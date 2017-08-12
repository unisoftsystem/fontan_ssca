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
  label.errorDato {
    margin-left: 10px;
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
       
         <div class="container-fluid">
          <h2 align="right" style="margin-top:2.5%; margin-right:2%; color:#09C"><?= $titulo;?></h2>
          <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <?= $this->session->userdata('UserNameInternoSSCA');?></h4>  
          <input type="hidden" id="txtUserId" name="txtUserId" value="<?= $this->session->userdata('UserIDInternoSSCA');?>" /> 
          <div class="calendar" data-color="normal" offset="0">
              <!--<div class="calendar-month-view">

                    <p>Men&uacute;s del dia</p>

                </div>-->
                <div class="letrasDay">
                  <div>Lunes</div>
                    <div>Martes</div>
                    <div>Miercoles</div>
                    <div>Jueves</div>
                    <div>Viernes</div>
                    <div>Sabado</div>
                    <div>Domingo</div>
                </div>
                <div class="calendar-holder">
                  <div class="calendar-grid">
                      <?php
                          /*
                              Se valida que el result de la consulta de tecnicas tenga datos.
                              Este valor es enviado desde la funcion del controlador
                          */                                    
                          if($menus){
                              //Se itera el result de los tecnicos. $tecnicos es enviado como un objeto, el cual para obtener los datos se obtiene un array asociativo, el cual se itera con un foreach y se muestra en el select
                            $contador = 1;
                              foreach ($menus->result() as $value) {
                      ?>
                      <div class="calendar-day" strtime="201611" time="1451687014797">
                          <div class="event-notif-holder"></div>
                            <div class="date-holder" align="left">
                              <img  width="100%" src="<?= base_url(1) . $value->Foto?>"/><br/><?= $value->Nombre?><br><br><?= $value->Proteina?><br><?= $value->Descripcion?>                             
                            </div>
                        </div>
                      
                      <?php
                            $contador++;
                              }
                          }
                      ?>        
                        
                    </div>
              </div>
            </div><br/>
          <form class="cmxform" method="POST" action="" id="commentForm">
            <div class="row">
              <div class="col-md-8">  
                <div class="row">
                  <div class="col-md-4">  
                      <label for="txtNombre"><font color="#09C" size="2">Nombre del Menú: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="text" name="txtNombre" id="txtNombre" class="form-control"/>
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-4">  
                      <label for="txtDescripcion"><font color="#09C" size="2">Prote&iacute;na: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <select id="selectProteina" name="selectProteina" class="form-control">
                      
                    </select><br><a href="#open" id="open"><font color="#09C" size="2">Crear Prote&iacute;na</font></a>
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-4">  
                      <label for="txtValor"><font color="#09C" size="2">Descripcion del men&uacute;: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <textarea name="txtDescripcion" id="txtDescripcion" class="form-control"></textarea>
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-4">  
                      <label for="txtTiempo"><font color="#09C" size="2">Dia de la semana: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <select id="selectDiaSemana" name="selectDiaSemana" class="form-control">
                      <option value="1">Lunes</option>
                      <option value="2">Martes</option>
                      <option value="3">Miercoles</option>
                      <option value="4">Jueves</option>
                      <option value="5">Viernes</option>
                      <option value="6">Sabado</option>
                      <option value="7">Domingo</option>
                    </select>
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-4">  
                      <label for="txtRest"><font color="#09C" size="2">Restricci&oacute;n por edad: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="text" name="txtRest" id="txtRest" class="form-control" onKeyUp="format(this)">
                  </div>
                </div><br/>
                
                <div class="row">
                  <div class="col-md-11" align="right">
                    
                    
                      <button type="submit" class="btn btn-primary" id="btnGuardar"><b>Guardar</b></button>
                   
                  </div>
                </div><br/>
                  

              
                </div>
                <div class="col-md-2" align="center">
                  <br>
                  <img id="imageFoto" name="imageFoto" width="100%" src="<?= base_url(1);?>images/box.png" />
                  
                  <label for="fileFoto"><font color="#09C" size="2">Seleccionar foto: </font></label><br><input type="file" id="fileFoto" name="fileFoto" class="btn btn-primary" accept="image/*"/>
              </div>
            </div>
          </form>

          <div id="popup" style="display: none; margin-top:100px">
                <div class="content-popup">
                    <div class="close"><a href="#" id="close"><img src="<?= base_url(1);?>images/close.png"/></a></div><br/>
                      <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <hr size="1" color="#000000"/>
                                <h4 class="text-primary text-left">
                                    Nueva Prote&iacute;na
                                </h4>

                                <hr size="1" color="#000000"/>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3">  
                            <label for="txtNombreProteina"><font color="#09C" size="2">Nombre:</font></label>
                          </div>
                          <div class="col-md-9">
                            <input type="text" name="txtNombreProteina" id="txtNombreProteina" class="form-control"/>
                            <?php
                              $attributesError = array(
                                  'id' => 'lblErrorNombreProteina',
                                  'style' => 'display: none;',
                                  'class' => 'errorDato'
                              );
                              echo form_label("", "txtNombreProteina", $attributesError);
                            ?>   
                          </div>
                        </div><br/>

                        <div class="row">
                          <div class="col-md-12" align="right">  
                            <button type="buttin" name="btnCrearProteina" id="btnCrearProteina" class="btn btn-primary"><b>CREAR</b></button>
                          </div>
                        </div>
                      </div>
                
                    
                </div>
            </div>
        
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
          var nombre = $("#txtNombre").val();
          var rest = $("#txtRest").val();
          rest = rest.replace('.','');
          var proteina = $("#selectProteina").val();
          var descripcion = $("#txtDescripcion").val();
          var dia = $("#selectDiaSemana").val();
          var file = $('#fileFoto')[0].files[0]
          var foto = $("#imageFoto").attr("src");
          
          //Se guardan los datos en un JSON
          var datos = {
            nombre: nombre,
            rest: rest,
            proteina: proteina,
            descripcion: descripcion,
            dia: dia,
            imgBase64: foto
          }   
          $("#btnGuardar").attr("disabled", "disabled")
            $.post("<?= base_url();?>index.php/menus/nuevoMenuDia", datos)
            .done(function( data ) {console.log(data)
              alert("¡Se registro con exito el menu del dia!")
              window.location.href = "<?= base_url();?>index.php/menus/MenuDia";
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
            txtNombre: "required",
            txtRest: "required",
            fileFoto: "required",
            txtDescripcion: "required"
          },
          messages: {
            txtNombre: "Por favor ingrese un nombre para el menu del dia",
            txtRest: "Por favor ingrese la edad de restriccion",
            fileFoto: "Por favor seleccione una foto",
            txtDescripcion: "Por favor ingrese una descripcion de los acompañantes de la proteina"
          }
        });
        listarProteinas("")

      })();

      
        $("#txtNombreProteina").keyup(function(e) {
          //Se obtiene lo que ha escrito el usuario
          var Nombre = $("#txtNombreProteina").val();
  
          //Se guardan los datos en un JSON
          var datos = {
              Nombre: Nombre          
          }       
          /*
              Se conecta a la funcion del controlador para verificar la existencia del dato enviado.
              La funcion base_url(1) obtiene la url base del proyecto, la cual es configurada en el archivo config.php
          */
          $.post("<?= base_url();?>index.php/proteinas/ExisteProteina", datos)
          .done(function( data ) {
              if($.trim(data) == "1"){
                  $("#lblErrorNombreProteina").css({"display":"block"});
                  $("#lblErrorNombreProteina").html('La proteina ' + $("#txtNombreProteina").val() + ' ya existe');
                  $("#btnCrearProteina").css({"visibility":"hidden"});
              }else{
                  $("#lblErrorNombreProteina").css({"display":"none"});
                  $("#btnCrearProteina").css({"visibility":"visible"});
              }
          });
          
          
      });
      
      
        $("#btnCrearProteina").click(function(e){
          
          $.post("<?= base_url();?>index.php/proteinas/insertar", {Nombre: $("#txtNombreProteina").val()})
          .done(function( data ) {console.log(data)
            $('#popup').fadeOut('slow');
            $('.popup-overlay').fadeOut('slow');
            listarProteinas($.trim(data))
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

        function listarProteinas(proteina){
          $.post("<?= base_url();?>index.php/proteinas/listarProteinas", {})
          .done(function( data ) {
            if(data != "[]"){
              var json = JSON.parse(data);
              $("#selectProteina").html("")
              for (var i = 0; i < json.length; i++) {
                $("#selectProteina").append('<option value="' + json[i].id + '">' + json[i].Descripcion + '</option>')
              }
            }
            if(proteina != ""){
              $("#selectProteina").val(proteina)
            }
          });
        }
      </script> 
    </body>
</html>