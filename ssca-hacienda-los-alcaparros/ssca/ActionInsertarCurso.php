
<?php 
	header("Access-Control-Allow-Origin: *");
	
	require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
	
	$descripcion = $_REQUEST["descripcion"];
	
	$query  = "INSERT INTO `cursos`(`id`, `Descripcion`) VALUES (NULL,'$descripcion')";
    $result = mysql_query($query);
	
	
  	echo $result;

	
?>