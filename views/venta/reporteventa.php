<?php
header('Content-type: application/pdf');

use yii\db\Query;

class PDF extends FPDF
{

    function Impresion($fechaIni, $fechaFin, $combo, $estadoPago, $sala, $codigoClub, $usuario)
    {
        $model = new \app\models\Usuario();
        $cliente = new \app\models\Cliente();

//      $this->Cell(Ancho , Alto , cadena , bordes , posición , alinear , fondo, URL )
        $this->SetFont('Arial', 'B', 20);

//      $this->Image('ruta de imagen', horizontal, vertical, ancho, alto);
//        $this->Image(Yii::getAlias('@groupgygUrlReporte'), 1, 1, 1.5, 1.5);
        $this->Cell(115, 1, utf8_decode('Lista de Ventas'), 0, 'C', 'C');
        $this->Ln(2);

        $this->SetFont('Arial', 'B', 11);
        $this->SetFillColor(150, 54, 52); // establece el color del fondo de la celda.
        $this->SetDrawColor(150, 54, 52);     // establece el color del contorno de la celda.
        $this->SetTextColor(255, 255, 255);  // Establece el color del texto.
        $this->Cell(0.2, 0.2, utf8_decode(''), 0, 0, 'C', True);
        $this->Cell(114.6, 0.2, utf8_decode(''), 1, 0, 'C', True);
        $this->Cell(0.2, 0.2, utf8_decode(''), 0, 0, 'C', True);
        $this->Ln(0.6);

        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(9.16, 0.5, utf8_decode('Fecha: ' . date("d/m/Y", strtotime($fechaIni)) . ' Hasta el: ' . date("d/m/Y", strtotime($fechaFin))), 0, '', 'L');
//        $this->Cell(9.16, 0.5, utf8_decode('Estado del Reporte: ' . 'Sin Estado Definido'), 0, '', 'L');
        $this->Cell(9.16, 0.5, utf8_decode('Usuario Solicitado: ' . $model->getRol(Yii::$app->user->identity->Codigo_Rol)), 0, '', 'L');
        $this->Ln(0.8);


        $this->Cell(18, 1, utf8_decode(strtoupper('')), 0, '', 'C');
        $this->Cell(27, 1, utf8_decode(strtoupper('DATOS DEL CLIENTE')), 1, '', 'C');
        $this->Cell(12, 1, utf8_decode(strtoupper('PRODUCTO CONTRATADO')), 1, '', 'C');
        $this->Cell(13.5, 1, utf8_decode(strtoupper('DATOS BENEFICIAROS')), 1, '', 'C');
        $this->Cell(29, 1, utf8_decode(strtoupper('INCENTIVOS')), 1, '', 'C');
        $this->Cell(19.5, 1, utf8_decode(strtoupper('FORMA DE PAGO')), 1, '', 'C');
        $this->Ln();

        $this->SetFont('Arial', 'B', 7.5);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(1.5, 1, utf8_decode(strtoupper('ITEM')), 1, '', 'C');
        $this->Cell(10, 1, utf8_decode(strtoupper('RAZÓN SOCIAL')), 1, '', 'C');
        $this->Cell(2, 1, utf8_decode(strtoupper('NºCTO')), 1, '', 'C');
        $this->Cell(2, 1, utf8_decode(strtoupper('SERIE ')), 1, '', 'C');
        $this->Cell(2.5, 1, utf8_decode(strtoupper('N° DE COMP.')), 1, '', 'C');

        $this->Cell(4.5, 1, utf8_decode(strtoupper('NOMBRE')), 1, '', 'C');
        $this->Cell(5.5, 1, utf8_decode(strtoupper('APELLIDOS')), 1, '', 'C');
        $this->Cell(2.5, 1, utf8_decode(strtoupper('ESTADO CIVIL')), 1, '', 'C');
        $this->Cell(5, 1, utf8_decode(strtoupper('OCUPACION')), 1, '', 'C');
        $this->Cell(3, 1, utf8_decode(strtoupper('DNI')), 1, '', 'C');
        $this->Cell(1.5, 1, utf8_decode(strtoupper('EDAD')), 1, '', 'C');
        $this->Cell(2.5, 1, utf8_decode(strtoupper('TELEF. CASA')), 1, '', 'C');
        $this->Cell(2.5, 1, utf8_decode(strtoupper('TELEF. CELULAR')), 1, '', 'C');

        $this->Cell(3.5, 1, utf8_decode(strtoupper('TIPO PASAPORTE')), 1, '', 'C');
        $this->Cell(3.5, 1, utf8_decode(strtoupper('C. DE PASAPORTE')), 1, '', 'C');
        $this->Cell(2.5, 1, utf8_decode(strtoupper('CANT. DE NOCHES')), 1, '', 'C');
        $this->Cell(2.5, 1, utf8_decode(strtoupper('N° NOCHES')), 1, '', 'C');

        $this->Cell(11.5, 1, utf8_decode(strtoupper('NOMBRE')), 1, '', 'C');
        $this->Cell(2, 1, utf8_decode(strtoupper('DNI')), 1, '', 'C');

        $this->Cell(3.5, 1, utf8_decode(strtoupper('CONVERTIDOR 1')), 1, '', 'C');
        $this->Cell(3.5, 1, utf8_decode(strtoupper('CONVERTIDOR 2')), 1, '', 'C');
        $this->Cell(11, 1, utf8_decode(strtoupper('REGALOS')), 1, '', 'C');
        $this->Cell(11, 1, utf8_decode(strtoupper('OBSERVACIONES')), 1, '', 'C');

        $this->Cell(4.5, 1, utf8_decode(strtoupper('F-P')), 1, '', 'C');
        $this->Cell(3.5, 1, utf8_decode(strtoupper('MONTO TOTAL VENTA')), 1, '', 'C');
        $this->Cell(2.5, 1, utf8_decode(strtoupper('INGRESADO ')), 1, '', 'C');
        $this->Cell(2.5, 1, utf8_decode(strtoupper('PENDIENTE')), 1, '', 'C');
        $this->Cell(3, 1, utf8_decode(strtoupper('FECHA PAGO FINAN.')), 1, '', 'C');
        $this->Cell(3.5, 1, utf8_decode(strtoupper('ESTADO')), 1, '', 'C');
        $this->Ln();

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
              com.*
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

        $i = 1;
        while ($row = $resultado->read()) {

            $this->SetFont('Arial', '', 7.5);
            $this->Cell(1.5, 1, utf8_decode(strtoupper($i)), 1, '', 'C');
            $this->Cell(10, 1, utf8_decode(strtoupper($row['razon_social'])), 1, '', 'L');
            $this->Cell(2, 1, utf8_decode(strtoupper($row['NUMEROCONTRATO'])), 1, '', 'C');
            $this->Cell(2, 1, utf8_decode(strtoupper($row['SERIE'])), 1, '', 'C');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['COMPROBANTE'])), 1, '', 'C');

            // Cliente
            $this->Cell(4.5, 1, utf8_decode(strtoupper($row['NOMBRE'])), 1, '', 'L');
            $this->Cell(5.5, 1, utf8_decode(strtoupper($row['APELLIDO'])), 1, '', 'L');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['Estado_Civil'])), 1, '', 'C');
            $this->Cell(5, 1, utf8_decode(strtoupper($row['PROFESION'])), 1, '', 'L');
            $this->Cell(3, 1, utf8_decode(strtoupper($row['DNI'])), 1, '', 'L');
            $this->Cell(1.5, 1, utf8_decode(strtoupper($row['EDAD'])), 1, '', 'C');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['Telefono_Casa'])), 1, '', 'L');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['Telefono_Celular'])), 1, '', 'L');

            // Producto Contratado
            $this->Cell(3.5, 1, utf8_decode(strtoupper($row['NOMBREPASPORTE'])), 1, '', 'L');
            $this->Cell(3.5, 1, utf8_decode(strtoupper($row['NUMEROPASAPORTE'])), 1, '', 'C');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['VigenciaDias'])), 1, '', 'C');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['VigenciaDias'])), 1, '', 'C');

            // Datos Beneficiario
            $this->Cell(11.5, 1, utf8_decode(strtoupper('')), 1, '', 'L');
            $this->Cell(2, 1, utf8_decode(strtoupper('')), 1, '', 'C');

            // Incentivos
            $this->Cell(3.5, 1, utf8_decode(strtoupper($row['CONVER1'])), 1, '', 'L');
            $this->Cell(3.5, 1, utf8_decode(strtoupper($row['CONVER2'])), 1, '', 'L');
            $this->Cell(11, 1, utf8_decode(strtoupper($row['REGALOS'])), 1, '', 'L');
            $this->Cell(11, 1, utf8_decode(strtoupper($row['OBSER'])), 1, '', 'L');

            //Forma de Pago
            $this->Cell(4.5, 1, utf8_decode(strtoupper($row['tipo_pago'])), 1, '', 'C');
            $this->Cell(3.5, 1, utf8_decode(strtoupper($row['MONTO'])), 1, '', 'C');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['INGRESA'])), 1, '', 'C');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['RESTANTE'])), 1, '', 'C');
            $this->Cell(3, 1, utf8_decode(strtoupper('')), 1, '', 'L');
            $this->Cell(3.5, 1, utf8_decode(strtoupper($row['estado_pago'])), 1, '', 'C');
           
            //Comisiones

            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['VigenciaDias'])), 1, '', 'C');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['VigenciaDias'])), 1, '', 'C');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['VigenciaDias'])), 1, '', 'C');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['VigenciaDias'])), 1, '', 'C');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['VigenciaDias'])), 1, '', 'C');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['VigenciaDias'])), 1, '', 'C');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['VigenciaDias'])), 1, '', 'C');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['VigenciaDias'])), 1, '', 'C');
            $this->Cell(2.5, 1, utf8_decode(strtoupper($row['VigenciaDias'])), 1, '', 'C');

            
            $this->Ln();

            $i++;
        }

    }

}

$pdf = new PDF('L', 'cm', array(22, 115));
$Reporte = "Reporte_de_Venta.pdf";
$pdf->AddPage();
$pdf->Impresion($fechaIni, $fechaFin, $combo, $estadoPago, $sala, $codigoClub, $usuario);
$pdf->SetTitle("Reporte de Ventas");
$pdf->SetAuthor("Rustica Club");
$pdf->Output($Reporte, 'I');
$pdf->Close();
exit();