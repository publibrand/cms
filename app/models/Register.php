<?php

class Register extends Eloquent {

	protected $table = 'registers';
	
	protected $fillable = ['*'];
	
	public function metaData() {
	
		return $this->hasMany('MetaData', 'registers_id', 'id');
		
	}
	
}
