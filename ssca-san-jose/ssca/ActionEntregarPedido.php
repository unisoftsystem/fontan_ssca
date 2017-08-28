
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_OrdenPedido.php');
	
	$resultCredenciales = ""; 
	$idCredencial = $_REQUEST["idCredencial"];	
	$controller_OrdenPedido = new Controller_OrdenPedido();
	
	//Llamar la funcion que lista las categorias
	$resultOrdenPedido = $controller_OrdenPedido->EntregarPedidos($idCredencial);	
	
	echo $resultOrdenPedido;
	
	
	
	
?>