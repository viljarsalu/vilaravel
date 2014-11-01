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
	    $this->layout->title = '';
	   	$this->layout->metaDescription = Lang::get('text.meta_content');
	   	$this->layout->metaKeywords = Lang::get('text.keywords');
	    $this->layout->content = View::make('users.register');
	}

	public function postCreate() {

    	$validator = Validator::make(Input::all(), User::$rules);

 		//return Input::all();
 		if ($validator->passes()) {
		    $user = new User;
		    $user->first_name = Input::get('first_name');
		    $user->last_name = Input::get('last_name');
		    $user->email = Input::get('email');
		    $user->password = Hash::make(Input::get('password'));

		    //users additional data
		    $user->sex = Input::get('sex');
		    $user->birth_day = Input::get('birth_day');
            $user->birth_month = Input::get('birth_month');
            $user->birth_year = Input::get('birth_year');

            // address
		    $user->country = ( Input::get('country') ? Input::get('country') : 'Eesti');
		    $user->county = Input::get('county');
		    $user->city = Input::get('city');
		    $user->street = Input::get('street');
		    $user->postindex = Input::get('postindex');
			$user->created_at = new DateTime;
		    $user->updated_at = new DateTime;
		    $user->save();
		    return Redirect::to('/')->with('message', Lang::get('text.thanks_for_registrering') );

		} else {
		    return Redirect::to('users/register')->with('errormessage', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}

	public function getLogin() {
		/*$this->layout->title = 'login title';
		$this->layout->desc = "";
		$this->layout->contextMenu = '';
	    $this->layout->content = View::make('/');*/
	    if ( Auth::check() )
	    {
	    	return Redirect::to('/')->with('message', 'Thanks for registering!');
	    } else {
	    	return Redirect::to('users/register')->with('errormessage', Lang::get('text.please_log_in'));
	    }
	}

	public function postSignin() {
        //return 'sing:' . Input::all();
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

		$user = Auth::user();
		$user = User::find($user->id);

		$posts = $user->posts;
		$bookmarks = $user->bookmarks;
		//echo $posts;
		
		$pageData = [];

		foreach ($posts as $key => $value) {
			/*echo $value->tags;
			echo $key;*/
			$oldPost = $this->isPostOld($value->payments[0]->best_before);
			//echo $value->payments[0]->best_before;
			$test = $value->tags;
			if( count($test) > 0 ){
				$k = $value->tags[0]->title;
				$data = [];
				array_push($data, [
					'category' 		=> $value->category,
					'product_tag' 	=> $value->tags[0]->title,
					'post_id' 		=> $value->id,
					'title' 		=> $value->title,
					'content' 		=> $value->content,
					'price' 		=> $value->price,
					'unit' 			=> $value->unit,
					'public' 		=> $value->public,
					'created_at' 	=> $value->created_at,
					'post_user' 	=> User::find($value->user_id),
					'old_post'		=> $oldPost,
					'best_before'	=> $value->payments[0]->best_before
				]);

				$pageData[$k][] = $data;
			}
			
		}
		//print_r($pageData);
		/*echo "<hr/>";
		return "test";*/

		$bookmakrslist = [];
		foreach ($bookmarks as $key => $value) {
			$postid = $value->post_id;
			$postData = Post::find($postid);

			array_push($bookmakrslist, [
				'post_id' 	=> $postData->id,
				'category' 	=> $postData->category,
				'title' 	=> $postData->title,
				'content' 	=> $postData->content,
				'price' 	=> $postData->price,
				'unit' 		=> $postData->unit,
				'product_tag' 	=> $postData->tags[0]->title,
				'highlight' 	=> $postData->id,
				'public' 		=> $postData->public,
				'created_at' 	=> $postData->created_at,
				'post_user' => User::find($postData->user_id)
			]);
		}
		// siia koik kasutaja postid, lemmikud
		$rawData = [];
		array_push($rawData, [
			'posts' => ( count($pageData) > 0 ? $pageData : 'empty'),
			'bookmarks' => ( count($bookmakrslist) > 0 ? $bookmakrslist : 'empty'),
		]);

		/*print_r($rawData);
		return "end";*/
    	$this->layout->title = '';
	   	$this->layout->metaDescription = Lang::get('text.meta_content');
	   	$this->layout->metaKeywords = Lang::get('text.keywords');
    	$this->layout->content = View::make('users.dashboard', array('rawData' => $rawData) );
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
