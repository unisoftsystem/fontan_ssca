<?php

    error_reporting(0);
    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    //sesion a variable
     $_SESSION['userid'] = $id;
    //fecha actual
    $fecha_actual=date("d/m/Y");
?>
<?php
        $_SESSION['usc']=$_GET["nombre"];

        $_SESSION['link']=$_GET["ruta"];
 
?>
<?php
        
        $valor = $_SESSION['link'];
        $usc = $_SESSION['usc'];


        $fechain = date("d/m/Y");

       
        error_reporting(0);
?>

<?php
        $valor = $_GET["ruta"];
        include("connect.php");
        $query  = "SELECT *  FROM asignacionruta where idruta='".$valor."'";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $rutaid = $row['id'];
        }
?>

<?php
        $valor = $rutaid;
        include("connect.php");
        $query  = "SELECT idruta  FROM asignacionruta where id='".$valor."'";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $ruta = $row['idruta'];
        }
?>
<?php
        $valor = $rutaid;
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
        $valor = $rutaid;
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
        $valor = $rutaid;
        include("connect.php");
        $query  = "SELECT  *  FROM vehiculo where idvehiculo='".$ruta."'";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $sillas = ($row['sillas']);
        $placa = ($row['placa']);
        }
?>
<?php
        $valor = $rutaid;
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
    $fechain = date("d/m/Y");
        $valor = $rutaid;
        include("connect.php");
        $query  = "SELECT PrimerNombre, PrimerApellido  FROM usuarios INNER JOIN cart ON usuarios.NumeroId=cart.valores where cart.ruta='".$valor."' and cart.fecha='".$fechain."'  ";
        $result = mysql_query($query);   
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $PrimerNombre = ($row['PrimerNombre']);
        $PrimerApellido = ($row['PrimerApellido']);
        }
?>
<?php
    $fechain = date("d/m/Y");
        include("conn.php");
        $valor = $rutaid;
            // Query
            try {
              $results = $db->query("SELECT latitud, longitud FROM usuarios INNER JOIN cart ON usuarios.NumeroId=cart.valores where cart.ruta='".$valor."' and cart.fecha='".$fechain."' ");
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
        $fecha_actual=date("Y-m-d");
        $valor = $rutaid;
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
        $valor = $rutaid;
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
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SSCA</title>
        <script type="text/javascript" src="js/ConexionWebService.js"></script>
        <script type="text/javascript" src="js/ValidacionUsuario.js"></script>
        <link href="css/style.css" rel="stylesheet"/>
        <link href="css/menu.css" rel="stylesheet"/>
        <link href="css/popup.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/style.js"></script>  
        <script type="text/javascript" src="js/ConexionWebService.js"></script>
        <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/alertify.js"></script>
        <link rel="stylesheet" href="css/alertify.core.css" />
        <link rel="stylesheet" href="css/alertify.default.css" />
        <script src="js/script.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="js/popup.js"></script>

        <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="dist/base.css" rel="stylesheet" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>


        <style type="text/css">
          #map {
        height: 90%;
        width: 95%;
        height: 90%;
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
       .mover{  
          position:relative;  
        top:40px;  
      } 
        </style>
  <script language=javascript>
        function frmSubmit(){
         document.myform.submit();
     }
  </script>
  
  
    </head>
    <body id="bodyBase" onload="setTimeout('frmSubmit()', 6000)">
        <form name="myform" method="GET" action="http://181.55.254.193/ssca/TrackingPadres2.php">
        <?php $valorpost = $_GET["ruta"]; ?>
        <input type="hidden" name="ruta" value="<?php echo $valorpost;?>">
        <input type="hidden" name="nombre" value="<?php echo $usc;?>">
        </form>
        <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Modulo Acudientes</h4>
        <h1 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Bienvenido</h1>
        <?php
        $query1  = "SELECT * FROM usuarios_sistema where  idUsuario='".$id."'";
        $result1 = mysql_query($query1);
        while($rows = mysql_fetch_array($result1, MYSQL_ASSOC))
        { 
        $permisos = stripslashes($rows['permisos']);
        }
        ?>
        <div id='cssmenu'>
        <ul>
            <li><a href='#' title="Credenciales"><h6><p class="full-circle"></p><span>Credenciales</span></h6></a>
                      <ul >
                           <li><a href='RecargadeCredenciales.php' title="Recarga de Credenciales"><span>Recarga de Credenciales</span></a></li> 
                           <li><a href='TransferenciadeFondos.php' title="Transferencia de Fondos"><span>Transferencia de Fondos</span></a></li>
                           <li><a href='EstadosdeCuenta.php' title="Estados de Cuenta"><span>Estados de Cuenta</span></a></li>
                      </ul>
            </li>
            <li><a href='#' title="Ruta Escolar"><h6><p class="full-circle"></p><span>Ruta Escolar</span></h6></a>
                      <ul >
                           <li><a href='diss.php' title="Tracking Ruta Escolar"><span>Tracking Ruta Escolar</span></a></li> 
                           <li><a href='BitacoradeUso.php' title="Bitacora de Uso"><span>Bitacora de Uso</span></a></li>
                           <li><a href='Mensajeria.php' title="Mensajeria"><span>Mensajeria</span></a></li> 
                           <li><a href='EnvioaCentrodeOperaciones.php' title="Envio a Centro de Operaciones"><span>Envio a Centro de Operaciones</span></a></li>
                      </ul>
            </li>
            <li><a href='#' title="Cafeteria y Restaurante"><h6><p class="full-circle"></p><span>Cafeteria y Restaurante</span></h6></a>
                      <ul>
                           <li><a href='RestriccionesdeConsumo.php' title="Restricciones de Consumo"><span>Restricciones de Consumo</span></a></li> 
                           <li><a href='PlanificaciondeConsumos.php' title="Planificacion de Consumos"><span>Planificacion de Consumos</span></a></li>
                      </ul>
            </li>
            <li><a href='#' title="Gestion Pagos"><h6><p class="full-circle"></p><span>Gestion Pagos</span></h6></a>
                      <ul>
                           <li><a href='SelecciondeProducto.php' title="Seleccion de Producto"><span>Seleccion de Producto</span></a></li> 
                           
                      </ul>
            </li>

        </ul>
        </div>
        <div class="contenidoBorde">
            </br>
            <center><h4 style="color:#09C;">Usuario: <?php echo $usc; ?></h4></center>


            <div class="col-md-12">
      <h3 class="text-primary">
        Mapa
      </h3>
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

      <div class="row">
        <div class="col-md-6">
          <div id="directions-panel"></div> 
          </br>
          </br>
          
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
    center: {lat: 41.85, lng: -87.65}
  });
  directionsDisplay.setMap(map);
calculateAndDisplayRoute(directionsService, directionsDisplay);
//selecciones de ruta y movimiento actual
var lats = [<?php echo $latitud; ?>];
var longs = [<?php echo $longitud; ?>]; 

 var latLng = new google.maps.LatLng(lats, longs);
        
        //Definimos algunas opciones del mapa a crear
         var myOptions = {
            center: latLng,//centro del mapa
            zoom: 15,//zoom del mapa
            mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc
          };
          
          //creamos el marcador en el mapa
          marker = new google.maps.Marker({
              map: map,//el mapa creado en el paso anterior
              position: latLng,//objeto con latitud y longitud
              icon: 'images/red-circle.png',
              draggable: false //que el marcador se pueda arrastrar
          });
         
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
  var waypts=[];

  var origen = '<?php echo $PuntoOrigenlat.",".$PuntoOrigenlon; ?>';
  var destino = '<?php echo $PuntoDestinolat.",".$PuntoDestinolon; ?>';
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
      }
    } else {
      window.alert('No se encuentra la direccion ' + status);
    }
  });
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJhwAnBcf7HiAk8mhenonqyOyXrmwh3g&signed_in=true&callback=initMap" async defer>
    </script>
       

        </div>     
    </body>
</html>