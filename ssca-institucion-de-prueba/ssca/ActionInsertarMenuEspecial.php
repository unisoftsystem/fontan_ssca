
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
	$valor = $_REQUEST["valor"];	
	$descripcion = $_REQUEST["descripcion"];
	$dia = $_REQUEST["dia"];	
	$uidFoto = uniqid();
	$file = "";
	
	$query  = "SELECT * FROM `menuespecial` WHERE `Dia`=$dia";
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
		$queryInsert  = "INSERT INTO `menuespecial`(`id`, `Nombre`, `Valor`, `Descripcion`, `Dia`, `Foto`) VALUES ($dia,'$nombre',$valor,'$descripcion',$dia,'$file')";
    	$resultInsert = mysql_query($queryInsert);
		echo $resultInsert;
	}else{
		$queryUpdate  = "UPDATE `menuespecial` SET `Nombre`='$nombre',`Valor`=$valor,`Descripcion`='$descripcion',`Foto`='$file' WHERE `Dia`=$dia";
    	$resultUpdate = mysql_query($queryUpdate);
		echo $resultUpdate;
	}
	
	

	
?>