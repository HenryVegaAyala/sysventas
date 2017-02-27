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
    /* CLIENTE */
    ->setCellValue('A1', 'ITEM')
    ->setCellValue('B1', 'NOMBRE')
    ->setCellValue('C1', 'APELLIDO')
    ->setCellValue('D1', 'PROFESION')
    ->setCellValue('E1', 'EDAD')
    ->setCellValue('F1', 'ESTADO CIVIL')
    ->setCellValue('G1', 'DISTRITO')
    ->setCellValue('H1', 'DIRECCIÓN')
    ->setCellValue('I1', 'TELEFONO CASA')
    ->setCellValue('J1', 'TELEFONO CELULAR')
    ->setCellValue('K1', 'TELEFONO CASA 2')
    ->setCellValue('L1', 'TELEFONO CASA CELULAR 2')
    ->setCellValue('M1', 'TELEFONO CASA CELULAR 3')
    ->setCellValue('N1', 'EMAIL')
    ->setCellValue('O1', 'TRASLADO')
    ->setCellValue('P1', 'TIPO DE TARJETA')
    ->setCellValue('Q1', 'DNI')
    /*Producto Contratado*/
    ->setCellValue('R1', 'TIPO PASAPORTE')
    ->setCellValue('S1', 'C. DE PASAPORTE ')
    ->setCellValue('T1', 'CANT. DE NOCHES')
    ->setCellValue('U1', 'N° NOCHES')
    /*DATOS BENEFICIAROS*/
    ->setCellValue('V1', 'NOMBRE')
    ->setCellValue('W1', 'APELLIDO')
    ->setCellValue('X1', 'DNI')
    /*INCENTIVOS*/
    ->setCellValue('Y1', 'CONVERTIDOR 1')
    ->setCellValue('Z1', 'CONVERTIDOR 2')
    ->setCellValue('AA1', 'REGALOS')
    ->setCellValue('AB1', 'OBSERVACIONES')
    /*FORMAS DE PAGO*/
    ->setCellValue('AC1', 'TIPO DE PAGO')
    ->setCellValue('AD1', 'MONTO TOTAL')
    ->setCellValue('AE1', 'MONTO INGRESADO')
    ->setCellValue('AF1', 'MONTO RESTANTE')
    ->setCellValue('AG1', 'FECHAS DE PAGO')
    ->setCellValue('AH1', 'ESTADO DE PAGO')
    /*COMISIONES*/
    ->setCellValue('AI1', 'DIGITADOR')
    ->setCellValue('AJ1', 'OPC')
    ->setCellValue('AK1', 'TIENDA')
    ->setCellValue('AL1', 'SUPERV. PROMOTOR')
    ->setCellValue('AM1', 'SUPERV. GENERAL OPC')
    ->setCellValue('AN1', 'DIREC. DE MERCADEO')
    ->setCellValue('AO1', 'TLMK')
    ->setCellValue('AP1', 'SUPERV. DE TLMK')
    ->setCellValue('AQ1', 'CONFIRMADOR')
    ->setCellValue('AR1', 'DIREC. DE TLMK')
    ->setCellValue('AS1', 'LINER')
    ->setCellValue('AT1', 'CLOSER')
    ->setCellValue('AU1', 'CLOSER 2')
    ->setCellValue('AV1', 'JEFE DE SALA')
    ->setCellValue('AW1', 'DIREC. DE VENTAS')
    ->setCellValue('AX1', 'DIREC. DE PROYECTOS')
    ->setCellValue('AY1', 'GERENCIA GENERAL')
    ->setCellValue('AZ1', 'DIREC. DE PLAN.')
    ->setCellValue('BA1', 'ASESOR DE PLAN.');
//    ->setCellValue('BB1', '')
//    ->setCellValue('BC1', '')
//    ->setCellValue('BD1', '')
//    ->setCellValue('BE1', '')
//    ->setCellValue('BF1', '')
//    ->setCellValue('BG1', '')
//    ->setCellValue('BH1', '')
//    ->setCellValue('BI1', '')
//    ->setCellValue('BJ1', '')
//    ->setCellValue('BK1', '')
//    ->setCellValue('BL1', '')
//    ->setCellValue('BM1', '')
//    ->setCellValue('BN1', '')
//    ->setCellValue('BO1', '')
//    ->setCellValue('BP1', '')
//    ->setCellValue('BQ1', '')
//    ->setCellValue('BR1', '')
//    ->setCellValue('BS1', '')
//    ->setCellValue('BT1', '')
//    ->setCellValue('BU1', '')
//    ->setCellValue('BV1', '')
//    ->setCellValue('BW1', '')
//    ->setCellValue('BX1', '')
//    ->setCellValue('BY1', '')
//    ->setCellValue('BZ1', '');


$connection = \Yii::$app->db;
$sqlStatement = '
        SELECT DISTINCT
              razon_social,
          numero_contrato    AS NUMEROCONTRATO,
          serie_comprobante  AS SERIE,
          numero_comprobante AS COMPROBANTE,
          c.Nombre           AS NOMBRE,
          c.Apellido         AS APELLIDO,
          CASE
          c.Estado_Civil
          WHEN 0
            THEN "Soltero"
          WHEN 1
            THEN "Casado"
          WHEN 2
            THEN "Comprometido"
          WHEN 3
            THEN "Divorciado"
          WHEN 4
            THEN "Viudo"
          END                AS Estado_Civil_X,
          c.Profesion        AS PROFESION,
          c.DNI              AS DNI,
          c.Edad             AS EDAD,
          c.Telefono_Celular AS TELEFONOCELULAR,
              c.*,
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
          CASE
          c.Traslado
          WHEN 0
            THEN "Particular"
          WHEN 1
            THEN "Bus"
          END                AS Trasalado_X,
          CASE
          c.Tarjeta_De_Credito
          WHEN 0
            THEN "Tarjeta de Credito"
          WHEN 1
            THEN "Tarjeta de Debito"
          END                AS Tarjeta_De_Credito_X,
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
              END                AS estado_pago,
              com.*,
                cl.Nombre  AS NOMBRE_PASAPORT
        FROM venta v
          INNER JOIN cliente c ON v.Codigo_Cliente = c.Codigo_Cliente
          INNER JOIN club cl ON v.Codigo_club = cl.Codigo_club
          INNER JOIN pasaporte p ON v.Codigo_pasaporte = v.Codigo_pasaporte
          INNER JOIN combo co ON v.Codigo_venta = co.Codigo_venta
          INNER JOIN pago pa ON v.Codigo_venta = pa.Codigo_venta
          INNER JOIN comision com ON v.Codigo_venta = com.Codigo_venta
           ';

        if ($combo == 0) {
            $sqlStatement .= ' WHERE pa.estado_pago = "' . $estadoPago . '"';
        } elseif ($combo == 1) {
            $sqlStatement .= ' WHERE v.salas = "' . $sala . '"';
        } elseif ($combo == 2) {
            $sqlStatement .= ' WHERE cl.Codigo_club = "' . $codigoClub . '"';
        } elseif ($combo == 3) {
            $sqlStatement .= ' WHERE com.Codigo_usuario = "' . $usuario . '"';
        }

$comando = $connection->createCommand($sqlStatement);
$resultado = $comando->query();

$model = new \app\models\Cliente();

$i = 2;
while ($row = $resultado->read()) {
    $objPHPExcel->setActiveSheetIndex(0)
        /* CLIENTE */
        ->setCellValue('A' . $i, ($i-1))
        ->setCellValue('B' . $i, $row['Nombre'])
        ->setCellValue('C' . $i, $row['Apellido'])
        ->setCellValue('D' . $i, $row['Profesion'])
        ->setCellValue('E' . $i, $row['Edad'])
        ->setCellValue('F' . $i, $row['Estado_Civil_X'])
        ->setCellValue('G' . $i, $row['Distrito'])
        ->setCellValue('H' . $i, $row['Direccion'])
        ->setCellValue('I' . $i, $row['Telefono_Casa'])
        ->setCellValue('J' . $i, $row['Telefono_Celular'])
        ->setCellValue('K' . $i, $row['Telefono_Casa2'])
        ->setCellValue('L' . $i, $row['Telefono_Celular2'])
        ->setCellValue('M' . $i, $row['Telefono_Celular3'])
        ->setCellValue('N' . $i, $row['Email'])
        ->setCellValue('O' . $i, $row['Trasalado_X'])
        ->setCellValue('P' . $i, $row['Tarjeta_De_Credito_X'])
        ->setCellValue('Q' . $i, $row['dni'])
        /*Producto Contratado*/
        ->setCellValue('R' . $i, $row['NOMBRE_PASAPORT'])
        ->setCellValue('S' . $i, $row['NUMEROPASAPORTE'])
        ->setCellValue('T' . $i, $row['VigenciaDias'])
        ->setCellValue('U' . $i, $row['VigenciaDias'])
        /*DATOS BENEFICIAROS*/
//        ->setCellValue('V' . $i, $row[''])
//        ->setCellValue('W' . $i, $row[''])
//        ->setCellValue('X' . $i, $row[''])
        /*INCENTIVOS*/
        ->setCellValue('Y' . $i, $row['CONVER1'])
        ->setCellValue('Z' . $i, $row['CONVER2'])
        ->setCellValue('AA' . $i, $row['REGALOS'])
        ->setCellValue('AB' . $i, $row['OBSER'])
        /*FORMAS DE PAGO*/
        ->setCellValue('AC' . $i, $row['tipo_pago'])
        ->setCellValue('AD' . $i, $row['MONTO'])
        ->setCellValue('AE' . $i, $row['INGRESA'])
        ->setCellValue('AF' . $i, $row['RESTANTE'])
//        ->setCellValue('AG' . $i, $row[''])
        ->setCellValue('AH' . $i, $row['estado_pago'])
        /*COMISIONES*/
        ->setCellValue('AI' . $i, $row['Digitador'])
        ->setCellValue('AJ' . $i, $row['OPC'])
        ->setCellValue('AK' . $i, $row['Tienda'])
        ->setCellValue('AL' . $i, $row['SupervisorPromotor'])
        ->setCellValue('AM' . $i, $row['SuperviorGeneralOPC'])
        ->setCellValue('AN' . $i, $row['DirectordeMercadero'])
        ->setCellValue('AO' . $i, $row['TLMK'])
        ->setCellValue('AP' . $i, $row['SupervisordeTLMK'])
        ->setCellValue('AQ' . $i, $row['Confirmadora'])
        ->setCellValue('AR' . $i, $row['Liner'])
        ->setCellValue('AR' . $i, $row['Closer'])
        ->setCellValue('AR' . $i, $row['Closer2'])
        ->setCellValue('AR' . $i, $row['JefedeSala'])
        ->setCellValue('AR' . $i, $row['DirectordeVentas'])
        ->setCellValue('AR' . $i, $row['DirectordeProyectos'])
        ->setCellValue('AR' . $i, $row['GenerenciaGeneral'])
        ->setCellValue('AR' . $i, $row['directordePlaneamiento'])
        ->setCellValue('AR' . $i, $row['asesordePlaneamiento'])

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
