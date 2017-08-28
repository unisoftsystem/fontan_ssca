<?php
include("connect.php");
?>
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
    //sesion a variable
     $_SESSION['userid'] = $id;
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
        <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="js/script.js"></script>
        <style>
          input, select{
        border-radius:8px;
        
        }
  h2 {
        text-shadow: 0px 2px 3px #555;
        }
        </style>
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
              }); 
          });
          function ajax_search(){ 
            $("#apellido1").show(); 
            var search_val=$("#nidentificacion").val(); 
            $.post("./find2.php", {search_term : search_val}, function(data){
             if (data.length>0){ 
               $("#apellido1").val(data); 
             } 
            }) 
          } 
          function ajax_search1(){ 
            $("#apellido2").show(); 
            var search_val=$("#nidentificacion").val(); 
            $.post("./find3.php", {search_term : search_val}, function(data){
             if (data.length>0){ 
               $("#apellido2").val(data); 
             } 
            }) 
          } 
          function ajax_search2(){ 
            $("#nombre1").show(); 
            var search_val=$("#nidentificacion").val(); 
            $.post("./find4.php", {search_term : search_val}, function(data){
             if (data.length>0){ 
               $("#nombre1").val(data); 
             } 
            }) 
          } 
          function ajax_search3(){ 
            $("#nombre2").show(); 
            var search_val=$("#nidentificacion").val(); 
            $.post("./find5.php", {search_term : search_val}, function(data){
             if (data.length>0){ 
               $("#nombre2").val(data); 
             } 
            }) 
          } 
        </script>
        <script type="text/javascript">
        function fetch_select(val)
        {
           $.ajax({
             type: 'post',
             url: 'fetch_data.php',
             data: {
               get_option:val
             },
             success: function (response) {
               document.getElementById("new_select").innerHTML=response;
    sumarcbx(); 
             }
           });
        }
        
        function fetch_select2(val)
        {
           $.ajax({
             type: 'post',
             url: 'fetch_data1.php',
             data: {
               get_option:val
             },
             success: function (response) {
               document.getElementById("new_sel").innerHTML=response; 
    sumarcbx();
             }
           });
        }

        function fetch_select3(val)
        {
           $.ajax({
             type: 'post',
             url: 'fetch_data2.php',
             data: {
               get_option:val
             },
             success: function (response) {
               document.getElementById("new_sell").innerHTML=response; 
    sumarcbx();
             }
           });
        }
        </script>
        
        <script type="text/javascript">
        function fetch(val)
        {
           $.ajax({
             type: 'post',
             url: 'fetch.php',
             data: {
               get_option:val
             },
             success: function (response) {
               document.getElementById("new").innerHTML=response; 
         console.log(response);
             }
           });
        }
        
        function fetch1(val)
        {
           $.ajax({
             type: 'post',
             url: 'fetch1.php',
             data: {
               get_option:val
             },
             success: function (response) {
               document.getElementById("new1").innerHTML=response; 
             }
           });
        }

        function fetch2(val)
        {
           $.ajax({
             type: 'post',
             url: 'fetch2.php',
             data: {
               get_option:val
             },
             success: function (response) {
               document.getElementById("new2").innerHTML=response; 
             }
           });
        }
        </script>
        <script>
          function sumarcbx(){
            var cb1=$("#new_select").val();
            var cb2=$("#new_sell").val();
            var cb3=$("#new_sel").val();
            if(cb1 == null)cb1 = 0;
            if(cb2 == null)cb2 = 0;
            if(cb3 == null)cb3 = 0;
            var suma=parseFloat(cb1)+parseFloat(cb2)+parseFloat(cb3);
            $("#valortotal").val(suma);
          }
          </script>
    </head>
    <body id="bodyBase">
      <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Centro de Liquidacion y Pagos</h4>
        <h2 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Pago Inicial de Servicios Escolares</h2>
        <?php
        $query1  = "SELECT * FROM usuarios_sistema where  idUsuario='".$id."'";
        $result1 = mysql_query($query1);

        while($rows = mysql_fetch_array($result1, MYSQL_ASSOC))
        { 
        $permisos = stripslashes($rows['permisos']);
        }
        ?>
        <div id='cssmenu'>
            <ul> 
               <li><a href='#' title="Recaudos"><h6><p class="full-circle"></p><span>Recaudos</span></h6></a>
                    <ul style="margin-right:-42%">
                         <?php
                          $pos = strpos($permisos, "CREAR PAGO INICIAL SERVICIOS");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='asignacionpagoinicial.php' title=\"Pago Inicial de Servicios\"><span>Pago Inicial de Servicios</span></a></li>";
                          }
                          ?> 
                          <?php
                          $pos = strpos($permisos, "CREAR RECAUDO SERVICIOS");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li class='last' title=\"Recaudo de Servicios\" ><a href='RecaudodeServicios.html'><span>Recaudo de Servicios</span></a></li>";
                          }
                          ?> 
                          <?php
                          $pos = strpos($permisos, "CREAR RECARGUE DE CREDENCIALES");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li class='last' title=\"Recargue de Credenciales\" ><a href='ProcesoRecaudo.php'><span>Recargue de Credenciales</span></a></li>";
                          }
                          ?>
                    </ul>
               </li>
               <li class=''><a href='#' title="Reportes"><h6><p class="full-circle"></p><span>Reportes</span></h6></a>
                  <ul style="margin-right:-42%">
                          <?php
                          $pos = strpos($permisos, "REPORTES");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='ReporteRecaudo.php' title=\"Cierre de Caja\"><span>Cierre de Caja</span></a></li>";
                          }
                          ?>
                          <?php
                          $pos = strpos($permisos, "REPORTES");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='Generacionestadosdecuenta.html' title=\"Generacion estados de cuenta\"><span>Generacion estados de cuenta</span></a></li>";
                          }
                          ?>
                  </ul>
               </li>
               <li><a href='#' title="Mensajeria"><h6><p class="full-circle"></p><span>Mensajeria</span></h6></a>
                  <ul style="margin-right:-42%">
                          <?php
                          $pos = strpos($permisos, "COBRO SERVICIOS ESCOLARES");
                          if ($pos == false) {
                              //no es necesario mostrar mensaje ya que se veria mal en el menu por eso se deja vacio.
                          } else {
                              echo "<li><a href='Cobrodeserviciosescolaresalosacudientes.html'><span>Cobro de servicios escolares a los acudientes</span></a></li>";
                          }
                          ?>
                  </ul>
               </li>
            </ul>
        </div>
        
        <div class="contenidoBorde">
            <form name="formulario" id="formulario" method="post" action="mensajecrearasignacion.php" style="height:100%">
                <table  cellspacing="0" cellpadding="0" width="100%">
		    </br>
                    <tr valign="top" style="border-bottom: 1px solid #a2a2a2;">
                        <td align="right"><label for="nidentificacion"><font color="#09C" size="1">No.Identificacion&nbsp;&nbsp;&nbsp;</font></label></td>
                        
                        <td><input id="nidentificacion" name="nidentificacion" type="text" required/></td>
                        <td align="right"><label for="apellido1"><font color="#09C" size="1">Primer Apellido&nbsp;&nbsp;&nbsp;</font></label></td>
                        
                        <td><input id="apellido1" name="apellido1" type="text" required readonly /></td>
                        
                        <td align="right"><label for="apellido2"><font color="#09C" size="1">Segundo Apellido&nbsp;&nbsp;&nbsp;</font></label></td>
                        
                        <td><input id="apellido2" name="apellido2" type="text" required readonly/></td>
                        
                    </tr>
                    <td>&nbsp;</td>
                    <tr valign="top">
                        <td align="right"><label for="tipo"><font color="#09C" size="1"></font></label></td>
                        
                        <td><input id="tipo" name="tipo" type="hidden" required/></td>
                        <td align="right"><label for="nombre1"><font color="#09C" size="1">Primer Nombre&nbsp;&nbsp;&nbsp;</font></label></td>
                        
                        <td><input id="nombre1" name="nombre1" type="text" required readonly/></td>
                        
                        <td align="right"><label for="nombre2"><font color="#09C" size="1">Segundo Nombre&nbsp;&nbsp;&nbsp;</font></label></td>
                        
                        <td><input id="nombre2" name="nombre2" type="text" required readonly/></td>
                          
                    </tr>
                    <td>&nbsp;</td>
                    <tr valign="top" style="background-color: gray; height: 1px; border: 0; width: 100%;">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>
                    <td>&nbsp;</td>
                    <tr valign="middle" height="100">
                        <td><label for="Tipo Servicio"><font color="#09C" size="1">Tipo Servicio</font></label></td>
                             
                         <td><select id="tipo" name="tipo" onchange="fetch(this.value); required">
                           <option>
                              seleccione
                           </option>
                           <?php
                             $select=mysql_query("select tipo from servicios ORDER BY tipo ASC");
                             while($row=mysql_fetch_array($select))
                             {
                              echo "<option>".$row['tipo']."</option>";
                             }
                           ?>
                          </select>
                         </td>
                        <td><label for="Categoria"><font color="#09C" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Categoria</font></label></td>
                           
                         <td>
                           <select id="new" name="new" onchange="fetch_select(this.value); required">
                            <option>
                              seleccione
                           </option>
                          </select>
                         </td>

                        
                        <td align="right"><label for="Valor"><font color="#09C" size="1">Valor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></label></td>
                        
                        <td><select style="width: 100px" id="new_select" name="new_select" onchange="sumarcbx();" readonly></select></td>
                        
                    
                    <td><label for="Periodicidad"><font color="#09C" size="1">Periodicidad&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></label></td>
                             
                         <td><select id="periodicidad" name="periodicidad" required>
                           
                           <?php
                             $select=mysql_query("select periodicidad from servicios ORDER BY periodicidad ASC");
                             while($row=mysql_fetch_array($select))
                             {
                              echo "<option>".$row['periodicidad']."</option>";
                             }
                           ?>
                          </select>
                         </td>
                    </tr>


                    <tr valign="middle" height="100"> 
                        <td><label for="Tipo Servicio"><font color="#09C" size="1">Tipo Servicio</font></label></td>
                            
                         <td><select id="tipo4" name="tipo4"  onchange="fetch2(this.value);">
                           <option>
                              seleccione
                           </option>
                           <?php
                             $select=mysql_query("select tipo from servicios ORDER BY tipo ASC");
                             while($row=mysql_fetch_array($select))
                             {
                              echo "<option>".$row['tipo']."</option>";
                             }
                           ?>
                          </select>
                         </td>

                        
                        <td><label for="Categoria"><font color="#09C" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Categoria</font></label></td>
                            
                         <td>
                           <select id="new2" name="new2" onchange="fetch_select3(this.value);">
                            <option>
                              seleccione
                           </option>
                          </select>
                         </td>

                        
                        <td align="right"><label for="Valor1"><font color="#09C" size="1">Valor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></label></td>
                        <td><select style="width: 100px" id="new_sell" name="new_sell" onchange="sumarcbx();" readonly></select></td>
                  

                  
                    <td><label for="Periodicidad1"><font color="#09C" size="1">Periodicidad&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></label></td>
                            
                         <td><select id="periodicidad1" name="periodicidad1">
                           
                           <?php
                             $select=mysql_query("select periodicidad from servicios ORDER BY periodicidad ASC");
                             while($row=mysql_fetch_array($select))
                             {
                              echo "<option>".$row['periodicidad']."</option>";
                             }
                           ?>
                          </select>
                         </td>
                    </tr>

                  
                  <tr valign="middle" height="100"> 
                        <td><label for="Tipo Servicio"><font color="#09C" size="1">Tipo Servicio</font></label></td>
                            
                         <td><select id="tipo1" name="tipo1"  onchange="fetch1(this.value);">
                           <option>
                              seleccione
                           </option>
                           <?php
                             $select=mysql_query("select tipo from servicios ORDER BY tipo ASC");
                             while($row=mysql_fetch_array($select))
                             {
                              echo "<option>".$row['tipo']."</option>";
                             }
                           ?>
                          </select>
                         </td>

                        
                        <td><label for="Categoria"><font color="#09C" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Categoria</font></label></td>
                             
                         <td>
                           <select id="new1" name="new1" onchange="fetch_select2(this.value);">
                            <option>
                              seleccione
                           </option>
                          </select>
                         </td>

                        
                        <td align="right"><label for="Valor2"><font color="#09C" size="1">Valor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></label></td>
                        
                        <td><select style="width: 100px" id="new_sel" name="new_sel"  onchange="sumarcbx();" readonly ></select></td>
                        
                  
                    <td align="right"><label for="Periodicidad2"><font color="#09C" size="1">Periodicidad&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></label></td>
                          
                         <td><select id="periodicidad2" name="periodicidad2">
                           
                           <?php
                             $select=mysql_query("select periodicidad from servicios ORDER BY periodicidad ASC");
                             while($row=mysql_fetch_array($select))
                             {
                              echo "<option>".$row['periodicidad']."</option>";
                             }
                           ?>
                          </select>
                         </td>
                    </tr>
                  
                    <td>&nbsp;</td>
                    <tr>
                      
                    </tr>
                    <tr>
                        <td align="right"><font color="#09C" size="1"><label for="Pago en Efectivo">Pago en Efectivo&nbsp;</label></font></td>
                        <td ><input type="radio" name="r1" id="r1" value="Pago en Efectivo" required></td>

                        <td align="right"><font color="#09C" size="1"><label for="Pago con Credencial">Pago con Credencial&nbsp;</label></font></td>
                        <td><input type="radio" name="r1" id="r1" value="Pago con Credencial"></td>
                       
                        <td colspan="1" align="center"><button type="submit" style="width:120px; border-radius:6px; height:30px;background-color:#069;color:#FFF;" name="btnCrearUsuario" id="btnCrearUsuario" value="1">Pagar </button></td>
                        <td colspan="1" align="center"><button type="submit" style="width:120px; border-radius:6px; height:30px;background-color:#ee2121;color:#FFF;" name="btnCrearUsuario1" id="btnCrearUsuario1">Sin Pago </button></td>

                       
                        <td align="right"><label for="Valor Total"><font color="#09C" size="1">Valor Total&nbsp;&nbsp;&nbsp;</font></label></td>
                        
                        <td><input style="width: 100px"id="valortotal" name="valortotal" type="text" required readonly required/></td>
                        <div id="reflejar"></div>
                    </tr>
                </table>
            </form>
        </div>
        <script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>     
    </body>
</html>