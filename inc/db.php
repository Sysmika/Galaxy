<?
    define('DB_DRIVER' 		,'mysql');
	define('DB_HOSTNAME' 	,'localhost');
	define('DB_USERNAME' 	,'orion202_master');
	define('DB_PASSWORD' 	,'?wBE8Rh[sezn');
	define('DB_DATABASE' 	,'galaxy');
	define('DB_CHARSET'	    ,'utf-8'); 	
	define('DB_PORT'		,'3306'); 
/*////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////*/
	$mysqli = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE,DB_PORT);
?>
