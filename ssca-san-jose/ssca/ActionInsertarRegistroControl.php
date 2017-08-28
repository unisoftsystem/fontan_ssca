
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIRDATA", "Data");
	define("DIR_DATA", "Data");
	define("DIR_CONTROLLER", "Controller");

	
	include_once(DIR_DATA . '/DataCredenciales.php');
	include_once(DIR_DATA . '/DataUsuario.php');
	include_once(DIR_DATA . '/DataRegistroControl.php');
	include_once(DIR_CONTROLLER . '/Controller_Usuario.php');
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
	include_once(DIR_CONTROLLER . '/Controller_RegistroControl.php');
	include_once(DIR_CONTROLLER . '/Controller_Horario.php');
	include_once(DIR_CONTROLLER . '/Controller_Permiso.php');
	
	$dataUsuario = new DataUsuario();
	$dataCredenciales = new DataCredenciales();
	$dataRegistroControl = new DataRegistroControl();
	
	$controller_Usuario = new Controller_Usuario();
	$controller_Credenciales = new Controller_Credenciales();
	$controller_RegistroControl = new Controller_RegistroControl();
	$controller_Horario = new Controller_Horario();
	$controller_Permiso = new Controller_Permiso();

	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$idCredencial = $_POST["idCredencial"];
	$fecha = date("Y-m-d");	
	$hora = date("H:i:s");	
	
	/*
		Obtener datos necesarios
	*/
	$idUsuario = $controller_Credenciales->ObtenerIdUsuario($idCredencial);	
	$resultUsuarioCredencial = $controller_Usuario->ConsultarUsuarioPorCredencial($idCredencial);
	$jsonUsuario = json_decode($resultUsuarioCredencial, true);
	
	//foreach ($jsonUsuario as $data) {
		//print_r($jsonHorario[0]["HoraSalida"]);
		//print_r($jsonUsuario[0]["tipoUsuario"]);
	//}
	if($resultUsuarioCredencial != "[]"){
		if($jsonUsuario[0]["tipoUsuario"] == "Estudiante"){
			
			$hora1 = strtotime( $hora );
			$hora2 = strtotime( "15:00:00" );
			/*
				if($resultUsuarioCredencial != "[]"){
					$dataRegistroControl->setIdCredencial($idCredencial);
					$dataRegistroControl->setIdUsuario($idUsuario);
					$dataRegistroControl->setFecha($fecha);
					$dataRegistroControl->setHora($hora);
					$email_message = "";
					$resultExisteResgistroEntrada = $controller_RegistroControl->ExisteEntradaUltima($idCredencial);
					if($resultExisteResgistroEntrada){
						$dataRegistroControl->setTipo("SALIDA");
						$jsonUsuario[0]["TipoRegistro"]="SALIDA";
						$jsonUsuario[0]["CodigoConfirmacion"]="1";
						
						$email_message = "El estudiante " . $jsonUsuario[0]["primerNombre"] . " " . $jsonUsuario[0]["segundoNombre"] . " " . $jsonUsuario[0]["primerApellido"] . " " . $jsonUsuario[0]["segundoApellido"] . " ya se subio al bus a las " . $hora;
					}else{
						$dataRegistroControl->setTipo("ENTRADA");
						$jsonUsuario[0]["TipoRegistro"]="ENTRADA";
						$jsonUsuario[0]["CodigoConfirmacion"]="1";
						
						$email_message = "El estudiante " . $jsonUsuario[0]["primerNombre"] . " " . $jsonUsuario[0]["segundoNombre"] . " " . $jsonUsuario[0]["primerApellido"] . " " . $jsonUsuario[0]["segundoApellido"] . " ya se bajo al bus a las " . $hora;
					}
					
					//Llamar la funcion que crea un registro
					$resultResgistroNuevo = $controller_RegistroControl->CrearRegistroControl($dataRegistroControl);	
					
					$email_to = $jsonUsuario[0]["idAcudiente"];
					$email_subject = "Ruta Escolar";
					
					// Ahora se envía el e-mail usando la función mail() de PHP
					$headers = "From: inforuta@181.55.254.193\r\n".
					'X-Mailer: PHP/' . phpversion();
					@mail($email_to, $email_subject, $email_message, $headers);
					
					echo json_encode($jsonUsuario);
				}else{
					echo $resultUsuarioCredencial;
				}
			*/
			//print_r($json->HoraSalida);
				
				if($resultUsuarioCredencial != "[]"){
					$resultExisteResgistroEntrada = $controller_RegistroControl->ExisteEntradaUltima($idCredencial);
					//echo $resultExisteResgistroEntrada;
					if($resultExisteResgistroEntrada == true){
						
						if( $hora1 < $hora2 ) {
							$resultExistePermiso = $controller_Permiso->ObtenerHoraPermiso($idUsuario, $fecha);
							if($resultExistePermiso != ""){
								$horaUsuario = strtotime( $hora );
								$horaPermiso = strtotime( $resultExistePermiso );
								
								if( $horaUsuario >= $horaPermiso ) {
									$dataRegistroControl->setIdCredencial($idCredencial);
									$dataRegistroControl->setIdUsuario($idUsuario);
									$dataRegistroControl->setFecha($fecha);
									$dataRegistroControl->setHora($hora);
									$dataRegistroControl->setTipo("SALIDA");
									//echo "SALIDA";
									$jsonUsuario[0]["TipoRegistro"]="SALIDA";
									$jsonUsuario[0]["CodigoConfirmacion"]="1";
									//array_push($jsonHorario, $jsonHorario[0]["TipoRegistro"]=>"SALIDA");
									
									//Llamar la funcion que crea un registro
									$resultResgistroNuevo = $controller_RegistroControl->CrearRegistroControl($dataRegistroControl);	
									//echo json_encode($jsonHorario);
									//echo json_encode($jsonUsuario);
									echo json_encode($jsonUsuario);
								}else{
									$jsonUsuario[0]["TipoRegistro"]="SALIDA";
									$jsonUsuario[0]["CodigoConfirmacion"]="0";
									echo json_encode($jsonUsuario);
								}
							} else{
								$jsonUsuario[0]["TipoRegistro"]="SALIDA";
								$jsonUsuario[0]["CodigoConfirmacion"]="0";
								echo json_encode($jsonUsuario);
							}
							
						} else{
							$dataRegistroControl->setIdCredencial($idCredencial);
							$dataRegistroControl->setIdUsuario($idUsuario);
							$dataRegistroControl->setFecha($fecha);
							$dataRegistroControl->setHora($hora);
							$dataRegistroControl->setTipo("SALIDA");
							//echo "SALIDA";
							$jsonUsuario[0]["TipoRegistro"]="SALIDA";
							$jsonUsuario[0]["CodigoConfirmacion"]="1";
							//array_push($jsonHorario, $jsonHorario[0]["TipoRegistro"]=>"SALIDA");
							
							//Llamar la funcion que crea un registro
							$resultResgistroNuevo = $controller_RegistroControl->CrearRegistroControl($dataRegistroControl);	
							//echo json_encode($jsonHorario);
							echo json_encode($jsonUsuario);
						}
					}else{
						$dataRegistroControl->setIdCredencial($idCredencial);
						$dataRegistroControl->setIdUsuario($idUsuario);
						$dataRegistroControl->setFecha($fecha);
						$dataRegistroControl->setHora($hora);
						$dataRegistroControl->setTipo("ENTRADA");
						$jsonUsuario[0]["TipoRegistro"]="ENTRADA";
						$jsonUsuario[0]["CodigoConfirmacion"]="1";
						//array_push($jsonHorario[0]["TipoRegistro"], "ENTRADA");
						//echo "ENTRADA";
						$resultResgistroNuevo = $controller_RegistroControl->CrearRegistroControl($dataRegistroControl);	
						//Llamar la funcion que crea un registro
						//s = $controller_RegistroControl->CrearRegistroControl($dataRegistroControl);	
						//echo json_encode($jsonHorario);
						echo json_encode($jsonUsuario);
					}
					
				}else{
					echo $resultUsuarioCredencial;
				}
			
		}else{
			if($resultUsuarioCredencial != "[]"){
				$dataRegistroControl->setIdCredencial($idCredencial);
				$dataRegistroControl->setIdUsuario($idUsuario);
				$dataRegistroControl->setFecha($fecha);
				$dataRegistroControl->setHora($hora);
				
				$resultExisteResgistroEntrada = $controller_RegistroControl->ExisteEntradaUltima($idCredencial);
				if($resultExisteResgistroEntrada){
					$dataRegistroControl->setTipo("SALIDA");
					$jsonUsuario[0]["TipoRegistro"]="SALIDA";
					$jsonUsuario[0]["CodigoConfirmacion"]="1";
				}else{
					$dataRegistroControl->setTipo("ENTRADA");
					$jsonUsuario[0]["TipoRegistro"]="ENTRADA";
					$jsonUsuario[0]["CodigoConfirmacion"]="1";
				}
				
				//Llamar la funcion que crea un registro
				$resultResgistroNuevo = $controller_RegistroControl->CrearRegistroControl($dataRegistroControl);	
				
				echo json_encode($jsonUsuario);
			}else{
				echo $resultUsuarioCredencial;
			}
		}
	}else{
		echo '[]';		
	}
	
	
	
	
	
?>