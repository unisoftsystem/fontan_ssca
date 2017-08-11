<?php
	class ConexionBD {
		
		
		public function __construct(){
			
		}
		public function conectar(){
			/*$host = "sql308.260mb.net";
			$user = "n260m_16801686";
			$password = "admin123";
			$database = "n260m_16801686_ssca";*/
			
			
			$host = "localhost";
			$user = "root";
			$password = "";
			$database = "ssca";
			
		
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