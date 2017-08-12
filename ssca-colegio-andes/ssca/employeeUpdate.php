<?php  


if(isset($_POST["codigoProducto"])){  
     $codigoProducto = $_POST["codigoProducto"];  
	$cantidad = $_POST["cantidad"];
    /*$name = echappement(utf8_urldecode($_POST["name"]));  
    $email = echappement(utf8_urldecode($_POST["email"]));  
    $startdate = $_POST["startdate"];  
    $salary = $_POST["salary"];  
    $active = $_POST["active"];  
    $ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];  
    if($active == 'true') $active = 1;  
    else $active = 0;  
  
    connect_db();  
    $query = "UPDATE ".TBL_DEMO_EMPLOYEE." SET ".  
                "NAME='$name',EMAIL='$email',STARTDATE='$startdate',SALARY='$salary'".  
                ",MODIP='$ip',MODDATE=NOW(),ACTIVE=$active ".  
                "WHERE ID='$id'";  
    mysql_query($query);  
    close_db();  */
	//echo $id;
	echo "<script>alert('" . $codigoProducto . " - " . $cantidad . "');</script>";
}  

?>  