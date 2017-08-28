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
        <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Ingresos y Salida de Estudiantes</h4>
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
                  
                   <li><a href='#' title="Liquidacion y Cobros"><h6><p class="full-circle"></p><span>Ingreso y Salida</span></h6></a>
                      <ul style="margin-right:-42%">
                           <?php
                            $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"52_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CONSULTA REGISTRO INGRESO DE ESTUDIANTES</a>");
                            if ($pos == false) {
                            //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                            } else {
                            echo "<li><a href='#' title=\"Consulta Registros Ingreso\"><span>Consulta Registros Ingreso</span></a></li>";
                            }
                            ?> 
                            <?php
                            $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"53_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CONSULTA REGISTRO SALIDA DE ESTUDIANTES</a>");
                            if ($pos == false) {
                            //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                            } else {
                            echo "<li><a href='#' title=\"Consulta Registros Salida\"><span>Consulta Registros Salida</span></a></li>";
                            }
                            ?>
                      </ul>
                   </li>
                           
                   <li ><a href='#' title="Reportes"><h6><p class="full-circle"></p><span>Reportes</span></h6></a>
                        <ul style="margin-right:-42%">
                            <?php
                            $pos = strpos($permisos, "REPORTES ESTUDIANTES");
                            if ($pos == false) {
                            //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                            } else {
                            echo "<li><a href='#' title=\"Reporte\"><span>Reporte</span></a></li>";
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