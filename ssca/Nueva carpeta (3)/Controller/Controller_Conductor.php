<?php

	
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataConductor.php');
	
	class Controller_Usuario {
		
		public function __construct(){
			
		}
				
		public function CrearConductor(DataConductor $conductor){
			$conexionBD = new ConexionBD();
			$tipoId = $conductor->getTipoId();	
			$numeroId = $conductor->getNumeroId();
			$primerApellido = $conductor->getPrimerApellido();
			$segundoApellido = $conductor->getSegundoApellido();
			$primerNombre = $conductor->getPrimerNombre();
			$segundoNombre = $conductor->getSegundoNombre();
			$direccion = $conductor->getDireccion();
			$telefono1 = $conductor->getTelefono1();	
			$telefono2 = $conductor->getTelefono2();
			$Licencia = $conductor->getLicencia();
			$email = $conductor->getEmail();	
			$imagenFotografica = $conductor->getImagenFotografica();
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `conductor` (`idconductor`, `nombre`, `nombre2`, `apellido`, `apellido2`, `direccion`, `telefono`, `telefono2`, `Tipoidentificacion`, `licencianumero`, `email`, `imagen`) VALUES ('$numeroId', '$primerNombre', '$segundoNombre', '$primerApellido', '$segundoApellido', '$direccion', '$telefono1', '$telefono2', '$tipoId', '$Licencia', '$email', '$imagenFotografica');";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ModificarConductor(DataConductor $conductor){
			$conexionBD = new ConexionBD();
			
			$tipoId = $conductor->getTipoId();	
			$numeroId = $conductor->getNumeroId();
			$primerApellido = $conductor->getPrimerApellido();
			$segundoApellido = $conductor->getSegundoApellido();
			$primerNombre = $conductor->getPrimerNombre();
			$segundoNombre = $conductor->getSegundoNombre();
			$direccion = $conductor->getDireccion();
			$telefono1 = $conductor->getTelefono1();	
			$telefono2 = $conductor->getTelefono2();
			$Licencia = $conductor->getLicencia();
			$email = $conductor->getEmail();	
			$imagenFotografica = $conductor->getImagenFotografica();
			$conexion = $conexionBD->conectar();
			
			$query = "UPDATE `conductor` SET `idconductor`='$numeroId',`nombre`='$primerNombre',`nombre2`='$segundoNombre',`apellido`='$primerApellido',`apellido2`='$segundoApellido',`direccion`='$direccion',`telefono`='$telefono1',`telefono2`='$telefono2',`Tipoidentificacion`='$tipoId',`licencianumero`='$Licencia',`email`='$email',`imagen`='$imagenFotografica' WHERE `idUsuario` = '$usuario'";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ExisteUsuario($idconductor){
			$conexionBD = new ConexionBD();
			$existe = false;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `conductor` WHERE `idconductor`='$idconductor'";
			
			$result = mysqli_query($conexion, $query);
			
			$registro = mysqli_fetch_array($result);
			
			if($registro != null){
				$existe = true;				
			}
			return $existe;
		}
		
		
		
		public function ConsultarUsuario($idconductor){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT `idconductor`, `nombre`, `nombre2`, `apellido`, `apellido2`, `direccion`, `telefono`, `telefono2`, `Tipoidentificacion`, `licencianumero`, `email`, `imagen` FROM `conductor` WHERE `idconductor`='$idconductor'";
			
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
					$Licencia = $registro["Licencia"];	
					$email = $registro["Email"];
					$ImagenFotografica = $registro["Imagen"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "Licencia":"' . $Licencia . '", "email":"' . $email . '", "Imagen":"' . $ImagenFotografica . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
						 $jsonAcudientes .= '{"tipoId":"' . $tipoId . '", "numeroId":"' . $numeroId . '", "primerApellido":"' . $primerApellido . '", "segundoApellido":"' . $segundoApellido . '", "primerNombre":"' . $primerNombre . '", "segundoNombre":"' . $segundoNombre . '", "direccion":"' . $direccion . '", "telefono1":"' . $telefono1 . '", "telefono2":"' . $telefono2 . '", "Licencia":"' . $Licencia . '", "email":"' . $email . '", "Imagen":"' . $ImagenFotografica . '"}';
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