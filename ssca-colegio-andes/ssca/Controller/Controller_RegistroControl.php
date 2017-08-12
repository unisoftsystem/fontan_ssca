<?php
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataRegistroControl.php');
	
	class Controller_RegistroControl { 
	
		public function __construct(){
			
		}
		
		public function CrearRegistroControl(DataRegistroControl $registroControl){
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
		}
		
		//Funcion para saber si el ultimo registro de una credencial es una entrada
		public function ExisteEntradaUltima($idCredencial){
			$conexionBD = new ConexionBD();
			$existe = false;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM  `registrocontrol` WHERE  `idCredencial` = '$idCredencial' AND Fecha = CURDATE() ORDER BY `idControl` DESC LIMIT 1";
			
			$result = mysqli_query($conexion, $query);
			
			$registro = mysqli_fetch_array($result);
			$datos = $registro["Tipo"];
			if($registro["Tipo"] == "ENTRADA"){
				$existe = true;				
			}
			return $existe;
		}
		
		public function Reporte($fechaInicial, $fechaFinal, $tipo, $numeroID){
			$conexionBD = new ConexionBD();
			$jsonCredencial = "[";
			$contador = 1;
			$querySelect = "";
			
			$conexion = $conexionBD->conectar();
			
			if($numeroID == ""){
				$querySelect = "SELECT rc.*, u.* FROM registrocontrol rc inner join usuarios u on u.idUsuario = rc.idUsuario WHERE (rc.Fecha BETWEEN '$fechaInicial' AND '$fechaFinal') AND (u.TipoUsuario = '$tipo')";
			}else{
				$querySelect = "SELECT rc.*, u.* FROM registrocontrol rc inner join usuarios u on u.idUsuario = rc.idUsuario WHERE (rc.Fecha BETWEEN '$fechaInicial' AND '$fechaFinal') AND (u.TipoUsuario = '$tipo') AND (u.NumeroId='$numeroID')";
			}
			$resultSelect = mysqli_query($conexion, $querySelect);
			
			if($resultSelect != null){
				$numeroFilas = mysqli_num_rows($resultSelect);
				
				while($registro = mysqli_fetch_array($resultSelect)){
					$idCredencial = $registro["idCredencial"];	
					$idUsuario = $registro["idUsuario"];	
					$Tipo = $registro["Tipo"];	
					$Fecha = $registro["Fecha"];	
					$Hora = $registro["Hora"];
					$TipoUsuario = $registro["TipoUsuario"];
					$TipoId = $registro["TipoId"];
					$NumeroId = $registro["NumeroId"];
					$PrimerApellido = $registro["PrimerApellido"];
					$SegundoApellido = $registro["SegundoApellido"];
					$PrimerNombre = $registro["PrimerNombre"];
					$SegundoNombre = $registro["SegundoNombre"];
					$ImagenFotografica = $registro["ImagenFotografica"];
					$Direccion = $registro["Direccion"];
					$Telefono1 = $registro["Telefono1"];
					
					if($contador == 1){
						$jsonCredencial .= '{"idCredencial":"' . $idCredencial . '", "idUsuario":"' . $idUsuario . '", "Tipo":"' . $Tipo . '", "Fecha":"' . $Fecha . '", "Hora":"' . $Hora . '", "TipoUsuario":"' . $TipoUsuario . '", "TipoId":"' . $TipoId . '", "NumeroId":"' . $NumeroId . '", "PrimerApellido":"' . $PrimerApellido . '", "SegundoApellido":"' . $SegundoApellido . '", "PrimerNombre":"' . $PrimerNombre . '", "SegundoNombre":"' . $SegundoNombre . '", "ImagenFotografica":"' . $ImagenFotografica . '", "Direccion":"' . $Direccion . '", "Telefono1":"' . $Telefono1 . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonCredencial .= ',{"idCredencial":"' . $idCredencial . '", "idUsuario":"' . $idUsuario . '", "Tipo":"' . $Tipo . '", "Fecha":"' . $Fecha . '", "Hora":"' . $Hora . '", "TipoUsuario":"' . $TipoUsuario . '", "TipoId":"' . $TipoId . '", "NumeroId":"' . $NumeroId . '", "PrimerApellido":"' . $PrimerApellido . '", "SegundoApellido":"' . $SegundoApellido . '", "PrimerNombre":"' . $PrimerNombre . '", "SegundoNombre":"' . $SegundoNombre . '", "ImagenFotografica":"' . $ImagenFotografica . '", "Direccion":"' . $Direccion . '", "Telefono1":"' . $Telefono1 . '"}';	
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