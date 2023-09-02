<?
/*////////////////////////////////////////////////////////////
    define('DB_DRIVER' 	 ,'mysql');
	define('DB_HOSTNAME' ,'localhost');
	define('DB_USERNAME' ,'');
	define('DB_PASSWORD' ,'');
	define('DB_DATABASE' ,'');
	define('DB_CHARSET'	 ,'utf-8'); 	
	define('DB_PORT'	 ,'3306'); 
/*////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////*/
    define('DB_DRIVER' 		,'mysql');
	define('DB_HOSTNAME' 	,'localhost');
	define('DB_USERNAME' 	,'root');
	define('DB_PASSWORD' 	,'Miguel#1960');
	define('DB_DATABASE' 	,'bulk'); 
	define('DB_CHARSET'	    ,'utf-8'); 	
	define('DB_PORT'		,'3306'); 
/*////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////*/
	$mysqli = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE,DB_PORT);
?>
