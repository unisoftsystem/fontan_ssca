<?php
	class DataSubCategoria {
		
		private $codigo;
		private $nombre;
		private $idCategoria;	
		
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
		
		public function setIdCategoria($idCategoria){
			$this->idCategoria = $idCategoria;
		}
		public function getIdCategoria(){
			return $this->idCategoria;
		}
		
		
	}
?>