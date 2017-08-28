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
			$horaEntrega = $usuario->getHoraEntrega();
			$fechaEntrega = $usuario->getFechaEntrega();
			$origen = $usuario->getOrigen();
			
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `ordenpedido` (`idUsuario`, `idCredencial`, `ConsecutivoTurno`, `ConsecutivoInterno`, `DescripcionPedido`, `UbicacionPedido`, `HoraEntrega`, `FechaEntrega`, `OrigenPedido`) VALUES ('$idUsuario', '$idCredencial', $consecutivoTurno, $consecutivoInterno, '$descripcionPedido', '$ubicacionPedido', '$horaEntrega', '$fechaEntrega', '$origen');";
			
			$result = mysqli_query($conexion, $query);
			
			$sql = "SELECT MAX(id) AS id FROM ordenpedido";
			$resultId = mysqli_query($conexion, $sql);
			$registro = mysqli_fetch_array($resultId);
			return $registro["id"];
		}
		
		public function ActualizarPedido($consecutivoInterno, $estado){
			$conexionBD = new ConexionBD();
			$turno = 0;
			$result;
			$conexion = $conexionBD->conectar();	

			if($estado == "ALISTAMIENTO"){
				$sqlTurno = "SELECT * FROM `ordenpedido` WHERE `ConsecutivoTurno`!= 0 ORDER BY `id` DESC LIMIT 1";
				$resultTurno = mysqli_query($conexion, $sqlTurno);

				if(mysqli_num_rows($resultTurno) > 0){
					$registroTurno = mysqli_fetch_array($resultTurno);
					if($registroTurno["ConsecutivoTurno"] < 50){
						$turno = $registroTurno["ConsecutifvoTurno"] + 1;
					}else{
						$turno = 1;
					}
					
				}else{
					$turno = 1;
				}
				$query = "UPDATE `ordenpedido` SET `UbicacionPedido`= '$estado', `ConsecutivoTurno` = '$turno' WHERE `ConsecutivoInterno`='$consecutivoInterno'";
			
				$result = mysqli_query($conexion, $query);
			}else{
				$query = "UPDATE `ordenpedido` SET `UbicacionPedido`= '$estado' WHERE `ConsecutivoInterno`='$consecutivoInterno'";
			
				$result = mysqli_query($conexion, $query);
			}					
			
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
		
		public function EsSuTurno($idCredencial){
			$conexionBD = new ConexionBD();
			$existe = false;//Boolean que sirve para saber si algun turno que tenga un usuario es el actual
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `ordenpedido` WHERE `UbicacionPedido`='ENTREGA' ORDER BY `ConsecutivoTurno` LIMIT 1";
			
			$result = mysqli_query($conexion, $query);
			$registro = mysqli_fetch_array($result);
			
			
			if($registro["idCredencial"] == $idCredencial){
				$existe = true;
			}
			
			
			return $existe;
		}
		
		public function EntregarPedidos($idCredencial){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT u.*, op.* FROM `ordenpedido` op, usuarios u WHERE op.`UbicacionPedido`='ENTREGA' AND u.idUsuario = op.idUsuario AND op.idCredencial = '$idCredencial'";
			
			$result = mysqli_query($conexion, $query);
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				
				//if(EsSuTurno($result) == true){
					while($registro = mysqli_fetch_array($result)){
						$idUsuario = $registro["idUsuario"];	
						$TipoUsuario = $registro["TipoUsuario"];	
						$TipoId = $registro["TipoId"];	
						$NumeroId = $registro["NumeroId"];	
						$PrimerApellido = $registro["PrimerApellido"];	
						$SegundoApellido = $registro["SegundoApellido"];
						$PrimerNombre = $registro["PrimerNombre"];
						$SegundoNombre = $registro["SegundoNombre"];
						$ImagenFotografica = $registro["ImagenFotografica"];
						$Telefono1 = $registro["Telefono1"];
						$Telefono2 = $registro["Telefono2"];
						
						$idCredencial = $registro["idCredencial"];	
						$ConsecutivoTurno = $registro["ConsecutivoTurno"];	
						$ConsecutivoInterno = $registro["ConsecutivoInterno"];	
						$DescripcionPedido = $registro["DescripcionPedido"];	
						$UbicacionPedido = $registro["UbicacionPedido"];	
						
						//consulta para sacar el valor del plato
						$query1 = "SELECT * FROM movimientos INNER JOIN ordenpedido ON movimientos.idCredencial = ordenpedido.idCredencial WHERE movimientos.ValorMovimiento >0 AND ordenpedido.UbicacionPedido =  'ENTREGA' AND movimientos.DescripcionMovimiento LIKE  'No. Pedido%' AND INSTR( movimientos.DescripcionMovimiento, ordenpedido.DescripcionPedido ) >0  AND movimientos.idCredencial ='$idCredencial' AND ordenpedido.DescripcionPedido ='$DescripcionPedido' ";
			
						$result2 = mysqli_query($conexion, $query1);
						if($result2 != null){
							$numeroFilas1 = mysqli_num_rows($result2);
								while($registro1 = mysqli_fetch_array($result2)){
									$ValorMovimiento = $registro1["ValorMovimiento"];	
							}
						}	
						//


						if($contador == 1){
							$jsonAcudientes .= '{"idUsuario":"' . $idUsuario . '", "idCredencial":"' . $idCredencial . '", "ConsecutivoTurno":"' . $ConsecutivoTurno . '", "ConsecutivoInterno":"' . $ConsecutivoInterno . '", "DescripcionPedido":"' . $DescripcionPedido . '", "UbicacionPedido":"' . $UbicacionPedido . '", "TipoUsuario":"' . $TipoUsuario . '", "TipoId":"' . $TipoId . '", "NumeroId":"' . $NumeroId . '", "PrimerApellido":"' . $PrimerApellido . '", "SegundoApellido":"' . $SegundoApellido . '", "PrimerNombre":"' . $PrimerNombre . '", "SegundoNombre":"' . $SegundoNombre . '", "ImagenFotografica":"' . $ImagenFotografica . '", "Telefono1":"' . $Telefono1 . '", "Telefono2":"' . $Telefono2 . '","ValorMovimiento":"' . $ValorMovimiento . '"}';	
						}else{
							if($contador <= $numeroFilas && $contador != 1){
								$jsonAcudientes .= ',{"idUsuario":"' . $idUsuario . '", "idCredencial":"' . $idCredencial . '", "ConsecutivoTurno":"' . $ConsecutivoTurno . '", "ConsecutivoInterno":"' . $ConsecutivoInterno . '", "DescripcionPedido":"' . $DescripcionPedido . '", "UbicacionPedido":"' . $UbicacionPedido . '", "TipoUsuario":"' . $TipoUsuario . '", "TipoId":"' . $TipoId . '", "NumeroId":"' . $NumeroId . '", "PrimerApellido":"' . $PrimerApellido . '", "SegundoApellido":"' . $SegundoApellido . '", "PrimerNombre":"' . $PrimerNombre . '", "SegundoNombre":"' . $SegundoNombre . '", "ImagenFotografica":"' . $ImagenFotografica . '", "Telefono1":"' . $Telefono1 . '", "Telefono2":"' . $Telefono2 . '","ValorMovimiento":"' . $ValorMovimiento . '"}';		
							}
						}
						$contador+=1;
					}	
				//}
			}
			$jsonAcudientes .= "]";	
			return $jsonAcudientes;
		}
		
		public function PedidosPorEstado($estado){
			$conexionBD = new ConexionBD();
			$jsonAcudientes = "[";
			$contador = 1;
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT u.*, op.* FROM `ordenpedido` op, usuarios u WHERE op.`UbicacionPedido`='$estado' AND u.idUsuario = op.idUsuario ORDER BY op.`ConsecutivoTurno`";
			
			$result = mysqli_query($conexion, $query);
			
			
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				
				while($registro = mysqli_fetch_array($result)){
					$idUsuario = $registro["idUsuario"];	
					$TipoUsuario = $registro["TipoUsuario"];	
					$TipoId = $registro["TipoId"];	
					$NumeroId = $registro["NumeroId"];	
					$PrimerApellido = $registro["PrimerApellido"];	
					$SegundoApellido = $registro["SegundoApellido"];
					$PrimerNombre = $registro["PrimerNombre"];
					$SegundoNombre = $registro["SegundoNombre"];
					$ImagenFotografica = $registro["ImagenFotografica"];
					$Telefono1 = $registro["Telefono1"];
					$Telefono2 = $registro["Telefono2"];
					
					$idCredencial = $registro["idCredencial"];	
					$ConsecutivoTurno = $registro["ConsecutivoTurno"];	
					$ConsecutivoInterno = $registro["ConsecutivoInterno"];	
					$DescripcionPedido = $registro["DescripcionPedido"];	
					$UbicacionPedido = $registro["UbicacionPedido"];	
					
					if($contador == 1){
						$jsonAcudientes .= '{"idUsuario":"' . $idUsuario . '", "idCredencial":"' . $idCredencial . '", "ConsecutivoTurno":"' . $ConsecutivoTurno . '", "ConsecutivoInterno":"' . $ConsecutivoInterno . '", "DescripcionPedido":"' . $DescripcionPedido . '", "UbicacionPedido":"' . $UbicacionPedido . '", "TipoUsuario":"' . $TipoUsuario . '", "TipoId":"' . $TipoId . '", "NumeroId":"' . $NumeroId . '", "PrimerApellido":"' . $PrimerApellido . '", "SegundoApellido":"' . $SegundoApellido . '", "PrimerNombre":"' . $PrimerNombre . '", "SegundoNombre":"' . $SegundoNombre . '", "ImagenFotografica":"' . $ImagenFotografica . '", "Telefono1":"' . $Telefono1 . '", "Telefono2":"' . $Telefono2 . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',{"idUsuario":"' . $idUsuario . '", "idCredencial":"' . $idCredencial . '", "ConsecutivoTurno":"' . $ConsecutivoTurno . '", "ConsecutivoInterno":"' . $ConsecutivoInterno . '", "DescripcionPedido":"' . $DescripcionPedido . '", "UbicacionPedido":"' . $UbicacionPedido . '", "TipoUsuario":"' . $TipoUsuario . '", "TipoId":"' . $TipoId . '", "NumeroId":"' . $NumeroId . '", "PrimerApellido":"' . $PrimerApellido . '", "SegundoApellido":"' . $SegundoApellido . '", "PrimerNombre":"' . $PrimerNombre . '", "SegundoNombre":"' . $SegundoNombre . '", "ImagenFotografica":"' . $ImagenFotografica . '", "Telefono1":"' . $Telefono1 . '", "Telefono2":"' . $Telefono2 . '"}';		
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
			
			$query = "SELECT op.*, m.* FROM `ordenpedido` op, movimientos m WHERE `UbicacionPedido`='$estado' AND (m.`FechaMovimiento` BETWEEN '$fechaInicial' AND '$fechaFinal') AND m.`DescripcionMovimiento` LIKE CONCAT ('%No. Pedido ', op.`ConsecutivoInterno`, '%') AND m.`idUsuario` =  '$usuario'";
			
			$result = mysqli_query($conexion, $query);
			
			
			
			if($result != null){
				$numeroFilas = mysqli_num_rows($result);
				
				while($registro = mysqli_fetch_array($result)){
					
					
					if($contador == 1){
						$jsonAcudientes .= json_encode($registro);	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonAcudientes .= ',' . json_encode($registro);
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