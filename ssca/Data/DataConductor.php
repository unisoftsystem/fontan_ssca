<?php
	class DataConductor {
		private $idconductor;
		private $TipoId;	
		private $nombre;	
		private $apellido;	
		private $TipoUsuario;	
		private $telefono;
		private $direccion;	
		private $imagenFotografica;
		private $latitud;
		private $longitud;
		private $estado;
		private $arl;
		private $tipoSangre;	
		
		public function __construct(){
			
		}
		
		public function setIdconductor($idconductor){
			$this->idconductor = $idconductor;
		}
		public function getIdconductor(){
			return $this->idconductor;
		}
		
		public function setTipoId($tipoId){
			$this->tipoId = $tipoId;
		}
		public function getTipoId(){
			return $this->tipoId;
		}
		
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
		public function getNombre(){
			return $this->nombre;
		}
		
		public function setApellido($apellido){
			$this->apellido = $apellido;
		}
		public function getApellido(){
			return $this->apellido;
		}
		
		public function setTipoUsuario($TipoUsuario){
			$this->TipoUsuario = $TipoUsuario;
		}
		public function getTipoUsuario(){
			return $this->TipoUsuario;
		}
		
		public function setTelefono($telefono){
			$this->telefono = $telefono;
		}
		public function getTelefono(){
			return $this->telefono;
		}
		
		public function setDireccion($direccion){
			$this->direccion = $direccion;
		}
		public function getDireccion(){
			return $this->direccion;
		}
		
		public function setImagenFotografica($imagenFotografica){
			$this->imagenFotografica = $imagenFotografica;
		}
		public function getImagenFotografica(){
			return $this->imagenFotografica;
		}
		public function setLatitud($latitud){
			$this->latitud = $latitud;
		}
		public function getLatitud(){
			return $this->latitud;
		}
		public function setLongitud($longitud){
			$this->longitud = $longitud;
		}
		public function getLongitud(){
			return $this->longitud;
		}
		
		public function setEstado($estado){
			$this->estado = $estado;
		}
		public function getEstado(){
			return $this->estado;
		}
		public function setTipoSangre($tipoSangre){
			$this->tipoSangre = $tipoSangre;
		}
		public function getTipoSangre(){
			return $this->tipoSangre;
		}
		
		public function setArl($arl){
			$this->arl = $arl;
		}
		public function getArl(){
			return $this->arl;
		}
	}
?>