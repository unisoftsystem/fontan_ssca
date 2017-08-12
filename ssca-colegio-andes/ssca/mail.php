<?php
	/*ini_set("SMTP","http://181.55.254.193");
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
	$headers .= "From: test@gmail.com" . "\r\n";
	$bool = mail("shelvinbb@gmail.com","test subject","test body",$headers);
	if($bool){
		echo "Mensaje enviado";
	}else{
		echo "Mensaje no enviado";
	}*/
	
	
		// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
		$email_to = "shelvinbb@gmail.com";
		$email_subject = "Contacto desde el sitio web";
		
		
		$email_message = "Detalles del formulario de contacto:\n\n";
		$email_message .= "Nombre: \n";
		$email_message .= "Apellido: \n";
		$email_message .= "E-mail: \n";
		$email_message .= "Teléfono: \n";
		$email_message .= "Comentarios: \n\n";
		
		//$mail->Host = "localhost";
		//$mail->Port = "25";
		// Ahora se envía el e-mail usando la función mail() de PHP
		$headers = "From: \r\n".
		'X-Mailer: PHP/' . phpversion();
		$bool = mail($email_to, $email_subject, $email_message, $headers);
		
		if($bool){
			echo "¡El formulario se ha enviado con éxito!";
		}else{
			echo "¡El formulario no se ha enviado!";
		}
		
		
?>