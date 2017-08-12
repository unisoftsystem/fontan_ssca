<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	define('UPLOAD_DIR', 'images/');
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	$contador = 1;
	$tipofuncionario = $_REQUEST["tipofuncionario"];
	$valorsubsidio = $_REQUEST["valorsubsidio"];
	
	$query  = "SELECT * FROM `subsidios_funcionarios` WHERE `tipo`='".$tipofuncionario."'";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	
	if($numeroFilas == 0){
		$queryInsert  = "INSERT INTO `subsidios_funcionarios`(`tipo`, `valor`) VALUES ('$tipofuncionario','$valorsubsidio')";
    	$resultInsert = mysql_query($queryInsert);
		echo $resultInsert;
	}else{
		$queryUpdate  = "UPDATE `subsidios_funcionarios` SET `tipo`='$tipofuncionario',`valor`='$valorsubsidio' WHERE `tipo`='".$tipofuncionario."'";
    	$resultUpdate = mysql_query($queryUpdate);
		echo $resultUpdate;
	}
	
	

	
?>