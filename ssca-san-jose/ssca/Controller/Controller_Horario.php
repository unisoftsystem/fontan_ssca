<?php
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataHorario.php');
	
	class Controller_Horario { 
	
		public function __construct(){
			
		}
		
		/*public function CrearRegistroControl(DataRegistroControl $registroControl){
			$conexionBD = new ConexionBD();
			
			$idCredencial = $registroControl->getIdCredencial();
			$idUsuario = $registroControl->getIdUsuario();
			$tipo = $registroControl->getTipo();
			$fecha = $registroControl->getFecha();
			$hora = $registroControl->getHora();
			
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `registrocontrol`(`idControl`, `idCredencial`, `idUsuario`, `Tipo`, `Fecha`, `Hora`) VALUES (NULL,'$idCredencial','$idUsuario','$tipo','$fecha','$hora')";
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}*/
		
		//Funcion para saber si el ultimo registro de una credencial es una entrada
		public function ConsultarHorario(){
			$conexionBD = new ConexionBD();
			$jsonCredencial = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT h.* FROM `detallehorario` dh, `horario` h WHERE h.`idHorario`= dh.`idHorario`";
			
			$resultSelect = mysqli_query($conexion, $query);
				
			if($resultSelect != null){
				$numeroFilas = mysqli_num_rows($resultSelect);
				
				while($registro = mysqli_fetch_array($resultSelect)){
					$idHorario = $registro["idHorario"];	
					$HoraEntrada = $registro["HoraEntrada"];	
					$HoraSalida = $registro["HoraSalida"];	
					$Titulo = $registro["Titulo"];	
					
					if($contador == 1){
						$jsonCredencial .= '{"idHorario":"' . $idHorario . '", "HoraEntrada":"' . $HoraEntrada . '", "HoraSalida":"' . $HoraSalida . '", "Titulo":"' . $Titulo . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonCredencial .= ',{"idHorario":"' . $idHorario . '", "HoraEntrada":"' . $HoraEntrada . '", "HoraSalida":"' . $HoraSalida . '", "Titulo":"' . $Titulo . '"}';	
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