<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use App\Ads;

class AdsController extends Controller
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
        //output posts if exists
        $ads = Ads::all()->count();
        if ($ads > 0) {
            $results = Ads::orderBy('end_date', 'desc')->paginate(10);
        }
        //get present date for evaluating ad dates
        $presentDate = mktime(0,0,0,date('m'),date('d'),date('Y'));
        //get user logged in id. if admin, give ability to delete advert
        $admin_id = auth()->user()->id;
        return view('admin.ads', compact('results', 'ads', 'presentDate', 'admin_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adsCreate');
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
            'start_day' => 'required',
            'start_month' => 'required',
            'start_year' => 'required',
            'end_day' => 'required',
            'end_month' => 'required',
            'end_year' => 'required',
            'title' => 'required',
            'image' => 'required',
            'dimension' => 'required'
        ];
        
        $overview = $this->validate(request(), $rules);
        //create date
        $startDate = mktime(0, 0, 0, $request->start_month, $request->start_day, $request->start_year);
        $endDate = mktime(0, 0, 0, $request->end_month, $request->end_day, $request->end_year);
        
        //upload image and insert into db
        if ($request->image) {
            ini_set('memory_limit', '128M');
            $fileName = time() . rand(000, 999) . '.' . $request->image->getClientOriginalExtension();

            $destinationPath = public_path('ads');
            if (!file_exists($destinationPath)) {
                @mkdir($destinationPath);
            }
            //resize image if width is greater than 750 
            $img = Image::make($request->image->getRealpath());
            if ($img->width() > 750) {
                $img->resize(750, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            //save
            $store = $img->save($destinationPath . '/' . $fileName);

            $create = Ads::create([

                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'title' => $request->title,
                    'image_name' => 'ads/'.$fileName,
                    'image_dimension' => $request->dimension,
                    'url' => $request->url
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
        //delete photo
        $image = Ads::find($id);
        unlink(public_path($image->image_name));
        $image->delete();
        return redirect('/admin/ads')->with('success', 'Deleted');
    }
}
