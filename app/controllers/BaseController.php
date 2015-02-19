<?php

class BaseController extends Controller {

	protected function saveFile($file, $dir = 'uploads'){
		$destinationPath = public_path() . '/' . $dir . "/";
		$fileName = Str::random(140) .'.'. $file->getClientOriginalExtension();
		
		$file->move($destinationPath, $fileName);

		return $dir . "/" . $fileName;
	}

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
