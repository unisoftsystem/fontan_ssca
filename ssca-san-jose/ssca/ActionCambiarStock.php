
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Producto.php');
	
	if(isset($_POST["codigoProducto"]) && isset($_POST["cantidad"])){  
		$codigoProducto = $_REQUEST["codigoProducto"];
		$cantidad = $_REQUEST["cantidad"];
			
		$controller_Producto = new Controller_Producto();
		
		//Llamar la funcion que lista las categorias
		$resultProductos = $controller_Producto->AumentarStock($codigoProducto, $cantidad);	
		
		echo "<script>window.location.href = 'gestioninventarios.html';</script>";
	
	}
	
	
?>