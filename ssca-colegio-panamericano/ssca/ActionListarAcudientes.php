
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIRDATA", "Data");
	define("DIR_DATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Usuario.php');
	
	$resultCredenciales = ""; 
		
	$controller_Usuario = new Controller_Usuario();


	
	//Llamar la funcion que crea un usuario
	$resultAcudientes = $controller_Usuario->ListarAcudientes();	
	
	
	echo $resultAcudientes;
	
	
	
	
?>