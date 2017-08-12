
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIRDATA", "Data");
	define("DIR_DATA", "Data");
	define("DIR_CONTROLLER", "Controller");

	include_once(DIR_DATA . '/DataCredenciales.php');
	include_once(DIR_DATA . '/DataUsuario.php');
	include_once(DIR_DATA . '/DataRecogida.php');
	include_once(DIR_CONTROLLER . '/Controller_Recogida.php');
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
	include_once(DIR_DATA . '/DataRegistroControl.php');
	include_once(DIR_CONTROLLER . '/Controller_Usuario.php');
	include(DIR_CONTROLLER . '/Controller_Monitor.php');
	
	$dataUsuario = new DataUsuario();
	$dataCredenciales = new DataCredenciales();
	$dataRecogida = new DataRecogida();
	
	$controller_Recogida = new Controller_Recogida();
	$controller_Usuario = new Controller_Usuario();
	$controller_Credenciales = new Controller_Credenciales();
	$controller_Monitor = new Controller_Monitor();
	
	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$latitud = $_REQUEST["latitud"];	
	$longitud = $_REQUEST["longitud"];
	$idCredencial = $_REQUEST["idCredencial"];
	$fecha = date("Y-m-d");	
	$hora = date("H:i:s");	
	$tipo = $_REQUEST["tipo"];	
	$idRuta = $_REQUEST["idRuta"];
	require_once 'db_connect1.php';
	// connecting to db
	$db = new DB_CONNECT();
	/*
		Obtener datos necesarios
	*/
	$idUsuario = $controller_Credenciales->ObtenerIdUsuario($idCredencial);	
	$resultUsuarioCredencial = $controller_Usuario->ConsultarUsuarioPorCredencial($idCredencial);
	
	if($resultUsuarioCredencial != "[]"){
		$jsonUsuario = json_decode($resultUsuarioCredencial, true);
		
		if($jsonUsuario[0]["tipoUsuario"] == "Estudiante"){
			if(ExisteUsuario($idRuta, $idUsuario, $fecha)){
				$dato = explode("-", $fecha);  
				$mes = $dato[1];  
				$year = $dato[0];  
				$NumeroId = $jsonUsuario[0]["numeroId"];
				/*$condicion = "pago ruta " . ObtenerMes($mes) . " " . $year;
				
				$queryServicio  = "SELECT * FROM `asignacion_servicios` WHERE `tipo_servicio`='$condicion' AND `numero_identificacion`='$NumeroId'";
				$resultServicio = mysql_query($queryServicio);
				$numeroRegistros = mysql_num_rows($resultServicio);
				
				if($numeroRegistros > 0){*/
					switch ($tipo) {
						case "RECOGIDA":
							$queryServicio  = "SELECT * FROM `log_ruta` WHERE `tipo`='RECOGIDA' AND `idruta`='$idRuta' AND `fecha`='$fecha'";
							$resultServicio = mysql_query($queryServicio);
							$numeroRegistros = mysql_num_rows($resultServicio);

							$_queryServicio  = "SELECT * FROM `usuarios` WHERE `NumeroId`='$NumeroId'";
							$_resultServicio = mysql_query($_queryServicio);
							$_numeroRegistros = mysql_num_rows($_resultServicio);
							
							if($numeroRegistros == 0 && $_numeroRegistros == 1){

								$latitudUsuario = $jsonUsuario[0]["latitud"];
								$longitudUsuario = $jsonUsuario[0]["longitud"];
								
								$point1 = array("lat" =>  $latitudUsuario, "long" => $longitudUsuario ); 
								$point2 = array("lat" => $latitud, "long" => $longitud); 
								$km = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long']); // Calcular la distancia en kilómetros (por defecto)
					
								if($km > 1){
									$coordenadas = $latitud . "," . $longitud;
									
									$query  = "INSERT INTO `log_ruta`(`id`, `idestudiante`, `coordenadas_recogida`, `tipo`, `idruta`, `fecha`, `hora`, `mensaje`) VALUES (NULL,'$idUsuario','$coordenadas','$tipo','$idRuta','$fecha','$hora','Fue recogido en un sitio diferente')";
									$result = mysql_query($query);
									
									$jsonUsuario[0]["Mensaje"] = "Fue recogido en un sitio diferente";
									$jsonUsuario[0]["CodigoConfirmacion"] = "1";
									$jsonUsuario[0]["TipoRegistro"] = $tipo;
									
									// El mensaje
									$mensaje = '<style type="text/css">
										*{
											margin: 0;
											padding: 0;
										}
										.btn-primary {
										    
										}
										.btn {
										    
										}
									</style>
									<img src="http://190.60.211.17/Fontan/img/parte-a-recogida.png" width="100%"/>
									<img src="http://190.60.211.17/Fontan/img/parte-b-recogida.png" width="50%" style="float: left">
									<div align="center" style="width: 50%; float: right">
										<label style="font-size: 22px; color: #FFBF00; font-weight: 500">A trav&eacute;s de nuestro servicio de comunicaci&oacute;n y alertas de SSCA nos permitimos informar muy gratamente que el estudiante <b><i>' . $jsonUsuario[0]["primerNombre"] . " " . $jsonUsuario[0]["segundoNombre"] . " " . $jsonUsuario[0]["primerApellido"] . " " . $jsonUsuario[0]["segundoApellido"] . '</i></b>  fue recogido y ya se encuentra en nuestro bus escolar</label><br>
										<a href="http://190.60.211.17/Fontan/index.php/rutas/contactenos?email=' + $jsonUsuario[0]["idAcudiente"] + '&name=' . $jsonUsuario[0]["primerNombre"] . " " . $jsonUsuario[0]["segundoNombre"] . " " . $jsonUsuario[0]["primerApellido"] . " " . $jsonUsuario[0]["segundoApellido"] . '" target="_blank"><button type="button" id="btnGenerarReporte" style="width: 90%; margin-top:	20px; padding: 12px 12px;
										    margin-bottom: 0;
										    font-size: 18px;
										    font-weight: 400;
										    line-height: 1.42857143;
										    text-align: center;
										    white-space: nowrap;
										    vertical-align: middle;
										    -ms-touch-action: manipulation;
										    touch-action: manipulation;
										    cursor: pointer;
										    -webkit-user-select: none;
										    -moz-user-select: none;
										    -ms-user-select: none;
										    user-select: none;
										    border: 1px solid transparent;color: #fff;
										    background-image: url(http://190.60.211.17/Fontan/img/textura.png);"><b>CONTACTESE CON NOSOTROS</b></button></a>
									</div>
									<div style="width:100%" align="center">
										<hr width="98%" size="8" style="background-image: url(http://190.60.211.17/Fontan/img/azul.png); margin-top:35px; border: none">	
									</div>
									<table width="100%" border="0">
										<tr>
											<td width="20px">&nbsp;</td>
											<td><label style="color: #2E64FE; ">Cont&aacute;ctenos: 0180001124587 Bogot&aacute; Colombia</label></td>
											<td><img src="http://190.60.211.17/Fontan/img/tel.png" width="36px"></td>
											<td>
												<div style="width: 100%">
													<a target="_blank" href="https://www.facebook.com/SSCA-535192806677054/"><img src="http://190.60.211.17/Fontan/img/facebook_C.png" width="36px" style="opacity: 1"></a>
							                        <a target="_blank" href="https://twitter.com/sscacolombia"><img src="http://190.60.211.17/Fontan/img/Twitter_C.png" width="36px"></a>
							                        <a target="_blank" href="https://www.youtube.com/channel/UCkZ6kVJWgmS9vQJ3_mK5NAA"><img src="http://190.60.211.17/Fontan/img/Youtube_C.png" width="36px"></a>
							                        <a target="_blank" href="https://plus.google.com/109158087234743471968"><img src="http://190.60.211.17/Fontan/img/google_C.png" width="36px"></a>  
												</div>
											</td>
										</tr>
									</table>';										
									
									// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
									$email_to = $jsonUsuario[0]["idAcudiente"];
									$email_subject = "Informe Ingreso a Ruta Escolar";
									
									
									//$mail->Host = "localhost";
									//$mail->Port = "25";
									// Ahora se envía el e-mail usando la función mail() de PHP
									
									$headers = 'MIME-Version: 1.0' . "\r\n";
									$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
									$headers .= "From: SSCA – Servicios Escolares Colegio Fontán<ruta@ssca.com>";
									$bool = mail($email_to, $email_subject, $mensaje, $headers);
									
									$queryAlerta  = "INSERT INTO `alertas` (`id`, `idUsuario`, `fecha`, `hora`, `mensaje`, `tipo`) VALUES (NULL, '$idUsuario', '$fecha', '$hora', '$mensaje', 'ALERTEACORREO');";
									$resultAlerta = mysql_query($queryAlerta);
									
									echo json_encode($jsonUsuario);
									
								}else{
									
									$coordenadas = $latitud . "," . $longitud;
									
									// connecting to db
									
									$query  = "INSERT INTO `log_ruta`(`id`, `idestudiante`, `coordenadas_recogida`, `tipo`, `idruta`, `fecha`, `hora`, `mensaje`) VALUES (NULL,'$idUsuario','$coordenadas','$tipo','$idRuta','$fecha','$hora','Fue recogido correctamente')";
									$result = mysql_query($query);
									
									$jsonUsuario[0]["Mensaje"] = "Fue recogido correctamente";
									$jsonUsuario[0]["CodigoConfirmacion"] = "1";
									$jsonUsuario[0]["TipoRegistro"] = $tipo;								

									// El mensaje
									$mensaje = '<style type="text/css">
										*{
											margin: 0;
											padding: 0;
										}
										.btn-primary {
										    
										}
										.btn {
										    
										}
									</style>
									<img src="http://190.60.211.17/Fontan/img/parte-a-recogida.png" width="100%"/>
									<img src="http://190.60.211.17/Fontan/img/parte-b-recogida.png" width="50%" style="float: left">
									<div align="center" style="width: 50%; float: right">
										<label style="font-size: 22px; color: #FFBF00; font-weight: 500">A trav&eacute;s de nuestro servicio de comunicaci&oacute;n y alertas de SSCA nos permitimos informar muy gratamente que el estudiante <b><i>' . $jsonUsuario[0]["primerNombre"] . " " . $jsonUsuario[0]["segundoNombre"] . " " . $jsonUsuario[0]["primerApellido"] . " " . $jsonUsuario[0]["segundoApellido"] . '</i></b>  fue recogido y ya se encuentra en nuestro bus escolar</label><br>
										<a href="http://190.60.211.17/Fontan/index.php/rutas/contactenos?email=' + $jsonUsuario[0]["idAcudiente"] + '&name=' . $jsonUsuario[0]["primerNombre"] . " " . $jsonUsuario[0]["segundoNombre"] . " " . $jsonUsuario[0]["primerApellido"] . " " . $jsonUsuario[0]["segundoApellido"] . '" target="_blank"><button type="button" id="btnGenerarReporte" style="width: 90%; margin-top:	20px; padding: 12px 12px;
										    margin-bottom: 0;
										    font-size: 18px;
										    font-weight: 400;
										    line-height: 1.42857143;
										    text-align: center;
										    white-space: nowrap;
										    vertical-align: middle;
										    -ms-touch-action: manipulation;
										    touch-action: manipulation;
										    cursor: pointer;
										    -webkit-user-select: none;
										    -moz-user-select: none;
										    -ms-user-select: none;
										    user-select: none;
										    border: 1px solid transparent;color: #fff;
										    background-image: url(http://190.60.211.17/Fontan/img/textura.png);"><b>CONTACTESE CON NOSOTROS</b></button></a>
									</div>
									<div style="width:100%" align="center">
										<hr width="98%" size="8" style="background-image: url(http://190.60.211.17/Fontan/img/azul.png); margin-top:35px; border: none">	
									</div>
									<table width="100%" border="0">
										<tr>
											<td width="20px">&nbsp;</td>
											<td><label style="color: #2E64FE; ">Cont&aacute;ctenos: 0180001124587 Bogot&aacute; Colombia</label></td>
											<td><img src="http://190.60.211.17/Fontan/img/tel.png" width="36px"></td>
											<td>
												<div style="width: 100%">
													<a target="_blank" href="https://www.facebook.com/SSCA-535192806677054/"><img src="http://190.60.211.17/Fontan/img/facebook_C.png" width="36px" style="opacity: 1"></a>
							                        <a target="_blank" href="https://twitter.com/sscacolombia"><img src="http://190.60.211.17/Fontan/img/Twitter_C.png" width="36px"></a>
							                        <a target="_blank" href="https://www.youtube.com/channel/UCkZ6kVJWgmS9vQJ3_mK5NAA"><img src="http://190.60.211.17/Fontan/img/Youtube_C.png" width="36px"></a>
							                        <a target="_blank" href="https://plus.google.com/109158087234743471968"><img src="http://190.60.211.17/Fontan/img/google_C.png" width="36px"></a>  
												</div>
											</td>
										</tr>
									</table>';	
									
									// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
									$email_to = $jsonUsuario[0]["idAcudiente"];
									$email_subject = "Informe Ingreso a Ruta Escolar";
									
									
									//$mail->Host = "localhost";
									//$mail->Port = "25";
									// Ahora se envía el e-mail usando la función mail() de PHP
									$headers = 'MIME-Version: 1.0' . "\r\n";
									$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
									$headers .= "From: SSCA – Servicios Escolares Colegio Fontán<ruta@ssca.com>";
									$bool = mail($email_to, $email_subject, $mensaje, $headers);
									
									echo json_encode($jsonUsuario);
									
								}
							}else{
								$jsonUsuario[0]["Mensaje"] = "El estudiante ya se ha recogido el dia de hoy en esta ruta";
								$jsonUsuario[0]["CodigoConfirmacion"] = "0";
								$jsonUsuario[0]["TipoRegistro"] = $tipo;
								echo json_encode($jsonUsuario);
							}
							break;

						case "BAJADA":
							$queryServicio  = "SELECT * FROM `log_ruta` WHERE `tipo`='BAJADA' AND `idruta`='$idRuta' AND `fecha`='$fecha'";
							$resultServicio = mysql_query($queryServicio);
							$numeroRegistros = mysql_num_rows($resultServicio);

							$_queryServicio  = "SELECT * FROM `usuarios` WHERE `NumeroId`='$NumeroId'";
							$_resultServicio = mysql_query($_queryServicio);
							$_numeroRegistros = mysql_num_rows($_resultServicio);
							
							if($numeroRegistros == 0 && $_numeroRegistros == 1){
								$queryValidar = "SELECT * FROM `log_ruta` WHERE `tipo`='RECOGIDA' AND `idruta`='$idRuta' AND `fecha`='$fecha' AND `idestudiante`='$idUsuario'";
									$resultValidar = mysql_query($queryValidar);
									$numeroRegistrosValidar = mysql_num_rows($resultValidar);
									
								if($numeroRegistrosValidar != 0){
									$coordenadas = $latitud . "," . $longitud;
									
									// connecting to db
									
									$query  = "INSERT INTO `log_ruta`(`id`, `idestudiante`, `coordenadas_recogida`, `tipo`, `idruta`, `fecha`, `hora`, `mensaje`) VALUES (NULL,'$idUsuario','$coordenadas','$tipo','$idRuta','$fecha','$hora','Bajo del bus sin ningun inconveniente')";
									$result = mysql_query($query);
									
									$jsonUsuario[0]["Mensaje"] = "Bajo del bus sin ningun inconveniente";
									$jsonUsuario[0]["CodigoConfirmacion"] = "1";
									$jsonUsuario[0]["TipoRegistro"] = $tipo;
									
									// El mensaje
									$mensaje = '<style type="text/css">
										*{
											margin: 0;
											padding: 0;
										}
										.btn-primary {
										    
										}
										.btn {
										    
										}
									</style>
									<img src="http://190.60.211.17/Fontan/img/parte-a-recogida.png" width="100%"/>
									<img src="http://190.60.211.17/Fontan/img/parte-b-recogida.png" width="50%" style="float: left">
									<div align="center" style="width: 50%; float: right">
										<label style="font-size: 22px; color: #FFBF00; font-weight: 500">A trav&eacute;s de nuestro servicio de comunicaci&oacute;n y alertas de SSCA nos permitimos informar muy gratamente que el estudiante <b><i>' . $jsonUsuario[0]["primerNombre"] . " " . $jsonUsuario[0]["segundoNombre"] . " " . $jsonUsuario[0]["primerApellido"] . " " . $jsonUsuario[0]["segundoApellido"] . '</i></b> ha llegado a su destino</label><br>
										<a href="http://190.60.211.17/Fontan/index.php/rutas/contactenos?email=' + $jsonUsuario[0]["idAcudiente"] + '&name=' . $jsonUsuario[0]["primerNombre"] . " " . $jsonUsuario[0]["segundoNombre"] . " " . $jsonUsuario[0]["primerApellido"] . " " . $jsonUsuario[0]["segundoApellido"] . '" target="_blank"><button type="button" id="btnGenerarReporte" style="width: 90%; margin-top:	20px; padding: 12px 12px;
										    margin-bottom: 0;
										    font-size: 18px;
										    font-weight: 400;
										    line-height: 1.42857143;
										    text-align: center;
										    white-space: nowrap;
										    vertical-align: middle;
										    -ms-touch-action: manipulation;
										    touch-action: manipulation;
										    cursor: pointer;
										    -webkit-user-select: none;
										    -moz-user-select: none;
										    -ms-user-select: none;
										    user-select: none;
										    border: 1px solid transparent;color: #fff;
										    background-image: url(http://190.60.211.17/Fontan/img/textura.png);"><b>CONTACTESE CON NOSOTROS</b></button></a>
									</div>
									<div style="width:100%" align="center">
										<hr width="98%" size="8" style="background-image: url(http://190.60.211.17/Fontan/img/azul.png); margin-top:35px; border: none">	
									</div>
									<table width="100%" border="0">
										<tr>
											<td width="20px">&nbsp;</td>
											<td><label style="color: #2E64FE; ">Cont&aacute;ctenos: 0180001124587 Bogot&aacute; Colombia</label></td>
											<td><img src="http://190.60.211.17/Fontan/img/tel.png" width="36px"></td>
											<td>
												<div style="width: 100%">
													<a target="_blank" href="https://www.facebook.com/SSCA-535192806677054/"><img src="http://190.60.211.17/Fontan/img/facebook_C.png" width="36px" style="opacity: 1"></a>
							                        <a target="_blank" href="https://twitter.com/sscacolombia"><img src="http://190.60.211.17/Fontan/img/Twitter_C.png" width="36px"></a>
							                        <a target="_blank" href="https://www.youtube.com/channel/UCkZ6kVJWgmS9vQJ3_mK5NAA"><img src="http://190.60.211.17/Fontan/img/Youtube_C.png" width="36px"></a>
							                        <a target="_blank" href="https://plus.google.com/109158087234743471968"><img src="http://190.60.211.17/Fontan/img/google_C.png" width="36px"></a>  
												</div>
											</td>
										</tr>
									</table>';									
										
										// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
										$email_to = $jsonUsuario[0]["idAcudiente"];
										$email_subject = "Informe Ruta Escolar llegada a Destino";
										
										
										//$mail->Host = "localhost";
										//$mail->Port = "25";
										// Ahora se envía el e-mail usando la función mail() de PHP
										$headers = 'MIME-Version: 1.0' . "\r\n";
										$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
										$headers .= "From: SSCA – Servicios Escolares Colegio Fontán<ruta@ssca.com>";
										$bool = mail($email_to, $email_subject, $mensaje, $headers);
									
									echo json_encode($jsonUsuario);
								}else{
									$jsonUsuario[0]["Mensaje"] = "El estudiante no se ha recogido el dia de hoy en esta ruta";
									$jsonUsuario[0]["CodigoConfirmacion"] = "0";
									$jsonUsuario[0]["TipoRegistro"] = $tipo;
									echo json_encode($jsonUsuario);
								}
							}else{
								$jsonUsuario[0]["Mensaje"] = "El estudiante ya se ha entregado el dia de hoy en esta ruta";
								$jsonUsuario[0]["CodigoConfirmacion"] = "0";
								$jsonUsuario[0]["TipoRegistro"] = $tipo;
								echo json_encode($jsonUsuario);
							}
							break;
						
						default:
							# code...
							break;
					}
					
			
						
				
				
			}else{
				$jsonUsuario[0]["Mensaje"] = "El estudiante no esta asignado a esta ruta";
				$jsonUsuario[0]["CodigoConfirmacion"] = "0";
				$jsonUsuario[0]["TipoRegistro"] = $tipo;
				echo json_encode($jsonUsuario);
			}
		}else{
				$jsonUsuario[0]["Mensaje"] = "No es estudiante";
				$jsonUsuario[0]["CodigoConfirmacion"] = "0";
				$jsonUsuario[0]["TipoRegistro"] = $tipo;
				echo json_encode($jsonUsuario);
			}
	}else{
		echo $resultUsuarioCredencial;
	}
	
	
	function ExisteUsuario($idRuta, $idUsuario, $fecha){
		$controller_Monitor = new Controller_Monitor();
		$resultUsuarios = $controller_Monitor->ListarEstudiantesRuta($idRuta, $fecha);
		$jsonEstudiantes = json_decode($resultUsuarios, true);
		$existe = false;
		
		for($i = 0; $i < count($jsonEstudiantes); $i++){
			if($jsonEstudiantes[$i]["usuario"] == $idUsuario){
				$existe = true;
			}
		}
		return $existe;
	}
	
	function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
		// Cálculo de la distancia en grados
		$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
	 
		// Conversión de la distancia en grados a la unidad escogida (kilómetros, millas o millas naúticas)
		switch($unit) {
			case 'km':
				$distance = $degrees * 111.13384; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
				break;
			case 'mi':
				$distance = $degrees * 69.05482; // 1 grado = 69.05482 millas, basándose en el diametro promedio de la Tierra (7.913,1 millas)
				break;
			case 'nmi':
				$distance =  $degrees * 59.97662; // 1 grado = 59.97662 millas naúticas, basándose en el diametro promedio de la Tierra (6,876.3 millas naúticas)
		}
		return round($distance, $decimals);
	}
	function ObtenerMes($mes){
		$mesLetras = "";
		switch($mes){
			case "01":
				$mesLetras = "Enero";
				break;
			case "02":
				$mesLetras = "Febrero";
				break;
			case "03":
				$mesLetras = "Marzo";
				break;
			case "04":
				$mesLetras = "Abril";
				break;
			case "05":
				$mesLetras = "Mayo";
				break;
			case "06":
				$mesLetras = "Junio";
				break;
			case "07":
				$mesLetras = "Julio";
				break;
			case "08":
				$mesLetras = "Agosto";
				break;
			case "09":
				$mesLetras = "Septiembre";
				break;
			case "10":
				$mesLetras = "Obtubre";
				break;
			case "11":
				$mesLetras = "Noviembre";
				break;
			case "12":
				$mesLetras = "Diciembre";
				break;
		}
		return $mesLetras;
	}

	
?>
