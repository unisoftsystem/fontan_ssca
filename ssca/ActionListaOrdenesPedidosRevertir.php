
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_OrdenPedido.php');
	
	$resultCredenciales = ""; 
	$idUsuario = $_REQUEST["idUsuario"];	
	$estado = $_REQUEST["estado"];	
	$fechaInicial = $_REQUEST["fechaInicial"];	
	$fechaFinal = $_REQUEST["fechaFinal"];	
	$controller_OrdenPedido = new Controller_OrdenPedido();
	
	//Llamar la funcion que lista las categorias
	$resultOrdenPedido = $controller_OrdenPedido->ListarPedidosParaReversion($estado, $fechaInicial, $fechaFinal, $idUsuario);	
	
	echo $resultOrdenPedido;
	
	
	
	
?>