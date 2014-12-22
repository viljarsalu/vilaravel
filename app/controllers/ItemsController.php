<?php

class ItemsController extends \BaseController {

	protected $layout = 'layouts.main';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//$items = Item::with('content','labels')->get();
		//$items = Item::with('content','labels')->where('public','=',1)->get();
		/*$type = 'type';
		$items = Item::with('content','labels')->where('type','LIKE','%'.$type.'%')->get();
		return $items;*/

		/*$labels = Label::with('items')->where('public','=',1)->get();
		return $labels;*/
		//return 'end';
		$t 	= Helper::helloWorld();
		$d 	= Helper::get_time_ago(strtotime('now'));
		//return "test". $d;

		$items = Item::with('content','comments','votes','votedusers','labels','assets')->where('public','=',1)->orderBy('created_at','DESC')->get();
		//return $items;

		$this->layout->title 			= 'Items';
	   	$this->layout->metaDescription 	= Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords 	= Lang::get('text.keywords') . ' ';
	   	$this->layout->content 			= View::make('items.show', array('items' => $items) );
	}

	/**
	 * Display a listing of the resource order by nearest point.
	 *
	 * @return Response
	 */
	public function getNearest()
	{
		//$items = Item::with('content','labels')->get();
		//$items = Item::with('content','labels')->where('public','=',1)->get();
		/*$type = 'type';
		$items = Item::with('content','labels')->where('type','LIKE','%'.$type.'%')->get();
		return $items;*/

		/*$labels = Label::with('items')->where('public','=',1)->get();
		return $labels;*/
		//return 'end';
		$t 	= Helper::helloWorld();
		$d 	= Helper::get_time_ago(strtotime('now'));
		//return "test". $d;
/* test */
		/*$test = DB::select('SELECT *, ((ACOS(SIN(59.436961 * PI() / 180) * SIN(lat * PI() / 180) + COS(59.436961 * PI() / 180) * COS(lat * PI() / 180) * COS((24.753575 - lng) * PI() / 180)) * 180 / PI()) * 60 * 1.1515 * 1.609344) as distance 
		HAVING distance <= 100 
		ORDER BY distance ASC');*/
		
		/*$dist 	= 10;
		$mylat 	= 59.436961;
		$mylng 	= 24.753575;
		$lon1 	= $mylng-$dist/abs(cos(radians($mylat))*69);
		$lon2 	= $mylng+$dist/abs(cos(radians($mylat))*69);
		$lat1 	= $mylat-($dist/69);
		$lat2 	= $mylat+($dist/69);

		$res = DB::select('SELECT *, 3956 * 2 * ASIN(SQRT( POWER(SIN(($mylat - `lat`) * pi()/180 / 2), 2) +COS($mylat * pi()/180) * COS(`lat` * pi()/180) *POWER(SIN(($mylng - `lng`) * pi()/180 / 2), 2) )) as distance 
		FROM `vl_addresses`, WHERE `lng` between $lon1 and $lon2 and `lat` between $lat1 and $lat2 
		having distance < $dist ORDER BY Distance limit 10');*/

		$res = DB::select('SELECT *, 3956 * 2 * ASIN(SQRT( POWER(SIN((59.436961 - `lat`)*pi()/180 / 2), 2) +COS(59.436961*pi()/180)*COS(`lat`*pi()/180)*POWER(SIN((24.753575 - `lng`)*pi()/180 / 2), 2) )) as distance 
		FROM `vl_addresses` WHERE `lng` between (24.753575-10/abs(cos(radians(59.436961))*69)) and ((24.753575+10/abs(cos(radians(59.436961))*69))) and `lat` between (59.436961-(10/69)) and (59.436961+(10/69)) 
		having distance < 1000 Order By Distance Limit 10');

		var_dump($res);
		/*foreach($res as $k=>$val) {
			echo $k . ') ' . $val->distance . '<br />';
			echo 'miles:' . ($res[0]->distance * 60 * 1.1515) . ' <br />';
			echo 'km:' . ($res[0]->distance * 60 * 1.1515) * 1.609344 . '<hr />';
		}*/
		//return ($res[0]->distance * 60 * 1.1515) * 1.609344;

		/*return Item::with('addresses')->where('public','=',1)->get();*/
		return "-----";

		/* optimeeritud toimiv query */
		/*SELECT *, 3956 * 2 * ASIN(SQRT( POWER(SIN((59.436961 - `lat`) * pi()/180 / 2), 2) +COS(59.436961 * pi()/180) * COS(`lat` * pi()/180) *POWER(SIN((24.753575 - `lng`) * pi()/180 / 2), 2) )) as distance 
		FROM `vl_addresses` WHERE `lng` between (24.753575-10/abs(cos(radians(59.436961))*69)) and ((24.753575+10/abs(cos(radians(59.436961))*69))) and `lat` between (59.436961-(10/69)) and (59.436961+(10/69)) 
		having distance < 300 Order By Distance Limit 2*/
		/* end / optimeeritud toimiv query */

		/* toimiv query */
		/*SELECT *, 3956 * 2 * ASIN(SQRT( POWER(SIN((59.436961 - abs(`lat`)) * pi()/180 / 2),2) + COS(59.436961 * pi()/180 ) * COS(abs(`lat`) *  pi()/180) * POWER(SIN((24.753575 - `lng`) *  pi()/180 / 2), 2) )) 
		as distance 
		FROM `vl_addresses`
		having distance < 100 
		ORDER BY distance limit 10;*/
		/* / toimiv query */








		/* end / test */
		$items = Item::with('content','comments','votes','votedusers','labels','assets')->where('public','=',1)->orderBy('created_at','DESC')->get();
		//return $items;

		$this->layout->title 			= 'Items';
	   	$this->layout->metaDescription 	= Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords 	= Lang::get('text.keywords') . ' ';
	   	$this->layout->content 			= View::make('items.show', array('items' => $items) );
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
