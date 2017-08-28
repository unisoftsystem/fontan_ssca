
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	$jsonAcudientes = "[";
	$contador = 1;
	$curso = $_REQUEST["curso"];
	$apellido = $_REQUEST["apellido"];
	$query  = "SELECT * FROM usuarios where ((curso LIKE '$curso' AND (NOT curso is null AND NOT curso LIKE '')) OR (PrimerApellido LIKE '$apellido' AND NOT PrimerApellido is null)) AND `TipoUsuario`='Estudiante'";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
		$tipoId = stripslashes($registro["TipoId"]);	
		$numeroId = stripslashes($registro["NumeroId"]);	
		$primerApellido = stripslashes($registro["PrimerApellido"]);	
		$segundoApellido = stripslashes($registro["SegundoApellido"]);		
		$primerNombre = stripslashes($registro["PrimerNombre"]);	
		$segundoNombre = stripslashes($registro["SegundoNombre"]);	
		$direccion = stripslashes($registro["Direccion"]);	
		$telefono1 = stripslashes($registro["Telefono1"]);		
		$telefono2 = stripslashes($registro["Telefono2"]);		
		$tipoUsuario = stripslashes($registro["TipoUsuario"]);		
		$idAcudiente = stripslashes($registro["idAcudiente"]);	
		$ImagenFotografica = stripslashes($registro["ImagenFotografica"]);	
		
		if($contador == 1){
			$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "ImagenFotografica":"' . $ImagenFotografica . '"}';	
		}else{
			if($contador <= $numeroFilas && $contador != 1){
				$jsonAcudientes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "ImagenFotografica":"' . $ImagenFotografica . '"}';
			}
		}
		$contador+=1;
	}	
	/*while($row = mysql_fetch_array($result, MYSQL_ASSOC))
      { 

        $id = stripslashes($row['NumeroId']);
        $nombre = stripslashes($row['PrimerNombre']);
        $apellido = stripslashes($row['PrimerApellido']);
        $ruta = stripslashes($row['ruta_idruta']);
        $imagen = stripslashes($row['ImagenFotografica']);
   
  	}*/
	$jsonAcudientes .= "]";		
  echo $jsonAcudientes;

	
?>