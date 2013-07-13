<?php
error_reporting(E_ERROR);
$jsVersion = '36.2';
$cssVersion = '2.4';
if (!function_exists('saveSessionObject')) {
function saveSessionObject($name,$obj){
	session_start();
	$_SESSION[$name.CLIENT_NAME] = json_encode($obj);
	session_write_close();
}
}

if (!function_exists('getSessionObject')) {
function getSessionObject($name){
	session_start();
	$obj = $_SESSION[$name.CLIENT_NAME];
	session_write_close();
	if(empty($obj)){
		return null;
	}
	return json_decode($obj);
}
}