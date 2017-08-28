
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Monitor.php');
	
	$controller_Monitor = new Controller_Monitor();

	$usuario = $_REQUEST["usuario"];
	$gcm_id = $_REQUEST["gcm_id"];
	
	$resultIdToken = $controller_Monitor->ModificarIdToken($gcm_id, $usuario);
	echo $resultIdToken;
	
	
?>