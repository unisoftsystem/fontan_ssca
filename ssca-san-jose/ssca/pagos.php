<?php
        include("connect.php");
        $valor1 = 1012324820;
        $query  = "SELECT *  FROM usuarios INNER JOIN pagos ON usuarios.NumeroId=pagos.idestudiante where idAcudiente='".$valor1."'";
        $result1 = mysql_query($query);       
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
    <script type="text/javascript" src="js/funtions.js"></script>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
    <script src="js/responsive-nav.js"></script>
  </head>
  <body onload="validate_fechaMayorQue();">

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
      <h1>Pagos</h1>
      <table class="table table-striped">
  <thead>
    <tr>
      <th bgcolor="#dedede"><center>Identificacion</center></th>
      <th bgcolor="#dedede"><center>Fecha</center></th>
      <th bgcolor="#dedede"><center>Valor</center></th>
      <th bgcolor="#dedede"><center>Consultar</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
    while($row = mysql_fetch_array($result1, MYSQL_ASSOC))
   {
        echo "<tr><td>".$row["idpagos"]."</td>";
        echo "<td>".$row["fecha"]."</td>";
        echo "<td>".$row["valor"]."</td>";
        echo "<td bgcolor=\"#EFE5FC\"><a href=\"javascript:abrir('detallepagos.php?o=".$row["idpagos"]."')\" title='Consultar'><center><img src='img/busqueda.png' width='22' height='22' alt='detalle'></center></a></td></tr>";       
        $fecha=$row["fecha"];
  }
  ?>
  
  </tbody>
  </table>
    <script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/fixed-responsive-nav.js"></script>
    <script>
        /**
         * Funcion que dadas dos fechas, valida que la fecha final sea
         * superior a la fecha inicial.
         * Tiene que recibir las fechas en formato español dd/mm/yyyy
         * No valida que las fechas sean correctas
         * Devuelve 1 si es mayor
         *
         * Para validar si una fecha es correcta, utilizar la función:
         * http://www.lawebdelprogramador.com/codigo/JavaScript/1757-Validar_una_fecha.html
         */
        function validate_fechaMayorQue()
        {
          var fecha1,fecha2,f1,f2; 

          fecha1=new Date(); 
          fecha2=new Date(); 

          fecha2=new Date(<?php echo $fecha; ?>); 
          fecha1=new Date(fecha1.getFullYear(),fecha1.getMonth(),fecha1.getDate()); 
          f1=new Date(fecha2); 
          f2=new Date(fecha1); 

          if(f1==f2) 
          { 
          alert('Debe Realizar el pago de ruta'); 
          } 
          else 
          { 
          alert('Esta al dia con los pagos'); 
          }
        }
    </script>
  </body>
</html>

