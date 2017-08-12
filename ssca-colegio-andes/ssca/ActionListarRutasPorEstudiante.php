
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
	$usuario = $_REQUEST["usuario"];
	$query  = "SELECT c.fecha, a.* FROM cart c INNER JOIN asignacionruta a ON a.id = c.ruta WHERE c.valores='$usuario'";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	if($numeroFilas > 0){
		while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
			if($contador == 1){
				$jsonAcudientes .= json_encode($registro);			
			}else{
				if($contador <= $numeroFilas && $contador != 1){
					$jsonAcudientes .= "," . json_encode($registro);			
				}
			}
			$contador+=1;
			
		}
		
	}
	$jsonAcudientes .= "]";		
  	echo $jsonAcudientes;
	

	
?>