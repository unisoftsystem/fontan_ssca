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

    $consultaqrt="create temporary table temp(cantidad int(11) not null,descripcion varchar(1000))";
    $consultf=mysql_query($consultaqrt, $conexion) or die(mysql_error());
      
		//realizo consulta de productos
      $consulta5="SELECT movimientos.*
FROM  `movimientos` 
WHERE movimientos.FechaMovimiento
BETWEEN  '$fechai' AND  '$fechaf'
AND movimientos.`DescripcionMovimiento` LIKE '%No. Pedido %' ";
      $consulta5=mysql_query($consulta5, $conexion);

      //cantidad de datos
      $numero = mysql_num_rows($consulta5);
      while($row = mysql_fetch_array($consulta5, MYSQL_ASSOC)){
	      $DescripcionMovimiento = $row["DescripcionMovimiento"];
	      $pedido = explode(":", $DescripcionMovimiento);
        $productos = $pedido[1]; // porción1

        $detalleProducto = explode(",", $productos);
              

            foreach ($detalleProducto as &$valor) {
              $productoPedido = explode(" ", $valor);
              $cantidad = "";
              $descrip = "";
              if($productoPedido[0] == ""){
                  $cantidad = $productoPedido[1];

                  for($i = 2; $i < count($productoPedido); $i++){
                    if($i == (count($productoPedido) - 1)){
                      $descrip .= $productoPedido[$i];
                    }else{
                      $descrip .= $productoPedido[$i] . " ";
                    }
                  }
              }else{
                $cantidad = $productoPedido[0];
                for($i = 1; $i < count($productoPedido); $i++){
                    if($i == (count($productoPedido) - 1)){
                      $descrip .= $productoPedido[$i];
                    }else{
                      $descrip .= $productoPedido[$i] . " ";
                    }
                  }
              }
              
              $consulta6="SELECT * FROM  `temp` WHERE descripcion='". $descrip . "'";
              $consulta6=mysql_query($consulta6, $conexion);
              $numeroFilas = mysql_num_rows($consulta6);

              if($numeroFilas > 0){
                $rowCantidad = mysql_fetch_array($consulta6, MYSQL_ASSOC);
                $cantidadActual = $rowCantidad["cantidad"];
                $cantidadActual += $cantidad;
                mysql_query("UPDATE temp SET cantidad='". $cantidadActual . "' WHERE descripcion='". $descrip . "'") or die(mysql_error());
              }else{
                  mysql_query("INSERT INTO temp (cantidad,descripcion) VALUES ('".$cantidad."','".$descrip."')") or die(mysql_error());
              }
              
            }
            
        /*for($i = 0; $i < count($detalleProducto); $i++){
            $prod = $detalleProducto[$i];
            $productoPedido = explode(" ", $prod);
            $cantidad = $productoPedido[0];
            $descrip = "";

            

           
        }
     

	    
	      //muestro los datos en pantalla
	      /*echo "<tr><td><center>".$cantidaddia."</center></td>";
	      echo "<td><center>".$categoria."</center></td>";
	      echo "<td><center>".$subcategoria."</center></td>";
	      echo "<td><center>".$descripcion."</center></td>";
	      echo "<td><center>".$subtotal."</center></td></tr>";
	      //$ValorMovimiento = $row["ValorMovimiento"];

	      $total_price += $subtotal;*/

      }

      $consulta7="SELECT * FROM  `temp` ORDER BY descripcion ASC";
      $consulta7=mysql_query($consulta7, $conexion);
      while($row = mysql_fetch_array($consulta7, MYSQL_ASSOC)){
        $cantidad = $row["cantidad"];
        $descripcion = $row["descripcion"];

        $consulta8="SELECT productos.*, categoria.Nombre AS NombreCategoria, `sub-categoria`.Nombre AS NombreSubCategoria FROM `productos` INNER JOIN categoria ON categoria.codigo = productos.Categoria INNER JOIN `sub-categoria` ON `sub-categoria`.codigo = productos.Subcategoria WHERE productos.`NombreProducto`='" . $descripcion . "'";
        $consulta8=mysql_query($consulta8, $conexion);
        $rowProducto = mysql_fetch_array($consulta8, MYSQL_ASSOC);

                 echo "<td><center>" . $cantidad . "</center></td>";
        echo "<td><center>" . $rowProducto["NombreCategoria"] . "</center></td>";
        echo "<td><center>" . $rowProducto["NombreSubCategoria"] . "</center></td>";
        echo "<td><center>" . $descripcion . "</center></td>";
        echo "<td><center>".($cantidad * $rowProducto["ValorUnitario"])."</center></td></tr>";
        $total_price += $cantidad * $rowProducto["ValorUnitario"];
        
        

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