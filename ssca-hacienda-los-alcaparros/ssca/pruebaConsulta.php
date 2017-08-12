<?php
  require_once 'db_config1.php';
  header("Access-Control-Allow-Origin: *");          
   
   $host = 'localhost';
   $user = 'root';
   $pass = 'usc';
   mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);

   mysql_select_db(DB_DATABASE);
    

   $find=mysql_query("SELECT * FROM `usuarios` INNER JOIN credenciales ON credenciales.idUsuarioSecundario = usuarios.idUsuario WHERE usuarios.NumeroId = '79000001'");
   
   $contador = 0;
   echo "[";
   while($row=mysql_fetch_array($find))
   {
    if($contador == 0){
      echo json_encode($row);
    }else{
      echo "," . json_encode($row);
    }
     
     
   }
   echo "]";
   exit;
   

?>