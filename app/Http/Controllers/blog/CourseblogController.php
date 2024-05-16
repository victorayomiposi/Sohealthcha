<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use App\Models\blog\course\Courseblog;
use App\Models\blog\course\Coursecontent;
use App\Models\Department\SelectCourse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseblogController extends Controller
{
    
    public function index()
    {
     $posts = Courseblog::all();
     return view('blog.course.index',compact('posts'));
    }

    // public function content()
    // {
        
    //  $posts =  Courseblog::with('Coursecontent')->get();
    //   return view('blog.department.content',compact('posts'));
    // }

    public function blog()
    {
     $posts = Courseblog::all();
     return view('blog.course.blog',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $depart = SelectCourse::all();
       return view('blog.course.create',compact('depart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $dataExist = Courseblog::where('name', $request->name)->exists();

    if ($dataExist) {
        return redirect()->back()->with('error', 'Course with the same name already exists.');
    }

    $post = new Courseblog;
    $post->name = $request->name;
    $post->about = $request->about;
    $post->description = $request->description;

    // Check if an image was uploaded
    if ($request->hasFile('images')) {
        $image = $request->file('images');

        // Generate a unique name for the image based on the timestamp and the original extension
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Save the image to the 'course_images' folder in the 'public' directory
        $image->storeAs('course_images', $imageName, 'public');

        // Save the image name in the database
        $post->images = $imageName;
    }

    $post->save();

    if ($post->save()) {
        return back()->with('success', 'Course blog created successfully');
    }

    return back()->with('error', 'An error occurred while creating the Course blog');
}
  

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Courseblog::find($id);
        $post = Courseblog::all();
        return view('blog.view.course',compact('posts','post'));
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
     $post = Courseblog::find($id);
     return view('blog.course.edit',compact('post','depart'));
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
        $post = Courseblog::find($id);
        $post->name =$request->name;
        $post->about =$request->about;
        $post->images =$request->images;
        $post->description =$request->description;
        $post->save();
        if ($post->save()) {
            return redirect()->route('course_blog')->with('success', 'Course blog update successfully');
        }
    
        return back()->with('error', 'An error occurred while updating the Course blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $delete = Courseblog::find($id);
        if ($delete->delete()) {
            return back()->with('success', 'Course blog deleted successfully');
            }

        return back()->with('error', 'An error occurred while deleting the Course blog');
    }
}
