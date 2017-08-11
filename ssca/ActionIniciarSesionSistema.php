<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Usuarios.php');
	
	$resultCredenciales = ""; 
		
	$controller_Usuarios = new Controller_Usuarios();

	$usuario = $_REQUEST["usuario"];
	$clave = base64_encode($_REQUEST["clave"]);
	
	//Llamar la funcion que consultar un usuario
	$resultUsuario = $controller_Usuarios->IniciarSesionAcudiente($usuario, $clave);
	echo $resultUsuario;
	
?>