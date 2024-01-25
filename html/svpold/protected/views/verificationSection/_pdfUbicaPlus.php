<?php

class PlainPDF extends SVPPDF {

    public function PlainPDF() {
        parent::SVPPDF(null, null);
    }

    function Header()
    {
        //Put the watermark
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(0,0,0);
        $this->RotatedImage(Yii::app()->basePath . '/images/Logo_cerebro.png',180,180,180,180,180);
    }

    function RotatedImage($file,$x,$y,$w,$h,$angle)
    {
        //Image rotated around its upper-left corner
        $this->Rotate($angle,$x,$y);
        $this->Image($file,102,120,$w,$h);
        $this->Rotate(0);
    }

}

$pdf = new PlainPDF($dataTU, null);
$pdf->SetMargins('15', '15');
$pdf->AddPage();

$pdf->SetFont('Arial','B',20);
$pdf->SetTextColor(116,115,115);
$pdf->MultiCell(190, 7, "Ubica Plus", 0, 'C', 0, 0, '', '', true);
$pdf->Ln();
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(190, 7, $dataTU->Tercero->Entidad, 0, 'R', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(164,7, date('d/m/Y H:i:s'), 0, 'R', 0, 0, '', '', true);


$pdf->SetY(40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);

$pdf->MultiCell(190, 0, "Información Básica del Cliente"  , 1, 'C', 1, 0, '', '', true);
$pdf->SetTextColor(0,0,0);
$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetFont('Arial', 'B', 6);
$pdf->SetFillColor(230,230,230);
$pdf->MultiCell(50,7, 'TIPO DE IDENTIFICACIÓN', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(50,7, $dataTU->Tercero->TipoIdentificacion, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'EST DOCUMENTO', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(20,7, $dataTU->Tercero->Estado, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'FECHA', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40,7, $dataTU->Tercero->Fecha, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();//Salto de línea para generar otra fila
$pdf->MultiCell(50,7, 'No. IDENTIFICACIÓN', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(50,7, $dataTU->Tercero->NumeroIdentificacion, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'FECHA EXP.', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(20,7, $dataTU->Tercero->FechaExpedicion, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'HORA', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40,7, $dataTU->Tercero->Hora, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();//Salto de línea para generar otra fila
$pdf->MultiCell(50,7, 'NOMBRE Y APELLIDOS-RAZÓN SOCIAL', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(50,7, $dataTU->Tercero->NombreTitular, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'LUGAR EXP.', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(20,7, $dataTU->Tercero->LugarExpedicion, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'USUARIO', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40,7, $dataTU->Tercero->Entidad, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();//Salto de línea para generar otra fila
$pdf->MultiCell(50,7, 'GENERÓ', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(50,7, $dataTU->Tercero->GeneroTercero, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'RANGO EDAD PROBABLE', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(20,7, $dataTU->Tercero->RangoEdad, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'No.INFORME', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40,7, $dataTU->Tercero->NumeroInforme, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();//Salto de línea para generar otra fila
$pdf->MultiCell(50,7, 'ACTIVIDAD ECONOMICA-CIIU', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(50,7, $dataTU->Tercero->CodigoCiiu, 0, 'L', 0, 0, '', '', true);


$pdf->Ln(15);
$pdf->MultiCell(0, 0, '', 1, 'C', 1, 0, '', '', true);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(190, 0, "Datos Históricos de Direcciones"  , 1, 'C', 1, 0, '', '', true);
$pdf->SetTextColor(0,0,0);
$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetFont('Arial', 'B', 6);
$pdf->SetFillColor(230,230,230);
$pdf->Cell(10, '', 'NO.', 0, 0, 'C', 1);
$pdf->Cell(20, '', 'TIPO', 0, 0, 'C', 1);
$pdf->Cell(35, '', 'DIRECCIÓN', 0, 0, 'C', 1);
$pdf->Cell(35, '', 'CIUDAD', 0, 0, 'C', 1);
$pdf->Cell(20, '', 'PR. REPORTE', 0, 0, 'C', 1);
$pdf->Cell(20, '', 'ULT. REPORTE', 0, 0, 'C', 1);
$pdf->Cell(10, '', 'GRUPO', 0, 0, 'C', 1);
$pdf->Cell(20, '', 'P.ACTIVO', 0, 0, 'C', 1);
$pdf->Cell(20, '', 'NO. REPORTES', 0, 0, 'C', 1);
$pdf->Ln();//Salto de línea para generar otra fila

//convert into json
//$json  = json_encode($dataTU);

//convert into associative array
//$xmlArr = json_decode($json, true);

//$xml = simplexml_load_file($dataTU);
//print_r($dataTU->Tercero->UbicaPlusCifin->Direcciones->Direccion);
//print_r($xmlArr['Tercero']['UbicaPlusCifin']['Telefonos']['Telefono']);
//die();
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(230,230,230);
$pdf->SetFont('Arial', 'B', 6);
if(isset($dataTU->Tercero->UbicaPlusCifin->Direcciones->Direccion)){
    foreach ($dataTU->Tercero->UbicaPlusCifin->Direcciones->Direccion as $dir) {

        $pdf->Cell(10, '', $dir->DirPos, 0, 0, 'C', 0);
        $pdf->Cell(20, '', $dir->TipoUbicacion, 0, 0, 'C', 0);
        $pdf->Cell(35, '', $dir->Direccion, 0, 0, 'C', 0);
        $pdf->Cell(35, '', $dir->Ciudad, 0, 0, 'C', 0);
        $pdf->Cell(20, '', $dir->PrimerReporte, 0, 0, 'C', 0);
        $pdf->Cell(20, '',  $dir->UltimoReporte, 0, 0, 'C', 0);
        $pdf->Cell(10, '', $dir->SectorEconomico, 0, 0, 'C', 0);
        $pdf->Cell(20, '',  $dir->ProductoActivo, 0, 0, 'C', 0);
        $pdf->Cell(20, '', $dir->NoReportes, 0, 0, 'C', 0);
        $pdf->Ln();
    }
}

//$pdf->SetY(100);
$pdf->Ln(10);
$pdf->MultiCell(0, 0, '', 1, 'C', 1, 0, '', '', true);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(190, 0, "Datos Históricos de Números Telefónicos"  , 1, 'C', 1, 0, '', '', true);
$pdf->SetTextColor(0,0,0);
$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetFont('Arial', 'B', 6);
$pdf->SetFillColor(230,230,230);
$pdf->Cell(10, '', 'NO.', 0, 0, 'C', 1);
$pdf->Cell(20, '', 'TIPO', 0, 0, 'C', 1);
$pdf->Cell(15, '', 'PREFIJO', 0, 0, 'C', 1);
$pdf->Cell(15, '', 'TELÉFONO', 0, 0, 'C', 1);
$pdf->Cell(30, '', 'CIUDAD', 0, 0, 'C', 1);
$pdf->Cell(20, '', 'PR. REPORTE', 0, 0, 'C', 1);
$pdf->Cell(20, '', 'ULT. REPORTE', 0, 0, 'C', 1);
$pdf->Cell(20, '', 'GRUPO', 0, 0, 'C', 1);
$pdf->Cell(20, '', 'P.ACTIVO', 0, 0, 'C', 1);
$pdf->Cell(20, '', 'NO. REPORTES', 0, 0, 'C', 1);
$pdf->Ln();//Salto de línea para generar otra fila

if(isset($dataTU->Tercero->UbicaPlusCifin->Telefonos->Telefono)){
    foreach ($dataTU->Tercero->UbicaPlusCifin->Telefonos->Telefono as $tel) {
        $pdf->Cell(10, '', $tel->TelPos, 0, 0, 'C', 0);
        $pdf->Cell(20, '', $tel->TipoUbicacion, 0, 0, 'C', 0);
        $pdf->Cell(15, '', $tel->Prefijo, 0, 0, 'C', 0);
        $pdf->Cell(15, '', $tel->Telefono, 0, 0, 'C', 0);
        $pdf->Cell(30, '', $tel->Ciudad, 0, 0, 'C', 0);
        $pdf->Cell(20, '', $tel->PrimerReporte, 0, 0, 'C', 0);
        $pdf->Cell(20, '', $tel->UltimoReporte, 0, 0, 'C', 0);
        $pdf->Cell(20, '', $tel->SectorEconomico, 0, 0, 'C', 0);
        $pdf->Cell(20, '', $tel->ProductoActivo, 0, 0, 'C', 0);
        $pdf->Cell(20, '', $tel->NoReportes, 0, 0, 'C', 0);
        $pdf->Ln();
    }
}

$pdf->SetMargins('50', '50');
$pdf->Ln(10);
$pdf->MultiCell(0, 0, '', 1, 'C', 1, 0, '', '', true);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(125, 0, "Datos Históricos de Números Celulares"  , 1, 'C', 1, 0, '', '', true);
$pdf->SetTextColor(0,0,0);
$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetFont('Arial', 'B', 6);
$pdf->SetFillColor(230,230,230);
$pdf->MultiCell(10,7, 'NO.', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(15,7, 'CELULAR', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(20,7, 'PR. REPORTE', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(20,7, 'ULT. REPORTE', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(20,7, 'GRUPO', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(20,7, 'P.ACTIVO', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(20,7, 'NO. REPORTES', 0, 'C', 1, 0, '', '', true);
$pdf->Ln();//Salto de línea para generar otra fila

if(isset($dataTU->Tercero->UbicaPlusCifin->Celulares->Celular)){
    foreach ($dataTU->Tercero->UbicaPlusCifin->Celulares->Celular as $cel) {

        $pdf->MultiCell(10,7, $cel->CelPos, 0, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(15,7, $cel->Celular, 0, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $cel->PrimerReporte, 0, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $cel->UltimoReporte, 0, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $cel->SectorEconomico, 0, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $cel->ProductoActivo, 0, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $cel->NoReportes, 0, 'C', 0, 0, '', '', true);
        $pdf->Ln();
    }
}

$pdf->SetMargins('40', '40');
$pdf->Ln(10);
$pdf->MultiCell(0, 0, '', 1, 'C', 1, 0, '', '', true);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(150, 0, "Datos Históricos de Correos Electrónicos"  , 1, 'C', 1, 0, '', '', true);
$pdf->SetTextColor(0,0,0);
$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetFont('Arial', 'B', 6);
$pdf->SetFillColor(230,230,230);
$pdf->MultiCell(70,7, 'CORREO', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(20,7, 'NO. REPORTES', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(30,7, 'PR. REPORTE', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(30,7, 'ULT. REPORTE', 0, 'C', 1, 0, '', '', true);

$pdf->Ln();//Salto de línea para generar otra fila

if(isset($dataTU->Tercero->UbicaPlusCifin->Mails->Mail)){
    foreach ($dataTU->Tercero->UbicaPlusCifin->Mails->Mail as $mail) {

        $pdf->MultiCell(70,7, $mail->Correo, 0, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $mail->NoReportes, 0, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(30,7, $mail->PrimerReporte, 0, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(30,7, $mail->UltimoReporte, 0, 'C', 0, 0, '', '', true);
        $pdf->Ln();
    }
}

/*$pdf->SetMargins('40', '40');
$pdf->Ln(10);
$pdf->MultiCell(0, 0, '', 1, 'C', 1, 0, '', '', true);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(150, 0, "Huellas de Consultas Últimos Seis Meses"  , 1, 'C', 1, 0, '', '', true);
$pdf->SetTextColor(0,0,0);
$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetFont('Arial', 'B', 6);
$pdf->SetFillColor(230,230,230);
$pdf->MultiCell(60,7, 'ENTIDAD', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(30,7, 'NUMERO CONSULTAS', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(60,7, 'FECHA ULTIMA CONSULTA ENTIDAD', 0, 'C', 1, 0, '', '', true);

$pdf->Ln();//Salto de línea para generar otra fila

if(isset($dataTU->Tercero->UbicaPlusCifin->Mails->Mail)){
    foreach ($dataTU->Tercero->UbicaPlusCifin->Mails->Mail as $mail) {

        $pdf->MultiCell(60,7, $mail->Correo, 0, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(30,7, $mail->NoReportes, 0, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(60,7, $mail->PrimerReporte, 0, 'C', 0, 0, '', '', true);
        $pdf->Ln();
    }
}*/

$pdf->SetTextColor(160,152,152);
$pdf->SetMargins('15', '15');
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(190,7, '*TIPO: RES) Residencia, LAB) Laboral, COR) Correspondencia', 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(190,7, '**GRUPO: Fuente Información: 1)Sector Financiero y Telecomunicaciones, 2) Sector Solidario, 3) Sector Real (Sin Telecomunicaciones)', 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(190,7, '***P. ACTIVO: Presenta obligaciones activas en el sector financiero, real y solidario, no se excluyen productos del pasivo.', 0, 'L', 0, 0, '', '', true);

$filename = tempnam(Yii::app()->getRuntimePath(), 'UbicaPlus_');
if ($filename != '') {
    $pdf->Output($filename, 'F');
    $namePDF="_UbicaPlus";
    $transUnion = new TransUnion();
    $transUnion->savePDFTU($bckid, $dataTU->Tercero->NumeroIdentificacion, $filename, $namePDF);
}


