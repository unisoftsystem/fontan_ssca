<?php
	class DataPlaneacionRuta {
		private $idPlaneacionRuta;
		private $nombreRuta;	
		private $puntoOrigen;	
		private $puntoDestino;	
		private $idConductor;	
		private $idMonitor;	
		
		public function __construct(){
			
		}
		
		public function setIdPlaneacionRuta($idPlaneacionRuta){
			$this->idPlaneacionRuta = $idPlaneacionRuta;
		}
		public function getIdPlaneacionRuta(){
			return $this->idPlaneacionRuta;
		}
		
		public function setNombreRuta($nombreRuta){
			$this->nombreRuta = $nombreRuta;
		}
		public function getNombreRuta(){
			return $this->nombreRuta;
		}
		
		public function setPuntoOrigen($puntoOrigen){
			$this->puntoOrigen = $puntoOrigen;
		}
		public function getPuntoOrigen(){
			return $this->puntoOrigen;
		}
		
		public function setPuntoDestino($puntoDestino){
			$this->puntoDestino = $puntoDestino;
		}
		public function getPuntoDestino(){
			return $this->puntoDestino;
		}
		
		public function setIdConductor($idConductor){
			$this->idConductor = $idConductor;
		}
		public function getIdConductor(){
			return $this->idConductor;
		}
		
		public function setIdMonitor($idMonitor){
			$this->idMonitor = $idMonitor;
		}
		public function getIdMonitor(){
			return $this->idMonitor;
		}
    }
?>