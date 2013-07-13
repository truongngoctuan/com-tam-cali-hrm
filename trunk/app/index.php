<?php
include ('config.php');
$group = $_REQUEST['g'];
$name= $_REQUEST['n'];
if(!isset($_REQUEST['g']) || !isset($_REQUEST['n'])){
header("Location:".CLIENT_BASE_URL."login.php");	
}
include APP_BASE_PATH.'/'.$group.'/'.$name.'/index.php';