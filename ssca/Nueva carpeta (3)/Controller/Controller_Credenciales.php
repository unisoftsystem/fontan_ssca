<?php
	include_once(DIR_DATA . '/ConexionBD.php');
		
	class Controller_Credenciales { 
	
		public function __construct(){
			
		}
		
		public function CrearCredencial(DataCredenciales $credencial){
			$conexionBD = new ConexionBD();
			
			$idUsuarioPrincipal = $credencial->getIdUsuarioPrincipal();
			$idUsuarioSecundario = $credencial->getIdUsuarioSecundario();
			$saldo = $credencial->getSaldo();
			
			$conexion = $conexionBD->conectar();
			
			//Se ejecuta un SQL para generar y obtener un codigo GUID
			$queryId = "SELECT UUID() AS idCredencial;";
			$resultSelect = mysqli_query($conexion, $queryId);
			$row = mysqli_fetch_array($resultSelect);
			$idCredencial = $row["idCredencial"];
			
			$queryInsert = "INSERT INTO `ssca`.`credenciales` (`idCredencial`, `idUsuarioPrincipal`, `idUsuarioSecundario`, `EstadoCredencial`, `SaldoCredencial`) VALUES ('$idCredencial', '$idUsuarioPrincipal', '$idUsuarioSecundario', 'ACTIVO', $saldo);";
			
			$resultInsert = mysqli_query($conexion, $queryInsert);
			
			return $idCredencial;
		}
		
		public function CrearReemplazoCredencial($idCredencialAnterior){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			//Se ejecuta un SQL para generar y obtener un codigo GUID
			$queryId = "SELECT UUID() AS idCredencial;";
			$resultSelect = mysqli_query($conexion, $queryId);
			$row = mysqli_fetch_array($resultSelect);
			$idCredencial = $row["idCredencial"];
			
			$queryUpdate = "UPDATE `credenciales` SET `idCredencial`= '$idCredencial', `EstadoCredencial`='ACTIVO' WHERE `idCredencial`='$idCredencialAnterior'";
			
			$resultInsert = mysqli_query($conexion, $queryUpdate);
			
			mysqli_close($conexion);
			return $idCredencial;
		}
		
		public function CambiarSaldo($idCredencial, $valor){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$queryUpdate = "UPDATE `credenciales` SET `SaldoCredencial`= '$valor', `EstadoCredencial`='ACTIVO' WHERE `idCredencial`='$idCredencial'";
			
			$resultUpdate = mysqli_query($conexion, $queryUpdate);
			
			mysqli_close($conexion);
			return $resultUpdate;
		}
		
		public function ObtenerSaldoActual($idCredencial){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT `SaldoCredencial` FROM `credenciales` WHERE `idCredencial`='$idCredencial' AND `EstadoCredencial`='ACTIVO'";
			
			$resultDatos = mysqli_query($conexion, $query);
			
			$row = mysqli_fetch_array($resultDatos);
			$SaldoCredencial = $row["SaldoCredencial"];
			mysqli_close($conexion);
			
			return $SaldoCredencial;
		}
		
		public function ObtenerIdCredencial($idUsuario){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT c.*, u.*, u.`TipoUsuario` FROM `usuarios` u inner join credenciales c on u.`idUsuario` = c.`idUsuarioSecundario` or u.`NumeroId` = c.`idUsuarioSecundario` WHERE (u.`TipoUsuario`='Estudiante' or u.`TipoUsuario`='Funcionario') AND u.`idUsuario`='$idUsuario'";
			
			$resultDatos = mysqli_query($conexion, $query);
			
			$row = mysqli_fetch_array($resultDatos);
			$idCredencial = $row["idCredencial"];
			mysqli_close($conexion);
			
			return $idCredencial;
		}
		
		public function ObtenerIdUsuario($idCredencial){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT c.*, u.*, u.`TipoUsuario` FROM `usuarios` u inner join credenciales c on u.`idUsuario` = c.`idUsuarioSecundario` or u.`NumeroId` = c.`idUsuarioSecundario` WHERE (u.`TipoUsuario`='Estudiante' or u.`TipoUsuario`='Funcionario') AND c.`idCredencial`='$idCredencial'";
			
			$resultDatos = mysqli_query($conexion, $query);
			
			$row = mysqli_fetch_array($resultDatos);
			$idUsuario = $row["idUsuarioSecundario"];
			mysqli_close($conexion);
			
			return $idUsuario;
		}
		
		public function CambiarEstado($estado, $idCredencial){
			$conexionBD = new ConexionBD();
			
			$conexion = $conexionBD->conectar();
			
			$queryUpdate = "UPDATE `credenciales` SET `EstadoCredencial`='$estado' WHERE `idCredencial`='$idCredencial'";
			
			$resultUpdate = mysqli_query($conexion, $queryUpdate);
			
			mysqli_close($conexion);
			return $resultUpdate;
		}
		
		public function ReporteCredencial($idUsuarioPrincipal, $idUsuarioSecundario){
			$conexionBD = new ConexionBD();
			$jsonCredencial = "[";
			$contador = 1;
			
			$conexion = $conexionBD->conectar();
			
			$querySelect = "SELECT * FROM `credenciales` WHERE `idUsuarioPrincipal`='$idUsuarioPrincipal' AND `idUsuarioSecundario`='$idUsuarioSecundario'";
			
			$resultSelect = mysqli_query($conexion, $querySelect);
			
			
			
			if($resultSelect != null){
				$numeroFilas = mysqli_num_rows($resultSelect);
				
				while($registro = mysqli_fetch_array($resultSelect)){
					$idCredencial = $registro["idCredencial"];	
					$idUsuarioPrincipal = $registro["idUsuarioPrincipal"];	
					$idUsuarioSecundario = $registro["idUsuarioSecundario"];	
					$EstadoCredencial = $registro["EstadoCredencial"];	
					$SaldoCredencial = $registro["SaldoCredencial"];
					
					if($contador == 1){
						$jsonCredencial .= '{"idCredencial":"' . $idCredencial . '", "idUsuarioPrincipal":"' . $idUsuarioPrincipal . '", "idUsuarioSecundario":"' . $idUsuarioSecundario . '", "EstadoCredencial":"' . $EstadoCredencial . '", "SaldoCredencial":"' . $SaldoCredencial . '"}';	
					}else{
						if($contador <= $numeroFilas && $contador != 1){
							$jsonCredencial .= ',{"idCredencial":"' . $idCredencial . '", "idUsuarioPrincipal":"' . $idUsuarioPrincipal . '", "idUsuarioSecundario":"' . $idUsuarioSecundario . '", "EstadoCredencial":"' . $EstadoCredencial . '", "SaldoCredencial":"' . $SaldoCredencial . '"}';
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