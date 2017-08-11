<?php
    $UserName = $this->session->userdata('UserNameInternoSSCA');
    if(empty($UserName)) { // Recuerda usar corchetes.
        header('Location: ' . base_url());
    }
?>
<style>  
  #commentForm label.error {
    margin-left: 10px;
    width: auto;
    display: inline;
    color:#F00;
    font-size:12px;
  }
  #bodyBase{
    background-image:none;
    overflow:auto; 
  }
  label.errorDato{
    width: auto;
    display: inline;
    color:#F00;
    font-size:12px;
  }
  .footer {
    position:relative;
    bottom: 0;
    left: 0;
    width: 100%;
    /* Set the fixed height of the footer here */
    height: 13%;
    background-color: #f5f5f5;
  }
  .clearFix
    {
        clear:both;
    }
    .panel.panel-chat
    {
        position: fixed;
        bottom:0;
        right:0;
        max-width: 350px;
        width: 350px;
        box-shadow: none;
        -webkit-box-shadow: none; 
        z-index: 1;                 
    }
    
    .panel-heading{
        padding: 10px 10px 10px 10px;
    }
    .panel.panel-chat .panel-heading
    {
        background: #4b67a8;
        border: 1px solid #2e4588;
        color:#FFF;
    }
    
    .panel.panel-chat
    {
        display: block;
        padding: 0;
        margin: 0;
        border-left: 1px solid #b2b2b2;
        border-right: 1px solid #b2b2b2;
        background: #EDEFF4;
        overflow: auto;
    }
    .panel-body
    {
        display: block;
        padding: 0;
        margin: 0;
        max-height: 350px;
        height: 350px;
        border-left: 1px solid #b2b2b2;
        border-right: 1px solid #b2b2b2;
        overflow: auto;
    }
    
    .panel.panel-chat .panel-body .messageMe
    {
        border-bottom:1px dotted #b2b2b2;
         margin-top: 10px;
    }
    .panel.panel-chat .panel-body .messageMe img
     {
         float:left;
         width: 50px;             
        max-height: 50px;
     }
    .panel.panel-chat .panel-body .messageMe span
    {
        display: block;
        float:left;
        padding: 5px;
        background: #FFF;
        min-height: 50px;
        max-width: 90%;
        height: 50px;
        width: 100%;
        word-break: break-all;
    }
    .panel.panel-chat .panel-body .messageHer
    {
        border-bottom:1px dotted #b2b2b2;
         margin-top: 10px;
    }
    .panel.panel-chat .panel-body .messageHer img
    {
        float:right;
        max-width: 10%;
         max-height: 50px;
    }
    .panel.panel-chat .panel-body .messageHer span
    {
        display: block;
        float:right;
        padding: 5px;
        background: #A9D0F5;
        min-height: 50px;
        max-width: 90%;
        width: auto;
        height: 50px;
        width: 100%;
        word-break: break-all;
    }
    .panel.panel-chat .panel-footer
    {
        padding: 0;
        margin: 0;
        border: 1px solid #b2b2b2;
        max-height: 75px;
        height: 37px;
        resize: none;
        bottom: 0;
    }
    .panel.panel-chat .panel-footer textarea
    {
        margin-bottom: -5px;
        resize: none;
        width: 100%;
        height: 100%;
    }

    .chat-box
    {
        width: 100%;
    }

    .header
    {
        padding: 10px;
        color: white;
        font-size: 14px;
        font-weight: bold;
        background-color: #6d84b4;
    }

    

    .panel-body ul
    {
        padding: 0px;
        list-style-type: none;
    }

    .panel-body ul li
    {
        height: auto;
        margin-bottom: 10px;
        clear: both;
        padding-left: 10px;
        padding-right: 10px;
    }

    .panel-body ul li img
    {
        display: inline-block;
        max-width: 15%;
        width: 15%;  
        float: left;       
    }

    .panel-body ul li span
    {
        display: inline-block;
        max-width: 80%;
        background-color: white;
        padding: 5px;
        border-radius: 4px;
        position: relative;
        border-width: 1px;
        border-style: solid;
        border-color: grey;
        text-align: left;
    }

    .panel-body ul li span.left
    {
        float: left;
        background-color: #fff;
        left:10px;
        top: 6px;
        bottom: 5px;
    }

    .panel-body ul li span.left:after
    {
        content: "";
        display: inline-block;
        position: absolute;
        left: -8px;
        top: 6px;
        height: 0px;
        width: 0px;
        border-top: 8px solid transparent;
        border-bottom: 8px solid transparent;
        border-right: 8px solid #fff;
    }

    .panel-body ul li span.left:before
    {
        content: "";
        display: inline-block;
        position: absolute;
        left: -9px;
        top: 6px;
        height: 0px;
        width: 0px;
        border-top: 8px solid transparent;
        border-bottom: 8px solid transparent;
        border-right: 8px solid black;
    }

    .panel-body ul li span.right:after
    {
        content: "";
        display: inline-block;
        position: absolute;
        right: -8px;
        top: 6px;
        height: 0px;
        width: 0px;
        border-top: 8px solid transparent;
        border-bottom: 8px solid transparent;
        border-left: 8px solid #dbedfe;
    }

    .panel-body ul li span.right:before
    {
        content: "";
        display: inline-block;
        position: absolute;
        right: -9px;
        top: 6px;
        height: 0px;
        width: 0px;
        border-top: 8px solid transparent;
        border-bottom: 8px solid transparent;
        border-left: 8px solid black;
    }

    .panel-body ul li span.right
    {
        float: right;
        background-color: #dbedfe;
        top: 6px;
    }

    .clear
    {
        clear: both;
    }
    .windowHidden{
        position: absolute; 
        bottom: 0;
        right: 720px;
    }
    .windowHidden > li > ul > li:hover{
        background: #4b67a8;
        border: 1px solid #2e4588;
        color:#FFF;
        cursor: pointer;
    }

    .windowHidden > li > ul > li{
        padding: 10px;
    }

    .windowHidden > li > ul{
        width: 100%;
    }
    #tablaOrden{
      /*border-collapse: seperate;*/
      border-spacing: 5px;
      width: 100%;
      font-size: 12px;
    }

    #tablaOrden td{
      padding: 0px;

    }
    #tablaOrden thead > tr > td{
      padding: 5px;
    }
    #tablaOrden tbody > tr > td{
      padding: 3px;
      border: 1px solid #ccc;;
    }
    #tablaOrden thead, tbody { display: block; width: 100%}

    #tablaOrden tbody {
      height: 170px;       /* Just for the demo          */
      overflow-y: auto;    /* Trigger vertical scroll    */
      overflow-x: hidden;  /* Hide the horizontal scroll */
    }
</style>
<script src="<?= base_url();?>js/drag/jquery-git2.min.js"></script>
<script src="<?= base_url();?>js/drag/jquery.event.drag-2.2.js"></script>
<script src="<?= base_url();?>js/drag/jquery.event.drag.live-2.2.js"></script>
<script src="<?= base_url();?>js/drag/jquery.event.drop-2.2.js"></script>
<script src="<?= base_url();?>js/drag/jquery.event.drop.live-2.2.js"></script>
<script src="<?= base_url();?>js/drag/excanvas.min.js"></script>
<script src="<?= base_url();?>js/drag/watermark-polyfill.js"></script>

<body id="bodyBase">
  <ul class="nav navbar-nav windowHidden" style="display: none;">                
        <li class="dropup">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="background: #4b67a8;
        border: 1px solid #2e4588; color:#FFF;width: 350px; height: 42px; border-radius: 2px"><i class="fa fa-chevron-up"></i></a>
            <ul class="dropdown-menu">
            </ul>
        </li>
    </ul>    
  </br>
  <input type="hidden" id="txtUserId" name="txtUserId" value="<?= $this->session->userdata('UserIDInternoSSCA');?>" /> 

  <div class="container-fluid">

    <!--campos ocultos donde guardamos los datos--> 
    <input type="hidden" class="form-control" readonly name="lat" id="lat"/>
    <input type="hidden" class="form-control" readonly name="lng" id="long"/>    
    <input type="hidden" class="form-control" readonly name="lats" id="lats"/>
    <input type="hidden" class="form-control" readonly name="lngs" id="longs"/>
    <input type="hidden" class="form-control" id="cursos" name="cursos" readonly>
    <input type="hidden" class="form-control" id="busquedas" name="busquedas" readonly >
    <input type="hidden" class="form-control" id="rutas" name="rutas" readonly>
    <input type="hidden" class="form-control" id="monitores" name="monitores" readonly >        
    <form class="cmxform" method="POST" action="" id="">
      <div class="row">
         <div class="col-md-12" style="background-image: url('<?= base_url();?>img/www logo rutas escolares.png'); background-repeat: no-repeat; background-size: 100% 100%; padding-top: 10px; padding-bottom: 10px; height: 192px" align="center">

            <a style="position: absolute; bottom: -6px; right: 410px" href="<?= base_url();?>index.php/rutas/nuevo"><img src="<?= base_url();?>img/www creacion ruta escolar.png" width="100px" height="100px"></a>&nbsp;

            <a style="position: absolute; bottom: -6px; right: 300px" href="<?= base_url();?>index.php/rutas/editar"><img src="<?= base_url();?>img/www modificarcion ruta escolar.png" width="100px" height="100px" border="0"></a>

            <a style="position: absolute; bottom: -30px; right: 190px; border: 5px solid #f59540; border-radius: 100%; padding: 0px" href="<?= base_url();?>index.php/rutas/obtener"><img src="<?= base_url();?>img/www tracking ruta escolar.png" width="100px" height="100px" border="0"></a>

            <a style="position: absolute; bottom: -6px; right: 80px" href="<?= base_url();?>index.php/usuarios_sistema/homeInternoModulos"><img src="<?= base_url();?>img/www menu anterior.png" width="100px" height="100px" border="0"></a><br>

        </div>
      </div>
      
      
      <br><br><br>
      <div class="row">   
        <div class="col-md-12" style="border: 3px solid #fff1c5;margin-bottom: 10px;width: 97.5%;margin-left: 15px;margin-right: 15px;">
          <table width="100%" border="0" style="margin-top: 5px; margin-left: -5px" id="tablaOrden">
            <thead style="width: 98.7%;">
              <tr style="background-color: #fff1c5">
                <td style="width: 6%;" align="center">Color</td>
                <td style="width: 20%;" align="center">Nombre de la Ruta</td>
                <td style="width: 20%;" align="center">Conductor</td>
                <td style="width: 15%;" align="center">Monitor</td>
                <td style="width: 10%;" align="center">Vehículo</td>
                <td style="width: 5%;" align="center">Hora Inicio</td>
                <td style="width: 10%;" align="center">Con Alarmas</td>
              </tr>
            </thead>
            <tbody>
                          
            </tbody>
          </table><br>
        </div>

        <div class="col-md-12">
          
          <div class="row">
            <div class="col-md-12">
              <!-- div donde se dibuja el mapa-->
              <div id="map_canvas" style="width:100%;height:500px;"></div>
            </div>

          </div><br>

          <div class="row">
            <div class="col-md-6">
              <button type="button" id="btnConsultarRuta" class="btn btn-primary btn-lg">Consultar una Ruta</button>
            </div>
            
          </div>
          
          <div class="row">
            <div class="col-md-6" id="rutasInfo">            
             
            </div>
            
          </div>
        </div>
      </div><br>

      <div class="row">
      </div>

    </form>
  
  </div>
      <div class="container">
        <div class="row" align="center" id="chats">           
            
        </div>
      </div>
      <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="../../js/chat.js"></script>
      
      <script type="text/javascript">
        var totalItem = 0;
        var contadorFilasAgregadas = 1;
        var contadorColumnasAgregadas = 1;
        var contadorId = 1;
        var map;
        var marker;
        var markers = [];
        
        var interval;

        function initMap() {
        
          
         
          
          map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 6,
            center: {lat: 41.85, lng: -87.65}
          });
          
          
          MostrarDatosRuta();         
          MostrarBus()
          interval = setInterval(function(){             
            MostrarBus()  
            MostrarDatosTodasRutas()
          }, 6000);

          MostrarDatosTodasRutas()

          console.log($("#tablaOrden").parent().width())
          //$('#tablaOrden > thead').width("1227px")
          $('#tablaOrden > thead > tr > td').each(function(index) {
            var ancho = $(this).width() + 10
            for (var i = 0; i < $("#tablaOrden")[0].children[1].children.length; i++) {
              $("#tablaOrden > tbody > tr")[i].children[index].style.width = ancho + "px"
              console.log(ancho + " " + index)
            }
            
          });
        }

        setInterval(function(){
          MostrarDatosTodasRutas()
        }, 2000);

        $(window).bind("resize", function() {
          $('#tablaOrden > thead > tr > td').each(function(index) {
            var ancho = $(this).width() + 10
            for (var i = 0; i < $("#tablaOrden")[0].children[1].children.length; i++) {
              $("#tablaOrden > tbody > tr")[i].children[index].style.width = ancho + "px"
            }
            
          });
        });


        $("#OpcionSalir").click(function(e){
          var confirmar = window.confirm("¿Desea cerrar sesión?");
          if(confirmar){
              $.post("<?= base_url();?>index.php/usuarios_sistema/cerrarSesionUsuarioInterno", {})
              .done(function( data ) {
                  window.location.href = "<?= base_url();?>";
              });
          }                    
        });       
        
        $(".opcionMenuModulo").click(function(e){
          var id = $(this).attr("data-id");
          var texto = $(this).find("a").html();
          $.post("<?= base_url();?>index.php/usuarios_sistema/MostrarServicios", {id:id, texto:texto})
          .done(function( data ) {
              window.location.href = "<?= base_url();?>index.php/usuarios_sistema/homeInternoServicios";
          });
        });


        $("#btnConsultarRuta").click(function(e) {
          window.location.href = "<?= base_url();?>index.php/rutas/obtener";
        })

        function MostrarDatosRuta(){  
          

          $.post("<?= base_url();?>index.php/rutas/listarRutas", {})
          .done(function( data ) {
            //console.log(data)
            $("#btnOtroRuta").css({"display":"block"})
            var json = JSON.parse(data);

            $.each(json, function(i, item) {
              
             
              var CoordenadasOrigenRuta = json[i].latorigen + "," + json[i].longorigen;
              var CoordenadasDestinoRuta = json[i].latdestino + "," + json[i].longdestino;
              calculateAndDisplayRoute(CoordenadasOrigenRuta, CoordenadasDestinoRuta, json[i].id, json[i].color);
              
              
            });

          });

        }

        function MostrarDatosTodasRutas(){  
          

          $.post("<?= base_url();?>index.php/rutas/ListarTodasRutas", {})
          .done(function( data ) {
            console.log(data)
            $('#tablaOrden > tbody').html("")
            if($.trim(data) != "[]"){
              var json = JSON.parse(data)

              for (var i = 0; i < json.length; i++) {
                  $('#tablaOrden > tbody').append('<tr>' +
                    '<td align="center" valign="middle">' +
                      '<div style="width: 70%;background-color: ' + json[i].color + ';height: 10px;border-radius: 4px;">&nbsp;</div>' +
                    '</td>' +
                    '<td>' + json[i].nombreruta + '</td>' +
                    '<td>' + json[i].nombreConductor + ' ' + json[i].apellidoConductor + '</td>' +
                    '<td>' + json[i].nombreMonitor + ' ' + json[i].apellidoMonitor + '</td>' +
                    '<td align="center">' + json[i].placa + '</td>' +
                    '<td align="center">' + json[i].horainicial + '</td>' +
                    '<td align="center">' + json[i].alarmas + '</td>' +
                  '</tr>')
              }

              $('#tablaOrden > thead > tr > td').each(function(index) {
                var ancho = $(this).width() + 10
                for (var i = 0; i < $("#tablaOrden")[0].children[1].children.length; i++) {
                  $("#tablaOrden > tbody > tr")[i].children[index].style.width = ancho + "px"
                }
                
              });
            }
          });

        }

        function MostrarBus(){         
          var datos = {
            
          } 
          $.post("<?= base_url();?>index.php/rutas/ObtenerCoordenadasTodosBus", datos)
          .done(function( data ) {
            console.log(data)
            deleteMarkers();
            if($.trim(data) != "[]"){             
              
              var json = JSON.parse(data);   

              $("#rutasInfo").html("<h3>INFORMACIÓN DE LAS RUTAS</h3>")   
              $.each(json, function(i, item) {
                if($.trim(json[i].coordenadas_recogida).length > 0){
                  var datosBus = json[i].coordenadas_recogida;
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

                  $("#rutasInfo").append("<img src='http://www.googlemapsmarkers.com/v1/ /" + json[i].color.substr(1) + "/FFFFFF/000000' style='float:left; margin-right:5px'><p><b>" + json[i].nombreruta + "</b><br><b>CONDUCTOR:</b> " + json[i].nombreConductor + " " + json[i].apellidoConductor + "<br><b>MONITOR:</b> " + json[i].nombreMonitor + " " + json[i].apellidoMonitor + "<br><b>PLACA:</b> " + json[i].placa + "</p><br><br>")
                  //creamos el marcador en el mapa
                  marker = new google.maps.Marker({
                    map: map,//el mapa creado en el paso anterior
                    position: latLng,//objeto con latitud y longitud
                    icon: pinSymbol(json[i].color),
                    draggable: false //que el marcador se pueda arrastrar
                  });
                  
                  markers.push(marker);
                }                
              });
            }
          });
        }
        function pinSymbol(color) {
          return {
              path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z M -2,-30 a 2,2 0 1,1 4,0 2,2 0 1,1 -4,0',
              fillColor: color,
              fillOpacity: 1,
              strokeColor: '#000',
              strokeWeight: 2,
              scale: 1,
         };
      }
        function MostrarEstudiantes(idruta){  
  
          var datos = {
            idruta: idruta
          }   
          
          $.post("<?= base_url();?>index.php/rutas/ListarEstudiantesTracking", datos)
          .done(function( data ) {
            if($.trim(data) != "[]"){
              var json = JSON.parse(data);
              var htmlRecogidos = "";
              var htmlNoRecogidos = "";
              $.each(json, function(i, item) {
                if($.trim(json[i].TipoDatos) == "RECOGIDOS"){
                  htmlRecogidos += '<div id="name" class="name">' +
                      '<p id="n"><b>Posicion: </b>' + (i + 1) + '</p>' +
                      '<p id="n"><b>Estudiante: </b>' + json[i].PrimerApellido + ' ' + json[i].SegundoApellido + ' ' + json[i].PrimerNombre + ' ' + json[i].SegundoNombre + '</p>' +
                      '<p id="n"><b>Recogido </b><input id=\"checkbox\" type=\"checkbox\" name=\"checkbox\" checked="checked" readonly=\"readonly\"  onclick=\"javascript: return false;\" style="margin-top:3px"/></p><br><br>' +
                    '</div>';
                  
                }else{
                  htmlNoRecogidos += '<div id="name" class="name">' +
                      '<p id="n"><b>Posicion: </b>' + (i + 1) + '</p>' +
                      '<p id="n"><b>Estudiante: </b>' + json[i].PrimerApellido + ' ' + json[i].SegundoApellido + ' ' + json[i].PrimerNombre + ' ' + json[i].SegundoNombre + '</p>' +
                      '<p id="n"><b>Recogido </b> <input id=\"checkbox\" type=\"checkbox\"  readonly=\"readonly\"  onclick=\"javascript: return false;\" style="margin-top:3px"/><br><br>' +
                    '</div>';
                  
                }
              });
              if(htmlRecogidos != ""){
                $("#rutaEstudiantesRecogido").html('<br><br>' +
                    '<h3 class="text-primary">Estudiantes en ruta</h3>' + htmlRecogidos);
              }else{
                $("#rutaEstudiantesRecogido").html('<br><br><h3 class="text-primary">Estudiantes en ruta</h3>');
              }
              if(htmlNoRecogidos != ""){
                $("#rutaEstudiantesNoRecogido").html('<br><br>' +
                    '<h3 class="text-primary">Estudiantes que no estan en ruta</h3>' + htmlNoRecogidos);
              }else{
                $("#rutaEstudiantesNoRecogido").html('<br><br><h3 class="text-primary">Estudiantes que no estan en ruta</h3>');
              }
              
            }
          });
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
          for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
          }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
          setMapOnAll(null);
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
          clearMarkers();
          markers = [];
        }

        function calculateAndDisplayRoute(CoordenadasOrigenRuta, CoordenadasDestinoRuta, idruta, color) {
          
          //var color = dame_color_aleatorio() + "";
          //var directionsService = new google.maps.DirectionsService();
          //var directionsDisplay = new google.maps.DirectionsRenderer();
          //var directionsDisplay = new google.maps.DirectionsRenderer({ polylineOptions: { strokeColor: color } });
          var directionsService = new google.maps.DirectionsService();
          var directionsDisplay = new google.maps.DirectionsRenderer({ polylineOptions: { strokeColor: color } });
          

          //directionsDisplay.setMap(map);  
          directionsDisplay.setMap(map);
          directionsDisplay.setOptions({ suppressMarkers: false });

          var waypts = [];
          var datos = {
            idruta: idruta
          } 
          $.post("<?= base_url();?>index.php/rutas/ObtenerCoordenadasRuta", datos)
          .done(function( data ) {
                
            if($.trim(data) != "[]"){
             
              var json = JSON.parse(data);
              
              $.each(json, function(i, item) {
                var latlon = new google.maps.LatLng(json[i].latitud,json[i].longitud);
                waypts.push({
                  location: latlon,
                  stopover: true
                });
              });
              
              
              directionsService.route({
                origin: CoordenadasOrigenRuta,
                destination: CoordenadasDestinoRuta,
                waypoints: waypts,
                optimizeWaypoints: true,
                travelMode: google.maps.TravelMode.DRIVING
              }, 
              function(response, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                  directionsDisplay.setDirections(response);
                  var route = response.routes[0];
                  
                } else {
                  //window.alert('No se encuentra la direccion ' + status);
                }
              });
            }
          }); 
          
          
        }

        function aleatorio(inferior,superior){
          numPosibilidades = superior - inferior
          aleat = Math.random() * numPosibilidades
          aleat = Math.floor(aleat)
          return parseInt(inferior) + aleat
        } 

        function dame_color_aleatorio(){
          hexadecimal = new Array("0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F")
          color_aleatorio = "#";
          for (i=0;i<6;i++){
            pos = aleatorio(0,hexadecimal.length)
            color_aleatorio += hexadecimal[pos]
          }
          return color_aleatorio
        }

      </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJhwAnBcf7HiAk8mhenonqyOyXrmwh3g&callback=initMap"
        async defer></script>
      <footer class="footer">
        <img alt="" src="<?= base_url();?>images/logo.png" width="300" height="110"  border="0"></footer>
      </footer>
    </body>
</html>