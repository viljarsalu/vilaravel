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

		$user_id 	= Auth::user()->id;
		$user 		= User::find($user_id);

		$label 			= Label::where('public','=',true)->get();// define it into model
		$plansPrices 	= Price::where('public','=',true)->get();// define it into model
		$existing_address = User::find(Auth::user()->id);
		$address_list = $existing_address->addresses;
		$assets = $user->assets;


		$this->layout->title 			= 'Add Item';
	   	$this->layout->metaDescription 	= Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords 	= Lang::get('text.keywords') . ' ';
	   	$this->layout->content 			= View::make('item.create', array( 'label' => $label, 'plansPrices' => $plansPrices, 'address_list' => $address_list, 'assets'=>$assets ));
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

		$user_id 	= Auth::user()->id;
		$user 		= User::find($user_id);

		$validator 	= Validator::make(Input::all(), Item::$rules);

 		if ($validator->passes()) 
 		{

 			/* ITEM
			*  Save item to table
			*
				*/
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
 				/* ITEM CONTENT
				*  Save content to table and associate it with item	
				*
 				*/
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

 				/* ADDRESS
				*  Save address to table and attach asset to user and item	
				*
 				*/
 				$existing_address = Input::get('existing_address_id');
 				if ( $existing_address ) {
 					// Attach address to item
	 				$item->addresses()->attach(Input::get('existing_address_id'));
 				} else {
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
				// item from user gallery
				if( count(Input::get('item_id')) > 0 ) {
					// Attach asset to item
					$item->assets()->attach(Input::get('item_id'));
				} else {
					// new item
	 				$image 		= Input::file('picture');
					$filename 	= $image->getClientOriginalName();
					//$userPath	= public_path() . '/uploads/' . $user->id . '_' . $user->first_name . '_' . $user->last_name;
					//$newDir 	= File::makeDirectory($userPath, 0775, true);
					$savingPath	= public_path() . '/uploads/' . $user->id . '_' . $user->first_name . '_' . $user->last_name . $filename;
					$userPath	= '/uploads/' . $user->id . '_' . $user->first_name . '_' . $user->last_name . $filename;
					// set image
					$img 		= Image::make($image->getRealPath());
					// resize image
					$img->resize('100','100');
					// save image
					if( $img->save($savingPath) ) {
						$asset 			= new Asset;
						$asset->type 	= 'img'; 
						$asset->source 	= $userPath;
						$asset->save();

						//$userAsset = Asset::find($asset->id);
						// Attach asset to item
						$item->assets()->attach($asset->id);
						// Attach asset to user
						$user->assets()->attach($asset->id);
					} else {
						return Redirect::to('/item/create')->with('errormessage', Lang::get('text.something_went_wrong_saving_data_to_table'));
					}
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
		$items = Item::with('content','comments','votes','votedusers','addresses','prices','assets')->where('public','=',1)->where('id','=',$id)->get();
		$item 		= Item::find($id);
		$price 		= $item->prices;
		$address 	= $item->addresses;
		$content 	= $item->content;
		$asset 		= $item->assets;
		$vote 		= $item->votes;
		$votedUser 	= $item->votedusers;
		$comments 	= $item->comments;
		//return $address;
		$this->layout->title 			= 'Item';
	   	$this->layout->metaDescription 	= Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords 	= Lang::get('text.keywords') . ' ';
	   	$this->layout->content 			= View::make('item.show', array(
	   		'item' 		=> $item,
	   		'price' 	=> (count($price) 	  > 0 ? $price[0] 	  : false), 
	   		'content' 	=> $content, 
	   		'address' 	=> (count($address)   > 0 ? $address[0]   : false),
	   		'asset' 	=> (count($asset) 	  > 0 ? $asset[0] 	  : false),
	   		'vote' 		=> (count($vote)	  > 0 ? $vote[0] 	  : false),
	   		'voterCheck'=> (count($votedUser) > 0 ? $votedUser[0] : false),
	   		'comments' 	=> (count($comments)  > 0 ? $comments     : false)
	   	));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /item/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		
		$item 	= Item::find($id)->content;
		$votes 	= Item::find($id)->votes;
		
		// all users addresses
		$myAddresses 	= Item::find($id)->user;
		$userId 		= $myAddresses->id;
		$myAddresses 	= User::find($userId)->addresses;
		// current item address
		$itemAddress 	= Item::find($id)->addresses; 
		//return $myAddresses;
	   	
	   	// item price and plan
	   	$price 	= Item::find($id)->prices;

	   	// all prices and plans
	   	$prices = Price::all();

	   	//assets
	   	$asset 	= Item::find($id)->assets;
	   	$assets = User::find($userId)->assets;

		$this->layout->title 			= 'Item edit';
	   	$this->layout->metaDescription 	= Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords 	= Lang::get('text.keywords') . ' ';
	   	$this->layout->content 			= View::make('item.edit', array(
	   		'item' 			=> $item, 
	   		'myAddresses'	=> $myAddresses, 
	   		'itemAddress'	=> $itemAddress, 
	   		'price'			=> $price,
	   		'prices'		=> $prices,
	   		'asset'			=> $asset,
	   		'assets'		=> $assets,
	   		'usr'			=> $userId
	   		));
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