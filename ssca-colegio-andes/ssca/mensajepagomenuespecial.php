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
         $consecutivointerno = $_REQUEST["consecutivointerno"];
         $descp= $_REQUEST["desc"];
         $valoragregarcredencial = $_REQUEST["valoragregarcredencial"];
         $valorplatoespecial = $_REQUEST["valorplatoespecial"];
         $idCredencial = $_REQUEST["idCredencial"];
         //concateno para pasar a descripcion en el insert
        $des = 'Cambio por Plato Especial '.$descp;
         require_once 'db_connect1.php';
            // connecting to db
            $db = new DB_CONNECT();
             //consulto saldo de credencial
             $resultconsultacredencial = mysql_query("SELECT * FROM credenciales where idCredencial='".$idCredencial."'");    
             if ($row = mysql_fetch_assoc($resultconsultacredencial)) {
              $SaldoCredencial = $row['SaldoCredencial'];
              }
              //valido saldo
        if($SaldoCredencial > 0){

        if($_REQUEST["valorplatoespecial"] > 0){  

        if($SaldoCredencial > $_REQUEST["valorplatoespecial"]){
        //descuento el valor del plato especial
         $Nuevosaldo = $SaldoCredencial - $_REQUEST["valoragregarcredencial"];    
            // mysql inserting a new row
            $result = mysql_query("UPDATE credenciales SET SaldoCredencial = $Nuevosaldo WHERE  idCredencial='".$idCredencial."'");
            
                //se realiza la actualizacion de la orden
                $result = mysql_query("UPDATE ordenpedido SET UbicacionPedido='ENTREGADO'  WHERE ConsecutivoInterno='".$consecutivointerno."'");
                $result = mysql_query("UPDATE ordenpedido SET observaciones='Cambio a Plato Especial' WHERE ConsecutivoInterno='".$consecutivointerno."'");
                
            if ($result) {
                // successfully inserted into database
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "<div class=\"col-md-2 col-md-offset-5\">";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "Pago de Plato Especial Exitoso";
                echo "</div>";
                echo "</div>";
                header( "refresh:3;url=lectorQREntrega.html" );
            } else {
                // failed to insert row
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "<div class=\"col-md-2 col-md-offset-5\">";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "El Pago del Plato Especial No se Pudo Realizar";
                echo $result;
                echo "</div>";
                echo "</div>";
                header( "refresh:3;url=lectorQREntrega.html" );
            }


}else{
   // en el caso que el saldo sea 0
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "<div class=\"col-md-2 col-md-offset-5\">";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "El saldo es insuficiente para el pago del plato especial";
                echo $result;
                echo "</div>";
                echo "</div>";
                header( "refresh:3;url=lectorQREntrega.html" );
}






}else{
   // failed to insert row
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "<div class=\"col-md-2 col-md-offset-5\">";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "El valor del plato especial no puede ser 0";
                echo $result;
                echo "</div>";
                echo "</div>";
                header( "refresh:3;url=CrearCuentaCobro.php" );
}





}else{
   // en el caso que el saldo sea 0
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "<div class=\"col-md-2 col-md-offset-5\">";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "La credencial no tiene saldo para el pago";
                echo $result;
                echo "</div>";
                echo "</div>";
                header( "refresh:3;url=lectorQREntrega.html" );
}



    ?>
    <script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>    
    </body>
</html>