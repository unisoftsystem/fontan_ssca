
<?php 
	header("Access-Control-Allow-Origin: *");	
	require_once 'db_connect1.php';
	
    // connecting to db
    $db = new DB_CONNECT();
	$jsonAcudientes = "[";
	$contador = 1;
	$idruta = $_REQUEST["idruta"];
	
	$query  = "SELECT usuarios.* FROM usuarios INNER JOIN cart ON usuarios.NumeroId=cart.valores where cart.ruta='$idruta'";
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