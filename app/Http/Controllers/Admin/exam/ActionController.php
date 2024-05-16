<?php

namespace App\Http\Controllers\Admin\exam;

use App\Http\Controllers\Controller;
use App\Models\candidate\Batch;
use App\Models\candidate\Candidate_info;
use Illuminate\Http\Request;
use App\Models\candidate\Exam_checker ;
use App\Models\candidate\Time;
use Illuminate\Support\Facades\DB;
class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_batch($id)
    {
       $bat = Batch::find($id); 
       $candidate = Candidate_info::where('session', $bat->session)->count();
       $batchs = Batch::where('session', $bat->session)->get();
        
       return view('admin.exam.allocation.action.batch.edit',compact('bat','candidate', 'batchs'));
    } 

    public function update_batch(Request $request, $id)
    {
        $allocationLimit = intval($request->input('session2'));
        $allocationTo = intval($request->input('allocation'));
         if ($allocationTo > $allocationLimit) {
            return redirect()->back()->with('error', 'Unable to update Batch exceeds the limit');
        }
    
        $data = Batch::find($id);
        $data->session = $request->session;
        $data->allocation = $allocationTo;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->save();
    
        return redirect()->route('exam_allocate')->with('success', 'Batch updated successfully');
    }

    public function destroy_batch($id)
    {
       $batch = Batch::find($id); 
       $batch->delete();
       return redirect()->back()->with('success','Batch deleted successfully');
    }


    /*controller function for Exam_checker.*/
   

    public function edit_time($id)
    {
       $bat = Time::find($id); 
       $batchs = Batch::where('session', $bat->session)->get();
        
       return view('admin.exam.allocation.action.time.edit',compact('bat','batchs'));
    } 

    public function update_time(Request $request, $id)
    {
         dd($request);
        $allocationLimit = $request->input('remain');
        $allocationTo = $request->input('allocation_to');
    
        if ($allocationTo > $allocationLimit) {
            return back()->with('error', 'Time allocation exceeds the remaining limit');
        }
    
        try {
            // Start a database transaction
            DB::beginTransaction();
    
            // Insert the time into the times table
            $time = Time::find($id);
            $time->time_range = $request->input('time_range');
            $time->allocation_to = $allocationTo;
            $time->save();
    
            // Select random admission numbers from the candidate_info table using Eloquent model
            $admissionNumbers = Candidate_info::inRandomOrder()
            ->where('session',$request->input('sesion'))
            ->limit($allocationTo)
            ->pluck('admissionnumber')
            ->toArray();
    
            // Insert the selected admission numbers into the examination table
            foreach ($admissionNumbers as $admissionNumber) {
                $examination = new Exam_checker;
                $examination->time_id = $request->input('time_range');
                $examination->time = $request->input('time_range');
                $examination->session = $request->input('sesion');
                $examination->admissionnumber = $admissionNumber;
                $examination->save();
            }
    
            DB::commit();
    
            return redirect()->back()->with('success', 'Time inserted successfully');
        } catch (\Exception $e) {
             DB::rollback();
    
             return back()->with('error', 'An error occurred while saving the data.');
        }
    }

    public function destroy_time($id)
    {
        $batch = Time::find($id);
        $batch2 = Exam_checker::where('time_id', $id)->delete();
        if ($batch) {
            $batch->delete();
            return redirect()->back()->with('success', 'Time allocation deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Time allocation not found');
        }
    }
}
