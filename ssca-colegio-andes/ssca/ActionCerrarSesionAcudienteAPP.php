
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Usuario.php');
	include(DIR_CONTROLLER . '/Controller_Credenciales.php');
	
	$resultCredenciales = ""; 
		
	$controller_Usuario = new Controller_Usuario();
	$controller_Credenciales = new Controller_Credenciales();

	$idUsuario = $_REQUEST["usuario"];

	//Llamar la funcion que modificar el id token de un usuario
	$resultIdToken = $controller_Usuario->ModificarIdToken("", $idUsuario);
	echo $resultIdToken;
	
?>