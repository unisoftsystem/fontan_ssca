<style>  
  #commentForm label.error {
    margin-left: 10px;
    width: auto;
    display: inline;
    color:red;
    font-size:12px;
  }
  #bodyBase{
    background-image:none;
    overflow:auto; 
  }
  label.errorDato{
    width: auto;
    display: inline;
    color:red;
    font-size:12px;
  }
  .footer {
    position:absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    /* Set the fixed height of the footer here */
    height: 13%;
    background-color: #f5f5f5;
  }
 
  
    


</style>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1749329-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">
  function nobackbutton(){
     window.location.hash="no-back-button";
     window.location.hash="Again-No-back-button" 
     window.onhashchange=function(){window.location.hash="no-back-button";} 
  }
</script>
<body id="bodyBase" onload="nobackbutton();">
  
  <div class="container-fluid">
    
    <form class="cmxform" method="POST" action="" id="commentForm">
      <div class="row">
        <div class="col-md-12" style="background-color: #f5f5f5; padding-top: 10px; padding-bottom: 10px">
            <img src="<?= base_url(1);?>img/HOME.png" width="200" height="100" border="0" style="top: 0px">           
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
            <h3 class="text-primary text-right">
                <?= $titulo;?>
            </h3>
        </div>
      </div>
      

      <div class="row">
      
        <div class="col-md-12">
          <h4 class="text-primary">Nombre:</h4>
          <hr>
          
          <div class="form-group">
              <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="" disabled="disabled">
          </div>

          <h4 class="text-primary">E-mail:</h4>
          <hr>
          <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="" disabled="disabled">          

          <h4 class="text-primary">Mensaje:</h4>
          <hr>
          <textarea class="form-control" id="txtMensaje" name="txtMensaje" placeholder=""></textarea>
          
          <hr>
          <button type="submit" id="btnEnviar" class="btn btn-primary pull-right">ENVIAR</button>
        </div>

      </div><br>

    </form>
  
  </div>
      <script src="<?= base_url(1);?>js/jquery.validate.js"></script>
      <script type="text/javascript">      

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
            $("button").addClass("disabled")
            $.post("<?= base_url();?>index.php/rutas/enviarMensajeContactenos", datos)
            .done(function( data ) {
              alert("¡Se envio con exito el mensaje!")
              $("input").val("");
              $("textarea").val("");
              window.close();
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
          $("#txtNombre").val($_GET("email"))
          $("#txtEmail").val($_GET("name"))
        })();
        

       
        function $_GET(param) {
          /* Obtener la url completa */
          url = document.URL;
          /* Buscar a partir del signo de interrogación ? */
          url = String(url.match(/\?+.+/));
          /* limpiar la cadena quitándole el signo ? */
          url = url.replace("?", "");
          /* Crear un array con parametro=valor */
          url = url.split("&");

          /* 
          Recorrer el array url
          obtener el valor y dividirlo en dos partes a través del signo = 
          0 = parametro
          1 = valor
          Si el parámetro existe devolver su valor
          */

          x = 0;
          while (x < url.length) {
            p = url[x].split("=");

            if (p[0] == param) {
              return decodeURIComponent(p[1]);
            }
            x++;
          }
        }
      </script> 
     
      <footer class="footer">
        <img alt="" src="<?= base_url(1);?>images/logo.png" width="300" height="110"  border="0"></footer>
      </footer>
    </body>
</html>