<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>consulta rutas</title>
    <meta name="author" content="Adtile">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/funtions.js"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
  <!-- for the one page layout -->
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
      <h1>Bitacora</h1>

<?php
      
      $valor = $_REQUEST["busqueda"];
      require_once '/db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
    $result = mysql_query("SELECT * FROM usuarios INNER JOIN bitacora ON usuarios.NumeroId=bitacora.usuarios_idUsuario where NumeroId='".$valor."'");
      
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th bgcolor="#dedede"><center>Identificacion</center></th>
      <th bgcolor="#dedede"><center>Primer Nombre</center></th>
      <th bgcolor="#dedede"><center>Segundo Nombre</center></th>
      <th bgcolor="#dedede"><center>Primer Apellido</center></th>
      <th bgcolor="#dedede"><center>Segundo Apellido</center></th>
      <th bgcolor="#dedede"><center>Fecha</center></th>
      <th bgcolor="#dedede"><center>Hora</center></th>
      <th bgcolor="#dedede"><center>Consultar</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
    while($row = mysql_fetch_assoc($result))
   {
        echo "<tr><td>".$row["NumeroId"]."</td>";
        echo "<td>".$row["PrimerNombre"]."</td>";
        echo "<td>".$row["SegundoNombre"]."</td>";
        echo "<td>".$row["PrimerApellido"]."</td>";
        echo "<td>".$row["SegundoApellido"]."</td>";
        echo "<td>".$row["fecha"]."</td>";
        echo "<td>".$row["hora"]."</td>";
        echo "<td bgcolor=\"#EFE5FC\"><a href=\"javascript:abrir('detallebitacora.php?o=".$row["NumeroId"]."')\" title='Consultar'><center><img src='img/busqueda.png' width='22' height='22' alt='detalle'></center></a></td></tr>";       
  }
  ?>
  </tbody>
  </table>
    <script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/fixed-responsive-nav.js"></script>
  </body>
</html>