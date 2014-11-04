<?php

class SendEmail extends \BaseController {

	protected $layout = 'layouts.main';

	/**
	 * Send feedback form.
	 *
	 * @return Response
	 */
	public function getFeedback()
	{
		//return App::environment();
		$this->layout->title = 'send feedback';
	   	$this->layout->metaDescription = Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords = Lang::get('text.keywords') . ' ';
	   	$this->layout->content = View::make('emails.feedback');
	}
	/**
	 * feedback post.
	 *
	 * @return Response
	 */
	public function postFeedback()
	{
		$input = Input::all();
		$sender_name 	= Input::get('your_name');
		$sender_email 	= Input::get('your_email');
		$sender_message = Input::get('your_name');
		/*Mail::send('layouts.feedback.welcome', array('first_name'=>$sender_name), function($sender_message){
	        $sender_message->to($sender_email, $sender_name)->subject('Feedback from webpage');
	    });*/
	    Mail::send('layouts.feedback', array('input'=>$input), function($message) {
		    $message->to('viltssalts@gmail.com', 'Vilts Salts')->subject('Contact from webpage!');
		});

		return Redirect::to('/')->with('message', 'Thanks for feedback!');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
