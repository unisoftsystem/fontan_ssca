
<?php
        $valor = $_REQUEST["ruta"];

        include("connect.php");
        $query  = "SELECT coordenadas  FROM ruta where idruta='".$valor."'";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $coordenadas = stripslashes($row['coordenadas']);
        }
?>
<?php
        $valor = $_REQUEST["ruta"];
        include("connect.php");
        $query  = "SELECT nombre_ruta, sillas  FROM ruta where idruta='".$valor."'";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $nombre_ruta = ($row['nombre_ruta']);
        $sillas = ($row['sillas']);
        }
?>
<?php
        $valor = $_REQUEST["ruta"];
        include("connect.php");
        $query  = "SELECT PrimerNombre, PrimerApellido  FROM usuarios where ruta_idruta='".$valor."'";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $PrimerNombre = ($row['PrimerNombre']);
        $PrimerApellido = ($row['PrimerApellido']);
        }
?>
<?php
        include("conn.php");
            // Query
            try {
              $results = $db->query("SELECT latitud, longitud FROM usuarios where ruta_idruta='".$valor."'");
              if($count = $results->rowCount()) {
                while($row = $results->fetchAll(PDO::FETCH_ASSOC)) {  
                  $data[] = $row;
                  $cadena = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($data), ENT_NOQUOTES));
                }                
              }            
            } catch (Exception $e) {
              echo "no query happedend";
              exit;
            }       
?>
<?php
        include("connect.php");
        $query  = "SELECT * FROM planeacionruta where IdRuta='".$valor."'";
        $result1 = mysql_query($query);
        while($row = mysql_fetch_array($result1, MYSQL_ASSOC))
        {        
        $PuntoOrigen = stripslashes($row['PuntoOrigen']);
        $PuntoDestino = stripslashes($row['PuntoDestino']);
        }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Mapa Ruta</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        float: left;
        width: 70%;
        height: 100%;
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
        border-width: 2px;
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
    </style>
  </head>
  <body>
    <div id="map"></div>
    <div id="right-panel">
    <h3>Nombre Ruta: <?php echo  $nombre_ruta; ?></h3>
    <h3>Sillas: <?php echo  $sillas; ?></h3>
    <input type="button" value="Buscar otra ruta"  onClick=" window.location.href='buscarrutas.php'"  class="btn btn-primary pull-right"/>
    <div>
    </br>
    </br>
    <input type="submit" id="submit" class="btn btn-primary pull-right" value="Consultar Ruta">
    </div>
    <div id="directions-panel"></div>
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

  document.getElementById('submit').addEventListener('click', function() {
    calculateAndDisplayRoute(directionsService, directionsDisplay);
  });
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
  var waypts=[];

  var origen = '<?php echo $PuntoOrigen; ?>';
  var destino = '<?php echo $PuntoDestino; ?>';
  // arreglo de json en variable json
 var json = [<?php echo $cadena; ?>]; 
 //alert(json[0].latitud);  
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
      var summaryPanel = document.getElementById('directions-panel');
      summaryPanel.innerHTML = '';
      // For each route, display summary information.
	  console.log('localizacion: ' + route.legs);
      for (var i = 0; i < route.legs.length; i++) {
        var routeSegment = i + 1;
        summaryPanel.innerHTML += '<b>Punto: ' + routeSegment +
            '</b><br>';
        summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
        summaryPanel.innerHTML += route.legs[i].distance.text + '<br>';
        summaryPanel.innerHTML += '<b>Estudiante: ' + '<?php echo $PrimerNombre; ?>' + '</b><br>';
      }
    } else {
      window.alert('No se encuentra la direccion ' + status);
    }
  });
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJhwAnBcf7HiAk8mhenonqyOyXrmwh3g&signed_in=true&callback=initMap" async defer></script>
  </body>
</html>