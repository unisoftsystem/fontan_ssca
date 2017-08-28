<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Waypoints in directions</title>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    </head>
  <body>
  	<h2>Planeacion de Rutas</h2>
    </br>
    <form id="testForm"  name="testForm" method="POST" action="formrutas.php">
  	<b>Nombre de ruta:</b>
    <select id="ruta">
      <option value="1">Ruta 1</option>
      <option value="2">Ruta 2</option>
      <option value="3">Ruta 3</option>
      <option value="4">Ruta 4</option>
    </select>
    <br>
    <b>Punto de Origen:</b>
    <select id="origen">
      <option value="1">Punto 1</option>
      <option value="2">Punto 2</option>
      <option value="3">Punto 3</option>
      <option value="4">Punto 4</option>
    </select>
    <br>
    <b>Punto de Destino:</b>
    <select id="destino">
      <option value="1">Punto 1</option>
      <option value="2">Punto 2</option>
      <option value="3">Punto 3</option>
      <option value="4">Punto 4</option>
    </select>
    <br>
    <b>Seleccion de bus:</b>
    <select id="bus">
      <option value="1">Bus 1</option>
      <option value="2">Bus 2</option>
      <option value="3">Bus 3</option>
      <option value="4">Bus 4</option>
    </select>
    <br>
    <b>Seleccion de conductor:</b>
    <select id="conductor">
      <option value="1">Conductor 1</option>
      <option value="2">Conductor 2</option>
      <option value="3">Conductor 3</option>
      <option value="4">Conductor 4</option>
    </select>
    <br>
    <b>Seleccion de monitor:</b>
    <select id="monitor">
      <option value="1">Monitor 1</option>
      <option value="2">Monitor 2</option>
      <option value="3">Monitor 3</option>
      <option value="4">Monitor 4</option>
    </select>
    <br>
    <b>Seleccion de pasajeros:</b>
    <select id="pasajeros">
      <option value="1">Pasajeros 1</option>
      <option value="2">Pasajeros 2</option>
      <option value="3">Pasajeros 3</option>
      <option value="4">Pasajeros 4</option>
    </select>
    <br>
    <b>Seleccion de pasajeros:</b>
    <select id="pasajeros">
      <option value="1">Pasajeros 1</option>
      <option value="2">Pasajeros 2</option>
      <option value="3">Pasajeros 3</option>
      <option value="4">Pasajeros 4</option>
    </select>
    <br>
    <b>Agendamiento de ruta:</b>
    <select id="agendamiento">
      <option value="1">Lunes</option>
      <option value="2">Martes</option>
      <option value="3">Miercoles</option>
      <option value="4">Jueves</option>
      <option value="5">Viernes</option>
      <option value="6">Sabado</option>
      <option value="7">Domingo</option>
    </select>
    </br>
    <input name="mysubmit" type="submit" value="Enviar" />
    </form>
    <div id="result"></div>
    <br>
</body>
<script src="jquery-1.3.min.js" language="javascript"></script>
<script language="javascript">// <![CDATA[
$(document).ready(function() {
   // Esta primera parte crea un loader no es necesaria
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
   // Interceptamos el evento submit
    $('#form, #fat, #testForm').submit(function() {
  // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#result').html(data);
            }
        })        
        return false;
    }); 
})
</script>
</html>