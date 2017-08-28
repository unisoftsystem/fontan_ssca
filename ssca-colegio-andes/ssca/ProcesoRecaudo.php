<?php
include("connect.php");
/* Empezamos la sesión */
    session_start();
    /* Creamos la sesión */
    $id =  $_SESSION['userid'];
    /* Si no hay una sesión creada, redireccionar al index. */
    if(empty($_SESSION['userid'])) { // Recuerda usar corchetes.
        header('Location: indexusuariointerno.html');
    } // Recuerda usar corchetes

    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    //sesion a variable
     $_SESSION['userid'] = $id;
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Proceso de Recaudo</title>
<link href="css/style.css" rel="stylesheet"/>
<link href="css/menu.css" rel="stylesheet"/>
<link href="css/popup.css" rel="stylesheet"/>
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/popup.js"></script>
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/style.js"></script>  
<script type="text/javascript" src="js/ConexionWebService.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/ValidacionNumerica.js"></script>
<script src="js/script.js"></script>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/html5-qrcode.min.js"></script>
<script type="text/javascript"> 
  $(document).ready(function(){
    $('#reader').html5_qrcode(function(data){
        //Mostrar resultado de escanear codigo qr
        //$('#read').html(data);
        console.log(data);
        $("#txtUsuario").val(data);
        EnviarDatos({usuario: data}, "ActionConsultarUsuarioPorId.php", "CONSULTARUSUARIOREEMPLAZOC");
        console.log(data);
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
<script type="text/javascript">
function nobackbutton(){
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button" 
   window.onhashchange=function(){window.location.hash="no-back-button";} 
}
</script>
<style>
  input, button{
    border-radius:7px;
  }
  label, select{
    color:#00C;
  }
</style>
</head>

<body id="bodyBase" onload="nobackbutton();">

<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <label id="usuarioSesion" style="color:#CCC"><?php echo $id;?></label></h4>
        <h2 align="right" style="margin-top:2%; margin-right:2%; color:#00C">Proceso de Recaudo</h2>
        <?php
        $query1  = "SELECT * FROM usuarios_sistema where  idUsuario='".$id."'";
        $result1 = mysql_query($query1);

        while($rows = mysql_fetch_array($result1, MYSQL_ASSOC))
        { 
        $permisos = stripslashes($rows['permisos']);
        }
        ?>
		<div id='cssmenu'>
            <ul> 
               <li><a href='#' title="Recaudos"><h6><p class="full-circle"></p><span>Recaudos</span></h6></a>
                    <ul style="margin-right:-42%">
                         <?php
                          $pos = strpos($permisos, "CREAR PAGO INICIAL SERVICIOS");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='asignacionpagoinicial.php' title=\"Pago Inicial de Servicios\"><span>Pago Inicial de Servicios</span></a></li>";
                          }
                          ?> 
                          <?php
                          $pos = strpos($permisos, "CREAR RECAUDO SERVICIOS");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li class='last' title=\"Recaudo de Servicios\" ><a href='RecaudodeServicios.html'><span>Recaudo de Servicios</span></a></li>";
                          }
                          ?> 
                          <?php
                          $pos = strpos($permisos, "CREAR RECARGUE DE CREDENCIALES");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li class='last' title=\"Recargue de Credenciales\" ><a href='ProcesoRecaudo.html'><span>Recargue de Credenciales</span></a></li>";
                          }
                          ?>
                    </ul>
               </li>
               <li class=''><a href='#' title="Reportes"><h6><p class="full-circle"></p><span>Reportes</span></h6></a>
                  <ul style="margin-right:-42%">
                          <?php
                          $pos = strpos($permisos, "REPORTES");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='ReporteRecaudo.php' title=\"Cierre de Caja\"><span>Cierre de Caja</span></a></li>";
                          }
                          ?>
                          <?php
                          $pos = strpos($permisos, "REPORTES");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='Generacionestadosdecuenta.html' title=\"Generacion estados de cuenta\"><span>Generacion estados de cuenta</span></a></li>";
                          }
                          ?>
                  </ul>
               </li>
               <li><a href='#' title="Mensajeria"><h6><p class="full-circle"></p><span>Mensajeria</span></h6></a>
                  <ul style="margin-right:-42%">
                          <?php
                          $pos = strpos($permisos, "COBRO SERVICIOS ESCOLARES");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='Cobrodeserviciosescolaresalosacudientes.html'><span>Cobro de servicios escolares a los acudientes</span></a></li>";
                          }
                          ?>
                  </ul>
               </li>
            </ul>
        </div>
        <div class="contenidoBorde" style="border:0">
           <div class="container-fluid">
          <br/>
              <div class="row">
                  <div class="col-md-8">
                    <div  class="center" id="reader" style="width:100%;height:400px"></div>                     
                  </div>
                  <div class="col-md-4">
                      <input type="text" name="txtUsuario" id="txtUsuario" class="form-control" placeholder="Buscar Usuario" /><br>
                      <label for="txtPrimerApellido">Primer Apellido:</label>
                      <input type="text" name="txtPrimerApellido" id="txtPrimerApellido" disabled class="form-control"/><br>
                      <label for="txtSegundoApellido">Segundo Apellido:</label>
                      <input type="text" name="txtSegundoApellido" id="txtSegundoApellido" disabled class="form-control"/><br>
                      <label for="txtPrimerNombre">Primer Nombre:</label>
                      <input type="text" name="txtPrimerNombre" id="txtPrimerNombre" disabled class="form-control"/><br>
                      <label for="txtSegundoNombre">Segundo Nombre:</label>
                      <input type="hidden" name="txtSaldo" id="txtSaldo" class="form-control"/>
                      <input type="text" name="txtSegundoNombre" id="txtSegundoNombre" disabled class="form-control"/><br>
                      <label for="txtRecarga">Valor de recarga:</label>
                      <input type="text" name="txtRecarga" id="txtRecarga" min="1" onKeyUp="format(this)" class="form-control"/><br>
                      <button type="button" name="btnIngresar" id="btnIngresar" class="btn btn-primary" style="float: right;"><b>Realizar Recarga</b></button>
                  </div>
              </div>
          </div>
            
          <div id="popup" style="display: none;">
                <div class="content-popup">
                  <div class="close"><a href="#" id="close"><img src="images/close.png"/></a></div>
                    <h4 align="rigth">Informaci&oacute;n</h4>
                    <img src="" id="foto" />
                    <div id="Datos"></div>
        </div>                    
      </div>

		    </div>
<script type="text/javascript">
	/*
    Fecha:      Octubre 22 de 2015
    Descripcion:  Script para enviar los datos al webservice para que los inserte en la base de datos
  
  */
  
  //Valor guardado cuando se cierra un popup y se concreto una operación
  var opcionSeleccionar = "";
  $('#close').click(function(){
        $('#popup').fadeOut('slow');
        $('.popup-overlay').fadeOut('slow');
       window.location.href = "ProcesoRecaudo.php";
        return false;
    }); 
  //Capturar evento del boton crear
  $("#btnIngresar").click(function(e) {
    //Se obtienen los datos a enviar    
    var usuarioIngresado = $("#txtUsuario").val();
    var saldo = $("#txtRecarga").val();
    var usuarioSesion = $("#usuarioSesion").html(); 
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
    if(parseInt(vaux) >= 20000){
      var usuario = {
        usuario: usuarioIngresado,
        usuarioSesion: usuarioSesion,
        saldo: saldo,
        fecha: fechaActual,
        hora: horaActual
          }   
      console.log(usuario);
      //Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage
      //EnviarDatos(usuario, "ActionProcesarRecaudo.php", "PROCESARRECAUDO");
      
      $.post("ActionProcesarRecaudo.php", usuario)
      .done(function( data ) {
        console.log($.trim(data));
        
        if($.trim(data) != "[]"){
          //alert("Se proceso con exito el recaudo");
          var json = JSON.parse(data);
          var html = "";
          $.each(json, function(i, item) {

            html+="<h5>" + json[i].primerNombre + " " + json[i].segundoNombre + " " + json[i].primerApellido + " " + json[i].segundoApellido + " " + "</h5><p>Saldo Anterior:" + $("#txtSaldo").val() + " </p><p>Saldo Actual:" + json[i].SaldoCredencial + " </p>";
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
      alert("La recarga debe ser mayor o igual a 20.000")
    }
    
    
    });
  
  /*
    Fecha: 23 de Octubre de 2015
    Descripcion: Evento para capturar la existencia del usuario en la base de datos al quitar el focus del campo de texto de usuario
  */
  $("#txtUsuario").keyup (function(e) {
        var usuarioConsultar = $("#txtUsuario").val();
    
    //Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage
    EnviarDatos({usuario: usuarioConsultar}, "ActionConsultarUsuarioPorId.php", "CONSULTARUSUARIOREEMPLAZOC");
    });
  window.addEventListener('load',init);
  function init(){
    
    
  }
  $("#Salir").click(function(e) {
    localStorage.removeItem("usuario");
    localStorage.removeItem("tipoUsuario");
    window.location.href = "index.html";
  });
</script>
</body>
</html>
