<?php 
include("connect.php");
$valor	= $_POST['arrayorder'];

$comma_separated = implode(",", $valor);

$result = mysql_query("INSERT INTO cart(valores) VALUES('".$comma_separated."')");

	if ($result) {
        // successfully inserted into database
        echo "Insersion Exitosa ";
    } else {
        // failed to insert row
        echo "Insersion Fallida ";
    }
?>