
<?php 
	header("Access-Control-Allow-Origin: *");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	$jsonAcudientes = "[";
	$contador = 1;
	$fecha = $_REQUEST["fecha"];
	$query  = "SELECT ordenpedido.*, usuarios.* FROM `registrocontrol` INNER JOIN usuarios ON usuarios.idUsuario = registrocontrol.idUsuario INNER JOIN ordenpedido ON ordenpedido.`UbicacionPedido` = 'PLANIFICADO' AND ordenpedido.`FechaEntrega`='$fecha' AND ordenpedido.`idUsuario` = registrocontrol.`idUsuario` WHERE registrocontrol.`Tipo`='ENTRADA' AND  registrocontrol.`Fecha`='$fecha'
UNION SELECT ordenpedido.*, usuarios.* FROM `log_ruta` INNER JOIN usuarios ON usuarios.idUsuario = log_ruta.idestudiante INNER JOIN ordenpedido ON ordenpedido.`UbicacionPedido` = 'PLANIFICADO' AND ordenpedido.`FechaEntrega`='$fecha' AND ordenpedido.`idUsuario` = log_ruta.`idestudiante` WHERE log_ruta.`tipo`='RECOGIDA' AND log_ruta.`fecha`='$fecha'";
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