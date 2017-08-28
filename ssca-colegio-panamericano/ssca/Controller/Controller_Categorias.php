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

		public function ObtenerCategoria($codigo){
			$conexionBD = new ConexionBD();
			$jsonCredencial = "";
			$contador = 1;
			//obtener hora actual
			$time = time();
			$tiempoactual = date("H:i:s", $time);
			
			$conexion = $conexionBD->conectar();
			
			$querySelect = "SELECT categoria.* FROM `categoria` WHERE categoria.codigo='$codigo'";
			
			$resultSelect = mysqli_query($conexion, $querySelect);
			
			if($resultSelect != null){
				$numeroFilas = mysqli_num_rows($resultSelect);
				
				while($registro = mysqli_fetch_array($resultSelect)){						
					if($registro["codigo"] != "10" && $registro["codigo"] != "15"){
						if($contador == 1){
							$jsonCredencial .= json_encode($registro);	
						}else{
							if($contador <= $numeroFilas && $contador != 1){
								$jsonCredencial .= ',' . json_encode($registro);	;	
							}
						}
						$contador+=1;
					}
					
				}	
			}
			
			$jsonCredencial .= "";		
			
			mysqli_close($conexion);
			return $jsonCredencial;
		}
		
		public function ListarCategorias(){
			$conexionBD = new ConexionBD();
			$jsonCredencial = "[";
			$contador = 1;
			//obtener hora actual
			$time = time();
			$tiempoactual = date("H:i:s", $time);
			
			$conexion = $conexionBD->conectar();
			
			$querySelect = "SELECT categoria.* FROM `categoria` ORDER BY `codigo` ASC";
			
			$resultSelect = mysqli_query($conexion, $querySelect);
			
			if($resultSelect != null){
				$numeroFilas = mysqli_num_rows($resultSelect);
				
				while($registro = mysqli_fetch_array($resultSelect)){						
					if($registro["codigo"] != "10" && $registro["codigo"] != "15"){
						if($contador == 1){
							$jsonCredencial .= json_encode($registro);	
						}else{
							if($contador <= $numeroFilas && $contador != 1){
								$jsonCredencial .= ',' . json_encode($registro);	;	
							}
						}
						$contador+=1;
					}
					
				}	
			}
			
			$jsonCredencial .= "]";		
			
			mysqli_close($conexion);
			return $jsonCredencial;
		}
	}
?>