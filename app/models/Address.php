<?php

class Address extends \Eloquent {
	protected $table = 'addresses';
	protected $fillable = [];

	public function items()
	{
		return $this->belongsToMany('Item');
	}
	
	public function users()
	{
		return $this->belongsToMany('User');
	}
}