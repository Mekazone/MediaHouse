<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.testmail');
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
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ];
        $overview = $this->validate(request(), $rules);
        
        $to_name = 'FIDES';
        $to_email = 'info@fidesnigeria.org';
        $subject = 'Feedback from FIDES website';
        
        $name = $request->get('firstName');
		$email = $request->get('email');
		$enq_message = $request->get('message');
        
        Mail::send('mailtemplate',
        [
            'name' => $request->get('firstName'),
            'email' => $request->get('email'),
            'enq_message' => $request->get('message'),
            'subject' => $subject,
        ], function($message) use ($to_name, $to_email)
        {
            $message->from($email, $name);
            $message->to($to_email, $to_name)->subject($subject);
        });
        $response = [
            'status' => 'success',
            'msg' => 'Mail sent successfully',
        ];
        return response()->json([$response], 200);
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
