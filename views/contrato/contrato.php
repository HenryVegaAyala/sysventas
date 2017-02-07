<?php
header('Content-type: application/pdf');

$Codigo_Contrato = $model->Codigo_Contrato;

class PDF extends FPDF
{
    function Impresion($Codigo_Contrato)
    {
//      $this->Cell(Ancho , Alto , cadena , bordes , posición , alinear , fondo, URL )
        $this->SetFont('Arial', 'B', 11);

        $this->Image(Yii::getAlias('@groupgygUrlReporte'), 1, 1, 1.5, 1.5);
        $this->Cell(19, 0.7, utf8_decode(strtoupper('Formato N° - ' . $Codigo_Contrato)), 0, '', 'C');
        $this->Image(Yii::getAlias('@groupgygUrlReporte'), 18.5, 1, 1.5, 1.5);
        $this->Ln();

        $this->Cell(19, 0.5, utf8_decode(strtoupper('CONTRATO DE INTERMEDIACIÓN COMERCIAL')), 0, '', 'C');
        $this->Ln(1.5);

        $this->SetFont('Arial', 'B', 11);
        $this->SetFillColor(150, 54, 52); // establece el color del fondo de la celda.
        $this->SetDrawColor(150, 54, 52);     // establece el color del contorno de la celda.
        $this->SetTextColor(255, 255, 255);  // Establece el color del texto.
        $this->Cell(19, 0.7, utf8_decode(strtoupper('Datos Personales')), 1, 0, 'C', True);
        $this->Ln(1);

        $this->SetFont('Arial', '', 11);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(19, 0.6, utf8_decode('Apellidos y Nombres:'), 0, '', 'L');
        $this->Ln(1);

        $this->Cell(9.5, 0.6, utf8_decode(ucwords('Titular:')), 0, '', 'L');
        $this->Cell(9.5, 0.6, utf8_decode(ucwords('Esposa (o):')), 0, '', 'L');
        $this->Ln(1);

        $this->Cell(9.5, 0.6, utf8_decode(ucwords('D.N.I.:')), 0, '', 'L');
        $this->Cell(9.5, 0.6, utf8_decode(ucwords('D.N.I.:')), 0, '', 'L');
        $this->Ln(1);

        $this->Cell(9.5, 0.6, utf8_decode(ucwords('Estado Civil:')), 0, '', 'L');
        $this->Cell(9.5, 0.6, utf8_decode(ucwords('Estado Civil:')), 0, '', 'L');
        $this->Ln(1);

        $this->Cell(9.5, 0.6, utf8_decode(ucwords('Domicilio:')), 0, '', 'L');
        $this->Cell(9.5, 0.6, utf8_decode(ucwords('Domicilio:')), 0, '', 'L');
        $this->Ln(1);

        $this->Cell(9.5, 0.6, utf8_decode(ucwords('Ocupación:')), 0, '', 'L');
        $this->Cell(9.5, 0.6, utf8_decode(ucwords('Ocupación:')), 0, '', 'L');
        $this->Ln(1);

        $this->SetFont('Arial', 'B', 11);
        $this->SetFillColor(150, 54, 52); // establece el color del fondo de la celda.
        $this->SetDrawColor(150, 54, 52);     // establece el color del contorno de la celda.
        $this->SetTextColor(255, 255, 255);  // Establece el color del texto.
        $this->Cell(19, 0.7, utf8_decode(strtoupper('MODALIDAD DE PAGO ')), 1, 0, 'C', True);
        $this->Ln(1);

        $this->SetFont('Arial', '', 11);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(19, 0.6, utf8_decode('Monto Pagado:'), 0, '', 'L');
        $this->Ln(1);

        $this->Cell(19, 0.6, utf8_decode('Saldos:'), 0, '', 'L');
        $this->Ln(1);

        $this->Cell(19, 0.6, utf8_decode('N° de cuotas:'), 0, '', 'L');
        $this->Ln(1);

        $this->SetFont('Arial', 'B', 11);
        $this->SetFillColor(150, 54, 52); // establece el color del fondo de la celda.
        $this->SetDrawColor(150, 54, 52);     // establece el color del contorno de la celda.
        $this->SetTextColor(255, 255, 255);  // Establece el color del texto.
        $this->Cell(19, 0.7, utf8_decode(strtoupper('REGISTRO ONLINE')), 1, 0, 'C', True);
        $this->Ln(1);

        $this->SetFont('Arial', '', 11);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(19, 0.6, utf8_decode('ID. USUARIO:'), 0, '', 'L');
        $this->Ln(1);

        $this->Cell(19, 0.6, utf8_decode('Contraseña:'), 0, '', 'L');
        $this->Ln(1);

        $this->Cell(19, 0.6, utf8_decode('Fecha de Reserva:'), 0, '', 'L');
        $this->Ln(1);

        $this->SetFont('Arial', 'B', 11);
        $this->SetFillColor(150, 54, 52); // establece el color del fondo de la celda.
        $this->SetDrawColor(150, 54, 52);     // establece el color del contorno de la celda.
        $this->SetTextColor(255, 255, 255);  // Establece el color del texto.
        $this->Cell(19, 0.7, utf8_decode(strtoupper('CANCELACIÓN')), 1, 0, 'C', True);
        $this->Ln(1);

        $this->SetFont('Arial', '', 11);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(9.5, 0.6, utf8_decode(ucwords('Causas:')), 0, '', 'L');
        $this->Cell(9.5, 0.6, utf8_decode(ucwords('Penalización:')), 0, '', 'L');
        $this->Ln(1);

        $this->Cell(9.5, 0.6, utf8_decode(ucwords('Formas:')), 0, '', 'L');
        $this->Cell(9.5, 0.6, utf8_decode(ucwords('Monto devolución:')), 0, '', 'L');
        $this->Ln(1);
    }
}

$pdf = new PDF('P', 'cm', 'A4');
$Reporte = "Contrato-Comercial.pdf";
$pdf->AddPage();
$pdf->Impresion($Codigo_Contrato);
$pdf->SetTitle("Contrato Comercial");
$pdf->SetAuthor("Rustica Club");
$pdf->Output($Reporte, 'I');
$pdf->Close();
exit();