<style>
    #commentForm label.error,  label.error{
        width: auto;
        display: block;
        color:#F00;
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
    
    <div class="container-fluid" style="top:82px;background-image:url(../../img/qr-Ssca.png); background-repeat:no-repeat; background-size: cover;width: 100%; position: absolute;" id="body"><br><br>
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
                <a href="../inicio/control"><img class="select" src="../../img/btn sistemas de control.png" width="94px"></a>
                <a href="../inicio/contactenos"><img src="../../img/btn contactenos.png" width="90px"></a>
            </div>   
        </div><br>   
        <div class="row" style="">
            <div class="col-md-4" style="background: #000; opacity: .4; padding: 15px 35px 140px 25px; color: #fff; opacity: .3; letter-spacing: 2px;">
                <h3 style="font-family: Arial; opacity: 4;">SISTEMAS de CONTROL<br>por LECTURA DE CODIGOS</h3><br>
                <p style="opacity: 1; font-family: Arial">Sistemas de control eficientes y rapidos a partir de lectura de códigos</p>
                <ul style="margin-left: 10%; list-style-type: none;" class="textoPage">
                    <li>Administración de inventarios</li>
                    <li>Control de Accesos</li>
                    <li>Validación de Información</li>
                    <li>Dispositivos de Lectura</li>
                    <li>Software de lectura para moviles</li>
                    <li>Códigos de Barras</li>
                    <li>Códigos QR</li>
                    <li>Reconocimiento facial</li>
                </ul>
                
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
    </script>       
</body>
</html>
