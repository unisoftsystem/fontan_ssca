<?php
include("connect.php");
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
        width:50%
        }
        h3 {
               text-shadow: 0px 2px 3px #555;
            }
        </style>
        
       
        
        <script type="text/javascript">
        function fetch(val)
        {
           $.ajax({
             type: 'post',
             url: 'fech.php',
             data: {
               get_option:val
             },
             success: function (response) {
               document.getElementById("new").innerHTML=response; 
         console.log(response);
             }
           });
        }
        </script>
        <script type="text/javascript">
        function fetch_select(val)
        {
           $.ajax({
             type: 'post',
             url: 'fetch_data4.php',
             data: {
               get_option:val
             },
             success: function (response) {
               document.getElementById("new_select").innerHTML=response; 
             }
           });
        }
        </script>
    </head>
    <body id="bodyBase">
      <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Modulo Administrativo</h4>
        <h3 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Creacion de Servicios del Sistema</h3>
        <div id='cssmenu'>
            <ul>
               <li ><a href='#' title="Gestion de Usuarios"><h6><p class="full-circle"></p><span>Gestion de Usuarios</span></h6></a>
                    <ul style="margin-right:-42%">
                         <li><a href='UsuariosdelSistema.html' title="Usuarios del Sistema"><span>Usuarios del Sistema</span></a></li>
                         <li class='last' title="Usuarios Aplicaciones" class="active"><a href='AdminUsuariosAplicaciones.html'><span>Usuarios de Aplicaciones</span></a></li>
                    </ul>
               </li>
               <li class="active"><a href='#' title="Gestion Servicios del Sistema"><h6><p class="full-circle"></p><span>Gestion Servicios del Sistema</span></h6></a>
                  <ul style="margin-right:-42%">
                     <li><a href='CrearServiciosSistema.php' title="Servicios del Sistema"><span>Servicios del Sistema</span></a></li>
                     <li class='last'><a href='Reportes.html' title="Reportes"><span>Reportes</span></a></li>
                  </ul>
               </li>
               <li><a href='#' title="Gestion Servicios del Sistema"><h6><p class="full-circle"></p><span>Gestion Servicios Escolares</span></h6></a>
                  <ul style="margin-right:-42%">
                     <li><a href='CrearServicios.html'><span>Servicios Escolares</span></a></li>
                     <li><a href='PagosCuentaCobro.php'><span>Pago a Terceros</span></a></li>
                     <li class='last'><a href='ReportesServiciosSistema.html'><span>Reportes</span></a></li>
                  </ul>
               </li>
               <li class=''><a href='#' title="Puntos de Recarga"><h6><p class="full-circle"></p><span>Gestion de Credenciales</span></h6></a>
                  <ul style="margin-right:-42%">
                     <li><a href='ReemplazarCredencial.html'><span>Remplazo de Credenciales</span></a></li>
                     <li><a href='ReporteCredencial.html'><span>Reportes</span></a></li>
                  </ul>
               </li>
               <li class=''><a href='#' title="Entrada y Salida de Personal"><h6><p class="full-circle"></p><span>Entrada y Salida de Personal</span></h6></a>
                    <ul style="margin-right:-42%">
                         <li><a href='Estudiantes.html' title="Estudiantes"><span>Estudiantes</span></a></li>
                         <li><a href='FuncionariosInternos.html' title="Funcionarios Internos"><span>Funcionarios Internos</span></a></li>
                    </ul>
               </li>
            </ul>
        </div>
        
        <div class="contenidoBorde">
            <form name="formulario" id="formulario" method="post" action="mensajecrearserviciossistema.php" style="height:100%">
                <table style="padding-left:4%; padding-top:4.5%;padding-right:20px;position:absolute" cellspacing="0" cellpadding="0" width="100%">
                    
                    <td>&nbsp;</td>
                    <tr valign="middle" height="50">
                        <td><label for="TModulo"><font color="#09C" size="1">Modulo</font></label></td>
                        <td width="5px">&nbsp;</td>     
                         <td><select id="tipo" name="tipo" onchange="fetch(this.value);" width="0%">
                           <option>
                              seleccione
                           </option>
                           <?php
                             $select=mysql_query("select nombre from modulos");
                             while($row=mysql_fetch_array($select))
                             {
                              echo "<option>".$row['nombre']."</option>";
                             }
                           ?>
                          </select>
                         </td>
                    </tr>
                    <tr tr valign="middle" height="100">
                    <td><label for="SubModulo"><font color="#09C" size="1">SubModulo</font></label></td>
                        <td width="10px"></td>     
                         <td>
                           <select id="new" name="new" width="0%" onchange="fetch_select(this.value);" >
                            <option>
                              seleccione
                           </option>
                          </select>
                         </td>
                    </tr>
                    <tr valign="middle" height="100">
                        <td><label for="Accion"><font color="#09C" size="1">Accion</font></label></td>
                        <td width="5px"></td>
                        <td><select id="new_select" name="new_select" onchange="sumarcbx();" readonly>
                        <option>
                              seleccione
                           </option>
                          </select>
                         </td>
                    </tr>
                    <td>&nbsp;</td>
                    <tr>
                      <td colspan="5" height="2px">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center"><button type="submit" style="width:120px; border-radius:6px; height:30px;background-color:#069;color:#FFF;" name="btnCrearUsuario" id="btnCrearUsuario">Crear</button></td>
                    </tr>
                </table>
            </form>
        </div>
        <script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>     
    </body>
</html>