<?php
$initDebugging = false;
function debugging($msg, $str="") {
	/*
	if ($initDebugging == false) {
		$initDebugging = true;
		error_log("------------------------------------------------\n", 3, APP_BASE_PATH."error.log");
		error_log("start debugging ".date('l jS \of F Y h:i:s A')."\n", 3, APP_BASE_PATH."error.log");	
	}
	*/
	if ($str != ""){
		error_log($str."\n", 3, APP_BASE_PATH."error.log");	
	}
	error_log($msg."\n", 3, APP_BASE_PATH."error.log");		

}

function debugging_p($obj, $str="") {
	if ($str != ""){
		error_log($str."\n", 3, APP_BASE_PATH."error.log");	
	}
	$msg = print_r($obj, true);
	error_log($msg."\n", 3, APP_BASE_PATH."error.log");		
}

/*
function debugging($str, $msg) {
	error_log($str."\n", 3, APP_BASE_PATH."error.log");	
	error_log($msg."\n", 3, APP_BASE_PATH."error.log");		
}

function debugging_p($str, $obj) {
	error_log($str."\n", 3, APP_BASE_PATH."error.log");	
	$msg = print_r($obj, true);
	error_log($msg."\n", 3, APP_BASE_PATH."error.log");		
}
*/
?>