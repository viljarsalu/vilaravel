<?php

class Comment extends \Eloquent {
	protected $table = 'comments';

	protected $fillable = ['title','comment'];

	public static $rules = array(
		'comment_title' 	=> 'required',
		'comment' 			=> 'required'
	);

	public function item()
	{
		return $this->belongsTo('Item');
	}
}