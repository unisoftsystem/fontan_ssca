<?php
 	class DataCredenciales {
		
		private $idUsuarioPrincipal;
		private $idUsuarioSecundario;	
		private $idCredencial;	
		private $estado;	
		private $saldo;	
		private $fechaVencimiento;	
		
		public function __construct(){
			
		}
		
		public function setIdUsuarioPrincipal($idUsuarioPrincipal){
			$this->idUsuarioPrincipal = $idUsuarioPrincipal;
		}
		public function getIdUsuarioPrincipal(){
			return $this->idUsuarioPrincipal;
		}
		
		public function setIdUsuarioSecundario($idUsuarioSecundario){
			$this->idUsuarioSecundario = $idUsuarioSecundario;
		}
		public function getIdUsuarioSecundario(){
			return $this->idUsuarioSecundario;
		}
		
		public function setIdCredencial($idCredencial){
			$this->idCredencial = $idCredencial;
		}
		public function getIdCredencial(){
			return $this->idCredencial;
		}
		
		public function setEstado($estado){
			$this->estado = $estado;
		}
		public function getEstado(){
			return $this->estado;
		}
		
		public function setSaldo($saldo){
			$this->saldo = $saldo;
		}
		public function getSaldo(){
			return $this->saldo;
		}
		
		public function setFechaVencimiento($fechaVencimiento){
			$this->fechaVencimiento = $fechaVencimiento;
		}
		public function getFechaVencimiento(){
			return $this->fechaVencimiento;
		}
 }
?>