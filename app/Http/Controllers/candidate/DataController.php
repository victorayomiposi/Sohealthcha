<?php

namespace App\Http\Controllers\candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\candidate\Candidate_info;
use App\Models\candidate\Examination_date;
use App\Models\pin\PinStore;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class DataController extends Controller
{

    public function index()
    {
        return view('auth.candidate.data.reprintphotocard');
    }

    public function change_course()
    {
        return view('auth.candidate.data.change_course');
    }

    public function store(Request $request)
    {
        $request->validate([
            'admissionnumber' => 'nullable|exists:candidate_info,admissionnumber',
            'pinnumber' => 'nullable|exists:pin_stores,pinnumber',
            'serialnumber' => 'nullable|exists:pin_stores,serialnumber',
            'tab' => 'required',
        ]);
        $tab = $request->tab;
        if ($tab == 0) {
            $admissionNumber = $request->input('admissionnumber');
            $candidate = DB::table('candidate_info')
                ->where('admissionnumber', $admissionNumber)
                ->first();

            if ($candidate) {
                $admissionId = $candidate->id;
                return redirect()->route('fetch.photocard', ['admissionnumber' => $admissionId]);
            } else {
                return redirect()->back()->with('error', 'Admission number not found for: ' . $admissionNumber);
            }
        } else {
            $pinExists = PinStore::where('serialnumber', $request->serialnumber)
                ->where('pinnumber', $request->pinnumber)
                ->first();
            $admissionNumber = $pinExists->admissionnumber;
            $candidate = DB::table('candidate_info')
                ->where('admissionnumber', $admissionNumber)
                ->first();

            if ($candidate) {
                $admissionId = $candidate->id;
                return redirect()->route('fetch.photocard', ['admissionnumber' => $admissionId]);
            } else {
                return redirect()->back()->with('error', 'Admission number not found for: ' . $admissionNumber);
            }
        }
    }

    public function passport(Request $request)
    {
        $session = $request->input('session');
        $candidates = Candidate_info::where('session', $session)->pluck('passport');
        // dd($candidates);
        foreach ($candidates as $candidatePassport) {
            $sourcePath = public_path('storage/' . trim($candidatePassport, './'));
            $destinationPath = public_path('candidate_images/' . $session);

            if (!File::exists($sourcePath)) {
                dd("Source file does not exist: " . $sourcePath);
            }

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            $fileName = pathinfo($sourcePath, PATHINFO_BASENAME);
            $destinationFilePath = $destinationPath . '/' . $fileName;

            File::copy($sourcePath, $destinationFilePath);
        }
    }

    public function check(Request $request)
    {
        $addmissionget = $request->input('admissionnumber');
        $pinget = $request->input('pin');
        $serialget = $request->input('serial');

        $pinStoreExists = DB::table('changeofcourseformpin')
            ->where('serial', $serialget)
            ->where('pin', $pinget)
            ->exists();
        $Course = DB::table('changeofcourseformpin')
            ->where('serial', $serialget)
            ->where('pin', $pinget)
            ->pluck('course_available');
        $courseExists = DB::table('candidate_institution_choice')
            ->where('admissionnumber', $addmissionget)
            ->exists();
        if ($pinStoreExists && $courseExists) {
            // Data exists, admissionnumber is empty
            return redirect()->route('update.change_course', [
                'admissionnumber' => $addmissionget,
                'Course' => $Course,
            ]);
        } else {
            // Data doesn't exist
            return redirect()->back()->with('error', 'Addmission number or your pin and serial not found.');
        }
    }

    public function fetchphotocard($admission)
    {
        $candidateInfo = Candidate_info::with(
            'candidateInstitution',
            'candidateAcademic',
            'admissionPin',
            'candidateOlevel',
            'Pinstore',
        )->find($admission);

        $session = Candidate_info::where('id', $admission)->pluck('session')->first();

        $examDate = Examination_date::where('session', $session)->value('exam_date');

        $admno = Candidate_info::where('id', $admission)->pluck('admissionnumber')->first();
        $admissionPin = DB::table('resultchecker_admission_pin')->where('admissionnumber', $admno)->get();

        $currentDateTime = Carbon::now()->format('h:i:s A');

        $pdf = Pdf::loadView(
            'pdf.photocard',
            compact('candidateInfo', 'examDate', 'admissionPin', 'currentDateTime')
        )->setPaper('A4', 'portrait');
        return $pdf->stream('photocard_' . $admno . '.pdf');
    }

    public function changeCourse($admissionnumber, $Course)
    {

        $courseArray = json_decode($Course);

        $courseName = $courseArray[0];

        $departments = DB::table('course_selection')->where('coursename', $courseName)->get();

        if ($departments->isEmpty()) {
            return redirect()->back()->with('error', 'No departments found for the selected course.');
        }
        return view('auth.candidate.change_course', compact('admissionnumber', 'departments'));
    }
}
