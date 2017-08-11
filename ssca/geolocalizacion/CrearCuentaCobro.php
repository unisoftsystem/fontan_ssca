<?php
      require_once '/db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
    $result = mysql_query("SELECT * FROM ordenpedido");
      
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
    </head>
    <body id="bodyBase">
    </br>
    </br>
      <h3 align="center">Cuenta de Cobro&nbsp;</h3>
      </br>
      <div class="col-md-2 col-md-offset-5">
      <form class="form-inline" method="POST" action="ConsultaCuentaCobro.php">
		  </br>
		  <div class="form-group">
        <label>Ingrese la fecha a buscar</label>
		    <input type="date" class="form-control" id="fecha" name="fecha"  required>
        <label>Ingrese la hora</label>
        <input type="time" class="form-control" id="time" name="time"  required>
        </br>
        </br>
		    <button type="submit" class="btn btn-primary">Buscar</button>
		  </div>
		</form>
      </div>
      </br>
      </br>
      </br>
      </br>   
		<script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>    
    </body>
</html>