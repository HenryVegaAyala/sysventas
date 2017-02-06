<?php
use yii\db\Query;

header('Content-type: application/pdf');

class PDF extends FPDF
{

    function ImpresionCabezara($fechaI, $fechaF)
    {

//      $this->Cell(Ancho , Alto , cadena , bordes , posición , alinear , fondo, URL )
        $this->SetFont('Arial', 'B', 16);

//      $this->Image('ruta de imagen', horizontal, vertical, ancho, alto);
        $this->Image(Yii::getAlias('@groupgygUrlReporte'), 1, 1, 1.5, 1.5);
        $this->Cell(27.5, 1, utf8_decode(strtoupper('REPORTE DE TELEMARKETING-ASISTENTES POTENCIALES')), 0, 'C', 'C');
        $this->Ln(2);

        $this->SetFont('Arial', 'B', 11);
        $this->SetFillColor(150, 54, 52); // establece el color del fondo de la celda.
        $this->SetDrawColor(150, 54, 52);     // establece el color del contorno de la celda.
        $this->SetTextColor(255, 255, 255);  // Establece el color del texto.
        $this->Cell(0.2, 0.2, utf8_decode(''), 0, 0, 'C', True);
        $this->Cell(27.1, 0.2, utf8_decode(''), 1, 0, 'C', True);
        $this->Cell(0.2, 0.2, utf8_decode(''), 0, 0, 'C', True);
        $this->Ln(0.6);

        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(9.16, 0.5, utf8_decode('Fecha: ' . date("d/m/Y", strtotime($fechaI)) . ' Hasta el: ' . date("d/m/Y", strtotime($fechaF))), 0, '', 'L');
        $this->Cell(9.16, 0.5, utf8_decode('Estado del Reporte: ' . 'Sin Estado Definido'), 0, '', 'L');
        $this->Cell(9.16, 0.5, utf8_decode('Usuario Solicitado: ' . Yii::$app->user->identity->username), 0, '', 'L');
        $this->Ln(0.8);

    }

    function ImpresionCuerpo($fechaIni, $fechaFin)
    {
        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(1.5, 0.7, utf8_decode(strtoupper('ITEM')), 1, '', 'C');
        $this->Cell(2, 0.7, utf8_decode(strtoupper('CODIGO')), 1, '', 'C');
        $this->Cell(6.3, 0.7, utf8_decode(strtoupper('Nombres y Apellidos')), 1, '', 'C');
        $this->Cell(3.9, 0.7, utf8_decode(strtoupper('PROFESIÓN')), 1, '', 'C');
        $this->Cell(3, 0.7, utf8_decode(strtoupper('DIRECCIÓN')), 1, '', 'C');
        $this->Cell(2.7, 0.7, utf8_decode(strtoupper('TELEFONO')), 1, '', 'C');
        $this->Cell(2, 0.7, utf8_decode(strtoupper('COD.OPC')), 1, '', 'C');
        $this->Cell(2.2, 0.7, utf8_decode(strtoupper('COD.TLMK')), 1, '', 'C');
        $this->Cell(3.9, 0.7, utf8_decode(strtoupper('OBSERVACION')), 1, '', 'C');
        $this->Ln();

//        $connection = \Yii::$app->db;
//        $sqlStatement = "";
//        $comando = $connection->createCommand($sqlStatement);
//        $resultado = $comando->query();
//
//        while ($row = $resultado->read()) {
//            $this->SetFont('Arial', '', 10);
//            $this->Cell(1.5, 0.5, utf8_decode(strtoupper($row['Codigo'])), 1, '', 'C');
//            $this->Cell(7.5, 0.5, utf8_decode(strtoupper($row['Nombre'] . ' ' . $row['Apellido'])), 1, '', 'L');
//            $this->Cell(2, 0.5, utf8_decode(strtoupper($row['DNI'])), 1, '', 'C');
//            $this->Cell(3.9, 0.5, utf8_decode(strtoupper($row['Cargo'])), 1, '', 'C');
//            $this->Cell(3, 0.5, utf8_decode(strtoupper($row['Telefono_Celular'])), 1, '', 'C');
//            $this->Cell(2.7, 0.5, utf8_decode(strtoupper($row['Telefono_Casa'])), 1, '', 'C');
//            $this->Cell(3, 0.5, utf8_decode(strtoupper($row['Turno'])), 1, '', 'C');
//            $this->Cell(3.9, 0.5, utf8_decode(strtoupper($row['Descanso'])), 1, '', 'C');
//            $this->Ln();
//        }

    }

    function ImpresionFooter($fechaIni, $fechaFin)
    {
        $this->SetXY(1.93, 17.5);

        $this->SetFont('Arial', 'B', 11);
        $this->Ln();
        $this->Cell(4.3, 0.7, utf8_decode(strtoupper('TOTAL ASISTENTES: ')), 0, '', 'L');
        $this->Cell(2, 0.7, utf8_decode(strtoupper('')), 0, '', 'L');
        $this->Ln();

//        $connection = \Yii::$app->db;
//        $sqlStatement = "";
//        $comando = $connection->createCommand($sqlStatement);
//        $resultado = $comando->query();
//
//        while ($row = $resultado->read()) {
//            $this->SetFont('Arial', '', 11);
//            $this->Cell(1.5, 0.6, utf8_decode(strtoupper($row['Codigo'])), 1, '', 'C');
//            $this->Cell(7.5, 0.6, utf8_decode(strtoupper($row['Nombre'] . ' ' . $row['Apellido'])), 1, '', 'L');
//            $this->Cell(2, 0.6, utf8_decode(strtoupper($row['DNI'])), 1, '', 'C');
//            $this->Cell(3.9, 0.6, utf8_decode(strtoupper($row['Cargo'])), 1, '', 'C');
//            $this->Cell(3, 0.6, utf8_decode(strtoupper($row['Telefono_Celular'])), 1, '', 'C');
//            $this->Cell(2.7, 0.6, utf8_decode(strtoupper($row['Telefono_Casa'])), 1, '', 'C');
//            $this->Cell(3, 0.6, utf8_decode(strtoupper($row['Turno'])), 1, '', 'C');
//            $this->Cell(3.9, 0.6, utf8_decode(strtoupper($row['Descanso'])), 1, '', 'C');
//            $this->Ln();
//        }
    }



    function Impresion($fechaIni, $fechaFin)
    {
        $this->ImpresionCabezara($fechaIni, $fechaFin);
        $this->ImpresionCuerpo($fechaIni, $fechaFin);
        $this->ImpresionFooter($fechaIni, $fechaFin);
    }

}


$pdf = new PDF('L', 'cm', 'A4');
$Reporte = "REPORTE DE TELEMARKETING-ASISTENTES POTENCIALES.pdf";
$pdf->AddPage();
$pdf->Impresion($fechaIni, $fechaFin);
$pdf->SetTitle("Reporte de Telemarketing - Asistentes Potenciales");
$pdf->SetAuthor("Rustica Club");
$pdf->Output($Reporte, 'I');
$pdf->Close();
exit();