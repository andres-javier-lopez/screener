<?php

if(isset($_GET['url'])) {
	if(!file_exists('images')) {
		mkdir('images');
	}
	
	$url = 'http://'.$_GET['url'];
	$file = 'images/'.$_GET['url'].'.png';
	system('./phantomjs rasterize.js '.$url.' '.$file);
	
	list($width, $height) = getimagesize($file);
	$new_width = $width;
	$new_height = isset($_GET['alto'])?$_GET['alto']:$height;
	$imagen_orig = imagecreatefrompng($file);
	$imagen = imagecreatetruecolor($new_width, $new_height);
	
	imagecopyresampled($imagen, $imagen_orig, 0, 0, 0, 0, $new_width, $new_height, $width, $new_height);
	$new_file = str_replace('.png', '.crop.png', $file);
	imagepng($imagen, $new_file, 7);
	
	if(file_exists($new_file)) {
		header('Content-Type: image/png');
		readfile($new_file);
	}
	else {
		echo 'No se pudo crear el screenshot';
	}
}
else {
	echo 'No se proporcion&oacute; una direcci&oacute;n';
}
