<?php

class Collection extends BaseModel {

	protected $table = 'collections';

	protected $fillable = ['*'];
	
	public static $fields = [
		'text' => 'Text',
		'email' => 'Email',
		'phone' => 'Phone',
		'textarea' => 'Textarea',
		'wysiwyg' => 'WYSIWYG',
		'select' => 'Select',
		'number' => 'Number',
		'currency' => 'Currency',
		'date' => 'Date',
		'time' => 'Time',
		'boolean' => 'Yes or No',
		'file' => 'File',
	];

	public function registers() {

		return $this->hasMany('Register', 'collections_id', 'id');
	
	}

	public function scopeConfig($query, $key) {

		try{

			return $query->where('slug','=', 'config')
						 ->firstOrFail()
						 ->registers()
				      	 ->firstOrFail()
						 ->metaData()
						 ->where('key', '=', $key)
						 ->first()
						 ->value;

		} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {

			return [];

		}

	}

}
