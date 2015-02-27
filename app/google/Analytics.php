<?php 

namespace Google;

class Analytics extends \Google\Google{

	private $profileId;
	private $startDate;
	private $endDate;

	public function __construct() {

		parent::__construct([
			'https://www.googleapis.com/auth/analytics.readonly'
		]);
		
		$this->profileId = \Collection::config('profile_id');
  		$this->setService('Google_Service_Analytics');
  		$this->setStartDate(date('Y-m-d', strtotime(\Carbon\Carbon::now()->subMonth())));
  		$this->setEndDate(date('Y-m-d'));

	}

	public function setStartDate($date) {

		$this->startDate = $date;

	}

	public function getStartDate() {

		return $this->startDate;

	}

	public function setEndDate($date) {

		$this->endDate = $date;

	}

	public function getEndDate() {

		return $this->endDate;

	}

	public function get($startDate, $endDate, $metrics) {

		$service = $this->getService();

		$result = $service->data_ga
						  ->get('ga:' . $this->profileId, $startDate, $endDate, $metrics);

		if($result->getRows()) {

			return $result->getRows()[0][0];

		} 

		return 0;

	}

	public function pagesViewLastWeek() {

		$results = [];

		$currentDate = \Carbon\Carbon::now();

		for($i = 0; $i < 6; $i++) {

			$date = date('Y-m-d', strtotime($currentDate));
			$views = (int) $this->get($date, $date, 'ga:users');

			$results[] = [
				$date,
				$views,
				date('l, d/m', strtotime($currentDate)),
			];

			$currentDate->subDay();

		}

		return array_reverse($results, TRUE);

	}

	public function sessions() {

		return (int) $this->get($this->getStartDate(), $this->getEndDate(), 'ga:sessions');

	}	

	public function users() {

		return (int) $this->get($this->getStartDate(), $this->getEndDate(), 'ga:users');

	}

	public function avgDuration() {

		return gmdate("i:s", $this->get($this->getStartDate(), $this->getEndDate(), 'ga:avgSessionDuration'));

	}

	public function bounceRate() {

		return (int) $this->get($this->getStartDate(), $this->getEndDate(), 'ga:bounceRate') . "%";

	}

	public function newSessions() {

		return (int) $this->get($this->getStartDate(), $this->getEndDate(), 'ga:percentNewSessions') . "%";

	}

	public function pagesViewBySession() {

		return number_format($this->get($this->getStartDate(), $this->getEndDate(), 'ga:pageviewsPerSession'), 2, ',', ' ');

	}

	public function pages() {

		return (int) $this->get($this->getStartDate(), $this->getEndDate(), 'ga:pageviews');

	}

}