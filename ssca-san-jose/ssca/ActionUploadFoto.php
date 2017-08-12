<?php
	function chmod_open()
	{
		$ftp_server = "181.55.254.193";
		$ftp_user = "usc";
		$ftp_pass = "usc";
		
		// establecer una conexión o finalizarla
		$conn_id = ftp_connect($ftp_server) or die("No se pudo conectar a $ftp_server"); 
		
		// intentar iniciar sesión
		if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
			//echo "Conectado como $ftp_user@$ftp_server\n";
		} else {
			//echo "No se pudo conectar como $ftp_user\n";
		}
		return $conn_id;  
	}
	
	function chmod_file($conn_id, $permissions, $path)
	{
		$ftp_root = '/var/www/html/ssca/';
		if (ftp_site($conn_id, 'CHMOD ' . $permissions . ' ' . $ftp_root . $path) !== false)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function chmod_close($conn_id)
	{
		// cerrar la conexión ftp
		ftp_close($conn_id);
	}
	
	if(isset($_FILES["fileFoto"])){
		$file = $_FILES["fileFoto"];
		$nombre = $file["name"];
		$type = $file["type"];
		$ruta_temporal = $file["tmp_name"];
		$size = $file["size"];
		$dimensiones = getimagesize($ruta_temporal);
		$width = $dimensiones[0];
		$height = $dimensiones[1];
		$carpeta = "images/";
		$uidFoto = uniqid();
		
		$src = $carpeta . $nombre;
		move_uploaded_file($ruta_temporal, $src);
		
		// CHMOD the required setup files
	
		// Connect to the FTP
		//$conn_id = chmod_open();
		
		// CHMOD each file and echo the results
		//echo chmod_file($conn_id, 777, $src) ? $src : 'Error';
		//echo $src;
		echo chmod($src, 0777);
		
		//chmod_close($conn_id);
		
	}
	
	/*define('UPLOAD_DIR', 'images/');
	$img = $_POST['imgBase64'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . uniqid() . '.png';
	$success = file_put_contents($file, $data);
	print $success ? $file : 'Unable to save the file.';*/
?>