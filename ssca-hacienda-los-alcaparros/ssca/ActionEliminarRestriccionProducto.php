
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
	$idAcudiente = $_REQUEST["idAcudiente"];
	$Credencial = $_REQUEST["idCredencial"];
	$idProducto = $_REQUEST["idProducto"];

	//Llamar la funcion que obtener la credencial teniendo un id de un usuario
	$idCredencial = $controller_Credenciales->ObtenerIdCredencial($Credencial);
	
	$query  = "DELETE FROM `restriccion` WHERE `idAcudiente`='$idAcudiente' AND `idEstudiante`='$idCredencial' AND `Tipo`='PORPRODUCTO' AND `Log`='$idProducto'";
    $result = mysql_query($query);	
			
  	echo $result;

	
?>