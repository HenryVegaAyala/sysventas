<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Hello')
    ->setCellValue('B1', 'world!')
    ->setCellValue('C1', 'Hello')
    ->setCellValue('D1', 'world!')
    ->setCellValue('E1', 'world!')
    ->setCellValue('F1', 'world!')
    ->setCellValue('G1', 'world!')
    ->setCellValue('H1', 'world!')
    ->setCellValue('I1', 'world!')
    ->setCellValue('J1', 'world!')
    ->setCellValue('K1', 'world!')
    ->setCellValue('L1', 'world!')
    ->setCellValue('M1', 'world!')
    ->setCellValue('N1', 'world!')
    ->setCellValue('O1', 'world!')
    ->setCellValue('P1', 'world!')
    ->setCellValue('Q1', 'world!')
    ->setCellValue('R1', 'world!')
    ->setCellValue('S1', 'world!');

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A2', '')
    ->setCellValue('B2', '!')
    ->setCellValue('C2', '')
    ->setCellValue('D2', '!');

$objPHPExcel->getActiveSheet()->setTitle('Reporte Venta');

$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=" ReporteVenta.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
