<?php

class Userinfo extends Eloquent {

	/*public static $rules = array(
		'email' 		=> 'required|email|unique:users',
		'password' 		=> 'required|alpha_num|between:6,12',
		'first_name' 	=> 'required|alpha|min:2',
		'last_name' 	=> 'required|alpha|min:2',
		'sex' 			=> 'required',
		'birth_day' 	=> 'required|alpha_num',
		'birth_month' 	=> 'required|alpha_num',
		'birth_year' 	=> 'required|alpha_num',
	);*/

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usersinfo';

	public function user()
	{
		return $this->belongsTo('User');
	}

}
