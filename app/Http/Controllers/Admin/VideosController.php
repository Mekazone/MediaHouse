<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;

class VideosController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //output posts if exists
        $videos = Video::all()->count();
        if ($videos > 0) {
            $results = Video::orderBy('date', 'desc')->paginate(10);
        }
        return view('admin.videos', compact('results', 'videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videosCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //validation rules
        $rules = [
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'title' => 'required',
            'video' => 'required'
        ];

        $overview = $this->validate(request(), $rules);
        //create date
        $date = mktime(date('H'),date('i'),date('s'), $request->month, $request->day, $request->year);
        //create slug from title
        $slug = str_replace(' ', '-', $request->title);
        $slug = urlencode(strtolower(str_replace('/', '-', $slug)));
        //db insert
        $create = Video::create([

                    'date' => $date,
                    'title' => $request->title,
                    'slug' => $slug,
                    'link' => urlencode($request->video),
                    'category' => 'videos'
        ]);

        return back()->with('success', 'Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date, $slug) {
        //urldecode $slug
        $slug = urlencode($slug);
        //display results if exists, else display form
        $videos = Video::all()->count();
        if ($videos > 0) {
            $result = Video::where('slug', $slug)->first();
        }
        return view('admin.videosView', compact('result', 'videos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $results = Video::where('id', $id)->first();
        $day = date('d', $results->date);
        $month = date('m', $results->date);
        $year = date('Y', $results->date);
        return view('admin.videosEdit', compact('results', 'id', 'day', 'month', 'year'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //validation rules
        $rules = [
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'title' => 'required',
            'video' => 'required'
        ];

        $overview = $this->validate(request(), $rules);

        $date = mktime(date('H'),date('i'),date('s'), $request->month, $request->day, $request->year);
        //create slug from title
        $slug = str_replace(' ', '-', $request->title);
        $slug = urlencode(strtolower(str_replace('/', '-', $slug)));

        //update db
        $update = Video::where('id', $id)->first();
        $update->date = $date;
        $update->title = $request->title;
        $update->link = urlencode($request->video);
        $update->slug = $slug;
        $update->save();

        return redirect('/admin/videos')->with('success', 'Edit successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //delete video
        $video = Video::find($id);
        $video->delete();
        return redirect('/admin/videos')->with('success', 'Deleted');
    }
}