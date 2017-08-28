<?php
	class DataDetalleHorario {
		
		private $idHorario;
		private $idUsuario;	
		
		public function __construct(){
			
		}
		
		public function setIdHorario($idHorario){
			$this->idHorario = $idHorario;
		}
		public function getIdHorario(){
			return $this->idHorario;
		}
		
		public function setIdUsuario($idUsuario){
			$this->idUsuario = $idUsuario;
		}
		public function getIdUsuario(){
			return $this->idUsuario;
		}		
	}
?>