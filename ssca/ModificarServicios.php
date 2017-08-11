<?php
  require_once 'db_connect1.php';
    // connecting to db
  $db = new DB_CONNECT(); 
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
        <script src="js/script.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="js/popup.js"></script>
        <script type="text/javascript" src="js/popup.js"></script>
        <style>
          input, select{
        border-radius:8px;
        width:100%
      }
        </style>
        <script type='text/javascript'> 
          $(document).ready(function(){  
              $("#identificacion").click(function(e){ 
                  e.preventDefault(); 
                  ajax_search1(); 
                  ajax_search2();
                  ajax_search3();
                  ajax_search4();
              });
          });
          function ajax_search1(){ 
            $("#tipo").show(); 
            var search_val=$("#identificacion").val(); 
            $.post("./fet.php", {get_option : search_val}, function(data){
             if (data.length>0){ 
               $("#tipo").val(data); 
             } 
            }) 
          } 
          function ajax_search2(){ 
            $("#categoria").show(); 
            var search_val=$("#identificacion").val(); 
            $.post("./fet1.php", {get_option : search_val}, function(data){
             if (data.length>0){ 
               $("#categoria").val(data); 
             } 
            }) 
          } 
          function ajax_search3(){ 
            $("#valor").show(); 
            var search_val=$("#identificacion").val(); 
            $.post("./fet2.php", {get_option : search_val}, function(data){
             if (data.length>0){ 
               $("#valor").val(data); 
             } 
            }) 
          } 
          function ajax_search4(){ 
            $("#periodicidad").show(); 
            var search_val=$("#identificacion").val(); 
            $.post("./fet3.php", {get_option : search_val}, function(data){
             if (data.length>0){ 
               $("#periodicidad").val(data); 
             } 
            }) 
          } 
          </script>
    </head>
    <body id="bodyBase">
      <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Modulo Administrativo</h4>
        <label style="float:right;margin-right:7%; margin-top:-20px"><font color="#FFFFFF" size="4"><a href="ModificarServicios.html" style="color:#FFF">Modificaci&oacute;n de Servicios</a></font></label><label style="float:right; margin-right:20px; margin-top:-20px">|</label><label style="float:right; margin-right:40px; margin-top:-20px"><font color="#FFFFFF" size="4"><a href="CrearServicios.html" style="color:#FFF">Creaci&oacute;n de Servicios</a></font></label>
        <h2 align="right" style="margin-top:2%; margin-right:2%; color:#00C">Modificaci&oacute;n de Servicios</h2>
        <div id='cssmenu'>
            <ul>
               <li ><a href='#' title="Gestion de Usuarios"><span>Gestion de Usuarios</span></a>
                    <ul style="margin-right:-42%">
                         <li><a href='UsuariosdelSistema.html' title="Usuarios del Sistema"><span>Usuarios del Sistema</span></a></li>
                         <li class='last' title="Usuarios Aplicaciones" class="active"><a href='AdminUsuariosAplicaciones.html'><span>Usuarios de Aplicaciones</span></a></li>
                    </ul>
               </li>
               <li class=''><a href='#' title="Gestion Servicios del Sistema"><span>Gestion Servicios del Sistema</span></a>
                  <ul style="margin-right:-42%">
                     <li><a href='CrearServiciosSistema.php' title="Servicios del Sistema"><span>Servicios del Sistema</span></a></li>
                     <li class='last'><a href='Reportes.html' title="Reportes"><span>Reportes</span></a></li>
                  </ul>
               </li>
               <li class="active"><a href='#' title="Gestion Servicios del Sistema"><span>Gestion Servicios Escolares</span></a>
                  <ul style="margin-right:-42%">
                     <li><a href='CrearServicios.html'><span>Servicios Escolares</span></a></li>
                     <li><a href='PagosCuentaCobro.php'><span>Pago a Terceros</span></a></li>
                     <li class='last'><a href='ReportesServiciosSistema.html'><span>Reportes</span></a></li>
                  </ul>
               </li>
               <li class=''><a href='#' title="Puntos de Recarga"><span>Gestion de Credenciales</span></a>
                  <ul style="margin-right:-42%">
                     <li><a href='ReemplazarCredencial.html'><span>Remplazo de Credenciales</span></a></li>
                     <li><a href='ReporteCredencial.html'><span>Reportes</span></a></li>
                  </ul>
               </li>
               <li class=''><a href='#' title="Entrada y Salida de Personal"><span>Entrada y Salida de Personal</span></a>
                    <ul style="margin-right:-42%">
                         <li><a href='Estudiantes.html' title="Estudiantes"><span>Estudiantes</span></a></li>
                         <li><a href='FuncionariosInternos.html' title="Funcionarios Internos"><span>Funcionarios Internos</span></a></li>
                    </ul>
               </li>
            </ul>
        </div>
        
        <div class="contenidoBorde">
            <form id="commentForm" method="post" action="mensajemodificarservicios.php" style="height:100%">
                <table style="padding-left:4%; padding-top:4.5%;padding-right:20px;position:absolute" cellspacing="0" cellpadding="0" width="100%">
                   <tr valign="top">
                        <td align="right"><label for="identificacion"><font color="#0033FF" size="2">Seleccione el servicio</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><select id="identificacion" name="identificacion" onchange="fetch(this.value); required">
                           
                           <?php
                             $select=mysql_query("select * from servicios ORDER BY tipo ASC");
                             while($row=mysql_fetch_array($select))
                             {
                              echo "<option value=".$row['idservicio'].">".$row['tipo']."</option>";
                             }
                           ?>
                          </select>
                         </td>
                    </tr>
                    <td>&nbsp;</td>
                    <tr valign="top">
                        <td align="right"><label for="tipos"><font color="#0033FF" size="2">Tipo</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><input id="tipo" name="tipo" type="text" onchange="fetch_select(this.value);" required/></td>


                        <td align="right"><label for="categoria"><font color="#0033FF" size="2">Categoria</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><input id="categoria" name="categoria" type="text" required/></td>

                        <td width="12px">&nbsp;</td>
                    </tr>
                    <td>&nbsp;</td>
                    <tr valign="top">
                        <td align="right"><label for="valor"><font color="#0033FF" size="2">Valor</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><input id="valor" name="valor" type="number" required/></td>
                        <td align="right"><label for="periodicidad"><font color="#0033FF" size="2">Periodicidad</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><input id="periodicidad" name="periodicidad" type="number" required/></td>
                        <td width="12px">&nbsp;</td>
                    </tr>
                    <td>&nbsp;</td>
                    <tr>
                      <td colspan="6" height="2px">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                        <td colspan="4" align="right"><button type="submit" style="width:120px; border-radius:6px; height:30px;background-color:#069;color:#FFF;" name="btnCrearUsuario" id="btnCrearUsuario">Modificar </button></td>
                        <td>&nbsp;</td>
                        <td align="center">&nbsp;</td>
                    </tr>
                </table>
            </form>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>     
    </body>
</html>