<?php 
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
    <title>SSCA</title>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
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
  <body>

    <center><h3> Reporte Tendencias Semana</h3></center>
    <div align="right">
      <button type="button" class="btn btn-primary" onclick="window.location.href='/ssca/TendenciasDia.php'">Reporte Tendencias Dia</button>
      <button type="button" class="btn btn-warning" onclick="window.location.href='/ssca/TendenciasMes.php'">Reporte Tendencias Mes</button>
      </div>
      </br>
      </br>
      </br>
      </br>
    <!-- css bar graph -->
    <div class="css_bar_graph">
      
      <!-- y_axis labels -->
      <ul class="y_axis">

        <!-- y_axis labels 
        <li>10.000kg</li><li>9.000kg</li><li>8.000kg</li><li>7.000kg</li><li>6.000kg</li><li>5.000kg</li><li>4.000kg</li><li>3.000kg</li><li>2.000kg</li><li>1.000kg</li><li>0kg</li>
         -->
      </ul>
      <?php   
      //conexion
      $conexion=mysql_connect("localhost", "root", "usc");
      mysql_select_db("ssca", $conexion);
      //
      $consultaqrt="create temporary table temps3(valor int(11) not null,descripcion varchar(500))";
      $consultf=mysql_query($consultaqrt, $conexion) or die(mysql_error());  
      //realizo la consulta
      $consulta="SELECT * FROM  `movimientos` INNER JOIN ordenpedido ON movimientos.idCredencial = ordenpedido.idCredencial WHERE YEARWEEK( FechaMovimiento ) = YEARWEEK( CURRENT_date ) AND InStr(movimientos.DescripcionMovimiento ,ordenpedido.DescripcionPedido)> 0 GROUP BY  `DescripcionPedido` ORDER BY  `DescripcionPedido` DESC LIMIT 0 , 10";
      $consulta=mysql_query($consulta, $conexion);
      ?>
      <!-- x_axis labels -->
      <ul class="x_axis">
      <?php
      $i=0;
      while($row = mysql_fetch_array($consulta))
      {
      $var = $row["DescripcionPedido"];
       //divido la variable
      $dividir = explode(",", $var);
      //realizo el paso de veces que requiero que se cuente por producto
      for ($i = 0; $i < 10; $i++) {
      $resultado = intval(preg_replace('/[^0-9]+/', '', $dividir[$i]), 5);
      $resultado2 = ereg_replace("[^A-Za-z -]", "", $dividir[$i]);
      //inserto en tabla
      mysql_query("INSERT INTO temps3(valor, descripcion) VALUES ('".$resultado."','".$resultado2."')") or die(mysql_error());
      }

      
      }
      //realizo consulta de datos modificados y enviados a temp
      $consulta5="SELECT SUM(Valor) AS TOTAL, descripcion FROM temps3 where descripcion = descripcion and valor != 0  GROUP BY `descripcion` ORDER BY `TOTAL` DESC limit 0,10";
      $consulta5=mysql_query($consulta5, $conexion);
      //cantidad de datos
      $numero = mysql_num_rows($consulta5);
      while($row = mysql_fetch_array($consulta5)){
      $valor = $row["TOTAL"];
      $descripcion = $row["descripcion"];
      //muestro los datos en pantalla
       echo "<li>".$valor."</li>";
       echo "<li>".$descripcion."</li>";
      }
      ?>
      </ul>
      <!-- graph -->
      <div class="graph">
        <!-- grid -->
        <ul class="grid">
          <li><!-- 10 --></li>
          <li><!-- 9 --></li>
          <li><!-- 8 --></li>
          <li><!-- 7 --></li>
          <li><!-- 6 --></li>
          <li><!-- 5 --></li>
          <li><!-- 4 --></li>
          <li><!-- 3 --></li>
          <li><!-- 2 --></li>
          <li><!-- 1 --></li>
          <li class="bottom"><!-- 0 --></li>
        </ul>
        <!-- bars -->
        <!-- 250px = 100% -->
          <?php
	$n = 10;
        for ($i = 0; $i < $numero; $i++) {
	$n = $n - 1;
        echo "<ul>";
        echo "<li class=\"bar nr_".$i." blue\" style=\"height: 1".$n."0px;\"><div class=\"top\"></div><div class=\"bottom\"></div></li>";
        echo "</ul>"; 
        }
        ?>
      </div>
    </div>
  </body>
</html>