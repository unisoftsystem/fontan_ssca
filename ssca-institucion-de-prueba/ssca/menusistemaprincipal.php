<?php
    /* Empezamos la sesión */
    session_start();
    /* Creamos la sesión */
    $_SESSION['userid'] = $_POST["txtUsuario"];
    /* Si no hay una sesión creada, redireccionar al index. */
    if(empty($_SESSION['userid'])) { // Recuerda usar corchetes.
        header('Location: indexusuariointerno.html');
    } // Recuerda usar corchetes
   
    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    //validando usuario
    $nombre = $_POST["txtUsuario"]; 
    $password = $_POST["txtClave"]; 
    $clave = base64_encode($password);

    
    $sql = "SELECT * FROM `usuarios_sistema` WHERE `idUsuario`='$nombre' AND `Clave`='$clave' AND `Estado`='ACTIVO'";  
    $rec = mysql_query($sql);
    $count = 0;
    while($row = mysql_fetch_object($rec))
    {
        $count++;
        $result = $row;
    }
    if($count == 1)
    {
        
    }
    else
    {
        header ("Location: indexusuariointerno.html?mensaje='Usuario o Contraseña Erroneos'");
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SSCA</title>
        <link href="css/style.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/style.js"></script>
        <script type="text/javascript" src="js/alertify.js"></script>
    		<link rel="stylesheet" href="css/alertify.core.css" />
    		<link rel="stylesheet" href="css/alertify.default.css" />
    		<link href="css/menu1.css" rel="stylesheet"/>
        <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">  
            
    </head>
    <body id="bodyLogin">

    	<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <label id="usuarioSesion"><?php echo $_SESSION['userid']; ?></label></h4></body>
        <?php
        $query1  = "SELECT * FROM usuarios_sistema where  idUsuario='".$_SESSION['userid']."'";
        $result1 = mysql_query($query1);

        while($rows = mysql_fetch_array($result1, MYSQL_ASSOC))
        { 
        $permisos = stripslashes($rows['permisos']);
        }
        ?>
        </br>
        
        <div id='cssmenu' style="margin-top: 340px; ">
            <ul>
              <?php
                  $pos = strpos($permisos, 'MODULO ADMINISTRATIVO') || strpos($permisos, 'aria-selected="true"');
                  if ($pos == false) {
                      //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                      echo "<li><a href='menumoduloadministrativo.php' title=\"Modulo Administrativo\"><span>Modulo Administrativo</span></a></li>";
                  }
              ?>
               <?php
                  $pos = strpos($permisos, "CENTRO DE LIQUIDACION Y PAGOS") || strpos($permisos, 'aria-selected="true"');
                  if ($pos == false) {
                      //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                      echo "<li><a href='menucentroliquidacionypagos.php' title=\"Centro Liquidacion y Pagos\"><span>Centro Liquidacion y Pagos</span></a></li>";
                  }
              ?>
              <?php
                  $pos = strpos($permisos, "CENTRO OPERATIVO DE RUTAS ESCOLARES") || strpos($permisos, 'aria-selected="true"');
                  if ($pos == false) {
                      //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                      echo "<li><a href='menucentrooperativoderutasescolares.php' title=\"Centro Operativo de Rutas Escolares\"><span>Centro Operativo de Rutas Escolares</span></a></li>";
                  }
              ?>
              <?php
                  $pos = strpos($permisos, "MODULO DE INGRESOS Y SALIDA DE PERSONAL") || strpos($permisos, 'aria-selected="true"');
                  if ($pos == false) {
                      //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                      echo "<li class=''><a href='menuingresoysalidadepersonal.php' title=\"Modulo Ingresos y Salida de Personal\"><span>Modulo Ingresos y Salida de Personal</span></a></li>";
                  }
              ?>
              <?php
                  $pos = strpos($permisos, "MODULO DE INGRESOS Y SALIDA DE ESTUDIANTES") || strpos($permisos, 'aria-selected="true"');
                  if ($pos == false) {
                      //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                      echo "<li ><a href='menuingresoysalidadeestudiantes.php' title=\"Modulo Ingresos y Salida de Estudiantes\"><span>Modulo Ingresos y Salida de Estudiantes </span></a></li>";
                  }
              ?>
               <?php
                  $pos = strpos($permisos, "MODULO DE CAFETERIA") || strpos($permisos, 'aria-selected="true"');
                  if ($pos == false) {
                      //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                      echo "<li ><a href='menucafeteria.php' title=\"Modulo de Cafeteria\"><span>Modulo de Cafeteria</span></a></li>";
                  }
              ?>
              <?php
                  $pos = strpos($permisos, "MODULO DE PEDIDOS WEB") || strpos($permisos, 'aria-selected="true"');
                  if ($pos == false) {
                      //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                      echo "<li ><a href='menupedidosweb.php' title=\"Modulo de Pedidos Web\"><span>Modulo de Pedidos Web</span></a></li>";
                  }
              ?> 
              <?php
                  $pos = strpos($permisos, "MODULO DE RESTAURANTE") || strpos($permisos, 'aria-selected="true"');
                  if ($pos == false) {
                      //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                      echo "<li ><a href='menurestaurante.php' title=\"Modulo de Restaurante\"><span>Modulo de Restaurante</span></a></li>";
                  }
              ?> 
              <?php
                  $pos = strpos($permisos, "MODULO DE ACUDIENTES") || strpos($permisos, 'aria-selected="true"');
                  if ($pos == false) {
                      //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                      echo "<li ><a href='menuacudientes.php' title=\"Modulo de Acudientes\"><span>Modulo de Acudientes</span></a></li>";
                  }
              ?> 
               <li class="" id="Salir"><a href='indexusuariointerno.html' title="Cerrar Sesi&oacute;n"><span>Cerrar Sesi&oacute;n</span></a></li>
            </ul>
        </div>
    
    	<footer class="footer" align="right">
        <script src="js/jquery.js"></script>
				<script src="js/jquery.validate.js"></script>
				<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
        </footer>
    </body> 
</html>
