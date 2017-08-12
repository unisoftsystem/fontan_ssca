<?php
/* Empezamos la sesión */
    

    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    
    //fecha actual
    $fecha_actual=date("d/m/Y");

?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SSCA</title>
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
        <script type="text/javascript" src="js/ConexionWebService.js"></script>
        <script type="text/javascript" src="js/ValidacionUsuario.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="dist/base.css" rel="stylesheet" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>


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
         function prueba() {
         var usuarioSesion = localStorage.getItem("usuario");
         alert(usuarioSesion);
         }
         </script>
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
         <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Modulo Acudientes</h4>
        <h4 align="right" style="color:#FFF;margin-left:10px; margin-top:5px; margin-right: 10px">Bienvenido(a): <label id="usuarioSesion" style="color:#FFF"></label></h4>
       
        <div id='cssmenu'>
        <ul>
               <li class="" id="AdminUsuarios" style="display:none"><a href='#' title="Admin.Usuarios"><h6><p class="full-circle"></p><span>Admin.Usuarios</span></h6></a>
                    <ul style="margin-right:-42%">
                         <li><a href='#' title="Usuarios Plataforma"><span>Usuarios Plataforma</span></a></li>
                         <li class='last' title="Usuarios Aplicaciones"><a href='AdminUsuariosAplicaciones.html'><span>Usuarios Aplicaciones</span></a></li>
          </ul>
               </li>
               <li class='' style="" id="AdminCredenciales"><a href='#' title="Admin.Credenciales"><h6><p class="full-circle"></p><span>Administración de Credenciales</span></h6></a>
                  <ul style="margin-right:-42%">
                     <li id="ReemplazoCredencial" style="display:none"><a href='ReemplazarCredencial.html' title="Reemplazo de credenciales"><span>Reemplazo de credenciales</span></a></li>
                     <li class='last'><a href='AdminCredencial.html' title="Cambio de Estado"><span>Cambio de Estado</span></a></li>
                     <li class='last'><a href='ConsultaMovimientosAcudiente.html' title="Consulta de Movimientos"><span>Consulta de Movimientos</span></a></li>
                     <li class='last'><a href='ConsultaSaldo.html' title="Consulta de Saldos"><span>Consulta de Saldos</span></a></li>
                     <li class='last'><a href='ServicioProximoRecargaLinea.php' title="Recarga en Linea"><span>Recarga en Linea</span></a></li>
                     <li class='last'><a href='TrasladoCredencialAcudiente.html' title="Traslado de Fondos entre Credenciales"><span>Traslado de Fondos entre Credenciales</span></a></li>
                  </ul>
               </li>
               <li class='' id="Liquidacion" style="display:none"><a href='#' title="Liquidaci&oacute;n y Pagos"><h6><p class="full-circle"></p><span>Liquidaci&oacute;n y Pagos</span></h6></a>
                  <ul style="margin-right:-42%">
                    
                  </ul>
               </li>
               <li class='' id="PuntosRecargue" style="display:none"><a href='#' title="Puntos de Recarga"><h6><p class="full-circle"></p><span>Puntos de Recarga</span></h6></a>
                  <ul style="margin-right:-42%">
                     
                  </ul>
               </li>
               <li class='' id="CentroOperacion" style="display:none"><a href='#' title="Centro - Operaciones Rutas"><h6><p class="full-circle"></p><span>Centro - Operaciones Rutas</span></h6></a>
                    <ul style="margin-right:-42%">
                         <li><a href='' title="Vehiculos"><span>Vehiculos</span></a></li>
                         <li><a href='#' title="Conductores"><span>Conductores</span></a></li>
                         <li><a href='#' title="Monitores"><span>Monitores</span></a></li>
                         <li><a href='#' title="v"><span>Rutas</span></a></li>
                         <li><a href='#' title="Centro de Pagos"><span>Centro de Pagos</span></a></li>
                         <li class='last' title="Tracking"><a href="javascript:void(0);" onclick="enviar_variables();"><span>Tracking</span></a></li>
                         
                    </ul>
               </li>

               

               <li class="" id="RutaEscolar" style=""><a href='#' title="Ruta Escolar"><h6><p class="full-circle"></p><span>Ruta Escolar</span></h6></a>
                    <ul style="margin-right:-42%">
                        <li><a href='EnvioMensajesMonitor.html' title="Envío de Mensajes"><span>Envío de Mensajes</span></a></li>
                        <li class='last' title="Tracking"><a href="javascript:void(0);" onclick="enviar_variables();"><span>Tracking</span></a></li>
                        <li><a href='#' title="Información de la Ruta"><span>Información de la Ruta</span></a></li>
                    </ul>
               </li>
               <li class="" id="RestriccionConsumo" style=""><a href='#' title="Restricci&oacute;n de Consumo"><h6><p class="full-circle"></p><span>Restricci&oacute;n de Consumo</span></h6></a>
                    <ul style="margin-right:-42%">
                        <li><a href='RestriccionConsumoValor.html' title="Restricciones por Valor"><span>Restricciones por Valor</span></a></li>
            <li><a href='RestriccionConsumoProducto.html' title="Restricciones por Producto"><span>Restricciones por Producto</span></a></li>
          </ul>
               </li>
               <li class="" id="RestauranteAcudientes" style="">
                <a href='#' title="Restaurante">
                  <h6><p class="full-circle"></p><span>Restaurante</span></h6>
                </a>
                <ul style="margin-right:-42%">
                  <li>
                    <a href='MenuSemanal.html' title="Menú Semanal"> 
                      <span>Menú Semanal</span>
                    </a>
                  </li>
                </ul>
              </li>
               <li class="" id="RecargueCredencial" style="display:none"><a href='ProcesoRecaudo.html' title="Recargue de Credenciales"><h6><p class="full-circle"></p><span>Recargue de Credenciales</span></h6></a>
                    <ul style="margin-right:-42%">
                        
          </ul>
               </li>
               <li class="" id="Reportes" style="display:none"><a href='ReporteRecaudo.html' title="Reportes"><h6><p class="full-circle"></p><span>Reportes</span></h6></a>
                    <ul style="margin-right:-42%">
                        
          </ul>
               </li>
              <li class="" id="Modificacion Datos Perfil" style="display:none"><a href='ModificarAcudiente.html' title="Modificacion Datos Perfil"><h6><p class="full-circle"></p><span>Modificacion Datos Perfil</span></h6></a>
                  <ul style="margin-right:-42%">    
                  </ul>
               </li>
               <li class="" id="Salir"><a href='#' title="Cerrar Sesi&oacute;n"><h6><p class="full-circle"></p><span>Cerrar Sesi&oacute;n</span></h6></a>
                    <ul style="margin-right:-42%">
                        
                    </ul>
               </li>
            </ul>
        </div>
        <div class="contenidoBorde">
<div id="map"></div>
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

   
    
  }

  function calculateAndDisplayRoute(directionsService, directionsDisplay, CoordenadasOrigenRuta, CoordenadasDestinoRuta) {
  
          var waypts=[];

          var origen = CoordenadasOrigenRuta;
          var destino = CoordenadasDestinoRuta;
          
          var datos = {
            idruta: $("#ruta").val()
          } 
          $.post("ActionObtenerCoordenadasRuta.php", datos)
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
            //deleteMarkers();
            if($.trim(data) != "[]"){
              var json = JSON.parse(data);      
              
              var datosBus = json[0].coordenadas_recogida;
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
        
        <script>
        
        </script> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJhwAnBcf7HiAk8mhenonqyOyXrmwh3g&signed_in=true&callback=initMap" async defer></script>
              
    </body>
</html>