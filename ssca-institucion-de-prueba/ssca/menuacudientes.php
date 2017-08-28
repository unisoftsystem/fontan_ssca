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
        <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Modulo Acudientes</h4>
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
            <li><a href='#' title="Credenciales"><h6><p class="full-circle"></p><span>Credenciales</span></h6></a>
                      <ul >
                            <?php
                            $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"77_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREAR RECARGA CREDENCIALES</a>");
                            if ($pos == false) {
                            //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                            } else {
                            echo "<li><a href='RecargadeCredenciales.php' title=\"Recarga de Credenciales\"><span>Recarga de Credenciales</span></a></li>";
                            }
                            ?>
                            <?php
                            $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"78_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREAR TRANSFERENCIA DE FONDOS</a>");
                            if ($pos == false) {
                            //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                            } else {
                            echo "<li><a href='TransferenciadeFondos.php' title=\"Transferencia de Fondos\"><span>Transferencia de Fondos</span></a></li>";
                            }
                            ?>
                            <?php
                            $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"80_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CONSULTA ESTADOS DE CUENTA</a>");
                            if ($pos == false) {
                            //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                            } else {
                            echo "<li><a href='EstadosdeCuenta.php' title=\"Estados de Cuenta\"><span>Estados de Cuenta</span></a></li>";
                            }
                            ?>
                      </ul>
            </li>
            <li><a href='#' title="Ruta Escolar"><h6><p class="full-circle"></p><span>Ruta Escolar</span></h6></a>
                      <ul >
                           <?php
                            $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"81_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CONSULTA TRAKING RUTA</a>");
                            if ($pos == false) {
                            //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                            } else {
                            echo "<li><a href='diss.php' title=\"Tracking Ruta Escolar\"><span>Tracking Ruta Escolar</span></a></li> ";
                            }
                            ?>
                            <?php
                            $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"82_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CONSULTA BITACORA</a>");
                            if ($pos == false) {
                            //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                            } else {
                            echo "<li><a href='BitacoradeUso.php' title=\"Bitacora de Uso\"><span>Bitacora de Uso</span></a></li>";
                            }
                            ?>
                            <?php
                            $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"83_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CONSULTA MENSAJES</a>");
                            if ($pos == false) {
                            //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                            } else {
                            echo "<li><a href='Mensajeria.php' title=\"Mensajeria\"><span>Mensajeria</span></a></li> ";
                            }
                            ?>
                      </ul>
            </li>
            <li><a href='#' title="Cafeteria y Restaurante"><h6><p class="full-circle"></p><span>Cafeteria y Restaurante</span></h6></a>
                      <ul>
                           <?php
                            $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"84_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREAR RESTRICCIONES DE CONSUMO</a>");
                            if ($pos == false) {
                            //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                            } else {
                            echo " <li><a href='RestriccionesdeConsumo.php' title=\"Restricciones de Consumo\"><span>Restricciones de Consumo</span></a></li>";
                            }
                            ?>
                            <?php
                            $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"85_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CONSULTA CONSUMOS</a>");
                            if ($pos == false) {
                            //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                            } else {
                            echo " <li><a href='PlanificaciondeConsumos.php' title=\"Planificacion de Consumos\"><span>Planificacion de Consumos</span></a></li>";
                            }
                            ?>
                      </ul>
            </li>
            <li><a href='#' title="Gestion Pagos"><h6><p class="full-circle"></p><span>Gestion Pagos</span></h6></a>
                      <ul>
                           <?php
                            $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"86_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREAR PAGO PRODUCTOS</a>");
                            if ($pos == false) {
                            //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                            } else {
                            echo "<li><a href='SelecciondeProducto.php' title=\"Seleccion de Producto\"><span>Seleccion de Producto</span></a></li>";
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