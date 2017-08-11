<?php
        //se obtiene año
        $y = date("Y");
        error_reporting(0);
        //se obtiene el mes y se realiza un switch
        $m = date("m");
        function genMonth_Text($m) { 
         switch ($m) { 
          case 1: $month_text = "Enero"; break; 
          case 2: $month_text = "Febrero"; break; 
          case 3: $month_text = "Marzo"; break; 
          case 4: $month_text = "Abril"; break; 
          case 5: $month_text = "Mayo"; break; 
          case 6: $month_text = "Junio"; break; 
          case 7: $month_text = "Julio"; break; 
          case 8: $month_text = "Agosto"; break; 
          case 9: $month_text = "Septiembre"; break; 
          case 10: $month_text = "Octubre"; break; 
          case 11: $month_text = "Noviembre"; break; 
          case 12: $month_text = "Diciembre"; break; 
         } 
         return ($month_text); 
        } 
        $m = genMonth_Text($m); 
        $date = "$m"; 
        //conexion
        require_once 'db_connect1.php';
        // connecting to db
        $db = new DB_CONNECT();
        // mysql inserting a new row
        $term = strip_tags(substr($_POST['usuario'],0, 100));
        $term = mysql_escape_string($term);
        $r = "Restaurante ".$date." ".$y; 
        //validacion de credencial
        
        $query  = "SELECT idUsuarioSecundario  FROM credenciales where  idCredencial='".$term."'";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $idUsuarioSecundario = ($row['idUsuarioSecundario']);
        }

?>

<?php
          include("connect.php");
          $query1  = "SELECT  tipo_servicio, estado FROM asignacion_servicios where numero_identificacion='".$idUsuarioSecundario."' AND estado='cancelado' AND tipo_servicio='".$r."'";
          $result1 = mysql_query($query1);
          if (mysql_num_rows($result1)>0) {
          // successfully select database
          echo "<div class=\"alert alert-success\" role=\"alert\">";
          echo "El estudiante puede ingresar al restaurante";
          //msj para el insert del log
          $msj = "El estudiante puede ingresar al restaurante"; 
          echo "</div>";
        
          //fecha y hora para el insert
          $fechain = date("d/m/Y");
          $horain  = date("H:i:s");
          // mysql inserting a new row
          $result = mysql_query("INSERT INTO log_restaurante(documento,fecha,hora,mensaje) VALUES('".$term."', '".$fechain."', '".$horain."', '".$msj."')");
          }else{
          // failed to insert row
          echo "<div class=\"alert alert-success\" role=\"alert\">";
          echo "El estudiante no puede ingresar al restaurante";
          echo "</div>";
          }

?>		