<?php
error_reporting(0);
include("connect.php");
?>
<?php 
    require_once 'db_connect1.php';
    // connecting to db
    $db = new DB_CONNECT(); 

     $result = mysql_query("SELECT * FROM asignacion_servicios where  numero_identificacion='".$_POST["search_term"]."'");          
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

          #popup1 {
              left: 0;
              position: absolute;
              top: 0;
              width: 100%;
              z-index: 1001;
          }

          .content-popup1 {
              margin:0px auto;
              margin-top:120px;
              position:relative;
              padding:10px;
              width:500px;
              height:358px;
              min-height:250px;
              border-radius:4px;
              background-color:#FFFFFF;
              box-shadow: 0 2px 5px #666666;
          }

          .content-popup1 h2 {
              color:#48484B;
              border-bottom: 1px solid #48484B;
              margin-top: 0;
              padding-bottom: 4px;
          }

          .popup-overlay1 {
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

          .close1 {
              position: absolute;
              right: 15px;
          }


           #popup2 {
              left: 0;
              position: absolute;
              top: 0;
              width: 100%;
              z-index: 1001;
          }

          .content-popup2 {
              margin:0px auto;
              margin-top:70px;
              position:relative;
              padding:10px;
              width:500px;
               height:400px;
              min-height:250px;
              border-radius:4px;
              background-color:#FFFFFF;
              box-shadow: 0 2px 5px #666666;
          }

          .content-popup2 h2 {
              color:#48484B;
              border-bottom: 1px solid #48484B;
              margin-top: 0;
              padding-bottom: 4px;
          }

          .popup-overlay2 {
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

          .close2 {
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

        <script type="text/javascript">
          $(document).ready(function(){
            $('#Crearp').click(function(){
                  $('#popup1').fadeIn('slow');
                  $('.popup-overlay1').fadeIn('slow');
                  $('.popup-overlay1').height($(window).height());
                  return false;
              });
              
              $('#close1').click(function(){
                  $('#popup1').fadeOut('slow');
                  $('.popup-overlay1').fadeOut('slow');
                  return false;
              });
          });
          </script>

          <script type="text/javascript">
          $(document).ready(function(){
            $('#rc').click(function(){
                  $('#popup2').fadeIn('slow');
                  $('.popup-overlay2').fadeIn('slow');
                  $('.popup-overlay2').height($(window).height());
                  return false;
              });
              
              $('#close2').click(function(){
                  $('#popup2').fadeOut('slow');
                  $('.popup-overlay2').fadeOut('slow');
                  return false;
              });
          });
        </script>

        <script language="javascript">
        function Suma(isChecked, myValue)
        {
          tot = parseInt(document.form1.valortotalactual.value);
          myValue = parseInt(myValue);
          if (isChecked) document.form1.valortotalactual.value = tot + myValue;
          else document.form1.valortotalactual.value = tot - myValue;
        
          tot = parseInt(document.form2.valorapagar.value);
          myValue = parseInt(myValue);
          if (isChecked) document.form2.valorapagar.value = tot + myValue;
          else document.form2.valorapagar.value = tot - myValue;

          tot = parseInt(document.form3.valorapagar1.value);
          myValue = parseInt(myValue);
          if (isChecked) document.form3.valorapagar1.value = tot + myValue;
          else document.form3.valorapagar1.value = tot - myValue;

          var numero1 = parseFloat(document.form2.valortotaladeudado.value);
          var numero2 = parseFloat(document.form2.valorapagar.value);
          var Resultado = numero1 - numero2;
          document.form2.saldo.value= Resultado;

          var numero3 = parseFloat(document.form3.valortotaladeudado1.value);
          var numero4 = parseFloat(document.form3.valorapagar1.value);
          var Resultado = numero3 - numero4;
          document.form3.saldo1.value= Resultado;
        }
        </script>

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
                  ajax_search1(); 
                  ajax_search2();
                  ajax_search3();
              }); 
          });
          function ajax_search(){ 
            $("#apellido1").show(); 
            var search_val=$("#search_term").val(); 
            $.post("./find2.php", {search_term : search_val}, function(data){
             if (data.length>0){ 
               $("#apellido1").val(data); 
             } 
            }) 
          } 
          function ajax_search1(){ 
            $("#apellido2").show(); 
            var search_val=$("#search_term").val(); 
            $.post("./find3.php", {search_term : search_val}, function(data){
             if (data.length>0){ 
               $("#apellido2").val(data); 
             } 
            }) 
          } 
          function ajax_search2(){ 
            $("#nombre1").show(); 
            var search_val=$("#search_term").val(); 
            $.post("./find4.php", {search_term : search_val}, function(data){
             if (data.length>0){ 
               $("#nombre1").val(data); 
             } 
            }) 
          } 
          function ajax_search3(){ 
            $("#nombre2").show(); 
            var search_val=$("#search_term").val(); 
            $.post("./find5.php", {search_term : search_val}, function(data){
             if (data.length>0){ 
               $("#nombre2").val(data); 
             } 
            }) 
          } 
        </script>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
      
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
                <td align="right"><input type="text" name="apellido1" id="apellido1"  readonly/> </td>
                 <td ><label for="nidentificacion"><font color="#09C" size="2">Segundo Apellido</font></label></td>
                <td align="right"><input type="text" name="apellido2" id="apellido2"  readonly/> </td>
                </tr>
              <tr>
                <form action="centpagos.php" method="post">
                <td align="right"><input type="text" name="search_term" id="search_term" /></td>


                <td ><label for="nidentificacion"><font color="#09C" size="2">Primer Nombre</font></label></td>
                <td align="right"><input type="text" name="nombre1" id="nombre1"  readonly /> </td>
                <td ><label for="nidentificacion"><font color="#09C" size="2">Segundo Nombre</font></label></td>
                <td align="right"><input type="text" name="nombre2" id="nombre2"  readonly/> </td>
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
                         <td><button type="submit" value="Submit">Busqueda</button></td>
                         </form>
              </tr>
              <tr>
                <th width="200" bgcolor="#dedede"><center>Concepto</center></th>
                <th width="200" bgcolor="#dedede"><center>Valor</center></th>
                <th width="200" bgcolor="#dedede"><center>Estado Pago</center></th>
                <th width="200" bgcolor="#dedede"><center></center></th>
                <th width="200" bgcolor="#dedede"><center>Recibo de Pago</center></th>
                <th width="200" bgcolor="#dedede"><center></center></th>
              </tr>
            </thead>
            <tbody>
              <div id="search_results" style="position:absolute; padding-top:100px; padding-left:20px;width:90%;"></div> 

                    <?php
                      while($row = mysql_fetch_assoc($result))

                     {
                          echo "<tr><td><center>".$row["tipo_servicio"]."</center></td>";
                          echo "<td><center>".$row["valor"]."</center></td>";
                          echo "<td><center>".$row["estado"]."</center></td>";

                          $estado = $row["estado"];
                          $checked = "";
                          $status = ($estado);
                          if ($status == "sin pago" )  
                          {
                            $status = 1;
                            $checked = 'checked="checked"';
                            //
                            $array[] = $row["idasignacion"];
                            $var = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($array), ENT_NOQUOTES));
                            //
                            $array2[] = $row["valor"];
                            $var2 = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($array2), ENT_NOQUOTES));

                            echo '<td><center><input type="checkbox" name="status"   value="'.$row["valor"].'" onClick="Suma(this.checked,this.value)" /></center></td>';
                          }
                          else
                          {
                            $status = 0;
                          }
                          
                          
                          echo "<td><center>".$row["recibo_pago"]."</center></td>";
                          echo "<td><center>".$row["num_recibo"]."</center></td></tr>";



                    }
                    $_SESSION['idasignacion']= json_encode($var);
                    $_SESSION['valorpago']= json_encode($var2);
                    ?>


                    <tr valign="middle" height="100"></tr>
                     
                    
                    <tr>
                        <td ><font color="#09C" size="1"><label for="r1">Otros Medios de Pago</label></font></td>
                        <td ><input type="radio" name="r1" id="r1"></td>

                        <td colspan="1" align="center"><button type="submit" style="width:120px; border-radius:6px; height:30px;background-color:#069;color:#FFF;" name="btnCrearUsuario" id="btnCrearUsuario">Pagar </button></td>
                        
                        <form name="form1" method="post" action="">
                        <td align="right"><label for="nombre2"><font color="#09C" size="1">Valor Pago Actual&nbsp;</font></label></td>
                        
                        <td><input id="valortotalactual" name="valortotalactual" type="text" value="0"  required></input></td>
                        </form>

                    </tr>
                    <tr>
                        <td><font color="#09C" size="1"><label for="r1">Pago con Credencial</label></font></td>
                        <td><input type="radio" name="rc" id="rc"></td>
                        <td colspan="1" align="center"></td>
                        <?php 
                        $result1 = mysql_query("SELECT sum(valor) as total FROM asignacion_servicios where  numero_identificacion='".$_POST["search_term"]."' and  estado='sin pago'"); 

                         while($row = mysql_fetch_assoc($result1))

                     {
                         
                          $total = $row["total"];

                    }

                        ?>
                        <td align="right"><label for="nombre2"><font color="#09C" size="1">Valor Total&nbsp;</font></label></td>
                        
                        <td><input id="valortotal" name="valortotal" type="text" value="<?php echo $total; ?>" required  readonly/></td>
                        
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
               <font color="#09C" size="1"><label for="r2">Pago en Efectivo</label></font>
               <input type="radio" name="r2" id="r2" value="1">
               <font color="#09C" size="1"><label for="r3">Tarjeta Debito</label></font>
               <input type="radio" name="r2" id="r2" value="2">
               <font color="#09C" size="1"><label for="r4">Tarjeta Credito</label></font>
               <input type="radio" name="r2" id="r2" value="3">
               </div>
               <div class="col-sm-11">
                <button type="submit" class="btn btn-primary pull-right" name="Crearp" id="Crearp">Crear </button>
               </div>
               </div>
            </div>
          </div>
        </div>

        <div id="popup1" style="display: none;">
            <div class="content-popup1">
            <div class="close"><a href="#" id="close1"><img src="images/close.png"/></a></div>
            <div>
               <h2>Recaudo de pagos - Efectivo</h2>
               <form name="form2" method="post" action="">
               <font color="#09C" size="1"><label for="r1">Valor total adeudado</label></font>
               <input type="text" name="valortotaladeudado" id="valortotaladeudado" value="<?php echo $total; ?>" readonly />
               <font color="#09C" size="1"><label for="r1">Valor a pagar</label></font>
               <input type="text" name="valorapagar" id="valorapagar" value="0" readonly  />
               <font color="#09C" size="1"><label for="r1">Saldo</label></font>
               <input type="text" name="saldo" id="saldo" readonly  />
               <font color="#09C" size="1"><label for="r1">Observaciones</label></font>
               </br>
               <textarea id="observaciones" name="observaciones" rows="4" cols="50"> </textarea>
               <h2></h2>
               <button type="submit" class="btn btn-primary pull-right" name="Crea" id="Crearp">Aplicar Pago</button>
               </form>
            </div>
          </div>
        </div>


        <div id="popup2" style="display: none;">
            <div class="content-popup2">
            <div class="close"><a href="#" id="close2"><img src="images/close.png"/></a></div>
            <div>
               <h2>Recaudo de pagos - Credencial</h2>
               <?php  
                  $result2 = mysql_query("SELECT * FROM usuarios where NumeroId='".$_POST["search_term"]."'");
                   while($row = mysql_fetch_assoc($result2))
                     {
                      $correo = $row["idUsuario"];
                      $result3 = mysql_query("SELECT * FROM credenciales where idUsuarioSecundario='".$correo."'");
                      while($row = mysql_fetch_assoc($result3))
                       {
                          $saldoc = $row["SaldoCredencial"];
                       }
                    }
               ?>
               <font color="#09C" size="1"><label for="r1">Saldo de Credencial</label></font>
               <input type="text" name="saldocredencial" id="saldocredencial" value="<?php echo $saldoc; ?>"  readonly />
               <form name="form3" method="post" action="">
               <font color="#09C" size="1"><label for="r1">Valor total adeudado</label></font>
               <input type="text" name="valortotaladeudado1" id="valortotaladeudado1" value="<?php echo $total; ?>" readonly />
               <font color="#09C" size="1"><label for="r1">Valor a pagar</label></font>
               <input type="text" name="valorapagar1" id="valorapagar1" value="0" readonly  />
               <font color="#09C" size="1"><label for="r1">Saldo</label></font>
               <input type="text" name="saldo1" id="saldo1" readonly  />
               <font color="#09C" size="1"><label for="r1">Observaciones</label></font>
               </br>
               <textarea id="observaciones" name="observaciones" rows="4" cols="50"> </textarea>
               <h2></h2>
               <button type="submit" class="btn btn-primary pull-right" name="Crea" id="Crearp">Aplicar Pago</button>
               </form>
            </div>
          </div>
        </div>
            
            
            
        </div>
        <script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>     
    </body>
</html>