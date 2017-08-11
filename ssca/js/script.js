( function( $ ) {
$( document ).ready(function() {
$('#cssmenu > ul > li > a').click(function() {
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


});
} )( jQuery );
