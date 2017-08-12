<?php include('includes/loader.php'); ?>
<?php
error_reporting(0);
    /* Empezamos la sesión */
    session_start();
    /* Si no hay una sesión creada, redireccionar al index. */
    if(empty($_SESSION['userid'])) { // Recuerda usar corchetes.
        header('Location: login.php');
    } // Recuerda usar corchetes
   
    require_once 'db_connect.php';
    // connecting to db
    $db = new DB_CONNECT();
    //agregando post a vars
    $nombre = $_SESSION['userid']; 
    $password = $_SESSION['pass']; 
    $salt = '12000:';
    $clave = md5($salt . $password);
    //selecionamos el usuario
    $sql = "SELECT * FROM `users` WHERE `email`='$nombre' AND `salt`='$clave' AND `active`='True'";  
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
        header ("Location: login.php?mensaje='Usuario o Contraseña Erroneos'");
    }
    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Agregar Citas</title>
  <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/ui-lightness/jquery-ui.css" rel="stylesheet">
    <link href="css/fullcalendar.css" rel="stylesheet">
    <link href="lib/colorpicker/css/colorpicker.css" rel="stylesheet">
    <link href="lib/validation/css/validation.css" rel="stylesheet">
    <link href="lib/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

  <script type="text/javascript">
  $(window).load(function() {
    $(".loader").fadeOut("slow");
  })
  </script>
  <style type="text/css">
    .loader {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('images/page-loader.gif') 50% 50% no-repeat rgb(249,249,249);
    }

    header {
    width: 100%;
    height: 1px;
    overflow: hidden;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 999;
    border-bottom-right-radius: 50%;
    border-bottom-left-radius: 50%;
    -moz-border-radius:0px 55px;
    background-color: #0683c9;
    -webkit-transition: height 0.3s;
    -moz-transition: height 0.3s;
    -ms-transition: height 0.3s;
    -o-transition: height 0.3s;
    transition: height 0.3s;
}
header h1#logo {
    display: inline-block;
    height: 150px;
    line-height: 150px;
    float: left;
    font-family: "Oswald", sans-serif;
    font-size: 60px;
    color: white;
    font-weight: 400;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -ms-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}
header nav {
    display: inline-block;
    float: right;
}
header nav a {
    line-height: 150px;
    margin-left: 20px;
    color: #9fdbfc;
    font-weight: 700;
    font-size: 18px;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -ms-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}
header nav a:hover {
    color: white;
}
header.smaller {
    height: 75px;
}
header.smaller h1#logo {
    width: 150px;
    height: 75px;
    line-height: 75px;
    font-size: 30px;
}
header.smaller nav a {
    line-height: 75px;
}

@media all and (max-width: 660px) {
    header h1#logo {
        display: block;
        float: none;
        margin: 0 auto;
        height: 100px;
        line-height: 100px;
        text-align: center;
    }
    header nav {
        display: block;
        float: none;
        height: 50px;
        text-align: center;
        margin: 0 auto;
    }
    header nav a {
        line-height: 50px;
        margin: 0 10px;
    }
    header.smaller {
        height: 75px;
    }
    header.smaller h1#logo {
        height: 40px;
        line-height: 40px;
        font-size: 30px;
    }
    header.smaller nav {
        height: 35px;
    }
    header.smaller nav a {
        line-height: 35px;
    }
}
#footer{
    position:fixed;
    width:100%;
    height:90px;
    background-color:#FFFFFF;
    color:#000000;
    bottom:0px;
    clear:both;
    z-index: 999;
  }


  </style>
  <script type="text/javascript">
    function init() {
        window.addEventListener('scroll', function(e){
            var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = 300,
                header = document.querySelector("header");
            if (distanceY > shrinkOn) {
                classie.add(header,"smaller");
            } else {
                if (classie.has(header,"smaller")) {
                    classie.remove(header,"smaller");
                }
            }
        });
    }
         window.onload = init();
  </script>
  <script type='text/javascript'> 
          $(document).ready(function(){ 
          $("#search_results").slideUp(); 
              $("#search_button").click(function(e){ 
                  e.preventDefault(); 
                  ajax_search(); 
              }); 
              $("#nidentificacion").keyup(function(e){ 
                  e.preventDefault(); 
                  ajax_search(); 
                  ajax_search1(); 
                  ajax_search2();
                  ajax_search3();
                  ajax_search4();
              }); 
          });
          function ajax_search(){ 
            $("#apellidos").show(); 
            var search_val=$("#nidentificacion").val(); 
            $.post("./find2.php", {search_term : search_val}, function(data){
             if (data.length>0){ 
               $("#apellidos").val(data); 
             } 
            }) 
          } 
          function ajax_search1(){ 
            $("#nombres").show(); 
            var search_val=$("#nidentificacion").val(); 
            $.post("./find3.php", {search_term : search_val}, function(data){
             if (data.length>0){ 
               $("#nombres").val(data); 
             } 
            }) 
          } 
          function ajax_search2(){ 
            $("#fechan").show(); 
            var search_val=$("#nidentificacion").val(); 
            $.post("./find4.php", {search_term : search_val}, function(data){
             if (data.length>0){ 
               $("#fechan").val(data); 
             } 
            }) 
          } 
          function ajax_search3(){ 
            $("#genero").show(); 
            var search_val=$("#nidentificacion").val(); 
            $.post("./find5.php", {search_term : search_val}, function(data){
             if (data.length>0){ 
               $("#genero").val(data); 
             } 
            }) 
          } 

          function ajax_search4(){ 
            $("#email").show(); 
            var search_val=$("#nidentificacion").val(); 
            $.post("./find6.php", {search_term : search_val}, function(data){
             if (data.length>0){ 
               $("#email").val(data); 
             } 
            }) 
          } 
        </script>  
</head>
<body>

<header>
    <div class="container clearfix">
        </br>
        <center><img src="images/logo_blanco.png"  height="15%" width="15%"></center>
    </div>
</header>



<div class="container-fluid">
  <div class="row">
    <div class="col-md-2">   
    </div>
        <div class="col-md-8">
         <div class="header"><center><h4><label>Crear Cita</label></h4></center></div>
             <form id="add_event">

                <div class="col-md-6">
                <label>Identificacion Paciente:</label>
                <input type="number" class="form-control" name="nidentificacion" id="nidentificacion" required >  
                <label>Apellidos Paciente:</label>
                <input type="text" class="form-control" name="apellidos" id="apellidos" required readonly > 
                <label>Fecha Nacimiento:</label>
                <input type="date" class="form-control" name="fechan" id="fechan" required readonly>
                <label>Tipo de Consulta:</label>
                <input type="text" class="validate[required] form-control" name="title" placeholder="Tipo de Consulta" id="title" required>
                <label>Ubicacion Sala:</label>
                <select name="categorie" class="form-control" required>
                  <option value="Silla 1">Silla 1</option>
                  <option value="Silla 2">Silla 2</option>
                  <option value="Silla 3">Silla 3</option>
                </select>
                <label>Fecha Final:</label>
                <input type="text" class="form-control input-sm" name="end_date" id="datepicker2" required>
                <label>Hora Final:</label>
                <input type="text" class="form-control input-sm" name="end_time" placeholder="HH:MM" id="tp2" required>
                <label>Color del Evento:</label>
                <input type="text" class="form-control input-sm" name="color" id="cp" required>
                </div> 

                <div class="col-md-6">
                <label>Nombres Paciente:</label>
                <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres Paciente" required readonly>  
                <label>Genero:</label>
                <input type="text" class="form-control" name="genero" id="genero" placeholder="Genero" required readonly> 
                <label>E-mail:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required readonly>
                <label>Descripcion:</label>
                <textarea class="form-control" name="description" id="description" placeholder="Descripcion" required></textarea>
                <label>Fecha Inicial:</label>
                <input type="text" name="start_date" class="form-control input-sm validate[required]" id="datepicker" required>
                <label>Hora Inicial:</label>
                <input type="text" class="form-control input-sm" name="start_time" placeholder="HH:MM" id="tp1" required>
                <label>Evento Todo el Dia:</label>
                <select name="allDay" class="form-control" required>
                    <option value="true" selected>Si</option>
                    <option value="false">No</option>
                </select>
                </br>
                </br>
                <button type="submit" onclick="calendar.save()" class="btn btn-primary pull-right">Agregar Cita</button>

                </div>    
                
                
                
            </form>   
          </br>
          </br>
          </br>
          </br>
          </br>
          </br>
          </br>
          </br>
          </br>
          </br>
          </br>
      </div>
        <div class="col-md-2">
            
        </div>
  </div>
  </br>
                </br>
                </br>
                </br>
                </br>
                </br>
                </br>
                </br>
                </br>
                </br>
</div>
<div id="footer">
  <div>
  <center><img src="images/cita-on.png" title="Citas"  height="50px" width="50px"><img src="images/separador.png"  height="50px" width="50px"><img src="images/paciente.png" title="Pacientes"  height="50px" width="50px">&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/asistente.png" title="Asistentes"  height="50px" width="50px">  <img src="images/separador.png"  height="50px" width="50px">   <a href="menu.php"><img src="images/roles.png" title="Roles"  height="50px" width="50px"></a>   <a href="login.php"><img src="images/salir.png" title="Salir" height="50px" width="50px"></a><center>
  <center>Citas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pacientes&nbsp;&nbsp;&nbsp;Asistentes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Roles&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Salir<center>
  </div> 
  
  
</div>

<!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/fullcalendar.js"></script>
    <script src="js/gcal.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery.calendar.js"></script>
    <script src="lib/colorpicker/bootstrap-colorpicker.js"></script>
    <script src="lib/validation/jquery.validationEngine.js"></script>
    <script src="lib/validation/jquery.validationEngine-en.js"></script>
    
    <script src="lib/timepicker/jquery-ui-sliderAccess.js"></script>
    <script src="lib/timepicker/jquery-ui-timepicker-addon.min.js"></script>
    
    <script src="js/custom.js"></script>
    
    <script type="text/javascript">
    $().FullCalendarExt();
  </script>

   

</body>
</html>
