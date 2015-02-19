<?php

class Collection extends BaseModel {

	protected $table = 'collections';

	protected $fillable = ['*'];

	public static $fields = [
		'text' => 'Text',
		'file' => 'File',
		'select' => 'Select',
	];

	public static function boot() {
		parent::boot();
    }

}
