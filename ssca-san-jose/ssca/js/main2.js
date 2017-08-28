$(document).ready(function(){
	$('#reader').html5_qrcode(function(data){
			//Mostrar resultado de escanear codigo qr
			$('#read').html(data);
		},
		function(error){
			//Mostrar error cuando se trata de leer el qr, es Opcional
			//$('#read_error').html(error);
		}, function(videoError){
			//Mostrar error en video, es Opcional
			//$('#vid_error').html(videoError);
		}
	);
});