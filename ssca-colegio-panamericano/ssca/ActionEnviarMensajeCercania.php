<?php
	header("Access-Control-Allow-Origin: *");
	require_once '../ssca/db_connect1.php';
	include_once 'GCM.php';
    // connecting to db
    $db = new DB_CONNECT();
	
	$hora = $_REQUEST["horaActual"];
	$idestudiante = $_REQUEST["idestudiante"];
	$fecha = $_REQUEST["fecha"];
	$idruta = $_REQUEST["idruta"];
	$regId = $_REQUEST["regId"];
    $distancia = $_REQUEST["distancia"];
	$tiempoLlegada = $_REQUEST["tiempoLlegada"];
	$coordenadas = $_REQUEST["coordenadas"];
	$message = "El bus esta cerca de sus casa. Se encuentra a " . $distancia/* . " y llegara a proximadamente en " . $tiempoLlegada*/;
	
	$query  = "SELECT * FROM `log_ruta` WHERE `idestudiante`='$idestudiante' AND `fecha`='$fecha' AND `tipo`='MENSAJECERCANO' AND `idruta`='$idruta'";
	$resultSelect = mysql_query($query);
	$numeroFilas = mysql_num_rows($resultSelect);
	if($numeroFilas == 0){
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
	 	
		$queryMensaje  = "INSERT INTO `log_ruta`(`id`, `idestudiante`, `coordenadas_recogida`, `tipo`, `idruta`, `fecha`, `hora`, `mensaje`) VALUES (NULL,'$idestudiante','$coordenadas','MENSAJECERCANO','$idruta','$fecha','$hora','Mensaje a la APP del estudiante')";
		$resultMensaje = mysql_query($queryMensaje);
		
		$queryAlerta  = "INSERT INTO `alertas` (`id`, `idUsuario`, `fecha`, `hora`, `mensaje`, `tipo`) VALUES (NULL, '$idestudiante', '$fecha', '$hora', '$mensaje', 'ALERTEAPP');";
		$resultAlerta = mysql_query($queryAlerta);
						
    	echo '[{"resultadMensaje":"' . $resultMensaje . '","resultadoNotificacion":"1","Mensaje":"Se envio Correctamente el mensaje", "codigo":"1"}]';
	}else{
		if($numeroFilas > 0){
			echo '[{"resultadMensaje":"0","resultadoNotificacion":"0","Mensaje":"No se pudo enviar el mensaje, ya se envio hoy un mensaje", "codigo":"0"}]';
		}
	}
	//echo $numeroFilas;
?>