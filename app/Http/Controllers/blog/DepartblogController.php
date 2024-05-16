<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use App\Models\blog\department\Deptblog;
use App\Models\blog\department\Deptcontent;
use Illuminate\Http\Request;
use App\Models\Department\SelectCourse;
use Carbon\Carbon;

class DepartblogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $posts = Deptblog::all();
     return view('blog.department.index',compact('posts'));
    }

    // public function content()
    // {
        
    //  $posts =  Deptblog::with('deptcontent')->get();
    //   return view('blog.department.content',compact('posts'));
    // }

    public function blog()
    {
     $posts = Deptblog::all();
     return view('blog.department.blog',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $depart = SelectCourse::all();
       return view('blog.department.create',compact('depart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataExist = Deptblog::where('name', $request->name)->exists();
    
        if ($dataExist) {
            return redirect()->back()->with('error', 'Department with same name already exists.');
        }
        $post = new Deptblog;
        $post->name =$request->name;
        $post->about =$request->about;
        $post->description =$request->description;
        $post->save();
        if ($post->save()) {
            return back()->with('success', 'Department blog created successfully');
        }
    
        return back()->with('error', 'An error occurred while creating the Department blog');
    }
  

    public function blog_store(Request $request)
    {
        $date = Carbon::now()->format('jS, F Y');
        //dd($request);
        $post = new Deptcontent;
        $post->depart_id =$request->depart_id;
        $post->title =$request->title;
        $post->date = $date;
        $post->description =$request->description;
        $post->save();
        if ($post->save()) {
            return back()->with('success', 'Department blog publish successfully');
        }
    
        return back()->with('error', 'An error occurred while publish the Department blog');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Deptblog::find($id);
        $post = Deptblog::all();
        return view('blog.view.department',compact('posts','post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
     $depart = SelectCourse::all();
     $post = Deptblog::find($id);
     return view('blog.department.edit',compact('post','depart'));
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
        $post = Deptblog::find($id);
        $post->name =$request->name;
        $post->about =$request->about;
        $post->description =$request->description;
        $post->save();
        if ($post->save()) {
            return redirect()->route('depart_blog')->with('success', 'Department blog update successfully');
        }
    
        return back()->with('error', 'An error occurred while updating the Department blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $delete = Deptblog::find($id);
        if ($delete->delete()) {
            return back()->with('success', 'Department blog deleted successfully');
            }

        return back()->with('error', 'An error occurred while deleting the Department blog');
    }
}
