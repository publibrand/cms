<?php

class Register extends BaseModel {

	protected $table = 'registers';

	protected $fillable = ['*'];

	public function collection() {

		return $this->belongsTo('Collection', 'id');

	}

}
