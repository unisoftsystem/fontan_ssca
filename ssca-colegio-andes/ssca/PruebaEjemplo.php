
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
	//$usuario = $_REQUEST["usuario"];
	
	$query  = "SELECT c.* , u.`idUsuario` , u.`TipoUsuario` , u.`TipoId` , u.`NumeroId` , u.`PrimerApellido` , u.`SegundoApellido` , u.`PrimerNombre` , u.`SegundoNombre` , u.`ImagenFotografica` , u.`idAcudiente` , u.`Direccion` , u.`Telefono1` , u.`Telefono2` , u.`Estado` , u.`Clave`, u.`latitud` , u.`longitud` FROM  `credenciales` c INNER JOIN usuarios u ON u.idUsuario = c.idUsuarioSecundario WHERE c.`idCredencial` ='a8b66518-bc62-11e5-843c-00252299e748'";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){
		$tipoId = $registro["TipoId"];	
		$numeroId = $registro["NumeroId"];	
		$latitud = $registro["latitud"];	
		$longitud = $registro["longitud"];	
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
		$SaldoCredencial = $registro["SaldoCredencial"];
		$idCredencial = $registro["idCredencial"];

		if($contador == 1){
			$jsonAcudientes .= '{"latitud":"' . $latitud . '", "longitud":"' . $longitud . '", "tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '"}';	
		}else{
			if($contador <= $numeroFilas && $contador != 1){
				$jsonAcudientes .= ',{"latitud":"' . $latitud . '", "longitud":"' . $longitud . '", "tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '"}';
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