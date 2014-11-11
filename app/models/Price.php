<?php

class Price extends \Eloquent {
	protected $table = 'prices';
	protected $fillable = ['title','description','price','date_start','date_end','public'];

	public static $rules = array(
		'title' 		=> 'required',
		'description' 	=> 'required',
		'price' 		=> 'required'
	);

	public function items()
	{
		return $this->belongsToMany('Item');
	}

	public function users()
	{
		return $this->belongsToMany('User');
	}
}