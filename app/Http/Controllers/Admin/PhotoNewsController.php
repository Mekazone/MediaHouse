<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use App\PhotoNews;
use App\PhotoNewsAlbum;

class PhotoNewsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //output albums if exists
        $photoNews = PhotoNewsAlbum::all()->count();
        if ($photoNews > 0) {
            $results = PhotoNewsAlbum::orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.photoNews', compact('results', 'photoNews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {
        return view('admin.photoNewsCreate',compact('id'));
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
            'photo' => 'required',
            'caption' => 'required'
        ];
        //photo
        $photo = $request->photo;
        $overview = $this->validate(request(), $rules);
        //create date
        $date = mktime(date('H'),date('i'),date('s'), $request->month, $request->day, $request->year);

        //upload top attachment and insert into db
        if ($request->photo) {
            ini_set('memory_limit', '128M');
            //fileCategoryId (1 = image, 2 = doc)
            $fileName = time() . rand(000, 999) . '.' . $request->photo->getClientOriginalExtension();

            $destinationPath = public_path('photoNewsAttachments');
            if (!file_exists($destinationPath)) {
                @mkdir($destinationPath);
            }
            //resize image if width is greater than 700 
            $img = Image::make($request->photo->getRealpath());
            if ($img->width() > 700) {
                $img->resize(700, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            //save
            $store = $img->save($destinationPath . '/' . $fileName);
            //db insert
            $create = PhotoNews::create([
                        'date' => $date,
                        'name' => 'photoNewsAttachments/' . $fileName,                    
                        'caption' => $request->caption,
                        'albumId' => $request->albumId
            ]);
        }
        return back()->with('success', 'Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //display results if exists, else display form
        $photoNews = PhotoNewsAlbum::all()->count();
        $albumTitle = PhotoNewsAlbum::select('title')->where('id',$id)->first();
        if ($photoNews > 0) {
            $results = PhotoNewsAlbum::where('photo_news_albums.id', $id)->join('photo_news','photo_news_albums.id','=','photo_news.albumId')->get();
        }
        return view('admin.photoNewsView', compact('results', 'photoNews', 'id', 'albumTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $results = PhotoNews::where('id', $id)->first();
        $day = date('d', $results->date);
        $month = date('m', $results->date);
        $year = date('Y', $results->date);
        return view('admin.photoNewsEdit', compact('results', 'id', 'day', 'month', 'year'));
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
            'photo' => 'required',
            'caption' => 'required'
        ];
        //top image
        $photo = $request->photo;
        $overview = $this->validate(request(), $rules);

        $date = mktime(date('H'),date('i'),date('s'), $request->month, $request->day, $request->year);
        //delete file
        $image = PhotoNews::where('id', $id)->first();
        $file = $image->name;
        unlink(public_path($file));

        //upload top attachment and insert into db
        if($photo)
        {
            ini_set('memory_limit','128M');
            //fileCategoryId (1 = image, 2 = doc)
            $fileName = time().rand(000,999).'.'.$request->photo->getClientOriginalExtension();

            $destinationPath = public_path('photoNewsAttachments');
            if(!file_exists($destinationPath))
            {
                @mkdir($destinationPath);
            }
            //resize image if width is greater than 700 
            $img = Image::make($request->photo->getRealpath());
            if($img->width() > 700)
            {
                $img->resize(700, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            //save
            $store = $img->save($destinationPath.'/'.$fileName);            
        }

        //update db
        $update = PhotoNews::where('id', $id)->first();
        $update->date = $date;
        $update->name = 'photoNewsAttachments/' . $fileName;
        $update->caption = $request->caption;
        $update->save();

        return redirect('/admin/photonews')->with('success', 'Edit successful');
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
        return redirect('/admin/photonews/'.$images->albumId)->with('success', 'Deleted');
    }
}