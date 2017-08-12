
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Usuario.php');
	
	$resultCredenciales = ""; 
		
	$controller_Usuario = new Controller_Usuario();

	$usuario = $_REQUEST["usuario"];
	$clave = base64_encode($_REQUEST["clave"]);
	
	//Llamar la funcion que consultar un usuario
	$resultUsuario = $controller_Usuario->IniciarSesionRecaudo($usuario, $clave);
	echo $resultUsuario;
	
?>