
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	
	$contador = 1;
	$nombre = $_REQUEST["nombre"];
	
	$queryValidar  = "SELECT * FROM `proteinas` WHERE `Descripcion`='$nombre'";
    $resultValidar = mysql_query($queryValidar);
	$numeroFilas = mysql_num_rows($resultValidar);
	
	if($numeroFilas == 0){
		$color = "#" . substr(md5(time()), 0, 6);
		$queryInsert  = "INSERT INTO `proteinas` (`id`, `Descripcion`, `color`) VALUES (NULL, '$nombre', '$color')";
    	$resultInsert = mysql_query($queryInsert);
		
		$queryUltimo  = "SELECT MAX(id) AS id FROM proteinas";
		$resultUltimo = mysql_query($queryUltimo);
		$registro = mysql_fetch_array($resultUltimo, MYSQL_ASSOC);
		$idProteina = stripslashes($registro["id"]);	
		echo '[{"codigo":"' . $resultInsert . '", "Nombre":"' . $nombre . '", "Mensaje": "¡Proteina creada con exito!", "codigoProteina":"' . $idProteina . '"}]';
	}else{
		echo '[{"codigo":"0", "Nombre":"", "Mensaje": "¡La proteina ' . $nombre . ' ya esta registrada en el sistema!", "codigoProteina":""}]';
	}
	
	
	
?>