<?php

	
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataConductor.php');
	
	class Controller_Conductor {
		
		public function __construct(){
			
		}
				
		public function CrearConductor(DataConductor $conductor){
			$conexionBD = new ConexionBD();
			$latitud = $conductor->getLatitud();
			$longitud = $conductor->getLongitud();
			$idconductor = $conductor->getIdconductor();	
			$TipoId = $conductor->getTipoId();
			$nombre = $conductor->getNombre();
			$apellido = $conductor->getApellido();
			$TipoUsuario = $conductor->getTipoUsuario();
			$telefono = $conductor->getTelefono();
			$direccion = $conductor->getDireccion();	
			$tipoUsuario = $conductor->getTipoUsuario();	
			$imagenFotografica = $conductor->getImagenFotografica();
			$coordenadas = $latitud . ", " . $longitud;
			$arl = $conductor->getArl();
			$tipoSangre = $conductor->getTipoSangre();
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `conductor`(`idconductor`, `nombre`, `apellido`, `direccion`, `telefono`, `TipoUsuario`, `TipoId`, `ImagenFotografica`, `Estado`, `Coordenadas`, `TipoSangre`, `arl`) VALUES ('$idconductor','$nombre','$apellido','$direccion','$telefono','$TipoUsuario','$TipoId','$imagenFotografica','ACTIVO','$coordenadas', '$tipoSangre', '$arl');";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ModificarConductor(DataConductor $conductor){
			$conexionBD = new ConexionBD();
			
			$latitud = $conductor->getLatitud();
			$longitud = $conductor->getLongitud();
			$idconductor = $conductor->getIdconductor();	
			$TipoId = $conductor->getTipoId();
			$nombre = $conductor->getNombre();
			$apellido = $conductor->getApellido();
			$TipoUsuario = $conductor->getTipoUsuario();
			$telefono = $conductor->getTelefono();
			$direccion = $conductor->getDireccion();	
			$tipoUsuario = $conductor->getTipoUsuario();	
			$imagenFotografica = $conductor->getImagenFotografica();
			$estado = $conductor->getEstado();
			$arl = $conductor->getArl();
			$tipoSangre = $conductor->getTipoSangre();
			$coordenadas = $latitud . ", " . $longitud;
			$conexion = $conexionBD->conectar();
			
			$query = "UPDATE `conductor` SET `nombre`='$nombre',`apellido`='$apellido',`direccion`='$direccion',`telefono`='$telefono',`TipoUsuario`='$tipoUsuario',`TipoId`='$TipoId',`ImagenFotografica`='$imagenFotografica',`Estado`='$estado',`Coordenadas`='$coordenadas', `TipoSangre`='$tipoSangre', `arl`='$arl' WHERE `idconductor`='$idconductor'";
			
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
			
			$query = "SELECT cond.*, c.* FROM `conductor` cond INNER JOIN credenciales c ON c.idUsuarioSecundario = cond.idconductor WHERE cond.`idconductor`='$idconductor'";
			
			$result = mysqli_query($conexion, $query);
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				
				while($registro = mysqli_fetch_array($result)){
					$idconductor = $registro["idconductor"];	
					$nombre = $registro["nombre"];	
					$apellido = $registro["apellido"];	
					$direccion = $registro["direccion"];	
					$telefono = $registro["telefono"];	
					$TipoUsuario = $registro["TipoUsuario"];	
					$TipoId = $registro["TipoId"];	
					$ImagenFotografica = $registro["ImagenFotografica"];	
					$Estado = $registro["Estado"];	
					$Coordenadas = $registro["Coordenadas"];	
					$SaldoCredencial = $registro["SaldoCredencial"];	
					$FechaVencimiento = $registro["FechaVencimiento"];
					$TipoSangre = $registro["TipoSangre"];
					$arl = $registro["arl"];
					
					if($contador == 1){
						$jsonAcudientes .= '{"idconductor":"' . $idconductor . '", "nombre":"' . $nombre . '", "apellido":"' . $apellido . '", "direccion":"' . $direccion . '", "telefono":"' . $telefono . '", "TipoUsuario":"' . $TipoUsuario . '", "TipoId":"' . $TipoId . '", "ImagenFotografica":"' . $ImagenFotografica . '", "Estado":"' . $Estado . '", "Coordenadas":"' . $Coordenadas . '", "SaldoCredencial":"' . $SaldoCredencial . '", "FechaVencimiento":"' . $FechaVencimiento . '", "TipoSangre":"' . $TipoSangre . '", "arl":"' . $arl . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
						 $jsonAcudientes .= '{"idconductor":"' . $idconductor . '", "nombre":"' . $nombre . '", "apellido":"' . $apellido . '", "direccion":"' . $direccion . '", "telefono":"' . $telefono . '", "TipoUsuario":"' . $TipoUsuario . '", "TipoId":"' . $TipoId . '", "ImagenFotografica":"' . $ImagenFotografica . '", "Estado":"' . $Estado . '", "Coordenadas":"' . $Coordenadas . '", "SaldoCredencial":"' . $SaldoCredencial . '", "FechaVencimiento":"' . $FechaVencimiento . '", "TipoSangre":"' . $TipoSangre . '", "arl":"' . $arl . '"}';	
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