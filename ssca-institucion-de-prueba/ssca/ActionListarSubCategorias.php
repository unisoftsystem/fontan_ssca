
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_SubCategorias.php');
	
	$idCategoria = $_REQUEST["idCategoria"];
		
	$controller_SubCategorias = new Controller_SubCategorias();
	
	//Llamar la funcion que lista las categorias
	$resultSubCategorias = $controller_SubCategorias->ListarSubCategorias($idCategoria);	
	
	echo $resultSubCategorias;
	
	
	
	
?>