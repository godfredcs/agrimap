<?php

namespace App\Http\Controllers;

use Auth;
use Validator;

use App\Mail\SupportMail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * Show the form for contacting support
	 *
	 */
    public function index()
    {
    	return view('support.index' , compact('applicant'));
    }

    /**
     * Send a message to support via email
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\Response
     */
    public function sendMessage(Request $request)
    {
    	$destination = 'agrimapdev@gmail.com';

    	$validator = Validator::make($request->all(),
    		[
    		    'name'  => 'required',
    		    'email' => 'required',
    		    'telephone' => 'required',
    		    'subject'  =>'required',
    		    'body' => 'required'
    		]);

    	if($validator->fails()){
    		return redirect()->back()->withErrors($validator)->withInput();
    	}

    	$data = [
    	    'sender_name'  => $request->name,
    	    'sender_email' => $request->email,
    	    'telephone'    => $request->telephone,
    	    'subject'      => $request->subject,
    	    'body'         => $request->body
    	];

    	Mail::to($destination)->send(new SupportMail($data));

    	return redirect()->back()->with('status' , 'Your message has been sent.');
    }
}
