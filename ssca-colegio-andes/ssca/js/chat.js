
jQuery(function($){
	var socket = io.connect("http://190.60.211.17:3003");
	//socket = io.connect("http://192.168.1.54:3001");
	var $messageForm = $('#send-message');
	var $messageBox = $('#message');
	var $chat = $('#chat');
	

	socket.on('connect', function() {
		socket.on('new message', function(data){
      var usuarioSesion = $("#txtUserId").val(); 
      console.log(data)
      //Se verifica que el usuario de destino del mensaje es el usuario que inicio sesion
      if(data.usuarioF == usuarioSesion){
        
        //Se verifica que la ventana del chat del usuario que envia el mensaje existe
        if($("#" + data.objetivo).length != 0 ){
          //Si existe esa ventana se verifica si es una ventana principal, es decir
          //es alguna de las dos ventanas que estan visibles, de lo contrario se agrega
          //como un item del menu de ventanas de chats ocultas
          if($("#" + data.objetivo).attr("mode") == "main"){
            //Se verifica si la ventana esta minimizada o  abierta
            if($( "#" + data.objetivo).attr("class") == "panel panel-chat mini"){
              //Si esta minimizada la ventana se muestra un alert cambiando el color de fondo
              //del header, se agrega el mensaje al body de la ventana y se mueve el scroll
              //hasta el final del body de mensajes
              $( '#' + data.objetivo + ' > .panel-heading').css({"background": "orange", "border": "1px solid orange"})
              $( "#" + data.objetivo + " > .panel-body > ul" ).append('<li>' +
                  '<img src="../../images/bus icono.png" alt=""/>' +
                  '<span class="left">' + data.message + '</span>' +
                  '<div class="clear"></div>' +
              '</li>');
              $( '#' + data.objetivo + ' > .panel-body').animate({ scrollTop: $('#' + data.objetivo + ' > .panel-body')[0].scrollHeight}, 1000);
            }else{
              //Si la ventana esta abierta solo se agrega el mensaje al body de la ventana y se mueve el scroll
              //hasta el final del body de mensajes
              $('#' + data.objetivo + ' > .panel-heading').css({"background": "#4b67a8", "border": "1px solid #2e4588"})
              $( "#" + data.objetivo + " > .panel-body > ul" ).append('<li>' +
                  '<img src="../../images/bus icono.png" alt=""/>' +
                  '<span class="left">' + data.message + '</span>' +
                  '<div class="clear"></div>' +
              '</li>');
              $( '#' + data.objetivo + ' > .panel-body').animate({ scrollTop: $('#' + data.objetivo + ' > .panel-body')[0].scrollHeight}, 1000);
            }
          }else{
            //Si la ventana esta oculta se cambia el color de fondo del header
            //del menu donde esta las ventanas ocultas
            $('.windowHidden > li > a').css({"background": "orange", "border": "1px solid orange"})
            $( "#" + data.objetivo).css({"background": "orange", "border": "1px solid orange"})
          }
        }else{
          //Si no existe la ventana del chat se dispone a crear una nueva
          //dependiendo si ya se ocupo el limite de dos ventanas principales o no
          var len = parseInt($("#chats > .panel-chat").length) - 1

          // Se verifica si el numero de ventanas principales diferente a cero,
          //es decir que exista al menos una ventana
          if($("#chats > .panel-chat").length != 0){
            
            
            //Se verifica el tipo de usuario que envia el mensaje con un switch
            switch(data.tipo){
              case "ACUDIENTE":
                  var marginRight;
                  //Cuando es un Acudiente se busca sus datos como usuario 
                  //de aplicacion por su idUsuario
                  $.post("../usuarios_aplicaciones/ObtenerusuarioAplicacion", {usuario: data.usuarioS})
                  .done(function( resultado ) {
                    var jsonDatos = JSON.parse(resultado);
                    if($.trim(resultado) != ""){
                      //Se obtienen los datos de las ventanas de los chats guardados en la session
                      //para guardar los datos del chat en caso de que no exista en la session
                      $.post("../rutas/obtenerJSONChatSesion", {})
                      .done(function( dato ) {
                        if($.trim(dato) != ""){
                          var jsonChats = JSON.parse(dato);console.log(jsonChats)
                          var con = 0;
                          for (var i = 0; i < jsonChats.length; i++) {
                            if(jsonChats[i]){
                              if(jsonChats[i].usuarioF == data.usuarioS && jsonChats[i].usuarioS == data.usuarioF){
                                con++;
                              }
                            }
                          }
                          console.log(con)
                          if(con == 0){
                            var usuarioSesion = $("#txtUserId").val();
                            jsonChats[jsonChats.length] = {origen: data.objetivo, destino: usuarioSesion, usuarioF: data.usuarioS, usuarioS: data.usuarioF, tipo:"ACUDIENTE"}
                            $.post("../rutas/guardarJSONChatSesion", {JSONCHAT:JSON.stringify(jsonChats)})
                            .done(function( result ) {
                              console.log(result)
                            });
                          }
                          
                        }else{
                          var jsonChats = JSON.parse("[]");
                          var usuarioSesion = $("#txtUserId").val();
                          jsonChats[jsonChats.length] = {origen: data.objetivo, destino: usuarioSesion, usuarioF: data.usuarioS, usuarioS: data.usuarioF, tipo:"ACUDIENTE"}
                          $.post("../rutas/guardarJSONChatSesion", {JSONCHAT:JSON.stringify(jsonChats)})
                          .done(function( result ) {
                            console.log(result)
                          });
                        }
                      });

                      ///Se verifica la cantidad de ventanas principales existentes
                      //para marcar el margin-right de la ventana en caso de que que sea menor a 2
                      //o cuando es igual o mayor a 2 se agrega en el menu de chats ocultos
                      if($("#chats > div").length < 2){
                        switch($("#chats > div").length){
                          case 0:
                            marginRight = 0;
                            break;
                          case 1:
                            marginRight = 360;
                            break;
                        }

                        //En caso de que el numero de ventanas principales es menor a 2
                        //se agrega la nueva ventana y el margin-right se agrega dependiendo del 
                        //resultado en el switch
                        $("#chats").append('<div class="panel panel-chat" style="margin-right:' + marginRight + 'px" id="' + data.objetivo + '" persona="' + data.usuarioS + '" mode="main">' +
                          '<div class="panel-heading" align="center">' +
                              '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
                              '<span>ACUDIENTE (' + jsonDatos[0].PrimerNombre + ' ' + jsonDatos[0].SegundoNombre + ' ' + jsonDatos[0].PrimerApellido + ' ' + jsonDatos[0].SegundoApellido + ')</span>' +
                              '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + data.objetivo + '" personaS="' + data.usuarioS + '"><i class="glyphicon glyphicon-remove"></i></a>' +
                          '</div>' +
                          '<div class="panel-body">' +
                              '<br>' +
                              '<ul>' +
                              '</ul>' +
                              '<div class="clear"></div>' +
                          '</div>' +
                          '<table width="100%" cellpadding="0" cellpadding="0">' +
                              '<tr>' +
                                  '<td width="95%"><input name="textMessage' + data.objetivo + '" id="textMessage' + data.objetivo + '" cols="0" rows="0" onkeypress="validar(event)" class="form-control" /></td>' +
                                  '<td width="5%"><button type="button" data-inline="true" data-mini="true" id="btnEnviar' + data.objetivo + '" persona="' + data.objetivo + '" personaS="' + data.usuarioS + '" class="btn btn-primary">></button></td>' +
                              '</tr>' +
                          '</table>' +
                        '</div>')

                        console.log($( "#" + data.objetivo).attr("class"))

                        //Se agrega el mensaje nuevo en el body de mensajes del chat
                        //y se mueve el scroll hacia el ultimo mensaje
                        $( "#" + data.objetivo + " > .panel-body > ul" ).append('<li>' +
                          '<img src="../../images/bus icono.png" alt=""/>' +
                          '<span class="left">' + data.message + '</span>' +
                          '<div class="clear"></div>' +
                        '</li>');
                        $( '#' + data.objetivo + ' > .panel-body').animate({ scrollTop: $('#' + data.objetivo + ' > .panel-body')[0].scrollHeight}, 1000);

                        //Evento para cerrar la ventana del chat.
                        //Cuando se cierra una ventana, los datos de ese chat se borran de la session
                        $("#" + data.objetivo + " > .panel-heading > .chatClose").click(function(){
                          var persona = $(this).attr("persona")
                          cerrarVentana(persona)
                        });

                        //Evento para cuando se da click en el header para
                        //minimizar la ventana de chat
                        //Si la ventana esta minimizada se abre
                        //y sino se minimiza
                        $("#" + data.objetivo + " > .panel-heading").click(function(){
                          var id = $(this).parent().attr("id")
                          var clases = $("#" + id).attr("class")
                          console.log(clases)

                          switch(clases){
                            case "panel panel-chat mini":
                              $("#" + id).removeClass('mini').addClass('normal');
                              $('#' + id + ' > .panel-body').animate({height: "350px", scrollTop: $('#' + id + ' > .panel-body')[0].scrollHeight}, 500).show();
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
                          

                        });

                        //Evento para enviar un mensaje al usuario objetivo
                        //Se obtienen los datos del chat, se agrega el mensaje al body y 
                        //se envia el mensaje al usuario objetivo
                        $("#btnEnviar" + data.objetivo).click(function(e){
                          var persona = $(this).attr("persona")
                          var personaS = $(this).attr("personaS")
                          var texto = $( "#textMessage" + persona).val()
                          var usuarioSesion = $("#txtUserId").val();
                          
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
                          $( "#textMessage" + persona ).val("")
                          $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                              '<span class="right">' + texto + '</span>' +
                              '<div class="clear"></div>' +
                          '</li>');
                          $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                        })
                        $("#textMessage" + data.objetivo).keypress(function(e){
                          tecla = (document.all) ? e.keyCode : e.which;
                          var texto = $( this ).val()
                          if (tecla==13){
                            var idButton = $(this).parent().parent().parent().parent().parent().attr("id")
                            var persona = $("#btnEnviar" + idButton).attr("persona")
                            var personaS = $("#btnEnviar" + idButton).attr("personaS")
                            var tipo = $("#btnEnviar" + idButton).attr("tipo")
                            var usuarioSesion = $("#txtUserId").val(); 
                            
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

                            $( "#textMessage" + persona ).val("")
                            $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                        '<span class="right">' + texto + '</span>' +
                                        '<div class="clear"></div>' +
                                    '</li>');
                            $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                          }
                        });
                        $(".windowHidden").css({"display":"none"})
                      }else{
                        //Cuando ya hay 2 ventanas principales
                        //se agrega un item al menu de chats ocultos y se cambia el color
                        //de fondo para indicar un nuevo mensaje
                        $( ".windowHidden > li > ul" ).append('<li id="' + data.objetivo + '" mode="hidden" persona="' + data.usuarioS + '">ACUDIENTE (' + jsonDatos[0].PrimerNombre + ' ' + jsonDatos[0].SegundoNombre + ' ' + jsonDatos[0].PrimerApellido + ' ' + jsonDatos[0].SegundoApellido + ')</li>'); 
                        $('.windowHidden > li > a').css({"background": "orange", "border": "1px solid orange"})
                        $( "#" + data.objetivo).css({"background": "orange", "border": "1px solid orange"})

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

                          console.log(personaLast + " " + personaSelect)
                          $("#" + idSelect).attr("persona", personaLast) 
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
                          $("#chats").append('<div class="panel panel-chat" style="margin-right:360px;" id="' + idSelect + '" persona="' + personaSelect + '" mode="main">' +
                              '<div class="panel-heading" align="center">' +
                                  '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
                                  '<span>' + spanSelect + '</span>' +
                                  '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + idSelect + '" tipo="" personaS="' + personaSelect + '"><i class="glyphicon glyphicon-remove"></i></a>' +
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
                                      '<td width="5%"><button data-inline="true" data-mini="true" id="btnEnviar' + idSelect + '" persona="' + idSelect + '" tipo="" personaS="' + personaSelect + '" class="btn btn-primary">></button></td>' +
                                  '</tr>' +
                              '</table>' +
                          '</div>')
                          var usuarioSesion = $("#txtUserId").val();
                          var array = {
                              usuario1: idSelect,
                              usuario2: usuarioSesion
                          }
                          $.post("../rutas/obtenerChatUsuario", array)
                          .done(function( resul ) {
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
                          $('#' + idSelect + ' > .panel-body').animate({ scrollTop: $('#' + idSelect + ' > .panel-body')[0].scrollHeight}, 1000);

                          //Cargar todo el chat con esa persona
                          /*$( "#" + idSelect + " > .panel-body > ul" ).append('<li>' +
                              '<img src="../../images/bus icono.png" alt=""/>' +
                              '<span class="left">Hi</span>' +
                              '<div class="clear"></div>' +
                          '</li>');*/
                          $( '#' + idSelect + ' > .panel-body').animate({ scrollTop: $('#' + idSelect + ' > .panel-body')[0].scrollHeight}, 1000);

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
                                $('#' + id + ' > .panel-body').animate({height: "350px", scrollTop: $('#' + id + ' > .panel-body')[0].scrollHeight}, 500).show();
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

                          //Evento para enviar un mensaje al usuario objetivo
                          //Se obtienen los datos del chat, se agrega el mensaje al body y 
                          //se envia el mensaje al usuario objetivo
                          $("#btnEnviar" + idSelect).click(function(e){
                            var persona = $(this).attr("persona")
                            var personaS = $(this).attr("personaS")
                            var texto = $( "#textMessage" + persona).val()
                            var usuarioSesion = $("#txtUserId").val();
                            
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
                            $( "#textMessage" + persona ).val("")
                            $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                '<span class="right">' + texto + '</span>' +
                                '<div class="clear"></div>' +
                            '</li>');
                            $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                          })
                          $("#textMessage" + idSelect).keypress(function(e){
                            tecla = (document.all) ? e.keyCode : e.which;
                            var texto = $( this ).val()
                            if (tecla==13){
                              var idButton = $(this).parent().parent().parent().parent().parent().attr("id")
                              var persona = $("#btnEnviar" + idButton).attr("persona")
                              var personaS = $("#btnEnviar" + idButton).attr("personaS")
                              var tipo = $("#btnEnviar" + idButton).attr("tipo")
                              var usuarioSesion = $("#txtUserId").val(); 
                              
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

                              $( "#textMessage" + persona ).val("")
                              $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                          '<span class="right">' + texto + '</span>' +
                                          '<div class="clear"></div>' +
                                      '</li>');
                              $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                            }
                          });
                          
                        })
                      } 
                    }
                  })
                break;

              case "MONITOR":
                var marginRight;
                //Cuando es un Acudiente se busca sus datos como usuario 
                //de aplicacion por su idUsuario
                $.post("../usuarios_aplicaciones/ConsultarUsuario", {usuario: data.usuarioS})
                .done(function( resultado ) {
                  var jsonDatos = JSON.parse(resultado);
                  if($.trim(resultado) != ""){
                    //Se obtienen los datos de las ventanas de los chats guardados en la session
                    //para guardar los datos del chat en caso de que no exista en la session
                    $.post("../rutas/obtenerJSONChatSesion", {})
                    .done(function( dato ) {
                      if($.trim(dato) != ""){
                        var jsonChats = JSON.parse(dato);console.log(jsonChats)
                        var con = 0;
                        for (var i = 0; i < jsonChats.length; i++) {
                          if(jsonChats[i]){
                            if(jsonChats[i].usuarioF == data.usuarioS && jsonChats[i].usuarioS == data.usuarioF){
                              con++;
                            }
                          }
                        }
                        console.log(con)
                        if(con == 0){
                          var usuarioSesion = $("#txtUserId").val();
                          jsonChats[jsonChats.length] = {origen: data.objetivo, destino: usuarioSesion, usuarioF: data.usuarioS, usuarioS: data.usuarioF, tipo:"MONITOR"}
                          $.post("../rutas/guardarJSONChatSesion", {JSONCHAT:JSON.stringify(jsonChats)})
                          .done(function( result ) {
                            console.log(result)
                          });
                        }
                        
                      }else{
                        var jsonChats = JSON.parse("[]");
                        var usuarioSesion = $("#txtUserId").val();
                        jsonChats[jsonChats.length] = {origen: data.objetivo, destino: usuarioSesion, usuarioF: data.usuarioS, usuarioS: data.usuarioF, tipo:"MONITOR"}
                        $.post("../rutas/guardarJSONChatSesion", {JSONCHAT:JSON.stringify(jsonChats)})
                        .done(function( result ) {
                          console.log(result)
                        });
                      }
                    });

                    ///Se verifica la cantidad de ventanas principales existentes
                    //para marcar el margin-right de la ventana en caso de que que sea menor a 2
                    //o cuando es igual o mayor a 2 se agrega en el menu de chats ocultos
                    if($("#chats > div").length < 2){
                      switch($("#chats > div").length){
                        case 0:
                          marginRight = 0;
                          break;
                        case 1:
                          marginRight = 360;
                          break;
                      }

                      //En caso de que el numero de ventanas principales es menor a 2
                      //se agrega la nueva ventana y el margin-right se agrega dependiendo del 
                      //resultado en el switch
                      $("#chats").append('<div class="panel panel-chat" style="margin-right:' + marginRight + 'px" id="' + data.objetivo + '" persona="' + data.usuarioS + '" mode="main">' +
                        '<div class="panel-heading" align="center">' +
                            '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
                            '<span>MONITOR RUTA ESCOLAR (' + jsonDatos[0].PrimerNombre + ' ' + jsonDatos[0].SegundoNombre + ' ' + jsonDatos[0].PrimerApellido + ' ' + jsonDatos[0].SegundoApellido + ')</span>' +
                            '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + data.objetivo + '" personaS="' + data.usuarioS + '"><i class="glyphicon glyphicon-remove"></i></a>' +
                        '</div>' +
                        '<div class="panel-body">' +
                            '<br>' +
                            '<ul>' +
                            '</ul>' +
                            '<div class="clear"></div>' +
                        '</div>' +
                        '<table width="100%" cellpadding="0" cellpadding="0">' +
                            '<tr>' +
                                '<td width="95%"><input name="textMessage' + data.objetivo + '" id="textMessage' + data.objetivo + '" cols="0" rows="0" onkeypress="validar(event)" class="form-control" /></td>' +
                                '<td width="5%"><button type="button" data-inline="true" data-mini="true" id="btnEnviar' + data.objetivo + '" persona="' + data.objetivo + '" personaS="' + data.usuarioS + '" class="btn btn-primary">></button></td>' +
                            '</tr>' +
                        '</table>' +
                      '</div>')

                      console.log($( "#" + data.objetivo).attr("class"))

                      //Se agrega el mensaje nuevo en el body de mensajes del chat
                      //y se mueve el scroll hacia el ultimo mensaje
                      $( "#" + data.objetivo + " > .panel-body > ul" ).append('<li>' +
                        '<img src="../../images/bus icono.png" alt=""/>' +
                        '<span class="left">' + data.message + '</span>' +
                        '<div class="clear"></div>' +
                      '</li>');
                      $( '#' + data.objetivo + ' > .panel-body').animate({ scrollTop: $('#' + data.objetivo + ' > .panel-body')[0].scrollHeight}, 1000);

                      //Evento para cerrar la ventana del chat.
                      //Cuando se cierra una ventana, los datos de ese chat se borran de la session
                      $("#" + data.objetivo + " > .panel-heading > .chatClose").click(function(){
                        var persona = $(this).attr("persona")
                        cerrarVentana(persona)                       
                      }); 

                      //Evento para cuando se da click en el header para
                      //minimizar la ventana de chat
                      //Si la ventana esta minimizada se abre
                      //y sino se minimiza
                      $("#" + data.objetivo + " > .panel-heading").click(function(){
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
                        

                      });

                      //Evento para enviar un mensaje al usuario objetivo
                      //Se obtienen los datos del chat, se agrega el mensaje al body y 
                      //se envia el mensaje al usuario objetivo
                      $("#btnEnviar" + data.objetivo).click(function(e){
                        var persona = $(this).attr("persona")
                        var personaS = $(this).attr("personaS")
                        var texto = $( "#textMessage" + persona).val()
                        var usuarioSesion = $("#txtUserId").val();
                        
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
                        $( "#textMessage" + persona ).val("")
                        $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                            '<span class="right">' + texto + '</span>' +
                            '<div class="clear"></div>' +
                        '</li>');
                        $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                      })
                      $("#textMessage" + data.objetivo).keypress(function(e){
                        tecla = (document.all) ? e.keyCode : e.which;
                        var texto = $( this ).val()
                        if (tecla==13){
                          var idButton = $(this).parent().parent().parent().parent().parent().attr("id")
                          var persona = $("#btnEnviar" + idButton).attr("persona")
                          var personaS = $("#btnEnviar" + idButton).attr("personaS")
                          var tipo = $("#btnEnviar" + idButton).attr("tipo")
                          var usuarioSesion = $("#txtUserId").val(); 
                          
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

                          $( "#textMessage" + persona ).val("")
                          $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                      '<span class="right">' + texto + '</span>' +
                                      '<div class="clear"></div>' +
                                  '</li>');
                          $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                        }
                      });
                      $(".windowHidden").css({"display":"none"})
                    }else{
                      //Cuando ya hay 2 ventanas principales
                      //se agrega un item al menu de chats ocultos y se cambia el color
                      //de fondo para indicar un nuevo mensaje
                      $( ".windowHidden > li > ul" ).append('<li id="' + data.objetivo + '" mode="hidden" persona="' + data.usuarioS + '">MONITOR RUTA ESCOLAR (' + jsonDatos[0].PrimerNombre + ' ' + jsonDatos[0].SegundoNombre + ' ' + jsonDatos[0].PrimerApellido + ' ' + jsonDatos[0].SegundoApellido + ')</li>'); 
                      $('.windowHidden > li > a').css({"background": "orange", "border": "1px solid orange"})
                      $( "#" + data.objetivo).css({"background": "orange", "border": "1px solid orange"})

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

                        console.log(personaLast + " " + personaSelect)
                        $("#" + idSelect).attr("persona", personaLast) 
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
                        $("#chats").append('<div class="panel panel-chat" style="margin-right:360px;" id="' + idSelect + '" persona="' + personaSelect + '" mode="main">' +
                            '<div class="panel-heading" align="center">' +
                                '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
                                '<span>' + spanSelect + '</span>' +
                                '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + idSelect + '" tipo="" personaS="' + persona + '"><i class="glyphicon glyphicon-remove"></i></a>' +
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
                                    '<td width="5%"><button data-inline="true" data-mini="true" id="btnEnviar' + idSelect + '" persona="' + idSelect + '" tipo="" personaS="' + persona + '" class="btn btn-primary">></button></td>' +
                                '</tr>' +
                            '</table>' +
                        '</div>')

                        var usuarioSesion = $("#txtUserId").val();
                        var array = {
                            usuario1: idSelect,
                            usuario2: usuarioSesion
                        }
                        $.post("../rutas/obtenerChatUsuario", array)
                        .done(function( resul ) {
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
                        $('#' + idSelect + ' > .panel-body').animate({ scrollTop: $('#' + idSelect + ' > .panel-body')[0].scrollHeight}, 1000);

                        //Cargar todo el chat con esa persona
                        /*$( "#" + idSelect + " > .panel-body > ul" ).append('<li>' +
                            '<img src="../../images/bus icono.png" alt=""/>' +
                            '<span class="left">Hi</span>' +
                            '<div class="clear"></div>' +
                        '</li>');*/
                        $( '#' + idSelect + ' > .panel-body').animate({ scrollTop: $('#' + idSelect + ' > .panel-body')[0].scrollHeight}, 1000);

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
                              $('#' + id + ' > .panel-body').animate({height: "350px", scrollTop: $('#' + id + ' > .panel-body')[0].scrollHeight}, 500).show();
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

                        //Evento para enviar un mensaje al usuario objetivo
                        //Se obtienen los datos del chat, se agrega el mensaje al body y 
                        //se envia el mensaje al usuario objetivo
                        $("#btnEnviar" + idSelect).click(function(e){
                          var persona = $(this).attr("persona")
                          var personaS = $(this).attr("personaS")
                          var texto = $( "#textMessage" + persona).val()
                          var usuarioSesion = $("#txtUserId").val();
                          
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
                          $( "#textMessage" + persona ).val("")
                          $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                              '<span class="right">' + texto + '</span>' +
                              '<div class="clear"></div>' +
                          '</li>');
                          $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                        })
                        
                        $("#textMessage" + idSelect).keypress(function(e){
                          tecla = (document.all) ? e.keyCode : e.which;
                          var texto = $( this ).val()
                          if (tecla==13){
                            var idButton = $(this).parent().parent().parent().parent().parent().attr("id")
                            var persona = $("#btnEnviar" + idButton).attr("persona")
                            var personaS = $("#btnEnviar" + idButton).attr("personaS")
                            var tipo = $("#btnEnviar" + idButton).attr("tipo")
                            var usuarioSesion = $("#txtUserId").val(); 
                            
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

                            $( "#textMessage" + persona ).val("")
                            $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                        '<span class="right">' + texto + '</span>' +
                                        '<div class="clear"></div>' +
                                    '</li>');
                            $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                          }
                        });
                      })
                    } 
                  }
                })
              break;              
            }

            
          }else{
            switch(data.tipo){
              case "ACUDIENTE":
                  $.post("../usuarios_aplicaciones/ObtenerusuarioAplicacion", {usuario: data.usuarioS})
                  .done(function( resultado ) {
                    var jsonDatos = JSON.parse(resultado);
                    if($.trim(resultado) != ""){
                      
                      $.post("../rutas/obtenerJSONChatSesion", {})
                      .done(function( dato ) {
                        if($.trim(dato) != ""){
                          var jsonChats = JSON.parse(dato);console.log(jsonChats)
                          var con = 0;
                          for (var i = 0; i < jsonChats.length; i++) {
                            if(jsonChats[i]){
                              if(jsonChats[i].usuarioF == data.usuarioS && jsonChats[i].usuarioS == data.usuarioF){
                                con++;
                              }
                            }
                          }
                          console.log(con)
                          if(con == 0){
                            var usuarioSesion = $("#txtUserId").val();
                            jsonChats[jsonChats.length] = {origen: data.objetivo, destino: usuarioSesion, usuarioF: data.usuarioS, usuarioS: data.usuarioF, tipo:"ACUDIENTE"}
                            $.post("../rutas/guardarJSONChatSesion", {JSONCHAT:JSON.stringify(jsonChats)})
                            .done(function( result ) {
                              console.log(result)
                            });
                          }
                        }else{
                          var jsonChats = JSON.parse("[]");
                          var usuarioSesion = $("#txtUserId").val();
                          jsonChats[jsonChats.length] = {origen: data.objetivo, destino: usuarioSesion, usuarioF: data.usuarioS, usuarioS: data.usuarioF, tipo:"ACUDIENTE"}
                          $.post("../rutas/guardarJSONChatSesion", {JSONCHAT:JSON.stringify(jsonChats)})
                          .done(function( result ) {
                            console.log(result)
                          });
                        }
                      });

                      $("#chats").append('<div class="panel panel-chat" style="margin-right:0px" id="' + data.objetivo + '" persona="' + data.usuarioS + '" mode="main">' +
                        '<div class="panel-heading" align="center">' +
                            '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
                            '<span>ACUDIENTE (' + jsonDatos[0].PrimerNombre + ' ' + jsonDatos[0].SegundoNombre + ' ' + jsonDatos[0].PrimerApellido + ' ' + jsonDatos[0].SegundoApellido + ')</span>' +
                            '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + data.objetivo + '" personaS="' + data.usuarioS + '"><i class="glyphicon glyphicon-remove"></i></a>' +
                        '</div>' +
                        '<div class="panel-body">' +
                            '<br>' +
                            '<ul>' +
                            '</ul>' +
                            '<div class="clear"></div>' +
                        '</div>' +
                        '<table width="100%" cellpadding="0" cellpadding="0">' +
                            '<tr>' +
                                '<td width="95%"><input name="textMessage' + data.objetivo + '" id="textMessage' + data.objetivo + '" cols="0" rows="0" onkeypress="validar(event)" class="form-control" /></td>' +
                                '<td width="5%"><button type="button" data-inline="true" data-mini="true" id="btnEnviar' + data.objetivo + '" persona="' + data.objetivo + '" personaS="' + data.usuarioS + '" class="btn btn-primary">></button></td>' +
                            '</tr>' +
                        '</table>' +
                      '</div>')
                      
                      

                     if($( "#" + data.objetivo).attr("class") == "panel panel-chat mini"){
                        $( '#' + data.objetivo + ' > .panel-heading').css({"background": "orange", "border": "1px solid orange"})
                        $( "#" + data.objetivo + " > .panel-body > ul" ).append('<li>' +
                            '<img src="../../images/bus icono.png" alt=""/>' +
                            '<span class="left">' + data.message + '</span>' +
                            '<div class="clear"></div>' +
                        '</li>');
                        $( '#' + data.objetivo + ' > .panel-body').animate({ scrollTop: $('#' + data.objetivo + ' > .panel-body')[0].scrollHeight}, 1000);
                      }else{
                        $('#' + data.objetivo + ' > .panel-heading').css({"background": "#4b67a8", "border": "1px solid #2e4588"})
                        $( "#" + data.objetivo + " > .panel-body > ul" ).append('<li>' +
                            '<img src="../../images/bus icono.png" alt=""/>' +
                            '<span class="left">' + data.message + '</span>' +
                            '<div class="clear"></div>' +
                        '</li>');
                        $( '#' + data.objetivo + ' > .panel-body').animate({ scrollTop: $('#' + data.objetivo + ' > .panel-body')[0].scrollHeight}, 1000);
                      }

                      $("#" + data.objetivo + " > .panel-heading > .chatClose").click(function(){
                        var persona = $(this).attr("persona")
                        cerrarVentana(persona)
                      });
                      $("#" + data.objetivo + " > .panel-heading").click(function(){
                        var id = $(this).parent().attr("id")
                        var clases = $("#" + id).attr("class")
                        console.log(clases)

                        switch(clases){
                          case "panel panel-chat mini":
                            console.log("MAL")
                            $("#" + id).removeClass('mini').addClass('normal');
                            $('#' + id + ' > .panel-body').animate({height: "350px", scrollTop: $('#' + id + ' > .panel-body')[0].scrollHeight}, 500).show();
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
                      $("#btnEnviar" + data.objetivo).click(function(e){
                        var persona = $(this).attr("persona")
                        var personaS = $(this).attr("personaS")
                        var texto = $( "#textMessage" + persona).val()
                        var usuarioSesion = $("#txtUserId").val();
                        
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
                        $( "#textMessage" + persona ).val("")
                        $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                            '<span class="right">' + texto + '</span>' +
                            '<div class="clear"></div>' +
                        '</li>');
                        $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                      })

                      $("#textMessage" + data.objetivo).keypress(function(e){
                        tecla = (document.all) ? e.keyCode : e.which;
                        var texto = $( this ).val()
                        if (tecla==13){
                          var idButton = $(this).parent().parent().parent().parent().parent().attr("id")
                          var persona = $("#btnEnviar" + idButton).attr("persona")
                          var personaS = $("#btnEnviar" + idButton).attr("personaS")
                          var tipo = $("#btnEnviar" + idButton).attr("tipo")
                          var usuarioSesion = $("#txtUserId").val(); 
                          
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

                          $( "#textMessage" + persona ).val("")
                          $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                      '<span class="right">' + texto + '</span>' +
                                      '<div class="clear"></div>' +
                                  '</li>');
                          $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                        }
                      });
                    }
                  })
                break;

              case "MONITOR":
                  $.post("../usuarios_aplicaciones/ConsultarUsuario", {usuario: data.usuarioS})
                  .done(function( resultado ) {console.log(resultado)
                    var jsonDatos = JSON.parse(resultado);
                    if($.trim(resultado) != ""){
                      $("#chats").append('<div class="panel panel-chat" style="margin-right:0px" id="' + data.objetivo + '" persona="' + data.usuarioS + '" mode="main">' +
                        '<div class="panel-heading" align="center">' +
                            '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
                            '<span>MONITOR RUTA ESCOLAR (' + jsonDatos[0].PrimerNombre + ' ' + jsonDatos[0].SegundoNombre + ' ' + jsonDatos[0].PrimerApellido + ' ' + jsonDatos[0].SegundoApellido + ')</span>' +
                            '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + data.objetivo + '" personaS="' + data.usuarioS + '"><i class="glyphicon glyphicon-remove"></i></a>' +
                        '</div>' +
                        '<div class="panel-body">' +
                            '<br>' +
                            '<ul>' +
                            '</ul>' +
                            '<div class="clear"></div>' +
                        '</div>' +
                        '<table width="100%" cellpadding="0" cellpadding="0">' +
                            '<tr>' +
                                '<td width="95%"><input name="textMessage' + data.objetivo + '" id="textMessage' + data.objetivo + '" cols="0" rows="0" onkeypress="validar(event)" class="form-control" /></td>' +
                                '<td width="5%"><button type="button" data-inline="true" data-mini="true" id="btnEnviar' + data.objetivo + '" persona="' + data.objetivo + '" personaS="' + data.usuarioS + '" class="btn btn-primary">></button></td>' +
                            '</tr>' +
                        '</table>' +
                      '</div>')
                      $.post("../rutas/obtenerJSONChatSesion", {})
                      .done(function( dato ) {
                        if($.trim(dato) != ""){
                          var jsonChats = JSON.parse(dato);console.log(jsonChats)
                          var con = 0;
                          for (var i = 0; i < jsonChats.length; i++) {
                            if(jsonChats[i]){
                              if(jsonChats[i].usuarioF == data.usuarioS && jsonChats[i].usuarioS == data.usuarioF){
                                con++;
                              }
                            }
                          }
                          console.log(con)
                          if(con == 0){
                            var usuarioSesion = $("#txtUserId").val();
                            jsonChats[jsonChats.length] = {origen: data.objetivo, destino: usuarioSesion, usuarioF: data.usuarioS, usuarioS: data.usuarioF, tipo:"MONITOR"}
                            $.post("../rutas/guardarJSONChatSesion", {JSONCHAT:JSON.stringify(jsonChats)})
                            .done(function( result ) {
                              console.log(result)
                            });
                          }
                          
                        }else{
                          var jsonChats = JSON.parse("[]");
                          var usuarioSesion = $("#txtUserId").val();
                          jsonChats[jsonChats.length] = {origen: data.objetivo, destino: usuarioSesion, usuarioF: data.usuarioS, usuarioS: data.usuarioF, tipo:"MONITOR"}
                          $.post("../rutas/guardarJSONChatSesion", {JSONCHAT:JSON.stringify(jsonChats)})
                          .done(function( result ) {
                            console.log(result)
                          });
                        }
                      });
                      
                      console.log($( "#" + data.objetivo).attr("class"))
                      if($( "#" + data.objetivo).attr("class") == "panel panel-chat mini"){
                        $( '#' + data.objetivo + ' > .panel-heading').css({"background": "orange", "border": "1px solid orange"})
                        $( "#" + data.objetivo + " > .panel-body > ul" ).append('<li>' +
                            '<img src="../../images/bus icono.png" alt=""/>' +
                            '<span class="left">' + data.message + '</span>' +
                            '<div class="clear"></div>' +
                        '</li>');
                        $( '#' + data.objetivo + ' > .panel-body').animate({ scrollTop: $('#' + data.objetivo + ' > .panel-body')[0].scrollHeight}, 1000);
                      }else{
                        $('#' + data.objetivo + ' > .panel-heading').css({"background": "#4b67a8", "border": "1px solid #2e4588"})
                        $( "#" + data.objetivo + " > .panel-body > ul" ).append('<li>' +
                            '<img src="../../images/bus icono.png" alt=""/>' +
                            '<span class="left">' + data.message + '</span>' +
                            '<div class="clear"></div>' +
                        '</li>');
                        $( '#' + data.objetivo + ' > .panel-body').animate({ scrollTop: $('#' + data.objetivo + ' > .panel-body')[0].scrollHeight}, 1000);
                      }
                      

                      $("#" + data.objetivo + " > .panel-heading > .chatClose").click(function(){
                        var persona = $(this).attr("persona")
                        cerrarVentana(persona)
                      });

                      $("#" + data.objetivo + " > .panel-heading").click(function(){
                        var id = $(this).parent().attr("id")
                        var clases = $("#" + id).attr("class")
                        console.log(clases)

                        switch(clases){
                          case "panel panel-chat mini":
                            console.log("MAL")
                            $("#" + id).removeClass('mini').addClass('normal');
                            $('#' + id + ' > .panel-body').animate({height: "350px", scrollTop: $('#' + id + ' > .panel-body')[0].scrollHeight}, 500).show();
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
                      $("#btnEnviar" + data.objetivo).click(function(e){
                        var persona = $(this).attr("persona")
                        var personaS = $(this).attr("personaS")
                        var texto = $( "#textMessage" + persona).val()
                        var usuarioSesion = $("#txtUserId").val();
                        
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
                        $( "#textMessage" + persona ).val("")
                        $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                            '<span class="right">' + texto + '</span>' +
                            '<div class="clear"></div>' +
                        '</li>');
                        $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                      })

                      $("#textMessage" + data.objetivo).keypress(function(e){
                        tecla = (document.all) ? e.keyCode : e.which;
                        var texto = $( this ).val()
                        if (tecla==13){
                          var idButton = $(this).parent().parent().parent().parent().parent().attr("id")
                          var persona = $("#btnEnviar" + idButton).attr("persona")
                          var personaS = $("#btnEnviar" + idButton).attr("personaS")
                          var tipo = $("#btnEnviar" + idButton).attr("tipo")
                          var usuarioSesion = $("#txtUserId").val(); 
                          
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

                          $( "#textMessage" + persona ).val("")
                          $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                      '<span class="right">' + texto + '</span>' +
                                      '<div class="clear"></div>' +
                                  '</li>');
                          $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                        }
                      });
                    }
                  })
                break;              
            }
          }
          

          
            

        }
        
        
      }
      console.log(JSON.stringify(data))
		});
	});
  $(".panel-body").removeAttr("style")

	var screenHeight = $(window).height() / 2;
	var height = (screenHeight) + "px";
	
    $( "#textMessage" ).css({
      "height": "37px",
      "width":"100%"
    });

	$( ".panel-body" ).css({
	  "height": height
	});

});
function validar(e) {
  /*tecla = (document.all) ? e.keyCode : e.which;
  var texto = $( "#textMessage" ).val()
  if (tecla==13){
  	//alert ('Has pulsado enter');
  	$( "#textMessage" ).css({
	  "height": "37px"
	});
	var idMonitorObjetivo = localStorage.getItem("idMonitorObjetivo"); 
  var usuarioSesion = localStorage.getItem("UserAppAcudiente"); 
  //socket.emit('send message', texto);
  socket.emit('send message', {message: texto, objetivo: idMonitorObjetivo, origen: usuarioSesion});
  $( "#textMessage" ).val("")
        $( ".panel-body > ul" ).append('<li>' +
                    '<span class="right">' + texto + '</span>' +
                    '<div class="clear"></div>' +
                '</li>');
        $(".panel-body").animate({ scrollTop: $('.panel-body')[0].scrollHeight}, 1000);
  }*/

}

$("#estudianteChatMonitor").change (function(e) { 
  if($("#estudianteChatMonitor").val() != "Seleccione"){
    var estudiante = $("#estudianteChatMonitor").val();
    $.post("http://190.60.211.17/ssca/fecn.php", {get_option:estudiante})
    .done(function( data ) {console.log(data)
      if($.trim(data) != ""){
        $("#rutaChatMonitor").html(data)
        $("#rutaChatMonitor").selectmenu( "refresh" );
        $("#btnSeleccionarMonitor").css({"display":"block"})
      }else{
        $("#rutaChatMonitor").html("")
        $("#btnSeleccionarMonitor").css({"display":"none"})
      }
      
    }); 
  }else{
    $("#rutaChatMonitor").html("")
    $("#rutaChatMonitor").selectmenu( "refresh" );
    $("#btnSeleccionarMonitor").css({"display":"none"})
  }
});

function cerrarVentana(usuario){
  console.log(usuario)
  var contadorLi = 0;
  var persona = $("#" + usuario + " > .panel-heading > a").attr("persona")
  var personaS = $("#" + usuario + " > .panel-heading > a").attr("personaS")
  var tipo = $("#" + usuario + " > .panel-heading > a").attr("tipo")
  var texto = $( "#textMessage" + persona).val()
  var usuarioSesion = $("#txtUserId").val();

  if($("#chats > div").length == 2){       
    if($(".windowHidden > li > ul > li").length != 0){
      var str = $("#" + usuario)[0].style.marginRight;
      var res = str.split("px");
      var idLast = $('#chats')[0].children[1].id

      if(res[0] == "0"){                                
        $('#' + idLast).animate({"margin-right": "0px"}, 500);
      }

      var idSelect = $('.windowHidden > li > ul')[0].children[0].id
      var personaSelect = $("#" + idSelect).attr("persona")
      var spanSelect = $("#" + idSelect).html() 
      
      
      //Agregar el chat oculto como ventana principal
      $("#chats").append('<div class="panel panel-chat" style="margin-right:360px;" id="' + idSelect + '" persona="' + personaSelect + '" mode="main">' +
          '<div class="panel-heading" align="center">' +
              '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
              '<span>' + spanSelect + '</span>' +
              '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + idSelect + '" tipo="" personaS="' + personaSelect + '"><i class="glyphicon glyphicon-remove"></i></a>' +
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
                  '<td width="5%"><button data-inline="true" data-mini="true" id="btnEnviar' + idSelect + '" persona="' + idSelect + '" tipo="" personaS="' + personaSelect + '" class="btn btn-primary">></button></td>' +
              '</tr>' +
          '</table>' +
      '</div>')
      
      $( '#' + idSelect + ' > .panel-body').animate({ scrollTop: $('#' + idSelect + ' > .panel-body')[0].scrollHeight}, 1000);

      $( ".windowHidden > li > ul > li" ).each(function( index ) {
        if($(this).css("background-color") == "rgb(255, 165, 0)"){
            contadorLi++;
        }
      });
      //Cuando hay un solo chat oculto que tiene mensaje nuevo sin leer se
      //borra la alerta de mensaje nuevo
      //si hay mas de una alerta se mantiene el color de fondo de alerta
      if(contadorLi == 1){
          $('.windowHidden > li > a').css({"background": "#4b67a8", "border": "1px solid #4b67a8"})
          $( "#" + idSelect).css({"background": "none", "border": "none"})
      }
      $("#" + idSelect).remove() 

      if($( ".windowHidden > li > ul > li" ).length == 0){
        $(".windowHidden").css({"display":"none"})
      }
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
            $('#' + id + ' > .panel-body').animate({height: "350px", scrollTop: $('#' + id + ' > .panel-body')[0].scrollHeight}, 500).show();
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

      //Evento para enviar un mensaje al usuario objetivo
      //Se obtienen los datos del chat, se agrega el mensaje al body y 
      //se envia el mensaje al usuario objetivo
      $("#btnEnviar" + idSelect).click(function(e){
        var persona = $(this).attr("persona")
        var personaS = $(this).attr("personaS")
        var texto = $( "#textMessage" + persona).val()
        var usuarioSesion = $("#txtUserId").val();
        
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
        $( "#textMessage" + persona ).val("")
        $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
            '<span class="right">' + texto + '</span>' +
            '<div class="clear"></div>' +
        '</li>');
        $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
      })

      $("#textMessage" + idSelect).keypress(function(e){
        tecla = (document.all) ? e.keyCode : e.which;
        var texto = $( this ).val()
        if (tecla==13){
          var idButton = $(this).parent().parent().parent().parent().parent().attr("id")
          var persona = $("#btnEnviar" + idButton).attr("persona")
          var personaS = $("#btnEnviar" + idButton).attr("personaS")
          var tipo = $("#btnEnviar" + idButton).attr("tipo")
          var usuarioSesion = $("#txtUserId").val(); 
          
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

          $( "#textMessage" + persona ).val("")
          $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                      '<span class="right">' + texto + '</span>' +
                      '<div class="clear"></div>' +
                  '</li>');
          $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
        }
      });
    }else{
      var str = $("#" + usuario)[0].style.marginRight;
      var res = str.split("px");
      var idLast = $('#chats')[0].children[1].id

      if(res[0] == "0"){                                
        $('#' + idLast).animate({"margin-right": "0px"}, 500);
      }
    }                  
    
    
  }else{

  }
  $("#" + usuario).remove();

  $.post("../rutas/obtenerJSONChatSesion", {})
  .done(function( dato ) {
    if($.trim(dato) != ""){
      var jsonChats = JSON.parse(dato);console.log(jsonChats)
      var con = -1;
      for (var i = 0; i < jsonChats.length; i++) {
        if(jsonChats[i]){
          if(jsonChats[i].usuarioF == personaS && jsonChats[i].usuarioS == $("#txtUserId").val()){
            con = i;
          }
        }
      }
      console.log(con + " " + personaS + " " + personaS + " " + $("#txtUserId").val() + " " + $("#txtUserId").val())
      if(con != -1){
        var usuarioSesion = $("#txtUserId").val();
        delete jsonChats[con];
        
        $.post("../rutas/guardarJSONChatSesion", {JSONCHAT:JSON.stringify(jsonChats)})
        .done(function( result ) {
          console.log(result)
          
        });
      }
      
    }
  });
}

window.addEventListener('load',init);
var right = 0;
function init(){
  /*$("#chats").append('<div class="panel panel-chat" style="margin-right:0px" id="0" mode="main" persona="">' +
    '<div class="panel-heading" align="center">' +
        '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
        '<span>ACUDIENTE (1)</span>' +
        '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="" tipo="" personaS=""><i class="glyphicon glyphicon-remove"></i></a>' +
    '</div>' +
    '<div class="panel-body">' +
        '<br>' +
        '<ul>' +
        '</ul>' +
        '<div class="clear"></div>' +
    '</div>' +
    '<table width="100%" cellpadding="0" cellpadding="0">' +
        '<tr>' +
            '<td width="95%"><input name="textMessage" id="textMessage" cols="0" rows="0" onkeypress="validar(event)" class="form-control" /></td>' +
            '<td width="5%"><button data-inline="true" data-mini="true" id="btnEnviar" persona="" tipo="" personaS="" class="btn btn-primary">></button></td>' +
        '</tr>' +
    '</table>' +
  '</div>')

  $("#chats").append('<div class="panel panel-chat" style="margin-right:360px" id="1" mode="main" persona="">' +
    '<div class="panel-heading" align="center">' +
        '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
        '<span>ACUDIENTE (2)</span>' +
        '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="" tipo="" personaS=""><i class="glyphicon glyphicon-remove"></i></a>' +
    '</div>' +
    '<div class="panel-body">' +
        '<br>' +
        '<ul>' +
        '</ul>' +
        '<div class="clear"></div>' +
    '</div>' +
    '<table width="100%" cellpadding="0" cellpadding="0">' +
        '<tr>' +
            '<td width="95%"><input name="textMessage" id="textMessage" cols="0" rows="0" onkeypress="validar(event)" class="form-control" /></td>' +
            '<td width="5%"><button data-inline="true" data-mini="true" id="btnEnviar" persona="" tipo="" personaS="" class="btn btn-primary">></button></td>' +
        '</tr>' +
    '</table>' +
  '</div>')

  /*$("#chats").append('<div class="panel panel-chat" style="margin-right:720px" id="2">' +
      '<div class="panel-heading" align="center">' +
          '<span>&nbsp;</span>' +
          '<a href="#" class="" style="float: right; margin-right: 0; color: #FFF"><i class="fa fa-chevron-up"></i></a>' +
      '</div>' +
  '</div>')*/
  /*$("#2 > .panel-heading").click(function(){
      $('#1').animate({"margin-right": "0px"}, 500).show();
      $('#0').animate({"margin-right": "360px"}, 500).show();

  })

  $(".windowHidden > li > ul > li").click(function(){
  var contadorLi = 0;
  var idSelect = $(this).attr("id")
  var persona = $(this).attr("persona")
  var idLast = $('#chats')[0].children[1].id

  var spanSelect = $("#" + idSelect).html()
  var spanLast = $("#" + idLast + " > .panel-heading > span").html() 

  $( ".windowHidden > li > ul > li" ).each(function( index ) {
      if($(this).css("background-color") == "rgb(255, 165, 0)"){
          contadorLi++;
      }
      //console.log( index + ": " + hexc($(this).css("background-color")) );
      console.log( index + ": " + $(this).css("background-color") );
  });
  if(contadorLi == 1){
      $('.windowHidden > li > a').css({"background": "#4b67a8", "border": "1px solid #4b67a8"})
      $( "#" + idSelect).css({"background": "#fff", "border": "1px solid #fff"})
  }
  //console.log($("#chats > div").length)
  $("#" + idLast).remove()
  $("#" + idSelect).html(spanLast)

  $("#" + idSelect).attr("id", idLast)

  //$( ".windowHidden > li > ul" ).find( $("li").css({"background"}) );
  
  console.log(contadorLi)
  
  
  $("#chats").append('<div class="panel panel-chat" style="margin-right:360px;" id="' + idSelect + '" mode="main">' +
      '<div class="panel-heading" align="center">' +
          '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
          '<span>' + spanSelect + '</span>' +
          '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + idSelect + '" tipo="" personaS="' + persona + '"><i class="glyphicon glyphicon-remove"></i></a>' +
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
              '<td width="5%"><button data-inline="true" data-mini="true" id="btnEnviar' + idSelect + '" persona="' + idSelect + '" tipo="" personaS="' + persona + '" class="btn btn-primary">></button></td>' +
          '</tr>' +
      '</table>' +
  '</div>')

  //Cargar todo el chat con esa persona
  $( "#" + idSelect + " > .panel-body > ul" ).append('<li>' +
      '<img src="../../images/bus icono.png" alt=""/>' +
      '<span class="left">Hi</span>' +
      '<div class="clear"></div>' +
  '</li>');
  $( "#" + idSelect + " > .panel-body").animate({ scrollTop: $('.panel-body')[0].scrollHeight}, 1000);  

  $("#" + idSelect + " > .panel-heading").click(function(){
      var id = $(this).parent().attr("id")
      var clases = $("#" + id).attr("class")
      console.log(clases)
      
      switch(clases){
        case "panel panel-chat mini":
          $("#" + id).removeClass('mini').addClass('normal');
          $('#' + id + ' > .panel-body').animate({height: "350px"}, 500).show();
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

  $("#btnEnviar" + idSelect).click(function(e){
      var persona = $(this).attr("persona")
      var personaS = $(this).attr("personaS")
      var texto = $( "#textMessage" + persona).val()
      var usuarioSesion = $("#txtUserId").val();
      
      socket.emit('send message', {
        message: texto, 
        origen: persona,
        objetivo: usuarioSesion, 
        tipo: "CENTRO", 
        usuarioF: personaS, 
        usuarioS: usuarioSesion
      });
      $( "#textMessage" + persona ).val("")
      $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
          '<span class="right">' + texto + '</span>' +
          '<div class="clear"></div>' +
      '</li>');
      $( "#" + persona + " > .panel-body").animate({ scrollTop: $('.panel-body')[0].scrollHeight}, 1000);
    })
      
  })
  $(".panel-chat > .panel-heading").click(function(){
    var id = $(this).parent().attr("id")
    var clases = $("#" + id).attr("class")
    console.log(clases)
    
    switch(clases){
      case "panel panel-chat mini":
        $("#" + id).removeClass('mini').addClass('normal');
        $('#' + id + ' > .panel-body').animate({height: "350px"}, 500).show();
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
      

  })*/
  
  var socket = io.connect("http://190.60.211.17:3003");
  contador = 0;
  $.post("../rutas/obtenerJSONChatSesion", {})
  .done(function( dato ) {console.log(dato)
    if($.trim(dato) != ""){
      var jsonChats = JSON.parse(dato);
      
      
      for (var i = 0; i < jsonChats.length; i++) {
        if(jsonChats[i]){
          if(jsonChats[i].destino == $("#txtUserId").val()){  
            if(jsonChats[i].tipo){
              switch(jsonChats[i].tipo){
                  case "ACUDIENTE":
                      if(contador == 0){  
                          $("#chats").append('<div class="panel panel-chat" style="margin-right:0px" id="' + jsonChats[i].origen + '" persona="' + jsonChats[i].usuarioF + '" mode="main">' +
                              '<div class="panel-heading" align="center">' +
                                  '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
                                  '<span>ACUDIENTE (' + jsonChats[i].Nombre + ')</span>' +
                                  '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + jsonChats[i].origen + '" tipo="' + jsonChats[i].tipo + '" personaS="' + jsonChats[i].usuarioF + '"><i class="glyphicon glyphicon-remove"></i></a>' +
                              '</div>' +
                              '<div class="panel-body">' +
                                  '<br>' +
                                  '<ul>' +
                                  '</ul>' +
                                  '<div class="clear"></div>' +
                              '</div>' +
                              '<table width="100%" cellpadding="0" cellpadding="0">' +
                                  '<tr>' +
                                      '<td width="95%"><input name="textMessage' + jsonChats[i].origen + '" id="textMessage' + jsonChats[i].origen + '" cols="0" rows="0" class="form-control" /></td>' +
                                      '<td width="5%"><button data-inline="true" data-mini="true" id="btnEnviar' + jsonChats[i].origen + '" persona="' + jsonChats[i].origen + '" tipo="' + jsonChats[i].tipo + '" personaS="' + jsonChats[i].usuarioF + '" class="btn btn-primary">></button></td>' +
                                  '</tr>' +
                              '</table>' +
                          '</div>')
                          var mensajes = jsonChats[i].Mensajes;
                          if(mensajes.length > 0){
                            for (var j = 0; j < mensajes.length; j++) {
                              console.log(mensajes[j].origen + " " + $("#txtUserId").val())
                              if($("#txtUserId").val() == mensajes[j].origen){
                                $( "#" + jsonChats[i].origen + " > .panel-body > ul" ).append('<li>' +
                                    '<span class="right">' + mensajes[j].message + '</span>' +
                                    '<div class="clear"></div>' +
                                '</li>');
                              }else{
                                $( "#" + jsonChats[i].origen + " > .panel-body > ul" ).append('<li>' +
                                  '<img src="../../images/bus icono.png" alt=""/>' +
                                  '<span class="left">' + mensajes[j].message + '</span>' +
                                  '<div class="clear"></div>' +
                                '</li>');                                    
                              }
                            }
                          }
                          
                          $(".windowHidden").css({"display":"none"})
                      }else{
                          if(contador == 1){  
                              $("#chats").append('<div class="panel panel-chat" style="margin-right: 360px" id="' + jsonChats[i].origen + '" id="' + jsonChats[i].origen + '" persona="' + jsonChats[i].usuarioF + '" mode="main">' +
                                  '<div class="panel-heading" align="center">' +
                                      '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
                                      '<span>ACUDIENTE (' + jsonChats[i].Nombre + ')</span>' +
                                      '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + jsonChats[i].origen + '" tipo="' + jsonChats[i].tipo + '" personaS="' + jsonChats[i].usuarioF + '"><i class="glyphicon glyphicon-remove"></i></a>' +
                                  '</div>' +
                                  '<div class="panel-body">' +
                                      '<br>' +
                                      '<ul>' +
                                      '</ul>' +
                                      '<div class="clear"></div>' +
                                  '</div>' +
                                  '<table width="100%" cellpadding="0" cellpadding="0">' +
                                      '<tr>' +
                                          '<td width="95%"><input name="textMessage' + jsonChats[i].origen + '" id="textMessage' + jsonChats[i].origen + '" cols="0" rows="0" onkeypress="validar(event)" class="form-control" /></td>' +
                                          '<td width="5%"><button data-inline="true" data-mini="true" id="btnEnviar' + jsonChats[i].origen + '" persona="' + jsonChats[i].origen + '" tipo="' + jsonChats[i].tipo + '" personaS="' + jsonChats[i].usuarioF + '" class="btn btn-primary">></button></td>' +
                                      '</tr>' +
                                  '</table>' +
                              '</div>')
                              var mensajes = jsonChats[i].Mensajes;
                              if(mensajes.length > 0){
                                for (var j = 0; j < mensajes.length; j++) {
                                  console.log(mensajes[j].origen + " " + $("#txtUserId").val())
                                  if($("#txtUserId").val() == mensajes[j].origen){
                                    $( "#" + jsonChats[i].origen + " > .panel-body > ul" ).append('<li>' +
                                        '<span class="right">' + mensajes[j].message + '</span>' +
                                        '<div class="clear"></div>' +
                                    '</li>');
                                  }else{
                                    $( "#" + jsonChats[i].origen + " > .panel-body > ul" ).append('<li>' +
                                      '<img src="../../images/bus icono.png" alt=""/>' +
                                      '<span class="left">' + mensajes[j].message + '</span>' +
                                      '<div class="clear"></div>' +
                                    '</li>');                                    
                                  }
                                }
                              }
                              $('#' + jsonChats[i].origen + ' > .panel-body').animate({ scrollTop: $('#' + jsonChats[i].origen + ' > .panel-body')[0].scrollHeight}, 1000);
                              $(".windowHidden").css({"display":"none"})
                          }else{
                              $( ".windowHidden > li > ul" ).append('<li id="' + jsonChats[i].origen + '" mode="hidden" persona="' + jsonChats[i].usuarioF + '">ACUDIENTE (' + jsonChats[i].Nombre + ')</li>'); 
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

                                console.log(personaLast + " " + personaSelect)
                                $("#" + idSelect).attr("persona", personaLast) 
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
                                $("#chats").append('<div class="panel panel-chat" style="margin-right:360px;" id="' + idSelect + '" persona="' + personaSelect + '" mode="main">' +
                                    '<div class="panel-heading" align="center">' +
                                        '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
                                        '<span>' + spanSelect + '</span>' +
                                        '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + idSelect + '" tipo="" personaS="' + personaSelect + '"><i class="glyphicon glyphicon-remove"></i></a>' +
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
                                            '<td width="5%"><button data-inline="true" data-mini="true" id="btnEnviar' + idSelect + '" persona="' + idSelect + '" tipo="" personaS="' + personaSelect + '" class="btn btn-primary">></button></td>' +
                                        '</tr>' +
                                    '</table>' +
                                '</div>')
                                var usuarioSesion = $("#txtUserId").val();
                                var array = {
                                    usuario1: idSelect,
                                    usuario2: usuarioSesion
                                }
                                $.post("../rutas/obtenerChatUsuario", array)
                                .done(function( resul ) {alert(resul)
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
                                $('#' + idSelect + ' > .panel-body').animate({ scrollTop: $('#' + idSelect + ' > .panel-body')[0].scrollHeight}, 1000);
                                

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
                                      $('#' + id + ' > .panel-body').animate({height: "350px", scrollTop: $('#' + id + ' > .panel-body')[0].scrollHeight}, 500).show();
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

                                //Evento para enviar un mensaje al usuario objetivo
                                //Se obtienen los datos del chat, se agrega el mensaje al body y 
                                //se envia el mensaje al usuario objetivo
                                $("#btnEnviar" + idSelect).click(function(e){
                                  var persona = $(this).attr("persona")
                                  var personaS = $(this).attr("personaS")
                                  var texto = $( "#textMessage" + persona).val()
                                  var usuarioSesion = $("#txtUserId").val();
                                  
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
                                  $( "#textMessage" + persona ).val("")
                                  $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                      '<span class="right">' + texto + '</span>' +
                                      '<div class="clear"></div>' +
                                  '</li>');
                                  $('#' + persona + ' > .panel-body').animate({scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                                })

                                $("#textMessage" + idSelect).keypress(function(e){
                                  tecla = (document.all) ? e.keyCode : e.which;
                                  var texto = $( this ).val()
                                  if (tecla==13){
                                    var idButton = $(this).parent().parent().parent().parent().parent().attr("id")
                                    var persona = $("#btnEnviar" + idButton).attr("persona")
                                    var personaS = $("#btnEnviar" + idButton).attr("personaS")
                                    var tipo = $("#btnEnviar" + idButton).attr("tipo")
                                    var usuarioSesion = $("#txtUserId").val(); 
                                    
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

                                    $( "#textMessage" + persona ).val("")
                                    $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                                '<span class="right">' + texto + '</span>' +
                                                '<div class="clear"></div>' +
                                            '</li>');
                                    $('#' + persona + ' > .panel-body').animate({scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                                  }
                                });
                                
                              })
                          }
                      }
                  break;

                  case "MONITOR":
                      if(contador == 0){  
                          $("#chats").append('<div class="panel panel-chat" style="margin-right:0px" id="' + jsonChats[i].origen + '" id="' + jsonChats[i].origen + '" persona="' + jsonChats[i].usuarioF + '" mode="main">' +
                              '<div class="panel-heading" align="center">' +
                                  '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
                                  '<span>MONITOR RUTA ESCOLAR (' + jsonChats[i].Nombre + ')</span>' +
                                  '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + jsonChats[i].origen + '" tipo="' + jsonChats[i].tipo + '" personaS="' + jsonChats[i].usuarioF + '"><i class="glyphicon glyphicon-remove"></i></a>' +
                              '</div>' +
                              '<div class="panel-body">' +
                                  '<br>' +
                                  '<ul>' +
                                  '</ul>' +
                                  '<div class="clear"></div>' +
                              '</div>' +
                              '<table width="100%" cellpadding="0" cellpadding="0">' +
                                  '<tr>' +
                                      '<td width="95%"><input name="textMessage' + jsonChats[i].origen + '" id="textMessage' + jsonChats[i].origen + '" cols="0" rows="0" onkeypress="validar(event)" class="form-control" /></td>' +
                                      '<td width="5%"><button data-inline="true" data-mini="true" id="btnEnviar' + jsonChats[i].origen + '" persona="' + jsonChats[i].origen + '" tipo="' + jsonChats[i].tipo + '" personaS="' + jsonChats[i].usuarioF + '" class="btn btn-primary">></button></td>' +
                                  '</tr>' +
                              '</table>' +
                          '</div>')
                          var mensajes = jsonChats[i].Mensajes;
                          if(mensajes.length > 0){
                            for (var j = 0; j < mensajes.length; j++) {
                              console.log(mensajes[j].origen + " " + $("#txtUserId").val())
                              if($("#txtUserId").val() == mensajes[j].origen){
                                $( "#" + jsonChats[i].origen + " > .panel-body > ul" ).append('<li>' +
                                    '<span class="right">' + mensajes[j].message + '</span>' +
                                    '<div class="clear"></div>' +
                                '</li>');
                              }else{
                                $( "#" + jsonChats[i].origen + " > .panel-body > ul" ).append('<li>' +
                                  '<img src="../../images/bus icono.png" alt=""/>' +
                                  '<span class="left">' + mensajes[j].message + '</span>' +
                                  '<div class="clear"></div>' +
                                '</li>');                                    
                              }
                            }
                          }
                          $(".windowHidden").css({"display":"none"})
                      }else{
                          if(contador == 1){  
                              $("#chats").append('<div class="panel panel-chat" style="margin-right: 360px" id="' + jsonChats[i].origen + '" id="' + jsonChats[i].origen + '" persona="' + jsonChats[i].usuarioF + '" mode="main">' +
                                  '<div class="panel-heading" align="center">' +
                                      '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
                                      '<span>MONITOR RUTA ESCOLAR (' + jsonChats[i].Nombre + ')</span>' +
                                      '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + jsonChats[i].origen + '" tipo="' + jsonChats[i].tipo + '" personaS="' + jsonChats[i].usuarioF + '"><i class="glyphicon glyphicon-remove"></i></a>' +
                                  '</div>' +
                                  '<div class="panel-body">' +
                                      '<br>' +
                                      '<ul>' +
                                      '</ul>' +
                                      '<div class="clear"></div>' +
                                  '</div>' +
                                  '<table width="100%" cellpadding="0" cellpadding="0">' +
                                      '<tr>' +
                                          '<td width="95%"><input name="textMessage' + jsonChats[i].origen + '" id="textMessage' + jsonChats[i].origen + '" cols="0" rows="0" onkeypress="validar(event)" class="form-control" /></td>' +
                                          '<td width="5%"><button data-inline="true" data-mini="true" id="btnEnviar' + jsonChats[i].origen + '" persona="' + jsonChats[i].origen + '" tipo="' + jsonChats[i].tipo + '" personaS="' + jsonChats[i].usuarioF + '" class="btn btn-primary">></button></td>' +
                                      '</tr>' +
                                  '</table>' +
                              '</div>')
                              var mensajes = jsonChats[i].Mensajes;
                              if(mensajes.length > 0){
                                for (var j = 0; j < mensajes.length; j++) {
                                  console.log(mensajes[j].origen + " " + $("#txtUserId").val())
                                  if($("#txtUserId").val() == mensajes[j].origen){
                                    $( "#" + jsonChats[i].origen + " > .panel-body > ul" ).append('<li>' +
                                        '<span class="right">' + mensajes[j].message + '</span>' +
                                        '<div class="clear"></div>' +
                                    '</li>');
                                  }else{
                                    $( "#" + jsonChats[i].origen + " > .panel-body > ul" ).append('<li>' +
                                      '<img src="../../images/bus icono.png" alt=""/>' +
                                      '<span class="left">' + mensajes[j].message + '</span>' +
                                      '<div class="clear"></div>' +
                                    '</li>');                                    
                                  }
                                }
                              }
                              $('#' + jsonChats[i].origen + ' > .panel-body').animate({ scrollTop: $('#' + jsonChats[i].origen + ' > .panel-body')[0].scrollHeight}, 1000);
                              $(".windowHidden").css({"display":"none"})
                          }else{
                              $( ".windowHidden > li > ul" ).append('<li id="' + jsonChats[i].origen + '" mode="hidden" persona="' + jsonChats[i].usuarioF + '">MONITOR RUTA ESCOLAR (' + jsonChats[i].Nombre + ')</li>'); 
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

                                console.log(personaLast + " " + personaSelect)
                                $("#" + idSelect).attr("persona", personaLast) 
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
                                $("#chats").append('<div class="panel panel-chat" style="margin-right:360px;" id="' + idSelect + '" persona="' + personaSelect + '" mode="main">' +
                                    '<div class="panel-heading" align="center">' +
                                        '<img src="../../images/circle_green_16_ns.png" style="float: left; margin-left: 0">' +
                                        '<span>' + spanSelect + '</span>' +
                                        '<a href="#" class="chatClose" onclick="return false" style="float: right; margin-right: 0; color: #FFF" persona="' + idSelect + '" tipo="" personaS="' + personaSelect + '"><i class="glyphicon glyphicon-remove"></i></a>' +
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
                                            '<td width="5%"><button data-inline="true" data-mini="true" id="btnEnviar' + idSelect + '" persona="' + idSelect + '" tipo="" personaS="' + personaSelect + '" class="btn btn-primary">></button></td>' +
                                        '</tr>' +
                                    '</table>' +
                                '</div>')

                                var usuarioSesion = $("#txtUserId").val();
                                var array = {
                                    usuario1: idSelect,
                                    usuario2: usuarioSesion
                                }
                                $.post("../rutas/obtenerChatUsuario", array)
                                .done(function( resul ) {alert(resul)
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
                                $('#' + idSelect + ' > .panel-body').animate({scrollTop: $('#' + idSelect + ' > .panel-body')[0].scrollHeight}, 1000);

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
                                      $('#' + id + ' > .panel-body').animate({height: "350px", scrollTop: $('#' + id + ' > .panel-body')[0].scrollHeight}, 500).show();
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

                                //Evento para enviar un mensaje al usuario objetivo
                                //Se obtienen los datos del chat, se agrega el mensaje al body y 
                                //se envia el mensaje al usuario objetivo
                                $("#btnEnviar" + idSelect).click(function(e){
                                  var persona = $(this).attr("persona")
                                  var personaS = $(this).attr("personaS")
                                  var texto = $( "#textMessage" + persona).val()
                                  var usuarioSesion = $("#txtUserId").val();
                                  
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
                                  $( "#textMessage" + persona ).val("")
                                  $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                      '<span class="right">' + texto + '</span>' +
                                      '<div class="clear"></div>' +
                                  '</li>');
                                  $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                                })

                                $("#textMessage" + idSelect).keypress(function(e){
                                  tecla = (document.all) ? e.keyCode : e.which;
                                  var texto = $( this ).val()
                                  if (tecla==13){
                                    var idButton = $(this).parent().parent().parent().parent().parent().attr("id")
                                    var persona = $("#btnEnviar" + idButton).attr("persona")
                                    var personaS = $("#btnEnviar" + idButton).attr("personaS")
                                    var tipo = $("#btnEnviar" + idButton).attr("tipo")
                                    var usuarioSesion = $("#txtUserId").val(); 
                                    
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

                                    $( "#textMessage" + persona ).val("")
                                    $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                                                '<span class="right">' + texto + '</span>' +
                                                '<div class="clear"></div>' +
                                            '</li>');
                                    $( '#' + persona + ' > .panel-body').animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
                                  }
                                });
                                
                              })
                          }
                      }
                  break;
              }
              
            }
          
          contador++;

          $("#" + jsonChats[i].origen + " > .panel-heading > .chatClose").click(function(){
              var persona = $(this).attr("persona")
              cerrarVentana(persona)                        
          });
          $("#" + jsonChats[i].origen + " > .panel-heading").click(function(){
              var id = $(this).parent().attr("id")
              var clases = $("#" + id).attr("class")
              console.log(clases)

              switch(clases){
                case "panel panel-chat mini":
                  $("#" + id).removeClass('mini').addClass('normal');
                  $('#' + id + ' > .panel-body').animate({height: "350px", scrollTop: $('#' + id + ' > .panel-body')[0].scrollHeight}, 500).show();
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
          $("#textMessage" + jsonChats[i].origen).keypress(function(e){
            tecla = (document.all) ? e.keyCode : e.which;
            var texto = $( this ).val()
            if (tecla==13){
              var idButton = $(this).parent().parent().parent().parent().parent().attr("id")
              var persona = $("#btnEnviar" + idButton).attr("persona")
              var personaS = $("#btnEnviar" + idButton).attr("personaS")
              var tipo = $("#btnEnviar" + idButton).attr("tipo")
              var usuarioSesion = $("#txtUserId").val(); 
              
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

              $( "#textMessage" + persona ).val("")
              $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                          '<span class="right">' + texto + '</span>' +
                          '<div class="clear"></div>' +
                      '</li>');
              $( "#" + persona + " > .panel-body").animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
            }
          });
          $("#btnEnviar" + jsonChats[i].origen).click(function(e){
            var persona = $(this).attr("persona")
            var personaS = $(this).attr("personaS")
            var tipo = $(this).attr("tipo")
            var texto = $( "#textMessage" + persona).val()
            var usuarioSesion = $("#txtUserId").val(); 
            
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

            $( "#textMessage" + persona ).val("")
            $( "#" + persona + " > .panel-body > ul" ).append('<li>' +
                        '<span class="right">' + texto + '</span>' +
                        '<div class="clear"></div>' +
                    '</li>');
            $( "#" + persona + " > .panel-body").animate({ scrollTop: $('#' + persona + ' > .panel-body')[0].scrollHeight}, 1000);
          })
        }
      }
      }
      $(".panel-chat").addClass('mini');
      $('.panel-chat > .panel-body').css({height: "0"});
      $('.panel-chat > table').hide();
    }else{
      
    }
  });

} 



