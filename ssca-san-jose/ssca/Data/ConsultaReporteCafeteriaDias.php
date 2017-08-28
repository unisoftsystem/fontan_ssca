<?php
  error_reporting(0);
  //validacion de fecha actual o menor
  $fecha_actual=date("Y-m-d");
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
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
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
		//realizo la consulta
      
		//realizo consulta de productos
      $consulta5="SELECT productos.*, categoria.Nombre AS NombreCategoria, `sub-categoria`.Nombre AS NombreSubCategoria, SUM(Detalle_OrdenPedido.`cantidad`) AS CantidadTotal, SUM(Detalle_OrdenPedido.`total`) AS Total
FROM  `Detalle_OrdenPedido` 
INNER JOIN productos ON productos.`codigoProducto` = Detalle_OrdenPedido.`codigoProducto` 
INNER JOIN movimientos ON movimientos.FechaMovimiento
BETWEEN  '$fechai' AND  '$fechaf'
AND movimientos.`DescripcionMovimiento` LIKE CONCAT(  '%No. Pedido ', Detalle_OrdenPedido.idOrdenPedido,  ':%' ) 
INNER JOIN categoria ON categoria.codigo = productos.Categoria INNER JOIN `sub-categoria` ON `sub-categoria`.codigo = productos.Subcategoria
GROUP BY Detalle_OrdenPedido.`codigoProducto` 
ORDER BY productos.NombreProducto ASC";
      $consulta5=mysql_query($consulta5, $conexion);

      //cantidad de datos
      $numero = mysql_num_rows($consulta5);
      while($row = mysql_fetch_array($consulta5, MYSQL_ASSOC)){
	      $descripcion = $row["NombreProducto"];
	      $codigoProducto = $row["codigoProducto"];
	      $categoria = $row["NombreCategoria"];
	      $subcategoria = $row["NombreSubCategoria"];	
        $cantidaddia = $row["CantidadTotal"];
        $subtotal = $row["Total"];

     

	    $consulta="SELECT SUM(Detalle_OrdenPedido.`cantidad`) AS CantidadTotal, SUM(Detalle_OrdenPedido.`total`) AS Total FROM  `Detalle_OrdenPedido` INNER JOIN movimientos ON movimientos.FechaMovimiento BETWEEN  '$fechai' AND  '$fechaf' AND movimientos.`DescripcionMovimiento` LIKE CONCAT(  '%No. Pedido ', Detalle_OrdenPedido.idOrdenPedido,  '%' ) WHERE  `codigoProducto` =  '$codigoProducto'";

			$consulta=mysql_query($consulta, $conexion);
			$registroTotal = mysql_fetch_array($consulta, MYSQL_ASSOC);
 			$cantidadtotal = $categoriadia;
	      //muestro los datos en pantalla
	      echo "<tr><td><center>".$cantidaddia."</center></td>";
	      echo "<td><center>".$categoria."</center></td>";
	      echo "<td><center>".$subcategoria."</center></td>";
	      echo "<td><center>".$descripcion."</center></td>";
	      echo "<td><center>".$subtotal."</center></td></tr>";
	      //$ValorMovimiento = $row["ValorMovimiento"];

	      $total_price += $subtotal;

      }
  ?>
     
  
  </tbody>
  </table>
  <?php
  	/*$str = '{ 

"players":[
   {

        "name":"Moldova",
        "image":"/Images/Moldova.jpg",
        "roll_over_image":"tank.jpg"
   },
   {

        "name":"Georgia",
        "image":"/Images/georgia.gif",
        "roll_over_image":"tank.jpg"
   } ]}';


 $arr = json_decode($str, true);
 $arrne['name'] = "dsds";
 array_push( $arr['players'], $arrne );
 print_r(json_encode($arr));*/
  ?>
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

?> 