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
        <style>
        	input, select{
				border-radius:8px;
				width:100%
			}
        </style>
    </head>
    <body id="bodyBase">
    	<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Centro Operativo de Rutas Escolares</h4>
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
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"38_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREACION CONDUCTORES</a>");
                  if ($pos == false) {
                   echo "<li class=''><a href='#' title=\"Gestion de Rutas Escolares\"><h6><p class=\"full-circle\"></p><span>Gestion de Conductores</span></h6></a>";
                  } else {
                  echo "<li><a href='CrearConductores.html' title=\"Gestion de Conductores\"><h6><p class=\"full-circle\"></p><span>Gestion de Conductores</span></h6></a></li>";
                  }
                  ?>
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"40_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREACION MONITORES</a>");
                  if ($pos == false) {
                  echo "<li class=''><a href='#' title=\"Gestion de Monitores\"><h6><p class=\"full-circle\"></p><span>Gestion de Monitores</span></h6></a>";
                  } else {
                  echo "<li class=''><a href='CrearMonitor.html' title=\"Gestion de Monitores\"><h6><p class=\"full-circle\"></p><span>Gestion de Monitores</span></h6></a></li>";
                  }
                  ?>
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"42_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREACION VEHICULOS</a>");
                  if ($pos == false) {
                  echo "<li class=''><a href='#' title=\"Gestion de Vehiculos\"><h6><p class=\"full-circle\"></p><span>Gestion de Vehiculos</span></h6></a>";
                  } else {
                  echo "<li class=''><a href='CrearVehiculos.html' title=\"Gestion de Vehiculos\"><h6><p class=\"full-circle\"></p><span>Gestion de Vehiculos</span></h6></a></li>";
                  }
                  ?>
               
               <li class=''><a href='#' title="Gestion de Rutas Escolares"><h6><p class="full-circle"></p><span>Gestion de Rutas Escolares</span></h6></a>
                  <ul style="margin-right:-42%">
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"44_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREACION RUTAS ESCOLARES</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='creaciones.php' title=\"Administracion Rutas Escolares\"><span>Administracion Rutas Escolares</span></a></li>";
                  }
                  ?>
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"46_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>TRACKING RUTAS ESCOLARES</a>");
                  if ($pos == false) {
                  
                  } else {
                  echo "<li><a href='diss.php' title=\"Tracking Time - Real\"><span>Tracking Time - Real</span></a></li>";
                  }
                  ?>
                  </ul>
                  </li>
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"47_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>MENSAJERIA RUTAS ESCOLARES</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li ><a href='#' title=\"Mensajeria\"><span>Mensajeria</span></a><ul style=\"margin-right:-42%\"><li><a href='MensajesAcudientes.php' title='Mensajeria para acudientes'><span>Mensajeria para acudientes</span></a></li></ul></li>";
                  }
                  ?>
               
               <li ><a href='#' title="Reportes"><h6><p class="full-circle"></p><span>Reportes</span></h6></a>
                    <ul style="margin-right:-42%">
                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"48_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>REPORTES RUTAS ESCOLARES</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='ReporteEstadodeCuenta.html' title=\"Reporte Estado de Cuenta\"><span>Reporte Estado de Cuenta</span></a></li>";
                  echo "<li><a href='ReporteRutas.php' title=\"Reporte Asignacion de Ruta\"><span>Reporte Asignacion de Ruta</span></a></li>";
                  echo "<li><a href='ReporteMensajeAcudiente.php' title=\"Reporte Mensajeria de Acudientes\"><span>Reporte Mensajeria de Acudientes</span></a></li>";
                  echo "<li><a href='BitacoradeRecogidasyentregas.html' title=\"Bitacora de Recogidas y entregas\"><span>Bitacora de Recogidas y entregas</span></a></li>";
                  echo "<li><a href='ReporteAlarmas.php' title=\"Alarmas generadas en trayectos\"><span>Alarmas generadas en trayectos</span></a></li>";
				  echo "<li><a href='ReporteMensajeCoordinador.php' title=\"Reporte Mensajeria de Coordinador a Acudientes\"><span>Reporte Mensajeria de Coordinador a Acudientes</span></a></li>";
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