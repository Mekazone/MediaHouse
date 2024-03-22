<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Subscribe;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //send e-mail to subscribers 
        $day = $_GET['day'];
        $month = $_GET['month'];
        $year = $_GET['year'];
        $title = $_GET['title'];
        $category = $_GET['category'];
        
        $date = mktime(date('H'),date('i'),date('s'), $month, $day, $year);
        //create slug from title
        $slug = str_replace(' ', '-', $title);
        //$slug = urlencode(strtolower(str_replace('/', '-', $slug)));
        $slug = strtolower(str_replace('/', '-', $slug));
               
        ini_set('memory_limit', '128M');
        $subscribe = Subscribe::select('email')->get();
        if(count($subscribe) > 0){
            foreach($subscribe as $email){
                $to_name = $email->email;
                $to_email = $email->email;
                
                $subject = $request->title;
                $name = 'FIDES Notifications';
        		$email = 'do-not-reply@fidesnigeria.org';
        		$post_link = $category.'/'.$date.'/'.$slug;
        		
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
