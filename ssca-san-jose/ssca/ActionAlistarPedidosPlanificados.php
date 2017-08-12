
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	
	$hora = $_REQUEST["hora"];
	$fecha = $_REQUEST["fecha"];
	//$hora = "18:36:00";
	$hora = strtotime ( $hora ) ;
	$query  = "SELECT * FROM `ordenpedido` WHERE `UbicacionPedido`='PLANIFICADO' AND `FechaEntrega`='$fecha'";
	$turno = 0;
	
	$sqlTurno = "SELECT * FROM `ordenpedido` WHERE `ConsecutivoTurno`!= 0 ORDER BY `id` DESC LIMIT 1";
	$resultTurno = mysqli_query($conexion, $sqlTurno);

	if(mysqli_num_rows($resultTurno) > 0){
		$registroTurno = mysqli_fetch_array($resultTurno);
		if($registroTurno["ConsecutivoTurno"] < 50){
			$turno = $registroTurno["ConsecutivoTurno"] + 1;
		}else{
			$turno = 1;
		}
		
	}else{
		$turno = 1;
	}
		
	

    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
		$id = stripslashes($registro["id"]);	
		$HoraEntrega = stripslashes($registro["HoraEntrega"]);	
		$nuevafecha = strtotime ( '-5 minute' , strtotime ( $HoraEntrega ) ) ;
		$nuevafecha = date ( 'H:i:s' , $nuevafecha );	 
		
		if(date ( 'H:i:s' , $hora ) >= date ( 'H:i:s' , strtotime ( $nuevafecha )) && date ( 'H:i:s' , $hora ) <= date ( 'H:i:s' , strtotime ( $HoraEntrega ))){
			//echo date ( 'H:i:s' , strtotime ( $nuevafecha ) ) . " - " . date ( 'H:i:s' , $hora );
			$queryUpdate  = "UPDATE `ordenpedido` SET `UbicacionPedido`='ALISTAMIENTO',`ConsecutivoTurno`='$turno' WHERE `id`='$id'";
			$resultUpdate = mysql_query($queryUpdate);
			echo $resultUpdate;
		}
		
	}	
	


	
?>