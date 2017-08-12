
<?php 
	header("Access-Control-Allow-Origin: *");	
	require_once 'db_connect1.php';
	
    // connecting to db
    $db = new DB_CONNECT();
	$jsonAcudientes = "";
	$contador = 1;
	$idruta = $_REQUEST["idruta"];
	
	$query  = "SELECT a.*, c.nombre AS nombreConductor, c.apellido  AS apellidoConductor, v.placa, v.marca, v.sillas, m.nombre AS nombreMonitor, m.apellido AS apellidoMonitor FROM `asignacionruta` a INNER JOIN conductor c ON a.`id_conductor` = c.idconductor INNER JOIN vehiculo v ON v.idvehiculo = a.`idruta` INNER JOIN monitor m ON m.idmonitor = a.`monitor` WHERE a.`id`='$idruta'";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){		
		
		if($contador == 1){
			$jsonAcudientes = json_encode($registro);	
			$contador++;
		}else{
			$jsonAcudientes .= ',' . json_encode($registro);			
		}
		
	}	
	
	//$jsonAcudientes .= "]";		
	echo $jsonAcudientes;

	
?>