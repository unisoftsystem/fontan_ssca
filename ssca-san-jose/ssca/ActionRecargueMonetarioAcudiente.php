
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include_once(DIR_DATA . '/DataCredenciales.php');
	include_once(DIR_DATA . '/DataMovimientos.php');
	include_once(DIR_DATA . '/DataUsuario.php');
	include_once(DIR_CONTROLLER . '/Controller_Usuario.php');
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
	include_once(DIR_CONTROLLER . '/Controller_Movimientos.php');
	
	$resultCredenciales = ""; 
	
	$dataUsuario = new DataUsuario();
	$dataCredenciales = new DataCredenciales();
	
	$controller_Usuario = new Controller_Usuario();
	$controller_Credenciales = new Controller_Credenciales();
	$controller_Movimientos = new Controller_Movimientos();

	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$usuario = $_REQUEST["usuario"];
	$usuarioSesion = $_REQUEST["usuarioSesion"];
	$saldo = $_REQUEST["saldo"];
	$fecha = $_REQUEST["fecha"];
	$hora = $_REQUEST["hora"];
	
	$idCredencial = $controller_Credenciales->ObtenerIdCredencial($usuario);	
	
	if($idCredencial != ""){
		$dataMovimientoRecarga = new DataMovimientos();
	
		$dataMovimientoRecarga->setIdUsuario($usuarioSesion);	
		$dataMovimientoRecarga->setIdCredencial($idCredencial);
		$dataMovimientoRecarga->setValorMovimiento($saldo);	
		$dataMovimientoRecarga->setFechaMovimiento($fecha);	
		$dataMovimientoRecarga->setHoraMovimiento($hora);
		$dataMovimientoRecarga->setDescripcionMovimiento("Recargue plataforma acudiente");	
		
		//Llamar la funcion que registra los movimientos
		$resultMovimientoRecarga = $controller_Movimientos->CrearMovimiento($dataMovimientoRecarga);
		
		$saldoActual = $controller_Credenciales->ObtenerSaldoActual($idCredencial);	
		$total = $saldoActual + $saldo;
		$resultCambiarSaldo = $controller_Credenciales->CambiarSaldo($idCredencial, $total);	
		echo $resultMovimientoRecarga;
	}else{
		//$idUsuario = $controller_Credenciales->ObtenerIdUsuario($usuario);	
		$dataMovimientoRecarga = new DataMovimientos();
	
		$dataMovimientoRecarga->setIdUsuario($usuarioSesion);	
		$dataMovimientoRecarga->setIdCredencial($usuario);
		$dataMovimientoRecarga->setValorMovimiento($saldo);	
		$dataMovimientoRecarga->setFechaMovimiento($fecha);	
		$dataMovimientoRecarga->setHoraMovimiento($hora);
		$dataMovimientoRecarga->setDescripcionMovimiento("Recargue plataforma acudiente");	
		
		//Llamar la funcion que registra los movimientos
		$resultMovimientoRecarga = $controller_Movimientos->CrearMovimiento($dataMovimientoRecarga);
		echo $resultMovimientoRecarga;
	}
	
	
	
	
	
?>