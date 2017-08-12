<?php
    $UserName = $this->session->userdata('UserNameInternoSSCA');
    if(empty($UserName)) { // Recuerda usar corchetes.
        header('Location: ' . base_url(1));
    }
?>
<style>
    #commentForm label.error,  label.error{
        width: auto;
        display: block;
        color:#F00;
        font-size:12px;
        padding-bottom: 0px;
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
                <!--<li id="josediaz78963gmailcom" mode="hidden" persona="josediaz78963@gmail.com">ACUDIENTE (Maria Torres)</li>
                <li id="hidden1" mode="hidden">MONITOR</li>
                <li id="hidden2" mode="hidden" persona="">ACUDIENTE</li>-->
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
              <div class="row">
                <div class="col-md-4">  
                    <label for="selectruta" style="margin-top: 6px"><font color="#09C" size="2">Selección de Ruta</font></label>
                </div>
                <div class="col-md-8">  
                  <select class="form-control" id="selectruta" name="selectruta"> 
                    <option value="SELECCIONE">SELECCIONE...</option>
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
              </div><br/>

              <div class="row">
                <div class="col-md-4">  
                    <label for="selectruta" style="margin-top: 6px"><font color="#09C" size="2">Selección de Estudiante</font></label>
                </div>
                <div class="col-md-8">  
                  <select class="form-control" id="selectEstudiante" name="selectEstudiante"> 
                    
                  </select>        
                </div>
              </div><br/>

              <div class="row">
                <div class="col-md-12" align="right">
                <button type="button" id="btnSeleccionarAcudiente" class="btn btn-primary" style="display: none;">SELECCIONAR</button>
                </div>
              </div>
              
            </div>
              
          </div>
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
    <script>
               
        
        function agregarNombre(usuario, contador) {

          return contador;
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
        function existeDatos(usuario1, usuario2, json){
          var estado = -1;
          for (var i = 0; i < json.length; i++) {
            if(jsonChats[i]){
              if(json[i].usuarioF == usuario1 && json[i].usuarioS == usuario2){
                estado = i;
              }
            }
          }
          return estado;
        }
        $("#selectruta").change(function(e) {
            var ruta = $(this).val()
            if(ruta != "SELECCIONE"){
                $("#selectEstudiante").empty()   
                $.post("../rutas/ObtenerRuta", {ruta:ruta})
                .done(function( data ) {
                    console.log(data)
                    if($.trim(data) != "[]"){
                        var jsonDatos = JSON.parse(data);
                        var json = jsonDatos[0].estudiantes;
                        for (var i = 0; i < json.length; i++) {
                            $("#selectEstudiante").append('<option value="' + json[i].idUsuario + '">' + json[i].PrimerNombre + ' ' + json[i].SegundoNombre + ' ' + json[i].PrimerApellido + ' ' + json[i].SegundoApellido + '</option>')   
                        }
                        $("#btnSeleccionarAcudiente").css({"display":"block"})
                    }else{
                        $("#btnSeleccionarAcudiente").css({"display":"none"})
                    }
                })  
            }else{
                $("#btnSeleccionarAcudiente").css({"display":"none"})
                $("#selectEstudiante").html("")   
            }                     

        })

        $("#btnSeleccionarAcudiente").click(function(e) {
            var socket = io.connect("http://190.60.211.17:3003");
            var ruta = $("#selectruta").val();
            var estudiante = $("#selectEstudiante").val();
            var usuarioSesion = $("#txtUserId").val(); 
            var specialChars = "!@#$^&%*()+=-[]\/{}|:<>?,.";
            var marginRight;

            /*// Los eliminamos todos
            for (var i = 0; i < specialChars.length; i++) {
                estudiante= estudiante.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
            }  */             

                $.post("../usuarios_aplicaciones/ObtenerusuarioAplicacion", {usuario:estudiante})
                .done(function( data ) {
                    console.log(data)

                    if($.trim(data) != ""){
                        var jsonDatos = JSON.parse(data);
                        var jsonEstudiante = [$("#selectEstudiante").val()]

                        estudiante = jsonDatos[0].idAcudiente;
                        // Los eliminamos todos
                        for (var i = 0; i < specialChars.length; i++) {
                            estudiante = estudiante.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
                        }   

                        if ( $("#" + estudiante).length == 0 ) {
                            if($("#chats > div").length < 2){
                                switch($("#chats > div").length){
                                  case 0:
                                    marginRight = 0;
                                    break;
                                  case 1:
                                    marginRight = 360;
                                    break;
                                }
                                var imagen = "";
                                if(jsonDatos[0].gcm_regid != ""){
                                    imagen = "<?= base_url(1);?>images/circle_green_16_ns.png";
                                }else{
                                    imagen = "<?= base_url(1);?>images/circle_red_16_ns.png";
                                }
                                $("#chats").append('<div class="panel panel-chat" style="margin-right:' + marginRight + 'px" id="' + estudiante + '" persona="' + jsonDatos[0].idAcudiente + '" mode="main" estudiantes="' + jsonEstudiante + '" mode="main">' +
                                    '<div class="panel-heading" align="center">' +
                                        '<img src="' + imagen + '" style="float: left; margin-left: 0">' +
                                        '<span>ACUDIENTE: ' + jsonDatos[0].NombreAcudiente + ' (' + jsonDatos[0].PrimerNombre + ' ' + jsonDatos[0].SegundoNombre + ' ' + jsonDatos[0].PrimerApellido + ' ' + jsonDatos[0].SegundoApellido + ')</span>' +
                                        '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + estudiante + '" personaS="' + jsonDatos[0].idAcudiente + '" tipo="ACUDIENTE"><i class="glyphicon glyphicon-remove"></i></a>' +
                                    '</div>' +
                                    '<div class="panel-body">' +
                                        '<br>' +
                                        '<ul>' +
                                        '</ul>' +
                                        '<div class="clear"></div>' +
                                    '</div>' +
                                    '<table width="100%" cellpadding="0" cellpadding="0">' +
                                        '<tr>' +
                                            '<td width="95%"><input name="textMessage' + estudiante + '" id="textMessage' + estudiante + '" cols="0" rows="0" onkeypress="validar(event)" class="form-control" /></td>' +
                                            '<td width="5%"><button type="button" data-inline="true" data-mini="true" id="btnEnviar' + estudiante + '" persona="' + estudiante + '" personaS="' + jsonDatos[0].idAcudiente + '" class="btn btn-primary" tipo="ACUDIENTE" estudiantes="' + jsonEstudiante + '">></button></td>' +
                                        '</tr>' +
                                    '</table>' +
                                  '</div>')
                                var array = {
                                  usuario1: jsonDatos[0].idAcudiente,
                                  usuario2: $("#txtUserId").val()
                                }
                                $.post("../rutas/obtenerChatUsuario", array)
                                .done(function( resul ) {console.log(resul)
                                  var mensajes = JSON.parse(resul);;
                                  if(mensajes.length > 0){
                                    for (var j = 0; j < mensajes.length; j++) {
                                      console.log(mensajes[j].origen + " " + $("#txtUserId").val())
                                        if($("#txtUserId").val() == mensajes[j].origen){
                                            $( "#" + estudiante + " > .panel-body > ul" ).append('<li>' +
                                                '<span class="right">' + mensajes[j].message + '</span>' +
                                                '<div class="clear"></div>' +
                                            '</li>');
                                        }else{
                                            $( "#" + estudiante + " > .panel-body > ul" ).append('<li>' +
                                              '<img src="<?= base_url(1);?>images/bus icono.png" alt=""/>' +
                                              '<span class="left">' + mensajes[j].message + '</span>' +
                                              '<div class="clear"></div>' +
                                            '</li>');                                    
                                        }
                                    }
                                  }
                                })
                                $('#' + estudiante + ' > .panel-body').animate({height: "350px",  scrollTop: $('#' + estudiante + ' > .panel-body')[0].scrollHeight}, 500).show();

                                $("#" + estudiante + " > .panel-heading > .chatClose").click(function(){
                                    var persona = $(this).attr("persona")
                                    cerrarVentana(persona)                            
                                });

                                $("#" + estudiante + " > .panel-heading").click(function(){
                                    var id = $(this).parent().attr("id")
                                    var clases = $("#" + id).attr("class")
                                    console.log(clases)

                                    switch(clases){
                                      case "panel panel-chat mini":
                                        console.log("MAL")
                                        $("#" + id).removeClass('mini').addClass('normal');
                                        $('#' + id + ' > .panel-body').animate({height: "350px",  scrollTop: $('#' + id + ' > .panel-body')[0].scrollHeight}, 500).show();
                                        $('#' + id + ' > table').show();
                                        $('#' + id + ' > .panel-heading').css({"background": "#4b67a8", "border": "1px solid #2e4588"})
                                        break;

                                      case "panel panel-chat normal":
                                        console.log("BIEN")
                                        $("#" + id).removeClass('normal').addClass('mini');
                                        $('#' + id + ' > .panel-body').animate({height: "0"}, 500);
                                        $('#' + id + ' > table').hide();

                                        break;

                                      case "panel panel-chat":
                                        $("#" + id).removeClass('normal').addClass('mini');
                                        $('#' + id + ' > .panel-body').animate({height: "0"}, 500);
                                        $('#' + id + ' > table').hide();
                                    }
                                    

                                });

                                $("#textMessage" + estudiante).keypress(function(e){
                                  var tecla = (document.all) ? e.keyCode : e.which;
                                  var texto = $( this ).val()
                                  if (tecla==13){
                                    var idButton = $(this).parent().parent().parent().parent().parent().attr("id")
                                    var persona = $("#btnEnviar" + idButton).attr("persona")
                                    var personaS = $("#btnEnviar" + idButton).attr("personaS")
                                    var tipo = $("#btnEnviar" + idButton).attr("tipo")
                                    var usuarioSesion = $("#txtUserId").val(); 
                                    if($.trim(texto).length != 0){
                                      socket.emit('send message', {
                                        message: texto, 
                                        origen: persona,
                                        objetivo: usuarioSesion, 
                                        tipo: "CENTRO", 
                                        usuarioF: personaS, 
                                        usuarioS: usuarioSesion
                                      });
                                      var array = {
                                        mensaje: texto,
                                        origen: usuarioSesion,
                                        destino: personaS,
                                        usuario1: personaS,
                                        usuario2: usuarioSesion
                                      }
                                      $.post("../rutas/guardarMensajeChat", array)
                                      .done(function( dato ) {
                                      })
                                      $.post("http://190.60.211.17/push/ActionEnviarMensajeChat.php", {idestudiante: personaS, tipoUsuario: tipo})
                                        .done(function( dato ) {
                                          console.log(dato)
                                        })

                                      $( "#textMessage" + persona ).val("")
                                      $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                                  '<span class="right">' + texto + '</span>' +
                                                  '<div class="clear"></div>' +
                                              '</li>');
                                      $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                                    }
                                  }
                                });
                                $("#btnEnviar" + estudiante).click(function(e){
                                    var persona = $(this).attr("persona")
                                    var personaS = $(this).attr("personaS")
                                    var tipo = $(this).attr("tipo")
                                    var texto = $( "#textMessage" + persona).val()
                                    var usuarioSesion = $("#txtUserId").val();
                                    if($.trim(texto).length != 0){
                                        socket.emit('send message', {
                                          message: texto, 
                                          origen: persona,
                                          objetivo: usuarioSesion, 
                                          tipo: "CENTRO", 
                                          usuarioF: personaS, 
                                          usuarioS: usuarioSesion
                                        });
                                        var array = {
                                            mensaje: texto,
                                            origen: usuarioSesion,
                                            destino: personaS,
                                            usuario1: personaS,
                                            usuario2: usuarioSesion
                                        }
                                        $.post("../rutas/guardarMensajeChat", array)
                                        .done(function( dato ) {
                                        })
                                        $.post("http://190.60.211.17/push/ActionEnviarMensajeChat.php", {idestudiante: personaS, tipoUsuario: tipo})
                                        .done(function( dato ) {
                                          console.log(dato)
                                        })
                                        $( "#textMessage" + persona ).val("")
                                        $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                            '<span class="right">' + texto + '</span>' +
                                            '<div class="clear"></div>' +
                                        '</li>');
                                        $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                                    }
                                })

                            }else{
                                $( ".windowHidden > li > ul" ).append('<li id="' + estudiante + '" mode="hidden" persona="' + jsonDatos[0].idAcudiente + '" estudiantes="' + jsonEstudiante + '">ACUDIENTE (' + jsonDatos[0].PrimerNombre + ' ' + jsonDatos[0].SegundoNombre + ' ' + jsonDatos[0].PrimerApellido + ' ' + jsonDatos[0].SegundoApellido + ')</li>'); 
                                $('.windowHidden > li > a').css({"background": "orange", "border": "1px solid orange"})
                                $( "#" + estudiante).css({"background": "orange", "border": "1px solid orange"})
                                //Se muestra el menu de chats disponibles
                                $(".windowHidden").css({"display":"block"})

                                //Evento para cuando se selecciona un item en el menu de chats ocultos
                                //Cuando se selecciona uno se borra la ventana pricipal numero 2
                                //, el chat oculto pasa a ser principal, y la ventana principal numero 2 se agrega
                                //como  chat oculto. Es decir se intercambian posicion: el chat oculto que se selecciono
                                //con la ventana principal numero 2
                                $(".windowHidden > li > ul > li").click(function(){
                                    var contadorLi = 0;
                                    var idSelect = $(this).attr("id")
                                    var persona = $(this).attr("persona")
                                    var idLast = $('#chats')[0].children[1].id

                                    var spanSelect = $("#" + idSelect).html()
                                    var spanLast = $("#" + idLast + " > .panel-heading > span").html()
                                    var personaLast = $("#" + idLast).attr("persona") 
                                    var personaSelect = $("#" + idSelect).attr("persona") 
                                    var estudiantesLast = $("#" + idLast).attr("estudiantes") 
                                    var estudiantesSelect = $("#" + idSelect).attr("estudiantes")

                                    console.log(personaLast + " " + personaSelect)
                                    $("#" + idSelect).attr("persona", personaLast) 
                                    $("#" + idSelect).attr("estudiantes", estudiantesLast) 
                                    //Se obtiene el numero de chats oculto que tiene alerta de mensajes nuevo
                                    $( ".windowHidden > li > ul > li" ).each(function( index ) {
                                      if($(this).css("background-color") == "rgb(255, 165, 0)"){
                                          contadorLi++;
                                      }
                                      //console.log( index + ": " + hexc($(this).css("background-color")) );
                                      console.log( index + ": " + $(this).css("background-color") );
                                    });
                                    //Cuando hay un solo chat oculto que tiene mensaje nuevo sin leer se
                                    //borra la alerta de mensaje nuevo
                                    //si hay mas de una alerta se mantiene el color de fondo de alerta
                                    if(contadorLi == 1){
                                        $('.windowHidden > li > a').css({"background": "#4b67a8", "border": "1px solid #4b67a8"})
                                        $( "#" + idSelect).css({"background": "none", "border": "none"})
                                    }
                                    //console.log($("#chats > div").length)
                                    $("#" + idLast).remove()
                                    $("#" + idSelect).html(spanLast)

                                    $("#" + idSelect).attr("id", idLast)

                                    //$( ".windowHidden > li > ul" ).find( $("li").css({"background"}) );
                                    
                                    //Agregar el chat oculto como ventana principal
                                    $("#chats").append('<div class="panel panel-chat" style="margin-right:360px;" id="' + idSelect + '" persona="' + personaSelect + '" mode="main" estudiantes="' + estudiantesSelect + '">' +
                                        '<div class="panel-heading" align="center">' +
                                            '<img src="<?= base_url(1);?>images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
                                            '<span>' + spanSelect + '</span>' +
                                            '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + idSelect + '" tipo="" personaS="' + personaSelect + '" tipo="ACUDIENTE"><i class="glyphicon glyphicon-remove"></i></a>' +
                                        '</div>' +
                                        '<div class="panel-body">' +
                                            '<br>' +
                                            '<ul>' +
                                            '</ul>' +
                                            '<div class="clear"></div>' +
                                        '</div>' +
                                        '<table width="100%" cellpadding="0" cellpadding="0">' +
                                            '<tr>' +
                                                '<td width="95%"><input name="textMessage' + idSelect + '" id="textMessage' + idSelect + '" cols="0" rows="0" onkeypress="validar(event)" class="form-control" /></td>' +
                                                '<td width="5%"><button data-inline="true" data-mini="true" id="btnEnviar' + idSelect + '" persona="' + idSelect + '" tipo="" personaS="' + personaSelect + '" class="btn btn-primary" tipo="ACUDIENTE" estudiantes="' + estudiantesSelect + '">></button></td>' +
                                            '</tr>' +
                                        '</table>' +
                                    '</div>')
                                    var array = {
                                      usuario1: personaSelect,
                                      usuario2: $("#txtUserId").val()
                                    }
                                    $.post("../rutas/obtenerChatUsuario", array)
                                    .done(function( resul ) {console.log(resul)
                                      var mensajes = JSON.parse(resul);;
                                      if(mensajes.length > 0){
                                        for (var j = 0; j < mensajes.length; j++) {
                                          console.log(mensajes[j].origen + " " + $("#txtUserId").val())
                                            if($("#txtUserId").val() == mensajes[j].origen){
                                                $( "#" + idSelect + " > .panel-body > ul" ).append('<li>' +
                                                    '<span class="right">' + mensajes[j].message + '</span>' +
                                                    '<div class="clear"></div>' +
                                                '</li>');
                                            }else{
                                                $( "#" + idSelect + " > .panel-body > ul" ).append('<li>' +
                                                  '<img src="<?= base_url(1);?>images/bus icono.png" alt=""/>' +
                                                  '<span class="left">' + mensajes[j].message + '</span>' +
                                                  '<div class="clear"></div>' +
                                                '</li>');                                    
                                            }
                                        }
                                      }
                                    })
                                    

                                    //Cargar todo el chat con esa persona
                                    /*$( "#" + idSelect + " > .panel-body > ul" ).append('<li>' +
                                        '<img src="../../images/bus icono.png" alt=""/>' +
                                        '<span class="left">Hi</span>' +
                                        '<div class="clear"></div>' +
                                    '</li>');*/
                                    $('#' + idSelect + ' > .panel-body').animate({height: "350px",  scrollTop: $('#' + idSelect + ' > .panel-body')[0].scrollHeight}, 500).show();

                                    //Evento para cuando se da click en el header para
                                    //minimizar la ventana de chat
                                    //Si la ventana esta minimizada se abre
                                    //y sino se minimiza
                                    $("#" + idSelect + " > .panel-heading").click(function(){
                                      var id = $(this).parent().attr("id")
                                      var clases = $("#" + id).attr("class")
                                      console.log(clases)
                                      
                                      switch(clases){
                                        case "panel panel-chat mini":
                                          $("#" + id).removeClass('mini').addClass('normal');
                                          $('#' + id + ' > .panel-body').animate({height: "350px",  scrollTop: $('#' + id + ' > .panel-body')[0].scrollHeight}, 500).show();
                                          $('#' + id + ' > table').show();
                                          $('#' + id + ' > .panel-heading').css({"background": "#4b67a8", "border": "1px solid #2e4588"})
                                          break;

                                        case "panel panel-chat normal":
                                          $("#" + id).removeClass('normal').addClass('mini');
                                          $('#' + id + ' > .panel-body').animate({height: "0"}, 500);
                                          $('#' + id + ' > table').hide();

                                          break;

                                        case "panel panel-chat":
                                          $("#" + id).removeClass('normal').addClass('mini');
                                          $('#' + id + ' > .panel-body').animate({height: "0"}, 500);
                                          $('#' + id + ' > table').hide();
                                      }
                                      

                                    })

                                    $("#" + idSelect + " > .panel-heading > .chatClose").click(function(){
                                      var persona = $(this).attr("persona")
                                      cerrarVentana(persona)
                                    });

                                    $("#textMessage" + idSelect).keypress(function(e){
                                      var tecla = (document.all) ? e.keyCode : e.which;
                                      var texto = $( this ).val()
                                      if (tecla==13){
                                        var idButton = $(this).parent().parent().parent().parent().parent().attr("id")
                                        var persona = $("#btnEnviar" + idButton).attr("persona")
                                        var personaS = $("#btnEnviar" + idButton).attr("personaS")
                                        var tipo = $("#btnEnviar" + idButton).attr("tipo")
                                        var usuarioSesion = $("#txtUserId").val(); 
                                        if($.trim(texto).length != 0){
                                          socket.emit('send message', {
                                            message: texto, 
                                            origen: persona,
                                            objetivo: usuarioSesion, 
                                            tipo: "CENTRO", 
                                            usuarioF: personaS, 
                                            usuarioS: usuarioSesion
                                          });
                                          var array = {
                                            mensaje: texto,
                                            origen: usuarioSesion,
                                            destino: personaS,
                                            usuario1: personaS,
                                            usuario2: usuarioSesion
                                          }
                                          $.post("../rutas/guardarMensajeChat", array)
                                          .done(function( dato ) {
                                          })
                                          $.post("http://190.60.211.17/push/ActionEnviarMensajeChat.php", {idestudiante: personaS, tipoUsuario: tipo})
                                            .done(function( dato ) {
                                              console.log(dato)
                                            })

                                          $( "#textMessage" + persona ).val("")
                                          $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                                      '<span class="right">' + texto + '</span>' +
                                                      '<div class="clear"></div>' +
                                                  '</li>');
                                          $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                                        }
                                      }
                                    });

                                    //Evento para enviar un mensaje al usuario objetivo
                                    //Se obtienen los datos del chat, se agrega el mensaje al body y 
                                    //se envia el mensaje al usuario objetivo
                                    $("#btnEnviar" + idSelect).click(function(e){
                                        var persona = $(this).attr("persona")
                                        var personaS = $(this).attr("personaS")
                                        var tipo = $(this).attr("tipo")
                                        var texto = $( "#textMessage" + persona).val()
                                        var usuarioSesion = $("#txtUserId").val();
                                        if($.trim(texto).length != 0){
                                            socket.emit('send message', {
                                                message: texto, 
                                                origen: persona,
                                                objetivo: usuarioSesion, 
                                                tipo: "CENTRO", 
                                                usuarioF: personaS, 
                                                usuarioS: usuarioSesion
                                            });
                                            var array = {
                                                mensaje: texto,
                                                origen: usuarioSesion,
                                                destino: personaS,
                                                usuario1: personaS,
                                                usuario2: usuarioSesion
                                            }
                                            $.post("../rutas/guardarMensajeChat", array)
                                            .done(function( dato ) {
                                            })
                                            $.post("http://190.60.211.17/push/ActionEnviarMensajeChat.php", {idestudiante: personaS, tipoUsuario: tipo})
                                            .done(function( dato ) {
                                              console.log(dato)
                                            })
                                            $( "#textMessage" + persona ).val("")
                                            $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                            '<span class="right">' + texto + '</span>' +
                                            '<div class="clear"></div>' +
                                            '</li>');
                                            $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                                        }
                                    })
                                    
                                })
                            }

                            



                            
                            var estudiantes = $("#" + estudiante).attr("estudiantes")
                            $.post("../rutas/obtenerJSONChatSesion", {})
                            .done(function( dato ) {
                                if($.trim(dato) != ""){
                                  var jsonChats = JSON.parse(dato);console.log(jsonChats)
                                  var con = 0;
                                  for (var i = 0; i < jsonChats.length; i++) {
                                    if(jsonChats[i]){
                                      if(jsonChats[i].usuarioS == usuarioSesion && jsonChats[i].usuarioF == jsonDatos[0].idAcudiente){
                                        con++;
                                      }
                                    }
                                  }
                                  console.log(con)
                                  if(con == 0){
                                    var usuarioSesion = $("#txtUserId").val();
                                    jsonChats[jsonChats.length] = {origen: estudiante, destino: usuarioSesion, usuarioF: jsonDatos[0].idAcudiente, usuarioS: usuarioSesion, tipo:"ACUDIENTE", estudiantes: estudiantes}
                                    $.post("../rutas/guardarJSONChatSesion", {JSONCHAT:JSON.stringify(jsonChats)})
                                    .done(function( result ) {
                                      console.log(result)
                                    });
                                  }
                                }else{
                                  var jsonChats = JSON.parse("[]");
                                  var usuarioSesion = $("#txtUserId").val();
                                  jsonChats[jsonChats.length] = {origen: estudiante, destino: usuarioSesion, usuarioF: jsonDatos[0].idAcudiente, usuarioS: usuarioSesion, tipo:"ACUDIENTE", estudiantes: estudiantes}
                                  $.post("../rutas/guardarJSONChatSesion", {JSONCHAT:JSON.stringify(jsonChats)})
                                  .done(function( result ) {
                                    console.log(result)
                                  });
                                }
                            });
                        }else{
                            var array = $("#" +estudiante).attr("estudiantes").split(",");
                            var estudiantes = $("#" + estudiante).attr("estudiantes")
                            var estado = 0;

                            if(array.length > 0){
                                var arrayDatos;
                                if($("#" + estudiante + " > .panel-heading > span").length > 0){
                                    arrayDatos = $("#" + estudiante + " > .panel-heading > span").html().split(")");
                                }else{
                                    arrayDatos = $("#" + estudiante).html().split(")");
                                }
                                for (var i = 0; i < array.length; i++) {
                                    if(array[i] == jsonDatos[0].idUsuario){
                                        estado = 1;
                                    }
                                }

                                if(estado == 0){
                                    var span = "";
                                    for (var i = 0; i < arrayDatos.length - 1; i++) {
                                        span+= arrayDatos[i];
                                    }
                                    span += " - " + jsonDatos[0].PrimerNombre + ' ' + jsonDatos[0].SegundoNombre + ' ' + jsonDatos[0].PrimerApellido + ' ' + jsonDatos[0].SegundoApellido + ")";
                                    if($("#" + estudiante + " > .panel-heading > span").length > 0){
                                        $("#" + estudiante + " > .panel-heading > span").html(span)
                                    }else{
                                        $("#" + estudiante).html(span)
                                    }
                                    estudiantes += "," + jsonDatos[0].idUsuario;
                                    $("#" + estudiante).attr("estudiantes", estudiantes)

                                    $.post("../rutas/obtenerJSONChatSesion", {})
                                    .done(function( dato ) {
                                        if($.trim(dato) != ""){
                                            var usuarioSesion = $("#txtUserId").val();
                                          var jsonChats = JSON.parse(dato);console.log(jsonChats)
                                          var conValidador = -1;
                                          for (var i = 0; i < jsonChats.length; i++) {
                                            if(jsonChats[i]){
                                              if(jsonChats[i].usuarioS == $("#txtUserId").val() && jsonChats[i].usuarioF == jsonDatos[0].idAcudiente){
                                                conValidador = i;
                                              }
                                            }
                                          }
                                          
                                          console.log(conValidador)
                                          if(conValidador != -1){
                                            var usuarioSesion = $("#txtUserId").val();
                                            jsonChats[conValidador] = {origen: estudiante, destino: usuarioSesion, usuarioF: jsonDatos[0].idAcudiente, usuarioS: usuarioSesion, tipo:"ACUDIENTE", estudiantes: estudiantes}
                                            $.post("../rutas/guardarJSONChatSesion", {JSONCHAT:JSON.stringify(jsonChats)})
                                            .done(function( result ) {
                                              console.log(result)
                                            });
                                          }
                                        }
                                    });
                                }
                            } 
                            //Si existe esa ventana se verifica si es una ventana principal, es decir
                            //es alguna de las dos ventanas que estan visibles, de lo contrario se agrega
                            //como un item del menu de ventanas de chats ocultas
                            if($("#" + estudiante).attr("mode") == "main"){

                                //Se verifica si la ventana esta minimizada o  abierta
                                if($("#" + estudiante).attr("class") == "panel panel-chat mini"){
                                    $("#" + estudiante).removeClass('mini').addClass('normal');
                                    $('#' + estudiante + ' > .panel-body').animate({height: "350px",  scrollTop: $('#' + estudiante + ' > .panel-body')[0].scrollHeight}, 500).show();

                                    $('#' + estudiante + ' > table').show();
                                }
                            }else{
                                //Si la ventana esta oculta se cambia el color de fondo del header
                                //del menu donde esta las ventanas ocultas
                                $('.windowHidden > li > a').css({"background": "orange", "border": "1px solid orange"})
                                $( "#" + estudiante).css({"background": "orange", "border": "1px solid orange"})

                                $(".windowHidden > li > ul > li").click(function(){
                                    var contadorLi = 0;
                                    var idSelect = $(this).attr("id")
                                    var persona = $(this).attr("persona")
                                    var idLast = $('#chats')[0].children[1].id

                                    var spanSelect = $("#" + idSelect).html()
                                    var spanLast = $("#" + idLast + " > .panel-heading > span").html()
                                    var personaLast = $("#" + idLast).attr("persona") 
                                    var personaSelect = $("#" + idSelect).attr("persona") 
                                    var estudiantesLast = $("#" + idLast).attr("estudiantes") 
                                    var estudiantesSelect = $("#" + idSelect).attr("estudiantes")

                                    console.log(personaLast + " " + personaSelect)
                                    $("#" + idSelect).attr("persona", personaLast) 
                                    $("#" + idSelect).attr("estudiantes", estudiantesLast) 
                                    //Se obtiene el numero de chats oculto que tiene alerta de mensajes nuevo
                                    $( ".windowHidden > li > ul > li" ).each(function( index ) {
                                      if($(this).css("background-color") == "rgb(255, 165, 0)"){
                                          contadorLi++;
                                      }
                                      //console.log( index + ": " + hexc($(this).css("background-color")) );
                                      console.log( index + ": " + $(this).css("background-color") );
                                    });
                                    //Cuando hay un solo chat oculto que tiene mensaje nuevo sin leer se
                                    //borra la alerta de mensaje nuevo
                                    //si hay mas de una alerta se mantiene el color de fondo de alerta
                                    if(contadorLi == 1){
                                        $('.windowHidden > li > a').css({"background": "#4b67a8", "border": "1px solid #4b67a8"})
                                        $( "#" + idSelect).css({"background": "none", "border": "none"})
                                    }
                                    //console.log($("#chats > div").length)
                                    $("#" + idLast).remove()
                                    $("#" + idSelect).html(spanLast)

                                    $("#" + idSelect).attr("id", idLast)

                                    //$( ".windowHidden > li > ul" ).find( $("li").css({"background"}) );
                                    
                                    console.log(contadorLi)
                                    
                                    //Agregar el chat oculto como ventana principal
                                    $("#chats").append('<div class="panel panel-chat" style="margin-right:360px;" id="' + idSelect + '" persona="' + personaSelect + '" estudiantes="' + estudiantesSelect + '" mode="main">' +
                                        '<div class="panel-heading" align="center">' +
                                            '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
                                            '<span>' + spanSelect + '</span>' +
                                            '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + idSelect + '" tipo="" personaS="' + personaSelect + '" tipo="ACUDIENTE"><i class="glyphicon glyphicon-remove"></i></a>' +
                                        '</div>' +
                                        '<div class="panel-body">' +
                                            '<br>' +
                                            '<ul>' +
                                            '</ul>' +
                                            '<div class="clear"></div>' +
                                        '</div>' +
                                        '<table width="100%" cellpadding="0" cellpadding="0">' +
                                            '<tr>' +
                                                '<td width="95%"><input name="textMessage' + idSelect + '" id="textMessage' + idSelect + '" cols="0" rows="0" onkeypress="validar(event)" class="form-control" /></td>' +
                                                '<td width="5%"><button data-inline="true" data-mini="true" id="btnEnviar' + idSelect + '" persona="' + idSelect + '" tipo="" personaS="' + personaSelect + '" class="btn btn-primary" tipo="ACUDIENTE" estudiantes="' + estudiantesSelect + '">></button></td>' +
                                            '</tr>' +
                                        '</table>' +
                                    '</div>')
                                    var array = {
                                      usuario1: personaSelect,
                                      usuario2: $("#txtUserId").val()
                                    }
                                    $.post("../rutas/obtenerChatUsuario", array)
                                    .done(function( resul ) {console.log(resul)
                                      var mensajes = JSON.parse(resul);;
                                      if(mensajes.length > 0){
                                        for (var j = 0; j < mensajes.length; j++) {
                                          console.log(mensajes[j].origen + " " + $("#txtUserId").val())
                                            if($("#txtUserId").val() == mensajes[j].origen){
                                                $( "#" + idSelect + " > .panel-body > ul" ).append('<li>' +
                                                    '<span class="right">' + mensajes[j].message + '</span>' +
                                                    '<div class="clear"></div>' +
                                                '</li>');
                                            }else{
                                                $( "#" + idSelect + " > .panel-body > ul" ).append('<li>' +
                                                  '<img src="../../images/bus icono.png" alt=""/>' +
                                                  '<span class="left">' + mensajes[j].message + '</span>' +
                                                  '<div class="clear"></div>' +
                                                '</li>');                                    
                                            }
                                        }
                                      }
                                    })

                                    //Cargar todo el chat con esa persona
                                    /*$( "#" + idSelect + " > .panel-body > ul" ).append('<li>' +
                                        '<img src="../../images/bus icono.png" alt=""/>' +
                                        '<span class="left">Hi</span>' +
                                        '<div class="clear"></div>' +
                                    '</li>');*/
                                    $('#' + idSelect + ' > .panel-body').animate({height: "350px",  scrollTop: $('#' + idSelect + ' > .panel-body')[0].scrollHeight}, 500).show();

                                    //Evento para cuando se da click en el header para
                                    //minimizar la ventana de chat
                                    //Si la ventana esta minimizada se abre
                                    //y sino se minimiza
                                    $("#" + idSelect + " > .panel-heading").click(function(){
                                      var id = $(this).parent().attr("id")
                                      var clases = $("#" + id).attr("class")
                                      console.log(clases)
                                      
                                      switch(clases){
                                        case "panel panel-chat mini":
                                          $("#" + id).removeClass('mini').addClass('normal');
                                          $('#' + id + ' > .panel-body').animate({height: "350px",  scrollTop: $('#' + id + ' > .panel-body')[0].scrollHeight}, 500).show();
                                                  $('#' + id + ' > table').show();
                                          $('#' + id + ' > table').show();
                                          $('#' + id + ' > .panel-heading').css({"background": "#4b67a8", "border": "1px solid #2e4588"})
                                          break;

                                        case "panel panel-chat normal":
                                          $("#" + id).removeClass('normal').addClass('mini');
                                          $('#' + id + ' > .panel-body').animate({height: "0"}, 500);
                                          $('#' + id + ' > table').hide();

                                          break;

                                        case "panel panel-chat":
                                          $("#" + id).removeClass('normal').addClass('mini');
                                          $('#' + id + ' > .panel-body').animate({height: "0"}, 500);
                                          $('#' + id + ' > table').hide();
                                      }
                                      

                                    })

                                    $("#" + idSelect + " > .panel-heading > .chatClose").click(function(){
                                      var persona = $(this).attr("persona")
                                      cerrarVentana(persona)
                                    });

                                    $("#textMessage" + idSelect).keypress(function(e){
                                      var tecla = (document.all) ? e.keyCode : e.which;
                                      var texto = $( this ).val()
                                      if (tecla==13){
                                        var idButton = $(this).parent().parent().parent().parent().parent().attr("id")
                                        var persona = $("#btnEnviar" + idButton).attr("persona")
                                        var personaS = $("#btnEnviar" + idButton).attr("personaS")
                                        var tipo = $("#btnEnviar" + idButton).attr("tipo")
                                        var usuarioSesion = $("#txtUserId").val(); 
                                        if($.trim(texto).length != 0){
                                          socket.emit('send message', {
                                            message: texto, 
                                            origen: persona,
                                            objetivo: usuarioSesion, 
                                            tipo: "CENTRO", 
                                            usuarioF: personaS, 
                                            usuarioS: usuarioSesion
                                          });
                                          var array = {
                                            mensaje: texto,
                                            origen: usuarioSesion,
                                            destino: personaS,
                                            usuario1: personaS,
                                            usuario2: usuarioSesion
                                          }
                                          $.post("../rutas/guardarMensajeChat", array)
                                          .done(function( dato ) {
                                          })
                                          $.post("http://190.60.211.17/push/ActionEnviarMensajeChat.php", {idestudiante: personaS, tipoUsuario: tipo})
                                        .done(function( dato ) {
                                          console.log(dato)
                                        })

                                          $( "#textMessage" + persona ).val("")
                                          $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                                      '<span class="right">' + texto + '</span>' +
                                                      '<div class="clear"></div>' +
                                                  '</li>');
                                          $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                                        }
                                      }
                                    });

                                    //Evento para enviar un mensaje al usuario objetivo
                                    //Se obtienen los datos del chat, se agrega el mensaje al body y 
                                    //se envia el mensaje al usuario objetivo
                                    $("#btnEnviar" + idSelect).click(function(e){
                                      var persona = $(this).attr("persona")
                                      var personaS = $(this).attr("personaS")
                                      var tipo = $(this).attr("tipo")
                                      var texto = $( "#textMessage" + persona).val()
                                      var usuarioSesion = $("#txtUserId").val();
                                      if($.trim(texto).length != 0){
                                          socket.emit('send message', {
                                            message: texto, 
                                            origen: persona,
                                            objetivo: usuarioSesion, 
                                            tipo: "CENTRO", 
                                            usuarioF: personaS, 
                                            usuarioS: usuarioSesion
                                          });
                                            var array = {
                                                mensaje: texto,
                                                origen: usuarioSesion,
                                                destino: personaS,
                                                usuario1: personaS,
                                                usuario2: usuarioSesion
                                            }
                                            $.post("../rutas/guardarMensajeChat", array)
                                            .done(function( dato ) {
                                            })
                                            $.post("http://190.60.211.17/push/ActionEnviarMensajeChat.php", {idestudiante: personaS, tipoUsuario: tipo})
                                            .done(function( dato ) {
                                              console.log(dato)
                                            })
                                          $( "#textMessage" + persona ).val("")
                                          $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                              '<span class="right">' + texto + '</span>' +
                                              '<div class="clear"></div>' +
                                          '</li>');
                                          $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                                      }
                                    })
                                    
                                })
                            }
                        } 
                    }
                });
            
        });
         
    </script>       
</body>
</html>
