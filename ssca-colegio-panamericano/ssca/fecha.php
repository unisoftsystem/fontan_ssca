<?php
	$fecha = "18:40:00";
	$nuevafecha = strtotime ( '-5 minute' , strtotime ( $fecha ) ) ;
	$nuevafecha = date ( 'H:i:s' , $nuevafecha );	 
	echo $nuevafecha;
?>