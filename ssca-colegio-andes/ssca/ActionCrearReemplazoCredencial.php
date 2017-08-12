<?php 
	header("Access-Control-Allow-Origin: *");
	
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include_once(DIR_DATA . '/DataTarifas.php');
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
	include_once(DIR_CONTROLLER . '/Controller_Movimientos.php');
	include_once(DIR_CONTROLLER . '/Controller_Tarifas.php');
	include_once(DIR_CONTROLLER . '/Controller_Usuario.php');
	
	$resultCredenciales = ""; 
	
	//Se crean los objetos para llamar las funciones creadas en los controles que realizan las operaciones en la base de datos
	$controller_Credenciales = new Controller_Credenciales();
	$controller_Movimientos = new Controller_Movimientos();
	$controller_Tarifas = new Controller_Tarifas();
	$controller_Usuario = new Controller_Usuario();

	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$usuario = $_REQUEST["usuario"];
	$saldo = $_REQUEST["saldo"];
	$fecha = $_REQUEST["fecha"];
	$hora = $_REQUEST["hora"];
	
	//Llamar la funcion que obtener la credencial teniendo un id de un usuario
	$idCredencial = $controller_Credenciales->ObtenerIdCredencial($usuario);	
	$VrTarjeta = $controller_Tarifas->ConsultarValorTarifa("Vr. Tarjeta");
	$VrTransaccional = $controller_Tarifas->ConsultarValorTarifa("Vr Transaccional");
	$saldoActual = $controller_Credenciales->ObtenerSaldoActual($idCredencial);	
	
	$saldoIngresar = $saldoActual - $VrTarjeta - ($VrTransaccional * $VrTarjeta);
	//$resultCambiarSaldo = $controller_Credenciales->CambiarSaldo($idCredencial, $saldoIngresar);	
	
	//Se crean primero los datos del movimiento, el id de la credencial se actualizara automaticamente cuando se genere otra credencial
	$dataMovimiento = new DataMovimientos();
	$dataMovimiento->setIdUsuario($usuario);	
	$dataMovimiento->setIdCredencial($idCredencial);
	$dataMovimiento->setValorMovimiento($VrTarjeta + ($VrTransaccional * $VrTarjeta));	
	$dataMovimiento->setFechaMovimiento($fecha);	
	$dataMovimiento->setHoraMovimiento($hora);
	$dataMovimiento->setDescripcionMovimiento("cambio de credencial");	
	
	//se llama a la funcion que crea el movimiento
	$resultMovimiento = $controller_Movimientos->CrearMovimiento($dataMovimiento);
		
	//se llama a la funcion que realiza el reemplazo de la credencial
	$resultCredencialReemplada = $controller_Credenciales->CrearReemplazoCredencial($idCredencial);	
	//echo $usuario . " - " . $idCredencial . " - " . $resultCredencialReemplada . " - " . $resultMovimiento;
	
	$jsonUsuario = $controller_Usuario->ConsultarUsuarioPorCredencial($resultCredencialReemplada);	
	
	$obj = json_decode($jsonUsuario);
	foreach($obj as $array){
		
		if(isset($array->tipoUsuario)){
			$numeroId = $array->numeroId;
			$primerApellido = $array->primerApellido;
			$segundoApellido = $array->segundoApellido;
			$primerNombre = $array->primerNombre;
			$segundoNombre = $array->segundoNombre;
			$tipoUsuario = $array->tipoUsuario;
			$curso = $array->Descripcion;
			$tipoId = $array->tipoId;
			$tipoSangre = $array->TipoSangre;
			$cargo = $array->cargo;
			$arl = $array->arl;
			$file = $array->ImagenFotografica;
			$fechaVencimiento = $array->fechaVencimiento;
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
			echo '[{"resultado":"' . $resultMovimiento . '", "credencial":"' . $resultCredencialReemplada . '", "nombre":"' . $primerNombre . ' ' . $segundoNombre . '", "apellido":"' . $primerApellido . ' ' . $segundoApellido . '", "tipo":"' . strtoupper($tipoUsuario) . '", "numeroId":"' . $tipoId . " " . $numeroId . '", "foto":"' . $file . '", "curso":"' . $curso . '", "tipoSangre":"' . $tipoSangre . '", "fechaVencimiento":"' . $mes . '", "cargo":"' . $cargo . '", "arl":"' . $arl . '"}]';
				
		}else{
			$tipoUsuario = $array->TipoUsuario;
			if($tipoUsuario == "Monitor"){
				$numeroId = $array->idmonitor;
			}else{
				$numeroId = $array->idconductor;
			}
			
			$primerApellido = $array->apellido;
			$primerNombre = $array->nombre;
			$tipoSangre = $array->TipoSangre;
			$arl = $array->arl;
			
			$fechaVencimiento = $array->fechaVencimiento;
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
			
			$tipoId = $array->TipoId;
			$file = $array->ImagenFotografica;
			echo '[{"resultado":"' . $resultMovimiento . '", "credencial":"' . $resultCredencialReemplada . '", "nombre":"' . $primerNombre . '", "apellido":"' . $primerApellido . '", "tipo":"' . strtoupper($tipoUsuario) . '", "numeroId":"' . $tipoId . " " . $numeroId . '", "foto":"' . $file . '", "fechaVencimiento":"' . $mes . '", "tipoSangre":"' . $tipoSangre . '", "arl":"' . $arl . '"}]';
		}
        
	}
	//echo $resultCredencialReemplada;
?>