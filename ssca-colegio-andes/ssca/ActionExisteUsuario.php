
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include_once(DIR_CONTROLLER . '/Controller_Usuario.php');
	
	$resultCredenciales = ""; 
		
	$controller_Usuario = new Controller_Usuario();

	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$usuario = $_REQUEST["usuario"];
	
	/*
		Setear los datos del usuario en un objeto
	*/
	
	//Llamar la funcion que crea un usuario
	$resultExisteUsuario = $controller_Usuario->ExisteUsuario($usuario);	
	
	
	echo $resultExisteUsuario;
	
	
	
	
?>