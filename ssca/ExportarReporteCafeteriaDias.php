<?php

require_once 'PHPExcel/Classes/PHPExcel.php';
  require_once 'Data/ConexionBD.php';
    // connecting to db
require_once 'db_connect1.php';
  // connecting to db
  $db = new DB_CONNECT();  
  $array = array(array());
  $contadorFilas = 0;
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
               ->setLastModifiedBy("Maarten Balliauw")
               ->setTitle("Office 2007 XLSX Test Document")
               ->setSubject("Office 2007 XLSX Test Document")
               ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");
// Add some data
/*$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');
// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');*/
$fechai = $_REQUEST["fechai"];
$fechaf = $_REQUEST["fechaf"];

  //conexion
    $conexion=mysql_connect("localhost", "root", "usc");
    mysql_select_db("ssca", $conexion);
    
    //realizo consulta de productos
    $consulta5="SELECT movimientos.*
    FROM  `movimientos` 
    WHERE movimientos.FechaMovimiento
    BETWEEN  '$fechai' AND  '$fechaf'
    AND movimientos.`DescripcionMovimiento` LIKE '%No. Pedido %' ";
      $consulta5=mysql_query($consulta5, $conexion);

      //cantidad de datos
      $numero = mysql_num_rows($consulta5);
      while($row = mysql_fetch_array($consulta5, MYSQL_ASSOC)){
        $DescripcionMovimiento = $row["DescripcionMovimiento"];
        $pedido = explode("No. Pedido ", $DescripcionMovimiento);
        $productos = $pedido[1]; // porción1

        $detalleProducto = explode(":", $productos);              
        $codigoPedido = $detalleProducto[0];
        
        $consulta6="SELECT * FROM `Detalle_OrdenPedido` WHERE `idOrdenPedido`=$codigoPedido";
        $consulta6=mysql_query($consulta6, $conexion) or die(mysql_error());
        
        while($rowPedido = mysql_fetch_array($consulta6, MYSQL_ASSOC)){
          //Consultar los datos del producto
          $consulta7="SELECT productos.*, categoria.Nombre AS NombreCategoria, `sub-categoria`.Nombre AS NombreSubCategoria FROM `productos` INNER JOIN categoria ON categoria.codigo = productos.Categoria INNER JOIN `sub-categoria` ON `sub-categoria`.codigo = productos.Subcategoria WHERE productos.`codigoProducto`='" . $rowPedido["codigoProducto"] . "'";
          $consulta7=mysql_query($consulta7, $conexion);
          $rowProducto = mysql_fetch_array($consulta7, MYSQL_ASSOC);

          $fila = existeProducto($array, $rowProducto["codigoProducto"]);
          if($fila != -1){
            $cantidadActual = $array[$fila][0] + $rowPedido["cantidad"];
            $subtotalActual = $array[$fila][5] + $rowPedido["total"];

            $array[$fila][0] = $cantidadActual;
            $array[$fila][5] = $subtotalActual;
          }else{
            $array[$contadorFilas][0] = $rowPedido["cantidad"];
            $array[$contadorFilas][1] = $rowProducto["NombreProducto"];
            $array[$contadorFilas][2] = $rowProducto["codigoProducto"];
            $array[$contadorFilas][3] = $rowProducto["NombreCategoria"];
            $array[$contadorFilas][4] = $rowProducto["NombreSubCategoria"];
            $array[$contadorFilas][5] = $rowPedido["total"];

            $contadorFilas++;
          }
          
         
          
        }


        
        
      }
      function cmp($a, $b)
      {
          return strcmp(strtolower($a[1]), strtolower($b[1]));
      }

      usort($array, "cmp");
      function existeProducto($array, $codigo){
        $resultado = -1;
        for($i=0;$i<count($array);$i++) {
          if(count($array[$i]) > 0){
            if($array[$i][2] == $codigo){
              $resultado = $i;
              //echo json_encode($array[$i]);
            } 

          }
          
          
        }
        return $resultado;
      }
    
  $con = 2;    
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "CANTIDAD");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', "CATEGORIA");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "SUBCATEGORIA");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "DETALLE");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "SUBTOTAL");

  for($i=0;$i<count($array);$i++) {
    
    if($array[$i][1] != ""){
      $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$con, $array[$i][0]);

      $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('B'.$con, $array[$i][3]);

      $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C'.$con, $array[$i][4]);

      $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('D'.$con, $array[$i][1]);

      $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('E'.$con, $array[$i][5]);
      
      $con++;            
    }
  }

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Cafeteria');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel5)
$nombreArchivo = "Reporte_Cafeteria" . date("Y") . date("m") . date("d") . date("H") . date("i") . date("s") . date("u") . ".xls";
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;


?>