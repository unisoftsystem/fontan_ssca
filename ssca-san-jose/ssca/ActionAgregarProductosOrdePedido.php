
<?php 
	header("Access-Control-Allow-Origin: *");
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	
	$id = $_REQUEST["id"];
	$codigoProducto = $_REQUEST["codigoProducto"];
	$cantidad = $_REQUEST["cantidad"];
	$total = $_REQUEST["total"];

	$query = "INSERT INTO `Detalle_OrdenPedido`(`idOrdenPedido`, `codigoProducto`, `cantidad`, `total`) VALUES ('$id','$codigoProducto','$cantidad','$total')";
	$result = mysql_query($query);
	echo $result;
?>