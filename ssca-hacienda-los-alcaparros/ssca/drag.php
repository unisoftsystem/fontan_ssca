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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=8" />
    <link href="./css/base.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="./js/jquery-git2.min.js"></script>
    <script src="./js/jquery.event.drag-2.2.js"></script>
    <script src="./js/jquery.event.drag.live-2.2.js"></script>
    <script src="./js/jquery.event.drop-2.2.js"></script>
    <script src="./js/jquery.event.drop.live-2.2.js"></script>
    <script src="./js/excanvas.min.js"></script>
    <script src="./js/watermark-polyfill.js"></script>
    <script src="./js/main.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/styles.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript --> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/funtions.js"></script>
    <style type="text/css">
       #divredondo {
       height:80px;
       width:80px;
       border-radius:200px;
       background: #dedede;
       }
    </style>
    <script type="text/javascript">
          $(document).ready(function () {
           
          window.setTimeout(function() {
              $(".alert").fadeTo(500, 0).slideUp(500, function(){
                  $(this).remove(); 
              });
          }, 2000);
           
          });
    </script>
    <title>Cargar Estudiantes</title>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
    <script src="js/responsive-nav.js"></script>
    <!-- Scripts-->
    <script>
    function submitFunction() {//Qui guarda ?
        var value= '';
        $('.drag').each(function(idx, el) {
            if($(el).attr("status") == "1"){
              if(value != '') value += ',';
              value  += $(el).attr("idal")+"";
            }
        });
        $.ajax({
        url: 'store.php',
        type: 'POST',
        data: {value: value},
          beforeSend:function(){
              $('#search_result').html("<center><br/><h4>Cargando Datos.....</h4></center>");},
                success:function(data){
              $("#search_result").html(data);
            }
        });
    }
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

    
<input type="hidden" id="totalDrop" value="0">
<div id="lock"></div>
<div class="row">
</br>
</br>
</br>
<h4>Lista Estudiantes</h4>  
<div id="container-field">
</div>
<div id="container-player"></div>
<div id="search_result"></div>
<div id="divErrorMessages"></div>
</div>
<input type="submit" id="submit" class="btn btn-primary pull-right" onclick="submitFunction()" value="Crear">


<?php 
      include("connect.php");
      $query  = "SELECT NumeroId, PrimerNombre, PrimerApellido, ruta_idruta, ImagenFotografica FROM usuarios ";
      $result = mysql_query($query);
      
$totalData  = 4;
$perGroup   = 4;
$division   = ceil($totalData/$perGroup);
$group      = [];
$style_left = [];

for($x=0;$x<=$division;$x++){
    $style_left[$x] = 0;
    $group[$x] = [];
    if($x==0){
      $z             = 1;
      $perGroupAfter = $perGroup;
    }else{
      $z             = ($x*$perGroup)+1;
      $perGroupAfter = ($x*$perGroup)+$perGroup;
    }
    for($y=$z;$y<=$perGroupAfter;$y++){
      array_push($group[$x],$y);
    }
}
$i = 0;
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
      { 
      $i++; 
        $id = stripslashes($row['NumeroId']);
        $nombre = stripslashes($row['PrimerNombre']);
        $apellido = stripslashes($row['PrimerApellido']);
        $ruta = stripslashes($row['ruta_idruta']);
        $imagen = stripslashes($row['ImagenFotografica']);
    for($x=0;$x<=$division;$x++){
        if (in_array($i, $group[$x])) {
           $margin_top      = 90+($x*90);
           $style_left[$x] += 80;
           $sl              = $style_left[$x];
        }
    }
?>
<div class="drag" id="drag<?php echo $i;?>" idal="<?php echo $id;?>" number="<?php echo $i;?>" style="left:<?php echo $sl;?>px;top:<?php echo $margin_top;?>px;" status="0">
    <a class="boxclose" id="back<?php echo $i;?>" number="<?php echo $i;?>" top="" left="">
        <img src="./img/back.png" width="20">
    </a>
    <div class="name"><p id=""><?php echo $nombre;?></p></div>
</div>
<script>
    $(function($){
        setTimeout(function () { 
          var text = watermark.text;
          watermark(['<?php echo $imagen;?>'])
            .image(text.center('', 1, 48))
            .then(function (img) {
              $('#drag<?php echo $i;?>').css("background","url('"+img.src+"')","border-radius","200px");
            });

        }, 1000);
    });
</script>
<?php 
}
?>
    <script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/fixed-responsive-nav.js"></script>
  </body>
</html>

