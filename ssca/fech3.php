<?php
           
   if(isset($_POST['get_option']))
   {
     $host = 'localhost';
     $user = 'root';
     $pass = 'usc';
           
     mysql_connect($host, $user, $pass);

     mysql_select_db('ssca');
      

     $state = $_POST['get_option'];
     $find=mysql_query("select categoria from servicios where tipo='$state'");
     while($row=mysql_fetch_array($find))
     {
       echo "<option>seleccione</option>";
       echo "<option>".$row['categoria']."</option>";
     }
   
     exit;
   }

?>