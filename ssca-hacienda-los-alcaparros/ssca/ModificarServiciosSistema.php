<?php
//include("response.php");
?>  

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<link rel="stylesheet" href="dist/style.min.css" />
<script src="dist/jstree.min.js"></script>
<link href="dist/menu.css" rel="stylesheet"/>
<link href="css/style.css" rel="stylesheet"/>
<script src="dist/script.js"></script>
<link rel="stylesheet" href="css/screen.css" />
<script type="text/javascript" src="dist/ConexionWebService.js"></script>
<title></title>
<script>
</script>
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
        </style>
</head>
<body>

<body id="bodyBase">
        <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): Nombre Usuario</h4>
        <label style="float:right;margin-right:7%; margin-top:-20px"><font color="#FFFFFF" size="4"><a href="ModificarServiciosSistema.php" style="color:#FFF">Modificaci&oacute;n de Usuarios</a></font></label><label style="float:right; margin-right:20px; margin-top:-20px; color:#FFF">|</label><label style="float:right; margin-right:40px; margin-top:-20px"><font color="#FFFFFF" size="4"><a href="AsignarServiciosSistema.php" style="color:#FFF">Creaci&oacute;n de Usuario</a></font></label>
        <h2 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Modificaci&oacute;n de Usuarios</h2>
        <div id='cssmenu'>
            <ul>
               <li class="active"><a href='#' title="Gestion de Usuarios"><h6><p class="full-circle"></p><span>Gestion de Usuarios</span></h6></a>
                    <ul style="margin-right:-42%">
                         <li><a href='UsuariosdelSistema.html' title="Usuarios del Sistema"><span>Usuarios del Sistema</span></a></li>
                         <li class='last' title="Usuarios Aplicaciones" class="active"><a href='AdminUsuariosAplicaciones.html'><span>Usuarios de Aplicaciones</span></a></li>
                    </ul>
               </li>
               <li class=''><a href='#' title="Gestion Servicios del Sistema"><h6><p class="full-circle"></p><span>Gestion Servicios del Sistema</span></h6></a>
                  <ul style="margin-right:-42%">
                     <li><a href='CrearServiciosSistema.php' title="Servicios del Sistema"><span>Servicios del Sistema</span></a></li>
                     <li class='last'><a href='Reportes.html' title="Reportes"><span>Reportes</span></a></li>
                  </ul>
               </li>
               <li class=''><a href='#' title="Gestion Servicios del Sistema"><h6><p class="full-circle"></p><span>Gestion Servicios Escolares</span></h6></a>
                  <ul style="margin-right:-42%">
                     <li><a href='asignacion.php'><span>Servicios Escolares</span></a></li>
                     <li><a href='PagosCuentaCobro.php'><span>Pago a Terceros</span></a></li>
                     <li class='last'><a href='ReportesServiciosSistema.html'><span>Reportes</span></a></li>
                  </ul>
               </li>
               <li class=''><a href='#' title="Puntos de Recarga"><h6><p class="full-circle"></p><span>Gestion de Credenciales</span></h6></a>
                  <ul style="margin-right:-42%">
                     <li><a href='ReemplazarCredencial.html'><span>Remplazo de Credenciales</span></a></li>
                     <li><a href='ReporteCredencial.html'><span>Reportes</span></a></li>
                  </ul>
               </li>
               <li class=''><a href='#' title="Entrada y Salida de Personal"><h6><p class="full-circle"></p><span>Entrada y Salida de Personal</span></h6></a>
                    <ul style="margin-right:-42%">
                         <li><a href='Estudiantes.html' title="Estudiantes"><span>Estudiantes</span></a></li>
                         <li><a href='FuncionariosInternos.html' title="Funcionarios Internos"><span>Funcionarios Internos</span></a></li>
                    </ul>
               </li>
            </ul>
        </div>
        
        <div class="contenidoBorde">
            <form id="commentForm" method="post" action="#" style="height:100%">
                <table style="padding-left:4%; padding-top:4.5%;padding-right:20px;position:absolute" cellspacing="0" cellpadding="0" width="100%">
                     <td>&nbsp;</td>
                    <tr valign="top">
                        <td align="right"><label for="txtTipoId"><font color="#09C" size="2">Tipo de identificaci&oacute;n</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><input id="txtTipoId" name="txtTipoId" type="text" required/></td>
                        <td align="right"><label for="txtNumeroId"><font color="#09C" size="2">No. de identificaci&oacute;n</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><input id="txtNumeroId" name="txtNumeroId" type="text" required/></td>
                        <td width="12px">&nbsp;</td>
                        <td rowspan="6" align="center" valign="top">
                            <video id="v" width="100px" height="100px"></video><br>
                            <canvas id="c" width="100px" height="100px" style="display:none"></canvas><br>
                            <img src="" id="imageFoto" name="imageFoto" width="100px" height="100px"/>
                            <button id="t" type="button" style="width:80%; border-radius:8px; margin-top:5px" class="btn btn-primary">Tomar foto</button>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <td align="right"><label for="txtPrimerApellido"><font color="#09C" size="2">Primer Apellido</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><input id="txtPrimerApellido" name="txtPrimerApellido" type="text" required/></td>
                        <td align="right"><label for="txtSegundoApellido"><font color="#09C" size="2">Segundo Apellido</font></label></td>
                        <td>&nbsp;</td>
                        <td><input id="txtSegundoApellido" name="txtSegundoApellido" type="text" required/></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr valign="top">
                        <td align="right"><label for="txtPrimerNombre"><font color="#09C" size="2">Primer Nombre</font></label></td>
                        <td>&nbsp;</td>
                        <td><input id="txtPrimerNombre" name="txtPrimerNombre" type="text" required/></td>
                        <td align="right"><label for="txtSegundoNombre"><font color="#09C" size="2">Segundo Nombre</font></label></td>
                        <td>&nbsp;</td>
                        <td><input id="txtSegundoNombre" name="txtSegundoNombre" type="text"/></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr valign="top">
                        <td align="right"><label for="txtTelefono1"><font color="#09C" size="2">Tel&eacute;fono 1</font></label></td>
                        <td>&nbsp;</td>
                        <td><input id="txtTelefono1" name="txtTelefono1" type="text" required/></td>
                        <td align="right"><label for="txtTelefono2"><font color="#09C" size="2">Tel&eacute;fono 2</font></label></td>
                        <td>&nbsp;</td>
                        <td><input id="txtTelefono2" name="txtTelefono2" type="text"/></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr valign="top">
                        <td align="right"><label for="txtUsuario"><font color="#09C" size="2">E-Mail</font></label></td>
                        <td>&nbsp;</td>
                        <td><input id="txtUsuario" name="txtUsuario" type="text" required/></td>
                        <td align="right"><label for="txtPass"><font color="#09C" size="2">Contraseña</font></label></td>
                        <td>&nbsp;</td>
                        <td><input id="txtPass" name="txtPass" type="text" required/></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr valign="top">
                        <td align="right"><label for="direccion"><font color="#09C" size="2">Direccion</font></label></td>
                        <td>&nbsp;</td>
                        <td align="left" colspan="4"><input id="direccion" name="direccion" type="text" required style="border-radius:0px; border:inset"/></td>                        
                    </tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <tr valign="top">
                        <td align="right"><label for="Asignacion de Servicios"><font color="#09C" size="2">Asignacion de Servicios</font></label></td>
                        <td>&nbsp;</td>
                        <td align="left" colspan="4">
                            <div id="tree-container"></div>
                        </td>
                        
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td colspan="4" align="right"><button type="submit" style="width:120px; border-radius:6px; height:30px;background-color:#069;color:#FFF;" name="btnCrearUsuario" id="btnCrearUsuario">Modificar Usuario</button></td>
                        <td>&nbsp;</td>
                        <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="6" height="40px">&nbsp;</td>
                    </tr>
                </table>
            </form> 
        </div>

        <script src="dist/jquery.js"></script>
        <script src="dist/jquery.validate.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
        <script>
            var video = document.querySelector('#v'), canvas = document.querySelector('#c'), btn = document.querySelector('#t'), img = document.querySelector('#imageFoto');
            
            var opcionSeleccionar = "";
            
            
            $.validator.setDefaults({
                submitHandler: function() {
                    //Se obtienen los datos a ingresar
                    var tipoId = $("#txtTipoId").val();
                    var numeroId = $("#txtNumeroId").val();
                    var primerApellido = $("#txtPrimerApellido").val();
                    var segundoApellido = $("#txtSegundoApellido").val();
                    var primerNombre = $("#txtPrimerNombre").val();
                    var segundoNombre = $("#txtSegundoNombre").val();
                    var direccion = $("#direccion").val();
                    var telefono1 = $("#txtTelefono1").val();
                    var telefono2 = $("#txtTelefono2").val();
                    var usuarioIngresado = $("#txtUsuario").val();
                    var clave = $("#txtPass").val();
                    var permisos = $("#tree-container").html();
                    var dataURL = canvas.toDataURL("image/png");
                    
                    permisos = permisos.replace("'", "-=").replace("\"", "_=");
                    prompt("Please enter your name", permisos);
                
                    
                    //Se guardan los datos en un JSON
                    var usuario = {
                        tipoId: tipoId,
                        numeroId: numeroId,
                        primerApellido: primerApellido,
                        segundoApellido: segundoApellido,
                        primerNombre: primerNombre,
                        segundoNombre: segundoNombre,
                        direccion: direccion,
                        telefono1: telefono1,
                        telefono2: telefono2,
                        usuario: usuarioIngresado,
                        clave: clave,
                        imgBase64: dataURL,
                        permisos: permisos
                    }       
                    
                    //Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage
                    //EnviarDatos(usuario, "../ssca/ActionInsertarUsuarios.php", "CREARUSUARIOSISTEMA");
                    EnviarDatos(usuario, "../ssca/ActionModificarUsuarios.php", "MODIFICARUSUARIOS");
                    
                    $("#txtNumeroId").val("");
                    $("#txtPrimerApellido").val("");
                    $("#txtSegundoApellido").val("");
                    $("#txtPrimerNombre").val("");
                    $("#txtSegundoNombre").val("");
                    $("#txtDireccion").val("");
                    $("#txtTelefono1").val("");
                    $("#txtTelefono2").val("");
                    $("#txtUsuario").val("");
                    $("#txtPass").val("");
                    $("#tree-container").val("");
                    
                    
                    
                    //Subir Foto al servidor
                    //EnviarDatos(datos, "ActionUploadFoto.php", "SUBIRFOTO");
                },
                showErrors: function(map, list) {
                    // there's probably a way to simplify this
                    var focussed = document.activeElement;
                    if (focussed && $(focussed).is("input, textarea")) {
                        $(this.currentForm).tooltip("close", {
                            currentTarget: focussed
                        }, true)
                    }
                    this.currentElements.removeAttr("title").removeClass("ui-state-highlight");
                    $.each(list, function(index, error) {
                        $(error.element).attr("title", error.message).addClass("ui-state-highlight");
                    });
                    if (focussed && $(focussed).is("input, textarea")) {
                        $(this.currentForm).tooltip("open", {
                            target: focussed
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
            
                // validate the comment form when it is submitted
                $("#commentForm").validate({
                    rules: {
                        txtTipoId: "required",
                        txtNumeroId: "required",
                        txtPrimerApellido: "required",
                        txtSegundoApellido: "required",
                        txtPrimerNombre: "required",
                        txtTelefono1: "required",
                        direccion: "required",
                        txtUsuario: "required"
                    },
                    messages: {
                        txtTipoId: "Por favor ingrese un tipo de documento de identidad",
                        txtClave: "Por favor ingrese un número de documento de identidad",
                        txtPrimerApellido: "Por favor ingrese un primer apellido",
                        txtSegundoApellido: "Por favor ingrese un segundo apellido",
                        txtPrimerNombre: "Por favor ingrese un primer nombre",
                        txtTelefono1: "Por favor ingrese un número de teléfono",
                        direccion: "Por favor ingrese una dirección",
                        txtUsuario: "Por favor ingrese un nombre de usuario"
                    }
                });
            })();
            
            
            
            
            
            /*
                Descripcion: Tomar una foto con alguna camara que este concetada al equipo
            */
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
                    alert("Por favor usa el explorador opera o google chrome para el funcionamiento optimo del modulo. Gracias.");        
                }
          }
        </script>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){ 
    //fill data to tree  with AJAX call
    $('#tree-container').jstree({
	'plugins': ["wholerow", "checkbox"],
        'core' : {
            'data' : {
                "url" : "response.php",
                "dataType" : "json" // needed only if you do not supply JSON headers
            }
        }
    }) 
});
</script>