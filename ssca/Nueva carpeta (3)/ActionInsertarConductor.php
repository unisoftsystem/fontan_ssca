<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIRDATA", "Data");
	define("DIR_DATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	define('UPLOAD_DIR', 'images/');
	
	include_once(DIR_DATA . '/DataConductor.php');
	include_once(DIR_CONTROLLER . '/Controller_Conductor.php');
	
	$resultCredenciales = ""; 
	$dataConductor = new DataConductor();
	$controller_Conductor = new Controller_Conductor();
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
	$Licencia = $_REQUEST["licencia"];
	$fecha = $_REQUEST["fecha"];
	$hora = $_REQUEST["hora"];
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
	/*
		Setear los datos del usuario en un objeto
	*/
	$dataConductor->setTipoId($tipoId);	
	$dataConductor->setNumeroId($numeroId);
	$dataConductor->setPrimerApellido($primerApellido);
	$dataConductor->setSegundoApellido($segundoApellido);
	$dataConductor->setPrimerNombre($primerNombre);
	$dataConductor->setSegundoNombre($segundoNombre);
	$dataConductor->setDireccion($direccion);
	$dataConductor->setTelefono1($telefono1);	
	$dataConductor->setTelefono2($telefono2);
	$dataConductor->setLicencia($Licencia);
	$dataConductor->setImagenFotografica($file);
	
	//Llamar la funcion que crea un usuario
	$resultConductorNuevo = $controller_Conductor->CrearConductor($dataConductor);		
?>