/*
* Author : Ali Aboussebaba
* Email : bewebdeveloper@gmail.com
* Website : http://www.bewebdeveloper.com
* Subject : Dynamic Drag and Drop with jQuery and PHP
*/

$(function() {
    $('#sortable').sortable({
        axis: 'y',
        opacity: 0.7,
        handle: 'span',
        update: function(event, ui) {
            var list_sortable = $(this).sortable('toArray').toString();
    		// change order in the database using Ajax
            $.ajax({
                url: 'set_order.php',
                type: 'POST',
                data: {list_order:list_sortable},
                success: function(data) {
                    //finished
                }
            });
        }
    }); // fin sortable
	
	
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
});

