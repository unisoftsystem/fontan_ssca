<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIRDATA", "Data");
	define("DIR_DATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	define('UPLOAD_DIR', 'images/');
	
	include_once(DIR_DATA . '/DataMonitor.php');
	include_once(DIR_CONTROLLER . '/Controller_Monitor.php');
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
	
	$resultCredenciales = ""; 
	$dataUsuario = new DataMonitor();
	$Controller_Monitor = new Controller_Monitor();
	$controller_Credenciales = new Controller_Credenciales();
	
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
	$estado = $_REQUEST["estado"];
	$latitud = $_REQUEST["latitud"];
	$longitud = $_REQUEST["longitud"];
	$fechaVencimiento = $_REQUEST["fechaVencimiento"];
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
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = UPLOAD_DIR . $uidFoto . '.png';
		$success = file_put_contents($file, $data);
	}
		
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
	$dataUsuario->setEstado($estado);
	$dataUsuario->setImagenFotografica($file);
	$dataUsuario->setLatitud($latitud);
	$dataUsuario->setLongitud($longitud);
	$dataUsuario->setArl($arl);
	$dataUsuario->setTipoSangre($tipoSangre);
	
	//Llamar la funcion que crea un usuario
	$resultUsuarioNuevo = $Controller_Monitor->ModificarMonitor($dataUsuario);	
	
	$resultCredenciales = $controller_Credenciales->CambiarFechaVencimiento($fechaVencimiento, $idmonitor);	
	
	//echo $resultCredenciales . " - " . $resultMovimientoTarjeta;
	echo $resultUsuarioNuevo;
	
?>