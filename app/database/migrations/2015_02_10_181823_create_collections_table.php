<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('collections', function($table) {
			$table->increments('id')->unsigned();
			$table->string('name');
			$table->text('slug');
			$table->text('fields');
			$table->boolean('is_visible')->default(1);
			$table->integer('max');
			$table->integer('order');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('collections');
	}

}
