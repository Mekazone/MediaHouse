<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use App\NewsAttachment;
use App\Politics;
use App\PoliticsAttachment;
use App\Sport;
use App\SportAttachment;
use App\Opinion;
use App\OpinionAttachment;
use App\Editorial;
use App\EditorialAttachment;
use App\BishopDesk;
use App\BishopDeskAttachment;
use App\Fides;
use App\FidesAttachment;
use App\Vatican;
use App\VaticanAttachment;
use App\Diocesan;
use App\DiocesanAttachment;
use App\ParishesNews;
use App\ParishesNewsAttachment;
use App\YoungPeople;
use App\YoungPeopleAttachment;
use App\AsISeeIt;
use App\AsISeeItAttachment;
use App\FrankTalk;
use App\FrankTalkAttachment;
use App\Odogwu;
use App\OdogwuAttachment;
use App\ChurchDoc;
use App\ChurchDocAttachment;
use App\Advertorial;
use App\AdvertorialAttachment;
use App\Wits;
use App\WitsAttachment;
use App\Dosad;
use App\DosadAttachment;
use App\Sunday;
use App\SundayAttachment;
use App\Inspirational;
use App\InspirationalAttachment;
use App\VaticanNews;
use App\VaticanNewsAttachment;
use App\Ads;
use App\FeaturedNews;
use App\Video;

class IndexController extends Controller
{
    private $topAds;
    private $centreTopAds;
    private $centreBottomAds;
    private $bottomAds;
    public function __construct()
    {
        //get relevent ads
        $presentDate = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $adsCount = Ads::where('start_date','<=',$presentDate)->where('end_date','>=',$presentDate)->count();
        if($adsCount > 0)
        {
            //get top ad
            $this->topAds = Ads::where('image_dimension','LIKE','%Front%')->where('start_date','<=',$presentDate)->where('end_date','>=',$presentDate)->offset(0)->limit(2)->get();
            //get centre top ad
            $this->centreTopAds = Ads::where('image_dimension','LIKE','%Front%')->where('start_date','<=',$presentDate)->where('end_date','>=',$presentDate)->offset(2)->limit(2)->get();
            //get centre bottom ad
            $this->centreBottomAds = Ads::where('image_dimension','LIKE','%Front%')->where('start_date','<=',$presentDate)->where('end_date','>=',$presentDate)->offset(4)->limit(2)->get();
            //get bottom ad
            $this->bottomAds = Ads::where('image_dimension','LIKE','%Front%')->where('start_date','<=',$presentDate)->where('end_date','>=',$presentDate)->skip(6)->take(PHP_INT_MAX)->get();
        }           
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get featured news
        $featured = FeaturedNews::all();
        /*
        //display top left news
        $topLeft = News::all()->count();
        if($topLeft > 0)
        { 
            $topLeftResults = News::orderBy('date','desc')->offset(0)->limit(2)->get();
            foreach($topLeftResults as $result)
            {                
                $image = NewsAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $topLeftResult[] = $result;
            }  
        }
        */
        //display top right news
        $topRight = Opinion::all()->count();
        if($topRight > 0)
        { 
            $topRightResults = Opinion::orderBy('date','desc')->offset(0)->limit(1)->get();
            foreach($topRightResults as $result)
            {                
                $image = OpinionAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $topRightResult[] = $result;
            }  
        }
        
        //display results for home page       
        $news = News::all()->count();
        if($news > 0)
        {                                  
            //print news with attachment if it exists
            $results = News::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = NewsAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $newsResults[] = $result;
            }                    
        }
       
        $politics = Politics::all()->count();
        if($politics > 0)
        {                                  
            //print news with attachment if it exists
            $results = Politics::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = PoliticsAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $politicsResults[] = $result;
            }                    
        }
        
        $sports = Sport::all()->count();
        if($sports > 0)
        {                                  
            //print news with attachment if it exists
            $results = Sport::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = SportAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $sportsResults[] = $result;
            }                    
        }
        
        $opinion = Opinion::all()->count();
        if($opinion > 0)
        {                                  
            //print news with attachment if it exists
            $results = Opinion::orderBy('date','desc')->offset(1)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = OpinionAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $opinionResults[] = $result;
            }                    
        }
        
        $editorial = Editorial::all()->count();
        if($editorial > 0)
        {                                  
            //print news with attachment if it exists
            $results = Editorial::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = EditorialAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $editorialResults[] = $result;
            }                    
        }
        
        $bishopsDesk = BishopDesk::all()->count();
        if($bishopsDesk > 0)
        {                                  
            //print news with attachment if it exists
            $results = BishopDesk::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = BishopDeskAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $bishopsDeskResults[] = $result;
            }                    
        }
        
        $fides = Fides::all()->count();
        if($fides > 0)
        {                                  
            //print news with attachment if it exists
            $results = Fides::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = FidesAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $fidesResults[] = $result;
            }                    
        }
        
        $vaticanNotifs = Vatican::all()->count();
        if($vaticanNotifs > 0)
        {                                  
            //print news with attachment if it exists
            $results = Vatican::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = VaticanAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $vaticanNotifsResults[] = $result;
            }                    
        }
        
        $diocesan = Diocesan::all()->count();
        if($diocesan > 0)
        {                                  
            //print news with attachment if it exists
            $results = Diocesan::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = DiocesanAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $diocesanResults[] = $result;
            }                    
        }
        
        $parishes = ParishesNews::all()->count();
        if($parishes > 0)
        {                                  
            //print news with attachment if it exists
            $results = ParishesNews::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = ParishesNewsAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $parishesResults[] = $result;
            }                    
        }
        
        $youngPeople = YoungPeople::all()->count();
        if($youngPeople > 0)
        {                                  
            //print news with attachment if it exists
            $results = YoungPeople::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = YoungPeopleAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $youngPeopleResults[] = $result;
            }                    
        }
        
        $asISeeIt = AsISeeIt::all()->count();
        if($asISeeIt > 0)
        {                                  
            //print news with attachment if it exists
            $results = AsISeeIt::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = AsISeeItAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $asISeeItResults[] = $result;
            }                    
        }
        
        $frankTalk = FrankTalk::all()->count();
        if($frankTalk > 0)
        {                                  
            //print news with attachment if it exists
            $results = FrankTalk::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = FrankTalkAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $frankTalkResults[] = $result;
            }                    
        }
        
        $odogwu = Odogwu::all()->count();
        if($odogwu > 0)
        {                                  
            //print news with attachment if it exists
            $results = Odogwu::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = OdogwuAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $odogwuResults[] = $result;
            }                    
        }
        
        $churchDoc = ChurchDoc::all()->count();
        if($churchDoc > 0)
        {                                  
            //print news with attachment if it exists
            $results = ChurchDoc::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = ChurchDocAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $churchDocResults[] = $result;
            }                    
        }
        
        $advertorial = Advertorial::all()->count();
        if($advertorial > 0)
        {                                  
            //print news with attachment if it exists
            $results = Advertorial::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = AdvertorialAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $advertorialResults[] = $result;
            }                    
        }
        
        $wits = Wits::all()->count();
        if($wits > 0)
        {                                  
            //print news with attachment if it exists
            $results = Wits::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = WitsAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $witsResults[] = $result;
            }                    
        }
        
        $dosad = Dosad::all()->count();
        if($dosad > 0)
        {                                  
            //print news with attachment if it exists
            $results = Dosad::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = DosadAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $dosadResults[] = $result;
            }                    
        }
        
        $sunday = Sunday::all()->count();
        if($sunday > 0)
        {                                  
            //print news with attachment if it exists
            $results = Sunday::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = SundayAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $sundayResults[] = $result;
            }                    
        }
        
        $inspirational = Inspirational::all()->count();
        if($inspirational > 0)
        {                                  
            //print news with attachment if it exists
            $results = Inspirational::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = InspirationalAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $inspirationalResults[] = $result;
            }                    
        }
        
        $vaticanNews = VaticanNews::all()->count();
        if($vaticanNews > 0)
        {                                  
            //print news with attachment if it exists
            $results = VaticanNews::orderBy('date','desc')->offset(0)->limit(3)->get();
            foreach($results as $result)
            {                
                $image = VaticanNewsAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 

                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $vaticanNewsResults[] = $result;
            }                    
        }
        
        $videos = Video::all()->count();
        if($videos > 0)
        {
            $results = Video::orderBy('date','desc')->offset(0)->limit(2)->get();;
            foreach($results as $result)
            {                                
                $videosResults[] = $result;
                
            }
        }
        
        //get ad if available
        $topAds = $this->topAds;
        $centreTopAds = $this->centreTopAds;
        $centreBottomAds = $this->centreBottomAds;
        $bottomAds = $this->bottomAds;
        
        return view('frontend.index', compact('topLeft', 'topLeftResult', 'topRight', 'topRightResult', 'news', 'newsResults', 'politics', 'politicsResults', 'sports', 'sportsResults', 'opinion', 'opinionResults', 'editorial', 'editorialResults', 'bishopsDesk', 'bishopsDeskResults', 'fides', 'fidesResults', 'vaticanNotifs', 'vaticanNotifsResults', 'diocesan', 'diocesanResults', 'parishes', 'parishesResults', 'youngPeople', 'youngPeopleResults', 'asISeeIt', 'asISeeItResults', 'frankTalk', 'frankTalkResults', 'odogwu', 'odogwuResults', 'churchDoc', 'churchDocResults', 'advertorial', 'advertorialResults', 'wits', 'witsResults', 'dosad', 'dosadResults','sunday', 'sundayResults', 'inspirational', 'inspirationalResults', 'vaticanNews', 'vaticanNewsResults', 'videos', 'videosResults', 'topAds', 'centreTopAds', 'centreBottomAds', 'bottomAds', 'featured'));
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
