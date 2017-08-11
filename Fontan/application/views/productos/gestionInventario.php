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
  .ezInputEditor{
    color: #000;
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
            
         <div class="container-fluid">
            <h2 align="right" style="margin-top:2.5%; margin-right:2%; color:#09C"><?= $titulo;?></h2>
            <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <?= $this->session->userdata('UserNameInternoSSCA');?></h4>  
            <input type="hidden" id="txtUserId" name="txtUserId" value="<?= $this->session->userdata('UserIDInternoSSCA');?>" /> 
          <table id="demo" width="100%">
                <thead>
                    <tr align="center">   
                        <th style="width: 0px">Session</th>                     
                        <th>Producto</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Categoria</th>
                        <th>Subcategoria</th>
                        <th>Stock</th>
                        <th>Cantidad</th>
                        <th>Accion</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        /*
                            Se valida que el result de la consulta de tecnicas tenga datos.
                            Este valor es enviado desde la funcion del controlador
                        */                                    
                        if($productos){
                            //Se itera el result de los tecnicos. $tecnicos es enviado como un objeto, el cual para obtener los datos se obtiene un array asociativo, el cual se itera con un foreach y se muestra en el select
                            foreach ($productos->result() as $value) {
                    ?>    <tr align="center">     
                            <td style="width: 0px"><?= $this->session->userdata('UserIDInternoSSCA');?></td>                       
                            <td><?= $value->codigoProducto;?></td>
                            <td><?= $value->NombreProducto;?></td>
                            <td><?= $value->Descripcion;?></td>
                            <td><?= $value->ValorUnitario;?></td>
                            <td><?= $value->NombreCategoria;?></td>
                            <td><?= $value->NombreSubCategoria;?></td>
                            <td><?= $value->Stock;?></td>
                            <td>0</td>
                            <td>0</td>
                            
                          </tr>
                    <?php

                            }
                        }
                    ?>         
                    
                </tbody>
            </table>
            <div id="popup" style="display: none;">
                <div class="content-popup">
                  <div class="close"><a href="#" id="close"><img src="<?= base_url();?>images/close.png"/></a></div>
                  <h4 align="rigth">Informaci&oacute;n</h4>
                  <img src="" id="foto" width="128px" />
                  <div id="Datos"></div>
                </div>                    
              </div>
        </div>
        

      </div> 
        <div class="container">
            <div class="row" align="center" id="chats">           
                
            </div>
        </div>
        <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="../../js/chat.js"></script>
      <script src="<?= base_url();?>js/jquery.validate.js"></script>
      <script src="<?= base_url();?>dist/tablefilter/tablefilter.js"></script>
      <script type="text/javascript">
        //Configuracion de la tabla    
        var filtersConfig = {
            base_path: '<?= base_url();?>dist/tablefilter/',
            paging: true,//Activar o no la paginacion
            results_per_page: ['Filas: ', [10,25,50,100]],//Numero de registros a mostrar en cada pagina
            auto_filter: true,
            auto_filter_delay: 1100, //milliseconds
            filters_row_index: 1,
            remember_grid_values: true,
            remember_page_number: true,
            remember_page_length: true,
            alternate_rows: true,
            grid_layout: true,
            grid_width: '100%',
            alternate_rows: true,
            btn_reset: true,
            rows_counter: true,
            loader: true,
            status_bar: true,
            col_5: 'select',//Configurar el filtro de la columna con select
            col_6: 'select',//Configurar el filtro de la columna con select
            
            extensions:[
                {
                    name: 'advancedGrid',
                    // For the purpose of this demo, ezEditTable dependency
                    // is loaded from its own website which is not a CDN.
                    // This dependency also requires a licence therefore
                    // DO NOT import it in this way in your projects.
                    filename: 'ezEditTable_min.js',
                    vendor_path: '<?= base_url();?>js/',
                    // Once ezEditTable dependency is installed in your
                    // project import it by pointing to a local path:
                    // vendor_path: 'path/to/ezEditTable'
                    editable: true,
                    selection: true,
                    default_selection: 'both',
                    editor_model: 'cell',
                    cell_editors: [                        
                        { type: 'none', attributes:[['title', 'session']]},
                        { type: 'none', attributes:[['title', 'codigoProducto']]},
                        { type: 'none', attributes:[['title', 'Nombre']]},
                        { type: 'none', attributes:[['title', 'Descripcion']]},
                        { type: 'none', attributes:[['title', 'Precio']]},
                        { type: 'none', attributes:[['title', 'Categoria']]},
                        { type: 'none', attributes:[['title', 'Subcategoria']]},
                        { type: 'none', attributes:[['title', 'Stock']]},
                        { type: 'input', attributes:[['title', 'Cantidad'], ['onKeyUp', 'format(this)']]},
                        { type: 'command',  
                          buttons:{  
                            enable: ['update', 'cancel'],  
                            'update': { title:'Edit row' },  
                            'cancel': { title:'Guardar',icon: 'http://tablefilter.free.fr/TableFilter/ezEditTable/themes/icn_add.gif'}                    
                          }  
                        }
                    ],
    
                    actions:{
                        'update': {  
                            uri: '<?= base_url();?>index.php/producto/AumentarStockGestion', 
                            submit_method: 'ajax', 
                            form_method: 'POST', 
                            param_names: ['session', 'codigoProducto', 'nombre', 'descripcion', 'precio', 'categoria', 'subcategoria', 'stock', 'cantidad']
                        }
                    }
                }, {
                    name: 'sort',
                    types: [
                        'number', 'string', 'string',
                        'number', 'string', 'string',
                        'number', 'number'
                    ]
                }
            ]
        };

        var tf = new TableFilter('demo', filtersConfig);                   
        tf.init();


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
        $('#close').click(function(){
          $('#popup').fadeOut('slow');
          $('.popup-overlay').fadeOut('slow');
         window.location.href = "<?= base_url();?>index.php/producto/gestionInventario";
          return false;
        }); 
      </script> 
    </body>
</html>