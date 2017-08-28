<?php
    error_reporting(0);
    //validacion de fecha actual o menor
    $fecha_actual=date("Y-m-d");
    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();  
    /* Empezamos la sesión */
    session_start();
    /* Creamos la sesión */
    $id =  $_SESSION['userid'];
    /* Si no hay una sesión creada, redireccionar al index. */
    if(empty($_SESSION['userid'])) { 
        header('Location: indexfuncionariointerno.html');
    }
    //consulta de movimientos por orden
     $result = mysql_query("SELECT credenciales.SaldoCredencial as saldo , usuarios.PrimerApellido as primerapellido, usuarios.SegundoApellido as segundoapellido, usuarios.PrimerNombre as primernombre, usuarios.SegundoNombre as segundonombre, usuarios.Direccion as direccion,usuarios.Telefono1 as telefono, usuarios.NumeroId as numeroid   FROM credenciales  INNER JOIN usuarios  ON credenciales.idUsuarioSecundario=usuarios.idUsuario  WHERE usuarios.idUsuario = '$id' "); 

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
    	<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Consulta Saldo</h4>
        <h1 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Bienvenido</h1>
        <div id='cssmenu'>
            <ul>
                <li><a href='ReporteMovimientosFuncionario.php' title="Modulo de Movimientos"><span>Consulta de Movimientos</span></a></li>
                <li><a href='Saldosfuncionarios.php' title="Modulo de Saldo"><span>Consulta de Saldo</span></a></li>
               <li class="" id="Salir"><a href='salida.php' title="Cerrar Sesi&oacute;n"><span>Cerrar Sesi&oacute;n</span></a></li>
            </ul>
        </div>
      <div class="contenidoBorde">
      </br>
            <div align="right"><h4 style="color:#09C;">&nbsp;&nbsp;Usuario: <?php echo $id; ?></h4></div>
      </br>
        <?php
        //ciclo de movimientos
        while($row = mysql_fetch_array($result))
       {
            $num = $row["numeroid"];
            $primerapellido = $row["primerapellido"];
            $segundoapellido = $row["segundoapellido"];
            $primernombre = $row["primernombre"];
            $segundonombre = $row["segundornombre"];
            $direccion = $row["direccion"];
            $telefono = $row["telefono"];
            $saldo = $row["saldo"];
      }
      ?>

      <table style="padding-left:4%; padding-top:4.5%;padding-right:20px;" cellspacing="0" cellpadding="0" width="80%">
        <tr>
            <td><label for="txtIdentificacion"><font color="#09C" size="2">&nbsp;&nbsp;&nbsp;&nbsp;Identificacion:</font></label></td>
            <td><input type="text" name="txtIdentificacion" id="txtIdentificacion" value="<?php echo $num;?>" disabled class="form-control"/></td>        
        </tr>
        <tr>
            <td><label for="txtPrimerApellido"><font color="#09C" size="2">&nbsp;&nbsp;&nbsp;&nbsp;Primer Apellido:</font></label></td>
            <td><input type="text" name="txtPrimerApellido" id="txtPrimerApellido"  disabled value="<?php echo $primerapellido;?>" class="form-control"/></td>        
        </tr>
        <tr>
            <td><label for="txtSegundoApellido"><font color="#09C" size="2">&nbsp;&nbsp;&nbsp;&nbsp;Segundo Apellido:</font></label></td>
            <td><input type="text" name="txtSegundoApellido" id="txtSegundoApellido" disabled value="<?php echo $segundoapellido;?>" class="form-control"/></td>        
        </tr>
        <tr>
            <td><label for="txtPrimerNombre"><font color="#09C" size="2">&nbsp;&nbsp;&nbsp;&nbsp;Primer Nombre:</font></label></td>
            <td><input type="text" name="txtPrimerNombre" id="txtPrimerNombre" disabled value="<?php echo $primernombre;?>" class="form-control"/></td>        
        </tr>
        <tr>
            <td><label for="txtSegundoNombre"><font color="#09C" size="2">&nbsp;&nbsp;&nbsp;&nbsp;Segundo Nombre:</font></label></td>
            <td><input type="text" name="txtSegundoNombre" id="txtSegundoNombre" disabled value="<?php echo $segundonombre;?>" class="form-control"/></td>        
        </tr>
        <tr>
            <td><label for="txtRecarga"><font color="#09C" size="2">&nbsp;&nbsp;&nbsp;&nbsp;Saldo:</font></label></td>
            <td><input type="text" name="txtRecarga" id="txtRecarga" disabled value="<?php echo $saldo;?>" class="form-control"/></td>        
        </tr>
      </table>

      </br>
      </br>
      </div> 
      <script src="js/jquery.js"></script>
      <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>     
    </body>
</html>
