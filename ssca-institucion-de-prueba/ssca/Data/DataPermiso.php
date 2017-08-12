<?php
	class DataPermiso {
		
		private $idPermiso;
		private $idUsuario;	
		private $fecha;
		private $hora;
		private $observaciones;
		private $estado;
		
		public function __construct(){
			
		}
		
		public function setIdPermiso($idPermiso){
			$this->idPermiso = $idPermiso;
		}
		public function getIdPermiso(){
			return $this->idPermiso;
		}
		
		public function setIdUsuario($idUsuario){
			$this->idUsuario = $idUsuario;
		}
		public function getIdUsuario(){
			return $this->idUsuario;
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
		
		public function setObservaciones($observaciones){
			$this->observaciones = $observaciones;
		}
		public function getObservaciones(){
			return $this->observaciones;
		}	
		
		public function setEstado($estado){
			$this->estado = $estado;
		}
		public function getEstado(){
			return $this->estado;
		}		
	}
?>