<?php

class AssetsController extends \BaseController {

	/**
	 * Return image.
	 * GET /assets
	 *
	 * @return Response
	 */
	public function getImg($assetId)
	{
		$asset = Asset::find($assetId);
		return $asset;
	}
	/**
	 * Return images.
	 * GET /assets
	 *
	 * @return Response
	 */
	public function getGallery($userId)
	{
		$user = User::find($userId);
		$assets = $user->assets;
		return $assets;
	}

	/**
	 * Display a listing of the resource.
	 * GET /assets
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /assets/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /assets
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /assets/{id}
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
	 * GET /assets/{id}/edit
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
	 * PUT /assets/{id}
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
	 * DELETE /assets/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}