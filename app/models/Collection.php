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
