<?php
	class DataVehiculo {
		private $idvehiculo;
		private $marca;	
		private $categoria;	
		private $placa;	
		private $nombreruta;	
		private $sillas;
		private $observaciones;	
		private $imagenFotografica;
		
		public function __construct(){
			
		}
		
		public function setIdvehiculo($idvehiculo){
			$this->idvehiculo = $idvehiculo;
		}
		public function getIdvehiculo(){
			return $this->idvehiculo;
		}
		
		public function setMarca($marca){
			$this->marca = $marca;
		}
		public function getMarca(){
			return $this->marca;
		}
		
		public function setCategoria($categoria){
			$this->categoria = $categoria;
		}
		public function getCategoria(){
			return $this->categoria;
		}
		
		public function setPlaca($placa){
			$this->placa = $placa;
		}
		public function getPlaca(){
			return $this->placa;
		}
		
		public function setNombreruta($nombreruta){
			$this->nombreruta = $nombreruta;
		}
		public function getNombreruta(){
			return $this->nombreruta;
		}
		
		public function setSillas($sillas){
			$this->sillas = $sillas;
		}
		public function getSillas(){
			return $this->sillas;
		}
		
		public function setObservaciones($observaciones){
			$this->observaciones = $observaciones;
		}
		public function getObservaciones(){
			return $this->observaciones;
		}
		
		public function setImagenFotografica($imagenFotografica){
			$this->imagenFotografica = $imagenFotografica;
		}
		public function getImagenFotografica(){
			return $this->imagenFotografica;
		}
		
	}
?>