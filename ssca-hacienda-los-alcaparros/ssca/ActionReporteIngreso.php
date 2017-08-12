
<?php 
	header("Access-Control-Allow-Origin: *");
	
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include_once(DIR_CONTROLLER . '/Controller_RegistroControl.php');
	
	$resultCredenciales = ""; 
	
	//Se crean los objetos para llamar las funciones creadas en los controles que realizan las operaciones en la base de datos
	$controller_RegistroControl = new Controller_RegistroControl();

	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$tipo = $_REQUEST["tipo"];
	$fechaInicial = $_REQUEST["fechaInicial"];
	$fechaFinal = $_REQUEST["fechaFinal"];
	$numeroID = $_REQUEST["numeroID"];
	
	//Llamar la funcion que obtener la credencial teniendo un id de un usuario
	$resultCredencial = $controller_RegistroControl->Reporte($fechaInicial, $fechaFinal, $tipo, $numeroID);	
	
	echo $resultCredencial;
	
?>