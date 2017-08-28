<?php
/* Empezamos la sesión */
    session_start();
    /* Creamos la sesión */
    $id =  $_SESSION['userid'];
    /* Si no hay una sesión creada, redireccionar al index. */
    if(empty($_SESSION['userid'])) { // Recuerda usar corchetes.
        header('Location: indexusuariointerno.html');
    } // Recuerda usar corchetes

    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    //sesion a variable
     $_SESSION['userid'] = $id;
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SSCA</title>
        <link href="css/style.css" rel="stylesheet"/>
        <link href="css/menu.css" rel="stylesheet"/>
        <link href="css/popup.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/style.js"></script>  
        <script type="text/javascript" src="js/ConexionWebService.js"></script>
        <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/alertify.js"></script>
            <link rel="stylesheet" href="css/alertify.core.css" />
            <link rel="stylesheet" href="css/alertify.default.css" />
            <script src="js/script.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="js/popup.js"></script>
    </head>
    <body id="bodyBase">
        <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Modulo Cafeteria</h4>
        <h1 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Bienvenido</h1>
        <?php
        $query1  = "SELECT * FROM usuarios_sistema where  idUsuario='".$id."'";
        $result1 = mysql_query($query1);
        while($rows = mysql_fetch_array($result1, MYSQL_ASSOC))
        { 
        $permisos = stripslashes($rows['permisos']);
        }
        ?>
        <div id='cssmenu'>
            <ul>
                  <li><a href='#' title="Gestion de Productos"><h6><p class="full-circle"></p><span>Gestion de Productos</span></h6></a>
                  <ul style="margin-right:-42%">  
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"56_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREACION DE PRODUCTOS</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li class='active'><a href='NuevoProducto.html' title=\"Crear Productos\"><span>Crear Productos</span></a></li>";
                  }
                  ?>
                  </ul>
                  </li>
                  <li><a href='#' title="Gestion de Inventarios"><h6><p class="full-circle"></p><span>Gestion de Inventarios</span></h6></a>
                  <ul style="margin-right:-42%">
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"58_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREAR STOCK</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='gestioninventarios.html' title=\"Crear Stock\"><span>Crear Stock</span></a></li>";
                  }
                  ?>
                  </ul>
                  </li>
                  <li><a href='#' title="Liquidacion y Cobros"><h6><p class="full-circle"></p><span>Liquidacion y Cobros</span></h6></a>
                  <ul style="margin-right:-42%">
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"59_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREAR REVERSION PEDIDOS</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='ReversionOrdenPedido.html' title=\"Reversion de Pedidos\"><span>Reversion de Pedidos</span></a></li>";
                  }
                  ?>
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"60_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREACION CUENTAS DE COBRO</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='CrearCuentaCobro.php' title=\"Crear Cuenta Cobro\"><span>Crear Cuenta Cobro</span></a></li>";
                  }
                  ?>    
                  </ul>
               </li>
               <li class=''><a href='#' title="Reportes"><h6><p class="full-circle"></p><span>Reportes</span></h6></a>
                  <ul style="margin-right:-42%">
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"62_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>REPORTES CAFETERIA</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='TendenciasDia.php' title=\"Tendencias dia\"><span>Tendencias de Consumo Dia</span></a></li>";
                  echo "<li><a href='TendenciasSemana.php' title=\"Tendencias semana\"><span>Tendencias de Consumo Semana</span></a></li>";
                  echo "<li><a href='TendenciasMes.php' title=\"Tendencias mes\"><span>Tendencias de Consumo Mes</span></a></li>";
                  }
                  ?>    
                  </ul>
               </li>
               <li class=''><a href='#' title="Area de Alistamiento"><h6><p class="full-circle"></p><span>Area de Alistamiento</span></h6></a>
                  <ul style="margin-right:-42%">
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"54_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CONSULTAR PEDIDOS</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='#' title=\"Consulta Pedidos\"><span>Consulta Pedidos</span></a></li>";
                  }
                  ?>  
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"55_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>APLICAR PEDIDOS</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='#' title=\"Aplicar Pedidos\"><span>Aplicar Pedidos</span></a></li>";
                  }
                  ?>   
                  </ul>
               </li>
               <li class=''><a href='#' title="Area de Entrega"><h6><p class="full-circle"></p><span>Area de Entrega</span></h6></a>
                  <ul style="margin-right:-42%">
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"63_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CONSULTA TURNOS</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='#' title=\"Turnos\"><span>Turnos</span></a></li>";
                  }
                  ?>  
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"64_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREAR ENTREGA</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='#' title=\"Aplicar Turnos\"><span>Aplicar Turnos</span></a></li>";
                  }
                  ?>   
                  </ul>
               </li>
            </ul>
        </div>
        <div class="contenidoBorde">
            </br>
            <center><h4 style="color:#09C;">Usuario: <?php echo $id; ?></h4></center>
        </div>     
    </body>
</html>