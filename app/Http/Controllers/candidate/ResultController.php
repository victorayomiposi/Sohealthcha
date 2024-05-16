<?php

namespace App\Http\Controllers\candidate;

use App\Http\Controllers\Controller;
use App\Models\candidate\Candidate_info;
use App\Models\candidate\Cut_off;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel; 
use App\Imports\candidate\ApplicantImport;


class ResultController extends Controller
{
 
    public function index()
    {
        return view('auth.candidate.check.examresult');
    }
 
    public function check(Request $request)
    {
        $addmissionget = $request->input('admissionnumber');
        $pinget = $request->input('pin');
        $serialget = $request->input('serial');
         $pinStoreExists = DB::table('resultchecker_admission_pin')
        ->where('serial', $serialget)
        ->where('pin', $pinget)
        ->where('admissionnumber', $addmissionget)
        ->exists();
        //dd($pinStoreExists);
        if ($pinStoreExists) {
                // Data exists, admissionnumber is empty
                return redirect()->route('update.examresult', [
                    'admissionnumber' => $addmissionget,
                     
                ]);

        } else {
            // Data doesn't exist
            return redirect()->back()->with('error','Addmission number or your pin and serial not found.');
         }
         
    }
 
    public function examresult($admissionnumber)
{
     $candidateInfo = Candidate_info::with(
        'candidateInstitution',
        'candidateOlevel',
        'candidateresult'
    )->where('admissionnumber', $admissionnumber)->first();
    
$cut = DB::table('cut_offs')->where('name', $candidateInfo->candidateInstitution->firstchoicecourse)->pluck('cut_off')->first();
                                        $cutoff = !empty($cut) ? $cut : null;
 
 
    if (!$candidateInfo) {
        // Candidate not found
        return redirect()->back()->with('error', 'Candidate not found.');
    }
         $currentDateTime = Carbon::now()->format('h:ia, jS M Y');

     $options = new Options();
    $options->setIsRemoteEnabled(true);
    $options->setIsPhpEnabled(true);
    $dompdf = new Dompdf($options);

    $html = view('pdf.examresult', compact('candidateInfo','cutoff','currentDateTime'))->render();

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('pdf.examresult', ['Attachment' => 0]);
}

     public function store_result(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
            'session' => 'required',
        ]);
        $session = $request->input('session');
        $file = $request->file('file');

        $path = $file->store('temp');

        $import = new ApplicantImport($session);
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
 
}
