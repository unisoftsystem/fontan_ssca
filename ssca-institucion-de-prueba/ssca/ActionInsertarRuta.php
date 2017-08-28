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
	
	// connecting to db
	$db = new DB_CONNECT();
	// mysql inserting a new row
	$query = "INSERT INTO `asignacionruta`(`idruta`, `nombreruta`, `monitor`, `latorigen`, `longorigen`, `latdestino`, `longdestino`) VALUES ('$valor','$nombre','$valor2','$valor7','$valor3','$valor4','$valor5')";
	$result = mysql_query("INSERT INTO asignacionruta(idruta, nombreruta, monitor,id_conductor, latorigen, longorigen, latdestino, longdestino) VALUES('".$valor."', '".$nombre."', '".$valor2."','".$valor7."', '".$valor3."', '".$valor4."', '".$valor5."', '".$valor6."')");
	$rs = mysql_query("SELECT MAX(id) AS id FROM asignacionruta");
	$row = mysql_fetch_row($rs);
	$id = trim($row[0]);
	echo $id;
	
?>