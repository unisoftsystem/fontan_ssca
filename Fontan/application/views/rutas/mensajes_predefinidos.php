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
  .ezInputEditor{
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
        </br>
            
        <div class="container-fluid" style="padding: 0">
            <h2 align="right" style="margin-top:2.5%; margin-right:2%; color:#09C"><?= $titulo;?></h2>
            <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <?= $this->session->userdata('UserNameInternoSSCA');?></h4>  
            <input type="hidden" id="txtUserId" name="txtUserId" value="<?= $this->session->userdata('UserIDInternoSSCA');?>" /> 
            
            <form class="cmxform" id="commentForm" method="get" action="">
                
                <br>
                <div class="row" style="width:99%; margin-left:1%"">
                    <div class="col-md-11">
                        <label for="radio1">Seleccionar Mensaje a Editar</label>
                        <select id="select_mensaje" name="select_mensaje" class="form-control">
                            <option value="Seleccione">SELECCIONE...</option>
                            <?php
                                if($mensajes){
                                    foreach ($mensajes->result() as $value) {
                            ?>
                            <option value="<?= $value->id;?>"><?= $value->mensaje;?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-11"><br>
                        <textarea id="textarea_mensaje" name="textarea_mensaje" style="width:100%" placeholder="Mensaje" class="form-control"></textarea>
                    </div>
                </div>
                <br>
                <div class="row" align="right"" style="width:99%">
                    <div class="col-md-12">
                        <button class="btn btn-primary" type="submit" id="btn_enviar_mensaje">Enviar Mensaje</button>
                    </div>
                </div>
            </form>
        </div>
        

    </div> 
        <div class="container">
            <div class="row" align="center" id="chats">           
                
            </div>
        </div>
        <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="../../js/chat.js"></script>
      <script src="<?= base_url();?>js/jquery.validate.js"></script>
      <script src="<?= base_url();?>dist/tablefilter/tablefilter.js"></script>
      <script type="text/javascript">
        //Capturar evento del boton crear
        $.validator.setDefaults({
            //Capturar evento del boton crear
            submitHandler: function() {
                if($("#btn_enviar_mensaje").html() == "Enviar Mensaje"){
                    var mensaje = $("#textarea_mensaje").val();
                    var datos = {
                        mensaje: mensaje
                    }   
                    $.post("../rutas/crear_mensaje_predefinido", datos)
                    .done(function( data ) {
                        console.log($.trim(data));
                        alertify.alert("¡Se registró con exito el mensaje!", function(){
                            location.reload();
                        });           
                        
                    });
                }else{
                    var mensaje = $("#textarea_mensaje").val();
                    var id_mensaje = $("#select_mensaje").val();
                    var datos = {
                        mensaje: mensaje,
                        id: id_mensaje
                    }   
                    $.post("../rutas/update_mensaje_predefinido", datos)
                    .done(function( data ) {
                        console.log($.trim(data));
                        alertify.alert("¡Se modificó con exito el mensaje!", function(){
                            location.reload();
                        });           
                        
                    });
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
                    textarea_mensaje: "required"
                },
                messages: {
                    textarea_mensaje: "Por favor ingrese un mensaje"
                }
            });
        
        })();
        $("#select_mensaje").change(function(e){
            if($(this).val() != "Seleccione"){
                $("#btn_enviar_mensaje").html("Editar Mensaje")
                $("#btn_enviar_mensaje").removeClass("btn-success").addClass("btn-warning")
                var id_mensaje = $("#select_mensaje").val();
                var datos = {
                    id: id_mensaje
                }   
                $.post("../rutas/ObtenerMensajePredefinido", datos)
                .done(function( data ) {
                    console.log($.trim(data));
                    if($.trim(data) != "{}"){
                        var json = JSON.parse(data)
                        $("#textarea_mensaje").val(json.mensaje);
                    }        
                    
                });
            }else{
                $("#btn_enviar_mensaje").removeClass("btn-warning").addClass("btn-success")
                $("#btn_enviar_mensaje").html("Enviar Mensaje")
                $("#textarea_mensaje").val("");
            }
        })
       
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
       
      </script> 
    </body>
</html>