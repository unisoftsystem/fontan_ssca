<?php

	
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataVehiculo.php');
	
	class Controller_Vehiculo {
		
		public function __construct(){
			
		}
				
		public function CrearVehiculo(DataVehiculo $usuario){
			$conexionBD = new ConexionBD();
			$idvehiculo = $usuario->getIdvehiculo();	
			$marca = $usuario->getMarca();
			$categoria = $usuario->getCategoria();
			$placa = $usuario->getPlaca();
			$nombreruta = $usuario->getNombreruta();
			$sillas = $usuario->getSillas();
			$observaciones = $usuario->getObservaciones();	
			$imagenFotografica = $usuario->getImagenFotografica();
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `vehiculo` (`idvehiculo`, `marca`, `categoria`, `placa`, `nombre_ruta`, `sillas`, `observaciones`, `ImagenFotografica` ) VALUES ('$idvehiculo', '$marca', '$categoria', '$placa', '$nombreruta', '$sillas', '$observaciones', '$imagenFotografica');";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ModificarVehiculo(DataVehiculo $usuario){
			$conexionBD = new ConexionBD();
			
			$conexionBD = new ConexionBD();
			$marca = $usuario->getMarca();
			$categoria = $usuario->getCategoria();
			$placa = $usuario->getPlaca();
			$nombreruta = $usuario->getNombreruta();
			$sillas = $usuario->getSillas();
			$observaciones = $usuario->getObservaciones();	
			$conexion = $conexionBD->conectar();
			
			$query = "UPDATE `vehiculo` SET `marca`='$marca',`categoria`='$categoria',`nombre_ruta`='$nombreruta',`sillas`=$sillas,`observaciones`='$observaciones' WHERE `placa`='$placa'";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ExisteMonitor($idvehiculo){
			$conexionBD = new ConexionBD();
			$existe = false;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `vehiculo` WHERE `idvehiculo`='$idvehiculo'";
			
			$result = mysqli_query($conexion, $query);
			
			$registro = mysqli_fetch_array($result);
			
			if($registro != null){
				$existe = true;				
			}
			return $existe;
		}
		public function ConsultarVehiculo($placa){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `vehiculo` WHERE `placa`='$placa'";
			
			$result = mysqli_query($conexion, $query);
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				
				while($registro = mysqli_fetch_array($result)){
					$idvehiculo = $registro["idvehiculo"];	
					$marca = $registro["marca"];	
					$categoria = $registro["categoria"];	
					$placa = $registro["placa"];	
					$nombre_ruta = $registro["nombre_ruta"];	
					$sillas = $registro["sillas"];	
					$observaciones = $registro["observaciones"];	
					$ImagenFotografica = $registro["ImagenFotografica"];	
					$coordenadas = $registro["coordenadas"];	
					
					if($contador == 1){
						$jsonAcudientes .= '{"idvehiculo":"' . $idvehiculo . '", "marca":"' . $marca . '", "categoria":"' . $categoria . '", "placa":"' . $placa . '", "nombre_ruta":"' . $nombre_ruta . '", "sillas":"' . $sillas . '", "observaciones":"' . $observaciones . '", "ImagenFotografica":"' . $ImagenFotografica . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
						 $jsonAcudientes .= ',{"idvehiculo":"' . $idvehiculo . '", "marca":"' . $marca . '", "categoria":"' . $categoria . '", "placa":"' . $placa . '", "nombre_ruta":"' . $nombre_ruta . '", "sillas":"' . $sillas . '", "observaciones":"' . $observaciones . '", "ImagenFotografica":"' . $ImagenFotografica . '"}';	
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