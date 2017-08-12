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
        </br>
        <h2 align="right" style="margin-top:2.5%; margin-right:2%; color:#09C"><?= $titulo;?></h2>
        <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <?= $this->session->userdata('UserNameInternoSSCA');?></h4>  
        <input type="hidden" id="txtUserId" name="txtUserId" value="<?= $this->session->userdata('UserIDInternoSSCA');?>" /> 
         <div class="container-fluid">
          
          <form class="cmxform" method="POST" action="" id="commentForm">
           
                <div class="row">
                  <div class="col-md-2">  
                      <label for="marca"><font color="#09C" size="2">Marca: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="text" name="marca" id="marca" class="form-control"/>
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-2">  
                      <label for="categoria"><font color="#09C" size="2">Categoria: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="text" name="categoria" id="categoria" class="form-control"/>
                  </div>
                </div><br/>
                
                <div class="row">
                  <div class="col-md-2">  
                      <label for="placa"><font color="#09C" size="2">Placa: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="text" name="placa" id="placa" class="form-control"/>
                    <?php
                      $attributesError = array(
                          'id' => 'lblErrorPlaca',
                          'style' => 'display: none;',
                          'class' => 'errorDato'
                      );
                      echo form_label("", "placa", $attributesError);
                    ?>
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-2">  
                      <label for="nombreruta"><font color="#09C" size="2">Nombre Ruta: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="text" name="nombreruta" id="nombreruta" class="form-control"/>
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-2">  
                      <label for="sillas"><font color="#09C" size="2">Sillas: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="text" name="sillas" id="sillas" class="form-control" onKeyUp="format(this)"/>
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-2">  
                      <label for="observaciones"><font color="#09C" size="2">Observaciones: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
                  </div>
                </div><br/>
                
                <div class="row">
                  <div class="col-md-10" align="right">
                      <button type="submit" class="btn btn-primary" id="btnGuardar"><b>Guardar</b></button>                   
                  </div>
                </div><br/>
                  

              
                
          </form>
        
        </div>
        

      </div> 
      
    <div class="container" style="position: absolute;z-index: 1;">
        <div class="row" align="center" id="chats">           
            
        </div>
    </div>
    <?= $footer;?>
      <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="<?= base_url(1);?>js/chat.js"></script>
      <script src="<?= base_url(1);?>js/jquery.validate.js"></script>
      <script type="text/javascript">
        var urlFoto = "";
        function readImage() {
            //console.log(this.files);
            if ( this.files && this.files[0] ) {
                var FR = new FileReader();
                FR.onload = function(e) {
                     $('#imageFoto').attr( "src", e.target.result );
                     //$('#base').text( e.target.result );
                     //console.log(e.target.result);
                     urlFoto = e.target.result;
                     //$("#lblErrorFoto").css({"display":"none"})
                };       
                FR.readAsDataURL( this.files[0] );
            }
        }
        
        $("#fileFoto").change( readImage );
        $.validator.setDefaults({
          //Capturar evento del boton crear
          submitHandler: function() {
            var marca = $("#marca").val();
            var categoria = $("#categoria").val();
            var placa = $("#placa").val();
            var nombreruta = $("#nombreruta").val();
            var sillas = $("#sillas").val();
            var observaciones = $("#observaciones").val();
      
            //Se guardan los datos en un JSON
            var datos = {
              marca: marca,
              categoria: categoria,
              placa: placa,
              ruta: nombreruta,
              sillas: sillas,
              observaciones: observaciones,
              imgBase64: "",
              coordenadas: ""
            }   
            $("#btnGuardar").attr("disabled", "disabled")
            $.post("<?= base_url();?>index.php/vehiculos/insertar", datos)
            .done(function( data ) {console.log(data)
              alert("¡Se registro con exito el vehiculo!")
              window.location.href = "<?= base_url();?>index.php/vehiculos/nuevo";
            });
            
            
          }
        });

        /*
            Evento para saber si la placa existe o no en la bd.
            Si este existe se muestra un error y se oculta el boton de registrar, sino se quitar el mensaje de error y se muestra el boton de registrar.
        */
        $("#placa").keyup(function(e) {
            //Se obtiene lo que ha escrito el usuario
            var placa = $("#placa").val();
    
            //Se guardan los datos en un JSON
            var datos = {
                placa: placa          
            }       
            /*
                Se conecta a la funcion del controlador para verificar la existencia del dato enviado.
                La funcion base_url(1) obtiene la url base del proyecto, la cual es configurada en el archivo config.php
            */
            $.post("<?= base_url();?>index.php/vehiculos/ExisteVehiculoPlaca", datos)
            .done(function( data ) {
                if($.trim(data) == "1"){
                    $("#lblErrorPlaca").css({"display":"block"});
                    $("#lblErrorPlaca").html('La placa ' + $("#placa").val() + ' ya existe');
                    $("#btnGuardar").css({"visibility":"hidden"});
                }else{
                    $("#lblErrorPlaca").css({"display":"none"});
                    $("#btnGuardar").css({"visibility":"visible"});
                }
            });
            
            
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
              marca:"required",
              categoria: "required",
              placa: "required",
              nombreruta: "required",
              sillas: "required"
            },
            messages: {
              marca: "Por favor ingrese una marca",
              categoria: "Por favor ingrese una categoria",
              placa: "Por favor ingrese una placa",
              nombreruta: "Por favor ingrese un nombre de la ruta",
              sillas: "Por favor ingrese la cantidad de sillas"
            }
          });
        
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
      </script> 
    </body>
</html>