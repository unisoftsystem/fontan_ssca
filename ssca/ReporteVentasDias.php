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
        <title>SSCA</title>
        <link href="css/styler.css" rel="stylesheet"/>
        <link href="css/menu.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="dist/tablefilter/style/tablefilter.css">
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/style.js"></script>	
        <script type="text/javascript" src="js/ConexionWebService.js"></script>
        <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
		<script src="js/script.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
       <style>
			label, select{
				color:#00C;
			}
		</style>
    
    
    </head>
    <body id="bodyBase">
    <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <label id="usuarioSesion" style="color:#CCC"><?php echo $id;?></label></h4>
    <h2 align="right" style="margin-top:2%; margin-right:2%; color:#00C">Reportes de Ventas</h2>

    	<div id='cssmenu'>
            <ul>
              <li><a href='#' title="Crear Liquidacion"><h6><p class="full-circle"></p><span>Reportes Ventas</span></h6></a>
                    <ul style="margin-right:-42%">
                        <li><a href='#' title=\"Crear Liquidacion\"><h6><p class=\"full-circle\"></p><span>Reporte por Fecha</span></h6></a></li> 
                    </ul>
              </li>
          </ul>
      </div>
    <div class="contenidoBorde">
    <br><br>

    <table align="center" width="100%">		
        <tr>
            <td><label for="dateFechaInicial">FECHA INICIAL:&nbsp;</label></td>
            <td><input class="form-control" type="date" name="dateFechaInicial" id="dateFechaInicial"/></td>        
        </tr>
        <tr>
            <td><label for="dateFechaFinal">FECHA FINAL:&nbsp;</label></td>
            <td><input class="form-control" type="date" name="dateFechaFinal" id="dateFechaFinal"/></td>        
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="right"><button type="button" name="btnExportarReporte" id="btnExportarReporte" class="btn btn-primary" style="margin-right: 10px; visibility: hidden;"><b>EXPORTAR EXCEL</b></button><button type="button" name="btnGenerarReporte" id="btnGenerarReporte" class="btn btn-primary"><b>GENERAR REPORTE</b></button></td>
        </tr>
        <tr>
            <td colspan="2" height="20px">&nbsp;</td>
        </tr>
    </table>
      <h2 id="h2Total" align="right"></h2>
	<table id="demo" width="100%">
        <thead>
            <tr>
                <th>Id Usuario</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Descripcion</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody id="tbody">
            
            
        </tbody>
    </table>

      
       </div>   
       <script src="dist/tablefilter/tablefilter.js"></script>
			<script>
            
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
          					col_0: 'none',//Configurar el filtro de la columna con select
          					col_1: 'none',//Configurar el filtro de la columna con select
          					col_2: 'none',//Configurar el filtro de la columna con select
                    col_3: 'none',//Configurar el filtro de la columna con select
                    col_4: 'none',//Configurar el filtro de la columna con select
          					col_5: 'none',//Configurar el filtro de la columna con select
          					col_6: 'none',//Configurar el filtro de la columna con select
                    
                    extensions:[
                        {
                            name: 'advancedGrid',
                            // For the purpose of this demo, ezEditTable dependency
                            // is loaded from its own website which is not a CDN.
                            // This dependency also requires a licence therefore
                            // DO NOT import it in this way in your projects.
                            filename: 'ezEditTable_min.js',
                            vendor_path: 'http://181.55.254.193/ssca/js/',
                            // Once ezEditTable dependency is installed in your
                            // project import it by pointing to a local path:
                            // vendor_path: 'path/to/ezEditTable'
                            editable: false,
                            selection: true,
                            default_selection: 'both',
                            editor_model: 'cell',
                            
                        }, {
                            name: 'sort',
                            types: [
                                'number', 'string', 'string',
                                'number', 'string', 'string',
                                'number'
                            ]
                        }
                    ]
                };
            	var tf = new TableFilter('demo', filtersConfig);
                
            </script>
      <script type="text/javascript">
        /*
          Fecha:      Octubre 24 de 2015
          Descripcion:  Script para enviar los datos al webservice para que los inserte en la base de datos
        
        */
        
        //Valor guardado cuando se cierra un popup y se concreto una operación
        var opcionSeleccionar = "";
          
        //Capturar evento del boton crear
        $("#btnGenerarReporte").click(function(e) {
  			var fechaInicial = $("#dateFechaInicial").val();
  			var fechaFinal = $("#dateFechaFinal").val();
  			
  			//Se guardan los datos en un JSON
  			var datos = {
  				fechaInicial: fechaInicial,
  				fechaFinal: fechaFinal
  			}   
  			
       
  			//Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage
  			//EnviarDatos(usuario, "ActionReporteRecaudo.php", "REPORTERECAUDO");
		    
        $.post("ActionReporteVentasDias.php", datos)
        .done(function( data ) {
          var jsonUsuario = JSON.parse(data);
          var total = 0;
          var html = '';
        
          if($.trim(data) != "[]"){
             $("#btnExportarReporte").css({"visibility":"visible"});
            $.each(jsonUsuario, function(i, item) {
              var res = jsonUsuario[i].DescripcionMovimiento.split(":");
              if((i + 1) % 2 == 1){
                html += '<tr class="even" validrow="true">' +
                '<td>' + jsonUsuario[i].NumeroId + '</td>' +
                '<td>' + jsonUsuario[i].PrimerNombre + ' ' + jsonUsuario[i].SegundoNombre + '</td>' +
                '<td>' + jsonUsuario[i].PrimerApellido + ' ' + jsonUsuario[i].SegundoApellido + '</td>' +
                '<td>' + jsonUsuario[i].FechaMovimiento + '</td>' +
                '<td>' + jsonUsuario[i].HoraMovimiento + '</td>' +
                '<td>' + res[1] + '</td>' +
                '<td>' + jsonUsuario[i].ValorMovimiento + '</td>' +
                '</tr>';            
                total += parseFloat(jsonUsuario[i].ValorMovimiento);
              }else{
                html += '<tr class="odd" validrow="true">' +
                '<td>' + jsonUsuario[i].NumeroId + '</td>' +
                '<td>' + jsonUsuario[i].PrimerNombre + ' ' + jsonUsuario[i].SegundoNombre + '</td>' +
                '<td>' + jsonUsuario[i].PrimerApellido + ' ' + jsonUsuario[i].SegundoApellido + '</td>' +
                '<td>' + jsonUsuario[i].FechaMovimiento + '</td>' +
                '<td>' + jsonUsuario[i].HoraMovimiento + '</td>' +
               '<td>' + res[1] + '</td>' +
                '<td>' + jsonUsuario[i].ValorMovimiento + '</td>' +
                '</tr>';    
                total += parseFloat(jsonUsuario[i].ValorMovimiento);        
              }         
              $("#h2Total").html("Total: " + total);
                        
            });
            /*$("#dateFechaInicial").val("");
            $("#dateFechaFinal").val("");*/
            $("#tbody").html(html);
            
            var tf = new TableFilter('demo', filtersConfig);
            tf.init();
          }else{
            $("#tbody").empty();
            alert("Los datos ingresados no estan registrados en el sistema");
          }
        });
		  });
        
        window.addEventListener('load',init);
        function init(){

          
          
        }
        $("#Salir").click(function(e) {
			localStorage.removeItem("usuario");
			localStorage.removeItem("tipoUsuario");
			window.location.href = "index.html";
		});
      $("#btnExportarReporte").click(function(e) {
        var usuarioSeleccionado = $("#selectUsuario").val();
        var fechaInicial = $("#dateFechaInicial").val();
        var fechaFinal = $("#dateFechaFinal").val();
        var win = window.open("ExportarReporteVentaDias.php?fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal, '_blank');
        win.focus();  
          
      });
		$(".flt").keypress(function(e) {
            
        });
        
      </script>
        
		<script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>    
    </body>
</html>