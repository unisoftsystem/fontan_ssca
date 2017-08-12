
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Producto.php');
	
	$codigoProducto = $_REQUEST["codigoProducto"];
	$cantidad = $_REQUEST["cantidad"];
	$session = $_REQUEST["session"];
		
	$controller_Producto = new Controller_Producto();
	
	//Llamar la funcion que lista las categorias
	$resultProductos = $controller_Producto->AumentarStock($codigoProducto, $cantidad, $session, "AUMENTAR STOCK POR ELIMINAR PRODUCTO EN PEDIDO APP");	
	
	echo $resultProductos;
	
	
	
	
?>