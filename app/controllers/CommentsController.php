<?php

class CommentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return 'comments index';
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		print_r(Auth::user());
		return 'comments create';
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postAdd()
	{
		print_r(Input::all());
		print_r(Auth::user());
		/*
		$user_id = Auth::user()->id;
		$user = User::find($user_id);

		$usr = $user->get();
		
		if ( Auth::user()->id ) {
			$author = User::find(Auth::user()->id)->get();
		} else {
			$author = "Visitor";
		}*/
		return ' comments post values stored ';
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		return 'comments show ' . $id;
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
