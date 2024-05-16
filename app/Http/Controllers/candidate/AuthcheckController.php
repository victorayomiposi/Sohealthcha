<?php

namespace App\Http\Controllers\candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\candidate\Candidate_info;
use App\Models\candidate\Examination_date;
use App\Models\candidate\Admission_pin;
use App\Models\candidate\Admissionshortlist;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;

class AuthcheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkexamdate()
    {
        return view('auth.candidate.check.examdate');
    }

    public function authexamdate(Request $request)
    {
        $addmissionget = $request->input('admissionnumber');
        
        $addmissioner = DB::table('candidate_info')
            ->where('admissionnumber', $addmissionget)
            ->exists();
        
        if ($addmissioner) {
            $addmission = DB::table('candidate_info')
            ->where('admissionnumber', $addmissionget)
            ->pluck('id')->first();
                // Data exists, admissionnumber is empty
                return redirect()->route('fetch.examdate', [
                    'admissionnumber' => $addmission,
                    
                ]);
             
        } else {
            // Data doesn't exist
            return redirect()->back()->with('error','Addmission number not found for: '. $addmissionget);
         }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function fetchexamdate($admission)
    {
        $candidateInfo = Candidate_info::with(
            'examChecker.batch'
        )->find($admission);
         
        $session = Candidate_info::where('id', $admission)->pluck('session')->first();
        $ADMNO = Candidate_info::where('id', $admission)->pluck('admissionnumber');
      //  dd($ADMNO);
          // protected $fillable =['admissionnumber','batch_id','time','session'];

      $allocateID = DB::table('exam_checkers')->where('admissionnumber', $ADMNO)->value('batch_id');
       $Date = DB::table('batches')->where('id', $allocateID)->value('description');
        $examDate = Carbon::parse($Date)->format('jS, M, Y');
    // dd($examDate);
       $allocatebatch = DB::table('batches')->where('id', $allocateID)->value('name');
     // dd($allocatebatch);/
      $allocation = DB::table('exam_checkers')->where('admissionnumber', $ADMNO)->value('time');
       // dd($allocation);
       $currentDateTime = Carbon::now()->format('h:i:s A');
        // Create a new Dompdf instance
        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $options->setIsPhpEnabled(true);
        $dompdf = new Dompdf($options);

        $html = view('pdf.examdate', compact('candidateInfo', 'examDate','allocation','allocatebatch','currentDateTime'))->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('pdf.examdate', ['Attachment' => 0]);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    
    public function delete()
    {
      $session = 2023;

    // Get admission numbers from Candidate_info for the specified session
    $admissionNumbers = Admissionshortlist::where('session',$session)->pluck('admissionnumber');

    // Find duplicate admission numbers in the ResultCheckerAdmissionPin table
    $duplicates = DB::table('e_admission_pin')->select('admissionnumber')
        ->whereIn('admissionnumber', $admissionNumbers)
        ->groupBy('admissionnumber')
         ->get();
   dd($admissionNumbers);
    return view('delete', compact('duplicates'));

    }
}
