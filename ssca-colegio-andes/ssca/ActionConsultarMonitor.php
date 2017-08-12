
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Monitor.php');
	
	$resultCredenciales = ""; 
		
	$controller_Monitor = new Controller_Monitor();

	$usuario = $_REQUEST["usuario"];
	
	//Llamar la funcion que crea un usuario
	$resultUsuario = $controller_Monitor->ConsultarUsuario($usuario);

	echo $resultUsuario;

	
?>