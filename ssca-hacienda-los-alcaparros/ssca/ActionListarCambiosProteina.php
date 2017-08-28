
<?php 
	header("Access-Control-Allow-Origin: *");
		
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	$jsonEstudiantes = "[";
	$contador = 1;
	$dia = $_REQUEST["dia"];
	$fecha = $_REQUEST["fecha"];
	
	$query  = "SELECT MAX( dm.`fecha` ) AS fecha, MAX( dm.`hora` ) AS hora, dm.`idUsuario` , u.*, p.Descripcion AS Proteina, p.color AS color FROM  `detallenenudia` dm INNER JOIN usuarios u ON u.idUsuario = dm.`idUsuario` INNER JOIN proteinas p ON p.id = dm.`idProteina` INNER JOIN log_restaurante l ON l.documento = ( SELECT c.`idCredencial` as idCredencial FROM `usuarios` u INNER JOIN credenciales c ON u.`idUsuario` = c.`idUsuarioSecundario` OR u.`NumeroId` = c.`idUsuarioSecundario` WHERE u.`idUsuario` = dm.`idUsuario` ) WHERE dm.`Dia` =$dia AND l.fecha =  '$fecha' GROUP BY dm.`idUsuario` ORDER BY l.fecha ASC, l.hora ASC";
	//$query = "SELECT MAX(dm.`fecha`) AS fecha, MAX(dm.`hora`) as hora, dm.`idUsuario`, u.*, p.Descripcion AS Proteina, p.color AS color FROM `detallenenudia` dm INNER JOIN usuarios u ON u.idUsuario = dm.`idUsuario` INNER JOIN proteinas p on p.id = dm.`idProteina` WHERE dm.`Dia`=$dia GROUP BY dm.`idUsuario` ORDER BY `fecha` ASC, `hora` ASC";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
		$tipoId = stripslashes($registro["TipoId"]);	
		$numeroId = stripslashes($registro["NumeroId"]);	
		$primerApellido = stripslashes($registro["PrimerApellido"]);	
		$segundoApellido = stripslashes($registro["SegundoApellido"]);		
		$primerNombre = stripslashes($registro["PrimerNombre"]);	
		$segundoNombre = stripslashes($registro["SegundoNombre"]);	
		$direccion = stripslashes($registro["Direccion"]);	
		$telefono1 = stripslashes($registro["Telefono1"]);		
		$telefono2 = stripslashes($registro["Telefono2"]);		
		$tipoUsuario = stripslashes($registro["TipoUsuario"]);		
		$idAcudiente = stripslashes($registro["idAcudiente"]);	
		$ImagenFotografica = stripslashes($registro["ImagenFotografica"]);	
		$gcm_regid = stripslashes($registro["gcm_regid"]);
		$fecha = stripslashes($registro["fecha"]);
		$hora = stripslashes($registro["hora"]);	
		$latitud = stripslashes($registro["latitud"]);
		$longitud = stripslashes($registro["longitud"]);
		$Coordenadas = stripslashes($registro["Coordenadas"]);	
		$Proteina = stripslashes($registro["Proteina"]);
		$color = stripslashes($registro["color"]);	
		
		if($contador == 1){
			$jsonEstudiantes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "ImagenFotografica":"' . $ImagenFotografica . '", "gcm_regid":"' . $gcm_regid . '", "fecha":"' . $fecha . '", "hora":"' . $hora . '", "latitud":"' . $latitud . '", "longitud":"' . $longitud . '", "Coordenadas":"' . $Coordenadas . '", "Proteina":"' . $Proteina . '", "color":"' . $color . '"}';	
		}else{
			if($contador <= $numeroFilas && $contador != 1){
				$jsonEstudiantes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "ImagenFotografica":"' . $ImagenFotografica . '", "gcm_regid":"' . $gcm_regid . '", "fecha":"' . $fecha . '", "hora":"' . $hora . '", "latitud":"' . $latitud . '", "longitud":"' . $longitud . '", "Coordenadas":"' . $Coordenadas . '", "Proteina":"' . $Proteina . '", "color":"' . $color . '"}';
			}
		}
		$contador+=1;
	}
	$jsonEstudiantes .= "]";		
  	echo $jsonEstudiantes;

	
?>