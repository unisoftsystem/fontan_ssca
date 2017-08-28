<?php
        $fecha_actual= date("Y/m/d");
        $valor = $_REQUEST["ruta"];
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
        $valor = $_REQUEST["ruta"];
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
        $valor = $_REQUEST["ruta"];
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
        $valor = $_REQUEST["ruta"];
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
        $valor = $_REQUEST["ruta"];
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
        $valor = $_REQUEST["ruta"];
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
        $valor = $_REQUEST["ruta"];
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="dist/base.css" rel="stylesheet" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
    <style type="text/css">
      .footer {
      position:fixed;
      bottom: 0;
      width: 100%;
      /* Set the fixed height of the footer here */
      height: 13%;
      background-color: #f5f5f5;
    }
      #map {
        height: 60%;
        width: 95%;
        height: 60%;
        position:absolute;
        z-index:1;
        outline: 1px solid black;
      }
        .checkbox { color:blue; }
        .checkbox:before { content:""; background-color:blue; width:15px; height:18px; display:block; position:absolute; margin-left:-20px; }
        .checkbox.checked { color:red; }
        .checkbox.checked:before { background-color:red; } 
        h2 {
             text-shadow: 0px 2px 3px #555;
           }
    </style>
  </head>
  <body >
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-12" style="background-color: #f5f5f5;">
    <img alt="Bootstrap Image Preview" src="img/HOME.png" width="200" height="100" border="0">

      <a href="creaciones.php" style="margin-left:25%;"><img src="img/logo1.png" width="100" height="100" border="1" ></a></center> 
      <a href="diss.php" ><img src="img/logo2.png" width="100" height="100" border="1" ></a>
      <a href="#" ><img src="img/logo3.png" width="100" height="100" border="1" ></a>
    </div>
    
  </div>
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-primary text-right">
        Tracking Tiempo Real
      </h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <h3 class="text-primary">
        Datos Ruta
      </h3>
      <hr>
      <h6>Nombre Ruta: <?php echo  $nombre_ruta; ?></h6>
      <hr>
      <h6>Conductor: <?php echo  $nombrec.' '.$apellidoc; ?></h6>
      <hr>
      <h6>Placa: <?php echo  $placa; ?></h6>
      <hr>
      <h6>Monitor: <?php echo  $nombrem.' '.$apellidom; ?></h6>
      <hr>
      <h6>Sillas: <?php echo  $sillas; ?></h6>
      <hr>
      <input type="button" value="Buscar otra ruta"  onClick=" window.location.href='seleccionrutatiemporeal.php'"  class="btn btn-primary btn-lg pull-right"/>
    <div>
    </br>
    </br>
    </div>
    </div>
      <div class="col-md-8">
      <h3 class="text-primary">
        Mapa
      </h3>
      <hr>
      <input type="submit" id="submit" class="btn btn-primary btn-lg" value="Visualizar Ruta">
      </br>
          <hr>
           <div id="map">
           </div>
      </br>
      <div class="row">
        <div class="col-md-12">
          <!-- div donde se dibuja el mapa-->
          <div id="map_canvas" style="width:100%;height:200px;"></div>
        </div>
      </div>

      
             
  </div>
</div>
<script>
function initMap() {
  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer;
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 6,
    center: {lat: 4.710988599999999, lng: -74.072092}
  });
  directionsDisplay.setMap(map);

  
    calculateAndDisplayRoute(directionsService, directionsDisplay);
  
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
  var waypts=[];

var origen = '<?php echo $PuntoOrigenlat.",".$PuntoOrigenlon; ?>';
var destino = '<?php echo $PuntoDestinolat.",".$PuntoDestinolon; ?>';
var lats = [<?php echo $latitud; ?>];
var longs = [<?php echo $longitud; ?>]; 
var latlon = new google.maps.LatLng(lats,longs);
    waypts.push({
          location: latlon,
          stopover: true
        }
  );

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
      var summaryPanel = document.getElementById('directions-panel');
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJhwAnBcf7HiAk8mhenonqyOyXrmwh3g&signed_in=true&callback=initMap" async defer>
    </script>
    <footer class="footer">
    <img alt="" src="img/logo.png" width="250" height="88"  border="0"></footer>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
</body>
</html>