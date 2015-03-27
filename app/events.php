<?php

/*
|--------------------------------------------------------------------------
| Activities Events
|--------------------------------------------------------------------------
*/

Event::listen('activities.store', function($action, $entity) {
	
	if($entity->slug == NULL) {
		$route = route('registers.edit', [$entity->collection->slug, $entity->id], false);
	} else {
		$route = route('collections.edit', [$entity->id], false);
	}
	

	$data = json_encode([
		'action' => $action,
		'user' => Sentry::getUser(),
		'entity' => $entity,
		'route' => $route,
		'date' => time(),
	]) . "\n";

	File::append(storage_path() .'/logs/activities.log', $data);

});