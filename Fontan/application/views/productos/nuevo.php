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
        </br>
          <h2 align="right" style="margin-top:2.5%; margin-right:2%; color:#09C"><?= $titulo;?></h2>
          <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <?= $this->session->userdata('UserNameInternoSSCA');?></h4>  
          <input type="hidden" id="txtUserId" name="txtUserId" value="<?= $this->session->userdata('UserIDInternoSSCA');?>" /> 
         <div class="container-fluid">
          
          <form class="cmxform" method="POST" action="" id="commentForm">
            <div class="row">
              <div class="col-md-8">  
                <div class="row">
                  <div class="col-md-4">  
                      <label for="txtNombre"><font color="#09C" size="2">Nombre del Producto: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="text" name="txtNombre" id="txtNombre" class="form-control"/>
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-4">  
                      <label for="txtDescripcion"><font color="#09C" size="2">Descripción del producto: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <textarea name="txtDescripcion" id="txtDescripcion" class="form-control"></textarea>
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-4">  
                      <label for="txtValor"><font color="#09C" size="2">Valor del producto: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="text" name="txtValor" id="txtValor" class="form-control" onKeyUp="format(this)">
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-4">  
                      <label for="txtTiempo"><font color="#09C" size="2">Restriccion Tiempo: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="time" name="txtTiempo" id="txtTiempo" class="form-control">
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-4">  
                      <label for="txtEdadMinima"><font color="#09C" size="2">Edad Minima: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="text" name="txtEdadMinima" id="txtEdadMinima" class="form-control">
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-4">  
                      <label for="txtEdad"><font color="#09C" size="2">Edad Maxima: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="text" name="txtEdad" id="txtEdad" class="form-control">
                  </div>
                </div><br/>

                <div class="row" id="rowcategoria">
                  <div class="col-md-4">  
                      <label for="selectCategoria"><font color="#09C" size="2">Categoria: </font></label>
                  </div>
                  <div class="col-md-8">  
                      <select name="selectCategoria" id="selectCategoria" class="form-control">
                        <option value="Seleccione">Seleccione...</option>
                        <?php
                            /*
                                Se valida que el result de la consulta de tecnicas tenga datos.
                                Este valor es enviado desde la funcion del controlador
                            */                                    
                            if($categorias){
                                //Se itera el result de los tecnicos. $tecnicos es enviado como un objeto, el cual para obtener los datos se obtiene un array asociativo, el cual se itera con un foreach y se muestra en el select
                                foreach ($categorias->result() as $value) {
                        ?>
                        <option value="<?= $value->codigo?>"><?= $value->Nombre;?></option>
                        <?php

                                }
                            }
                        ?>               

                      </select>
                  </div>
                </div><br/>

                <div class="row" id="rowsubcategoria">
                  <div class="col-md-4">  
                      <label for="selectSubcategoria"><font color="#09C" size="2">Subcategoria: </font></label>
                  </div>
                  <div class="col-md-8">  
                      <select name="selectSubcategoria" id="selectSubcategoria" class="form-control"></select>
                  </div>
                </div><br/>
                
                <div class="row">
                  <div class="col-md-4">  
                      <label for="txtEdad"><font color="#09C" size="2">Tiempo Cancelacion: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="time" name="txtTiempoC" id="txtTiempoC" class="form-control">
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-4">  
                      <label for="txtEstado"><font color="#09C" size="2">Estado: </font></label>
                  </div>
                  <div class="col-md-8">  
                    
                    <label for="radioEstadoActivo"><font color="#09C" size="1">ACTIVO</font><input type="radio" name="radioEstado" id="radioEstadoActivo" value="ACTIVO" class="form-control" checked="checked" /></label>

                    
                    <label for="radioEstadoInactivo" style="margin-left: 15px"><font color="#09C" size="1">INACTIVO</font><input type="radio" name="radioEstado" id="radioEstadoInactivo" value="INACTIVO" class="form-control"/></label>
                  </div>
                </div><br/>

                <div class="row">
                  <div class="col-md-4">  
                      <label for="txtStock"><font color="#09C" size="2">Stock: </font></label>
                  </div>
                  <div class="col-md-8">  
                    <input type="text" name="txtStock" id="txtStock" class="form-control" onKeyUp="format(this)">
                  </div>
                </div><br/>
                
                <div class="row">
                  <div class="col-md-11" align="right">
                    
                    
                      <button type="submit" class="btn btn-primary" id="btnGuardar" style="display:none"><b>Guardar</b></button>
                   
                  </div>
                </div><br/>
                  

              
                </div>
                <div class="col-md-2" align="center">
                  <br>
                  <img id="imageFoto" name="imageFoto" width="100%" src="<?= base_url();?>images/box.png" />
                  
                  <label for="fileFoto"><font color="#09C" size="2">Seleccionar foto: </font></label><br><input type="file" id="fileFoto" name="fileFoto" class="btn btn-primary" accept="image/*"/>
              </div>
            </div>
          </form>
        
        </div>
        

      </div> 
      <div class="container">
        <div class="row" align="center" id="chats">           
            
        </div>
      </div>
      <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="../../js/chat.js"></script>
      <script src="<?= base_url();?>js/jquery.validate.js"></script>
      <script type="text/javascript">
      var urlFoto = "";
      function readImage() {
          //console.log(this.files);
          if ( this.files && this.files[0] ) {
              var FR = new FileReader();
              FR.onload = function(e) {
                   $('#imageFoto').attr( "src", e.target.result );
                   //$('#base').text( e.target.result );
                   //console.log(e.target.result);
                   urlFoto = e.target.result;
                   //$("#lblErrorFoto").css({"display":"none"})
              };       
              FR.readAsDataURL( this.files[0] );
          }
      }
      
      $("#fileFoto").change( readImage );
      $.validator.setDefaults({
        //Capturar evento del boton crear
        submitHandler: function() {
          var codigo = $("#txtCodigo").val();
          var nombre = $("#txtNombre").val();
          var descripcion = $("#txtDescripcion").val();
          var valor = $("#txtValor").val();
          valor = valor.replace('.','');
          var tiempo = $("#txtTiempo").val();
          var tiempoc = $("#txtTiempoC").val();
          var edad = $("#txtEdad").val();
          var edadMinima = $("#txtEdadMinima").val();
          var categoria = $("#selectCategoria").val();
          var subCategoria = $("#selectSubcategoria").val();
          var estado = $("input[name='radioEstado']:checked").val();
          var stock = $("#txtStock").val();
          stock = stock.replace('.','');
          var foto = "";
          if(urlFoto != ""){
            foto = $("#imageFoto").attr("src");;
          }
    
        //Se guardan los datos en un JSON
        var datos = {
          nombreProducto: nombre,
          descripcion: descripcion,
          valorUnitario: valor,
          tiempo: tiempo,
          tiempoc: tiempoc,
          edad: edad,
          edadMinima: edadMinima,
          categoria: categoria,
          subcategoria: subCategoria,
          stock: stock,
          estado: estado,
          imgBase64: foto
        }   
        $("#btnGuardar").attr("disabled", "disabled")
          $.post("<?= base_url();?>index.php/producto/insertar", datos)
          .done(function( data ) {console.log(data)
            alert("¡Se registro con exito el producto!")
            window.location.href = "<?= base_url();?>index.php/producto/nuevo";
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
            txtNombre:"required",
            txtDescripcion: "required",
            txtValor: "required",
            txtTiempo: "required",
            txtEdadMinima: "required",
            txtEdad: "required",
            txtTiempoC: "required",
            txtStock: "required",
          },
          messages: {
            txtNombre: "Por favor ingrese un nombre",
            txtDescripcion: "Por favor ingrese una Descripción",
            txtValor: "Por favor ingrese un precio unitario",
            txtTiempo: "Por favor ingrese una Restricción de tiempo",
            txtEdadMinima: "Por favor ingrese una edad minima",
            txtEdad: "Por favor ingrese una edad Maxima",
            txtTiempoC: "Por favor ingrese un tiempo de Cancelacion",
            txtStock: "Por favor ingrese una cantidad"
          }
        });
      
      })();

      

      $("#selectCategoria").change(function(e) {
        var categoria = $("#selectCategoria").val();
        
        
     
        if($("#selectCategoria").val() != "Seleccione"){
        
          $.post("<?= base_url();?>index.php/subcategoria/listarSubCategorias", {idCategoria: $("#selectCategoria").val()})
          .done(function( data ) {
            
            if($.trim(data) != "[]"){
              $("#btnGuardar").css( "display", "block" );
              var json = JSON.parse(data);
              $("#selectSubcategoria").html("")
              for (var i = 0; i < json.length; i++) {
                $("#selectSubcategoria").append('<option value="' + json[i].codigo + '">' + json[i].Nombre + '</option>')
              }
            }else{
              $("#btnGuardar").css( "display", "none" );
            }
       });
          }else{
            $("#btnGuardar").css( "display", "none" );
          }
          
        
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