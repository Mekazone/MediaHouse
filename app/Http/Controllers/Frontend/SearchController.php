<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Ads;

class SearchController extends Controller
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
    public function index(Request $request)
    { 
        $term = $request->search;
        $title = "Search Results";
                
        $news = DB::table('news')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                
        $vaticanNews = DB::table('vatican_news')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");    
                    
        $parishesNews = DB::table('parishes_news')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                
        $politics = DB::table('politics')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                
        $bishopsDesk = DB::table('bishop_desks')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                
        $churchDoc = DB::table('church_docs')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                   
        $inspirational = DB::table('inspirationals')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                
        $wits = DB::table('wits')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                
        $youngPeople = DB::table('young_peoples')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                
        $asISeeIt = DB::table('as_i_see_its')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");    
                    
        $frankTalk = DB::table('frank_talks')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                
        $odogwu = DB::table('odogwus')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                
        $editorial = DB::table('editorials')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                
        $opinion = DB::table('opinions')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                   
        $sports = DB::table('sports')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                
        $sportsProfile = DB::table('sport_profiles')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                
        $advertorial = DB::table('advertorials')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");  
        
        $fidesInfo = DB::table('fides')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                   
        $diocesanNotifs = DB::table('diocesans')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");
                
        $vaticanNotifs = DB::table('vaticans')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");   
                
        $sunday = DB::table('sundays')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%"); 
                
        $christendom = DB::table('christendoms')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%");                

        $query = DB::table('dosads')->select('date','title','body','slug','category')->where('title','like',"%$term%")
                ->orWhere('body','like',"%$term%")
                ->union($news)
                ->union($vaticanNews)
                ->union($parishesNews)
                ->union($politics)
                ->union($bishopsDesk)
                ->union($churchDoc)
                ->union($inspirational)
                ->union($wits)
                ->union($youngPeople)
                ->union($asISeeIt)
                ->union($frankTalk)
                ->union($odogwu)
                ->union($editorial)
                ->union($opinion)
                ->union($sports)
                ->union($sportsProfile)
                ->union($advertorial)
                ->union($fidesInfo)
                ->union($diocesanNotifs)
                ->union($vaticanNotifs)
                ->union($sunday)
                ->union($christendom)
                ->get();
        
        //get ad if available
        $ads = $this->ads;
        return view('frontend.searchResults', compact('query','title', 'ads'));
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
