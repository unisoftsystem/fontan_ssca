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
			//alert(data);
			localStorage.setItem("Resultado",data);
			//Llama a la funcion para validar el resultado
			ValidarResultado(operacion);
		},
		error: function ( jqXHR, textStatus, errorThrown ){
			alert(errorThrown);
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
					var win = window.open("Carnet.html", '_blank');
  					win.focus();						
					
				})
			}
			
		break;	

		case "CREARUSUARIOSISTEMA": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			alert("Se ingreso con exito el usuario");				
			
		break;
		
		case "CREARCONDUCTOR": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			alertify.success("Se ingreso con exito el conductor");	
			var jsonUsuario = JSON.parse(resultado);
			if(jsonUsuario.length > 0){
				$.each(jsonUsuario, function(i, item) {
					//alert("Se ingreso con exito el usuario");
					var win = window.open("Carnet.html", '_blank');
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
		
		case "CONSULTARUSUARIOCAFETERIA": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				//$.each(jsonUsuario, function(i, item) {
					localStorage.setItem("SaldoCredencial",jsonUsuario[0].SaldoCredencial);
					localStorage.setItem("idCredencialSesion",jsonUsuario[0].idCredencial);
					localStorage.setItem("idUsuarioApp",jsonUsuario[0].usuario);
					localStorage.setItem("PrimerNombreUsuarioSesionApp",jsonUsuario[0].primerNombre);
					localStorage.setItem("SegundoNombreUsuarioSesionApp",jsonUsuario[0].segundoNombre);
					localStorage.setItem("PrimerApellidoUsuarioSesionApp",jsonUsuario[0].primerApellido);
					localStorage.setItem("SegundoApellidoUsuarioSesionApp",jsonUsuario[0].segundoApellido);
					saldoActual = parseInt(jsonUsuario[0].SaldoCredencial);
					
				//});
				window.location.href = "cafeteriaProductos.html";
			}
			
			
		break;
		
		case "CREARPEDIDO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			localStorage.removeItem("idUsuarioApp");
			localStorage.removeItem("idCredencialSesion");
			//$("#lblTurno").html(resultado);
			//$("#txtTotal").val("0");
			window.location.href = "cafeteria.html";
			
		break;
		
		case "LISTARCATEGORIASPEDIDO": 
			var resultado = localStorage.getItem("Resultado"); 
			
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$("#cssmenu").html("");
				var menu = '<ul>';
				
				$.each(jsonUsuario, function(i, item) {
					
					menu += '<li class=""><a href="#" title="Restricción de Consumo" data-id="' + jsonUsuario[i].codigo + '" id="Categoria' + jsonUsuario[i].codigo + '"><span>' + jsonUsuario[i].Nombre + '</span></a><ul style="margin-right: -42%" id="SubCategorias' + jsonUsuario[i].codigo + '"></ul></li>';	
					 
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
                        EnviarDatos({subcategoria: id}, "ActionListarProductoSubCategoria.php", "LISTARPRODUCTOSSUB");
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
			
			if($.trim(resultado) != "[]"){
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
					
					html = '<div style="width:20%; border:solid 4px #CCC;display: inline-block; margin-top:5px; background-color:#FFF; padding-top:10px; height: 250px;" align="center" class="recuadro" data-fila="' + i + '" data-codigoProducto="' + jsonUsuario[i].codigoProducto + '">' +
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
			   $("#TablaProductos").append(html);
					contador+=1;
				});
				$(".recuadro").click(function(e) {
					console.log($("*:focus").attr("class"));
					
					if($("*:focus").attr("class") != "botonMenos btn btn-primary" && $("*:focus").attr("class") != "botonMas btn btn-primary" && $("*:focus").attr("class") != "botonAgregar btn btn-primary"){
						var fila = $(this).attr("data-fila");
						var maximo = $("#btnMas" + fila).attr("data-max");
						$("#btnMasPopup").attr("data-max", maximo);
						$("#fontNombreProducto").html($("#fontNombre" + fila).html())
						$("#fontPrecioPopup").html($("#fontPrecio" + fila).html())
						//$( "#popup" ).popup( "open" );
						$('#popup').fadeIn('slow');
						$('.popup-overlay').fadeIn('slow');
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
						if((numero * precio) <= saldoActual){
							$("#btnAgregar" + fila).css({display: "block"});
							$("#txtCantidad" + fila).val(numero)
							console.log(saldoActual + " - " + (numero * precio));
							
							$("#fontError" + fila).html("")
						}else{
							$("#btnAgregar" + i).css({display: "none"});
							$("#fontError" + fila).html("El saldo actual es de " + saldoAux + ". No es suficiente para agregar mas productos")
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
					/$("#txtTotal").val(Obtener_Total())
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

		case "MODIFICARUSUARIOS": 
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
					var win = window.open("Carnet.html", '_blank');
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
			console.log(resultado + " - " + operacion);
			var html = '';
			var jsonUsuario = JSON.parse(resultado);
			$("#tablaPedidosPorAlistar").html(""); 
			
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					if((i + 1) % 2 == 1){
						 html += '<tr class="even" validrow="true">' +
							'<td>' + jsonUsuario[i].ConsecutivoTurno + '</td>' +
							'<td>' + jsonUsuario[i].DescripcionPedido + '</td>' +
							'<td></td>' +
							'<td><input type="checkbox" name="checkboxAlistar" id="checkboxAlistar' + i + '" class="checkboxPedidos" value="' + jsonUsuario[i].ConsecutivoInterno + '"/></td>' +
						'</tr>';						
					 }else{
						 html += '<tr class="odd" validrow="true">' +
							'<td>' + jsonUsuario[i].ConsecutivoTurno + '</td>' +
							'<td>' + jsonUsuario[i].DescripcionPedido + '</td>' +
							'<td></td>' +
							'<td><input type="checkbox" name="checkboxAlistar" id="checkboxAlistar' + i + '" class="checkboxPedidos" value="' + jsonUsuario[i].ConsecutivoInterno + '"/></td>' +
						'</tr>';	
					 }								
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
				alertify.error("No hay pedidos registrados para entregar");					
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
					localStorage.setItem("tipoUsuario",jsonUsuario[i].tipoUsuario);
					window.location.href = "home.html";
										
				});
				
			}else{
				$("#divResultado").html("");
				alertify.error("Usuario o constraseña incorrecto/a.");	
			}
			
			
		break;

		case "USUARIOSESIONSISTEMA": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion);
			
			var jsonUsuario = JSON.parse(resultado);
			
			if($.trim(resultado) != "[]"){
				$.each(jsonUsuario, function(i, item) {
					
					$("#txtUsuario").val("");
					$("#txtClave").val("");
					localStorage.setItem("usuario",jsonUsuario[i].usuario);
					window.location.href = "menusistemaprincipal.html";
										
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