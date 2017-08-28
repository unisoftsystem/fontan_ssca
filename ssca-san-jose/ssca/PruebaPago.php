
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIRDATA", "Data");
	define("DIR_DATA", "Data");
	define("DIR_CONTROLLER", "Controller");

	include_once(DIR_DATA . '/DataCredenciales.php');
	include_once(DIR_DATA . '/DataUsuario.php');
	include_once(DIR_DATA . '/DataRecogida.php');
	include_once(DIR_CONTROLLER . '/Controller_Recogida.php');
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
	include_once(DIR_DATA . '/DataRegistroControl.php');
	include_once(DIR_CONTROLLER . '/Controller_Usuario.php');
	include(DIR_CONTROLLER . '/Controller_Monitor.php');
	
	$dataUsuario = new DataUsuario();
	$dataCredenciales = new DataCredenciales();
	$dataRecogida = new DataRecogida();
	
	$controller_Recogida = new Controller_Recogida();
	$controller_Usuario = new Controller_Usuario();
	$controller_Credenciales = new Controller_Credenciales();
	$controller_Monitor = new Controller_Monitor();
	
	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$idCredencial = $_REQUEST["idCredencial"];
	$fecha = $_REQUEST["fecha"];	
	require_once 'db_connect1.php';
	// connecting to db
	$db = new DB_CONNECT();
	/*
		Obtener datos necesarios
	*/
	$idUsuario = $controller_Credenciales->ObtenerIdUsuario($idCredencial);	
	$resultUsuarioCredencial = $controller_Usuario->ConsultarUsuarioPorCredencial($idCredencial);
	
	if($resultUsuarioCredencial != "[]"){
		$jsonUsuario = json_decode($resultUsuarioCredencial, true);
		
		

			$dato = explode("-", $fecha);  
			$mes = $dato[1];  
			$year = $dato[0];  
			$NumeroId = $jsonUsuario[0]["numeroId"];
			$condicion = "pago ruta " . ObtenerMes($mes) . " " . $year;
			
			$queryServicio  = "SELECT * FROM `asignacion_servicios` WHERE `tipo_servicio`='$condicion' AND `numero_identificacion`='$NumeroId'";
			$resultServicio = mysql_query($queryServicio);
			$numeroRegistros = mysql_num_rows($resultServicio);
			
			if($numeroRegistros > 0){
				echo $numeroRegistros;
			}else{
				$queryValidarServicio  = "SELECT * FROM `log_ruta` WHERE (`tipo`='RECOGIDA' OR `tipo`='BAJADA') AND `idestudiante`='$idUsuario' AND fecha LIKE '%-" . $mes . "-%'";
				$resultValidarServicio = mysql_query($queryValidarServicio);
				$numeroRegistrosServicio = mysql_num_rows($resultValidarServicio);
				if($numeroRegistros == 0){
					echo "Puede subir solo esta vez";
				}else{
					echo "No ha pagado, nuede subir";
				}
				
			}
			
	}
	
	function ObtenerMes($mes){
		$mesLetras = "";
		switch($mes){
			case "01":
				$mesLetras = "Enero";
				break;
			case "02":
				$mesLetras = "Febrero";
				break;
			case "03":
				$mesLetras = "Marzo";
				break;
			case "04":
				$mesLetras = "Abril";
				break;
			case "05":
				$mesLetras = "Mayo";
				break;
			case "06":
				$mesLetras = "Junio";
				break;
			case "07":
				$mesLetras = "Julio";
				break;
			case "08":
				$mesLetras = "Agosto";
				break;
			case "09":
				$mesLetras = "Septiembre";
				break;
			case "10":
				$mesLetras = "Obtubre";
				break;
			case "11":
				$mesLetras = "Noviembre";
				break;
			case "12":
				$mesLetras = "Diciembre";
				break;
		}
		return $mesLetras;
	}
	
	
?>
