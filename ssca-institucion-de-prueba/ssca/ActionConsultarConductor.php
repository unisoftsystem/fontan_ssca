
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Conductor.php');
	
	$resultCredenciales = ""; 
		
	$controller_Conductor = new Controller_Conductor();

	$usuario = $_REQUEST["usuario"];
	
	//Llamar la funcion que crea un usuario
	$resultUsuario = $controller_Conductor->ConsultarUsuario($usuario);

	echo $resultUsuario;

	
?>