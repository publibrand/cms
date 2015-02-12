<?php

class Collection extends Eloquent {

	protected $table = 'collections';

	protected $fillable = ['*'];

	public static $fields = [
		'text' => 'Text',
		'file' => 'File',
		'select' => 'Select',
	];

}
