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

     
    // mysql select
    $result = mysql_query("SELECT  * FROM `movimientos` INNER JOIN ordenpedido ON movimientos.idCredencial = ordenpedido.idCredencial WHERE SUBSTRING(FechaMovimiento FROM 1 FOR 7) =  SUBSTRING(CURRENT_date - INTERVAL 1 MONTH FROM 1 FOR 7) GROUP BY  `DescripcionPedido` ORDER BY  `DescripcionPedido` DESC LIMIT 0 , 10");         
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
      <h3>Tendencia de Consumo Mes&nbsp;&nbsp;&nbsp;</h3>
      </div>
      </br>
      <div align="right">
      <button type="button" class="btn btn-primary" onclick="window.location.href='/ssca/ReporteTendenciasDia.php'">Reporte Tendencias Dia</button>
      <button type="button" class="btn btn-success" onclick="window.location.href='/ssca/ReporteTendenciasSemana.php'">Reporte Tendencias Semana</button>
      </div>
      <table class="table table-striped">
  <thead>
    <tr>
      <th bgcolor="#dedede"><center>Producto</center></th>
      <th bgcolor="#dedede"><center>Fecha</center></th> 
    </tr>
  </thead>
  <tbody>
    <?php
    while($row = mysql_fetch_assoc($result))
   {
        //creo un array de productos
        $des = $row["DescripcionPedido"];
        //paso variables 
        $ValorMovimiento = $row["ValorMovimiento"];
        echo "<tr><td><center>".$row["DescripcionPedido"]."</center></td>";
         echo "<td><center>".$row["FechaMovimiento"]."</center></td></tr>";
        
  }
  ?>
    
      </br>
      </br>
      </br>
      </br>
     


      </div> 
      <script src="js/jquery.js"></script>
      <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>     
    </body>
</html>