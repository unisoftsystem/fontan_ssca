<?php
   require_once 'db_config1.php';
           
   if(isset($_POST['get_option']))
   {
     $host = 'localhost';
     $user = 'root';
     $pass = 'usc';
           
     mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);

     mysql_select_db(DB_DATABASE);
      

     $state = $_POST['get_option'];
     $find=mysql_query("select * from servicios where idservicio='$state'");
     while($row=mysql_fetch_array($find))
     {
       
       echo $row['periodicidad'];
     }
   
     exit;
   }

?>