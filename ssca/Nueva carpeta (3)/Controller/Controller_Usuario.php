<?php

	
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataUsuario.php');
	
	class Controller_Usuario {
		
		public function __construct(){
			
		}
				
		public function CrearUsuario(DataUsuario $usuario){
			$conexionBD = new ConexionBD();
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
			$usuario = $usuario->getIdUsuario();
			
			$coordenadas = $latitud . ", " . $longitud;
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `usuarios` (`idUsuario`, `TipoUsuario`, `TipoId`, `NumeroId`, `PrimerApellido`, `SegundoApellido`, `PrimerNombre`, `SegundoNombre`, `ImagenFotografica`, `idAcudiente`, `Direccion`, `Telefono1`, `Telefono2`, `Estado`, `Clave`, `Coordenadas`) VALUES ('$usuario', '$tipoUsuario', '$tipoId', '$numeroId', '$primerApellido', '$segundoApellido', '$primerNombre', '$segundoNombre', '$imagenFotografica', '$idAcudiente', '$direccion', '$telefono1', '$telefono2', 'ACTIVO', '$pass', '$coordenadas');";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
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
			$usuario = $usuario->getIdUsuario();
			
			
			$conexion = $conexionBD->conectar();
			
			$query = "UPDATE `usuarios` SET `NumeroId`='$numeroId',`PrimerApellido`='$primerApellido',`SegundoApellido`='$segundoApellido',`PrimerNombre`='$primerNombre',`SegundoNombre`='$segundoNombre',`ImagenFotografica`='$imagenFotografica',`idAcudiente`='$idAcudiente',`Direccion`='$direccion',`Telefono1`='$telefono1',`Telefono2`='$telefono2',`Estado`='$estado',`Clave`='$pass' WHERE `idUsuario` = '$usuario'";
			
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
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '"}';
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
			
			$query = "SELECT `idUsuario`, `TipoUsuario`, `TipoId`, `NumeroId`, `PrimerApellido`, `SegundoApellido`, `PrimerNombre`, `SegundoNombre`, `ImagenFotografica`, `idAcudiente`, `Direccion`, `Telefono1`, `Telefono2`, `Estado`, `Clave` FROM `usuarios` WHERE `NumeroId`='$idUsuario'";
			
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
							$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '"}';
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
			
			$query = "SELECT `idUsuario`, `TipoUsuario`, `TipoId`, `NumeroId`, `PrimerApellido`, `SegundoApellido`, `PrimerNombre`, `SegundoNombre`, `ImagenFotografica`, `idAcudiente`, `Direccion`, `Telefono1`, `Telefono2`, `Estado`, `Clave` FROM `usuarios` WHERE `idUsuario`='$idUsuario'";
			
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
							$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '"}';
						}
					}
					$contador+=1;
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
			
			$query = "SELECT c.*, u.* FROM `usuarios` u, `credenciales` c WHERE u.`idUsuario`='$idUsuario' AND u.`idAcudiente`='$acudiente' AND c.`idUsuarioPrincipal`='$acudiente' AND `idUsuarioSecundario`='$idUsuario'";
			
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
					$SaldoCredencial = $registro["SaldoCredencial"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '"}';
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
			
			$query = "SELECT `idUsuario`, `TipoUsuario`, `TipoId`, `NumeroId`, `PrimerApellido`, `SegundoApellido`, `PrimerNombre`, `SegundoNombre`, `ImagenFotografica`, `idAcudiente`, `Direccion`, `Telefono1`, `Telefono2`, `Estado`, `Clave` FROM `usuarios` WHERE `idUsuario`='$idUsuario' AND `Clave`='$clave' AND `Estado`='ACTIVO'";
			
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
		
		public function IniciarSesionEstudiante($idUsuario, $clave){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT `idUsuario`, `TipoUsuario`, `TipoId`, `NumeroId`, `PrimerApellido`, `SegundoApellido`, `PrimerNombre`, `SegundoNombre`, `ImagenFotografica`, `idAcudiente`, `Direccion`, `Telefono1`, `Telefono2`, `Estado`, `Clave` FROM `usuarios` WHERE `idUsuario`='$idUsuario' AND `Clave`='$clave' AND `TipoUsuario`='Estudiante' AND `Estado`='ACTIVO'";
			
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
		
		public function ConsultarUsuarioPorCredencial($idUsuario){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT c . * , u.`idUsuario` , u.`TipoUsuario` , u.`TipoId` , u.`NumeroId` , u.`PrimerApellido` , u.`SegundoApellido` , u.`PrimerNombre` , u.`SegundoNombre` , u.`ImagenFotografica` , u.`idAcudiente` , u.`Direccion` , u.`Telefono1` , u.`Telefono2` , u.`Estado` , u.`Clave` FROM  `credenciales` c INNER JOIN usuarios u ON u.idUsuario = c.idUsuarioSecundario WHERE c.`idCredencial` ='$idUsuario'";
			
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
					$SaldoCredencial = $registro["SaldoCredencial"];
					$idCredencial = $registro["idCredencial"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '"}';
						}
					}
					$contador+=1;
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
			
			$query = "SELECT c . * , u.`idUsuario` , u.`TipoUsuario` , u.`TipoId` , u.`NumeroId` , u.`PrimerApellido` , u.`SegundoApellido` , u.`PrimerNombre` , u.`SegundoNombre` , u.`ImagenFotografica` , u.`idAcudiente` , u.`Direccion` , u.`Telefono1` , u.`Telefono2` , u.`Estado` , u.`Clave` FROM  `credenciales` c INNER JOIN usuarios u ON u.idUsuario = c.idUsuarioSecundario WHERE c.`idCredencial` ='$idUsuario' AND u.`idAcudiente` =  '$acudiente'";
			
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
					$SaldoCredencial = $registro["SaldoCredencial"];
					$idCredencial = $registro["idCredencial"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '"}';
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
			
			$query = "SELECT c. * , u.`idUsuario` , u.`TipoUsuario` , u.`TipoId` , u.`NumeroId` , u.`PrimerApellido` , u.`SegundoApellido` , u.`PrimerNombre` , u.`SegundoNombre` , u.`ImagenFotografica` , u.`idAcudiente` , u.`Direccion` , u.`Telefono1` , u.`Telefono2` , u.`Estado` , u.`Clave` FROM  `credenciales` c INNER JOIN usuarios u ON u.idUsuario = c.idUsuarioSecundario WHERE u.`idAcudiente` =  '$acudiente'";
			
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
					$SaldoCredencial = $registro["SaldoCredencial"];
					$idCredencial = $registro["idCredencial"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "tipoUsuario":"' . $tipoUsuario . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "idAcudiente":"' . $idAcudiente . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '", "SaldoCredencial":"' . $SaldoCredencial . '", "idCredencial":"' . $idCredencial . '"}';
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonAcudientes .= "]";		
			
			return $jsonAcudientes;
		}
	}
?>