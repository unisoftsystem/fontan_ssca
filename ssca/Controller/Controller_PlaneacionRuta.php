<?php
	define("DIRDATA", "Data");
	include_once(DIRDATA . '/ConexionBD.php');
	include_once(DIRDATA . '/DataPlaneacionRuta.php');
	
	class Controller_PlaneacionRuta {
		
		public function __construct(){
			
		}
		
		public function CrearRuta(DataPlaneacionRuta $ruta){
			$conexionBD = new ConexionBD();
			
			$nombreRuta = $ruta->getIdPlaneacionRuta();
			$puntoOrigen = $ruta->getNombreRuta();
			$puntoOrigen = $ruta->getPuntoOrigen();
			$puntoDestino = $ruta->getPuntoDestino();
			$idConductor = $ruta->getIdConductor();
			$idMonitor = $ruta->getIdMonitor();
			
			$conexion = $conexionBD->conectar();
			
			$query = "INSERT INTO `planeacionruta`(`idPlaneacionRuta`, `NombreRuta`, `PuntoOrigen`, `PuntoDestino`, `idConductor`, `idMonitor`) VALUES (NULL,'$nombreRuta','$puntoOrigen','$puntoDestino','$idConductor','$idMonitor')";
			
			$result = mysqli_query($conexion, $query);
			
			return $result;
		}
	}
	
?>