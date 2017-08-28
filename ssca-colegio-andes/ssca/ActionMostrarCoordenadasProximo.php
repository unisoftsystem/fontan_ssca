
<?php 
	header("Access-Control-Allow-Origin: *");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	
	$jsonAcudientes = "[";
	$idRuta = $_REQUEST["idRuta"];
	$fecha = date('Y-m-d');
	
	$query  = "SELECT usu.*,(acos(sin(radians(36.720139)) * sin(radians(40.425797)) + 
cos(radians(36.720139)) * cos(radians(40.425797)) * 
cos(radians(-4.419422) - radians(-3.690462))) * 6378) * 1000 as 
distancia FROM cart c INNER JOIN usuarios usu ON usu.NumeroId = c.valores WHERE c.ruta = '$idRuta' AND NOT c.valores IN (SELECT u.NumeroId FROM log_ruta lr, usuarios u WHERE lr.idestudiante = u.idUsuario AND lr.fecha = '$fecha' AND lr.tipo='RECOGIDA')";
    $result = mysql_query($query);
	$contador = 0;
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
		if($contador == 0){
			$jsonAcudientes .= json_encode($registro);	
		}else{
			$jsonAcudientes .= "," . json_encode($registro);	
		}		
		$contador++;
	}	
	$jsonAcudientes .= "]";			
  echo $jsonAcudientes;

	
?>