<?php

/*
|--------------------------------------------------------------------------
| Activities Events
|--------------------------------------------------------------------------
*/

Event::listen('activities.store', function($action, $entity) {

	$data = json_encode([
		'action' => $action,
		'user' => Sentry::getUser(),
		'entity' => $entity,
		'date' => time(),
	]) . "\n";

	File::append(storage_path() .'/logs/activities.log', $data);;

});