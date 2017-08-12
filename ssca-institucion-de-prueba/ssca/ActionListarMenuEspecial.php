
<?php 
	header("Access-Control-Allow-Origin: *");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	$jsonMenus = "[";
	$contador = 1;

	$query  = "SELECT * FROM `menuespecial`   ORDER BY `Dia` ASC";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
		$id = stripslashes($registro["id"]);	
		$Nombre = stripslashes($registro["Nombre"]);	
		$Valor = stripslashes($registro["Valor"]);	
		$Descripcion = stripslashes($registro["Descripcion"]);		
		$Dia = stripslashes($registro["Dia"]);	
		$Foto = stripslashes($registro["Foto"]);	
		$resultado = str_replace("/", "\/", $Foto);
		$resultadoDescripcion = str_replace("\n", ", ", $Descripcion);	
		//echo $resultadoDescripcion;
		if($contador == 1){
			$jsonMenus .= '{"id":"' . $id . '", "Nombre":"' . $Nombre . '", "Valor":"' . $Valor . '", "Descripcion":"' . $resultadoDescripcion . '", "Dia":"' . $Dia . '", "Foto":"' . $resultado . '"}';	
		}else{
			if($contador <= $numeroFilas && $contador != 1){
				$jsonMenus .= ',{"id":"' . $id . '", "Nombre":"' . $Nombre . '", "Valor":"' . $Valor . '", "Descripcion":"' . $resultadoDescripcion . '", "Dia":"' . $Dia . '", "Foto":"' . $resultado . '"}';
			}
		}
		$contador+=1;
	}
	
	$jsonMenus .= "]";		
  	echo $jsonMenus;

	
?>