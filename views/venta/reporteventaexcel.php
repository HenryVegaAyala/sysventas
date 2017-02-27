<?php

use yii\db\Query;

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
    ->setCellValue('Z1', 'Convertidor 2')
    ->setCellValue('AA1', 'Regalos')
    ->setCellValue('AB1', 'Observaciones')
    ->setCellValue('AC1', 'Tipo de Pago')
    ->setCellValue('AD1', 'Estado de Pago')
    ->setCellValue('AE1', 'Monto')
    ->setCellValue('AF1', 'Monto Ingresado')
    ->setCellValue('AG1', 'Monto Restante')
    ->setCellValue('AH1', 'Digitador')
    ->setCellValue('AI1', 'OPC')
    ->setCellValue('AJ1', 'Tienda')
    ->setCellValue('AM1', 'Supervisor Promotor')
    ->setCellValue('AN1', 'Supervior General OPC')
    ->setCellValue('AO1', 'Director de Mercadero')
    ->setCellValue('AP1', 'TLMK')
    ->setCellValue('AK1', 'Supervisor de TLMK')
    ->setCellValue('AR1', 'Confirmadora')
    ->setCellValue('AS1', 'Director de TLMK')
    ->setCellValue('AT1', 'Liner')
    ->setCellValue('AU1', 'Closer')
    ->setCellValue('AV1', 'Closer 2')
    ->setCellValue('AW1', 'Jefe de Sala')
    ->setCellValue('AX1', 'Director de Ventas')
    ->setCellValue('AY1', 'Director de Proyectos')
    ->setCellValue('AZ1', 'Generencia General')
    ->setCellValue('BA1', 'Benficiario');

$connection = \Yii::$app->db;
$sqlStatement = '
        SELECT DISTINCT
          numero_contrato    AS NUMEROCONTRATO,
          serie_comprobante  AS SERIE,
          numero_comprobante AS COMPROBANTE,
          c.Nombre           AS NOMBRE,
          c.Apellido         AS APELLIDO,
          CASE
          c.Estado_Civil
          WHEN 0
            THEN "S"
          WHEN 1
            THEN "C"
          WHEN 2
            THEN "CO"
          WHEN 3
            THEN "D"
          WHEN 4
            THEN "V"
          END                AS Estado_Civil,
          c.Profesion        AS PROFESION,
          c.DNI              AS DNI,
          c.Edad             AS EDAD,
          c.Telefono_Celular AS TELEFONOCELULAR,
          c.Email            AS EMAIL,
          cl.Nombre          AS NOMBRECLUB,
          p.Nombre           AS NOMBREPASPORTE,
          v.numero_pasaporte AS NUMEROPASAPORTE,
          CASE
          cl.Vigencia
          WHEN 1
            THEN "10"
          WHEN 2
            THEN "20"
          WHEN 3
            THEN "30"
          END                AS VigenciaDias,
          co.convetidor1     AS CONVER1,
          co.convetidor2     AS CONVER2,
          co.Regalos         AS REGALOS,
          co.Observacion     AS OBSER,
          CASE
          pa.tipo_pago
          WHEN 0
            THEN "Tarjeta de Credito"
          WHEN 1
            THEN "Tarjeta de Debito"
          WHEN 2
            THEN "Plazo"
          WHEN 3
            THEN "Letras"
          WHEN 4
            THEN "Cash"
          END                AS tipo_pago,
          pa.monto_pagado    AS MONTO,
          pa.monto_ingresado AS INGRESA,
          pa.monto_restante  AS RESTANTE,
          CASE
          pa.estado_pago
          WHEN 0
            THEN "Adelanto"
          WHEN 1
            THEN "Pendiente"
          WHEN 2
            THEN "Cancelado"
          END                AS estado_pago
        FROM venta v
          INNER JOIN cliente c ON v.Codigo_Cliente = c.Codigo_Cliente
          INNER JOIN club cl ON v.Codigo_club = cl.Codigo_club
          INNER JOIN pasaporte p ON v.Codigo_pasaporte = v.Codigo_pasaporte
          INNER JOIN combo co ON v.Codigo_venta = co.Codigo_venta
          INNER JOIN pago pa ON v.Codigo_venta = pa.Codigo_venta
          INNER JOIN comision com ON v.Codigo_venta = com.Codigo_venta
            ';
$comando = $connection->createCommand($sqlStatement);
$resultado = $comando->query();

$i = 2;
while ($row = $resultado->read()) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$i,$row['RazonSocial'])
        ->setCellValue('B'.$i,$row['NUMEROCONTRATO'])
        ->setCellValue('C'.$i,$row['SERIE'])
        ->setCellValue('D'.$i,$row['COMPROBANTE'])
        ->setCellValue('E'.$i,$row['NOMBRE'])
        ->setCellValue('F'.$i,$row['APELLIDO'])
        ->setCellValue('G'.$i,$row['DNI'])
        ->setCellValue('H'.$i,$row['Edad'])
        ->setCellValue('I'.$i,$row['Direccion'])
        ->setCellValue('J'.$i,$row['Distrito'])
        ->setCellValue('K'.$i,$row['Traslado'])
        ->setCellValue('L'.$i,$row['Tarjeta_De_Credito'])
        ->setCellValue('M'.$i,$row['Estado_Civil'])
        ->setCellValue('N'.$i,$row['Profesion'])
        ->setCellValue('O'.$i,$row['Telefono_Casa'])
        ->setCellValue('P'.$i,$row['Telefono_Casa2'])
        ->setCellValue('Q'.$i,$row['Telefono_Celular'])
        ->setCellValue('R'.$i,$row['Telefono_Celular2'])
        ->setCellValue('S'.$i,$row['Telefono_Celular3'])
        ->setCellValue('T'.$i,$row['Email'])
        ->setCellValue('U'.$i,$row['CLN'])
        ->setCellValue('V'.$i,$row['NCP'])
        ->setCellValue('CLN'.$i,$row['Distrito'])
        ->setCellValue('W'.$i,$row['CP'])
        ->setCellValue('Y1'.$i,$row['CONVER1'])
        ->setCellValue('Z1'.$i,$row['CONVER2'])
        ->setCellValue('AA1'.$i,$row['REGALOS'])
        ->setCellValue('AB1'.$i,$row['OBSER'])
        ->setCellValue('AC1'.$i,$row['tipo_pago'])
        ->setCellValue('AD1'.$i,$row['MONTO'])
        ->setCellValue('AE1'.$i,$row['INGRESA'])
        ->setCellValue('AG1'.$i,$row['RESTANTE'])
        ->setCellValue('AD1'.$i,$row['estado_pago'])
        ->setCellValue('BA1'.$i,$row['Beneficiario'])


    ;
    $i++;
}


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
