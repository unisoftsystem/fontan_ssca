<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>consulta rutas</title>
    <meta name="author" content="Adtile">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/funtions.js"></script>
  <!-- for the one page layout -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
    <script src="js/responsive-nav.js"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
<style>
ul {
  padding:0px;
  margin: 0px;
}
#response {
  padding:10px;
  background-color:#DAD8DF;
  border:2px solid #396;
  margin-bottom:20px;
}
#list li {
  margin: 0 0 3px;
  padding:8px;
  background-color:#ABAAAA;
  color:#fff;
  list-style: none;
}
</style>
<script type="text/javascript">
$(document).ready(function(){   
    function slideout(){
  setTimeout(function(){
  $("#response").slideUp("slow", function () {
      });  
}, 2000);}
  
    $("#response").hide();
  $(function() {
  $("#list ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {
      
      var order = $(this).sortable("serialize") + '&update=update'; 
      $.post("updateList.php", order, function(theResponse){
        $("#response").html(theResponse);
        $("#response").slideDown('slow');
        slideout();
      });                                
    }                 
    });
  });

}); 
</script>


  </head>
  <body>
   <div id="container">
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
    <h1>Rutas</h1>

    <?php
      require_once '/db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
   ?>
     <form  action="msjinsersionrutas.php" method="POST">
  <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Ruta</label>
  
    <div class="col-lg-10">
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
    </div>
  </div>
  </br>
  </br>
  <div class="form-group">
    <label for="ejemplo_password_3" class="col-lg-2 control-label">Conductor</label>
    
    <div class="col-lg-10">
      <select class="form-control" name="conductor"> 
      <?php
            $result = mysql_query("SELECT * FROM conductor");
            while($row = mysql_fetch_assoc($result))
            {
            ?>
            <option  value="<?php echo($row['idconductor'])?>" >
                <?php echo($row['nombre']) ?> <?php echo($row['apellido']) ?>
            </option>
            <?php
            }               
        ?>
      </select>
    </div>
    </br>
  </br>
  <div class="form-group">
    <label for="ejemplo_password_3" class="col-lg-2 control-label">Monitor</label>
    
    <div class="col-lg-10">
      <select class="form-control" name="monitor"> 
      <?php
            $result = mysql_query("SELECT * FROM monitor");
            while($row = mysql_fetch_assoc($result))
            {
            ?>
            <option  value="<?php echo($row['idmonitor'])?>" >
                <?php echo($row['nombre']) ?> <?php echo($row['apellido']) ?>
            </option>
            <?php
            }               
        ?>
      </select>
    </div>
  </br>
  </br>
  </br>
  </br>
  </br>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Crear</button>
    </div>
  </div>
</form>
</br>
<div id="footer"></div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7025232-1");
pageTracker._trackPageview();
} catch(err) {}</script>
    <script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/fixed-responsive-nav.js"></script>
  </div>
  </body>
</html>