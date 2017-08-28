// JavaScript Document

$( document ).ready(function() {
	var usuario = localStorage.getItem("usuario"); 
	var permisos = localStorage.getItem("permisos"); 
	
	if(usuario == null){
		window.location.href = "indexusuariointerno.html";
	}else{
		ValidarTipoUsuario(permisos);
	}

	function ValidarTipoUsuario(tipo){
		switch (tipo){
			case "Acudiente":
				$("#AdminCredenciales").css({"display":"block"});
				$("#RutaEscolar").css({"display":"block"});
				$("#RestriccionConsumo").css({"display":"block"});
				$("#ReemplazoCredencial").css({"display":"none"});				
				break;
			
			case "Funcionario":
				$("#RecargueCredencial").css({"display":"block"});
				$("#Reportes").css({"display":"block"});
				break;
				
			case "Admin":
				
				break;
		}
	}
	
	
});