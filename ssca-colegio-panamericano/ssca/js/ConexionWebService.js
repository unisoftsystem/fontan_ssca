// JavaScript Document
/***
Fecha: 			Octubre 21 de 2015
Decripcion:		Script para conectarse a una webservice enviandoles como parametros unos datos en JSON y generando una 		respuesta que sera retornada en la funcion que hace la conexion

**/
var saldoActual = 0;
var jsonCarrito = new Array();

function Obtener_Total(){
	var total = 0;
	
	$.each(jsonCarrito, function(i, item) {
		total += parseInt(jsonCarrito[i].total);
	});	
	return total;
}

function scriptMenu(){
	$('#cssmenu > ul > li > a').click(function() {
		var id = $(this).attr("data-id");
		localStorage.setItem("idCollapase",id);
		//alert(id);
		EnviarDatos({idCategoria: id}, "ActionListarSubCategorias.php", "LISTARSUBCATEGORIASPEDIDOS");
	  $('#cssmenu li').removeClass('active');
	  $('#cssmenu li').addClass('desactive');
	  $(this).closest('li').removeClass('desactive');	
	  $(this).closest('li').addClass('active');	
	  var checkElement = $(this).next();
	  
	  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
		$(this).closest('li').removeClass('active');
		checkElement.slideUp('normal');
	  }
	  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
		$('#cssmenu ul ul:visible').slideUp('normal');
		checkElement.slideDown('normal');
	  }
	  if($(this).closest('li').find('ul').children().length == 0) {
		return true;
	  } else {
		return false;	
	  }		
	});
	$('#cssmenu > ul > li > ul > li > a').click(function() {
		$('#cssmenu li ul li').removeClass('active');
		$('#cssmenu li ul li').addClass('desactive');
		
		$(this).closest('li ul li').removeClass('desactive');	
		$(this).closest('li ul li').addClass('active');	
	});
}

function cargaContextoCanvas(idCanvas){
   var elemento = document.getElementById(idCanvas);
   if(elemento && elemento.getContext){
      var contexto = elemento.getContext('2d');
      if(contexto){
         return contexto;
      }
   }
   return FALSE;
}

/*
	Funcion para realizar la conexion al webservice, sirve como modelo para realizar la conexion a distintos webservice
*/
function EnviarDatos(ArrayDatos, url, operacion){
	
	//localStorage.removeItem("Resultado");
	
	$.ajax({
		url:url,
		async:"false",
		type:"POST",
		data:ArrayDatos,
		success: function(data){
			//Guarda el resultado en una localstorage
			localStorage.setItem("Resultado",data);
			
			//Llama a la funcion para validar el resultado
			ValidarResultado(operacion);
		},
		error: function ( jqXHR, textStatus, errorThrown ){
			console.log(errorThrown);
		}
	});	
}

/***
Fecha: 			Octubre 21 de 2015
Decripcion:		Script para subir una foto a un servidor

**/

/*
	Funcion para realizar la conexion al webservice, sirve como modelo para realizar la conexion a distintos webservice
*/
function SubirFoto(ArrayDatos, url, operacion){
	
	localStorage.removeItem("Resultado");
	
	$.ajax({
		url:url,
		async:"false",
		type:"POST",
		data:ArrayDatos,
		contentType:false,
		processData:false,
		success: function(data){
			//Guarda el resultado en una localstorage
			localStorage.setItem("Resultado",data);
			
			//Llama a la funcion para validar el resultado
			ValidarResultado(operacion);
		},
		error: function ( jqXHR, textStatus, errorThrown ){
			console.log(errorThrown);
		}
	});
	
}


//Funcion para validar las acciones con respecto al resultado que dio la conexion al webserive dependiendo de la operacion que se este realizando
function ValidarResultado(operacion){
	
	switch(operacion){
		case "CREARUSUARIO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			alert("Se ingreso con exito el usuario");
			var jsonUsuario = JSON.parse(resultado);
			$("input").val("")
			if(jsonUsuario.length > 0){
				$.each(jsonUsuario, function(i, item) {
					//alert("Se ingreso con exito el usuario");
					var win = window.open("Carnet.html", '_blank');
  					win.focus();						
					
				})
			}
			
		break;

		case "CREARMONITOR": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			alertify.success("Se ingreso con exito el monitor");	
			var jsonUsuario = JSON.parse(resultado);
			if(jsonUsuario.length > 0){
				$.each(jsonUsuario, function(i, item) {
					//alert("Se ingreso con exito el usuario");
					var win = window.open("CarnetFuncionario.html", '_blank');
  					win.focus();						
					
				})
			}
			
		break;	

		case "MODIFICARCONDUCTOR": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			alertify.alert("¡Se modifico con exito el conductor!", function(){
				window.location.href = "ModificarConductores.html";
			});				
		break;	
		
		case "MODIFICARVEHICULO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			if($.trim(resultado) == "1"){
				alertify.alert("¡Se modifico con exito el vehiculo!", function(){
					window.location.href = "ModificarVehiculos.html";
				});				
			}
		break;	
		
		case "MODIFICARMONITOR": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			alertify.alert("¡Se modifico con exito el monitor!", function(){
				window.location.href = "ModificarMonitor.html";
			});				
		break;	

				
		case "CREARCONDUCTOR": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			alertify.success("Se ingreso con exito el conductor");	
			var jsonUsuario = JSON.parse(resultado);
			if(jsonUsuario.length > 0){
				$.each(jsonUsuario, function(i, item) {
					//alert("Se ingreso con exito el usuario");
					var win = window.open("CarnetFuncionario.html", '_blank');
  					win.focus();						
					
				})
			}
			
		break;	

		
		case "CREARUSUARIOACUDIENTE": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			alert("Se ingreso con exito el usuario");
			//Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage
			EnviarDatos({}, "ActionListarAcudientes.php", "LISTARACUDIENTES");
			
		break;
		
		case "CREARCATEGORIA": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			if($.trim(resultado) == "1"){
				$('#selectTipo > option[value="Categoria"]').attr('selected', 'selected');
				alert("Se ingreso con exito la categoria");
			}
			
		break;
		case "CREARCURSO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			if($.trim(resultado) == "1"){
				alert("Se ingreso con exito el curso");
			}
			
		break;
		
		case "CREARPRODUCTO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			if($.trim(resultado) == "1"){
				$('#selectCategoria > option[value="Seleccione"]').attr('selected', 'selected');
				$("#selectSubcategoria").html("")
				alert("Se ingreso con exito el producto");
			}
			
		break;

		case "CREARSUBSIDIO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			alertify.alert("¡Subsidio creado con exito!", function(){
				window.location.href = "NuevoSubsidio.html";
			});	
		break;

		case "CREARMENUDIA": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			alertify.alert("¡Menu del dia creado con exito!", function(){
				window.location.href = "NuevoMenuDia.html";
			});	
		break;

		case "CREARMENUESPECIAL": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			alertify.alert("¡Menu especial creado con exito!", function(){
				window.location.href = "NuevoMenuEspecial.html";
			});	
		break;
		
		case "CREARPROTEINAPOPUP": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			
			var jsonProteina = JSON.parse(resultado);
			
			if($.trim(jsonProteina[0].codigo) == "1"){
				alertify.alert(jsonProteina[0].Mensaje + "", function(){
					EnviarDatos({}, "ActionListarProteinas.php", "LISTARPROTEINAS");	
					$("#txtNombreProteina").val();
					opcionSeleccionar = jsonProteina[0].codigoProteina;
					$('#popup').fadeOut('slow', function(){
						console.log(opcionSeleccionar);
					});
				});
			}else{
				alertify.alert(jsonProteina[0].Mensaje + "");	
			}
				
		break;
		
		case "MODIFICARPRODUCTO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			if($.trim(resultado) == "1"){
				$('#selectCategoria > option[value="Seleccione"]').attr('selected', 'selected');
				$("#selectSubcategoria").html("")
				alert("Se modifico con exito el producto");
				window.location.href = "ModificarProducto.html";
			}
			
		break;
		
		case "MODIFICATCATEGORIA": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			if($.trim(resultado) == "1"){
				$('#selectTipo > option[value="Seleccione"]').attr('selected', 'selected');
				alert("Se modifico con exito el usuario");
			}
			
		break;
		
		case "EXISTEUSUARIO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			
			if($.trim(resultado) == "1"){
				alert("El usuario ingresado ya existe");
				$("#btnCrearUsuario").css({"display":"none"});
				$("#btnCrearUsuarioPopup").css({"display":"none"});
			}else{
				$("#btnCrearUsuario").css({"display":"block"});
				$("#btnCrearUsuarioPopup").css({"display":"block"});
			}
			
		break;
		
		case "LISTARACUDIENTES": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			
			var jsonAcudientes = JSON.parse(resultado);
			
			$("#selectAcudiente").html("");
			
			$.each(jsonAcudientes, function(i, item) {
				$("#selectAcudiente").append('<option value="' + jsonAcudientes[i].usuario + '">' + jsonAcudientes[i].primerNombre + ' ' + jsonAcudientes[i].segundoNombre + ' ' + jsonAcudientes[i].primerApellido + ' ' + jsonAcudientes[i].segundoApellido + '</option>');
			});
			$('#selectAcudiente > option[value="' + opcionSeleccionar + '"]').attr('selected', 'selected');
		break;
		
		case "CONSULTARUSUARIO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			
			var jsonUsuario = JSON.parse(resultado);
			
			if(jsonUsuario.length > 0){
				$.each(jsonUsuario, function(i, item) {
					$("#txtNumeroId").val(jsonUsuario[i].numeroId);
					$("#txtUsuario").val(jsonUsuario[i].usuario);
					$("#txtPrimerApellido").val(jsonUsuario[i].primerApellido);
					$("#txtSegundoApellido").val(jsonUsuario[i].segundoApellido);
					$("#txtPrimerNombre").val(jsonUsuario[i].primerNombre);
					$("#txtSegundoNombre").val(jsonUsuario[i].segundoNombre);
					$("#txtDireccion").val(jsonUsuario[i].direccion);
					$("#txtTelefono1").val(jsonUsuario[i].telefono1);
					$("#txtTelefono2").val(jsonUsuario[i].telefono2);
					$("#txtClave").val(jsonUsuario[i].clave);
					$("#txtTipoSangre").val(jsonUsuario[i].TipoSangre);
					$("#txtFechaVencimiento").val(jsonUsuario[i].fechaVencimiento);
					$("#txtFecha").val(jsonUsuario[i].fechanacimiento);
					$('#selectCurso > option[value="' + jsonUsuario[i].curso + '"]').attr('selected', 'selected');
					$('#txtTipoId > option[value="' + jsonUsuario[i].tipoId + '"]').attr('selected', 'selected');
					$("#txtTipoUsuario").val(jsonUsuario[i].tipoUsuario);
					$('input[value=' + jsonUsuario[i].estado + ']').prop("checked",true);
					$('#imageFoto').attr('src',jsonUsuario[i].ImagenFotografica);
					opcionSeleccionar = jsonUsuario[i].idAcudiente;
					var ctx = cargaContextoCanvas('c');
					if(ctx){
						//Creo una imagen conun objeto Image de Javascript
						var img = new Image();
						//indico la URL de la imagen
						img.src = jsonUsuario[i].ImagenFotografica;
						//defino el evento onload del objeto imagen
						img.onload = function(){
							//incluyo la imagen en el canvas
							ctx.drawImage(img, 0, 0, 128, 128);
						}
					}
					
					var latitud = parseFloat(jsonUsuario[i].latitud);
					var longitud = parseFloat(jsonUsuario[i].longitud);
					var latLng = new google.maps.LatLng(latitud,longitud);
				   
				   //Definimos algunas opciones del mapa a crear
					var myOptions = {
					   center: latLng,//centro del mapa
					   zoom: 15,//zoom del mapa
					   mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc
					 };
					 //creamos el mapa con las opciones anteriores y le pasamos el elemento div
					 map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
					  
					 //creamos el marcador en el mapa
					 marker = new google.maps.Marker({
						 map: map,//el mapa creado en el paso anterior
						 position: latLng,//objeto con latitud y longitud
						 draggable: true //que el marcador se pueda arrastrar
					 });
					 
					//función que actualiza los input del formulario con las nuevas latitudes
					//Estos campos suelen ser hidden
					 updatePosition(latLng);
					
					if(jsonUsuario[i].tipoUsuario == "Estudiante"){
						$( "#rowAcudiente" ).css( "visibility", "visible" );
						
						var datos = {
							
						}
					
						//Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage
						EnviarDatos(datos, "ActionListarAcudientes.php", "LISTARACUDIENTES");
						
						//$('#selectAcudiente > option[value="' + jsonUsuario[i].idAcudiente + '"]').attr('selected', 'selected');
			
					}else{
						$( "#rowAcudiente" ).css( "visibility", "hidden" );
					}
				});
			}else{
				$("#txtNumeroId").val("");
				$("#txtUsuario").val("");
				$("#txtPrimerApellido").val("");
				$("#txtSegundoApellido").val("");
				$("#txtPrimerNombre").val("");
				$("#txtSegundoNombre").val("");
				$("#txtDireccion").val("");
				$("#txtTelefono1").val("");
				$("#txtTelefono2").val("");
				$("#txtClave").val("");
				$("#txtTipoId").val("");
				$("#txtTipoUsuario").val("");
				
				$( "#rowAcudiente" ).css( "visibility", "hidden" );
			}
			
		break;
		
		case "CONSULTARCONDUCTOR": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			
			var jsonUsuario = JSON.parse(resultado);
			
			if(jsonUsuario.length > 0){
				$.each(jsonUsuario, function(i, item) {
					$("#idconductor").val(jsonUsuario[i].idconductor);
					$("#nombre").val(jsonUsuario[i].nombre);
					$("#apellido").val(jsonUsuario[i].apellido);
					$("#direccion").val(jsonUsuario[i].direccion);
					$("#telefono").val(jsonUsuario[i].telefono);
					$("#TipoUsuario").val(jsonUsuario[i].TipoUsuario);
					$("#TipoId").val(jsonUsuario[i].TipoId);
					$("#txtFechaVencimiento").val(jsonUsuario[i].FechaVencimiento);
					$('input[value=' + jsonUsuario[i].Estado + ']').prop("checked",true);
					$('#imageFoto').attr('src',jsonUsuario[i].ImagenFotografica);
					
					var ctx = cargaContextoCanvas('c');
					if(ctx){
						//Creo una imagen conun objeto Image de Javascript
						var img = new Image();
						//indico la URL de la imagen
						img.src = jsonUsuario[i].ImagenFotografica;
						//defino el evento onload del objeto imagen
						img.onload = function(){
							//incluyo la imagen en el canvas
							ctx.drawImage(img, 10, 10);
						}
					}
					
					var Coordenadas = jsonUsuario[i].Coordenadas;
					var CoordenadasDividas = Coordenadas.split(',');

					var latitud = parseFloat(CoordenadasDividas[0]);
					var longitud = parseFloat(CoordenadasDividas[1]);
					var latLng = new google.maps.LatLng(latitud,longitud);
				   
				   //Definimos algunas opciones del mapa a crear
					var myOptions = {
					   center: latLng,//centro del mapa
					   zoom: 15,//zoom del mapa
					   mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc
					 };
					 //creamos el mapa con las opciones anteriores y le pasamos el elemento div
					 map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
					  
					 //creamos el marcador en el mapa
					 marker = new google.maps.Marker({
						 map: map,//el mapa creado en el paso anterior
						 position: latLng,//objeto con latitud y longitud
						 draggable: true //que el marcador se pueda arrastrar
					 });
					 
					//función que actualiza los input del formulario con las nuevas latitudes
					//Estos campos suelen ser hidden
					 updatePosition(latLng);					
				});
			}else{
				$("#txtUsuario").val("");
				$("#txtPrimerApellido").val("");
				$("#txtSegundoApellido").val("");
				$("#txtPrimerNombre").val("");
				$("#txtSegundoNombre").val("");
				$("#txtDireccion").val("");
				$("#txtTelefono1").val("");
				$("#txtTelefono2").val("");
				$("#txtClave").val("");
				$("#txtTipoId").val("");
				$("#txtTipoUsuario").val("");
				
				$( "#rowAcudiente" ).css( "visibility", "hidden" );
			}
			
		break;
		
		case "CONSULTARMONITOR": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			
			var jsonUsuario = JSON.parse(resultado);
			
			if(jsonUsuario.length > 0){
				$.each(jsonUsuario, function(i, item) {
					$("#idmonitor").val(jsonUsuario[i].idmonitor);
					$("#nombre").val(jsonUsuario[i].nombre);
					$("#apellido").val(jsonUsuario[i].apellido);
					$("#direccion").val(jsonUsuario[i].Direccion);
					$("#telefono").val(jsonUsuario[i].telefono);
					$("#TipoUsuario").val(jsonUsuario[i].TipoUsuario);
					$("#TipoId").val(jsonUsuario[i].TipoId);
					$("#txtFechaVencimiento").val(jsonUsuario[i].FechaVencimiento);
					$('input[value=' + jsonUsuario[i].Estado + ']').prop("checked",true);
					$("#Clave").val(jsonUsuario[i].Clave);
					$('#imageFoto').attr('src',jsonUsuario[i].ImagenFotografica);
					
					var ctx = cargaContextoCanvas('c');
					if(ctx){
						//Creo una imagen conun objeto Image de Javascript
						var img = new Image();
						//indico la URL de la imagen
						img.src = jsonUsuario[i].ImagenFotografica;
						//defino el evento onload del objeto imagen
						img.onload = function(){
							//incluyo la imagen en el canvas
							ctx.drawImage(img, 10, 10);
						}
					}
					
					var Coordenadas = jsonUsuario[i].Coordenadas;
					var CoordenadasDividas = Coordenadas.split(',');

					var latitud = parseFloat(CoordenadasDividas[0]);
					var longitud = parseFloat(CoordenadasDividas[1]);
					var latLng = new google.maps.LatLng(latitud,longitud);
				   
				   //Definimos algunas opciones del mapa a crear
					var myOptions = {
					   center: latLng,//centro del mapa
					   zoom: 15,//zoom del mapa
					   mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc
					 };
					 //creamos el mapa con las opciones anteriores y le pasamos el elemento div
					 map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
					  
					 //creamos el marcador en el mapa
					 marker = new google.maps.Marker({
						 map: map,//el mapa creado en el paso anterior
						 position: latLng,//objeto con latitud y longitud
						 draggable: true //que el marcador se pueda arrastrar
					 });
					 
					//función que actualiza los input del formulario con las nuevas latitudes
					//Estos campos suelen ser hidden
					 updatePosition(latLng);					
				});
			}else{
				
				$("#txtUsuario").val("");
				$("#txtPrimerApellido").val("");
				$("#txtSegundoApellido").val("");
				$("#txtPrimerNombre").val("");
				$("#txtSegundoNombre").val("");
				$("#txtDireccion").val("");
				$("#txtTelefono1").val("");
				$("#txtTelefono2").val("");
				$("#txtClave").val("");
				$("#txtTipoId").val("");
				$("#txtTipoUsuario").val("");
				
				$( "#rowAcudiente" ).css( "visibility", "hidden" );
			}
			
		break;
		
		case "CONSULTARVEHICULO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			
			var jsonUsuario = JSON.parse(resultado);
			
			if(jsonUsuario.length > 0){
				$.each(jsonUsuario, function(i, item) {
					$("#marca").val(jsonUsuario[i].marca);
					$("#categoria").val(jsonUsuario[i].categoria);
					$("#placa").val(jsonUsuario[i].placa);
					$("#nombreruta").val(jsonUsuario[i].nombre_ruta);
					$("#sillas").val(jsonUsuario[i].sillas);
					$("#observaciones").val(jsonUsuario[i].observaciones);
					
				});
			}else{
				$("#marca").val("");
				$("#categoria").val("");
				
				$("#nombreruta").val("");
				$("#sillas").val("");
				$("#observaciones").val("");
			}
			
		break;
		
		case "CONSULTARUSUARIOREEMPLAZOC": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			
			var jsonUsuario = JSON.parse(resultado);
			
			if(jsonUsuario.length > 0){
				$.each(jsonUsuario, function(i, item) {
					try{
					
						if(jsonUsuario[i].tipoUsuario){	
							$("#txtPrimerApellido").val(jsonUsuario[i].primerApellido);
							$("#txtSegundoApellido").val(jsonUsuario[i].segundoApellido);
							$("#txtPrimerNombre").val(jsonUsuario[i].primerNombre);
							$("#txtSegundoNombre").val(jsonUsuario[i].segundoNombre);
							$("#txtDireccion").val(jsonUsuario[i].direccion);
							$("#txtTelefono1").val(jsonUsuario[i].telefono1);
							$("#txtTelefono2").val(jsonUsuario[i].telefono2);
							$("#txtClave").val(jsonUsuario[i].clave);
							$("#txtAcudiente").val(jsonUsuario[i].idAcudiente);
							$("#txtTipoSangre").val(jsonUsuario[i].TipoSangre);
							$('#selectCurso').val(jsonUsuario[i].curso);
							$('#txtSaldo').val(jsonUsuario[i].SaldoCredencial);
							
							//$("#txtTipoUsuario").val(jsonUsuario[i].tipoUsuario);
							$('#txtTipoUsuario > option[value="' + jsonUsuario[i].tipoUsuario + '"]').attr('selected', 'selected');
							$('#imageFoto').attr('src',jsonUsuario[i].ImagenFotografica);
							//$('input[value=' + jsonUsuario[i].estado + ']').prop("checked",true);
							$( "#rowAcudiente" ).css( "visibility", "visible" );						
						}else{
							$("#txtPrimerApellido").val(jsonUsuario[i].apellido);
							$("#txtPrimerNombre").val(jsonUsuario[i].nombre);
							$("#txtDireccion").val(jsonUsuario[i].direccion);
							$("#txtTelefono1").val(jsonUsuario[i].telefono);
							//$("#txtTipoUsuario").val(jsonUsuario[i].tipoUsuario);
							$('#txtTipoUsuario > option[value="' + jsonUsuario[i].TipoUsuario + '"]').attr('selected', 'selected');
							$('#imageFoto').attr('src',jsonUsuario[i].ImagenFotografica);
							//$('input[value=' + jsonUsuario[i].estado + ']').prop("checked",true);
							$( "#rowAcudiente" ).css( "visibility", "hidden" );
							$('#txtSaldo').val(jsonUsuario[i].SaldoCredencial);
						}
						}catch(Excepcion){
					}
				});
			}else{
				$("#txtPrimerApellido").val("");
				$("#txtSegundoApellido").val("");
				$("#txtPrimerNombre").val("");
				$("#txtSegundoNombre").val("");
				$("#txtDireccion").val("");
				$("#txtTelefono1").val("");
				$("#txtTelefono2").val("");
				$("#txtClave").val("");
				$("#txtAcudiente").val("");
				$("#txtTipoUsuario").val("");
				$( "#rowAcudiente" ).css( "visibility", "hidden" );
			}
			
		break;
		
		case "CONSULTARUSUARIOCAFETERIA": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				//$.each(jsonUsuario, function(i, item) {
				localStorage.setItem("SaldoCredencial",jsonUsuario[0].SaldoCredencial);
				localStorage.setItem("idCredencialSesion",jsonUsuario[0].idCredencial);
				localStorage.setItem("idUsuarioApp",jsonUsuario[0].usuario);
				localStorage.setItem("ValorRestriccion",jsonUsuario[0].ValorRestriccion);
				localStorage.setItem("PrimerNombreUsuarioSesionApp",jsonUsuario[0].primerNombre);
				localStorage.setItem("SegundoNombreUsuarioSesionApp",jsonUsuario[0].segundoNombre);
				localStorage.setItem("PrimerApellidoUsuarioSesionApp",jsonUsuario[0].primerApellido);
				localStorage.setItem("SegundoApellidoUsuarioSesionApp",jsonUsuario[0].segundoApellido);
				

				saldoActual = parseInt(jsonUsuario[0].SaldoCredencial);
					
				//});
				window.location.href = "cafeteriaProductos.html";
			}
			
			
		break;
		
		case "CONSULTARUSUARIOENTREGA": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			//alert(resultado);
			if($.trim(resultado) != "[]"){
				var jsonUsuario = JSON.parse(resultado);
			
				
				//alert(jsonUsuario[0].idCredencial);
				localStorage.setItem("idCredencialSesionEntrega",jsonUsuario[0].idCredencial);
				localStorage.setItem("idUsuarioEntrega",jsonUsuario[0].usuario);
				localStorage.setItem("PrimerNombreUsuarioSesionEntrega",jsonUsuario[0].primerNombre);
				localStorage.setItem("SegundoNombreUsuarioSesionEntrega",jsonUsuario[0].segundoNombre);
				localStorage.setItem("PrimerApellidoUsuarioSesionEntrega",jsonUsuario[0].primerApellido);
				localStorage.setItem("SegundoApellidoUsuarioSesionEntrega",jsonUsuario[0].segundoApellido);
				localStorage.setItem("ImagenFotograficaEntrega",jsonUsuario[0].ImagenFotografica);
					
				window.location.href = "ProcesoEntrega.html";
				
			}else{
				if($.trim(resultado) == "[]"){
					alert("La credencial no tiene pedidos actualmente para entregar");
				}
			}
			
			
			
			
		break;
		
		case "CREARPEDIDO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			var json = JSON.parse(resultado);
			$.each(jsonCarrito, function(i, item) {
				if(jsonCarrito[i] != null){
					$.post("ActionAgregarProductosOrdePedido.php", {codigoProducto: jsonCarrito[i].codigoProducto, cantidad: jsonCarrito[i].cantidad, total: jsonCarrito[i].total, id: id})
					.done(function( data ) {
						if(i == (jsonCarrito.length - 1)){
							alert("¡Pedido Creado con exito!");
							localStorage.removeItem("idUsuarioApp");
							localStorage.removeItem("idCredencialSesion");
							window.location.href = "cafeteria.html";
						}
					});
					
				}
			});	
			
			
			
		break;
		
		case "LISTARCATEGORIASPEDIDO": 
			var resultado = localStorage.getItem("Resultado"); 
			
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$("#cssmenu").html("");
				var menu = '<ul>';
				
				$.each(jsonUsuario, function(i, item) {
					menu += '<li class=""><a href="#" title="' + jsonUsuario[i].Nombre + '" data-id="' + jsonUsuario[i].codigo + '" id="Categoria' + jsonUsuario[i].codigo + '"><h6><p class="full-circle"></p><span>' + jsonUsuario[i].Nombre + '</span></h6></a><ul style="margin-right:-42%" id="SubCategorias' + jsonUsuario[i].codigo + '"></ul></li>';
					
					/*menu += '<li class=""><a href="#" title="Restricción de Consumo" data-id="' + jsonUsuario[i].codigo + '" id="Categoria' + jsonUsuario[i].codigo + '"><span>' + jsonUsuario[i].Nombre + '</span></a><ul style="margin-right: -42%" id="SubCategorias' + jsonUsuario[i].codigo + '"></ul></li>';	*/
					 
				});
				menu += '</ul>';
				$("#cssmenu").html(menu);
				scriptMenu();	
			}else{								
				//alert("Los datos ingresados no estan registrados en el sistema");
			}
			
		break;
		
		case "LISTARSUBCATEGORIASPEDIDOS": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado);
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				
				var idCollapase = localStorage.getItem("idCollapase");
				
				$('#SubCategorias' + idCollapase).html('');
				var contador = 1;
				$.each(jsonUsuario, function(i, item) {					
					$('#SubCategorias' + idCollapase).append('<li id="Categoria' + idCollapase + 'subcategoria' + contador + '" data-subcategoria="' + jsonUsuario[i].codigo + '"><a href="#" title="' + jsonUsuario[i].Nombre + '"><span>' + jsonUsuario[i].Nombre + '</span></a></li>');
					
					
					
					$('#Categoria' + idCollapase + 'subcategoria' + contador).click(function(e) {
						var id = $(this).attr("data-subcategoria");
						var f = new Date();
						var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
						var dia = f.getDay();
						var idUsuarioApp = localStorage.getItem("idUsuarioApp"); 
						var idCredencialSesion = localStorage.getItem("idCredencialSesion"); 
                        EnviarDatos({subcategoria: id, dia: dia, idUsuario: idUsuarioApp, idCredencial: idCredencialSesion}, "ActionListarProductoSubCategoria.php", "LISTARPRODUCTOSSUB");
						//$( "#myPanel" ).panel( "close" );
						
                    });
					contador += 1;					
				});
				
			}else{								
				//alert("Los datos ingresados no estan registrados en el sistema");
			}
		break;
		
		case "LISTARPRODUCTOSSUB": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado);
			var contador = 0;
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]" && $.trim(resultado) != "[][]"){
				$("#TablaProductos").html("");
				var html = "";
				$("#TablaProductos").html("");
				$.each(jsonUsuario, function(i, item) {
					var fotoProducto = "";
					
					if(jsonUsuario[i].Imagen.length != 0){
						fotoProducto = jsonUsuario[i].Imagen;
					}else{
						fotoProducto = "images/logo.png";
					}
					if($.trim(jsonUsuario[i].Restriccion) == "NO"){
						html = '<div style="width:20%; border:solid 4px #CCC;display: inline-block; margin-top:5px; background-color:#FFF; padding-top:10px; height: 250px;" align="center" class="recuadro" data-fila="' + i + '" data-codigoProducto="' + jsonUsuario[i].codigoProducto + '" data-imagenProducto="' + jsonUsuario[i].Imagen + '" data-descProducto="' + jsonUsuario[i].Descripcion + '" restriccion="no">' +
						'<img src="' + fotoProducto + '" height="80px" width="60%"/><br>' +
						'<font size="-1"><b id="fontNombre' + i + '">' + jsonUsuario[i].NombreProducto + '</b></font><br>' +
						'<font color="#FF0000">$</font><font color="#FF0000" id="fontPrecio' + i + '">' + jsonUsuario[i].ValorUnitario + '</font><br>' +
						'<font size="1"><b>CANTIDADES:</b></font><br>' +
						
						'<div style="display: inline-block;margin:0;">' +
							
						   '<table width="100%" height="10px" cellpadding="0" cellspacing="0" align="center">' +
								'<tr>' +
									'<td align="right" width="20%"><input type="button"  id="btnMenos' + i + '" name="btnMenos' + i + '" style="margin-right:10px" value="-" class="botonMenos btn btn-primary" data-fila="' + i + '"/></td>' +
									'<td align="center" width="30%"><input value="1" style="width:100%; text-align:center;border-radius:4px; border-style:ridge" id="txtCantidad' + i + '" name="txtCantidad' + i + '" type="" value="1"/></td>' +
									'<td width="20%"><input type="button" id="btnMas' + i + '" name="btnMas' + i + '" data-max="' + jsonUsuario[i].Stock + '" value="+" style="margin-left:10px" class="botonMas btn btn-primary" data-fila="' + i + '"/></td>' +
								'</tr>' +
								'<tr>' +
									'<td colspan="3" align="center"><button type="button" id="btnAgregar' + i + '" name="btnAgregar' + i + '" data-codigoProducto="' + jsonUsuario[i].codigoProducto + '" class="botonAgregar btn btn-primary" data-fila="' + i + '" style="width:90%; margin-top:5px"><font size="-1">Agregar</font></button><br><font color="#FF0000" id="fontError' + i + '">&nbsp;</font></td>' +
								'</tr>' +
							'</table>' +
						'</div>' +
				   '</div>';
					}else{
						html = '<div style="width:20%; border:solid 4px #CCC;display: inline-block; margin-top:5px; background-color:#FFF; padding-top:10px; height: 250px;" align="center" class="recuadro" data-fila="' + i + '" data-codigoProducto="' + jsonUsuario[i].codigoProducto + '" data-imagenProducto="' + jsonUsuario[i].Imagen + '" data-descProducto="' + jsonUsuario[i].Descripcion + '" restriccion="si">' +
						'<img src="' + fotoProducto + '" height="80px" width="60%"/><br>' +
						'<font size="-1"><b id="fontNombre' + i + '">' + jsonUsuario[i].NombreProducto + '</b></font><br>' +
						'<font color="#FF0000">$</font><font color="#FF0000" id="fontPrecio' + i + '">' + jsonUsuario[i].ValorUnitario + '</font><br>' +
						'<font size="2" color="#FF0000"><b>PRODUCTO RESTRINGIDO POR EL ACUDIENTE</b></font>' +
						
				   '</div>';
					}
			   $("#TablaProductos").append(html);
					contador+=1;
				});
				$(".recuadro").click(function(e) {
					
					var restriccion = $(this).attr("restriccion");

					if($("*:focus").attr("class") != "botonMenos btn btn-primary" && $("*:focus").attr("class") != "botonMas btn btn-primary" && $("*:focus").attr("class") != "botonAgregar btn btn-primary"){
						if($.trim(restriccion) == "no"){
							$("#filaPopup").css({"display":"block"});
							$("#btnAgregarProducto").css({"display":"block"});
							var fila = $(this).attr("data-fila");
							var maximo = $("#btnMas" + fila).attr("data-max");
							$("#btnMasPopup").attr("data-max", maximo);
							$("#fontNombreProducto").html($("#fontNombre" + fila).html())
							$("#fontPrecioPopup").html($("#fontPrecio" + fila).html())
							//$( "#popup" ).popup( "open" );
							$('#popup').fadeIn('slow');
							$('.popup-overlay').fadeIn('slow');
							$("#txtCantidadPopup").val(1)
							$("#fotoProductoPopup").attr("src", $(this).attr("data-imagenProducto"));
							$("#fontDescProducto").html($(this).attr("data-descProducto"))
							$("#cantidadesMensaje").html("<font size='1'><b>CANTIDADES:</b></font>")
							$("#txtCodigoProductoHidden").val($("#btnAgregar" + fila).attr("data-codigoProducto"));
						}else{
							$("#filaPopup").css({"display":"none"});
							$("#btnAgregarProducto").css({"display":"none"});
							$("#cantidadesMensaje").html("<font size='2'><b>PRODUCTO RESTRINGIDO POR El ACUDIENTE</b></font>")

							var fila = $(this).attr("data-fila");
							var maximo = $("#btnMas" + fila).attr("data-max");
							$("#btnMasPopup").attr("data-max", maximo);
							$("#fontNombreProducto").html($("#fontNombre" + fila).html())
							$("#fontPrecioPopup").html($("#fontPrecio" + fila).html())
							//$( "#popup" ).popup( "open" );
							$('#popup').fadeIn('slow');
							$('.popup-overlay').fadeIn('slow');
							$("#txtCantidadPopup").val(1)
							$("#fotoProductoPopup").attr("src", $(this).attr("data-imagenProducto"));
							$("#fontDescProducto").html($(this).attr("data-descProducto"))
							
							$("#txtCodigoProductoHidden").val($("#btnAgregar" + fila).attr("data-codigoProducto"));
						}
							

					}
					
				});
				
				
				
				$(".botonMenos").click(function(e) {
					var fila = $(this).attr("data-fila");
					var cantidadActual = $("#txtCantidad" + fila).val();
					
					var numero = parseInt(cantidadActual);
					if(numero > 1){
						numero -= 1;
						$("#txtCantidad" + fila).val(numero)
						$("#fontError" + fila).html("")
						$("#btnAgregar" + fila).css({display: "block"});
					}
					
				});
				$(".botonMas").click(function(e) {
					var fila = $(this).attr("data-fila");
					var cantidadActual = $("#txtCantidad" + fila).val();
					var numero = parseInt(cantidadActual);
					var precio = parseInt($("#fontPrecio" + fila).html());
					var CantidadMaxima = parseInt($(this).attr("data-max"));
					var saldoAux = saldoActual - (cantidadActual * precio);; 
					var ValorRestriccion = localStorage.getItem("ValorRestriccion"); 
					
					if(ValorRestriccion != ""){
						var valor = parseInt(ValorRestriccion);
						var totalActual = Obtener_Total() + (numero * precio);
						if(numero < CantidadMaxima){
							numero += 1;
							var idCredencialSesion = localStorage.getItem("idCredencialSesion"); 
							var date = new Date();
							var dia = date.getDate();
							var mes = (date.getMonth() + 1);
							var year = date.getFullYear();
							
							if(dia < 10) {
								dia = '0' + dia;
							} 
							
							if(mes < 10) {
								mes = '0' + mes;
							} 
							
							var fechaActual = year + "-" + mes + "-" + dia;
							
							$.post("http://181.55.254.193/ssca/ActionMostrarTotalPorDia.php", {idCredencial: idCredencialSesion, fecha: fechaActual})
							.done(function( data ) {
								if($.trim(data) != "[]"){
									var json = JSON.parse(data);
									console.log(json[0].Total);
									if(json[0].Total != null){
										var totalActual = Obtener_Total() + (numero * precio) + (parseFloat(json[0].Total));
										if(totalActual <= valor){
											if((numero * precio) <= saldoActual){
												$("#btnAgregar" + fila).css({display: "block"});
												$("#txtCantidad" + fila).val(numero)
												console.log(saldoActual + " - " + (numero * precio));
												
												$("#fontError" + fila).html("")
											}else{
												$("#btnAgregar" + fila).css({display: "none"});
												$("#fontError" + fila).html("El saldo actual es de " + saldoAux + ". No es suficiente para agregar mas productos")
											}
										}else{
											$("#btnAgregar" + fila).css({display: "none"});
											$("#fontError" + fila).html("Usted no puede sobrepasar la restriccion de consumir " + ValorRestriccion)
										}
									}else{
										var totalActual = Obtener_Total() + (numero * precio);
										if(totalActual <= valor){
											if((numero * precio) <= saldoActual){
												$("#btnAgregar" + fila).css({display: "block"});
												$("#txtCantidad" + fila).val(numero)
												console.log(saldoActual + " - " + (numero * precio));
												
												$("#fontError" + fila).html("")
											}else{
												$("#btnAgregar" + fila).css({display: "none"});
												$("#fontError" + fila).html("El saldo actual es de " + saldoAux + ". No es suficiente para agregar mas productos")
											}
										}else{
											$("#btnAgregar" + fila).css({display: "none"});
											$("#fontError" + fila).html("Usted no puede sobrepasar la restriccion de consumir " + ValorRestriccion)
										}
									}
								}
							});
						}
					}else{
						if(numero < CantidadMaxima){
							if((numero * precio) <= saldoActual){
								$("#btnAgregar" + fila).css({display: "block"});
								$("#txtCantidad" + fila).val(numero + 1)
								console.log(saldoActual + " - " + (numero * precio));
								
								$("#fontError" + fila).html("")
							}else{
								$("#btnAgregar" + fila).css({display: "none"});
								$("#fontError" + fila).html("El saldo actual no es suficiente para agregar mas productos")
							}
						}
					}
					
					
				});
				$(".botonAgregar").click(function(e) {
					var fila = $(this).attr("data-fila");
					var cantidadActual = parseInt($("#txtCantidad" + fila).val());
					var precio = parseInt($("#fontPrecio" + fila).html());
					var nombre = $("#fontNombre" + fila).html();
					var codigoProducto = $(this).attr("data-codigoProducto");
					var total = cantidadActual * precio;
					saldoActual = saldoActual - (cantidadActual * precio);
					console.log(saldoActual);
					jsonCarrito.push(
						{codigoProducto: codigoProducto, nombre: nombre, cantidad: cantidadActual, precioUnitario: precio, total: total}
					);
					console.log(jsonCarrito);
					$("#txtCantidad" + fila).val("1")
					$("#txtTotal").val(Obtener_Total())
					$("#txtSaldoRestante").val(saldoActual)
					$('#popupCarrito').fadeIn('slow');
					//$("#btnPagar").css({display: "block"});
					//alert("Agregado con exito el producto");
					alertify.success("Producto agregado con exito");	
					//EnviarDatos({codigoProducto: codigoProducto, cantidad: cantidadActual}, "ActionDisminuirStock.php", "");
					verPedido();
									
				});
			}else{								
				$("#TablaProductos").html("");
				$("#TablaProductos").append('<h1>No existen productos por el momento en esta subcategoria</h1>');
					
			}
			
		break;
		
		case "LISTARTODOSPRODUCTOS": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado);
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				var html = '';
				$.each(jsonUsuario, function(i, item) {
					
					/*menu += '<li class=""><a href="#" title="Restricción de Consumo" data-id="' + jsonUsuario[i].codigo + '" id="Categoria' + jsonUsuario[i].codigo + '"><span>' + jsonUsuario[i].Nombre + '</span></a><ul style="margin-right: -42%" id="SubCategorias' + jsonUsuario[i].codigo + '"></ul></li>';	*/
					 console.log(i);
					 if((i + 1) % 2 == 1){
						 html += '<tr class="even" validrow="true">' +
							'<td>' + jsonUsuario[i].codigoProducto + '</td>' +
							'<td>' + jsonUsuario[i].NombreProducto + '</td>' +
							'<td>' + jsonUsuario[i].Descripcion + '</td>' +
							'<td>' + jsonUsuario[i].ValorUnitario + '</td>' +
							'<td>' + jsonUsuario[i].NombreCategoria + '</td>' +
							'<td>' + jsonUsuario[i].NombreSubCategoria + '</td>' +
							'<td>' + jsonUsuario[i].Stock + '</td>' +
							'<td>0</td>' +
							'<td>0</td>' +
						'</tr>';						
					 }else{
						 html += '<tr class="odd" validrow="true">' +
							'<td>' + jsonUsuario[i].codigoProducto + '</td>' +
							'<td>' + jsonUsuario[i].NombreProducto + '</td>' +
							'<td>' + jsonUsuario[i].Descripcion + '</td>' +
							'<td>' + jsonUsuario[i].ValorUnitario + '</td>' +
							'<td>' + jsonUsuario[i].NombreCategoria + '</td>' +
							'<td>' + jsonUsuario[i].NombreSubCategoria + '</td>' +
							'<td>' + jsonUsuario[i].Stock + '</td>' +
							'<td>0</td>' +
							'<td>0</td>' +
						'</tr>';						
					 }
				});
				$("#tbody").html(html);
				var tf = new TableFilter('demo', filtersConfig);
                tf.init();
				
			}else{								
				//alert("Los datos ingresados no estan registrados en el sistema");
			}

		break;
		
		
		case "CONSULTARUSUARIOSALDO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			
			var jsonUsuario = JSON.parse(resultado);
			
			if(jsonUsuario.length > 0){
				$.each(jsonUsuario, function(i, item) {
					$("#txtPrimerApellido").val(jsonUsuario[i].primerApellido);
					$("#txtSegundoApellido").val(jsonUsuario[i].segundoApellido);
					$("#txtPrimerNombre").val(jsonUsuario[i].primerNombre);
					$("#txtSegundoNombre").val(jsonUsuario[i].segundoNombre);
					$("#txtDireccion").val(jsonUsuario[i].direccion);
					$("#txtTelefono1").val(jsonUsuario[i].telefono1);
					$("#txtTelefono2").val(jsonUsuario[i].telefono2);
					$("#txtClave").val(jsonUsuario[i].clave);
					$("#txtAcudiente").val(jsonUsuario[i].idAcudiente);
					$("#txtRecarga").val(jsonUsuario[i].SaldoCredencial);
					$('#txtTipoUsuario > option[value="' + jsonUsuario[i].tipoUsuario + '"]').attr('selected', 'selected');
					$('#imageFoto').attr('src',jsonUsuario[i].ImagenFotografica);
					//$('input[value=' + jsonUsuario[i].estado + ']').prop("checked",true);
					
					if(jsonUsuario[i].tipoUsuario == "Estudiante"){
						$( "#rowAcudiente" ).css( "visibility", "visible" );						
					}else{
						$( "#rowAcudiente" ).css( "visibility", "hidden" );
					}
				});
			}else{
				$("#txtPrimerApellido").val("");
				$("#txtSegundoApellido").val("");
				$("#txtPrimerNombre").val("");
				$("#txtSegundoNombre").val("");
				$("#txtDireccion").val("");
				$("#txtTelefono1").val("");
				$("#txtTelefono2").val("");
				$("#txtClave").val("");
				$("#txtAcudiente").val("");
				$("#txtTipoUsuario").val("");
				$("#txtRecarga").val("");
				$( "#rowAcudiente" ).css( "visibility", "hidden" );
			}
			
		break;
		
		case "CONSULTARUSUARIOTRASLADO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			
			var jsonUsuario = JSON.parse(resultado);
			
			if(jsonUsuario.length > 0){
				$.each(jsonUsuario, function(i, item) {
					$("#txtPrimerApellidoDestino").val(jsonUsuario[i].primerApellido);
					$("#txtSegundoApellidoDestino").val(jsonUsuario[i].segundoApellido);
					$("#txtPrimerNombreDestino").val(jsonUsuario[i].primerNombre);
					$("#txtSegundoNombreDestino").val(jsonUsuario[i].segundoNombre);
					$("#txtDireccionDestino").val(jsonUsuario[i].direccion);
					$("#txtTelefono1Destino").val(jsonUsuario[i].telefono1);
					$("#txtTelefono2Destino").val(jsonUsuario[i].telefono2);
					$("#txtClaveDestino").val(jsonUsuario[i].clave);
					$("#txtAcudienteDestino").val(jsonUsuario[i].idAcudiente);
					$("#txtRecargaDestino").val(jsonUsuario[i].SaldoCredencial);
					$('#txtTipoUsuario > option[value="' + jsonUsuario[i].tipoUsuario + '"]').attr('selected', 'selected');
					$('#imageFotoDestino').attr('src',jsonUsuario[i].ImagenFotografica);
					//$('input[value=' + jsonUsuario[i].estado + ']').prop("checked",true);
					
					if(jsonUsuario[i].tipoUsuario == "Estudiante"){
						$( "#rowAcudiente" ).css( "visibility", "visible" );						
					}else{
						$( "#rowAcudiente" ).css( "visibility", "hidden" );
					}
				});
			}else{
				$("#txtPrimerApellido").val("");
				$("#txtSegundoApellido").val("");
				$("#txtPrimerNombre").val("");
				$("#txtSegundoNombre").val("");
				$("#txtDireccion").val("");
				$("#txtTelefono1").val("");
				$("#txtTelefono2").val("");
				$("#txtClave").val("");
				$("#txtAcudiente").val("");
				$("#txtTipoUsuario").val("");
				$("#txtRecarga").val("");
				$( "#rowAcudiente" ).css( "visibility", "hidden" );
			}
			
		break;
		
		case "MODIFICARUSUARIO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			if($.trim(resultado) == "1"){
				
				alert("Se modifico con exito el usuario");
				window.location.href = "ModificarUsuario.html";
			}
			
		break;

		case "MODIFICARACUDIENTE": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			if($.trim(resultado) == "1"){
				
				alert("Se modifico con exito el usuario");
				window.location.href = "ModificarAcudiente.html";
			}
			
		break;
		
		case "REEMPLAZOCREDENCIAL": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			var jsonUsuario = JSON.parse(resultado);
			
			if(jsonUsuario.length > 0){
				if(jsonUsuario[0].tipo == "ESTUDIANTE" || jsonUsuario[0].tipo == "FUNCIONARIO"){
					//alert("Se ingreso con exito el usuario");
					var win = window.open("Carnet.html", '_blank');
  					win.focus();						
				}else{
					var win = window.open("CarnetFuncionario.html", '_blank');
  					win.focus();						
				}
				
			}
			
			
		break;
		
		case "PROCESARRECAUDO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			alert("Se proceso con exito el recaudo");
			
			
		break;
		
		case "ADMINCREDENCIAL": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			alert("Se Modifico con exito la credencial");
			
			
		break;
		
		case "REPORTECREDENCIAL": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					var html = '<b>Id Alumno: </b>' + jsonUsuario[i].idUsuarioSecundario + '<br><b>Id acudiente: </b>' + jsonUsuario[i].idUsuarioPrincipal + '<br><b>Estado: </b>' + jsonUsuario[i].EstadoCredencial + '<br><b>Saldo: </b>' + jsonUsuario[i].SaldoCredencial;
					$("#txtAlumno").val("");
					$("#txtAcudiente").val("");
					$("#divResultado").html(html); 
										
				});
			}else{
				$("#divResultado").html("");				
				alert("Los datos ingresados no estan registrados en el sistema");
			}
			
			
			
			
		break;
		
		case "REPORTERECAUDO": 
			var resultado = localStorage.getItem("Resultado"); 
			//console.log(resultado + " - " + operacion);
			var html = '';
			var jsonUsuario = JSON.parse(resultado);
			var total = 0;
			$("#tbody").html("");
			if($.trim(resultado) != "[]"){
				 $("#btnExportarReporte").css({"visibility":"visible"});
				$.each(jsonUsuario, function(i, item) {
					if((i + 1) % 2 == 1){
						html += '<tr class="even" validrow="true">' +
						'<td>' + jsonUsuario[i].idUsuario + '</td>' +
						'<td>' + jsonUsuario[i].PrimerNombre + ' ' + jsonUsuario[i].SegundoNombre + '</td>' +
						'<td>' + jsonUsuario[i].PrimerApellido + ' ' + jsonUsuario[i].SegundoApellido + '</td>' +
						'<td>' + jsonUsuario[i].Acudiente + '</td>' +
						'<td>' + jsonUsuario[i].NumeroIdAcudiente + '</td>' +
						'<td>' + jsonUsuario[i].FechaMovimiento + '</td>' +
						'<td>' + jsonUsuario[i].HoraMovimiento + '</td>' +
						'<td>' + jsonUsuario[i].DescripcionMovimiento + '</td>' +
						'<td>' + jsonUsuario[i].ValorMovimiento + '</td>' +
						'</tr>';						
						total += parseFloat(jsonUsuario[i].ValorMovimiento);
					}else{
						html += '<tr class="odd" validrow="true">' +
						'<td>' + jsonUsuario[i].idUsuario + '</td>' +
						'<td>' + jsonUsuario[i].PrimerNombre + ' ' + jsonUsuario[i].SegundoNombre + '</td>' +
						'<td>' + jsonUsuario[i].PrimerApellido + ' ' + jsonUsuario[i].SegundoApellido + '</td>' +
						'<td>' + jsonUsuario[i].Acudiente + '</td>' +
						'<td>' + jsonUsuario[i].NumeroIdAcudiente + '</td>' +
						'<td>' + jsonUsuario[i].FechaMovimiento + '</td>' +
						'<td>' + jsonUsuario[i].HoraMovimiento + '</td>' +
						'<td>' + jsonUsuario[i].DescripcionMovimiento + '</td>' +
						'<td>' + jsonUsuario[i].ValorMovimiento + '</td>' +
						'</tr>';		
						total += parseFloat(jsonUsuario[i].ValorMovimiento);				
					}					
					$("#h2Total").html("Total: " + total);
										
				});
				/*$("#dateFechaInicial").val("");
				$("#dateFechaFinal").val("");*/
				$("#tbody").html(html);
				var tf = new TableFilter('demo', filtersConfig);
              tf.init(); 
				
				
			}else{
				$("#tbody").empty();
				alert("Los datos ingresados no estan registrados en el sistema");
			}
			
			
			
			
		break;
		
		case "REPORTEINGRESO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			var html = '';
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					html += '<b>Nombres: </b>' + jsonUsuario[i].PrimerNombre + ' ' + jsonUsuario[i].SegundoNombre + '<br><b>Apellidos: </b>' + jsonUsuario[i].PrimerApellido + ' ' + jsonUsuario[i].SegundoApellido + '<br><b>Tipo: </b>' + jsonUsuario[i].TipoUsuario + '<br><b>Documento de Identificación: </b>' + jsonUsuario[i].NumeroId + '<br><b>Fecha: </b>' + jsonUsuario[i].Fecha + '<br><b>Hora: </b>' + jsonUsuario[i].Hora + "<br><br>";
					
										
				});
				$("#dateFechaInicial").val("");
				$("#dateFechaFinal").val("");
				$("#documentoID").val("");
				$("#divResultado").html(html); 
			}else{
				$("#divResultado").html("");	
				alertify.error("No hay registros en el sistema con los datos suministrados");	
			}
			
			
			
			
		break;
		
		case "TURNOSENTREGA": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			var jsonUsuario = JSON.parse(resultado);
			$.each(jsonUsuario, function(i, item) {
				$("#imagenCelda" + (i + 1)).attr("src", jsonUsuario[i].ImagenFotografica);
				$("#turnoCelda" + (i + 1)).html(jsonUsuario[i].ConsecutivoTurno);
				$("#nombreCelda" + (i + 1)).html(jsonUsuario[i].PrimerNombre + " " + jsonUsuario[i].SegundoNombre + " " + jsonUsuario[i].PrimerApellido + " " + jsonUsuario[i].SegundoApellido);
			})
			
		break;
		
		case "PEDIDOSPORALISTAR": 
			var resultado = localStorage.getItem("Resultado"); 
			//console.log(resultado + " - " + operacion);
			var html = '';
			var jsonUsuario = JSON.parse(resultado);
			$("#tbody").html(""); 
			
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					//var Productos = jsonUsuario[i].DescripcionPedido.split(',');
					var cantidad = ObtenerCantidad(jsonUsuario[i].DescripcionPedido)
					if((i + 1) % 2 == 1){
						 html += '<tr class="even" validrow="true">' +
							'<td align="center">' + jsonUsuario[i].ConsecutivoTurno + '</td>' +
							'<td align="center">' + jsonUsuario[i].DescripcionPedido + '</td>' +
							'<td align="center">' + cantidad + '</td>' +
							'<td align="center"><input type="checkbox" name="checkboxAlistar" id="checkboxAlistar' + i + '" class="checkboxPedidos" value="' + jsonUsuario[i].ConsecutivoInterno + '"/></td>' +
						'</tr>';						
					 }else{
						 html += '<tr class="odd" validrow="true">' +
							'<td align="center">' + jsonUsuario[i].ConsecutivoTurno + '</td>' +
							'<td align="center">' + jsonUsuario[i].DescripcionPedido + '</td>' +
							'<td align="center">' + cantidad + '</td>' +
							'<td align="center"><input type="checkbox" name="checkboxAlistar" id="checkboxAlistar' + i + '" class="checkboxPedidos" value="' + jsonUsuario[i].ConsecutivoInterno + '"/></td>' +
						'</tr>';	
					 }								
				});
				$("#tbody").append(html); 
				//var tf = new TableFilter('demo', filtersConfig);
        		//tf.init();
				
				$( '.checkboxPedidos' ).on( 'click', function() {
					if( $(this).is(':checked') ){
						// Hacer algo si el checkbox ha sido seleccionado
						//alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
						//Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage	
						var idPedido = $(this).val();
						var estado = "ENTREGA";
						var usuario = {
							consecutivoInterno: idPedido,
							estado: estado
						}
						EnviarDatos(usuario, "ActionAlistarPedidos.php", "ALISTAR");
					} else {
						// Hacer algo si el checkbox ha sido deseleccionado
						//alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
					}
				});
							}else{
				$("#tbody").html("");				
				//alert("No hay pedidos registrados");
			}
			
			
			
			
		break;
		
		case "PEDIDOSPORREVERTIR": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			var html = '';
			var jsonUsuario = JSON.parse(resultado);
			$("#tablaPedidosReversion").html(""); 
			html = '<tr align="center"><td><font for="" size="2">Numero Orden de pedido</font></td><td><font for="" size="2">Fecha de creacion</font></td><td><font for="" size="2">Valor</font></td><td><font for="" size="2">Id alumno</font></td><td><font for="" size="2">Descripci&oacute;n</font></td><td><font for="" size="2">Reversar</font></td></tr>';
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					html += '<tr align="center"><td><font for="" size="2">' + jsonUsuario[i].ConsecutivoInterno + '</font></td><td><font for="" size="2">' + jsonUsuario[i].FechaMovimiento + '</font></td><td><font for="" size="2">' + '</font></td><td><font for="" size="2">' + jsonUsuario[i].idUsuario + '</font></td><td><font for="" size="2">' + jsonUsuario[i].DescripcionPedido + '</font></td><td><input type="checkbox" name="checkboxAlistar" id="checkboxAlistar' + i + '" class="checkboxPedidos" value="' + jsonUsuario[i].ConsecutivoInterno + '"/></td></tr>';				
				});
				$("#tablaPedidosReversion").append(html); 
				
				$( '.checkboxPedidos' ).on( 'click', function() {
					if( $(this).is(':checked') ){
						// Hacer algo si el checkbox ha sido seleccionado
						//alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
						//Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage	
						var idPedido = $(this).val();
						var estado = "ANULADO";
						var usuario = {
							consecutivoInterno: idPedido,
							estado: estado
						}
						EnviarDatos(usuario, "ActionAlistarPedidos.php", "ANULAR");
					} else {
						// Hacer algo si el checkbox ha sido deseleccionado
						//alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
					}
				});
			}else{
				$("#tablaPedidosReversion").html("");				
				alert("No hay pedidos registrados");
			}
			
			
			
			
		break;
		
		case "REPORTESORDENES": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			var html = '';
			var jsonUsuario = JSON.parse(resultado);
			$("#divResultado").html(""); 
			html = '';	
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					html += 'Numero Orden de pedido: ' + jsonUsuario[i].ConsecutivoInterno + '<br>Fecha Orden de pedido: ' + jsonUsuario[i].FechaMovimiento + '<br>Id del alumno: ' + jsonUsuario[i].idUsuario + '<br>Descripcion: ' + jsonUsuario[i].DescripcionPedido + '<br>Ubicacion: ' + jsonUsuario[i].UbicacionPedido + '<br><br>';						
				});
				$("#divResultado").append(html); 
				
			}else{
				$("#divResultado").html("");				
				alert("No hay pedidos registrados");
			}
			
			
			
			
		break;
		
		case "REPORTEMOVIMIENTOS": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			var html = '';
			var jsonUsuario = JSON.parse(resultado);
			$("#divResultado").html(""); 
			html = '';	
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					html += 'Fecha: ' + jsonUsuario[i].FechaMovimiento + '<br>Hora: ' + jsonUsuario[i].HoraMovimiento + '<br>Descripcion: ' + jsonUsuario[i].DescripcionMovimiento + '<br><br>';						
				});
				$("#divResultado").html(html); 
				
			}else{
				$("#divResultado").html("");				
				alert("No hay pedidos registrados");
			}
			
			
			
			
		break;
		
		case "LISTACREDENCIALESACUDIENTES": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			
			var jsonUsuario = JSON.parse(resultado);
			$("#selectIdCredencial").html(""); 
			
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					$("#selectIdCredencial").append('<option value="' + jsonUsuario[i].usuario + '">' + jsonUsuario[i].primerNombre + ' ' + jsonUsuario[i].segundoNombre + ' ' + jsonUsuario[i].primerApellido + ' ' + jsonUsuario[i].segundoApellido + '</option>'); 		
				});
				
			}else{
				$("#selectIdCredencial").html("");				
				alert("No hay pedidos registrados");
			}
			
			
		break;
		
		case "LISTACREDENCIALESACUDIENTESTRASLADO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			
			var jsonUsuario = JSON.parse(resultado);
			$("#selectIdCredencial").html(""); 
			$("#selectUsuario").html(""); 
			
			if($.trim(resultado) != "[]"){
				$("#selectIdCredencial").append('<option value="Seleccione">Seleccione...</option>'); 
				$("#selectUsuario").append('<option value="Seleccione">Seleccione...</option>'); 
				$.each(jsonUsuario, function(i, item) {
					$("#selectIdCredencial").append('<option value="' + jsonUsuario[i].idCredencial + '">' + jsonUsuario[i].primerNombre + ' ' + jsonUsuario[i].segundoNombre + ' ' + jsonUsuario[i].primerApellido + ' ' + jsonUsuario[i].segundoApellido + '</option>'); 
					$("#selectUsuario").append('<option value="' + jsonUsuario[i].idCredencial + '">' + jsonUsuario[i].primerNombre + ' ' + jsonUsuario[i].segundoNombre + ' ' + jsonUsuario[i].primerApellido + ' ' + jsonUsuario[i].segundoApellido + '</option>'); 		
				});
				
			}else{
				$("#selectIdCredencial").html("");				
				alert("No hay usuarios asociados al acudiente");
			}
			
			
		break;
		case "LISTACREDENCIALESACUDIENTESMENSAJE": 
			var resultado = localStorage.getItem("Resultado"); 
			//console.log(resultado + " - " + operacion);
			
			var jsonUsuario = JSON.parse(resultado);
			$("#estudiantes").empty(); 
			
			if($.trim(resultado) != "[]"){
				
				$.each(jsonUsuario, function(i, item) {
					$("#estudiantes").append('<input type="checkbox" value="' + jsonUsuario[i].numeroId + '" id="checkbox' + i + '" name="checkEstudiante[]" class="checkboxEstudiante" coordenadas="' + jsonUsuario[i].Coordenadas + '" usuario="' + jsonUsuario[i].usuario + '" iter="' + i + '"/>&nbsp;<label for="checkbox' + i + '">' + jsonUsuario[i].primerNombre + ' ' + jsonUsuario[i].segundoNombre + ' ' + jsonUsuario[i].primerApellido + ' ' + jsonUsuario[i].segundoApellido + '</label><div style="display:none; width:100%; border: 1px #000 solid; border-radius: 8px; padding: 5px 5px 5px 5px" id="div' + i + '"></div><br>');
					
					$( '#checkbox' + i ).on( 'click', function() {
						if( $(this).is(':checked') ){
							// Hacer algo si el checkbox ha sido seleccionado
							
							var idEstudiante = $(this).val();
							$("#div" + i).css({"display":"block"});
							$.post("ActionListarRutasPorEstudiante.php", {usuario: idEstudiante})
							.done(function( data ) {
								
								var json = JSON.parse(data);
								
								$("#div" + i).empty();
								$("#div" + i).append('<h5>Rutas a seleccionar</h5>');
								if(json.length == 0){
									$("#div" + i).append('<h6>El estudiante no tiene rutas asignadas</h6>');
								}else{
									for(n = 0; n < json.length; n++){
										console.log(json[n]);
										$("#div" + i).append('<input type="checkbox" value="' + json[n].id + '" id="checkboxRuta' + i + '' + n + '" name="checkRuta' + i + '[]" class="checkboxRuta" style="margin-left:10px"/>&nbsp;<label for="checkboxRuta' + i + '' + n + '">' + json[n].nombreruta + '</label><br>');
									}
								}
							});	
						} else {
							$("#div" + i).css({"display":"none"});
							$("#div" + i).html("")
						}
					});
				});
				
			}else{
				$("#estudiantes").empty();				
				
			}
			
			
		break;
		
		case "PEDIDOSPORENTREGAR": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			var html = '';
			var jsonUsuario = JSON.parse(resultado);
			$("#tbody").html(""); 
			if(jsonUsuario.length == 1){
				//$("#btnAtras").css({"display":"none"});
			}
			
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					var cantidad = ObtenerCantidad(jsonUsuario[i].DescripcionPedido)
					if((i + 1) % 2 == 1){
						 html += '<tr class="even" validrow="true" align="center">' +
							'<td align="center"><font for="" size="2">' + jsonUsuario[i].ConsecutivoTurno + '</font></td>' +
							'<td align="center"><font for="" size="2">' + jsonUsuario[i].DescripcionPedido + '</font></td>' +
							'<td align="center">' + cantidad + '</td>' +
							'<td align="center"><font for="" size="2">' + jsonUsuario[i].ValorMovimiento + '</font></td>';
							

							html +='<form action="menusespeciales.php" method="post">' +
							'<input type="hidden" name="idCredencial" id="idCredencial" value="' + jsonUsuario[i].idCredencial + '">' +
							'<input type="hidden" name="ValorMovimiento" id="ValorMovimiento" value="' + jsonUsuario[i].ValorMovimiento + '">' +
							'<input type="hidden" name="ConsecutivoInterno" id="ConsecutivoInterno" value="' + jsonUsuario[i].ConsecutivoInterno + '">' +
							'</form>';

						
							html += '<td align="center"><input type="checkbox" name="checkboxAlistar" id="checkboxAlistar' + i + '" class="checkboxPedidos form-control" value="' + jsonUsuario[i].ConsecutivoInterno + '"/></td>' +
						'</tr>';						
					 }else{
						 html += '<tr class="odd" validrow="true" align="center">' +
							'<td align="center">' + jsonUsuario[i].ConsecutivoTurno + '</td>' +
							'<td align="center">' + jsonUsuario[i].DescripcionPedido + '</td>' +
							'<td align="center">' + cantidad + '</td>' +
							'<td align="center">' + jsonUsuario[i].ValorMovimiento + '</font></td>' +
							'<form action="menusespeciales.php" method="post">' +
							'<input type="hidden" name="idCredencial" id="idCredencial" value="' + jsonUsuario[i].idCredencial + '">' +
							'<input type="hidden" name="ValorMovimiento" id="ValorMovimiento" value="' + jsonUsuario[i].ValorMovimiento + '">' +
							'<input type="hidden" name="ConsecutivoInterno" id="ConsecutivoInterno" value="' + jsonUsuario[i].ConsecutivoInterno + '">' +
							'</form>'+
							'<td align="center"><input type="checkbox" name="checkboxAlistar" id="checkboxAlistar' + i + '" class="checkboxPedidos form-control" value="' + jsonUsuario[i].ConsecutivoInterno + '"/></td>' +
						'</tr>';	
					 }		
					//html += '<tr align="center"><td><font for="" size="2">' + jsonUsuario[i].ConsecutivoTurno + '</font></td><td><font for="" size="2">' + jsonUsuario[i].DescripcionPedido + '</font></td><td><font for="" size="2">' + '</font></td><td><input type="checkbox" name="checkboxAlistar" id="checkboxAlistar' + i + '" class="checkboxPedidos" value="' + jsonUsuario[i].ConsecutivoInterno + '"/></td></tr>';				
				});
				$("#tbody").append(html); 
				var tf = new TableFilter('demo', filtersConfig);
        		tf.init(); 
				
				$( '.checkboxPedidos' ).on( 'click', function() {
					if( $(this).is(':checked') ){
						// Hacer algo si el checkbox ha sido seleccionado
						//alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
						//Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage	
						var idPedido = $(this).val();
						var estado = "ENTREGADO";
						var usuario = {
							consecutivoInterno: idPedido,
							estado: estado
						}
						EnviarDatos(usuario, "ActionAlistarPedidos.php", "ENTREGAR");
					} else {
						// Hacer algo si el checkbox ha sido deseleccionado
						//alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
					}
				});
			}else{
				$("#divResultado").html("");
				alert("No hay pedidos registrados para entregar");
				window.location.href = "lectorQREntrega.html";
					
			}
			
			
			
			
		break;
		
		case "LISTARCATEGORIAS": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado);
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$("#selectCategoria").html("");
				
				$.each(jsonUsuario, function(i, item) {
					
					$("#selectCategoria").append('<option value="' + jsonUsuario[i].codigo + '">' + jsonUsuario[i].Nombre + '</option>');
				});
				
			}else{								
				//alert("Los datos ingresados no estan registrados en el sistema");
			}
			
		break;
		
		case "LISTARCATEGORIASMODIF": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado);
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$("#selectCategoria").html("");
				$("#selectCategoria").append('<option value="Seleccione">Seleccione...</option>');
				$.each(jsonUsuario, function(i, item) {
					
					$("#selectCategoria").append('<option value="' + jsonUsuario[i].codigo + '">' + jsonUsuario[i].Nombre + '</option>');
				});
				
			}else{								
				//alert("Los datos ingresados no estan registrados en el sistema");
			}
			
		break;
		
		case "LISTARPROTEINAS": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado);
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$("#selectProteina").html("");
				
				$.each(jsonUsuario, function(i, item) {
					
					$("#selectProteina").append('<option value="' + jsonUsuario[i].id + '">' + jsonUsuario[i].Descripcion + '</option>');
				});
				if(opcionSeleccionar != ""){
					$('#selectProteina > option[value="' + opcionSeleccionar + '"]').attr('selected', 'selected');
				}
			}else{								
				//alert("Los datos ingresados no estan registrados en el sistema");
			}
			
		break;
		
		case "USUARIOSESION": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					
					$("#txtUsuario").val("");
					$("#txtClave").val("");
					localStorage.setItem("usuario",jsonUsuario[i].usuario);
					window.location.href = "HomeRecaudo.html";
										
				});
				
			}else{
				$("#divResultado").html("");				
				alert("Los datos ingresados no estan registrados en el sistema");
			}
			
			
		break;
		
		case "USUARIOSESIONACUDIENTE": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);

			
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					
					$("#txtUsuario").val("");
					$("#txtClave").val("");
					localStorage.setItem("primernombreusuario",jsonUsuario[i].primerNombre);
					localStorage.setItem("segundonombreusuario",jsonUsuario[i].segundoNombre);
					localStorage.setItem("primerapellidousuario",jsonUsuario[i].primerApellido);
					localStorage.setItem("segundoapellidousuario",jsonUsuario[i].segundoApellido);
					localStorage.setItem("usuario",jsonUsuario[i].usuario);
					localStorage.setItem("tipoUsuario",jsonUsuario[i].tipoUsuario);
					window.location.href = "home.html";
										
				});
				
			}else{
				$("#divResultado").html("");
				alertify.error("Usuario o constraseña incorrecto/a.");	
			}
			
			
		break;
		
		case "LISTARSUBCATEGORIAS": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado);
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$('#selectSubcategoria').html('');
				$("#selectSubcategoria").append('<option value="Seleccione">Seleccione...</option>');
				$.each(jsonUsuario, function(i, item) {					
					$('#selectSubcategoria').append('<option value="' + jsonUsuario[i].codigo + '">' + jsonUsuario[i].Nombre + '</option>');				
				});
				
			}else{								
				//alert("Los datos ingresados no estan registrados en el sistema");
			}
		break;
		
		case "SUBIRFOTO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			
			
		break;
		case "ALISTAR": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			window.location.href = "ProcesoAlistamiento.html";
			
		break;
		case "ANULAR": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			window.location.href = "ReversionOrdenPedido.html";
			
		break;
		case "ENTREGAR": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			window.location.href = "ProcesoEntrega.html";
			
		break;
		
		case "CARNET": 
			var resultado = localStorage.getItem("Resultado"); 
			//$("#imageQR").attr("src", resultado);
			console.log(resultado);
			
			
		break;
		
		case "LISTARPRODUCTOS": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado);
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$("#selectProducto").append('<option value="Seleccione">Seleccione...</option>');
				$.each(jsonUsuario, function(i, item) {					
					$('#selectProducto').append('<option value="' + jsonUsuario[i].codigoProducto + '">' + jsonUsuario[i].NombreProducto + '</option>');				
				});			
				
			}else{								
				
			}
			
		break;
		
		case "CONSULTARPRODUCTOS": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado);
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {					
					$("#txtCodigo").val(jsonUsuario[i].codigoProducto)
					$("#txtNombre").val(jsonUsuario[i].NombreProducto)
					$("#txtDescripcion").val(jsonUsuario[i].Descripcion)
					$("#txtValor").val(jsonUsuario[i].ValorUnitario)
					$("#txtTiempo").val(jsonUsuario[i].horamaxima)
					$("#txtTiempoC").val(jsonUsuario[i].tiempocancelacion)
					$("#txtEdad").val(jsonUsuario[i].edad_max);
					$("#txtEdadMinima").val(jsonUsuario[i].edad)
					$("#selectCategoria").val(jsonUsuario[i].Categoria)
					EnviarDatos({idCategoria: $("#selectCategoria").val()}, "ActionListarSubCategorias.php", "LISTARSUBCATEGORIAS");
					$("#selectSubcategoria").val(jsonUsuario[i].Subcategoria)
					$("#txtStock").val(jsonUsuario[i].Stock)
					$("#imageFoto").attr("src",jsonUsuario[i].Imagen);
				});			
				
				
			}else{								
				
			}
			
		break;
		
		case "MONITORES": 
			var resultado = localStorage.getItem("Resultado"); 
			//console.log(resultado + " - " + operacion); 
			
			var jsonAcudientes = JSON.parse(resultado);
			console.log(jsonAcudientes);
			$("#monitor").html("");
			
			$.each(jsonAcudientes, function(i, item) {
				$("#monitor").append('<option value="' + jsonAcudientes[i].idUsuario + '">' + jsonAcudientes[i].primerNombre + ' ' + jsonAcudientes[i].segundoNombre + ' ' + jsonAcudientes[i].primerApellido + ' ' + jsonAcudientes[i].segundoApellido + '</option>');
			});
			
		break;
		
		case "CONDUCTORES": 
			var resultado = localStorage.getItem("Resultado"); 
			//console.log(resultado + " - " + operacion); 
			
			var jsonAcudientes = JSON.parse(resultado);
			console.log(jsonAcudientes);
			$("#conductor").html("");
			
			$.each(jsonAcudientes, function(i, item) {
				$("#conductor").append('<option value="' + jsonAcudientes[i].idUsuario + '">' + jsonAcudientes[i].primerNombre + ' ' + jsonAcudientes[i].segundoNombre + ' ' + jsonAcudientes[i].primerApellido + ' ' + jsonAcudientes[i].segundoApellido + '</option>');
			});
			
		break;
		
		
	}
	
}

function ObtenerCantidad(descripcion){
	var Productos = $.trim(descripcion).split(',');	
	var cantidad = 0;
	for(i = 0; i < Productos.length; i++){
		var producto = $.trim(Productos[i]);
		cantidad += parseInt(producto[0]);
		//console.log(producto[0] + " " + i);
	}
	return cantidad;
}
function InsertarDetalleOrden(id){
        var total = 0;
        
        $.each(jsonCarrito, function(i, item) {
          if(jsonCarrito[i] != null){
            $.post("ActionAgregarProductosOrdePedido.php", {codigoProducto: jsonCarrito[i].codigoProducto, cantidad: jsonCarrito[i].cantidad, total: jsonCarrito[i].total, id: id})
            .done(function( data ) {
              
            });
            total += 1;
          }
        }); 
        return total;
      }