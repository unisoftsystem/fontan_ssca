<?php
	class DataRecogida {
		
		private $idrecogida;
		private $latitud;	
		private $longitud;	
		private $idestudiante;	
		private $tipo;	
		private $fecha;	
		private $hora;	
		
		public function __construct(){
			
		}
		
		public function setIdrecogida($idrecogida){
			$this->idrecogida = $idrecogida;
		}
		public function getIdrecogida(){
			return $this->idrecogida;
		}
		
		public function setLatitud($latitud){
			$this->latitud = $latitud;
		}
		public function getLatitud(){
			return $this->latitud;
		}
		
		public function setLongitud($longitud){
			$this->longitud = $longitud;
		}
		public function getLongitud(){
			return $this->longitud;
		}
		
		public function setIdestudiante($idestudiante){
			$this->idestudiante = $idestudiante;
		}
		public function getIdestudiante(){
			return $this->idestudiante;
		}
		
		public function setTipo($tipo){
			$this->tipo = $tipo;
		}
		public function getTipo(){
			return $this->tipo;
		}
		
		public function setFecha($fecha){
			$this->fecha = $fecha;
		}
		public function getFecha(){
			return $this->fecha;
		}
		
		public function setHora($hora){
			$this->hora = $hora;
		}
		public function getHora(){
			return $this->hora;
		}
	}
?>