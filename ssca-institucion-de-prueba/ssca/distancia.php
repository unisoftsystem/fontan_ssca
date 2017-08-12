<?php
	$point1 = array("lat" => "10.385205", "long" => "-75.456564"); // París (Francia), 
	$point2 = array("lat" => "10.385302266666667", "long" => "-75.45668656666668"); // Ciudad de México (México)
	$km = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long']); // Calcular la distancia en kilómetros (por defecto)
	$mi = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long'], 'mi'); // Calcular la distancia en millas
	$nmi = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long'], 'nmi'); // Calcular la distancia en millas naúticas
	echo "La distancia entre París (Francia) y la Ciudad de México (México) es de $km km (= $mi millas = $nmi millas naúticas)";


	
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