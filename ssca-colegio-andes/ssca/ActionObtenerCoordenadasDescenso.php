
<?php 
	header("Access-Control-Allow-Origin: *");	
	require_once 'db_connect1.php';
	
    // connecting to db
    $db = new DB_CONNECT();
	$json_array = array();
	$contador = 1;
	$idruta = $_POST["idruta"];
	$documento_estudiante = $_POST["documento"];
	$fecha = date("Y-m-d");
	
	$query  = "SELECT log_ruta.* FROM `log_ruta` INNER JOIN usuarios ON usuarios.idUsuario = log_ruta.idestudiante WHERE log_ruta.`idruta`='$idruta' AND log_ruta.`fecha`='$fecha' AND log_ruta.`tipo`='BAJADA' AND usuarios.NumeroId = '$documento_estudiante'";

    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){		
		array_push($json_array, $registro);
	}	

	echo json_encode($json_array);

	
?>