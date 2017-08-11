
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include_once(DIR_DATA . '/DataOrdenPedido.php');
	include_once(DIR_CONTROLLER . '/Controller_OrdenPedido.php');
	
	$controller_OrdenPedido = new Controller_OrdenPedido();
	
	$consecutivoInterno = $_REQUEST["consecutivoInterno"];
	$estado = $_REQUEST["estado"];
	
	$resultOrdenPedido = $controller_OrdenPedido->ActualizarPedido($consecutivoInterno, $estado);
	
	echo $resultOrdenPedido;
	
	
	
	
	
	
	
?>