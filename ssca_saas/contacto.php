<?php
//Comprobamos que se haya presionado el boton enviar

//Guardamos en variables los datos enviados
/*$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$ciudad = $_POST['ciudad'];
$mensaje = $_POST['mensaje'];*/
$nombre = "prueba";
$email = "prueba@gmail.com";
$mensaje = "Mensja"; 
//Cabeceras del correo
$headers = "From: $nombre <$email>\r\n"; //Quien envia?
$headers .= "X-Mailer: PHP5\n";
$headers .= 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; //



//$para = "contacto@hco.com.co";//Email al que se enviará
$para = "shelvinbb@gmail.com";//Email al que se enviará
$asunto = "Contacto para servicios plataforma hco";//Puedes cambiar el asunto del mensaje desde aqui
//Este sería el cuerpo del mensaje
 
//Comprobamos que los datos enviados a la función MAIL de PHP estén bien y si es correcto enviamos
if(mail($para, $asunto, $mensaje, $headers)){
	echo "1";
}else{
	echo "0";	
}

?>