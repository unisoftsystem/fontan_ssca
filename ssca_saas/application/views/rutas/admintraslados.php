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
    .label_form{
        margin-top: 7px;
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
    

    .table > caption + thead > tr:first-child > th, .table > colgroup + thead > tr:first-child > th, .table > thead:first-child > tr:first-child > th, .table > caption + thead > tr:first-child > td, .table > colgroup + thead > tr:first-child > td, .table > thead:first-child > tr:first-child > td {
        border-top: 0;
        background-color: #01A9DB;
        color: #FFFFFF;
    }
    .table-bordered {
        border: 1px solid #ddd;
    }
    .table > thead > tr > th,
    .table > tbody > tr > th,
    .table > tfoot > tr > th,
    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
        text-align: center;
    }
    .table > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
        text-align: center;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > tbody > tr > th,
    .table-bordered > tfoot > tr > th,
    .table-bordered > thead > tr > td,
    .table-bordered > tbody > tr > td,
    .table-bordered > tfoot > tr > td {
        border: 1px solid #ddd;
        text-align: center;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > thead > tr > td {
        border-bottom-width: 2px;
        text-align: center;
    }
    .table-hover > tbody > tr:hover > td,
    .table-hover > tbody > tr:hover > th {
        background-color: #f5f5f5;
        text-align: center;
    }
    .table-hover > tbody > tr > td.active:hover,
    .table-hover > tbody > tr > th.active:hover,
    .table-hover > tbody > tr.active:hover > td,
    .table-hover > tbody > tr.active:hover > th {
        background-color: #e8e8e8;
        text-align: center;
    }
    .table-hover > tbody > tr > td.success:hover,
    .table-hover > tbody > tr > th.success:hover,
    .table-hover > tbody > tr.success:hover > td,
    .table-hover > tbody > tr.success:hover > th {
        background-color: #d0e9c6;
        text-align: center;
    }
    .table > thead > tr > td.active,
    .table > tbody > tr > td.active,
    .table > tfoot > tr > td.active,
    .table > thead > tr > th.active,
    .table > tbody > tr > th.active,
    .table > tfoot > tr > th.active,
    .table > thead > tr.active > td,
    .table > tbody > tr.active > td,
    .table > tfoot > tr.active > td,
    .table > thead > tr.active > th,
    .table > tbody > tr.active > th,
    .table > tfoot > tr.active > th {
        background-color: #f5f5f5;
        text-align: center;
    }
    legend{
        color: #333;
        border-bottom: none;
        margin-bottom: 0px;
        padding-left: 10px;
    }
    fieldset{
        padding: 10px; 
        border: 1px solid #09C; 
        border-radius: 4px;
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
            //updatePosition(latLng);
              
              
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
               alertify.alert("No podemos encontrar la dirección", function(){})
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
                    <div class="col-md-12">
                        <br/>  
                        <hr style="margin-top: 0px; margin-bottom: 7px">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="label_form" for="txtNumeroId"><font color="#09C" size="2">No. de identificación</font></label>
                            </div>
                            <div class="col-md-5">
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
                        </div>
                        <hr style="margin-top: 7px; margin-bottom: 7px;">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="txt_apellidos" class="label_form"><font color="#09C" size="2">Apellidos</font></label>
                                <input id="txt_apellidos" name="txt_apellidos" type="text" class="form-control" disabled="disabled" />
                            </div>
                            <div class="col-md-6">
                                <label for="txt_nombres" class="label_form"><font color="#09C" size="2">Nombres</font></label>
                                <input id="txt_nombres" name="txt_nombres" type="text" class="form-control" disabled="disabled"/>
                            </div>
                        </div>
                        
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="txt_fecha_observacion" class="label_form"><font color="#09C" size="2">Fecha Observación</font></label>
                        <input id="txt_fecha_observacion" name="txt_fecha_observacion" type="date" class="form-control"/>
                    </div>
                    <div class="col-md-3">
                        <label for="select_tipo_actividad" class="label_form"><font color="#09C" size="2">Tipo Actividad</font></label>
                        <select id="select_tipo_actividad" name="select_tipo_actividad" class="form-control">
                            <option value="Ascenso">Ascenso</option>
                            <option value="Descenso">Descenso</option>  
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="select_ruta" class="label_form"><font color="#09C" size="2">Ruta</font></label>
                        <select id="select_ruta" name="select_ruta" class="form-control">
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
                    <div class="col-md-3">
                        <label for="txt_observaciones" class="label_form"><font color="#09C" size="2">Observaciones</font></label>
                        <input id="txt_observaciones" name="txt_observaciones" type="text" class="form-control"/>
                    </div>
                    <div class="col-md-8"><br/>
                        <fieldset>
                            <legend></legend>
                            <div class="col-md-7">
                                <label for="direccion" class="label_form"><font color="#09C" size="2">Dirección</font></label>
                                <input id="direccion" name="direccion" type="text" class="form-control"/>
                            </div>

                            <div class="col-md-4" align="right">
                                <label for="" class="label_form">&nbsp;</label><br>
                                <button  id="pasar" type="button" class="btn btn-primary">Obtener coordenadas</button>
                            </div>


                            <div class="col-md-12"><br/>                        
                                <div id="map_canvas" style="width:100%;height:200px;"></div>
                                <!--campos ocultos donde guardamos los datos-->
                                <input type="hidden" name="lat" id="lat"/>
                                <input type="hidden" name="lng" id="long"/>

                            </div>
                        
                        </fieldset>
                    </div>
                    
                    
                    <div class="col-md-4" align="right"><br/>
                        <button id="btn_adicionar_fila" type="button" class="btn btn-primary" style="width: 100%">ADICIONAR</button>
                    </div>

                    <div class="col-md-12"><br/>
                        <table id="target" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                  <th align="center">Nombre Estudiante</th>
                                  <th align="center">Dir. de Ascenso</th>
                                  <th align="center">Dir. de Descenso</th>
                                  <th align="center">Observaciones</th>
                                  <th align="center">Ruta</th>
                                  <th align="center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                

                

                <div class="row">
                    <div class="col-md-12" align="right">
                        <button type="submit" class="btn btn-primary" name="btnCrearUsuario" id="btnCrearUsuario" disabled="disabled">REGISTRAR</button>
                        <?php
                            $attributesError = array(
                                'id' => 'lblError',
                                'style' => 'display: none;',
                                'class' => 'errorDato'
                            );
                            echo form_label("", "btnCrearUsuario", $attributesError);
                        ?>  <br/><br/><br/>      
                    </div>
                </div>
            </form> 
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
                    
                    var json = JSON.parse(data);

                    if(json.length > 0){
                        $.each(json, function(i, item) {
                            $("#txtTipoId").val(json[i].TipoId);
                            $("#txt_apellidos").val(json[i].PrimerApellido + " " + json[i].SegundoApellido);
                            $("#txt_nombres").val(json[i].PrimerNombre + " " + json[i].SegundoNombre);

                            if($.trim(json[i].ImagenFotografica).length > 0){
                                $("#imageFoto").attr("src", "<?= base_url(1);?>" + json[i].ImagenFotografica);      
                            }else{
                                $("#imageFoto").attr("src", "<?= base_url(1);?>" + "images/person.png");
                            }                               
                            
                        });
                    }else{
                        $("#txt_apellidos").val("");
                        $("#txt_nombres").val("");
                        $("#txtTipoId").val("Cedula de ciudadania");
                    }
                
                }else{                    
                    $("#txt_apellidos").val("");
                    $("#txt_nombres").val("");
                    $("#txtTipoId").val("Cedula de ciudadania");
                }
            });
            
            
        });   

        $("#btn_adicionar_fila").click(function(e){
            var fecha_observacion = $("#txt_fecha_observacion").val();
            var tipo_actividad = $("#select_tipo_actividad").val();
            var ruta = $("#select_ruta").val();
            var observaciones = $("#txt_observaciones").val();
            var direccion = $("#direccion").val();
            var latitud = $("#lat").val()
            var longitud = $("#long").val()
            if(fecha_observacion != "" && tipo_actividad != "" && observaciones != "" && direccion != "" && latitud != "" && longitud != "" && ruta != ""){
                addToCartTable()
            }else{
                var messages = "¡Debe ingresar ";
                if($.trim(fecha_observacion) == ""){
                    if(messages == "¡Debe ingresar "){
                        messages += "una fecha de observación"
                    }else{
                        messages += ", una fecha de observación"
                    }
                    
                }
                if($.trim(observaciones) == ""){
                    if(messages == "¡Debe ingresar "){
                        messages += "una observación"
                    }else{
                        messages += ", una observación"
                    }
                    
                }
                if($.trim(direccion) == ""){
                    if(messages == "¡Debe ingresar "){
                        messages += "una dirección"
                    }else{
                        messages += ", una dirección"
                    }
                    
                }
                if($.trim(ruta) == ""){
                    if(messages == "¡Debe ingresar "){
                        messages += "debe tener al menos registrada una ruta"
                    }else{
                        messages += ", debe tener al menos registrada una ruta"
                    }
                    
                }
                if($.trim(latitud) == "" && $.trim(longitud) == ""){
                    if(messages == "¡Debe ingresar "){
                        messages = "¡Debe obtener las coordenadas de la dirección ingresada!";
                    }else{
                        messages += "!<br>¡Debe obtener las coordenadas de la dirección ingresada!";
                    }
                    
                }else{
                    messages += "!"
                }
                
                alertify.alert(messages, function(){})
            }
            
        })      
        function addToCartTable() {
            var fecha_observacion = $("#txt_fecha_observacion").val();
            var tipo_actividad = $("#select_tipo_actividad").val();
            var observaciones = $("#txt_observaciones").val();
            var ruta = $('#select_ruta option:selected').text();
            var direccion = $("#direccion").val();
            console.log(tipo_actividad)
            var newRow = document.createElement('tr');
            newRow.appendChild(createCell(fecha_observacion));
            if(tipo_actividad == "Ascenso"){            
                newRow.appendChild(createCell(direccion));
                newRow.appendChild(createCell(""));
            }else{             
                newRow.appendChild(createCell(""));
                newRow.appendChild(createCell(direccion));        
            }
            newRow.appendChild(createCell(observaciones));
            newRow.appendChild(createCell(ruta));
            var cellRemoveBtn = createCell();
            cellRemoveBtn.appendChild(createRemoveBtn())
            newRow.appendChild(cellRemoveBtn);

            document.querySelector('#target tbody').appendChild(newRow);

            mostrar_boton();

            $("#txt_fecha_observacion").val("");
            $("#select_tipo_actividad").val($("#select_tipo_actividad option:first").val());
            $("#select_ruta").val($("#select_ruta option:first").val());
            $("#txt_observaciones").val("");
            $("#direccion").val("");
            $("#lat").val("")
            $("#long").val("")
            initialize()
        }


        function createRemoveBtn() {
            var btnRemove = document.createElement('button');
            btnRemove.onclick = remove;
            btnRemove.innerText = 'X';              
            btnRemove.setAttribute("coordenadas", $("#lat").val() + "," + $("#long").val()); 
            btnRemove.setAttribute("id_ruta", $("#select_ruta").val());  
            btnRemove.setAttribute("tipo_actividad", $("#select_tipo_actividad").val());  
            btnRemove.setAttribute("class", "btn btn-danger");    
            return btnRemove;
        }

        function createCell(text) {
          var td = document.createElement('td');
          if(text) {
            td.innerText = text;
          }
          return td;
        }

        function createCell1(text) {
          var index_id = 0;
          if($("#target > tbody > tr > td > input:last").length > 0){
            index_id = parseInt($("#target > tbody > tr > td > input:last")[0].attributes.index.value) + 1
          }
          var td = document.createElement('td');
          if(text) {
            var input = document.createElement('input');
            input.value = text;
            input.onkeyup = update_total;
            input.setAttribute("id", "txtValor" + index_id);     
            input.setAttribute("index", index_id); 
            input.setAttribute("class", "form-control");    
            input.setAttribute("style", "text-align: center");
            td.appendChild(input)    
          }
          return td;
        } 

        function remove() {
            var row = this.parentNode.parentNode;
            document.querySelector('#target tbody')
                    .removeChild(row);
        }  
           
        $.validator.setDefaults({
            submitHandler: function() {
                var contador = 0;
                $("#target > tbody > tr").each(function(index){
                    var numeroId = $("#txtNumeroId").val();
                    var obj_celdas = $(this)[0].children
                    var fecha = obj_celdas[0].outerText
                    var direccion_ascenso = obj_celdas[1].outerText
                    var direccion_descenso = obj_celdas[2].outerText
                    var direccion = "";

                    if(direccion_ascenso != ""){
                        direccion = direccion_ascenso
                    }else{
                        direccion = direccion_descenso
                    }
                    
                    var observaciones = obj_celdas[3].outerText
                    var fecha = obj_celdas[0].outerText
                    var coordenadas = obj_celdas[5].children[0].attributes.coordenadas.value
                    var id_ruta = obj_celdas[5].children[0].attributes.id_ruta.value
                    var tipo_actividad = obj_celdas[5].children[0].attributes.tipo_actividad.value

                    var datos = {
                        fecha: fecha,
                        numero_id: numeroId,
                        tipo: tipo_actividad,
                        id_ruta: id_ruta,
                        observacion: observaciones,
                        direccion: direccion,
                        coordenadas: coordenadas
                    }
                    $.post("<?= base_url();?>index.php/rutas/registrar_observacion", datos)
                    .done(function( result ) {
                        if(contador == ($("#target > tbody > tr").length) - 1){
                            alertify.alert("¡Se ingreso con exito las observaciones!", function(){
                                location.reload();
                            })
                        }    
                        contador++;                 
                    });
                })             
                
                
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
                txtNumeroId: "required"
              },
              messages: {
                txtNumeroId: "Por favor ingrese un numero de identificacion"
              }
            });

            if($("#select_ruta > option").length == 0){
                alertify.alert("¡El listado de rutas esta vacio, debe tener al menos registrada una ruta!", function(){})
            }
              
        })();           
            
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

        
        function mostrar_boton(){
            if($("#target > tbody > tr").length > 0){
                $("#lblError").css({"display":"none"});
                $("#btnCrearUsuario").removeAttr("disabled")
            }else{
                $("#btnCrearUsuario").attr("disabled", "disabled")
                $("#lblError").css({"display":"block"});
            }
        }

            
    </script>   
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIJhwAnBcf7HiAk8mhenonqyOyXrmwh3g&callback=initialize"
    async defer></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
</body>
</html>
