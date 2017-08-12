
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
	
	$query  = "SELECT (SELECT CONCAT(PrimerNombre, ' ', SegundoNombre, ' ', PrimerApellido, ' ', SegundoApellido) FROM `usuarios` WHERE `idUsuario`=usua.idAcudiente) AS NombreAcudiente, l.*, '' AS nombreruta, usua.`idUsuario`, usua.`TipoId`, usua.`NumeroId`, usua.`PrimerApellido`, usua.`SegundoApellido`, usua.`PrimerNombre`, usua.`SegundoNombre`, usua.`ImagenFotografica`, usua.`Direccion`, usua.`Telefono1`, usua.`Telefono2`, usua.`Estado` FROM `log_ruta` l INNER JOIN usuarios_sistema u ON u.idUsuario = l.`idestudiante` INNER JOIN usuarios usua ON usua.idUsuario = l.`idruta` WHERE l.`tipo`='MENSAJEAACUDIENTESPORESTUDIANTE' UNION SELECT '' AS NombreAcudiente, lr.*, a.nombreruta, us.`idUsuario`, us.`TipoId`, us.`NumeroId`, us.`PrimerApellido`, us.`SegundoApellido`, us.`PrimerNombre`, us.`SegundoNombre`, us.`ImagenFotografica`, us.`Direccion`, us.`Telefono1`, us.`Telefono2`, us.`Estado` FROM `log_ruta` lr INNER JOIN asignacionruta a ON a.id = lr.`idruta` INNER JOIN usuarios_sistema us ON us.idUsuario = lr.`idestudiante` WHERE lr.`tipo`='MENSAJEAACUDIENTESPORRUTA'";
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