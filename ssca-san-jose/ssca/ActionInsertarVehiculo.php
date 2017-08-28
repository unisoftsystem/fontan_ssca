<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIRDATA", "Data");
	define("DIR_DATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	define('UPLOAD_DIR', 'images/');
	
	include_once(DIR_DATA . '/DataVehiculo.php');
	include_once(DIR_CONTROLLER . '/Controller_Vehiculo.php');
	
	$resultCredenciales = ""; 
	$dataVehiculo = new DataVehiculo();
	$Controller_Vehiculo = new Controller_Vehiculo();
	/*
		Obtener valores enviados desde el script de la conexion
	*/	
	$marca = $_REQUEST["marca"];	
	$categoria = $_REQUEST["categoria"];	
	$placa = $_REQUEST["placa"];	
	$nombreruta = $_REQUEST["nombreruta"];	
	$sillas = $_REQUEST["sillas"];	
	$observaciones = $_REQUEST["observaciones"];
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
	$dataVehiculo->setMarca($marca);
	$dataVehiculo->setCategoria($categoria);
	$dataVehiculo->setPlaca($placa);
	$dataVehiculo->setNombreruta($nombreruta);
	$dataVehiculo->setSillas($sillas);
	$dataVehiculo->setObservaciones($observaciones);	
	$dataVehiculo->setImagenFotografica($file);
	
	//Llamar la funcion que crea un usuario
	$resultUsuarioNuevo = $Controller_Vehiculo->CrearVehiculo($dataVehiculo);	
	
	

	
	
?>