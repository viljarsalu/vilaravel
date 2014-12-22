<?php

class AddressController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Return address.
	 *
	 * @return Response
	 */
	public function getGet($addressId)
	{
		$address = Address::find($addressId);
		return $address;
	}

	public function postUpdateaddress(){
		$user = User::find(Input::get('user_id'));
		$item = Item::find(Input::get('item_id'));
		$address 					= new Address;
		$address->street_address 	= Input::get('route') . " " . Input::get('street_number') . ", " . Input::get('administrative_area_level_1') . ", " . Input::get('country');
		$address->city 				= Input::get('locality');
		$address->state 			= Input::get('administrative_area_level_1');
		$address->country 			= Input::get('country');
		$address->zip 				= Input::get('postal_code');
		$address->lat 				= Input::get('lat');
		$address->lng 				= Input::get('lng');
		$address->save();
		
		$saved = 0;
		// add new aadress
		$user->addresses()->attach($address->id);
		// update address
		if( $item->addresses()->detach() )
		{
			$item->addresses()->attach($address->id);
			$saved = 1;
		}

		return Response::json( array (
        		'street_address' 	=> $address->street_address,
        		'lat'				=> Input::get('lat'),
        		'lng'				=> Input::get('lng'),
        		'address_id'		=> $address->id
        	));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return Input::all();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		return Input::all();
		// Attach address to Item
		$plansPrices = Price::find($price_id);
		$item->prices()->attach($plansPrices->id);
		// Attach address to user
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
	public function getChange($id)
	{
		$user = User::find($id);
		$addresses = $user->addresses;
		echo 'sdfsadfas';
		return $addresses;

		$this->layout->title 			= 'Item';
	   	$this->layout->metaDescription 	= Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords 	= Lang::get('text.keywords') . ' ';
	   	$this->layout->content 			= View::make('address.show', array('addresses' => $addresses) );
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
