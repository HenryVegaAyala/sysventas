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
    ->setCellValue('A1', 'Razon Social')
    ->setCellValue('B1', 'N° de Contrato')
    ->setCellValue('C1', 'N° de Serie')
    ->setCellValue('D1', 'N° de Comprobante')
    ->setCellValue('E1', 'Nombres')
    ->setCellValue('F1', 'Apellidos')
    ->setCellValue('G1', 'DNI')
    ->setCellValue('H1', 'Edad')
    ->setCellValue('I1', 'Dirección')
    ->setCellValue('J1', 'Distrito')
    ->setCellValue('K1', 'Traslado')
    ->setCellValue('L1', 'Tipo de tarjeta')
    ->setCellValue('M1', 'Estado Civil')
    ->setCellValue('N1', 'Profesión')
    ->setCellValue('O1', 'Telefonó Casa 1')
    ->setCellValue('P1', 'Telefonó Casa 2')
    ->setCellValue('Q1', 'Telefonó Celular 1')
    ->setCellValue('R1', 'Telefonó Celular 2')
    ->setCellValue('S1', 'Telefonó Celular 3')
    ->setCellValue('T1', 'Email')
    ->setCellValue('U1', 'Tipo de Club')
    ->setCellValue('V1', 'Tipo de Pasaporte')
    ->setCellValue('W1', 'Codigó de Pasaporte')
    ->setCellValue('X1', 'Codiǵo de Certificado')
    ->setCellValue('Y1', 'Convertidor 1')
    ->setCellValue('AA1', 'Regalos')
    ->setCellValue('AB1', 'Observaciones')
    ->setCellValue('AC1', 'Tipo de Pago')
    ->setCellValue('AD1', 'Estado de Pago')
    ->setCellValue('AE1', 'Monto')
    ->setCellValue('AF1', 'Monto Ingresado')
    ->setCellValue('AG1', 'Monto Restante');

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
