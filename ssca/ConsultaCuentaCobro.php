<?php
  error_reporting(0);
  //validacion de fecha actual o menor
  $fecha_actual=date("Y-m-d");
  if($_POST['fecha'] <= $fecha_actual){
?> 
<?php
    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();  
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

     
    //fecha ------------------------------- 
    $values = str_replace("/","-",$_POST['fecha']);
    $nuevafechacorte = $_POST['fecha'];
    // tiempo
    $times = $_POST['time'];
    //numero de id
    $numid = $_POST['numid'];  
    //fecha y hora del ultimo id cuenta_cobro
    $fechacorte = $_POST['fechar'];
    $horacorte = $_POST['horar'];
    // mysql select
    $result = mysql_query("SELECT * FROM movimientos  INNER JOIN ordenpedido  ON movimientos.idCredencial=ordenpedido.idCredencial  WHERE movimientos.ValorMovimiento > 0 AND ordenpedido.UbicacionPedido ='ENTREGADO' AND movimientos.DescripcionMovimiento  LIKE 'No. Pedido%' AND InStr(movimientos.DescripcionMovimiento ,ordenpedido.DescripcionPedido)> 0 AND movimientos.FechaMovimiento between '$fechacorte' AND '$values' AND  movimientos.HoraMovimiento between '$horacorte' AND '$times' ORDER BY movimientos.FechaMovimiento ASC,movimientos.HoraMovimiento ASC  ");         
?>
<?php
  $result2 = mysql_query("SELECT MAX(idcuenta) AS idcuenta, fecha_corte FROM cuenta_cobro");    
     if ($row = mysql_fetch_row($result2)) {
      $idk = trim($row[0]+1);
      }
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
        <link type="text/css" href="css/bootstrap.min.css" />
        <link type="text/css" href="css/bootstrap-timepicker.min.css" />
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
    </head>
    <body id="bodyBase">
    	<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Liquidacion y Pagos</h4>
        <h1 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Bienvenido</h1>
        
        <div id='cssmenu'>
            <ul>
                   <li><a href='#' title="Crear Liquidacion"><h6><p class="full-circle"></p><span>Crear Liquidacion</span></h6></a>
                      <ul style="margin-right:-42%">
                          <li><a href='CrearCuentaCobro.php' title=\"Crear Liquidacion\"><h6><p class=\"full-circle\"></p><span>Crear Liquidacion</span></h6></a></li> 
                      </ul>
                   </li>        
                   <li ><a href='#' title="Reporte de Liquidaciones"><h6><p class="full-circle"></p><span>Reporte de Liquidaciones</span></h6></a>
                        <ul style="margin-right:-42%">
                            <li><a href='#' title=\"Reporte de Liquidaciones\"><h6><p class=\"full-circle\"></p><span>Reporte de Liquidaciones</span></h6></a></li>
                        </ul>
                   </li>
            </ul>
        </div>
      <div class="contenidoBorde">
      </br>
            <div align="left"><h4 style="color:#09C;">&nbsp;&nbsp;Usuario: <?php echo $id; ?></h4></div>      
      
      <div align="right">
      <h3>Cuenta de Cobro No. <?php echo $idk; ?>&nbsp;&nbsp;&nbsp;</h3>
      </div>
      </br>
      <table class="table table-striped">
  <thead>
    <tr>
      <th bgcolor="#dedede"><center>Fecha</center></th>
      <th bgcolor="#dedede"><center>OP</center></th>
      <th bgcolor="#dedede"><center>Detalle</center></th>
      <th bgcolor="#dedede"><center>Vr. Total</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
    
    while($row = mysql_fetch_array($result))
   {
        //creo un array de productos
        $array[] = $row["DescripcionPedido"];
        $var = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($array), ENT_NOQUOTES));
        // array de op
         $array2[] = $row["DescripcionMovimiento"];
         $var2 = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($array2), ENT_NOQUOTES));
        //paso variables 
        $ValorMovimiento = $row["ValorMovimiento"];
        echo "<tr><td><center>".$row["FechaMovimiento"]."</center></td>";
        echo "<td><center> ".$row["DescripcionMovimiento"]."</center></td>";
        echo "<td><center>".$row["DescripcionPedido"]."</center></td>";
        echo "<td><center>".$row["ValorMovimiento"]."</center></td></tr>";

  }
  date_default_timezone_set('America/Bogota');
  $startDate = date('Y/m/d h:i:s a', time());
  $time = time();
  $startTime = date("H:i:s", $time)
  ?>
   <?php 
     $result1 = mysql_query("SELECT SUM(ValorMovimiento) AS TOTAL FROM movimientos  INNER JOIN ordenpedido  ON movimientos.idCredencial=ordenpedido.idCredencial  WHERE movimientos.ValorMovimiento > 0 AND ordenpedido.UbicacionPedido ='ENTREGADO' AND movimientos.DescripcionMovimiento  LIKE 'No. Pedido%'  AND InStr(movimientos.DescripcionMovimiento ,ordenpedido.DescripcionPedido)> 0 AND movimientos.FechaMovimiento between '$fechacorte' AND '$values' AND  movimientos.HoraMovimiento between '$horacorte' AND '$times' ORDER BY movimientos.FechaMovimiento ASC, movimientos.HoraMovimiento ASC ");    
     $qty= 0;
     while ($row = mysql_fetch_assoc($result1)) 
    {
      $total = $row['TOTAL'];
    }
  ?>  
  <?php 
     $result4 = mysql_query("SELECT  nombre, area, descuento1, descuento2, descuento3, descuento4 FROM tercero where documento='".$numid."'");    
     if ($row = mysql_fetch_assoc($result4)) {
      $nombre = $row['nombre'];
      $area = $row['area'];
      $descuento1 = $row['descuento1'];
      $descuento2 = $row['descuento2'];
      $descuento3 = $row['descuento3'];
      $descuento4 = $row['descuento4'];
      }

    //paso la respuesta json a session para recuperarla en mensajecrearcuentacobro.php 
    $_SESSION['productos']= json_encode($var);
    $_SESSION['operaciones']= json_encode($var2);
   
  ?>
  </tbody>
  </table>



    <form action="mensajecrearcuentacobro.php" method="POST">

      <div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
                                 <textarea class="form-control" name="Text1" id="Text1" cols="40" rows="7" placeholder="Observaciones De Creacion Cuenta De Cobro" ></textarea>
				</div>
				<div class="col-md-6">
      <div align="right">                           
      <h4>Valor Total $ <?php echo number_format($total, 2, ',', ' '); ?>&nbsp;&nbsp;&nbsp;</h4>
      </div>
      </br>
      <button type="submit" class="btn btn-primary pull-right">CREAR CUENTA DE COBRO</button>
      </br>
      </br>
      </br>
      <button type="button" onClick="location.href='<?=$_SERVER["HTTP_REFERER"]?>'"  class="btn btn-danger pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CANCELAR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
      </br>
      </br>
   
				</div>
			</div>
		</div>


      
      <input class="form-control" type="hidden" id="area" name="area" value="<?php echo $area; ?>"/>
      <input class="form-control" type="hidden" id="tercero" name="tercero" value="<?php echo $nombre; ?>"/>
      <input class="form-control" type="hidden" id="fecha_generacion" name="fecha_generacion" value="<?php echo $startDate; ?>"/>
      <input class="form-control" type="hidden" id="hora_corte" name="hora_corte" value="<?php echo $startTime; ?>"/>
      <input class="form-control" type="hidden" id="fecha_corte" name="fecha_corte" value="<?php echo $nuevafechacorte; ?>"/>
      <input class="form-control" type="hidden" id="valor_cuenta" name="valor_cuenta" value="<?php echo $total; ?>"/>
      <input class="form-control" type="hidden" id="desc1" name="desc1" value="<?php echo $descuento1; ?>"/>
      <input class="form-control" type="hidden" id="desc2" name="desc2" value="<?php echo $descuento2; ?>"/>
      <input class="form-control" type="hidden" id="desc3" name="desc3" value="<?php echo $descuento3; ?>"/>
      <input class="form-control" type="hidden" id="desc4" name="desc4" value="<?php echo $descuento4; ?>"/>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
    </form>
    </br>
      </br>
      </br>
      </br>
     


      </div> 
      <script src="js/jquery.js"></script>
      <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>     
    </body>
</html>
<?php
 }else{
header("Location: CrearCuentaCobro.php");
} 
?> 