
<?php
 $valor = $_REQUEST["ruta"];
 $valor2 = $_REQUEST["monitor"];
 $valor3 = $_REQUEST["lat"];
 $valor4 = $_REQUEST["lng"];
 $valor5 = $_REQUEST["lats"];
 $valor6 = $_REQUEST["lngs"];
 $valor7 = $_REQUEST["conductor"];
 $curso = $_REQUEST['cursos'];
 $apellido = $_REQUEST['busquedas'];

 require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO asignacionruta(idruta, monitor,id_conductor, latorigen, longorigen, latdestino, longdestino) VALUES('".$valor."', '".$valor2."','".$valor7."', '".$valor3."', '".$valor4."', '".$valor5."', '".$valor6."')");
    // check if row inserted or not
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=8" />
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
          html, body{
          background-image:url(img/crea.png);
          background-repeat:no-repeat;
          background-size: 100% 100%;
          height: 100%;
              margin: 0;
              padding: 0;
        }
       #divredondo {
       height:80px;
       width:80px;
       border-radius:200px;
       background: #dedede;
       }
       #contenedor {height: 300px;margin:0;position:relative;top:110px;}

  a.boxclose{
    float:right;
    margin-top:-20px;
    margin-right:-10px;
    cursor:pointer;
    display: inline-block;
    line-height: 0px;
    padding: 11px 3px;   
    visibility:hidden;    
}

.drag {
  position: absolute; 
  height: 58px;
  width: 58px;
  cursor: move;
  top: 300px;
  border-radius:200px;
}

#container-field {
  float: right;
  width:400px;
  height:320px;
  border: 1px dashed #888;
  background: url('img/bg.png') no-repeat;
  background-size: 100% 60px;
  background-color:rgba(0, 0, 0, 0.5);
  padding-left:15%;
}

#container-player {
  float: left;
  width:400px;
  height: 320px;
  border: 1px dashed #888;
  background-color:rgba(0, 0, 0, 0.5);
  top         : 70px;
  padding-left:15%;
}

#lock { height: 575px; width: 420px; }
#lock {
  position    : fixed;
  z-index     : 99999;
  top         : 70px;
  left        : 20px;
  overflow    : hidden;
  text-indent : 100%;
  font-size   : 0;
  opacity     : 0.6;
  background  : #E0E0E0  url(../img/locked_gif.gif) center no-repeat;
}

.drag div {
  font-size :10px;
  margin-top:55px;
  text-align: center;
  font-weight: bold;
  float: left;
}
#wrap { margin:0 auto 0 auto; width:350px; }
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
    function submitFunction() {
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
              $('#search_result').html("<center><br/><h4></h4></center>");},
                success:function(data){
              $("#search_result").html(data);
            }
        });
    }
    </script>
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
    
<input type="hidden" id="totalDrop" value="0">
<div class="row">
  <div id="wrap">
    <a href="creacion.php"><img src="img/logo1.png" width="100" height="100" border="0"></a> 
    <a href="diss.php"><img src="img/logo2.png" width="100" height="100" border="0"></a>
    <a href="#"><img src="img/logo3.png" width="100" height="100" border="0"></a>
  </div>

<div id="contenedor">
<div id="search_result">
</div>
  <?php
       if ($result) {
        // sin mensaje por ser un proceso unido a drag
        echo "";
    } else {
        // failed to insert row
        
        echo "Insersion Fallida de Ruta";
        
    }
    ?>
<div id="container-field">
</div>

<div id="container-player"></div>


</div>
<div id="divErrorMessages"></div>
</div>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
<input type="submit" id="submit" class="btn btn-primary pull-right" onclick="submitFunction()" value="Crear">


<?php 
      
      include("connect.php");
      $query  = "SELECT NumeroId, PrimerNombre, PrimerApellido, ruta_idruta, ImagenFotografica FROM usuarios where curso=".$curso."";
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
           $margin_top      = 180+($x*180);
           $style_left[$x] += 80;
           $sl              = $style_left[$x];
        }
    }
?>



<?php 
      
      include("connect.php");
      $query  = "SELECT NumeroId, PrimerNombre, PrimerApellido, ruta_idruta, ImagenFotografica FROM usuarios where PrimerApellido=".$apellido."";
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
           $margin_top      = 180+($x*180);
           $style_left[$x] += 80;
           $sl              = $style_left[$x];
        }
    }
?>
<?php 
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