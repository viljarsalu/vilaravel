<?php

class Item extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'items';
	protected $fillable = ['type','public'];

	public static $rules = array(
		'type' 	=> 'required'
	);

	public function content() {
		return $this->hasOne('Content');
	}
	
	public function user()
	{
		return $this->belongsTo('User');
	}

	public function labels()
	{
		return $this->belongsToMany('Label');
	}

	public function prices()
	{
		return $this->belongsToMany('Price');
	}

	public function comments() {
		return $this->hasMany('Comment');
	}

	public function votes() {
		return $this->hasMany('Vote');
	}
	
	public function votedusers() {
		return $this->hasMany('Voteduser');
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