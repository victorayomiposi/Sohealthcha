<?php

namespace App\Http\Controllers\candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\candidate\Candidate_info;
use App\Models\candidate\Candidate_institution;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use App\Models\candidate\Examination_date;
use Carbon\Carbon;
use App\Exports\CandidateInfoExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ViewCandController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $session = $request->input('session');
        $department = $request->input('department');
        $course = $request->input('course');
        $search = $request->input('search');
        $candidate = Candidate_info::where('session', $session)->count();
        $selectedsession = $session;
        $query = Candidate_info::with('candidateInstitution', 'candidateAcademic', 'admissionPin', 'candidateOlevel')->orderBy('id', 'desc');

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

        return view('admin.candidate.applicant.view', compact('candidateInfo', 'departments','candidate','selectedsession'));
    }

 
   public function deleteDuplicates(Request $request)
    {
        $selectedDuplicates = $request->input('selectedDuplicates', []);
        
        if (!empty($selectedDuplicates)) {
            DB::table('candidate_result')
                ->whereIn('result_id', $selectedDuplicates)
                ->delete();
        }

        return redirect()->back()->with('success', 'Selected duplicates have been deleted.');
    }
 

    public function olevel(Request $request)
    {
    $perPage = $request->input('per_page', 20);
    $session = $request->input('session');
    $department = $request->input('department');
    $course = $request->input('course');
    $search = $request->input('search');
    $candidate = Candidate_info::where('session', $session)->count();
        $selectedsession = $session;
    $query = Candidate_info::with('candidateInstitution', 'candidateAcademic', 'candidateOlevel');

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
       return view('admin.candidate.applicant.olevel', compact('candidateInfo', 'departments','candidate','selectedsession'));
    }

    public function show($id)
    { 
        
    $candidateInfo = Candidate_info::with(
        'candidateInstitution',
        'candidateAcademic',
         'candidateOlevel'
    )->find($id);

    $session = Candidate_info::where('id', $id)->pluck('session')->first();
    $examDate = Examination_date::where('session', $session)->value('exam_date');

    $admno = Candidate_info::where('id', $id)->pluck('admissionnumber')->first();
    $admissionPin = DB::table('resultchecker_admission_pin')->where('admissionnumber', $admno)->get();
    $currentDateTime = Carbon::now()->format('h:i:s A');

 
    $pdf = Pdf::loadView(
        'pdf.photocard',
        compact('candidateInfo', 'examDate','admissionPin','currentDateTime')
    )->setPaper('A4', 'portrait');
    return $pdf->stream('photocard_'.$admno . '.pdf');
    }

    public function course_list(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $session = $request->input('session');
        $department = $request->input('department');
        $course = $request->input('course');
        $search = $request->input('search');

        $query = Candidate_info::with('candidateInstitution', 'candidateAcademic', 'admissionPin', 'candidateOlevel');

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

        return view('admin.candidate.course.index', compact('candidateInfo', 'departments'));
    }
    public function edit_course($id)
    {
         $user = Candidate_info::with('candidateInstitution')->find($id);
          $departments = DB::table('course_selection')->get(); 
        return view('admin.candidate.course.edit', compact('departments','user'));
    }
     
    public function update_course(Request $request, $id)
    {
        $user = Candidate_info::find($id);
    
        // Validate the request data
        $validatedData = $request->validate([
            'department' => 'required',
            'course' => 'required',
        ]);
    
        // Update the user's department and course
        $user->candidateInstitution()->update([
            'firstchoiceschool' => $validatedData['department'],
            'firstchoicecourse' => $validatedData['course'],
        ]);
    
         return redirect()->route('applicantcourse')->with('success', 'Course updated successfully');
    }


    public function change_courses(Request $request, $admissionnumber)
    {
        $user = Candidate_institution::where('admissionnumber', $admissionnumber)->first();
        
        // Validate the form inputs
        $validatedData = $request->validate([
            'department' => 'required',
            'course' => 'required'
        ]);

        // Update the department and course for the specified user
        $user->update([
            'firstchoiceschool' => $validatedData['department'],
            'firstchoicecourse' => $validatedData['course']
        ]);

        // Redirect to the desired page after updating the course
        return redirect()->route('changecourse')->with('error', 'Course updated successfully');
    }

     public function exportInfo()
    {
       return view('admin.candidate.applicant.export');
    }
    
   public function applicantexport(Request $request)
{
    $session = $request->input('session');
    return Excel::download(new CandidateInfoExport($session), 'candidates_'.$session.'.xlsx');
}


}
