<?php

class Userinfo extends Eloquent {

	public static $rules = array(
		'sex' 			=> 'required',
		'birth_time' 	=> 'required|alpha_num',
		'birth_month' 	=> 'required|alpha_num'
	);

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
