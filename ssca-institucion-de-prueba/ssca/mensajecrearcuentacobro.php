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
         session_start();
         $valor = json_decode($_SESSION['productos']);
         $valor1 = $_REQUEST["area"];
         $valor2 = $_REQUEST["tercero"];
         $valor3 = $_REQUEST["fecha_generacion"];
         $valor4 = $_REQUEST["fecha_corte"];
         $valor5 = $_REQUEST["valor_cuenta"];
         $valor6 = $_REQUEST["desc1"];
         $valor7 = $_REQUEST["desc2"];
         $valor8 = $_REQUEST["desc3"];
         $valor9 = $_REQUEST["desc4"];
         $valor11 = $_REQUEST["hora_corte"];
         $valor12 = $_REQUEST["Text1"];
         $valor13 = json_decode($_SESSION['operaciones']);
         $resta = $valor5-(($valor5*$valor6)/100);
         $resta1 = $resta-(($resta*$valor7)/100);
         $valor10 = $resta1; 
         
          if($_REQUEST["valor_cuenta"] > 0){

         require_once 'db_connect1.php';
            // connecting to db
            $db = new DB_CONNECT();
            // mysql inserting a new row
            $result = mysql_query("INSERT INTO cuenta_cobro(descripcion,area,tercero,fecha_generacion,fecha_corte,valor_cuenta,desc1,desc2,desc3,desc4,valor_total,hora_corte,observaciones) VALUES('".$valor."', '".$valor1."', '".$valor2."', '".$valor3."' , '".$valor4."', '".$valor5."', '".$valor6."', '".$valor7."', '".$valor8."', '".$valor9."', '".$valor10."', '".$valor11."', '".$valor12.$valor13."')");
            // check if row inserted or not
            if ($result) {
                // successfully inserted into database
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "<div class=\"col-md-2 col-md-offset-5\">";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "Insersion Exitosa de Cuenta Cobro";
                echo "</div>";
                echo "</div>";
                header( "refresh:3;url=CrearCuentaCobro.php" );
            } else {
                // failed to insert row
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "<div class=\"col-md-2 col-md-offset-5\">";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "Insersion Fallida de Cuenta Cobro";
                echo $result;
                echo "</div>";
                echo "</div>";
                header( "refresh:3;url=CrearCuentaCobro.php" );
            }
}else{
   // failed to insert row
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "<div class=\"col-md-2 col-md-offset-5\">";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "Insersion Fallida de Cuenta Cobro  el valor no puede ser 0";
                echo $result;
                echo "</div>";
                echo "</div>";
                header( "refresh:3;url=CrearCuentaCobro.php" );
}
    ?>
    <script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>    
    </body>
</html>