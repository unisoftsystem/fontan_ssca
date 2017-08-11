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

                                  echo form_dropdown('txtTipoId', $options, 'Cedula de ciudadania', 'id="txtTipoId" class="form-control" disabled');

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
                                        'class' => 'errorDato'
                                    );
                                    echo form_label("", "txtNumeroId", $attributesErrorDoc);
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
                               <label for="txtRh"><font color="#09C" size="2">RH</font></label>
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
                                    <option value="Monitor">Monitor</option>
                                    <option value="Conductor">Conductor</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-3" align="right">
                               <label for="txtARL"><font color="#09C" size="2">ARL</font></label>
                            </div>
                            <div class="col-md-3">
                               <input id="txtARL" name="txtARL" type="text" class="form-control" disabled/>  
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
                                <input id="txtCargo" name="txtCargo" type="text" class="form-control" disabled/>
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
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-3" align="right">
                               <label for="selectTipoFuncionario"><font color="#09C" size="2">Tipo de Funcionario</font></label>
                            </div>
                            <div class="col-md-3">
                               <input name="selectTipoFuncionario" id="selectTipoFuncionario" class="form-control" disabled />            
                            </div>
                            <div class="col-md-3" align="right">
                               
                            </div>
                            <div class="col-md-3">
                               
                            </div>
                        </div><br>
                                        
                        <div class="row" style="">
                            <div class="col-md-3" align="right">
                               <label for="selectTipoFuncionario" style="margin-top:5px"><font color="#09C" size="2">Motivo</font></label>
                            </div>
                            <div class="col-md-7">
                                <textarea class="form-control" id="txtMotivo" name="txtMotivo"></textarea>
                              
                            </div>
                        </div>                                       
                                        
                        <div class="row">
                            <div class="col-md-12" align="right">
                                <button type="submit" class="btn btn-primary" name="btnGuardar" id="btnGuardar" style="display:none">Borrar</button>
                                <?php
                                    $attributesError = array(
                                        'id' => 'lblError',
                                        'style' => 'display: none;',
                                        'class' => 'errorDato'
                                    );
                                    echo form_label("", "btnGuardar", $attributesError);
                                ?>     
                            </div>
                        </div>
                    </div> 
                                        
                                
                    <div class="col-md-3" align="center" >
                        <br>
                        <img id="imageFoto" name="imageFoto" width="100%" src="<?= base_url();?>images/person.png" />
                        <input type="hidden" name="UrlImagenOculta" id="UrlImagenOculta"><br/><br/>                                
                    </div>
                </div>
            </form> 
        </div> 
                      
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
            var video = document.querySelector('#v'), canvas = document.querySelector('#c'), btn = document.querySelector('#t'), img = document.querySelector('#imageFoto');
            var urlFoto = "";
        	window.addEventListener('load',init);
    		function init(){
    			
    		}
            
            $.validator.setDefaults({
                submitHandler: function() {
                    //Se obtienen los datos a enviar        
                    var usuarioIngresado = $("#txtUsuario").val();
                    var motivo = $("#txtMotivo").val();
                    var documento = $("#txtNumeroId").val();
                    var tipo_documento = $("#txtTipoId").val();
                    var nombres = $("#txtPrimerApellido").val() + " " + $("#txtSegundoApellido").val();
                    var apellidos = $("#txtPrimerNombre").val() + " " + $("#txtSegundoNombre").val();
                  
                    
                    //Se guardan los datos en un JSON
                    var datos = {
                        usuario: usuarioIngresado,
                        motivo: motivo,
                        documento: documento,
                        tipo_documento: tipo_documento,
                        nombres: nombres,
                        apellidos: apellidos
                    }       

                    $("#btnGuardar").attr("disabled", "disabled")
                    $.post("<?= base_url();?>index.php/usuarios_aplicaciones/action_borrar_funcionario", datos)
                    .done(function( result ) {console.log(result)
                        
                        alertify.alert('¡Funcionario borrado con éxito!', function(){
                            location.reload();
                        })
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
                    txtNumeroId: "required",
                    txtMotivo: "required"
                  },
                  messages: {
                    txtNumeroId: "Por favor ingrese un numero de identificacion",
                    txtMotivo: "Por favor ingrese un motivo"
                  }
                });                  
            })();
            function borrarTodo(){
                $("#btnCrearUsuario").css({"display":"none"})
                $("#rowCredencial").css({"display":"none"}) 
                $("#btnCrearUsuario").css({"display":"none"})
                $("#rowCredencial").css({"display":"none"}) 
                 $("#txtPrimerApellido").val("");
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
                $("#imageFoto").attr("src", "<?= base_url();?>" + "images/person.png");
            }

            
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
                $.post("<?= base_url();?>index.php/usuarios_aplicaciones/ConsultarUsuarioFuncionario", datos)
                .done(function( data ) {
                  console.log($.trim(data));
                 
                  if($.trim(data) != "[]"){                    
                    
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
                        $("#txtUsuarioHidden").val(json[i].idUsuario)
                        $("#selectTipoUsuario").val(json[i].TipoUsuario);
                        $("#direccion").val(json[i].Direccion);
                        $("#txtPass").val(json[i].Clave);
                        $("#txtRePass").val(json[i].Clave);                        
                        if($.trim(json[i].ImagenFotografica).length > 0){
                            $("#imageFoto").attr("src", "<?= base_url();?>" + json[i].ImagenFotografica);
                             $("#UrlImagenOculta").val(json[i].ImagenFotografica)
                            
                        }else{
                            $("#imageFoto").attr("src", "<?= base_url();?>" + "images/person.png");
                        }                        
                        $("#txtCredencialHidden").val(json[i].idCredencial)
                        $("#btnGuardar").css({"display":"block"})                        
                      });
                    }else{
                      $("#btnCrearUsuario").css({"display":"none"})
                        $("#divEstudiantes1").css({"display":"none"})
                        $("#divEstudiantes2").css({"display":"none"})
                        $("#divFuncionarios1").css({"display":"none"})
                        $("#divFuncionarios2").css({"display":"none"})
                        $("#rowCredencial").css({"display":"none"}) 
                        $("#btnCrearUsuario").css({"display":"none"})
                        $("#rowCredencial").css({"display":"none"}) 
                         $("#txtPrimerApellido").val("");
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
                        $("#imageFoto").attr("src", "<?= base_url();?>" + "images/person.png");
                    }
                  }else{
                    $("#btnCrearUsuario").css({"display":"none"})
                    $("#rowCredencial").css({"display":"none"}) 
                    $("#btnCrearUsuario").css({"display":"none"})
                    $("#rowCredencial").css({"display":"none"}) 
                     $("#txtPrimerApellido").val("");
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
                    $("#imageFoto").attr("src", "<?= base_url();?>" + "images/person.png");
                  }
                });
                
                
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

           
        </script>	
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
</body>
</html>
