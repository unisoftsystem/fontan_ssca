<?php
	class DataMovimientos {
		
		private $idUsuario;
		private $idCredencial;	
		private $valorMovimiento;	
		private $fechaMovimiento;	
		private $horaMovimiento;	
		private $descripcionMovimiento;	
		
		public function __construct(){
			
		}
		
		public function setIdUsuario($idUsuario){
			$this->idUsuario = $idUsuario;
		}
		public function getIdUsuario(){
			return $this->idUsuario;
		}
		
		public function setIdCredencial($idCredencial){
			$this->idCredencial = $idCredencial;
		}
		public function getIdCredencial(){
			return $this->idCredencial;
		}
		
		public function setValorMovimiento($valorMovimiento){
			$this->valorMovimiento = $valorMovimiento;
		}
		public function getValorMovimiento(){
			return $this->valorMovimiento;
		}
		
		public function setFechaMovimiento($fechaMovimiento){
			$this->fechaMovimiento = $fechaMovimiento;
		}
		public function getFechaMovimiento(){
			return $this->fechaMovimiento;
		}
		
		public function setHoraMovimiento($horaMovimiento){
			$this->horaMovimiento = $horaMovimiento;
		}
		public function getHoraMovimiento(){
			return $this->horaMovimiento;
		}
		
		public function setDescripcionMovimiento($descripcionMovimiento){
			$this->descripcionMovimiento = $descripcionMovimiento;
		}
		public function getDescripcionMovimiento(){
			return $this->descripcionMovimiento;
		}
	}
?>