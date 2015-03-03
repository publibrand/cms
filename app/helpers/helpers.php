<?php

function thumb($img, $dimensions, $resize = TRUE) {

	$imageInfo = pathinfo($img);
	$imageName = $dimensions[0] .'x'. $dimensions[1] . '-' . $imageInfo['filename'] . '.' . $imageInfo['extension'];

	try {

		File::get(public_path('thumbnails/' . $imageName));

		return str_replace('bootstrap.php/', '', asset('thumbnails/' . $imageName));

	} catch(Exception $e) {

		$thumb = new PHPThumb\GD($img);

		if($resize) {
			$thumb->resize($dimensions[0], $dimensions[1]);
		}

		if(count($dimensions) == 2) {
			$thumb->cropFromCenter($dimensions[0], $dimensions[1]);
		} else {
			$thumb->crop($dimensions[0], $dimensions[1], $dimensions[2], $dimensions[3]);
		}


		$thumb->save(public_path('thumbnails/' . $imageName));

		return str_replace('bootstrap.php/', '', asset('thumbnails/' . $imageName));

	}

}