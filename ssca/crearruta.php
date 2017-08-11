 <?php
      require_once '/db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
   ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
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
  
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
	<style>
	html, body{
		background-image:url(img/creacion.png);
		background-repeat:no-repeat;
		background-size: 100% 100%;
		height: 100%;
        margin: 0;
        padding: 0;
	}
	#wrap { margin:0 auto 0 auto; width:390px; }

	#map {
        height: 60%;
        float: right;
        width: 75%;
        height: 60%;
      }
#right-panel {
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}

#right-panel select, #right-panel input {
  font-size: 15px;
}

#right-panel select {
  width: 100%;
}

#right-panel i {
  font-size: 12px;
}

      #right-panel {
        margin: 20px;
        border-width: 1px;
        width: 20%;
        float: left;
        text-align: left;
        padding-top: 20px;
      }
      #directions-panel {
        margin-top: 20px;
        background-color: #FFEE77;
        padding: 10px;
      }

    #contenedor {height: 300px;margin:0;position:relative;top:0px;}
    #col_der, #col_izq, #col_cen {height: 100%;}
    #col_der {float: right; width: 410px;}
    #col_izq {float: left; width: 350px;}
    #col_cen {}

        .drag div {
      font-size :10px;
      margin-top:55px;
      text-align: center;
      font-weight: bold;
      float: left;
    }

    #container-field {
      float: right;
      width:300px;
      height:300px;
      border: 1px dashed #888;
      background: url('../img/bg.png') no-repeat;
    }

    #container-player {
      float: left;
      width:300px;
      height: 300px;
      border: 1px dashed #888;
      background: #dedede;
      top         : 70px;
    }

        .drag {
      position: absolute; 
      height: 58px;
      width: 58px;
      cursor: move;
      top: 300px;
    }

	</style>
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
    <script type="text/javascript">
  //Declaramos las variables que vamos a user
  var lat = null;
  var lng = null;
  var map = null;
  var geocoder = null;
  var marker = null;
           
  jQuery(document).ready(function(){
       //obtenemos los valores en caso de tenerlos en un formulario ya guardado en la base de datos
       lat = jQuery('#lat').val();
       lng = jQuery('#long').val();
       //Asignamos al evento click del boton la funcion codeAddress
       jQuery('#pasar').click(function(){
          codeAddress();
          return false;
       });
      //Inicializamos la función de google maps una vez el DOM este cargado
      initialize();
  });
       
      function initialize() {
       
        geocoder = new google.maps.Geocoder();
          
         //Si hay valores creamos un objeto Latlng
         if(lat !='' && lng != '')
        {
           var latLng = new google.maps.LatLng(lat,lng);
        }
        else
        {
           var latLng = new google.maps.LatLng(4.710988599999999,-74.072092);
        }
        //Definimos algunas opciones del mapa a crear
         var myOptions = {
            center: latLng,//centro del mapa
            zoom: 15,//zoom del mapa
            mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc
          };
          //creamos el mapa con las opciones anteriores y le pasamos el elemento div
          map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
           
          //creamos el marcador en el mapa
          marker = new google.maps.Marker({
              map: map,//el mapa creado en el paso anterior
              position: latLng,//objeto con latitud y longitud
              draggable: true //que el marcador se pueda arrastrar
          });
          
         //función que actualiza los input del formulario con las nuevas latitudes
         //Estos campos suelen ser hidden
          updatePosition(latLng);
           
           
      }
       
      //funcion que traduce la direccion en coordenadas
      function codeAddress() {
           
          //obtengo la direccion del formulario
          var address = document.getElementById("direccion").value;
          //hago la llamada al geodecoder
          geocoder.geocode( { 'address': address}, function(results, status) {
           
          //si el estado de la llamado es OK
          if (status == google.maps.GeocoderStatus.OK) {
              //centro el mapa en las coordenadas obtenidas
              map.setCenter(results[0].geometry.location);
              //coloco el marcador en dichas coordenadas
              marker.setPosition(results[0].geometry.location);
              //actualizo el formulario      
              updatePosition(results[0].geometry.location);
               
              //Añado un listener para cuando el markador se termine de arrastrar
              //actualize el formulario con las nuevas coordenadas
              google.maps.event.addListener(marker, 'dragend', function(){
                  updatePosition(marker.getPosition());
              });
        } else {
            //si no es OK devuelvo error
            alert("No podemos encontrar la direcci&oacute;n, error: " + status);
        }
      });
    }
     
    //funcion que simplemente actualiza los campos del formulario
    function updatePosition(latLng)
    {
         
         jQuery('#lat').val(latLng.lat());
         jQuery('#long').val(latLng.lng());
     
    }
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1749329-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
	<div id="wrap">
	</br>
	</br>
		<a href="crearruta.php"><img src="img/logo1.png" width="100" height="100" border="0"></a> 
		<a href="diss.php"><img src="img/logo2.png" width="100" height="100" border="0"></a>
		<a href="#"><img src="img/logo3.png" width="100" height="100" border="0"></a>
	</div>
	</br>
	</br>
  </br>
  </br>
  </br>
  </br>
  </br>
  </br>
<div id="contenedor">
<div id="col_der">
<form id="google" name="google" action="#">
    <p><label>Direcci&oacute;n: </label>
    <div class="col-lg-12">
    <input class="form-control" type="text" id="direccion" name="direccion" value=""/><button type="submit" id="pasar" class="btn btn-primary pull-right">GO <span class="fa fa-arrow-right"></span></button>
      </div> 
    </p>
    <!-- div donde se dibuja el mapa-->
    <div id="map_canvas" style="width:300%;height:200px;"></div>
     <br>
    </form>
<form action="mensaje.php" method="POST"> 
    <p><label>Latitud: </label></br></p>
    <div class="col-lg-12">
      <input type="text" class="form-control" readonly name="lat" id="lat"/>
      </div>
    <p><label> Longitud:</label></p>
    <div class="col-lg-12">
      <input type="text" class="form-control" readonly name="lng" id="long"/>
      </div>
      <div class="col-lg-12">
    <button type="submit" class="btn btn-primary pull-right">Enviar <span class="fa fa-arrow-right"></span></button>
      </div>
    </form>

</div>
<div id="col_izq">
<form  action="msjinsersionrutas.php" method="POST">
  
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
  </br>
  </br>
    
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

  </br>
  </br>
  </br>
  </br>
  
  <button type="submit" class="btn btn-primary">Crear Ruta</button>
  
</form>
</div>
<div id="col_cen">
<div id="container-field"></div>
<div id="container-player"></div>
</div>

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
            .image(text.center('18px Josefin Slab', '#000', 1, 48))
            .then(function (img) {
              $('#drag<?php echo $i;?>').css("background","url('"+img.src+"')","border-radius","500px", "-webkit-border-radius", "150px", "-moz-border-radius", "150px");
            });

        }, 1000);
    });
</script>
<?php 
}
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="js/fastclick.js"></script>
<script src="js/scroll.js"></script>
<script src="js/fixed-responsive-nav.js"></script>
</body>
</html>