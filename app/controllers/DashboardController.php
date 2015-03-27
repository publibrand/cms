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

	public function getAnalytics() {


		try{		

			if(Cache::has('analytics') && Request::isMethod('get')) {

				return Cache::get('analytics');

			} 

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
			$analyticsInfo['pageViews'] = $analytics->pageViews();
			$analyticsInfo['clientSite'] = $analytics->getClientSite();

			$view = View::make('dashboard.analytics')
						->with('analytics', $analyticsInfo)
				   		->with('analyticsCreatedAt', date('d/m/Y, H:i'))
				   		->render();

			Cache::forever('analytics', $view);

			return $view;

		} catch(Exception $e) {

			return false;

		}
	}

	public function index() {
		
		$collections = Collection::where('type', '=', 'collection')
								 ->get();
	 	
		$activities = $this->getActivities();
		$analytics = $this->getAnalytics();

		return View::make('dashboard.index')
				   ->with('collections', $collections)
				   ->with('activities', $activities)
				   ->with('analytics',  $analytics);

	}

}
