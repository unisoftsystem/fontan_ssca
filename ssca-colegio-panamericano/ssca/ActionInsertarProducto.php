
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIRDATA", "Data");
	define("DIR_DATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	define('UPLOAD_DIR', 'images/');
	
	include_once(DIR_DATA . '/DataProducto.php');
	include_once(DIR_CONTROLLER . '/Controller_Producto.php');
	
	$dataProducto = new DataProducto();
	
	$controller_Producto = new Controller_Producto();
	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$nombreProducto = $_REQUEST["nombreProducto"];	
	$descripcion = $_REQUEST["descripcion"];	
	$valorUnitario = $_REQUEST["valorUnitario"];	
	$tiempo = $_REQUEST["tiempo"];
	$tiempoc = $_REQUEST["tiempoc"];
	$edad = $_REQUEST["edad"];	
	$edadMinima = $_REQUEST["edadMinima"];	
	$categoria = $_REQUEST["categoria"];	
	$subcategoria = $_REQUEST["subcategoria"];	
	$stock = $_REQUEST["stock"];	
	$estado = $_REQUEST["estado"];	
	$uidFoto = uniqid();
	$file = $_REQUEST["file"];
	$cantidad = str_replace(".", "", $stock);	
	/*
		Setear los datos del usuario en un objeto
	*/
	//$dataProducto->setCodigoProducto($tipoId);	
	$dataProducto->setNombreProducto($nombreProducto);
	$dataProducto->setDescripcion($descripcion);
	$dataProducto->setValorUnitario($valorUnitario);
	$dataProducto->setTiempo($tiempo);
	$dataProducto->setTiempoc($tiempoc);
	$dataProducto->setEdad($edad);
	$dataProducto->setEdadMinima($edadMinima);
	$dataProducto->setCategoria($categoria);
	$dataProducto->setSubcategoria($subcategoria);
	$dataProducto->setStock($cantidad);
	$dataProducto->setEstado($estado);	
	$dataProducto->setImagen("images/" . $file);
	
	//Llamar la funcion que crea un producto
	$resultProductoNuevo = $controller_Producto->CrearProducto($dataProducto);	
	echo $resultProductoNuevo;
?>