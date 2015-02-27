<?php 

namespace Google;

abstract class Google {

	protected $client;
	protected $service;

	public function __construct($scopes) {

		$this->client = new \Google_Client();
  		$this->auth($scopes);

	}

	protected function setService($service) {

		$this->service = new $service($this->client);

	}

	protected function getService() {

		return $this->service;

	}

	private function getKey() {

		return \File::get(public_path() . "/" . \Collection::config('key_file'));

	}

	private function getScopes() {

		return $this->scopes;

	}

	private function auth($scopes) {
		
  		$this->client
  			 ->setClientId(\Collection::config('client_id'));

		$credentials = new \Google_Auth_AssertionCredentials(
    		\Collection::config('client_email'),
    		$scopes,
    		$this->getKey()
	  	);

		$this->client->setAssertionCredentials($credentials);

  		if ($this->client->getAuth()->isAccessTokenExpired()) {
			$this->client->getAuth()->refreshTokenWithAssertion($credentials);
		}

  	}

}