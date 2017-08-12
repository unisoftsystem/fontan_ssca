<?php
 $valor = $_REQUEST["ruta"];
 $valor2 = $_REQUEST["monitor"];
 $valor3 = $_REQUEST["lat"];
 $valor4 = $_REQUEST["lng"];
 $valor5 = $_REQUEST["lats"];
 $valor6 = $_REQUEST["lngs"];
 $valor7 = $_REQUEST["conductor"];
 $curso = $_REQUEST['cursos'];
 



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
    <meta charset="UTF-8">
    <title>Ssca</title>
    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/stylen.css" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
	  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
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
    <script type="text/javascript" src="js/funtions.js"></script>
    <style type="text/css">
    	.footer {
		  position: static;
		  bottom: 0;
		  width: 100%;
		  /* Set the fixed height of the footer here */
		  height: 100px;
		  background-color: #f5f5f5;
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
  position: static;
  width:400px;
  height:500px;
  border: 1px dashed #888;
  background: url('img/bg.png') no-repeat;
  background-size: 100% 60px;
  background-color:rgba (255,255,255, 0.7);
  padding-left:15%;
}

#container-player {
  float: left;
  position: static;
  width:400px;
  height: 500px;
  border: 1px dashed #888;
  background-color:rgba (255,255,255, 0.7);
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
  margin-top:65px;
  text-align: center;
  font-weight: bold;
  float: left;
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

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12" style="background-color: #f5f5f5;">
			<img alt="Bootstrap Image Preview" src="img/HOME.png" width="200" height="100" border="0">
		</div>
    <div id="bartolo" align= "center" style="margin:0 auto 0 auto; left: 40%;" >
      <a href="creaciones.php"><img src="img/logo1.png" width="70" height="70" border="0"></a> 
      <a href="diss.php"><img src="img/logo2.png" width="70" height="70" border="0"></a>
      <a href="#"><img src="img/logo3.png" width="70" height="70" border="0"></a>
    </div>
	</div>
<div class="row">  
<h3 class="text-primary text-right">Seleccion de Estudiantes</h3>
<div id="search_result">
<?php
       if ($result) {
        // sin mensaje por ser un proceso unido a drag
        echo "";
    } else {
        // failed to insert row
        echo "Insersion Fallida de Ruta"; 
    }
    ?>
</div>
</div>
	<div class="row">
    <div class="col-md-6">
    <div id="container-player"></div>
    
    </div>
    <div class="col-md-6">
    <div id="container-field"></div>
    <div id="divErrorMessages"></div>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    <input type="submit" id="submit" class="btn btn-primary pull-right" onclick="submitFunction()" value="Crear Ruta">
    </div>
  </div>

  <?php 
      
      include("connect.php");
      $query  = "SELECT * FROM usuarios where curso=".$curso."";
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
if (!empty($_POST['cursos'])) {
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
           $margin_top      = 230+($x*230);
           $style_left[$x] += 80;
           $sl              = $style_left[$x];
        }
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




<?php 
$apellido = $_REQUEST['busquedas'];   
$query1  = "SELECT NumeroId, PrimerNombre, PrimerApellido, ruta_idruta, ImagenFotografica FROM usuarios where PrimerApellido='".$apellido."'";
$result1 = mysql_query($query1);
      
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

if (!empty($_POST['busquedas'])) {
$n = 0;
while($rows = mysql_fetch_array($result1, MYSQL_ASSOC))
      { 
      $n++; 
        $id1 = stripslashes($rows['NumeroId']);
        $nombre1 = stripslashes($rows['PrimerNombre']);
        $apellido1 = stripslashes($rows['PrimerApellido']);
        $ruta1 = stripslashes($rows['ruta_idruta']);
        $imagen1 = stripslashes($rows['ImagenFotografica']);
    for($x=0;$x<=$division;$x++){
        if (in_array($n, $group[$x])) {
           $margin_top      = 230+($x*230);
           $style_left[$x] += 80;
           $sl              = $style_left[$x];
        }
    }
  }
?>
<div class="drag" id="drag<?php echo $n;?>" idal="<?php echo $id1;?>" number="<?php echo $n;?>" style="left:<?php echo $sl;?>px;top:<?php echo $margin_top;?>px;" status="0">
    <a class="boxclose" id="back<?php echo $n;?>" number="<?php echo $n;?>" top="" left="">
        <img src="./img/back.png" width="20">
    </a>
    <div class="name"><p id=""><?php echo $nombre;?></p></div>
</div>
<script>
    $(function($){
        setTimeout(function () { 
          var text = watermark.text;
          watermark(['<?php echo $imagen1;?>'])
            .image(text.center('', 1, 48))
            .then(function (img) {
              $('#drag<?php echo $n;?>').css("background","url('"+img.src+"')","border-radius","200px");
            });

        }, 1000);
    });
</script>
<?php 
}
?>

<footer class="footer">
   <img alt="" src="img/logo.png" width="300" height="110"  border="0">
</footer>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="js/fastclick.js"></script>
<script src="js/scroll.js"></script>
</body>
</html>