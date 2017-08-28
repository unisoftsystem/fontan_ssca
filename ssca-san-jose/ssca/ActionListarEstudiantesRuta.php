
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Monitor.php');
	
	$controller_Monitor = new Controller_Monitor();

	$idRuta = $_REQUEST["idRuta"];
	$fecha = date("Y-m-d");
	
	//Llamar la funcion que consultar un usuario
	$resultUsuario = $controller_Monitor->ListarEstudiantesRuta($idRuta, $fecha);
	echo $resultUsuario;
	
?>