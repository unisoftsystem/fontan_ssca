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
    </head>
    <body id="bodyBase">
    <?php
         $valor = $_REQUEST["tipo"];
         $valor1 = $_REQUEST["new"];
         $valor2 = $_REQUEST["new_select"];

         require_once 'db_connect1.php';
            // connecting to db
            $db = new DB_CONNECT();
		//consulta del modulo para poder ser ingresada en el arbol de seleccion
		$query1  = "SELECT * FROM modulos where  nombre='".$valor."'";
        	$result1 = mysql_query($query1);
        	while($rows = mysql_fetch_array($result1, MYSQL_ASSOC))
        	{ 
        	$permisos = stripslashes($rows['id']);
        	}
            // mysql inserting a new row
            $result = mysql_query("INSERT INTO servicios_sistema(modulo,submodulo,accion,name,text,parent_id) VALUES('".$valor."', '".$valor1."', '".$valor2."','".$valor."', '".$valor2."', '".$permisos."')");
            
            // check if row inserted or not
            if ($result) {
                // successfully inserted into database
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "<div class=\"col-md-2 col-md-offset-5\">";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "Insersion Exitosa de Creacion Servicio Sistema";
                echo "</div>";
                echo "</div>";
            } else {
                // failed to insert row
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "<div class=\"col-md-2 col-md-offset-5\">";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "Insersion Fallida de Creacion Servicio Sistema";
                echo $result;
                echo "</div>";
                echo "</div>";
            }
    ?>
    <script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>    
    </body>
</html>