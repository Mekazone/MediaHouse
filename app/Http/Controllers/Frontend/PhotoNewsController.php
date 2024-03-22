<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PhotoNews;
use App\PhotoNewsAlbum;
use App\Ads;

class PhotoNewsController extends Controller
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
    public function index() {
        //get meta keyword and description
        $title = 'Photo News';
        $description = 'Photo News';
        $keywords = str_replace(' ',',',$description);
        //output posts if exists
        $albums = PhotoNewsAlbum::all()->count();
        if($albums > 0){
            $results = PhotoNewsAlbum::orderBy('id', 'desc')->paginate(15);
            
            $photos = array();
            foreach($results as $result){
                //get first image in each album
                $photo = PhotoNews::select('name')->where('albumId',$result->id)->first();
                if(count($photo)>0){
                   $result->photo = $photo->name; 
                } 
                $photos[] = $result;                                   
            }
            
        }

        //get ad if available
        $ads = $this->ads;
        return view('frontend.photoNews', compact('results', 'photos', 'albums', 'photoName', 'title', 'description', 'keywords', 'ads'));
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
    public function show($id)
    {
        //get meta keyword and description
        $title = 'Photo News';
        $description = 'Photo News';
        $keywords = str_replace(' ',',',$description);
        //display results if exists, else display form
        $photoNews = PhotoNewsAlbum::all()->count();
        $albumTitle = PhotoNewsAlbum::select('title')->where('id',$id)->first();
        if ($photoNews > 0) {
            $results = PhotoNewsAlbum::where('photo_news_albums.id', $id)->join('photo_news','photo_news_albums.id','=','photo_news.albumId')->get();
        }
        //get ad if available        
        $centreTopAds = $this->centreTopAds;
        $centreCentreAds = $this->centreCentreAds;
        $centreBottomAds = $this->centreBottomAds;
        $ads = $this->ads;
        return view('frontend.photoNewsView', compact('results', 'albums', 'title', 'description', 'keywords', 'photoNews', 'id', 'albumTitle', 'centreTopAds', 'centreCentreAds', 'centreBottomAds', 'ads'));
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
