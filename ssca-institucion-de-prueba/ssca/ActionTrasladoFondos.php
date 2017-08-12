
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
	$usuarioOrigen = $_REQUEST["usuarioOrigen"];
	$usuarioDestino = $_REQUEST["usuarioDestino"];
	$usuarioSesion = $_REQUEST["usuarioSesion"];
	$saldo = $_REQUEST["saldo"];
	$fecha = $_REQUEST["fecha"];
	$hora = $_REQUEST["hora"];

	$idCredencialOrigen = $controller_Credenciales->ObtenerIdCredencial($usuarioOrigen);
	$idCredencialDestino = $controller_Credenciales->ObtenerIdCredencial($usuarioDestino);
	
	$saldoActualOrigen = $controller_Credenciales->ObtenerSaldoActual($idCredencialOrigen);	
	$saldoActualDestino = $controller_Credenciales->ObtenerSaldoActual($idCredencialDestino);	

	if($saldoActualOrigen >= $saldo){
		$totalOrigen = $saldoActualOrigen - $saldo;
		$totalDestino = $saldoActualDestino + $saldo;
		$resultCambiarSaldoOrigen = $controller_Credenciales->CambiarSaldo($idCredencialOrigen, $totalOrigen);	
		$resultCambiarSaldoDestino = $controller_Credenciales->CambiarSaldo($idCredencialDestino, $totalDestino);
		
		$dataMovimientoRecargaOrigen = new DataMovimientos();
		$dataMovimientoRecargaComisionOrigen = new DataMovimientos();
		$dataMovimientoRecargaDestino = new DataMovimientos();
		$dataMovimientoRecargaComisionDestino = new DataMovimientos();
		
		$dataMovimientoRecargaOrigen->setIdUsuario($idCredencialOrigen);	
		$dataMovimientoRecargaOrigen->setIdCredencial($idCredencialDestino);
		$dataMovimientoRecargaOrigen->setValorMovimiento($saldo);	
		$dataMovimientoRecargaOrigen->setFechaMovimiento($fecha);	
		$dataMovimientoRecargaOrigen->setHoraMovimiento($hora);
		$dataMovimientoRecargaOrigen->setDescripcionMovimiento("traslado de fondos de " . $usuarioOrigen . " a " . $usuarioDestino);	
		$dataMovimientoRecargaOrigen->setOrigen("APPACUDIENTE");
		
		$dataMovimientoRecargaComisionOrigen->setIdUsuario($idCredencialOrigen);	
		$dataMovimientoRecargaComisionOrigen->setIdCredencial($idCredencialDestino);
		$dataMovimientoRecargaComisionOrigen->setValorMovimiento(($saldo * 0.06));	
		$dataMovimientoRecargaComisionOrigen->setFechaMovimiento($fecha);	
		$dataMovimientoRecargaComisionOrigen->setHoraMovimiento($hora);
		$dataMovimientoRecargaComisionOrigen->setDescripcionMovimiento("comisión transaccional traslado de fondos");
		$dataMovimientoRecargaComisionOrigen->setOrigen("APPACUDIENTE");
		
		$dataMovimientoRecargaDestino->setIdUsuario($idCredencialDestino);	
		$dataMovimientoRecargaDestino->setIdCredencial($idCredencialOrigen);
		$dataMovimientoRecargaDestino->setValorMovimiento($saldo);	
		$dataMovimientoRecargaDestino->setFechaMovimiento($fecha);	
		$dataMovimientoRecargaDestino->setHoraMovimiento($hora);
		$dataMovimientoRecargaDestino->setDescripcionMovimiento("traslado de fondos de " . $usuarioOrigen . " a " . $usuarioDestino);	
		$dataMovimientoRecargaDestino->setOrigen("APPACUDIENTE");
		
		$dataMovimientoRecargaComisionDestino->setIdUsuario($idCredencialDestino);	
		$dataMovimientoRecargaComisionDestino->setIdCredencial($idCredencialOrigen);
		$dataMovimientoRecargaComisionDestino->setValorMovimiento(($saldo * 0.06));	
		$dataMovimientoRecargaComisionDestino->setFechaMovimiento($fecha);	
		$dataMovimientoRecargaComisionDestino->setHoraMovimiento($hora);
		$dataMovimientoRecargaComisionDestino->setDescripcionMovimiento("comisión transaccional traslado de fondos");
		$dataMovimientoRecargaComisionDestino->setOrigen("APPACUDIENTE");
		
		//Llamar la funcion que registra los movimientos
		$resultMovimientoRecargaOrigen = $controller_Movimientos->CrearMovimiento($dataMovimientoRecargaOrigen);
		$resultMovimientoRecargaComisionOrigen = $controller_Movimientos->CrearMovimiento($dataMovimientoRecargaComisionOrigen);
		$resultMovimientoRecargaDestino = $controller_Movimientos->CrearMovimiento($dataMovimientoRecargaDestino);
		$resultMovimientoRecargaComisionOrigen = $controller_Movimientos->CrearMovimiento($dataMovimientoRecargaComisionDestino);

		echo '{"estado":"ok", "mensaje":"Se proceso con exito el traslado de fondos"}';
	}else{
		echo '{"estado":"error", "mensaje":"El saldo de origen debe ser mayor o igual al saldo a transferir. Actualmente hay '  . $saldoActualOrigen . ' '  . $saldoActualDestino . ' '  . $saldo . '"}';
	}	
	/*echo '{"estado":"ok", "mensaje":"El saldo de origen debe ser mayor o igual al saldo a transferir. Actualmente hay '  . $saldoActualOrigen . ' '  . $saldoActualDestino . ' '  . $saldo . '"}';*/
	

?>