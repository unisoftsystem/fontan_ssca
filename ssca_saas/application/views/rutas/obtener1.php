<?php
    $UserName = $this->session->userdata('UserNameInternoSSCA');
    if(empty($UserName)) { // Recuerda usar corchetes.
        header('Location: ' . base_url(1));
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
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    /* Set the fixed height of the footer here */
    height: 13%;
    background-color: #f5f5f5;
  }

  /* The Modal (background) */
#myModalEstudiante {
    display: none; /* Hidden by default */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
}

/* Modal Content/Box */
#myModalEstudiante > .modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

p > b{
   color: #337ab7
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
</style>
<script src="<?= base_url(1);?>js/drag/jquery-git2.min.js"></script>
<script src="<?= base_url(1);?>js/drag/jquery.event.drag-2.2.js"></script>
<script src="<?= base_url(1);?>js/drag/jquery.event.drag.live-2.2.js"></script>
<script src="<?= base_url(1);?>js/drag/jquery.event.drop-2.2.js"></script>
<script src="<?= base_url(1);?>js/drag/jquery.event.drop.live-2.2.js"></script>
<script src="<?= base_url(1);?>js/drag/excanvas.min.js"></script>
<script src="<?= base_url(1);?>js/drag/watermark-polyfill.js"></script>

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
        <div class="col-md-12" style="background-color: #f5f5f5; padding-top: 10px; padding-bottom: 10px" align="center">
            <img src="<?= base_url(1);?>img/HOME.png" width="200" height="100" border="0" style="left:15px; position:absolute; top: 0px">
            <a href="<?= base_url();?>index.php/rutas/nuevo"><img src="<?= base_url(1);?>img/logo1.png" width="70" height="70"></a>&nbsp; 
            <a style="top:40px; position: relative;" href="<?= base_url();?>index.php/rutas/obtener"><img src="<?= base_url(1);?>img/logo2.png" width="70" height="70" border="0"></a>
            <a href="<?= base_url();?>index.php/rutas/editar"><img src="<?= base_url(1);?>img/logo3.png" width="70" height="70" border="0"></a>
            <a href="#" id="OpcionSalir"><img src="<?= base_url(1);?>img/exit.png" width="70" height="70" border="0"></a><br>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
            <h3 class="text-primary text-right">
                <?= $titulo;?>
            </h3>
        </div>
      </div>

      <div class="row">
      
        <div class="col-md-4">
          <h3 class="text-primary" id="lblSelectRuta">Selección de Ruta</h3>
          <hr id="hrRuta">

          <div class="form-group" id="rowSelectRuta">
              <select class="form-control" id="selectruta" name="selectruta"> 
                <?php
                  /*
                      Se valida que el result de la consulta de tecnicas tenga datos.
                      Este valor es enviado desde la funcion del controlador
                  */                                    
                  if($rutas){
                    //Se itera el result de los tecnicos. $tecnicos es enviado como un objeto, el cual para obtener los datos se obtiene un array asociativo, el cual se itera con un foreach y se muestra en el select
                    foreach ($rutas->result() as $value) {
                ?>
                <option value="<?= $value->id?>"><?= $value->nombreruta;?></option>
                <?php
                    }
                  }
                ?>
              </select>        
          </div>

          <div class="form-group">
              <button type="button" id="btnConsultarRuta" class="btn btn-primary btn-lg">Consultar Ruta</button>

              <button type="button" id="btnTodasRutas" class="btn btn-primary btn-lg">Todas las Rutas</button>
          </div>
          <div class="row" style="padding-left:15px; padding-right:15px; display:none" id="rowDatos">
            
              <div class="form-group">
                <h3 class="text-primary">Datos Ruta</h3>
              </div>
              <hr>

              <div class="form-group">
                <h6 id="NombreRuta">Nombre Ruta: </h6>
              </div>
              <hr>

              <div class="form-group">
                <h6 id="ConductorRuta">Conductor: </h6>
              </div>
              <hr>

              <div class="form-group">
                <h6 id="PlacaRuta">Placa: </h6>
              </div>
              <hr>

              <div class="form-group">
                <h6 id="MonitorRuta">Monitor: </h6>
              </div>
              <hr>

              <div class="form-group">
                <h6 id="SillasRuta">Sillas: </h6>
              </div>
              <hr>

              <input type="button" value="Buscar otra ruta" class="btn btn-primary btn-lg pull-right" style="display:none" id="btnOtroRuta"/>
              
          </div>

          

          
          
        </div>
        
        <div class="col-md-8">
          <h3 class="text-primary">Mapa</h3>
          <hr> 
      
          <div class="row">
            <div class="col-md-12">
              <!-- div donde se dibuja el mapa-->
              <button class="btn btn-primary pull-right" type="button" id="btnVerMapa" style="display: none;">VER BUS</button><br><br>
              <div id="map_canvas" style="width:100%;height:400px;"></div>
            </div>

          </div>
          <div class="row" id="rowEstudiantes" style="display:none">
            <div class="col-md-12">
              <br>
              <table width="100%" border="1">
                  <thead>
                      <tr style="background-color: #81BEF7; color: white; font-size: 13px">
                          <td align="center">Posicion</td>
                          <td align="center">Estudiante</td>
                          <td align="center">Recogido</td>
                          <td align="center">Entregado</td>
                          <td align="center">Mensajes/Alertas</td>
                      </tr>
                  </thead>
                  <tbody id="tbody">
                  </tbody>
              </table>
            </div>
            
          </div>
          
          
        </div>
      </div><br>

      

    </form>

    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Mensajes</h4>
          </div>
          <div class="modal-body">
            <h5 class="modal-title">Mensajes para Acudiente</h5><br>
            <table width="100%" border="1">
              <thead>
                <tr style="background-color: #81BEF7; color: white; font-size: 13px">
                    <td align="center">Acudiente</td>
                    <td align="center">Hora</td>
                    <td align="center">Mensaje</td>
                </tr>
              </thead>
              <tbody id="tbodyMensajesAcudientes">
              </tbody>
            </table>
            <hr>

            <h5 class="modal-title">Mensajes para Monitor</h5><br>
            <table width="100%" border="1">
              <thead>
                <tr style="background-color: #81BEF7; color: white; font-size: 13px">
                    <td align="center">Monitor</td>
                    <td align="center">Acudiente</td>
                    <td align="center">Hora</td>
                    <td align="center">Mensaje</td>
                </tr>
              </thead>
              <tbody id="tbodyMensajesMonitor">
              </tbody>
            </table>
            <hr>

            <h5 class="modal-title">Mensajes para Estudiantes</h5><br>
            <table width="100%" border="1">
              <thead>
                <tr style="background-color: #81BEF7; color: white; font-size: 13px">
                    <td align="center">Monitor</td>
                    <td align="center">Estudiante</td>
                    <td align="center">Hora</td>
                    <td align="center">Mensaje</td>
                </tr>
              </thead>
              <tbody id="tbodyMensajesEstudiantes">
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- The Modal -->
    <div id="myModalEstudiante" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <!--<span class="close" id="cerrar">x</span><br><br>
        <hr>-->
        <div class="row" style="border: 1px solid #09C; border-radius: 4px; margin-top: 0px; margin-left: 5px; margin-right: 5px">
          <div class="col-md-2">
            <img src="<?= base_url(1);?>images/stock_people.png" width="100%" id="fotoEstudiante">
          </div>
          <div class="col-md-10">
            <div style="background-color: #337ab7; width:100%; padding-top: 5px; padding-bottom: 5px; margin-top: 5px; border-radius: 2px; padding-left: 3%  ">
              <h4 style="color:#FFF; text-transform:uppercase;" id="estudianteNombre"></h4>
            </div>
            <hr style="background-color: #337ab7; height: 1px" size="4">
            <p id="estudianteTelefono" style="margin-left: 3%; text-transform:uppercase;"></p>
            <p id="estudianteNombreAcudiente" style="margin-left: 3%; text-transform:uppercase;"></p>
            <p id="estudianteEmail" style="margin-left: 3%; text-transform:uppercase;"></p>
            <p id="estudianteTelefonoAcudiente" style="margin-left: 3%; text-transform:uppercase;"></p>
          </div>
          <div class="row">
            <div class="col-md-12" align="center">
              <hr style="background-color: #337ab7; height: 1px;" size="4" width="98%">
            </div>
          </div>
        </div>

      </div>

    </div>
</div>
      <div class="container">
        <div class="row" align="center" id="chats">           
            
        </div>
      </div>
      <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="<?= base_url(1);?>js/chat.js"></script>
      
      <script type="text/javascript">

        /** ***************************** **/
        // Get the modal
        
        var modal = document.getElementById('myModalEstudiante');
        // Get the button that opens the modal
       

        // Get the <span> element that closes the modal
        /*var span = document.getElementById("cerrar");

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }*/

        // When the user clicks anywhere outside of the modal, close it
        modal.onmouseover = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        /** ***************************** **/

        var totalItem = 0;
        var contadorFilasAgregadas = 1;
        var contadorColumnasAgregadas = 1;
        var contadorId = 1;
        var map;
        var marker;
        var markers = [];
        var directionsService;
        var directionsDisplay;
        var interval;
        function initMap() {
        
          directionsService = new google.maps.DirectionsService;
          directionsDisplay = new google.maps.DirectionsRenderer;
          
          map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 6,
            center: {lat: 41.85, lng: -87.65}
          });
          
          directionsDisplay.setMap(map);
          //MostrarBus();        
        }


        $("#OpcionSalir").click(function(e){
          var confirmar = window.confirm("¿Desea cerrar sesión?");
          if(confirmar){
              $.post("<?= base_url();?>index.php/usuarios_sistema/cerrarSesionUsuarioInterno", {})
              .done(function( data ) {
                  window.location.href = "<?= base_url(1);?>";
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
          var ruta = $("#selectruta").val();
          $("#tbody").html("")
          MostrarDatosRuta(ruta, directionsService, directionsDisplay);
          MostrarEstudiantes(ruta)
          MostrarBus(ruta)  

          interval = setInterval(function(){ 
            var ruta = $("#selectruta").val();
            $("#rutaEstudiantesRecogido").empty();
            MostrarEstudiantes(ruta)
            MostrarBus(ruta)  
          }, 500);

          $("#rowDatos").css({"display":"block"})
          $("#btnVerMapa").css({"display":"block"})
          $("#rowEstudiantes").css({"display":"block"})
          $("#lblSelectRuta").css({"display":"none"})
          $("#hrRuta").css({"display":"none"})
          $("#rowSelectRuta").css({"display":"none"})
          $("#btnConsultarRuta").css({"visibility":"hidden"})
          $("#btnOtroRuta").css({"display":"block"})
          $("footer").css({"position":"relative"})
        });

        $("#btnOtroRuta").click(function(e) {
          $("#rowDatos").css({"display":"none"})
          $("#btnVerMapa").css({"display":"none"})
          $("#rowEstudiantes").css({"display":"none"})
          $("#lblSelectRuta").css({"display":"block"})
          $("#hrRuta").css({"display":"block"})
          $("#rowSelectRuta").css({"display":"block"})
          $("#btnConsultarRuta").css({"visibility":"visible"})          
          $("#btnOtroRuta").css({"display":"none"})
          $("footer").css({"position":"absolute"})
          initMap()
          deleteMarkers();
          clearInterval(interval);
        });

        $("#btnTodasRutas").click(function(e) {
          window.location.href = "<?= base_url();?>index.php/rutas/todos";
        })

        function MostrarDatosRuta(idruta, directionsService, directionsDisplay){  
          $("#tbody").html("")
          $.post("<?= base_url();?>index.php/rutas/ObtenerRutaDetallada", {ruta:idruta})
          .done(function( data ) {
            
            $("#btnOtroRuta").css({"display":"block"})
            var json = JSON.parse(data);
            $.each(json, function(i, item) {
              $("#NombreRuta").html("<b>Nombre Ruta: </b>" + json[i].nombreruta);
              $("#ConductorRuta").html("<b>Conductor: </b>" + json[i].nombreConductor + " " + json[i].apellidoConductor);
              $("#PlacaRuta").html("<b>Placa: </b>" + json[i].placa);
              $("#MonitorRuta").html("<b>Monitor: </b>" + json[i].nombreMonitor + " " + json[i].apellidoMonitor);
              $("#SillasRuta").html("<b>Sillas: </b>" + json[i].sillas); 

              var CoordenadasOrigenRuta = json[i].latorigen + "," + json[i].longorigen;
              var CoordenadasDestinoRuta = json[i].latdestino + "," + json[i].longdestino;
              
              calculateAndDisplayRoute(directionsService, directionsDisplay, CoordenadasOrigenRuta, CoordenadasDestinoRuta);
            });
          });

        }

        function MostrarBus(idruta){
          var date = new Date();
          var dia = date.getDate();
          var mes = (date.getMonth() + 1);
          var year = date.getFullYear();
          
          if(dia < 10) {
            dia = '0' + dia;
          } 
          
          if(mes < 10) {
            mes = '0' + mes;
          } 
          
          var fecha_actual = year + "-" + mes + "-" + dia;
          var datos = {
            idruta: idruta,
            fecha: fecha_actual
          } 
          $.post("<?= base_url();?>index.php/rutas/ObtenerCoordenadasBus", datos)
          .done(function( data ) {console.log(data)
            deleteMarkers();
            if($.trim(data) != "[]"){
              ;
              
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
                icon: '<?= base_url(1);?>img/icon-bus.png',
                draggable: false //que el marcador se pueda arrastrar
              });
              
              markers.push(marker);
              
            }else{
              
            }
          });
        }

        $("#btnVerMapa").click(function(e){
          var center = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
          
          map.panTo(center);
          console.log(marker.position.lat() + " " + marker.position.lng())
        })

        function MostrarEstudiantes(idruta){  
  
          var datos = {
            idruta: idruta
          }   
          
          $.post("<?= base_url();?>index.php/rutas/ListarEstudiantesTracking", datos)
          .done(function( data ) {//console.log(data)
            if($.trim(data) != "[]"){
              var json = JSON.parse(data);
              $("#tbody").html("")
              $.each(json, function(i, item) {
                if($.trim(json[i].TipoDatos) == "RECOGIDO"){
                  var mensajes = "";
                  if(json[i].mensajes.length == 0){
                    mensajes = "NO TIENE MENSAJES";
                  }else{
                    mensajes = "<a href='#' data-toggle='modal' data-target='#myModal' id='enlacePopUp" + i + "' mensajes='" + JSON.stringify(json[i].mensajes) + "' itera='" + i + "'>MENSAJES</a>";
                  }
                  $("#tbody").append('<tr align="center"><td>' + json[i].Indice + '</td><td><label id="estudiante' + i + '" idUsuario="' + json[i].idUsuario + '" itera="' + i + '" style="margin-top: 15px; margin-bottom: 15px; cursor:pointer">' + json[i].PrimerApellido + ' ' + json[i].SegundoApellido + ' ' + json[i].PrimerNombre + ' ' + json[i].SegundoNombre + '</label></td><td>' + json[i].HoraRecogido + '<br><input id=\"checkbox\" type=\"checkbox\" name=\"checkbox\" checked="checked" readonly=\"readonly\"  onclick=\"javascript: return false;\" style="margin-top:3px"/></td><td>&nbsp;</td><td>' + mensajes + '</td></tr>');

                  $("#estudiante" + i).mouseover(function(e){
                    var itera = $(this).attr("itera")
                    var idUsuario = $("#estudiante" + itera).attr("idUsuario")
                    
                      var datos = {
                        idUsuario: idUsuario
                      }   
                      
                      $.post("<?= base_url();?>index.php/rutas/ObtenerDatosPersonas", datos)
                      .done(function( data ) {//console.log(data)
                        if($.trim(data) != "[]"){
                          var json = JSON.parse(data);
                          
                          $.each(json, function(i, item) {
                            $("#estudianteNombre").html(json[i].PrimerApellido.toUpperCase() + ' ' + json[i].SegundoApellido.toUpperCase() + ' ' + json[i].PrimerNombre.toUpperCase() + ' ' + json[i].SegundoNombre.toUpperCase());
                            $("#fotoEstudiante").attr("src" , "<?= base_url(1);?>" + json[i].ImagenFotografica);
                            $("#estudianteTelefono").html("<b style='color: #337ab7'>TELEFONOS:</b> " + json[i].Telefono1.toUpperCase() + ' ' + json[i].Telefono2.toUpperCase());
                            $("#estudianteNombreAcudiente").html("<b style='color: #337ab7'>NOMBRE ACUDIENTE:</b> " + json[i].PrimerApellidoAcudiente.toUpperCase() + ' ' + json[i].SegundoApellidoAcudiente.toUpperCase() + ' ' + json[i].PrimerNombreAcudiente.toUpperCase() + ' ' + json[i].SegundoNombreAcudiente.toUpperCase());
                            $("#estudianteTelefonoAcudiente").html("<b style='color: #337ab7'>TELEFONO ACUDIENTE:</b> " + json[i].Telefono1Acudiente + ' ' + json[i].Telefono2Acudiente);
                            $("#estudianteEmail").html("<b style='color: #337ab7'>E-MAIL ACUDIENTE: </b>" + json[i].idUsuarioAcudiente.toUpperCase());
                          });
                        }else{
                          $("#estudianteNombre").html("");
                            $("#fotoEstudiante").attr("src" , "<?= base_url(1);?>images/stock_people.png");
                            $("#estudianteTelefono").html("");
                            $("#estudianteNombreAcudiente").html("");
                            $("#estudianteTelefonoAcudiente").html("");
                            $("#estudianteEmail").html("");
                        }
                        modal.style.display = "block";
                      });
                    
                    })

                    /*$("#estudiante" + i).mouseleave(function(e){ 
                      console.log("AAA")    
                      $("#estudianteNombre").html("");
                      $("#fotoEstudiante").attr("src" , "<?= base_url(1);?>images/stock_people.png");
                      $("#estudianteTelefono").html("");
                      $("#estudianteNombreAcudiente").html("");
                      $("#estudianteTelefonoAcudiente").html("");
                      $("#estudianteEmail").html("");
                      modal.style.display = "none";
                    });*/

                  $("#enlacePopUp" + i).click(function(e){
                    var itera = $(this).attr("itera")
                    var mensajes = $("#enlacePopUp" + itera).attr("mensajes")

                    var jsonDatos = JSON.parse(mensajes);

                    $("#tbodyMensajesAcudientes").html("")
                    $("#tbodyMensajesMonitor").html("")
                    $("#tbodyMensajesEstudiantes").html("")

                    for (var j = 0; j < jsonDatos.length; j++) {
                      switch(jsonDatos[j].tipo){
                        case "MENSAJEAMONITOR":
                          $("#tbodyMensajesMonitor").append('<tr align="center"><td>' + jsonDatos[j].nombre + ' ' + jsonDatos[j].apellido  + '</td><td>' + jsonDatos[j].Nombre  + '</td><td>' + jsonDatos[j].hora + '</td><td>' + jsonDatos[j].mensaje + '</td></tr>');
                          break;

                        case "MENSAJEAACUDIENTESPORESTUDIANTE":
                          $("#tbodyMensajesAcudientes").append('<tr align="center"><td>' + jsonDatos[j].NombreAcudiente  + '</td><td>' + jsonDatos[j].hora + '</td><td>' + jsonDatos[j].mensaje + '</td></tr>');
                          break;

                        case "MENSAJEAACUDIENTESPORRUTA":
                          $("#tbodyMensajesAcudientes").append('<tr align="center"><td>' + jsonDatos[j].NombreAcudiente  + '</td><td>' + jsonDatos[j].hora + '</td><td>' + jsonDatos[j].mensaje + '</td></tr>');
                          break;

                        case "ALERTEAPPNOTIFICACION":
                          $("#tbodyMensajesEstudiantes").append('<tr align="center"><td>' + jsonDatos[j].nombre + ' ' + jsonDatos[j].apellido  + '</td><td>' + jsonDatos[j].PrimerNombre + ' ' + jsonDatos[j].SegundoNombre + ' ' + jsonDatos[j].PrimerApellido + ' ' + jsonDatos[j].SegundoApellido  + '</td><td>' + jsonDatos[j].hora + '</td><td>' + jsonDatos[j].mensaje + '</td></tr>');
                          break;
                      }
                      
                    }
                    
                  })
                }else{
                  if($.trim(json[i].TipoDatos) == "ENTREGADO"){
                    var mensajes = "";
                    if(json[i].mensajes.length == 0){
                      mensajes = "NO TIENE MENSAJES";
                    }else{
                      mensajes = "<a href='#' data-toggle='modal' data-target='#myModal' id='enlacePopUp" + i + "' mensajes='" + JSON.stringify(json[i].mensajes) + "' itera='" + i + "'>MENSAJES</a>";
                    }
                    $("#tbody").append('<tr align="center"><td>' + json[i].Indice + '</td><td><label id="estudiante' + i + '" idUsuario="' + json[i].idUsuario + '" itera="' + i + '" style="margin-top: 15px; margin-bottom: 15px; cursor:pointer">' + json[i].PrimerApellido + ' ' + json[i].SegundoApellido + ' ' + json[i].PrimerNombre + ' ' + json[i].SegundoNombre + '</label></td><td>' + json[i].HoraRecogido + '<br><input id=\"checkbox\" type=\"checkbox\" name=\"checkbox\" checked="checked" readonly=\"readonly\"  onclick=\"javascript: return false;\" style="margin-top:3px"/></td><td>' + json[i].HoraEntregado + '<br><input id=\"checkbox\" type=\"checkbox\" name=\"checkbox\" checked="checked" readonly=\"readonly\"  onclick=\"javascript: return false;\" style="margin-top:3px"/></td><td>' + mensajes + '</td></tr>');  

                    $("#estudiante" + i).mouseover(function(e){
                      var itera = $(this).attr("itera")
                      var idUsuario = $("#estudiante" + itera).attr("idUsuario")
                      
                        var datos = {
                          idUsuario: idUsuario
                        }   
                        
                        $.post("<?= base_url();?>index.php/rutas/ObtenerDatosPersonas", datos)
                        .done(function( data ) {//console.log(data)
                          if($.trim(data) != "[]"){
                            var json = JSON.parse(data);
                            
                            $.each(json, function(i, item) {
                              $("#estudianteNombre").html(json[i].PrimerApellido.toUpperCase() + ' ' + json[i].SegundoApellido.toUpperCase() + ' ' + json[i].PrimerNombre.toUpperCase() + ' ' + json[i].SegundoNombre.toUpperCase());
                              $("#fotoEstudiante").attr("src" , "<?= base_url(1);?>" + json[i].ImagenFotografica);
                              $("#estudianteTelefono").html("<b style='color: #337ab7'>TELEFONOS:</b> " + json[i].Telefono1.toUpperCase() + ' ' + json[i].Telefono2.toUpperCase());
                              $("#estudianteNombreAcudiente").html("<b style='color: #337ab7'>NOMBRE ACUDIENTE:</b> " + json[i].PrimerApellidoAcudiente.toUpperCase() + ' ' + json[i].SegundoApellidoAcudiente.toUpperCase() + ' ' + json[i].PrimerNombreAcudiente.toUpperCase() + ' ' + json[i].SegundoNombreAcudiente.toUpperCase());
                              $("#estudianteTelefonoAcudiente").html("<b style='color: #337ab7'>TELEFONO ACUDIENTE:</b> " + json[i].Telefono1Acudiente + ' ' + json[i].Telefono2Acudiente);
                              $("#estudianteEmail").html("<b style='color: #337ab7'>E-MAIL ACUDIENTE: </b>" + json[i].idUsuarioAcudiente.toUpperCase());
                            });
                          }else{
                            $("#estudianteNombre").html("");
                            $("#fotoEstudiante").attr("src" , "<?= base_url(1);?>images/stock_people.png");
                            $("#estudianteTelefono").html("");
                            $("#estudianteNombreAcudiente").html("");
                            $("#estudianteTelefonoAcudiente").html("");
                            $("#estudianteEmail").html("");
                          }
                          modal.style.display = "block";
                        });
                      
                      }) 

                      /*$("#estudiante" + i).mouseleave(function(e){ 
                        console.log("AAA")    
                        $("#estudianteNombre").html("");
                        $("#fotoEstudiante").attr("src" , "<?= base_url(1);?>images/stock_people.png");
                        $("#estudianteTelefono").html("");
                        $("#estudianteNombreAcudiente").html("");
                        $("#estudianteTelefonoAcudiente").html("");
                        $("#estudianteEmail").html("");
                        modal.style.display = "none";
                      });*/

                    $("#enlacePopUp" + i).click(function(e){
                      var itera = $(this).attr("itera")
                      var mensajes = $("#enlacePopUp" + itera).attr("mensajes")

                      var jsonDatos = JSON.parse(mensajes);

                      $("#tbodyMensajesAcudientes").html("")
                      $("#tbodyMensajesMonitor").html("")
                      $("#tbodyMensajesEstudiantes").html("")

                      for (var j = 0; j < jsonDatos.length; j++) {
                        switch(jsonDatos[j].tipo){
                          case "MENSAJEAMONITOR":
                            $("#tbodyMensajesMonitor").append('<tr align="center"><td>' + jsonDatos[j].nombre + ' ' + jsonDatos[j].apellido  + '</td><td>' + jsonDatos[j].Nombre  + '</td><td>' + jsonDatos[j].hora + '</td><td>' + jsonDatos[j].mensaje + '</td></tr>');
                            break;

                          case "MENSAJEAACUDIENTESPORESTUDIANTE":
                            $("#tbodyMensajesAcudientes").append('<tr align="center"><td>' + jsonDatos[j].NombreAcudiente  + '</td><td>' + jsonDatos[j].hora + '</td><td>' + jsonDatos[j].mensaje + '</td></tr>');
                            break;

                          case "MENSAJEAACUDIENTESPORRUTA":
                            $("#tbodyMensajesAcudientes").append('<tr align="center"><td>' + jsonDatos[j].NombreAcudiente  + '</td><td>' + jsonDatos[j].hora + '</td><td>' + jsonDatos[j].mensaje + '</td></tr>');
                            break;

                          case "ALERTEAPPNOTIFICACION":
                            $("#tbodyMensajesEstudiantes").append('<tr align="center"><td>' + jsonDatos[j].nombre + ' ' + jsonDatos[j].apellido  + '</td><td>' + jsonDatos[j].PrimerNombre + ' ' + jsonDatos[j].SegundoNombre + ' ' + jsonDatos[j].PrimerApellido + ' ' + jsonDatos[j].SegundoApellido  + '</td><td>' + jsonDatos[j].hora + '</td><td>' + jsonDatos[j].mensaje + '</td></tr>');
                            break;
                        }
                        
                      }
                      
                    })                      
                  }else{
                    var mensajes = "";
                    if(json[i].mensajes.length == 0){
                      mensajes = "NO TIENE MENSAJES";
                    }else{
                      mensajes = "<a href='#' data-toggle='modal' data-target='#myModal' id='enlacePopUp" + i + "' mensajes='" + JSON.stringify(json[i].mensajes) + "' itera='" + i + "'>MENSAJES</a>";
                    }
                     $("#tbody").append('<tr align="center"><td>' + json[i].Indice + '</td><td><label id="estudiante' + i + '" idUsuario="' + json[i].idUsuario + '" itera="' + i + '" style="margin-top: 15px; margin-bottom: 15px; cursor:pointer">' + json[i].PrimerApellido + ' ' + json[i].SegundoApellido + ' ' + json[i].PrimerNombre + ' ' + json[i].SegundoNombre + '</label></td><td>&nbsp;</td><td>&nbsp;</td><td>' + mensajes + '</td></tr>');

                    $("#estudiante" + i).mouseover(function(e){
                      var itera = $(this).attr("itera")
                      var idUsuario = $("#estudiante" + itera).attr("idUsuario")
                      
                        var datos = {
                          idUsuario: idUsuario
                        }   
                        
                        $.post("<?= base_url();?>index.php/rutas/ObtenerDatosPersonas", datos)
                        .done(function( data ) {//console.log(data)
                          if($.trim(data) != "[]"){
                            var json = JSON.parse(data);
                            
                            $.each(json, function(i, item) {
                              $("#estudianteNombre").html(json[i].PrimerApellido.toUpperCase() + ' ' + json[i].SegundoApellido.toUpperCase() + ' ' + json[i].PrimerNombre.toUpperCase() + ' ' + json[i].SegundoNombre.toUpperCase());
                              $("#fotoEstudiante").attr("src" , "<?= base_url(1);?>" + json[i].ImagenFotografica);
                              $("#estudianteTelefono").html("<b style='color: #337ab7'>TELEFONOS:</b> " + json[i].Telefono1.toUpperCase() + ' ' + json[i].Telefono2.toUpperCase());
                              $("#estudianteNombreAcudiente").html("<b style='color: #337ab7'>NOMBRE ACUDIENTE:</b> " + json[i].PrimerApellidoAcudiente.toUpperCase() + ' ' + json[i].SegundoApellidoAcudiente.toUpperCase() + ' ' + json[i].PrimerNombreAcudiente.toUpperCase() + ' ' + json[i].SegundoNombreAcudiente.toUpperCase());
                              $("#estudianteTelefonoAcudiente").html("<b style='color: #337ab7'>TELEFONO ACUDIENTE:</b> " + json[i].Telefono1Acudiente + ' ' + json[i].Telefono2Acudiente);
                              $("#estudianteEmail").html("<b style='color: #337ab7'>E-MAIL ACUDIENTE: </b>" + json[i].idUsuarioAcudiente.toUpperCase());
                            });
                          }else{
                            $("#estudianteNombre").html("");
                            $("#fotoEstudiante").attr("src" , "<?= base_url(1);?>images/stock_people.png");
                            $("#estudianteTelefono").html("");
                            $("#estudianteNombreAcudiente").html("");
                            $("#estudianteTelefonoAcudiente").html("");
                            $("#estudianteEmail").html("");
                          }
                          modal.style.display = "block";
                        });
                      
                      })

                      /*$("#estudiante" + i).mouseleave(function(e){ 
                        console.log("AAA")    
                        $("#estudianteNombre").html("");
                        $("#fotoEstudiante").attr("src" , "<?= base_url(1);?>images/stock_people.png");
                        $("#estudianteTelefono").html("");
                        $("#estudianteNombreAcudiente").html("");
                        $("#estudianteTelefonoAcudiente").html("");
                        $("#estudianteEmail").html("");
                        modal.style.display = "none";
                      });*/

                      $("#enlacePopUp" + i).click(function(e){
                        var itera = $(this).attr("itera")
                        var mensajes = $("#enlacePopUp" + itera).attr("mensajes")

                        var jsonDatos = JSON.parse(mensajes);

                        $("#tbodyMensajesAcudientes").html("")
                        $("#tbodyMensajesMonitor").html("")
                        $("#tbodyMensajesEstudiantes").html("")

                        for (var j = 0; j < jsonDatos.length; j++) {
                          switch(jsonDatos[j].tipo){
                            case "MENSAJEAMONITOR":
                              $("#tbodyMensajesMonitor").append('<tr align="center"><td>' + jsonDatos[j].nombre + ' ' + jsonDatos[j].apellido  + '</td><td>' + jsonDatos[j].Nombre  + '</td><td>' + jsonDatos[j].hora + '</td><td>' + jsonDatos[j].mensaje + '</td></tr>');
                              break;

                            case "MENSAJEAACUDIENTESPORESTUDIANTE":
                              $("#tbodyMensajesAcudientes").append('<tr align="center"><td>' + jsonDatos[j].NombreAcudiente  + '</td><td>' + jsonDatos[j].hora + '</td><td>' + jsonDatos[j].mensaje + '</td></tr>');
                              break;

                            case "MENSAJEAACUDIENTESPORRUTA":
                              $("#tbodyMensajesAcudientes").append('<tr align="center"><td>' + jsonDatos[j].NombreAcudiente  + '</td><td>' + jsonDatos[j].hora + '</td><td>' + jsonDatos[j].mensaje + '</td></tr>');
                              break;

                            case "ALERTEAPPNOTIFICACION":
                              $("#tbodyMensajesEstudiantes").append('<tr align="center"><td>' + jsonDatos[j].nombre + ' ' + jsonDatos[j].apellido  + '</td><td>' + jsonDatos[j].PrimerNombre + ' ' + jsonDatos[j].SegundoNombre + ' ' + jsonDatos[j].PrimerApellido + ' ' + jsonDatos[j].SegundoApellido  + '</td><td>' + jsonDatos[j].hora + '</td><td>' + jsonDatos[j].mensaje + '</td></tr>');
                              break;
                          }
                          
                        }
                        
                      })
                  }
                }
              });
            }else{
              $("#tbody").html("")
            }
          })
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

        function calculateAndDisplayRoute(directionsService, directionsDisplay, CoordenadasOrigenRuta, CoordenadasDestinoRuta) {
  
          var waypts=[];

          var date = new Date();
          var dia = date.getDate();
          var mes = (date.getMonth() + 1);
          var year = date.getFullYear();
          
          if(dia < 10) {
            dia = '0' + dia;
          } 
          
          if(mes < 10) {
            mes = '0' + mes;
          } 
          
          var fecha_actual = dia + "/" + mes + "/" + year;
          var origen = CoordenadasOrigenRuta;
          var destino = CoordenadasDestinoRuta;
          // arreglo de json en variable json
          var datos = {
            idruta: $("#selectruta").val()
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
                  /*var summaryPanel = document.getElementById('directions-panel');
                  summaryPanel.innerHTML = '';*/
                  // For each route, display summary information.
                  //console.log('localizacion: ' + route.legs);
                  for (var i = 0; i < route.legs.length; i++) {
                    var routeSegment = i + 1;
                  }
                } else {
                  window.alert('No se encuentra la direccion ' + status);
                }
              });
            }
          }); 
        }

      </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJhwAnBcf7HiAk8mhenonqyOyXrmwh3g&callback=initMap"
        async defer></script>
      <footer class="footer">
        <img alt="" src="<?= base_url(1);?>images/logo.png" width="300" height="110"  border="0"></footer>
      </footer>
    </body>
</html>