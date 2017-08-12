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
	
	/*
		Setear los datos del usuario en un objeto
	*/	
	$dataVehiculo->setMarca($marca);
	$dataVehiculo->setCategoria($categoria);
	$dataVehiculo->setPlaca($placa);
	$dataVehiculo->setNombreruta($nombreruta);
	$dataVehiculo->setSillas($sillas);
	$dataVehiculo->setObservaciones($observaciones);	
	
	//Llamar la funcion que crea un usuario
	$resultUsuarioNuevo = $Controller_Vehiculo->ModificarVehiculo($dataVehiculo);	
	
	echo $resultUsuarioNuevo;

	
	
?>