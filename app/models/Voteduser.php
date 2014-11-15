<?php

class Voteduser extends \Eloquent {
	protected $table 	= 'voted_user';
	protected $fillable = [];

	/*public static $rules = array(
		'title' 		=> 'required',
		'description' 	=> 'required',
		'price' 		=> 'required'
	);*/

	public function item()
	{
		return $this->belongsTo('Item');
	}
}