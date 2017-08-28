<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SSCA</title>
        <link href="css/styler.css" rel="stylesheet"/>
        <link href="css/menu.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/style.js"></script>	
        <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
		    <script src="js/script.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/ConexionWebService.js"></script>
        <script type="text/javascript" src="js/popup.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/photobooth.js"></script>
        <script type="text/javascript" src="js/qr/grid.js"></script>
        <script type="text/javascript" src="js/qr/version.js"></script>
        <script type="text/javascript" src="js/qr/detector.js"></script>
        <script type="text/javascript" src="js/qr/formatinf.js"></script>
        <script type="text/javascript" src="js/qr/errorlevel.js"></script>
        <script type="text/javascript" src="js/qr/bitmat.js"></script>
        <script type="text/javascript" src="js/qr/datablock.js"></script>
        <script type="text/javascript" src="js/qr/bmparser.js"></script>
        <script type="text/javascript" src="js/qr/datamask.js"></script>
        <script type="text/javascript" src="js/qr/rsdecoder.js"></script>
        <script type="text/javascript" src="js/qr/gf256poly.js"></script>
        <script type="text/javascript" src="js/qr/gf256.js"></script>
        <script type="text/javascript" src="js/qr/decoder.js"></script>
        <script type="text/javascript" src="js/qr/qrcode.js"></script>
        <script type="text/javascript" src="js/qr/findpat.js"></script>
        <script type="text/javascript" src="js/qr/alignpat.js"></script>
        <script type="text/javascript" src="js/qr/databr.js"></script>
        <script type="text/javascript">
          $(document).ready(function() {

              // for webcam support
              $('#example').photobooth().on("image", function(event, dataUrl) {
                  qrCodeDecoder(dataUrl);
              });
          
              $('#button').click(function() {
                  $('.trigger').trigger('click');
              });
              
              qrcode.callback = showInfo;
          });
          
          // decode the img
          function qrCodeDecoder(dataUrl) {
              qrcode.decode(dataUrl);
          }
          
          // show info from qr code
          function showInfo(data) {
              $("#txtBuscar").val(data);
              EnviarDatos({usuario: data}, "ActionConsultarUsuario.php", "CONSULTARUSUARIO");
              console.log(data);
          }
         
      </script>
    <style type="text/css"> 
    
    #inner{ width: 65%; height: 70%; left:35%; position: relative;  top:50; border-style: groove;} 

    .contenedor{ width: 350px; float: left;}
    .titulo{ font-size: 12pt; font-weight: bold;}
    #camara, #foto{
    width: 320px;
    min-height: 240px;
    border: 1px solid #008000;
    }
    #contenedor {height: 450px;margin:0;position:relative;top:0px;}
    #col_der, #col_izq, #col_cen {height: 100%;}
    #col_der {float: right; width: 50px;top:-200px;}
    #col_izq {float: left; width: 350px;}
    #col_cen {float: left; width: 800px; border-style: groove; }
    }
    </style> 
    
    </head>
    <body id="bodyBase">
      <div id="contenedor">
        <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): Nombre Usuario</h4>
        <h1 align="right" style="margin-top:2%; margin-right:2%; color:#00C; visibility:hidden">Creaci&oacute;n de Usuarios</h1>
        <div id='cssmenu'>
            <ul>
               <li class=""><a href='#' title="Admin.Usuarios"><span>Admin.Usuarios</span></a>
                    <ul style="margin-right:-42%">
                         <li><a href='#' title="Usuarios Plataforma"><span>Usuarios Plataforma</span></a></li>
                         <li class='last' title="Usuarios Aplicaciones"><a href='AdminUsuariosAplicaciones.html'><span>Usuarios Aplicaciones</span></a></li>
          </ul>
               </li>
               <li class=''><a href='#' title="Admin.Credenciales"><span>Admin.Credenciales</span></a>
                  <ul style="margin-right:-42%">
                     <li><a href='#' title="Reemplazo de credenciales"><span>Reemplazo de credenciales</span></a></li>
                     <li class='last'><a href='#' title="Cambio de Estado"><span>Cambio de Estado</span></a></li>
                  </ul>
               </li>
               <li class=''><a href='#' title="Liquidaci&oacute;n y Pagos"><span>Liquidaci&oacute;n y Pagos</span></a>
                  <ul style="margin-right:-42%">
                     <li><a href='#'><span>Liquidaci&oacute;n y Pagos</span></a></li>
                     <li><a href='#'><span>Product 2</span></a></li>
                     <li class='last'><a href='#'><span>Product 3</span></a></li>
                  </ul>
               </li>
               <li class=''><a href='#' title="Puntos de Recarga"><span>Puntos de Recarga</span></a>
                  <ul style="margin-right:-42%">
                     <li><a href='#'><span>Usuarios Aplicaciones</span></a></li>
                     <li><a href='#'><span>Product 2</span></a></li>
                     <li class='last'><a href='#'><span>Product 3</span></a></li>
                  </ul>
               </li>
               <li class=''><a href='#' title="Centro - Operaciones Rutas"><span>Centro - Operaciones Rutas</span></a>
                    <ul style="margin-right:-42%">
                         <li><a href='#' title="Vehiculos"><span>Vehiculos</span></a></li>
                         <li><a href='#' title="Conductores"><span>Conductores</span></a></li>
                         <li><a href='#' title="Monitores"><span>Monitores</span></a></li>
                         <li><a href='#' title="v"><span>Rutas</span></a></li>
                         <li><a href='#' title="Centro de Pagos"><span>Centro de Pagos</span></a></li>
                         <li class='last' title="Tracking"><a href='#'><span>Tracking</span></a></li>
                    </ul>
               </li>
            </ul>
      </div>

      <div id="col_cen">
            <form class="form-inline" action="mensajecrearconductor.php" method="POST">
                <div class="form-group">
                  <label for="TipoIdentificacion">Tipo Identificacion</label>
                  <input type="text" class="form-control" id="TipoIdentificacion" name="TipoIdentificacion" required >
                </div>
                <div class="form-group">
                  <label for="NoIdentificacion">No Identificacion&nbsp;</label>
                  <input type="number" class="form-control" id="NoIdentificacion" name="NoIdentificacion" required>
                </div>
                </br>
                </br>
                <div class="form-group">
                  <label for="PrimerApellido">&nbsp;&nbsp;Primer Apellido&nbsp;&nbsp;&nbsp;</label>
                  <input type="text" class="form-control" id="PrimerApellido" name="PrimerApellido" required>
                </div>
                <div class="form-group">
                  <label for="SegundoApellido">Segundo Apellido</label>
                  <input type="text" class="form-control" id="segundoapeliido" name="segundoapellido" required>
                </div>
                </br>
                </br>
                <div class="form-group">
                  <label for="PrimerNombre">&nbsp;&nbsp;&nbsp;Primer Nombre&nbsp;&nbsp;&nbsp;</label>
                  <input type="text" class="form-control" id="PrimerNombre" name="PrimerNombre" required>
                </div>
                <div class="form-group">
                  <label for="segundonombre">Segundo Nombre&nbsp;</label>
                  <input type="text" class="form-control" id="segundonombre" name="segundonombre" required>
                </div>
                </br>
                </br>
                <div class="form-group">
                  <label for="Telefono1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Telefono 1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                  <input type="number" class="form-control" id="Telefono1" name="Telefono1" required>
                </div>
                <div class="form-group">
                  <label for="Telefono2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Telefono 2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                  <input type="number" class="form-control" id="Telefono2" name="Telefono2" required>
                </div>
                </br>
                </br>
                <div class="form-group">
                  <label for="LicenciaNo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Licencia No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                  <input type="number" class="form-control" id="LicenciaNo" name="LicenciaNo" required>
                </div>
                <div class="form-group">
                  <label for="Email">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                  <input type="email" class="form-control" id="Email" name="Email" required>
                </div>
                </br>
                </br>
                <div class="form-group">
                  <label for="Direccion">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direccion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                  <input type="text" class="form-control" id="Direccion" name="Direccion" required>
                </div>
                </br>
                </br>
                </br>
                </br>
                </br>
                </br>
                <button type="submit" class="btn btn-primary pull-right">Guardar</button>  
                </div>  
                <canvas id="c"  width="128px" height="128px" style="display:none"></canvas>
            </form>
              <img src="" id="imageFoto" name="imageFoto" width="128" height="128"/><br>
              <label for="fileFoto"><b>Captura de Fotografia</b></label><br>
              <video id="v" width="128px" height="128px"></video><br>
              <br>
              <button id="t" class="btn btn-default">Tomar foto</button>

      </div> 
      </div>
       <script type="text/javascript">
    /*
        Fecha:          Octubre 21 de 2015
        Descripcion:    Script para enviar los datos al webservice para que los inserte en la base de datos
    
    */
    
    //Valor guardado cuando se cierra un popup y se concreto una operación
    var opcionSeleccionar = "";
    var video = document.querySelector('#v'), canvas = document.querySelector('#c'), btn = document.querySelector('#t'), img = document.querySelector('#imageFoto');
        
    
    $("#txtBuscar").keyup (function(e) {
        var usuarioConsultar = $("#txtBuscar").val();
        
        //Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage
        EnviarDatos({usuario: usuarioConsultar}, "ActionConsultarUsuario.php", "CONSULTARUSUARIO");
    });
    
    //Verificar si el usuario que se esta escribiendo existe
    $("#txtUsuarioPopup").focusout(function(e) {
        var usuarioExiste = $("#txtUsuarioPopup").val();

        //Se guardan los datos en un JSON
        var datos = {
            usuario: usuarioExiste          
        }       
        
        //Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage
        EnviarDatos({usuario: usuarioExiste}, "ActionExisteUsuario.php", "EXISTEUSUARIO");
    });
    
    window.addEventListener('load',init);
    function init(){
        

        navigator.getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUSerMedia || navigator.msGetUserMedia);

        if(navigator.getUserMedia){
            navigator.getUserMedia({video:true},function(stream){
            video.src = window.URL.createObjectURL(stream);
            video.play();
        },function(e){console.log(e)});
        
        video.addEventListener('loadedmetadata',function(){canvas.width = video.videoWidth, canvas.height = video.videoHeight;},false);
        
        btn.addEventListener('click',function(){
            canvas.getContext('2d').drawImage(video,0,0);
            var imgData = canvas.toDataURL('image/png');
            img.setAttribute('src',imgData);        
        });
        
        }else{
            alert("Actualiza tu navegador");        
        }
  }
    
</script>
        
		<script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>    
    </body>
</html>