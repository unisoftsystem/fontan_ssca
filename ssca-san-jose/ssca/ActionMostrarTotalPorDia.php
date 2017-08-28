
<?php 
	header("Access-Control-Allow-Origin: *");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	
	$fecha = $_REQUEST["fecha"];
	$idCredencial = $_REQUEST["idCredencial"];
	
	$query  = "SELECT SUM(`ValorMovimiento`) AS Total FROM `movimientos` WHERE `idCredencial`='$idCredencial' AND (`DescripcionMovimiento` LIKE '%No de pedido%' OR `DescripcionMovimiento` LIKE '%No. Pedido%') AND `FechaMovimiento`='$fecha'";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	$registro = mysql_fetch_array($result, MYSQL_ASSOC);
	echo "[" . json_encode($registro) . "]";
	
?>