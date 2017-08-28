<?php
/* Empezamos la sesión */
    session_start();
    /* Creamos la sesión */
    $_SESSION['userid'] = $_POST["txtUsuario"];
    $_SESSION['userpass'] = $_POST["txtClave"];

    /* Creamos la sesión */
    $id =  $_SESSION['userid'];
    $pass =  $_SESSION['userpass'];

    $convert = base64_encode ($pass);
      require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();


    $result = mysql_query("SELECT * FROM `usuarios` WHERE `idUsuario`='$id' AND `Clave`='$convert' AND `TipoUsuario`='Funcionario' ");   
    while($row = mysql_fetch_array($result)){
    $pfil = $row["Estado"];
    }

    /* Si no hay una sesión creada, redireccionar al index. */
    if($pfil != "ACTIVO") { // Recuerda usar corchetes.
        header('Location: indexfuncionariointerno.html');
    } // Recuerda usar corchetes


    
      
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
    	<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Consulta Movimientos</h4>
        <h1 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Bienvenido</h1>
        
        <div id='cssmenu'>
            <ul>
                <li><a href='#' title="Modulo de Movimientos"><span>Consulta de Movimientos</span></a></li>
                 <li><a href='Saldosfuncionarios.php' title="Modulo de Saldo"><span>Consulta de Saldo</span></a></li>
               <li class="" id="Salir"><a href='salida.php' title="Cerrar Sesi&oacute;n"><span>Cerrar Sesi&oacute;n</span></a></li>
            </ul>
        </div>
        <div class="contenidoBorde">
            </br>
            <div align="right"><h4 style="color:#09C;">Usuario: <?php echo $id; ?></h4></div>
             
      </br>
      </br>
             <h3 align="center">Consulta Movimientos por Fechas</h3>
      </br>
      </br>
     

    <center><form class="form-inline" method="POST" action="movimientosfuncionarios.php">
  <div class="form-group">
    <label for="Ultima fecha corte ">Fecha Inicial</label>
    <input type="date" class="form-control" id="fechai" name="fechai"  required></input>
  </div>
  <br>
 <br>
<div class="form-group">
    <label for="Ultima fecha corte ">Fecha Final</label>
    <input type="date" class="form-control" id="fechaf" name="fechaf"  required></input>
  </div>
<br>
<br>
<div class="pull-right"> 
  <button type="submit" class="btn btn-primary">Generar</button>
  &nbsp;&nbsp;&nbsp;&nbsp;
  </div>
    
  </div>
  
</form></center>
        </div> 
        <script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>     
    </body>
</html>