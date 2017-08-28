
<?php 
	header("Access-Control-Allow-Origin: *");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	$jsonMenus = "[";
	$contador = 1;
	$dia = $_REQUEST["dia"];
	
	$query  = "SELECT m.*, p.Descripcion AS Proteina FROM `menudia` m INNER JOIN proteinas p on p.id = m.`idProteina` WHERE `Dia`=$dia";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
		$id = stripslashes($registro["id"]);	
		$Nombre = stripslashes($registro["Nombre"]);	
		$idProteina = stripslashes($registro["idProteina"]);	
		$Descripcion = stripslashes($registro["Descripcion"]);		
		$Dia = stripslashes($registro["Dia"]);	
		$Foto = stripslashes($registro["Foto"]);	
		$resultado = str_replace("/", "\/", $Foto);
		$resultadoDescripcion = str_replace("\n", ", ", $Descripcion);
		$Proteina = stripslashes($registro["Proteina"]);	
		//echo $resultadoDescripcion;
		if($contador == 1){
			$jsonMenus .= '{"id":"' . $id . '", "Nombre":"' . $Nombre . '", "idProteina":"' . $idProteina . '", "Descripcion":"' . $resultadoDescripcion . '", "Dia":"' . $Dia . '", "Foto":"' . $resultado . '", "Proteina":"' . $Proteina . '"}';	
		}else{
			if($contador <= $numeroFilas && $contador != 1){
				$jsonMenus .= ',{"id":"' . $id . '", "Nombre":"' . $Nombre . '", "idProteina":"' . $idProteina . '", "Descripcion":"' . $resultadoDescripcion . '", "Dia":"' . $Dia . '", "Foto":"' . $resultado . '", "Proteina":"' . $Proteina . '"}';
			}
		}
		$contador+=1;
	}
	
	$jsonMenus .= "]";		
  	echo $jsonMenus;

	
?>