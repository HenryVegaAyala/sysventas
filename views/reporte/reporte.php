<?php
header('Content-type: application/pdf');

$fechaIni;
$fechaFin;

class PDF extends FPDF
{


    function Impresion($fechaIni, $fechaFin)
    {
        $model = new \app\models\Usuario();

//      $this->Cell(Ancho , Alto , cadena , bordes , posición , alinear , fondo, URL )
        $this->SetFont('Arial', 'B', 15);

//      $this->Image('ruta de imagen', horizontal, vertical, ancho, alto);
        $this->Image(Yii::getAlias('@groupgygUrlReporte'), 1, 1, 1.5, 1.5);
        $this->Cell(27.5, 1, utf8_decode('Lista de Ventas Generadas'), 0, 'C', 'C');
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
        $this->Cell(9.16, 0.5, utf8_decode('Fecha: ' . date("d/m/Y", strtotime($fechaIni)) . ' Hasta el: ' . date("d/m/Y", strtotime($fechaFin))), 0, '', 'L');
        $this->Cell(9.16, 0.5, utf8_decode('Estado del Reporte: ' . 'Sin Estado Definido'), 0, '', 'L');
        $this->Cell(9.16, 0.5, utf8_decode('Usuario Solicitado: ' . $model->getRol(Yii::$app->user->identity->Codigo_Rol)), 0, '', 'L');
        $this->Ln(0.8);

        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(3, 0.7, utf8_decode(strtoupper('cantidad')), 1, '', 'C');
        $this->Cell(18.5, 0.7, utf8_decode(strtoupper('descripciÓn')), 1, '', 'C');
        $this->Cell(3, 0.7, utf8_decode(strtoupper('precio')), 1, '', 'C');
        $this->Cell(3, 0.7, utf8_decode(strtoupper('total')), 1, '', 'C');
        $this->Ln();

//        $this->SetFont('Arial', 'B', 12);
//        $this->Cell(3, 8.5, utf8_decode(strtoupper('')), 1, '', 'C');
//        $this->Cell(18.5, 8.5, utf8_decode(strtoupper('')), 1, '', 'C');
//        $this->Cell(3, 8.5, utf8_decode(strtoupper('')), 1, '', 'C');
//        $this->Cell(3, 8.5, utf8_decode(strtoupper('')), 1, '', 'C');
//        $this->Ln();

    }
}

$pdf = new PDF('L', 'cm', 'A4');
$Reporte = "Reporte_de_Venta.pdf";
$pdf->AddPage();
$pdf->Impresion($fechaIni, $fechaFin);
$pdf->SetTitle("Reporte de Ventas");
$pdf->SetAuthor("Rustica Club");
$pdf->Output($Reporte, 'I');
$pdf->Close();
exit();