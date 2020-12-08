<?php

global $albums;

require_once "musicAuthority.php";

$albums = unserialize (file_get_contents ("albums"));

$msg = new MA_Store ();

$msg->work ();
$msg->run (function ($album) {

	print_r ($album->messageId);
	print_r ($album);
	global $albums;
	$albums[$album->messageId] = $album->releaseList->title. " (" . $album->releaseList->additionalTitle . ")";

	
}, function ($album) {
	global $albums;
	$albums[$album->messageId] = $album->releaseList->title. " (" . $album->releaseList->additionalTitle . ")";

}, function ($album) {
	global $albums;
	$albums[$album->messageId] = $album->releaseList->title . " (" . $album->releaseList->additionalTitle . ")";
	unset ($albums[$album->messageId]);

} );



file_put_contents ("albums", serialize ($albums));