<?php
ini_set("error_log", "/var/log/nginx/icehrm.log");
define('CURRENT_PATH',__DIR__);
define('CLIENT_APP_PATH',realpath(__DIR__."/..")."/");
define('APP_PATH',realpath(__DIR__."/../..")."/");