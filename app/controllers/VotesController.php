<?php

class VotesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /votes
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//
	}

	/**
	 * Set vote.
	 * GET /votes/like
	 *
	 * @return Response
	 */
	public function postLike()
	{
		$item = Item::find( Input::get('item_id') );
		//return $item->votedusers;
		 
		if ( count($item->votes) > 0 )
		{
			$voteCount 	= $item->votes[0]->like;
			$voteId 	= $item->votes[0]->id;
			$vote 		= Vote::find($voteId);
			$vote->increment('like',1);
			 
			if ( $vote->save() )
			{
				$voteduser = new Voteduser;
				$voteduser->user_id = Auth::user()->id;
				$savedUser = $voteduser->item()->associate($item)->save();
				

				if( $savedUser )
				{
					return Redirect::back()->with('message', Lang::get('text.vote_saved'));
				} else {
					return Redirect::back()->with('errormessage', Lang::get('text.vote_not_saved'));
				}
				
				return Redirect::back()->with('message', Lang::get('text.vote_saved'));

			} else {
				return Redirect::back()->with('errormessage', Lang::get('text.vote_not_saved'));
			}
		} else {
			
			$vote 		= new Vote;
			$vote->like = 1;
			$saved 		= $vote->item()->associate($item)->save();

			if ( $saved )
			{
				$voteduser = new Voteduser;
				$voteduser->user_id = Auth::user()->id;
				$savedUser = $voteduser->item()->associate($item)->save();
				
				if( $savedUser )
				{
					return Redirect::back()->with('message', Lang::get('text.vote_saved'));
				} else {
					return Redirect::back()->with('errormessage', Lang::get('text.vote_not_saved'));
				}

				return Redirect::back()->with('message', Lang::get('text.vote_saved'));

			} else {
				return Redirect::back()->with('errormessage', Lang::get('text.vote_not_saved'));
			}
		}
	}

	/**
	 * Set vote.
	 * GET /votes/dislike
	 *
	 * @return Response
	 */
	public function postDislike()
	{
		$item = Item::find( Input::get('item_id') );
		//return $item->votedusers;
		 
		if ( count($item->votes) > 0 )
		{
			$voteCount 	= $item->votes[0]->dislike;
			$voteId 	= $item->votes[0]->id;
			$vote 		= Vote::find($voteId);
			$vote->increment('dislike',1);
			 
			if ( $vote->save() )
			{
				$voteduser 			= new Voteduser;
				$voteduser->user_id = Auth::user()->id;
				$savedUser 			= $voteduser->item()->associate($item)->save();
				

				if( $savedUser )
				{
					return Redirect::back()->with('message', Lang::get('text.vote_saved'));
				} else {
					return Redirect::back()->with('errormessage', Lang::get('text.vote_not_saved'));
				}
				
				return Redirect::back()->with('message', Lang::get('text.vote_saved'));

			} else {
				return Redirect::back()->with('errormessage', Lang::get('text.vote_not_saved'));
			}
		} else {
			
			$vote 			= new Vote;
			$vote->dislike 	= 1;
			$saved 			= $vote->item()->associate($item)->save();

			if ( $saved )
			{
				$voteduser 			= new Voteduser;
				$voteduser->user_id = Auth::user()->id;
				$savedUser 			= $voteduser->item()->associate($item)->save();
				
				if( $savedUser )
				{
					return Redirect::back()->with('message', Lang::get('text.vote_saved'));
				} else {
					return Redirect::back()->with('errormessage', Lang::get('text.vote_not_saved'));
				}

				return Redirect::back()->with('message', Lang::get('text.vote_saved'));

			} else {
				return Redirect::back()->with('errormessage', Lang::get('text.vote_not_saved'));
			}
		}

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /votes
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /votes/{id}
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
	 * GET /votes/{id}/edit
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
	 * PUT /votes/{id}
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
	 * DELETE /votes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}