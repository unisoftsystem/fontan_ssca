
<?php 
	header("Access-Control-Allow-Origin: *");
	
	require_once 'db_connect1.php';
	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$coordenadas = $_REQUEST["coordenadas"];	
	$idUsuario = $_REQUEST["idUsuario"];
	$fecha = $_REQUEST["fecha"];	
	$hora = $_REQUEST["hora"];	
	$idRuta = $_REQUEST["idRuta"];
	$mensaje = $_REQUEST["mensaje"];
	
	// connecting to db
	$db = new DB_CONNECT();
	$queryValidar  = "SELECT * FROM `asignacionruta` WHERE `id`='$idRuta'";
	$resultValidar = mysql_query($queryValidar);
	
	if(mysql_num_rows($resultValidar) > 0){
		$query  = "INSERT INTO `log_ruta`(`id`, `idestudiante`, `coordenadas_recogida`, `tipo`, `idruta`, `fecha`, `hora`, `mensaje`) VALUES (NULL,'$idUsuario','$coordenadas','MENSAJEAMONITOR','$idRuta','$fecha','$hora','$mensaje')";
		$result = mysql_query($query);
		
		echo $result;	
	}else{
		echo "0";
	}
	
?>