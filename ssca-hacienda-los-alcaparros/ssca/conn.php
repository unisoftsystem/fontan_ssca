<?php
require_once 'db_config1.php';    
	// Connection
	try {
		$db = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE . ";port=",DB_USER,DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$db->exec("SET NAMES 'utf8'");
	} catch (Exception $e) { // $e catches data sent by Exception
		echo "No esta conectado a la bd";	
		exit;
	}
	
	
	
			
?>