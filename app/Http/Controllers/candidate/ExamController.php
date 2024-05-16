<?php

namespace App\Http\Controllers\candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\candidate\Examination_date;
use Carbon\Carbon;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function set_exam_date()
    {
        return view('admin.exam.date.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dateExist = Examination_date::where('session', $request->session)->first();
    
        if ($dateExist) {
            $dateExist->exam_date = Carbon::createFromFormat('Y-m-d', $request->exam_date)->format('jS, F Y');
            $dateExist->save();
            return back()->with('success', 'Exam date updated successfully');
        }
    
        $user = Examination_date::create([
            'session' => $request->session,
            'exam_date' => Carbon::createFromFormat('Y-m-d', $request->exam_date)->format('jS, F Y'),
        ]);
    
        if ($user) {
            return back()->with('success', 'Exam date set successfully');
        }
    
        return back()->with('error', 'An error occurred while setting the exam date');
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
