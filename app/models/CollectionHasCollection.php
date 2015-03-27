<?php

class CollectionHasCollection extends BaseModel {

	protected $table = 'collection_has_collection';

	public $timestamps = false;
	
	public function collection() {

		return $this->hasOne('Collection', 'id', 'siblings_id');
	
	}
	
	public static function boot() {
	}
}
