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
        $this->Cell(7.5, 1, utf8_decode(strtoupper('')), 0, 'C', 'L');
        $this->Image(Yii::getAlias('@groupgygUrlReporte'), 1, 1, 1.5, 1.5);
        $this->Cell(12.5, 1, utf8_decode(strtoupper('Registro de Anfitriones')), 0, 'C', 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(7.5, 1, utf8_decode(strtoupper('Tienda:')), 1, 'C', 'L');
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

    function ImpresionCuerpo($fechaIni, $fechaFin, $turno, $descanso)
    {
        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(1.5, 0.7, utf8_decode(strtoupper('CÓD.')), 1, '', 'C');
        $this->Cell(7.5, 0.7, utf8_decode(strtoupper('Nombres y Apellidos')), 1, '', 'C');
        $this->Cell(2, 0.7, utf8_decode(strtoupper('DNI')), 1, '', 'C');
        $this->Cell(3.9, 0.7, utf8_decode(strtoupper('CARGO')), 1, '', 'C');
        $this->Cell(3, 0.7, utf8_decode(strtoupper('N° cecular')), 1, '', 'C');
        $this->Cell(2.7, 0.7, utf8_decode(strtoupper('N° Fijo')), 1, '', 'C');
        $this->Cell(3, 0.7, utf8_decode(strtoupper('Turno')), 1, '', 'C');
        $this->Cell(3.9, 0.7, utf8_decode(strtoupper('Dia de Descanso')), 1, '', 'C');
        $this->Ln();

        $connection = \Yii::$app->db;
        $sqlStatement = "
        SELECT
          Codigo,
          Nombre,
          Apellido,
          DNI,
          Edad,
          Cargo,
          Telefono_Casa,
          Telefono_Celular,
          CASE Turno
          WHEN 0
            THEN 'MaÑana'
          WHEN 1
            THEN 'Tarde'
          WHEN 2
            THEN 'Noche'
          END AS Turno,
          CASE Descanso
          WHEN 0
            THEN 'Lunes'
          WHEN 1
            THEN 'Martes'
          WHEN 2
            THEN 'Miercoles'
          WHEN 3
            THEN 'Jueves'
          WHEN 4
            THEN 'Viernes'
          WHEN 5
            THEN 'Sabado'
          WHEN 6
            THEN 'Domingo'
          END AS Descanso
        FROM anfitrion
        WHERE Encargado = 0 or Encargado IS NULL ;
";
        $comando = $connection->createCommand($sqlStatement);
        $resultado = $comando->query();

        while ($row = $resultado->read()) {
            $this->SetFont('Arial', '', 10);
            $this->Cell(1.5, 0.5, utf8_decode(strtoupper($row['Codigo'])), 1, '', 'C');
            $this->Cell(7.5, 0.5, utf8_decode(strtoupper($row['Nombre'] . ' ' . $row['Apellido'])), 1, '', 'L');
            $this->Cell(2, 0.5, utf8_decode(strtoupper($row['DNI'])), 1, '', 'C');
            $this->Cell(3.9, 0.5, utf8_decode(strtoupper($row['Cargo'])), 1, '', 'C');
            $this->Cell(3, 0.5, utf8_decode(strtoupper($row['Telefono_Celular'])), 1, '', 'C');
            $this->Cell(2.7, 0.5, utf8_decode(strtoupper($row['Telefono_Casa'])), 1, '', 'C');
            $this->Cell(3, 0.5, utf8_decode(strtoupper($row['Turno'])), 1, '', 'C');
            $this->Cell(3.9, 0.5, utf8_decode(strtoupper($row['Descanso'])), 1, '', 'C');
            $this->Ln();
        }

    }

    function ImpresionFooter($fechaIni, $fechaFin, $turno, $descanso)
    {
        $this->SetXY(1.93, 16.1);

        $this->SetFont('Arial', 'B', 11);
        $this->Ln();
        $this->Cell(27.5, 0.7, utf8_decode(strtoupper('Encargados de tienda: ')), 0, '', 'L');
        $this->Ln();

        $connection = \Yii::$app->db;
        $sqlStatement = "
        SELECT
          Codigo,
          Nombre,
          Apellido,
          DNI,
          Edad,
          Cargo,
          Telefono_Casa,
          Telefono_Celular,
          CASE Turno
          WHEN 0
            THEN 'MaÑana'
          WHEN 1
            THEN 'Tarde'
          WHEN 2
            THEN 'Noche'
          END AS Turno,
          CASE Descanso
          WHEN 0
            THEN 'Lunes'
          WHEN 1
            THEN 'Martes'
          WHEN 2
            THEN 'Miercoles'
          WHEN 3
            THEN 'Jueves'
          WHEN 4
            THEN 'Viernes'
          WHEN 5
            THEN 'Sabado'
          WHEN 6
            THEN 'Domingo'
          END AS Descanso
        FROM anfitrion
        WHERE Encargado = 1;";
        $comando = $connection->createCommand($sqlStatement);
        $resultado = $comando->query();

        while ($row = $resultado->read()) {
            $this->SetFont('Arial', '', 11);
            $this->Cell(1.5, 0.6, utf8_decode(strtoupper($row['Codigo'])), 1, '', 'C');
            $this->Cell(7.5, 0.6, utf8_decode(strtoupper($row['Nombre'] . ' ' . $row['Apellido'])), 1, '', 'L');
            $this->Cell(2, 0.6, utf8_decode(strtoupper($row['DNI'])), 1, '', 'C');
            $this->Cell(3.9, 0.6, utf8_decode(strtoupper($row['Cargo'])), 1, '', 'C');
            $this->Cell(3, 0.6, utf8_decode(strtoupper($row['Telefono_Celular'])), 1, '', 'C');
            $this->Cell(2.7, 0.6, utf8_decode(strtoupper($row['Telefono_Casa'])), 1, '', 'C');
            $this->Cell(3, 0.6, utf8_decode(strtoupper($row['Turno'])), 1, '', 'C');
            $this->Cell(3.9, 0.6, utf8_decode(strtoupper($row['Descanso'])), 1, '', 'C');
            $this->Ln();
        }
    }

    function Impresion($fechaIni, $fechaFin, $turno, $descanso)
    {
        $this->ImpresionCabezara($fechaIni, $fechaFin);
        $this->ImpresionCuerpo($fechaIni, $fechaFin, $turno, $descanso);
        $this->ImpresionFooter($fechaIni, $fechaFin, $turno, $descanso);
    }
}


$pdf = new PDF('L', 'cm', 'A4');
$Reporte = "Reporte_de_Venta.pdf";
$pdf->AddPage();
$pdf->Impresion($fechaIni, $fechaFin, $turno, $descanso);
$pdf->SetTitle("Reporte de Ventas");
$pdf->SetAuthor("Rustica Club");
$pdf->Output($Reporte, 'I');
$pdf->Close();
exit();