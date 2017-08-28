<?php
	class DataOrdenPedido {
		private $idUsuario;
		private $idCredencial;	
		private $consecutivoTurno;	
		private $consecutivoInterno;	
		private $descripcionPedido;	
		private $ubicacionPedido;	
		private $horaEntrega;
		private $fechaEntrega;
		private $origen;
		
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
		
		public function setConsecutivoTurno($consecutivoTurno){
			$this->consecutivoTurno = $consecutivoTurno;
		}
		public function getConsecutivoTurno(){
			return $this->consecutivoTurno;
		}
		
		public function setConsecutivoInterno($consecutivoInterno){
			$this->consecutivoInterno = $consecutivoInterno;
		}
		public function getConsecutivoInterno(){
			return $this->consecutivoInterno;
		}
		
		public function setDescripcionPedido($descripcionPedido){
			$this->descripcionPedido = $descripcionPedido;
		}
		public function getDescripcionPedido(){
			return $this->descripcionPedido;
		}
		
		public function setUbicacionPedido($ubicacionPedido){
			$this->ubicacionPedido = $ubicacionPedido;
		}
		public function getUbicacionPedido(){
			return $this->ubicacionPedido;
		}
		
		public function setHoraEntrega($horaEntrega){
			$this->horaEntrega = $horaEntrega;
		}
		public function getHoraEntrega(){
			return $this->horaEntrega;
		}
		
		public function setFechaEntrega($fechaEntrega){
			$this->fechaEntrega = $fechaEntrega;
		}
		public function getFechaEntrega(){
			return $this->fechaEntrega;
		}
		
		public function setOrigen($origen){
			$this->origen = $origen;
		}
		public function getOrigen(){
			return $this->origen;
		}
	}
?>