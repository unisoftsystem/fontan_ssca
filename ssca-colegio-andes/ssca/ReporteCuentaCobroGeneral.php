<?php 
    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();

     $result2 = mysql_query("SELECT MAX(idcuenta) AS idcuenta, fecha_corte FROM cuenta_cobro");    
     if ($row = mysql_fetch_row($result2)) {
      $id = trim($row[0]);
      }
  ?> 
 
  
<?php
    
    /* Empezamos la sesión */
    session_start();
    /* Creamos la sesión */
    $id =  $_SESSION['userid'];

   
    /* Si no hay una sesión creada, redireccionar al index. */
    if(empty($_SESSION['userid'])) { // Recuerda usar corchetes.
        header('Location: indexusuariointerno.html');
    } // Recuerda usar corchetes

     
        
    
    // mysql select
    $result = mysql_query("SELECT * FROM movimientos  INNER JOIN ordenpedido  ON movimientos.idCredencial=ordenpedido.idCredencial ");    
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SSCA</title>
        
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
    <label>Usuario : <?php echo $id;?></label>
    </br>
    </br>
      <h3 align="center">Cuenta de Cobro&nbsp;</h3>
      </br>
      </br>
      </br>
      <table class="table table-striped">
  <thead>
    <tr>
      <th bgcolor="#dedede"><center>Identificacion</center></th> 
      <th bgcolor="#dedede"><center>Credencial</center></th>
      <th bgcolor="#dedede"><center>Descripcion Pedido</center></th>
      <th bgcolor="#dedede"><center>Valor Movimiento</center></th>
      <th bgcolor="#dedede"><center>Fecha Movimiento</center></th>
      <th bgcolor="#dedede"><center>Hora Movimiento</center></th>
      <th bgcolor="#dedede"><center>Estado Producto</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
    while($row = mysql_fetch_assoc($result))
   {
       
        if ($status == "0" )  
        {
          $status = 1;
          $checked = "Pagado";
        }
        else
        {
          $status = 0;
          $checked = "Sin Pago";
        }
        $DescripcionPedido = $row["DescripcionPedido"];
        $ValorMovimiento = $row["ValorMovimiento"];
        echo "<td><center>".$row["idUsuario"]."</center></td>";
        echo "<td><center>".$row["idCredencial"]."</center></td>";
        echo "<td><center>".$row["DescripcionPedido"]."</center></td>";
        echo "<td><center>".$row["ValorMovimiento"]."</center></td>";
        echo "<td><center>".$row["FechaMovimiento"]."</center></td>";
        echo "<td><center>".$row["HoraMovimiento"]."</center></td>";
        echo "<td><center>".$checked."</center></td></tr>";
        //echo "<td bgcolor=\"#EFE5FC\"><a href=\"javascript:abrir('detalleruta.php?o=".$row["idordenpedido"]."')\" title='Consultar'><center><img src='img/busqueda.png' width='22' height='22' alt='detalle'></center></a></td></tr>";       
  }
  date_default_timezone_set('America/Bogota');
  $startDate = date('Y/m/d h:i:s a', time());
  $time = time();
  $startTime = date("H:i:s", $time)
  ?>
   <?php 
     $result1 = mysql_query("SELECT SUM(ValorMovimiento) AS TOTAL FROM movimientos  INNER JOIN ordenpedido  ON movimientos.idCredencial=ordenpedido.idCredencial ");    
     $qty= 0;
     while ($row = mysql_fetch_assoc($result1)) 
    {
      $total = $row['TOTAL'];
    }
  ?>  
  

 
  </tbody>
  </table>
  <div class="col-md-1 col-md-offset-11">
  <?php
    echo "<tr bgcolor=\"#dedede\"><h4>Total $</h4>".$total."</tr>";   
  ?>
  </div>  
   
    <script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>    
    </body>
</html>