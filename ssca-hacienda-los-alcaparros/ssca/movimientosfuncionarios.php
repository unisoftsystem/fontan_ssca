<?php
    error_reporting(0);
    header('Content-Type: text/html; charset=UTF-8');
    //validacion de fecha actual o menor
    $fecha_actual=date("Y-m-d");
  if($_POST['fechai'] <= $fecha_actual){
    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();  
    /* Empezamos la sesión */
    session_start();
    /* Creamos la sesión */
    $id =  $_SESSION['userid'];
    /* Si no hay una sesión creada, redireccionar al index. */
    if(empty($_SESSION['userid'])) { 
        header('Location: indexfuncionariointerno.html');
    }
    $fechai = $_POST['fechai'];
    //fecha final
    $fechaf = $_POST['fechaf']; 
    //consulta de movimientos por orden
     $result = mysql_query("SELECT movimientos.DescripcionMovimiento as movimiento, movimientos.FechaMovimiento as fecha, movimientos.HoraMovimiento as hora, movimientos.ValorMovimiento as valor FROM movimientos   INNER JOIN credenciales ON movimientos.idCredencial=credenciales.idCredencial  WHERE credenciales.idUsuarioSecundario = '$id' AND movimientos.FechaMovimiento
    BETWEEN  '$fechai' AND  '$fechaf' AND movimientos.DescripcionMovimiento!='costo de asignación de tarjeta nueva' AND movimientos.DescripcionMovimiento!='costo de asignacion de tarjeta nueva' AND NOT movimientos.DescripcionMovimiento LIKE '%No de pedido%' AND movimientos.DescripcionMovimiento!='cambio de credencial' ORDER BY movimientos.FechaMovimiento ASC"); 

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
    	<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Consulta Movimientos</h4>
        <h1 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Bienvenido</h1>
        <div id='cssmenu'>
            <ul>
                <li><a href='ReporteMovimientosFuncionarios.php' title="Consulta de Movimientos"><span>Consulta de Movimientos</span></a></li>
                <li><a href='Saldosfuncionarios.php' title="Consulta de Saldo"><span>Consulta de Saldo</span></a></li>
               <li class="" id="Salir"><a href='salida.php' title="Cerrar Sesi&oacute;n"><span>Cerrar Sesi&oacute;n</span></a></li>
            </ul>
        </div>
      <div class="contenidoBorde">
      </br>
            <div align="left"><h4 style="color:#09C;">&nbsp;&nbsp;Usuario: <?php echo $id; ?></h4></div>
      </br>
      <table class="table table-striped">
      <thead>
        <tr>
          <th bgcolor="#dedede"><center>Descripcion Movimiento</center></th>
          <th bgcolor="#dedede"><center>Fecha</center></th>
          <th bgcolor="#dedede"><center>Hora</center></th>
          <th bgcolor="#dedede"><center>Valor</center></th>
        </tr>
      </thead>
      <tbody>
        <?php
        //ciclo de movimientos
        while($row = mysql_fetch_array($result))
       {
            echo "<tr><td><center>".$row["movimiento"]."</center></td>";
            echo "<td><center> ".$row["fecha"]."</center></td>";
            echo "<td><center>".$row["hora"]."</center></td>";
            echo "<td><center>".$row["valor"]."</center></td></tr>";
      }
      ?>  
      </tbody>
      </table>
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
header("Location: ReporteMovimientosFuncionarios.php");
}
?>
