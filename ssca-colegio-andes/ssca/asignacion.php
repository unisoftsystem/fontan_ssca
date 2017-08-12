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
        width:100%
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
      <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Modulo Administrativo</h4>
        <h2 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Asignacion de Servicios Internos</h2>
        <div id='cssmenu'>
            <ul>
               <li><a href='#' title="Gestion de Usuarios"><h6><p class="full-circle"></p><span>Gestion de Usuarios</span></h6></a>
                    <ul style="margin-right:-42%">
                         <li><a href='UsuariosdelSistema.html' title="Usuarios del Sistema"><span>Usuarios del Sistema</span></a></li>
                         <li class='last' title="Usuarios Aplicaciones" class="active"><a href='AdminUsuariosAplicaciones.html'><span>Usuarios de Aplicaciones</span></a></li>
          </ul>
               </li>
               <li class=''><a href='#' title="Gestion Servicios del Sistema"><h6><p class="full-circle"></p><span>Gestion Servicios del Sistema</span></h6></a>
                  <ul style="margin-right:-42%">
                     <li><a href='ServiciosdelSistema.html' title="Servicios del Sistema"><span>Servicios del Sistema</span></a></li>
                     <li class='last'><a href='Reportes.html' title="Reportes"><span>Reportes</span></a></li>
                  </ul>
               </li>
               <li class="active"><a href='#' title="Gestion Servicios del Sistema"><h6><p class="full-circle"></p><span>Gestion Servicios Escolares</span></h6></a>
                  <ul style="margin-right:-42%">
                     <li><a href='asignacion.php'><span>Servicios Escolares</span></a></li>
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
            <form name="formulario" id="formulario" method="post" action="mensajecrearasignacion.php" style="height:100%">
                <table style="padding-left:4%; padding-top:4.5%;padding-right:20px;position:absolute" cellspacing="0" cellpadding="0" width="100%">
                    <tr valign="top" style="border-bottom: 1px solid #a2a2a2;">
                        <td align="right"><label for="nidentificacion"><font color="#09C" size="1">No.Identificacion</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><input id="nidentificacion" name="nidentificacion" type="text" required/></td>
                        <td align="right"><label for="apellido1"><font color="#09C" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Primer Apellido</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><input id="apellido1" name="apellido1" type="text" required readonly/></td>
                        <td width="12px">&nbsp;</td>
                        <td align="right"><label for="apellido2"><font color="#09C" size="1">Segundo Apellido</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><input id="apellido2" name="apellido2" type="text" required readonly/></td>
                        <td width="12px">&nbsp;</td>
                    </tr>
                    <td>&nbsp;</td>
                    <tr valign="top">
                        <td align="right"><label for="tipo"><font color="#09C" size="1"></font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><input id="tipo" name="tipo" type="hidden" required/></td>
                        <td align="right"><label for="nombre1"><font color="#09C" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Primer Nombre</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><input id="nombre1" name="nombre1" type="text" required readonly/></td>
                        <td width="12px">&nbsp;</td>
                        <td align="right"><label for="nombre2"><font color="#09C" size="1">Segundo Nombre</font></label></td>
                        <td width="12px">&nbsp;</td>
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
                        <td><label for="nombre2"><font color="#09C" size="1">Tipo Servicio</font></label></td>
                        <td width="5px">&nbsp;</td>     
                         <td><select id="tipo"  onchange="fetch(this.value);">
                           <option>
                              seleccione
                           </option>
                           <?php
                             $select=mysql_query("select tipo from servicios");
                             while($row=mysql_fetch_array($select))
                             {
                              echo "<option>".$row['tipo']."</option>";
                             }
                           ?>
                          </select>
                         </td>
                        <td><label for="nombre2"><font color="#09C" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Categoria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></label></td>
                        <td width="1px">&nbsp;</td>     
                         <td>
                           <select id="new" onchange="fetch_select(this.value);">
                            <option>
                              seleccione
                           </option>
                          </select>
                         </td>
                        <td width="12px">&nbsp;</td>
                        <td align="right"><label for="nombre2"><font color="#09C" size="1">Valor</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><select id="new_select" onchange="sumarcbx();" disabled></select></td>
                        <td width="12px">&nbsp;</td>
                        <td width="12px">&nbsp;</td> 
                    </tr>
		    

                    <tr valign="middle" height="100"> 
                        <td><label for="nombre2"><font color="#09C" size="1">Tipo Servicio</font></label></td>
                        <td width="5px">&nbsp;</td>     
                         <td><select id="tipo4"  onchange="fetch2(this.value);">
                           <option>
                              seleccione
                           </option>
                           <?php
                             $select=mysql_query("select tipo from servicios");
                             while($row=mysql_fetch_array($select))
                             {
                              echo "<option>".$row['tipo']."</option>";
                             }
                           ?>
                          </select>
                         </td>

                        
                        <td><label for="nombre3"><font color="#09C" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Categoria</font></label></td>
                        <td width="10px">&nbsp;</td>     
                         <td>
                           <select id="new2" onchange="fetch_select3(this.value);">
                            <option>
                              seleccione
                           </option>
                          </select>
                         </td>

                        <td width="12px">&nbsp;</td>
                        <td align="right"><label for="nombre2"><font color="#09C" size="1">Valor</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><select id="new_sell" onchange="sumarcbx();" disabled></select></td>
                        <td width="12px">&nbsp;</td>
                        <td width="12px">&nbsp;</td> 
                  </tr>

                  
                  <tr valign="middle" height="100"> 
                        <td><label for="nombre2"><font color="#09C" size="1">Tipo Servicio</font></label></td>
                        <td width="5px">&nbsp;</td>     
                         <td><select id="tipo1"  onchange="fetch1(this.value);">
                           <option>
                              seleccione
                           </option>
                           <?php
                             $select=mysql_query("select tipo from servicios");
                             while($row=mysql_fetch_array($select))
                             {
                              echo "<option>".$row['tipo']."</option>";
                             }
                           ?>
                          </select>
                         </td>

                        
                        <td><label for="nombre2"><font color="#09C" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Categoria</font></label></td>
                        <td width="10px">&nbsp;</td>     
                         <td>
                           <select id="new1" onchange="fetch_select2(this.value);">
                            <option>
                              seleccione
                           </option>
                          </select>
                         </td>

                        <td width="12px">&nbsp;</td>
                        <td align="right"><label for="nombre2"><font color="#09C" size="1">Valor</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><select id="new_sel"  onchange="sumarcbx();"  disabled></select></td>
                        <td width="12px">&nbsp;</td>
                        <td width="12px">&nbsp;</td> 
                  </tr>



                  

                  
                    <td>&nbsp;</td>
                    <tr>
                      <td colspan="5" height="2px">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right"><font color="#09C" size="1"><label for="r1">Pago en Efectivo</label></font></td>
                        <td width="12px"><input type="radio" name="r" id="r1"></td>

                        <td align="right"><font color="#09C" size="1"><label for="r1">Pago con Credencial</label></font></td>
                        <td width="12px"><input type="radio" name="r" id="r2"></td>
                       
                        <td colspan="1" align="center"><button type="submit" style="width:120px; border-radius:6px; height:30px;background-color:#069;color:#FFF;" name="btnCrearUsuario" id="btnCrearUsuario" value="1">Pagar </button></td>
                        <td colspan="1" align="center"><button type="submit" style="width:120px; border-radius:6px; height:30px;background-color:#ee2121;color:#FFF;" name="btnCrearUsuario1" id="btnCrearUsuario1" >Sin Pago </button></td>

                        <td width="12px">&nbsp;</td>
                        <td align="right"><label for="nombre2"><font color="#09C" size="1">Valor Total</font></label></td>
                        <td width="12px">&nbsp;</td>
                        <td><input id="valortotal" name="valortotal" type="text" required readonly/></td>
                        <div id="reflejar"></div>
                        <td width="12px">&nbsp;</td>
                    </tr>
                </table>
            </form>
        </div>
        <script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>     
    </body>
</html>