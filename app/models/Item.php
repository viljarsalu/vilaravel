<?php

class Item extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'items';
	protected $fillable = ['type','label','plan_and_price'];

	public static $rules = array(
		'type' 				=> 'required',
		'label' 			=> 'required',
		'plan_and_price' 	=> 'required'
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

	public function plansandprices()
	{
		return $this->belongsToMany('Price');
	}
}