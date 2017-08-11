<?php

$dbhost							= "localhost";
$dbuser							= "root";
$dbpass							= "usc";
$dbname							= "ssca";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to database". mysql_error());
mysql_select_db($dbname);
 
 $term = strip_tags(substr($_POST['search_term'],0, 100));
 $term = mysql_escape_string($term);
 
 $sql = "SELECT * FROM usuarios where  NumeroId='".$term."'";

 $result = mysql_query($sql);
 $string = '';

if (mysql_num_rows($result) > 0){
  while($row = mysql_fetch_object($result)){

    $string .= $row->PrimerApellido; 
  }

}else{
  $string = "No hay resultados";
} 

echo $string;
?>