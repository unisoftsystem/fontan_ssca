
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	require_once 'db_connect1.php';
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');

    // connecting to db
    $db = new DB_CONNECT();
	$jsonAcudientes = "[";
	$contador = 1;
	$idAcudiente = $_REQUEST["idAcudiente"];
	$Credencial = $_REQUEST["idCredencial"];
	$controller_Credenciales = new Controller_Credenciales();

	//Llamar la funcion que obtener la credencial teniendo un id de un usuario
	$idCredencial = $controller_Credenciales->ObtenerIdCredencial($Credencial);	
	
	$query  = "SELECT c.* , u.*, r.Log FROM  `credenciales` c INNER JOIN usuarios u ON u.idUsuario = c.idUsuarioSecundario INNER JOIN restriccion r ON r.`idEstudiante` =  c.`idCredencial` AND r.Tipo = 'PORVALOR' WHERE c.`idCredencial` ='$idCredencial' AND u.`idAcudiente` =  '$idAcudiente'";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
		if($contador == 1){
			$jsonAcudientes .= json_encode($registro);
		}else{
			if($contador <= $numeroFilas && $contador != 1){
				$jsonAcudientes .= ',' . json_encode($registro);;
			}
		}
		$contador+=1;
	}	
	
	$jsonAcudientes .= "]";		
  	echo $jsonAcudientes;

	
?>