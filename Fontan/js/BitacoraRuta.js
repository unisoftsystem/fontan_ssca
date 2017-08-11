var apiKey = 'AIzaSyAqzXEudKCJZDpROHnuFnTVLBP6Gsw0C_Y';
var posotions = [];

$('#txtFecha').blur(function() {
  dispatchGetData();
});
$('#selectruta').blur(function() {
  dispatchGetData();
});

function dispatchGetData() {
  _getData('particuliaridades');
  _getData('messagesMonitores');
  _getData('alertas');
  _getData('chatAcudiente');
  _getData('mapa');
}

// Actualizar mapa
$('#actualizar_mapa').click(function() {
  _getData('mapa');
});

// Obetner datos mapa
$('a[href="#recorrido_graf"]').on('click', function() {
  setTimeout(function() {
    window.google.maps.event.trigger(map, 'resize');
  }, 500);
});



function validarRutaYFecha(ruta, fecha){
  if (!ruta || !fecha) {
    return false
  }else {
    return true;
  }
}

function _getData(endPoint) {
  var _idRuta = $('#selectruta').val();
  var _fecha = $('#txtFecha').val();

  if( validarRutaYFecha(_idRuta, _fecha) ) {
    if(endPoint == 'particuliaridades') {
      printObservaciones({id_asignacionruta: _idRuta, fecha_reemplazo: _fecha});
    }else if(endPoint == 'messagesMonitores') {
      printMsgAcuedienteMonitor({id_asignacionruta: _idRuta, fecha_reemplazo: _fecha});
    }else if(endPoint == 'alertas') {
      printAlertasRuta({id_asignacionruta: _idRuta, fecha_reemplazo: _fecha});
    }else if(endPoint == 'chatAcudiente') {
      printChatConAcudiente({id_asignacionruta: _idRuta, fecha_reemplazo: _fecha});
    }else if(endPoint == 'mapa') {
      printMapa({id_asignacionruta: _idRuta, fecha_reemplazo: _fecha});
    }
  }
}

function printMapa(data) {
  var endPoint = _base_url + 'index.php/rutas/get_recorrido_dia';
  $.post( endPoint, data).done(function(response) {
    posotions = response;
    initMap();
  });
}// END Mapa

function printChatConAcudiente(data) {
  var endPoint = _base_url + 'index.php/rutas/get_chat_con_acudiente';
  $('#chatAcudiente .loader').css('display', 'block');
  $('#chatAcudiente-list').empty();
  
  $.post( endPoint, data).done(function(response) {
  
    
    for (var i = response.length - 1; i >= 0; i--) {
      var _html = [
        '<li style="border: 1px solid #eee;">',
          '<div class="row">',
            '<div class="col-xs-3 col-md-1">',
              '<img src="'+_base_url+response[i]['ImagenFotografica']+'" class="img-responsive"/>',
            '</div>', 
            '<div class="col-xs-9 col-md-11">',
              '<span style="color:#929292;"><small>'+response[i]['hora']+'</small></span><br />',
              '<span><b>'+response[i]['nombre_completo']+'</b></span><br />',
              '<span>'+response[i]['mensaje']+'</span>',
            '</div>',
          '</div>',
        '</li>',
      ].join(''); 
      $('#chatAcudiente-list').append(_html);
    }

    if(response == false) {
      $('#chatAcudiente-list').empty();
      $('#chatAcudiente-list').append('No hay datos para mostrar...');
    }

    $('#chatAcudiente .loader').css('display', 'none');
  }).fail(function(error) {
    $('#chatAcudiente .loader').css('display', 'none');
    console.log('error', error);
  });
}

function printAlertasRuta(data) {
  var endPoint = _base_url + 'index.php/rutas/get_alerta_monitor';
  $('#alertas .loader').css('display', 'block');
  $('#alertas-list').empty();
  
  $.post( endPoint, data).done(function(response) {
  
    
    for (var i = response.length - 1; i >= 0; i--) {
      var _html = [
        '<li style="border: 1px solid #eee;">',
          '<div class="row">',
            '<div class="col-xs-3 col-md-1">',
              '<img src="'+_base_url+response[i]['ImagenFotografica']+'" class="img-responsive"/>',
            '</div>', 
            '<div class="col-xs-9 col-md-11">',
              '<span style="color:#929292;"><small>'+response[i]['hora']+'</small></span><br />',
              '<span><b>'+response[i]['nombre_completo']+'</b></span><br />',
              '<span>'+response[i]['mensaje']+'</span>',
            '</div>',
          '</div>',
        '</li>',
      ].join(''); 
      $('#alertas-list').append(_html);
    }

    if(response == false) {
      $('#alertas-list').empty();
      $('#alertas-list').append('No hay datos para mostrar...');
    }

    $('#alertas .loader').css('display', 'none');
  }).fail(function(error) {
    $('#alertas .loader').css('display', 'none');
    console.log('error', error);
  });
}

function printMsgAcuedienteMonitor(data) {
  var endPoint = _base_url + 'index.php/rutas/get_mensaje_acudiente_monitor';
  $('#messagesMonitores .loader').css('display', 'block');
  $('#messagesMonitores-list').empty();
  
  $.post( endPoint, data).done(function(response) {
  
    
    for (var i = response.length - 1; i >= 0; i--) {
      var _html = [
        '<li style="border: 1px solid #eee;">',
          '<div class="row">',
            '<div class="col-xs-3 col-md-1">',
              '<img src="'+_base_url+response[i]['ImagenFotografica']+'" class="img-responsive"/>',
            '</div>', 
            '<div class="col-xs-9 col-md-11">',
              '<span style="color:#929292;"><small>'+response[i]['hora']+'</small></span><br />',
              '<span><b>'+response[i]['nombre_completo']+'</b></span><br />',
              '<span>'+response[i]['mensaje']+'</span>',
            '</div>',
          '</div>',
        '</li>',
      ].join(''); 
      $('#messagesMonitores-list').append(_html);
    }

    if(response == false) {
      $('#messagesMonitores-list').empty();
      $('#messagesMonitores-list').append('No hay datos para mostrar...');
    }

    $('#messagesMonitores .loader').css('display', 'none');
  }).fail(function(error) {
    $('#messagesMonitores .loader').css('display', 'none');
    console.log('error', error);
  });
}

function printObservaciones(data) {
  var endPoint = _base_url + 'index.php/rutas/get_observacione_particulares';
  $('#particuliaridades .loader').css('display', 'block');
  $('#particuliaridades').empty();
  
  $.post( endPoint, data).done(function(response) {
    
    for (var i = response.length - 1; i >= 0; i--) {
      var _html = [
      '<div class="panel panel-default">',
      '<div class="panel-heading">',
      '<b>',
      response[i]['fecha_reemplazo'], 
      '<small class="pull-right">' + response[i]['nombreruta'] + '</small>',
      '</b>', 
      '</div>',
      '<div class="panel-body">',
      '<br><br><div class="row">',
      '<div class="col-xs-12 col-md-10 col-md-offset-1"><b>Monitor: </b>',
      response[i]['monitor_nombre'] + ' ' + response[i]['monitor_apellido'],
      '</div><br><br>',
      '<div class="col-xs-12 col-md-10 col-md-offset-1"><b>Conductor: </b>',
      response[i]['conductor_nombre'] + ' ' + response[i]['conductor_apellido'],
      '</div><br><br>',
      '<div class="col-xs-12 col-md-10 col-md-offset-1"><b>Vehiculo: </b>', response[i]['placa'],
      '</div><br><br>',
      '<div class="col-xs-12 col-md-10 col-md-offset-1"><b>Observaciones: </b><br><br>',
      response[i]['observaciones'],
      '</div>',
      '</div>',
      '</div>',
      '</div>'
      ].join(''); 
      $('#particuliaridades').append(_html);
    }

    if(response == false) {
      $('#particuliaridades').empty();
      $('#particuliaridades').append('No hay datos para mostrar...');
    }
    
    $('#particuliaridades .loader').css('display', 'none');
  }).fail(function(error) {
    $('#particuliaridades .loader').css('display', 'none');
    console.log('error', error);
  });
}

function initMap() {
  var image = {
    url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
    size: new google.maps.Size(15, 15),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(0, 32)
  };

  if(posotions && posotions.length > 0) {
    var initP = posotions[0].coordenadas_recogida.split(',');
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 4.7065735, lng: -74.032849},
      zoom: 13
    });

    $.each(posotions, function(index, pos) {
      var p = pos.coordenadas_recogida.split(',');
      var marker = new google.maps.Marker({
        position: {lat: parseFloat(p[0]), lng: parseFloat(p[1])},
        icon: image,
        map: map
      });
    });
  }
}

// window.exporLogRuta =  function (e) {
//   var selectRuta = document.getElementById('selectruta');
//   var idRuta = selectRuta.value;
//   var nameRuta = selectRuta.options[ selectRuta.options.selectedIndex ].innerText;
//   var dateFilter = document.getElementById('txtFecha').value;
//   if(nameRuta.length > 0 && dateFilter.length > 0 && idRuta.length > 0) {
//     var url = _base_url + 'index.php/rutas/export_log_ruta?i='+idRuta+'&n='+nameRuta+'&f='+dateFilter;
//     e.target.href = url;
//     window.alert('Esta operación puede tomar algunos minutos.');
//   }else {
//     e.preventDefault();
//     window.alert('Por favor selecciona una ruta y fecha válida.');
//   }
// }

















