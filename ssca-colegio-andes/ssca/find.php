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
 
 $sql = "SELECT * FROM asignacion_servicios where  numero_identificacion='".$term."'";

 $result = mysql_query($sql);
 $string = '';

if (mysql_num_rows($result) > 0){
  while($row = mysql_fetch_object($result)){

    $string .= " <tr> ";
    $string .= " <center><td style=\"width : 5%\"> ".$row->tipo_servicio." </td></center> ";
    $string .= " <center><td style=\"width : 5%\"> ".number_format($row->valor, 2, '.', '')." </td></center> ";
    

        $estado = $row->estado;
        $checked = "";
        $status = ($estado);
        if ($status == "cancelado" )  
        {
          $status = 1;
          $checked = 'checked="checked"';
        }
        else
        {
          $status = 0;
        }
         

        
        $string .= " <center><td style=\"width : 5%\"> ".$row->estado."<input type=\"checkbox\" name=\"status\" $checked /> </td></center> ";
        $string .= " <center><td style=\"width : 5%\"> ".$row->recibo_pago." </td></center> ";
        $string .= " <center><td style=\"width : 5%\"> ".$row->num_recibo." </td></center> ";
	$string .= " </tr> ";
  }
  
        
}else{
  $string = "No hay resultados";
} 

echo $string;
?>