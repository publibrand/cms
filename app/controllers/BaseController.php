<?php

class BaseController extends Controller {


	public function __construct() {

		View::share('menu', $this->getMenuItems());

	}
	
	private function getMenuItems() {

		$menu = [];

		$menu['collections'] = Collection::where('id', '!=', 1)
										 ->get();

		return $menu;

	}
}
