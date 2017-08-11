
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Producto.php');
	
	$subcategoria = $_REQUEST["subcategoria"];
	$dia = $_REQUEST["dia"];
	$idUsuario = $_REQUEST["idUsuario"];
	$idCredencial = $_REQUEST["idCredencial"];
		
	$controller_Producto = new Controller_Producto();	
		
	//Llamar la funcion que lista las categorias
	$resultProductos = $controller_Producto->ListarProductosSubCategoria($subcategoria, $dia, $idUsuario, $idCredencial);	
	
	echo $resultProductos;
	
	
	
	
?>