<?php
  
  header("Access-Control-Allow-Origin: *");          
   if(isset($_POST['get_option']))
   {
     $host = 'localhost';
     $user = 'root';
     $pass = 'usc';
     $fecha_actual=date("d/m/Y");      
     mysql_connect($host, $user, $pass);

     mysql_select_db('ssca');
      

     $state = $_POST['get_option'];
     $find=mysql_query("select asignacionruta.* from cart INNER JOIN asignacionruta ON asignacionruta.`id` = cart.ruta where cart.valores='$state'");

     while($row=mysql_fetch_array($find))
     {
       
       echo "<option value='".$row['id']."'>".$row['nombreruta']."</option>";
     }
   
     exit;
   }

?>