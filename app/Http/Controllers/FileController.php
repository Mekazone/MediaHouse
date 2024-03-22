<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Image;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function getResizeImage()
    {
        return view('files.resizeimage');
    }
    
    public function postResizeImage(Request $request)
    {
        //data validation
        $this->validate($request, [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        $photo = $request->photo;
        $imagename = time().'.'.$photo->getClientOriginalExtension();

        $destinationPath = public_path('thumbnail_images');
        if(!file_exists($destinationPath))
        {
            mkdir($destinationPath);
        }
        //resize image if width is greater than 620 
        $thumb_img = Image::make($photo->getRealpath());
        if($thumb_img->width() > 620)
        {
            $thumb_img->resize(620, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        }
        //save
        $thumb_img->save($destinationPath.'/'.$imagename);

        return back()
            ->with('success','Image upload successful')
            ->with('imagename',$imagename);
        
    }
    
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
