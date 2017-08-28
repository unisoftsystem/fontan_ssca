<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SSCA</title>
        <link href="css/style.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/style.js"></script>  
        <script type="text/javascript" src="js/ConexionWebService.js"></script>
        <script type="text/javascript" src="js/alertify.js"></script>
        <link rel="stylesheet" href="css/alertify.core.css" />
        <link rel="stylesheet" href="css/alertify.default.css" />
        <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">  
        <script type="text/javascript">
            function nobackbutton(){
               window.location.hash="no-back-button";
               window.location.hash="Again-No-back-button" 
               window.onhashchange=function(){window.location.hash="no-back-button";} 
            }
        </script>     
    </head>
    
    <body id="bodyLogin" onload="nobackbutton();">
    
        <footer class="footer" align="right">
            <div style="" class="recuadroLogin">
                <form id="commentForm" method="post" action="#">
                    <table height="100%" style="padding-left:10%; padding-top:5%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="left"><img src="images/UserName.png" width="80" style="opacity:.9 "/></td>
                            <td width="20px">&nbsp;</td>
                            <td align="left"><input id="txtUsuario" name="txtUsuario" type="text" required/></td>
                        </tr>
                        <tr>
                            <td colspan="3" height="1px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="left"><img src="images/Password.png" width="80" style="opacity:.9 "/></td>   
                            <td width="20px">&nbsp;</td>
                            <td align="left"><input id="txtClave" name="txtClave" type="password" required/></td>
                        </tr>
                        <tr>
                            <td align="right" colspan="3"><button type="submit" id="btnIngresar" name="btnIngresar"><img src="images/Ingresar.png" width="80" style="opacity:.9 "/></button></td>
                        </tr>
                    </table>
                </form>
                <script src="js/jquery.js"></script>
                <script src="js/jquery.validate.js"></script>
                <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
                <script>
                    $.validator.setDefaults({
                        submitHandler: function() {
                            //Envio de datos si todo esta bien
                            var usuarioIngresado = $("#txtUsuario").val();
                            var clave = $("#txtClave").val();
                            
                            //Se guardan los datos en un JSON
                            var usuario = {
                                usuario: usuarioIngresado,
                                clave: clave
                            }       
                            EnviarDatos(usuario, "../ssca/ActionIniciarSesionAcudiente.php", "USUARIOSESIONACUDIENTE");        
                        },
                        showErrors: function(map, list) {
                            // there's probably a way to simplify this
                            var focussed = document.activeElement;
                            if (focussed && $(focussed).is("input, textarea")) {
                                $(this.currentForm).tooltip("close", {
                                    currentTarget: focussed
                                }, true)
                            }
                            this.currentElements.removeAttr("title").removeClass("ui-state-highlight");
                            $.each(list, function(index, error) {
                                $(error.element).attr("title", error.message).addClass("ui-state-highlight");
                            });
                            if (focussed && $(focussed).is("input, textarea")) {
                                $(this.currentForm).tooltip("open", {
                                    target: focussed
                                });
                            }
                        }
                    });
                    
                    (function() {
                        // use custom tooltip; disable animations for now to work around lack of refresh method on tooltip
                        $("#commentForm").tooltip({
                            show: false,
                            hide: false
                        });
                    
                        // validate the comment form when it is submitted
                        $("#commentForm").validate({
                            rules: {
                                txtUsuario: "required",
                                txtClave: {
                                    required: true,
                                    minlength: 1
                                }
                            },
                            messages: {
                                txtUsuario: "Por favor ingrese un usuario",
                                txtClave: "Por favor ingrese una clave"
                            }
                        });
                    })();
                </script>
            </div>
        </footer>
        
    </body>
</html>
