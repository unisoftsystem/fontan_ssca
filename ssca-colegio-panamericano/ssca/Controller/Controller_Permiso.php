<?php
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataPermiso.php');
	
	class Controller_Permiso { 
	
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
		public function ExistePermisoUsuario($idUsuario){
			$conexionBD = new ConexionBD();
			$existe = false;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `permiso` WHERE `idUsuario`='$idUsuario'";
			
			$result = mysqli_query($conexion, $query);
			
			$registro = mysqli_fetch_array($result);

			if($registro != null){
				$existe = true;				
			}
			return $existe;
		}
		
		//Funcion para saber si el ultimo registro de una credencial es una entrada
		public function ObtenerHoraPermiso($usuario, $fecha){
			$conexionBD = new ConexionBD();
			$hora = "";
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM `permiso` WHERE `idUsuario`='$usuario' AND `Fecha`='$fecha' AND `Estado`='ACTIVO' ORDER BY `Fecha`, `Hora` DESC LIMIT 1";
			
			$resultSelect = mysqli_query($conexion, $query);
				
			if($resultSelect != null){
				$numeroFilas = mysqli_num_rows($resultSelect);
				$registro = mysqli_fetch_array($resultSelect);
				$hora = $registro["Hora"];	
			}
			
			mysqli_close($conexion);
			return $hora;
		}
		
	}
?>