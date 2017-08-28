<?php
	header("Access-Control-Allow-Origin: *");
	require_once '../ssca/db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	
	$idestudiante = $_REQUEST["idestudiante"];
	
	$queryAlertaLlego = "SELECT * FROM `alertas` WHERE `idUsuario`='$idestudiante' AND `fecha`=CURDATE() AND `mensaje`='Ruta ha llegado' AND `tipo`='ALERTEAPPNOTIFICACION'";
	$resultAlertaLlego = mysql_query($queryAlertaLlego);
	$numeroFilasLlego = mysql_num_rows($resultAlertaLlego);

	$queryAlertaEspera = "SELECT * FROM `alertas` WHERE `idUsuario`='$idestudiante' AND `fecha`=CURDATE() AND `mensaje`='Te estamos esperando' AND `tipo`='ALERTEAPPNOTIFICACION'";
	$resultAlertaEspera = mysql_query($queryAlertaEspera);
	$numeroFilasEspera= mysql_num_rows($resultAlertaEspera);

	$queryAlertaPartido= "SELECT * FROM `alertas` WHERE `idUsuario`='$idestudiante' AND `fecha`=CURDATE() AND `mensaje`='Ruta ha partido' AND `tipo`='ALERTEAPPNOTIFICACION'";
	$resultAlertaPartido= mysql_query($queryAlertaPartido);
	$numeroFilasPartido = mysql_num_rows($resultAlertaPartido);
					
	echo '[{"resultadoLlego":"' . $numeroFilasLlego . '","resultadoEspera":"' . $numeroFilasEspera . '","resultadoPartido":"' . $numeroFilasPartido . '", "codigo":"1"}]';
?>