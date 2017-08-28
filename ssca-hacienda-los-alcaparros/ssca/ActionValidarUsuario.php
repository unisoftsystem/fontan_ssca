
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include(DIR_CONTROLLER . '/Controller_Usuario.php');
	require_once 'db_connect1.php';
	$db = new DB_CONNECT();
	
    
	$resultCredenciales = ""; 
		
	$controller_Usuario = new Controller_Usuario();

	$usuario = $_REQUEST["usuario"];
	$query  = "SELECT u.*, op.* FROM `ordenpedido` op, usuarios u WHERE op.`UbicacionPedido`='ENTREGA' AND u.idUsuario = op.idUsuario AND op.idCredencial = '$usuario'";
	$result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	//Llamar la funcion que crea un usuario
	
	if($numeroFilas > 0 ){
		if($controller_Usuario->ConsultarUsuarioPorCredencial($usuario) != "[]"){
			
			$resultUsuarioCredencial = $controller_Usuario->ConsultarUsuarioPorCredencial($usuario);
			echo $resultUsuarioCredencial;
			
		}else{
			echo "[]";
		}
	}else{
		echo "[]";
	}
	
	
?>