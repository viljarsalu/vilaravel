<?php

class Item extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'items';
	protected $fillable = ['title','content'];

	public static $rules = array(
		'type' 				=> 'required',
		'label' 			=> 'required',
		'plan_and_price' 	=> 'required',
		'title' 			=> 'required|min:2',
		'content' 			=> 'required|min:2',
	);

	public function content() {
		return $this->hasOne('Content');
	}
	
	public function user()
	{
		return $this->belongsTo('User');
	}
}