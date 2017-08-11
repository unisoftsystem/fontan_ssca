
<?php 
	header("Access-Control-Allow-Origin: *");
	require_once 'db_connect1.php';
	
    // connecting to db
    $db = new DB_CONNECT();
	$usuario = $_REQUEST["usuario"];
	
	$query  = "UPDATE `monitor` SET `Gcm_Phone`='' WHERE `idmonitor`='$usuario'";
	$queryUsuario = "UPDATE `usuarios` SET `gcm_regid`='' WHERE `NumeroId` = '$usuario'";
    $result = mysql_query($query);
	mysql_query($queryUsuario);
	
	echo $result;

	
?>