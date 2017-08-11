	<?php
	    $UserName = $this->session->userdata('UserNameInternoSSCA');
	    if(empty($UserName)) { // Recuerda usar corchetes.
	        header('Location: ' . base_url());
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
	<script src="<?= base_url();?>js/html5-qrcode.min.js"></script>
	<script type="text/javascript">
	    function nobackbutton(){
	       window.location.hash="no-back-button";
	       window.location.hash="Again-No-back-button" 
	       window.onhashchange=function(){window.location.hash="no-back-button";} 
	    }
    </script>
	<script>
		$(document).ready(function(){
			$('#reader').html5_qrcode(function(data){
					//Mostrar resultado de escanear codigo qr
					
					$.post("../ordenpedido/ActionConsultarUsuarioPorId", {usuario: data})
					.done(function( result ) {console.log(result)
						if($.trim(result) != "[]"){
							var jsonUsuario = JSON.parse(result);
							var datos = {
								SaldoCredencial: jsonUsuario[0].SaldoCredencial,
								idCredencial: jsonUsuario[0].idCredencial,
								usuario: jsonUsuario[0].idUsuario,
								ValorRestriccion: jsonUsuario[0].ValorRestriccion,
								primerNombre: jsonUsuario[0].PrimerNombre,
								segundoNombre: jsonUsuario[0].SegundoNombre,
								primerApellido: jsonUsuario[0].PrimerApellido,
								segundoApellido: jsonUsuario[0].SegundoApellido,
								ImagenFotografica: jsonUsuario[0].ImagenFotografica
							}
							$.post("../ordenpedido/guardarSesion", datos)
							.done(function( respuesta ) {
								window.location.href = "../ordenpedido/cajeroProductos";
							});
						}
					});	
				},
				function(error){
					//Mostrar error cuando se trata de leer el qr, es Opcional
					//$('#read_error').html(error);
					console.log(error);
				}, function(videoError){
					//Mostrar error en video, es Opcional
					//$('#vid_error').html(videoError);
				}
			);
		});
    </script>
	<body id="bodyBase" onload="nobackbutton();">
		<ul class="nav navbar-nav windowHidden" style="display: none;">                
	        <li class="dropup">
	            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="background: #4b67a8;
	        border: 1px solid #2e4588; color:#FFF;width: 350px; height: 42px; border-radius: 2px"><i class="fa fa-chevron-up"></i></a>
	            <ul class="dropdown-menu">
	            </ul>
	        </li>
	    </ul>
	    <input type="hidden" id="txtUserId" name="txtUserId" value="<?= $this->session->userdata('UserIDInternoSSCA');?>" /> 
		<h4 style="color:#CCC;margin-left:10px">Bienvenido(a): <?= $this->session->userdata('UserNameInternoSSCA');?></h4>
        <h1 align="right" style="margin-top:2%; margin-right:2%; color:#00C; visibility:hidden"><?= $titulo;?></h1>
        <div id='cssmenu'>
            <ul>            	
               	<li class="" id="OpcionSalir">
					<a href='#' title="Cerrar Sesi&oacute;n">
						<span>Cerrar Sesi&oacute;n</span>
					</a>
				<ul style="margin-right:-42%">

				</ul>
               </li>    
            </ul>
        </div>
		<div class="contenidoBorde">
        	<div  class="center" id="reader" style="width:100%;height:99%"></div>
        </div>
        <div class="container">
	        <div class="row" align="center" id="chats">           
	            
	        </div>
	    </div>
	    <script src="http://190.60.211.17:3003/socket.io/socket.io.js"></script>
        <script type="text/javascript" src="../../js/chat.js"></script>
        <script>
        	window.addEventListener('load',init);
			function init(){
				
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
        </script>		
           
	</body>
</html>