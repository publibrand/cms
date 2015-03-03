<?php 

include __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/start.php';
$app->boot();

function thumb($img, $dimensions, $resize = TRUE) {

	$thumb = new PHPThumb\GD($img);

	if($resize) {
		$thumb->resize($dimensions[0], $dimensions[1]);
	}

	if(count($dimensions) == 2) {
		$thumb->cropFromCenter($dimensions[0], $dimensions[1]);
	} else {
		$thumb->crop($dimensions[0], $dimensions[1], $dimensions[2], $dimensions[3]);
	}

	$thumb->show();

}

 echo thumb('http://eaibeleza.com/wp-content/uploads/2014/04/maquiagem-bem-na-foto-blog.jpg', [200, 200]);
?>

