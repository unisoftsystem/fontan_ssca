<?php
 /**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt  LGPL
 * @version    ##VERSION##, ##DATE##
 */
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');
if (PHP_SAPI == 'cli')
  die('This example should only be run from a Web Browser');
/** Include PHPExcel */
require_once 'PHPExcel/Classes/PHPExcel.php';
require_once 'Data/ConexionBD.php';
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
$usuario = $_REQUEST["usuario"];
$fechaInicial = $_REQUEST["fechaInicial"];
$fechaFinal = $_REQUEST["fechaFinal"];
$conexionBD = new ConexionBD();
$conexion = $conexionBD->conectar();
 $sql = "Select movimientos.*, us.* From movimientos  INNER JOIN credenciales c ON c.idCredencial = movimientos.idCredencial INNER JOIN usuarios us ON us.idUsuario = c.idUsuarioSecundario WHERE (movimientos.`FechaMovimiento` BETWEEN '$fechaInicial' AND '$fechaFinal') AND movimientos.`idCredencial`='$usuario' AND (movimientos.DescripcionMovimiento<>'costo de asignación de tarjeta nueva' AND NOT movimientos.DescripcionMovimiento LIKE '%No de pedido%' AND movimientos.DescripcionMovimiento<>'cambio de credencial')";
 $resultado = mysqli_query($conexion, $sql);
 $registros = mysqli_num_rows ($resultado);

  $i = 4;    
  
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', "FECHA");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "HORA");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', "DESCRIPCION");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', "VALOR");
  while ($registro = mysqli_fetch_array($resultado, MYSQL_ASSOC)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', $registro["PrimerNombre"] . " " . $registro["SegundoNombre"] . " " . $registro["PrimerApellido"] . " " . $registro["SegundoApellido"]);
    

    $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('B'.$i, $registro["FechaMovimiento"]);

    $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('C'.$i, $registro["HoraMovimiento"]);

    $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('D'.$i, $registro["DescripcionMovimiento"]);

    $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('E'.$i, $registro["ValorMovimiento"]);          

    $i++;

  }
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Movimientos');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel5)
$nombreArchivo = "Reporte_Movimientos" . date("Y") . date("m") . date("d") . date("H") . date("i") . date("s") . date("u") . ".xls";
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