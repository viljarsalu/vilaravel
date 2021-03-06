<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	public static $rules = array(
		'email' 		=> 'required|email|unique:users',
		'password' 		=> 'required|alpha_num|between:6,12',
		'first_name' 	=> 'required|alpha|min:2',
		'last_name' 	=> 'required|alpha|min:2'
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	protected $fillable = array('email', 'password','first_name','last_name');
	
	public function items() {
		return $this->hasMany('Item');
	}

	public function userinfo()
	{
		return $this->hasOne('Userinfo');
	}

	public function prices()
	{
		return $this->belongsToMany('Price');
	}
	
	public function addresses()
	{
		return $this->belongsToMany('Address');
	}
	
	public function assets()
	{
		return $this->belongsToMany('Asset');
	}

}
