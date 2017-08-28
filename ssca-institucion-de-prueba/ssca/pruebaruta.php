<?php
    //conect
      require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
   ?>

<?php
        $valor = "1";
        include("connect.php");
        $query  = "SELECT coordenadas  FROM vehiculo where idvehiculo='".$valor."'";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $coordenadas = stripslashes($row['coordenadas']);
        }
        error_reporting(0);
?>
<?php
        $valor = "1";
        include("connect.php");
        $query  = "SELECT *  FROM asignacionruta where id='".$valor."'";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $nombre_ruta = ($row['nombreruta']);
        $monitor = ($row['monitor']);
        $conductor = ($row['id_conductor']);
        }
?>

<?php
        $valor = "1";
        include("connect.php");
        $query  = "SELECT *  FROM monitor where idmonitor='".$monitor."'";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $nombrem = ($row['nombre']);
        $apellidom = ($row['apellido']);
        }
?>

<?php
        $valor = "1";
        include("connect.php");
        $query  = "SELECT  *  FROM vehiculo where idvehiculo='".$valor."'";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $sillas = ($row['sillas']);
        $placa = ($row['placa']);
        }
?>
<?php
        $valor = "1";
        include("connect.php");
        $query  = "SELECT  *  FROM conductor where idconductor='".$conductor."'";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $nombrec = ($row['nombre']);
        $apellidoc = ($row['apellido']);
        }
?>
<?php
        $valor = "1";
        include("connect.php");
        $query  = "SELECT PrimerNombre, PrimerApellido  FROM usuarios INNER JOIN cart ON usuarios.NumeroId=cart.valores where cart.ruta='".$valor."'";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $PrimerNombre = ($row['PrimerNombre']);
        $PrimerApellido = ($row['PrimerApellido']);
        }
?>
<?php
        $valor = "1";
        include("conn.php");
            // Query
            try {
              $results = $db->query("SELECT latitud, longitud FROM usuarios INNER JOIN cart ON usuarios.NumeroId=cart.valores where cart.ruta='".$valor."'");
              if($count = $results->rowCount()) {
                while($row = $results->fetchAll(PDO::FETCH_ASSOC)) {  
                  $data[] = $row;
                  $cadena = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($data), ENT_NOQUOTES));
                  echo $cadena;
                }                
              }            
            } catch (Exception $e) {
              echo "no query happedend";
              exit;
            }       
?>
<?php
        $fecha_actual=date("Y-m-d");
        $valor = "1";
        include("connect.php");
        $query  = "SELECT * FROM log_ruta WHERE  hora=(SELECT max(hora) FROM log_ruta where idruta='".$valor."' and fecha='".$fecha_actual."')";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $coordenadas_recogida = ($row['coordenadas_recogida']);
        $dividir = explode(",", $coordenadas_recogida);
        $latitud = $dividir[0];
        $longitud = $dividir[1];
        }
?>
<?php
        $valor = "1";
        include("connect.php");
        $query  = "SELECT * FROM asignacionruta where id='".$valor."'";
        $result1 = mysql_query($query);
        while($row = mysql_fetch_array($result1, MYSQL_ASSOC))
        {        
        $PuntoOrigenlat = stripslashes($row['latorigen']);
        $PuntoOrigenlon = stripslashes($row['longorigen']);
        $PuntoDestinolat = stripslashes($row['latdestino']);
        $PuntoDestinolon = stripslashes($row['longdestino']);
        }
?>
<?php
//fecha actual
$fecha_actual=date("Y-m-d");
?>   
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">

    <title>Ssca</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/base.css" rel="stylesheet" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="js/drag/jquery-git2.min.js"></script>
  <script src="js/drag/jquery.event.drag-2.2.js"></script>
    <script src="js/drag/jquery.event.drag.live-2.2.js"></script>
    <script src="js/drag/jquery.event.drop-2.2.js"></script>
    <script src="js/drag/jquery.event.drop.live-2.2.js"></script>
    <script src="js/drag/excanvas.min.js"></script>
    <script src="js/drag/watermark-polyfill.js"></script>
    <script src="js/drag/ScriptMain.js"></script>
    <script src="js/drag/ConexionWebService.js"></script>
  <script type="text/javascript" src="js/alertify.js"></script>
    <link rel="stylesheet" href="css/alertify.core.css" />
    <link rel="stylesheet" href="css/alertify.default.css" />
    
    <style type="text/css">
      .footer {
      position: static;
      bottom: 0;
      width: 100%;
      /* Set the fixed height of the footer here */
      height: 20%;
      background-color: #f5f5f5;
    }
    </style>


  <script>
   //duplicado de curso
      $(document).ready(function () {
          $("#curso").keyup(function () {
              var value = $(this).val();
              $("#cursos").val(value);
          });
      });
</script>
<script>
   //duplicado de busqueda
      $(document).ready(function () {
          $("#busqueda").keyup(function () {
              var value = $(this).val();
              $("#busquedas").val(value);
          });
      });
</script>

<script>
   //duplicado de ruta
      $(document).ready(function () {
          $("#ruta").keyup(function () {
              var value = $(this).val();
              $("#rutas").val(value);
          });
      });
</script>
<script>
   //duplicado de monitor
      $(document).ready(function () {
          $("#monitor").keyup(function () {
              var value = $(this).val();
              $("#monitores").val(value);
          });
      });
</script>

<script>
//jquery
  $(function () {
    
    function doSomething(value) {
      $('#rutas').html('Selected Option: '+value);
    }
    
    $('#ruta').bind('change keyup',function () {
      //get value of selected option
      var value = $(this).children("option:selected").attr('value');
      doSomething(value);
    }).change();/*remove this ".change()" if you dont need it*/

    
  });

</script>

  <script type="text/javascript">
  //Declaramos las variables que vamos a user
  var lat = null;
  var lng = null;
  var map = null;
  var geocoder = null;
  var marker = null;

  var lat1 = null;
  var lng1 = null;
  var map1 = null;
  var geocoder1 = null;
  var marker1 = null;
           
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
     initialize()
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
      
      google.maps.event.addListener(marker, 'dragend', function(){
        updatePosition(marker.getPosition());
        console.log(marker.getPosition());
      });
          
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
          console.log(marker.getPosition());
              });
        } else {
            //si no es OK devuelvo error
            alert("No podemos encontrar la direcci&oacute;n, error: " + status);
        }
      });   
          
    }

    //funcion que traduce la direccion en coordenadas
      function codeAddress1() {
      //obtengo la direccion del formulario
          var address1 = document.getElementById("direccions").value;
          //hago la llamada al geodecoder
          geocoder.geocode( { 'address': address1}, function(results, status) {
           
          //si el estado de la llamado es OK
          if (status == google.maps.GeocoderStatus.OK) {
              //centro el mapa en las coordenadas obtenidas
              map1.setCenter(results[0].geometry.location);
              //coloco el marcador en dichas coordenadas
              marker1.setPosition(results[0].geometry.location);
              //actualizo el formulario      
              updatePosition1(results[0].geometry.location);
               
              //Añado un listener para cuando el markador se termine de arrastrar
              //actualize el formulario con las nuevas coordenadas
              google.maps.event.addListener(marker1, 'dragend', function(){
                  updatePosition1(marker1.getPosition());
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
    function updatePosition1(latLng)
    {
         jQuery('#lats').val(latLng.lat());
         jQuery('#longs').val(latLng.lng());
    }
</script>

<script>
function initMap() {
  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer;
  var map = new google.maps.Map(document.getElementById('map_canvas'), {
    zoom: 6,
    center: {lat: 4.710988599999999, lng: -74.072092}
  });
  directionsDisplay.setMap(map);

    //envio datos directos para visualizacion automatica
    calculateAndDisplayRoute(directionsService, directionsDisplay);
  
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
 var waypts=[];
 var origen = '<?php echo $PuntoOrigenlat.",".$PuntoOrigenlon; ?>';
 var destino = '<?php echo $PuntoDestinolat.",".$PuntoDestinolon; ?>';
 //variables latitud y longitud del bus 
 var lats = [<?php echo $latitud; ?>];
 var longs = [<?php echo $longitud; ?>];
 // arreglo de json en variable json
 var json = [<?php echo $cadena; ?>];
 //ciclo json con datos de coordenadas de estudiantes
 for (var i = json.length - 1; i >= 0; i--) {
   var latlon = new google.maps.LatLng(json[i].latitud,json[i].longitud);
    waypts.push({
          location: latlon,
          stopover: true
        }
  );
 }
      directionsService.route({
      origin: origen,
      destination: destino,
      waypoints: waypts,
      optimizeWaypoints: true,
      travelMode: google.maps.TravelMode.DRIVING
    }, 
  function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var summaryPanel = document.getElementById('map_canvas');
      summaryPanel.innerHTML = '';
      // For each route, display summary information.
    console.log('localizacion: ' + route.legs);
      for (var i = 0; i < route.legs.length; i++) {
        var routeSegment = i + 1;
      }
    } else {
      window.alert('No se encuentra la direccion ' + status);
    }
  });
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
            <div class="col-md-12">
                <h3 class="text-primary text-right">
                    Creacion de Rutas
                </h3>
            </div>
        </div>
        
  <div class="row">
      
     
  

            <input type="hidden" class="form-control" readonly name="lat" id="lat"/>
            <input type="hidden" class="form-control" readonly name="lng" id="long"/>
            <!--campos ocultos donde guardamos los datos--> 
            <input type="hidden" class="form-control" readonly name="lats" id="lats"/>
            <input type="hidden" class="form-control" readonly name="lngs" id="longs"/>
            <input type="hidden" class="form-control" id="cursos" name="cursos" readonly>
            <input type="hidden" class="form-control" id="busquedas" name="busquedas" readonly >
            <input type="hidden" class="form-control" id="rutas" name="rutas" readonly>
            <input type="hidden" class="form-control" id="monitores" name="monitores" readonly >        
    </div>
    
        
        
      
        
        
    
      <div class="col-md-4">

      <div class="row">
        <div class="col-md-12">
                    <!-- div donde se dibuja el mapa-->
                    <div id="map_canvas" style="width:100%;height:200px;"></div>
                    </br>
        </div>
      </div>
    </div>   
  </div>
        


<footer class="footer">
   <img alt="" src="images/logo.png" width="300" height="110"  border="0">
</footer>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="js/fastclick.js"></script>
<script src="js/scroll.js"></script>
  </body>
</html>