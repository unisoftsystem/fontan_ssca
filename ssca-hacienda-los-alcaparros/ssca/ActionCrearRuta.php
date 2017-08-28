<?php

$ruta = $_REQUEST["ruta"];
$origen = $_REQUEST["origen"];
$destino = $_REQUEST["destino"];
$bus = $_REQUEST["bus"];
$conductor = $_REQUEST["conductor"];
$monitor = $_REQUEST["monitor"];

$wsdlAddress = "http://181.55.254.193/ssca/Service/Service_CrearRuta.php?wsdl";

$options = array(
    "soap_version" => SOAP_1_1,
    "cache_wsdl" => WSDL_CACHE_NONE,
    "exceptions" => true
);

$webServiceClient = new SoapClient($wsdlAddress, $options);

$requestData = array('PuntoOrigen' => $origen, 'NombreRuta' => $ruta, 'PuntoDestino' => $destino, 'idConductor' => $conductor, 'idMonitor' => $monitor);

$response = $webServiceClient->__soapCall("CrearRuta", $requestData);
print_r($response);
?>