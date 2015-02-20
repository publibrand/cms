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

		$menu['collections'] = Collection::where('is_visible', '=', 1)
										 ->get();

		$menu['pages'] = Collection::where('slug', '=', 'pages')
								   ->first()
								   ->registers()
								   ->get();
		return $menu;

	}
}
