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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/script.js"></script>
        <style>
          input, select{
        border-radius:8px;
        width:100%
        }

        #popup {
              left: 0;
              position: absolute;
              top: 0;
              width: 100%;
              z-index: 1001;
          }

          .content-popup {
              margin:0px auto;
              margin-top:120px;
              position:relative;
              padding:10px;
              width:500px;
              min-height:250px;
              border-radius:4px;
              background-color:#FFFFFF;
              box-shadow: 0 2px 5px #666666;
          }

          .content-popup h2 {
              color:#48484B;
              border-bottom: 1px solid #48484B;
              margin-top: 0;
              padding-bottom: 4px;
          }

          .popup-overlay {
              left: 0;
              position: absolute;
              top: 0;
              width: 100%;
              z-index: 999;
              display:none;
              background-color: #777777;
              cursor: pointer;
              opacity: 0.7;
          }

          .close {
              position: absolute;
              right: 15px;
          }
           h3 {
              text-shadow: 0px 2px 3px #555;
              }
        </style>
        <script type="text/javascript" src="jquery.js"></script>
          <script type="text/javascript">
          $(document).ready(function(){
            $('#btnCrearUsuario').click(function(){
                  $('#popup').fadeIn('slow');
                  $('.popup-overlay').fadeIn('slow');
                  $('.popup-overlay').height($(window).height());
                  return false;
              });
              
              $('#close').click(function(){
                  $('#popup').fadeOut('slow');
                  $('.popup-overlay').fadeOut('slow');
                  return false;
              });
          });
          </script>

          <script type="text/javascript">
          $(document).ready(function(){
            $('#r1').click(function(){
                  $('#popup').fadeIn('slow');
                  $('.popup-overlay').fadeIn('slow');
                  $('.popup-overlay').height($(window).height());
                  return false;
              });
              
              $('#close').click(function(){
                  $('#popup').fadeOut('slow');
                  $('.popup-overlay').fadeOut('slow');
                  return false;
              });
          });
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
        <script type='text/javascript'> 
          $(document).ready(function(){ 
          $("#search_results").slideUp(); 
              $("#search_button").click(function(e){ 
                  e.preventDefault(); 
                  ajax_search(); 
              }); 
              $("#search_term").keyup(function(e){ 
                  e.preventDefault(); 
                  ajax_search(); 
              }); 

          });
          function ajax_search(){ 
            $("#search_results").show(); 
            var search_val=$("#search_term").val(); 
            $.post("./find.php", {search_term : search_val}, function(data){
             if (data.length>0){ 
               $("#search_results").html(data); 
             } 
            }) 
          } 
</script>
    </head>
    <body id="bodyBase">
      <h4 style="color:#CCC;margin-left:10px; margin-top:5px">Centro de Liquidacion y Pagos</h4>
        <h3 align="right" style="margin-top:2%; margin-right:2%; color:#09C">Centro de Pagos - Recaudo de Pagos</h3>
        <div id='cssmenu'>
            <ul>
               <li class="active"><a href='#' title="Recaudos"><h6><p class="full-circle"></p><span>Recaudos</span></h6></a>
                    <ul style="margin-right:-42%">
                         <li><a href='asignacionpagoinicial.php' title="Pago Inicial de Servicios"><span>Pago Inicial de Servicios</span></a></li>
                         <li class='last' title="Recaudo de Servicios" class="active"><a href='RecaudodeServicios.html'><span>Recaudo de Servicios</span></a></li>
                         <li class='last' title="Recargue de Credenciales" class="active"><a href='ProcesoRecaudo.html'><span>Recargue de Credenciales</span></a></li>
                    </ul>
               </li>
               <li class=''><a href='#' title="Reportes"><h6><p class="full-circle"></p><span>Reportes</span></h6></a>
                  <ul style="margin-right:-42%">
                     <li><a href='CierresdeCaja.html' title="Cierres de Caja"><span>Cierres de Caja</span></a></li>
                     <li class='last'><a href='Generacionestadosdecuenta.html' title="Generacion estados de cuenta"><span>Generacion estados de cuenta</span></a></li>
                  </ul>
               </li>
               <li><a href='#' title="Mensajeria"><h6><p class="full-circle"></p><span>Mensajeria</span></h6></a>
                  <ul style="margin-right:-42%">
                     <li><a href='Cobrodeserviciosescolaresalosacudientes.html'><span>Cobro de servicios escolares a los acudientes</span></a></li>
                  </ul>
               </li>
            </ul>
        </div>
        
        <div class="contenidoBorde">
          <table style="padding-left:1%; padding-top:4.5%;padding-right:10px;position:absolute" cellspacing="0" cellpadding="0" width="100%">
            <thead>
              <tr>
                <td><label for="nidentificacion"><font color="#09C" size="2">No. Identificacion</font></label></td>
                 <td ><label for="nidentificacion"><font color="#09C" size="2">Primer Apellido</font></label></td>
                <td align="right"><input type="text" name="search_terms" id="search_terms"  readonly/> </td>
                 <td ><label for="nidentificacion"><font color="#09C" size="2">Segundo Apellido</font></label></td>
                <td align="right"><input type="text" name="search_terms" id="search_terms"  readonly/> </td>
                </tr>
              <tr>
                <td align="right"><input type="text" name="search_term" id="search_term" /></td>
                <td ><label for="nidentificacion"><font color="#09C" size="2">Primer Nombre</font></label></td>
                <td align="right"><input type="text" name="search_terms" id="search_terms"  readonly /> </td>
                <td ><label for="nidentificacion"><font color="#09C" size="2">Segundo Nombre</font></label></td>
                <td align="right"><input type="text" name="search_terms" id="search_terms"  readonly/> </td>
              </tr> 
              <tr>
                <td ><label for="nidentificacion"><font color="#09C" size="2">Busqueda</font></label></td>
                <td><select id="tipo" name="tipo">
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
              </tr> 
              <tr>
                <th width="200" bgcolor="#dedede"><center>Concepto</center></th>
                <th width="200" bgcolor="#dedede"><center>Valor</center></th>
                <th width="200" bgcolor="#dedede"><center>Estado Pago</center></th>
                <th width="200" bgcolor="#dedede"><center>Recibo de Pago</center></th>
                <th width="200" bgcolor="#dedede"><center></center></th>
              </tr>
            </thead>
            <tbody>
              <div id="search_results" style="position:absolute; padding-top:100px; padding-left:20px;width:90%;"></div> 

                    <tr valign="middle" height="220"></tr>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                    <tr>
                      <td colspan="8" height="2px">&nbsp;</td>
                    </tr>
                    <tr>
                        <td ><font color="#09C" size="1"><label for="r1">Otros Medios de Pago</label></font></td>
                        <td ><input type="radio" name="r1" id="r1"></td>

                        <td colspan="1" align="center"><button type="submit" style="width:120px; border-radius:6px; height:30px;background-color:#069;color:#FFF;" name="btnCrearUsuario" id="btnCrearUsuario">Pagar </button></td>
                        
                        
                        <td align="right"><label for="nombre2"><font color="#09C" size="1">Valor Pago Actual&nbsp;</font></label></td>
                        
                        <td><input id="valortotal" name="valortotal" type="text" required/></td>

                    </tr>
                    <tr>
                        <td><font color="#09C" size="1"><label for="r1">Pago con Credencial</label></font></td>
                        <td><input type="radio" name="r1" id="r1"></td>
                        <td colspan="1" align="center"></td>
                        
                        <td align="right"><label for="nombre2"><font color="#09C" size="1">Valor Total&nbsp;</font></label></td>
                        
                        <td><input id="valortotal" name="valortotal" type="text" required/></td>
                        
                    </tr>  
            </tbody>
            </table>
            
            <div id="popup" style="display: none;">
            <div class="content-popup">
            <div class="close"><a href="#" id="close"><img src="images/close.png"/></a></div>
            <div>
               <h2>Seleccione Medio de Pago</h2>
               <div class="row">
                <div class="col-md-4">
               <font color="#09C" size="1"><label for="r1">Pago en Efectivo</label></font>
               <input type="radio" name="r1" id="r1" value="1">
               <font color="#09C" size="1"><label for="r1">Tarjeta Debito</label></font>
               <input type="radio" name="r1" id="r1" value="2">
               <font color="#09C" size="1"><label for="r1">Tarjeta Credito</label></font>
               <input type="radio" name="r1" id="r1" value="3">
               </div>
               <div class="col-sm-11">
                <button type="submit" class="btn btn-primary pull-right" name="Crear" id="Crear">Crear </button>
               </div>
               </div>
            </div>
          </div>
        </div>

        <div id="popup1" style="display: none;">
            <div class="content-popup">
            <div class="close"><a href="#" id="close"><img src="images/close.png"/></a></div>
            <div>
               <h2>Seleccione Medio de Pago</h2>
               <font color="#09C" size="1"><label for="r1">Pago en Efectivo</label></font>
               <input type="radio" name="r1" id="r1" >
               <font color="#09C" size="1"><label for="r2">Pago en Efectivo</label></font>
               <input type="radio" name="r2" id="r2">
               <font color="#09C" size="1"><label for="r3">Pago en Efectivo</label></font>
               <input type="radio" name="r3" id="r3">
            </div>
          </div>
        </div>
             
            
        </div>
        <script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>     
    </body>
</html>