<?php
require_once 'db_config1.php';
$dbhost							= "localhost";
$dbuser							= "root";
$dbpass							= "usc";
$dbname							= "ssca";

$conn = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die ("Error connecting to database". mysql_error());
mysql_select_db(DB_DATABASE);
 
 $term = strip_tags(substr($_POST['search_term'],0, 100));
 $term = mysql_escape_string($term);
 
 $sql = "SELECT * FROM usuarios where  NumeroId='".$term."'";

 $result = mysql_query($sql);
 $string = '';

if (mysql_num_rows($result) > 0){
  while($row = mysql_fetch_object($result)){

    $string .= $row->SegundoApellido; 
  }

}else{
  $string = "No hay resultados";
} 

echo $string;
?>