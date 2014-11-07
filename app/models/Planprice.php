<?php

class Planprice extends \Eloquent {
	protected $table = 'plans_and_prices';
	protected $fillable = ['title','description','price','date_start','date_end','public'];

	public static $rules = array(
		'title' 		=> 'required',
		'description' 	=> 'required',
		'price' 		=> 'required'
	);

	public function item()
	{
		return $this->belongsTo('Item');
	}
}