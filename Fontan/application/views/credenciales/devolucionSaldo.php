<?php
    $UserName = $this->session->userdata('UserNameInternoSSCA');
    if(empty($UserName)) { // Recuerda usar corchetes.
        header('Location: ' . base_url());
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
<script src="<?= base_url();?>js/html5-qrcode.min.js"></script>
<script>
  $(document).ready(function(){
    $('#reader').html5_qrcode(function(data){
        //Mostrar resultado de escanear codigo qr
        $("#txtUsuario").val(data);
        $.post("<?= base_url();?>index.php/ordenpedido/ActionConsultarUsuarioPorId", {usuario: data})
        .done(function( result ) {
          if($.trim(result) != "[]"){
            var jsonUsuario = JSON.parse(result);
            $.each(jsonUsuario, function(i, item) {
              $("#txtPrimerApellido").val(jsonUsuario[i].PrimerApellido);
              $("#txtSegundoApellido").val(jsonUsuario[i].SegundoApellido);
              $("#txtPrimerNombre").val(jsonUsuario[i].PrimerNombre);
              $("#txtSegundoNombre").val(jsonUsuario[i].SegundoNombre);
              $('#txtSaldo').val(jsonUsuario[i].SaldoCredencial);
              $('#txtCredencial').val(jsonUsuario[i].idCredencial);
            });
            $("#btnIngresar").css({"display":"block"})
          }else{
            $("#txtPrimerApellido").val("");
            $("#txtSegundoApellido").val("");
            $("#txtPrimerNombre").val("");
            $("#txtSegundoNombre").val("");
            $("#txtSaldo").val("");
            $("#txtCredencial").val("");
            $("#btnIngresar").css({"display":"none"})
          }
        }); 
      },
      function(error){
        //Mostrar error cuando se trata de leer el qr, es Opcional
        //$('#read_error').html(error);
        console.log(error);
      }, function(videoError){
        //Mostrar error en video, es Opcional
        //$('#vid_error').html(videoError);
      }
    );
  });
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
        </br>
        <h2 align="right" style="margin-top:2.5%; margin-right:2%; color:#09C"><?= $titulo;?></h2>
        <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <?= $this->session->userdata('UserNameInternoSSCA');?></h4>  
        <input type="hidden" id="txtUserId" name="txtUserId" value="<?= $this->session->userdata('UserIDInternoSSCA');?>" /> 
         <div class="container-fluid">
          
          <form class="cmxform" method="POST" action="" id="commentForm">
            <div class="row">
              <div class="col-md-8">  
                
                  <div  class="center" id="reader" style="width:100%;height:400px"></div>

              
                </div>
                <div class="col-md-4">
                  <input type="hidden" name="txtUsuario" id="txtUsuario" class="form-control" placeholder="Buscar Usuario" disabled/>
                  <input type="hidden" name="txtCredencial" id="txtCredencial" class="form-control"/><br>

                  <label for="txtPrimerApellido"><font color="#09C" size="2">Primer Apellido:</font></label>
                  <input type="text" name="txtPrimerApellido" id="txtPrimerApellido" disabled class="form-control"/><br>

                  <label for="txtSegundoApellido"><font color="#09C" size="2">Segundo Apellido:</font></label>
                  <input type="text" name="txtSegundoApellido" id="txtSegundoApellido" disabled class="form-control"/><br>

                  <label for="txtPrimerNombre"><font color="#09C" size="2">Primer Nombre:</font></label>
                  <input type="text" name="txtPrimerNombre" id="txtPrimerNombre" disabled class="form-control"/><br>

                  <label for="txtSegundoNombre"><font color="#09C" size="2">Segundo Nombre:</font></label>
                  <input type="text" name="txtSegundoNombre" id="txtSegundoNombre" disabled class="form-control"/><br>
                  <label for="txtRecarga"><font color="#09C" size="2">Saldo Actual:</font></label>
                  <input type="text" name="txtSaldo" id="txtSaldo" class="form-control" disabled/><br>
                  <label for="txtRecarga"><font color="#09C" size="2">Devolver:</font></label>
                  <input type="text" name="txtRecarga" id="txtRecarga" min="1" onKeyUp="format(this)" class="form-control"/><br>

                  <button type="submit" name="btnIngresar" id="btnIngresar" class="btn btn-primary" style="float: right;display:none"><b>Realizar Devolución</b></button><br><br><br>

                


                </div>
            </div>
          </form>
          <div id="popup" style="display: none;">
            <div class="content-popup">
              <div class="close"><a href="#" id="close"><img src="<?= base_url();?>images/close.png"/></a></div>
              <h4 align="rigth">Informaci&oacute;n</h4>
              <img src="" id="foto" />
              <div id="Datos"></div>
            </div>                    
          </div>
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
      var urlFoto = "";
      
      $('#close').click(function(){
          $('#popup').fadeOut('slow');
          $('.popup-overlay').fadeOut('slow');
         window.location.href = "<?= base_url();?>index.php/credenciales/devolucionSaldo";
          return false;
      }); 
      
      $.validator.setDefaults({
        //Capturar evento del boton crear
        submitHandler: function() {
         //Se obtienen los datos a enviar    
          var usuarioIngresado = $("#txtUsuario").val();
          var saldo = $("#txtRecarga").val();
          var usuarioSesion = $("#txtUserId").val(); 
          var credencial = $("#txtCredencial").val();
          var saldoActual = $("#txtSaldo").val();
          /*
            Descripcion: Obtener fecha y hora para registrar movimientos
          */
          var date = new Date();
          var dia = date.getDate();
          var mes = (date.getMonth() + 1);
          var year = date.getFullYear();
          
          var vaux = saldo.replace('.','');
          if(dia < 10) {
            dia = '0' + dia;
          } 
          
          if(mes < 10) {
            mes = '0' + mes;
          } 
          
          var fechaActual = year + "-" + mes + "-" + dia;
          var horaActual = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds(); 
          
          //Se guardan los datos en un JSON
          if($.trim(saldoActual) != ""){
            if(parseInt(vaux) > 0){
              if(parseInt(vaux) <= parseInt(saldoActual)){
              var usuario = {
                usuario: usuarioIngresado,
                usuarioSesion: usuarioSesion,
                saldo: saldo,
                fecha: fechaActual,
                hora: horaActual,
                credencial: credencial
                  }   
              console.log(usuario);
              $("#btnIngresar").attr("disabled", "disabled")
              
              $.post("<?= base_url();?>index.php/credenciales/DevolverSaldo", usuario)
              .done(function( data ) {
                console.log($.trim(data));
                
                if($.trim(data) != "[]"){
                  //alert("Se proceso con exito el recaudo");
                  var json = JSON.parse(data);
                  var html = "";
                  $.each(json, function(i, item) {

                    html+="<h5>" + json[i].PrimerNombre + " " + json[i].SegundoNombre + " " + json[i].PrimerApellido + " " + json[i].SegundoApellido + " " + " se le ha devuelto con exito el saldo</h5><p>Saldo Anterior:" + $("#txtSaldo").val() + " </p><p>Saldo Actual:" + json[i].SaldoCredencial + " </p>";
                    $("#foto").attr("src", json[i].ImagenFotografica);
                  });
                  $("#Datos").html(html);
                  $('#popup').fadeIn('slow');
                }
              });

              $("#txtPrimerApellido").val("");
              $("#txtSegundoApellido").val("");
              $("#txtPrimerNombre").val("");
              $("#txtSegundoNombre").val("");
              $("#txtRecarga").val("");
              $("#txtUsuario").val("");
            }else{
              alert("El valor a devolver debe ser menor o igual que el saldo actual de la credencial")
            }
          }else{
            alert("El valor a devolver debe ser mayor a 0")
          }
                  
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
            txtNombre:"required",
            txtDescripcion: "required",
            txtValor: "required",
            txtTiempo: "required",
            txtEdadMinima: "required",
            txtEdad: "required",
            txtTiempoC: "required",
            txtStock: "required",
          },
          messages: {
            txtNombre: "Por favor ingrese un nombre",
            txtDescripcion: "Por favor ingrese una Descripción",
            txtValor: "Por favor ingrese un precio unitario",
            txtTiempo: "Por favor ingrese una Restricción de tiempo",
            txtEdadMinima: "Por favor ingrese una edad minima",
            txtEdad: "Por favor ingrese una edad Maxima",
            txtTiempoC: "Por favor ingrese un tiempo de Cancelacion",
            txtStock: "Por favor ingrese una cantidad"
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