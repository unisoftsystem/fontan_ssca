<?php
require_once 'db_connect1.php';

$element = $_POST['value'];
$ruta = $_POST['ruta'];
//fecha
$fechain = date("d/m/Y");
// connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO `cart`(`id`, `valores`, `ruta` , `fecha`) VALUES (NULL,'$element','$ruta','$fechain')");
    // check if row inserted or not
    /*if ($result) {
        echo "<div class=\"alert alert-success\" role=\"alert\">";
        echo "Insersion Exitosa";
        echo "</div>";
    } else {
        // failed to insert row
        echo "<div class=\"alert alert-success\" role=\"alert\">";
        echo "Insersion Fallida";
        echo "</div>";
    }*/
	echo $result;



?>