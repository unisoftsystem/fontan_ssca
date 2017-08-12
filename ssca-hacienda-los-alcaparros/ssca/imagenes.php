<?php include('includes/loader.php'); 
header('Content-Type: text/html; charset=UTF-8');
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
        header ("Location: index.php?mensaje='Usuario o Contraseña Erroneos'");
    }
    $id= $_GET['usuario']; 
    // mysql select usuarios
    $result = mysql_query("SELECT * FROM users where email='".$id."' ");            
?>
<!DOCTYPE html>
<html>
<head>
  <title>Imagenes</title>
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
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="css/base.css" rel="stylesheet">
    <link href="tools/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="js/jquery-1.10.2.min.js"></script>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <!-- Include our stylesheet -->
    <link href="css/styles.css" rel="stylesheet"/>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

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
    height: 90px;
    
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

   .media
    {
        /*box-shadow:0px 0px 4px -2px #000;*/
        margin: 20px 0;
        padding:30px;
    }
    .dp
    {
        border:10px solid #eee;
        transition: all 0.2s ease-in-out;
    }
    .dp:hover
    {
        border:2px solid #eee;
        
    }



    .nav {
    left:50%;
    margin-left:-150px;
    top:50px;
    position:absolute;
}
.nav>li>a:hover, .nav>li>a:focus, .nav .open>a, .nav .open>a:hover, .nav .open>a:focus {
    background:#fff;
}
.dropdown {
    border-radius:4px;
    width:300px;    
}
.dropdown-menu>li>a {
    color:#428bca;
}
.dropdown ul.dropdown-menu {
    border-radius:4px;
    box-shadow:none;
    margin-top:20px;
    width:300px;
}
.dropdown ul.dropdown-menu:before {
    content: "";
    border-bottom: 10px solid #fff;
    border-right: 10px solid transparent;
    border-left: 10px solid transparent;
    position: absolute;
    top: -10px;
    right: 16px;
    z-index: 10;
}
.dropdown ul.dropdown-menu:after {
    content: "";
    border-bottom: 12px solid #ccc;
    border-right: 12px solid transparent;
    border-left: 12px solid transparent;
    position: absolute;
    top: -12px;
    right: 14px;
    z-index: 9;
}




.profile 
{
    min-height: 300px;
    display: inline-block;
    }
figcaption.ratings
{
    margin-top:20px;
    }
figcaption.ratings a
{
    color:#f1c40f;
    font-size:11px;
    }
figcaption.ratings a:hover
{
    color:#f39c12;
    text-decoration:none;
    }
.divider 
{
    border-top:1px solid rgba(0,0,0,0.1);
    }
.emphasis 
{
    border-top: 4px solid transparent;
    }
.emphasis:hover 
{
    border-top: 4px solid #1abc9c;
    }
.emphasis h2
{
    margin-bottom:0;
    }
span.tags 
{
    background: #1abc9c;
    border-radius: 2px;
    color: #f5f5f5;
    font-weight: bold;
    padding: 2px 4px;
    }

.row {
    margin-left: -130px;
}

.col-fixed {
    /* custom width */
    width:320px;
}
.col-min {
    /* custom min width */
    min-width:320px;
}
.col-max {
    /* custom max width */
    max-width:320px;
}

#menuinicial{
    position:fixed;
    width:100%;
    height:90px;
    background-color:#FFFFFF;
    color:#000000;
    clear:both;
    z-index: 100;
  }

 @media (min-width: 992px)
.col-md-9 {
    width: 100%;
}

#dialogo2 {
    background-color: #e5e5e5;
    border-radius: 20px;
    padding: 10px;
    text-align: left;
    padding: 15px 30px 30px 30px;
    margin-bottom: 30px;
}

#dialogo3 {
    background-color: #e5e5e5;
    border-radius: 20px;
    padding: 10px;
    text-align: left;
    padding: 15px 30px 30px 30px;
    margin-bottom: 30px;
    width: 80%;
}

ul.tabs{height:30px;width:100%;margin:0;padding:0;list-style:none}
        .tabs li{float:left;height:30px;background:#f5f5f5;border-radius:6px 6px 0 0}
        .tabs li.selected{background:#fff;border:solid #f5f5f5;border-width:1px 1px 0 1px}         
            .tabs li a:link,.tabs li a:active,.tabs li a:visited,.tabs li a:hover{line-height:30px;font-size:1.1em;text-decoration:none;display:block;color:#000;padding:0 30px}
            .tabs li.selected a:link,.tabs li.selected a:active,.tabs li.selected a:visited,.tabs li.selected a:hover{font-weight:bold}         
        div.pestana{width:100%;margin:0;padding:0;padding:20px;top:-1px;z-index:-1;border-radius:0 0 6px 6px}
            .pestana p{font-size:1em;line-height:100%;margin:0;}

.modal-body {
     max-height: 800px; 
    padding: 15px;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
}

.border-text {
    border-radius: 5px;
    border: 2px solid #4d4d4d;
    padding: 10px;
    max-width: 200px;
    text-align: center;
}

.radio-toolbar input[type="radio"]:checked ~ * { 
    background:#0683c9 !important;
}

#eti {
    padding: 5px;
    border-radius: 5px;
    margin-right: 5px;
    background-color: #fff;
}

header h1{
    font-size:12pt;
    color: #fff;
    background-color: #1BA1E2;
    padding: 20px;

}
article
{
    width: 80%;
    margin:auto;
    margin-top:10px;
}


.thumbnail{

    height: 100px;
    margin: 10px;    
}

#divfiltro {
    min-height: 20px;
    padding: 19px;
    margin-bottom: 20px;
    background-color: #f5f5f5;
    border: 1px solid #e3e3e3;
    border-radius: 4px;
    min-height: 300px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
}
  </style>
  <script type="text/javascript">
  function ocultardiv(){
    //oculta  el div con id 
    document.getElementById('ocultar').style.display='none';
    //muestra el div con if
    document.getElementById('ocultar2').style.display='block';
    }

    function ocultardiv2(){
    //oculta  el div con id 
    document.getElementById('ocultar').style.display='block';
    //muestra el div con if
    document.getElementById('ocultar2').style.display='none';
    } 
  </script>
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
  <!-- funcion de shelvin  -->
  <script type="text/javascript">
    window.onload = function(){
    var contador = 0;
            function readImage() {
                
                if(this.files.length > 0){
                  for (var i = 0; i < this.files.length; i++) {
                    console.log(this.files[i]);    
                    var FR = new FileReader();
                    FR.onload = function(e) {
                         console.log(e.target.result);
                         $("#result").append('<img class="thumbnail" src="' + e.target.result + '" title="" id="foto' + contador + '"/><input type="text" id="etiqueta' + contador + '" name="etiqueta' + contador + '" class="form-control"/><br>');
                         contador++;
                    };       
                    FR.readAsDataURL( this.files[i] );
                  } 
                }
                
            }

             $("#fileFoto").change( readImage );
             
    }
</script>
<script type="text/javascript">

window.onload = function(){
        
    //Check File API support
    if(window.File && window.FileList && window.FileReader)
    {
        var filesInput = document.getElementById("archivo");
        
        filesInput.addEventListener("change", function(event){
            
            var files = event.target.files; //FileList object
            var output = document.getElementById("result");
            
            for(var i = 0; i< files.length; i++)
            {
                var file = files[i];
                
                //Only pics
                if(!file.type.match('image'))
                  continue;
                
                var picReader = new FileReader();
                
                picReader.addEventListener("load",function(event){
                    
                    var picFile = event.target;
                    
                    var div = document.createElement("div");
                    
                    div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                            "title='" + picFile.name + "'/><a href='#' class='remove_pict'>X</a>"+
                            "</br>"+
                            "<label>Etiqueta</label>"+
                            "</br>"+
                            "<input type='text' id='texto' /> ";
                    
                    output.insertBefore(div,null);   
                    div.children[1].addEventListener("click", function(event){
                       div.parentNode.removeChild(div);
                    });         
                
                });
                
                 //Read the image
                picReader.readAsDataURL(file);
            }                               
           
        });
    }
    else
    {
        console.log("Your browser does not support File API");
    }
}
</script>
<script type="text/javascript">
    $(document).ready(function(){
                                
        var consulta;
                                                                          
         //hacemos focus al campo de búsqueda
        $("#busquedas").focus();
                                                                                                    
        //comprobamos si se pulsa una tecla
        $("#busquedas").change(function(e){
                                     
              //obtenemos el texto introducido en el campo de búsqueda
              consulta = $("#busquedas").val();
              consulta2 = $("#busquedas2").val();     
              $.ajax({
                    type: "POST",
                    url: "buscar.php",
                    data: { "uno" : consulta, "dos": consulta2 },
                    dataType: "html",
                    beforeSend: function(){
                          //imagen de carga
                          $("#resultado").html("<p align='center'><img src='images/ajax-loader.gif'  /></p>");
                    },
                    error: function(e){
                          alert("Error en la busqueda " + e.responseText);
                    },
                    success: function(data){                                                    
                          $("#resultado").empty();
                          $("#resultado").append(data);
                                                             
                    }
              });                                                                       
                                                                           
        });                                                                  
});
</script>
</script>
</head>
<body>
<header>
    <div class="container clearfix" >
        <div class="col-md-11">
        <center><img src="images/logo_blanco.png"  height="12%" width="12%"></center>
        </div>
        <div class="col-md-1">
        <?php include 'menusuario.php';?>
        </div>
    </div>
</header>
<?php include 'menusuperior.php';?>

<div class="container-fluid">
  <div class="row">
    </br>
    <div class="col-md-2">  
    </div>
        <div class="col-md-10">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <div class="container-fluid">
    </br>
    </br>
    </br>
    </br>
    <div class="row">
    <div class="col-md-2" style="position: fixed">
         <div class="well profile">
            <div class="col-sm-12">           
                <div class="col-xs-12 col-sm-6 text-center">
                    <figure>
                        <img src="<?php echo $image_url ?>" alt="" class="img-circle img-responsive">
                        
                    </figure>
                </div>

                <div class="col-xs-12 ">
                    <h5><?php echo $firstname ?></h5>
                    <h5><?php echo $lastname ?></h5>
                    <p><strong>C.C.: </strong> <?php echo $documentnumber ?></p>
                    <p><strong>Edad: </strong> <?php echo $edad ?></p>
                    <p><strong>Genero: </strong> <?php echo $genero ?></p>
                    <p><strong>Fecha de Nacimiento: </strong> <?php echo $birthdate ?></p>
                       <?php
                       //paso documento a session para uso del path imagenes en scan.php
                      $_SESSION["documentnumber"]=$documentnumber;
                      ?>
                    <a href="modificarpaciente.php?usuario=<?= $id ?>"><img src="images/editar.png" title="Editar Paciente"  height="30px" width="30px"></a>
                </div>
            </div>  
         </div> 
          <center><a href="modificarpaciente.php?usuario=<?= $id ?>"><img src="images/foto.png" title="Editar Imagen"  height="50px" width="50px"></a></center>
         </div>
         </br> 
         
         <center><h4>ARCHIVOS DEL PACIENTE</h4></center>

         <div class="col-md-2">
         </div>
         <div class="col-md-10" id="ocultar">
                <div class="col-md-9" id="resultado">
                <div class="pestana" id="tab-1">
                <form action="uploadimg.php" method="post" enctype="multipart/form-data" name="inscripcion">
                <label for="archivo" style="position: relative;" >
                  <img for="archivo" title="Click para agregar imagen" src="images/plus_blanco.png" height="50%" width="50%" />
                </label>
                <input onclick="ocultardiv();" type='file' id="archivo"  name='archivo[]'  required style="display: none;" multiple=""/>
                <?php
                $querydientes  = "SELECT * FROM imagenes where  iduser='$documentnumber' and menu=menu and fecha=fecha";
                $resultpc = mysql_query($querydientes);
                while($rows = mysql_fetch_array($resultpc, MYSQL_ASSOC))
                { 
                $menu = $rows['menu'];
                $fecha = $rows['fecha'];
                $imagen = "data:image/jpeg;base64,".$rows['data'];
                ?>
                <a href="<?php echo $imagen; ?>"><img  id="color" src="<?php echo $imagen; ?>" width="100px" height="100px" style="border-radius: 50%;border: 3px solid gray;"  /></a>
                <?php 
                }
                ?>
                </div>
                </div>
                <div class="col-md-3" id="divfiltro">
                <center><p>Filtros</p></center>
                <label>Fecha</label>
                <center>
                </br>
                <input type="hidden" value="<?php echo $documentnumber ?>" id="busquedas2"/>
                <input type="date" data-date="" data-date-format="DD-MMMM-YYYY" id="busquedas" />
                </center>
               </form>
                </div>
        </div>
         <div class="col-md-1">
         </div>
         <div class="col-md-8" style="display: none" id="ocultar2">
                    <div class="col-md-4">
                    <form action="uploadimg.php" method="post" enctype="multipart/form-data" name="inscripcion" novalidate>
                    <label for="fileFoto" style="position: relative;" >
                    <img for="fileFoto" title="Click para agregar imagen" src="images/boton1.png" height="100%" width="100%" />
                    </label>
                    
                    </div>
                    <div class="col-md-4">
                    <button type="submit" name="someName" ><img for="archivo"  src="images/boton2.png" height="100%" width="100%" /></button>
                    <input type="hidden" id="didentidad" name="didentidad" value="<?php echo $documentnumber ?>"/>
                    <!-- input de shelvin  -->
                    <input onclick="ocultardiv();" type="file" id="fileFoto" name="fileFoto" class="btn btn-primary" accept="image/*" multiple/>
                    <!-- input de shelvin  -->
                    </div>
                    <div class="col-md-4">
                    <img for="archivo" onclick="ocultardiv2();" src="images/boton3.png" height="100%" width="100%" />
                    </div>
                <div class="col-md-12">    
                <output id="result">
                </output>
                </div>
                </form>
         </div>
         </div>       
         </div>
         </div>
        </div>
    </div>
    </div>
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
          </br>
</div>
<div id="footer">
  <div>
  <center><a href="citas.php"><img src="images/cita-on.png" title="Citas"  height="50px" width="50px"></a><img src="images/separador.png"  height="50px" width="50px"><a href="listapacientes.php"><img src="images/paciente.png" title="Pacientes"  height="50px" width="50px"></a>&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/asistente.png" title="Asistentes"  height="50px" width="50px">  <img src="images/separador.png"  height="50px" width="50px">   <a href="menu.php"><img src="images/roles.png" title="Roles"  height="50px" width="50px"></a>   <a href="login.php"><img src="images/salir.png" title="Salir" height="50px" width="50px"></a><center>
    <center>Citas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pacientes&nbsp;&nbsp;&nbsp;Asistentes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Roles&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Salir<center>
  </div> 
</div>
    <script src="js/script.js"></script>
</body>
</html>