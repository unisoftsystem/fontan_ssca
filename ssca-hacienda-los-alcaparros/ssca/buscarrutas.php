<?php
include("connect.php");
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
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
    <script src="js/responsive-nav.js"></script>
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
      <h1>Consultar Rutas Mapa</h1>
      <form  action="dis.php" method="POST">
      <select class="form-control" name="ruta"> 
      <?php
            $result = mysql_query("SELECT * FROM ruta");
            while($row = mysql_fetch_assoc($result))
            {
            ?>
            <option  value="<?php echo($row['idruta'])?>" >
                <?php echo($row['nombre_ruta']) ?> 
            </option>
            <?php
            }               
        ?>
      </select>
    </br>
    </br>
    </br>
       <input type="submit" id="submit" class="btn btn-primary pull-right" value="Ver Mapa Ruta">
    </form>
    <script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/fixed-responsive-nav.js"></script>
  </body>
</html>


