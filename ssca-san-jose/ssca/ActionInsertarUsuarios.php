
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIRDATA", "Data");
	define("DIR_DATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	define('UPLOAD_DIR', 'images/');
	
	
	include_once(DIR_DATA . '/DataUsuarios.php');
	include_once(DIR_CONTROLLER . '/Controller_Usuarios.php');
	
	$resultCredenciales = ""; 
	
	$dataUsuario = new DataUsuarios();
	
	$Controller_Usuarios = new Controller_Usuarios();

	/*
		Obtener valores enviados desde el script de la conexion
	*/
	$tipoId = $_REQUEST["tipoId"];	
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
	$uidFoto = uniqid();
	$permisos = $_REQUEST["permisos"];
	$file = "";
	
	/*
		Descripcion: Subir foto al servidor local, convierte la imagen que estaba en base64 a un archivo png
	*/
	if($_POST['imgBase64'] != ""){
		$img = $_POST['imgBase64'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = UPLOAD_DIR . $uidFoto . '.png';
		$success = file_put_contents($file, $data);
	}
	/*
		Setear los datos del usuario en un objeto
	*/
	$dataUsuario->setTipoId($tipoId);	
	$dataUsuario->setNumeroId($numeroId);
	$dataUsuario->setPrimerApellido($primerApellido);
	$dataUsuario->setSegundoApellido($segundoApellido);
	$dataUsuario->setPrimerNombre($primerNombre);
	$dataUsuario->setSegundoNombre($segundoNombre);
	$dataUsuario->setDireccion($direccion);
	$dataUsuario->setTelefono1($telefono1);	
	$dataUsuario->setTelefono2($telefono2);	
	$dataUsuario->setIdUsuario($usuario);
	$dataUsuario->setPassword($clave);
	$dataUsuario->setPermiso($permisos);
	$dataUsuario->setImagenFotografica($file);
	
	
	//Llamar la funcion que crea un usuario del sistema
	$resultUsuarioNuevo = $Controller_Usuarios->CrearUsuarios($dataUsuario,$permisos);	
	
	
	
	
	
?>