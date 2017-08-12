<?php
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataRecogida.php');
	
	class Controller_Recogida { 
	
		public function __construct(){
			
		}
		
		public function CrearRecogida(DataRecogida $registroControl){
			$conexionBD = new ConexionBD();
			
			$latitud = $registroControl->getLatitud();
			$longitud = $registroControl->getLongitud();
			$idestudiante = $registroControl->getIdestudiante();
			$tipo = $registroControl->getTipo();
			$fecha = $registroControl->getFecha();
			$hora = $registroControl->getHora();
			
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `recogida`(`idrecogida`, `latitud`, `longitud`, `idestudiante`, `tipo`, `fecha`, `hora`) VALUES (NULL,'$latitud','$longitud','$idestudiante','$tipo','$fecha','$hora')";
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
		
		//Funcion para saber si el ultimo registro de una credencial es una entrada
		public function ExisteEntradaUltima($idCredencial){
			$conexionBD = new ConexionBD();
			$existe = false;
			
			$conexion = $conexionBD->conectar();
			
			$query = "SELECT * FROM  `registrocontrol` WHERE  `idCredencial` =  '$idCredencial' ORDER BY  `Fecha`, `Hora` DESC LIMIT 1";
			
			$result = mysqli_query($conexion, $query);
			
			$registro = mysqli_fetch_array($result);
			$datos = $registro["Tipo"];
			if($registro["Tipo"] == "ENTRADA"){
				$existe = true;				
			}
			return $existe;
		}
		
	}
?>