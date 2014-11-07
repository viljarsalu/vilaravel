<?php

class Label extends \Eloquent {

	protected $table = 'labels';
	protected $fillable = ['title','public'];

	public static $rules = array(
		'title' => 'required',
	);

	public function items()
	{
		return $this->belongsToMany('Item');
	}

}