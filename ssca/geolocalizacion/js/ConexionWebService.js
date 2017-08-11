// JavaScript Document
/***
Fecha: 			Octubre 21 de 2015
Decripcion:		Script para conectarse a una webservice enviandoles como parametros unos datos en JSON y generando una 		respuesta que sera retornada en la funcion que hace la conexion

**/

/*
	Funcion para realizar la conexion al webservice, sirve como modelo para realizar la conexion a distintos webservice
*/
function EnviarDatos(ArrayDatos, url, operacion){
	
	localStorage.removeItem("Resultado");
	
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
			var jsonUsuario = JSON.parse(resultado);
			
			if(jsonUsuario.length > 0){
				$.each(jsonUsuario, function(i, item) {
					//alert("Se ingreso con exito el usuario");
					var win = window.open("http://localhost/ssca/Carnet.html", '_blank');
  					win.focus();						
					
				})
			}
			
			
		break;
		
		case "CREARUSUARIOACUDIENTE": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			alert("Se ingreso con exito el usuario");
			
			
		break;
		
		case "CREARCATEGORIA": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			if($.trim(resultado) == "1"){
				$('#selectTipo > option[value="Categoria"]').attr('selected', 'selected');
				alert("Se ingreso con exito la categoria");
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
		
		case "MODIFICARPRODUCTO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			if($.trim(resultado) == "1"){
				$('#selectCategoria > option[value="Seleccione"]').attr('selected', 'selected');
				$("#selectSubcategoria").html("")
				alert("Se modifico con exito el producto");
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
					$("#txtTipoId").val(jsonUsuario[i].tipoId);
					$("#txtTipoUsuario").val(jsonUsuario[i].tipoUsuario);
					$('input[value=' + jsonUsuario[i].estado + ']').prop("checked",true);
					$('#imageFoto').attr('src',jsonUsuario[i].ImagenFotografica);
					
					if(jsonUsuario[i].tipoUsuario == "Estudiante"){
						$( "#rowAcudiente" ).css( "display", "inline-table" );
						
						var datos = {
							
						}
					
						//Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage
						EnviarDatos(datos, "ActionListarAcudientes.php", "LISTARACUDIENTES");
						
						$('#selectAcudiente > option[value="' + jsonUsuario[i].idAcudiente + '"]').attr('selected', 'selected');
			
					}else{
						$( "#rowAcudiente" ).css( "display", "none" );
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
				
				$( "#rowAcudiente" ).css( "display", "none" );
			}
			
		break;
		
		case "CONSULTARUSUARIOREEMPLAZOC": 
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
					//$("#txtTipoUsuario").val(jsonUsuario[i].tipoUsuario);
					$('#txtTipoUsuario > option[value="' + jsonUsuario[i].tipoUsuario + '"]').attr('selected', 'selected');
					$('#imageFoto').attr('src',jsonUsuario[i].ImagenFotografica);
					//$('input[value=' + jsonUsuario[i].estado + ']').prop("checked",true);
					
					if(jsonUsuario[i].tipoUsuario == "Estudiante"){
						$( "#rowAcudiente" ).css( "display", "inline-table" );						
					}else{
						$( "#rowAcudiente" ).css( "display", "none" );
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
				$( "#rowAcudiente" ).css( "display", "none" );
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
						$( "#rowAcudiente" ).css( "display", "inline-table" );						
					}else{
						$( "#rowAcudiente" ).css( "display", "none" );
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
				$( "#rowAcudiente" ).css( "display", "none" );
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
						$( "#rowAcudiente" ).css( "display", "inline-table" );						
					}else{
						$( "#rowAcudiente" ).css( "display", "none" );
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
				$( "#rowAcudiente" ).css( "display", "none" );
			}
			
		break;
		
		case "MODIFICARUSUARIO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			if($.trim(resultado) == "1"){
				
				alert("Se modifico con exito el usuario");
			}
			
		break;
		
		case "REEMPLAZOCREDENCIAL": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			var jsonUsuario = JSON.parse(resultado);
			
			if(jsonUsuario.length > 0){
				$.each(jsonUsuario, function(i, item) {
					//alert("Se ingreso con exito el usuario");
					var win = window.open("http://localhost/ssca/Carnet.html", '_blank');
  					win.focus();						
					
				})
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
			console.log(resultado + " - " + operacion);
			var html = '';
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					html += '<b>Valor: </b>' + jsonUsuario[i].ValorMovimiento + '<br><b>Fecha Movimiento: </b>' + jsonUsuario[i].FechaMovimiento + '<br><b>Hora Movimiento: </b>' + jsonUsuario[i].HoraMovimiento + '<br><b>Descripcion Movimiento: </b>' + jsonUsuario[i].DescripcionMovimiento + "<br><br>";
					
										
				});
				$("#dateFechaInicial").val("");
				$("#dateFechaFinal").val("");
				$("#divResultado").html(html); 
			}else{
				$("#divResultado").html("");				
				alert("Los datos ingresados no estan registrados en el sistema");
			}
			
			
			
			
		break;
		
		case "PEDIDOSPORALISTAR": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			var html = '';
			var jsonUsuario = JSON.parse(resultado);
			$("#tablaPedidosPorAlistar").html(""); 
			html = '<tr align="center"><td><font for="" size="2">TURNO</font></td><td><font for="" size="2">DETALLE DE PEDIDO</font></td><td><font for="" size="2">No productos</font></td><td>&nbsp;</td></tr>';	
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					html += '<tr align="center"><td><font for="" size="2">' + jsonUsuario[i].ConsecutivoTurno + '</font></td><td><font for="" size="2">' + jsonUsuario[i].DescripcionPedido + '</font></td><td><font for="" size="2">' + '</font></td><td><input type="checkbox" name="checkboxAlistar" id="checkboxAlistar' + i + '" class="checkboxPedidos" value="' + jsonUsuario[i].ConsecutivoInterno + '"/></td></tr>';				
				});
				$("#tablaPedidosPorAlistar").append(html); 
				
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
				$("#divResultado").html("");				
				alert("No hay pedidos registrados");
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
					$("#selectIdCredencial").append('<option value="' + jsonUsuario[i].idCredencial + '">' + jsonUsuario[i].primerNombre + ' ' + jsonUsuario[i].segundoNombre + ' ' + jsonUsuario[i].primerApellido + ' ' + jsonUsuario[i].segundoApellido + '</option>'); 		
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
				alert("No hay pedidos registrados");
			}
			
			
		break;
		
		case "PEDIDOSPORENTREGAR": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			var html = '';
			var jsonUsuario = JSON.parse(resultado);
			$("#tablaPedidosPorAlistar").html(""); 
			html = '<tr align="center"><td><font for="" size="2">TURNO</font></td><td><font for="" size="2">DETALLE DE PEDIDO</font></td><td><font for="" size="2">No productos</font></td><td>&nbsp;</td></tr>';	
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					html += '<tr align="center"><td><font for="" size="2">' + jsonUsuario[i].ConsecutivoTurno + '</font></td><td><font for="" size="2">' + jsonUsuario[i].DescripcionPedido + '</font></td><td><font for="" size="2">' + '</font></td><td><input type="checkbox" name="checkboxAlistar" id="checkboxAlistar' + i + '" class="checkboxPedidos" value="' + jsonUsuario[i].ConsecutivoInterno + '"/></td></tr>';				
				});
				$("#tablaPedidosPorAlistar").append(html); 
				
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
				alert("No hay pedidos registrados");
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
					localStorage.setItem("usuario",jsonUsuario[i].usuario);
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
			$("#imageQR").html(resultado);
			console.log(resultado + " - " + operacion);
			
			
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