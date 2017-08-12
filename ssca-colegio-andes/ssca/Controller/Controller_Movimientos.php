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
			$origen = $movimiento->getOrigen();
			
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `movimientos` (`idUsuario`, `idCredencial`, `ValorMovimiento`, `FechaMovimiento`, `HoraMovimiento`, `DescripcionMovimiento`, `OrigenPedido`) VALUES ('$idUsuario', '$idCredencial', $valorMovimiento, '$fechaMovimiento', '$horaMovimiento', '$descripcionMovimiento', '$origen');";
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ReporteCaja($fechaInicial, $fechaFinal, $usuario){
			$conexionBD = new ConexionBD();
			$jsonCredencial = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$querySelect = "SELECT us.*, m.ValorMovimiento, m.idCredencial, m.FechaMovimiento, m.HoraMovimiento, m.DescripcionMovimiento From movimientos m INNER JOIN credenciales c ON c.idCredencial = m.idCredencial INNER JOIN usuarios us ON us.idUsuario = c.idUsuarioSecundario WHERE (m.`FechaMovimiento` BETWEEN '$fechaInicial' AND '$fechaFinal') AND (m.`DescripcionMovimiento`='Recargue Caja' OR m.`DescripcionMovimiento`='recargue monetario') AND m.idUsuario = '$usuario'";
			
			$resultSelect = mysqli_query($conexion, $querySelect);
			
			if($resultSelect != null){
				$numeroFilas = mysqli_num_rows($resultSelect);
				
				while($registro = mysqli_fetch_array($resultSelect)){
					$idCredencial = $registro["idCredencial"];	
					$ValorMovimiento = $registro["ValorMovimiento"];	
					$FechaMovimiento = $registro["FechaMovimiento"];	
					$HoraMovimiento = $registro["HoraMovimiento"];	
					$DescripcionMovimiento = $registro["DescripcionMovimiento"];
					$idUsuario = $registro["idUsuario"];	
					$idAcudiente = $registro["idAcudiente"];	
					$TipoUsuario = $registro["TipoUsuario"];	
					$PrimerApellido = $registro["PrimerApellido"];	
					$SegundoApellido = $registro["SegundoApellido"];	
					$PrimerNombre = $registro["PrimerNombre"];	
					$SegundoNombre = $registro["SegundoNombre"];
					$acudiente = "";
					$numeroDocAcudiente = "";
					if($TipoUsuario  == "Estudiante"){
						$queryAcudiente = "SELECT * FROM usuarios WHERE idUsuario LIKE  '$idAcudiente'";
						$resultAcudiente = mysqli_query($conexion, $queryAcudiente);
						if($resultAcudiente != null){
							$row = mysqli_fetch_array($resultAcudiente);
							$acudiente = $row["PrimerNombre"] . " " . $row["SegundoNombre"] . " " . $row["PrimerApellido"] . " " . $row["SegundoApellido"];
							$numeroDocAcudiente = $row["TipoId"] . " " . $row["NumeroId"];
						}
					}
					if($contador == 1){
						$jsonCredencial .= '{"idCredencial":"' . $idCredencial . '", "ValorMovimiento":"' . $ValorMovimiento . '", "FechaMovimiento":"' . $FechaMovimiento . '", "HoraMovimiento":"' . $HoraMovimiento . '", "DescripcionMovimiento":"' . $DescripcionMovimiento . '", "idUsuario":"' . $idUsuario . '", "PrimerApellido":"' . $PrimerApellido . '", "SegundoApellido":"' . $SegundoApellido . '", "PrimerNombre":"' . $PrimerNombre . '", "SegundoNombre":"' . $SegundoNombre . '", "Acudiente":"' . $acudiente . '", "NumeroIdAcudiente":"' . $numeroDocAcudiente . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonCredencial .= ',{"idCredencial":"' . $idCredencial . '", "ValorMovimiento":"' . $ValorMovimiento . '", "FechaMovimiento":"' . $FechaMovimiento . '", "HoraMovimiento":"' . $HoraMovimiento . '", "DescripcionMovimiento":"' . $DescripcionMovimiento . '", "idUsuario":"' . $idUsuario . '", "PrimerApellido":"' . $PrimerApellido . '", "SegundoApellido":"' . $SegundoApellido . '", "PrimerNombre":"' . $PrimerNombre . '", "SegundoNombre":"' . $SegundoNombre . '", "Acudiente":"' . $acudiente . '", "NumeroIdAcudiente":"' . $numeroDocAcudiente . '"}';	
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonCredencial .= "]";		
			
			mysqli_close($conexion);
			return $jsonCredencial;
		}

		public function ReporteDevoluciones($fechaInicial, $fechaFinal, $usuario){
			$conexionBD = new ConexionBD();
			$jsonCredencial = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$querySelect = "SELECT us.*, m.ValorMovimiento, m.idCredencial, m.FechaMovimiento, m.HoraMovimiento, m.DescripcionMovimiento From movimientos m INNER JOIN credenciales c ON c.idCredencial = m.idCredencial INNER JOIN usuarios us ON us.idUsuario = c.idUsuarioSecundario WHERE (m.`FechaMovimiento` BETWEEN '$fechaInicial' AND '$fechaFinal') AND m.`DescripcionMovimiento`='Devolucion Saldo' AND m.idUsuario = '$usuario'";
			
			$resultSelect = mysqli_query($conexion, $querySelect);
			
			if($resultSelect != null){
				$numeroFilas = mysqli_num_rows($resultSelect);
				
				while($registro = mysqli_fetch_array($resultSelect)){
					$idCredencial = $registro["idCredencial"];	
					$ValorMovimiento = $registro["ValorMovimiento"];	
					$FechaMovimiento = $registro["FechaMovimiento"];	
					$HoraMovimiento = $registro["HoraMovimiento"];	
					$DescripcionMovimiento = $registro["DescripcionMovimiento"];
					$idUsuario = $registro["idUsuario"];	
					$idAcudiente = $registro["idAcudiente"];	
					$TipoUsuario = $registro["TipoUsuario"];	
					$PrimerApellido = $registro["PrimerApellido"];	
					$SegundoApellido = $registro["SegundoApellido"];	
					$PrimerNombre = $registro["PrimerNombre"];	
					$SegundoNombre = $registro["SegundoNombre"];
					$acudiente = "";
					$numeroDocAcudiente = "";
					if($TipoUsuario  == "Estudiante"){
						$queryAcudiente = "SELECT * FROM usuarios WHERE idUsuario LIKE  '$idAcudiente'";
						$resultAcudiente = mysqli_query($conexion, $queryAcudiente);
						if($resultAcudiente != null){
							$row = mysqli_fetch_array($resultAcudiente);
							$acudiente = $row["PrimerNombre"] . " " . $row["SegundoNombre"] . " " . $row["PrimerApellido"] . " " . $row["SegundoApellido"];
							$numeroDocAcudiente = $row["TipoId"] . " " . $row["NumeroId"];
						}
					}
					if($contador == 1){
						$jsonCredencial .= '{"idCredencial":"' . $idCredencial . '", "ValorMovimiento":"' . $ValorMovimiento . '", "FechaMovimiento":"' . $FechaMovimiento . '", "HoraMovimiento":"' . $HoraMovimiento . '", "DescripcionMovimiento":"' . $DescripcionMovimiento . '", "idUsuario":"' . $idUsuario . '", "PrimerApellido":"' . $PrimerApellido . '", "SegundoApellido":"' . $SegundoApellido . '", "PrimerNombre":"' . $PrimerNombre . '", "SegundoNombre":"' . $SegundoNombre . '", "Acudiente":"' . $acudiente . '", "NumeroIdAcudiente":"' . $numeroDocAcudiente . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonCredencial .= ',{"idCredencial":"' . $idCredencial . '", "ValorMovimiento":"' . $ValorMovimiento . '", "FechaMovimiento":"' . $FechaMovimiento . '", "HoraMovimiento":"' . $HoraMovimiento . '", "DescripcionMovimiento":"' . $DescripcionMovimiento . '", "idUsuario":"' . $idUsuario . '", "PrimerApellido":"' . $PrimerApellido . '", "SegundoApellido":"' . $SegundoApellido . '", "PrimerNombre":"' . $PrimerNombre . '", "SegundoNombre":"' . $SegundoNombre . '", "Acudiente":"' . $acudiente . '", "NumeroIdAcudiente":"' . $numeroDocAcudiente . '"}';	
						}
					}
					$contador+=1;
				}	
			}
			
			$jsonCredencial .= "]";		
			
			mysqli_close($conexion);
			return $jsonCredencial;
		}

		public function ReportePedidos($fechaInicial, $fechaFinal){
			$conexionBD = new ConexionBD();
			$jsonCredencial = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$querySelect = "SELECT movimientos.*, usuarios.* FROM `movimientos` INNER JOIN credenciales ON credenciales.idCredencial = movimientos.idCredencial INNER JOIN usuarios ON credenciales.idUsuarioSecundario = usuarios.idUsuario WHERE movimientos.`DescripcionMovimiento` LIKE '%No. Pedido %' AND movimientos.FechaMovimiento BETWEEN '$fechaInicial' AND '$fechaFinal'";
			
			$resultSelect = mysqli_query($conexion, $querySelect);
			
			if($resultSelect != null){
				$numeroFilas = mysqli_num_rows($resultSelect);
				
				while($registro = mysqli_fetch_array($resultSelect)){
					
					if($contador == 1){
						$jsonCredencial .= json_encode($registro);	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonCredencial .= ',' . json_encode($registro);	
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
			
			$querySelect = "Select * From movimientos WHERE (`FechaMovimiento` BETWEEN '$fechaInicial' AND '$fechaFinal') AND `idCredencial`='$usuario' AND (DescripcionMovimiento<>'costo de asignación de tarjeta nueva' AND NOT DescripcionMovimiento LIKE '%No de pedido%' AND DescripcionMovimiento<>'cambio de credencial' AND NOT DescripcionMovimiento LIKE 'comisión transaccional traslado de fondos') ORDER BY `FechaMovimiento` ASC";
			
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