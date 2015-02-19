<?php

class Register extends BaseModel {

	protected $table = 'registers';
	
	protected $fillable = ['*'];
	
	public function metaData() {
	
		return $this->hasMany('MetaData', 'registers_id', 'id');
		
	}

	public function collection() {

		return $this->belongsTo('Collection', 'id');

	}

}
