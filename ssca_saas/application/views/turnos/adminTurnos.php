<?php
    $UserName = $this->session->userdata('UserNameInternoSSCA');
    if(empty($UserName)) { // Recuerda usar corchetes.
        header('Location: ' . base_url(1));
    }
?>
<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?= base_url(1);?>lib/timepicker/jquery-ui-timepicker-addon.css" />
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
                  <div class="col-md-3">  
                      <label for="selectFuncionario"><font color="#09C" size="2">Funcionario: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <select class="form-control" id="selectFuncionario" name="selectFuncionario">
                      <option value="Seleccione">Seleccione...</option>
                      <?php
                        if($funcionarios){
                          foreach ($funcionarios->result() as $value) {
                      ?>
                      <option value="<?= $value->idUsuario?>"><?= $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;?></option>
                      <?php
                          }
                        }
                      ?> 
                    </select>
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-3">  
                      <label for="txtNombreTurno"><font color="#09C" size="2">Nombre del Turno Laboral: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="text" name="txtNombreTurno" id="txtNombreTurno" class="form-control" disabled="disabled"/>
                  </div>
                </div><br/>
                
                <div class="row">
                  <div class="col-md-3">  
                      <label for="txtHoraInicio"><font color="#09C" size="2">Hora Inicial del Turno: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="time" name="txtHoraInicio" id="txtHoraInicio" class="form-control" disabled="disabled" data-provide="timepicker"/>                    
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-3">  
                      <label for="txtHoraFinal"><font color="#09C" size="2">Hora Final del Turno: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="time" name="txtHoraFinal" id="txtHoraFinal" class="form-control" disabled="disabled" data-provide="timepicker" onchange="CompararHoras()"/>
                  </div>
                </div><br/>
                
                <div class="row">
                  <div class="col-md-11" align="right">
                      <button type="submit" class="btn btn-primary" id="btnGuardar" disabled="disabled"><b>CREAR</b></button>                   
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
      <script type="text/javascript" src="<?= base_url(1);?>lib/timepicker/jquery-ui-timepicker-addon.js"></script>
      <script type="text/javascript" src="<?= base_url(1);?>lib/timepicker/jquery-ui-sliderAccess.js"></script>
      <script type="text/javascript">
        (function() {
          // use custom tooltip; disable animations for now to work around lack of refresh method on tooltip
          $("#commentForm").tooltip({
            show: false,
            hide: false
          });
        
          // validate signup form on keyup and submit
          $("#commentForm").validate({
            rules: {
              txtNombreTurno:"required",
              txtHoraInicio:"required",
              txtHoraFinal:"required"
            },
            messages: {
              txtNombreTurno: "Por favor ingrese un nombre del turno",
              txtHoraInicio: "Por favor ingrese una hora de inicio",
              txtHoraFinal: "Por favor ingrese una hora final"
            },
            submitHandler: function(form) {
              var usuario = $("#selectFuncionario").val();
              var nombre = $("#txtNombreTurno").val();
              var horaInicio = $("#txtHoraInicio").val();
              var horaFin = $("#txtHoraFinal").val();    

              //Se guardan los datos en un JSON
              var datos = {
                usuario: usuario,
                nombre: nombre,
                horainicio: horaInicio,
                horafinal: horaFin
              }   
              
              if($.trim($("#btnGuardar").html()) == "CREAR"){             
                
                //Enviar datos para crearse
                $.post("<?= base_url();?>index.php/turnos_laborales/crearTurno", datos)
                .done(function( data ) {console.log(data)             
                   alert("¡Se registro con exito el turno!")
                   window.location.href = "<?= base_url();?>index.php/turnos_laborales/adminTurnos";
                });
              }else{

                //Enviar datos para modificarse 
                $.post("<?= base_url();?>index.php/turnos_laborales/editarTurno", datos)
                .done(function( data ) {console.log(data)             
                   alert("¡Se modifico con exito el turno!")
                   window.location.href = "<?= base_url();?>index.php/turnos_laborales/adminTurnos";
                });
              }
              
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

        $('#txtHoraInicio').timepicker({
          hourMin: 0,
          hourMax: 23
        }).on("change", function(e){
          var dateString = $('#txtHoraInicio').val();
          var fecha = dateString.split(":")
          //console.log(dateString);
          //CompararHoras()
          $("#txtHoraFinal").removeAttr("disabled")
         

          var hora = parseInt(fecha[0]);
          $('#txtHoraFinal').timepicker({
            hourMin: hora,
            hourMax: 23
          });
          $('#txtHoraFinal').val($('#txtHoraInicio').val())
        });

        $('#selectFuncionario').change(function(e) {
          if($('#selectFuncionario').val() != "Seleccione"){
            $.post("<?= base_url();?>index.php/turnos_laborales/obtenerTurno", {usuario:$('#selectFuncionario').val()})
            .done(function( data ) {
              console.log(data)
              if($.trim(data) != "[]"){
                $("#btnGuardar").html("MODIFICAR")
                $("#btnGuardar").removeAttr("disabled")
                $("#btnGuardar").addClass("btn-warning")

                var json = JSON.parse(data)

                for (var i = 0; i < json.length; i++) {
                  $("#txtNombreTurno").val(json[i].name)
                  $("#txtHoraInicio").val(json[i].hora_inicio)
                  $("#txtHoraFinal").val(json[i].hora_final)
                  $('#txtHoraInicio').timepicker({
                    hourMin: 0,
                    hourMax: 23
                  })
                }
              }else{
                $("#btnGuardar").html("CREAR")
                $("#btnGuardar").removeClass("btn-warning")
              }
              $("#txtNombreTurno").removeAttr("disabled")
              $("#txtHoraInicio").removeAttr("disabled")
              
            });
          }else{
            $("#btnGuardar").attr("disabled", "disabled")
            $("#txtNombreTurno").attr("disabled", "disabled")
            $("#txtHoraInicio").attr("disabled", "disabled")
            $("#txtHoraFinal").attr("disabled", "disabled")
            $("#txtNombreTurno").val("")
            $("#txtHoraInicio").val("")
            $("#txtHoraFinal").val("")
          }
        });

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
          
          // Comparar 
          if (estado > 0){ 
            alert("La hora  inicial no puede ser mayor que la final"); 
            $("#btnGuardar").attr("disabled", "disabled")
          }else{
            $("#btnGuardar").removeAttr("disabled")

           
          }

        } 
        
      </script> 
    </body>
</html>