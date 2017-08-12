<?php
	class DataRegistroControl {
		
		private $idControl;
		private $idCredencial;	
		private $idUsuario;	
		private $tipo;	
		private $fecha;	
		private $hora;	
		
		public function __construct(){
			
		}
		
		public function setIdControl($idControl){
			$this->idControl = $idControl;
		}
		public function getIdControl(){
			return $this->idControl;
		}
		
		public function setIdCredencial($idCredencial){
			$this->idCredencial = $idCredencial;
		}
		public function getIdCredencial(){
			return $this->idCredencial;
		}
		
		public function setIdUsuario($idUsuario){
			$this->idUsuario = $idUsuario;
		}
		public function getIdUsuario(){
			return $this->idUsuario;
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