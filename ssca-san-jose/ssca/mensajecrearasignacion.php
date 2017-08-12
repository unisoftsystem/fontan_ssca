<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SSCA</title>
        <link href="css/styler.css" rel="stylesheet"/>
        <link href="css/menu.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/style.js"></script>  
        <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
        <script src="js/script.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        
    </head>
    <body id="bodyBase">
<?php
error_reporting(0);
 //conexion
  require_once 'db_connect1.php';
 // connecting to db
  $db = new DB_CONNECT();
//se obtiene el año
$y = date("Y");
//se obtiene el mes
$m = date("m");
//funcion fechas
function genMonth_Text($m) { 
  $month_text = "";
  if($m > 12) $m = $m - 12;
  if($m > 12) $m = $m - 12;
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
  default : $month_text = "Fuera Rango = ".$m; break; 
 } 
 return ($month_text); 
} 
$m = genMonth_Text($m); 
$date = "$m"; 
//datos de estudiante
 $valor = $_REQUEST["nidentificacion"];
 $valor1 = $_REQUEST["apellido1"];
 $valor2 = $_REQUEST["apellido2"];
 $valor3 = $_REQUEST["nombre1"];
 $valor4 = $_REQUEST["nombre2"];
//select 1
 $valor5 = isset($_REQUEST["tipo"]) ? $_REQUEST["tipo"] : "";
 $valor6 = isset($_REQUEST["new"]) ? $_REQUEST["new"] : "";
 $valor7 = isset($_REQUEST["new_select"]) ? $_REQUEST["new_select"] : "";
 $valor18 = isset($_REQUEST["periodicidad"]) ? $_REQUEST["periodicidad"] : "";
//select 2
 $valor8 = isset($_REQUEST["tipo4"]) ? $_REQUEST["tipo4"] : "";
 $valor9 = isset($_REQUEST["new2"]) ? $_REQUEST["new2"] : "";
 $valor10 = isset($_POST["new_sell"]) ? $_REQUEST["new_sell"] : "";
 $valor19 = isset($_REQUEST["periodicidad1"]) ? $_REQUEST["periodicidad1"] : "";
//select 3
 $valor11 = isset($_REQUEST["tipo1"]) ? $_REQUEST["tipo1"] : "";
 $valor12 = isset($_REQUEST["new1"]) ? $_REQUEST["new1"] : "";
 $valor13 = isset($_POST["new_sel"]) ? $_REQUEST["new_sel"] : "";
 $valor20 = isset($_REQUEST["periodicidad2"]) ? $_REQUEST["periodicidad2"] : "";
//datos complementarios
 $valor14 = isset($_POST["r1"]) ? $_REQUEST["r1"] : "";
 $valor15 = isset($_POST["r2"]) ? $_REQUEST["r2"] : "";
 $valor16 = isset($_REQUEST["valortotal"]) ? $_REQUEST["valortotal"] : "";
 $valor17 = isset($_REQUEST["btnCrearUsuario"]) ? $_REQUEST["btnCrearUsuario"] : "";

//validacion de check
if ($valor14 == "Pago en Efectivo" OR $valor14 == "Pago con Credencial"){
   $pago = "cancelado";
}else{
   $pago = "sin pago";
}
//validacion de pago o sin pago
if ($valor17 == 0){
   $pago = "sin pago";
}else{
   $pago = "cancelado";
} 
    //insert primera linea
    if (!empty($_POST['tipo'])) {
     if (!empty($_POST['new'])) {
      if (!empty($_POST['new_select'])) {   
       if (!empty($_POST['periodicidad'])) {
        //selecionamos el usuario
        $resultus = mysql_query("SELECT * FROM usuarios  WHERE  NumeroId='".$valor."'");    
         $qty= 0;
         while ($row = mysql_fetch_assoc($resultus)) 
        {
          $idUsuario = $row['idUsuario'];
        }
        //selecionamos la credencial
        $result1 = mysql_query("SELECT * FROM credenciales  WHERE  idUsuarioSecundario='".$idUsuario."'");    
         $qty= 0;
         if ($result1) {
         while ($row = mysql_fetch_assoc($result1)) 
        {
          $idCredencial = $row['idCredencial'];
          $SaldoCredencial = $row['SaldoCredencial']; 
        }

         if ($SaldoCredencial > 0) {
        //valido que el saldo sea mayoy
         if ($SaldoCredencial >= $valor16) {
         //valido el boton de pago  1 es pagado
         if ($valor17 == 1 AND $valor14 == "Pago con Credencial"){
        //operacion para realizar el saldo
         $SaldoActual = $SaldoCredencial - $valor16;
         //fecha
         $fecha_actual=date("Y/m/d");
         //hora
         $hora_actual = date("H:i:s", $time);
         $result2 = mysql_query("UPDATE credenciales SET SaldoCredencial = '$SaldoActual' WHERE  idCredencial ='".$idCredencial."' "); //actualizamos valor credencial
         $resultmov = mysql_query("INSERT INTO movimientos(idUsuario,idCredencial,ValorMovimiento,FechaMovimiento,HoraMovimiento,DescripcionMovimiento) VALUES('".$idUsuario."', '". $idCredencial."', '".$valor16."', '".$fecha_actual."' , '".$hora_actual."', '".$valor6."')");
         }

        //ciclo de periodicidad e inserta la cantidad de veces que traiga ese valor
        $values = array();
        //mes
        $m = date("m") + 0;
        for ($x=0; $x < $valor18; $x++){
          $m = genMonth_Text($m + $x);
          $values[] = "('$valor','$valor1','$valor2','$valor3','$valor4','$valor5 $m $y','$valor6','$valor7','$valor14','$valor16','$valor17','$pago')";
        }
        //sentencia
        $sql = "INSERT INTO asignacion_servicios(numero_identificacion,primer_apellido,segundo_apellido,primer_nombre,segundo_nombre,tipo_servicio,categoria,valor,tipo_pago,valor_total,estado_pago,estado) VALUES";
        //valores
        $sql .= implode(",",$values); 
        //resultado 
        $result = mysql_query($sql);
        // validacion
        if ($result) {
            // successfully inserted into database
            echo "<div class=\"alert alert-success\" role=\"alert\">";
            echo "Insersion Exitosa de Asignacion<br />";
            echo "</div>";
            header( "refresh:5; url=asignacionpagoinicial.php" );
        } else {
            // failed to insert row
            echo "<div class=\"alert alert-success\" role=\"alert\">";
            echo "Insersion Fallida de Asignacion";
            echo "</div>";
            header( "refresh:5; url=asignacionpagoinicial.php" );
        } 
       }else{
           if ($valor14 == "Pago en Efectivo"){

            //ciclo de periodicidad e inserta la cantidad de veces que traiga ese valor
            $values = array();
            //mes
            $m = date("m") + 0;
            for ($x=0; $x < $valor18; $x++){
              $m = genMonth_Text($m + $x);
              $values[] = "('$valor','$valor1','$valor2','$valor3','$valor4','$valor5 $m $y','$valor6','$valor7','$valor14','$valor16','$valor17','$pago')";
            }
            //sentencia
            $sql = "INSERT INTO asignacion_servicios(numero_identificacion,primer_apellido,segundo_apellido,primer_nombre,segundo_nombre,tipo_servicio,categoria,valor,tipo_pago,valor_total,estado_pago,estado) VALUES";
            //valores
            $sql .= implode(",",$values); 
            //resultado 
            $result = mysql_query($sql);
            // validacion
            if ($result) {
                // successfully inserted into database
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "Insersion Exitosa de Asignacion<br />";
                echo "</div>";
                header( "refresh:5; url=asignacionpagoinicial.php" );
            } else {
                // failed to insert row
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "Insersion Fallida de Asignacion";
                echo "</div>";
                header( "refresh:5; url=asignacionpagoinicial.php" );
            } 

           }else{
            // failed to insert row
            echo "<div class=\"alert alert-success\" role=\"alert\">";
            echo "Saldo insuficiente debe recargar la credencial para realizar el pago";
            echo "</div>";
            header( "refresh:5; url=asignacionpagoinicial.php" );
            } 
       }
     }else{
        // failed to insert row
            echo "<div class=\"alert alert-success\" role=\"alert\">";
            echo "La credencial tiene saldo en 0 por favor recargue";
            echo "</div>";
            header( "refresh:5; url=asignacionpagoinicial.php" );
       }
     }else{
        // failed to insert row
            echo "<div class=\"alert alert-success\" role=\"alert\">";
            echo "Insersion Fallida de Asignacion la credencial no existe";
            echo "</div>";
            header( "refresh:5; url=asignacionpagoinicial.php" );
       }
      }
     }
    }
  }

    //insert segunda linea
    if (!empty($_POST['tipo4'])) {
     if (!empty($_POST['new2'])) {
      if (!empty($_POST['new_sell'])) {   
       if (!empty($_POST['periodicidad1'])) { 
        //ciclo de periodicidad e inserta la cantidad de veces que traiga ese valor
        $values1 = array();
        //mes
        $m = date("m") + 0;
        for ($x=0; $x < $valor19; $x++){
        $m = genMonth_Text($m + $x);
        $values1[] = "('$valor','$valor1','$valor2','$valor3','$valor4','$valor8 $m $y','$valor9','$valor10','$valor14','$valor16','$valor17','$pago')";
        }
        //sentencia
        $sql1 = "INSERT INTO asignacion_servicios(numero_identificacion,primer_apellido,segundo_apellido,primer_nombre,segundo_nombre,tipo_servicio,categoria,valor,tipo_pago,valor_total,estado_pago,estado) VALUES";
        //valores
        $sql1 .= implode(",",$values1); 
        //resultado 
        $result = mysql_query($sql1);
        // validacion
        if ($result) {
            // successfully inserted into database
            echo "<div class=\"alert alert-success\" role=\"alert\">";
            echo "Insersion Exitosa de Asignacion";
            echo "</div>";
            header( "refresh:5; url=asignacionpagoinicial.php" );
        } else {
            // failed to insert row
            echo "<div class=\"alert alert-success\" role=\"alert\">";
            echo "Insersion Fallida de Asignacion";
            echo "</div>";
            header( "refresh:5; url=asignacionpagoinicial.php" );
        }          
      }
     }
    }
   }


   //insert tercera linea
    if (!empty($_POST['tipo1'])) {
     if (!empty($_POST['new1'])) {
      if (!empty($_POST['new_sel'])) {   
       if (!empty($_POST['periodicidad2'])) { 
        //ciclo de periodicidad e inserta la cantidad de veces que traiga ese valor
        $values2 = array();
        //mes
        $m = date("m") + 0;
        for ($x=0; $x < $valor20; $x++){
        $m = genMonth_Text($m + $x);
        $values2[] = "('$valor','$valor1','$valor2','$valor3','$valor4','$valor11 $m $y','$valor12','$valor13','$valor14','$valor16','$valor17','$pago')";
        }
        //sentencia
        $sql2 = "INSERT INTO asignacion_servicios(numero_identificacion,primer_apellido,segundo_apellido,primer_nombre,segundo_nombre,tipo_servicio,categoria,valor,tipo_pago,valor_total,estado_pago,estado) VALUES";
        //valores
        $sql2 .= implode(",",$values2); 
        //resultado 
        $result = mysql_query($sql2);
        // validacion
        if ($result) {
            // successfully inserted into database
            echo "<div class=\"alert alert-success\" role=\"alert\">";
            echo "Insersion Exitosa de Asignacion";
            echo "</div>";
            header( "refresh:5; url=asignacionpagoinicial.php" );
        } else {
            // failed to insert row
            echo "<div class=\"alert alert-success\" role=\"alert\">";
            echo "Insersion Fallida de Asignacion";
            echo "</div>";
            header( "refresh:5; url=asignacionpagoinicial.php" );
        }          
      }
     }
    }
   }

?>
    <script src="js/jquery.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>    
    </body>
</html>