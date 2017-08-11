<?php
	class DataOrdenPedido {
		private $idUsuario;
		private $idCredencial;	
		private $consecutivoTurno;	
		private $consecutivoInterno;	
		private $descripcionPedido;	
		private $ubicacionPedido;	
		
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
		
	}
?>