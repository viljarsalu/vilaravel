<?php

class Vote extends \Eloquent {
	protected $table 	= 'votes';
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