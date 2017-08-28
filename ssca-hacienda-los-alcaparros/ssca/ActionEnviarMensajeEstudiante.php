<?php
	header("Access-Control-Allow-Origin: *");
	require_once '../ssca/db_connect1.php';
	include_once 'GCM.php';
    // connecting to db
    $db = new DB_CONNECT();
	
	$hora = date("H-i-s");
	$idestudiante = $_REQUEST["idestudiante"];
	$fecha = date("Y-m-d");
	$idruta = $_REQUEST["idruta"];
	$regId = "";
	$message = $_REQUEST["message"];
	
	$queryUsuario  = "SELECT * FROM `usuarios` WHERE `idUsuario`='$idestudiante'";
	$resultUsuario = mysql_query($queryUsuario);
	$registro = mysql_fetch_array($resultUsuario, MYSQL_ASSOC);
	$regId = $registro["gcm_regid"];	
	

	$gcm = new GCM();
 
	$registatoin_ids = array($regId);
	$mensaje = array(
	'message' 		=> $message, //mensaje a enviar
	'title'			=> 'SSCA',// Titulo de la notificación
	'msgcnt'		=> '3'
	);
	
	if($regId != ""){
		$result = $gcm->send_notification($registatoin_ids, $mensaje);
	}
	


	$queryAlerta  = "INSERT INTO `alertas` (`id`, `idUsuario`, `fecha`, `hora`, `mensaje`, `tipo`) VALUES (NULL, '$idestudiante', CURDATE(), curTime(), '$message', 'ALERTEAPP');";
	$resultAlerta = mysql_query($queryAlerta);
					
	echo '[{"resultadMensaje":"' . $resultAlerta . '","resultadoNotificacion":"1","Mensaje":"Se envio Correctamente el mensaje", "codigo":"1"}]';
?>