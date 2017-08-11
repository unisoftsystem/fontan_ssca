<?php
	class DataProducto {
		private $codigoProducto;
		private $nombreProducto;	
		private $descripcion;	
		private $valorUnitario;	
		private $categoria;	
		private $subcategoria;	
		private $stock;	
		private $estado;	
		private $imagen;	
		
		public function __construct(){
			
		}
		
		public function setCodigoProducto($codigoProducto){
			$this->codigoProducto = $codigoProducto;
		}
		public function getCodigoProducto(){
			return $this->codigoProducto;
		}
		
		public function setNombreProducto($nombreProducto){
			$this->nombreProducto = $nombreProducto;
		}
		public function getNombreProducto(){
			return $this->nombreProducto;
		}
		
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}
		public function getDescripcion(){
			return $this->descripcion;
		}
		
		public function setValorUnitario($valorUnitario){
			$this->valorUnitario = $valorUnitario;
		}
		public function getValorUnitario(){
			return $this->valorUnitario;
		}
		
		public function setCategoria($categoria){
			$this->categoria = $categoria;
		}
		public function getCategoria(){
			return $this->categoria;
		}
		
		public function setSubcategoria($subcategoria){
			$this->subcategoria = $subcategoria;
		}
		public function getSubcategoria(){
			return $this->subcategoria;
		}
		
		public function setStock($stock){
			$this->stock = $stock;
		}
		public function getStock(){
			return $this->stock;
		}
		
		public function setEstado($estado){
			$this->estado = $estado;
		}
		public function getEstado(){
			return $this->estado;
		}
		
		public function setImagen($imagen){
			$this->imagen = $imagen;
		}
		public function getImagen(){
			return $this->imagen;
		}
	}
?>