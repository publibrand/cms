<?php

class DashboardController extends BaseController {

	public function index() {
		
		$collections = Collection::all();

		return View::make('dashboard.index')
				   ->with('collections', $collections);

	}

}
