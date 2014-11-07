<?php

class Content extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'contents';
	protected $fillable = ['title','description'];

	public static $rules = array(
		'title' 		=> 'required|min:2',
		'description' 	=> 'required|min:2',
	);

	public function item()
	{
		return $this->belongsTo('Item');
	}
}