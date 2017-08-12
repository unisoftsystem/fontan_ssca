<?php
  error_reporting(0);
  //validacion de fecha actual o menor
  $fecha_actual=date("Y-m-d");
  $array = array(array());
  $contadorFilas = 0;
  $json = ""; 
	$contador = 0;
  if($_POST['fechai'] <= $fecha_actual){
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
    // fecha inicial
    $fechai = $_POST['fechai'];
    //fecha final
    $fechaf = $_POST['fechaf'];   


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
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
    </head>
    <body id="bodyBase">
    	<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Cafeteria</h4>
        <h1 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Bienvenido</h1>
        
        <div id='cssmenu'>
            <ul>
                          
                   <li ><a href='#' title="Reporte de Cafeteria"><h6><p class="full-circle"></p><span>Reporte de Cafeteria</span></h6></a>
                        <ul style="margin-right:-42%">
                            <li><a href='#' title=\"Reporte de Cafeteria\"><h6><p class=\"full-circle\"></p><span>Reporte de Cafeteria</span></h6></a></li>
                        </ul>
                   </li>
            </ul>
        </div>
      <div class="contenidoBorde">
      </br>
            <div align="left"><h4 style="color:#09C;">&nbsp;&nbsp;Usuario: <?php echo $id; ?></h4></div>      
      
      <div align="right">
      <h3>Reporte Cafeteria</h3>
      </div>
      </br>
      <table class="table table-striped">
  <thead>
    <tr>
      <th bgcolor="#dedede"><center>Cantidad</center></th>
      <th bgcolor="#dedede"><center>Categoria</center></th>
      <th bgcolor="#dedede"><center>Subcategoria</center></th>
      <th bgcolor="#dedede"><center>Detalle</center></th>
      <th bgcolor="#dedede"><center>Subtotal</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
    	
    	//conexion
		$conexion=mysql_connect("localhost", "root", "usc");
		mysql_select_db("ssca", $conexion);
    
    //realizo consulta de productos
    $consulta5="SELECT movimientos.*
    FROM  `movimientos` 
    WHERE movimientos.FechaMovimiento
    BETWEEN  '$fechai' AND  '$fechaf'
    AND movimientos.`DescripcionMovimiento` LIKE '%No. Pedido %' ";
      $consulta5=mysql_query($consulta5, $conexion);
      $acum = 0;
      //cantidad de datos
      $numero = mysql_num_rows($consulta5);
      while($row = mysql_fetch_array($consulta5, MYSQL_ASSOC)){
	      $DescripcionMovimiento = $row["DescripcionMovimiento"];
	      $pedido = explode("No. Pedido ", $DescripcionMovimiento);
        $productos = $pedido[1]; // porción1

        $detalleProducto = explode(":", $productos);              
        $codigoPedido = $detalleProducto[0];
        

        $consulta6="SELECT * FROM `Detalle_OrdenPedido` WHERE `idOrdenPedido`='$codigoPedido'";
        $consulta6=mysql_query($consulta6, $conexion) or die(mysql_error());
        $acum += $row["ValorMovimiento"];
        $suma = 0;
        $contadorDatos = 1;
        //echo $codigoPedido . " " . $suma . " : " . $row["ValorMovimiento"] . "<br>";
        while($rowPedido = mysql_fetch_array($consulta6, MYSQL_ASSOC)){
          //Consultar los datos del producto
          $consulta7="SELECT productos.*, categoria.Nombre AS NombreCategoria, `sub-categoria`.Nombre AS NombreSubCategoria FROM `productos` INNER JOIN categoria ON categoria.codigo = productos.Categoria INNER JOIN `sub-categoria` ON `sub-categoria`.codigo = productos.Subcategoria WHERE productos.`codigoProducto`='" . $rowPedido["codigoProducto"] . "'";
          $suma += $rowPedido["total"];
          $consulta7=mysql_query($consulta7, $conexion);
          $rowProducto = mysql_fetch_array($consulta7, MYSQL_ASSOC);
          
          $contadorDatos += 1;
          $fila = existeProducto($array, $rowProducto["codigoProducto"]);
          if($fila != -1){
            $cantidadActual = $array[$fila][0] + $rowPedido["cantidad"];
            $subtotalActual = $array[$fila][5] + $rowPedido["total"];

            $array[$fila][0] = $cantidadActual;
            $array[$fila][5] = $subtotalActual;

          }else{
            $array[$contadorFilas][0] = $rowPedido["cantidad"];
            $array[$contadorFilas][1] = $rowProducto["NombreProducto"];
            $array[$contadorFilas][2] = $rowProducto["codigoProducto"];
            $array[$contadorFilas][3] = $rowProducto["NombreCategoria"];
            $array[$contadorFilas][4] = $rowProducto["NombreSubCategoria"];
            $array[$contadorFilas][5] = $rowPedido["total"];

            $contadorFilas++;
          }
         
          
        }
        

        
        
      }

      function cmp($a, $b)
      {
          return strcmp(strtolower($a[1]), strtolower($b[1]));
      }

      usort($array, "cmp");
      $total_price = imprimirArray($array);
            
      
  ?>
     
  
  </tbody>
  </table>
  <button type="button" name="btnExportarReporte" id="btnExportarReporte" class="btn btn-primary" style="margin-right: 10px; "><b>EXPORTAR EXCEL</b></button>
  <script type="text/javascript">
    $("#btnExportarReporte").click(function(e) {
        var fechaInicial = "<?php echo $fechai; ?>";
        var fechaFinal = "<?php echo $fechaf; ?>";
        var win = window.open("ExportarReporteCafeteriaDias.php?fechai=" + fechaInicial + "&fechaf=" + fechaFinal, '_blank');
        win.focus();  
          
      });    
  </script>
 
      <div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
				</div>
				<div class="col-md-6">
      <div align="right">                           
      <h4>Valor Total $ <?php echo number_format($total_price, 2, ',', ' '); ?>&nbsp;&nbsp;&nbsp;</h4>
      </div>
      </br>
      </br>
      </br>
      </br>
   
				</div>
			</div>
		</div>

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
header("Location: ReporteCafeteriaDias.php");
} 
function existeProducto($array, $codigo){
  $resultado = -1;
  for($i=0;$i<count($array);$i++) {
    if($array[$i][2] == $codigo){
      $resultado = $i;
    }    
  }
  return $resultado;
}

function imprimirArray($array){
    $total_price = 0;
  for($i=0;$i<count($array);$i++) {
    
    if($array[$i][1] != ""){
      echo "<td><center>" . $array[$i][0] . "</center></td>";
      echo "<td><center>" . $array[$i][3] . "</center></td>";
      echo "<td><center>" . $array[$i][4] . "</center></td>";
      echo "<td><center>" . $array[$i][1] . "</center></td>";
      echo "<td><center>" . $array[$i][5] . "</center></td></tr>";
      $total_price += $array[$i][5];

    }
   
  }
   
  return $total_price;
}
?> 