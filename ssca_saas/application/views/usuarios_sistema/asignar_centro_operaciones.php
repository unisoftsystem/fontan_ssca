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

                                                        echo form_dropdown('txtTipoId', $options, 'Cedula de ciudadania', 'id="txtTipoId" disabled="disabled" class="form-control"');

                                                ?>
                                            </div>
                                            <div class="col-md-3" align="right">
                                                <label for="txtNumeroId"><font color="#09C" size="2">No. de identificaci&oacute;n</font></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtNumeroId" name="txtNumeroId" type="text" class="form-control" autofocus="" />
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
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-5" align="right">
                                               <label for="checkbox_co" style="margin-top: 10px"><font color="#09C" size="2">Asignacion de usuario para mensajeria</font></label>
                                            </div>
                                            <div class="col-md-1" style="padding: 0px">
                                               <input id="checkbox_co" name="checkbox_usuario" type="checkbox" class="form-control" />
                                            </div>
                                        </div>
                                        <br>
                                        
                                        <div class="row">
                                            <div class="col-md-12" align="right"><br/>
                                                <button type="submit" class="btn btn-primary" name="btnGuardar" id="btnGuardar" style="display:none">Guardar</button>
                                            </div>
                                        </div>
                                </div> 
                                        
                                
                                <div class="col-md-3" align="center" >
                                        <br>
                                        <img id="imageFoto" name="imageFoto" width="100%" src="<?= base_url(1);?>images/person.png" />
                                </div>
                         </div>
                        </form> 
                </div> 
                <br/>
    </div>  
    <div class="container" style="position: absolute;z-index: 1;">
        <div class="row" align="center" id="chats">           
            
        </div>
    </div>
    <?= $footer;?>
        <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="<?= base_url(1);?>js/chat.js"></script>
        <script src="<?= base_url(1);?>js/jquery.validate.js"></script>    
        <script src="<?= base_url(1);?>js/jquery-loader.js" type="text/javascript"></script>   
        <script>          
            $.validator.setDefaults({
                submitHandler: function() {
                    //Se obtienen los datos a ingresar
                    var numeroId = $("#txtNumeroId").val();                   
                    
                    //Se guardan los datos en un JSON
                    var datos = {
                        numeroId: numeroId,
                    } 
                   
                    $conf = {
                        autoCheck: false,
                        size: 32,  //指定菊花大小
                        bgColor: "#FFF",   //背景颜色
                        bgOpacity: 0.25,    //背景透明度
                        fontColor: "#000",  //文字颜色
                        title: "Registrando", //文字
                        isOnly: false
                    };
                    $.loader.open($conf);
                    $.post("<?= base_url();?>index.php/usuarios_sistema/asignar_usuario_co", datos)
                    .done(function( data ) {console.log(data)
                        var json = JSON.parse(data)
                        $.loader.close(true);
                        if(json.response == "OK"){
                            alertify.alert(json.message, function(){
                                location.reload();
                            })
                        }else{
                            alertify.alert(json.message, function(){
                                
                            })
                        }
                        
                    });
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
                    checkbox_usuario: "required"
                  },
                  messages: {
                    txtNumeroId: "Por favor ingrese un numero de identificacion",
                    checkbox_usuario: "Por favor seleccione la opcion de asignar un usuario como Centro de Operaciones"
                  }
                });
                  
            })();

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
                    La funcion base_url(1) obtiene la url base del proyecto, la cual es configurada en el archivo config.php
                */
                $.post("<?= base_url();?>index.php/usuarios_sistema/ObtenerUsuarioDocumento", datos)
                .done(function( data ) {
                    
                    if($.trim(data) != "[]"){                       
                        var json = JSON.parse(data); 
                        $("#btnGuardar").css({"display":"block"})
                        for (var i = 0; i < json.length; i++) {
                            $("#txtTipoId").val(json[i].TipoId)
                            $("#txtPrimerNombre").val(json[i].PrimerNombre)
                            $("#txtSegundoNombre").val(json[i].SegundoNombre)
                            $("#txtPrimerApellido").val(json[i].PrimerApellido)
                            $("#txtSegundoApellido").val(json[i].SegundoApellido)
                            $("#txtTelefono1").val(json[i].Telefono1)
                            $("#txtTelefono2").val(json[i].Telefono2)
                            $("#txtUsuario").val(json[i].idUsuario)

                            if(json[i].ImagenFotografica != ""){
                                $("#imageFoto").attr("src", "<?= base_url(1);?>" + json[i].ImagenFotografica)
                                $("#UrlImagenOculta").val(json[i].ImagenFotografica)
                            }else{
                                $("#imageFoto").attr("src", "<?= base_url(1);?>images/person.png")
                            }  
                            
                        }
                        
                    }else{
                        $("#txtPrimerNombre").val("")
                        $("#txtSegundoNombre").val("")
                        $("#txtPrimerApellido").val("")
                        $("#txtSegundoApellido").val("")
                        $("#txtTelefono1").val("")
                        $("#txtTelefono2").val("")
                        $("#txtUsuario").val("")
                        $("#imageFoto").attr("src", "<?= base_url(1);?>images/person.png")

                        $("#btnGuardar").css({"display":"none"})
                        
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
        </script>		
           
</body>
</html>