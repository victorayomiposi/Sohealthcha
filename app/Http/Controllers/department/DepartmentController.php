<?php

namespace App\Http\Controllers\department;

use App\Http\Controllers\Controller;
use App\Models\candidate\Cut_off;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Department\SelectCourse;

use function Pest\Laravel\delete;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $user = DB::table('course_selection')->get();
        return view('admin.department.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create');
    }

    public function programme()
    {
        $course = DB::table('course_selection')->get();
        return view('admin.department.addprogramme',compact('course'));
    }

    public function cutoffmark(Request $request)
    {
        $type = $request->type;
        $course = DB::table('course_selection')->get();
         $query = Cut_off::query();

        if ($request->has('type')) {
            $query->where('type', 'like', '%' . $request->input('type') . '%');
        }
         $cutoff = $query->get();
        return view('admin.department.cutoffmark',compact('course','cutoff'));
    }

    public function cutoffmark_edit($id)
    {
        $course = DB::table('course_selection')->get();
        $cutoff = Cut_off::find($id);
        return view('admin.department.cutoffedit',compact('course','cutoff'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_cutoff(Request $request)
    {
        $dataExist = Cut_off::where('name', $request->department)->exists();
    
        if ($dataExist) {
            return redirect()->back()->with('error', 'Cut-off mark already exists for this department');
        }
    
        $cutOff = new Cut_off();
        $cutOff->name = $request->department;
        $cutOff->type = $request->type;
        $cutOff->cut_off = $request->cutoffmark;
    
        if ($cutOff->save()) {
            return back()->with('success', 'Cut-off mark created successfully');
        }
    
        return back()->with('error', 'An error occurred while creating the Cut-off mark');
    }


    public function updatecutoff(Request $request, $id)
    {
        //dd($cutOff);
        $cutOff = Cut_off::find($id);
        $cutOff->name = $request->department;
        $cutOff->type = $request->type;
        $cutOff->cut_off = $request->cutoffmark;
     
        if ($cutOff->save()) {
            return redirect()->route('cutoffmark_depart')->with('success', 'Cut-off mark update successfully');
        }
    
        return back()->with('error', 'An error occurred while update the Cut-off mark');
    }


    public function store(Request $request)
    {
        $user = DB::table('course_selection')
        ->insert([
            'schoolname' => $request->department,
         ]);

        if ($user) {
            return back()->with('success', 'Department created successfully');
        }
    
        return back()->with('error', 'An error occurred while creating the department');
    }

    public function store_programme(Request $request)
{
    $depart = SelectCourse::find($request->department); // Find the SelectCourse record
    
    if (!$depart) {
        return back()->with('error', 'Department not found');
    }
    
    $depart->coursename = $request->course; // Update the coursename
    
    if ($depart->save()) {
        return redirect()->route('view_department')->with('success', 'Department updated successfully');
    }

    return back()->with('error', 'An error occurred while updating the department');
}

    public function edit($id)
    {
        $user = SelectCourse::findOrFail($id);
        return view('admin.department.edit',compact('user'));
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
        $depart = SelectCourse::findOrFail($id);    
        $depart->schoolname = $request->department;
        $depart->coursename = $request->course;
      
        if ($depart->save()) {
            return redirect()->route('view_department')->with('success', 'Department updated successfully');
        }
    
        return back()->with('error', 'An error occurred while updating the department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         
        $user = SelectCourse::findOrFail($id);
    
        if ($user->delete()) {
            return back()->with('success', 'Department deleted successfully');
        }
        return back()->with('error', 'An error occurred while deleting the department');
    }

 
    public function cutoffmark_delete($id)
    {
        $user = Cut_off::findOrFail($id);

        if ($user->delete()) {
            return back()->with('success', 'Cut-off mark deleted successfully');
        }

        return back()->with('error', 'An error occurred while deleting the Cut-off mark');
    }
     
}
