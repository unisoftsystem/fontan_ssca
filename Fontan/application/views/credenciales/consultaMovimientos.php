<?php
    $UserName = $this->session->userdata('UserNameInternoSSCA');
    if(empty($UserName)) { // Recuerda usar corchetes.
        header('Location: ' . base_url());
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
            <label for="txtUsuario" style="margin-top:10px"><font color="#09C" size="2">Usuario:&nbsp;</font></label>
          </div>
          <div class="col-md-8">  
            <input type="text" name="txtUsuario" id="txtUsuario" class="form-control" placeholder="Buscar Usuario" /><input type="hidden" name="txtCredencial" id="txtCredencial" class="form-control"/>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3" align="right">  
            <label for="txtPrimerApellido" style="margin-top:10px"><font color="#09C" size="2">Primer Apellido:</font></label>
          </div>
          <div class="col-md-8">  
            <input type="text" name="txtPrimerApellido" id="txtPrimerApellido" disabled class="form-control"/>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3" align="right">  
            <label for="txtSegundoApellido" style="margin-top:10px"><font color="#09C" size="2">Segundo Apellido:</font></label>
          </div>
          <div class="col-md-8">  
            <input type="text" name="txtSegundoApellido" id="txtSegundoApellido" disabled class="form-control"/>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3" align="right">  
            <label for="txtPrimerNombre" style="margin-top:10px"><font color="#09C" size="2">Primer Nombre:</font></label>
          </div>
          <div class="col-md-8">  
            <input type="text" name="txtPrimerNombre" id="txtPrimerNombre" disabled class="form-control"/>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3" align="right">  
            <label for="txtSegundoNombre" style="margin-top:10px"><font color="#09C" size="2">Segundo Nombre</font>:</label>
          </div>
          <div class="col-md-8">  
            <input type="text" name="txtSegundoNombre" id="txtSegundoNombre" disabled class="form-control"/>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3" align="right">  
            <label for="txtSaldo" style="margin-top:10px"><font color="#09C" size="2">Saldo Actual:</font></label>
          </div>
          <div class="col-md-8">  
            <input type="text" name="txtSaldo" id="txtSaldo" disabled class="form-control"/>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3" align="right">  
            <label for="dateFechaInicial" style="margin-top:10px"><font color="#09C" size="2">Fecha Inicial:</font></label>
          </div>
          <div class="col-md-8">  
            <input type="date" name="dateFechaInicial" id="dateFechaInicial" class="form-control"/>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3" align="right">  
            <label for="dateFechaFinal" style="margin-top:10px"><font color="#09C" size="2">Fecha Final:</font></label>
          </div>
          <div class="col-md-8">  
            <input type="date" name="dateFechaFinal" id="dateFechaFinal" class="form-control"/>
          </div>
        </div><br/>

        <div class="row">
          <div class="col-md-11" align="right">  
            <button type="button" name="btnExportarReporte" id="btnExportarReporte" class="btn btn-primary" style="margin-right: 10px; visibility: hidden;"><b>EXPORTAR EXCEL</b></button>

            <button type="submit" name="btnGenerarReporte" id="btnGenerarReporte" class="btn btn-primary" style="visibility:hidden"><b>GENERAR REPORTE</b></button>
          </div>
        </div>
      </div>
    </form>
      <h2 id="h2Total" align="right"></h2>
      <table id="demo" width="100%">
        <thead>
            <tr align="center">
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
       <div class="container">
          <div class="row" align="center" id="chats">           
              
          </div>
      </div>
      <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="../../js/chat.js"></script>
       <script src="<?= base_url();?>js/jquery.validate.js"></script>
       <script src="<?= base_url();?>js/jquery-loader.js" type="text/javascript"></script>
        <script src="<?= base_url();?>dist/tablefilter/tablefilter.js"></script>      
       <script>
            
                //Configuracion de la tabla    
                var filtersConfig = {
                    base_path: '<?= base_url();?>dist/tablefilter/',
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
          //Se obtienen los datos a enviar    
          var fechaInicial = $("#dateFechaInicial").val();
          var fechaFinal = $("#dateFechaFinal").val();
          var credencial = $("#txtCredencial").val();
          //Se guardan los datos en un JSON
          var datos = {
            usuario: credencial,
                  fechaInicial: fechaInicial,
            fechaFinal: fechaFinal
              } 
          //Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage
          //EnviarDatos(datos, "ActionReporteMovimientosAcudiente.php", "REPORTEMOVIMIENTOS");  
          $.post("<?= base_url();?>index.php/movimientos/ReporteMovimientos", datos)
          .done(function( data ) {
            //console.log($.trim(data));
            var html = '';
            var total = 0;
            if($.trim(data) != "[]"){
              $("#btnExportarReporte").css({"visibility":"visible"});
              //alert("Se proceso con exito el recaudo");
              var json = JSON.parse(data);
              $.each(json, function(i, item) {
                var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre")
                var fechas = json[i].FechaMovimiento.split("-");
                var fechaDato = fechas[2] + " de " + meses[parseInt(fechas[1]) - 1] + " de " + fechas[0];
              if((i + 1) % 2 == 1){
                   html += '<tr class="even" validrow="true">' +
                    '<td>' + fechaDato + '</td>' +
                    '<td>' + json[i].HoraMovimiento + '</td>' +
                    '<td>' + json[i].DescripcionMovimiento + '</td>' +
                    '<td>' + json[i].ValorMovimiento + '</td>' +
                  '</tr>';  
                  
                 }else{
                   html += '<tr class="odd" validrow="true">' +
                    '<td>' + fechaDato + '</td>' +
                    '<td>' + json[i].HoraMovimiento + '</td>' +
                    '<td>' + json[i].DescripcionMovimiento + '</td>' +
                    '<td>' + json[i].ValorMovimiento + '</td>' +
                  '</tr>';
                  
                }
                });
                
                $("#tbody").html(html);
                
                tf.init();
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
         var credencial = $("#txtCredencial").val();
          var fechaInicial = $("#dateFechaInicial").val();
          var fechaFinal = $("#dateFechaFinal").val();
          var win = window.open("<?= base_url();?>index.php/movimientos/ExportarConsultaMovimientos?usuario=" + credencial + "&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal, '_blank');
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

        $("#txtUsuario").keyup (function(e) {
        var usuarioConsultar = $("#txtUsuario").val();
    

        $.post("<?= base_url();?>index.php/usuarios_aplicaciones/ConsultarUsuario", {usuario: usuarioConsultar})
        .done(function( data ) {
          //console.log($.trim(data));
         
          if($.trim(data) != "[]"){
            $("#btnGenerarReporte").css({"visibility":"visible"})
            //alert("Se proceso con exito el recaudo");
            var json = JSON.parse(data);
            if(json.length > 0){
              $.each(json, function(i, item) {
                $("#txtPrimerApellido").val(json[i].PrimerApellido);
                $("#txtSegundoApellido").val(json[i].SegundoApellido);
                $("#txtPrimerNombre").val(json[i].PrimerNombre);
                $("#txtSegundoNombre").val(json[i].SegundoNombre);
                $("#txtCredencial").val(json[i].idCredencial);
                $("#txtSaldo").val(json[i].SaldoCredencial);
              });
            }else{
              $("#btnGenerarReporte").css({"visibility":"visible"})
            }
          }else{
            $("#btnGenerarReporte").css({"visibility":"visible"})
          }
        });
     });
      </script> 
    </body>
</html>