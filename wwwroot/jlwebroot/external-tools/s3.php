<?php
extract($_REQUEST);
require(dirname(__FILE__) . '/../../../jlprotected/config/constants.php');

$filename = basename("{$name}.{$ext}");

// Get path of original file
$filepath = realpath(dirname(__FILE__) . "/.." . str_replace("/fill/{$w}-{$h}", "", $uri));
// Get dir path of current file
$dirPath = dirname(__FILE__) . "/.." . dirname($uri);

/**
 thinhpq
*/
// $imagesize = @getimagesize("{$filepath}");
// if(!$imagesize){
// 	require_once("placehold.php");
// 	if($h>1000) $h = 220;
// 	createImgPlaceHold($w,$h,282828,969696);
// }

// If orgininal file existed
if ($filepath !== false) {
	// thumbnail file
	require_once("my_image.php");

	$my_image = new my_image($filepath);


	$my_image->fill($w, $h);
// 	$my_image->copyTo("{$dirPath}/{$filename}");
	$my_image->show();
} else {
	switch (strtolower($ext)) {
		case "gif":
			header("Content-type: image/jpeg");
			break;
		case "jpg":
		case "jpeg":
			header("Content-type: image/jpeg");
			break;
		case "PNG":
			header("Content-type: image/png");
			break;
	}
	
	header("Cache-control: Public");
	$headerTimeOffset = 60 * 60 * 24 * 30;
	$headeExpire = "Expires: ".gmdate("D, d M Y H:i:s",time()+$headerTimeOffset)." GMT";
	header ($headeExpire);
	
	$params = require(dirname(__FILE__) . '/../../../jlprotected/config/' . APPLICATION_ENV . '/params.php');

	$pattern = "/upload\/([^\/]+?)\/[^\?]+?\?album_id=(.*?)$/";

	preg_match($pattern, $_SERVER['REQUEST_URI'], $matches);

	$dir = $matches[1];
	$albumID = $matches[2];

	$s3FilePath = "{$params['AWS']['S3URL']}/upload/{$dir}/{$albumID}/{$name}.{$ext}";
	
	$headers = @get_headers($s3FilePath);
	
	if ($headers[0] == "HTTP/1.1 403 Forbidden" || !preg_match("/image\/(jpg|jpeg|png)/", $headers[6])) {
		//$image->invalid = 1;
		//$image->save();
		require_once("placehold.php");
		$w = $w > 1000 ? $h : $w;
		$h = $h > 1000 ? $w : $h;
		createImgPlaceHold($w, $h, 282828,969696);
		exit;
	}

		// thumbnail file
	require_once("my_image.php");
	
	$my_image = new my_image($s3FilePath);
	
	$my_image->fill($w, $h);
	
	/*$fileToWrite = dirname(__FILE__) . "/.." . str_replace("/fill/{$w}-{$h}", "", $uri);
	$pos = strrpos($fileToWrite, "/");
	
	$dirToWrite = substr($fileToWrite, 0, $pos);

	if (!is_dir($dirToWrite)) {
		mkdir($dirToWrite, 0777, true);
		chmod($dirToWrite, 0777);
	}
	
	$dirPath = dirname($fileToWrite) . "/fill/{$w}-{$h}";
	$my_image->copyTo("{$dirPath}/{$filename}");*/
	
	$my_image->show();
}