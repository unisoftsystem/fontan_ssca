// JavaScript Document
/***
Fecha: 			Octubre 21 de 2015
Decripcion:		Script para conectarse a una webservice enviandoles como parametros unos datos en JSON y generando una 		respuesta que sera retornada en la funcion que hace la conexion

**/
var saldoActual = 0;
var jsonCarrito = new Array();
var totalItem = 0;
var contadorFilasAgregadas = 1;
var contadorColumnasAgregadas = 1;
var contadorId = 1;
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
		case "FILTRO": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 	
			borrarItems();
			var jsonUsuario = JSON.parse(resultado);
			//$("#divDrag").html("");
			if(jsonUsuario.length > 0){
				var contador = 1
				var filas = 0;
				$.each(jsonUsuario, function(i, item) {
			
					//console.log(typeof(EstaAgregado(jsonUsuario[i].numeroId)));
					if(EstaAgregado(jsonUsuario[i].numeroId) == false){
						
						if(contador == 1){
							var left = 10;
							var top = 90 * filas;
							$("#divDrag").append('<div class="drag" id="drag' + (contadorId) + '" numeroid="' + jsonUsuario[i].numeroId + '" number="' + (contadorId) + '" style="left:' + left + 'px;top:' + top + 'px;" status="0" fila="' + filas + '" columna="' + contador + '"><a class="boxclose" id="back' + (contadorId) + '" number="' + (contadorId) + '" top="" left=""><img src="./img/back.png" width="20"></a><div class="name">' + jsonUsuario[i].primerNombre + ' ' + jsonUsuario[i].primerApellido + '</div></div>');
							$('#drag' + (contadorId)).css({"background":"url('" + jsonUsuario[i].ImagenFotografica + "')", "background-size":"100% 100%"});
							contadorId++;	
							totalItem++;						
							contador++;
						}else{
							if(contador == 2){
								var left = 80;
								var top = 90 * filas;
								$("#divDrag").append('<div class="drag" id="drag' + (contadorId) + '" numeroid="' + jsonUsuario[i].numeroId + '" number="' + (contadorId) + '" style="left:' + left + 'px;top:' + top + 'px;" status="0" fila="' + filas + '" columna="' + contador + '"><a class="boxclose" id="back' + (contadorId) + '" number="' + (contadorId) + '" top="" left=""><img src="./img/back.png" width="20"></a><div class="name">' + jsonUsuario[i].primerNombre + ' ' + jsonUsuario[i].primerApellido + '</div></div>');	
								$('#drag' + (contadorId)).css({"background":"url('" + jsonUsuario[i].ImagenFotografica + "')", "background-size":"100% 100%"});
								contadorId++;
								contador++;
								totalItem++;						
							}else{
								if(contador == 3){
									var left = 150;
									var top = 90 * filas;
									$("#divDrag").append('<div class="drag" id="drag' + (contadorId) + '" numeroid="' + jsonUsuario[i].numeroId + '" number="' + (contadorId) + '" style="left:' + left + 'px;top:' + top + 'px;" status="0" fila="' + filas + '" columna="' + contador + '"><a class="boxclose" id="back' + (contadorId) + '" number="' + (contadorId) + '" top="" left=""><img src="./img/back.png" width="20"></a><div class="name">' + jsonUsuario[i].primerNombre + ' ' + jsonUsuario[i].primerApellido + '</div></div>');	
									$('#drag' + (contadorId)).css({"background":"url('" + jsonUsuario[i].ImagenFotografica + "')", "background-size":"100% 100%"});
									contadorId++;
									contador = 1;
									filas++;
									totalItem++;						
								}
							}
						}
					
					}
				});
				document.getElementById("divDrag").style.overflow = "auto";
				/*for(i = 1; i<= 4; i++){
					$('#drag' + i).css({"background":"url('img/logo1.png')", "background-size":"100%"});
					
				}*/
				CodigoDrag();
			}
	
			
			
		break;

		case "CREARRUTA":
			var resultado = localStorage.getItem("Resultado");
			localStorage.setItem("idRutaResultado",resultado); 
			var idRutaResultado = localStorage.getItem("idRutaResultado");
			console.log(resultado + " - " + operacion); 
			var value= '';
			$('.drag').each(function(idx, el) {
				if($(el).attr("status") == "1"){
					/*if(value != '') value += ',';
					value  += $(el).attr("numeroid")+"";*/
					value = $(el).attr("numeroid");
					var datos = {
						value: value,
						ruta: idRutaResultado
					}
					console.log(value);
				  EnviarDatos(datos,"store.php","AGREGARESTUDIANTES");
				}
			});
			alertify.alert("Ruta creada con exito", function(){
				window.location.href = "creaciones.php";	
			});
			
			break;
			
		case "AGREGARESTUDIANTES":
			var resultado = localStorage.getItem("Resultado"); 
			//console.log(resultado + " - " + operacion); 
			break;
			
		case "MODIFICARRUTA":
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 
			var idRutaResultado = localStorage.getItem("idRutaResultado");
			console.log(resultado + " - " + operacion); 
			var data = {
				ruta: idRutaResultado
			}
			EnviarDatos(data,"storeEliminar.php","");
			var value= '';
			$('.drag').each(function(idx, el) {
				if($(el).attr("status") == "1"){
					/*if(value != '') value += ',';
					value  += $(el).attr("numeroid")+"";*/
					value = $(el).attr("numeroid");
					var datos = {
						value: value,
						ruta: idRutaResultado
					}
					console.log(value);
				  EnviarDatos(datos,"store.php","AGREGARESTUDIANTES");
				}
			});
			alertify.alert("Ruta modificada con exito", function(){
				window.location.href = "modificarcreaciones.php";	
			});
			break;
			
		case "LISTARESTUDIANTES": 
			var resultado = localStorage.getItem("Resultado"); 
			console.log(resultado + " - " + operacion); 	
			borrarItems();
			var jsonUsuario = JSON.parse(resultado);
			//$("#divDrag").html("");
			
			if(jsonUsuario.length > 0){
				var contador = 1
				var filas = 0;
				$.each(jsonUsuario, function(i, item) {
			
					//console.log(typeof(EstaAgregado(jsonUsuario[i].numeroId)));
					if(EstaAgregado(jsonUsuario[i].numeroId) == false){
						var altura = 0;
						var ancho = 0;
						if(contadorFilasAgregadas == 1){
							altura = 60;	
							
						}else{
							altura = (contadorFilasAgregadas * 90) - 30;
								
						}
						if(contadorColumnasAgregadas == 1){
							var left = 55;
							var top = 60;
							$("#divDrag").append('<div class="drag" id="drag' + (contadorId) + '" numeroid="' + jsonUsuario[i].numeroId + '" number="' + (contadorId) + '" style="left:' + left + '%;top:' + altura + 'px;" status="0" fila="' + filas + '" columna="' + contador + '"><a class="boxclose" id="back' + (contadorId) + '" number="' + (contadorId) + '" top="" left=""><img src="./img/back.png" width="20"></a><div class="name">' + jsonUsuario[i].primerNombre + ' ' + jsonUsuario[i].primerApellido + '</div></div>');
							$('#drag' + (contadorId)).css({"background":"url('" + jsonUsuario[i].ImagenFotografica + "')", "background-size":"100% 100%"});
							$("#totalDrop").val(totalDrop);
							//$('#drag' + number).attr('style','top:230px');
							$('#drag' + contadorId).attr('status','1');
							$("#back"+contadorId).css("visibility","visible");
							contadorColumnasAgregadas++;
							contadorId++;	
							totalItem++;						
							contador++;
						}else{
							if(contadorColumnasAgregadas == 2){
								var left = 70;
								var top = (contadorFilasAgregadas * 90) - 30;
								$("#divDrag").append('<div class="drag" id="drag' + (contadorId) + '" numeroid="' + jsonUsuario[i].numeroId + '" number="' + (contadorId) + '" style="left:' + left + '%;top:' + altura + 'px;" status="0" fila="' + filas + '" columna="' + contador + '"><a class="boxclose" id="back' + (contadorId) + '" number="' + (contadorId) + '" top="" left=""><img src="./img/back.png" width="20"></a><div class="name">' + jsonUsuario[i].primerNombre + ' ' + jsonUsuario[i].primerApellido + '</div></div>');	
								$('#drag' + (contadorId)).css({"background":"url('" + jsonUsuario[i].ImagenFotografica + "')", "background-size":"100% 100%"});
								$("#totalDrop").val(totalDrop);
								//$('#drag' + number).attr('style','top:230px');
								$('#drag' + contadorId).attr('status','1');
								$("#back"+contadorId).css("visibility","visible");
								contadorColumnasAgregadas++;
								contadorId++;
								contador++;
								totalItem++;						
							}else{
								if(contadorColumnasAgregadas == 3){
									var left = 85;
									var top = (contadorFilasAgregadas * 90) - 30;
									$("#divDrag").append('<div class="drag" id="drag' + (contadorId) + '" numeroid="' + jsonUsuario[i].numeroId + '" number="' + (contadorId) + '" style="left:' + left + '%;top:' + altura + 'px;" status="0" fila="' + filas + '" columna="' + contador + '"><a class="boxclose" id="back' + (contadorId) + '" number="' + (contadorId) + '" top="" left=""><img src="./img/back.png" width="20"></a><div class="name">' + jsonUsuario[i].primerNombre + ' ' + jsonUsuario[i].primerApellido + '</div></div>');	
									$('#drag' + (contadorId)).css({"background":"url('" + jsonUsuario[i].ImagenFotografica + "')", "background-size":"100% 100%"});
									$("#totalDrop").val(totalDrop);
									//$('#drag' + number).attr('style','top:230px');
									$('#drag' + contadorId).attr('status','1');
									$("#back"+contadorId).css("visibility","visible");
									console.log((contadorFilasAgregadas * 90) - 30);
									contadorColumnasAgregadas = 1;
									contadorFilasAgregadas++;
									contadorId++;
									contador = 1;
									filas++;
									totalItem++;						
								}
							}
						}
						
					
					}
				});
				document.getElementById("divDrag").style.overflow = "auto";
				CodigoDrag();
				
			}
				
		break;
		
		
	}
	
}

function borrarItems(){
	if(totalItem != 0){
		for(i = 0; i < totalItem; i++){
			if($("#drag" + (i + 1)).attr("status") == "0"){
				$("#drag" + (i + 1)).remove();
			}
			
		}
		
	}
}
function EstaAgregado(id){
	var estado = false;
	$('.drag').each(function(idx, el) {
		if($(el).attr("status") == "1"){
			
			var value = $(el).attr("numeroid");
			if(value == id){
				estado = true;
			}
		}
	});
	return estado;
}

function CodigoDrag(){
	/****************************************SCRIPT DEL DRAG***********************************************************/
	$(function($){
		$("#lock").hide();
		$("#totalDrop").val(0);
		var $divField = $('#container-field');
		var totalDrop = $("#totalDrop").val();
		var contadorItem = 0;
		$('.drag')
			.drag("start",function( ev, dd ){
	
				/*dd.limit = $divField.offset();
				dd.limit.bottom = dd.limit.top + $divField.outerHeight() - $( this ).outerHeight();
				dd.limit.right = dd.limit.left + $divField.outerWidth() - $( this ).outerWidth();*/
	
				var status = $(this).attr('status');
				var number = $(this).attr('number');
				/*if(totalDrop >= 12){
					//totalDrop--;
					$("#totalDrop").val(totalDrop);
					$("#drag"+number).attr('status','0');
					$("#back"+number).css("visibility","hidden");
	
					$( this ).animate({
						top: $("#back"+number).attr('top'),
						left: $("#back"+number).attr('left')
					}, 420 );
	
				} else {*/
					if(status == 0){
						totalDrop++;
						$("#totalDrop").val(totalDrop);
						$(this).attr('status','1');
						$("#back"+number).css("visibility","visible");
						
						/*if(totalDrop == 11){
							$("#lock").show();
						} */
					}
					if($("#back"+number).attr('top') == ""){
						$("#back"+number).attr('top',dd.originalY);
					}
					if($("#back"+number).attr('left') == ""){
						$("#back"+number).attr('left',dd.originalX);
					}
					
				//}
	
			})
			.drag(function( ev, dd ){
				   
				var status = $(this).attr('status');
				var number = $(this).attr('number');
				if(contadorItem < 1){
					//console.log(dd.drag.outerHTML);
					var html = dd.drag.outerHTML;
					var idItem = dd.drag.id;
					//console.log(idItem);
					//console.log(document.getElementById(idItem).parentNode.id);
					//document.getElementById(idItem).parentNode.id = "container-field";
					var fila = $("#" + idItem).attr("fila");
					var columna = $("#" + idItem).attr("columna");
					
					
					var altura = 0;
					var ancho = 0;
					if(contadorFilasAgregadas == 1){
						altura = 60;	
						
					}else{
						altura = (contadorFilasAgregadas * 90) - 30;
							
					}
					if(contadorColumnasAgregadas == 1){
						ancho = 55;
						console.log( "FILA: " + contadorFilasAgregadas);
						console.log( "COLUMNA: " + contadorColumnasAgregadas);
						contadorColumnasAgregadas++;
						//console.log(columna + " - " + ancho);
					}else{
						if(contadorColumnasAgregadas == 2){
							//$("#" + idItem).remove();
							ancho = 70;
							//console.log( "FILA: " + contadorFilasAgregadas);
							//console.log( "COLUMNA: " + contadorColumnasAgregadas);
							contadorColumnasAgregadas++;
							//console.log(columna + " - " + ancho);
						}else{
							if(contadorColumnasAgregadas == 3){
								//console.log( "FILA: " + contadorFilasAgregadas);
								//console.log( "COLUMNA: " + contadorColumnasAgregadas);
								ancho = 85;
								//console.log(columna + " - " + ancho);
								contadorFilasAgregadas++;
								contadorColumnasAgregadas = 1;
							}
						}
					}
					
					$( this ).css({
						top: altura,
						left: ancho + "%"
					});										
					
					//$("#" + idItem).remove();
					//document.getElementById("container-field").innerHTML = html;
					
					//$('#drag' + number).css({"background":"url('img/logo1.png')", "background-size":"100%"});
					
					//totalDrop++;
					$("#totalDrop").val(totalDrop);
					//$('#drag' + number).attr('style','top:230px');
					$('#drag' + number).attr('status','1');
					$("#back"+number).css("visibility","visible");
					
					/*if(totalDrop == 11){
						$("#lock").show();
					} */
					
					if($("#back"+number).attr('top') == ""){
						$("#back"+number).attr('top',dd.originalY);
					}
					if($("#back"+number).attr('left') == ""){
						$("#back"+number).attr('left',dd.originalX);
					}
					
					
					contadorItem++;
				}
				
				/*if(totalDrop >= 12){
					//totalDrop--;
					$("#totalDrop").val(totalDrop);
					$("#drag"+number).attr('status','0');
					$("#back"+number).css("visibility","hidden");
	
					$( this ).animate({
						top: $("#back"+number).attr('top'),
						left: $("#back"+number).attr('left')
					}, 420 );
	
				} else {*/
					
					
				//}
	
			})
			 .drop('start', function(ev, dd) {
				
				var status = $(this).attr('status');
				var number = $(this).attr('number');
				/*if(totalDrop >= 12){
					//totalDrop--;
					$("#totalDrop").val(totalDrop);
					$("#drag"+number).attr('status','0');
					$("#back"+number).css("visibility","hidden");
	
					$( this ).animate({
						top: $("#back"+number).attr('top'),
						left: $("#back"+number).attr('left')
					}, 420 );
				} else {*/
					if(status == 0){
						totalDrop++;
						$("#totalDrop").val(totalDrop);
						$(this).attr('status','1');
						$("#back"+number).css("visibility","visible");
					}
					if($("#back"+number).attr('top') == ""){
						$("#back"+number).attr('top',dd.originalY);
					}
					//alert(dd.originalX);
					if($("#back"+number).attr('left') == ""){
						$("#back"+number).attr('left',dd.originalX);
					}
					
				//}
	
			})
			.drag("end",function( ev, dd ){
				
				var status = $(this).attr('status');
				var number = $(this).attr('number');
				/*if(totalDrop >= 12){
					//totalDrop--;
					$("#totalDrop").val(totalDrop);
					$("#drag"+number).attr('status','0');
					$("#back"+number).css("visibility","hidden");
	
					$( this ).animate({
						top: $("#back"+number).attr('top'),
						left: $("#back"+number).attr('left')
					}, 420 );
	
				} else {*/
					if(status == 0){
						totalDrop++;
						$("#totalDrop").val(totalDrop);
						$(this).attr('status','1');
						$("#back"+number).css("visibility","visible");
						
						/*if(totalDrop == 11){
							$("#lock").show();
						} */
					}
					if($("#back"+number).attr('top') == ""){
						$("#back"+number).attr('top',dd.originalY);
					}
					if($("#back"+number).attr('left') == ""){
						$("#back"+number).attr('left',dd.originalX);
					}
					contadorItem = 0;
					console.log(contadorItem);
				//}
			}) 
			;
	
			$('.boxclose').click(function(){
			
				var number = $(this).attr('number');
	
				var status = $("#drag"+number).attr('status');
				
				if(status == 1){
					//totalDrop--;
					$("#totalDrop").val(totalDrop);
					$("#drag"+number).attr('status','0');
					$("#back"+number).css("visibility","hidden");
					if(totalDrop < 11){
						$("#lock").hide();
					} 
				}
				//console.log($( '#drag'+number ).attr("fila"));
				var fila = parseInt($('#drag'+number).attr("fila"));
				var columna = $('#drag'+number).attr("columna");
				var totalAlto = fila * 90;
				if(columna == "1"){
					$( '#drag'+number ).animate({
						top: totalAlto,
						left: 10
					}, 420 );										
				}
				if(columna == "2"){
					$( '#drag'+number ).animate({
						top: totalAlto,
						left: 80
					}, 420 );	
				}
				if(columna == "3"){
					$( '#drag'+number ).animate({
						top: totalAlto,
						left: 150
					}, 420 );	
				}
				
			});
	
	});
/************************************************************************************************************/
}
