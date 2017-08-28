<?php
/* Empezamos la sesión */
    

    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    
    //fecha actual
    $fecha_actual=date("d/m/Y");

    $variable_user = $_GET['proced']; 

?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SSCA</title>
        
        <link rel="stylesheet" href="css/styles.css"/>
<link rel="stylesheet" href="css/styles.css"/>
<link href="css/style.css" rel="stylesheet"/>
<link href="css/menu.css" rel="stylesheet"/>
<link href="css/styleQR.css" rel="stylesheet"/>
<link href="css/popup.css" rel="stylesheet"/>
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/style.js"></script>  
<script type="text/javascript" src="js/ConexionWebService.js"></script>
<script type="text/javascript" src="js/ValidacionUsuario.js"></script>
<link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/alertify.js"></script>
<link rel="stylesheet" href="css/alertify.core.css" />
<link rel="stylesheet" href="css/alertify.default.css" />
<script src="js/script.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/photobooth.js"></script>


        <style type="text/css">
          #map {
            width: 100%;
            height: 400px;
            z-index:1;
            outline: 1px solid black;
          }
          h2 {
                 text-shadow: 0px 2px 3px #555;
             }
        </style>
	       
	<script type="text/javascript">
        function fetch(val)
        {
           $.ajax({
             type: 'post',
             url: 'fecn.php',
             data: {
               get_option:val
             },
             success: function (response) {
                $("#ruta").html(response)
               //document.getElementById("ruta").innerHTML=response; 
         console.log(response);
         if($.trim(response)){
          $("#submit").css({"display":"block"})
        }else{
          $("#submit").css({"display":"none"})
        }
             }
           });
        }
        
        
        </script>
	
    </head>
    <body id="bodyBase">
   
<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Modulo Consulta de Saldo Credenciales</h4>
<h4 align="right" style="color:#FFF;margin-left:10px; margin-top:5px; margin-right: 10px">Bienvenido(a): <label id="usuarioSesion" style="color:#FFF"></label></h4>      
<br>
<h2 align="right" style="margin-top:2%; margin-right:2%; color:#09C">CONSULTA DE RUTA ESCOLAR</h2>

       
        <div id='cssmenu'>
            <ul>
               <li class='' style="display:none" id="AdminCredenciales" class="desactive"><a href='#' title="Admin.Credenciales">ADMINISTRACIÓN DE CREDENCIALES</a>
                  <ul style="margin-right:-42%">
                     <li id="ReemplazoCredencial" style="display:none"><a href='ReemplazarCredencial.html' title="Reemplazo de credenciales">Reemplazo de credenciales</a></li>
                     <li class='last'><a href='AdminCredencial.html' title="Cambio de Estado">CAMBIO DE ESTADO</a></li>
                     <li class='last'><a href='ConsultaMovimientosAcudiente.html' title="Consulta de Movimientos">CONSULTA DE MOVIMIENTOS</a></li>
                     <li class='last'><a href='ConsultaSaldo.html' title="Consulta de Saldos">CONSULTA DE SALDOS</a></li>
                     <li class='last'><a href='ServicioProximoRecargaLinea.php' title="Recarga en Linea">RECARGA EN LINEA</a></li>
                     <li class='last'><a href='TrasladoCredencialAcudiente.html' title="Traslado de Fondos entre Credenciales">TRASLADO DE FONDOS ENTRE CREDENCIALES</a></li>
                  </ul>
               </li>
               
               <li class="" id="RutaEscolar" style="display:none" class="desactive"><a href='#' title="Ruta Escolar">RUTA ESCOLAR</a>
                    <ul style="margin-right:-42%">
                        <li><a href='EnvioMensajesMonitor.html' title="Envío de Mensajes">ENVÍO DE MENSAJES</a></li>
                        <li class='last' title="Tracking"><a href="javascript:void(0);" onclick="enviar_variables();">TRACKING</a></li>
                        <li><a href='#' title="Información de la Ruta">INFORMACIÓN DE LA RUTA</a></li>
                    </ul>
               </li>
               <li class="" id="RestriccionConsumo" style="display:none" class="desactive"><a href='#' title="Restricci&oacute;n de Consumo">RESTRICCI&Oacute;N DE CONSUMO</a>
                    <ul style="margin-right:-42%">
                      <li><a href='RestriccionConsumoValor.html' title="Restricciones por Valor">RESTRICCIONES POR VALOR</a></li>
                      <li><a href='RestriccionConsumoProducto.html' title="Restricciones por Producto">RESTRICCIONES POR PRODUCTO</a></li>
                  </ul>
               </li>
                <li class="" id="RestauranteAcudientes" style="display:none" class="desactive">
                  <a href='#' title="Restaurante">RESTAURANTE</a>
                  <ul style="margin-right:-42%">
                    <li>
                      <a href='MenuSemanal.html' title="Menú Semanal"> 
                        MENÚ SEMANAL
                      </a>
                    </li>
                  </ul>
                </li>              
               
                <li class="" id="Modificacion Datos Perfil" style="display:none" class="desactive"><a href='ModificarAcudiente.html' title="Modificacion Datos Perfil">Modificacion Datos Perfil</a>
                    <ul style="margin-right:-42%">    
                    </ul>
                 </li>
               <li class="" id="Salir"><a href='#' title="Cerrar Sesi&oacute;n">CERRAR SESI&Oacute;N</a>
                    <ul style="margin-right:-42%">
                        
                    </ul>
               </li>
            </ul>

          

        </div>
        <div class="contenidoBorde">
            </br>
           
           
              <?php 
                
              ?>
            <div class="form-group">
           <form  action="TrackingPadres2.php" method="GET">
              <label>Seleccione el estudiante</label>
              <select class="form-control" name="tipo" id="tipo" onchange="fetch(this.value);" required > 
	                          <option>
                             seleccione
                           </option>
                           <?php
                             $select=mysql_query("SELECT * FROM usuarios where idAcudiente='".$variable_user."'");
                             while($row=mysql_fetch_array($select))
                             {
                              echo "<option  value=\"".$row['NumeroId']." \" >".$row['PrimerApellido']." ".$row['SegundoApellido']." ".$row['PrimerNombre']." ".$row['SegundoNombre']."</option>";
                             }
                           ?>


      </select>
  <label>Seleccione la ruta</label>    
	<select class="form-control" id="ruta" name="ruta" onchange="fetch_select(this.value); required">
                           
                          </select>

        <input type="hidden" id="nombre" name="nombre" value="<?php echo $variable_user;?>">
   		
      </br>
       <input type="button" id="submit" class="btn btn-primary btn-lg" title="Consultar Ruta" value="Consultar Ruta" style="display:none">
    </form>
    </div>




 <center><div id="map"></div></center>


<script>
var map;
var marker;
var markers = [];
var markers_bajada = [];
var directionsService;
var directionsDisplay;
var interval;
function initMap() {
        
    directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer;
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 6,
      center: {lat: 4.710988599999999, lng: -74.072092}
    });
    
    directionsDisplay.setMap(map);

    document.getElementById('submit').addEventListener('click', function() {
    var idruta = $("#ruta").val()
    $.post("ActionMostrarDatosRuta.php", {idruta:idruta})
    .done(function( data ) {
      console.log(data)
      var json = JSON.parse(data);
       
      var CoordenadasOrigenRuta = json.latorigen + "," + json.longorigen;
      var CoordenadasDestinoRuta = json.latdestino + "," + json.longdestino;
      
      calculateAndDisplayRoute(directionsService, directionsDisplay, CoordenadasOrigenRuta, CoordenadasDestinoRuta);
      interval = setInterval(function(){ 
        var ruta = $("#ruta").val();
        MostrarBus(ruta)  
      }, 500);
      MostrarBajada(idruta, $("#tipo").val())  
      
    });
  })
    
  }


  function calculateAndDisplayRoute(directionsService, directionsDisplay, CoordenadasOrigenRuta, CoordenadasDestinoRuta) {
  
          var waypts=[];

          var origen = CoordenadasOrigenRuta;
          var destino = CoordenadasDestinoRuta;
          
          var datos = {
            idruta: $("#ruta").val()
          } 
          $.post("../Fontan/index.php/rutas/ObtenerCoordenadasRuta", datos)
          .done(function( data ) {
            
            if($.trim(data) != "[]"){
             
              var json = JSON.parse(data);
              
              $.each(json, function(i, item) {
                var latlon = new google.maps.LatLng(json[i].latitud,json[i].longitud);
                waypts.push({
                  location: latlon,
                  stopover: false
                });
              });
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
                  
                } else {
                  window.alert('No se encuentra la direccion ' + status);
                }
              });
              console.log(origen + " " + destino)
            }
          });
        }

        function MostrarBus(idruta){
          var datos = {
            idruta: idruta
          } 
          $.post("ActionObtenerCoordenadasBus.php", datos)
          .done(function( data ) {console.log(data)
            deleteMarkers();
            if($.trim(data) != "[]"){
              var json = JSON.parse(data);      
              
              var datosBus = json.coordenadas_recogida;
              var coordenadas = datosBus.split(",");
              var lats = parseFloat(coordenadas[0]);
              var longs = parseFloat(coordenadas[1]);; 

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
                icon: 'img/icon-bus.png',
                draggable: false //que el marcador se pueda arrastrar
              });
              
              markers.push(marker);

            }else{
              
            }
          });
        }

        function MostrarBajada(idruta, tipo){
          var datos = {
            idruta: idruta,
            documento: tipo
          } 
          $.post("ActionObtenerCoordenadasDescenso.php", datos)
          .done(function( data ) {console.log(data)
            deleteMarkersBajada();
            if($.trim(data) != "[]"){
              var json = JSON.parse(data);

              for (var i = 0; i < json.length; i++) {
                var datos_bajada = json[i].coordenadas_recogida;
                var coordenadas = datos_bajada.split(",");
                var lats = parseFloat(coordenadas[0]);
                var longs = parseFloat(coordenadas[1]);

                var latLng = new google.maps.LatLng(lats, longs);

                var myOptions = {
                  center: latLng,//centro del mapa
                  zoom: 15,//zoom del mapa
                  mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc
                };

                //creamos el marcador en el mapa
                marker = new google.maps.Marker({
                  map: map,//el mapa creado en el paso anterior
                  position: latLng,//objeto con latitud y longitud
                  icon: 'img/back.png',
                  draggable: false //que el marcador se pueda arrastrar
                });
                
                markers_bajada.push(marker);
              }     


            }else{
              
            }
          });
        }
        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
          for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
          }
        }
        // Sets the map on all markers in the array.
        function setMapOnAllBajada(map) {
          for (var i = 0; i < markers_bajada.length; i++) {
            markers_bajada[i].setMap(map);
          }
        }
         // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
          setMapOnAll(null);
        }
        // Removes the markers from the map, but keeps them in the array.
        function clearMarkersBajada() {
          setMapOnAllBajada(null);
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
          clearMarkers();
          markers = [];
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkersBajada() {
          clearMarkersBajada();
          markers_bajada = [];
        }
 window.addEventListener('load',init);
      function init(){
        var usuarioSesion = localStorage.getItem("primernombreusuario") + " " + localStorage.getItem("segundonombreusuario") + " " + localStorage.getItem("primerapellidousuario") + " " + localStorage.getItem("segundoapellidousuario"); 
        console.log(usuarioSesion);
        $("#usuarioSesion").html(usuarioSesion);
      }
      $("#Salir").click(function(e) {
        var confirmar = window.confirm("¿Desea cerrar sesión?");
        if(confirmar){
          localStorage.removeItem("usuario");
          localStorage.removeItem("tipoUsuario");
          localStorage.removeItem("primernombreusuario");
          localStorage.removeItem("segundonombreusuario");
          localStorage.removeItem("primerapellidousuario");
          localStorage.removeItem("segundoapellidousuario");
          window.location.href = "index.html";
        }
      });

      function enviar_variables(){
        var usuarioSesion = localStorage.getItem("usuario");
        location.href="TrackingPadres.php?proced="+ usuarioSesion;
      } 
</script>


        </div> 

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJhwAnBcf7HiAk8mhenonqyOyXrmwh3g&signed_in=true&callback=initMap" async defer></script>
              
    </body>
</html>