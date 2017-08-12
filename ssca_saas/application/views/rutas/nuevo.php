<?php
    $UserName = $this->session->userdata('UserNameInternoSSCA');
    if(empty($UserName)) { // Recuerda usar corchetes.
        header('Location: ' . base_url(1));
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

table{
  border-collapse: seperate;
  border-spacing: 5px;
}

td{
  padding: 0px;

}
thead > tr > td{
  padding: 5px;
}
tbody > tr > td{
  padding: 3px;
  border: 1px solid #ccc;;
}
thead, tbody { display: block; width: 100%}

tbody {
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
</style>
<script src="<?= base_url(1);?>js/drag/jquery-git2.min.js"></script>
<script src="<?= base_url(1);?>js/drag/jquery.event.drag-2.2.js"></script>
<script src="<?= base_url(1);?>js/drag/jquery.event.drag.live-2.2.js"></script>
<script src="<?= base_url(1);?>js/drag/jquery.event.drop-2.2.js"></script>
<script src="<?= base_url(1);?>js/drag/jquery.event.drop.live-2.2.js"></script>
<script src="<?= base_url(1);?>js/drag/excanvas.min.js"></script>
<script src="<?= base_url(1);?>js/drag/watermark-polyfill.js"></script>
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

       var color = dame_color_aleatorio() + "";
       $("#txtColor").val(color)

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
          //Si hay valores creamos un objeto Latlng
         if(lat1 !='' && lng1 != '')
        {
           var latLng1 = new google.maps.LatLng(lat1,lng1);
        }
        else
        {
           var latLng1 = new google.maps.LatLng(4.710988599999999,-74.072092);
        }
        //Definimos algunas opciones del mapa a crear
         var myOptions1 = {
            center: latLng1,//centro del mapa
            zoom: 15,//zoom del mapa
            mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc
          };
          //creamos el mapa con las opciones anteriores y le pasamos el elemento div
           map1 = new google.maps.Map(document.getElementById("map_canvass"), myOptions);

          //creamos el marcador en el mapa
          marker1 = new google.maps.Marker({
              map: map1,//el mapa creado en el paso anterior
              position: latLng1,//objeto con latitud y longitud
              draggable: true //que el marcador se pueda arrastrar
          });
         //función que actualiza los input del formulario con las nuevas latitudes
         //Estos campos suelen ser hidden
          updatePosition1(latLng1);   
          google.maps.event.addListener(marker1, 'dragend', function(){
            updatePosition1(marker1.getPosition());
          });


           //Si hay valores creamos un objeto Latlng
         if(lat2 !='' && lng2 != '')
        {
           var latLng2 = new google.maps.LatLng(lat1,lng1);
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
           map2 = new google.maps.Map(document.getElementById("map_canvass2"), myOptions);

          //creamos el marcador en el mapa
          marker2 = new google.maps.Marker({
              map: map1,//el mapa creado en el paso anterior
              position: latLng2,//objeto con latitud y longitud
              draggable: true //que el marcador se pueda arrastrar
          });

          directionsDisplay.setMap(map2);
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

            if($.trim($("#lat").val()).length > 0 && $.trim($("#long").val()).length > 0 && $.trim($("#lats").val()).length > 0 && $.trim($("#longs").val()).length > 0 && $("#ruta > option").length > 0 > 0 && $("#conductor > option").length > 0 > 0 && $("#monitor > option").length > 0) {
              $("#btnActualizarMapa").removeAttr("disabled")
            }else{
              $("#btnActualizarMapa").attr("disabled")
            }
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
            if($.trim($("#lat").val()).length > 0 && $.trim($("#long").val()).length > 0 && $.trim($("#lats").val()).length > 0 && $.trim($("#longs").val()).length > 0 && $("#ruta > option").length > 0 > 0 && $("#conductor > option").length > 0 > 0 && $("#monitor > option").length > 0) {
              $("#btnActualizarMapa").removeAttr("disabled")
            }else{
              $("#btnActualizarMapa").attr("disabled")
            }
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
<script type="text/javascript">
  function nobackbutton(){
     window.location.hash="no-back-button";
     window.location.hash="Again-No-back-button" 
     window.onhashchange=function(){window.location.hash="no-back-button";} 
  }
</script>
<body id="bodyBase" onload="nobackbutton();">
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
        <div class="col-md-12" style="background-image: url('<?= base_url(1);?>img/www logo rutas escolares.png'); background-repeat: no-repeat; background-size: 100% 100%; padding-top: 10px; padding-bottom: 10px; height: 192px" align="center">

            <a style="position: absolute; bottom: -30px; right: 410px; border: 5px solid #f59540; border-radius: 100%; padding: 0px" href="<?= base_url();?>index.php/rutas/nuevo"><img src="<?= base_url(1);?>img/www creacion ruta escolar.png" width="100px" height="100px"></a>&nbsp;

            <a style="position: absolute; bottom: -6px; right: 300px" href="<?= base_url();?>index.php/rutas/editar"><img src="<?= base_url(1);?>img/www modificarcion ruta escolar.png" width="100px" height="100px" border="0"></a>

            <a style="position: absolute; bottom: -6px; right: 190px" href="<?= base_url();?>index.php/rutas/obtener"><img src="<?= base_url(1);?>img/www tracking ruta escolar.png" width="100px" height="100px" border="0"></a>

            <a style="position: absolute; bottom: -6px; right: 80px" href="<?= base_url();?>index.php/usuarios_sistema/homeInternoModulos"><img src="<?= base_url(1);?>img/www menu anterior.png" width="100px" height="100px" border="0"></a><br>

        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
            <h3 class="text-primary">
              <?= $titulo;?>
              <hr>
            </h3>
        </div>
      </div>

      <div class="row" style="padding: 0px; margin: 0px">       
        <div class="col-md-1">
          <label>Nombre de la ruta</label>
        </div>

        <div class="col-md-5">
          <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="">
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
          <select class="form-control" id="ruta" name="ruta"> 
            
          </select>
        </div>

        <div class="col-md-1">   
          <label>Color</label>
        </div>

        <div class="col-md-2">
          <input type="color" class="form-control" id="txtColor" name="txtColor" placeholder="">
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
          <input type="date" class="form-control" id="txtFechaInicio" name="txtFechaInicio" placeholder="Fecha de Inicio" onchange="compare_dates()" min="<?php echo date("Y-m-d");?>" max="<?php echo date("Y") . '-12-31';?>">          
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
          <select class="form-control" id="conductor" name="conductor" >
                 
          </select>
        </div>

        <div class="col-md-1">
          <label>Repetir</label>
        </div>

        <div class="col-md-2" style="padding: 0px; margin: 0px; background-color: #ffe9a3;">  
          <div class="col-md-6" style="padding: 0px; margin: 0px">  
            <label class="radio-inline"><input type="radio" name="radioRepetir" id="radioNunca" value="NUNCA" checked="checked">Nunca</label>
          </div>

          <div class="col-md-6" style="padding: 0px; margin: 0px"> 
            <label class="radio-inline"><input type="radio" name="radioRepetir" id="radioDiariamente" value="DIARIAMENTE">Diariamente</label> 
          </div>

          <div class="col-md-6" style="padding: 0px; margin: 0px"> 
            <label class="radio-inline"><input type="radio" name="radioRepetir" id="radioSemanalmente" value="SEMANALMENTE">Semanalmente</label> 
          </div>

          <div class="col-md-6" style="padding: 0px; margin: 0px"> 
            <label class="radio-inline"><input type="radio" name="radioRepetir" id="radioMensualmente" value="MENSUALMENTE">Mensualmente</label> 
          </div>

        </div>

      </div>

      <div class="row" style="padding: 0px; margin: 0px"> 
        <div class="col-md-1">
          <label>Hora de Inicio</label>
        </div>

        <div class="col-md-2">
          <input type="time" class="form-control" id="txtHoraInicio" name="txtHoraInicio" placeholder="Hora de Inicio" onchange="CompararHoras()">
        </div>

        <div class="col-md-1">
          <label>Hora Final</label>
        </div>

        <div class="col-md-2">
          <input type="time" class="form-control" id="txtHoraFinal" name="txtHoraFinal" placeholder="Hora Final" onchange="CompararHoras()">
        </div>
          
        <div class="col-md-1"> 
          <label>Selección de Monitor</label>
        </div>

        <div class="col-md-2"> 
          <select class="form-control" id="monitor" name="monitor"> 
           
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
        </div>    


        <div class="col-md-3">
          <label>
            Lista abierta
            <span data-toggle="tooltip" data-placement="left" title="Agregar estudiantes dinamicamente.">
              <span class="glyphicon glyphicon-question-sign"></span>
            </span> 
            &nbsp;
            &nbsp;
            <input type="checkbox" name="rutaDinamica" id="rutaDinamica">
          </label>
        </div>      

          
      </div>

      <div class="row"> 
        <div class="col-md-6" align="center">
          <div style="border: 1px solid #ffe9a3; width: 98%; height: 470px; padding: 10px">
            <form role="form" action="" method="POST">  
              <div class="row"> 
                <div class="col-md-9">
                  
                  <select class="form-control" id="curso" name="curso" disabled="disabled" style="background-color: #ffe9a3;"> 
                    <option value="Seleccione">Seleccione...</option>
                    <?php
                      /*
                          Se valida que el result de la consulta de tecnicas tenga datos.
                          Este valor es enviado desde la funcion del controlador
                      */                                    
                      if($cursos){
                        //Se itera el result de los tecnicos. $tecnicos es enviado como un objeto, el cual para obtener los datos se obtiene un array asociativo, el cual se itera con un foreach y se muestra en el select
                        foreach ($cursos->result() as $value) {
                      ?>
                      <option value="<?= $value->id?>"><?= $value->Descripcion;?></option>
                    <?php
                        }
                      }
                    ?>
                  </select>      
                </div>
              </div>

              <div class="row"> 
                <div class="col-md-9">
                  <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="Busqueda por Apellido" style="margin-top: 5px; background-color: #ffe9a3;" disabled="disabled">
                </div>
                <div class="col-md-3">
                  <button type="button" id="btnFiltro" class="btn btn-primary pull-right" disabled="disabled" style="width: 100%; margin-top: 5px;">Buscar</button>
                </div>
              </div>

            </form>
            <hr>  
            
            <input type="hidden" id="totalDrop" value="0">
            <br><br>
            <div style="width: 100%; background: #fff1c5;" align="right">
              <img style="position: absolute; left: 63%; top: 25%" width="150" src="<?= base_url(1);?>img/B1.png">              

              <div id="container-field">
                <label style="font-weight: bolder; float: left; margin-left: 20px; margin-top: 10px; color: #337ab7" id="sillasOcupadas">0/0</label>                
                <div style="margin-top: 40px; height: 240px; overflow-y: auto;"></div>
              </div>

              <div id="container-player">

                <!--<div class="drag" id="1">                  
                  <div class="col-md-11" align="center" style="padding: 0px; margin: 0px">
                    <img width="58px" src="<?= base_url(1);?>images/56d9b9c572926.png">
                    <p>Nombre Completo 1</p>
                  </div>                 
                  <div class="col-md-1" style="padding: 0px; margin: 0px">
                    <a class="boxclose" id="back">
                      <img src="<?= base_url(1);?>img/der.png" width="20">
                    </a>
                  </div>
                </div>

                <div class="drag" id="2">                  
                  <div class="col-md-11" align="center" style="padding: 0px; margin: 0px">
                    <img width="58px" src="<?= base_url(1);?>images/56d9b9c572926.png">
                    <p>Nombre Completo 2</p>
                  </div>                 
                  <div class="col-md-1" style="padding: 0px; margin: 0px">
                    <a class="boxclose" id="back">
                      <img src="<?= base_url(1);?>img/der.png" width="20">
                    </a>
                  </div>
                </div>

                <div class="drag" id="3">                  
                  <div class="col-md-11" align="center" style="padding: 0px; margin: 0px">
                    <img width="58px" src="<?= base_url(1);?>images/56d9b9c572926.png">
                    <p>Nombre Completo 3</p>
                  </div>                 
                  <div class="col-md-1" style="padding: 0px; margin: 0px">
                    <a class="boxclose" id="back">
                      <img src="<?= base_url(1);?>img/der.png" width="20">
                    </a>
                  </div>
                </div>

                <div class="drag" id="4">                  
                  <div class="col-md-11" align="center" style="padding: 0px; margin: 0px">
                    <img width="58px" src="<?= base_url(1);?>images/56d9b9c572926.png">
                    <p>Nombre Completo 4</p>
                  </div>                 
                  <div class="col-md-1" style="padding: 0px; margin: 0px">
                    <a class="boxclose" id="back">
                      <img src="<?= base_url(1);?>img/der.png" width="20">
                    </a>
                  </div>
                </div>

                <div class="drag" id="5">                  
                  <div class="col-md-11" align="center" style="padding: 0px; margin: 0px">
                    <img width="58px" src="<?= base_url(1);?>images/56d9b9c572926.png">
                    <p>Nombre Completo 5</p>
                  </div>                 
                  <div class="col-md-1" style="padding: 0px; margin: 0px">
                    <a class="boxclose" id="back">
                      <img src="<?= base_url(1);?>img/der.png" width="20">
                    </a>
                  </div>
                </div>-->

                <!--<div class="drag" id="6">                  
                  <div class="col-md-11" align="center" style="padding: 0px; margin: 0px">
                    <img width="58px" src="<?= base_url(1);?>images/56d9b9c572926.png">
                    <p>Nombre Completo 6</p>
                  </div>                 
                  <div class="col-md-1" style="padding: 0px; margin: 0px">
                    <a class="boxclose" id="back">
                      <img src="<?= base_url(1);?>img/der.png" width="20">
                    </a>
                  </div>
                </div>

                <div class="drag" id="7">                  
                  <div class="col-md-11" align="center" style="padding: 0px; margin: 0px">
                    <img width="58px" src="<?= base_url(1);?>images/56d9b9c572926.png">
                    <p>Nombre Completo 7</p>
                  </div>                 
                  <div class="col-md-1" style="padding: 0px; margin: 0px">
                    <a class="boxclose" id="back">
                      <img src="<?= base_url(1);?>img/der.png" width="20">
                    </a>
                  </div>
                </div>

                <div class="drag" id="8">                  
                  <div class="col-md-11" align="center" style="padding: 0px; margin: 0px">
                    <img width="58px" src="<?= base_url(1);?>images/56d9b9c572926.png">
                    <p>Nombre Completo 8</p>
                  </div>                 
                  <div class="col-md-1" style="padding: 0px; margin: 0px">
                    <a class="boxclose" id="back">
                      <img src="<?= base_url(1);?>img/der.png" width="20">
                    </a>
                  </div>
                </div>

                <div class="drag" id="9">                  
                  <div class="col-md-11" align="center" style="padding: 0px; margin: 0px">
                    <img width="58px" src="<?= base_url(1);?>images/56d9b9c572926.png">
                    <p>Nombre Completo 9</p>
                  </div>                 
                  <div class="col-md-1" style="padding: 0px; margin: 0px">
                    <a class="boxclose" id="back">
                      <img src="<?= base_url(1);?>img/der.png" width="20">
                    </a>
                  </div>
                </div>-->

                

              </div>
            </div>
            
            <!--<div id="divDrag" style="position:absolute; margin-top:40px; width:90%;height: 290px; border: 1px solid">

              

            </div>-->
            <?php
              $attributesErrorEstudiantes = array(
                'id' => 'lblErrorEstudiantes',
                'style' => 'display: none;',
                'class' => 'errorDato'
              );
              echo form_label("", "divDrag", $attributesErrorEstudiantes);
            ?>
          </div>
        </div>
        
        <br>
        <div class="col-md-6" style="background-color: #f2f2f2; padding-top: 0; padding-left: 10px; padding-right: 10px">

          <div class="col-md-12" style="background-color: #d9d9d9; margin-top: 8px; padding: 0px">
            <div class="col-md-5" style="margin-left: -5px;">
              <br>
              <label>Punto Origen de Ruta</label>
              
              <form role="form" id="google" name="google" action="#">
                <input class="form-control" type="text" id="direccion" name="direccion"/>
                <button type="button" id="pasar" class="btn btn-primary pull-right" style="background-color: #f59540; border-color: #f59540; margin-top: 5px">Ubicar Coordenadas</button>
              </form> <br>
            </div>
            <div class="col-md-7" style="margin-top: -20px; padding: 5px; margin-bottom: -13px">
              <!-- div donde se dibuja el mapa--><br>
              <div id="map_canvas" style="width:100%;height:200px;margin-bottom: 15px;"></div>
            </div>
          </div>

          <div class="col-md-12" style="background-color: #d9d9d9; margin-top: 8px; padding: 0px; margin-bottom: 10px">
            <div class="col-md-5">
              <br>
              <label>Punto Destino de Ruta</label>
              <form role="form" id="google" name="google" action="#">     
                <input class="form-control" type="text" id="direccions" name="direccions"/>
                <button type="button" id="pasars" class="btn btn-primary pull-right" style="background-color: #f59540; border-color: #f59540; margin-top: 5px">Ubicar Coordenadas</button>
              </form> <br>
            </div>
            <div class="col-md-7" style="margin-top: -20px; padding: 5px; margin-bottom: -13px">
              <!-- div donde se dibuja el mapa--><br>
              <div id="map_canvass" style="width:100%;height:200px;margin-bottom: 15px;"></div>
            </div>
          </div>

        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-md-6" align="center" style="height: 320px;">
          <div style="width: 98%; padding: 0px; border: 1px solid #ffe9a3; margin-bottom: 10px; height: 310px">
            <div style="background-color: #fff1c5; width: 100%; margin-bottom: 10px">
              <label>Orden de Recogida en Ruta Escolar</label>  
            </div>
            
            <table width="100%" border="0" style="border-collapse: separate;" id="tablaOrden">
              <thead style="width: 95%">
                <tr style="background-color: #fff1c5">
                    <td align="center">Identificador</td>
                    <td width="40%">Nombre</td>
                    <td width="40%">Dirección</td>
                    <td width="10%">Acción</td>
                </tr>
              </thead>
              <tbody>
                <!--<tr id="tr0" ind="0">
                  <td valign="middle" align="center">A</td>
                  <td valign="middle">Paredes Caballero Javier</td>
                  <td valign="middle">Carrera 7A Bis 135 52</td>
                  <td valign="middle" align="center"><i class="fa fa-arrow-circle-o-up" aria-hidden="true" style="font-size: 20px; visibility: hidden;"></i>&nbsp;&nbsp;<i class="fa fa-arrow-circle-o-down" aria-hidden="true" style="font-size: 20px"></i></td>
                </tr>  
                <tr id="tr1" ind="1">
                  <td valign="middle" align="center">B</td>
                  <td valign="middle">Cabrera García Raúl</td>
                  <td valign="middle">Calle 100 No. 60-20</td>
                  <td valign="middle" align="center"><i class="fa fa-arrow-circle-o-up" aria-hidden="true" style="font-size: 20px"></i>&nbsp;&nbsp;<i class="fa fa-arrow-circle-o-down" aria-hidden="true" style="font-size: 20px"></i></td>
                </tr> 
                <tr id="tr2" ind="2">
                  <td valign="middle" align="center">C</td>
                  <td valign="middle">Cabrera García Raúl</td>
                  <td valign="middle">Calle 100 No. 60-20</td>
                  <td valign="middle" align="center"><i class="fa fa-arrow-circle-o-up" aria-hidden="true" style="font-size: 20px"></i>&nbsp;&nbsp;<i class="fa fa-arrow-circle-o-down" aria-hidden="true" style="font-size: 20px"></i></td>
                </tr> 
                <tr id="tr3" ind="3">
                  <td valign="middle" align="center">D</td>
                  <td valign="middle">Cabrera García Raúl</td>
                  <td valign="middle">Calle 100 No. 60-20</td>
                  <td valign="middle" align="center"><i class="fa fa-arrow-circle-o-up" aria-hidden="true" style="font-size: 20px"></i>&nbsp;&nbsp;<i class="fa fa-arrow-circle-o-down" aria-hidden="true" style="font-size: 20px"></i></td>
                </tr> 
                <tr id="tr4" ind="4">
                  <td valign="middle" align="center">E</td>
                  <td valign="middle">Cabrera García Raúl</td>
                  <td valign="middle">Calle 100 No. 60-20</td>
                  <td valign="middle" align="center"><i class="fa fa-arrow-circle-o-up" aria-hidden="true" style="font-size: 20px"></i>&nbsp;&nbsp;<i class="fa fa-arrow-circle-o-down" aria-hidden="true" style="font-size: 20px"></i></td>
                </tr> 
                <tr id="tr5" ind="5">
                  <td valign="middle" align="center">F</td>
                  <td valign="middle">Cabrera García Raúl</td>
                  <td valign="middle">Calle 100 No. 60-20</td>
                  <td valign="middle" align="center"><i class="fa fa-arrow-circle-o-up" aria-hidden="true" style="font-size: 20px"></i>&nbsp;&nbsp;<i class="fa fa-arrow-circle-o-down" aria-hidden="true" style="font-size: 20px"></i></td>
                </tr> 
                <tr id="tr6" ind="6">
                  <td valign="middle" align="center">G</td>
                  <td valign="middle">Munevar Bahamon Isabela</td>
                  <td valign="middle">Calle 100 No. 60-20</td>
                  <td valign="middle" align="center"><i class="fa fa-arrow-circle-o-up" aria-hidden="true" style="font-size: 20px"></i>&nbsp;&nbsp;<i class="fa fa-arrow-circle-o-down" aria-hidden="true" style="font-size: 20px; visibility: hidden;"></i></td>
                </tr>-->                                
              </tbody>
            </table><br>

            <div align="right" style="width: 100%; position: absolute; bottom: 15px; right: 22px">
              <button type="button" id="btnActualizarMapa" class="btn btn-primary" style="background-color: #f59540; border-color: #f59540; margin-right: 17px" disabled="disabled"><b>Actualizar Mapa</b></button>
              <input type="hidden" name="txtPuntos" id="txtPuntos">
            </div><br>
          </div>
        </div>

        <div class="col-md-6" style="background-color: #d9d9d9; padding: 5px">
          <div id="map_canvass2" style="width:100%;height:300px;"></div>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-md-12">
          <div id="spin"></div>    
          <button type="button" id="btnCrearRuta" class="btn btn-primary pull-right" style="background-color: #f59540; border-color: #f59540; display: none;"><b>CREAR RUTA ESCOLAR</b></button>
        </div>
      </div>
      

    </form><br>
  
  </div>
    <div class="container">
        <div class="row" align="center" id="chats">           
            
        </div>
    </div>
    <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
    <script type="text/javascript" src="<?= base_url(1);?>js/chat.js"></script>
    <script src="<?= base_url(1);?>js/jquery.babypaunch.spinner.min.js"></script>
      
      <script type="text/javascript">
        var totalItem = 0;
        var contadorFilasAgregadas = 1;
        var contadorColumnasAgregadas = 1;
        var contadorId = 1;
        var abecedario=new Array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');

        $(function(){
          //$("#spin").spinner();

          $("#spin").spinner({
            color: "black"
            , background: "rgba(255,255,255,0.5)"
            , html: "<i class='fa fa-circle-o-notch fa-5x' style='color: gray;'></i>"
            , spin: true
          });     
          

        });

        function compare_dates()  
        {  
          var fech1 = document.getElementById("txtFechaInicio").value; 
          var fech2 = document.getElementById("txtFechaFinal").value; 
          

          if((Date.parse(fech1)) > (Date.parse(fech2))){
            alert("La fecha inicial no puede ser mayor que la fecha final");
            document.getElementById("txtFechaFinal").value = fech1
            $("#txtFechaFinal").attr("min", fech1)
          }else{
            $("#txtFechaFinal").attr("min", fech1)
            
            var horaInicio = $("#txtHoraInicio").val();
            var horaFin = $("#txtHoraFinal").val();
            var fechaInicio = $("#txtFechaInicio").val();
            var fechaFin = $("#txtFechaFinal").val();
            var repetir =  $('input:radio[name=radioRepetir]:checked').val();

            if(repetir == "NUNCA"){
              $("#txtFechaFinal").attr("min", horaInicio)
              $("#txtFechaFinal").attr("max", horaInicio)
              $("#txtFechaFinal").attr("disabled", "disabled")
              $("#txtFechaFinal").val(fechaInicio)
            }else{
              $("#txtFechaFinal").removeAttr("disabled")              
            }

            if($.trim(horaInicio) != "" && $.trim(horaFin) != "" && $.trim(fechaInicio) != ""){
              $("#btnCrearRuta").css({"display":"block"});
              $("#btnFiltro").removeAttr("disabled")
              var datos = {
                horainicial: horaInicio,
                horafinal: horaFin,
                fechainicial: fechaInicio,
                fechafinal: fechaFin,
                repetir: repetir
              }         
              listar_monitores(datos)
              listar_conductores(datos)
              listar_vehiculos(datos)

              

              $("#curso").removeAttr("disabled")
              $("#busqueda").removeAttr("disabled")

              if($.trim($("#lat").val()).length > 0 && $.trim($("#long").val()).length > 0 && $.trim($("#lats").val()).length > 0 && $.trim($("#longs").val()).length > 0 && $("#ruta > option").length > 0 > 0 && $("#conductor > option").length > 0 > 0 && $("#monitor > option").length > 0) {
                $("#btnActualizarMapa").removeAttr("disabled")
              }else{
                $("#btnActualizarMapa").attr("disabled")
              }
              
              
            }else{
              $("#btnCrearRuta").css({"display":"none"});
              $("#curso").attr("disabled", "disabled")
              $("#busqueda").attr("disabled", "disabled")
            }
          }
        }

        $("#curso").change(function(e){
          if($("#curso").val() != "Seleccione"){
            $("#curso").removeAttr("disabled")
            $("#busqueda").attr("disabled", "disabled")
          }else{
            $("#curso").attr("disabled", "disabled")
            $("#busqueda").removeAttr("disabled")
          }
        })

        $("#busqueda").keyup(function(e){
          if($.trim($("#busqueda").val()).length > 0){
            $("#curso").attr("disabled", "disabled")
            $("#busqueda").removeAttr("disabled")
          }else{
            $("#curso").removeAttr("disabled")
            $("#busqueda").attr("disabled", "disabled")
          }
        })

        
        $("#container-player").html("")
        $("#tablaOrden > tbody").html("")
        
        $("#btnActualizarMapa").click(function(e){
          var CoordenadasOrigenRuta = $("#lat").val() + "," + $("#long").val();
          var CoordenadasDestinoRuta = $("#lats").val() + "," + $("#longs").val();
          var waypts=[];    

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

                $("#txtPuntos").val(JSON.stringify(waypts))

              }

              

              if(($("#tablaOrden > tbody > tr").length - 1) == index){
                console.log(waypts)
                directionsService.route({
                  origin: CoordenadasOrigenRuta,
                  destination: CoordenadasDestinoRuta,
                  waypoints: waypts,
                  travelMode: google.maps.TravelMode.DRIVING
                }, function(response, status) {

                  if (status === google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                  } else {
                    window.alert('Directions request failed due to ' + status);
                  }
                });
              }
                            

            })
          })

          
          
        })
        
       

        function CompararHoras() { 
          var arHoras = document.getElementById("txtHoraInicio").value; 
          var arHoras2 = document.getElementById("txtHoraFinal").value;          
          var estado = 0;

          var arHora1 = arHoras.split(":");
          var arHora2 = arHoras2.split(":");
           
          // Obtener horas y minutos (hora 1) 
          var hh1 = parseInt(arHora1[0],10); 
          var mm1 = parseInt(arHora1[1],10); 

          // Obtener horas y minutos (hora 2) 
          var hh2 = parseInt(arHora2[0],10); 
          var mm2 = parseInt(arHora2[1],10); 

          var totalM = mm2 - mm1
          var totalH = hh2 - hh1

          if(totalH <= 0 & totalM <= 0){
            estado++;
          }else{
            
          }
          
          console.log(arHora2[0] + " " + arHora1[0] + " " + totalH + " : " + estado)
          // Comparar 
          if (estado > 0){ 
            alert("La hora inicial no puede ser mayor que la final"); 
            $("#btnCrearRuta").css({"display":"none"});
            $("#monitor").empty();
            $("#ruta").empty();
            $("#conductor").empty();
          }else{
            var horaInicio = $("#txtHoraInicio").val();
            var horaFin = $("#txtHoraFinal").val();
            var fechaInicio = $("#txtFechaInicio").val();
            var fechaFin = $("#txtFechaFinal").val();
            var repetir =  $('input:radio[name=radioRepetir]:checked').val();

            if(repetir == "NUNCA"){
              $("#txtFechaFinal").attr("min", horaInicio)
              $("#txtFechaFinal").attr("max", horaInicio)
              $("#txtFechaFinal").attr("disabled", "disabled")
              $("#txtFechaFinal").val(fechaInicio)
            }else{
              $("#txtFechaFinal").removeAttr("disabled")              
            }

            if($.trim(horaInicio) != "" && $.trim(horaFin) != "" && $.trim(fechaInicio) != ""){
              $("#btnCrearRuta").css({"display":"block"});
              $("#btnFiltro").removeAttr("disabled")
              
              var datos = {
                horainicial: horaInicio,
                horafinal: horaFin,
                fechainicial: fechaInicio,
                fechafinal: fechaFin,
                repetir: repetir
              }         
              listar_monitores(datos)
              listar_vehiculos(datos)
              listar_conductores(datos)

              $("#curso").removeAttr("disabled")
              $("#busqueda").removeAttr("disabled")

              if($.trim($("#lat").val()).length > 0 && $.trim($("#long").val()).length > 0 && $.trim($("#lats").val()).length > 0 && $.trim($("#longs").val()).length > 0 && $("#ruta > option").length > 0 > 0 && $("#conductor > option").length > 0 > 0 && $("#monitor > option").length > 0) {
                $("#btnActualizarMapa").removeAttr("disabled")
              }else{
                $("#btnActualizarMapa").attr("disabled")
              }
            }else{
              $("#btnCrearRuta").css({"display":"none"});
              $("#curso").attr("disabled", "disabled")
              $("#busqueda").attr("disabled", "disabled")
            }

           
          }

        } 

        $("input[name=radioRepetir]").click(function () {    
          var horaInicio = $("#txtHoraInicio").val();
          var horaFin = $("#txtHoraFinal").val();
          var fechaInicio = $("#txtFechaInicio").val();
          var fechaFin = $("#txtFechaFinal").val();
          var repetir =  $('input:radio[name=radioRepetir]:checked').val();

          if(repetir == "NUNCA"){
            $("#txtFechaFinal").attr("min", horaInicio)
            $("#txtFechaFinal").attr("max", horaInicio)
            $("#txtFechaFinal").attr("disabled", "disabled")
            $("#txtFechaFinal").val(fechaInicio)
          }else{
            $("#txtFechaFinal").removeAttr("disabled")            
          }

          if($.trim(horaInicio) != "" && $.trim(horaFin) != "" && $.trim(fechaInicio) != ""){
            $("#btnCrearRuta").css({"display":"block"});
            $("#btnFiltro").removeAttr("disabled")
            
            var datos = {
              horainicial: horaInicio,
              horafinal: horaFin,
              fechainicial: fechaInicio,
              fechafinal: fechaFin,
              repetir: repetir
            }         
            
            listar_monitores(datos);
            listar_vehiculos(datos)
            listar_conductores(datos)

            $("#curso").removeAttr("disabled")
            $("#busqueda").removeAttr("disabled")

            if($.trim($("#lat").val()).length > 0 && $.trim($("#long").val()).length > 0 && $.trim($("#lats").val()).length > 0 && $.trim($("#longs").val()).length > 0 && $("#ruta > option").length > 0 > 0 && $("#conductor > option").length > 0 > 0 && $("#monitor > option").length > 0) {
              $("#btnActualizarMapa").removeAttr("disabled")
            }else{
              $("#btnActualizarMapa").attr("disabled")
            }
            $("#sillasOcupadas").html($("#container-field > div > .drag").length + "/" + $('#ruta option:selected').attr("sillas"))
          }else{
            $("#btnCrearRuta").css({"display":"none"});
            $("#curso").attr("disabled", "disabled")
            $("#busqueda").attr("disabled", "disabled")
          }
        });
        
        $("#txtHoraInicio").keyup(function(e){
          var horaInicio = $("#txtHoraInicio").val();
          var horaFin = $("#txtHoraFinal").val();
          var fechaInicio = $("#txtFechaInicio").val();
          var fechaFin = $("#txtFechaFinal").val();
          var repetir =  $('input:radio[name=radioRepetir]:checked').val();

          if(repetir == "NUNCA"){
            $("#txtFechaFinal").attr("min", horaInicio)
            $("#txtFechaFinal").attr("max", horaInicio)
            $("#txtFechaFinal").attr("disabled", "disabled")
            $("#txtFechaFinal").val(fechaInicio)
          }else{
            $("#txtFechaFinal").removeAttr("disabled")            
          }

          if($.trim(horaInicio) != "" && $.trim(horaFin) != "" && $.trim(fechaInicio) != ""){
            $("#btnCrearRuta").css({"display":"block"});
            $("#btnFiltro").removeAttr("disabled")
            
            var datos = {
              horainicial: horaInicio,
              horafinal: horaFin,
              fechainicial: fechaInicio,
              fechafinal: fechaFin,
              repetir: repetir
            }         
            listar_monitores(datos)
            listar_vehiculos(datos)
            listar_conductores(datos)
          }else{
            $("#btnCrearRuta").css({"display":"none"});
          }
        });

        $("#txtHoraFinal").keyup(function(e){
          var horaInicio = $("#txtHoraInicio").val();
          var horaFin = $("#txtHoraFinal").val();
          var fechaInicio = $("#txtFechaInicio").val();
          var fechaFin = $("#txtFechaFinal").val();
          var repetir =  $('input:radio[name=radioRepetir]:checked').val();

          if(repetir == "NUNCA"){
            $("#txtFechaFinal").attr("min", horaInicio)
            $("#txtFechaFinal").attr("max", horaInicio)
            $("#txtFechaFinal").attr("disabled", "disabled")
            $("#txtFechaFinal").val(fechaInicio)
          }else{
            $("#txtFechaFinal").removeAttr("disabled")            
          }

          if($.trim(horaInicio) != "" && $.trim(horaFin) != "" && $.trim(fechaInicio) != ""){
            $("#btnCrearRuta").css({"display":"block"});
            $("#btnFiltro").removeAttr("disabled")
            
            var datos = {
              horainicial: horaInicio,
              horafinal: horaFin,
              fechainicial: fechaInicio,
              fechafinal: fechaFin,
              repetir: repetir
            }         
            listar_monitores(datos)
            listar_vehiculos(datos)
            listar_conductores(datos)
          }else{
            $("#btnCrearRuta").css({"display":"none"});
          }
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

        function listar_monitores(datos){
          $.post("<?= base_url();?>index.php/rutas/listarMonitores", datos)
          .done(function( data ) {console.log(data)
            $("#monitor").empty();
            var json = JSON.parse(data);
            $.each(json, function(i, item) {
              $("#monitor").append('<option value="' + json[i].idmonitor + '">' + json[i].nombre + ' ' + json[i].apellido + '</option>');
            });

          });
        }

        function listar_conductores(datos){
          $.post("<?= base_url();?>index.php/rutas/listarConductores", datos)
          .done(function( data ) {console.log(data)
            $("#conductor").empty();
            var json = JSON.parse(data);
            $.each(json, function(i, item) {
              $("#conductor").append('<option value="' + json[i].idconductor + '">' + json[i].nombre + ' ' + json[i].apellido + '</option>');
            });
          });
        }

        function listar_vehiculos(datos){
          $.post("<?= base_url();?>index.php/rutas/listarVehiculos", datos)
          .done(function( data ) {console.log(data)
            $("#ruta").empty();
            var json = JSON.parse(data);
            $.each(json, function(i, item) {
              $("#ruta").append('<option value="' + json[i].idvehiculo + '" sillas="' + json[i].sillas + '">' + json[i].categoria + ' ' + json[i].placa + '</option>');
            });
          });
        }
        
        $("#btnFiltro").click(function(e){   
          var curso = $("#curso").val();
          var apellido = $("#busqueda").val();

          var datos = {
            curso: curso,
            apellido: apellido
          } 
          if($.trim($("#lat").val()).length > 0 && $.trim($("#long").val()).length > 0 && $.trim($("#lats").val()).length > 0 && $.trim($("#longs").val()).length > 0 && $("#ruta > option").length > 0 > 0 && $("#conductor > option").length > 0 > 0 && $("#monitor > option").length > 0) {
            $("#btnActualizarMapa").removeAttr("disabled")
          }else{
            $("#btnActualizarMapa").attr("disabled")
          }    
          $("#sillasOcupadas").html($("#container-field > div > .drag").length + "/" + $('#ruta option:selected').attr("sillas"))
          $.post("<?= base_url();?>index.php/usuarios_aplicaciones/listarEstudiantes", datos)
          .done(function( data ) {
              $("#container-player").html("")
              if($.trim(data) != "[]"){
                var jsonUsuario = JSON.parse(data);
                for (var i = 0; i < jsonUsuario.length; i++) {
                  
                  if($("#" + jsonUsuario[i].NumeroId).length == 0){

                    $("#container-player").append('<div class="drag" id="' + jsonUsuario[i].NumeroId + '">' +
                      '<div class="col-md-11" align="center" style="padding: 0px">' +
                        '<img width="58px" height="58px" id="foto' + jsonUsuario[i].NumeroId + '" src="<?= base_url(1);?>' + jsonUsuario[i].ImagenFotografica + '">' +
                        '<p>' + jsonUsuario[i].PrimerNombre + ' ' + jsonUsuario[i].PrimerApellido + '</p>' +
                      '</div>' +
                      '<div class="col-md-1" style="padding: 0px; margin: 0px">' +
                        '<a class="boxclose" id="back' + jsonUsuario[i].NumeroId + '" document="' + jsonUsuario[i].NumeroId + '" nombre="' + jsonUsuario[i].PrimerNombre + ' ' + jsonUsuario[i].PrimerApellido + '" direccion="' + jsonUsuario[i].Direccion + '">' +
                          '<img src="<?= base_url(1);?>img/der.png" width="20">' +
                        '</a>' +
                      '</div>' +
                    '</div>')

                    
                    
                    $( "#foto" + jsonUsuario[i].NumeroId ).error(function() {
                      $(this).attr("src", "<?= base_url(1);?>images/stock_people.png")
                    })/*.attr("src", "<?= base_url(1);?>images/stock_people.png")*/
                    

                    $("#back" + jsonUsuario[i].NumeroId).click(function (e) {   
                      var documento = $(this).attr("document")  
                      var nombre = $(this).attr("nombre")  
                      var direccion = $(this).attr("direccion")
                      switch($('#' + documento + " > .col-md-1 > a > img").attr("src")){
                        case "<?= base_url(1);?>img/der.png":
                          console.log($('#' + documento + " > .col-md-1 > a > img").attr("src") + " MAL")

                          if($("#container-field > div > .drag").length < parseInt($('#ruta option:selected').attr("sillas"))){
                            $('#' + documento).hide().appendTo("#container-field > div").show('normal');
                            $('#' + documento + ' > .col-md-1 > a > img').attr("src", '<?= base_url(1);?>img/izq.png')
                            
                            agregarTabla(nombre, direccion, documento)
                          }else{
                            alert("¡No puede sobrepasar el limite de sillas del vehiculo!")
                          }
                          
                          $('#tablaOrden > thead > tr > td').each(function(index) {
                            var ancho = $(this).width() + 10
                            for (var i = 0; i < $("#tablaOrden")[0].children[1].children.length; i++) {
                              $("#tablaOrden > tbody > tr")[i].children[index].style.width = ancho + "px"
                              console.log(ancho + " " + index)
                            }
                            
                          });
                          
                          $("#sillasOcupadas").html($("#container-field > div > .drag").length + "/" + $('#ruta option:selected').attr("sillas"))
                          break;

                        case "<?= base_url(1);?>img/izq.png":
                          console.log($('#' + documento + " > .col-md-1 > a > img").attr("src"))
                          $('#' + documento).hide().appendTo("#container-player").show('normal');
                          $('#' + documento + ' > .col-md-1 > a > img').attr("src", '<?= base_url(1);?>img/der.png')
                          $('#tr' + documento).hide().remove()
                          mostrarBotonesTabla()
                          $("#sillasOcupadas").html($("#container-field > div > .drag").length + "/" + $('#ruta option:selected').attr("sillas"))
                          break;
                      }         
                    });
                  }
                  

                  

                  
                }

              }
          });
                              
        });
        
        function mostrarBotonesTabla() {
          $("#tablaOrden > tbody > tr").each(function (index) {
            $(this)[0].children[0].innerHTML = index + 1
            if(($("#tablaOrden > tbody > tr").length - 1) == 0){
              $(this)[0].children[3].children[0].style.visibility = "hidden"
              $(this)[0].children[3].children[1].style.visibility = "hidden"
            }else{
              if(index == 0){
                $(this)[0].children[3].children[0].style.visibility = "hidden"
                $(this)[0].children[3].children[1].style.visibility = "visible"
              }else{
                if(($("#tablaOrden > tbody > tr").length - 1) == index){
                  $(this)[0].children[3].children[0].style.visibility = "visible"
                  $(this)[0].children[3].children[1].style.visibility = "hidden"
                }else{
                  $(this)[0].children[3].children[0].style.visibility = "visible"
                  $(this)[0].children[3].children[1].style.visibility = "visible"
                }
              }
            }
            
          })
        }

        function agregarTabla(nombre, direccion, documento) {
          var contadorID;
          if($("#tablaOrden > tbody > tr").length > 0){
            contadorID = parseInt($("#tablaOrden > tbody > tr:last").attr("ind")) + 1;
          }else{
            contadorID = 0;
          }
          $("#tablaOrden > tbody").append('<tr id="tr' + documento + '" ind="' + contadorID + '" documento="' + documento + '">' +
            '<td valign="middle" align="center">A</td>' +
            '<td valign="middle">' + nombre + '</td>' +
            '<td valign="middle">' + direccion + '</td>' +
            '<td valign="middle" align="center"><i id="subir' + contadorID + '" class="fa fa-arrow-circle-o-up" aria-hidden="true" style="font-size: 20px; visibility: hidden;"></i>&nbsp;&nbsp;<i id="bajar' + contadorID + '" class="fa fa-arrow-circle-o-down" aria-hidden="true" style="font-size: 20px"></i></td>' +
          '</tr>')

          mostrarBotonesTabla()

          $('#subir' + contadorID).click(function (e) {
            var ind = parseInt($(this).parent().parent().attr("ind"))
            var id = $(this).parent().parent().attr("id")
            var idAnter = $(  "#" + id ).prev().attr("id")

            var idDrag = $(this).parent().parent().attr("documento")
            var idDragAnter = $(  "#" + idDrag ).prev().attr("id")
            console.log(idAnter)

            

            /*if(ind == parseInt($("tbody > tr:last").attr("ind"))){
              $("#" + id + " > td > .fa-arrow-circle-o-up").css({"visibility":"visible"}) 
              $("#" + id + " > td > .fa-arrow-circle-o-down").css({"visibility":"visible"}) 

              $("#" + idAnter + " > td > .fa-arrow-circle-o-up").css({"visibility":"visible"}) 
              $("#" + idAnter + " > td > .fa-arrow-circle-o-down").css({"visibility":"hidden"}) 
            }else{
              if(idAnter == $("tbody > tr:first").attr("id")){
                $("#" + id + " > td > .fa-arrow-circle-o-up").css({"visibility":"hidden"}) 
                $("#" + id + " > td > .fa-arrow-circle-o-down").css({"visibility":"visible"}) 

                $("#" + idAnter + " > td > .fa-arrow-circle-o-up").css({"visibility":"visible"}) 
                $("#" + idAnter + " > td > .fa-arrow-circle-o-down").css({"visibility":"visible"}) 
              }else{
                $("#" + id + " > td > .fa-arrow-circle-o-up").css({"visibility":"visible"}) 
                $("#" + id + " > td > .fa-arrow-circle-o-down").css({"visibility":"visible"}) 

                $("#" + idAnter + " > td > .fa-arrow-circle-o-up").css({"visibility":"visible"}) 
                $("#" + idAnter + " > td > .fa-arrow-circle-o-down").css({"visibility":"visible"}) 
              }
            }*/
            
            $( "#" + id ).hide().insertBefore("#" + idAnter).show('normal');
            $( "#" + idDrag ).hide().insertBefore( "#" + idDragAnter ).show('normal');

            mostrarBotonesTabla()
            $("#sillasOcupadas").html($("#container-field > div > .drag").length + "/" + $('#ruta option:selected').attr("sillas"))
          });

          $('#bajar' + contadorID).click(function (e) {
            var ind = parseInt($(this).parent().parent().attr("ind"))
            var id = $(this).parent().parent().attr("id")
            var idSigu = $(  "#" + id ).next().attr("id") 

            var idDrag = $(this).parent().parent().attr("documento")
            var idDragSigu = $(  "#" + idDrag ).next().attr("id")
            console.log(idSigu)

            

            /*if(ind == parseInt($("tbody > tr:first").attr("ind"))){
              $("#" + id + " > td > .fa-arrow-circle-o-up").css({"visibility":"visible"}) 
              $("#" + id + " > td > .fa-arrow-circle-o-down").css({"visibility":"visible"}) 

              $("#" + idSigu + " > td > .fa-arrow-circle-o-up").css({"visibility":"hidden"}) 
              $("#" + idSigu + " > td > .fa-arrow-circle-o-down").css({"visibility":"visible"}) 
            }else{
              if(idSigu == $("tbody > tr:last").attr("id")){
                $("#" + id + " > td > .fa-arrow-circle-o-up").css({"visibility":"visible"}) 
                $("#" + id + " > td > .fa-arrow-circle-o-down").css({"visibility":"hidden"}) 

                $("#" + idSigu + " > td > .fa-arrow-circle-o-up").css({"visibility":"visible"}) 
                $("#" + idSigu + " > td > .fa-arrow-circle-o-down").css({"visibility":"visible"}) 
              }else{
                $("#" + id + " > td > .fa-arrow-circle-o-up").css({"visibility":"visible"}) 
                $("#" + id + " > td > .fa-arrow-circle-o-down").css({"visibility":"visible"}) 

                $("#" + idSigu + " > td > .fa-arrow-circle-o-up").css({"visibility":"visible"}) 
                $("#" + idSigu + " > td > .fa-arrow-circle-o-down").css({"visibility":"visible"}) 
              }
            }*/
            
            $( "#" + id ).hide().insertAfter("#" + idSigu).show('normal');
            $( "#" + idDrag ).hide().insertAfter( "#" + idDragSigu ).show('normal');

            mostrarBotonesTabla()
            $("#sillasOcupadas").html($("#container-field > div > .drag").length + "/" + $('#ruta option:selected').attr("sillas"))
          })         

        }



        /*
            Evento para saber si el nombre de usuario o idusuario existe o no en la bd.
            Si este existe se muestra un error y se oculta el boton de registrar, sino se quitar el mensaje de error y se muestra el boton de registrar.
        */
        $("#txtNombre").keyup(function(e) {
            //Se obtiene lo que ha escrito el usuario
            var ruta = $("#txtNombre").val();
    
            //Se guardan los datos en un JSON
            var datos = {
                ruta: ruta          
            }       
            /*
                Se conecta a la funcion del controlador para verificar la existencia del dato enviado.
                La funcion base_url(1) obtiene la url base del proyecto, la cual es configurada en el archivo config.php
            */
            $.post("<?= base_url();?>index.php/rutas/ExisteRuta", datos)
            .done(function( data ) {
                if($.trim(data) == "1"){
                    $("#lblErrorNombreRuta").css({"display":"block"});
                    $("#lblErrorNombreRuta").html('La ruta ' + $("#txtNombre").val() + ' ya existe');
                }else{
                    $("#lblErrorNombreRuta").css({"display":"none"});
                }
                mostrarBoton()
            });
            
            
        });

        $("#txtColor").change(function(e) {
            //Se obtiene lo que ha escrito el usuario
            var color = $("#txtColor").val();
    
            //Se guardan los datos en un JSON
            var datos = {
                color: color          
            }       
            
            /*
                Se conecta a la funcion del controlador para verificar la existencia del dato enviado.
                La funcion base_url(1) obtiene la url base del proyecto, la cual es configurada en el archivo config.php
            */
            $.post("<?= base_url();?>index.php/rutas/ExisteColorRuta", datos)
            .done(function( data ) {
                if($.trim(data) == "1"){
                    $("#lblErrorColorRuta").css({"display":"block"});
                    $("#lblErrorColorRuta").html('El color de la ruta ' + $("#txtNombre").val() + ' ya existe');                    
                }else{
                    $("#lblErrorColorRuta").css({"display":"none"});
                    
                }
                mostrarBoton()
            });
            
            
        });

        $(".opcionMenuModulo").click(function(e){
            var id = $(this).attr("data-id");
            var texto = $(this).find("a").html();
            $.post("<?= base_url();?>index.php/usuarios_sistema/MostrarServicios", {id:id, texto:texto})
            .done(function( data ) {
                window.location.href = "<?= base_url();?>index.php/usuarios_sistema/homeInternoServicios";
            });
        });

          $("#ruta").change(function(e) {
            var vehiculo = $("#ruta").val();
            var sillas = parseInt($("#ruta option:selected").attr("sillas"));

            if($("#container-field > div > .drag").length > parseInt(sillas)) {
              alert("No puede seleccionar un vehiculo que sea menor a la cantidad de estudiantes agregados")
              $("#ruta").val($("#vehiculohidden").val())

            }else{
              $("#vehiculohidden").val(vehiculo)
            }
            $("#sillasOcupadas").html($("#container-field > div > .drag").length + "/" + $('#ruta option:selected').attr("sillas"))
         });
        $("#btnCrearRuta").click(function(e) {
              
          var ruta = $("#ruta").val();
          var monitor = $("#monitor").val();
          var lat = $("#lat").val();
          var lng = $("#long").val();
          var lats = $("#lats").val();
          var lngs = $("#longs").val();
          var conductor = $("#conductor").val();
          var cursos = $("#cursos").val();
          var nombreruta = $("#txtNombre").val();
          var color = $("#txtColor").val();
          var horaInicio = $("#txtHoraInicio").val();
          var horaFin = $("#txtHoraFinal").val();
          var fechaInicio = $("#txtFechaInicio").val();
          var fechaFin = $("#txtFechaFinal").val();
          var repetir =  $('input:radio[name=radioRepetir]:checked').val();
          var estudiantes = obtenerEstudiantesAgregados();
          
          if($.trim(nombreruta) != ""){
            if($('#container-field > div').length > 0){
              $("#spin").show();
              $("#spin").css({"display":"block"})

              var datos = {
                ruta: ruta,
                monitor: monitor,
                lat: lat,
                lng: lng,
                lats: lats,
                lngs: lngs,
                conductor: conductor,
                cursos: cursos,
                nombre: nombreruta,
                estudiantes: estudiantes,
                color: color,
                repetir: repetir,
                horainicial: horaInicio,
                horafinal: horaFin,
                fechainicial: fechaInicio,
                fechafinal: fechaFin,
                rutaDinamica: ($('#rutaDinamica').prop('checked') == true) ? 1 : 0
              }
              console.log($('#container-field > div').length)
              console.log(obtenerEstudiantesAgregados())
              
              $.post("<?= base_url();?>index.php/rutas/insertar", datos)
              .done(function( data ) {
                  console.log(data)
                  $("#spin").hide();
                  $("#spin").css({"display":"none"})
                  alertify.alert("Ruta creada con exito", function(){
                    window.location.href = "<?= base_url();?>index.php/rutas/nuevo";
                  });
                  
              });
            }else{
              $("#lblErrorEstudiantes").css({"display":"block"})
              $("#lblErrorEstudiantes").html("Por favor agregue al menos 1 estudiante a la ruta")              
            }
          }else{
            $("#lblErrorNombreRuta").css({"display":"block"})
            $("#lblErrorNombreRuta").html("Por favor ingrese un nombre de la ruta")
          }
        });

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

        function borrarItems(){
          if(totalItem != 0){
            for(i = 0; i < totalItem; i++){
              if($("#drag" + (i + 1)).attr("status") == "0"){
                $("#drag" + (i + 1)).remove();
              }
              
            }
            
          }
        }

        function obtenerEstudiantesAgregados(){
          var estudiantes = "";
          contador = 0;
          $('#container-field > div > .drag').each(function(idx, el) {
            value = $(el).attr("id");
            if(contador == 0){
              estudiantes += $(el).attr("id");
            }else{
              estudiantes += "," + $(el).attr("id");
            }
            contador++;
          });
          return estudiantes;
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
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJhwAnBcf7HiAk8mhenonqyOyXrmwh3g&callback=initialize"
        async defer></script>
      <footer class="footer">
        <img alt="" src="<?= base_url(1);?>images/logo.png" width="300" height="110"  border="0"></footer>
      </footer>
    </body>
</html>