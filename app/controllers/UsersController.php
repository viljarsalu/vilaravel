<?php

class UsersController extends BaseController {

	protected $layout = "layouts.main";
	
	public function __construct() {
	    $this->beforeFilter('csrf', array('on'=>'post'));
	    $this->beforeFilter('auth', array('only'=>array('getList')));//getDashboard
	}
	public function getIndex() {
		return Redirect::to('/');
	}
    public function getRegister() {
	    $this->layout->title = 'tere tulemast!';
	   	$this->layout->metaDescription = Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords = Lang::get('text.keywords') . ' ';
	   	$this->layout->content = View::make('users.register');
	}

	public function postCreate() {

    	$validator = Validator::make(Input::all(), User::$rules);

 		if ($validator->passes()) {

 			$user = new User;
			$user->first_name	= Input::get('first_name');
			$user->last_name 	= Input::get('last_name');
			$user->email 		= Input::get('email');
			$user->password 	= Hash::make(Input::get('password'));
			//$user->save(); 

 			if( $user->save() ) 
 			{
 				//users additional info
			    $userinfo 				= new Userinfo;
			    $userinfo->sex 			= Input::get('sex');
			    $userinfo->birth_time 	= Input::get('birth_time');
	            $userinfo->user()->associate($user)->save();

	            // add address
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
 				$existingUser = User::find($user->id);
 				$existingUser->addresses()->attach($address->id);

 			} else {
 				return Redirect::to('users/register')->with('errormessage', 'The following errors occurred')->withErrors($validator)->withInput();
 			}

		    return Redirect::to('/')->with('message', Lang::get('text.thanks_for_registrering') );
		    
		} else {
		    return Redirect::to('users/register')->with('errormessage', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}

	public function getLogin() {
	    if ( Auth::check() )
	    {
	    	return Redirect::to('/')->with('message', 'Thanks for registering!');
	    } else {
	    	return Redirect::to('users/register')->with('errormessage', Lang::get('text.please_log_in'));
	    }
	}

	public function postSignin() {
        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
		    return Redirect::to('users/dashboard')->with('message', Lang::get('text.welcome_message_for_user'));
		} else {
		    return Redirect::to('users/login')
		        ->with('errormessage', 'Your username/password combination was incorrect')
		        ->withInput();
		}     
	}
	
	// dashboard page
	public function getDashboard() {
		if ( Auth::guest() )
		{
			return Redirect::to('/')->with('errormessage', Lang::get('text.please_log_in') );
		}

		$user_id 	= Auth::user()->id;
		$user 		= User::find($user_id);

		$items = Item::with('content')->where('user_id','=',$user_id)->get();
		//return $items;
		//return $user->items;

		$usr = $user->get();
		$this->layout->title 			= 'tere tulemast!';
	   	$this->layout->metaDescription 	= Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords 	= Lang::get('text.keywords') . ' ';
	   	$this->layout->content 			= View::make('users.dashboard', array('user'=>$usr, 'userinfo'=>$user->userinfo, 'items'=>$items));
	}

	public function getList() {
		$userid 						= Auth::user()->id;
		$username 						= Auth::user()->first_name;
    	$this->layout->title 			= '';
	   	$this->layout->metaDescription 	= Lang::get('text.meta_content');
	   	$this->layout->metaKeywords 	= Lang::get('text.keywords');
    	$this->layout->content 			= View::make('users.dashboard', array('userid'=>$userid, 'username'=>$username));
	}

	public function getLogout() {
    	Auth::logout();
    	Session::flush();
    	/*$this->layout->title = '';
	   	$this->layout->metaDescription = Lang::get('text.meta_content');
	   	$this->layout->metaKeywords = Lang::get('text.keywords');
	    $this->layout->content = View::make('users/logout');*/
    	return Redirect::to('/')->with('message', 'Your are now logged out! See you soon!');
	}

	public function getUpdate() {
		if(Auth::check()) {
			$userid 	= Auth::user()->id;
			$userdata 	= User::where('id', $userid)->get();

		    $this->layout->title 			= '';
	   		$this->layout->metaDescription 	= Lang::get('text.meta_content');
	   		$this->layout->metaKeywords 	= Lang::get('text.keywords');
		    $this->layout->content 			= View::make('users.update', array('post' => $userdata));
		} else {
			return Redirect::to('/');//->with('message', 'Please, login or sign up!');
		}
		
	}





	public function postUpdate() {
    	$update_info = array(
		    'first_name' 	=> Input::get('firstname'),
		    'last_name' 	=> Input::get('lastname'),
		    'email' 		=> Input::get('email'),
		    'birth_time' 	=> Input::get('birth_day'),
		    'sex' 			=> Input::get('sex')
		);
		$user = Auth::user();
	   	if( !empty($user) ) {
			$post = User::where( 'id', $user->id )->update( $update_info );
			return Redirect::to("users/dashboard")->with('message', Lang::get('text.change_saved') );
		} else {
			return Redirect::to("/")->with('errormessage', Lang::get('text.general_error') );
		}
	}

	/**
	 * Check is post old or not.
	 *
	 * @param  date
	 * @return Response
	 */
	public function isPostOld($bestBefore)
	{
		date_default_timezone_set('Europe/Tallinn');
		$best_before = new DateTime($bestBefore);
		$currentTime = new DateTime();
		if( $currentTime > $best_before ) {
			$postIsOld = 1;
		} else {
			$postIsOld = 0;
		}
		return $postIsOld;
	}


}
