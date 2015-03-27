<?php

class BaseController extends Controller {

	protected function saveFile($file, $dir = 'uploads'){
		$destinationPath = public_path() . '/' . $dir . "/";
		$fileName = Str::random(140) .'.'. $file->getClientOriginalExtension();
		
		$file->move($destinationPath, $fileName);

		return $dir . "/" . $fileName;
	}

	public static function getMenuItems() {

		$menu = [];

		$menu['collections'] = Collection::where('type', '=', 'collection')
										 ->get();

		$menu['pages'] = Collection::where('type', '=', 'page')
								   ->get();
		return $menu;

	}
}
