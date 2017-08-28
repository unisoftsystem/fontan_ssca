<?php
	class ConexionBD {
		
		
		public function __construct(){
			
		}
		public function conectar(){
			/*$host = "sql308.260mb.net";
			$user = "n260m_16801686";
			$password = "admin123";
			$database = "n260m_16801686_ssca";*/
			
			$_uri = explode('/', $_SERVER['REQUEST_URI']);

			$host = "localhost";
			$user = "root";
			$password = "usc";
			$database = $_uri[1];	
			//$database = "ssca-hacienda-los-alcaparros";				
		
			$conexion = mysqli_connect($host, $user, $password);
			mysqli_select_db($conexion, $database);
			return $conexion;
		}
		
		public function execute_query($link, $query){
			$result = mysqli_query($link, $query);
			return $result;
		}
		
		public function desconcetar(){
			
		}
	}
?>