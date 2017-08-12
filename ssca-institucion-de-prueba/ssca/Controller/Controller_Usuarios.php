<?php

	
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataUsuarios.php');
	
	class Controller_Usuarios {
		
		public function __construct(){
			
		}
				
		public function CrearUsuarios(DataUsuarios $usuario,$permisos){
			$conexionBD = new ConexionBD();
			$pass = base64_encode($usuario->getPassword());
			$tipoId = $usuario->getTipoId();	
			$numeroId = $usuario->getNumeroId();
			$primerApellido = $usuario->getPrimerApellido();
			$segundoApellido = $usuario->getSegundoApellido();
			$primerNombre = $usuario->getPrimerNombre();
			$segundoNombre = $usuario->getSegundoNombre();
			$direccion = $usuario->getDireccion();
			$telefono1 = $usuario->getTelefono1();	
			$telefono2 = $usuario->getTelefono2();	
			$imagenFotografica = $usuario->getImagenFotografica();
			$usuario = $usuario->getIdUsuario();
			$permisos = $permisos;
			
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `usuarios_sistema` (`idUsuario`, `TipoId`, `NumeroId`, `PrimerApellido`, `SegundoApellido`, `PrimerNombre`, `SegundoNombre`, `ImagenFotografica`, `Direccion`, `Telefono1`, `Telefono2`, `Estado`, `Clave`, `permisos`) VALUES ('$usuario', '$tipoId', '$numeroId', '$primerApellido', '$segundoApellido', '$primerNombre', '$segundoNombre', '$imagenFotografica', '$direccion', '$telefono1', '$telefono2', 'ACTIVO', '$pass','$permisos');";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ModificarUsuarios(DataUsuarios $usuario,$permisos){
			$conexionBD = new ConexionBD();
			$pass = base64_encode($usuario->getPassword());
			$tipoId = $usuario->getTipoId();	
			$numeroId = $usuario->getNumeroId();
			$primerApellido = $usuario->getPrimerApellido();
			$segundoApellido = $usuario->getSegundoApellido();
			$primerNombre = $usuario->getPrimerNombre();
			$segundoNombre = $usuario->getSegundoNombre();
			$direccion = $usuario->getDireccion();
			$telefono1 = $usuario->getTelefono1();	
			$telefono2 = $usuario->getTelefono2();	
			$imagenFotografica = $usuario->getImagenFotografica();
			$usuario = $usuario->getIdUsuario();
			$conexion = $conexionBD->conectar();
			
			$query = "UPDATE `usuarios_sistema` SET `NumeroId`='$numeroId',`PrimerApellido`='$primerApellido',`SegundoApellido`='$segundoApellido',`PrimerNombre`='$primerNombre',`SegundoNombre`='$segundoNombre',`ImagenFotografica`='$imagenFotografica',`Direccion`='$direccion',`Telefono1`='$telefono1',`Telefono2`='$telefono2',`Clave`='$pass' ,`permisos`='$permisos' WHERE `idUsuario` = '$usuario'";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}


		public function IniciarSesionAcudiente($idUsuario, $clave){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT `idUsuario`, `TipoId`, `NumeroId`, `PrimerApellido`, `SegundoApellido`, `PrimerNombre`, `SegundoNombre`, `ImagenFotografica`, `Direccion`, `Telefono1`, `Telefono2`, `Estado`, `Clave` , `permisos` FROM `usuarios_sistema` WHERE `idUsuario`='$idUsuario' AND `Clave`='$clave' AND `Estado`='ACTIVO'";
			
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
					$usuario = $registro["idUsuario"];
					$clave = base64_decode($registro["Clave"]);
					$estado = $registro["Estado"];
					$permisos = $registro["permisos"];
					$ImagenFotografica = $registro["ImagenFotografica"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '",  "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "usuario":"' . $usuario . '", "clave":"' . $clave . '", "estado":"' . $estado . '", "ImagenFotografica":"' . $ImagenFotografica . '"}';
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