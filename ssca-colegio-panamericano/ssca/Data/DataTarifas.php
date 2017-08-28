<?php
	class DataTarifas {
		
		private $idTarifa;
		private $descripcion;	
		private $valor;	
		private $idColegio;	
		
		public function __construct(){
			
		}
		
		public function setIdTarifa($idTarifa){
			$this->idTarifa = $idTarifa;
		}
		public function getIdTarifa(){
			return $this->idTarifa;
		}
		
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}
		public function getDescripcion(){
			return $this->descripcion;
		}
		
		public function setValor($valor){
			$this->valor = $valor;
		}
		public function getValor(){
			return $this->valor;
		}
		
		public function setIdColegio($idColegio){
			$this->idColegio = $idColegio;
		}
		public function getIdColegio(){
			return $this->idColegio;
		}	
	}
?>