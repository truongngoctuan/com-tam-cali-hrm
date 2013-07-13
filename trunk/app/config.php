<?php 
ini_set('error_log', '/tmp/icehrm.log');

define('CLIENT_NAME', 'app');
define('APP_BASE_PATH', 'C:\wamp\www\comtamcalihrm/');
define('CLIENT_BASE_PATH', 'C:\wamp\www\comtamcalihrm\app/');
define('BASE_URL','http://localhost/comtamcalihrm/');
define('CLIENT_BASE_URL','http://localhost/comtamcalihrm/app/');

define('APP_DB', 'comtamcali_hrm');
define('APP_USERNAME', 'root');
define('APP_PASSWORD', 'asd');
define('APP_HOST', 'localhost');
define('APP_CON_STR', 'mysql://'.APP_USERNAME.':'.APP_PASSWORD.'@'.APP_HOST.'/'.APP_DB);

//file upload
define('FILE_TYPES', 'jpg,png,jpeg');
define('MAX_FILE_SIZE_KB', 10 * 1024);
