<?php

class DashboardController extends BaseController {

	private function getActivities() {

		$log = storage_path() .'/logs/activities.log';

		try {

			$activities = file($log);
			$activities = array_map('json_decode', $activities);

			return array_reverse($activities, TRUE);

		} catch(ErrorException $e) {

			File::put($log, '');
			
			return [];
			
		}

	}

	public function index() {
		
		$collections = Collection::where('slug', '!=', 'config')
								 ->get();
								 
		$activities = $this->getActivities();

		return View::make('dashboard.index')
				   ->with('collections', $collections)
				   ->with('activities', $activities);

	}

}
