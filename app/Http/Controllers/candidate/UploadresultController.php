<?php

namespace App\Http\Controllers\candidate;

use App\Exports\candidate\ApplicantTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\candidate\AdmissionImport;
use App\Imports\candidate\ApplicantImport;
use App\Models\candidate\AdmissionAcceptanceRelease;
use App\Models\candidate\Candidate_info;
use App\Models\candidate\Candidate_institution;
use App\Models\candidate\Admissionshortlist;
use App\Models\candidate\Admission_pin;
use App\Models\EAdmissionPin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
 
class UploadresultController extends Controller 
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    $perPage = $request->input('per_page', 20);
    $session = $request->input('session');
    $department = $request->input('department');
    $course = $request->input('course');
    $search = $request->input('search');
    $candidate = Candidate_institution::where('session', $session)->where('firstchoicecourse', $course)->count();
    $selectedsession = $course;
    $query = Candidate_info::with('candidateInstitution', 'candidateAcademic', 'candidateOlevel','candidateresult');
// $query = Candidate_info::with(['candidateInstitution', 'candidateAcademic', 'candidateOlevel', 'candidateresult' => function ($query) {
//     $query->orderBy('score', 'desc');
// }])->get();



    // Apply filters
    if ($session) {
        $query->where('session', $session);
    }
    if ($department) {
        $query->whereHas('candidateInstitution', function ($q) use ($department) {
            $q->where('firstchoiceschool', $department);
        });
    }
    if ($course) {
        $query->whereHas('candidateInstitution', function ($q) use ($course) {
            $q->where('firstchoicecourse', $course);
        });
    }
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('surname', 'like', '%' . $search . '%')
                ->orWhere('firstname', 'like', '%' . $search . '%')
                ->orWhere('othername', 'like', '%' . $search . '%')
                ->orWhere('admissionnumber', 'like', '%' . $search . '%');
        });
    }

    $candidateInfo = $query->paginate($perPage);
 
    $departments = DB::table('course_selection')->get();  
       return view('admin.candidate.applicant.result_view', compact('candidateInfo', 'departments','candidate','selectedsession'));
     }


public function transferAdmissions(Request $request)
{
    $selectedCandidates = $request->input('transfer');

    if (!empty($selectedCandidates)) {
        foreach ($selectedCandidates as $candidateId) {
            // Get the selected candidate's data
            $selectedCandidate = Candidate_info::with('candidateInstitution')->find($candidateId);

            if ($selectedCandidate) {
                // Determine the count based on the session
                $session = $selectedCandidate->session;
                
                // Check if the admission number already exists in the session
                $existingAdmission = Admissionshortlist::where('session', $session)
                    ->where('admissionnumber', $selectedCandidate->admissionnumber)
                    ->first();

                if (!$existingAdmission) {
                    // Admission number doesn't exist in the session, so insert it
                    Admissionshortlist::create([
                        'coursename' => $selectedCandidate->candidateInstitution->firstchoicecourse,
                        'admissionnumber' => $selectedCandidate->admissionnumber,
                        'session' => $session,
                        'count' => 1,
                    ]);

                }
            }
        }

         return redirect()->back()->with('success', 'Candidates transferred successfully.');
    }

    return redirect()->back()->with('error', 'No candidates selected for transfer.');
}



    public function result_upload()
    {
     return view('admin.candidate.applicant.result_upload');
    }

    public function passort()
    {
     return view('admin.candidate.applicant.passort');
    }
    
    public function locked(Request $request)
{
     $admissionAcceptance = AdmissionAcceptanceRelease::where('session', $request->session)->first();

    if ($admissionAcceptance) {
         $status = ($admissionAcceptance->locked === 0) ? 1 : 0;
        $admissionAcceptance->update(['locked' => $status]);

         $message = ($status === 1) ? 'Status : Release' : 'Status : Lock';
    } else {
         AdmissionAcceptanceRelease::create([
            'session' => $request->session,
            'locked' => 0,
        ]);

         $message = 'Status: Created Successfully';
    }

    return redirect()->back()->with('success', $message);
}
 
public function exportTemplate(Request $request)
{
     $request->validate([
        'selected_session' => 'required',
    ]);

     $selectedSession = $request->input('selected_session');

     return Excel::download(new ApplicantTemplateExport($selectedSession), 'applicant_template.xlsx');
}

   
     
    public function store_admission(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
            'session' => 'required',
            'coursename' => 'required',
        ]);
        

        $session = $request->input('session');
        $coursename = $request->input('coursename');
        $file = $request->file('file');

        $path = $file->store('temp');

        $import = new AdmissionImport($session, $coursename);
        Excel::import($import, $path);

        $failedRecords = $import->getFailedRecords();

        if ($failedRecords->isNotEmpty()) {
            $errorMessage = 'Some records already exist';
            

            return redirect()->back()->with('error', $errorMessage);
        } else {
            return redirect()->back()->with('success', 'Excel data imported successfully.');
        }

        return redirect()->route('import.form')
            ->withErrors($failedRecords);
    }
}
