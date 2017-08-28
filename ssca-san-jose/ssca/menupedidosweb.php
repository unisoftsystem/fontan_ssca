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
        <style type="text/css">
        h3 {
            text-shadow: 0px 2px 3px #555;
           }
        </style>
    </head>
    <body id="bodyBase">
        <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Modulo Pedidos Web</h4>
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
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"65_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CONSULTA QR</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='LecturadecodigoQR.php' title=\"Lectura de código QR\"><h6><p class=\"full-circle\"></p><span>Lectura de código QR</span></h6></a></li>";
                  }
                  ?>

                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"68_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CREAR PAGO PEDIDO</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='Verificacióndesaldocredencial.php' title=\"Verificación de saldo credencial\"><h6><p class=\"full-circle\"></p><span>Verificación de saldo credencial</span></h6></a></li>";
                  }
                  ?>

                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"66_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CONSULTA PRODUCTOS</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='Seleccióndeproductos.php' title=\"Seleccion de Productos\"><h6><p class=\"full-circle\"></p><span>Seleccion de Productos</span></h6></a></li>";
                  }
                  ?>

                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"67_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>CONSULTA ENTREGA PEDIDO</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='CierrePedidos.php' title=\"Cierre Pedidos\"><h6><p class=\"full-circle\"></p><span>Cierre Pedidos</span></h6></a></li>";
                  }
                  ?>

                  <?php
                  $pos = strpos($permisos, "<a class=\"jstree-anchor jstree-clicked\" href=\"#\" tabindex=\"-1\" id=\"70_anchor\"><i class=\"jstree-icon jstree-checkbox\" role=\"presentation\"></i><i class=\"jstree-icon jstree-themeicon\" role=\"presentation\"></i>PAGO DE PEDIDO</a>");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo " <li class=''><a href='PagosPedidos.php' title=\"Pagos Pedidos\"><h6><p class=\"full-circle\"></p><span>Pagos Pedidos</span></h6></a></li>";
                  }
                  ?>
               
                
               
               
            </ul>
        </div>
        <div class="contenidoBorde">
            </br>
            <center><h4 style="color:#09C;">Usuario: <?php echo $id; ?></h4></center>
        </div>     
    </body>
</html>