<?php 
$valor = $_REQUEST["o"];
?>
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
        <script type="text/javascript" src="js/funtions.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
        <script src="js/script.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    </head>
    <body id="bodyBase">
    </br>
    </br>
      <?php
            require_once '/db_connect1.php';
          // connecting to db
          $db = new DB_CONNECT();
          // mysql inserting a new row
          $result = mysql_query("SELECT *  FROM cuenta_cobro  where idcuenta='".$valor."'");
          while($row = mysql_fetch_assoc($result))
         {
          $idcuenta = $row['idcuenta'];
          $fechageneracion = $row['fecha_generacion'];
          $valorcuenta = $row['valor_cuenta'];
          $area = $row['area'];
          $tercero = $row['tercero'];
          $valortotal = $row['valor_total'];
          echo"<div class=\"col-md-2 col-md-offset-5\">";
          echo"<h1>Consulta Cuenta por Pagar</h1>";
          echo " Cuenta de Cobro N: {$row['idcuenta']}  <br>";
          echo "Fecha de Envio: {$row['fecha_generacion']} <br>";
          echo "Valor Cuenta: {$row['valor_cuenta']} <br>";
          echo "Area: {$row['area']} <br>";
          echo "Tercero: {$row['tercero']} <br>";  
          echo"</div>"; 
        }    
      ?>
    </br>
      <div class="col-md-2 col-md-offset-5">
      <form action="mensajecrearpagocuentacobro.php" method="POST">
        <label>Ingrese la fecha de pago</label>
        <input class="form-control" type="date" id="fpago" name="fpago" required/>
        <input class="form-control" type="hidden" id="idcuenta" name="idcuenta" value="<?php echo $idcuenta; ?>"/>
        <input class="form-control" type="hidden" id="fechageneracion" name="fechageneracion" value="<?php echo $fechageneracion; ?>"/>
        <input class="form-control" type="hidden" id="valorcuenta" name="valorcuenta" value="<?php echo $valorcuenta; ?>"/>
        <input class="form-control" type="hidden" id="area" name="area" value="<?php echo $area; ?>"/>
        <input class="form-control" type="hidden" id="tercero" name="tercero" value="<?php echo $tercero; ?>"/>
        <input class="form-control" type="hidden" id="valortotal" name="valortotal" value="<?php echo $valortotal; ?>"/>
        </br>
        <button type="submit" class="btn btn-primary">REALIZAR PAGO</button>
      </form>  
      </div>
    <script src="js/jquery.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>    
    </body>
</html>