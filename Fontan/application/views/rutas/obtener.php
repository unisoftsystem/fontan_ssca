<?php
    $UserName = $this->session->userdata('UserNameInternoSSCA');
    if(empty($UserName)) { // Recuerda usar corchetes.
        header('Location: ' . base_url());
    }
?>
<style>  
  input[type=text]
    background-color: #ffe9a3;
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
      position:relative;
    bottom: 0;
    left: 0;
    width: 100%;
    /* Set the fixed height of the footer here */
    height: 13%;
    background-color: #f5f5f5;
  }
  .ui-datepicker-title{
    color: #000;
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
  border-collapse: seperate;
  border-spacing: 5px;
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
i{
  cursor: pointer;
}
.form-control{
  background-color: #ffe9a3;
  margin-bottom: 10px;
}
label{
  padding: 0;
  font-family: "Calibri";
  font-weight: normal;
  margin-right: -35px;
  width: 100%;
  /*margin-top: 7px;*/
  margin-left: 8px;
  text-align: left;
}
.row{
}
.col-md-1, .col-md-2, .col-md-3{
}
*{
  font-family: "Calibri";
}
.radio-inline{
  font-size: 12px;
}
.radio-inline > input{
  margin-top: 2px;
}
input[disabled="disabled"] { 
  background-color: #ffe9a3;
}
</style>
<script src="<?= base_url();?>js/drag/jquery-git2.min.js"></script>
<script src="<?= base_url();?>js/drag/jquery.event.drag-2.2.js"></script>
<script src="<?= base_url();?>js/drag/jquery.event.drag.live-2.2.js"></script>
<script src="<?= base_url();?>js/drag/jquery.event.drop-2.2.js"></script>
<script src="<?= base_url();?>js/drag/jquery.event.drop.live-2.2.js"></script>
<script src="<?= base_url();?>js/drag/excanvas.min.js"></script>
<script src="<?= base_url();?>js/drag/watermark-polyfill.js"></script>
<script type="text/javascript">
  //Declaramos las variables que vamos a user
  var lat = null;
  var lng = null;
  var map = null;
  var geocoder;
  var marker = null;

  var lat1 = null;
  var lng1 = null;
  var map1 = null;
  var geocoder1 = null;
  var marker1 = null;
  var directionsService;
  var directionsDisplay;

  var lat2 = null;
  var lng2 = null;
  var map2 = null;
  var geocoder2 = null;
  var marker2 = null;
           
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
     

        lat1 = jQuery('#lats').val();
       lng1 = jQuery('#longs').val();
       jQuery('#pasars').click(function(){        
          codeAddress1();
          return false;
       });

      

      $('#tablaOrden > thead > tr > td').each(function(index) {
        var ancho = $(this).width() + 10
        for (var i = 0; i < $("#tablaOrden")[0].children[1].children.length; i++) {
          $("#tablaOrden > tbody > tr")[i].children[index].style.width = ancho + "px"
          console.log(ancho + " " + index)
        }
        
      });
  });

  $(window).bind("resize", function() {
    $('#tablaOrden > thead > tr > td').each(function(index) {
      var ancho = $(this).width() + 10
      for (var i = 0; i < $("#tablaOrden")[0].children[1].children.length; i++) {
        $("#tablaOrden > tbody > tr")[i].children[index].style.width = ancho + "px"
      }
      
    });
  });


       
      function initialize() {
        directionsService = new google.maps.DirectionsService;
        directionsDisplay = new google.maps.DirectionsRenderer;

        geocoder = new google.maps.Geocoder();
        
        //Si hay valores creamos un objeto Latlng
        if(lat2 !=null && lng2 != null)
        {
           var latLng2 = new google.maps.LatLng(lat2,lng2);
        }
        else
        {
           var latLng2 = new google.maps.LatLng(4.710988599999999,-74.072092);
        }
        //Definimos algunas opciones del mapa a crear
         var myOptions2 = {
            center: latLng2,//centro del mapa
            zoom: 15,//zoom del mapa
            mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc
          };
          //creamos el mapa con las opciones anteriores y le pasamos el elemento div
          map2 = new google.maps.Map(document.getElementById("map_canvass2"), myOptions2);


          directionsDisplay.setMap(map2);
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

<body id="bodyBase"">
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
    <form class="cmxform" method="POST" action="" id="">
      <div class="row" style="margin-top: -20px">
        <div class="col-md-12" style="background-image: url('<?= base_url();?>img/www logo rutas escolares.png'); background-repeat: no-repeat; background-size: 100% 100%; padding-top: 10px; padding-bottom: 10px; height: 192px" align="center">

            <a style="position: absolute; bottom: -6px; right: 410px" href="<?= base_url();?>index.php/rutas/nuevo"><img src="<?= base_url();?>img/www creacion ruta escolar.png" width="100px" height="100px"></a>&nbsp;

            <a style="position: absolute; bottom: -6px; right: 300px" href="<?= base_url();?>index.php/rutas/editar"><img src="<?= base_url();?>img/www modificarcion ruta escolar.png" width="100px" height="100px" border="0"></a>

            <a style="position: absolute; bottom: -30px; right: 190px; border: 5px solid #f59540; border-radius: 100%; padding: 0px" href="<?= base_url();?>index.php/rutas/obtener"><img src="<?= base_url();?>img/www tracking ruta escolar.png" width="100px" height="100px" border="0"></a>

            <a style="position: absolute; bottom: -6px; right: 80px" href="<?= base_url();?>index.php/usuarios_sistema/homeInternoModulos"><img src="<?= base_url();?>img/www menu anterior.png" width="100px" height="100px" border="0"></a><br>

        </div>
      </div>
      
      <div class="row">
        <div class="col-md-3">
          <h3 class="text-primary">
            <?= $titulo;?>
            <hr>
          </h3>
        </div>

        <div class="col-md-3" style="padding: 0px">
          <select class="form-control" id="selectruta" name="selectruta" style="margin-top: 15px;"> 
            <option value="Seleccione">Seleccione...</option>
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

        <div class="col-md-3" style="padding: 0px" align="center">
          <button type="button" id="btnTodasRutas" class="btn btn-primary" style="margin-top: 15px; background-color: #f59540; border-color: #f59540">Todas las Rutas</button>     
        </div>
      </div>

      <div class="row" style="padding: 0px; margin: 0px">       
        <div class="col-md-1">
          <label>Nombre de la ruta</label>
        </div>

        <div class="col-md-5">
          <input type="text" class="form-control" id="txtNombre" name="txtNombre" disabled="disabled">
          <?php
            $attributesErrorNombreRuta = array(
                'id' => 'lblErrorNombreRuta',
                'style' => 'display: none;',
                'class' => 'errorDato'
            );
            echo form_label("", "txtNombre", $attributesErrorNombreRuta);
          ?>
        </div>

        <div class="col-md-1">
          <label>Selección de Vehiculo</label>
        </div>

        <div class="col-md-2">          
          <select class="form-control" id="ruta" name="ruta" disabled="disabled"> 
            <?php
                /*
                    Se valida que el result de la consulta de tecnicas tenga datos.
                    Este valor es enviado desde la funcion del controlador
                */                                    
                if($vehiculos){
                    //Se itera el result de los tecnicos. $tecnicos es enviado como un objeto, el cual para obtener los datos se obtiene un array asociativo, el cual se itera con un foreach y se muestra en el select
                    foreach ($vehiculos->result() as $value) {
            ?>
            <option value="<?= $value->idvehiculo?>" sillas="<?= $value->sillas?>"><?= $value->categoria . " " . $value->placa;?></option>
            <?php

                    }
                    ?>
                    <input type="hidden" id="vehiculohidden" value="<?= $vehiculos->result()[0]->idvehiculo?>">
                    <?php
                }else{
                ?>
                    <input type="hidden" id="vehiculohidden">
                <?php
                }
            ?>           
          </select>
        </div>

        <div class="col-md-1">   
          <label>Color</label>
        </div>

        <div class="col-md-2">
          <input type="color" class="form-control" id="txtColor" name="txtColor" placeholder="" disabled="disabled">
            <?php
              $attributesErrorColorRuta = array(
                  'id' => 'lblErrorColorRuta',
                  'style' => 'display: none;',
                  'class' => 'errorDato'
              );
              echo form_label("", "txtColor", $attributesErrorColorRuta);
            ?>
        </div>
      </div>

      <div class="row" style="padding: 0px; margin: 0px">
        <div class="col-md-1">
          <label>Fecha de Inicio</label>
        </div>

        <div class="col-md-2">
          <input type="date" class="form-control" id="txtFechaInicio" name="txtFechaInicio" placeholder="Fecha de Inicio" onchange="compare_dates()" min="<?php echo date("Y-m-d");?>" max="<?php echo date("Y") . '-12-31';?>" disabled="disabled">          
        </div>

        <div class="col-md-1">
          <label>Fecha Final</label>
        </div>

        <div class="col-md-2">
          <input type="date" class="form-control" id="txtFechaFinal" name="txtFechaFinal" placeholder="Fecha Final" style="background-color: #ffe9a3;" disabled="disabled" onchange="compare_dates()" min="<?php echo date("Y-m-d");?>" max="<?php echo date("Y") . '-12-31';?>">
        </div>

        <div class="col-md-1">
          <label>Selección de Conductor</label>
        </div>

        <div class="col-md-2 ">
          <select class="form-control" id="conductor" name="conductor" disabled="disabled">
            <?php
                /*
                    Se valida que el result de la consulta de tecnicas tenga datos.
                    Este valor es enviado desde la funcion del controlador
                */                                    
                if($conductores){
                    //Se itera el result de los tecnicos. $tecnicos es enviado como un objeto, el cual para obtener los datos se obtiene un array asociativo, el cual se itera con un foreach y se muestra en el select
                    foreach ($conductores->result() as $value) {
            ?>
            <option value="<?= $value->idconductor?>"><?= $value->nombre . " " . $value->apellido;?></option>
            <?php

                    }
                }
            ?>                       
          </select>
        </div>

        <div class="col-md-1">
          <label>Repetir</label>
        </div>

        <div class="col-md-2" style="padding: 0px; margin: 0px; background-color: #ffe9a3;">  
          <div class="col-md-6" style="padding: 0px; margin: 0px">  
            <label class="radio-inline"><input type="radio" name="radioRepetir" id="radioNunca" value="NUNCA" checked="checked" disabled="disabled">Nunca</label>
          </div>

          <div class="col-md-6" style="padding: 0px; margin: 0px"> 
            <label class="radio-inline"><input type="radio" name="radioRepetir" id="radioDiariamente" value="DIARIAMENTE" disabled="disabled">Diariamente</label> 
          </div>

          <div class="col-md-6" style="padding: 0px; margin: 0px"> 
            <label class="radio-inline"><input type="radio" name="radioRepetir" id="radioSemanalmente" value="SEMANALMENTE" disabled="disabled">Semanalmente</label> 
          </div>

          <div class="col-md-6" style="padding: 0px; margin: 0px"> 
            <label class="radio-inline"><input type="radio" name="radioRepetir" id="radioMensualmente" value="MENSUALMENTE" disabled="disabled">Mensualmente</label> 
          </div>

        </div>
      </div>

      <div class="row" style="padding: 0px; margin: 0px"> 
        <div class="col-md-1">
          <label>Hora de Inicio</label>
        </div>

        <div class="col-md-2">
          <input type="time" class="form-control" id="txtHoraInicio" name="txtHoraInicio" placeholder="Hora de Inicio" onchange="CompararHoras()" disabled="disabled">
        </div>

        <div class="col-md-1">
          <label>Hora Final</label>
        </div>

        <div class="col-md-2">
          <input type="time" class="form-control" id="txtHoraFinal" name="txtHoraFinal" placeholder="Hora Final" onchange="CompararHoras()" disabled="disabled">
        </div>
          
        <div class="col-md-1"> 
          <label>Selección de Monitor</label>
        </div>

        <div class="col-md-2"> 
          <select class="form-control" id="monitor" name="monitor" disabled="disabled"> 
            <?php
                /*
                    Se valida que el result de la consulta de tecnicas tenga datos.
                    Este valor es enviado desde la funcion del controlador
                */                                    
                if($monitores){
                    //Se itera el result de los tecnicos. $tecnicos es enviado como un objeto, el cual para obtener los datos se obtiene un array asociativo, el cual se itera con un foreach y se muestra en el select
                    foreach ($monitores->result() as $value) {
            ?>
            <option value="<?= $value->idmonitor?>"><?= $value->nombre . " " . $value->apellido;?></option>
            <?php

                    }
                }
            ?>         
          </select>

          <input type="hidden" class="form-control" readonly name="lat" id="lat"/>
          <input type="hidden" class="form-control" readonly name="lng" id="long"/>
          <!--campos ocultos donde guardamos los datos--> 
          <input type="hidden" class="form-control" readonly name="lats" id="lats"/>
          <input type="hidden" class="form-control" readonly name="lngs" id="longs"/>
          <input type="hidden" class="form-control" id="cursos" name="cursos" readonly>
          <input type="hidden" class="form-control" id="busquedas" name="busquedas" readonly >
          <input type="hidden" class="form-control" id="rutas" name="rutas" readonly>
          <input type="hidden" class="form-control" id="monitores" name="monitores" readonly >        
          <input type="hidden" class="form-control" id="conductores" name="conductores" readonly >        
        </div>          

          
      </div>

      

      <hr>

      <div class="row">
        <div class="col-md-12" align="right"> 
          <button class="btn btn-primary" type="button" id="btnVerMapa" disabled="disabled">Ver Bus</button>
        </div>
      </div>
      
      <div class="row" style="margin-top: 10px">
        <div class="col-md-6" align="center" style="height: 320px;">
          <div style="width: 98%; padding: 0px; border: 1px solid #ffe9a3; margin-bottom: 10px; height: 310px">
            <div style="background-color: #fff1c5; width: 100%; margin-bottom: 10px">
              <label>Orden de Recogida en Ruta Escolar</label>  
            </div>
            
            <table width="100%" border="0" style="border-collapse: separate;" id="tablaOrden">
              <thead style="width: 95%">
                <tr style="background-color: #fff1c5">
                    <td align="center">Identificador</td>
                    <td width="25%">Nombre Estudiante</td>
                    <td width="10%">H.Recogido</td>
                    <td width="10%">H.Entregado</td>
                    <td align="center">Mensajes de Rutas</td>
                </tr>
              </thead>
              <tbody>
                           
              </tbody>
            </table><br>
          </div>
        </div>

        <div class="col-md-6" style="background-color: #d9d9d9; padding: 5px">
          <div id="map_canvass2" style="width:100%;height:300px;"></div>
        </div>
      </div>

    

  
      

    </form><br>
  
  </div>
    <div class="container">
        <div class="row" align="center" id="chats">           
            
        </div>
    </div>

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
    <div id="myModalEstudiante" class="modal" style="top: 20%;width: 70%;left: 1%;" data-backdrop="static">

      <!-- Modal content -->
      <div class="modal-content">
        <!--<span class="close" id="cerrar">x</span><br><br>
        <hr>-->
        <div class="row" style="border: 1px solid #09C; border-radius: 4px; margin-top: 0px; margin-left: 5px; margin-right: 5px">
          <div class="col-md-2">
            <img src="<?= base_url();?>images/stock_people.png" width="100%" id="fotoEstudiante">
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
    <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
    <script type="text/javascript" src="../../js/chat.js"></script>
    <script src="<?= base_url();?>js/jquery-loader.js" type="text/javascript"></script>
      
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
        var interval;
        var marker;
        var markers = [];
        var markersAlertas = [];
        var abecedario=new Array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');

       

        $("input").css({"background-color": "#ffe9a3"})
        $("select").css({"background-color": "#ffe9a3"})

        $("#selectruta").change(function(e) {
          clearInterval(interval);
          var ruta = $("#selectruta").val();
          
          $("#container-player").html("")
          $("#container-field > div").html("")
          $("#tablaOrden > tbody").html("")

          if(ruta != "Seleccione"){
            $("#btnVerMapa").removeAttr("disabled")
            initialize()

            $.post("<?= base_url();?>index.php/rutas/ObtenerRuta", {ruta:ruta})
            .done(function( data ) {
              //console.log(data)
              $("#btnCrearRuta").css({"display":"block"})
              var json = JSON.parse(data);
              
              $.each(json, function(i, item) {
                
                $("#txtColor").val(json[i].color)                              
                $("#txtNombre").val(json[i].nombreruta)                              
                $("#txtColorHidden").val(json[i].color)
                $("#txtFechaInicio").val(json[i].fechainicial)                              
                $("#txtFechaFinal").val(json[i].fechafinal)                              
                $("#txtHoraInicio").val(json[i].horainicial)                              
                $("#txtHoraFinal").val(json[i].horafinal)    
                $("#lat").val(json[i].latorigen)
                $("#long").val(json[i].longorigen)
                $("#lats").val(json[i].latdestino)
                $("#longs").val(json[i].longdestino)                          
                $("input[name=radioRepetir][value='" + json[i].repetir + "']").prop("checked",true);
                
                $("#monitor").val(json[i].monitor)
                $("#monitores").val(json[i].monitor)

                $("#ruta").val(json[i].idruta)
                $("#vehiculohidden").val(json[i].idruta)

                $("#conductor").val(json[i].id_conductor) 
                $("#conductores").val(json[i].id_conductor) 
                
                if(json[i].repetir == "NUNCA"){
                  $("#txtFechaFinal").attr("min", json[i].horainicial)
                  $("#txtFechaFinal").attr("max", json[i].horainicial)
                  $("#txtFechaFinal").attr("disabled", "disabled")
                }else{
                           
                }

                MostrarTablaEstudiantes(ruta)
                MostrarBus(ruta)
                mostrarAlertasRuta(ruta)
                MostrarCoodenadasBus(ruta)

                interval = setInterval(function(){ ;
                  //MostrarTablaEstudiantes(ruta)
                  MostrarBus(ruta)  
                }, 500);
                
                  
                
              })
            })
          }else{
            $("#btnVerMapa").attr("disabled", "disabled")
            $("#btnCrearRuta").css({"display":"none"})
            $("input").val("")
            $("button").attr("disabled", "disabled")
            $("input").attr("disabled", "disabled")
            $("#ruta").val("")
            $("#conductor").val("")
            $("#monitor").val("")
            $("#ruta").attr("disabled", "disabled")
            $("#conductor").attr("disabled", "disabled")
            $("#monitor").attr("disabled", "disabled")
            $("#curso").attr("disabled", "disabled")
            directionsDisplay.setMap(null);
          }
        })

        $("#btnVerMapa").click(function(e){
          if(marker != null){
            var center = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
          
            map2.panTo(center);
            console.log(marker.position.lat() + " " + marker.position.lng())
          }
          
        })

        function MostrarEstudiantes(jsonUsuario) {
          if(jsonUsuario.length > 0){   

            $.each(jsonUsuario, function(i, item) {  

              agregarTabla(jsonUsuario[i].PrimerNombre + " " + jsonUsuario[i].PrimerApellido, jsonUsuario[i].NumeroId)               
              
              $( "#foto" + jsonUsuario[i].NumeroId ).error(function() {
                $(this).attr("src", "<?= base_url();?>images/stock_people.png")
              })/*.attr("src", "<?= base_url();?>images/stock_people.png")*/                

              
            })

            actualizarMapa()
          }
        }        
                
        $("#container-player").html("")
        $("#tablaOrden > tbody").html("") 
        
        function actualizarMapa() {
          var CoordenadasOrigenRuta = $("#lat").val() + "," + $("#long").val();
          var CoordenadasDestinoRuta = $("#lats").val() + "," + $("#longs").val();
          var waypts=[];    
          console.log(CoordenadasOrigenRuta)
          console.log(CoordenadasDestinoRuta)
          //console.log(waypts)

          $("#tablaOrden > tbody > tr").each(function (index) {
            var datos = {
              document: $(this).attr("documento")
            }         
            $.post("<?= base_url();?>index.php/usuarios_aplicaciones/ConsultarUsuarioDocumento", datos)
            .done(function( data ) {//console.log(data)
                       

              if($.trim(data) != "{}"){
                var json = JSON.parse(data);

                var latlon = new google.maps.LatLng(json.latitud,json.longitud);
                waypts.push({
                  location: latlon,
                  stopover: true
                });
              }

              

              if(($("#tablaOrden > tbody > tr").length - 1) == index){
                
                directionsService.route({
                  origin: CoordenadasOrigenRuta,
                  destination: CoordenadasDestinoRuta,
                  waypoints: waypts,
                  travelMode: google.maps.TravelMode.DRIVING
                }, function(response, status) {
                  console.log(response)
                  if (status === google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                  } else {
                    window.alert('No se puede trazar la ruta en el mapa ' + status);
                  }
                });
              }
                            

            })
          })
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
        
       
        
        

        function agregarTabla(nombre, documento) {
          var contadorID;
          if($("#tablaOrden > tbody > tr").length > 0){
            contadorID = parseInt($("#tablaOrden > tbody > tr:last").attr("ind")) + 1;
          }else{
            contadorID = 0;
          }
          $("#tablaOrden > tbody").append('<tr id="tr' + documento + '" ind="' + contadorID + '" documento="' + documento + '">' +
            '<td valign="middle" align="center">A</td>' +
            '<td valign="middle">' + nombre + '</td>' +
            '<td valign="middle" align="center"></td>' +
            '<td valign="middle" align="center"></td>' +
            '<td valign="middle" align="center"><a href="#" data-toggle="modal" data-target="#myModal" id="enlacePopUp' + contadorID + '" mensajes="" itera="' + contadorID + '">MENSAJES</a></td>' +
            '<td valign="middle" align="center"></td>' +
          '</tr>')

          $('#tablaOrden > thead > tr > td').each(function(index) {
            var ancho = $(this).width() + 10
            for (var i = 0; i < $("#tablaOrden")[0].children[1].children.length; i++) {
              $("#tablaOrden > tbody > tr")[i].children[index].style.width = ancho + "px"
              console.log(ancho + " " + index)
            }
            
          });


          
        }


        
        function MostrarTablaEstudiantes(idruta){  
  
          var datos = {
            idruta: idruta
          }   
          
          $.post("<?= base_url();?>index.php/rutas/ListarEstudiantesTracking", datos)
          .done(function( data ) {//console.log(data)
            if($.trim(data) != "[]"){
              var json = JSON.parse(data);
              $("#tablaOrden > tbody").html("")
              $.each(json, function(i, item) {
                if($.trim(json[i].TipoDatos) == "RECOGIDO"){
                  var mensajes = "";
                  if(json[i].mensajes.length == 0){
                    mensajes = "NO TIENE MENSAJES";
                  }else{
                    mensajes = "<a href='#' data-toggle='modal' data-target='#myModal' id='enlacePopUp" + i + "' mensajes='" + JSON.stringify(json[i].mensajes) + "' itera='" + i + "'>MENSAJES</a>";
                  }
                  $("#tablaOrden > tbody").append('<tr align="center" documento="' + json[i].NumeroId + '"><td>' + json[i].Indice + '</td><td id="estudiante' + i + '" idUsuario="' + json[i].idUsuario + '" itera="' + i + '" style="cursor:pointer">' + json[i].PrimerApellido + ' ' + json[i].SegundoApellido + ' ' + json[i].PrimerNombre + ' ' + json[i].SegundoNombre + '</td><td>' + json[i].HoraRecogido + '</td><td>&nbsp;</td><td>' + mensajes + '</td></tr>');

                  $('#tablaOrden > thead > tr > td').each(function(index) {
                    var ancho = $(this).width() + 10
                    for (var i = 0; i < $("#tablaOrden")[0].children[1].children.length; i++) {
                      $("#tablaOrden > tbody > tr")[i].children[index].style.width = ancho + "px"
                      console.log(ancho + " " + index)
                    }
                    
                  });

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
                            $("#fotoEstudiante").attr("src" , "<?= base_url();?>" + json[i].ImagenFotografica);
                            $("#estudianteTelefono").html("<b style='color: #337ab7'>TELEFONOS:</b> " + json[i].Telefono1.toUpperCase() + ' ' + json[i].Telefono2.toUpperCase());
                            $("#estudianteNombreAcudiente").html("<b style='color: #337ab7'>NOMBRE ACUDIENTE:</b> " + json[i].PrimerApellidoAcudiente.toUpperCase() + ' ' + json[i].SegundoApellidoAcudiente.toUpperCase() + ' ' + json[i].PrimerNombreAcudiente.toUpperCase() + ' ' + json[i].SegundoNombreAcudiente.toUpperCase());
                            $("#estudianteTelefonoAcudiente").html("<b style='color: #337ab7'>TELEFONO ACUDIENTE:</b> " + json[i].Telefono1Acudiente + ' ' + json[i].Telefono2Acudiente);
                            $("#estudianteEmail").html("<b style='color: #337ab7'>E-MAIL ACUDIENTE: </b>" + json[i].idUsuarioAcudiente.toUpperCase());
                          });
                        }else{
                          $("#estudianteNombre").html("");
                            $("#fotoEstudiante").attr("src" , "<?= base_url();?>images/stock_people.png");
                            $("#estudianteTelefono").html("");
                            $("#estudianteNombreAcudiente").html("");
                            $("#estudianteTelefonoAcudiente").html("");
                            $("#estudianteEmail").html("");
                        }
                        modal.style.display = "block";
                      });
                    
                    })

                   

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
                    $("#tablaOrden > tbody").append('<tr align="center" documento="' + json[i].NumeroId + '"><td>' + json[i].Indice + '</td><td id="estudiante' + i + '" idUsuario="' + json[i].idUsuario + '" itera="' + i + '" style="cursor:pointer">' + json[i].PrimerApellido + ' ' + json[i].SegundoApellido + ' ' + json[i].PrimerNombre + ' ' + json[i].SegundoNombre + '</td><td>' + json[i].HoraRecogido + '</td><td>' + json[i].HoraEntregado + '</td><td>' + mensajes + '</td></tr>');  

                    $('#tablaOrden > thead > tr > td').each(function(index) {
                      var ancho = $(this).width() + 10
                      for (var i = 0; i < $("#tablaOrden")[0].children[1].children.length; i++) {
                        $("#tablaOrden > tbody > tr")[i].children[index].style.width = ancho + "px"
                        console.log(ancho + " " + index)
                      }
                      
                    });

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
                              $("#fotoEstudiante").attr("src" , "<?= base_url();?>" + json[i].ImagenFotografica);
                              $("#estudianteTelefono").html("<b style='color: #337ab7'>TELEFONOS:</b> " + json[i].Telefono1.toUpperCase() + ' ' + json[i].Telefono2.toUpperCase());
                              $("#estudianteNombreAcudiente").html("<b style='color: #337ab7'>NOMBRE ACUDIENTE:</b> " + json[i].PrimerApellidoAcudiente.toUpperCase() + ' ' + json[i].SegundoApellidoAcudiente.toUpperCase() + ' ' + json[i].PrimerNombreAcudiente.toUpperCase() + ' ' + json[i].SegundoNombreAcudiente.toUpperCase());
                              $("#estudianteTelefonoAcudiente").html("<b style='color: #337ab7'>TELEFONO ACUDIENTE:</b> " + json[i].Telefono1Acudiente + ' ' + json[i].Telefono2Acudiente);
                              $("#estudianteEmail").html("<b style='color: #337ab7'>E-MAIL ACUDIENTE: </b>" + json[i].idUsuarioAcudiente.toUpperCase());
                            });
                          }else{
                            $("#estudianteNombre").html("");
                            $("#fotoEstudiante").attr("src" , "<?= base_url();?>images/stock_people.png");
                            $("#estudianteTelefono").html("");
                            $("#estudianteNombreAcudiente").html("");
                            $("#estudianteTelefonoAcudiente").html("");
                            $("#estudianteEmail").html("");
                          }
                          modal.style.display = "block";
                        });
                      
                      }) 

                    

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
                    $("#tablaOrden > tbody").append('<tr align="center" documento="' + json[i].NumeroId + '"><td>' + json[i].Indice + '</td><td id="estudiante' + i + '" idUsuario="' + json[i].idUsuario + '" itera="' + i + '" style="cursor:pointer">' + json[i].PrimerApellido + ' ' + json[i].SegundoApellido + ' ' + json[i].PrimerNombre + ' ' + json[i].SegundoNombre + '</td><td>&nbsp;</td><td>&nbsp;</td><td>' + mensajes + '</td></tr>');

                    $('#tablaOrden > thead > tr > td').each(function(index) {
                      var ancho = $(this).width() + 10
                      for (var i = 0; i < $("#tablaOrden")[0].children[1].children.length; i++) {
                        $("#tablaOrden > tbody > tr")[i].children[index].style.width = ancho + "px"
                        console.log(ancho + " " + index)
                      }
                      
                    });

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
                              $("#fotoEstudiante").attr("src" , "<?= base_url();?>" + json[i].ImagenFotografica);
                              $("#estudianteTelefono").html("<b style='color: #337ab7'>TELEFONOS:</b> " + json[i].Telefono1.toUpperCase() + ' ' + json[i].Telefono2.toUpperCase());
                              $("#estudianteNombreAcudiente").html("<b style='color: #337ab7'>NOMBRE ACUDIENTE:</b> " + json[i].PrimerApellidoAcudiente.toUpperCase() + ' ' + json[i].SegundoApellidoAcudiente.toUpperCase() + ' ' + json[i].PrimerNombreAcudiente.toUpperCase() + ' ' + json[i].SegundoNombreAcudiente.toUpperCase());
                              $("#estudianteTelefonoAcudiente").html("<b style='color: #337ab7'>TELEFONO ACUDIENTE:</b> " + json[i].Telefono1Acudiente + ' ' + json[i].Telefono2Acudiente);
                              $("#estudianteEmail").html("<b style='color: #337ab7'>E-MAIL ACUDIENTE: </b>" + json[i].idUsuarioAcudiente.toUpperCase());
                            });
                          }else{
                            $("#estudianteNombre").html("");
                            $("#fotoEstudiante").attr("src" , "<?= base_url();?>images/stock_people.png");
                            $("#estudianteTelefono").html("");
                            $("#estudianteNombreAcudiente").html("");
                            $("#estudianteTelefonoAcudiente").html("");
                            $("#estudianteEmail").html("");
                          }
                          modal.style.display = "block";
                        });
                      
                      })

                     

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
              actualizarMapa()
            }else{
              $("#tablaOrden > tbody").html("")
            }
          })
          
        } 
        

        $(".opcionMenuModulo").click(function(e){
            var id = $(this).attr("data-id");
            var texto = $(this).find("a").html();
            $.post("<?= base_url();?>index.php/usuarios_sistema/MostrarServicios", {id:id, texto:texto})
            .done(function( data ) {
                window.location.href = "<?= base_url();?>index.php/usuarios_sistema/homeInternoServicios";
            });
        });

        $("#btnTodasRutas").click(function(e) {
          window.location.href = "<?= base_url();?>index.php/rutas/todos";
        })

          
        

        function mostrarBoton(){
          var contador = 0;
          for (var i = 0; i < $(".errorDato").length; i++) {
            if($(".errorDato")[i].attributes[2].value == "display: none;"){
              contador++;
            }
          }
          if(contador == $(".errorDato").length){
            $("#btnCrearRuta").css({"visibility":"visible"});
          }else{
            $("#btnCrearRuta").css({"visibility":"hidden"});
          }
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
                map: map2,//el mapa creado en el paso anterior
                position: latLng,//objeto con latitud y longitud
                icon: '<?= base_url();?>img/Bus_tracking.png',
                draggable: false //que el marcador se pueda arrastrar
              });
              
              markers.push(marker);
              
            }else{
              
            }
          });
        }

        function MostrarCoodenadasBus(idruta){
          var datos = {
            idruta: idruta
          } 
          $.post("<?= base_url();?>index.php/rutas/ObtenerTodasCoordenadasBusSinFecha", datos)
          .done(function( data ) {console.log(data)
            //deleteMarkers();
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
                  map: map2,//el mapa creado en el paso anterior
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

        function mostrarAlertasRuta(idruta){
          
          var datos = {
            idruta: idruta
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
                  map: map2,//el mapa creado en el paso anterior
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


      </script> 
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJhwAnBcf7HiAk8mhenonqyOyXrmwh3g&callback=initialize"
        async defer></script>
      <footer class="footer">
        <img alt="" src="<?= base_url();?>images/logo.png" width="300" height="110"  border="0"></footer>
      </footer>
    </body>
</html>