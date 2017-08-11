<?php
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataSubCategoria.php');
	
	class Controller_SubCategorias { 
	
		public function __construct(){
			
		}
		
		public function CrearSubCategoria($nombre, $idCategoria){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `sub-categoria`(`codigo`, `Nombre`, `idCategoria`) VALUES (NULL,'$nombre','$idCategoria')";
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ModificarSubCategoria($nombre, $idCategoria, $codigoSubCategoria){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$query = "UPDATE `sub-categoria` SET `Nombre`='$nombre',`idCategoria`='$idCategoria' WHERE `codigo`='$codigoSubCategoria'";
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ListarSubCategorias($idCategoria){
			$conexionBD = new ConexionBD();
			$jsonCredencial = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$querySelect = "SELECT * FROM `sub-categoria` WHERE `idCategoria`='$idCategoria'";
			
			$resultSelect = mysqli_query($conexion, $querySelect);
			
			if($resultSelect != null){
				$numeroFilas = mysqli_num_rows($resultSelect);
				
				while($registro = mysqli_fetch_array($resultSelect)){
					$codigo = $registro["codigo"];	
					$Nombre = $registro["Nombre"];	
					$idCategoria = $registro["idCategoria"];	
					
					if($contador == 1){
						$jsonCredencial .= '{"codigo":"' . $codigo . '", "Nombre":"' . $Nombre . '", "idCategoria":"' . $idCategoria . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonCredencial .= ',{"codigo":"' . $codigo . '", "Nombre":"' . $Nombre . '", "idCategoria":"' . $idCategoria . '"}';	
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonCredencial .= "]";		
			
			mysqli_close($conexion);
			return $jsonCredencial;
		}
	}
?>