<?php

class DashboardController extends BaseController {

	private function getActivities() {

		try {

			$activities = file(storage_path() .'/logs/activities.log');
			$activities = array_map('json_decode', $activities);

			return array_reverse($activities, TRUE);

		} catch(Illuminate\Filesystem\FileNotFoundException $e) {

			return [];
			
		}

	}

	public function index() {
		
		$collections = Collection::all();
		$activities = $this->getActivities();

		return View::make('dashboard.index')
				   ->with('collections', $collections)
				   ->with('activities', $activities);

	}

}
