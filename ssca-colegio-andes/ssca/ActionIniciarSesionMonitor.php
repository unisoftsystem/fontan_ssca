
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Monitor.php');
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
	
	$controller_Monitor = new Controller_Monitor();
	$controller_Credenciales = new Controller_Credenciales();

	$usuario = $_REQUEST["usuario"];
	$clave = base64_encode($_REQUEST["clave"]);
	$credencial = $_REQUEST["credencial"];
	$gcm_id = $_REQUEST["gcm_id"];
	
	// var_dump($credencial);

	// $resultUsuario = $controller_Monitor->IniciarSesion($usuario, $clave);
	// echo $resultUsuario;
	if(strlen($credencial) == 0){
		//Llamar la funcion que consultar un usuario
		$resultUsuario = $controller_Monitor->IniciarSesion($usuario, $clave);
		echo $resultUsuario;
	}else{
		$idUsuario = $controller_Credenciales->ObtenerIdMonitor($credencial);	
		//Llamar la funcion que consultar un usuario
		$resultUsuario = $controller_Monitor->IniciarSesionQR($credencial);
		echo $resultUsuario;
	}
	
	
?>