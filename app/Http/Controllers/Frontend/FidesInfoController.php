<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Fides;
use App\FidesAttachment;
use App\Ads;
use Illuminate\Support\Facades\DB;

class FidesInfoController extends Controller
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
        $title = "Fides Information Desk";
        $news = Fides::all()->count();
        if($news > 0)
        {                                  
            //print news with attachment if it exists
            $results = Fides::orderBy('date','desc')->paginate(10);
            //$data = array();
            foreach($results as $result)
            {                
                //echo $result->id;
                $image = FidesAttachment::where('postId',$result->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                
                if(!is_null($image))
                {
                    $result->image = $image->name;
                } 
                $posts[] = $result;
            }
            //sort post archive
            $archives = Fides::select('date','title','slug','category')->orderBy('date','desc')->get();
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
        return view('frontend.fidesInfo', compact('title', 'results', 'posts', 'news', 'ads', 'data'));
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
    public function show($date, $slug)
    {
        //urldecode $slug
        $slug = urlencode($slug);
        //display results if exists, else display form
        $title = "Fides Information Desk";
        //display results if exists, else display form
        $news = Fides::all()->count();
        if ($news > 0) {
            $result = Fides::where('slug', $slug)->first();
            //get meta keyword and description
            $description = $result->title;
            $keywords = str_replace(' ',',',$result->title);
            //get top image if present
            $topImage = FidesAttachment::where('filePosition', 'top')->where('slug', $slug)->where('postId', $result->id)->count();
            if($topImage > 0)
            {
                $topImage = FidesAttachment::where('filePosition', 'top')->where('slug', $slug)->where('postId', $result->id)->get();
            }
            
            //get bottom attachments if presents
            $bottomAttachments = FidesAttachment::where('filePosition', 'bottom')->where('slug', $slug)->where('postId', $result->id)->count();
            if($bottomAttachments > 0)
            {
                $bottomAttachments = FidesAttachment::where('filePosition', 'bottom')->where('slug', $slug)->where('postId', $result->id)->get();
            }
            
            //get similar news and attachments
            //get keywords first
            if(count($result->keywords > 0)){
                $queries = array();
                $key = explode(',', $result->keywords);
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $news = DB::table('news')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($news) > 0){
                        foreach($news as $post){
                            $image = DB::table('news_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }

                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $vaticanNews = DB::table('vatican_news')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($vaticanNews) > 0){
                        foreach($vaticanNews as $post){
                            $image = DB::table('vatican_news_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $parishesNews = DB::table('parishes_news')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($parishesNews) > 0){
                        foreach($parishesNews as $post){
                            $image = DB::table('parishes_news_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $politics = DB::table('politics')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($politics) > 0){
                        foreach($politics as $post){
                            $image = DB::table('politics_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $bishopsDesk = DB::table('bishop_desks')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($bishopsDesk) > 0){
                        foreach($bishopsDesk as $post){
                            $image = DB::table('bishop_desk_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $churchDoc = DB::table('church_docs')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($churchDoc) > 0){
                        foreach($churchDoc as $post){
                            $image = DB::table('church_doc_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $inspirational = DB::table('inspirationals')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($inspirational) > 0){
                        foreach($inspirational as $post){
                            $image = DB::table('inspirational_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $wits = DB::table('wits')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($wits) > 0){
                        foreach($wits as $post){
                            $image = DB::table('wits_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $youngPeople = DB::table('young_peoples')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($youngPeople) > 0){
                        foreach($youngPeople as $post){
                            $image = DB::table('young_people_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $asISeeIt = DB::table('as_i_see_its')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($asISeeIt) > 0){
                        foreach($asISeeIt as $post){
                            $image = DB::table('as_i_see_it_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $frankTalk = DB::table('frank_talks')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($frankTalk) > 0){
                        foreach($frankTalk as $post){
                            $image = DB::table('frank_talk_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $odogwu = DB::table('odogwus')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($odogwu) > 0){
                        foreach($odogwu as $post){
                            $image = DB::table('odogwu_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $editorial = DB::table('editorials')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($editorial) > 0){
                        foreach($editorial as $post){
                            $image = DB::table('editorial_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $opinion = DB::table('opinions')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($opinion) > 0){
                        foreach($opinion as $post){
                            $image = DB::table('opinion_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $sports = DB::table('sports')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($sports) > 0){
                        foreach($sports as $post){
                            $image = DB::table('sport_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $sportsProfile = DB::table('sport_profiles')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($sportsProfile) > 0){
                        foreach($sportsProfile as $post){
                            $image = DB::table('sport_profile_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $advertorial = DB::table('advertorials')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($advertorial) > 0){
                        foreach($advertorial as $post){
                            $image = DB::table('advertorial_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $fidesInfo = DB::table('fides')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($fidesInfo) > 0){
                        foreach($fidesInfo as $post){
                            $image = DB::table('fides_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $diocesanNotifs = DB::table('diocesans')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($diocesanNotifs) > 0){
                        foreach($diocesanNotifs as $post){
                            $image = DB::table('diocesan_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $vaticanNotifs = DB::table('vaticans')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($vaticanNotifs) > 0){
                        foreach($vaticanNotifs as $post){
                            $image = DB::table('vatican_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $dosads = DB::table('dosads')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($dosads) > 0){
                        foreach($dosads as $post){
                            $image = DB::table('dosad_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }
                
                foreach($key as $keyword){
                    $keyword = trim($keyword);
                    $christendom = DB::table('christendoms')->select('id', 'date','title','slug','category')->where('slug','<>',$slug)->where('title','like',"%$keyword%")->limit(1)->get();
                    if(count($christendom) > 0){
                        foreach($christendom as $post){
                            $image = DB::table('christendom_attachments')->select('name')->where('postId',$post->id)->where('fileCategoryId',1)->where('filePosition','top')->first(); 
                            if(count($image) > 0)
                            {
                                $post->name = $image->name;
                                $queries[] = $post;
                            }
                        }
                    }
                }   

                //get 3 results from query
                $i=0;
                $similarNews = array();
                foreach($queries as $query){                    
                    $similarNews[] = $query;
                    $i++;
                                
                    if($i == 3){
                        break;
                    }
                }                
            }
        }
        //get ad if available        
        $centreTopAds = $this->centreTopAds;
        $centreCentreAds = $this->centreCentreAds;
        $centreBottomAds = $this->centreBottomAds;
        $ads = $this->ads;
        return view('frontend.fidesInfoView', compact('result', 'title', 'news', 'topImage', 'bottomAttachments', 'description', 'keywords', 'similarNews', 'centreTopAds', 'centreCentreAds', 'centreBottomAds', 'ads'));
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
