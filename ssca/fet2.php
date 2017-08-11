<?php
   
           
   if(isset($_POST['get_option']))
   {
     $host = 'localhost';
     $user = 'root';
     $pass = 'usc';
           
     mysql_connect($host, $user, $pass);

     mysql_select_db('ssca');
      

     $state = $_POST['get_option'];
     $find=mysql_query("select * from servicios where idservicio='$state'");
     while($row=mysql_fetch_array($find))
     {
       
       echo $row['valor'];
     }
   
     exit;
   }

?>