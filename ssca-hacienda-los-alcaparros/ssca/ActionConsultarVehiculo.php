
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Vehiculo.php');
	
	$resultCredenciales = ""; 
		
	$controller_Vehiculo = new Controller_Vehiculo();

	$usuario = $_REQUEST["usuario"];
	
	//Llamar la funcion que crea un usuario
	$resultVehiculo = $controller_Vehiculo->ConsultarVehiculo($usuario);

	echo $resultVehiculo;

	
?>