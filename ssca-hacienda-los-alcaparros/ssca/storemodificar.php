<?php
require_once 'db_connect1.php';

$element = $_POST['value'];
$ruta = $_POST['ruta'];
// connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
    $result = mysql_query("UPDATE `cart` SET `valores`='$element', `ruta`='$ruta'  WHERE `ruta`='$ruta'");
	echo $result;
?>