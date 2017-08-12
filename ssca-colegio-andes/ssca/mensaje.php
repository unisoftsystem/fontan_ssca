<?php
 $valor = $_REQUEST["lat"];
 $valor2 = $_REQUEST["lng"];
 $valor3 = $_REQUEST["est"];

 require_once '/db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO recogida(latitud, longitud, idestudiante) VALUES('".$valor."', '".$valor2."', '".$valor3."')");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>app colegio</title>
    <meta name="author" content="Adtile">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
    <script src="js/responsive-nav.js"></script>
    <script type="text/javascript">
          $(document).ready(function () {
           
          window.setTimeout(function() {
              $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                  $(this).remove(); 
              });
          }, 5000);
           
          });
    </script>
  </head>
  <body>

    <header>
       <a href="menu.php" class="logo" data-scroll><img src="img/HOME.png" width="60" height="60" border="0"></a>
      <nav class="nav-collapse">
        <ul>
          <li class="menu-item active"><a href="consultarutas.php" data-scroll>Consulta Ruta</a></li>
          <li class="menu-item active"><a href="formcrearruta.php" data-scroll>Identificacion Ruta</a></li>
          <li class="menu-item"><a href="drag.php" data-scroll>Cargar Lista Estudiantes</a></li>
          <li class="menu-item"><a href="pagovirtual.php" data-scroll>Pagos Virtuales</a></li>
          <li class="menu-item"><a href="busquedahijo.php" data-scroll>Bitacoras</a></li>
          <li class="menu-item"><a href="mapa.php" data-scroll>Obtener Coordenadas Estudiante</a></li>
          <li class="menu-item"><a href="buscarrutas.php" data-scroll>Busqueda Rutas</a></li>
          <li class="menu-item"><a href="pagos.php" data-scroll>Pagos</a></li>
          <li class="menu-item"><a href="recogidavsdireccion.php" data-scroll>Recogida Vs Direccion</a></li>
          <li class="menu-item"><a href="#blog" data-scroll>Salir</a></li>
        </ul>
      </nav>
    </header>

    <section id="home">
    <?php
       if ($result) {
        // successfully inserted into database
        echo "<div class=\"alert alert-success\" role=\"alert\">";
        echo "Insersion Exitosa de Ruta";
        echo "</div>";
    } else {
        // failed to insert row
        echo "<div class=\"alert alert-success\" role=\"alert\">";
        echo "Insersion Fallida de Ruta";
        echo "</div>";
    }
    ?>
      
    <script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/fixed-responsive-nav.js"></script>
  </body>
</html>