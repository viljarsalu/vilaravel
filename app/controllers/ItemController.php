<?php

class ItemController extends \BaseController {

	protected $layout = 'layouts.main';

	/**
	 * Display a listing of the resource.
	 * GET /item
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return "item index";
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /item/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		if ( Auth::guest() ) {
			return Redirect::to('/')->with('errormessage', Lang::get('text.please_log_in') );
		}

		$label 			= Label::where('public','=',true)->get();// define it into model
		$plansPrices 	= Price::where('public','=',true)->get();// define it into model
		$existing_address = User::find(Auth::user()->id);
		$existing_address = $existing_address->addresses;

		$this->layout->title 			= 'Add Item';
	   	$this->layout->metaDescription 	= Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords 	= Lang::get('text.keywords') . ' ';
	   	$this->layout->content 			= View::make('item.create', array( 'label' => $label, 'plansPrices' => $plansPrices, 'existing_address' => $existing_address ));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /item
	 *
	 * @return Response
	 */
	public function postCreate()
	{

		if ( Auth::guest() ) 
		{
			return Redirect::to('/')->with('errormessage', Lang::get('text.please_log_in') );
		}

		$user_id = Auth::user()->id;
		$user = User::find($user_id);

		$validator = Validator::make(Input::all(), Item::$rules);

 		if ($validator->passes()) 
 		{

 			$item 			= new Item;
 			$item->paid 	= false;//vaja labimotelda
 			$item->public 	= ( Input::get('public') == 'on' ? true : false );
 			$item->type 	= Input::get('type');
 			$saveItem 		= $item->user()->associate($user)->save();

 			// othe fiels
 			$title 				= Input::get('title');
 			$description 		= Input::get('description');
 			$labelInput			= Input::get('label');
 			$price_id 			= Input::get('plan_and_price');
 			$address 			= Input::get('address');

 			if( $saveItem ) 
 			{
 				// Save content;
 				$content 				= new Content;
 				$content->title 		= $title;
 				$content->description 	= $description;
 				$content->item()->associate($item)->save();

 				// Attach Label to Item
 				$label = Label::find($labelInput);
 				$item->labels()->attach($label->id);

 				// Attach Price to Item
 				$plansPrices = Price::find($price_id);
 				$item->prices()->attach($plansPrices->id);
 				// Attach Price to User
 				$user->prices()->attach($plansPrices->id);

 				// Address Block
 				$existing_address = Input::get('existing_address_id');
 				if ( $existing_address ) {
 					//return "existing_address " . Input::get('existing_address_id');
 					// Attach address to item
	 				$item->addresses()->attach(Input::get('existing_address_id'));
 				} else {
 					//return "new address";
 					// address
	 				// add new address into base
	 				$address 					= new Address;
	 				$address->street_address 	= Input::get('route') . " " . Input::get('street_number') . ", " . Input::get('administrative_area_level_1') . ", " . Input::get('country');
	 				$address->city 				= Input::get('locality');
	 				$address->state 			= Input::get('administrative_area_level_1');
	 				$address->country 			= Input::get('country');
	 				$address->zip 				= Input::get('postal_code');
	 				$address->lat 				= Input::get('lat');
	 				$address->lng 				= Input::get('lng');
	 				$address->save();
	 				
	 				$userAddress = Address::find($address->id);
	 				// Attach address to user
	 				$user->addresses()->attach($address->id);
	 				// Attach address to item
	 				$item->addresses()->attach($address->id);
 				}

				/*
				*	IMAGE
				*	save image to table and attach asset to user and item
				*/
 				$image 		= Input::file('picture');
				$filename 	= $image->getClientOriginalName();
				$userPath	= public_path() . '/uploads/' . $user->id . '_' . $user->first_name . '_' . $user->last_name . '/' . $filename;
				// set image
				$img 		= Image::make($image->getRealPath());
				// resize image
				$img->resize('100','100');
				// save image
				if( $img->save($userPath) ) {
					$asset 			= new Asset;
					$asset->type 	= 'img'; 
					$asset->source 	= $userPath;
					$asset->save();

					$userAsset = Asset::find($asset->id);
					// Attach asset to item
					$item->assets()->attach($asset->id);
					// Attach asset to user
					$user->assets()->attach($asset->id);
				} else {
					return Redirect::to('/item/create')->with('errormessage', Lang::get('text.something_went_wrong_saving_data_to_table'));
				}
 				
 				return Redirect::to('/item/create')->with('message', Lang::get('text.saved') );
 			} else {
 				return Redirect::to('/item/create')->with('errormessage', Lang::get('text.something_went_wrong_saving_data_to_table'));
 			}
 			
		    return Redirect::to('/')->with('message', Lang::get('text.saved_successfully') );
		    
		} else {
		    return Redirect::to('/item/create')->with('errormessage', Lang::get('text.the_following_errors_occurred') )->withErrors($validator)->withInput();
		}

	}

	/**
	 * Display the specified resource.
	 * GET /item/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		//return "item show" . $id;
		$items = Item::with('content','comments','votes','votedusers','addresses','prices')->where('public','=',1)->where('id','=',$id)->get();
		//return $items;

		$this->layout->title 			= 'Item';
	   	$this->layout->metaDescription 	= Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords 	= Lang::get('text.keywords') . ' ';
	   	$this->layout->content 			= View::make('item.show', array('items' => $items) );
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /item/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return "item edit" . $id;
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /item/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return "item update" . $id;
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /item/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return "item destroy" . $id;
	}

}