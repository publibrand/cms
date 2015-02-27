<?php

class CreateDeveloper extends Seeder {

    public function run() {
    	
        $user = Sentry::createUser([
            'first_name' => 'Developer',
            'email'     => 'developer@developer.com',
            'password'  => 'developer',
	        'activated' => TRUE,
	    ]);

        $developer = Sentry::findGroupByName('Developer');
        $user->addGroup($developer);

    	$this->command->info('Developer account successfully created!');
    	$this->command->info('Email: developer@developer.com');
    	$this->command->info('Password: developer');

    }

}