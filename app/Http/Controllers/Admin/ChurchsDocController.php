<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Image;
use App\ChurchDoc;
use App\ChurchDocAttachment;
use App\FeaturedNews;
use App\Subscribe;

class ChurchsDocController extends Controller
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
        $news = ChurchDoc::all()->count();
        if ($news > 0) {
            $results = ChurchDoc::orderBy('date', 'desc')->paginate(10);
        }
        return view('admin.churchDocs', compact('results', 'news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.churchDocsCreate');
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
            'title' => 'required',
            'body' => 'required',
            'keywords' => 'required'
        ];
        //top image
        $topPhotos = $request->topAttachments;
        //bottom attachments
        $bottomPhotos = count($request->bottomAttachments);
        foreach (range(0, $bottomPhotos) as $bottomAttachments) {
            //$rules['bottomAttachments.' . $bottomAttachments] = 'image|mimes:jpeg,bmp,png|max:4000';
        }

        $overview = $this->validate(request(), $rules);
        //create date
        $date = mktime(date('H'),date('i'),date('s'), $request->month, $request->day, $request->year);
        //create slug from title
        $slug = str_replace(' ', '-', $request->title);
        $slug = urlencode(strtolower(str_replace('/', '-', $slug)));
        //db insert
        $create = ChurchDoc::create([

                    'date' => $date,
                    'title' => $request->title,
                    'body' => $request->body,
                    'category' => 'churchdocs',
                    'slug' => $slug,
                    'keywords' => $request->keywords
        ]);

        //upload top attachment and insert into db
        if ($request->topAttachment) {
            ini_set('memory_limit', '128M');
            //fileCategoryId (1 = image, 2 = doc)
            $fileName = time() . rand(000, 999) . '.' . $request->topAttachment->getClientOriginalExtension();

            $destinationPath = public_path('churchDocsAttachments');
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

            $attachment = ChurchDocAttachment::create([
                        'name' => 'churchDocsAttachments/' . $fileName,
                        'filePosition' => 'top',
                        'fileCategoryId' => 1,
                        'caption' => $request->topCaption,
                        'slug' => $slug,
                        'postId' => $create->id
            ]);
        }

        if ($request->bottomAttachments) {
            ini_set('memory_limit', '128M');
            foreach ($request->bottomAttachments as $key => $val) {
                //fileCategoryId (1 = image, 2 = doc)
                if ($request->fileTypeBottom[$key] == '1') {
                    //resize image
                    $bottomFileName = time() . rand(000, 999) . '.' . $val->getClientOriginalExtension();

                    $destinationPath = public_path('churchDocsAttachments');
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

                    $destinationPath = public_path('churchDocsAttachments');
                    if (!file_exists($destinationPath)) {
                        @mkdir($destinationPath);
                    }
                    //upload doc 
                    $store = $val->move($destinationPath, $bottomFileName);
                }

                $attachment = ChurchDocAttachment::create([
                            'name' => 'churchDocsAttachments/' . $bottomFileName,
                            'filePosition' => 'bottom',
                            'fileCategoryId' => $request->fileTypeBottom[$key],
                            'caption' => $request->bottomCaption[$key],
                            'slug' => $slug,
                            'postId' => $create->id
                ]);
            }
        }
        /*
        ini_set('memory_limit', '128M');
        $subscribe = Subscribe::select('email')->get();
        if(count($subscribe) > 0){
            foreach($subscribe as $email){
                $to_name = $email->email;
                $to_email = $email->email;
                
                $subject = $request->title;
                $name = 'FIDES Notifications';
        		$email = 'do-not-reply@fidesnigeria.org';
        		$post_link = 'churchdocs'.'/'.$date.'/'.$slug;
        		
        		$data = array(
                        'subject' => $subject,
        				'name' => $name,
        				'email' => $email,
        				'post_link' => $post_link
        		);
        		
        		Mail::send('notificationtemplate', $data, function ($message) use ($to_name, $to_email, $email, $name, $subject) {
        			$message->from($email, $name);
        			 
        			$message->to($to_email, $to_name)->subject($subject);
        		});
            }
        }
        */
        return back()->with('success', 'Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date, $slug) {
        //urldecode $slug
        $slug = urlencode($slug);
        //display results if exists, else display form
        $news = ChurchDoc::all()->count();
        if ($news > 0) {
            $result = ChurchDoc::where('slug', $slug)->first();
            //get top image if present
            $topImage = ChurchDocAttachment::where('filePosition', 'top')->where('slug', $slug)->where('postId', $result->id)->count();
            if($topImage > 0)
            {
                $topImage = ChurchDocAttachment::where('filePosition', 'top')->where('slug', $slug)->where('postId', $result->id)->first();
            }
            
            //get bottom attachments if presents
            $bottomAttachments = ChurchDocAttachment::where('filePosition', 'bottom')->where('slug', $slug)->where('postId', $result->id)->count();
            if($bottomAttachments > 0)
            {
                $bottomAttachments = ChurchDocAttachment::where('filePosition', 'bottom')->where('slug', $slug)->where('postId', $result->id)->get();
            }
            //check if post is in featured news
            $featureCount = FeaturedNews::where('postId',$result->id)->where('category',$result->category)->count();
            if($featureCount > 0){
                $featured = 'yes';
            }
        }
        return view('admin.churchDocsView', compact('result', 'news', 'topImage', 'bottomAttachments', 'featureCount', 'featured'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $results = ChurchDoc::where('id', $id)->first();
        $day = date('d', $results->date);
        $month = date('m', $results->date);
        $year = date('Y', $results->date);
        $attachments = ChurchDocAttachment::where('postId', $id)->get();
        return view('admin.churchDocsEdit', compact('results', 'attachments', 'id', 'day', 'month', 'year'));
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
            'title' => 'required',
            'body' => 'required',
            'keywords' => 'required'
        ];
        //top image
        $topPhotos = $request->topAttachments;
        //bottom attachments
        $bottomPhotos = count($request->bottomAttachments);
        foreach (range(0, $bottomPhotos) as $bottomAttachments) {
            //$rules['bottomAttachments.' . $bottomAttachments] = 'image|mimes:jpeg,bmp,png|max:4000';
        }

        $overview = $this->validate(request(), $rules);

        $date = mktime(date('H'),date('i'),date('s'), $request->month, $request->day, $request->year);
        //create slug from title
        $slug = str_replace(' ', '-', $request->title);
        $slug = urlencode(strtolower(str_replace('/', '-', $slug)));
        //delete pevious images, directory (db and files)
        $images = ChurchDocAttachment::where('postId', $id)->get();
        foreach ($images as $image) {
            $file = $image->name;
            unlink(public_path($file));
        }

        $images = ChurchDocAttachment::where('postId', $id);
        $images->delete();

        //upload top attachment and insert into db
        if($request->topAttachment)
        {
            ini_set('memory_limit','128M');
            //fileCategoryId (1 = image, 2 = doc)
            $fileName = time().rand(000,999).'.'.$request->topAttachment->getClientOriginalExtension();

            $destinationPath = public_path('churchDocsAttachments');
            if(!file_exists($destinationPath))
            {
                @mkdir($destinationPath);
            }
            //resize image if width is greater than 620 
            $img = Image::make($request->topAttachment->getRealpath());
            if($img->width() > 620)
            {
                $img->resize(620, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            //save
            $store = $img->save($destinationPath.'/'.$fileName);
                
            $attachment = ChurchDocAttachment::create([
                'name' => 'churchDocsAttachments/'.$fileName,
                'filePosition' => 'top',
                'fileCategoryId' => 1,
                'caption' => $request->topCaption,
                'slug' => $slug,
                'postId' => $id
            ]);             
        }

        if($request->bottomAttachments)
        {
            ini_set('memory_limit','128M');
            foreach($request->bottomAttachments as $key => $val)
            {
                //fileCategoryId (1 = image, 2 = doc)
                if($request->fileTypeBottom[$key] == '1')
                {
                    //resize image
                    $bottomFileName = time().rand(000,999).'.'.$val->getClientOriginalExtension();

                    $destinationPath = public_path('churchDocsAttachments');
                    if(!file_exists($destinationPath))
                    {
                        @mkdir($destinationPath);
                    }
                    //resize image if width is greater than 620 
                    $img = Image::make($val->getRealpath());
                    if($img->width() > 620)
                    {
                        $img->resize(620, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    //save
                    $store = $img->save($destinationPath.'/'.$bottomFileName);
                    
                }
                elseif($request->fileTypeBottom[$key] == '2')
                {
                    //upload document
                    $bottomFileName = time().rand(000,999).'.'.$val->getClientOriginalExtension();

                    $destinationPath = public_path('churchDocsAttachments');
                    if(!file_exists($destinationPath))
                    {
                        @mkdir($destinationPath);
                    }
                    //upload doc 
                    $store = $val->move($destinationPath, $bottomFileName);
                }
                
                $attachment = ChurchDocAttachment::create([
                    'name' => 'churchDocsAttachments/'.$bottomFileName,
                    'filePosition' => 'bottom',
                    'fileCategoryId' => $request->fileTypeBottom[$key],
                    'caption' => $request->bottomCaption[$key],
                    'slug' => $slug,
                    'postId' => $id
                ]);
            }
        }

        //update db
        $update = ChurchDoc::where('id', $id)->first();
        $update->date = $date;
        $update->title = $request->title;
        $update->body = $request->body;
        $update->slug = $slug;
        $update->keywords = $request->keywords;
        $update->save();

        return redirect('/admin/churchdocs')->with('success', 'Edit successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete news and attachments
        $images = ChurchDocAttachment::where('postId', $id)->get();
        foreach ($images as $image) {
            $file = $image->name;
            unlink(public_path($file));
        }
        
        $news = ChurchDoc::find($id);
        $news->delete();
        return redirect('/admin/churchdocs')->with('success', 'Deleted');
    }
}
