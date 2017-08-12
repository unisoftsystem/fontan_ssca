<?php

	
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataUsuario.php');
	
	class Controller_Usuario {
		
		public function __construct(){
			
		}
				
		public function CrearUsuario(DataUsuario $usuario){
			$conexionBD = new ConexionBD();
			$idusuario = $usuario->getIdUsuario();
			$latitud = $usuario->getLatitud();
			$longitud = $usuario->getLongitud();
			$pass = base64_encode($usuario->getPassword());
			$idAcudiente = $usuario->getIdAcudiente();
			$tipoId = $usuario->getTipoId();	
			$numeroId = $usuario->getNumeroId();
			$primerApellido = $usuario->getPrimerApellido();
			$segundoApellido = $usuario->getSegundoApellido();
			$primerNombre = $usuario->getPrimerNombre();
			$segundoNombre = $usuario->getSegundoNombre();
			$direccion = $usuario->getDireccion();
			$telefono1 = $usuario->getTelefono1();	
			$telefono2 = $usuario->getTelefono2();
			$tipoUsuario = $usuario->getTipoUsuario();	
			$imagenFotografica = $usuario->getImagenFotografica();
			$curso = $usuario->getCurso();
			$arl = $usuario->getArl();
			$cargo = $usuario->getCargo();
			$tipoSangre = $usuario->getTipoSangre();
			
			$coordenadas = $latitud . ", " . $longitud;
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `usuarios` (`idUsuario`, `TipoUsuario`, `TipoId`, `NumeroId`, `PrimerApellido`, `SegundoApellido`, `PrimerNombre`, `SegundoNombre`, `ImagenFotografica`, `idAcudiente`, `Direccion`, `Telefono1`, `Telefono2`, `Estado`, `Clave`, `Coordenadas`, `latitud`, `longitud`, `ruta_idruta`, `curso`, `TipoSangre`, `arl`, `cargo`) VALUES ('$idusuario', '$tipoUsuario', '$tipoId', '$numeroId', '$primerApellido', '$segundoApellido', '$primerNombre', '$segundoNombre', '$imagenFotografica', '$idAcudiente', '$direccion', '$telefono1', '$telefono2', 'ACTIVO', '$pass', '$coordenadas', '$latitud', '$longitud', 0, $curso, '$tipoSangre', '$arl', '$cargo')";
			$result = mysqli_query($conexion, $query);
			
			$queryCurso = "SELECT * FROM `cursos` WHERE `id`='$curso'";			
			$resultCurso = mysqli_query($conexion, $queryCurso);
			$registroCurso = mysqli_fetch_array($resultCurso);
			
			$descripcionCurso = $registroCurso["Descripcion"];
			return $descripcionCurso;
		}
		
		public function ModificarUsuario(DataUsuario $usuario){
			$conexionBD = new ConexionBD();
			
			$pass = base64_encode($usuario->getPassword());
			$idAcudiente = $usuario->getIdAcudiente();
			$tipoId = $usuario->getTipoId();	
			$numeroId = $usuario->getNumeroId();
			$primerApellido = $usuario->getPrimerApellido();
			$segundoApellido = $usuario->getSegundoApellido();
			$primerNombre = $usuario->getPrimerNombre();
			$estado = $usuario->getEstado();
			$segundoNombre = $usuario->getSegundoNombre();
			$direccion = $usuario->getDireccion();
			$telefono1 = $usuario->getTelefono1();	
			$telefono2 = $usuario->getTelefono2();
			$tipoUsuario = $usuario->getTipoUsuario();
			$imagenFotografica = $usuario->getImagenFotografica();	
			$idusuario = $usuario->getIdUsuario();
			$curso = $usuario->getCurso();
			$tipoSangre = $usuario->getTipoSangre();
			$latitud = $usuario->getLatitud();
			$longitud = $usuario->getLongitud();
			$arl = $usuario->getArl();
			$cargo = $usuario->getCargo();
			$fechanacimiento = $usuario->getFechanacimiento();
			$coordenadas = $latitud . ", " . $longitud;
			
			$conexion = $conexionBD->conectar();
			
			$queryUpdate = "UPDATE `credenciales` SET `idUsuarioPrincipal`= '$idAcudiente' WHERE `idUsuarioSecundario`='$idusuario'";
			
			$resultUpdate = mysqli_query($conexion, $queryUpdate);

			$query = "UPDATE `usuarios` SET `NumeroId`='$numeroId',`PrimerApellido`='$primerApellido',`SegundoApellido`='$segundoApellido',`PrimerNombre`='$primerNombre',`SegundoNombre`='$segundoNombre',`ImagenFotografica`='$imagenFotografica',`idAcudiente`='$idAcudiente',`Direccion`='$direccion',`Telefono1`='$telefono1',`Telefono2`='$telefono2',`Estado`='$estado',`Clave`='$pass',`Coordenadas`='$coordenadas',`latitud`='$latitud',`longitud`='$longitud',`curso`=$curso,`TipoSangre`='$tipoSangre', `arl`='$arl', `cargo`='$cargo',`fechanacimiento`='$fechanacimiento' WHERE `idUsuario` = '$idusuario'";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		//Funcion para modificar el idtoken de los telefonos que usan la app de estudiante. Se necesita para
		//saber en cual telefono inicio sesion el estudiante
		public function ModificarIdToken($gcm_regid, $usuario){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$query = "UPDATE `usuarios` SET `gcm_regid`='$gcm_regid' WHERE `idUsuario` = '$usuario'";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ExisteUsuario($idUsuario){
			$conexionBD = new ConexionBD();
			$existe = false;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `usuarios` WHERE `idUsuario`='$idUsuario'";
			
			$result = mysqli_query($conexion, $query);
			
			$registro = mysqli_fetch_array($result);
			
			if($registro != null){
				$existe = true;				
			}
			return $existe;
		}
		
		public function ListarAcudientes(){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `usuarios` WHERE `TipoUsuario`='Acudiente'";
			
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
					$curso = $registro["curso"];
					$TipoSangre = $registro["TipoSangre"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '"}';
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function ConsultarUsuarioIdUsuario($idUsuario){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT u.*, c.*, cre.* FROM `usuarios` u INNER JOIN cursos c on c.id = u.curso INNER JOIN `credenciales` cre ON u.idUsuario = cre.idUsuarioSecundario WHERE `NumeroId`='$idUsuario'";
			
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
					$estado = $registro["EstadoCredencial"];
					$ImagenFotografica = $registro["ImagenFotografica"];
					$Coordenadas = $registro["Coordenadas"];
					$latitud = $registro["latitud"];
					$longitud = $registro["longitud"];
					$curso = $registro["curso"];
					$TipoSangre = $registro["TipoSangre"];
					$idCredencial = $registro["idCredencial"];
					$SaldoCredencial = $registro["SaldoCredencial"];
					$fechaVencimiento = $registro["FechaVencimiento"];
					$fechanacimiento = $registro["fechanacimiento"];
					$arl = $registro["arl"];
					$cargo = $registro["cargo"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "Coordenadas":"' . $Coordenadas . '", "latitud":"' . $latitud . '", "longitud":"' . $longitud . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '", "idCredencial":"' . $idCredencial . '", "SaldoCredencial":"' . $SaldoCredencial . '", "fechaVencimiento":"' . $fechaVencimiento . '", "fechanacimiento":"' . $fechanacimiento . '", "arl":"' . $arl . '", "cargo":"' . $cargo . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "Coordenadas":"' . $Coordenadas . '", "latitud":"' . $latitud . '", "longitud":"' . $longitud . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '", "idCredencial":"' . $idCredencial . '", "SaldoCredencial":"' . $SaldoCredencial . '", "fechaVencimiento":"' . $fechaVencimiento . '", "arl":"' . $arl . '", "cargo":"' . $cargo . '"}';	
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function ConsultarUsuario($idUsuario){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT u.*, c.*, cre.* FROM `usuarios` u INNER JOIN cursos c on c.id = u.curso  INNER JOIN `credenciales` cre ON u.idUsuario = cre.idUsuarioSecundario WHERE `idUsuario`='$idUsuario'";
			
			$result = mysqli_query($conexion, $query);
			
			if(mysqli_num_rows($result) > 0){
				$numeroFilas = mysqli_num_rows($result);
				
				while($registro = mysqli_fetch_array($result, MYSQL_ASSOC)){
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
					$curso = $registro["curso"];
					$TipoSangre = $registro["TipoSangre"];
					$SaldoCredencial = $registro["SaldoCredencial"];
					$fechaVencimiento = $registro["FechaVencimiento"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '", "SaldoCredencial":"' . $SaldoCredencial . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '", "SaldoCredencial":"' . $SaldoCredencial . '"}';	
						}
					}
					$contador+=1;
				}	
			}else{
				$queryMonitor = "SELECT * FROM `monitor` WHERE `idmonitor`='$idUsuario'";
				$resultMonitor = mysqli_query($conexion, $queryMonitor);
				
				if(mysqli_num_rows($resultMonitor) > 0){
					$registroMonitor = mysqli_fetch_array($resultMonitor, MYSQL_ASSOC);
					$jsonAcudientes .= json_encode($registroMonitor);		
				}else{
					$queryConductor = "SELECT * FROM `conductor` WHERE `idconductor`='$idUsuario'";
					$resultConductor = mysqli_query($conexion, $queryConductor);
					$registroConductor = mysqli_fetch_array($resultConductor, MYSQL_ASSOC);
					$jsonAcudientes .= json_encode($registroConductor);		
				}
				
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function ConsultarUsuarioPorAcudiente($idUsuario, $acudiente){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT c.*, u.* FROM `usuarios` u, `credenciales` c WHERE u.`idUsuario`='$idUsuario' AND c.`idUsuarioPrincipal`='$acudiente' AND `idUsuarioSecundario`='$idUsuario'";
			
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
					$estado = $registro["EstadoCredencial"];
					$ImagenFotografica = $registro["ImagenFotografica"];
					$SaldoCredencial = $registro["SaldoCredencial"];
					$curso = $registro["curso"];
					$TipoSangre = $registro["TipoSangre"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '"}';
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '"}';
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function IniciarSesionRecaudo($idUsuario, $clave){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT `idUsuario`, `TipoUsuario`, `TipoId`, `NumeroId`, `PrimerApellido`, `SegundoApellido`, `PrimerNombre`, `SegundoNombre`, `ImagenFotografica`, `idAcudiente`, `Direccion`, `Telefono1`, `Telefono2`, `Estado`, `Clave` FROM `usuarios` WHERE `idUsuario`='$idUsuario' AND `Clave`='$clave' AND `TipoUsuario`='Funcionario' AND `Estado`='ACTIVO'";
			
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
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '"}';
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function IniciarSesionAcudiente($idUsuario, $clave){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `usuarios` WHERE `idUsuario`='$idUsuario' AND `Clave`='$clave' AND `Estado`='ACTIVO'";
			
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
					$curso = $registro["curso"];
					$TipoSangre = $registro["TipoSangre"];
					$gcm_regid = $registro["gcm_regid"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '", "gcm_regid":"' . $gcm_regid . '"}';
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '", "gcm_regid":"' . $gcm_regid . '"}';
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function IniciarSesionEstudiante($idUsuario, $clave){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `usuarios` WHERE `idUsuario`='$idUsuario' AND `Clave`='$clave' AND `TipoUsuario`='Estudiante' AND `Estado`='ACTIVO'";
			
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
					$curso = $registro["curso"];
					$TipoSangre = $registro["TipoSangre"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '"}';
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '"}';
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function ConsultarUsuarioPorCredencial($idUsuario){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			//e2354331-c6d4-11e5-a6ab-c4da260350a1
			$query = "SELECT c.* , u.*, TIMESTAMPDIFF(YEAR, u.fechanacimiento, CURDATE()) AS edad, curso.* FROM `credenciales` c INNER JOIN usuarios u ON u.idUsuario = c.idUsuarioSecundario INNER JOIN cursos curso on curso.id = u.curso WHERE c.`idCredencial` ='$idUsuario'";
			
			$result = mysqli_query($conexion, $query);
			
			if(mysqli_num_rows($result) > 0){
				$numeroFilas = mysqli_num_rows($result);
				
				while($registro = mysqli_fetch_array($result)){
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
					$Descripcion = $registro["Descripcion"];
					$curso = $registro["curso"];
					$TipoSangre = $registro["TipoSangre"];
					$fechaVencimiento = $registro["FechaVencimiento"];
					$fechanacimiento = $registro["fechanacimiento"];
					$arl = $registro["arl"];
					$edad = $registro["edad"];
					$cargo = $registro["cargo"];
					$gcm_regid = $registro["gcm_regid"];
					
					$queryRestriccion = "SELECT `Log` FROM `restriccion` WHERE `Tipo`='PORVALOR' AND `idEstudiante`='$idUsuario'";			
					$resultRestriccion = mysqli_query($conexion, $queryRestriccion);
					
					$valorRestriccion = "";
					
					if(mysqli_num_rows($resultRestriccion) > 0){
						$registroRestriccion = mysqli_fetch_array($resultRestriccion);
						$valorRestriccion = $registroRestriccion["Log"];
					}
					
					if($contador == 1){
						$jsonAcudientes .= '{"latitud":"' . $latitud . '", "longitud":"' . $longitud . '", "tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '", "curso":"' . $curso . '", "Descripcion":"' . $Descripcion . '", "TipoSangre":"' . $TipoSangre . '", "ValorRestriccion":"' . $valorRestriccion . '", "fechaVencimiento":"' . $fechaVencimiento . '", "fechanacimiento":"' . $fechanacimiento . '", "arl":"' . $arl . '", "cargo":"' . $cargo . '", "edad":"' . $edad . '", "gcm_regid":"' . $gcm_regid . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"latitud":"' . $latitud . '", "longitud":"' . $longitud . '", "tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '", "curso":"' . $curso . '", "Descripcion":"' . $Descripcion . '", "TipoSangre":"' . $TipoSangre . '", "ValorRestriccion":"' . $valorRestriccion . '", "fechaVencimiento":"' . $fechaVencimiento . '", "fechanacimiento":"' . $fechanacimiento . '", "arl":"' . $arl . '", "cargo":"' . $cargo . '", "edad":"' . $edad . '", "gcm_regid":"' . $gcm_regid . '"}';	
						}
					}
					$contador+=1;
				}	
			}else{
				$query = "SELECT c.* , u.*, TIMESTAMPDIFF(YEAR, u.fechanacimiento, CURDATE()) AS edad FROM `credenciales` c INNER JOIN usuarios u ON u.idUsuario = c.idUsuarioSecundario WHERE c.`idCredencial` ='$idUsuario'";
			
				$result = mysqli_query($conexion, $query);
				
				if(mysqli_num_rows($result) > 0){
					$numeroFilas = mysqli_num_rows($result);
					
					while($registro = mysqli_fetch_array($result)){
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
						
						$curso = $registro["curso"];
						$TipoSangre = $registro["TipoSangre"];
						$fechaVencimiento = $registro["FechaVencimiento"];
						$fechanacimiento = $registro["fechanacimiento"];
						$arl = $registro["arl"];
						$edad = $registro["edad"];
						$cargo = $registro["cargo"];
						$gcm_regid = $registro["gcm_regid"];
						
						if($contador == 1){
							$jsonAcudientes .= '{"latitud":"' . $latitud . '", "longitud":"' . $longitud . '", "tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '", "fechaVencimiento":"' . $fechaVencimiento . '", "fechanacimiento":"' . $fechanacimiento . '", "arl":"' . $arl . '", "cargo":"' . $cargo . '", "edad":"' . $edad . '", "gcm_regid":"' . $gcm_regid . '"}';	
						}else{
							if($contador <= $numeroFilas && $contador != 1){
								$jsonAcudientes .= ',{"latitud":"' . $latitud . '", "longitud":"' . $longitud . '", "tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '", "fechaVencimiento":"' . $fechaVencimiento . '", "fechanacimiento":"' . $fechanacimiento . '", "arl":"' . $arl . '", "cargo":"' . $cargo . '", "edad":"' . $edad . '", "gcm_regid":"' . $gcm_regid . '"}';	
							}
						}
						$contador+=1;
					}	
				}else{
					$queryMonitor = "SELECT c.*, m.* FROM `credenciales` c INNER JOIN monitor m ON m.idmonitor = c.idUsuarioSecundario WHERE c.`idCredencial` ='$idUsuario'";
					$resultMonitor = mysqli_query($conexion, $queryMonitor);
					if(mysqli_num_rows($resultMonitor) > 0){
						$registroMonitor = mysqli_fetch_array($resultMonitor, MYSQL_ASSOC);
						$jsonAcudientes .= json_encode($registroMonitor);		
					}else{
						$queryConductor = "SELECT c.*, con.* FROM `credenciales` c INNER JOIN conductor con ON con.idconductor = c.idUsuarioSecundario WHERE c.`idCredencial` ='$idUsuario'";
						$resultConductor = mysqli_query($conexion, $queryConductor);
						$registroConductor = mysqli_fetch_array($resultConductor, MYSQL_ASSOC);
						$jsonAcudientes .= json_encode($registroConductor);		
					}
				}


				
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		
		public function ConsultarUsuarioPorCredencialAcudiente($idUsuario, $acudiente){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT c . * , u.* FROM  `credenciales` c INNER JOIN usuarios u ON u.idUsuario = c.idUsuarioSecundario WHERE c.`idCredencial` ='$idUsuario' AND c.`idUsuarioPrincipal` =  '$acudiente'";
			
			$result = mysqli_query($conexion, $query);
			//9b4230f8-d668-11e5-aa3e-003067d17d8f
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
					$SaldoCredencial = $registro["SaldoCredencial"];
					$fechanacimiento = $registro["fechanacimiento"];
					$idCredencial = $registro["idCredencial"];
					$curso = $registro["curso"];
					$TipoSangre = $registro["TipoSangre"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '", "fechanacimiento":"' . $fechanacimiento . '"}';
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '", "fechanacimiento":"' . $fechanacimiento . '"}';
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
		
		public function ConsultarUsuariosPorAcudiente($acudiente){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT c. * , u.`idUsuario` , u.`TipoUsuario` , u.`TipoId` , u.`NumeroId` , u.`PrimerApellido` , u.`SegundoApellido` , u.`PrimerNombre` , u.`SegundoNombre` , u.`ImagenFotografica` , u.`idAcudiente` , u.`Direccion` , u.`Telefono1` , u.`Telefono2` , u.`Estado`  , u.`Clave`, u.`curso`, u.`TipoSangre`, u.`Coordenadas` FROM  `credenciales` c INNER JOIN usuarios u ON u.idUsuario = c.idUsuarioSecundario WHERE c.`idUsuarioPrincipal` = '$acudiente'";
			
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
					$estado = $registro["EstadoCredencial"];
					$ImagenFotografica = $registro["ImagenFotografica"];
					$SaldoCredencial = $registro["SaldoCredencial"];
					$idCredencial = $registro["idCredencial"];
					$curso = $registro["curso"];
					$TipoSangre = $registro["TipoSangre"];
					$Coordenadas = $registro["Coordenadas"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '", "Coordenadas":"' . $Coordenadas . '"}';
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '", "curso":"' . $curso . '", "TipoSangre":"' . $TipoSangre . '", "Coordenadas":"' . $Coordenadas . '"}';
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}

		public function ConsultarDatosUsuario($idUsuario){
			$conexionBD = new ConexionBD();
			$json = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT usuarios.* FROM `usuarios` WHERE usuarios.`idUsuario`='$idUsuario'";
			
			$result = mysqli_query($conexion, $query);
			
			if(mysqli_num_rows($result) > 0){
				while($registro = mysqli_fetch_array($result, MYSQL_ASSOC)){
					
					if($contador == 1){
						$json .= json_encode($registro);	
						$contador++;
					}else{
						$json .= ',' . json_encode($registro);	
						
					}					
				}	
			}else{
			}
			
			$json .= "]";				
			return $json;
		}
	}
?>