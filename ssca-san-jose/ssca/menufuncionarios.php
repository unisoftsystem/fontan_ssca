<?php
    /* Empezamos la sesión */
    session_start();
    /* Creamos la sesión */
    $_SESSION['userid'] = $_POST["txtUsuario"];
    /* Si no hay una sesión creada, redireccionar al index. */
    if(empty($_SESSION['userid'])) { // Recuerda usar corchetes.
        header('Location: indexusuariointerno.html');
    } // Recuerda usar corchetes
   
    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    //validando usuario
    $nombre = $_POST["txtUsuario"]; 
    $password = $_POST["txtClave"]; 
    $clave = base64_encode($password);

    
    $sql = "SELECT * FROM `usuarios_sistema` WHERE `idUsuario`='$nombre' AND `Clave`='$clave' AND `Estado`='ACTIVO'";  
    $rec = mysql_query($sql);
    $count = 0;
    while($row = mysql_fetch_object($rec))
    {
        $count++;
        $result = $row;
    }
    if($count == 1)
    {
        
    }
    else
    {
        header ("Location: indexfuncionariointerno.html?mensaje='Usuario o Contraseña Erroneos'");
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SSCA</title>
        <link href="css/style.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/style.js"></script>
        <script type="text/javascript" src="js/alertify.js"></script>
    		<link rel="stylesheet" href="css/alertify.core.css" />
    		<link rel="stylesheet" href="css/alertify.default.css" />
    		<link href="css/menu1.css" rel="stylesheet"/>
        <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">  
            
    </head>
    <body id="bodyLogin">

    	<h4 style="color:#CCC;margin-left:10px; margin-top:5px">Bienvenido(a): <label id="usuarioSesion"><?php echo $_SESSION['userid']; ?></label></h4>
        </br>
        
        <div id='cssmenu' style="margin-top: 340px; ">
            <ul>
                <li><a href='ReporteMovimientosFuncionarios.php' title="Modulo de Movimientos"><span>Modulo de Movimientos</span></a></li>
               <li class="" id="Salir"><a href='indexfuncionariointerno.html' title="Cerrar Sesi&oacute;n"><span>Cerrar Sesi&oacute;n</span></a></li>
            </ul>
        </div>
    	<footer class="footer" align="right">
        <script src="js/jquery.js"></script>
				<script src="js/jquery.validate.js"></script>
				<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
        </footer>
    </body> 
</html>
