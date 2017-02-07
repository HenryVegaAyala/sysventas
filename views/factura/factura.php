<?php
header('Content-type: application/pdf');

use yii\db\Query;

class PDF extends FPDF
{
    function ImpresionCabezara($model)
    {
//      $this->Cell(Ancho , Alto , cadena , bordes , posición , alinear , fondo, URL )
        $this->SetFont('Arial', 'B', 15);

//      $this->Image('ruta de imagen', horizontal, vertical, ancho, alto);
        $this->Image(Yii::getAlias('@groupgygUrlReporte'), 9, 1.3, 2.5, 2.5);
        $this->Cell(17.5, 3, utf8_decode(''), 0, 'C');
        $this->MultiCell(10, 1, utf8_decode(strtoupper('Rustica Club 
factura
N° - '.str_pad($model->id, 10, "0", STR_PAD_LEFT))), 1, 'C');

    }

    function ImpresionCuerpo($model)
    {

        $this->SetFont('Arial', 'B', 15);
        $this->Ln(0.5);
        $this->Cell(2.1, 1, utf8_decode('Cliente: '), 0, 'C');
        $this->SetFont('Arial', '', 13);
        $this->Cell(11.65, 1, utf8_decode(''), 0, 'R');
//        $this->Line(14.5,5.2,2.8,5.2);

        $this->SetFont('Arial', 'B', 15);
        $this->Cell(5, 1, utf8_decode('Fecha de Emisión:'), 0, 'C');
        $this->SetFont('Arial', '', 13);
        $this->Cell(8.75, 1, utf8_decode(date('d/m/Y',strtotime($model->Fecha_Creado))), 0, 'R');
        $this->Ln();

        $this->SetFont('Arial', 'B', 15);
        $this->Cell(2.8, 1, utf8_decode('Dirección:'), 0, 'C');
        $this->SetFont('Arial', '', 13);
        $this->Cell(10.95, 1, utf8_decode(''), 0, 'R');


        $this->SetFont('Arial', 'B', 15);
        $this->Cell(5, 1, utf8_decode('Estado del Pago:'), 0, 'C');
        $this->SetFont('Arial', '', 13);
        $this->Cell(8.75, 1, utf8_decode(''), 0, 'R');
        $this->Ln(1.5);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(3, 0.7, utf8_decode(strtoupper('cantidad')), 1, '', 'C');
        $this->Cell(18.5, 0.7, utf8_decode(strtoupper('descripciÓn')), 1, '', 'C');
        $this->Cell(3, 0.7, utf8_decode(strtoupper('precio')), 1, '', 'C');
        $this->Cell(3, 0.7, utf8_decode(strtoupper('total')), 1, '', 'C');
        $this->Ln();

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(3, 8.5, utf8_decode(strtoupper('')), 1, '', 'C');
        $this->Cell(18.5, 8.5, utf8_decode(strtoupper('')), 1, '', 'C');
        $this->Cell(3, 8.5, utf8_decode(strtoupper('')), 1, '', 'C');
        $this->Cell(3, 8.5, utf8_decode(strtoupper('')), 1, '', 'C');
        $this->Ln();

    }

    function ImpresionFooter($model)
    {
        $this->SetXY(1.93, 8.1);

        $this->SetFont('Arial', 'B', 11);
        $this->Ln();
        $this->Cell(21.5, 0.7, utf8_decode(strtoupper('son: ')), 1, '', 'L');
        $this->Cell(6, 0.7, '', 1, '', 'L');
        $this->Ln();

        $this->Cell(21.5, 1.65, '', 1, '', 'L');
        $this->Cell(3, 0.55, strtoupper('Sub-Total'), 1, '', 'C');
        $this->Cell(3, 0.55, strtoupper(''), 1, '', 'C');
        $this->Ln();

        $this->Cell(21.5, 0.55, '', 0, '', 'L');
        $this->Cell(3, 0.55, strtoupper('I.G.V. %'), 1, '', 'C');
        $this->Cell(3, 0.55, strtoupper(''), 1, '', 'C');
        $this->Ln();

        $this->Cell(21.5, 0.55, '', 0, '', 'L');
        $this->Cell(3, 0.55, strtoupper('Total'), 1, '', 'C');
        $this->Cell(3, 0.55, strtoupper(''), 1, '', 'C');
        $this->Ln();
    }

    function Impresion($model)
    {

        $this->ImpresionCabezara($model);
        $this->ImpresionCuerpo($model);
        $this->ImpresionFooter($model);
    }
}

$pdf = new PDF('L', 'cm', 'A4');
$Reporte = "Factura-".str_pad($model->id, 10, "0", STR_PAD_LEFT).".pdf";
$pdf->AddPage();
$pdf->Impresion($model);
$pdf->SetTitle("Factura - ".str_pad($model->id, 10, "0", STR_PAD_LEFT));
$pdf->SetAuthor("Rustica Club");
$pdf->Output($Reporte, 'I');
$pdf->Close();
exit();