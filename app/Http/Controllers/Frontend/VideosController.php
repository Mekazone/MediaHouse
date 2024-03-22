<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;
use App\News;
use App\Ads;
//use App\VideosComment;
use Illuminate\Routing\UrlGenerator;

class VideosController extends Controller
{
    private $centreTopAds;
    private $centreCentreAds;
    private $centreBottomAds;
    //sidebar ads
    private $ads;
        
    public function __construct()
    {
        //get relevent ads
        $presentDate = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $adsCount = Ads::where('start_date','<=',$presentDate)->where('end_date','>=',$presentDate)->count();
        if($adsCount > 0)
        {
            $this->ads = Ads::where('image_dimension','LIKE','%Sidebar%')->where('start_date','<=',$presentDate)->where('end_date','>=',$presentDate)->get();
            $this->centreTopAds = Ads::where('image_dimension','LIKE','%Centre%')->where('start_date','<=',$presentDate)->where('end_date','>=',$presentDate)->offset(0)->limit(1)->get();
            $this->centreCentreAds = Ads::where('image_dimension','LIKE','%Centre%')->where('start_date','<=',$presentDate)->where('end_date','>=',$presentDate)->offset(1)->limit(1)->get();
            $this->centreBottomAds = Ads::where('image_dimension','LIKE','%Centre%')->where('start_date','<=',$presentDate)->where('end_date','>=',$presentDate)->skip(2)->take(PHP_INT_MAX)->get();
        }                
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Videos";
        $videos = Video::all()->count();
        if($videos > 0)
        {                                  
            //print videos if it exists
            $results = Video::orderBy('date','desc')->paginate(5);
            foreach($results as $result)
            {                               
                
                /*//get comments
                $comments = NewsComment::where('postId', $result->id)->where('status', 'approved')->count();
                if($comments > 0)
                {
                    $result->comments = $comments;
                }
                */ 
                $posts[] = $result;
                
            } 
            //sort post archive
            $archives = Video::select('date','title','slug','category')->orderBy('date','desc')->get();
            // An array to store the data in a more managable order.
            
            $data = array();
            foreach($archives as $archive){
                $year = date('Y', $archive->date);
                $month = date('m', $archive->date);
                
                $data[$year][$month][] = $archive;
            }
        }
        //get ad if available
        $ads = $this->ads;
        return view('frontend.videos', compact('title', 'results', 'posts', 'videos', 'ads', 'data'));
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
        //validation rules
        $rules = [
            'name' => 'required',
            'comment' => 'required'
        ];
        $overview = $this->validate(request(), $rules);
        //date
        $date = mktime(date('H'),date('i'),date('s'), date('m'), date('d'), date('Y'));
        //db insert
        $create = NewsComment::create([
                    'postId' => $request->postId,
                    'date' => $date,
                    'name' => $request->name,
                    'comment' => $request->comment,
                    'status' => 'pending'
        ]);

        return redirect($request->returnUrl)->with('success', 'Success. Your comment shall appear after admin verification.');
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
        $title = "Videos";
        //display results if exists, else display form
        $videos = Video::all()->count();
        if ($videos > 0) {
            $result = Video::where('slug', $slug)->first();
            //get meta keyword and description
            $description = $result->title;
            $keywords = str_replace(' ',',',$result->title);
        }
        //get similar news
        $similarVideos = Video::where('slug','<>', $slug)->orderBy('date','desc')->limit(3)->get();
        //get ad if available        
        $centreTopAds = $this->centreTopAds;
        $centreCentreAds = $this->centreCentreAds;
        $centreBottomAds = $this->centreBottomAds;
        $ads = $this->ads;
        return view('frontend.videosView', compact('result', 'title', 'ads', 'videos', 'similarVideos', 'description', 'keywords', 'centreTopAds', 'centreCentreAds', 'centreBottomAds', 'ads'));
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
