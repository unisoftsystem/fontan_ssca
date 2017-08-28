<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ENVIO DE MENSAJES AL MONITOR</title>
<link rel="stylesheet" href="css/styles.css"/>
<link rel="stylesheet" href="css/styles.css"/>
<link href="css/style.css" rel="stylesheet"/>
<link href="css/menu.css" rel="stylesheet"/>
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/style.js"></script>	
<script type="text/javascript" src="js/ConexionWebService.js"></script>
<script type="text/javascript" src="js/ValidacionUsuario.js"></script>
<link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/alertify.js"></script>
<link rel="stylesheet" href="css/alertify.core.css" />
<link rel="stylesheet" href="css/alertify.default.css" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<script src="js/script.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/photobooth.js"></script>
<style>
          input, select{
        border-radius:8px;
        
        }
  h3 {
        text-shadow: 0px 2px 3px #555;
        }
        </style>
</head>

<body id="bodyBase">
<h5 style="color:#CCC;margin-left:10px; margin-top:5px">Modulo Recargue en Línea</h5>
<h5 align="right" style="color:#000000;margin-left:10px; margin-top:5px">Bienvenido(a): <label id="usuarioSesion"></label></h5>
<h3 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Recargue en Línea</h3>
	<div id='cssmenu'>
            <ul>
               <li class='' style="display:none" id="AdminCredenciales" class="desactive"><a href='#' title="Admin.Credenciales">ADMINISTRACIÓN DE CREDENCIALES</a>
                  <ul style="margin-right:-42%">
                     <li id="ReemplazoCredencial" style="display:none"><a href='ReemplazarCredencial.html' title="Reemplazo de credenciales">Reemplazo de credenciales</a></li>
                     <li class='last'><a href='AdminCredencial.html' title="Cambio de Estado">CAMBIO DE ESTADO</a></li>
                     <li class='last'><a href='ConsultaMovimientosAcudiente.html' title="Consulta de Movimientos">CONSULTA DE MOVIMIENTOS</a></li>
                     <li class='last'><a href='ConsultaSaldo.html' title="Consulta de Saldos">CONSULTA DE SALDOS</a></li>
                     <li class='last'><a href='ServicioProximoRecargaLinea.php' title="Recarga en Linea">RECARGA EN LINEA</a></li>
                     <li class='last'><a href='TrasladoCredencialAcudiente.html' title="Traslado de Fondos entre Credenciales">TRASLADO DE FONDOS ENTRE CREDENCIALES</a></li>
                  </ul>
               </li>
               
               <li class="" id="RutaEscolar" style="display:none" class="desactive"><a href='#' title="Ruta Escolar">RUTA ESCOLAR</a>
                    <ul style="margin-right:-42%">
                        <li><a href='EnvioMensajesMonitor.html' title="Envío de Mensajes">ENVÍO DE MENSAJES</a></li>
                        <li class='last' title="Tracking"><a href="javascript:void(0);" onclick="enviar_variables();">TRACKING</a></li>
                        <li><a href='#' title="Información de la Ruta">INFORMACIÓN DE LA RUTA</a></li>
                    </ul>
               </li>
               <li class="" id="RestriccionConsumo" style="display:none" class="desactive"><a href='#' title="Restricci&oacute;n de Consumo">RESTRICCI&Oacute;N DE CONSUMO</a>
                    <ul style="margin-right:-42%">
                      <li><a href='RestriccionConsumoValor.html' title="Restricciones por Valor">RESTRICCIONES POR VALOR</a></li>
                      <li><a href='RestriccionConsumoProducto.html' title="Restricciones por Producto">RESTRICCIONES POR PRODUCTO</a></li>
                  </ul>
               </li>
                <li class="" id="RestauranteAcudientes" style="display:none" class="desactive">
                  <a href='#' title="Restaurante">RESTAURANTE</a>
                  <ul style="margin-right:-42%">
                    <li>
                      <a href='MenuSemanal.html' title="Menú Semanal"> 
                        MENÚ SEMANAL
                      </a>
                    </li>
                  </ul>
                </li>              
               
                <li class="" id="Modificacion Datos Perfil" style="display:none" class="desactive"><a href='ModificarAcudiente.html' title="Modificacion Datos Perfil">Modificacion Datos Perfil</a>
                    <ul style="margin-right:-42%">    
                    </ul>
                 </li>
               <li class="" id="Salir"><a href='#' title="Cerrar Sesi&oacute;n">CERRAR SESI&Oacute;N</a>
                    <ul style="margin-right:-42%">
                        
                    </ul>
               </li>
            </ul>

          

        </div>
<div class="contenidoBorde" align="center">

<h4>Servicio próximo a ser habilitado</h4>

</div>
<script type="text/javascript">
  
  $("#Salir").click(function(e) {
                localStorage.removeItem("usuario");
        localStorage.removeItem("tipoUsuario");
        window.location.href = "index.html";
            });
  function enviar_variables(){
          var usuarioSesion = localStorage.getItem("usuario");

         location.href="TrackingPadres.php?proced="+ usuarioSesion;

          } 
</script>
<script src="js/jquery.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
</body>
</html>
