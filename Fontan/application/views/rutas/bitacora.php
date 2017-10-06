<?php
    $UserName = $this->session->userdata('UserNameInternoSSCA');
    if(empty($UserName)) { // Recuerda usar corchetes.
        header('Location: ' . base_url());
    }
?>
<style>
  #btnConsultarRuta {
    display: none;
  }
  .modal.fade.in {
    display: block;
  }
  #btnConsultarRecorrido {
    display: none !important;
  }  
  #map+#bar {
    display: none;
  }
  #panel {
    position: absolute;
    top: 5px;
    left: 50%;
    margin-left: -180px;
    z-index: 5;
    background-color: #fff;
    padding: 5px;
    border: 1px solid #999;
  }

  #bar {
    width: 240px;
    background-color: rgba(255, 255, 255, 0.75);
    margin: 8px;
    padding: 4px;
    border-radius: 4px;
  }

  #autoc {
    width: 100%;
    box-sizing: border-box;
  }

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
    position:absolute;
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
        position: fixed;
        bottom:0;
        right:0;
        max-width: 350px;
        width: 350px;
        box-shadow: none;
        -webkit-box-shadow: none; 
        z-index: 1;                 
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

    /*===========================*/
    /*=======LOADER STYLES=======*/
    /*===========================*/

    .tab-pane .loader {
      border: 5px solid #f3f3f3;
      border-top: 5px solid #5690b3;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spinl 2s linear infinite;
      margin: auto;
      position: inherit;
      margin-top: 30px;
      background: transparent;
      display: none;
    }

    @keyframes spinl {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
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
  <?= $menuPrincipal;?>
  <?= $menuServicios;?>
  <ul class="nav navbar-nav windowHidden" style="display: none;">                
    <li class="dropup">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="background: #4b67a8;
    border: 1px solid #2e4588; color:#FFF;width: 350px; height: 42px; border-radius: 2px"><i class="fa fa-chevron-up"></i></a>
        <ul class="dropdown-menu">
        </ul>
    </li>
  </ul>
  <div class="contenidoBorde">    
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
        <div class="col-md-12">
            <h3 class="text-primary text-right">
                <?= $titulo;?>
            </h3>
        </div>
      </div>

     

      <div class="row" id="divDatos">
        <div class="col-md-2">
          <label for="selectruta" style="margin-top: 5px"><font color="#09C" size="2">Seleccione Ruta</font></label>
        </div>
        <div class="col-md-4">
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

        <div class="col-md-2">
          <label for="txtFecha" style="margin-top: 5px"><font color="#09C" size="2">Seleccione Fecha</font></label>
        </div>
        <div class="col-md-3">
          <input class="form-control" type="date" name="txtFecha" id="txtFecha">
          <?php
                $attributesErrorFecha = array(
                    'id' => 'lblErrorFecha',
                    'style' => 'display: none;',
                    'class' => 'errorDato'
                );
                echo form_label("", "txtFecha", $attributesErrorFecha);
              ?>
        </div>
      </div><br>
      <div class="row">
        <div class="col-md-11" align="right">
          <button type="button" id="btnConsultarRuta" class="btn btn-primary">Consultar Ruta</button>            
        </div>
      </div><br>
  
      <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist" id="myTabs"> 
          <li role="presentation" class="active">
            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
              Regitro estudiantes
            </a>
          </li>
          <li role="presentation">
            <a href="#particuliaridades" aria-controls="particuliaridades" role="tab" data-toggle="tab">
              Observaciones particulares
            </a>
          </li>
          <li role="presentation">
            <a href="#messagesMonitores" aria-controls="messagesMonitores" role="tab" data-toggle="tab">
              Mensajes Monitores
            </a>
          </li>
          <li role="presentation">
            <a href="#alertas" aria-controls="alertas" role="tab" data-toggle="tab">
              Alertas
            </a>
          </li>
          <li role="presentation">
            <a href="#chatAcudiente" aria-controls="chatAcudiente" role="tab" data-toggle="tab">
              Chat con acudiente
            </a>
          </li>
          <li role="presentation">
            <a href="#recorrido_graf" aria-controls="recorrido_graf" role="tab" data-toggle="tab">
              Recorrido gráfico
            </a>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <!-- TAB INICIO -->
          <div role="tabpanel" class="tab-pane active" id="home">
            <div class="loader"></div>
          </div>
          <!-- TAB PARTICULIARIDADES -->
          <div role="tabpanel" class="tab-pane" id="particuliaridades">
            <div class="loader"></div>
          </div>
          <!-- TAB MENSAJES MONITORES -->
          <div role="tabpanel" class="tab-pane" id="messagesMonitores">
            <div class="loader"></div>
            <ul id="messagesMonitores-list" style="list-style:none; width: 100%;"></ul>
          </div>
          <!-- TAB MENSAJES ALERTAS -->
          <div role="tabpanel" class="tab-pane" id="alertas">
            <div class="loader"></div>
            <ul id="alertas-list" style="list-style:none; width: 100%;"></ul>
          </div>
          <!-- TAB CHAT ACUDIENTE Y CENTRO -->
          <div role="tabpanel" class="tab-pane" id="chatAcudiente">
            <div class="loader"></div>
            <ul id="chatAcudiente-list" style="list-style:none; width: 100%;"></ul>
          </div>
          <!-- TAB RECORRIDO GRAFICO -->
          <div role="tabpanel" class="tab-pane" id="recorrido_graf" style="position: relative;">
            <!-- <div class="loader"></div>
            <div class="pull-right" style="position: absolute; z-index: 1111; right: 0;">
              <button type="button" class="btn btn-default" title="Actualizar" id="actualizar_mapa">
                <span class="glyphicon glyphicon-refresh"></span>
              </button>
            </div>
            <div id="map_canvas" style="width:100%;height:400px;"></div> -->
            <!-- <a onclick="window.exporLogRuta(event)" target="_blank" class="btn btn-default" style="position: absolute; z-index: 11111; right: 10px; top: 10px;">
              Exportar log ruta
            </a> -->
            <div id="map" style="width:100%;height:400px;"></div>
<!--             <div id="bar">
              <p class="auto"><input type="text" id="autoc"/></p>
              <p><a id="clear" href="#">Haz clic aquí</a> para borrar el mapa.</p>
            </div> -->
          </div>
        </div>

      </div>

      


    
    <div class="row">
        <div class="col-md-12" align="right">
          
        </div>
      </div><br>
      </form>
    </div>
  </div> <br><br>

  <button type="button" id="btnRegresar" class="btn btn-primary" style="display:none;float: right; margin-right: 3%">Regresar</button>      
  <button type="button" id="btnConsultarRecorrido" class="btn btn-primary" style="display:none;float: right; margin-right: 3%">Consultar Recorrido Grafico</button>            

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
      <div class="container">
        <div class="row" align="center" id="chats">           
            
        </div>
      </div>
      <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="../../js/chat.js"></script>
      <script type="text/javascript">
        window._base_url = '<?php echo base_url() ?>';
        var totalItem = 0;
        var contadorFilasAgregadas = 1;
        var contadorColumnasAgregadas = 1;
        var contadorId = 1;
        var map;
        
        var markers = [];
        var markersAlertas = [];
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
          
          var fechaIn = year + "-" + mes + "-" + dia;
          var fecha = dia + "/" + mes + "/" + year;
          
        }


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
          var ruta = $("#selectruta").val();
          var fecha = $("#txtFecha").val();
          $("#tbody").html("")
          
          if(fecha){
            var datos = {
              idruta: ruta,
              fecha: fecha
            }   
            
            $.post("<?= base_url();?>index.php/rutas/ListarEstudiantesBitacora", datos)
            .done(function( data ) {
              if($.trim(data) != "[]"){
                // var json = JSON.parse(data);
                var json = data;
                $("#tbody").html("");
                $.each(json, function(i, item) {
                  var mensajes = "";
                  if(json[i].mensajes && json[i].mensajes.length == 0){
                    mensajes = "NO TIENE MENSAJES";
                  }else{
                    mensajes = "<a href='#' data-toggle='modal' data-target='#myModal' id='enlacePopUp" + i + "' mensajes='" + json[i].id + "' itera='" + i + "'>MENSAJES</a>";
                  }
                  $("#tbody").append('<tr align="center"><td>' + json[i].PrimerApellido + ' ' + json[i].SegundoApellido + ' ' + json[i].PrimerNombre + ' ' + json[i].SegundoNombre + '</td><td>' + (json[i].tipo == "RECOGIDA" ? json[i].hora : '') + '</td><td>' + (json[i].tipo != "RECOGIDA" ? json[i].hora : '')+ '</td><td>' + mensajes + '</td></tr>');

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
                });
              }else{
                $("#tbody").html('<tr align="center"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>')
              }
              

            })
            $("#lblErrorFecha").html("")
            $("#btnConsultarRecorrido").css({"display":"block"})
          }else{
            $("#lblErrorFecha").html("Debe seleccionar primero una fecha")
            $("#lblErrorFecha").css({"display":"block"})
          }

          

          

          $("#btnConsultarRecorrido").css({"display":"block"})
          
        });
        $("#txtFecha").keyup(function(e) {
          var fecha = $("#txtFecha").val();
          if(fecha){
            $("#lblErrorFecha").html("")
            $("#lblErrorFecha").css({"display":"none"})
          }else{
            $("#lblErrorFecha").html("Debe seleccionar primero una fecha")
            $("#lblErrorFecha").css({"display":"block"})
          }
        });

        $("#btnConsultarRecorrido").on('click', function(e) {
          var ruta = $("#selectruta").val();
          var fecha = $("#txtFecha").val();
          //$("#btnConsultarRecorrido").css({"display":"none"})
          //$("#divTabla").css({"display":"none"})
          $("#divMapa").css({"visibility":"visible"})
          //$("#divDatos").css({"display":"none"})
          //$("#btnConsultarRuta").css({"display":"none"})
          //$("#btnRegresar").css({"display":"block"})
          MostrarDatosRuta(ruta, directionsService, directionsDisplay);
          MostrarBus(ruta, fecha);
          mostrarAlertasRuta(ruta, fecha);
          setTimeout(function() {
            google.maps.event.trigger(map, 'resize');
          }, 500);
        });

        $("#btnRegresar").click(function(e) {
          $("#divTabla").css({"display":"block"})
          $("#divMapa").css({"visibility":"hidden"})
          $("#divDatos").css({"display":"block"})
          $("#btnConsultarRuta").css({"display":"block"})
          $("#btnRegresar").css({"display":"none"})
        })

        function MostrarDatosRuta(idruta, directionsService, directionsDisplay){  
          $.post("<?= base_url();?>index.php/rutas/ObtenerRutaDetallada", {ruta:idruta})
          .done(function( data ) {
            var json = JSON.parse(data);
            $.each(json, function(i, item) {
              var CoordenadasOrigenRuta = json[i].latorigen + "," + json[i].longorigen;
              var CoordenadasDestinoRuta = json[i].latdestino + "," + json[i].longdestino;
              
              calculateAndDisplayRoute(directionsService, directionsDisplay, CoordenadasOrigenRuta, CoordenadasDestinoRuta);
            });
          });

        }

        function MostrarBus(idruta, fecha){
          var datos = {
            idruta: idruta,
            fecha: fecha
          } 
          $.post("<?= base_url();?>index.php/rutas/ObtenerTodasCoordenadasBus", datos)
          .done(function( data ) {console.log(data)
            deleteMarkers();
            if($.trim(data) != "[]"){
             
              
              var json = JSON.parse(data);      
              
              for (var i = 0; i < json.length; i++) {
                var datosBus = json[i].coordenadas_recogida;
                var coordenadas = datosBus.split(",");
                var lats = parseFloat(coordenadas[0]);
                var longs = parseFloat(coordenadas[1]);; 

                var latLng = new google.maps.LatLng(lats, longs);
               
                //creamos el marcador en el mapa
                var marker3 = new google.maps.Marker({
                  map: map,//el mapa creado en el paso anterior
                  position: latLng,//objeto con latitud y longitud
                  icon: '<?= base_url();?>images/circle_yellow.png',
                  draggable: false //que el marcador se pueda arrastrar
                });
                
                //markers.push(marker);
              }

            }else{
              
            }
          });
        }

        function mostrarAlertasRuta(idruta, fecha){
          
          var datos = {
            idruta: idruta,
            fecha: fecha
          } 
          $.post("<?= base_url();?>index.php/rutas/mostrarAlertasRuta", datos)
          .done(function( data ) {console.log(data)
            deleteMarkers();
            if($.trim(data) != "[]"){           
              
              var json = JSON.parse(data);      
              
              for (var i = 0; i < json.length; i++) {
                var datosBus = json[i].coordenadas_recogida;
                var coordenadas = datosBus.split(",");
                var lats = parseFloat(coordenadas[0]);
                var longs = parseFloat(coordenadas[1]);
                var icono = "";
                var latLng = new google.maps.LatLng(lats, longs);
                //console.log(json[i].mensaje)
                switch(json[i].mensaje){
                  case "ALERTA DE ACCIDENTE":
                    icono = "<?= base_url();?>img/AlertaAccidente.png";
                    break;
                  case "INCIDENTE MECANICO":
                    icono = "<?= base_url();?>img/AlertaFallaMecanica.png";
                    break;
                  case "TRÁFICO LENTO":
                    icono = "<?= base_url();?>img/AlertaTraficoLento.png";
                    break;
                  case "DAÑO DE NEUMATICO":
                    icono = "<?= base_url();?>img/AlertaDanoNeumatico.png";
                    break;
                }

                //creamos el marcador en el mapa
                var marker2 = new google.maps.Marker({
                  map: map,//el mapa creado en el paso anterior
                  position: latLng,//objeto con latitud y longitud
                  icon: icono,
                  draggable: false //que el marcador se pueda arrastrar
                });
                
                markersAlertas.push(marker2);
                attachSecretMessage(marker2, json[i].hora);
                
              }
              
              
            }else{
              
            }
          });
        }

        // Attaches an info window to a marker with the provided message. When the
        // marker is clicked, the info window will open with the secret message.
        function attachSecretMessage(marker, secretMessage) {
          var infowindow = new google.maps.InfoWindow({
            content: secretMessage
          });

          marker.addListener('click', function() {
            infowindow.open(marker.get('map_canvass2'), marker);
          });
        }

        function MostrarEstudiantes(idruta){  
  
          
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
                  console.log('localizacion: ' + route.legs);
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

      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJhwAnBcf7HiAk8mhenonqyOyXrmwh3g&signed_in=true&callback=initMap" async defer></script>

      <!-- <script src="https://maps.googleapis.com/maps/api/js?libraries=drawing,places"></script> -->

      <footer class="footer">
        <img alt="" src="<?= base_url();?>images/logo.png" width="300" height="110"  border="0"></footer>
      </footer>
      
      <!-- =====================================
        MANGER TAB BITACORA
      ===================================== -->
      <script src="<?php echo base_url().'js/BitacoraRuta.js' ?>"></script> 

    </body>
</html>