<?php
	class DataMonitor {
		private $idmonitor;
		private $TipoId;	
		private $nombre;	
		private $apellido;	
		private $TipoUsuario;	
		private $telefono;
		private $direccion;	
		private $Clave;	
		private $imagenFotografica;
		private $qr;
		private $estado;
		private $latitud;
		private $longitud;
		private $arl;
		private $tipoSangre;	
		
		public function __construct(){
			
		}
		
		public function setIdmonitor($idmonitor){
			$this->idmonitor = $idmonitor;
		}
		public function getIdmonitor(){
			return $this->idmonitor;
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
		
		public function setClave($Clave){
			$this->Clave = $Clave;
		}
		public function getClave(){
			return $this->Clave;
		}
		
		public function setQr($qr){
			$this->qr = $qr;
		}
		public function getQr(){
			return $this->qr;
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