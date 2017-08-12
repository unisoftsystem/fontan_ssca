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
        </br>
          <h2 align="right" style="margin-top:2.5%; margin-right:2%; color:#09C"><?= $titulo;?></h2>
          <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <?= $this->session->userdata('UserNameInternoSSCA');?></h4>  
          <input type="hidden" id="txtUserId" name="txtUserId" value="<?= $this->session->userdata('UserIDInternoSSCA');?>" /> 
          <input type="hidden" name="txtFechaInicial" id="txtFechaInicial">
          <input type="hidden" name="txtFechaFinal" id="txtFechaFinal">
         <div class="container-fluid" id="resultado">
          
          <form class="cmxform" method="POST" action="" id="commentForm">
            <div class="row">
              
              <div class="col-md-6" style="margin-left: 25%">
                <div class="form-group">
                  <label for="Ultima fecha corte "><font color="#09C" size="2">Fecha Inicial</font></label>
                  <input type="date" class="form-control" id="fechai" name="fechai"  required></input>
                </div>
                
                <div class="form-group">
                  <label for="Ultima fecha corte "><font color="#09C" size="2">Fecha Final</font></label>
                  <input type="date" class="form-control" id="fechaf" name="fechaf"  required></input>
                </div>

                <button type="submit" class="btn btn-primary" id="btnGenerarReporte"><b>Generar</b></button>
              </div>
            </div>
            
              

          

          </form>
        
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
              <div align="right">                           
                <h4 id="total" style="display:none">Valor Total $ &nbsp;&nbsp;&nbsp;</h4>
              </div>
              </br>
              </br>
   
            </div>
          </div>
      </div>

      </br>
      </br>
      </br>
      </br>
      </div> 
      
    <div class="container" style="position: absolute;z-index: 1;">
        <div class="row" align="center" id="chats">           
            
        </div>
    </div>
    <?= $footer;?>
      <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="<?= base_url(1);?>js/chat.js"></script>
      <script src="<?= base_url(1);?>js/jquery.validate.js"></script>
      <script type="text/javascript">
      $.validator.setDefaults({
        //Capturar evento del boton crear
        submitHandler: function() {
           var fechaInicial = $("#fechai").val();
          var fechaFinal = $("#fechaf").val();
          $("#txtFechaInicial").val(fechaInicial)
          $("#txtFechaFinal").val(fechaFinal)
          //Se guardan los datos en un JSON
          var datos = {
            fechai: fechaInicial,
            fechaf: fechaFinal
          }   
          $.post("<?= base_url();?>index.php/ordenpedido/ConsultaReporteCafeteriaDias", datos)
          .done(function( data ) {
            console.log(data)
            $("#resultado").html("");
            var html = '' +
              '<table class="table table-striped">' + 
                '<thead>' +
                  '<tr>' +
                    '<th bgcolor="#dedede"><center>Cantidad</center></th>' +
                    '<th bgcolor="#dedede"><center>Categoria</center></th>' +
                    '<th bgcolor="#dedede"><center>Subcategoria</center></th>' +
                    '<th bgcolor="#dedede"><center>Detalle</center></th>' +
                    '<th bgcolor="#dedede"><center>Subtotal</center></th>' +
                  '</tr>' +
                '</thead>' +
                '<tbody>';
            if($.trim(data) != "[]"){
              var json = JSON.parse(data);
              sorting(json, 'NombreProducto');
              var tbody = "";
              var total = 0;
              $.each(json, function(i, item) {
                tbody += "<tr><td><center>" + json[i].cantidad + "</center></td>";
                tbody += "<td><center>" + json[i].NombreCategoria + "</center></td>";
                tbody += "<td><center>" + json[i].NombreSubCategoria + "</center></td>";
                tbody += "<td><center>" + json[i].NombreProducto + "</center></td>";
                tbody += "<td><center>" + json[i].total + "</center></td></tr>";
                total += parseFloat(json[i].total);
              });
              $("#total").css({"display":"block"});
              $("#total").html("Valor Total $" + currency(total, 0) + " &nbsp;&nbsp;&nbsp;")
            }
            html += tbody;
            html += '</tbody></table><button type="button" name="btnExportarReporte" id="btnExportarReporte" class="btn btn-primary" style="margin-right: 10px; float: left"><b>EXPORTAR EXCEL</b></button><a href="<?= base_url();?>index.php/ordenpedido/ReporteCafeteriaDias" class="btn btn-primary" style="margin-right: 10px; float: left"><b>GENERAR OTRO REPORTE</b></button>';
            $("#resultado").html(html);

            $("#btnExportarReporte").click(function(e) {
              var fechaInicial = $("#txtFechaInicial").val();
              var fechaFinal = $("#txtFechaFinal").val();
              var win = window.open("<?= base_url();?>index.php/ordenpedido/ExportarReporteCafeteriaDias?fechai=" + fechaInicial + "&fechaf=" + fechaFinal, '_blank');
              win.focus(); 
                
            });    
          
          
          });
          /*var win = window.open("http://190.60.211.17/ssca/ConsultaReporteCafeteriaDias.php?fechai=" + fechaInicial + "&fechaf=" + fechaFinal, '_blank');
              win.focus(); */
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
            fechai:{
              required: true,
              date: true
            },
            fechaf:{
              required: true,
              date: true
            }
          },
          messages: {
            fechai: "Por favor ingrese una fecha inicial valida",
            fechaf: "Por favor ingrese una fecha final valida"
          }
        });
      
      })();
        function sorting(json_object, key_to_sort_by) {
          function sortByKey(a, b) {
              var x = a[key_to_sort_by];
              var y = b[key_to_sort_by];
              return ((x < y) ? -1 : ((x > y) ? 1 : 0));
          }

          json_object.sort(sortByKey);
        }
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