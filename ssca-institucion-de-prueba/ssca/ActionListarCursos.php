
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
	
	$query  = "SELECT `id`, `Descripcion` FROM `cursos`";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
		$id = stripslashes($registro["id"]);	
		$Descripcion = stripslashes($registro["Descripcion"]);	
		
		if($contador == 1){
			$jsonAcudientes .= '{"id":"' . $id . '", "Descripcion":"' . $Descripcion . '"}';	
		}else{
			if($contador <= $numeroFilas && $contador != 1){
				$jsonAcudientes .= ',{"id":"' . $id . '", "Descripcion":"' . $Descripcion . '"}';	
			}
		}
		$contador+=1;
	}	
	
	$jsonAcudientes .= "]";		
  	echo $jsonAcudientes;

	
?>