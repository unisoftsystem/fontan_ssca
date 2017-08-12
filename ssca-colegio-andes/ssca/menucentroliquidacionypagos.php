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
        <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="js/script.js"></script>
        <style>
          input, select{
        border-radius:8px;
        width:100%
        }
        </style>
    </head>
    <body id="bodyBase">
      <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Centro de Liquidacion y Pagos</h4>
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
               <li><a href='#' title="Recaudos"><h6><p class="full-circle"></p><span>Recaudos</span></h6></a>
                    <ul style="margin-right:-42%">
                         <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"15_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREAR PAGO INICIAL SERVICIOS</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='asignacionpagoinicial.php' title=\"Pago Inicial de Servicios\"><span>Pago Inicial de Servicios</span></a></li>";
                          }
                          ?> 
                          <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"21_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREAR RECAUDO SERVICIOS</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li class='last' title=\"Recaudo de Servicios\" ><a href='RecaudodeServicios.html'><span>Recaudo de Servicios</span></a></li>";
                          }
                          ?> 
                          <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"16_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREAR RECARGUE DE CREDENCIALES</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li class='last' title=\"Recargue de Credenciales\" ><a href='ProcesoRecaudo.php'><span>Recargue de Credenciales</span></a></li>";
                          }
                          ?>
                    </ul>
               </li>
               <li class=''><a href='#' title="Reportes"><h6><p class="full-circle"></p><span>Reportes</span></h6></a>
                  <ul style="margin-right:-42%">
                          <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"22_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>REPORTES</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='ReporteRecaudo.php' title=\"Cierre de Caja\"><span>Cierre de Caja</span></a></li>";
                          }
                          ?>
                          <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"22_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>REPORTES</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='Generacionestadosdecuenta.html' title=\"Generacion estados de cuenta\"><span>Generacion estados de cuenta</span></a></li>";
                          }
                          ?>
                  </ul>
               </li>
               <li><a href='#' title="Mensajeria"><h6><p class="full-circle"></p><span>Mensajeria</span></h6></a>
                  <ul style="margin-right:-42%">
                          <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"23_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>COBRO SERVICIOS ESCOLARES</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='Cobrodeserviciosescolaresalosacudientes.html'><span>Cobro de servicios escolares a los acudientes</span></a></li>";
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
        <script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>     
    </body>
</html>