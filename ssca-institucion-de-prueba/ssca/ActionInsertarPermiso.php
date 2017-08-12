
<?php 
	header("Access-Control-Allow-Origin: *");
	
	require_once 'db_connect1.php';
	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$idUsuario = $_REQUEST["idUsuario"];
	$fecha = $_REQUEST["fecha"];	
	$hora = $_REQUEST["hora"];	
	$observaciones = $_REQUEST["observaciones"];
	
	// connecting to db
	$db = new DB_CONNECT();
	
	$query  = "INSERT INTO `permiso`(`idUsuario`, `Fecha`, `Hora`, `Observaciones`, `Estado`) VALUES ('$idUsuario','$fecha','$hora','$observaciones','ACTIVO')";
	$result = mysql_query($query);
	
	echo $result;	
	
	
?>