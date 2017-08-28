<style>
    #commentForm label.error,  label.error{
        width: auto;
        color:red;
        font-weight: bold;
        font-size:12px;
        padding-bottom: 0px;
    }
    .navbar-inverse .navbar-nav>li>a {
        color: #FFFFFF;
    }
    .navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:focus, .navbar-inverse .navbar-nav>.active>a:hover {
        color: #fff;
        background-color: #BDBDBD;
    }
    #bodyBase{
        background-image:url(img/estudiantes.png);
        background-repeat:no-repeat;
        overflow:auto; 
    }
    *{
        margin: 0;
        padding: 0;
    }
    li:before {
      content: "-";
      padding-right: 5px;
    }
    .menu a img{
        margin-left: 10px;
        margin-top: 10px;
        cursor: pointer;
    }
    .menu a .select{
        border: 4px solid #F2F5A9;
        border-radius: 4px;
    }
    .menu a img:hover{
        border: 4px solid #F2F5A9;
        border-radius: 4px;
        cursor: pointer;
    }
    a{
        text-decoration: none;
        color: #000;
    }

     a:hover{
        text-decoration: none;
        color: #000;
     }
     input{
        border-radius: 4px;
        background: transparent;
        border: 1px solid #fff;
        width: 100%;
        margin-top: 2px;
     }
     button{
        border-radius: 4px;
        background: transparent;
        border: 1px solid #fff;
        padding-top: 2px;
        padding-bottom: 2px;
        padding-left: 25px;
        padding-right: 25px;
        margin-top: 5px;
     }
    ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 0px;
        padding-right: 0px;
        font-size: 12px;
    }
    ::-moz-placeholder { /* Firefox 19+ */
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 0px;
        padding-right: 0px;
        font-size: 12px;
    }
    :-ms-input-placeholder { /* IE 10+ */
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 0px;
        padding-right: 0px;
        font-size: 12px;
    }
    :-moz-placeholder { /* Firefox 18- */
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 0px;
        padding-right: 0px;
        font-size: 12px;
    }

    input { /* Chrome/Opera/Safari */
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 15px;
        padding-right: 15px;
        font-size: 12px;
    }
</style>
<body id="">
    <div class="container-fluid" style="margin: 0;" id="menu">
        <div class="row" align="right" style="width: 100%">
            <div class="col-md-12"> 
                <div class="col-md-10" style="padding-top: 5px"> 
                    <a target="_blank" href="https://twitter.com/sscacolombia"><img src="../../img/icono twiter.png" width="25"></a>&nbsp;
                    <a target="_blank" href="https://www.youtube.com/channel/UCkZ6kVJWgmS9vQJ3_mK5NAA"><img src="../../img/icono youtube.png" width="25"></a>&nbsp;
                    <a target="_blank" href="https://www.facebook.com/SSCA-535192806677054/"><img src="../../img/icono face.png" width="25"></a>&nbsp;
                    <a target="_blank" href="https://plus.google.com/109158087234743471968"><img src="../../img/ICONO google.png" width="25"></a>
                </div>    
                <div class="col-md-2" style="padding-top: 5px"> 
                    <a target="_blank" href="../usuarios_sistema/loginInterno">Login</a>
                </div>
            </div>
        </div>
    </div>    
    
    <div class="container-fluid" style="top:82px;background-image:url(../../img/Contactenos.jpg); background-repeat:no-repeat; background-size: 100% 100%;width: 100%; position: absolute;" id="body"><br><br>
        <div class="row" style="">  
            <div class="col-md-12 tituloPage" style="background: #000; padding-top: 6px; padding-bottom: 6px; letter-spacing: 6px; color: #fff; font-size: 20px; opacity: .3; text-shadow: 5px 5px 5px #aaa;" align="center"> 
                OPTIMIZAMOS SERVICIOS ESCOLARES
            </div>            
        </div>
        <div class="row">
            <div class="col-md-12 menu" align="center" style="">
                <a href="../inicio"><img src="../../img/btn Inicio.png" width="90px"></a>
                <a href="../inicio/identificacion"><img src="../../img/btn sistemas de identificacion.png" width="90px"></a>
                <a href="../inicio/rutas"><img src="../../img/btn ruta escolar.png" width="90px"></a>
                <a href="../inicio/restaurante"><img src="../../img/btn restaurante.png" width="90px"></a>
                <a href="../inicio/cafeteria"><img src="../../img/btn cafeteria.png" width="90px"></a>
                <a href="../inicio/tarjeta"><img src="../../img/btn tarjeta monedero.png" width="90px"></a>
                <a href="../inicio/control"><img src="../../img/btn sistemas de control.png" width="90px"></a>
                <a href="../inicio/contactenos"><img class="select" src="../../img/btn contactenos.png" width="94px"></a>
            </div>   
        </div><br>   
        <div class="row" style="">
            <div class="col-md-4" style="background: #000; opacity: .4; padding: 15px 35px 140px 25px; color: #fff; opacity: .3; letter-spacing: 2px;">
                <h3 style="font-family: Arial; opacity: 4;">CONTACTENOS</h3><br>
                <p style="opacity: 1; font-family: Arial">Contamos con productos y servicios a su medida y para lo que usted necesita</p>
                <form class="cmxform" method="POST" action="" id="commentForm">
                    <input placeholder="Nombre (*)" class="textoPage" id="txtNombre" name="txtNombre" /><br>
                    <input placeholder="E-Mail (*)" class="textoPage" id="txtEmail" name="txtEmail" /><br>
                    <input placeholder="Mensaje (*)" class="textoPage" id="txtMensaje" name="txtMensaje" />
                    
                    <div style="width: 100%" align="right"><button type="submit" id="btnEnviar">Enviar</button></div>
                </form>
                <p>Línea de atención<br> en Bogotá, Colombia  +571 6967192<br>E-mail : info@ssca-colombia.com<br><br>Siguenos en : </p>
                <div style="width: 100%; margin-top: -30px; opacity: 1" align="right">
                    <a target="_blank" href="https://www.facebook.com/SSCA-535192806677054/"><img src="../../img/facebook_C.png" width="48"></a>
                    <a target="_blank" href="https://twitter.com/sscacolombia"><img src="../../img/Twitter_C.png" width="48"></a>
                    <a target="_blank" href="https://www.youtube.com/channel/UCkZ6kVJWgmS9vQJ3_mK5NAA"><img src="../../img/Youtube_C.png" width="48"></a>
                    <a target="_blank" href="https://plus.google.com/109158087234743471968"><img src="../../img/google_C.png" width="48"></a> 
                </div>
                
            </div>
            <div class="col-md-8" style="padding: 0"><br>
                
            </div>
        </div>
        
    </div>

    <div class="container-fluid" style="margin: 0;" id="logo">
        <div class="row" align="left" style="width: 100%">
            <div class="col-md-4" style="padding: 0">
                <img src="../../img/logo app.png" width="150" style="margin-left: 30px; position: absolute; top: -17px">
            </div>
            <div class="col-md-8 tituloPage" style="padding: 0; font-size: 20px; color: #00b0ff; padding-top:20px;" align="center">
                SCHOOL SERVICE <label style="background: url(../../img/textura2.png); color: #fff">&nbsp;&nbsp;and CONTROL ACCESS&nbsp;&nbsp;</label>
            </div>
        </div>
    </div>   
    <script src="<?= base_url(1);?>js/jquery.validate.js"></script>
    <script>
        window.addEventListener('load',init);
        function init(){
            
        }
        // JavaScript Document
        $(document).ready(function() {
            // Actualizamos el fondo al cargar la pagina
            
            /*var screenWidth = $(window).width();
            var screenHeight = $(window).height();
            var dimension = screenWidth + "px " + screenHeight + "px";
            var height = screenHeight + "px";
            
            $( "#body" ).css({
              "height": height
            });
            alert(screenHeight)
            $(window).bind("resize", function() {
                // Y tambien cada vez que se redimensione el navegador
                var screenWidth = $(window).width();
                var screenHeight = $(window).height();
                var dimension = screenWidth + "px " + screenHeight + "px";
                var height = screenHeight + "px";
                $( "#body" ).css({
                  "height": height
                });
            });*/
            
            
        });
        $.validator.setDefaults({
            //Capturar evento del boton crear
            submitHandler: function() {
              var nombre = $("#txtNombre").val();
              var email = $("#txtEmail").val();
              var mensaje = $("#txtMensaje").val();             
        
            //Se guardan los datos en un JSON
            var datos = {
              nombre: nombre,
              email: email,
              mensaje: mensaje
            }   
            $("#btnEnviar").attr("disabled", "disabled")
              $.post("<?= base_url();?>index.php/inicio/enviarMensaje", datos)
              .done(function( data ) {console.log(data)
                alert("¡Se envio con exito el mensaje!")
                window.location.href = "<?= base_url();?>index.php/inicio/contactenos";
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
            txtEmail: "required",
            txtMensaje: "required"
          },
          messages: {
            txtNombre: "Por favor ingrese un nombre",
            txtEmail: "Por favor ingrese un e-mail",
            txtMensaje: "Por favor ingrese un mensaje"
          }
        });
      
      })();
    </script>       
</body>
</html>
