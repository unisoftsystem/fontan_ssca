<?php 
/* incluimos primeramente el archivo que contiene la clase fpdf */
include ('fpdf/fpdf.php');
require "conversor.php"; 
$fecha_actual=date("d/m/Y");
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SSCA</title>
        <link href="css/styler.css" rel="stylesheet"/>
        <link href="css/menu.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/style.js"></script>  
        <link rel="stylesheet" media="screen" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
        <script src="js/script.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    </head>
    <body id="bodyBase" >
    <?php
         $valor = $_REQUEST["idcuenta"];
         $valor1 = $_REQUEST["fechageneracion"];
         $valor2 = $_REQUEST["valortotal"];
         $valor3 = $_REQUEST["area"];
         $valor4 = $_REQUEST["tercero"];
         $valor5 = $_REQUEST["fpago"]; 
         require_once 'db_connect1.php';
            // connecting to db
            $db = new DB_CONNECT();
            // mysql inserting a new row
            $result = mysql_query("INSERT INTO pago_cuenta_cobro(cuenta_cobro,fecha_envio,valor_total,area,tercero,fecha_cancelacion) VALUES('".$valor."', '".$valor1."', '".$valor2."', '".$valor3."' , '".$valor4."', '".$valor5."')");
            // check if row inserted or not
            if ($result) {
                // successfully inserted into database
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "<div class=\"col-md-2 col-md-offset-5\">";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "Insersion Exitosa de Pago Cuenta Cobro";
                echo "</div>";
                echo "</div>";
            } else {
                // failed to insert row
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "</br>";
                echo "<div class=\"col-md-2 col-md-offset-5\">";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "Insersion Fallida de Pago Cuenta Cobro";
                echo $result;
                echo "</div>";
                echo "</div>";
            }
             $result3 = mysql_query("SELECT idpagocuentacobro FROM pago_cuenta_cobro where cuenta_cobro='".$valor."'");    
             if ($row = mysql_fetch_assoc($result3)) {
              $idpagocuentacobro = $row['idpagocuentacobro'];
              }
            $result1 = mysql_query("UPDATE cuenta_cobro SET fecha_cancelacion = '".$valor5."', numero_recibo = '".$idpagocuentacobro."' WHERE idcuenta = '".$valor."'");
            // check if row inserted or not
            if ($result1) {
                // successfully inserted into database   
            } else {
                // failed to insert row   
            }
    ?>
    <?php 
    /* seleccion de datos de tercero para asignacion a pdf */
     $result4 = mysql_query("SELECT  nombre, apellido, area, documento, descuento1, descuento2, descuento3, descuento4, nit, empresa, telefono FROM tercero where nombre='".$valor4."'");    
     if ($row = mysql_fetch_assoc($result4)) {
      $nombre = $row['nombre'];
      $apellido = $row['apellido'];
      $area = $row['area'];
      $documento = $row['documento'];
      $descuento1 = $row['descuento1'];
      $descuento2 = $row['descuento2'];
      $descuento3 = $row['descuento3'];
      $descuento4 = $row['descuento4'];
      $telefono = $row['telefono'];
      $nit = $row['nit'];
      $empresa = $row['empresa'];
      }
  ?>
  <?php 
    /* seleccion de datos de tercero para asignacion a pdf */
     $result5 = mysql_query("SELECT  valor_cuenta,observaciones FROM cuenta_cobro where idcuenta='".$valor."'");    
     if ($row = mysql_fetch_assoc($result5)) {
      $valorcuenta = $row['valor_cuenta'];
      $obs = $row['observaciones'];
      }

    //conversor de numero a letras se usa conversor.php 
     $numero = $_REQUEST["valortotal"];
    if ($numero)
	 {
	 	$resultado = convertir($numero);
		
	 }
  ?>
    <?php
            $GLOBALS['nombre'] = $nombre;
            $GLOBALS['apellido'] = $apellido;
            $GLOBALS['documento'] = $documento;
            $GLOBALS['telefono'] = $telefono;
            $GLOBALS['valor'] = $valor;
            $GLOBALS['valorcuenta'] = $valorcuenta;
            $GLOBALS['descuento1'] = $descuento1;
            $GLOBALS['descuento2'] = $descuento2;
            $GLOBALS['valor2'] = $valor2;
            $GLOBALS['fechaactual'] = $fecha_actual;
            $GLOBALS['nit'] = $nit;
            $GLOBALS['empresa'] = $empresa;
            $GLOBALS['area'] = $area;
            $GLOBALS['obs'] = $obs;
            $GLOBALS['resultadoletras'] = $resultado;
        /* tenemos que generar una instancia de la clase */
            $pdf = new FPDF();
            $pdf->AddPage();
        /* seleccionamos el tipo, estilo y tamaño de la letra a utilizar */
            $pdf->Image('menu.png',0,0,210,300);
            $pdf->SetFont('Helvetica', 'B', 14);
            $pdf->Ln(12);
            $pdf->Ln();
            $pdf->Write (7,"                                     COMPROBANTE DE PAGO No  ".$idpagocuentacobro);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Write (7,"FECHA DE PAGO: ".$GLOBALS['fechaactual']);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Write (7,"PAGADO A : ".$GLOBALS['empresa']);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Write (7,"NIT : ".$GLOBALS['nit']);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Write (7,"AREA : ".$GLOBALS['area']);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Write (7,"REPRESENTANTE: ".$GLOBALS['nombre'].' '.$GLOBALS['apellido']);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln(); //salto de linea
            
            $pdf->Ln(); //salto de linea
            $pdf->Ln(); //salto de linea
            $pdf->Ln(); //salto de linea
            $pdf->Write (7,"CUENTA COBRO No ".$GLOBALS['valor']);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Write (7,"DESCUENTO CONVENIO COLEGIO: ".$GLOBALS['descuento1'].'%');
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Write (7,"COBROS TRANSACCIONALES: ".$GLOBALS['descuento2'].'%');
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Write (7,"VALOR CANCELADO $ ".$GLOBALS['valor2']);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Write (7,"VALOR EN LETRAS:  ".$GLOBALS['resultadoletras']);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Write (7,"OBSERVACIONES: ".$GLOBALS['obs']);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Write (7,"   ___________________________             __________________________");
            $pdf->Ln();
            $pdf->Write (7,"          FIRMA REPRESENTANTE                          FIRMA PAGADOR            ");
            //$pdf->Cell(60,7,$_POST['direccion'],1,0,'C');
            $pdf->Ln(15);//ahora salta 15 lineas 
            //$pdf->SetTextColor('255','0','0');//para imprimir en rojo 
            //$pdf->Multicell(190,7,$_POST['tel']."\n esta es la prueba del multicell",1,'R');
            //$pdf->Line(0,160,300,160);//impresión de linea
            $pdf->Output("pdfgenerados/$idpagocuentacobro.pdf",'F');
            echo "<script language='javascript'>window.open('pdfgenerados/$idpagocuentacobro.pdf','_self','');</script>";//para ver el archivo pdf generado
            exit;
    ?>
        <script src="js/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>    
    </body>
</html>