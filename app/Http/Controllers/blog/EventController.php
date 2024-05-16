<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use App\Models\blog\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = Event::all();
        return view('blog.event.index',compact('show'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.event.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
   {
        // dd($request);
       $this->validate($request, [
 
             'title' => 'required',
 
             'description' => 'required'
 
        ]);
 
    
       $description = $request->description;
 
       $dom = new \DomDocument();
 
       $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
 
       $images = $dom->getElementsByTagName('img');
 
       foreach($images as $k => $img){
 
 
           $data = $img->getAttribute('src');
 
           list($type, $data) = explode(';', $data);
 
           list(, $data)      = explode(',', $data);
 
           $data = base64_decode($data);
 
           $image_name= "/post/" . time().$k.'.png';
 
           $path = public_path() . $image_name;
 
           file_put_contents($path, $data);
 
           $img->removeAttribute('src');
 
           $img->setAttribute('src', $image_name);
 
        }
 
        $date = Carbon::now()->format('jS, F Y');

       $description = $dom->saveHTML();
 
       $summernote = new Event();
 
       $summernote->title = $request->title;
 
       $summernote->description = $description;
       $summernote->date = $date;
 
       $summernote->save();
 
       if ($summernote->save()) {
        return back()->with('success', 'Event blog created successfully');
    }

    return back()->with('error', 'An error occurred while creating the Event blog');
 
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
