<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('CreateConfigCollection');
		$this->call('CreateGroups');
		$this->call('CreateDeveloper');
	}

}
