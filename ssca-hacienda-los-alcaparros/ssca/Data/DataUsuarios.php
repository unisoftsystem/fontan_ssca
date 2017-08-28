<?php
	class DataUsuarios {
		private $idUsuario;
		private $tipoId;	
		private $numeroId;	
		private $primerApellido;	
		private $segundoApellido;	
		private $primerNombre;	
		private $segundoNombre;	
		private $direccion;	
		private $telefono1;	
		private $telefono2;	
		private $password;
		private $tipoUsuario;
		private $imagenFotografica;
		private $permiso;
		private $estado;
		
		
		
		public function __construct(){
			
		}
		
		public function setIdUsuario($idUsuario){
			$this->idUsuario = $idUsuario;
		}
		public function getIdUsuario(){
			return $this->idUsuario;
		}
		
		public function setTipoId($tipoId){
			$this->tipoId = $tipoId;
		}
		public function getTipoId(){
			return $this->tipoId;
		}
		
		public function setNumeroId($numeroId){
			$this->numeroId = $numeroId;
		}
		public function getNumeroId(){
			return $this->numeroId;
		}
		
		public function setPrimerApellido($primerApellido){
			$this->primerApellido = $primerApellido;
		}
		public function getPrimerApellido(){
			return $this->primerApellido;
		}
		
		public function setSegundoApellido($segundoApellido){
			$this->segundoApellido = $segundoApellido;
		}
		public function getSegundoApellido(){
			return $this->segundoApellido;
		}
		
		public function setPrimerNombre($primerNombre){
			$this->primerNombre = $primerNombre;
		}
		public function getPrimerNombre(){
			return $this->primerNombre;
		}
		
		public function setSegundoNombre($segundoNombre){
			$this->segundoNombre = $segundoNombre;
		}
		public function getSegundoNombre(){
			return $this->segundoNombre;
		}
		
		public function setDireccion($direccion){
			$this->direccion = $direccion;
		}
		public function getDireccion(){
			return $this->direccion;
		}
		
		public function setTelefono1($telefono1){
			$this->telefono1 = $telefono1;
		}
		public function getTelefono1(){
			return $this->telefono1;
		}
		
		public function setTelefono2($telefono2){
			$this->telefono2 = $telefono2;
		}
		public function getTelefono2(){
			return $this->telefono2;
		}
		
		public function setPassword($password){
			$this->password = $password;
		}
		public function getPassword(){
			return $this->password;
		}
		
		public function setTipoUsuario($tipoUsuario){
			$this->tipoUsuario = $tipoUsuario;
		}
		public function getTipoUsuario(){
			return $this->tipoUsuario;
		}
		
		public function setImagenFotografica($imagenFotografica){
			$this->imagenFotografica = $imagenFotografica;
		}
		public function getImagenFotografica(){
			return $this->imagenFotografica;
		}

		public function setPermiso($permiso){
			$this->permiso = $permiso;
		}
		public function getPermiso(){
			return $this->permiso;
		}
		
		public function setEstado($estado){
			$this->estado = $estado;
		}
		public function getEstado(){
			return $this->estado;
		}

		

		
	}
?>