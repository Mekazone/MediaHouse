<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FeaturedNews;

class FeaturedNewsController extends Controller
{
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
    public function create($category, $id, $date, $title, $photo, $slug)
    {
        //if post exists, remove, else insert into featured table
        $post = FeaturedNews::where('postId',$id)->where('category',$category)->count();
        if($post > 0){
            $delete = FeaturedNews::where('postId',$id)->where('category',$category)->delete();
        }
        else{
            $link = $category.'/'.$date.'/'.$slug;
            $photo = str_replace('-','/',$photo);
            $create = FeaturedNews::create([
                'postId' => $id,
                'title' =>urlencode($title),
                'category' => $category,
                'photo' => $photo,
                'link' => $link
            ]);
        }
        
        return back()->with('success','Success');
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
