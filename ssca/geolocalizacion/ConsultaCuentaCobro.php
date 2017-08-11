<?php
    //documento debe venir de session
      $documento ="1012324820";
    //------------------------------- 
    $values = str_replace("/","-",$_POST['fecha']);
    $time = $_POST['time'];
    require_once '/db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
    $result = mysql_query("SELECT * FROM movimientos  INNER JOIN ordenpedido  ON movimientos.idCredencial=ordenpedido.idCredencial WHERE FechaMovimiento='".$values."'");    
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
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
        <script src="js/script.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    </head>
    <body id="bodyBase">
    </br>
    </br>
      <h3 align="center">Cuenta de Cobro&nbsp;</h3>
      </br>
      </br>
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
    </tr>
  </thead>
  <tbody>
    <?php
    while($row = mysql_fetch_assoc($result))
   {
        $idordenpedido = $row["idordenpedido"];
        $DescripcionPedido = $row["DescripcionPedido"];
        $ValorMovimiento = $row["ValorMovimiento"];
        echo "<tr><td><center>".$row["idordenpedido"]."</center></td>";
        echo "<td><center>".$row["idCredencial"]."</center></td>";
        echo "<td><center>".$row["DescripcionPedido"]."</center></td>";
        echo "<td><center>".$row["ValorMovimiento"]."</center></td>";
        echo "<td><center>".$row["FechaMovimiento"]."</center></td>";
        echo "<td><center>".$row["HoraMovimiento"]."</center></td></tr>";
        //echo "<td bgcolor=\"#EFE5FC\"><a href=\"javascript:abrir('detalleruta.php?o=".$row["idordenpedido"]."')\" title='Consultar'><center><img src='img/busqueda.png' width='22' height='22' alt='detalle'></center></a></td></tr>";       
  }
  date_default_timezone_set('America/Bogota');
  $startDate = date('Y/m/d h:i:s a', time());
  ?>
   <?php 
     $result1 = mysql_query("SELECT SUM(ValorMovimiento) AS TOTAL FROM movimientos  INNER JOIN ordenpedido  ON movimientos.idCredencial=ordenpedido.idCredencial WHERE FechaMovimiento='".$values."' ");    
     $qty= 0;
     while ($row = mysql_fetch_assoc($result1)) 
    {
      $total = $row['TOTAL'];
    }
  ?>  
  <?php 
     $result2 = mysql_query("SELECT MAX(idcuenta) AS idcuenta, fecha_corte FROM cuenta_cobro");    
     if ($row = mysql_fetch_row($result2)) {
      $id = trim($row[0]);
      }
  ?> 
  <?php 
     $result3 = mysql_query("SELECT  fecha_corte FROM cuenta_cobro where idcuenta='".$id."'");    
     if ($row = mysql_fetch_assoc($result3)) {
      $fechacorte = $row['fecha_corte'];
      }
  ?>
  <?php 
     $result4 = mysql_query("SELECT  nombre, area, descuento1, descuento2, descuento3, descuento4 FROM tercero where documento='".$documento."'");    
     if ($row = mysql_fetch_assoc($result4)) {
      $nombre = $row['nombre'];
      $area = $row['area'];
      $descuento1 = $row['descuento1'];
      $descuento2 = $row['descuento2'];
      $descuento3 = $row['descuento3'];
      $descuento4 = $row['descuento4'];
      }
  ?>
  </tbody>
  </table>
  <div class="col-md-1 col-md-offset-11">
  <?php
    echo "<tr bgcolor=\"#dedede\"><h4>Total $</h4>".$total."</tr>";   
  ?>
  </div>  
   <form action="mensajecrearcuentacobro.php" method="POST">
      <input class="form-control" type="hidden" id="descripcion" name="descripcion" value="<?php echo $DescripcionPedido; ?>"/>
      <input class="form-control" type="hidden" id="area" name="area" value="<?php echo $area; ?>"/>
      <input class="form-control" type="hidden" id="tercero" name="tercero" value="<?php echo $nombre; ?>"/>
      <input class="form-control" type="hidden" id="fecha_generacion" name="fecha_generacion" value="<?php echo $startDate; ?>"/>
      <input class="form-control" type="hidden" id="fecha_corte" name="fecha_corte" value="<?php echo $fechacorte; ?>"/>
      <input class="form-control" type="hidden" id="valor_cuenta" name="valor_cuenta" value="<?php echo $total; ?>"/>
      <input class="form-control" type="hidden" id="desc1" name="desc1" value="<?php echo $descuento1; ?>"/>
      <input class="form-control" type="hidden" id="desc2" name="desc2" value="<?php echo $descuento2; ?>"/>
      <input class="form-control" type="hidden" id="desc3" name="desc3" value="<?php echo $descuento3; ?>"/>
      <input class="form-control" type="hidden" id="desc4" name="desc4" value="<?php echo $descuento4; ?>"/>
      </br>
      </br>
      <button type="submit" class="btn btn-primary pull-right">CREAR CUENTA DE COBRO</button>
   </form>
    <script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>    
    </body>
</html>