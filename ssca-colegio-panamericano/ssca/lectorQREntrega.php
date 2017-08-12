<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        
        <link href="css/style.css" rel="stylesheet"/>
        <link href="css/menu.css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/style.js"></script>	
        <script type="text/javascript" src="js/ConexionWebService.js"></script>
        <!--<script type="text/javascript" src="js/ValidacionUsuario.js"></script>-->
        <script src="js/script.js"></script>
        <script src="js/jquery-1.9.1.min.js"></script>
    	<script src="js/html5-qrcode.min.js"></script>
        
        <script>
			$(document).ready(function(){
				$('#reader').html5_qrcode(function(data){
						//Mostrar resultado de escanear codigo qr
						//$('#read').html(data);
						EnviarDatos({usuario: data}, "ActionConsultarUsuarioPorCredencial.php", "CONSULTARUSUARIOENTREGA");
						//console.log(data);
						
					},
					function(error){
						//Mostrar error cuando se trata de leer el qr, es Opcional
						//$('#read_error').html(error);
						console.log(error);
					}, function(videoError){
						//Mostrar error en video, es Opcional
						//$('#vid_error').html(videoError);
						console.log(videoError);
					}
				);
			});
        </script>
        <title>SSCA</title>
    </head>
    <body id="bodyBase">
    	<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <label id="usuarioSesion"></label></h4>
        <h1 align="right" style="margin-top:2%; margin-right:2%; color:#00C; visibility:hidden">Creaci&oacute;n de Usuarios</h1>
        <div id='cssmenu'>
            <ul>
               <li class="" id="AdminUsuarios" style="display:none"><a href='#' title="Admin.Usuarios"><span>Admin.Usuarios</span></a>
                    <ul style="margin-right:-42%">
                         <li><a href='#' title="Usuarios Plataforma"><span>Usuarios Plataforma</span></a></li>
                         <li class='last' title="Usuarios Aplicaciones"><a href='AdminUsuariosAplicaciones.html'><span>Usuarios Aplicaciones</span></a></li>
					</ul>
               </li>
               <li class='' style="display:none" id="AdminCredenciales"><a href='#' title="Admin.Credenciales"><span>Admin.Credenciales</span></a>
                  <ul style="margin-right:-42%">
                     <li id="ReemplazoCredencial" style="display:none"><a href='ReemplazarCredencial.html' title="Reemplazo de credenciales"><span>Reemplazo de credenciales</span></a></li>
                     <li class='last'><a href='AdminCredencial.html' title="Cambio de Estado"><span>Cambio de Estado</span></a></li>
                     <li class='last'><a href='ConsultaMovimientosAcudiente.html' title="Consulta de Movimientos"><span>Consulta de Movimientos</span></a></li>
                     <li class='last'><a href='ConsultaSaldo.html' title="Consulta de Saldos"><span>Consulta de Saldos</span></a></li>
                     <li class='last'><a href='RecargueMonetarioAcudiente.html' title="Recarga en Linea"><span>Recarga en Linea</span></a></li>
                     <li class='last'><a href='TrasladoCredencialAcudiente.html' title="Traslado de Fondos entre Credenciales"><span>Traslado de Fondos entre Credenciales</span></a></li>
                  </ul>
               </li>
               <li class='' id="Liquidacion" style="display:none"><a href='#' title="Liquidaci&oacute;n y Pagos"><span>Liquidaci&oacute;n y Pagos</span></a>
                  <ul style="margin-right:-42%">
                    
                  </ul>
               </li>
               <li class='' id="PuntosRecargue" style="display:none"><a href='#' title="Puntos de Recarga"><span>Puntos de Recarga</span></a>
                  <ul style="margin-right:-42%">
                     
                  </ul>
               </li>
               <li class='' id="CentroOperacion" style="display:none"><a href='#' title="Centro - Operaciones Rutas"><span>Centro - Operaciones Rutas</span></a>
                    <ul style="margin-right:-42%">
                         <li><a href='' title="Vehiculos"><span>Vehiculos</span></a></li>
                         <li><a href='CrearConductores.html' title="Conductores"><span>Conductores</span></a></li>
                         <li><a href='#' title="Monitores"><span>Monitores</span></a></li>
                         <li><a href='crearruta.php' title="v"><span>Rutas</span></a></li>
                         <li><a href='#' title="Centro de Pagos"><span>Centro de Pagos</span></a></li>
                         <li class='last' title="Tracking"><a href='menutracking.php'><span>Tracking</span></a></li>
                    </ul>
               </li>
               <li class="" id="RutaEscolar" style="display:none"><a href='#' title="Ruta Escolar"><span>Ruta Escolar</span></a>
                    <ul style="margin-right:-42%">
                        
					</ul>
               </li>
               <li class="" id="RestriccionConsumo" style="display:none"><a href='#' title="Restricci&oacute;n de Consumo"><span>Restricci&oacute;n de Consumo</span></a>
                    <ul style="margin-right:-42%">
                        
					</ul>
               </li>
               <li class="" id="RecargueCredencial" style="display:none"><a href='ProcesoRecaudo.html' title="Recargue de Credenciales"><span>Recargue de Credenciales</span></a>
                    <ul style="margin-right:-42%">
                        
					</ul>
               </li>
               <li class="" id="Reportes" style="display:none"><a href='ReporteRecaudo.html' title="Reportes"><span>Reportes</span></a>
                    <ul style="margin-right:-42%">
                        
					</ul>
               </li>
               <li class="" id="Salir"><a href='#' title="Cerrar Sesi&oacute;n"><span>Cerrar Sesi&oacute;n</span></a>
                    <ul style="margin-right:-42%">
                        
					</ul>
               </li>               
            </ul>
        </div>
        <div class="contenidoBorde">
        	<div  class="center" id="reader" style="width:100%;height:99%"></div>
        </div>
		<script>
        	window.addEventListener('load',init);
			function init(){
				var usuarioSesion = localStorage.getItem("usuario"); 
				console.log(usuarioSesion);
				$("#usuarioSesion").html(usuarioSesion);
			}
			$("#Salir").click(function(e) {
                localStorage.removeItem("usuario");
				localStorage.removeItem("tipoUsuario");
				window.location.href = "index.html";
            });
        </script>		
           
    </body>
</html>
