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
    // mysql inserting a new row
    $result = mysql_query("SELECT * FROM cuenta_cobro  ");   
    //recarga de pagina
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
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
        <script src="js/script.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <link type="text/css" href="css/bootstrap.min.css" />

        
        <script type="text/javascript" src="js/funtions.js"></script>
        
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
      
      <h3 align="center">Liquidacion y Pagos&nbsp;</h3>
      </br>
      </br>
      <table class="table table-striped" >
  <thead>
    <tr>
      <th bgcolor="#dedede"><center>Fecha</center></th> 
      <th bgcolor="#dedede"><center>Cuenta de Cobro N.</center></th>
      <th bgcolor="#dedede"><center>Observaciones</center></th>
      <th bgcolor="#dedede"><center>Valor</center></th>
      <th bgcolor="#dedede"><center>Cancelado</center></th>
      <th bgcolor="#dedede"><center>Fecha Cancelacion</center></th>
      <th bgcolor="#dedede"><center>Pdf</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
    while($row = mysql_fetch_assoc($result))
   {
        echo "<tr><td><center>".$row["fecha_generacion"]."</center></td>";
        echo "<td><center>".$row["idcuenta"]."</center></td>";
        echo "<td><center>".$row["observaciones"]."</center></td>";
        echo "<td><center>".$row["valor_cuenta"]."</center></td>";
        $numero_recibo = $row["numero_recibo"];
        $fecha_cancelado = $row["fecha_cancelacion"];

        $checked = "";
        $status = ($numero_recibo);
        //valida el estado
        if ($status >= 1 )  
        {
          $status = 1;
          $checked = 'checked="checked"';
        }
        else
        {
          $status = 0;
        }
        $status; 
        //valida fechas de cancelacion
        if ($fecha_cancelado == "0000-00-00"){
            $fecha_cancelado = "PENDIENTE";
        }else{
           $fecha_cancelado;
        }
        $fecha_cancelado;
        
        echo "<td><center><input type=\"checkbox\" name=\"status\" $checked  readonly/></center></td>";
        echo "<td><center>".$fecha_cancelado."</center></td>";
        // valida el estado
        if ($status >= 1){
        echo "<td bgcolor=\"#EFE5FC\"><a href=\"javascript:abrir('detallepdf.php?o=".$row["numero_recibo"]."')\" title='Pdf'><center><img src='img/busqueda.png' width='22' height='22' alt='detalle'></center></a></td></tr>";       
        }
  }
  ?>
  </tbody>
  </table>


      </div> 
      <script src="js/jquery.js"></script>
      <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>     
    </body>
</html>