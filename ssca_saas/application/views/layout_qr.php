<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>QR</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>

<body>
   	<img src="" width="170" height="170" id="imageQR"/> 
    
   
    <script type="text/javascript">
		window.addEventListener('load',init);
	function init(){
		var resultado = localStorage.getItem("Resultado"); 
		
		var jsonUsuario = JSON.parse(resultado);

		
		//if(jsonUsuario.length > 0){
			$.each(jsonUsuario, function(i, item) {
				console.log(item);				
				var datos = {
					data: item.idCredencial
				}					
				//Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage
				$.post("<?= base_url(1);?>index.php/credenciales/generarQR", datos)
				.done(function( respuesta ) {console.log(respuesta)
					$("#imageQR").attr("src", "<?= base_url(1);?>" + respuesta);
				});			
				
			})
		//}
		
		
		
	}
	$("#btnImprimir").click(function(e) {
        window.print()
		 
    });
	</script>
    
	
</body>
</html>
