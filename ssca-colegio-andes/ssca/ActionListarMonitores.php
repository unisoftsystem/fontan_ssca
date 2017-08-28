<?php


$wsdlAddress = "http://181.55.254.193/ssca/Service/Service_ListarMonitores.php?wsdl";

$options = array(
    "soap_version" => SOAP_1_1,
    "cache_wsdl" => WSDL_CACHE_NONE,
    "exceptions" => true
);

$webServiceClient = new SoapClient($wsdlAddress, $options);

$requestData = array();

$response = $webServiceClient->__soapCall("ListarMonitores", $requestData);
print_r($response);
?>