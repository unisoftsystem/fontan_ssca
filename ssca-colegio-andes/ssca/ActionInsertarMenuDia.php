
<?php 
	header("Access-Control-Allow-Origin: *");
	define("DIR_DATA", "Data");
	define("DIRDATA", "Data");
	define("DIR_CONTROLLER", "Controller");
	define('UPLOAD_DIR', 'images/');
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	$jsonProteinas = "[";
	$contador = 1;
	$nombre = $_REQUEST["nombre"];
	$rest = $_REQUEST["rest"];
	$proteina = $_REQUEST["proteina"];	
	$descripcion = $_REQUEST["descripcion"];
	$dia = $_REQUEST["dia"];	
	$uidFoto = uniqid();
	$file = "";
	
	$query  = "SELECT * FROM `menudia` WHERE `Dia`=$dia";
    $result = mysql_query($query);
	$numeroFilas = mysql_num_rows($result);
	
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
	
	if($numeroFilas == 0){
		$queryInsert  = "INSERT INTO `menudia`(`id`, `Nombre`, `idProteina`, `Descripcion`, `Dia`, `Foto`, `Edad`) VALUES ($dia,'$nombre',$proteina,'$descripcion',$dia,'$file','$rest')";
    	$resultInsert = mysql_query($queryInsert);
		echo $resultInsert;
	}else{
		$queryUpdate  = "UPDATE `menudia` SET `Nombre`='$nombre',`idProteina`=$proteina,`Descripcion`='$descripcion',`Foto`='$file',`Edad`='$rest' WHERE `Dia`=$dia";
    	$resultUpdate = mysql_query($queryUpdate);
		echo $resultUpdate;
	}
	
	

	
?>