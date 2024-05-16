<?php

namespace App\Http\Controllers\candidate;

use App\Http\Controllers\Controller;
use App\Models\candidate\AdmissionAcceptanceRelease;
use App\Models\candidate\Candidate_info;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AcceptanceController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function acceptance_index()
    {
        return view('auth.candidate.check.acceptance');
    }

    public function acceptance_check(Request $request)
    {
        $admissionGet = $request->input('admissionnumber');
    $pinGet = $request->input('pin');
    $serialGet = $request->input('serial');
    
    // Fetch the "session" value directly
    $session = Candidate_info::where('admissionnumber', $admissionGet)->value('session');
    if (!empty($session)) {
        $admissionLock = AdmissionAcceptanceRelease::where('session', $session)->first(); 

        if ($admissionLock === null) {
            return redirect()->back()->with('error', 'Admission number or Session not Found.');
        }

        if ($admissionLock->locked === 0) {
            return redirect()->back()->with('error', 'Admission letter is currently unavailable.');
        }

        $pinStoreExists = DB::table('resultchecker_admission_pin')
            ->where('serial', $serialGet)
            ->where('pin', $pinGet)
            ->where('admissionnumber', $admissionGet)
            ->exists();
            
             $admissionExists = DB::table('admissionshortlist')
            ->where('admissionnumber', $admissionGet)
            ->exists();
            
         if ($pinStoreExists && $admissionExists) {
            return redirect()->route('print.acceptance', ['admissionnumber' => $admissionGet]);
        } else {
            return redirect()->back()->with('error', 'Admission number or your pin and serial not found.');
        }
    } else {
        return redirect()->back()->with('error', 'Session not Found.');
    }
 
    }

    public function acceptance($admissionnumber) 
    {
        $candidateInfo = Candidate_info::with(
            'candidateInstitution',
            'candidateresult'
        )->where('admissionnumber', $admissionnumber)->first();
    
        if (!$candidateInfo) {
            // Candidate not found
            return redirect()->back()->with('error', 'Candidate not found.');
        }
    
 
        $currentTime= Carbon::now()->format('h:ia, jS M Y');
        $time = Carbon::now()->format('Y-m-d'); 
        $pdf = Pdf::loadView(
            'pdf.acceptanceletter',
            compact('candidateInfo','currentTime','time')
        )->setPaper('a4', 'portrait');

        return $pdf->stream('acceptanceletter_' . $candidateInfo->admissionnumber. '.pdf');
    }
    
     public function show($admissionnumber) 
    {
        $candidateInfo = Candidate_info::with(
            'candidateInstitution',
            'candidateresult'
        )->where('admissionnumber', $admissionnumber)->first();
    
        if (!$candidateInfo) {
            // Candidate not found
            return redirect()->back()->with('error', 'Candidate not found.');
        }
    
        $currentTime= Carbon::now()->format('h:ia, jS M Y');
        $time = Carbon::now()->format('Y-m-d'); 
        $pdf = Pdf::loadView(
            'pdf.acceptanceletter',
            compact('candidateInfo','currentTime','time')
        )->setPaper('a4', 'portrait');

        return $pdf->stream('acceptanceletter_' . $candidateInfo->admissionnumber. '.pdf');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admission_index()
    {
        return view('auth.candidate.check.admission');
    }

    public function admission_check(Request $request)
    {
        $admissionGet = $request->input('admissionnumber');
        $pinGet = $request->input('pin');
        $serialGet = $request->input('serial');
        
        // Fetch the "session" value directly
        $session = Candidate_info::where('admissionnumber', $admissionGet)->value('session');
    
        if (!empty($session)) {
            $admissionLock = AdmissionAcceptanceRelease::where('session', $session)->first();
    
            if ($admissionLock === null) {
                return redirect()->back()->with('error', 'Admission number or Session not Found.');
            }
    
            if ($admissionLock->locked === 0) {
                return redirect()->back()->with('error', 'Admission letter is currently unavailable.');
            }
            $limitExists = DB::table('e_admission_pin')
    ->where('serial', $serialGet)
    ->where('pin', $pinGet)
    ->where(function ($query) use ($admissionGet) {
        $query->where('admissionnumber', $admissionGet)
              ->orWhere('admissionnumber', 0);
    })
    ->first(); // Retrieve the record

if (!$limitExists) {
    return redirect()->back()->with('error', 'Invalid pin, serial or admission number.');
}

if ($limitExists->countused >= 5) {
    return redirect()->back()->with('error', 'You have reached the limit. Check your admission letter.');
}

        
         $pinStoreExists = DB::table('e_admission_pin')
        ->where('serial', $serialGet)
        ->where('pin', $pinGet)
        ->where(function ($query) use ($admissionGet) {
            $query->where('admissionnumber', $admissionGet)
                  ->orWhere('admissionnumber', 0);
        })
        ->exists();
           
    
    
            $admissionExists = DB::table('admissionshortlist')
                ->where('admissionnumber', $admissionGet)  
                ->exists();  
            
            if ($pinStoreExists && $admissionExists) {
     
                DB::table('e_admission_pin')
                    ->where('serial', $serialGet)
                    ->where('pin', $pinGet)
                     ->update([
                'admissionnumber' => $admissionGet,
                'countused' => DB::raw('countused + 1')  
            ]);  
            
            
                return redirect()->route('print.admission', ['admissionnumber' => $admissionGet]);
            } else {
                
                return redirect()->back()->with('error', 'You have reached the limit.Purchase another card.');
            }
    
        } else {
            return redirect()->back()->with('error', 'Session not Found.');
        }
    }


    public function admission($admissionnumber)
    {
        $candidateInfo = Candidate_info::with( 
            'candidateInstitution',
            'Admissionlist',
            'candidateresult'
        )->where('admissionnumber', $admissionnumber)->first();
    
        if (!$candidateInfo) {

            return redirect()->back()->with('error', 'Candidate not found.');
        }
    
    
        
         $currentTime= Carbon::now()->format('h:ia, jS M Y');
        $time = Carbon::now()->format('Y-m-d'); 
        $pdf = Pdf::loadView('pdf.admissionletter', compact('candidateInfo','currentTime','time')
        )->setPaper('a4', 'portrait');

        return $pdf->stream('acceptanceletter_' . $candidateInfo->admissionnumber. '.pdf');

    }
    
     
}
