
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	$jsonProteinas = "[";
	$contador = 1;
	
	$query  = "SELECT * FROM `proteinas`";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
		$id = stripslashes($registro["id"]);	
		$Descripcion = stripslashes($registro["Descripcion"]);	
		$color = stripslashes($registro["color"]);	
		
		if($contador == 1){
			$jsonProteinas .= '{"id":"' . $id . '", "Descripcion":"' . $Descripcion . '", "color":"' . $color . '"}';	
		}else{
			if($contador <= $numeroFilas && $contador != 1){
				$jsonProteinas .= ',{"id":"' . $id . '", "Descripcion":"' . $Descripcion . '", "color":"' . $color . '"}';	
			}
		}
		$contador+=1;
	}
	$jsonProteinas .= "]";		
	echo $jsonProteinas;

	
?>