<?php
    $UserName = $this->session->userdata('UserNameInternoSSCA');
    if(empty($UserName)) { // Recuerda usar corchetes.
        header('Location: ' . base_url(1));
    }
?>
<style>
    input, select{
        border-radius:8px;
        width:100%
    }
    a{
        text-decoration:none;
    }
    h2 {
      text-shadow: 0px 2px 3px #555;
      }
      #commentForm label.error,  label.error{
        width: auto;
        display: inline;
        color:#F00;
        font-size:12px;
    }
    .label{
        margin-top: 15px;
    }
    label.errorDato{
        width: auto;
        display: inline;
        color:#F00;
        font-size:12px;
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

<script type="text/javascript">
     //Declaramos las variables que vamos a user
     var lat = null;
     var lng = null;
     var map = null;
     var geocoder;
     var marker;
              
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
         initialize();
     });
          
         function initialize() {
          
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
                 });
           } else {
               //si no es OK devuelvo error
               alert("No podemos encontrar la direcci&oacute;n");
           }
         });
       }
        
       //funcion que simplemente actualiza los campos del formulario
       function updatePosition(latLng)
       {
            
            jQuery('#lat').val(latLng.lat());
            jQuery('#long').val(latLng.lng());
        
       }
</script>
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
                <div class="container-fluid">
                        <h2 align="right" style="margin-top:2.5%; margin-right:2%; color:#09C"><?= $titulo;?></h2>
                        <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <?= $this->session->userdata('UserNameInternoSSCA');?></h4>  
                        <input type="hidden" id="txtUserId" name="txtUserId" value="<?= $this->session->userdata('UserIDInternoSSCA');?>" />  
                        <form id="commentForm" method="post" action="#">
                        <div class="row">
                                <div class="col-md-9">
                                        
                                        <br/>  
                                        <div class="row">
                                            <div class="col-md-3" align="right">
                                                <label for="txtNumeroId"><font color="#09C" size="2">Buscar</font></label>
                                            </div>
                                            <div class="col-md-6">
                                                <input id="txtNumeroId" name="txtNumeroId" type="text" class="form-control"/>
                                                <?php
                                                    $attributesErrorDoc = array(
                                                        'id' => 'lblErrorDocUsuario',
                                                        'style' => 'display: none;',
                                                        'class' => 'errorDato'
                                                    );
                                                    echo form_label("", "txtNumeroDocumento", $attributesErrorDoc);
                                                ?>
                                            </div>
                                        </div><br>          
                                        <div class="row">
                                            <div class="col-md-3" align="right">
                                                <label for="txtTipoId"><font color="#09C" size="2">Tipo de identificaci&oacute;n</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <?php
                                                  $options = array(
                                                            'Cedula de ciudadania'  => 'Cedula de ciudadania',
                                                            'Cedula de Extranjeria'    => 'Cedula de Extranjeria',
                                                            'Nuip'   => 'Nuip',
                                                            'Pasaporte' => 'Pasaporte',
                                                            'Registro Civil'   => 'Registro Civil',
                                                            'TI' => 'TI'
                                                          );

                                                  echo form_dropdown('txtTipoId', $options, 'Cedula de ciudadania', 'id="txtTipoId" class="form-control"');

                                                ?>
                                            </div>
                                            <div class="col-md-3" align="right">
                                                <label for="txtNumeroIdNuevo"><font color="#09C" size="2">No. de identificaci&oacute;n</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtNumeroIdNuevo" name="txtNumeroIdNuevo" type="text" class="form-control" disabled/>
                                                <?php
                                                    $attributesErrorDoc = array(
                                                        'id' => 'lblErrorDocUsuarioNuevo',
                                                        'style' => 'display: none;',
                                                        'class' => 'errorDato'
                                                    );
                                                    echo form_label("", "txtNumeroIdNuevo", $attributesErrorDoc);
                                                ?>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-3" align="right">
                                                <label for="txtPrimerApellido" class="label"><font color="#09C" size="2">Primer Apellido</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtPrimerApellido" name="txtPrimerApellido" type="text" class="form-control" disabled/>
                                            </div>
                                            <div class="col-md-3" align="right">
                                                <label for="txtSegundoApellido" class="label"><font color="#09C" size="2">Segundo Apellido</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtSegundoApellido" name="txtSegundoApellido" type="text" class="form-control" disabled/>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-3" align="right">
                                               <label for="txtPrimerNombre" class="label"><font color="#09C" size="2">Primer Nombre</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtPrimerNombre" name="txtPrimerNombre" type="text" class="form-control" disabled/>
                                            </div>
                                            <div class="col-md-3" align="right">
                                                <label for="txtSegundoNombre" class="label"><font color="#09C" size="2">Segundo Nombre</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtSegundoNombre" name="txtSegundoNombre" type="text" class="form-control" disabled/>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-3" align="right">
                                               <label for="txtTelefono1"><font color="#09C" size="2">Tel&eacute;fono 1</font></label>
                                            </div>
                                            <div class="col-md-3">
                                               <input id="txtTelefono1" name="txtTelefono1" type="text" class="form-control" disabled/>
                                            </div>
                                            <div class="col-md-3" align="right">
                                               <label for="txtTelefono2"><font color="#09C" size="2">Tel&eacute;fono 2</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtTelefono2" name="txtTelefono2" type="text" class="form-control" disabled/>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-3" align="right">
                                               <label for="txtUsuario"><font color="#09C" size="2">RH</font></label>
                                            </div>
                                            <div class="col-md-3">
                                               <input id="txtRh" name="txtRh" type="text" class="form-control" disabled/>
                                            </div>
                                            <div class="col-md-3" align="right">
                                               <label for="txtFechaNaci"><font color="#09C" size="2">Fecha Nacimiento</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtFechaNaci" name="txtFechaNaci" type="date" class="form-control" disabled/>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-3" align="right">
                                               <label for="txtUsuario"><font color="#09C" size="2">E-Mail</font></label>
                                            </div>
                                            <div class="col-md-3">
                                               <input id="txtUsuario" name="txtUsuario" type="text" class="form-control" disabled/>
                                               <input type="hidden" name="txtUsuarioHidden" id="txtUsuarioHidden">
                                               <input type="hidden" name="txtCredencialHidden" id="txtCredencialHidden">
                                                <?php
                                                    $attributesError = array(
                                                        'id' => 'lblErrorUsuario',
                                                        'style' => 'display: none;',
                                                        'class' => 'errorDato'
                                                    );
                                                    echo form_label("", "txtUsuario", $attributesError);
                                                ?>
                                            </div>
                                            <div class="col-md-3" align="right">
                                               <label for="selectTipoUsuario"><font color="#09C" size="2">Tipo de Usuario</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="selectTipoUsuario" id="selectTipoUsuario" class="form-control" disabled>
                                                    <option value="Seleccione">Seleccione...</option>
                                                    <option value="Estudiante">Estudiante</option>
                                                    <option value="Acudiente">Acudiente</option>
                                                    <option value="Funcionario">Funcionario</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" id="divEstudiantes1" style="margin-top: 20px; display: none">
                                            <div class="col-md-3" align="right">
                                               <label for="selectAcudiente"><font color="#09C" size="2">Acudiente asociado</font></label>
                                            </div>
                                            <div class="col-md-3">
                                               <select name="selectAcudiente" id="selectAcudiente" style="" class="form-control"></select><br>
                                               <a href="#open" id="open" class="btn btn-primary">Crear Acudiente</a>   
                                            </div>
                                            <div class="col-md-3" align="right">
                                               <label name="estaltren" id="estaltren"><font color="#09C" size="2">Estudiante Alto Rendimiento</font>
                                            </div>
                                            <div class="col-md-3">
                                                <input type = "checkbox" name="estaltrend" id="estaltrend" style="" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row" id="divEstudiantes2" style="margin-top: 20px; display: none">
                                            <div class="col-md-3" align="right">
                                               <label for="selectCurso"><font color="#09C" size="2">Curso</font></label>
                                            </div>
                                            <div class="col-md-3">
                                               <select name="selectCurso" id="selectCurso" style="" class="form-control"></select>               
                                            </div>
                                            <div class="col-md-3" align="right">
                                               
                                            </div>
                                            <div class="col-md-3">

                                            </div>
                                        </div>
                                        <div class="row" id="divFuncionarios1" style="margin-top: 20px; display: none">
                                            <div class="col-md-3" align="right">
                                               <label for="txtARL"><font color="#09C" size="2">ARL</font></label>
                                            </div>
                                            <div class="col-md-3">
                                               <input id="txtARL" name="txtARL" type="text" class="form-control"/>  
                                                <?php
                                                    $attributesError = array(
                                                        'id' => 'lblErrorARL',
                                                        'style' => 'display: none;',
                                                        'class' => 'errorDato'
                                                    );
                                                    echo form_label("", "txtARL", $attributesError);
                                                ?>           
                                            </div>
                                            <div class="col-md-3" align="right">
                                               <label for="txtCargo"><font color="#09C" size="2">Cargo</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtCargo" name="txtCargo" type="text" class="form-control"/>
                                                <?php
                                                    $attributesError = array(
                                                        'id' => 'lblErrorCargo',
                                                        'style' => 'display: none;',
                                                        'class' => 'errorDato'
                                                    );
                                                    echo form_label("", "txtCargo", $attributesError);
                                                ?>    
                                            </div>
                                        </div>
                                        <div class="row" id="divFuncionarios2" style="margin-top: 20px; display: none">
                                            <div class="col-md-3" align="right">
                                               <label for="selectTipoFuncionario"><font color="#09C" size="2">Tipo de Funcionario</font></label>
                                            </div>
                                            <div class="col-md-3">
                                               <select name="selectTipoFuncionario" id="selectTipoFuncionario" class="form-control" >
                                                    <option value="Tipo A">Tipo A</option>
                                                    <option value="Tipo B">Tipo B</option>
                                                    <option value="Tipo C">Tipo C</option>
                                                </select>            
                                            </div>
                                            <div class="col-md-3" align="right">
                                               
                                            </div>
                                            <div class="col-md-3">
                                               
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-3" align="right">
                                               <label for="direccion"><font color="#09C" size="2">Direccion</font></label>
                                            </div>
                                            <div class="col-md-9">
                                               <input id="direccion" name="direccion" type="text" class="form-control" disabled/>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-3" align="right">
                                               
                                            </div>
                                            <div class="col-md-9">
                                                
                                                    <div id="map_canvas" style="width:100%;height:400px;"></div>
                                                    <!--campos ocultos donde guardamos los datos-->
                                                    <p><input type="hidden" name="lat" id="lat"/></p>
                                                    <p><input type="hidden" name="lng" id="long"/></p>
                                                

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3" align="right">
                                               <label for="txtPass"><font color="#09C" size="2">Contraseña</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtPass" name="txtPass" type="password" class="form-control" disabled/>
                                                <?php
                                                    $attributesError = array(
                                                        'id' => 'lblErrorPass',
                                                        'style' => 'display: none;',
                                                        'class' => 'errorDato'
                                                    );
                                                    echo form_label("", "txtPass", $attributesError);
                                                ?>    
                                            </div>
                                            <div class="col-md-3" align="right">
                                               <label for="txtRePass"><font color="#09C" size="2">Repetir Contraseña</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtRePass" name="txtRePass" type="password" class="form-control" disabled/>
                                                <?php
                                                    $attributesError = array(
                                                        'id' => 'lblErrorRePass',
                                                        'style' => 'display: none;',
                                                        'class' => 'errorDato'
                                                    );
                                                    echo form_label("", "txtRePass", $attributesError);
                                                ?>   
                                            </div>
                                        </div><br>
                                        <div class="row" style="display:none" id="rowCredencial">
                                            <div class="col-md-3" align="right">
                                               <label for="txtRecarga"><font color="#09C" size="2">Saldo:</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtRecarga" name="txtRecarga" type="text" style="" class="form-control" disabled/>
                                                <?php
                                                    $attributesError = array(
                                                        'id' => 'lblErrorRecarga',
                                                        'style' => 'display: none;',
                                                        'class' => 'errorDato'
                                                    );
                                                    echo form_label("", "txtRecarga", $attributesError);
                                                ?>   
                                            </div>
                                            <div class="col-md-3" align="right">
                                               <label for="txtFechaVencimiento"><font color="#09C" size="2">Fecha de Vencimiento de Credencial</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtFechaVencimiento" name="txtFechaVencimiento" type="date" class="form-control" disabled/>
                                                <?php
                                                    $attributesError = array(
                                                        'id' => 'lblErrorFechaVen',
                                                        'style' => 'display: none;',
                                                        'class' => 'errorDato'
                                                    );
                                                    echo form_label("", "txtFechaVencimiento", $attributesError);
                                                ?>   
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-12" align="right">
                                                <button type="submit" class="btn btn-primary" name="btnCrearUsuario" id="btnCrearUsuario" style="display:none">Guardar</button>
                                                <?php
                                                    $attributesError = array(
                                                        'id' => 'lblError',
                                                        'style' => 'display: none;',
                                                        'class' => 'errorDato'
                                                    );
                                                    echo form_label("", "btnCrearUsuario", $attributesError);
                                                ?>     
                                            </div>
                                        </div>
                                </div> 
                                        
                                
                            <div class="col-md-3" align="center" >
                                <br>
                                <video id="v" width="100%" height="100%"></video><br>
                                <canvas id="c" width="100%" height="100%" style="display:none"></canvas><br>
                                <img id="imageFoto" name="imageFoto" width="100%" src="<?= base_url(1);?>images/person.png" />
                                <input type="hidden" name="UrlImagenOculta" id="UrlImagenOculta"><br/><br/>
                                <button id="t" type="button" class="btn btn-primary" disabled>Tomar foto</button>
                                <?php
                                    $attributesError = array(
                                        'id' => 'lblErrorFoto',
                                        'style' => 'display: none;',
                                        'class' => 'errorDato'
                                    );
                                    echo form_label("", "imageFoto", $attributesError);
                                ?>    
                                <br><br>
                                
                                <label for="fileFoto"><font color="#09C" size="2">Seleccionar foto: </font></label><br><input type="file" id="fileFoto" name="fileFoto" class="btn btn-primary" accept="image/*" disabled/>
                                <br><br>   
                                <button  id="pasar" type="button" class="btn btn-primary" disabled>Capturar Coordenadas</button>
                            </div>
                         </div>
                        </form> 
                </div> 
                <div id="popup" style="display: none;">
                    <div class="content-popup" align="right">
                        <div class="close"><a href="#" id="close"><img src="<?= base_url(1);?>images/close.png"/></a></div><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr size="1" color="#000000"/>
                                    <h4 class="text-primary text-left">
                                        Nuevo acudiente
                                    </h4>
                                    <hr size="1" color="#000000"/>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-3" align="right">
                                       <label for="selectTipoIdPopup"><font color="#09C" size="2">Tipo de identificaci&oacute;n:</font></label>
                                    </div>
                                    <div class="col-md-9">
                                        <select id="selectTipoIdPopup" name="selectTipoIdPopup" class="form-control">
                                            <option value="Cedula de ciudadania">Cedula de ciudadania</option>
                                            <option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
                                            <option value="Nuip">Nuip</option>
                                            <option value="Pasaporte">Pasaporte</option>
                                            <option value="Registro Civil">Registro Civil</option>
                                            <option value="Ti">Tarjeta de identidad</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-3" align="right">
                                       <label for="txtNumeroIdPopup"><font color="#09C" size="2">Numero de identificaci&oacute;n:</font></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="txtNumeroIdPopup" id="txtNumeroIdPopup" class="form-control"/>
                                        <?php
                                            $attributesErrorDoc = array(
                                                'id' => 'lblErrorDocUsuarioPopup',
                                                'style' => 'display: none;',
                                                'class' => 'errorDato'
                                            );
                                            echo form_label("", "txtNumeroIdPopup", $attributesErrorDoc);
                                        ?>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-3" align="right">
                                       <label for="txtPrimerApellidoPopup"><font color="#09C" size="2">Primer Apellido:</font></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="txtPrimerApellidoPopup" id="txtPrimerApellidoPopup" class="form-control"/>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-3" align="right">
                                       <label for="txtSegundoApellidoPopup"><font color="#09C" size="2">Segundo Apellido:</font></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="txtSegundoApellidoPopup" id="txtSegundoApellidoPopup" class="form-control"/>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-3" align="right">
                                       <label for="txtPrimerNombrePopup"><font color="#09C" size="2">Primer Nombre:</font></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="txtPrimerNombrePopup" id="txtPrimerNombrePopup" class="form-control"/>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-3" align="right">
                                       <label for="txtSegundoNombrePopup"><font color="#09C" size="2">Segundo Nombre:</font></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="txtSegundoNombrePopup" id="txtSegundoNombrePopup" class="form-control"/>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-3" align="right">
                                       <label for="txtDireccionPopup"><font color="#09C" size="2">Direcci&oacute;n:</font></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="txtDireccionPopup" id="txtDireccionPopup" class="form-control"/>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-3" align="right">
                                       <label for="txtTipoSangrePopup"><font color="#09C" size="2">Tipo de Sangre:</font></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="txtTipoSangrePopup" id="txtTipoSangrePopup" class="form-control"/>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-3" align="right">
                                       <label for="txtTelefono1Popup"><font color="#09C" size="2">Tel&eacute;fono 1:</font></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="txtTelefono1Popup" id="txtTelefono1Popup" class="form-control"/>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-3" align="right">
                                       <label for="txtTelefono2Popup"><font color="#09C" size="2">Tel&eacute;fono 2:</font></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="txtTelefono2Popup" id="txtTelefono2Popup" class="form-control"/>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-3" align="right">
                                       <label for="selectTipoUsuarioPopup"><font color="#09C" size="2">Tipo de usuario:</font></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="selectTipoUsuarioPopup"  value="Acudiente" id="" name="" disabled class="form-control"/>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-3" align="right">
                                       <label for="txtUsuarioPopup"><font color="#09C" size="2">E-mail:</font></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="txtUsuarioPopup" id="txtUsuarioPopup" class="form-control"/>
                                        <?php
                                            $attributesError = array(
                                                'id' => 'lblErrorUsuarioPopUp',
                                                'style' => 'display: none;',
                                                'class' => 'errorDato'
                                            );
                                            echo form_label("", "txtUsuarioPopup", $attributesError);
                                        ?>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-3" align="right">
                                       <label for="txtClavePopup"><font color="#09C" size="2">Clave:</font></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" name="txtClavePopup" id="txtClavePopup" class="form-control"/>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px" id="validacion">
                                </div>

                            </div>
                            <br>
                        
                          <button type="button" class="btn btn-primary" id="btnGuardarPopUp" name="btnGuardarPopUp">Guardar</button>
                        </div>
                        
                      </div>
                      
        </div>          
        <br/>
        
    <div class="container" style="position: absolute;z-index: 1;">
        <div class="row" align="center" id="chats">           
            
        </div>
    </div>
    <?= $footer;?>
        <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="<?= base_url(1);?>js/chat.js"></script>
        <script src="<?= base_url(1);?>js/jquery.validate.js"></script>         
        <script>
            var arrayServicios = new Array();
            var arrayGuardar = new Array();
            var video = document.querySelector('#v'), canvas = document.querySelector('#c'), btn = document.querySelector('#t'), img = document.querySelector('#imageFoto');
            var urlFoto = "";
        	window.addEventListener('load',init);
    		function init(){
    			navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
            
                if(navigator.getUserMedia){
                    $("#t").css({"display":"block"})
                    navigator.getUserMedia({video:true},function(stream){
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                },function(e){$("#t").css({"display":"none"})});
                
                video.addEventListener('loadedmetadata',function(){canvas.width = video.videoWidth, canvas.height = video.videoHeight;},false);
                
                btn.addEventListener('click',function(){
                    canvas.getContext('2d').drawImage(video,0,0);
                    var imgData = canvas.toDataURL('image/png');
                    img.setAttribute('src',imgData);  
                    urlFoto = imgData;      
                    $("#lblErrorFoto").css({"display":"none"})
                });
                
                }else{
                    alert("Por favor usa el explorador opera o google chrome para el funcionamiento optimo del modulo. Gracias.");        
                }
    		}
            function readImage() {
                //console.log(this.files);
                if ( this.files && this.files[0] ) {
                    var FR = new FileReader();
                    FR.onload = function(e) {
                         $('#imageFoto').attr( "src", e.target.result );
                         //$('#base').text( e.target.result );
                         //console.log(e.target.result);
                         urlFoto = e.target.result;
                         $("#UrlImagenOculta").val("");
                         $("#lblErrorFoto").css({"display":"none"})
                         //console.log(urlFoto);
                    };       
                    FR.readAsDataURL( this.files[0] );
                }
            }
            
            $("#fileFoto").change( readImage );
            $.validator.setDefaults({
                submitHandler: function() {
                    //Se obtienen los datos a ingresar
                    var latitud = $("#lat").val()
                    var longitud = $("#long").val()
                    var tipoId = $("#txtTipoId").val();
                    var numeroId = $("#txtNumeroId").val();
                    var numeroIdNuevo = $("#txtNumeroIdNuevo").val();
                    var primerApellido = $("#txtPrimerApellido").val();
                    var segundoApellido = $("#txtSegundoApellido").val();
                    var primerNombre = $("#txtPrimerNombre").val();
                    var segundoNombre = $("#txtSegundoNombre").val();
                    var direccion = $("#direccion").val();
                    var telefono1 = $("#txtTelefono1").val();
                    var telefono2 = $("#txtTelefono2").val();
                    var estaltrend = "";  
                    var selectTipoFuncionario = $("#selectTipoFuncionario").val();
                    var fecha = $("#txtFechaNaci").val();
                    var tipoUsuario = $("#selectTipoUsuario").val();
                    var usuarioIngresado = $("#txtUsuario").val();
                    var clave = $("#txtPass").val();
                    var reclave = $("#txtRePass").val();
                    var saldo = $("#txtRecarga").val();
                    saldo = saldo.replace('.','');
                    var tipoSangre = $("#txtRh").val();
                    var curso = $("#selectCurso").val();
                    var arl = $("#txtARL").val();
                    var cargo = $("#txtCargo").val();
                    var idAcudiente = "";
                    var dataURL = canvas.toDataURL("image/png");
                    var fechaVencimiento = $("#txtFechaVencimiento").val();
                    var dataURL;
                    var fotoCon;
                    var idCredencial = $("#txtCredencialHidden").val();
                    if($("#UrlImagenOculta").val() == ""){
                        dataURL = $('#imageFoto').attr( "src");
                        console.log(dataURL + " + ")
                        fotoCon = "";
                    }else{
                        console.log($("#UrlImagenOculta").val() + " - ")
                        dataURL = "";
                        fotoCon = $("#UrlImagenOculta").val();
                    }

                    if(tipoUsuario == "Estudiante"){
                        idAcudiente = $("#selectAcudiente").val();
                    }else{
                        idAcudiente = numeroId;
                    }

                    if( $('#estaltrend').prop('checked') ) {
                        estaltrend = "on";
                    }else{
                        estaltrend = "";
                    }
                    /*
                        Descripcion: Obtener fecha y hora para registrar movimientos
                    */
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
                    
                    var fechaActual = year + "-" + mes + "-" + dia;
                    var horaActual = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds(); 
                    //Se guardan los datos en un JSON
                    var datos = {
                        TipoId: tipoId,
                        NumeroId: numeroId,
                        PrimerApellido: primerApellido,
                        SegundoApellido: segundoApellido,
                        PrimerNombre: primerNombre,
                        SegundoNombre: segundoNombre,
                        Direccion: direccion,
                        Telefono1: telefono1,
                        Telefono2: telefono2,
                        tipoestudiante: estaltrend,
                        fechanacimiento: fecha,
                        TipoUsuario: tipoUsuario,
                        idUsuario: usuarioIngresado,
                        Clave: clave,
                        idAcudiente: idAcudiente,
                        saldo: saldo,
                        fecha: fechaActual,
                        hora: horaActual,
                        imgBase64: dataURL,
                        latitud: latitud,
                        longitud: longitud,
                        TipoSangre: tipoSangre,
                        curso: curso,
                        fechaVencimiento: fechaVencimiento,
                        arl: arl,
                        cargo: cargo,
                        tipofuncionario: selectTipoFuncionario,
                        fotoCon: fotoCon,
                        idCredencial: idCredencial,
                        numeroIdNuevo: numeroIdNuevo
                    }   
                    

                    switch(tipoUsuario){
                        case "Estudiante":
                            //if(dataURL != ""){
                                if(clave == reclave){
                                    if($.trim(fechaVencimiento) != ""){
                                        $("#btnCrearUsuario").attr("disabled", "disabled")
                                        $.post("<?= base_url();?>index.php/usuarios_aplicaciones/editarUsuario", datos)
                                        .done(function( result ) {console.log(result)
                                            alert("¡Se actualizó con exito el usuario!");
                                            
                                            $("input").val("")
                                            $("#btnCrearUsuario").css({"display":"block"})
                                            $("#btnCrearUsuario").removeAttr("disabled")
                                            $("#divEstudiantes1").css({"display":"none"})
                                            $("#divEstudiantes2").css({"display":"none"})
                                            $("#divFuncionarios1").css({"display":"none"})
                                            $("#divFuncionarios2").css({"display":"none"})
                                            $("#imageFoto").attr("src", "<?= base_url(1);?>images/person.png");
                                            lat = '';
                                            lng = '';
                                            initialize()
                                            window.location.href = "<?= base_url();?>index.php/usuarios_aplicaciones/editar";
                                            
                                        });
                                    }else{
                                        if($.trim(fechaVencimiento) == ""){
                                            $("#lblErrorFechaVen").css({"display":"block"})
                                            $("#lblErrorFechaVen").html("Por favor ingrese la fecha de Vencimiento valida");
                                        }                                        
                                    }
                                     
                                }else{
                                    $("#lblErrorPass").css({"display":"block"})
                                    $("#lblErrorPass").html("Las contraseñas no coinciden");
                                    $("#lblErrorRePass").css({"display":"block"})
                                    $("#lblErrorRePass").html("Las contraseñas no coinciden");
                                }  
                                    
                                
                            /*}else{
                                $("#lblErrorFoto").css({"display":"block"})
                                $("#lblErrorFoto").html("Por favor seleccione una foto o capture una fotografia con la camara web");
                            }*/
                            break;

                        case "Funcionario":
                            //if(dataURL != ""){
                                if($.trim(arl) != "" && $.trim(cargo) != ""){
                                    if(clave == reclave){
                                        if($.trim(fechaVencimiento) != ""){
                                            $("#btnCrearUsuario").attr("disabled", "disabled")
                                            $.post("<?= base_url();?>index.php/usuarios_aplicaciones/editarUsuario", datos)
                                            .done(function( result ) {console.log(result)
                                                alert("¡Se actualizó con exito el usuario!");                         
                                                
                                                $("input").val("")
                                                $("#btnCrearUsuario").css({"display":"block"})
                                                $("#btnCrearUsuario").removeAttr("disabled")
                                                $("#divEstudiantes1").css({"display":"none"})
                                                $("#divEstudiantes2").css({"display":"none"})
                                                $("#divFuncionarios1").css({"display":"none"})
                                                $("#divFuncionarios2").css({"display":"none"})
                                                $("#imageFoto").attr("src", "<?= base_url(1);?>images/person.png");
                                                lat = '';
                                                lng = '';
                                                initialize()
                                                window.location.href = "<?= base_url();?>index.php/usuarios_aplicaciones/editar";
                                                
                                            });
                                        }else{
                                            if($.trim(fechaVencimiento) == ""){
                                                $("#lblErrorFechaVen").css({"display":"block"})
                                                $("#lblErrorFechaVen").html("Por favor ingrese la fecha de Vencimiento valida");
                                            }                                            
                                        }
                                    }else{
                                        $("#lblErrorPass").css({"display":"block"})
                                        $("#lblErrorPass").html("Las contraseñas no coinciden");
                                        $("#lblErrorRePass").css({"display":"block"})
                                        $("#lblErrorRePass").html("Las contraseñas no coinciden");
                                    }  
                                }else{
                                    if($.trim(arl) == ""){
                                        $("#lblErrorARL").css({"display":"block"})
                                        $("#lblErrorARL").html("Por favor ingrese la ARL del funcionario");
                                    }
                                    if($.trim(cargo) == ""){
                                        $("#lblErrorCargo").css({"display":"block"})
                                        $("#lblErrorCargo").html("Por favor ingrese el cargo del funcionario");
                                    }
                                }
                            /*}else{
                                $("#lblErrorFoto").css({"display":"block"})
                                $("#lblErrorFoto").html("Por favor seleccione una foto o capture una fotografia con la camara web");
                            }*/
                            break;

                        case "Acudiente":
                            if(clave == reclave){
                                $("#btnCrearUsuario").attr("disabled", "disabled")
                                $.post("<?= base_url();?>index.php/usuarios_aplicaciones/editarUsuario", datos)
                                .done(function( result ) {console.log(result)
                                    alert("¡Se actualizó con exito el usuario!");                         
                                    
                                    $("input").val("")
                                    $("#btnCrearUsuario").css({"display":"block"})
                                    $("#btnCrearUsuario").removeAttr("disabled")
                                    $("#divEstudiantes1").css({"display":"none"})
                                    $("#divEstudiantes2").css({"display":"none"})
                                    $("#divFuncionarios1").css({"display":"none"})
                                    $("#divFuncionarios2").css({"display":"none"})
                                    $("#imageFoto").attr("src", "<?= base_url(1);?>images/person.png");
                                    lat = '';
                                    lng = '';
                                    initialize()
                                    window.location.href = "<?= base_url();?>index.php/usuarios_aplicaciones/editar";
                                    
                                }); 
                            }else{
                                $("#lblErrorPass").css({"display":"block"})
                                $("#lblErrorPass").html("Las contraseñas no coinciden");
                                $("#lblErrorRePass").css({"display":"block"})
                                $("#lblErrorRePass").html("Las contraseñas no coinciden");
                            }
                            break;
                    }
                    
                    
                    
                }
            });
            (function() {
                // use custom tooltip; disable animations for now to work around lack of refresh method on tooltip
                $("#commentForm").tooltip({
                  show: false,
                  hide: false
                });
              
                // validate signup form on keyup and submit
                $("#commentForm").validate({
                  rules: {
                    txtNumeroId: "required",
                    txtPrimerApellido: "required",
                    txtSegundoApellido: "required",
                    txtPrimerNombre: "required",
                    txtTelefono1: "required",
                    txtUsuario: "required",
                    txtPass: "required",
                    direccion: "required",
                    txtFecha: "required",
                    txtUsuario: "required",
                    txtTipoSangre: "required",
                    txtRh: "required",
                    txtFechaNaci: "required"
                  },
                  messages: {
                    txtNumeroId: "Por favor ingrese un numero de identificacion",
                    txtPrimerApellido: "Por favor ingrese el primer apellido",
                    txtSegundoApellido: "Por favor ingrese el segundo apellido",
                    txtPrimerNombre: "Por favor ingrese el primer nombre",
                    txtTelefono1: "Por favor ingrese un numero de telefono",
                    txtUsuario: "Por favor ingrese un correo electronico válido",
                    txtPass: "Por favor ingrese una clave",
                    direccion: "Por favor ingrese una direccion",
                    txtFecha: "Por favor ingrese la fecha de nacimiento",
                    txtUsuario: "Por favor ingrese un nombre de usuario",
                    txtTipoSangre: "Por favor ingrese el tipo de sangre",
                    txtRh: "Por favor ingrese el RH",
                    txtFechaNaci: "Por favor ingrese una fecha de nacimiento valida"
                  }
                });


                  
            })();

            function cargaContextoCanvas(idCanvas){
               var elemento = document.getElementById(idCanvas);
               if(elemento && elemento.getContext){
                  var contexto = elemento.getContext('2d');
                  if(contexto){
                     return contexto;
                  }
               }
               return FALSE;
            }

            /*
                Evento para saber si el nombre de usuario o idusuario existe o no en la bd.
                Si este existe se muestra un error y se oculta el boton de registrar, sino se quitar el mensaje de error y se muestra el boton de registrar.
            */
            $("#txtUsuario").keyup(function(e) {
                //Se obtiene lo que ha escrito el usuario
                var usuarioExiste = $("#txtUsuario").val();
                var usuarioOculto = $("#txtUsuarioHidden").val();
                
                if(usuarioExiste != usuarioOculto){
        
                    //Se guardan los datos en un JSON
                    var datos = {
                        usuario: usuarioExiste          
                    }       
                    /*
                        Se conecta a la funcion del controlador para verificar la existencia del dato enviado.
                        La funcion base_url(1) obtiene la url base del proyecto, la cual es configurada en el archivo config.php
                    */
                    $.post("<?= base_url();?>index.php/usuarios_aplicaciones/ExisteUsuario", datos)
                    .done(function( data ) {
                        if($.trim(data) == "1"){
                            $("#lblErrorUsuario").css({"display":"block"});
                            $("#lblErrorUsuario").html('El usuario ' + $("#txtUsuario").val() + ' ya existe');
                            $("#btnCrearUsuario").css({"visibility":"hidden"});
                        }else{
                            $("#lblErrorUsuario").css({"display":"none"});
                            $("#btnCrearUsuario").css({"visibility":"visible"});
                        }
                    });
                }
                
            });

            $("#txtUsuarioPopup").keyup(function(e) {
                //Se obtiene lo que ha escrito el usuario
                var usuarioExiste = $("#txtUsuarioPopup").val();
        
                //Se guardan los datos en un JSON
                var datos = {
                    usuario: usuarioExiste          
                }       
                /*
                    Se conecta a la funcion del controlador para verificar la existencia del dato enviado.
                    La funcion base_url(1) obtiene la url base del proyecto, la cual es configurada en el archivo config.php
                */
                $.post("<?= base_url();?>index.php/usuarios_aplicaciones/ExisteUsuario", datos)
                .done(function( data ) {
                    if($.trim(data) == "1"){
                        $("#lblErrorUsuarioPopUp").css({"display":"block"});
                        $("#lblErrorUsuarioPopUp").html('El usuario ' + $("#txtUsuario").val() + ' ya existe');
                        $("#btnGuardarPopUp").css({"visibility":"hidden"});
                    }else{
                        $("#lblErrorUsuarioPopUp").css({"display":"none"});
                        $("#btnGuardarPopUp").css({"visibility":"visible"});
                    }
                });
                
                
            });

            /*
                Evento para saber si el nombre de usuario o idusuario existe o no en la bd.
                Si este existe se muestra un error y se oculta el boton de registrar, sino se quitar el mensaje de error y se muestra el boton de registrar.
            */
            $("#txtNumeroIdNuevo").keyup(function(e) {
                //Se obtiene lo que ha escrito el usuario
                var numeroId = $("#txtNumeroIdNuevo").val();
                var numeroIdViejo = $("#txtNumeroId").val();
        
                //Se guardan los datos en un JSON
                var datos = {
                    documento: numeroId         
                }   
                if(numeroId != numeroIdViejo){
                    /*
                        Se conecta a la funcion del controlador para verificar la existencia del dato enviado.
                        La funcion base_url(1) obtiene la url base del proyecto, la cual es configurada en el archivo config.php
                    */
                    $.post("<?= base_url();?>index.php/usuarios_aplicaciones/ExisteDocumentoUsuario", datos)
                    .done(function( data ) {console.log(data)
                        if($.trim(data) == "1"){
                            $("#lblErrorDocUsuarioNuevo").css({"display":"block"});
                            $("#lblErrorDocUsuarioNuevo").html('El documento de identificación ' + $("#txtNumeroIdNuevo").val() + ' ya existe');
                            $("#btnCrearUsuario").css({"visibility":"hidden"});
                        }else{
                            $("#lblErrorDocUsuarioNuevo").css({"display":"none"});
                            $("#btnCrearUsuario").css({"visibility":"visible"});
                        }
                    });
                }    
                
                
                
            });

            /*
                Evento para saber si el nombre de usuario o idusuario existe o no en la bd.
                Si este existe se muestra un error y se oculta el boton de registrar, sino se quitar el mensaje de error y se muestra el boton de registrar.
            */
            $("#txtNumeroId").keyup(function(e) {
                //Se obtiene lo que ha escrito el usuario
                var numeroId = $("#txtNumeroId").val();
        
                //Se guardan los datos en un JSON
                var datos = {
                    usuario: numeroId           
                }       
                /*
                    Se conecta a la funcion del controlador para verificar la existencia del dato enviado.
                    La funcion base_url(1) obtiene la url base del proyecto, la cual es configurada en el archivo config.php
                */
                $.post("<?= base_url();?>index.php/usuarios_aplicaciones/ConsultarUsuarioPorNum", datos)
                .done(function( data ) {
                    console.log($.trim(data));
                 
                    if($.trim(data) != "[]"){
                    
                        $("#txtPrimerApellido").removeAttr("disabled");
                        $("#txtNumeroIdNuevo").removeAttr("disabled");
                        $("#txtSegundoApellido").removeAttr("disabled");
                        $("#txtPrimerNombre").removeAttr("disabled");
                        $("#txtSegundoNombre").removeAttr("disabled");
                        $("#txtTelefono1").removeAttr("disabled");
                        $("#txtTelefono2").removeAttr("disabled");
                        $("#txtRh").removeAttr("disabled");
                        $("#txtFechaNaci").removeAttr("disabled");
                        $("#txtUsuario").removeAttr("disabled");
                        $("#txtUsuarioHidden").removeAttr("disabled");
                        $("#selectTipoUsuario").removeAttr("disabled");
                        $("#direccion").removeAttr("disabled");
                        $("#txtPass").removeAttr("disabled");
                        $("#txtRePass").removeAttr("disabled");
                        $("#txtFechaVencimiento").removeAttr("disabled");
                        $("#fileFoto").removeAttr("disabled");

                        $("button").removeAttr("disabled");
                        var json = JSON.parse(data);

                        if(json.length > 0){
                            $.each(json, function(i, item) {
                                $("#txtTipoId").val(json[i].TipoId);
                                $("#txtPrimerApellido").val(json[i].PrimerApellido);
                                $("#txtSegundoApellido").val(json[i].SegundoApellido);
                                $("#txtPrimerNombre").val(json[i].PrimerNombre);
                                $("#txtSegundoNombre").val(json[i].SegundoNombre);
                                $("#txtTelefono1").val(json[i].Telefono1);
                                $("#txtTelefono2").val(json[i].Telefono2);
                                $("#txtRh").val(json[i].TipoSangre);
                                $("#txtFechaNaci").val(json[i].fechanacimiento);
                                $("#txtUsuario").val(json[i].idUsuario);
                                $("#txtNumeroIdNuevo").val(json[i].NumeroId);
                                $("#txtUsuarioHidden").val(json[i].idUsuario)
                                $("#selectTipoUsuario").val(json[i].TipoUsuario);
                                $("#direccion").val(json[i].Direccion);
                                $("#txtPass").val(json[i].Clave);
                                $("#txtRePass").val(json[i].Clave);

                                if($.trim(json[i].ImagenFotografica).length > 0){
                                    $("#imageFoto").attr("src", "<?= base_url(1);?>" + json[i].ImagenFotografica);
                                     $("#UrlImagenOculta").val(json[i].ImagenFotografica)
                                    
                                }else{
                                    $("#imageFoto").attr("src", "<?= base_url(1);?>" + "images/person.png");
                                }
                                
                                if($.trim(json[i].latitud).length > 0 && $.trim(json[i].longitud).length > 0){
                                    
                                    lat = json[i].latitud;
                                    lng = json[i].longitud;

                                    codeAddress();
                                    //Inicializamos la función de google maps una vez el DOM este cargado
                                    initialize();
                                }else{
                                    lat = "";
                                    lng = "";

                                    initialize();

                                }
                                switch(json[i].TipoUsuario){
                                    case "Estudiante":
                                        ListarAcudientes(json[i].idAcudiente)
                                        ListarCursos(json[i].curso)
                                        $("#btnCrearUsuario").css({"display":"block"})
                                        $("#divEstudiantes1").css({"display":"block"})
                                        $("#divEstudiantes2").css({"display":"block"})
                                        $("#divFuncionarios1").css({"display":"none"})
                                        $("#divFuncionarios2").css({"display":"none"})
                                        $("#txtRecarga").val(json[i].SaldoCredencial);
                                        $("#txtFechaVencimiento").val(json[i].FechaVencimiento);
                                        $("#txtCredencialHidden").val(json[i].idCredencial);
                                        $("#rowCredencial").css({"display":"block"})  

                                        if($.trim(json[i].tipoestudiante) == "on"){
                                            $("#estaltrend").prop("checked", true);  // para poner la marca
                                        }else{
                                            $("#estaltrend").prop("checked", false);  // para poner la marca
                                        }
                                        break;

                                    case "Funcionario":
                                        $("#btnCrearUsuario").css({"display":"block"})
                                        $("#divEstudiantes1").css({"display":"none"})
                                        $("#divEstudiantes2").css({"display":"none"})
                                        $("#divFuncionarios1").css({"display":"block"})
                                        $("#divFuncionarios2").css({"display":"block"})
                                        $("#txtRecarga").val(json[i].SaldoCredencial);
                                        $("#txtFechaVencimiento").val(json[i].FechaVencimiento);
                                        $("#txtCredencialHidden").val(json[i].idCredencial);
                                        $("#txtARL").val(json[i].arl);
                                        $("#txtCargo").val(json[i].cargo);
                                        $("#selectTipoFuncionario").val(json[i].tipofuncionario);
                                        $("#rowCredencial").css({"display":"block"})  
                                        $("#estaltrend").prop("checked", false);  // para poner la marca
                                        break;

                                    case "Acudiente":
                                        $("#btnCrearUsuario").css({"display":"block"})
                                        $("#divEstudiantes1").css({"display":"none"})
                                        $("#divEstudiantes2").css({"display":"none"})
                                        $("#divFuncionarios1").css({"display":"none"})
                                        $("#divFuncionarios2").css({"display":"none"})
                                        $("#rowCredencial").css({"display":"none"}) 
                                        $("#txtCredencialHidden").val(""); 
                                        $("#estaltrend").prop("checked", false);  // para poner la marca
                                        break;
                                }
                            });
                        }else{
                            $("#btnCrearUsuario").css({"display":"none"})
                            $("#divEstudiantes1").css({"display":"none"})
                            $("#divEstudiantes2").css({"display":"none"})
                            $("#divFuncionarios1").css({"display":"none"})
                            $("#divFuncionarios2").css({"display":"none"})
                            $("#rowCredencial").css({"display":"none"}) 
                            $("#txtPrimerApellido").val("");
                            $("#txtNumeroIdNuevo").val("");
                            $("#txtSegundoApellido").val("");
                            $("#txtPrimerNombre").val("");
                            $("#txtSegundoNombre").val("");
                            $("#txtTelefono1").val("");
                            $("#txtTelefono2").val("");
                            $("#txtRh").val("");
                            $("#txtFechaNaci").val("");
                            $("#txtUsuario").val("");
                            $("#txtUsuarioHidden").val("");
                            $("#selectTipoUsuario").val("Seleccione");
                            $("#txtTipoId").val("Cedula de ciudadania");
                            $("#direccion").val("");
                            $("#txtPass").val("");
                            $("#txtRePass").val("");
                            $("#txtCredencialHidden").val("");
                            $("#imageFoto").attr("src", "<?= base_url(1);?>" + "images/person.png");
                            $("#estaltrend").prop("checked", false);  // para poner la marca

                            var latLng = new google.maps.LatLng(4.710988599999999,-74.072092);
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
                        }
                    
                    }else{
                        
                        $("#btnCrearUsuario").css({"display":"none"})
                        $("#divEstudiantes1").css({"display":"none"})
                        $("#divEstudiantes2").css({"display":"none"})
                        $("#divFuncionarios1").css({"display":"none"})
                        $("#divFuncionarios2").css({"display":"none"})
                        $("#rowCredencial").css({"display":"none"}) 
                        $("#btnCrearUsuario").css({"display":"none"})
                        $("#divEstudiantes1").css({"display":"none"})
                        $("#divEstudiantes2").css({"display":"none"})
                        $("#divFuncionarios1").css({"display":"none"})
                        $("#divFuncionarios2").css({"display":"none"})
                        $("#rowCredencial").css({"display":"none"}) 
                         $("#txtPrimerApellido").val("");
                        $("#txtSegundoApellido").val("");
                        $("#txtPrimerNombre").val("");
                        $("#txtNumeroIdNuevo").val("");
                        $("#txtSegundoNombre").val("");
                        $("#txtTelefono1").val("");
                        $("#txtTelefono2").val("");
                        $("#txtRh").val("");
                        $("#txtFechaNaci").val("");
                        $("#txtUsuario").val("");
                        $("#txtUsuarioHidden").val("");
                        $("#selectTipoUsuario").val("Seleccione");
                        $("#txtTipoId").val("Cedula de ciudadania");
                        $("#direccion").val("");
                        $("#txtPass").val("");
                        $("#txtRePass").val("");
                        $("#txtCredencialHidden").val("");
                        $("#imageFoto").attr("src", "<?= base_url(1);?>" + "images/person.png");
                        $("#estaltrend").prop("checked", false);  // para poner la marca

                        var latLng = new google.maps.LatLng(4.710988599999999,-74.072092);
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
                    }
                });
                
                
            });
            

            $("#txtNumeroIdPopup").keyup(function(e) {
                //Se obtiene lo que ha escrito el usuario
                var numeroId = $("#txtNumeroIdPopup").val();
                var tipoId = $("#selectTipoIdPopup").val();
        
                //Se guardan los datos en un JSON
                var datos = {
                    documento: numeroId,
                    tipoId: tipoId               
                }       
                /*
                    Se conecta a la funcion del controlador para verificar la existencia del dato enviado.
                    La funcion base_url(1) obtiene la url base del proyecto, la cual es configurada en el archivo config.php
                */
                $.post("<?= base_url();?>index.php/usuarios_aplicaciones/ExisteDocumentoUsuario", datos)
                .done(function( data ) {
                    if($.trim(data) == "1"){
                        $("#lblErrorDocUsuarioPopup").css({"display":"block"});
                        $("#lblErrorDocUsuarioPopup").html('El/La' + $("#selectTipoIdPopup").val() + " " + $("#txtNumeroIdPopup").val() + ' ya existe');
                        $("#btnGuardarPopUp").css({"visibility":"hidden"});
                    }else{
                        $("#lblErrorDocUsuarioPopup").css({"display":"none"});
                        $("#btnGuardarPopUp").css({"visibility":"visible"});
                    }
                });
                
                
            });

            

            $("#selectTipoUsuario").change(function(e) {
                switch($("#selectTipoUsuario").val()){
                    case "Estudiante":
                        ListarAcudientes("")
                        ListarCursos("")
                        $("#btnCrearUsuario").css({"display":"block"})
                        $("#divEstudiantes1").css({"display":"block"})
                        $("#divEstudiantes2").css({"display":"block"})
                        $("#divFuncionarios1").css({"display":"none"})
                        $("#divFuncionarios2").css({"display":"none"})
                        $("#rowCredencial").css({"display":"block"})  
                        
                        break;

                    case "Funcionario":
                        $("#btnCrearUsuario").css({"display":"block"})
                        $("#divEstudiantes1").css({"display":"none"})
                        $("#divEstudiantes2").css({"display":"none"})
                        $("#divFuncionarios1").css({"display":"block"})
                        $("#divFuncionarios2").css({"display":"block"})
                        $("#rowCredencial").css({"display":"block"})  
                        break;

                    case "Acudiente":
                        $("#btnCrearUsuario").css({"display":"block"})
                        $("#divEstudiantes1").css({"display":"none"})
                        $("#divEstudiantes2").css({"display":"none"})
                        $("#divFuncionarios1").css({"display":"none"})
                        $("#divFuncionarios2").css({"display":"none"})
                        $("#rowCredencial").css({"display":"none"})  
                        break;

                    case "Seleccione":
                        $("#btnCrearUsuario").css({"display":"none"})
                        $("#divEstudiantes1").css({"display":"none"})
                        $("#divEstudiantes2").css({"display":"none"})
                        $("#divFuncionarios1").css({"display":"none"})
                        $("#divFuncionarios2").css({"display":"none"})
                        $("#rowCredencial").css({"display":"none"})  
                        break;
                }
            });

            function ListarAcudientes(usuario){
                $.post("<?= base_url();?>index.php/usuarios_aplicaciones/listarAcudientes", {})
                .done(function( data ) {
                    if($.trim(data) != "[]"){                       
                        var json = JSON.parse(data);
                        $("#selectAcudiente").html("")
                        for (var i = 0; i < json.length; i++) {
                            $("#selectAcudiente").append("<option value='" + json[i].idUsuario + "'>" + json[i].PrimerNombre + " " + json[i].SegundoNombre + " " + json[i].PrimerApellido + " " + json[i].SegundoApellido + "</option>")
                        }
                        if(usuario != ""){
                          $("#selectAcudiente").val(usuario)
                        }
                    }
                    if($('#selectAcudiente option').length > 0){
                        mostrarBoton()
                        
                    }else{
                        var mensaje = "";
                        mensaje += "No se han registrado Acudientes en el sistema. Registre uno primero antes de crear el Estudiante<br/>";
                        mostrarBoton()
                       
                        $("#lblError").append(mensaje);
                    } 
                });
                
            }

            function ListarCursos(curso){
                $.post("<?= base_url();?>index.php/cursos/listarCursos", {})
                .done(function( data ) {
                    if($.trim(data) != "[]"){                       
                        var json = JSON.parse(data);
                        $("#selectCurso").html("")
                        for (var i = 0; i < json.length; i++) {
                            $("#selectCurso").append("<option value='" + json[i].id + "'>" + json[i].Descripcion + "</option>")
                        }
                        if(curso.length > 0){
                            $("#selectCurso").val(curso)
                        }
                        
                    } 
                    if($('#selectCurso option').length > 0){
                        mostrarBoton()
                        
                    }else{
                        var mensaje = "";
                        mensaje += "No se han registrado cursos en el sistema. Registre uno primero antes de crear el Estudiante<br/>";
                        mostrarBoton()
                        
                        $("#lblError").append(mensaje);

                    }
                });
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

            $("#btnGuardarPopUp").click(function(e){
                var tipoId = $("#selectTipoIdPopup").val();
                var numeroId = $("#txtNumeroIdPopup").val();
                var primerApellido = $("#txtPrimerApellidoPopup").val();
                var segundoApellido = $("#txtSegundoApellidoPopup").val();
                var primerNombre = $("#txtPrimerNombrePopup").val();
                var segundoNombre = $("#txtSegundoNombrePopup").val();
                var direccion = $("#txtDireccionPopup").val();
                var telefono1 = $("#txtTelefono1Popup").val();
                var telefono2 = $("#txtTelefono2Popup").val();
                var tipoUsuario = "Acudiente";
                var usuarioIngresado = $("#txtUsuarioPopup").val();
                var clave = $("#txtClavePopup").val();
                var tipoSangre = $("#txtTipoSangrePopup").val();
                var saldo = "";
                var idAcudiente = numeroId;
                
                var fechaActual = "";
                var horaActual = "";
                
                //Se guardan los datos en un JSON
                var datos = {
                    TipoId: tipoId,
                    NumeroId: numeroId,
                    PrimerApellido: primerApellido,
                    SegundoApellido: segundoApellido,
                    PrimerNombre: primerNombre,
                    SegundoNombre: segundoNombre,
                    Direccion: direccion,
                    Telefono1: telefono1,
                    Telefono2: telefono2,
                    tipoestudiante: "",
                    fechanacimiento: "",
                    TipoUsuario: tipoUsuario,
                    idUsuario: usuarioIngresado,
                    Clave: clave,
                    idAcudiente: idAcudiente,
                    saldo: saldo,
                    fecha: fechaActual,
                    hora: horaActual,
                    imgBase64: "",
                    latitud: "",
                    longitud: "",
                    TipoSangre: tipoSangre,
                    curso: "0"
                } 
                
                if(validarCampos() == "OK"){
                    $("#btnGuardarPopUp").attr("disabled", "disabled")
                    $.post("<?= base_url();?>index.php/usuarios_aplicaciones/crearUsuario", datos)
                    .done(function( result ) {
                        $("#validacion").html("")
                        alert("¡Se ingreso con exito el acudiente!");                       
                        
                        
                        $("#btnGuardarPopUp").css({"btnGuardarPopUp":"visible"})
                        $("#btnGuardarPopUp").removeAttr("disabled")
                        $("#imageFoto").attr("src", "<?= base_url(1);?>images/person.png");
                        
                        $(".modal-body > .container-fluid > .row > div > input").val("")
                        $('#popup').fadeOut('slow');
                        $('.popup-overlay').fadeOut('slow');

                        ListarAcudientes(usuarioIngresado)
                        
                    }); 
                    
                }else{
                    $("#validacion").html(validarCampos() )
                }
                
            });
            function mostrarBoton(){
              if($.trim($("#lblError").html().length) != 0){
                console.log($("#lblError").html().length)
                $("#btnCrearUsuario").css({"display":"none"});
                $("#lblError").css({"display":"block"});
              }else{
                $("#lblError").css({"display":"none"});
                $("#btnCrearUsuario").css({"display":"block"});
              }
            }

            function validarCampos(){
                var estado = "";
                var tipoId = $("#selectTipoIdPopup").val();
                var numeroId = $("#txtNumeroIdPopup").val();
                var primerApellido = $("#txtPrimerApellidoPopup").val();
                var segundoApellido = $("#txtSegundoApellidoPopup").val();
                var primerNombre = $("#txtPrimerNombrePopup").val();
                var segundoNombre = $("#txtSegundoNombrePopup").val();
                var direccion = $("#txtDireccionPopup").val();
                var telefono1 = $("#txtTelefono1Popup").val();
                var telefono2 = $("#txtTelefono2Popup").val();
                var tipoUsuario = "Acudiente";
                var usuarioIngresado = $("#txtUsuarioPopup").val();
                var clave = $("#txtClavePopup").val();
                var tipoSangre = $("#txtTipoSangrePopup").val();

                if($.trim(numeroId) != "" && $.trim(primerApellido) != "" && $.trim(segundoApellido) != "" && $.trim(primerNombre) != "" && $.trim(direccion) != "" && $.trim(telefono1) != "" && $.trim(usuarioIngresado) != "" && $.trim(clave) != "" && $.trim(tipoSangre) != ""){
                    estado = "OK";
                }else{
                    if($.trim(numeroId) == ""){
                        estado += "<label class='errorDato'>Por favor Ingrese el número de documento</label><br>";
                    } 
                    if($.trim(primerApellido) == ""){
                        estado += "<label class='errorDato'>Por favor Ingrese el primer apellido</label><br>";
                    }
                    if($.trim(segundoApellido) == ""){
                        estado += "<label class='errorDato'>Por favor Ingrese el segundo apellido</label><br>";
                    }
                    if($.trim(primerNombre) == ""){
                        estado += "<label class='errorDato'>Por favor Ingrese el primer nombre</label><br>";
                    }
                    if($.trim(direccion) == ""){
                        estado += "<label class='errorDato'>Por favor Ingrese la dirección</label><br>";
                    }
                    if($.trim(telefono1) == ""){
                        estado += "<label class='errorDato'>Por favor Ingrese el Numero de telefono</label><br>";
                    }
                    if($.trim(usuarioIngresado) == ""){
                        estado += "<label class='errorDato'>Por favor Ingrese el nombre de usuario</label><br>";
                    }
                    if($.trim(clave) == ""){
                        estado += "<label class='errorDato'>Por favor Ingrese la constraseña</label><br>";
                    }
                    if($.trim(tipoSangre) == ""){
                        estado += "<label class='errorDato'>Por favor Ingrese el tipo de sangre</label><br>";
                    } 
                }
                return estado;
            }
        </script>	
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJhwAnBcf7HiAk8mhenonqyOyXrmwh3g&callback=initialize"
        async defer></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
</body>
</html>
