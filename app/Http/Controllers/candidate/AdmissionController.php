<?php

namespace App\Http\Controllers\candidate;

use App\Exports\candidate\AdmissionlistExport;
use App\Http\Controllers\Controller;
use App\Imports\candidate\AdmissionImport;
use App\Models\candidate\AdmissionAcceptanceRelease;
use App\Models\candidate\Admissionshortlist;
use App\Models\candidate\Candidate_info;
use App\Models\Department\SelectCourse;
use App\Models\candidate\Candidate_institution;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdmissionController extends Controller
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
        $course = $request->input('course');
        $search = $request->input('search');
        $candidated = Admissionshortlist::where('session', $session)->where('coursename', $course)->count();
        $candid = Admissionshortlist::where('session', $session)->count();

        $selectedsession = $course;
        $query = Admissionshortlist::with('candidate', 'candidateInstitution', 'candidateAcademic', 'candidateOlevel', 'candidateresult');

        if ($session) {
            $query->where('session', $session);
        }



        if ($course) {
            $query->whereHas('candidateInstitution', function ($q) use ($course) {
                $q->where('firstchoicecourse', $course);
            });
        }
        if ($search) {
            $query->whereHas('candidate', function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('surname', 'like', '%' . $search . '%')
                        ->orWhere('firstname', 'like', '%' . $search . '%')
                        ->orWhere('othername', 'like', '%' . $search . '%')
                        ->orWhere('admissionnumber', 'like', '%' . $search . '%');
                });
            });
        }


        $candidateInfo = $query->paginate($perPage);

        $departments = DB::table('course_selection')->get();

        return view('admin.candidate.admission.index', compact('candidateInfo', 'candidated', 'departments', 'selectedsession', 'candid'));
    }





    public function create()
    {
        $course = SelectCourse::all();
        return view('admin.candidate.admission.create', compact('course'));
    }

    public function lock()
    {

        return view('admin.candidate.admission.lock');
    }

    public function export()
    {
        return Excel::download(new AdmissionlistExport, 'Admission_template.xlsx');
    }


    public function store(Request $request)
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
            return redirect()->back()->with('success', 'Applicant data imported successfully.');
        }

        return redirect()->route('import.form')
            ->withErrors($failedRecords);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
