
<?php 
	header("Access-Control-Allow-Origin: *");
	
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include_once(DIR_DATA . '/DataTarifas.php');
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
	include_once(DIR_CONTROLLER . '/Controller_Movimientos.php');
	include_once(DIR_CONTROLLER . '/Controller_Tarifas.php');
	
	$resultCredenciales = ""; 
	
	//Se crean los objetos para llamar las funciones creadas en los controles que realizan las operaciones en la base de datos
	$controller_Credenciales = new Controller_Credenciales();
	$controller_Movimientos = new Controller_Movimientos();
	$controller_Tarifas = new Controller_Tarifas();

	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$usuario = $_REQUEST["usuario"];
	$estado = $_REQUEST["estado"];
	$saldo = $_REQUEST["saldo"];
	$fecha = $_REQUEST["fecha"];
	$hora = $_REQUEST["hora"];
	
	//Llamar la funcion que obtener la credencial teniendo un id de un usuario
	$idCredencial = $controller_Credenciales->ObtenerIdCredencial($usuario);	
	
	//se llama a la funcion que realiza el reemplazo de la credencial
	$resultCredencialReemplada = $controller_Credenciales->CambiarEstado($estado, $idCredencial);	
	
	$VrCambioEstado = $controller_Tarifas->ConsultarValorTarifa("cambio de estado credencial");
	//$saldoActual = $controller_Credenciales->ObtenerSaldoActual($idCredencial);	
	
	//$saldoIngresar = $saldoActual - $VrCambioEstado;
	//$resultCambiarSaldo = $controller_Credenciales->CambiarSaldo($idCredencial, $saldoIngresar);	
	
	//Se crean primero los datos del movimiento
	$dataMovimiento = new DataMovimientos();
	$dataMovimiento->setIdUsuario($usuario);	
	$dataMovimiento->setIdCredencial($idCredencial);
	$dataMovimiento->setValorMovimiento($VrCambioEstado);	
	$dataMovimiento->setFechaMovimiento($fecha);	
	$dataMovimiento->setHoraMovimiento($hora);
	$dataMovimiento->setDescripcionMovimiento("cambio de estado credencia a " . $estado);	
	$dataMovimiento->setOrigen("APPACUDIENTE");
	
	//se llama a la funcion que crea el movimiento
	$resultMovimiento = $controller_Movimientos->CrearMovimiento($dataMovimiento);
	
	echo $idCredencial . " - " . $resultCredencialReemplada . " - " . $resultMovimiento;
	
?>