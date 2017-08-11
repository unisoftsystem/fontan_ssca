<?php
   
           
   if(isset($_POST['get_option']))
   {
     $host = 'localhost';
     $user = 'root';
     $pass = 'usc';
     $fecha_actual=date("d/m/Y");      
     mysql_connect($host, $user, $pass);

     mysql_select_db('ssca');
      

     $state = $_POST['get_option'];
     $find=mysql_query("select * from cart  ");

     while($row=mysql_fetch_array($find))
     {
       
       echo "<option>".$row['ruta']."</option>";
     }
   
     exit;
   }

?>