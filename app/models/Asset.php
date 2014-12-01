<?php

class Asset extends \Eloquent {
	protected $table = 'assets';
	protected $fillable = [];

	public function users()
	{
		return $this->belongsToMany('User');
	}

	public function items()
	{
		return $this->belongsToMany('Item');
	}
}