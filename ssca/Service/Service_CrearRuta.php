<?php

include_once("../plugins/soap/lib/nusoap.php");
$servicio = new soap_server();

$ns = "urn:miserviciowsdl";
$servicio->configureWSDL("ServiceCrearRuta",$ns);
$servicio->schemaTargetNamespace = $ns;

$servicio->register("CrearRuta", array('PuntoOrigen'=>'xsd:string', 'NombreRuta'=>'xsd:string', 'PuntoDestino'=>'xsd:string', 'idConductor'=>'xsd:string', 'idMonitor'=>'xsd:string'), array('return'=>'xsd:string'),$ns);

function CrearRuta($PuntoOrigen, $NombreRuta, $PuntoDestino, $idConductor, $idMonitor){
	$conexion = mysqli_connect("localhost", "root", "usc");
	mysqli_select_db($conexion, "ssca");
	$query = "INSERT INTO `planeacionruta`(`idPlaneacionRuta`, `NombreRuta`, `PuntoOrigen`, `PuntoDestino`, `idConductor`, `idMonitor`) VALUES (NULL,'$NombreRuta','$PuntoOrigen','$PuntoDestino','$idConductor','$idMonitor')"; 
	$result = mysqli_query($conexion, $query);
	return $result . "";
}
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$servicio->service($HTTP_RAW_POST_DATA);
?>