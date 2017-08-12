
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	require_once 'db_connect1.php';
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');

    // connecting to db
    $db = new DB_CONNECT();
    $controller_Credenciales = new Controller_Credenciales();
	
	$idAcudiente = $_REQUEST["idAcudiente"];
	$idEstudiante = $_REQUEST["idEstudiante"];
	$Tipo = $_REQUEST["Tipo"];
	$Fecha = date("Y-m-d");	
	$Hora = date("H:i:s");	
	$Log = $_REQUEST["Log"];
	$query = "";

	//Llamar la funcion que obtener la credencial teniendo un id de un usuario
	$idCredencial = $controller_Credenciales->ObtenerIdCredencial($idEstudiante);	

	
	if($Tipo == "PORVALOR"){
		$valor = str_replace(".", "", $Log);
		$querySelect = "SELECT * FROM `restriccion` WHERE `idEstudiante`='$idCredencial' AND `idAcudiente`='$idAcudiente' AND `Tipo`='PORVALOR'";
		$resultSelect = mysql_query($querySelect);
		$numeroFilas = mysql_num_rows($resultSelect);

		if($numeroFilas > 0){
			$queryUpdate = "UPDATE `restriccion` SET `Fecha`=CURDATE(),`Hora`=curTime(),`Log`='$valor' WHERE `idEstudiante`='$idCredencial' AND `idAcudiente`='$idAcudiente' AND `Tipo`='PORVALOR'";
			$resultUpdate = mysql_query($queryUpdate);
			echo $resultUpdate;
		}else{
			$query = "INSERT INTO `restriccion`(`idAcudiente`, `idEstudiante`, `Tipo`, `Fecha`, `Hora`, `Log`) VALUES ('$idAcudiente','$idCredencial','$Tipo',CURDATE(),curTime(),'$valor')";
			$result = mysql_query($query);
			echo $result;
		}
		
		
	}else{
		$query = "INSERT INTO `restriccion`(`idAcudiente`, `idEstudiante`, `Tipo`, `Fecha`, `Hora`, `Log`) VALUES ('$idAcudiente','$idCredencial','$Tipo',CURDATE(),curTime(),'$Log')";
		$result = mysql_query($query);
		echo $result;
	}
	
	
    //

	//echo $result;

	
?>