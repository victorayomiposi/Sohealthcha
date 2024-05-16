<?php

namespace App\Http\Controllers\Admin\exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\candidate\Candidate_info;
use App\Models\candidate\Batch;
use App\Models\candidate\Time;
use App\Models\candidate\Exam_checker;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CandidateExport;

class AllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $candidate = Candidate_info::where('session', $request->session)->count();
        $batchs = Batch::with('times')->where('session', $request->session)->get();
        $check = $request->session;

        return view('admin.exam.allocation.index',compact('candidate', 'batchs','check'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function view(Request $request)
{
    $perPage = $request->input('per_page', 20);
    $session = $request->input('session');
    $batch = $request->input('batch');
    $timed = $request->input('time');
    $sessionselected = $session ;
    $batchselected = Batch::where('id', $batch)->pluck('name')->first();
    $timeselected = $timed ;
    
    // Check if the selected batch is unique within the session
    $uniqueBatch = Exam_checker::where('session', $session)
        ->where('batch_id', $batch)
        ->exists();
    
    if (!$uniqueBatch) {
        // Handle error or display a message indicating non-unique batch within the session
    }
    
    // Get all times associated with the selected batch within the session
    $times = Exam_checker::where('session', $session)
        ->where('batch_id', $batch)
        ->pluck('time')
        ->unique();
    
    $candidate = Exam_checker::with('candidateInfo', 'batch')
        ->where('session', $session)
        ->where('batch_id', $batch)
        ->where('time', $timed)
        ->paginate($perPage);
    
    return view('admin.exam.allocation.view', compact('candidate', 'times','batchselected','sessionselected','timeselected'));
}

 
 public function getBatchesAndTimes(Request $request)
{
    $session = $request->input('session');
    
    // Get unique batches for the selected session
    $batches = Exam_checker::where('session', $session)
        ->distinct('batch_id')
        ->pluck('batch_id');

    // Get batch names for the selected session and batches
    $batchNames = Batch::whereIn('id', $batches)
        ->pluck('name');

    // Get unique times for the selected session and batches
    $times = Exam_checker::where('session', $session)
        ->whereIn('batch_id', $batches)
        ->distinct('time')
        ->pluck('time');
    
    return response()->json([
        'batches' => $batches,
        'batchNames' => $batchNames,
        'times' => $times,
    ]);
}
public function export_candidates(Request $request)
{
    $session = $request->input('session');
    $batch = $request->input('batch');
    $time = $request->input('time');
    $batchselected = Batch::where('id', $batch)->pluck('name')->first();

    $filename = 'Allocation_' . $session . '_' . $batchselected . '_' . $time . '.xlsx';

    return Excel::download(new CandidateExport(), $filename);
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $allocationLimit = intval($request->input('session2'));
        $allocationTo = intval($request->input('allocation'));
        //dd($allocationTo);
        if ($allocationTo > $allocationLimit) {
            return redirect()->back()->with('error', 'Batch exceeds the remaining limit');
        }
    
        $data = new Batch();
        $data->session = $request->session;
        $data->allocation = $allocationTo;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->save();
    
        return redirect()->back()->with('success', 'Batch created successfully');
    }

    public function save(Request $request)
    {
        $allocationLimit = $request->input('allocation_limit');
        $allocationTo = $request->input('allocation_to');

        if ($allocationTo > $allocationLimit) {
            return back()->with('error', 'Allocation exceeds the remaining limit');
        }

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Insert the time into the times table
            $time = new Time;
            $time->time_range = $request->input('time_range');
            $time->allocation_to = $allocationTo;
            $time->batch_id = $request->input('batch_id');
            $time->save();

            // Retrieve all admission numbers from the candidate_info table
            $allAdmissionNumbers = Candidate_info::where('session', $request->input('sesion'))
            ->distinct()
            ->pluck('admissionnumber')
            ->toArray();
          //  dd($allAdmissionNumbers);
            // Retrieve already allocated admission numbers from the examination table
            $allocatedAdmissionNumbers = Exam_checker::where('session', $request->input('sesion'))
                ->pluck('admissionnumber')
                ->toArray();

            // Calculate the remaining available admission numbers
            $availableAdmissionNumbers = array_diff($allAdmissionNumbers, $allocatedAdmissionNumbers);

            // Shuffle the available admission numbers
            shuffle($availableAdmissionNumbers);

            // Select the required number of admission numbers
            $admissionNumbers = array_slice($availableAdmissionNumbers, 0, $allocationTo);

            // Insert the selected admission numbers into the examination table
            foreach ($admissionNumbers as $admissionNumber) {
                $i = 1;
                $examination = new Exam_checker;
                $examination->batch_id = $request->input('batch_id');
                $examination->time_id =  $time->id;
                $examination->time = $request->input('time_range');
                $examination->session = $request->input('sesion');
                $examination->admissionnumber = $admissionNumber;
                $examination->save();
            }

            DB::commit();

            return redirect()->back()->with('success', 'Time inserted successfully');
        } catch (\Exception $e) {
            DB::rollback();
                dd($e);
            return back()->with('error', 'An error occurred while saving the data.');
        }
    }
 
     
}
