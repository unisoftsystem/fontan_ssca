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
        <link rel="stylesheet" href="css/bootstrap.min.css">
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
			a{
				text-decoration:none;
			}
			
        </style>
    </head>
    <body id="bodyBase">
    	<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Modulo Administrativo</h4>
        <h2 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Bienvenido</h2>
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
               <li><a href='#' title="Gestion de Usuarios"><h6><p class="full-circle"></p><span>Gestion de Usuarios</span></h6></a>
                    <ul style="margin-right:-42%">
                         <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"37_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentatio\"></i>CREACION USUARIOS SISTEMA</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='UsuariosdelSistema.html' title=\"Usuarios del Sistema\"><span>Usuarios del Sistema</span></a></li>";
                          }
                         ?>
                         <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"19_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREAR USUARIOS APLICACIONES</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li class='last' title=\"Usuarios Aplicaciones\" class=\"active\"><a href='AdminUsuariosAplicaciones.html'><span>Usuarios de Aplicaciones</span></a></li>";
                          }
                         ?>      
					  </ul>
               </li>
               <li class=''><a href='#' title="Gestion Servicios del Sistema"><h6><p class="full-circle"></p><span>Gestion Servicios del Sistema</span></h6></a>
                  <ul style="margin-right:-42%">
                     <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"14_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREACION SERVICIOS DEL SISTEMA</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='CrearServiciosSistema.php' title=\"Servicios del Sistema\"><span>Servicios del Sistema</span></a></li>";
                          }
                      ?>
                      <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"25_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>REPORTES GESTION DE SERVICIOS DEL SISTEMA</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li class='last'><a href='Reportes.html' title=\"Reportes\"><span>Reportes</span></a></li>";
                          }
                      ?>
                  </ul>
               </li>
               <li class=''><a href='#' title="Gestion Servicios Escolares"><h6><p class="full-circle"></p><span>Gestion Servicios Escolares</span></h6></a>
                  <ul style="margin-right:-42%">
                    <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"29_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREACION SERVICIOS ESCOLARES</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='asignacion.php'><span>Servicios Escolares</span></a></li>";
                          }
                    ?>
                    <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"30_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>PAGO A TERCEROS</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='PagosCuentaCobro.php'><span>Pago a Terceros</span></a></li>";
                          }
                    ?> 
                    <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"31_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>REPORTE GESTION SERVICIOS ESCOLARES</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li class='last'><a href='ReportesServiciosSistema.html'><span>Reportes</span></a></li>";
                          }
                    ?>
                  </ul>
               </li>
               <li class=''><a href='#' title="Puntos de Recarga"><h6><p class="full-circle"></p><span>Gestion de Credenciales</span></h6></a>
                  <ul style="margin-right:-42%">
                   <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"32_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>REMPLAZO DE CREDENCIALES</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='ReemplazarCredencial.html'><span>Remplazo de Credenciales</span></a></li>";
                          }
                    ?>
                    <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"33_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>REPORTES GESTION DE CREDENCIALES</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='ReporteCredencial.html'><span>Reportes</span></a></li>";
                          }
                    ?>
                  </ul>
               </li>
               <li class=''><a href='#' title="Entrada y Salida de Personal"><h6><p class="full-circle"></p><span>Entrada y Salida de Personal</span></h6></a>
                    <ul style="margin-right:-42%">
                    <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"34_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>REPORTES GESTION ENTRADA Y SALIDA DE PERSONAL</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='ReporteCredencial.html'><span>Reportes</span></a></li>";
                          }
                    ?>
                    <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"35_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CONSULTA REGISTRO INGRESO ADMINISTRATIVO/a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='Estudiantes.html' title=\"Estudiantes\"><span>Estudiantes</span></a></li>";
                          }
                    ?>
                    <?php
                          $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"36_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CONSULTA REGISTRO SALIDA ADMINISTRATIVO</a>");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='FuncionariosInternos.html' title=\"Funcionarios Internos\"><span>Funcionarios Internos</span></a></li>";
                          }
                    ?>  
                    </ul>
               </li>
               <li class=''><a href='menusistemaprincipal.php' title="Salir"><h6><p class="full-circle"></p><span>Salir</span></h6></a>
               </li>
            </ul>
        </div>
        
        <div class="contenidoBorde">
            </br>
            <center><h4 style="color:#09C;">Usuario: <?php echo $id; ?></h4></center>
        </div>    
    </body>
</html>
