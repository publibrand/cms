<?php

class BaseController extends Controller {


	public function __construct() {

		View::share('menu', $this->getMenuItems());

	}
	
	protected function saveFile($file, $dir = 'uploads'){
		$destinationPath = public_path() . '/' . $dir . "/";
		$fileName = Str::random(140) .'.'. $file->getClientOriginalExtension();
		
		$file->move($destinationPath, $fileName);

		return $dir . "/" . $fileName;
	}

	private function getMenuItems() {

		$menu = [];

		$menu['collections'] = Collection::where('id', '!=', 1)
										 ->get();
		$menu['pages'] = Register::where('collections_id', '=', 1)
								 ->get();

		return $menu;

	}
}
