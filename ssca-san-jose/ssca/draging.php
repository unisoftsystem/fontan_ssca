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
    <style>
		header, section {
			display: block;
		}
		body {
			font-family: 'Droid Serif';
		}
		h1, h2 {
			text-align: center;
			font-weight: normal;
		}
		#features {
			margin: auto;
			width: 460px;
			font-size: 0.9em;
		}
		.connected, .sortable, .exclude, .handles {
			margin: auto;
			padding: 0;
			width: 310px;
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		.sortable.grid {
			overflow: hidden;
		}
		.connected li, .sortable li, .exclude li, .handles li {
			list-style: none;
			border: 1px solid #CCC;
			background: #F6F6F6;
			font-family: "Tahoma";
			color: #1C94C4;
			margin: 5px;
			padding: 5px;
		}
		.handles span {
			cursor: move;
		}
		li.disabled {
			opacity: 0.5;
		}
		.sortable.grid li {
			line-height: 80px;
			float: left;
			width: 80px;
			height: 80px;
			text-align: center;
		}
		li.highlight {
			background: #FEE25F;
		}
		#connected {
			width: 440px;
			overflow: hidden;
			margin: auto;
		}
		.connected {
			float: left;
			width: 200px;
		}
		.connected.no2 {
			float: right;
		}
		li.sortable-placeholder {
			border: 1px dashed #CCC;
			background: none;
		}
	</style>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
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
    <?php
        include("connect.php");
        $query  = "SELECT NumeroId, PrimerNombre, PrimerApellido, ruta_idruta, ImagenFotografica FROM usuarios ";
        $result = mysql_query($query);
        
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $id = stripslashes($row['NumeroId']);
        $nombre = stripslashes($row['PrimerNombre']);
        $apellido = stripslashes($row['PrimerApellido']);
        $ruta = stripslashes($row['ruta_idruta']);
        }
	?> 
    <section id="home">
	<section id="connected">
		<h2>Listado Estudiantes</h2>
		<p id="dragelement_<?php echo $id ?><?php echo $ruta ?><?php echo $nombre ?><?php echo $apellido ?>" class='dragelement'><label> Identificacion </label> <?php echo $id ?> <label> Ruta </label>  <?php echo $ruta?> <label> Nombre </label> <?php echo $nombre ?> <label> Apellido </label> <?php echo $apellido;?> 
      </p>
		<ul class="connected list">
			<li>Item 1</li>
			<li>Item 2</li>
			<li>Item 3</li>
			<li>Item 4</li>
			<li>Item 5</li>
			<li>Item 6</li>
		</ul>
		<ul class="connected list no2">
			<li class="highlight">Item 1</li>
		</ul>
	</section><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="js/jquery.sortable.js"></script>
	<script>
		$(function() {
			$('.sortable').sortable();
			$('.handles').sortable({
				handle: 'span'
			});
			$('.connected').sortable({
				connectWith: '.connected'
			});
			$('.exclude').sortable({
				items: ':not(.disabled)'
			});
		});
	</script>

    <script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/fixed-responsive-nav.js"></script>
  </body>
</html>