<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionHasCollectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('collection_has_collection', function($table) {
			$table->increments('id')->unsigned();
			$table->integer('collections_id');
			$table->integer('siblings_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::drop('collection_has_collection');
	}

}
