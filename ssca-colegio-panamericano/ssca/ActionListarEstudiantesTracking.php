
<?php 
	header("Access-Control-Allow-Origin: *");	
	require_once 'db_connect1.php';
	
    // connecting to db
    $db = new DB_CONNECT();
	$jsonAcudientes = "[";
	$contador = 1;
	$idruta = $_REQUEST["idruta"];
	$fecha = $_REQUEST["fecha"];
	$fechaIn = $_REQUEST["fechaIn"];
	
	$query  = "(SELECT usuarios.*, 'RECOGIDOS' AS TipoDatos FROM cart INNER JOIN usuarios ON usuarios.NumeroId = cart.valores AND cart.ruta = '$idruta' WHERE (SELECT COUNT(*) FROM log_ruta WHERE log_ruta.idestudiante = usuarios.idUsuario AND log_ruta.tipo = 'RECOGIDA' AND fecha='$fechaIn') > 0) UNION (SELECT usuarios.*, 'NORECOGIDOS' AS TipoDatos FROM cart INNER JOIN usuarios ON usuarios.NumeroId = cart.valores AND cart.ruta = '$idruta' WHERE (SELECT COUNT(*) FROM log_ruta WHERE log_ruta.idestudiante = usuarios.idUsuario AND log_ruta.tipo = 'RECOGIDA' AND fecha='$fechaIn') = 0)";
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
	
	$jsonAcudientes .= "]";		
	echo $jsonAcudientes;

	
?>