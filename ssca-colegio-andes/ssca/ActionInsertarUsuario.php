
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIRDATA", "Data");
	define("DIR_DATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	define('UPLOAD_DIR', 'images/');
	
	include_once(DIR_DATA . '/DataCredenciales.php');
	include_once(DIR_DATA . '/DataMovimientos.php');
	include_once(DIR_DATA . '/DataUsuario.php');
	include_once(DIR_DATA . '/DataTarifas.php');
	include_once(DIR_CONTROLLER . '/Controller_Usuario.php');
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
	include_once(DIR_CONTROLLER . '/Controller_Movimientos.php');
	include_once(DIR_CONTROLLER . '/Controller_Tarifas.php');
	
	$resultCredenciales = ""; 
	
	$dataUsuario = new DataUsuario();
	$dataCredenciales = new DataCredenciales();
	
	$controller_Usuario = new Controller_Usuario();
	$controller_Credenciales = new Controller_Credenciales();
	$controller_Movimientos = new Controller_Movimientos();
	$controller_Tarifas = new Controller_Tarifas();

	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$tipoId = $_REQUEST["tipoId"];	
	$numeroId = $_REQUEST["numeroId"];	
	$primerApellido = $_REQUEST["primerApellido"];	
	$segundoApellido = $_REQUEST["segundoApellido"];	
	$primerNombre = $_REQUEST["primerNombre"];	
	$segundoNombre = $_REQUEST["segundoNombre"];	
	$direccion = $_REQUEST["direccion"];	
	$telefono1 = $_REQUEST["telefono1"];	
	$telefono2 = $_REQUEST["telefono2"];
	$estaltrend = $_REQUEST["estaltrend"];
	$selectTipoFuncionario = $_REQUEST["selectTipoFuncionario"];	
	$tipoUsuario = $_REQUEST["tipoUsuario"];	
	$usuario = $_REQUEST["usuario"];
	$clave = $_REQUEST["clave"];
	$idAcudiente = $_REQUEST["idAcudiente"];
	$saldo = $_REQUEST["saldo"];
	$fechanacimiento = $_REQUEST["fechanacimiento"];
	$fecha = $_REQUEST["fecha"];
	$hora = $_REQUEST["hora"];
	$uidFoto = uniqid();
	$latitud = $_REQUEST["latitud"];
	$longitud = $_REQUEST["longitud"];
	$tipoSangre = $_REQUEST["tipoSangre"];
	$curso = $_REQUEST["curso"];
	$arl = $_REQUEST["arl"];
	$cargo = $_REQUEST["cargo"];
	$fechaVencimiento = $_REQUEST["fechaVencimiento"];
	$file = "";
	$valor = str_replace(".", "", $saldo);
	/*
		Descripcion: Subir foto al servidor local, convierte la imagen que estaba en base64 a un archivo png
	*/
	if($_POST['imgBase64'] != ""){
		$img = $_POST['imgBase64'];
		$img = str_replace('data:image/png;base64,', '', $img);
		
		if($img == str_replace('data:image/png;base64,', '', $img)){
			$img = str_replace('data:image/jpeg;base64,', '', $img);
		}
		
		
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = UPLOAD_DIR . $uidFoto . '.png';
		$success = file_put_contents($file, $data);
	}
	/*
		Setear los datos del usuario en un objeto
	*/
	$dataUsuario->setTipoId($tipoId);	
	$dataUsuario->setNumeroId($numeroId);
	$dataUsuario->setPrimerApellido($primerApellido);
	$dataUsuario->setSegundoApellido($segundoApellido);
	$dataUsuario->setPrimerNombre($primerNombre);
	$dataUsuario->setSegundoNombre($segundoNombre);
	$dataUsuario->setDireccion($direccion);
	$dataUsuario->setTelefono1($telefono1);	
	$dataUsuario->setTelefono2($telefono2);
	$dataUsuario->setTipoUsuario($tipoUsuario);	
	$dataUsuario->setIdUsuario($usuario);
	$dataUsuario->setPassword($clave);
	$dataUsuario->setImagenFotografica($file);
	$dataUsuario->setIdAcudiente($idAcudiente);
	$dataUsuario->setLatitud($latitud);
	$dataUsuario->setLongitud($longitud);
	$dataUsuario->setFechanacimiento($fechanacimiento);
	$dataUsuario->setCurso($curso);
	$dataUsuario->setArl($arl);
	$dataUsuario->setCargo($cargo);
	$dataUsuario->setTipoSangre($tipoSangre);
	$dataUsuario->setTipoFuncionario($selectTipoFuncionario);
	$dataUsuario->getEstaltrend($estaltrend);
	
	//Llamar la funcion que crea un usuario
	$resultUsuarioNuevo = $controller_Usuario->CrearUsuario($dataUsuario);	
	
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
	
	
	if($tipoUsuario == "Estudiante"){
		$VrTarjeta = $controller_Tarifas->ConsultarValorTarifa("Vr. Tarjeta");
		$VrTransaccional = $controller_Tarifas->ConsultarValorTarifa("Vr Transaccional");
		$saldoIngresar = $valor - $VrTarjeta - ($VrTransaccional * $VrTarjeta);
		
		/*
		Setear los datos de la credencial a crear
		*/
		$dataCredenciales->setIdUsuarioPrincipal($idAcudiente);	
		$dataCredenciales->setIdUsuarioSecundario($usuario);
		$dataCredenciales->setSaldo($saldoIngresar);	
		$dataCredenciales->setFechaVencimiento($fechaVencimiento);	
		
		//Llamar la funcion que crea la credencial
		$resultCredenciales = $controller_Credenciales->CrearCredencial($dataCredenciales);		
		
		//echo $resultCredenciales;
		
		$dataMovimientoTarjeta = new DataMovimientos();
		$dataMovimientoRecarga = new DataMovimientos();
		
		$dataMovimientoTarjeta->setIdUsuario($usuario);	
		$dataMovimientoTarjeta->setIdCredencial($resultCredenciales);
		$dataMovimientoTarjeta->setValorMovimiento($VrTarjeta + ($VrTransaccional * $VrTarjeta));	
		$dataMovimientoTarjeta->setFechaMovimiento($fecha);	
		$dataMovimientoTarjeta->setHoraMovimiento($hora);
		$dataMovimientoTarjeta->setDescripcionMovimiento("costo de asignación de tarjeta nueva");	
		
		$dataMovimientoRecarga->setIdUsuario($usuario);	
		$dataMovimientoRecarga->setIdCredencial($resultCredenciales);
		$dataMovimientoRecarga->setValorMovimiento($valor);	
		$dataMovimientoRecarga->setFechaMovimiento($fecha);	
		$dataMovimientoRecarga->setHoraMovimiento($hora);
		$dataMovimientoRecarga->setDescripcionMovimiento("recargue monetario");	
		
		//Llamar la funcion que registra los movimientos
		$resultMovimientoTarjeta = $controller_Movimientos->CrearMovimiento($dataMovimientoTarjeta);
		$resultMovimientoRecarga = $controller_Movimientos->CrearMovimiento($dataMovimientoRecarga);
		
		echo '[{"resultado":"' . $resultCredenciales . '", "curso":"' . $resultUsuarioNuevo . '", "tipoSangre":"' . $tipoSangre . '", "credencial":"' . $resultCredenciales . '", "nombre":"' . $primerNombre . ' ' . $segundoNombre . '", "apellido":"' . $primerApellido . ' ' . $segundoApellido . '", "tipo":"' . strtoupper($tipoUsuario) . '", "numeroId":"' . $tipoId . " " . $numeroId . '", "foto":"' . $file . '", "fechaVencimiento":"' . $mes . '"}]';
	}else{
		if($tipoUsuario == "Funcionario"){
			$VrTarjeta = $controller_Tarifas->ConsultarValorTarifa("Vr. Tarjeta");
			$VrTransaccional = $controller_Tarifas->ConsultarValorTarifa("Vr Transaccional");
			$saldoIngresar = $valor - $VrTarjeta - ($VrTransaccional * $VrTarjeta);
			
			/*
			Setear los datos de la credencial a crear
			*/
			$dataCredenciales->setIdUsuarioPrincipal($usuario);	
			$dataCredenciales->setIdUsuarioSecundario($usuario);
			$dataCredenciales->setSaldo($saldoIngresar);	
			
			//Llamar la funcion que crea la credencial
			$resultCredenciales = $controller_Credenciales->CrearCredencial($dataCredenciales);		
			
			//echo $resultCredenciales;
			
			$dataMovimientoTarjeta = new DataMovimientos();
			$dataMovimientoRecarga = new DataMovimientos();
			
			$dataMovimientoTarjeta->setIdUsuario($usuario);	
			$dataMovimientoTarjeta->setIdCredencial($resultCredenciales);
			$dataMovimientoTarjeta->setValorMovimiento($VrTarjeta + ($VrTransaccional * $VrTarjeta));	
			$dataMovimientoTarjeta->setFechaMovimiento($fecha);	
			$dataMovimientoTarjeta->setHoraMovimiento($hora);
			$dataMovimientoTarjeta->setDescripcionMovimiento("costo de asignación de tarjeta nueva");	
			
			$dataMovimientoRecarga->setIdUsuario($usuario);	
			$dataMovimientoRecarga->setIdCredencial($resultCredenciales);
			$dataMovimientoRecarga->setValorMovimiento($valor);	
			$dataMovimientoRecarga->setFechaMovimiento($fecha);	
			$dataMovimientoRecarga->setHoraMovimiento($hora);
			$dataMovimientoRecarga->setDescripcionMovimiento("recargue monetario");	
			
			//Llamar la funcion que registra los movimientos
			$resultMovimientoTarjeta = $controller_Movimientos->CrearMovimiento($dataMovimientoTarjeta);
			$resultMovimientoRecarga = $controller_Movimientos->CrearMovimiento($dataMovimientoRecarga);
			
			echo '[{"resultado":"' . $resultCredenciales . '", "curso":"NINGUNO", "tipoSangre":"' . $tipoSangre . '", "credencial":"' . $resultCredenciales . '", "nombre":"' . $primerNombre . ' ' . $segundoNombre . '", "apellido":"' . $primerApellido . ' ' . $segundoApellido . '", "tipo":"' . strtoupper($tipoUsuario) . '", "numeroId":"' . $tipoId . " " . $numeroId . '", "foto":"' . $file . '", "fechaVencimiento":"' . $mes . '", "arl":"' . $arl . '", "cargo":"' . $cargo . '"}]';
		}
	}
	
	
?>