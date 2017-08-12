<?php
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
<title>REPORTE DE MENSAJES DE ACUDIENTES A MONITOR</title>
<link rel="stylesheet" href="css/styles.css"/>
<link rel="stylesheet" href="css/styles.css"/>
<link href="css/style.css" rel="stylesheet"/>
<link href="css/menu.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="dist/tablefilter/style/tablefilter.css">
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/style.js"></script>	
<script type="text/javascript" src="js/ConexionWebService.js"></script>
<!--<script type="text/javascript" src="js/ValidacionUsuario.js"></script>-->
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
	input, select, textarea{
		border-radius:8px;
	}
	textarea{
		height:200px;
	}
</style>
</head>

<body id="bodyBase">
<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <label id="usuarioSesion"><?php echo $id;?></label></h4>
<h2 align="right" style="margin-top:2%; margin-right:2%; color:#00C">REPORTE DE MENSAJES DE ACUDIENTES A MONITOR</h2>
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
                  <?php
                  $pos = strpos($permisos, "CREACION CONDUCTORES");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='CrearConductores.html' title=\"Gestion de Conductores\"><h6><p class=\"full-circle\"></p><span>Gestion de Conductores</span></h6></a></li>";
                  }
                  ?>
                  <?php
                  $pos = strpos($permisos, "CREACION MONITORES");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li class=''><a href='CrearMonitor.html' title=\"Gestion de Monitores\"><h6><p class=\"full-circle\"></p><span>Gestion de Monitores</span></h6></a></li>";
                  }
                  ?>
                  <?php
                  $pos = strpos($permisos, "CREACION VEHICULOS");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li class=''><a href='CrearVehiculos.html' title=\"Gestion de Vehiculos\"><h6><p class=\"full-circle\"></p><span>Gestion de Vehiculos</span></h6></a></li>";
                  }
                  ?>
               
               <li class=''><a href='#' title="Gestion de Rutas Escolares"><h6><p class="full-circle"></p><span>Gestion de Rutas Escolares</span></h6></a>
                  <ul style="margin-right:-42%">
                  <?php
                  $pos = strpos($permisos, "CREACION RUTAS ESCOLARES");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='creaciones.php' title=\"Administracion Rutas Escolares\"><span>Administracion Rutas Escolares</span></a></li>";
                  }
                  ?>
                  <?php
                  $pos = strpos($permisos, "TRACKING RUTAS ESCOLARES");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='diss.php' title=\"Tracking Time - Real\"><span>Tracking Time - Real</span></a></li>";
                  }
                  ?>
                  <li><a href='AvisosyObservaciones.html' title="Avisos y Observaciones"><span>Avisos y Observaciones</span></a></li>
                  </ul>
                  </li>
                  <?php
                  $pos = strpos($permisos, "CREAR MENSAJES");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li ><a href='#' title=\"Mensajeria\"><span>Mensajeria</span></a><ul style=\"margin-right:-42%\"><li><a href='MensajesAcudientes.php' title='Mensajeria para acudientes'><span>Mensajeria para acudientes</span></a></li></ul></li>";
                  }
                  ?>
               
               <li ><a href='#' title="Reportes"><h6><p class="full-circle"></p><span>Reportes</span></h6></a>
                    <ul style="margin-right:-42%">
                  <?php
                  $pos = strpos($permisos, "REPORTES");
                  if ($pos == false) {
                  //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                  } else {
                  echo "<li><a href='ReporteEstadodeCuenta.html' title=\"Reporte Estado de Cuenta\"><span>Reporte Estado de Cuenta</span></a></li>";
                  echo "<li><a href='ReporteRutas.php' title=\"Reporte Asignacion de Ruta\"><span>Reporte Asignacion de Ruta</span></a></li>";
                  echo "<li><a href='ReporteMensajeAcudiente.php' title=\"Reporte Mensajeria de Acudientes\"><span>Reporte Mensajeria de Acudientes</span></a></li>";
                  echo "<li><a href='BitacoradeRecogidasyentregas.html' title=\"Bitacora de Recogidas y entregas\"><span>Bitacora de Recogidas y entregas</span></a></li>";
                  echo "<li><a href='ReporteAlarmas.php' title=\"Alarmas generadas en trayectos\"><span>Alarmas generadas en trayectos</span></a></li>";
				  echo "<li><a href='ReporteMensajeCoordinador.php' title=\"Reporte Mensajeria de Coordinador a Acudientes\"><span>Reporte Mensajeria de Coordinador a Acudientes</span></a></li>";
                  }
                  ?>
                    </ul>
               </li>
            </ul>

        </div>
        <div class="contenidoBorde">
        	<table id="demo" width="100%">
                <thead>
                    <tr>
                        <th align="center">Acudiente</th>
                        <th align="center">Estudiante</th>
                        <th align="center">Ruta</th>
                        <th align="center">Fecha</th>
                        <th align="center">Mensaje</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    
                    
                </tbody>
            </table>
        </div>
<script src="dist/tablefilter/tablefilter.js"></script>
<script src="js/jquery.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript">
	/*
		Fecha: 23 de Octubre de 2015
		Descripcion: Evento para capturar la existencia del usuario en la base de datos al quitar el focus del campo de texto de usuario
	*/
	//Configuracion de la tabla    
	var filtersConfig = {
		base_path: 'dist/tablefilter/',
		paging: true,//Activar o no la paginacion
		results_per_page: ['Filas: ', [10,25,50,100]],//Numero de registros a mostrar en cada pagina
		auto_filter: true,//Aceptar o no filtro automatico cuando se empieza a escribir
		auto_filter_delay: 1100, //milliseconds
		filters_row_index: 1,
		remember_page_number: true,
		remember_page_length: true,
		alternate_rows: true,
		grid_layout: true,
		grid_width: '100%',//Ancho de la tabla
		alternate_rows: true,
		btn_reset: true,//Activar el boton de resetear los campos de filtro
		rows_counter: true,
		loader: true,
		status_bar: true,
		col_0: 'select',//Configurar el filtro de la columna con select
		col_2: 'select',//Configurar el filtro de la columna con select
		
		extensions:[
			{
				name: 'sort',
				types: [
					'number', 'string', 'string',
					'number', 'string', 'string',
					'number'
				]
			}
		]
	};
	window.addEventListener('load',init);
	function init(){
		
		$.post("ActionReporteMensajesAcudiente.php", {})
		.done(function( data ) {
			console.log($.trim(data));
			var html = '';
			if($.trim(data) != "[]"){
				var jsonUsuario = JSON.parse(data);
				$.each(jsonUsuario, function(i, item) {
					if((i + 1) % 2 == 1){
						html += '<tr class="even" validrow="true">' +
						'<td align="center">' + jsonUsuario[i].Nombre + '</td>' +
						'<td align="center">' + jsonUsuario[i].PrimerNombre + ' ' + jsonUsuario[i].SegundoNombre + ' ' + jsonUsuario[i].PrimerApellido + ' ' + jsonUsuario[i].SegundoApellido + '</td>' +
						'<td align="center">' + jsonUsuario[i].nombreruta + '</td>' +
						'<td align="center">' + jsonUsuario[i].fecha + '</td>' +
						'<td align="center">' + jsonUsuario[i].mensaje + '</td>' +
						'</tr>';						
					}else{
						html += '<tr class="odd" validrow="true">' +
						'<td align="center">' + jsonUsuario[i].Nombre + '</td>' +
						'<td align="center">' + jsonUsuario[i].PrimerNombre + ' ' + jsonUsuario[i].SegundoNombre + ' ' + jsonUsuario[i].PrimerApellido + ' ' + jsonUsuario[i].SegundoApellido + '</td>' +
						'<td align="center">' + jsonUsuario[i].nombreruta + '</td>' +
						'<td align="center">' + jsonUsuario[i].fecha + '</td>' +
						'<td align="center">' + jsonUsuario[i].mensaje + '</td>' +
						'</tr>';						
					}
				});
				$("#tbody").html(html)
				var tf = new TableFilter('demo', filtersConfig);
				tf.init();
			}
			
		});	
			
	}
	$("#Salir").click(function(e) {
		localStorage.removeItem("usuario");
		localStorage.removeItem("tipoUsuario");
		window.location.href = "index.html";
	});
</script>
</body>
</html>
