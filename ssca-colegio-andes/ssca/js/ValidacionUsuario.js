// JavaScript Document

$( document ).ready(function() {
	var usuario = localStorage.getItem("usuario"); 
	var tipoUsuario = localStorage.getItem("tipoUsuario"); 
	
	if(usuario == null){
		window.location.href = "index.html";
	}else{
		ValidarTipoUsuario(tipoUsuario);
	}
	
	function ValidarTipoUsuario(tipo){
		switch (tipo){
			case "Acudiente":
				$("#AdminCredenciales").css({"display":"block"});
				$("#RutaEscolar").css({"display":"block"});
				$("#RestriccionConsumo").css({"display":"block"});
				$("#ReemplazoCredencial").css({"display":"none"});				
				$("#CentroOperacion").css({"display":"none"});		
				$("#RestauranteAcudientes").css({"display":"block"});
				break;
			
			case "Funcionario":
				$("#RecargueCredencial").css({"display":"block"});
				$("#Reportes").css({"display":"block"});
				$("#RestauranteAcudientes").css({"display":"none"});
				break;
				
			case "Admin":
				
				break;
		}
	}
});
