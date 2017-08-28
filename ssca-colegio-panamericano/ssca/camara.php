<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
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
</head>

<body>
<h3 align="center">Modificar de Usuarios</h3>
<table align="center">
    <tr>
        <td><label for="txtBuscar">Buscar:</label></td>
        <td><input type="text" name="txtBuscar" id="txtBuscar"/><br><div id="example">
</div><button id="button">Escanear Codigo QR</button></td>  
        <td rowspan="12" valign="top">
            <img src="" id="imageFoto" name="imageFoto" width="128" height="128"/><br>
            <label for="fileFoto"><b>Captura de Fotografia</b></label><br>
            <video id="v" width="128px" height="128px"></video><br>
            <canvas id="c" width="128px" height="128px" style="display:none"></canvas><br>
            <button id="t">Tomar foto</button>  
        </td>        
    </tr>
    <tr>
        <td><label for="txtUsuario">Usuario:</label></td>
        <td><input type="text" name="txtUsuario" id="txtUsuario"/></td>  
    </tr>
    <tr style="display:none">
        <td><label for="txtTipoUsuario">Tipo de Usuario:</label></td>
        <td><input type="text" name="txtTipoUsuario" id="txtTipoUsuario" disabled/></td>        
    </tr>
    <tr>
        <td><label for="txtTipoId">Tipo de identificaci&oacute;n:</label></td>
        <td><select name="txtTipoId" id="txtTipoId">
            <!--<option value="Seleccione">Seleccione...</option>-->
            <option value="Registro Civil">Registro Civil</option>
            <option value="Tarjeta de identidad">Tarjeta de identidad</option>
            <option value="Cedula de ciudadania">C&eacute;dula de ciudadania</option>
        </select></td>        
    </tr>
    <tr>
        <td><label for="txtNumeroId">Numero de identificaci&oacute;n:</label></td>
        <td><input type="text" name="txtNumeroId" id="txtNumeroId"/></td>        
    </tr>
    <tr>
        <td><label for="txtClave">Clave:</label></td>
        <td><input type="password" name="txtClave" id="txtClave"/></td>        
    </tr>
    <tr>
        <td><label for="txtPrimerApellido">Primer Apellido:</label></td>
        <td><input type="text" name="txtPrimerApellido" id="txtPrimerApellido"/></td>        
    </tr>
    <tr>
        <td><label for="txtSegundoApellido">Segundo Apellido:</label></td>
        <td><input type="text" name="txtSegundoApellido" id="txtSegundoApellido"/></td>        
    </tr>
    <tr>
        <td><label for="txtPrimerNombre">Primer Nombre:</label></td>
        <td><input type="text" name="txtPrimerNombre" id="txtPrimerNombre"/></td>        
    </tr>
    <tr>
        <td><label for="txtSegundoNombre">Segundo Nombre:</label></td>
        <td><input type="text" name="txtSegundoNombre" id="txtSegundoNombre"/></td>        
    </tr>
    <tr>
        <td><label for="txtDirección">Direcci&oacute;n:</label></td>
        <td><input type="text" name="txtDirección" id="txtDireccion"/></td>        
    </tr>
    <tr>
        <td><label for="txtTelefono1">Tel&eacute;fono 1:</label></td>
        <td><input type="tel" name="txtTelefono1" id="txtTelefono1"/></td>        
    </tr>
    <tr>
        <td><label for="txtTelefono2">Tel&eacute;fono 2:</label></td>
        <td><input type="tel" name="txtTelefono2" id="txtTelefono2"/></td>        
    </tr>
    <tr style="display:none" id="rowAcudiente">
        <td valign="top"><label for="selectAcudiente">Acudiente asociado:</label></td>
        <td align="right">
            <select name="selectAcudiente" id="selectAcudiente">
 
            </select><br>Si el acudiente no esta registrado pulse <a href="#open" id="open">aqui</a>
        </td>        
    </tr>    
    <tr>
        <td valign="top"><label for="selectAcudiente">Acudiente asociado:</label></td>
        <td><input type="radio" name="radioEstado" id="radioEstadoActivo" value="ACTIVO"/>ACTIVO<br><input type="radio" name="radioEstado" id="radioEstadoInactivo" value="INACTIVO"/>INACTIVO</td>        
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td align="right"><button type="button" name="btnModificarUsuario" id="btnModificarUsuario"><b>GRABAR CAMBIOS </b></button></td>
    </tr>
    
    
</table>

    
   
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
</body>
</html>
