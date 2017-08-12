<?php
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataTarifas.php');
	
	class Controller_Tarifas { 
	
		public function __construct(){
			
		}
		
		public function ConsultarValorTarifa($descripion){
			$conexionBD = new ConexionBD();
			$conexion = $conexionBD->conectar();
			
			$querySelect = "SELECT * FROM `tarifas` WHERE `Descripcion`='$descripion'";
			
			$resultSelect = mysqli_query($conexion, $querySelect);
			
			$registro = mysqli_fetch_array($resultSelect);
			$Valor = $registro["Valor"];
						
			mysqli_close($conexion);
			return $Valor;
		}
	}
?>