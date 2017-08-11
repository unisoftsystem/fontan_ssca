
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include_once(DIR_CONTROLLER . '/Controller_Categorias.php');
	include_once(DIR_CONTROLLER . '/Controller_SubCategorias.php');
	
	$controller_Categorias = new Controller_Categorias();
	$controller_SubCategorias = new Controller_SubCategorias();
	
	$tipoCategoria = $_REQUEST["tipoCategoria"];
	$nombre = $_REQUEST["nombre"];
	$categoria = $_REQUEST["categoria"];
	
	if($tipoCategoria == "Categoria"){
		$resultCategorias = $controller_Categorias->CrearCategoria($nombre);
		echo $resultCategorias;
	}else{
		$resultSubCategorias = $controller_SubCategorias->CrearSubCategoria($nombre, $categoria);
		echo $resultSubCategorias;
	}
	
	
	
	
	
	
	
	
	
	
	
?>