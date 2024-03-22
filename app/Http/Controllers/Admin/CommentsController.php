<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\UrlGenerator;

class CommentsController extends Controller
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
        $vaticanNews = DB::table('vatican_news_comments')->join('vatican_news','vatican_news_comments.postId','=','vatican_news.id')->select('vatican_news_comments.id','vatican_news_comments.name','vatican_news_comments.date','vatican_news_comments.comment','vatican_news.category','vatican_news.date','vatican_news.slug','vatican_news.title')->where('status','pending');
        
        $parishesNews = DB::table('parishes_news_comments')->join('parishes_news','parishes_news_comments.postId','=','parishes_news.id')->select('parishes_news_comments.id','parishes_news_comments.name','parishes_news_comments.date','parishes_news_comments.comment','parishes_news.category','parishes_news.date','parishes_news.slug','parishes_news.title')->where('status','pending');
        
        $politics = DB::table('politics_comments')->join('politics','politics_comments.postId','=','politics.id')->select('politics_comments.id','politics_comments.name','politics_comments.date','politics_comments.comment','politics.category','politics.date','politics.slug','politics.title')->where('status','pending');
        
        $churchDocs = DB::table('church_docs_comments')->join('church_docs','church_docs_comments.postId','=','church_docs.id')->select('church_docs_comments.id','church_docs_comments.name','church_docs_comments.date','church_docs_comments.comment','church_docs.category','church_docs.date','church_docs.slug','church_docs.title')->where('status','pending');
        
        $inspiration = DB::table('inspirational_comments')->join('inspirationals','inspirational_comments.postId','=','inspirationals.id')->select('inspirational_comments.id','inspirational_comments.name','inspirational_comments.date','inspirational_comments.comment','inspirationals.category','inspirationals.date','inspirationals.slug','inspirationals.title')->where('status','pending');
        
        $sundayTonic = DB::table('sunday_tonic_comments')->join('sundays','sunday_tonic_comments.postId','=','sundays.id')->select('sunday_tonic_comments.id','sunday_tonic_comments.name','sunday_tonic_comments.date','sunday_tonic_comments.comment','sundays.category','sundays.date','sundays.slug','sundays.title')->where('status','pending');
        
        $wits = DB::table('wits_comments')->join('wits','wits_comments.postId','=','wits.id')->select('wits_comments.id','wits_comments.name','wits_comments.date','wits_comments.comment','wits.category','wits.date','wits.slug','wits.title')->where('status','pending');
        
        $youngPeople = DB::table('young_people_comments')->join('young_peoples','young_people_comments.postId','=','young_peoples.id')->select('young_people_comments.id','young_people_comments.name','young_people_comments.date','young_people_comments.comment','young_peoples.category','young_peoples.date','young_peoples.slug','young_peoples.title')->where('status','pending');
        
        $asISeeIt = DB::table('as_i_see_it_comments')->join('as_i_see_its','as_i_see_it_comments.postId','=','as_i_see_its.id')->select('as_i_see_it_comments.id','as_i_see_it_comments.name','as_i_see_it_comments.date','as_i_see_it_comments.comment','as_i_see_its.category','as_i_see_its.date','as_i_see_its.slug','as_i_see_its.title')->where('status','pending');
        
        $frankTalk = DB::table('frank_talk_comments')->join('frank_talks','frank_talk_comments.postId','=','frank_talks.id')->select('frank_talk_comments.id','frank_talk_comments.name','frank_talk_comments.date','frank_talk_comments.comment','frank_talks.category','frank_talks.date','frank_talks.slug','frank_talks.title')->where('status','pending');
        
        $odogwu = DB::table('odogwu_comments')->join('odogwus','odogwu_comments.postId','=','odogwus.id')->select('odogwu_comments.id','odogwu_comments.name','odogwu_comments.date','odogwu_comments.comment','odogwus.category','odogwus.date','odogwus.slug','odogwus.title')->where('status','pending');
        
        $editorial = DB::table('editorial_comments')->join('editorials','editorial_comments.postId','=','editorials.id')->select('editorial_comments.id','editorial_comments.name','editorial_comments.date','editorial_comments.comment','editorials.category','editorials.date','editorials.slug','editorials.title')->where('status','pending');
        
        $sports = DB::table('sports_comments')->join('sports','sports_comments.postId','=','sports.id')->select('sports_comments.id','sports_comments.name','sports_comments.date','sports_comments.comment','sports.category','sports.date','sports.slug','sports.title')->where('status','pending');
        
        $sportsProfile = DB::table('sports_profile_comments')->join('sport_profiles','sports_profile_comments.postId','=','sport_profiles.id')->select('sports_profile_comments.id','sports_profile_comments.name','sports_profile_comments.date','sports_profile_comments.comment','sport_profiles.category','sport_profiles.date','sport_profiles.slug','sport_profiles.title')->where('status','pending');
        
        $dosadInfo = DB::table('dosad_info_comments')->join('dosads','dosad_info_comments.postId','=','dosads.id')->select('dosad_info_comments.id','dosad_info_comments.name','dosad_info_comments.date','dosad_info_comments.comment','dosads.category','dosads.date','dosads.slug','dosads.title')->where('status','pending');
        
        $advertorial = DB::table('advertorial_comments')->join('advertorials','advertorial_comments.postId','=','advertorials.id')->select('advertorial_comments.id','advertorial_comments.name','advertorial_comments.date','advertorial_comments.comment','advertorials.category','advertorials.date','advertorials.slug','advertorials.title')->where('status','pending');
        
        $query = DB::table('news_comments')->join('news','news_comments.postId','=','news.id')->select('news_comments.id','news_comments.name','news_comments.date','news_comments.comment','news.category','news.date','news.slug','news.title')->where('status','pending')
            ->union($vaticanNews)
            ->union($parishesNews)
            ->union($politics)
            ->union($churchDocs)
            ->union($inspiration)
            ->union($sundayTonic)
            ->union($wits)
            ->union($youngPeople)
            ->union($asISeeIt)
            ->union($frankTalk)
            ->union($odogwu)
            ->union($editorial)
            ->union($sports)
            ->union($sportsProfile)
            ->union($dosadInfo)
            ->union($advertorial)
            ->get();
        return view('admin.comments', compact('query'));
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
    public function edit(Request $request, $id) {
        //get db table from category
        switch($request->query('category')){
            case "news":
                $table = 'news_comments';
                break;
            case "vaticannews":
                $table = 'vatican_news_comments';
                break;
            case "parishesnews":
                $table = 'parishes_news_comments';
                break;
            case "politics":
                $table = 'politics_comments';
                break;
            case "churchdocs":
                $table = 'church_docs_comments';
                break;
            case "inspirational":
                $table = 'inspirational_comments';
                break;
            case "sundaytonic":
                $table = 'sunday_tonic_comments';
                break;
            case "wits":
                $table = 'wits_comments';
                break;
            case "youngpeople":
                $table = 'young_people_comments';
                break;
            case "asiseeit":
                $table = 'as_i_see_it_comments';
                break;
            case "franktalk":
                $table = 'frank_talk_comments';
                break;
            case "odogwu":
                $table = 'odogwu_comments';
                break;
            case "editorial":
                $table = 'editorial_comments';
                break;
            case "opinion":
                $table = 'opinion_comments';
                break;
            case "sports":
                $table = 'sports_comments';
                break;
            case "sportsprofile":
                $table = 'sports_profile_comments';
                break;
            case "dosadinfo":
                $table = 'dosad_info_comments';
                break;
            case "advertorial":
                $table = 'advertorial_comments';
                break;
        }
        
        if($request->query('action') == 'approve'){
            //approve comment
            $action = DB::table($table)->where('id', $id)->update(array('status'=>'approved'));
            return redirect('/admin/comments')->with('success', 'Comment approved.');
        }
        else{
            //approve comment
            $action = DB::table($table)->where('id', $id)->update(array('status'=>'deny'));
            return redirect('/admin/comments')->with('success', 'Comment deleted.');
        }
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
    public function destroy($id) {
        //delete photo
        $images = PhotoNews::find($id);
        unlink(public_path($images->name));
        $images->delete();
        return redirect('/admin/photonews')->with('success', 'Deleted');
    }
}
