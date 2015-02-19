<?php

class Collection extends BaseModel {

	protected $table = 'collections';

	protected $fillable = ['*'];
	
	public static $fields = [
		'text' => 'Text',
		'file' => 'File',
		'select' => 'Select',
	];

	public function registers() {

		return $this->hasMany('Register', 'collections_id', 'id');
	
	}

}
