
<?php
/* Empezamos la sesión */
    session_start();
    /* Creamos la sesión */
    $id =  $_SESSION['userid'];

   
    /* Si no hay una sesión creada, redireccionar al index. */
    if(empty($_SESSION['userid'])) { // Recuerda usar corchetes.
        header('Location: indexusuariointerno.html');
    } // Recuerda usar corchetes


      require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
    $result = mysql_query("SELECT * FROM ordenpedido");
      
?>
<?php 
     $result5 = mysql_query("SELECT  *  FROM  usuarios_sistema where idUsuario='".$id."'");    
     if ($row = mysql_fetch_assoc($result5)) {
      $numid = $row['NumeroId'];
      }
  ?>
  <?php
  $result2 = mysql_query("SELECT MAX(idcuenta) AS idcuenta, fecha_corte FROM cuenta_cobro");    
     if ($row = mysql_fetch_row($result2)) {
      $idk = trim($row[0]);
      }
  ?> 
  <?php 
     $result3 = mysql_query("SELECT  fecha_corte,hora_corte FROM cuenta_cobro where idcuenta='".$idk."'");    
     if ($row = mysql_fetch_assoc($result3)) {
      $fechacorte = $row['fecha_corte'];
      $horacorte = $row['hora_corte'];
      }
  ?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SSCA</title>
        <link href="css/styler.css" rel="stylesheet"/>
        <link href="css/menu.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/style.js"></script>  
        <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
        <script src="js/script.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <link type="text/css" href="css/bootstrap.min.css" />
        <link type="text/css" href="css/bootstrap-timepicker.min.css" />
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
    </head>
    <body id="bodyBase">
    	<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Liquidacion y Pagos</h4>
        <h1 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Bienvenido</h1>
        
        <div id='cssmenu'>
            <ul>
                  
                
                   <li><a href='#' title="Crear Liquidacion"><h6><p class="full-circle"></p><span>Crear Liquidacion</span></h6></a>
                      <ul style="margin-right:-42%">
                          <li><a href='CrearCuentaCobro.php' title=\"Crear Liquidacion\"><h6><p class=\"full-circle\"></p><span>Crear Liquidacion</span></h6></a></li> 
                      </ul>
                   </li>
                            
                   <li ><a href='#' title="Reporte de Liquidaciones"><h6><p class="full-circle"></p><span>Reporte de Liquidaciones</span></h6></a>
                        <ul style="margin-right:-42%">
                            <li><a href='#' title=\"Reporte de Liquidaciones\"><h6><p class=\"full-circle\"></p><span>Reporte de Liquidaciones</span></h6></a></li>
                        </ul>
                   </li>
            </ul>
        </div>
        <div class="contenidoBorde">
            </br>
            <div align="right"><h4 style="color:#09C;">Usuario: <?php echo $id; ?></h4></div>
             
      </br>
      </br>
             <h3 align="center">Creacion de cuenta para liquidacion y pago&nbsp;</h3>
      </br>
      </br>
     

    <center><form class="form-inline" method="POST" action="ConsultaCuentaCobro.php">
  <div class="form-group">
    <label for="Ultima fecha corte ">Ultima fecha corte </label>
    <input type="text" class="form-control" id="fechar" name="fechar" value="<?php echo $fechacorte;?>" readonly required></input>
  </div>
  <br>
 <br>
<div class="form-group">
    <label for="Ultima hora corte ">Ultima hora corte </label>
    <input type="text" class="form-control" id="horar" name="horar" value="<?php echo $horacorte;?>" readonly  required></input>
  </div>
<br>
<br>
  <div class="form-group">
    <label for="Fecha de Generacion">Fecha de Generacion</label>
    <input type="date" class="form-control" id="fecha" name="fecha"  required>
  </div>
<br>
<br>
<div class="form-group">
    <label for="Hora de Generacion">Hora de Generacion</label>
    <select  id="time" name="time" class="form-control">
              <option value="1:00:00">1:00:00</option>
              <option value="2:00:00">2:00:00</option>
              <option value="3:00:00">3:00:00</option>
              <option value="4:00:00">4:00:00</option>
              <option value="5:00:00">5:00:00</option>
              <option value="6:00:00">6:00:00</option>
              <option value="7:00:00">7:00:00</option>
              <option value="8:00:00">8:00:00</option>
              <option value="9:00:00">9:00:00</option>
              <option value="10:00:00">10:00:00</option>
              <option value="11:00:00">11:00:00</option>
              <option value="12:00:00">12:00:00</option>
              <option value="13:00:00">13:00:00</option>
              <option value="14:00:00">14:00:00</option>
              <option value="15:00:00">15:00:00</option>
              <option value="16:00:00">16:00:00</option>
              <option value="17:00:00">17:00:00</option>
              <option value="18:00:00">18:00:00</option>
              <option value="19:00:00">19:00:00</option>
              <option value="20:00:00">20:00:00</option>
              <option value="21:00:00">21:00:00</option>
              <option value="22:00:00">22:00:00</option>
              <option value="23:00:00">23:00:00</option>
              <option value="24:00:00">24:00:00</option>
            </select>
<br>
<br>
    <input type="hidden"  class="form-control" id="numid" name="numid" value="<?php echo $numid; ?>" >
  </div>
<br>
  <div class="pull-right"> 
  <button type="submit" class="btn btn-primary">Generar</button>
  &nbsp;&nbsp;&nbsp;&nbsp;
  </div>
</form></center>
        </div> 
        <script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>     
    </body>
</html>