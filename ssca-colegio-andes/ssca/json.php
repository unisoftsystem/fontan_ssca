<?php
        include("connect.php");
        $query  = "SELECT NumeroId, PrimerNombre, PrimerApellido, ruta_idruta, ImagenFotografica FROM usuarios ";
        $result = mysql_query($query);
        
        $data = array();

        while($row = mysql_fetch_array($result)) {
          $data[] = $row;

          $json = json_decode(json_encode($data),true);

          foreach ($json as $item) {
            echo $item['NumeroId'];
          } 
        }

          
?>