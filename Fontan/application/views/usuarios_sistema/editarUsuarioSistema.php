<?php
    $UserName = $this->session->userdata('UserNameInternoSSCA');
    if(empty($UserName)) { // Recuerda usar corchetes.
        header('Location: ' . base_url());
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
                        <form id="commentForm" method="post" action="" style="height:100%">
                        <div class="row">
                                <div class="col-md-9">
                                        
                                        <br/>            
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
                                                <label for="txtNumeroId"><font color="#09C" size="2">No. de identificaci&oacute;n</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtNumeroId" name="txtNumeroId" type="text" class="form-control"/>
                                                <?php
                                                    $attributesErrorDoc = array(
                                                        'id' => 'lblErrorDocUsuario',
                                                        'style' => 'display: none;',
                                                        'class' => 'error'
                                                    );
                                                    echo form_label("", "txtNumeroDocumento", $attributesErrorDoc);
                                                ?>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-3" align="right">
                                                <label for="txtPrimerApellido"><font color="#09C" size="2">Primer Apellido</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtPrimerApellido" name="txtPrimerApellido" type="text" class="form-control" disabled/>
                                            </div>
                                            <div class="col-md-3" align="right">
                                                <label for="txtSegundoApellido"><font color="#09C" size="2">Segundo Apellido</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtSegundoApellido" name="txtSegundoApellido" type="text" class="form-control" disabled/>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-3" align="right">
                                               <label for="txtPrimerNombre"><font color="#09C" size="2">Primer Nombre</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtPrimerNombre" name="txtPrimerNombre" type="text" class="form-control" disabled/>
                                            </div>
                                            <div class="col-md-3" align="right">
                                                <label for="txtSegundoNombre"><font color="#09C" size="2">Segundo Nombre</font></label>
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
                                               <label for="txtUsuario"><font color="#09C" size="2">E-Mail</font></label>
                                            </div>
                                            <div class="col-md-3">
                                               <input id="txtUsuario" name="txtUsuario" type="text" class="form-control" disabled/>
                                               <input type="hidden" name="txtUsuarioHidden" id="txtUsuarioHidden">
                                               <?php
                                                    $attributesError = array(
                                                        'id' => 'lblErrorUsuario',
                                                        'style' => 'display: none;',
                                                        'class' => 'error'
                                                    );
                                                    echo form_label("", "txtUsuario", $attributesError);
                                                ?>
                                            </div>
                                            <div class="col-md-3" align="right">
                                               <label for="txtPass"><font color="#09C" size="2">Contraseña</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtPass" name="txtPass" type="password" class="form-control" disabled/>
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
                                        <div class="row"><br/>
                                            <div class="col-md-3" align="right">
                                               <label for="Asignacion de Servicios"><font color="#09C" size="2">Asignacion de Servicios</font></label>
                                            </div>
                                            <div class="col-md-9">
                                                <div id="tree-container"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12" align="right"><br/>
                                                <button type="submit" class="btn btn-primary" name="btnGuardar" id="btnGuardar" style="display:none">Guardar</button>
                                            </div>
                                        </div>
                                </div> 
                                        
                                
                                <div class="col-md-3" align="center" >
                                        <br>
                                        <video id="v" width="100%" height="100%"></video><br>
                                        <canvas id="c" width="100%" height="100%" style="display:none"></canvas><br>
                                        <img id="imageFoto" name="imageFoto" width="100%" src="<?= base_url();?>images/person.png" /><br/><br/>
                                        <input type="hidden" name="UrlImagenOculta" id="UrlImagenOculta">
                                        <button id="t" type="button" class="btn btn-primary">Tomar foto</button>
                                </div>
                         </div>
                        </form> 
                </div> 
                <br/>
        <div class="container">
            <div class="row" align="center" id="chats">           
                
            </div>
        </div>
        <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="../../js/chat.js"></script>
        <script src="<?= base_url();?>js/jquery.validate.js"></script>       
        <script>
            var arrayServicios = new Array();
            var arrayGuardar = new Array();
            var urlFoto = "";
            var video = document.querySelector('#v'), canvas = document.querySelector('#c'), btn = document.querySelector('#t'), img = document.querySelector('#imageFoto');
        	
            $('#tree-container').on("changed.jstree", function (e, data) {
                arrayServicios = data.selected             
            });
            $.validator.setDefaults({
                submitHandler: function() {
                    //Se obtienen los datos a ingresar
                    var tipoId = $("#txtTipoId").val();
                    var numeroId = $("#txtNumeroId").val();
                    var primerApellido = $("#txtPrimerApellido").val();
                    var segundoApellido = $("#txtSegundoApellido").val();
                    var primerNombre = $("#txtPrimerNombre").val();
                    var segundoNombre = $("#txtSegundoNombre").val();
                    var direccion = $("#direccion").val();
                    var telefono1 = $("#txtTelefono1").val();
                    var telefono2 = $("#txtTelefono2").val();
                    var usuarioIngresado = $("#txtUsuario").val();
                    var usuarioOculto = $("#txtUsuarioHidden").val();
                    var clave = $("#txtPass").val();
                    var permisos = Obtener_Permisos();
                    var dataURL;
                    var fotoCon;
                    if(urlFoto != ""){
                        dataURL = canvas.toDataURL("image/png");
                        fotoCon = "";
                    }else{
                        dataURL = "";
                        fotoCon = $("#UrlImagenOculta").val();
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
                        tipoId: tipoId,
                        numeroId: numeroId,
                        primerApellido: primerApellido,
                        segundoApellido: segundoApellido,
                        primerNombre: primerNombre,
                        segundoNombre: segundoNombre,
                        direccion: direccion,
                        telefono1: telefono1,
                        telefono2: telefono2,
                        usuario: usuarioIngresado,
                        clave: clave,
                        imgBase64: dataURL,
                        permisos: permisos,
                        fecha: fechaActual,
                        hora: horaActual,
                        fotoCon: fotoCon,
                        usuarioOculto: usuarioOculto
                    }  
                    
                    if(permisos != ""){
                        $("#btnGuardar").attr("disabled", "disabled")
                        $.post("<?= base_url();?>index.php/usuarios_sistema/editarUsuario", datos)
                        .done(function( data ) {console.log(data)
                            alert("¡Usuario modificado con exito!")
                            window.location.href = "<?= base_url();?>index.php/usuarios_sistema/ModificarUsuarioSistema";
                        });
                    }else{
                        alert("¡Debe asignar por lo menos un servicio!");
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
                    direccion: "required"
                  },
                  messages: {
                    txtNumeroId: "Por favor ingrese un numero de identificacion",
                    txtPrimerApellido: "Por favor ingrese el primer apellido",
                    txtSegundoApellido: "Por favor ingrese el segundo apellido",
                    txtPrimerNombre: "Por favor ingrese el primer nombre",
                    txtTelefono1: "Por favor ingrese un numero de telefono",
                    txtUsuario: "Por favor ingrese un correo electronico válido",
                    txtPass: "Por favor ingrese una clave",
                    direccion: "Por favor ingrese una direccion"
                  }
                });
                  
            })();

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
                        La funcion base_url() obtiene la url base del proyecto, la cual es configurada en el archivo config.php
                    */
                    $.post("<?= base_url();?>index.php/usuarios_sistema/ExisteUsuario", datos)
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

            /*
                Evento para saber si el nombre de usuario o idusuario existe o no en la bd.
                Si este existe se muestra un error y se oculta el boton de registrar, sino se quitar el mensaje de error y se muestra el boton de registrar.
            */
            $("#txtNumeroId").keyup(function(e) {
                //Se obtiene lo que ha escrito el usuario
                var numeroId = $("#txtNumeroId").val();
                    
                //Se guardan los datos en un JSON
                var datos = {
                    documento: numeroId            
                }       
                /*
                    Se conecta a la funcion del controlador para verificar la existencia del dato enviado.
                    La funcion base_url() obtiene la url base del proyecto, la cual es configurada en el archivo config.php
                */
                $.post("<?= base_url();?>index.php/usuarios_sistema/ObtenerUsuarioDocumento", datos)
                .done(function( data ) {
                    
                    if($.trim(data) != "[]"){                       
                        var json = JSON.parse(data); 
                        $("#btnGuardar").css({"display":"block"})
                        for (var i = 0; i < json.length; i++) {
                            $("#txtPrimerNombre").val(json[i].PrimerNombre)
                            $("#txtSegundoNombre").val(json[i].SegundoNombre)
                            $("#txtPrimerApellido").val(json[i].PrimerApellido)
                            $("#txtSegundoApellido").val(json[i].SegundoApellido)
                            $("#txtTelefono1").val(json[i].Telefono1)
                            $("#txtTelefono2").val(json[i].Telefono2)
                            $("#txtUsuario").val(json[i].idUsuario)
                            $("#txtPass").val(json[i].Clave)
                            $("#direccion").val(json[i].Direccion)
                            $("#txtTipoId").val(json[i].TipoId)
                            
                            $("#txtUsuarioHidden").val(json[i].idUsuario)

                            if(json[i].ImagenFotografica != ""){
                                $("#imageFoto").attr("src", "<?= base_url();?>" + json[i].ImagenFotografica)
                                $("#UrlImagenOculta").val(json[i].ImagenFotografica)
                            }else{
                                $("#imageFoto").attr("src", "<?= base_url();?>images/person.png")
                            }
                            
                            if(json[i].permisos != "[]"){
                                $('#tree-container').jstree(true).close_all();
                                $('#tree-container').jstree(true).deselect_all();
                                var jsonPermisos = JSON.parse(json[i].permisos);
                                
                                for(j = 0; j < jsonPermisos.length; j++){
                                    $('#tree-container').jstree(true).select_node(jsonPermisos[j].service_id);
                                }
                                
                                
                            }else{
                                $('#tree-container').jstree(true).close_all();
                                $('#tree-container').jstree(true).deselect_all();
                            }

                            $("#txtPrimerNombre").removeAttr("disabled");
                            $("#txtSegundoNombre").removeAttr("disabled");
                            $("#txtPrimerApellido").removeAttr("disabled");
                            $("#txtSegundoApellido").removeAttr("disabled");
                            $("#txtTelefono1").removeAttr("disabled");
                            $("#txtTelefono2").removeAttr("disabled");
                            $("#txtUsuario").removeAttr("disabled");
                            $("#txtPass").removeAttr("disabled");
                            $("#direccion").removeAttr("disabled");
                            
                        }
                        
                    }else{
                        $("#txtPrimerNombre").val("")
                        $("#txtSegundoNombre").val("")
                        $("#txtPrimerApellido").val("")
                        $("#txtSegundoApellido").val("")
                        $("#txtTelefono1").val("")
                        $("#txtTelefono2").val("")
                        $("#txtUsuario").val("")
                        $("#txtPass").val("")
                        $("#direccion").val("")
                        $("#imageFoto").attr("src", "<?= base_url();?>images/person.png")

                        $('#tree-container').jstree(true).close_all();
                        $('#tree-container').jstree(true).deselect_all();
                        $("#btnGuardar").css({"display":"none"})

                        $("#txtPrimerNombre").attr("disabled", "disabled");
                        $("#txtSegundoNombre").attr("disabled", "disabled");
                        $("#txtPrimerApellido").attr("disabled", "disabled");
                        $("#txtSegundoApellido").attr("disabled", "disabled");
                        $("#txtTelefono1").attr("disabled", "disabled");
                        $("#txtTelefono2").attr("disabled", "disabled");
                        $("#txtUsuario").attr("disabled", "disabled");
                        $("#txtPass").attr("disabled", "disabled");
                        $("#direccion").attr("disabled", "disabled");
                        
                    }
                });
                
                
            });            

            function Obtener_Permisos(){
                var permisos = "";
                
                for (var i = 0; i < arrayServicios.length; i++) {
                    if($("#" + arrayServicios[i]).attr("aria-level") == "1"){
                        
                    }else{
                        arrayGuardar[arrayGuardar.length] = arrayServicios[i]
                    }
                } 
                for (var i = 0; i < arrayGuardar.length; i++) {
                    if(i != (arrayGuardar.length - 1)){                   
                        permisos += arrayGuardar[i] + ",";                        
                    }else{
                        permisos += arrayGuardar[i];                        
                    }
                }  
                return permisos;
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

            window.addEventListener('load',init);

            function init(){
                navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
            
                if(navigator.getUserMedia){
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
                });
                
                }else{
                    alert("Por favor usa el explorador opera o google chrome para el funcionamiento optimo del modulo. Gracias.");        
                }
            }
        </script>		
           
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){ 
    //fill data to tree  with AJAX call
    $('#tree-container').jstree({
        'plugins': ["wholerow", "checkbox"],
        'core' : {
            'data' : {
                "url" : "<?= base_url();?>index.php/services/arbolServicios",
                "dataType" : "json" // needed only if you do not supply JSON headers
            }
        }
    }) 
});
</script>