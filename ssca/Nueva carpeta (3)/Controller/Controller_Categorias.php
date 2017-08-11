<?php
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataCategoria.php');
	
	class Controller_Categorias { 
	
		public function __construct(){
			
		}
		
		public function CrearCategoria($nombre){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `categoria`(`codigo`, `Nombre`) VALUES (NULL,'$nombre')";
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ModificarCategoria($nombre, $idCategoria){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$query = "UPDATE `categoria` SET `Nombre`='$nombre' WHERE `codigo`='$idCategoria'";
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ListarCategorias(){
			$conexionBD = new ConexionBD();
			$jsonCredencial = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$querySelect = "SELECT * FROM `categoria`";
			
			$resultSelect = mysqli_query($conexion, $querySelect);
			
			if($resultSelect != null){
				$numeroFilas = mysqli_num_rows($resultSelect);
				
				while($registro = mysqli_fetch_array($resultSelect)){
					$codigo = $registro["codigo"];	
					$Nombre = $registro["Nombre"];	
					
					if($contador == 1){
						$jsonCredencial .= '{"codigo":"' . $codigo . '", "Nombre":"' . $Nombre . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonCredencial .= ',{"codigo":"' . $codigo . '", "Nombre":"' . $Nombre . '"}';	
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