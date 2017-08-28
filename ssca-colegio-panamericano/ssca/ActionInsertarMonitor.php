<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIRDATA", "Data");
	define("DIR_DATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	define('UPLOAD_DIR', 'images/');
	
	include_once(DIR_DATA . '/DataCredenciales.php');
	include_once(DIR_DATA . '/DataMovimientos.php');
	include_once(DIR_DATA . '/DataMonitor.php');
	include_once(DIR_DATA . '/DataTarifas.php');
	include_once(DIR_CONTROLLER . '/Controller_Monitor.php');
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
	include_once(DIR_CONTROLLER . '/Controller_Movimientos.php');
	include_once(DIR_CONTROLLER . '/Controller_Tarifas.php');
	
	$resultCredenciales = ""; 
	$dataUsuario = new DataMonitor();
	$dataCredenciales = new DataCredenciales();
	$controller_Credenciales = new Controller_Credenciales();
	$Controller_Monitor = new Controller_Monitor();
	$controller_Movimientos = new Controller_Movimientos();
	$controller_Tarifas = new Controller_Tarifas();
	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$idmonitor = $_REQUEST["idmonitor"];	
	$nombre = $_REQUEST["nombre"];	
	$apellido = $_REQUEST["apellido"];	
	$telefono = $_REQUEST["telefono"];	
	$TipoUsuario = $_REQUEST["TipoUsuario"];	
	$TipoId = $_REQUEST["TipoId"];	
	$Direccion = $_REQUEST["direccion"];	
	$Clave = $_REQUEST["Clave"];	
	$qr = $_REQUEST["qr"];
	$latitud = $_REQUEST["latitud"];
	$longitud = $_REQUEST["longitud"];
	$fecha = $_REQUEST["fecha"];
	$hora = $_REQUEST["hora"];
	$tipoSangre = $_REQUEST["tipoSangre"];
	$arl = $_REQUEST["arl"];
	$fechaVencimiento = $_REQUEST["fechaVencimiento"];
	$uidFoto = uniqid();
	$file = "";
	
	/*
		Descripcion: Subir foto al servidor local, convierte la imagen que estaba en base64 a un archivo png
	*/
	if($_POST['imgBase64'] != ""){
		$img = $_POST['imgBase64'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = UPLOAD_DIR . $uidFoto . '.png';
		$success = file_put_contents($file, $data);
	}
	$dateVenci = explode("-", $fechaVencimiento);
	$mes = "";
	//echo $dateVenci[0]; // porción1
	//echo $dateVenci[1]; // porción2

	switch($dateVenci[1]){
		case "01":
			$mes = $dateVenci[2] . " ENERO DE " . $dateVenci[0];
			break;
		case "02":
			$mes = $dateVenci[2] . " FEBRERO DE " . $dateVenci[0];
			break;
		case "03":
			$mes = $dateVenci[2] . " MARZO DE " . $dateVenci[0];
			break;
		case "04":
			$mes = $dateVenci[2] . " ABRIL DE " . $dateVenci[0];
			break;
		case "05":
			$mes = $dateVenci[2] . " MAYO DE " . $dateVenci[0];
			break;
		case "06":
			$mes = $dateVenci[2] . " JUNIO DE " . $dateVenci[0];
			break;
		case "07":
			$mes = $dateVenci[2] . " JULIO DE " . $dateVenci[0];
			break;
		case "08":
			$mes = $dateVenci[2] . " AGOSTO DE " . $dateVenci[0];
			break;
		case "09":
			$mes = $dateVenci[2] . " SEPTIEMBRE DE " . $dateVenci[0];
			break;
		case "10":
			$mes = $dateVenci[2] . " OCTUBRE DE " . $dateVenci[0];
			break;
		case "11":
			$mes = $dateVenci[2] . " NOVIEMBRE DE " . $dateVenci[0];
			break;
		case "12":
			$mes = $dateVenci[2] . " DICIEMBRE DE " . $dateVenci[0];
			break;		
	}
	/*
		Setear los datos de la credencial a crear
	*/
	$dataCredenciales->setIdUsuarioPrincipal($idmonitor);	
	$dataCredenciales->setIdUsuarioSecundario($idmonitor);
	$dataCredenciales->setSaldo(0);	
	$dataCredenciales->setFechaVencimiento($fechaVencimiento);	
	
	//Llamar la funcion que crea la credencial
	$resultCredenciales = $controller_Credenciales->CrearCredencial($dataCredenciales);		
	
	$VrTarjeta = $controller_Tarifas->ConsultarValorTarifa("Vr. Tarjeta");
	$VrTransaccional = $controller_Tarifas->ConsultarValorTarifa("Vr Transaccional");
		
	/*
		Setear los datos del usuario en un objeto
	*/
	$dataUsuario->setIdmonitor($idmonitor);	
	$dataUsuario->setNombre($nombre);
	$dataUsuario->setApellido($apellido);
	$dataUsuario->setTelefono($telefono);
	$dataUsuario->setTipoUsuario($TipoUsuario);
	$dataUsuario->setTipoId($TipoId);
	$dataUsuario->setImagenFotografica($file);
	$dataUsuario->setDireccion($Direccion);	
	$dataUsuario->setClave($Clave);	
	$dataUsuario->setQr($qr);
	$dataUsuario->setImagenFotografica($file);
	$dataUsuario->setLatitud($latitud);
	$dataUsuario->setLongitud($longitud);
	$dataUsuario->setArl($arl);
	$dataUsuario->setTipoSangre($tipoSangre);
	
	//Llamar la funcion que crea un usuario
	$resultUsuarioNuevo = $Controller_Monitor->CrearMonitor($dataUsuario);	
	
	$dataMovimientoTarjeta = new DataMovimientos();
	
	$dataMovimientoTarjeta->setIdUsuario($idmonitor);	
	$dataMovimientoTarjeta->setIdCredencial($resultCredenciales);
	$dataMovimientoTarjeta->setValorMovimiento($VrTarjeta + ($VrTransaccional * $VrTarjeta));	
	$dataMovimientoTarjeta->setFechaMovimiento($fecha);	
	$dataMovimientoTarjeta->setHoraMovimiento($hora);
	$dataMovimientoTarjeta->setDescripcionMovimiento("costo de asignación de tarjeta nueva");	
	
	
	//Llamar la funcion que registra los movimientos
	$resultMovimientoTarjeta = $controller_Movimientos->CrearMovimiento($dataMovimientoTarjeta);
	
	//echo $resultCredenciales . " - " . $resultMovimientoTarjeta;
	echo '[{"resultado":"' . $resultCredenciales . '", "credencial":"' . $resultCredenciales . '", "nombre":"' . $nombre . '", "apellido":"' . $apellido . '", "tipo":"' . strtoupper($TipoUsuario) . '", "numeroId":"' . $idmonitor . '", "foto":"' . $file . '", "fechaVencimiento":"' . $mes . '", "arl":"' . $arl . '", "tipoSangre":"' . $tipoSangre . '"}]';
	
?>