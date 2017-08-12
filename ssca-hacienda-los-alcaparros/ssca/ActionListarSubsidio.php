
<?php 
	header("Access-Control-Allow-Origin: *");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	$jsonMenus = "[";
	$contador = 1;

	$query  = "SELECT * FROM `subsidios_funcionarios` ORDER BY `tipo` ASC";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
		$id = stripslashes($registro["id"]);	
		$tipo = stripslashes($registro["tipo"]);	
		$valor = stripslashes($registro["valor"]);	
		//echo $resultadoDescripcion;
		if($contador == 1){
			$jsonMenus .= '{"id":"' . $id . '", "tipo":"' . $tipo . '", "valor":"' . $valor . '"}';	
		}else{
			if($contador <= $numeroFilas && $contador != 1){
				$jsonMenus .= ',{"id":"' . $id . '", "tipo":"' . $tipo . '", "valor":"' . $valor . '"}';
			}
		}
		$contador+=1;
	}
	
	$jsonMenus .= "]";		
  	echo $jsonMenus;

	
?>