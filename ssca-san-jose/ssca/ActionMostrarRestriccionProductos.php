
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	require_once 'db_connect1.php';
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
    // connecting to db
    $db = new DB_CONNECT();
    $controller_Credenciales = new Controller_Credenciales();
	$jsonAcudientes = "[";
	$contador = 1;
	$idAcudiente = $_REQUEST["idAcudiente"];
	$Credencial = $_REQUEST["idCredencial"];

	//Llamar la funcion que obtener la credencial teniendo un id de un usuario
	$idCredencial = $controller_Credenciales->ObtenerIdCredencial($Credencial);
	
	$query  = "SELECT r.*, p.* FROM `restriccion` r INNER JOIN productos p ON p.codigoProducto = r.Log WHERE r.`idEstudiante`='$idCredencial' AND r.`Tipo`='PORPRODUCTO'";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
		/*$codigoProducto = $registro["codigoProducto"];
		$NombreProducto = $registro["NombreProducto"];*/
		if($contador == 1){
			$jsonAcudientes .= json_encode($registro);
			$contador++;
		}else{
			$jsonAcudientes .= "," . json_encode($registro);
		}
		//$jsonAcudientes .= '<label id="labelProducto' . $contador . '" class="form-group-lg">' . $NombreProducto . '</label><img src="images/close.png" style="margin-left:10px" class="eliminar" id="imagenEliminar' . $contador . '" idx="' . $contador . '" idProducto="' . $codigoProducto . '"/><br>';
		
		
	}		
	$jsonAcudientes .= "]";
  	echo $jsonAcudientes;

	
?>