<?php


    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT();

    $idCredencial = $_POST['idCredencial'];
    $ValorMovimiento = $_POST['ValorMovimiento'];
    $ConsecutivoInterno = $_POST['ConsecutivoInterno'];


    
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SSCA</title>
        <link href="css/style.css" rel="stylesheet"/>
        <link href="css/menu.css" rel="stylesheet"/>
        <link href="css/popup.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/style.js"></script>  
        <script type="text/javascript" src="js/ConexionWebService.js"></script>
        <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/alertify.js"></script>
        <link rel="stylesheet" href="css/alertify.core.css" />
        <link rel="stylesheet" href="css/alertify.default.css" />
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="js/popup.js"></script>
        <style type="text/css">
            @import url("http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,400italic");
            @import url("//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css");
            body {
            padding: 60px 0px;
            background-color: rgb(220, 220, 220);
          }
            
            .event-list {
            list-style: none;
            font-family: 'Lato', sans-serif;
            margin: 0px;
            padding: 0px;
          }
          .event-list > li {
            background-color: rgb(255, 255, 255);
            box-shadow: 0px 0px 5px rgb(51, 51, 51);
            box-shadow: 0px 0px 5px rgba(51, 51, 51, 0.7);
            padding: 0px;
            margin: 0px 0px 20px;
          }
          .event-list > li > time {
            display: inline-block;
            width: 100%;
            color: rgb(255, 255, 255);
            background-color: rgb(68, 59, 199);
            padding: 5px;
            text-align: center;
            text-transform: uppercase;
          }
          .event-list > li:nth-child(even) > time {
            background-color: rgb(165, 82, 167);
          }
          .event-list > li > time > span {
            display: none;
          }
          .event-list > li > time > .day {
            display: block;
            font-size: 56pt;
            font-weight: 100;
            line-height: 1;
          }
          .event-list > li time > .month {
            display: block;
            font-size: 24pt;
            font-weight: 900;
            line-height: 1;
          }
          .event-list > li > img {
            width: 100%;
          }
          .event-list > li > .info {
            padding-top: 5px;
            text-align: center;
          }
          .event-list > li > .info > .title {
            font-size: 17pt;
            font-weight: 700;
            margin: 0px;
          }
          .event-list > li > .info > .desc {
            font-size: 13pt;
            font-weight: 300;
            margin: 0px;
          }
          .event-list > li > .info > ul,
          .event-list > li > .social > ul {
            display: table;
            list-style: none;
            margin: 10px 0px 0px;
            padding: 0px;
            width: 100%;
            text-align: center;
          }
          .event-list > li > .social > ul {
            margin: 0px;
          }
          .event-list > li > .info > ul > li,
          .event-list > li > .social > ul > li {
            display: table-cell;
            cursor: pointer;
            color: rgb(30, 30, 30);
            font-size: 11pt;
            font-weight: 300;
                padding: 3px 0px;
          }
            .event-list > li > .info > ul > li > a {
            display: block;
            width: 100%;
            color: rgb(30, 30, 30);
            text-decoration: none;
          } 
            .event-list > li > .social > ul > li {    
                padding: 0px;
            }
            .event-list > li > .social > ul > li > a {
                padding: 3px 0px;
          } 
          .event-list > li > .info > ul > li:hover,
          .event-list > li > .social > ul > li:hover {
            color: rgb(30, 30, 30);
            background-color: rgb(200, 200, 200);
          }
          .facebook a,
          .twitter a,
          .google-plus a {
            display: block;
            width: 100%;
            color: rgb(75, 110, 168) !important;
          }
          .twitter a {
            color: rgb(79, 213, 248) !important;
          }
          .google-plus a {
            color: rgb(221, 75, 57) !important;
          }
          .facebook:hover a {
            color: rgb(255, 255, 255) !important;
            background-color: rgb(75, 110, 168) !important;
          }
          .twitter:hover a {
            color: rgb(255, 255, 255) !important;
            background-color: rgb(79, 213, 248) !important;
          }
          .google-plus:hover a {
            color: rgb(255, 255, 255) !important;
            background-color: rgb(221, 75, 57) !important;
          }

          @media (min-width: 768px) {
            .event-list > li {
              position: relative;
              display: block;
              width: 100%;
              height: 120px;
              padding: 0px;
            }
            .event-list > li > time,
            .event-list > li > img  {
              display: inline-block;
            }
            .event-list > li > time,
            .event-list > li > img {
              width: 120px;
              float: left;
            }
            .event-list > li > .info {
              background-color: rgb(245, 245, 245);
              overflow: hidden;
            }
            .event-list > li > time,
            .event-list > li > img {
              width: 120px;
              height: 120px;
              padding: 0px;
              margin: 0px;
            }
            .event-list > li > .info {
              position: relative;
              height: 120px;
              text-align: left;
              padding-right: 40px;
            } 
            .event-list > li > .info > .title, 
            .event-list > li > .info > .desc {
              padding: 0px 10px;
            }
            .event-list > li > .info > ul {
              left: 0px;
              bottom: 0px;
            }
            .event-list > li > .social {
              position: absolute;
              top: 0px;
              right: 0px;
              display: block;
              width: 40px;
            }
                .event-list > li > .social > ul {
                    border-left: 1px solid rgb(230, 230, 230);
                }
            .event-list > li > .social > ul > li {      
              display: block;
                    padding: 0px;
            }
            .event-list > li > .social > ul > li > a {
              display: block;
              width: 40px;
              padding: 10px 0px 9px;
            }
          }

          .contenidoBord {
            border: solid #CCC;
            height: 68%;
            top: 3%;
            position: relative;
            overflow: auto;
        }
      </style>
    </head>
    <body id="bodyBase">
        <h1 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Seleccion de Plato Especial</h1>
    <div class="contenidoBord">
    <?php
        $query1  = "SELECT * FROM menuespecial ";
        $result1 = mysql_query($query1);
        while($rows = mysql_fetch_array($result1, MYSQL_ASSOC))
        { 
        $id = stripslashes($rows['id']);
        $Nombre = stripslashes($rows['Nombre']);
        $Descripcion = stripslashes($rows['Descripcion']);
        $Foto = stripslashes($rows['Foto']);
        $Valor = stripslashes($rows['Valor']);
        ?>
      </br>
      <div class="[ col-xs-12 col-sm-offset-2 col-sm-8 ]">
        <ul class="event-list">
          <li>
            <time datetime="2016-02-11">
              <span class="day"><?php echo $id; ?></span>
            </time>
            <?php
               echo "<img src='".$Foto."' >";
            ?>
            
            <div class="info">
              <h2 class="title"><?php echo $Nombre; ?></h2>
              <p class="desc"><?php echo $Descripcion; ?></p>
              <ul>
                <li style="width:50%;"><span class="fa fa-money"></span> $ <?php echo $Valor; ?></li>
                <form action="mensajepagomenuespecial.php" method="post">
                <?php 
                 //valor a agregar en la credencial por costo de plato especial
                  $valoragregarcredencial =    $Valor - $ValorMovimiento;
                ?>
                 <input type="hidden" name="consecutivointerno" id="consecutivointerno" value="<?php echo $ConsecutivoInterno;?>">
                <input type="hidden" name="descripcionplatoespecial" id="descripcionplatoespecial" value="<?php echo $Descripcion;?>">
                <input type="hidden" name="desc" id="desc" value="<?php echo $Descripcion;?>">
                <input type="hidden" name="valoragregarcredencial" id="valoragregarcredencial" value="<?php echo $valoragregarcredencial;?>">
                <input type="hidden" name="valorplatoespecial" id="valorplatoespecial" value="<?php echo $Valor;?>">
                <input type="hidden" name="idCredencial" id="idCredencial" value="<?php echo $idCredencial;?>">
                <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
              </ul>
            </div>
            <div class="social">
              <ul>
                <li class="facebook" style="width:33%;"><a href="#facebook"><span class="fa fa-facebook"></span></a></li>
                <li class="twitter" style="width:34%;"><a href="#twitter"><span class="fa fa-twitter"></span></a></li>
                <li class="google-plus" style="width:33%;"><a href="#google-plus"><span class="fa fa-google-plus"></span></a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
      <?php
}
?>
</div>








    </body>
</html>