<?php
    /*
        Serie de arrays asociativos donde se agregan los atributos de los campos para el form. No es
        obligacion crear los controles con codigo php usando CodeIgniter ya que los controles del form se pueden agregar con codigo html
    */
    $nombres = array(
        'name' => 'txtNombres', 
        'id' => 'txtNombres', 
        'placeholder' => 'Nombres',
        'class' => 'form-control',
        'disabled' => 'disabled');
    $apellidos = array(
        'name' => 'txtApellidos', 
        'id' => 'txtApellidos', 
        'placeholder' => 'Apellidos',
        'class' => 'form-control',
        'disabled' => 'disabled');
    $rol = array(
        'name' => 'txtRol', 
        'id' => 'txtRol', 
        'placeholder' => 'Rol',
        'class' => 'form-control',
        'disabled' => 'disabled');
    $button = array(
        'name' => 'btnGuardar',
        'id' => 'btnGuardar',
        'value' => 'REGISTRAR',
        'class' => 'btn btn-primary',
        'type' => 'submit',
        'style' => 'float: right; display: none');
    
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
            <br/>
            <h2 align="right" style="margin-top:2.5%; margin-right:2%; color:#09C"><?= $titulo;?></h2>
            <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <?= $this->session->userdata('UserNameInternoSSCA');?></h4>  
            <input type="hidden" id="txtUserId" name="txtUserId" value="<?= $this->session->userdata('UserIDInternoSSCA');?>" /> 
            <form class="cmxform" id="commentForm" method="post" action="<?= base_url();?>index.php/services/crearServicio">
            <div class="row">
                <div class="col-md-8">
                    <?= form_label("Módulo:", "selectModulos");?>
                    <select class="form-control" id="selectModulos" name="selectModulos">
                        <option value="SELECCIONE">SELECCIONE...</option>
                        <?php
                            /*
                                Se valida que el result de la consulta de tecnicas tenga datos.
                                Este valor es enviado desde la funcion del controlador
                            */                                    
                            if($modulos){
                                //Se itera el result de los tecnicos. $tecnicos es enviado como un objeto, el cual para obtener los datos se obtiene un array asociativo, el cual se itera con un foreach y se muestra en el select
                                foreach ($modulos->result() as $value) {
                        ?>
                        <option value="<?= $value->id?>"><?= $value->nombre;?></option>
                        <?php

                                }
                            }
                        ?>                    
                    </select>
                </div>
            </div><br/>            
            
            <div class="row">
                <div class="col-md-8">
                    <?= form_label("SubMódulo:", "selectSubModulos");?>
                    <select class="form-control" id="selectSubModulos" name="selectSubModulos">
                                         
                    </select>
                </div>
            </div><br/>            

            <div class="row">
                <div class="col-md-8">
                    <?= form_label("Acción:", "selectServicios");?>
                    <select class="form-control" id="selectServicios" name="selectServicios">
                                         
                    </select>
                </div>
            </div><br/>       
            
            <div class="row">
                <div class="col-md-4">
                    <?= form_submit($button);?>
                    <?php
                        $attributesErrorSuper = array(
                            'id' => 'lblErrores',
                            'style' => 'display: none',
                            'class' => 'error'
                        );
                        echo form_label("", "btnGuardar", $attributesErrorSuper);
                    ?>
                </div>
            </div><br/>
            <?= form_close();?> <!---- Cerrar el form, equivalente al </form>. No es obligacion usar el codigo en php del helper de form. Incluso se puede abrir el form escribiendo el codigo en html y cerrarlo en php o viceversa -->

           
        </div>       
    </div>
    <div class="container">
        <div class="row" align="center" id="chats">           
            
        </div>
    </div>
    <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="../../js/chat.js"></script>
    <script src="<?= base_url();?>js/jquery.validate.js"></script>       
   <script type="text/javascript">
            
            
            $("#selectModulos").change(function(e) {
                if($(this).val() != "SELECCIONE"){
                    /*
                        Se conecta a la funcion del controlador para listar todos los submodulos.
                        La funcion base_url() obtiene la url base del proyecto, la cual es configurada en el archivo config.php
                    */
                    $.post("<?= base_url();?>index.php/services/listarSubModulo", {idModulo: $(this).val()})
                    .done(function( data ) {
                        /*
                            La variable data es decir la respuesta de la conexion a la funcion del controlador (que se trata como webservice) se convierte a un objeto JSON, porque la respuesta cuando se obtiene es en una cadena.
                        */
                        var json = JSON.parse(data);
                        
                        //Se borran todos los datos de la lista desplegable de los submodulos antes de llenarla
                        $("#selectSubModulos").empty();
                        $("#selectSubModulos").append('<option value="SELECCIONE">SELECCIONE...</option>');
                        //Se itera el json de supervisores
                        for(i = 0; i < json.length; i++){
                            //Se agregan las opciones a la lista desplegable de los submodulos con sus datos
                            $("#selectSubModulos").append('<option value="' + json[i].id + '">' + json[i].nombre + '</option>');
                        }
                        $("#selectServicios").empty();
                        $("#selectServicios").append('<option value="SELECCIONE">SELECCIONE...</option>');
                        $("#btnGuardar").css({"display":"none"});
                    });
                }else{
                    $("#selectSubModulos").empty();
                    $("#selectSubModulos").append('<option value="SELECCIONE">SELECCIONE...</option>');
                    $("#selectServicios").empty();
                    $("#selectServicios").append('<option value="SELECCIONE">SELECCIONE...</option>');
                    $("#btnGuardar").css({"display":"none"});
                }
            });

            $("#selectSubModulos").change(function(e) {
                if($(this).val() != "SELECCIONE"){
                    /*
                        Se conecta a la funcion del controlador para listar todos los servicios.
                        La funcion base_url() obtiene la url base del proyecto, la cual es configurada en el archivo config.php
                    */
                    $.post("<?= base_url();?>index.php/services/listarServicios", {idSubModulo: $(this).val()})
                    .done(function( data ) {
                        /*
                            La variable data es decir la respuesta de la conexion a la funcion del controlador (que se trata como webservice) se convierte a un objeto JSON, porque la respuesta cuando se obtiene es en una cadena.
                        */
                        var json = JSON.parse(data);
                        
                        //Se borran todos los datos de la lista desplegable de los servicios antes de llenarla
                        $("#selectServicios").empty();
                        $("#selectServicios").append('<option value="SELECCIONE">SELECCIONE...</option>');
                        //Se itera el json de supervisores
                        for(i = 0; i < json.length; i++){
                            //Se agregan las opciones a la lista desplegable de los servicios con sus datos
                            $("#selectServicios").append('<option value="' + json[i].id + '">' + json[i].nombre + '</option>');
                        }
                        $("#btnGuardar").css({"display":"none"});
                    });
                }else{
                    $("#selectServicios").empty();
                    $("#selectServicios").append('<option value="SELECCIONE">SELECCIONE...</option>');
                    $("#btnGuardar").css({"display":"none"});
                }
            });
            $("#selectServicios").change(function(e) {
                if($(this).val() != "SELECCIONE"){
                    $("#btnGuardar").css({"display":"block"});
                }else{
                    $("#btnGuardar").css({"display":"none"});
                }
            });

            $("#OpcionSalir").click(function(e){
                var confirmar = window.confirm("¿Desea cerrar sesión?");
                if(confirmar){
                    $.post("<?= base_url();?>index.php/usuario/cerrarSesion", {})
                    .done(function( data ) {
                        window.location.href = "<?= base_url();?>";
                    });
                }                    
            });
            $(document).ready(function(e){
                
            })
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
