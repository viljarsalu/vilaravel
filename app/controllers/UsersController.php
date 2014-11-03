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
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			//$user->save(); 

 			if( $user->save() ) 
 			{
 				//users additional info
			    $userinfo = new Userinfo;
			    $userinfo->sex = Input::get('sex');
			    $userinfo->birth_day = Input::get('birth_day');
	            $userinfo->birth_month = Input::get('birth_month');
	            $userinfo->birth_year = Input::get('birth_year');
	            $userinfo->user()->associate($user)->save();
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

		$user_id = Auth::user()->id;
		$user = User::find($user_id);
		$usr = $user->get();

		$this->layout->title = 'tere tulemast!';
	   	$this->layout->metaDescription = Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords = Lang::get('text.keywords') . ' ';
	   	$this->layout->content = View::make('users.dashboard', array('user'=>$usr,'userinfo'=>$user->userinfo));
	}

	public function getList() {
		$userid = Auth::user()->id;
		$username = Auth::user()->first_name;
    	$this->layout->title = '';
	   	$this->layout->metaDescription = Lang::get('text.meta_content');
	   	$this->layout->metaKeywords = Lang::get('text.keywords');
    	$this->layout->content = View::make('users.dashboard', array('userid'=>$userid, 'username'=>$username));
	}

	public function getLogout() {
    	Auth::logout();
    	Session::flush();
    	$this->layout->title = '';
	   	$this->layout->metaDescription = Lang::get('text.meta_content');
	   	$this->layout->metaKeywords = Lang::get('text.keywords');
	    $this->layout->content = View::make('users/logout');
    	//return Redirect::to('/')->with('message', 'Your are now logged out! See you soon!');
	}

	public function getUpdate() {
		if(Auth::check()) {
			$userid = Auth::user()->id;
			$userdata = User::where('id', $userid)->get();

		    $this->layout->title = '';
	   		$this->layout->metaDescription = Lang::get('text.meta_content');
	   		$this->layout->metaKeywords = Lang::get('text.keywords');
		    $this->layout->content = View::make('users.update', array('post' => $userdata));
		} else {
			return Redirect::to('/');//->with('message', 'Please, login or sign up!');
		}
		
	}





	public function postUpdate() {
    	$update_info = array(
		    'first_name' 	=> Input::get('firstname'),
		    'last_name' 	=> Input::get('lastname'),
		    'email' 		=> Input::get('email'),
		    'phone_number' 	=> Input::get('phone_number'),
		    'birth_day' 	=> Input::get('birth_day'),
	        'birth_month' 	=> Input::get('birth_month'),
	        'birth_year' 	=> Input::get('birth_year'),
		    'sex' 			=> Input::get('sex'),
		    'vendor' 		=> Input::get('vendor'),
		    'country' 		=> Input::get('country'),
		    'county' 		=> Input::get('county'),
		    'city' 			=> Input::get('city'),
		    'street' 		=> Input::get('street'),
		    'postindex' 	=> Input::get('postindex'),
		    //,'updated_at' => new DateTime
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
