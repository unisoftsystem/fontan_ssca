<?php
    $UserName = $this->session->userdata('UserIDInternoSSCA');
    if(!empty($UserName)) { // Recuerda usar corchetes.
        header('Location: ' . base_url() . "index.php/usuarios_sistema/homeInternoModulos");
    } 
    $pedido = $this->session->userdata('PedidoSSCASESSION');
    if($pedido != "[]" && $pedido != null && $pedido != "") { // Recuerda usar corchetes.
        header("Location: " . base_url() . "index.php/ordenpedido/borrarSesionTodo?session=" . $this->session->userdata('UserIDInternoSSCA'));
        //echo "<script>alert('ok')</script>";
    }
?>
<style>
    #commentForm label.error,  label.error{
        width: auto;
        display: block;
        color:#F00;
        font-size:12px;
        padding-bottom: 0px;
    }
</style>
<script type="text/javascript">
    function nobackbutton(){
       window.location.hash="no-back-button";
       window.location.hash="Again-No-back-button" 
       window.onhashchange=function(){window.location.hash="no-back-button";} 
    }
</script>
<body id="bodyLogin" onload="nobackbutton();">
    
        <footer class="footer" align="right">
            <div style="" class="recuadroLogin">
                <form id="commentForm" method="post" action="<?= base_url();?>index.php/usuarios_sistema/loginUsuarioInterno" class="cmxform"><br>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4" align="right">
                                <img src="<?= base_url();?>images/UserName.png" width="80" style="opacity:.9"/>
                            </div>
                            <div class="col-md-8" align="left">
                                <input id="txtUsuario" name="txtUsuario" type="text"/>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px">
                            <div class="col-md-4" align="right">
                                <img src="<?= base_url();?>images/Password.png" width="80" style="opacity:.9 "/>
                            </div>
                            <div class="col-md-8" align="left">
                                <input id="txtClave" name="txtClave" type="password" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" align="right">
                                <button type="submit" id="btnIngresar" name="btnIngresar"><img src="<?= base_url();?>images/Ingresar.png" width="80" style="opacity:.9 "/></button>
                            </div>
                        </div>                            
                    </div>


                    <table height="100%" style="padding-left:10%; padding-top:5%; margin-left: 10%; margin-top:2%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="left"></td>
                            <td width="20px">&nbsp;</td>
                            <td align="left"></td>
                        </tr>
                        <tr>
                            <td colspan="3" height="1px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="left"></td>   
                            <td width="20px">&nbsp;</td>
                            <td align="left"></td>
                        </tr>
                        <tr>
                            <td align="right" colspan="3"></td>
                        </tr>
                    </table>
                </form>
                <script src="<?= base_url();?>js/jquery.validate.js"></script>      
                <script type="text/javascript">
            
                    (function() {
                        
                        $("#commentForm").tooltip({
                            show: false,
                            hide: false
                        });
                    
                        /*
                            Validar campos en el form. En este caso no se agrega codigo para cuando esta llenado el form de forma correcta. Esto lo realiza el action del form.
                            Se establecen las reglas de los campos y sus mensajes.
                        */
                        $("#commentForm").validate({
                            rules: {
                                txtUsuario: "required",
                                txtClave: "required"
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
