<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceAttachment;
use App\Ads;

class ServicesController extends Controller
{
    private $ads;
    public function __construct()
    {
        //get relevent ads
        $presentDate = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $adsCount = Ads::where('start_date','<=',$presentDate)->where('end_date','>=',$presentDate)->count();
        if($adsCount > 0)
        {
            $this->ads = Ads::where('image_dimension','LIKE','%Sidebar%')->where('start_date','<=',$presentDate)->where('end_date','>=',$presentDate)->get();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //urldecode $slug
        $slug = urlencode($slug);
        //display results if exists, else display form
        $service = Service::where('slug', $slug)->count();
        if($service > 0)
        {
            $result = Service::where('slug', $slug)->first();
            $title = $result->title;
            //get meta keyword and description
            $description = $title;
            $keywords = str_replace(' ',',',$title);
            $topImages = ServiceAttachment::where('filePosition', 'top')->where('slug', $slug)->get();
            $bottomAttachments = ServiceAttachment::where('filePosition', 'bottom')->where('slug', $slug)->get();
        }
        //get ad if available
        $ads = $this->ads;        
        return view('frontend.'.$slug, compact('result', 'service', 'topImages', 'bottomAttachments', 'slug', 'title', 'ads', 'description', 'keywords'));
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