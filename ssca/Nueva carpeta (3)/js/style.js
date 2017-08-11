// JavaScript Document
$(document).ready(function() {
	// Actualizamos el fondo al cargar la pagina
	
	var screenWidth = $(window).width();
	var screenHeight = $(window).height();
	var dimension = screenWidth + "px " + screenHeight + "px";
	var height = screenHeight + "px";
	
	$( "body" ).css({
	  "background-size": dimension, "height": height
	});
	$(window).bind("resize", function() {
		// Y tambien cada vez que se redimensione el navegador
		var screenWidth = $(window).width();
		var screenHeight = $(window).height();
		var dimension = screenWidth + "px " + screenHeight + "px";
		var height = screenHeight + "px";
		$( "body" ).css({
		  "background-size": dimension, "height": height
		});
	});
	
	
});
