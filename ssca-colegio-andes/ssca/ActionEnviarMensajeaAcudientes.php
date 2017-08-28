
<?php 
	header("Access-Control-Allow-Origin: *");
	
	require_once 'db_connect1.php';
	$db = new DB_CONNECT();
	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$coordenadas = $_REQUEST["coordenadas"];	
	$idUsuario = $_REQUEST["idUsuario"];
	$fecha = $_REQUEST["fecha"];	
	$hora = $_REQUEST["hora"];	
	$idRuta = $_REQUEST["idRuta"];
	$mensaje = $_REQUEST["mensaje"];
	$tipo = $_REQUEST["tipo"];
	$idEstudiante = $_REQUEST["idEstudiante"];
	
	switch($tipo){
		case "ruta":
			$query  = "SELECT a.*, u.* FROM cart c INNER JOIN `asignacionruta` a ON c.ruta = a.id INNER JOIN usuarios u ON u.NumeroId = c.valores WHERE a.id = '$idRuta'";
			$result = mysql_query($query);
			$numeroFilas = mysql_num_rows($result);
			
			if($numeroFilas > 0){
				while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
					//echo json_encode($registro);
					// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
					$email_to = $registro["idAcudiente"];
					$email_subject = "Mensaje del Coordinador de las rutas";
					
					
					//$mail->Host = "localhost";
					//$mail->Port = "25";
					// Ahora se envía el e-mail usando la función mail() de PHP
					$headers = "From: inforuta@181.55.254.193\r\n".
					'X-Mailer: PHP/' . phpversion();
					$bool = mail($email_to, $email_subject, $mensaje, $headers);
				}
				$queryRegistro  = "INSERT INTO `log_ruta`(`id`, `idestudiante`, `coordenadas_recogida`, `tipo`, `idruta`, `fecha`, `hora`, `mensaje`) VALUES (NULL,'$idUsuario','$coordenadas','MENSAJEAACUDIENTESPORRUTA','$idRuta','$fecha','$hora','$mensaje')";
				$resultRegistro = mysql_query($queryRegistro);
				
				echo $resultRegistro;					
			}
			break;
		case "estudiante":
			$query  = "SELECT `idAcudiente` FROM `usuarios` WHERE `idUsuario`='$idEstudiante'";
			$result = mysql_query($query);
			$registro = mysql_fetch_array($result, MYSQL_ASSOC);
			$email_to = $registro["idAcudiente"];
			$email_subject = "Mensaje del Coordinador de las rutas";
			
			
			//$mail->Host = "localhost";
			//$mail->Port = "25";
			// Ahora se envía el e-mail usando la función mail() de PHP
			$headers = "From: inforuta@181.55.254.193\r\n".
			'X-Mailer: PHP/' . phpversion();
			$bool = mail($email_to, $email_subject, $mensaje, $headers);
			
			
			$queryRegistroEstudiante  = "INSERT INTO `log_ruta`(`id`, `idestudiante`, `coordenadas_recogida`, `tipo`, `idruta`, `fecha`, `hora`, `mensaje`) VALUES (NULL,'$idUsuario','$coordenadas','MENSAJEAACUDIENTESPORESTUDIANTE','$idEstudiante','$fecha','$hora','$mensaje')";
			$resultRegistroEstudiante = mysql_query($queryRegistroEstudiante);
			//acemail@fnt.com
			echo $resultRegistroEstudiante;					
			break;
	}
	
?>