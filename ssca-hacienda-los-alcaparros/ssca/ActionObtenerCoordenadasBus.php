
<?php 
	header("Access-Control-Allow-Origin: *");	
	require_once 'db_connect1.php';
	
    // connecting to db
    $db = new DB_CONNECT();
	$jsonAcudientes = "";
	$contador = 1;
	$idruta = $_REQUEST["idruta"];
	$fecha = date("Y-m-d");
	
	$query  = "SELECT log_ruta.* FROM `log_ruta` INNER JOIN monitor ON monitor.idmonitor = log_ruta.idestudiante WHERE log_ruta.`idruta`='$idruta' AND log_ruta.`fecha`='$fecha' AND log_ruta.`tipo`='BUS' AND monitor.Gcm_Phone != '' ORDER BY log_ruta.`fecha` DESC, log_ruta.`hora` DESC LIMIT 1";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){		
		
		if($contador == 1){
			$jsonAcudientes .= json_encode($registro);	
		}else{
			if($contador <= $numeroFilas && $contador != 1){
				$jsonAcudientes .= ',' . json_encode($registro);
			}
		}
		$contador+=1;
	}	
	
	//$jsonAcudientes .= "]";		
	echo $jsonAcudientes;

	
?>