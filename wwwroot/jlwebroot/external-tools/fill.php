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
$imagesize = @getimagesize("{$filepath}");
if(!$imagesize){
	require_once("placehold.php");
	if($h>1000) $h = 220;
	createImgPlaceHold($w,$h,282828,969696);
}

// If orgininal file existed
if ($filepath !== false) {
	// thumbnail file
	require_once("my_image.php");
	
	$my_image = new my_image($filepath);
	
	
	$my_image->fill($w, $h);
	$my_image->copyTo("{$dirPath}/{$filename}");
	$my_image->show();
} else {
	createImgPlaceHold($w,$h,282828,969696);
}