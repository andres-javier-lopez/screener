<?php

if(isset($_GET['url'])) {
	$url = 'http://'.$_GET['url'];
	$file = $_GET['url'].'.png';
	system('./phantomjs rasterize.js '.$url.' '.$file);
	
	if(file_exists($file)) {
		header('Content-Type: image/png');
		readfile($file);
	}
	else {
		echo 'No se pudo crear el screenshot';
	}
}
else {
	echo 'No se proporcion&oacute; una direcci&oacute;n';
}
