<?php
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataMovimientos.php');
	
	class Controller_Movimientos { 
	
		public function __construct(){
			
		}
		
		public function CrearMovimiento(DataMovimientos $movimiento){
			$conexionBD = new ConexionBD();
			
			$idUsuario = $movimiento->getIdUsuario();
			$idCredencial = $movimiento->getIdCredencial();
			$valorMovimiento = $movimiento->getValorMovimiento();
			$fechaMovimiento = $movimiento->getFechaMovimiento();
			$horaMovimiento = $movimiento->getHoraMovimiento();
			$descripcionMovimiento = $movimiento->getDescripcionMovimiento();
			
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `ssca`.`movimientos` (`idUsuario`, `idCredencial`, `ValorMovimiento`, `FechaMovimiento`, `HoraMovimiento`, `DescripcionMovimiento`) VALUES ('$idUsuario', '$idCredencial', $valorMovimiento, '$fechaMovimiento', '$horaMovimiento', '$descripcionMovimiento');";
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ReporteCaja($fechaInicial, $fechaFinal, $usuario){
			$conexionBD = new ConexionBD();
			$jsonCredencial = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$querySelect = "Select * From movimientos WHERE (`FechaMovimiento` BETWEEN '$fechaInicial' AND '$fechaFinal') AND `idUsuario`='$usuario' AND `DescripcionMovimiento`='Recargue Caja';";
			
			$resultSelect = mysqli_query($conexion, $querySelect);
			
			if($resultSelect != null){
				$numeroFilas = mysqli_num_rows($resultSelect);
				
				while($registro = mysqli_fetch_array($resultSelect)){
					$idCredencial = $registro["idCredencial"];	
					$ValorMovimiento = $registro["ValorMovimiento"];	
					$FechaMovimiento = $registro["FechaMovimiento"];	
					$HoraMovimiento = $registro["HoraMovimiento"];	
					$DescripcionMovimiento = $registro["DescripcionMovimiento"];
					
					if($contador == 1){
						$jsonCredencial .= '{"idCredencial":"' . $idCredencial . '", "ValorMovimiento":"' . $ValorMovimiento . '", "FechaMovimiento":"' . $FechaMovimiento . '", "HoraMovimiento":"' . $HoraMovimiento . '", "DescripcionMovimiento":"' . $DescripcionMovimiento . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonCredencial .= ',{"idCredencial":"' . $idCredencial . '", "ValorMovimiento":"' . $ValorMovimiento . '", "FechaMovimiento":"' . $FechaMovimiento . '", "HoraMovimiento":"' . $HoraMovimiento . '", "DescripcionMovimiento":"' . $DescripcionMovimiento . '"}';	
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonCredencial .= "]";		
			
			mysqli_close($conexion);
			return $jsonCredencial;
		}
		
		public function ReporteMovimientosAcudiente($fechaInicial, $fechaFinal, $usuario){
			$conexionBD = new ConexionBD();
			$jsonCredencial = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$querySelect = "Select * From movimientos WHERE (`FechaMovimiento` BETWEEN '$fechaInicial' AND '$fechaFinal') AND `idCredencial`='$usuario';";
			
			$resultSelect = mysqli_query($conexion, $querySelect);
			
			if($resultSelect != null){
				$numeroFilas = mysqli_num_rows($resultSelect);
				
				while($registro = mysqli_fetch_array($resultSelect)){
					$idCredencial = $registro["idCredencial"];	
					$ValorMovimiento = $registro["ValorMovimiento"];	
					$FechaMovimiento = $registro["FechaMovimiento"];	
					$HoraMovimiento = $registro["HoraMovimiento"];	
					$DescripcionMovimiento = $registro["DescripcionMovimiento"];
					
					if($contador == 1){
						$jsonCredencial .= '{"idCredencial":"' . $idCredencial . '", "ValorMovimiento":"' . $ValorMovimiento . '", "FechaMovimiento":"' . $FechaMovimiento . '", "HoraMovimiento":"' . $HoraMovimiento . '", "DescripcionMovimiento":"' . $DescripcionMovimiento . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonCredencial .= ',{"idCredencial":"' . $idCredencial . '", "ValorMovimiento":"' . $ValorMovimiento . '", "FechaMovimiento":"' . $FechaMovimiento . '", "HoraMovimiento":"' . $HoraMovimiento . '", "DescripcionMovimiento":"' . $DescripcionMovimiento . '"}';	
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