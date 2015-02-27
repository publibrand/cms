<?php

class CreateGroups extends Seeder {

    public function run() {
        
        Sentry::createGroup(array(
	        'name'        => 'Developer',
	    ));

	    Sentry::createGroup(array(
	        'name'        => 'Editor',
	    ));

	    Sentry::createGroup(array(
	        'name'        => 'User',
	    ));

    }

}