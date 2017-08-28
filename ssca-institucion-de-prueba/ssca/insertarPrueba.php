<?php
	header("Access-Control-Allow-Origin: *");
	$con = mysqli_connect("localhost", "root", "usc", "copia_ssca");
	$latitud = $_REQUEST['latitud'];
	$longitud = $_REQUEST['longitud'];
	$coordenadas = $latitud . "," . $longitud;

	$sql="INSERT INTO log_ruta(idestudiante, coordenadas_recogida, tipo, idruta, fecha, hora, mensaje) VALUES ('81851860','$coordenadas','BUS','4',CURDATE(),curTime(),'geolocalizacion')";
	if (mysqli_query($con,$sql))
	{
		$array = array();
		$array["mensaje"] = "Los valores se han insertado con éxito";
		echo '{"results" : [{"formatted_address":"Los valores se han insertado con éxito"}]}';
	}else{
		$array["mensaje"] = "No se puede conectar";
		echo '{"results" : [{"formatted_address":"No se puede conectar"}]}';
	}
?>