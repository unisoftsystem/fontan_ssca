
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Categorias.php');
	
	$codigo = $_REQUEST["codigo"];	
	$controller_Categorias = new Controller_Categorias();
	
	//Llamar la funcion que lista las categorias
	$resultCategorias = $controller_Categorias->ObtenerCategoria($codigo);	
	
	echo $resultCategorias;
	
	
	
	
?>