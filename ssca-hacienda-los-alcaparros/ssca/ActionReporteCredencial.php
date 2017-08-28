
<?php 
	header("Access-Control-Allow-Origin: *");
	
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
	
	$resultCredenciales = ""; 
	
	//Se crean los objetos para llamar las funciones creadas en los controles que realizan las operaciones en la base de datos
	$controller_Credenciales = new Controller_Credenciales();

	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$idAlumno = $_REQUEST["idAlumno"];
	$idAcudiente = $_REQUEST["idAcudiente"];
	
	//Llamar la funcion que obtener la credencial teniendo un id de un usuario
	$resultCredencial = $controller_Credenciales->ReporteCredencial($idAcudiente, $idAlumno);	
	
	echo $resultCredencial;
	
?>