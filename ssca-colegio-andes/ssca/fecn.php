<?php
  require_once 'db_config1.php';
  header("Access-Control-Allow-Origin: *");          
   if(isset($_POST['get_option']))
   {
     $host = 'localhost';
     $user = 'root';
     $pass = 'usc';
     $fecha_actual=date("d/m/Y");      
     mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);

     mysql_select_db(DB_DATABASE);
      

     $state = $_POST['get_option'];
     $find=mysql_query("select asignacionruta.* from cart INNER JOIN asignacionruta ON asignacionruta.`id` = cart.ruta where cart.valores='$state'");

     while($row=mysql_fetch_array($find))
     {
       
       echo "<option value='".$row['id']."'>".$row['nombreruta']."</option>";
     }
     exit;
   }

?>