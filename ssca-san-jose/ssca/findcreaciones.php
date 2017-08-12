<?php
require_once 'db_config1.php';
$dbhost							= "localhost";
$dbuser							= "root";
$dbpass							= "usc";
$dbname							= "ssca";

$conn = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die ("Error connecting to database". mysql_error());
mysql_select_db(DB_DATABASE);

$term = strip_tags(substr($_POST['asignacionruta'],0, 100));
//$term = mysql_escape_string($term);

$sql = "SELECT * FROM asignacionruta where id='".$term."'";

$result = mysql_query($sql);


$contador = 1;

if (mysql_num_rows($result) > 0){
	$jsonResultado = "[";
	while($row = mysql_fetch_object($result)){
	
		$id = $row->id; 
		$idruta = $row->idruta;
		$nombreruta = $row->nombreruta; 
		$monitor = $row->monitor; 
		$id_conductor = $row->id_conductor;
		$latorigen = $row->latorigen; 
		$longorigen = $row->longorigen; 
		$latdestino = $row->latdestino; 
		$longdestino = $row->longdestino; 
		
		if($contador == 1){
			$jsonResultado .= '{"id":"' . $id . '", "idruta":"' . $idruta . '", "nombreruta":"' . $nombreruta . '", "monitor":"' . $monitor . '", "id_conductor":"' . $id_conductor . '", "latorigen":"' . $latorigen . '", "longorigen":"' . $longorigen . '", "latdestino":"' . $latdestino . '", "longdestino":"' . $longdestino . '"}';	
		}else{
			if($contador <= mysql_num_rows($result) && $contador != 1){
				$jsonResultado .= ',{"id":"' . $id . '", "idruta":"' . $idruta . '", "nombreruta":"' . $nombreruta . '", "monitor":"' . $monitor . '", "id_conductor":"' . $id_conductor . '", "latorigen":"' . $latorigen . '", "longorigen":"' . $longorigen . '", "latdestino":"' . $latdestino . '", "longdestino":"' . $longdestino . '"}';
			}
		}
	}
	$jsonResultado .= "]";		
	echo $jsonResultado;
}else{
	echo "[]";
} 

?>