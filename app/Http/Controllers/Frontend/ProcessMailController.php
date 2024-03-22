<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ProcessMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rules = [
            'name' => 'required',
      		'email' => 'required|email',
      		'message' => 'required'
        ];
        $overview = $this->validate(request(), $rules);
         
        $to_name = 'FIDES';
        $to_email = 'info@fidesnigeria.org';
        $subject = 'Feedback from FIDES website';
        
        $name = $request->get('name');
		$email = $request->get('email');
		$enq_message = $request->get('message');
		
		$data = array(
                'subject' => $subject,
				'name' => $name,
				'email' => $email,
				'message' => $enq_message
		);
		
		Mail::send('mailtemplate', $data, function ($message) use ($to_name, $to_email, $email, $name, $subject) {
			$message->from($email, $name);
			 
			$message->to($to_email, $to_name)->subject($subject);
		});
        echo "success";
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
