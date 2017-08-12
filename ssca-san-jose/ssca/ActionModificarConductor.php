<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIRDATA", "Data");
	define("DIR_DATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	define('UPLOAD_DIR', 'images/');
	
	include_once(DIR_DATA . '/DataCredenciales.php');
	include_once(DIR_CONTROLLER . '/Controller_Conductor.php');
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
	
	$resultCredenciales = ""; 
	$dataUsuario = new DataConductor();
	$Controller_Conductor = new Controller_Conductor();
	$controller_Credenciales = new Controller_Credenciales();

	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$idconductor = $_REQUEST["idconductor"];	
	$nombre = $_REQUEST["nombre"];	
	$apellido = $_REQUEST["apellido"];	
	$telefono = $_REQUEST["telefono"];	
	$TipoUsuario = $_REQUEST["TipoUsuario"];	
	$TipoId = $_REQUEST["TipoId"];	
	$Direccion = $_REQUEST["direccion"];	
	$latitud = $_REQUEST["latitud"];
	$longitud = $_REQUEST["longitud"];
	$fecha = $_REQUEST["fecha"];
	$hora = $_REQUEST["hora"];
	$fechaVencimiento = $_REQUEST["fechaVencimiento"];
	$estado = $_REQUEST["estado"];
	$tipoSangre = $_REQUEST["tipoSangre"];
	$arl = $_REQUEST["arl"];
	$uidFoto = uniqid();
	$file = "";
	
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
	$dataUsuario->setIdconductor($idconductor);	
	$dataUsuario->setNombre($nombre);
	$dataUsuario->setApellido($apellido);
	$dataUsuario->setTelefono($telefono);
	$dataUsuario->setTipoUsuario($TipoUsuario);
	$dataUsuario->setTipoId($TipoId);
	$dataUsuario->setImagenFotografica($file);
	$dataUsuario->setDireccion($Direccion);	
	$dataUsuario->setImagenFotografica($file);
	$dataUsuario->setLatitud($latitud);
	$dataUsuario->setLongitud($longitud);
	$dataUsuario->setEstado($estado);
	$dataUsuario->setArl($arl);
	$dataUsuario->setTipoSangre($tipoSangre);
	
	//Llamar la funcion que crea un usuario
	$resultUsuarioNuevo = $Controller_Conductor->ModificarConductor($dataUsuario);	
	
	$resultCredenciales = $controller_Credenciales->CambiarFechaVencimiento($fechaVencimiento, $idconductor);	
	
	//echo $resultCredenciales . " - " . $resultMovimientoTarjeta;
	echo $resultUsuarioNuevo;
	
?>