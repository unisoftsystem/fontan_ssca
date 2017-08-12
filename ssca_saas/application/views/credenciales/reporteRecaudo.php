<?php
    $UserName = $this->session->userdata('UserNameInternoSSCA');
    if(empty($UserName)) { // Recuerda usar corchetes.
        header('Location: ' . base_url(1));
    }
?>
<style>  
  #commentForm label.error {
    margin-left: 10px;
    width: auto;
    display: inline;
    color:#F00;
    font-size:12px;
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
            </ul>
        </li>
    </ul>
    <div class="contenidoBorde">
    <br><br>
    <form class="cmxform" id="commentForm" method="post" action="">
      <div class="container-fluid">
        <h2 align="right" style="margin-top:2.5%; margin-right:2%; color:#09C"><?= $titulo;?></h2>
        <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <?= $this->session->userdata('UserNameInternoSSCA');?></h4>  
        <input type="hidden" id="txtUserId" name="txtUserId" value="<?= $this->session->userdata('UserIDInternoSSCA');?>" /> 
        <div class="row">
          <div class="col-md-3" align="right">  
            <label for="selectUsuario" style="margin-top:10px"><font color="#09C" size="2">Cajero:</font></label>
          </div>
          <div class="col-md-8">  
            <select class="form-control" id="selectUsuario" name="selectUsuario">
                <option value="Todos">Todos</option>
              <?php
                  /*
                      Se valida que el result de la consulta de tecnicas tenga datos.
                      Este valor es enviado desde la funcion del controlador
                  */                                    
                  if($usuarios){
                      //Se itera el result de los tecnicos. $tecnicos es enviado como un objeto, el cual para obtener los datos se obtiene un array asociativo, el cual se itera con un foreach y se muestra en el select
                      foreach ($usuarios->result() as $value) {
              ?>
              <option value="<?= $value->idUsuario?>"><?= $value->PrimerNombre . " " . $value->SegundoNombre . " " . $value->PrimerApellido . " " . $value->SegundoApellido;?></option>
              <?php

                      }
                  }
              ?>   
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3" align="right">  
            <label for="dateFechaInicial" style="margin-top:10px"><font color="#09C" size="2">Fecha Inicial:&nbsp;</font></label>
          </div>
          <div class="col-md-8">  
            <input class="form-control" type="date" name="dateFechaInicial" id="dateFechaInicial"/>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3" align="right">  
            <label for="dateFechaFinal" style="margin-top:10px"><font color="#09C" size="2">Fecha Final:&nbsp;</font></label>
          </div>
          <div class="col-md-8">  
            <input class="form-control" type="date" name="dateFechaFinal" id="dateFechaFinal"/>
          </div>
        </div><br>

        <div class="row">
          <div class="col-md-11" align="right">  
            <button type="button" name="btnExportarReporte" id="btnExportarReporte" class="btn btn-primary" style="margin-right: 10px; visibility: hidden;"><b>EXPORTAR EXCEL</b></button>

            <button type="submit" name="btnGenerarReporte" id="btnGenerarReporte" class="btn btn-primary"><b>GENERAR REPORTE</b></button>
          </div>
        </div>
      </div>
    </form>
      <h2 id="h2Total" align="right"></h2>
      <table id="demo" width="100%">
        <thead>
            <tr align="center">
                <th>Id Usuario</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Acudiente</th>
                <th>Numero de Indentificacion del Acudiente</th>
                <th>Funcionario</th>
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
       
    <div class="container" style="position: absolute;z-index: 1;">
        <div class="row" align="center" id="chats">           
            
        </div>
    </div>
    <?= $footer;?>
      <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="<?= base_url(1);?>js/chat.js"></script>
       <script src="<?= base_url(1);?>js/jquery.validate.js"></script>
       <script src="<?= base_url(1);?>js/jquery-loader.js" type="text/javascript"></script>
        <script src="<?= base_url(1);?>dist/tablefilter/tablefilter.js"></script>      
       <script>
            
                //Configuracion de la tabla    
                var filtersConfig = {
                    base_path: '<?= base_url(1);?>dist/tablefilter/',
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
                    col_7: 'none',//Configurar el filtro de la columna con select
                    col_8: 'none',//Configurar el filtro de la columna con select
                    col_9: 'none',//Configurar el filtro de la columna con select
                    
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
              var tf = new TableFilter('demo', filtersConfig);
              tf.init();    
            </script>
      <script type="text/javascript">
      $.validator.setDefaults({
        //Capturar evento del boton crear
        submitHandler: function() {
          var usuarioSeleccionado = $("#selectUsuario").val();
          var fechaInicial = $("#dateFechaInicial").val();
          var fechaFinal = $("#dateFechaFinal").val();
          
          //Se guardan los datos en un JSON
          var datos = {
            usuario: usuarioSeleccionado,
            fechaInicial: fechaInicial,
            fechaFinal: fechaFinal
          }   
        
       
        //Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage
        //EnviarDatos(usuario, "ActionReporteRecaudo.php", "REPORTERECAUDO");
        
        $.post("<?= base_url();?>index.php/movimientos/GenerarReporteRecaudo", datos)
        .done(function( data ) {
          var jsonUsuario = JSON.parse(data);
          var total = 0;
          $("#tbody").html("");
          var html = "";
          
          if($.trim(data) != "[]"){

             $("#btnExportarReporte").css({"visibility":"visible"});
            $.each(jsonUsuario, function(i, item) {
              var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre")
              var fechas = jsonUsuario[i].FechaMovimiento.split("-");
              var fechaDato = fechas[2] + " de " + meses[parseInt(fechas[1]) - 1] + " de " + fechas[0];
              if((i + 1) % 2 == 1){
                html += '<tr class="even" validrow="true" align="center">' +
                '<td>' + jsonUsuario[i].idUsuario + '</td>' +
                '<td>' + jsonUsuario[i].PrimerNombre + ' ' + jsonUsuario[i].SegundoNombre + '</td>' +
                '<td>' + jsonUsuario[i].PrimerApellido + ' ' + jsonUsuario[i].SegundoApellido + '</td>' +
                '<td>' + jsonUsuario[i].Acudiente + '</td>' +
                '<td>' + jsonUsuario[i].NumeroIdAcudiente + '</td>' +
                '<td>' + jsonUsuario[i].PrimerNombre_sistema + ' ' + jsonUsuario[i].SegundoNombre_sistema + ' ' + jsonUsuario[i].PrimerApellido_sistema + ' ' + jsonUsuario[i].SegundoApellido_sistema + '</td>' +
                '<td>' + fechaDato + '</td>' +
                '<td>' + jsonUsuario[i].HoraMovimiento + '</td>' +
                '<td>' + jsonUsuario[i].DescripcionMovimiento + '</td>' +
                '<td>' + jsonUsuario[i].ValorMovimiento + '</td>' +
                '</tr>';            
                total += parseFloat(jsonUsuario[i].ValorMovimiento);
              }else{
                html += '<tr class="odd" validrow="true" align="center">' +
                '<td>' + jsonUsuario[i].idUsuario + '</td>' +
                '<td>' + jsonUsuario[i].PrimerNombre + ' ' + jsonUsuario[i].SegundoNombre + '</td>' +
                '<td>' + jsonUsuario[i].PrimerApellido + ' ' + jsonUsuario[i].SegundoApellido + '</td>' +
                '<td>' + jsonUsuario[i].Acudiente + '</td>' +
                '<td>' + jsonUsuario[i].NumeroIdAcudiente + '</td>' +
                '<td>' + jsonUsuario[i].PrimerNombre_sistema + ' ' + jsonUsuario[i].SegundoNombre_sistema + ' ' + jsonUsuario[i].PrimerApellido_sistema + ' ' + jsonUsuario[i].SegundoApellido_sistema + '</td>' +
                '<td>' + fechaDato + '</td>' +
                '<td>' + jsonUsuario[i].HoraMovimiento + '</td>' +
                '<td>' + jsonUsuario[i].DescripcionMovimiento + '</td>' +
                '<td>' + jsonUsuario[i].ValorMovimiento + '</td>' +
                '</tr>';    
                total += parseFloat(jsonUsuario[i].ValorMovimiento);        
              }       
              
                        
            });
            $("#h2Total").html("Total: $" + currency(total, 0));
            
            /*$("#dateFechaInicial").val("");
            $("#dateFechaFinal").val("");*/
            $("#tbody").html(html);

            tf.init();   
            
          }else{
            $("#tbody").html('');
            $("#h2Total").html("Total: $" + currency(0, 0));
            
           
            //alert("Los datos ingresados no estan registrados en el sistema");
          }
        });
        }
      });
      
      (function() {
        // use custom tooltip; disable animations for now to work around lack of refresh method on tooltip
        $("#commentForm").tooltip({
          show: false,
          hide: false
        });
      
        // validate signup form on keyup and submit
        $("#commentForm").validate({
          rules: {
            dateFechaInicial:{
              required: true,
              date: true
            },
            dateFechaFinal:{
              required: true,
              date: true
            }
          },
          messages: {
            dateFechaInicial: "Por favor ingrese una fecha inicial valida",
            dateFechaFinal: "Por favor ingrese una fecha final valida"
          }
        });
      
      })();
        

         $("#btnExportarReporte").click(function(e) {
         var usuarioSeleccionado = $("#selectUsuario").val();
          var fechaInicial = $("#dateFechaInicial").val();
          var fechaFinal = $("#dateFechaFinal").val();
          var win = window.open("<?= base_url();?>index.php/movimientos/ExportarReporteRecaudo?usuario=" + usuarioSeleccionado + "&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal, '_blank');
          win.focus(); 
            
        });
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
      </script> 
    </body>
</html>