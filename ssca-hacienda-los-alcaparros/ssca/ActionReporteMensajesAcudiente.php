
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	$jsonAcudientes = "[";
	$contador = 1;
	
	$query  = "SELECT (SELECT CONCAT(PrimerNombre, ' ', SegundoNombre, ' ', PrimerApellido, ' ', SegundoApellido) FROM `usuarios` WHERE `idUsuario`=u.idAcudiente) AS Nombre, u.*, l.`id`, l.`idestudiante`, l.`coordenadas_recogida`, l.`tipo`, l.`idruta`, l.`fecha`, l.`hora`, l.`mensaje`, a.nombreruta FROM `log_ruta` l INNER JOIN usuarios u ON u.idUsuario = l.`idestudiante`  INNER JOIN asignacionruta a ON a.id = l.idruta WHERE l.`tipo`='MENSAJEAMONITOR'";
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