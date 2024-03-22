<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use App\Contact;
use App\ContactAttachment;

class ContactController extends Controller
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
         //validation rules
         $rules = [
            'title' => 'required',
            'body' => 'required'
         ];
         
         $topPhotos = $request->topAttachment;
        //bottom attachments
        $bottomPhotos = count($request->bottomAttachments);
        foreach (range(0, $bottomPhotos) as $bottomAttachments) {
            //$rules['bottomAttachments.' . $bottomAttachments] = 'image|mimes:jpeg,bmp,png|max:4000';
        }
         
         $overview = $this->validate(request(), $rules);

        //upload top attachment and insert into db
        if ($request->topAttachment) {
            ini_set('memory_limit', '128M');
            //fileCategoryId (1 = image, 2 = doc)
            $fileName = time() . rand(000, 999) . '.' . $request->topAttachment->getClientOriginalExtension();

            $destinationPath = public_path('contactAttachments');
            if (!file_exists($destinationPath)) {
                @mkdir($destinationPath);
            }
            //resize image if width is greater than 620 
            $img = Image::make($request->topAttachment->getRealpath());
            if ($img->width() > 620) {
                $img->resize(620, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            //save
            $store = $img->save($destinationPath . '/' . $fileName);

            $attachment = ContactAttachment::create([
                    'name' => 'contactAttachments/' . $fileName,
                    'filePosition' => 'top',
                    'fileCategoryId' => 1,
                    'caption' => $request->topCaption,
                    'slug' => $request->slug    
                ]);
        }
        
        if ($request->bottomAttachments) {
            ini_set('memory_limit', '128M');
            foreach ($request->bottomAttachments as $key => $val) {
                //fileCategoryId (1 = image, 2 = doc)
                if ($request->fileTypeBottom[$key] == '1') {
                    //resize image
                    $bottomFileName = time() . rand(000, 999) . '.' . $val->getClientOriginalExtension();

                    $destinationPath = public_path('contactAttachments');
                    if (!file_exists($destinationPath)) {
                        @mkdir($destinationPath);
                    }
                    //resize image if width is greater than 620 
                    $img = Image::make($val->getRealpath());
                    if ($img->width() > 620) {
                        $img->resize(620, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    //save
                    $store = $img->save($destinationPath . '/' . $bottomFileName);
                } elseif ($request->fileTypeBottom[$key] == '2') {
                    //upload document
                    $bottomFileName = time() . rand(000, 999) . '.' . $val->getClientOriginalExtension();

                    $destinationPath = public_path('contactAttachments');
                    if (!file_exists($destinationPath)) {
                        @mkdir($destinationPath);
                    }
                    //upload doc 
                    $store = $val->move($destinationPath, $bottomFileName);
                }

                $attachment = ContactAttachment::create([
                            'name' => 'contactAttachments/' . $bottomFileName,
                            'filePosition' => 'bottom',
                            'fileCategoryId' => $request->fileTypeBottom[$key],
                            'caption' => $request->bottomCaption[$key],
                            'slug' => $request->slug
                ]);
            }
        }

        $createOverview = Contact::create([
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $request->slug
        ]); 
        return back()->with('success', 'Overview has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        //display results if exists, else display form
        $aboutUs = Contact::where('slug', $slug)->count();
        if($aboutUs > 0)
        {
            $result = Contact::where('slug', $slug)->first();
            $topImages = ContactAttachment::where('filePosition', 'top')->where('slug', $slug)->get();
            $bottomAttachments = ContactAttachment::where('filePosition', 'bottom')->where('slug', $slug)->get();
        }
        return view('admin.'.$slug, compact('result', 'aboutUs', 'topImages', 'bottomAttachments', 'slug'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $results = Contact::where('slug', $slug)->first();
        $topImages = ContactAttachment::where('filePosition', 'top')->where('slug', $slug)->get();
        $bottomImages = ContactAttachment::where('filePosition', 'bottom')->where('slug', $slug)->get();
        return view('admin.contactEdit', compact('results', 'topImages', 'bottomImages', 'slug'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //validation rules
         $rules = [
            'title' => 'required',
            'body' => 'required'
         ];
         
         $topPhotos = $request->topAttachment;
        //bottom attachments
        $bottomPhotos = count($request->bottomAttachments);
        foreach (range(0, $bottomPhotos) as $bottomAttachments) {
            //$rules['bottomAttachments.' . $bottomAttachments] = 'image|mimes:jpeg,bmp,png|max:4000';
        }
         
         $overview = $this->validate(request(), $rules);

        //delete pevious images (db and files)
        $images = ContactAttachment::where('slug', $slug)->get();        
        foreach($images as $image)
        {
            $file = $image->name;
            unlink(public_path($file));
        }
        $images = ContactAttachment::where('slug', $slug);
        $images->delete();

        //upload top attachment and insert into db
        if ($request->topAttachment) {
            ini_set('memory_limit', '128M');
            //fileCategoryId (1 = image, 2 = doc)
            $fileName = time() . rand(000, 999) . '.' . $request->topAttachment->getClientOriginalExtension();

            $destinationPath = public_path('contactAttachments');
            if (!file_exists($destinationPath)) {
                @mkdir($destinationPath);
            }
            //resize image if width is greater than 620 
            $img = Image::make($request->topAttachment->getRealpath());
            if ($img->width() > 620) {
                $img->resize(620, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            //save
            $store = $img->save($destinationPath . '/' . $fileName);

            $attachment = ContactAttachment::create([
                    'name' => 'contactAttachments/' . $fileName,
                    'filePosition' => 'top',
                    'fileCategoryId' => 1,
                    'caption' => $request->topCaption,
                    'slug' => $request->slug    
                ]);
        }
        
        if ($request->bottomAttachments) {
            ini_set('memory_limit', '128M');
            foreach ($request->bottomAttachments as $key => $val) {
                //fileCategoryId (1 = image, 2 = doc)
                if ($request->fileTypeBottom[$key] == '1') {
                    //resize image
                    $bottomFileName = time() . rand(000, 999) . '.' . $val->getClientOriginalExtension();

                    $destinationPath = public_path('contactAttachments');
                    if (!file_exists($destinationPath)) {
                        @mkdir($destinationPath);
                    }
                    //resize image if width is greater than 620 
                    $img = Image::make($val->getRealpath());
                    if ($img->width() > 620) {
                        $img->resize(620, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    //save
                    $store = $img->save($destinationPath . '/' . $bottomFileName);
                } elseif ($request->fileTypeBottom[$key] == '2') {
                    //upload document
                    $bottomFileName = time() . rand(000, 999) . '.' . $val->getClientOriginalExtension();

                    $destinationPath = public_path('contactAttachments');
                    if (!file_exists($destinationPath)) {
                        @mkdir($destinationPath);
                    }
                    //upload doc 
                    $store = $val->move($destinationPath, $bottomFileName);
                }

                $attachment = ContactAttachment::create([
                            'name' => 'contactAttachments/' . $bottomFileName,
                            'filePosition' => 'bottom',
                            'fileCategoryId' => $request->fileTypeBottom[$key],
                            'caption' => $request->bottomCaption[$key],
                            'slug' => $request->slug
                ]);
             }  
        }
                
        //update
        $overview = Contact::where('slug', $slug)->first();
        $overview->title = $request->title;
        $overview->body = $request->body;
        $overview->slug = $request->slug;
        $overview->save();
        return redirect('/admin/contact/'.$slug)->with('success', 'Overview has been created');
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
