
<?php 
	header("Access-Control-Allow-Origin: *");
	
	require_once 'db_connect1.php';
	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$latitud = $_REQUEST["latitud"];	
	$longitud = $_REQUEST["longitud"];
	$idUsuario = $_REQUEST["idUsuario"];
	$fecha = $_REQUEST["fecha"];	
	$hora = $_REQUEST["hora"];	
	$idRuta = $_REQUEST["idRuta"];
	$coordenadas = $latitud . "," . $longitud;
	
	// connecting to db
	$db = new DB_CONNECT();
	$queryValidar  = "SELECT * FROM `asignacionruta` WHERE `id`='$idRuta'";
	$resultValidar = mysql_query($queryValidar);
	
	if($resultValidar != null){

		$queryValidarLog  = "SELECT * FROM `log_ruta` WHERE `idestudiante`='$idUsuario' AND `tipo`='BUS' AND `idruta`='$idRuta' AND `mensaje`='geolocalizacion' ORDER BY fecha DESC, hora DESC LIMIT 1";
		$resultValidarLog = mysql_query($queryValidarLog);

		if($resultValidarLog != null){

			$registro = mysql_fetch_array($resultValidarLog, MYSQL_ASSOC);
			$coord_log = explode(",", $registro["coordenadas_recogida"]);

			$point1 = array("lat" =>  $coord_log[0], "long" => $coord_log[1]); 
			$point2 = array("lat" => $latitud, "long" => $longitud); 

			$distancia = ($this->distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long'])) * 1000;

			if(($this->distanceCalculation($registro)) > 5){
				$query  = "INSERT INTO `log_ruta`(`id`, `idestudiante`, `coordenadas_recogida`, `tipo`, `idruta`, `fecha`, `hora`, `mensaje`) VALUES (NULL,'$idUsuario','$coordenadas','BUS','$idRuta','$fecha','$hora','geolocalizacion')";
				$result = mysql_query($query);
			
				echo $result;	
			}else{
				echo "0";	
			}
			
		}else{
			$query  = "INSERT INTO `log_ruta`(`id`, `idestudiante`, `coordenadas_recogida`, `tipo`, `idruta`, `fecha`, `hora`, `mensaje`) VALUES (NULL,'$idUsuario','$coordenadas','BUS','$idRuta','$fecha','$hora','geolocalizacion')";
			$result = mysql_query($query);
		
			echo $result;	
		}
	}

	function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
		// Cálculo de la distancia en grados
		$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
	 
		// Conversión de la distancia en grados a la unidad escogida (kilómetros, millas o millas naúticas)
		switch($unit) {
			case 'km':
				$distance = $degrees * 111.13384; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
				break;
			case 'mi':
				$distance = $degrees * 69.05482; // 1 grado = 69.05482 millas, basándose en el diametro promedio de la Tierra (7.913,1 millas)
				break;
			case 'nmi':
				$distance =  $degrees * 59.97662; // 1 grado = 59.97662 millas naúticas, basándose en el diametro promedio de la Tierra (6,876.3 millas naúticas)
		}
		return round($distance, $decimals);
	}
	
?>