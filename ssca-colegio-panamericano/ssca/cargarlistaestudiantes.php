
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>app colegio</title>
    <meta name="author" content="Adtile">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
    <script src="js/responsive-nav.js"></script>
    <script type="text/javascript">
          $(document).ready(function () {
           
          window.setTimeout(function() {
              $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                  $(this).remove(); 
              });
          }, 5000);
           
          });
    </script>
    <script>
    //initialize the drag and drop functions.
function drag(){
        
        $( "#content_box_drag p" ).draggable({
            appendTo: "body",
            helper: "clone",
            revert: "invalid"
            
            //add comma to previous last line & uncomment this if u want to remove the dropped item
             /*stop: function(){$(this).remove();}*/ 

        });
        
        $( "#content_box_drop p" ).droppable({
            activeClass: "dropper_hover",
            hoverClass: "dropper_hover",
            accept: ":not(.ui-sortable-helper)",
            drop: function( event, ui ) {
                 var ele = ui.draggable.text();            
                    $.ajax({
                                  url: "store.php",
                                  type : "POST",
                                  data: {element:ele},
                                  beforeSend:function(){
                                                $('#search_result').html("<center><br/><h4>Loading.....</h4></center>");
                                                            },
                                success:function(data){
                                               $("#search_result").html(data);
                                                            }
                                 });
            }
        });

}
    </script>
    <style>
    .content_box{ padding:5px; 
 width:300px; 
  float:left;height:250px; 
 border:#dedede solid 1px; 
 font-family:Verdana, Arial, Helvetica, sans-serif;
margin:90px;
overflow:auto;
color:#999999;
font-size:14px;
}

.content_holder_box{ width:300px;
float:right;
height: 300px;
border:#dedede solid 1px;
padding:10px;
margin:90px;
color:#999999;
font-size:14px;
}

.content_holder_box:hover{ border:#0099FF solid 1px; }

.dragelement{ padding:5px; margin:3px; width:270px; 
border:#dedede solid 1px;
background-color:#C7C6FF;
cursor:move;
color:#000;
font-size:13px;
}

.dropper{ width:270px;
height:125px;
margin:10px;

}

.dropper_hover{ border:#999999 dashed 1px; background:url(../images/darrow.jpg) center no-repeat  ;}
    </style>
  </head>
  <body>

    <header>
       <a href="menu.php" class="logo" data-scroll><img src="img/HOME.png" width="60" height="60" border="0"></a>
      <nav class="nav-collapse">
        <ul>
          <li class="menu-item active"><a href="consultarutas.php" data-scroll>Consulta Ruta</a></li>
          <li class="menu-item active"><a href="formcrearruta.php" data-scroll>Identificacion Ruta</a></li>
          <li class="menu-item"><a href="cargarlistaestudiantes.php" data-scroll>Cargar Lista Estudiantes</a></li>
          <li class="menu-item"><a href="pagovirtual.php" data-scroll>Pagos Virtuales</a></li>
          <li class="menu-item"><a href="bitacora.php" data-scroll>Bitacoras</a></li>
          <li class="menu-item"><a href="mapa.php" data-scroll>Mapa</a></li>
          <li class="menu-item"><a href="#blog" data-scroll>Salir</a></li>
        </ul>
      </nav>
    </header>
</br>
</br>
</br>
    <center><h1>Lista Estudiantes</h1></center>
    <div class="content_box" id="content_box_drag" onMouseOver="drag();"> Estudiantes
        <?php
        include("connect.php");
        $query  = "SELECT NumeroId, PrimerNombre, PrimerApellido, ruta_idruta FROM usuarios ";
        $result = mysql_query($query);
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {        
        $id = stripslashes($row['NumeroId']);
        $nombre = stripslashes($row['PrimerNombre']);
        $apellido = stripslashes($row['PrimerApellido']);
        $ruta = stripslashes($row['ruta_idruta']);
        ?>
      <p id="dragelement_<?php echo $id ?><?php echo $ruta ?><?php echo $nombre ?><?php echo $apellido ?>" class='dragelement'><label> Identificacion </label> <?php echo $id ?> <label> Ruta </label>  <?php echo $ruta?> <label> Nombre </label> <?php echo $nombre ?> <label> Apellido </label> <?php echo $apellido;?> 
      </p>
      <?php } ?>
      </div>
      <div class="content_holder_box" id="content_box_drop">Agregar
      <p class="dropper"></p>
      </div>
      <div style="clear:both;"></div>
      <br/><br/>
     <div id="search_result"></div>    
    <script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/fixed-responsive-nav.js"></script>
  </body>
</html>