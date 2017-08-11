// JavaScript Document
/***
Fecha: 			Octubre 21 de 2015
Decripcion:		Script para conectarse a una webservice enviandoles como parametros unos datos en JSON y generando una 		respuesta que sera retornada en la funcion que hace la conexion

**/

/*
	Funcion para realizar la conexion al webservice, sirve como modelo para realizar la conexion a distintos webservice
*/
var jsonCarrito = new Array();
var saldoActual = 0;

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
			alert(errorThrown);
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
			if($.trim(resultado) == "1"){
				
				alert("Se ingreso con exito el usuario");
			}
			
		break;
		
		case "CREARPEDIDO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			$("#lblTurno").html(resultado);
			$("#txtTotal").val("0");
			jQuery.mobile.changePage("#pageConfirmacion");
			
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
					
					if(jsonUsuario[i].tipoUsuario == "Estudiante"){
						$( "#rowAcudiente" ).css( "display", "inline-table" );
						
						var datos = {
							
						}
					
						//Se envian a la funcion que realiza la conexion al werbservice y genera una respuesta que se guarda en un localstorage
						EnviarDatos(datos, "http://181.55.254.193/ssca/ActionListarAcudientes.php", "LISTARACUDIENTES");
						
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
			alert("Se Reemplazo con exito la credencial");
			
			
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
		
		case "USUARIOSESION": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					
					$("#txtUsuario").val("");
					$("#txtClave").val("");
					localStorage.setItem("usuario",jsonUsuario[i].usuario);
					window.location.href = "ProcesoRecaudo.html";
										
				});
				
			}else{
				$("#divResultado").html("");				
				alert("Los datos ingresados no estan registrados en el sistema");
			}
			
			
			
			
		break;
		
		case "SUBIRFOTO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			
			
		break;
		
		case "CARNET": 
			var resultado = localStorage.getItem("Resultado"); 
			$("#imageQR").html(resultado);
			console.log(resultado + " - " + operacion);
			
			
		break;
		
		case "USUARIOSESIONAPP": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado);
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					
					$("#txtUsuario").val("");
					$("#txtClave").val("");
					
					if(jsonUsuario[i].tipoUsuario == "Estudiante"){
						jQuery.mobile.changePage("#pageHomeEstudiante");			
						
						localStorage.setItem("SaldoCredencial",jsonUsuario[i].SaldoCredencial);
						localStorage.setItem("idCredencialSesion",jsonUsuario[i].idCredencial);
						localStorage.setItem("idUsuarioApp",jsonUsuario[i].usuario);
						saldoActual = parseInt(jsonUsuario[i].SaldoCredencial);
						$("#SaldoCredencial").html('<font color="#FF0000" size="1">' + jsonUsuario[i].SaldoCredencial + '</font>');
					}
				});
				
			}else{								
				alert("Los datos ingresados no estan registrados en el sistema");
			}
			
			
			
			
		break;
		
		case "LISTARCATEGORIAS": 
			var resultado = localStorage.getItem("Resultado"); 
			
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$("#listarCategorias").html("");
				
				$.each(jsonUsuario, function(i, item) {
					
					//localStorage.setItem("usuario",jsonUsuario[i].usuario);
					//window.location.href = "ProcesoRecaudo.html";
					//$("#listarCategorias").append('<a href="#" class="ui-btn ui-btn-icon-right ui-icon-carat-r">' + jsonUsuario[i].Nombre + '</a>');	
					$("#listarCategorias").append('<div data-role="collapsible" class="lista" data-id="' + jsonUsuario[i].codigo + '" id="Categoria' + jsonUsuario[i].codigo + '"><h3>' + jsonUsuario[i].Nombre + '</h3></div>').trigger('create');
					
					$( ".lista" ).collapsible({
					  	collapse: function( event, ui ) {
							
						},
						expand: function( event, ui ) {
							var id = $(this).attr("data-id");
							localStorage.setItem("idCollapase",id);
							//alert(id);
							EnviarDatos({idCategoria: id}, "http://181.55.254.193/ssca/ActionListarSubCategorias.php", "LISTARSUBCATEGORIAS");
						}
					});
				});
				
			}else{								
				//alert("Los datos ingresados no estan registrados en el sistema");
			}
			
		break;
		
		case "LISTARSUBCATEGORIAS": 
			var resultado = localStorage.getItem("Resultado"); 
			
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				
				var idCollapase = localStorage.getItem("idCollapase");
				$('#Categoria' + idCollapase + ' .ui-collapsible-content').html('<ul data-role="listview" class="ui-listview" id="SubCategorias' + idCollapase + '"></ul>');
				var contador = 1;
				$.each(jsonUsuario, function(i, item) {					
					$('#SubCategorias' + idCollapase).append('<li class="ui-first-child ui-last-child" id="Categoria' + idCollapase + 'subcategoria' + contador + '" data-subcategoria="' + jsonUsuario[i].codigo + '"><a href="#" class="ui-btn">' + jsonUsuario[i].Nombre + '</a></li>');
					
					$('#Categoria' + idCollapase + 'subcategoria' + contador).click(function(e) {
						var id = $(this).attr("data-subcategoria");
                        EnviarDatos({subcategoria: id}, "http://181.55.254.193/ssca/ActionListarProductoSubCategoria.php", "LISTARPRODUCTOSSUB");
						$( "#myPanel" ).panel( "close" );
						
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
			
			if($.trim(resultado) != "[]"){
				$("#TablaProductos").html("");
				var html = "";
				$("#TablaProductos").html("");
				$.each(jsonUsuario, function(i, item) {
					//alert((i + 1) % 2 + "");
					var fotoProducto = "";
					var string1 = $("td div").html();
					console.log(string1)
					//var string2 = '-';
					//string1=string1.replace(string2,"");
					//$("td div").html(string1.substr(1))
					$("td div").removeClass("ui-btn");
					$("td div").removeClass("ui-input-btn");
					$("td div").removeClass("ui-corner-all");
					$("td div").removeClass("ui-shadow");
					
					if(jsonUsuario[i].Imagen.length != 0){
						fotoProducto = jsonUsuario[i].Imagen;
					}else{
						fotoProducto = "themes/images/icon.png";
					}
					
					if((i + 1) % 2 == 1){
						html = '<div style="width:40%; border:solid 4px #CCC;display: inline-block; margin-top:5px; background-color:#FFF" align="center" class="recuadro" data-fila="' + i + '" data-codigoProducto="' + jsonUsuario[i].codigoProducto + '">' +
							'<img src="' + fotoProducto + '" width="60%"/><br>' +
							'<font size="-1"><b id="fontNombre' + i + '">' + jsonUsuario[i].NombreProducto + '</b></font><br>' +
							'<font color="#FF0000">$</font><font color="#FF0000" id="fontPrecio' + i + '">' + jsonUsuario[i].ValorUnitario + '</font><br>' +
							'<font size="1"><b>CANTIDADES:</b></font><br>' +
							
							'<div style="display: inline-block;margin:0;">' +
								
							   '<table width="80%" height="10px" cellpadding="0" cellspacing="0" align="center">' +
									'<tr>' +
										'<td align="right" width="20%"><input type="button" id="btnMenos' + i + '" name="btnMenos' + i + '" style="" value="-" class="botonMenos" data-fila="' + i + '"/></td>' +
										'<td align="center" width="20%"><input value="1" style="width:100%; text-align:center; margin-left:2px" id="txtCantidad' + i + '" name="txtCantidad' + i + '" type=""/></td>' +
										' <td width="20%"><input type="button" id="btnMas' + i + '" name="btnMas' + i + '" data-max="' + jsonUsuario[i].Stock + '" value="+" style="margin-left:3px" class="botonMas" data-fila="' + i + '"/></td>' +
									'</tr>' +
									'<tr>' +
										'<td colspan="3" align="center"><button type="button" id="btnAgregar' + i + '" name="btnAgregar' + i + '" data-codigoProducto="' + jsonUsuario[i].codigoProducto + '" class="botonAgregar" data-fila="' + i + '" style="width:90%; margin-top:5px"><font size="-1">Agregar</font></button><br><font color="#FF0000" id="fontError' + i + '">&nbsp;</font></td>' +
									'</tr>' +
								'</table>' +
							'</div>' +
		 
					   '</div>';
					   $("#TablaProductos").append(html);
					}else{
						html = '<div style="width:40%; border:solid 4px #CCC;display: inline-block; margin-top:5px; background-color:#FFF; margin-left:1%" align="center" class="recuadro" data-fila="' + i + '">' +
							'<img src="themes/images/icon.png" width="60%"/><br>' +
							'<font size="-1"><b id="fontNombre' + i + '">' + jsonUsuario[i].NombreProducto + '</b></font><br>' +
							'<font color="#FF0000">$</font><font color="#FF0000" id="fontPrecio' + i + '">' + jsonUsuario[i].ValorUnitario + '</font><br>' +
							'<font size="1"><b>CANTIDADES:</b></font><br>' +
							
							'<div style="display: inline-block;margin:0;">' +
								
							   '<table width="80%" height="10px" cellpadding="0" cellspacing="0" align="center">' +
									'<tr>' +
										'<td align="right" width="20%"><input type="button" id="btnMenos' + i + '" name="btnMenos' + i + '" style="" value="-" class="botonMenos" data-fila="' + i + '"/></td>' +
										'<td align="center" width="20%"><input value="1" style="width:100%; text-align:center; margin-left:2px" id="txtCantidad' + i + '" name="txtCantidad' + i + '" type=""/></td>' +
										' <td width="20%"><input type="button" id="btnMas' + i + '" name="btnMas' + i + '" data-max="' + jsonUsuario[i].Stock + '" value="+" style="margin-left:3px" class="botonMas" data-fila="' + i + '"/></td>' +
									'</tr>' +
									'<tr>' +
										'<td colspan="3" align="center"><button type="button" id="btnAgregar' + i + '" name="btnAgregar' + i + '" data-codigoProducto="' + jsonUsuario[i].codigoProducto + '" class="botonAgregar" data-fila="' + i + '" style="width:90%; margin-top:5px"><font size="-1">Agregar</font></button><br><font color="#FF0000" id="fontError' + i + '">&nbsp;</font></td>' +
									'</tr>' +
								'</table>' +
							'</div>' +
		 
					   '</div><br>';
					   $("#TablaProductos").append(html);
					}
					contador+=1;
				});
				$(".recuadro").click(function(e) {
					
					if($("*:focus").attr("class") != "botonMenos" && $("*:focus").attr("class") != "botonMas" && $("*:focus").attr("class") != "botonAgregar"){
						var fila = $(this).attr("data-fila");
						var maximo = $("#btnMas" + fila).attr("data-max");
						$("#btnMasPopup").attr("data-max", maximo);
						$("#fontNombreProducto").html($("#fontNombre" + fila).html())
						$("#fontPrecioPopup").html($("#fontPrecio" + fila).html())
						$( "#popupProducto" ).popup( "open" );
						$("#txtCantidadPopup").val(1)
						$("#txtCodigoProductoHidden").val($("#btnAgregar" + fila).attr("data-codigoProducto"));
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
					
					
					if(numero < CantidadMaxima){
						numero += 1;
						//if((numero * precio) <= saldoActual){
							$("#btnAgregar" + fila).css({display: "block"});
							$("#txtCantidad" + fila).val(numero)
							console.log(saldoActual + " - " + (numero * precio));
							
							$("#fontError" + fila).html("")
						/*}else{
							//$("#btnAgregar" + i).css({display: "none"});
							$("#fontError" + fila).html("El saldo actual es de " + saldoAux + ". No es suficiente para agregar mas productos")
						}*/
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
					
					jsonCarrito.push(
						{codigoProducto: codigoProducto, nombre: nombre, cantidad: cantidadActual, precioUnitario: precio, total: total}
					);
					console.log(jsonCarrito);
					$("#txtCantidad" + fila).val("1")
					$("#txtTotal").val(Obtener_Total())
					$("#txtSaldoRestante").val(saldoActual)
					$( "#popupCarrito" ).popup( "open" )
					$("#btnPagar").css({display: "block"});
					alert("Agregado con exito el producto");
					EnviarDatos({codigoProducto: codigoProducto, cantidad: cantidadActual}, "http://181.55.254.193/ssca/ActionDisminuirStock.php", "");
					
				});
			}else{								
				$("#TablaProductos").html("");
			}
			
		break;
		
		
	}
	
}



function Obtener_Total(){
	var total = 0;
	
	$.each(jsonCarrito, function(i, item) {
		total += parseInt(jsonCarrito[i].total);
	});	
	return total;
}