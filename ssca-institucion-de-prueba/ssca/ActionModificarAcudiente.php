
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	define('UPLOAD_DIR', 'images/');
	
	include_once(DIR_CONTROLLER . '/Controller_Usuario.php');
	include_once(DIR_CONTROLLER . '/Controller_Credenciales.php');
	
	$resultCredenciales = ""; 
	
	$dataUsuario = new DataUsuario();
	
	$controller_Usuario = new Controller_Usuario();
	$controller_Credenciales = new Controller_Credenciales();

	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$estado = "ACTIVO";
	$numeroId = $_REQUEST["numeroId"];	
	$primerApellido = $_REQUEST["primerApellido"];	
	$segundoApellido = $_REQUEST["segundoApellido"];	
	$primerNombre = $_REQUEST["primerNombre"];	
	$segundoNombre = $_REQUEST["segundoNombre"];	
	$direccion = $_REQUEST["direccion"];	
	$telefono1 = $_REQUEST["telefono1"];	
	$telefono2 = $_REQUEST["telefono2"];
	$usuario = $_REQUEST["usuario"];
	$clave = $_REQUEST["clave"];
	$idAcudiente = $_REQUEST["idAcudiente"];
	$fechanacimiento = $_REQUEST["fechanacimiento"];
	$curso = $_REQUEST["curso"];
	$tipoSangre = $_REQUEST["tipoSangre"];
	$latitud = $_REQUEST["latitud"];
	$longitud = $_REQUEST["longitud"];
	$fechaVencimiento = $_REQUEST["fechaVencimiento"];
	$arl = $_REQUEST["arl"];
	$cargo = $_REQUEST["cargo"];
	$uidFoto = uniqid();

	/*
		Descripcion: Subir foto al servidor local, convierte la imagen que estaba en base64 a un archivo png
	*/
	if($_POST['imgBase64'] != ""){
		$img = $_POST['imgBase64'];
		$img = str_replace('data:image/png;base64,', '', $img);
		
		if($img == str_replace('data:image/png;base64,', '', $img)){
			$img = str_replace('data:image/jpeg;base64,', '', $img);
		}
		
		
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = UPLOAD_DIR . $uidFoto . '.png';
		$success = file_put_contents($file, $data);
	}
	
	
	/*
		Setear los datos del usuario en un objeto
	*/
	$dataUsuario->setNumeroId($numeroId);
	$dataUsuario->setPrimerApellido($primerApellido);
	$dataUsuario->setEstado($estado);
	$dataUsuario->setSegundoApellido($segundoApellido);
	$dataUsuario->setPrimerNombre($primerNombre);
	$dataUsuario->setSegundoNombre($segundoNombre);
	$dataUsuario->setDireccion($direccion);
	$dataUsuario->setTelefono1($telefono1);	
	$dataUsuario->setTelefono2($telefono2);
	$dataUsuario->setIdUsuario($usuario);
	$dataUsuario->setPassword($clave);
	$dataUsuario->setLatitud($latitud);
	$dataUsuario->setLongitud($longitud);
	$dataUsuario->setImagenFotografica($file);
	$dataUsuario->setIdAcudiente($idAcudiente);
	$dataUsuario->setCurso($curso);
	$dataUsuario->setFecha($fechanacimiento);
	$dataUsuario->setArl($arl);
	$dataUsuario->setCargo($cargo);
	$dataUsuario->setTipoSangre($tipoSangre);
	
	
	//Llamar la funcion que crea un usuario
	$resultUsuarioModificado = $controller_Usuario->ModificarAcudiente($dataUsuario);	
	
	echo $resultUsuarioModificado;
	
	
?>