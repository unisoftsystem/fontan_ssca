<?php
$dbhost							= "localhost";
$dbuser							= "root";
$dbpass							= "";
$dbname							= "ssca";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to database". mysql_error());
mysql_select_db($dbname);
?>