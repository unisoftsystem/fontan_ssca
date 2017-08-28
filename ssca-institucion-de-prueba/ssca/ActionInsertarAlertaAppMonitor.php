
<?php 
	header("Access-Control-Allow-Origin: *");
	
	require_once 'db_connect1.php';
	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$latitud = $_POST["latitud"];	
	$longitud = $_POST["longitud"];
	$idUsuario = $_POST["usuario"];
	$message = $_POST["message"];
	$idRuta = $_POST["idRuta"];
	$coordenadas = $latitud . "," . $longitud;
	
	// connecting to db
	$db = new DB_CONNECT();
	$queryValidar  = "SELECT * FROM `asignacionruta` WHERE `id`='$idRuta'";
	$resultValidar = mysql_query($queryValidar);
	
	if($resultValidar != null){
		$query  = "INSERT INTO `log_ruta`(`id`, `idestudiante`, `coordenadas_recogida`, `tipo`, `idruta`, `fecha`, `hora`, `mensaje`) VALUES (NULL,'$idUsuario','$coordenadas','ALERTAPPMONITOR','$idRuta',CURDATE(), curTime(),'$message')";
		$result = mysql_query($query);
		
		echo $result;	
	}
	
?>