<?php
session_start();

// Define database
define('dbhost', 'cmslamp14.aut.ac.nz');
define('dbuser', 'wxh7743');	
define('dbpass', 'Zootycoon123');
define('dbname', 'wxh7743');

// Connecting database
try {
	$connect = new PDO("mysql:host=".dbhost."; dbname=".dbname, dbuser, dbpass);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo $e->getMessage();
}

?>
