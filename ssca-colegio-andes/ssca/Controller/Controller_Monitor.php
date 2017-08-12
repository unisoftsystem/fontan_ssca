<?php

	
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataMonitor.php');
	
	class Controller_Monitor {
		
		public function __construct(){
			
		}
				
		public function CrearMonitor(DataMonitor $usuario){
			$conexionBD = new ConexionBD();
			$latitud = $usuario->getLatitud();
			$longitud = $usuario->getLongitud();
			$Clave = base64_encode($usuario->getClave());
			$idmonitor = $usuario->getIdmonitor();	
			$TipoId = $usuario->getTipoId();
			$nombre = $usuario->getNombre();
			$apellido = $usuario->getApellido();
			$TipoUsuario = $usuario->getTipoUsuario();
			$telefono = $usuario->getTelefono();
			$direccion = $usuario->getDireccion();	
			$tipoUsuario = $usuario->getTipoUsuario();	
			$imagenFotografica = $usuario->getImagenFotografica();
			$qr = $usuario->getQr();
			$coordenadas = $latitud . ", " . $longitud;
			$arl = $usuario->getArl();
			$tipoSangre = $usuario->getTipoSangre();
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `monitor` (`idmonitor`, `nombre`, `apellido`, `telefono`, `TipoUsuario`, `TipoId`, `ImagenFotografica`, `Direccion`, `Estado`, `Clave`, `qr`, `Coordenadas`, `TipoSangre`, `arl`) VALUES ('$idmonitor', '$nombre', '$apellido', '$telefono', '$TipoUsuario', '$TipoId', '$imagenFotografica', '$direccion', 'ACTIVO', '$Clave', '$qr', '$coordenadas', '$tipoSangre', '$arl');";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ModificarMonitor(DataMonitor $usuario){
			$conexionBD = new ConexionBD();
			
			$latitud = $usuario->getLatitud();
			$longitud = $usuario->getLongitud();
			$Clave = base64_encode($usuario->getClave());
			$idmonitor = $usuario->getIdmonitor();	
			$TipoId = $usuario->getTipoId();
			$nombre = $usuario->getNombre();
			$apellido = $usuario->getApellido();
			$TipoUsuario = $usuario->getTipoUsuario();
			$telefono = $usuario->getTelefono();
			$direccion = $usuario->getDireccion();	
			$tipoUsuario = $usuario->getTipoUsuario();	
			$imagenFotografica = $usuario->getImagenFotografica();
			$estado = $usuario->getEstado();
			$arl = $usuario->getArl();
			$tipoSangre = $usuario->getTipoSangre();
			$coordenadas = $latitud . ", " . $longitud;
			$conexion = $conexionBD->conectar();
			
			$query = "UPDATE `monitor` SET `nombre`='$nombre',`apellido`='$apellido',`telefono`='$telefono',`TipoUsuario`='$TipoUsuario',`TipoId`='$TipoId',`ImagenFotografica`='$imagenFotografica',`Direccion`='$direccion',`Estado`='$estado',`Clave`='$Clave',`Coordenadas`='$coordenadas',`TipoSangre`='$tipoSangre',`arl`='$arl' WHERE `idmonitor`='$idmonitor'";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		
		public function ExisteUsuario($idmonitor){
			$conexionBD = new ConexionBD();
			$existe = false;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `monitor` WHERE `idmonitor`='$idmonitor'";
			
			$result = mysqli_query($conexion, $query);
			
			$registro = mysqli_fetch_array($result);
			
			if($registro != null){
				$existe = true;				
			}
			return $existe;
		}
		
		public function IniciarSesion($idUsuario, $claveUsuario){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			$fecha = date("Y-m-d");

			$conexion = $conexionBD->conectar();
			
			/*$query = "SELECT c.idCredencial as idCredencial, c.SaldoCredencial as SaldoCredencial, m.`idmonitor` as idmonitor, m.`nombre` as nombre, m.`apellido` as apellido, m.`telefono` as telefono, m.`TipoUsuario` as TipoUsuario, m.`TipoId` as TipoId, m.`ImagenFotografica` as ImagenFotografica, m.`Direccion` as Direccion, m.`Estado` as Estado, m.`Clave` as Clave, m.`qr` as qr, m.`Coordenadas` as Coordenadas FROM `monitor` m, `credenciales` c WHERE (m.`idmonitor`='$idUsuario' AND m.`Clave`='$claveUsuario' AND c.`idUsuarioSecundario`='$idUsuario' AND c.`idUsuarioPrincipal`='$idUsuario') OR (c.idCredencial = '$credencial') AND m.`Estado`='ACTIVO' AND c.`EstadoCredencial`='ACTIVO'";*/
			//$query = "SELECT a.*, c.idCredencial as idCredencial, c.SaldoCredencial as SaldoCredencial, m.`idmonitor` as idmonitor, m.`nombre` as nombre, m.`apellido` as apellido, m.`telefono` as telefono, m.`TipoUsuario` as TipoUsuario, m.`TipoId` as TipoId, m.`ImagenFotografica` as ImagenFotografica, m.`Direccion` as Direccion, m.`Estado` as Estado, m.`Clave` as Clave, m.`qr` as qr, m.`Coordenadas` as Coordenadas FROM `monitor` m, `credenciales` c inner join asignacionruta a on a.monitor='$idUsuario' WHERE (m.`idmonitor`='$idUsuario' AND m.`Clave`='$claveUsuario' AND c.`idUsuarioSecundario`='$idUsuario' AND c.`idUsuarioPrincipal`='$idUsuario') OR (c.idCredencial = '$credencial') AND m.`Estado`='ACTIVO' AND c.`EstadoCredencial`='ACTIVO' AND a.monitor='$idUsuario'";
			/*
			SELECT ar.*, m.* FROM `asignacionruta` ar, `monitor` m WHERE m.`idmonitor` = '1012324820' AND m.`Clave` = 'ZGQ=' AND ar.`monitor` = '1012324820'
			SELECT ar.*, m.* FROM `asignacionruta` ar, `monitor` m inner join `credenciales` c on c.`idUsuarioPrincipal` = m.`idmonitor` AND c.`idUsuarioSecundario` = m.`idmonitor` WHERE c.`idCredencial` = '3898abdb-9a24-11e5-8dc4-c4da260350a1'  
			*/
			$query = "SELECT ar.*, monitor.*, c.*, usuarios.gcm_regid FROM `datoscalendario` ar INNER JOIN monitor ON monitor.`idmonitor` = ar.monitor AND monitor.`idmonitor` = '$idUsuario' AND monitor.`Clave` = '$claveUsuario' INNER JOIN usuarios ON usuarios.NumeroId = monitor.idMonitor INNER JOIN credenciales c ON c.idUsuarioSecundario = usuarios.idUsuario WHERE ar.`fecha` = '$fecha'";
			
			$result = mysqli_query($conexion, $query);
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				
				/*$queryUpdate = "UPDATE `monitor` SET `Gcm_Phone`='$gcm_id' WHERE `idmonitor`='$idUsuario' AND `Clave`='$claveUsuario'";			
				$resultUpdate = mysqli_query($conexion, $queryUpdate);*/
				
				while($registro = mysqli_fetch_array($result)){
					$id = $registro["idruta"];	
					$tipoId = $registro["TipoId"];	
					$nombreruta = $registro["nombreruta"];	
					$apellido = $registro["apellido"];		
					$nombre = $registro["nombre"];		
					$direccion = $registro["Direccion"];	
					$telefono = $registro["telefono"];	
					$tipoUsuario = $registro["TipoUsuario"];	
					$idmonitor = $registro["idmonitor"];
					$Coordenadas = $registro["Coordenadas"];
					$clave = base64_decode($registro["Clave"]);
					$estado = $registro["Estado"];
					$ImagenFotografica = $registro["ImagenFotografica"];
					$idruta = $registro["vehiculo"];
					$id_conductor = $registro["id_conductor"];
					$latorigen = $registro["latorigen"];
					$longorigen = $registro["longorigen"];
					$latdestino = $registro["latdestino"];
					$longdestino = $registro["longdestino"];
					$idCredencial = $registro["idCredencial"];
					$gcm_regid = $registro["gcm_regid"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"id":"' . $id . '","tipoId":"' . $tipoId . '","nombreruta":"' . $nombreruta . '", "apellido":"' . $apellido . '", "nombre":"' . $nombre . '", "direccion":"' . $direccion . '", "telefono":"' . $telefono . '", "tipoUsuario":"' . $tipoUsuario . '", "idmonitor":"' . $idmonitor . '", "Coordenadas":"' . $Coordenadas . '", "clave":"' . $clave . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "idruta":"' . $idruta . '", "id_conductor":"' . $id_conductor . '", "latorigen":"' . $latorigen . '", "longorigen":"' . $longorigen . '", "latdestino":"' . $latdestino . '", "longdestino":"' . $longdestino . '", "idCredencial":"' . $idCredencial . '", "gcm_regid":"' . $gcm_regid . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"id":"' . $id . '","tipoId":"' . $tipoId . '","nombreruta":"' . $nombreruta . '", "apellido":"' . $apellido . '", "nombre":"' . $nombre . '", "direccion":"' . $direccion . '", "telefono":"' . $telefono . '", "tipoUsuario":"' . $tipoUsuario . '", "idmonitor":"' . $idmonitor . '", "Coordenadas":"' . $Coordenadas . '", "clave":"' . $clave . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "idruta":"' . $idruta . '", "id_conductor":"' . $id_conductor . '", "latorigen":"' . $latorigen . '", "longorigen":"' . $longorigen . '", "latdestino":"' . $latdestino . '", "longdestino":"' . $longdestino . '", "idCredencial":"' . $idCredencial . '", "gcm_regid":"' . $gcm_regid . '"}';
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function IniciarSesionQR($credencial){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			$fecha = date("Y-m-d");
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT ar.*, monitor.*, c.*, usuarios.gcm_regid FROM `datoscalendario` ar INNER JOIN monitor ON monitor.`idmonitor` = ar.monitor INNER JOIN usuarios ON usuarios.NumeroId = monitor.idMonitor INNER JOIN credenciales c ON c.idUsuarioSecundario = usuarios.idUsuario WHERE ar.`fecha` = '$fecha' AND c.idCredencial = '$credencial'";
			
			$result = mysqli_query($conexion, $query);
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				/*$queryUpdate = "UPDATE `monitor` SET `Gcm_Phone`='$gcm_id' WHERE `idmonitor`='$idUsuario'";			
				$resultUpdate = mysqli_query($conexion, $queryUpdate);*/
				
				while($registro = mysqli_fetch_array($result)){
					$id = $registro["idruta"];
					
					$nombreruta = $registro["nombreruta"];	
					
					$tipoId = $registro["TipoId"];	
					$apellido = $registro["apellido"];		
					$nombre = $registro["nombre"];		
					$direccion = $registro["Direccion"];	
					$telefono = $registro["telefono"];	
					$tipoUsuario = $registro["TipoUsuario"];	
					$idmonitor = $registro["idmonitor"];
					$Coordenadas = $registro["Coordenadas"];
					$clave = base64_decode($registro["Clave"]);
					$estado = $registro["Estado"];
					$ImagenFotografica = $registro["ImagenFotografica"];
					$idruta = $registro["vehiculo"];
					$id_conductor = $registro["id_conductor"];
					$latorigen = $registro["latorigen"];
					$longorigen = $registro["longorigen"];
					$latdestino = $registro["latdestino"];
					$longdestino = $registro["longdestino"];
					$idCredencial = $registro["idCredencial"];
					$gcm_regid = $registro["gcm_regid"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"id":"' . $id . '","tipoId":"' . $tipoId . '","nombreruta":"' . $nombreruta . '", "apellido":"' . $apellido . '", "nombre":"' . $nombre . '", "direccion":"' . $direccion . '", "telefono":"' . $telefono . '", "tipoUsuario":"' . $tipoUsuario . '", "idmonitor":"' . $idmonitor . '", "Coordenadas":"' . $Coordenadas . '", "clave":"' . $clave . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "idruta":"' . $idruta . '", "id_conductor":"' . $id_conductor . '", "latorigen":"' . $latorigen . '", "longorigen":"' . $longorigen . '", "latdestino":"' . $latdestino . '", "longdestino":"' . $longdestino . '", "idCredencial":"' . $idCredencial . '", "gcm_regid":"' . $gcm_regid . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"id":"' . $id . '","tipoId":"' . $tipoId . '","nombreruta":"' . $nombreruta . '", "apellido":"' . $apellido . '", "nombre":"' . $nombre . '", "direccion":"' . $direccion . '", "telefono":"' . $telefono . '", "tipoUsuario":"' . $tipoUsuario . '", "idmonitor":"' . $idmonitor . '", "Coordenadas":"' . $Coordenadas . '", "clave":"' . $clave . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "idruta":"' . $idruta . '", "id_conductor":"' . $id_conductor . '", "latorigen":"' . $latorigen . '", "longorigen":"' . $longorigen . '", "latdestino":"' . $latdestino . '", "longdestino":"' . $longdestino . '", "idCredencial":"' . $idCredencial . '", "gcm_regid":"' . $gcm_regid . '"}';
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function ListarEstudiantesRuta($idRuta, $fecha){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT u.*, c.* FROM `cart` c inner join usuarios u on c.valores = u.NumeroId WHERE c.`ruta`='$idRuta' AND u.`TipoUsuario`='Estudiante'";
			
			$result = mysqli_query($conexion, $query);
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				
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
					$gcm_regid = $registro["gcm_regid"];
					$curso = $registro["curso"];
					$latitud = $registro["latitud"];
					$longitud = $registro["longitud"];
					
					$queryMensajes = "SELECT * FROM `log_ruta` WHERE `idruta`='$idRuta' AND `idestudiante`='$usuario' AND `tipo`='MENSAJEAMONITOR' AND `fecha`='$fecha' ORDER BY `hora` DESC";
			
					$resultMensajes = mysqli_query($conexion, $queryMensajes);
					$contadorMensajes = 1;
					$mensajes = "";
					while($registroMensajes = mysqli_fetch_array($resultMensajes, MYSQL_ASSOC)){
						if($contadorMensajes == 1){
							$mensajes.= json_encode($registroMensajes);
						}else{
							if($contadorMensajes <= $numeroFilas && $contador != 1){
								$mensajes.= "," . json_encode($registroMensajes);
							}
						}
						$contadorMensajes+=1;
					}
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "gcm_regid":"' . $gcm_regid . '", "curso":"' . $curso . '", "latitud":"' . $latitud . '", "longitud":"' . $longitud . '", "mensajes":[' . $mensajes . ']}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "gcm_regid":"' . $gcm_regid . '", "curso":"' . $curso . '", "latitud":"' . $latitud . '", "longitud":"' . $longitud . '", "mensajes":[' . $mensajes . ']}';	
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function ListarEstudiantesRutaFiltro($idRuta, $fecha, $apellido){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT u.*, c.* FROM `cart` c inner join usuarios u on c.valores = u.NumeroId WHERE c.`ruta`='$idRuta' AND u.`TipoUsuario`='Estudiante' AND u.PrimerApellido LIKE '%$apellido%'";
			
			$result = mysqli_query($conexion, $query);
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				
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
					$gcm_regid = $registro["gcm_regid"];
					$curso = $registro["curso"];
					$latitud = $registro["latitud"];
					$longitud = $registro["longitud"];
					
					$queryMensajes = "SELECT * FROM `log_ruta` WHERE `idruta`='$idRuta' AND `idestudiante`='$usuario' AND `tipo`='MENSAJEAMONITOR' AND `fecha`='$fecha' ORDER BY `hora` DESC";
			
					$resultMensajes = mysqli_query($conexion, $queryMensajes);
					$contadorMensajes = 1;
					$mensajes = "";
					while($registroMensajes = mysqli_fetch_array($resultMensajes, MYSQL_ASSOC)){
						if($contadorMensajes == 1){
							$mensajes.= json_encode($registroMensajes);
						}else{
							if($contadorMensajes <= $numeroFilas && $contador != 1){
								$mensajes.= "," . json_encode($registroMensajes);
							}
						}
						$contadorMensajes+=1;
					}
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "gcm_regid":"' . $gcm_regid . '", "curso":"' . $curso . '", "latitud":"' . $latitud . '", "longitud":"' . $longitud . '", "mensajes":[' . $mensajes . ']}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "gcm_regid":"' . $gcm_regid . '", "curso":"' . $curso . '", "latitud":"' . $latitud . '", "longitud":"' . $longitud . '", "mensajes":[' . $mensajes . ']}';	
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function ConsultarUsuario($idconductor){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT m.*, c.* FROM `monitor` m INNER JOIN credenciales c ON c.idUsuarioSecundario = m.idMonitor WHERE m.`idmonitor`='$idconductor'";
			
			$result = mysqli_query($conexion, $query);
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				
				while($registro = mysqli_fetch_array($result)){
					$idmonitor = $registro["idmonitor"];	
					$nombre = $registro["nombre"];	
					$apellido = $registro["apellido"];	
					$Direccion = $registro["Direccion"];	
					$telefono = $registro["telefono"];	
					$TipoUsuario = $registro["TipoUsuario"];	
					$TipoId = $registro["TipoId"];	
					$ImagenFotografica = $registro["ImagenFotografica"];	
					$Estado = $registro["Estado"];	
					$Coordenadas = $registro["Coordenadas"];	
					$Clave = base64_decode($registro["Clave"]);	
					$SaldoCredencial = $registro["SaldoCredencial"];	
					$FechaVencimiento = $registro["FechaVencimiento"];
					$TipoSangre = $registro["TipoSangre"];
					$arl = $registro["arl"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"idmonitor":"' . $idmonitor . '", "nombre":"' . $nombre . '", "apellido":"' . $apellido . '", "Direccion":"' . $Direccion . '", "telefono":"' . $telefono . '", "TipoUsuario":"' . $TipoUsuario . '", "TipoId":"' . $TipoId . '", "ImagenFotografica":"' . $ImagenFotografica . '", "Estado":"' . $Estado . '", "Coordenadas":"' . $Coordenadas . '", "Clave":"' . $Clave . '", "SaldoCredencial":"' . $SaldoCredencial . '", "FechaVencimiento":"' . $FechaVencimiento . '", "TipoSangre":"' . $TipoSangre . '", "arl":"' . $arl . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
						 $jsonAcudientes .= ',{"idmonitor":"' . $idmonitor . '", "nombre":"' . $nombre . '", "apellido":"' . $apellido . '", "Direccion":"' . $Direccion . '", "telefono":"' . $telefono . '", "TipoUsuario":"' . $TipoUsuario . '", "TipoId":"' . $TipoId . '", "ImagenFotografica":"' . $ImagenFotografica . '", "Estado":"' . $Estado . '", "Coordenadas":"' . $Coordenadas . '", "Clave":"' . $Clave . '", "SaldoCredencial":"' . $SaldoCredencial . '", "FechaVencimiento":"' . $FechaVencimiento . '", "TipoSangre":"' . $TipoSangre . '", "arl":"' . $arl . '"}';	
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}

		public function ModificarIdToken($gcm_regid, $usuario){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$query = "UPDATE `monitor` SET `Gcm_Phone`='$gcm_regid' WHERE `idmonitor` = '$usuario'";
			$queryUsuario = "UPDATE `usuarios` SET `gcm_regid`='$gcm_regid' WHERE `NumeroId` = '$usuario'";
			
			$result = mysqli_query($conexion, $query);
			mysqli_query($conexion, $queryUsuario);
			
			return $result;
		}	
	}
	
?>