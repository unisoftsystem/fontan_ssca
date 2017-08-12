
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Usuario.php');
	
	$resultCredenciales = ""; 
		
	$controller_Usuario = new Controller_Usuario();

	$usuario = $_REQUEST["usuario"];
	
	//Llamar la funcion que crea un usuario
	$resultUsuario = $controller_Usuario->ConsultarUsuarioIdUsuario($usuario);

	if($resultUsuario != "[]"){
		echo $resultUsuario;
	}else{
		$resultUsuarioCredencial = $controller_Usuario->ConsultarUsuarioPorCredencial($usuario);
		echo $resultUsuarioCredencial;
	}
		
	
	
	
	
	
	
?>