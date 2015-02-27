<?php

class DashboardController extends BaseController {

	private function getActivities() {

		$log = storage_path() .'/logs/activities.log';

		try {

			$activities = file($log);
			$activities = array_map('json_decode', $activities);
			$activities = array_reverse($activities, TRUE);
		
			return array_slice($activities, 0, 10);  

		} catch(ErrorException $e) {

			File::put($log, '');
			
			return [];
			
		}

	}

	private function getAnalyticsInfo() {

		$analytics = new \Google\Analytics();
		
		$analyticsInfo = [];
		$analyticsInfo['pagesViewLastWeek'] = json_encode($analytics->pagesViewLastWeek());
		$analyticsInfo['sessions'] = $analytics->sessions();
		$analyticsInfo['users'] = $analytics->users();
		$analyticsInfo['pages'] = $analytics->pages();
		$analyticsInfo['pagesViewBySession'] = $analytics->pagesViewBySession();
		$analyticsInfo['avgDuration'] = $analytics->avgDuration();
		$analyticsInfo['bounceRate'] = $analytics->bounceRate();
		$analyticsInfo['newSessions'] = $analytics->newSessions();

		return $analyticsInfo;
	}

	public function index() {
		
		$collections = Collection::where('slug', '!=', 'config')
								 ->get();
								 
		$activities = $this->getActivities();

		return View::make('dashboard.index')
				   ->with('collections', $collections)
				   ->with('activities', $activities)
				   ->with('analytics', $this->getAnalyticsInfo());

	}

}
