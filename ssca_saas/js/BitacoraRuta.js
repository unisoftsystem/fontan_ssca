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
    if(response != false) {
      if(response.length > 0) {
        var flightPlanCoordinates = [];
        
        for (var i = response.length - 1; i >= 0; i--) {
          var coordenates  = response[i]['coordenadas_recogida'].split(',');
          if(coordenates[0] != '' && coordenates[1] != '') {
            flightPlanCoordinates.push( {lat: parseInt(coordenates[0]), lng: parseInt(coordenates[1])} );
          }
          
          if(i == 0) {
            console.log(flightPlanCoordinates);

            var flightPath = new google.maps.Polyline({
              path: flightPlanCoordinates,
              geodesic: true,
              strokeColor: '#FF0000',
              strokeOpacity: 1.0,
              strokeWeight: 2
            });

            flightPath.setMap(map);
          }
        }
      }
    }else {
      var flightPath = new google.maps.Polyline({
        path: [ {lat: parseInt('4.6905541'), lng: parseInt('-74.0817848')} ],
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2
      });
      flightPath.setMap(map);
    }

  }).fail(function(error) {
    $('#recorrido_graf .loader').css('display', 'none');
    console.log('error', error);
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



















var apiKey = 'AIzaSyAqzXEudKCJZDpROHnuFnTVLBP6Gsw0C_Y';

var map;
var drawingManager;
var placeIdArray = [];
var polylines = [];
var snappedCoordinates = [];

function initialize() {
  console.log(initialize);
  
  var mapOptions = {
    zoom: 17,
    center: {lat: -33.8667, lng: 151.1955}
  };
  map = new google.maps.Map(document.getElementById('map'), mapOptions);

  // Adds a Places search box. Searching for a place will center the map on that
  // location.
  map.controls[google.maps.ControlPosition.RIGHT_TOP].push(
      document.getElementById('bar'));
  var autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autoc'));
  autocomplete.bindTo('bounds', map);
  autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);
    }
  });

  // Enables the polyline drawing control. Click on the map to start drawing a
  // polyline. Each click will add a new vertice. Double-click to stop drawing.
  drawingManager = new google.maps.drawing.DrawingManager({
    drawingMode: google.maps.drawing.OverlayType.POLYLINE,
    drawingControl: true,
    drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER,
      drawingModes: [
        google.maps.drawing.OverlayType.POLYLINE
      ]
    },
    polylineOptions: {
      strokeColor: '#696969',
      strokeWeight: 2
    }
  });
  drawingManager.setMap(map);

  // Snap-to-road when the polyline is completed.
  drawingManager.addListener('polylinecomplete', function(poly) {
    var path = poly.getPath();
    polylines.push(poly);
    placeIdArray = [];
    runSnapToRoad(path);
  });

  // Clear button. Click to remove all polylines.
  $('#clear').click(function(ev) {
    for (var i = 0; i < polylines.length; ++i) {
      polylines[i].setMap(null);
    }
    polylines = [];
    ev.preventDefault();
    return false;
  });
}

// Snap a user-created polyline to roads and draw the snapped path
function runSnapToRoad(path) {
  var pathValues = [];
  for (var i = 0; i < path.getLength(); i++) {
    pathValues.push(path.getAt(i).toUrlValue());
  }

  $.get('https://roads.googleapis.com/v1/snapToRoads', {
    interpolate: true,
    key: apiKey,
    path: pathValues.join('|')
  }, function(data) {
    processSnapToRoadResponse(data);
    drawSnappedPolyline();
    getAndDrawSpeedLimits();
  });
}

// Store snapped polyline returned by the snap-to-road service.
function processSnapToRoadResponse(data) {
  snappedCoordinates = [];
  placeIdArray = [];
  for (var i = 0; i < data.snappedPoints.length; i++) {
    var latlng = new google.maps.LatLng(
        data.snappedPoints[i].location.latitude,
        data.snappedPoints[i].location.longitude);
    snappedCoordinates.push(latlng);
    placeIdArray.push(data.snappedPoints[i].placeId);
  }
}

// Draws the snapped polyline (after processing snap-to-road response).
function drawSnappedPolyline() {
  var snappedPolyline = new google.maps.Polyline({
    path: snappedCoordinates,
    strokeColor: 'black',
    strokeWeight: 3
  });

  snappedPolyline.setMap(map);
  polylines.push(snappedPolyline);
}

// Gets speed limits (for 100 segments at a time) and draws a polyline
// color-coded by speed limit. Must be called after processing snap-to-road
// response.
function getAndDrawSpeedLimits() {
  for (var i = 0; i <= placeIdArray.length / 100; i++) {
    // Ensure that no query exceeds the max 100 placeID limit.
    var start = i * 100;
    var end = Math.min((i + 1) * 100 - 1, placeIdArray.length);

    drawSpeedLimits(start, end);
  }
}

// Gets speed limits for a 100-segment path and draws a polyline color-coded by
// speed limit. Must be called after processing snap-to-road response.
function drawSpeedLimits(start, end) {
    var placeIdQuery = '';
    for (var i = start; i < end; i++) {
      placeIdQuery += '&placeId=' + placeIdArray[i];
    }

    $.get('https://roads.googleapis.com/v1/speedLimits',
        'key=' + apiKey + placeIdQuery,
        function(speedData) {
          processSpeedLimitResponse(speedData, start);
        }
    );
}

// Draw a polyline segment (up to 100 road segments) color-coded by speed limit.
function processSpeedLimitResponse(speedData, start) {
  var end = start + speedData.speedLimits.length;
  for (var i = 0; i < speedData.speedLimits.length - 1; i++) {
    var speedLimit = speedData.speedLimits[i].speedLimit;
    var color = getColorForSpeed(speedLimit);

    // Take two points for a single-segment polyline.
    var coords = snappedCoordinates.slice(start + i, start + i + 2);

    var snappedPolyline = new google.maps.Polyline({
      path: coords,
      strokeColor: color,
      strokeWeight: 6
    });
    snappedPolyline.setMap(map);
    polylines.push(snappedPolyline);
  }
}

function getColorForSpeed(speed_kph) {
  if (speed_kph <= 40) {
    return 'purple';
  }
  if (speed_kph <= 50) {
    return 'blue';
  }
  if (speed_kph <= 60) {
    return 'green';
  }
  if (speed_kph <= 80) {
    return 'yellow';
  }
  if (speed_kph <= 100) {
    return 'orange';
  }
  return 'red';
}

$(window).load(initialize);
