<?php
function debugging($msg) {
	error_log($msg."\n", 3, APP_BASE_PATH."error.log");	
}

?>