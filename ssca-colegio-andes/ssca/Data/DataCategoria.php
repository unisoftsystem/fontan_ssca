<?php
	class DataCategoria {
		
		private $codigo;
		private $nombre;	
		
		public function __construct(){
			
		}
		
		public function setCodigo($codigo){
			$this->codigo = $codigo;
		}
		public function getCodigo(){
			return $this->codigo;
		}
		
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
		public function getNombre(){
			return $this->nombre;
		}
	}
?>