<?php
require_once 'db_connect1.php';

$element = $_POST['value'];
$ruta = $_POST['ruta'];
// connecting to db
$db = new DB_CONNECT();
$resultEliminar = mysql_query("DELETE FROM `cart` WHERE `ruta`='$ruta'");


echo $resultEliminar;



?>