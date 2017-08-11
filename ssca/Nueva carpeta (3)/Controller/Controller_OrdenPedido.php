<?php
		
	
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataOrdenPedido.php');
	
	class Controller_OrdenPedido {
		
		public function __construct(){
			
		}
				
		public function CrearPedido(DataOrdenPedido $usuario){
			$conexionBD = new ConexionBD();
			
			$idUsuario = $usuario->getIdUsuario();
			$idCredencial = $usuario->getIdCredencial();	
			$consecutivoTurno = $usuario->getConsecutivoTurno();
			$consecutivoInterno = $usuario->getConsecutivoInterno();
			$descripcionPedido = $usuario->getDescripcionPedido();
			$ubicacionPedido = $usuario->getUbicacionPedido();
			
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `ssca`.`ordenpedido` (`idUsuario`, `idCredencial`, `ConsecutivoTurno`, `ConsecutivoInterno`, `DescripcionPedido`, `UbicacionPedido`) VALUES ('$idUsuario', '$idCredencial', $consecutivoTurno, $consecutivoTurno, '$descripcionPedido', '$ubicacionPedido');";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ActualizarPedido($consecutivoInterno, $estado){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$query = "UPDATE `ordenpedido` SET `UbicacionPedido`= '$estado' WHERE `ConsecutivoInterno`='$consecutivoInterno'";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		public function ExisteTurno($turno){
			$conexionBD = new ConexionBD();
			$existe = false;
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `ordenpedido` WHERE `ConsecutivoTurno`='$turno'";
			
			$result = mysqli_query($conexion, $query);
			$registro = mysqli_fetch_array($result);
			
			if($registro["ConsecutivoTurno"] != null){
				$existe = true;
			}
			
			return $existe;
		}
		
		public function PedidosPorEstado($estado){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT u.*, op.* FROM `ordenpedido` op, usuarios u WHERE op.`UbicacionPedido`='$estado' AND u.idUsuario = op.idUsuario";
			
			$result = mysqli_query($conexion, $query);
			
			
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				
				while($registro = mysqli_fetch_array($result)){
					$idUsuario = $registro["idUsuario"];	
					$idCredencial = $registro["idCredencial"];	
					$ConsecutivoTurno = $registro["ConsecutivoTurno"];	
					$ConsecutivoInterno = $registro["ConsecutivoInterno"];	
					$DescripcionPedido = $registro["DescripcionPedido"];	
					$UbicacionPedido = $registro["UbicacionPedido"];	
					
					if($contador == 1){
						$jsonAcudientes .= '{"idUsuario":"' . $idUsuario . '", "idCredencial":"' . $idCredencial . '", "ConsecutivoTurno":"' . $ConsecutivoTurno . '", "ConsecutivoInterno":"' . $ConsecutivoInterno . '", "DescripcionPedido":"' . $DescripcionPedido . '", "UbicacionPedido":"' . $UbicacionPedido . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"idUsuario":"' . $idUsuario . '", "idCredencial":"' . $idCredencial . '", "ConsecutivoTurno":"' . $ConsecutivoTurno . '", "ConsecutivoInterno":"' . $ConsecutivoInterno . '", "DescripcionPedido":"' . $DescripcionPedido . '", "UbicacionPedido":"' . $UbicacionPedido . '"}';		
						}
					}
					$contador+=1;
				}	
			}
			$jsonAcudientes .= "]";	
			return $jsonAcudientes;
		}
		
		public function ListarPedidosPorEstado($estado, $fechaInicial, $fechaFinal){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT op.*, m.* FROM `ordenpedido` op, movimientos m WHERE `UbicacionPedido`='$estado' AND (m.`FechaMovimiento` BETWEEN '$fechaInicial' AND '$fechaFinal') AND m.`DescripcionMovimiento`=CONCAT ('No de pedido: ', op.`ConsecutivoInterno`)";
			
			$result = mysqli_query($conexion, $query);
			
			
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				
				while($registro = mysqli_fetch_array($result)){
					$idUsuario = $registro["idUsuario"];	
					$idCredencial = $registro["idCredencial"];	
					$ConsecutivoTurno = $registro["ConsecutivoTurno"];	
					$ConsecutivoInterno = $registro["ConsecutivoInterno"];	
					$DescripcionPedido = $registro["DescripcionPedido"];	
					$UbicacionPedido = $registro["UbicacionPedido"];	
					$FechaMovimiento = $registro["FechaMovimiento"];	
					
					if($contador == 1){
						$jsonAcudientes .= '{"idUsuario":"' . $idUsuario . '", "idCredencial":"' . $idCredencial . '", "ConsecutivoTurno":"' . $ConsecutivoTurno . '", "ConsecutivoInterno":"' . $ConsecutivoInterno . '", "DescripcionPedido":"' . $DescripcionPedido . '", "UbicacionPedido":"' . $UbicacionPedido . '", "FechaMovimiento":"' . $FechaMovimiento . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"idUsuario":"' . $idUsuario . '", "idCredencial":"' . $idCredencial . '", "ConsecutivoTurno":"' . $ConsecutivoTurno . '", "ConsecutivoInterno":"' . $ConsecutivoInterno . '", "DescripcionPedido":"' . $DescripcionPedido . '", "UbicacionPedido":"' . $UbicacionPedido . '", "FechaMovimiento":"' . $FechaMovimiento . '"}';		
						}
					}
					$contador+=1;
				}	
			}
			$jsonAcudientes .= "]";	
			return $jsonAcudientes;
		}
		
		public function ListarPedidosParaReversion($estado, $fechaInicial, $fechaFinal, $usuario){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT op.*, m.* FROM `ordenpedido` op, movimientos m WHERE `UbicacionPedido`='$estado' AND (m.`FechaMovimiento` BETWEEN '$fechaInicial' AND '$fechaFinal') AND m.`DescripcionMovimiento`=CONCAT ('No de pedido: ', op.`ConsecutivoInterno`) AND m.`idUsuario` =  '$usuario'";
			
			$result = mysqli_query($conexion, $query);
			
			
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				
				while($registro = mysqli_fetch_array($result)){
					$idUsuario = $registro["idUsuario"];	
					$idCredencial = $registro["idCredencial"];	
					$ConsecutivoTurno = $registro["ConsecutivoTurno"];	
					$ConsecutivoInterno = $registro["ConsecutivoInterno"];	
					$DescripcionPedido = $registro["DescripcionPedido"];	
					$UbicacionPedido = $registro["UbicacionPedido"];	
					$FechaMovimiento = $registro["FechaMovimiento"];	
					
					if($contador == 1){
						$jsonAcudientes .= '{"idUsuario":"' . $idUsuario . '", "idCredencial":"' . $idCredencial . '", "ConsecutivoTurno":"' . $ConsecutivoTurno . '", "ConsecutivoInterno":"' . $ConsecutivoInterno . '", "DescripcionPedido":"' . $DescripcionPedido . '", "UbicacionPedido":"' . $UbicacionPedido . '", "FechaMovimiento":"' . $FechaMovimiento . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"idUsuario":"' . $idUsuario . '", "idCredencial":"' . $idCredencial . '", "ConsecutivoTurno":"' . $ConsecutivoTurno . '", "ConsecutivoInterno":"' . $ConsecutivoInterno . '", "DescripcionPedido":"' . $DescripcionPedido . '", "UbicacionPedido":"' . $UbicacionPedido . '", "FechaMovimiento":"' . $FechaMovimiento . '"}';		
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