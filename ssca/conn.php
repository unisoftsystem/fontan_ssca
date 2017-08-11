<?php
	// Connection
	try {
		$db = new PDO("mysql:host=localhost;dbname=ssca;port=","root","usc");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$db->exec("SET NAMES 'utf8'");
	} catch (Exception $e) { // $e catches data sent by Exception
		echo "No esta conectado a la bd";	
		exit;
	}
	
	
	
			
?>