<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Logo_footer
{
	
	function __construct()
	{
		
	}

	public function obtener_logo(){
		$_uri = explode('/', $_SERVER['REQUEST_URI']);

		$host = "localhost";
		$user = "root";
		$password = "usc";
		$database = "ssca_saas";	
		$colegio = $_uri[1];	
		$logo = "";				
	
		$conexion = mysqli_connect($host, $user, $password);
		mysqli_select_db($conexion, $database);

		$query = "SELECT * FROM  `_colegios` WHERE  `dominio` LIKE  '$colegio'";

		$result = mysqli_query($conexion, $query);

		$numeroFilas = mysqli_num_rows($result);

		if($numeroFilas != 0){

			while($registro = mysqli_fetch_array($result)){
				$logo = $registro["img_logo"];
			}
			if($logo == ""){
				$logo = "img/logo app.png";
			}
		}

		
		return $logo;
	}
}
