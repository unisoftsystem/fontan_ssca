<?php
	require_once 'db_connect1.php';
	
	$valor = $_REQUEST["ruta"];
	$valor2 = $_REQUEST["monitor"];
	$valor3 = $_REQUEST["lat"];
	$valor4 = $_REQUEST["lng"];
	$valor5 = $_REQUEST["lats"];
	$valor6 = $_REQUEST["lngs"];
	$valor7 = $_REQUEST["conductor"];
	$curso = $_REQUEST['cursos'];
	$nombre = $_REQUEST["nombre"];
	$id = $_REQUEST["asignacionruta"];

	
	// connecting to db
	$db = new DB_CONNECT();
	$query = "UPDATE `asignacionruta` SET `idruta`='$valor', `nombreruta`='$nombre', `monitor`='$valor2', `latorigen`='$valor3', `longorigen`='$valor4',`latdestino`='$valor5',`longdestino`='$valor6'  WHERE `id`='$id'";

	$result = mysql_query("UPDATE `asignacionruta` SET `idruta`='" . $valor . "', `nombreruta`='" . $nombre . "', `monitor`='" . $valor2. "', `id_conductor`='" . $valor7 . "', `latorigen`='" . $valor3 . "', `longorigen`='" . $valor4 . "', `latdestino`='" . $valor5 . "', `longdestino`='" . $valor6 . "' WHERE `id`='" . $id . "'");
	echo $valor . " - " . $valor2 . " - " . $valor3 . " - " . $valor4 . " - " . $valor5 . " - " . $valor6 . " - " . $valor7 . " - " . $curso . " - " . $nombre . " - " . $id . " - " . $result;	
?>