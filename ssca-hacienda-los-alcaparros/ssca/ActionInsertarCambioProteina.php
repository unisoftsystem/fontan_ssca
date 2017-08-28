
<?php 
	header("Access-Control-Allow-Origin: *");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	
	
	$idMenuDia = $_REQUEST["idMenuDia"];
	$idProteina = $_REQUEST["idProteina"];
	$idUsuario = $_REQUEST["idUsuario"];
	$dia = $_REQUEST["dia"];
	$fecha = $_REQUEST["fecha"];
	$hora = $_REQUEST["hora"];
	
	$query  = "INSERT INTO `detallenenudia`(`idMenuDia`, `idProteina`, `idUsuario`, `Dia`, `fecha`, `hora`) VALUES ('$idMenuDia','$idProteina','$idUsuario','$dia','$fecha','$hora')";
    $result = mysql_query($query);
	
  	echo $result;

	
?>