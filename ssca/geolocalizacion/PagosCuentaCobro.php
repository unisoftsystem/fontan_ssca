<?php
    //documento debe venir de session
      
    //-------------------------------  
    require_once '/db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
    $result = mysql_query("SELECT * FROM cuenta_cobro  WHERE numero_recibo='0'");   

    $self = $_SERVER['PHP_SELF']; //Obtenemos la página en la que nos encontramos
    header("refresh:100; url=$self"); //Refrescamos cada 100 segundos 
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
      <h3 align="center">Cuentas por Pagar&nbsp;</h3>
      </br>
      </br>
      </br>
      </br>
      </br>
      <table class="table table-striped">
  <thead>
    <tr>
      <th bgcolor="#dedede"><center>Fecha de Envio</center></th> 
      <th bgcolor="#dedede"><center>Cuenta de Cobro N.</center></th>
      <th bgcolor="#dedede"><center>Valor</center></th>
      <th bgcolor="#dedede"><center>Area</center></th>
      <th bgcolor="#dedede"><center>Tercero</center></th>
      <th bgcolor="#dedede"><center>Pagado</center></th>
      <th bgcolor="#dedede"><center>Consultar</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
    while($row = mysql_fetch_assoc($result))
   {
        echo "<tr><td><center>".$row["fecha_generacion"]."</center></td>";
        echo "<td><center>".$row["idcuenta"]."</center></td>";
        echo "<td><center>".$row["valor_cuenta"]."</center></td>";
        echo "<td><center>".$row["area"]."</center></td>";
        echo "<td><center>".$row["tercero"]."</center></td>";
        $numero_recibo = $row["numero_recibo"];

          $checked = "";
          $status = ($numero_recibo);
        if ($status == 1 )  
        {
          $status = 1;
          $checked = 'checked="checked"';
        }
        else
        {
          $status = 0;
        }
        $status; 

        echo "<td><center><input type=\"checkbox\" name=\"status\" $checked /></center></td>";
        echo "<td bgcolor=\"#EFE5FC\"><a href=\"javascript:abrir('detallepagoscuentacobro.php?o=".$row["idcuenta"]."')\" title='Consultar'><center><img src='img/busqueda.png' width='22' height='22' alt='detalle'></center></a></td></tr>";       
  }
  ?>
  </tbody>
  </table>
    <script src="js/jquery.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>    
    </body>
</html>