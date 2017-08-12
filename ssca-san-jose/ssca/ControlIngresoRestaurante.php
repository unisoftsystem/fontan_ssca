<?php
$y = date("Y");
$m = date("m");
function genMonth_Text($m) { 
 switch ($m) { 
  case 1: $month_text = "Enero"; break; 
  case 2: $month_text = "Febrero"; break; 
  case 3: $month_text = "Marzo"; break; 
  case 4: $month_text = "Abril"; break; 
  case 5: $month_text = "Mayo"; break; 
  case 6: $month_text = "Junio"; break; 
  case 7: $month_text = "Julio"; break; 
  case 8: $month_text = "Agosto"; break; 
  case 9: $month_text = "Septiembre"; break; 
  case 10: $month_text = "Octubre"; break; 
  case 11: $month_text = "Noviembre"; break; 
  case 12: $month_text = "Diciembre"; break; 
 } 
 return ($month_text); 
} 
$m = genMonth_Text($m); 

$date = "$m";    
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="chrome=1" />
        
        <link href="css/style.css" rel="stylesheet"/>
        <link href="css/menu.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/style.js"></script>	
        <script type="text/javascript" src="js/ConexionWebService.js"></script>
        <!--<script type="text/javascript" src="js/ValidacionUsuario.js"></script>-->
        <script src="js/script.js"></script>
        <script src="js/jquery-1.9.1.min.js"></script>
    	<script src="js/html5-qrcode.min.js"></script>
        
        <script>
			$(document).ready(function(){
				$('#reader').html5_qrcode(function(data){
						//Mostrar resultado de escanear codigo qr
						//$('#read').html(data);
            $.ajax({
             type: 'post',
             url: 'respuestaqr.php',
             data: {
               usuario:data
             },
             success: function (response) {
               document.getElementById("new_select").innerHTML=response; 
             }
           });
						console.log(data);
						
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
        <title>SSCA</title>
    <style>
        .contenidoBorde{
        width: 99%; 
        border:solid #CCC; 
        height:68%; 
        top:3%; 
        position:relative;
        overflow:auto;
        }
        h2 {
              text-shadow: 0px 2px 3px #555;
              }
    </style>	
    </head>
    <body id="bodyBase">
    	<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Cafeteria - Gestion Administrativa</h4>
        <h2 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Control Ingreso - Restaurante</h2>  
        <div class="contenidoBorde">
        <center><div class="center" id="reader" style="width:70%;height:350px;"></div>
         <span id="read" class="center"></span>
         <div id="new_select">
          
        </div>
        </div></center>
	      
		<script>
        	window.addEventListener('load',init);
			function init(){
				var usuarioSesion = localStorage.getItem("usuario"); 
				console.log(usuarioSesion);
				$("#usuarioSesion").html(usuarioSesion);
			}
			$("#Salir").click(function(e) {
                localStorage.removeItem("usuario");
				localStorage.removeItem("tipoUsuario");
				window.location.href = "index.html";
            });
        </script>		
           
    </body>
</html>
