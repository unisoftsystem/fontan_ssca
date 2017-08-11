<?php

include_once("../plugins/soap/lib/nusoap.php");
$servicio = new soap_server();

$ns = "urn:miserviciowsdl";
$servicio->configureWSDL("ServiceListarConductores",$ns);
$servicio->schemaTargetNamespace = $ns;

$servicio->register("ListarMonitores", array(), array('return'=>'xsd:string'),$ns);

function ListarMonitores(){
	$conexion = mysqli_connect("localhost", "root", "usc");
	mysqli_select_db($conexion, "ssca");
	$query = "SELECT * FROM `usuarios` WHERE `TipoUsuario`='Conductor'"; 
	$result = mysqli_query($conexion, $query);
    //$row = mysqli_fetch_array($result);
	$numeroFilas = mysqli_num_rows($result);
	$jsonAcudientes = "[";
	$contador = 1;	
			
	while($registro = mysqli_fetch_array($result)){
		$tipoId = $registro["TipoId"];	
		$numeroId = $registro["NumeroId"];	
		$primerApellido = $registro["PrimerApellido"];	
		$segundoApellido = $registro["SegundoApellido"];	
		$primerNombre = $registro["PrimerNombre"];	
		$segundoNombre = $registro["SegundoNombre"];	
		$direccion = $registro["Direccion"];	
		$telefono1 = $registro["Telefono1"];	
		$telefono2 = $registro["Telefono2"];	
		$tipoUsuario = $registro["TipoUsuario"];	
		$usuario = $registro["idUsuario"];
		$idAcudiente = $registro["idAcudiente"];
		$clave = base64_decode($registro["Clave"]);
		$estado = $registro["Estado"];
		$ImagenFotografica = $registro["ImagenFotografica"];
		
		if($contador == 1){
			$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '"}';	
		}else{
			if($contador <= $numeroFilas && $contador != 1){
				$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '"}';
			}
		}
		$contador+=1;
	}	
	$jsonAcudientes .= "]";		
			
	return $jsonAcudientes;
}
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$servicio->service($HTTP_RAW_POST_DATA);
?>