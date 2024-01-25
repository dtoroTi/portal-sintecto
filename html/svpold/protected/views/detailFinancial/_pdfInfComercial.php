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

$pdf->SetDrawColor(255);
$pdf->SetFont('Arial','B',20);
$pdf->SetTextColor(116,115,115);
$pdf->MultiCell(190, 7, "Información Comercial", 0, 'C', 0, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(190, 7, $dataTU->Tercero->Entidad, 0, 'R', 0, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->MultiCell(164,7, date('d/m/Y H:i:s'), 0, 'R', 0, 0, '', '', true);


$pdf->SetY(40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);

$pdf->MultiCell(190, 0, "RESULTADO CONSULTA INFORMACIÓN COMERCIAL"  , 1, 'C', 1, 0, '', '', true);
$pdf->Ln(5);
$pdf->MultiCell(190, 0, "Información Básica del Cliente"  , 1, 'C', 1, 0, '', '', true);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0, '', '', 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 6);
$pdf->SetFillColor(230,230,230);
$pdf->MultiCell(50,7, 'TIPO DE IDENTIFICACIÓN', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(50,7, $dataTU->Tercero->TipoIdentificacion, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'EST DOCUMENTO', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(20,7, $dataTU->Tercero->Estado, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'FECHA', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40,7, $dataTU->Tercero->Fecha, 0, 'L', 0, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->MultiCell(50,7, 'No. IDENTIFICACIÓN', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(50,7, $dataTU->Tercero->NumeroIdentificacion, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'FECHA EXP.', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(20,7, $dataTU->Tercero->FechaExpedicion, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'HORA', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40,7, $dataTU->Tercero->Hora, 0, 'L', 0, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->MultiCell(50,7, 'NOMBRE Y APELLIDOS-RAZÓN SOCIAL', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(50,7, $dataTU->Tercero->NombreTitular, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'LUGAR EXP.', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(20,7, $dataTU->Tercero->LugarExpedicion, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'USUARIO', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40,7, $dataTU->Tercero->Entidad, 0, 'L', 0, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->MultiCell(50,7, 'ACTIVIDAD ECONOMICA-CIIU', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(50,7, $dataTU->Tercero->CodigoCiiu, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'RANGO EDAD PROBABLE', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(20,7, $dataTU->Tercero->RangoEdad, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(20,7, 'No.INFORME', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40,7, $dataTU->Tercero->NumeroInforme, 0, 'L', 0, 0, '', '', true);


$pdf->SetTextColor(160,152,152);
$pdf->SetMargins('15', '15');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(190,7, '*Todos los valores de la consulta estan expresados en miles de pesos', 0, 'L', 0, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->MultiCell(190,7, '*Se presenta reporte negativo cuando la(s) persona(s) naturales y juridicas efectivamente se encuentran en mora en sus cuotas u obligaciones', 0, 'L', 0, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->MultiCell(190,7, '*Se presenta reporte positivo cuando la(s) persona(s) naturales o juridicas se encuentran al día en sus obligaciones', 0, 'L', 0, 0, '', '', true);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetTextColor(17, 35, 117);
$pdf->MultiCell(190, 0, "RESUMEN DE ENDEUDAMIENTO"  , 0, 'C', 0, 0, '', '', true);
$pdf->SetTextColor(0,0,0);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(190, 0, "RESUMEN DE OBLIGACIONES (COMO PRINCIPAL)"  , 1, 'C', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 6);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(30,3, '', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(50,7, 'TOTALES', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(50,7, 'OBLIGACIONES AL DÍA', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(60,7, 'OBLIGACIONES EN MORA', 1, 'C', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->MultiCell(30,7, 'OBLIGACIONES', 0, 'C', 1, 0, '', '', true);
//TOTALES
$pdf->MultiCell(15,7, 'CANT', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(20,7, 'SALDO TOTAL', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(15,7, 'PADE', 1, 'C', 1, 0, '', '', true);
//OBLIGACIONES AL DÍA
$pdf->MultiCell(15,7, 'CANT', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(20,7, 'SALDO TOTAL', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(15,7, 'CUOTA', 1, 'C', 1, 0, '', '', true);
//OBLIGACIONES EN MORA
$pdf->MultiCell(10,7, 'CANT', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(20,7, 'SALDO TOTAL', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(10,7, 'CUOTA', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(20,7, 'VAL EN MORA', 1, 'C', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 6);
$pdf->SetFillColor(230,230,230);
if(isset($dataTU->Tercero->Consolidado->ResumenPrincipal)){
    foreach ($dataTU->Tercero->Consolidado->ResumenPrincipal->Registro as $resp) {

        $pdf->MultiCell(30,7, $resp->PaqueteInformacion, 1, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(15,7, $resp->NumeroObligaciones, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $resp->TotalSaldo, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(15,7, $resp->ParticipacionDeuda, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(15,7, $resp->NumeroObligacionesDia, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $resp->SaldoObligacionesDia, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(15,7, $resp->CuotaObligacionesDia, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(10,7, $resp->CantidadObligacionesMora, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $resp->SaldoObligacionesMora, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(10,7, $resp->CuotaObligacionesMora, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $resp->ValorMora, 1, 'C', 0, 0, '', '', true);
        $pdf->Cell(0, '', '', 0, 1, 'L');
    }
}

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(190, 0, "RESUMEN DE OBLIGACIONES (COMO DEUDOR Y OTROS)"  , 1, 'C', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 6);
$pdf->SetFillColor(230,230,230);
if(isset($dataTU->Tercero->Consolidado->ResumenDiferentePrincipal)){
    foreach ($dataTU->Tercero->Consolidado->ResumenDiferentePrincipal->Registro as $resDP) {

        $pdf->MultiCell(30,7, $resDP->PaqueteInformacion, 1, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(15,7, $resDP->NumeroObligaciones, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $resDP->TotalSaldo, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(15,7, $resDP->ParticipacionDeuda, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(15,7, $resDP->NumeroObligacionesDia, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $resDP->SaldoObligacionesDia, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(15,7, $resDP->CuotaObligacionesDia, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(10,7, $resDP->CantidadObligacionesMora, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $resDP->SaldoObligacionesMora, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(10,7, $resDP->CuotaObligacionesMora, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $resDP->ValorMora, 1, 'C', 0, 0, '', '', true);
        $pdf->Cell(0, '', '', 0, 1, 'L');
    }
}


$pdf->Cell(3, '', '', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(190, 0, "RESUMEN TOTALES DE OBLIGACIONES"  , 1, 'C', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 6);
$pdf->SetFillColor(230,230,230);
if(isset($dataTU->Tercero->Consolidado->Registro)){
    foreach ($dataTU->Tercero->Consolidado->Registro as $respT) {

        $pdf->MultiCell(30,7, $respT->PaqueteInformacion, 1, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(15,7, $respT->NumeroObligaciones, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $respT->TotalSaldo, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(15,7, $respT->ParticipacionDeuda, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(15,7, $respT->NumeroObligacionesDia, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $respT->SaldoObligacionesDia, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(15,7, $respT->CuotaObligacionesDia, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(10,7, $respT->CantidadObligacionesMora, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $respT->SaldoObligacionesMora, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(10,7, $respT->CuotaObligacionesMora, 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20,7, $respT->ValorMora, 1, 'C', 0, 0, '', '', true);
        $pdf->Cell(0, '', '', 0, 1, 'L');
    }
}

$pdf->SetMargins('10', '10');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetTextColor(17, 35, 117);
$pdf->MultiCell(200, 0, "INFORME DETALLADO"  , 0, 'C', 0, 0, '', '', true);
$pdf->SetTextColor(0,0,0);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(200, 0, "INFORMACIÓN DE CUENTAS"  , 1, 'C', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 6);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(13,7, 'FECHA CORTE.', 1, 0, 'C', 1);
$pdf->Cell(20,7, "TIPO CONTRATO", 1, 0, 'C', 1);
$pdf->Cell(12,7, 'No. CUENTA', 1, 0, 'C', 1);
$pdf->Cell(13,7, 'ESTADO', 1, 0, 'C', 1);
$pdf->Cell(10,7, 'TIPO ENT', 1, 0, 'C', 1);
$pdf->Cell(20,7, 'ENTIDAD', 1, 0, 'C', 1);
$pdf->Cell(15,7, 'CIUDAD', 1, 0, 'C', 1);
$pdf->Cell(24,7, 'SUCURSAL', 1, 0, 'C', 1);
$pdf->Cell(15,7, 'FECHA APERTURA', 1, 0, 'C', 1);
$pdf->Cell(15,7, 'CUPO SOBREGIRO', 1, 0, 'C', 1);
$pdf->Cell(10,7, 'DÍAS AUTOR', 1, 0, 'C', 1);
$pdf->Cell(15,7, 'FECHA PERMNCIA', 1, 0, 'C', 1);
$pdf->Cell(18,7, 'CHEQ DEVLT ULT MES', 1, 0, 'C', 1);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(160,152,152);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(200, 0, "ESTADO: VIGENTES"  , 1, 'L', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 6);
$pdf->SetFillColor(230,230,230);
if(isset($dataTU->Tercero->CuentasVigentes)){
    foreach ($dataTU->Tercero->CuentasVigentes->Obligacion as $oblg) {

        $pdf->Cell(13,7, $oblg->FechaCorte, 1, 0, 'L', 1);
        $pdf->Cell(20,7, $oblg->TipoContrato, 1, 0, 'C', 1);
        $pdf->Cell(12,7, $oblg->NumeroObligacion, 1, 0, 'C', 1);
        $pdf->Cell(13,7, $oblg->EstadoObligacion, 1, 0, 'C', 1);
        $pdf->Cell(10,7, $oblg->TipoEntidad, 1, 0, 'C', 1);
        $pdf->Cell(20,7, $oblg->NombreEntidad, 1, 0, 'C', 1);
        $pdf->Cell(15,7, $oblg->Ciudad, 1, 0, 'C', 1);
        $pdf->Cell(24,7, $oblg->Sucursal, 1, 0, 'C', 1);
        $pdf->Cell(15,7, $oblg->FechaApertura, 1, 0, 'C', 1);
        $pdf->Cell(15,7, '', 1, 0, 'C', 1);
        $pdf->Cell(10,7, $oblg->DiasCartera, 1, 0, 'C', 1);
        $pdf->Cell(15,7, $oblg->FechaPermanencia, 1, 0, 'C', 1);
        $pdf->Cell(18,7, $oblg->ChequesDevueltos, 1, 0, 'C', 1);
        $pdf->Cell(0, '', '', 0, 1, 'L');
    }
}
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(160,152,152);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(200, 0, "ESTADO: NO VIGENTES"  , 1, 'L', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 6);
$pdf->SetFillColor(230,230,230);
if(isset($dataTU->Tercero->CuentasExtinguidas)){
    foreach ($dataTU->Tercero->CuentasExtinguidas->Obligacion as $oblgEx) {

        $pdf->Cell(13,7, $oblgEx->FechaCorte, 1, 0, 'L', 1);
        $pdf->Cell(20,7, $oblgEx->TipoContrato, 1, 0, 'C', 1);
        $pdf->Cell(12,7, $oblgEx->NumeroObligacion, 1, 0, 'C', 1);
        $pdf->Cell(13,7, $oblgEx->EstadoObligacion, 1, 0, 'C', 1);
        $pdf->Cell(10,7, $oblgEx->TipoEntidad, 1, 0, 'C', 1);
        $pdf->Cell(20,7, $oblgEx->NombreEntidad, 1, 0, 'C', 1);
        $pdf->Cell(15,7, $oblgEx->Ciudad, 1, 0, 'C', 1);
        $pdf->Cell(24,7, $oblgEx->Sucursal, 1, 0, 'C', 1);
        $pdf->Cell(15,7, $oblgEx->FechaApertura, 1, 0, 'C', 1);
        $pdf->Cell(15,7, '', 1, 0, 'C', 1);
        $pdf->Cell(10,7, $oblgEx->DiasCartera, 1, 0, 'C', 1);
        $pdf->Cell(15,7, $oblgEx->FechaPermanencia, 1, 0, 'C', 1);
        $pdf->Cell(18,7, $oblgEx->ChequesDevueltos, 1, 0, 'C', 1);
        $pdf->Cell(0, '', '', 0, 1, 'L');
    }
}

$pdf->Cell(10, '', '', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(200, 0, "INFORMACIÓN ENDEUDAMIENTO EN SECTORES FINANCIERO, ASEGURADOR Y SOLIDARIO"  , 1, 'C', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 6);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(13, '', 'FECHA CORTE.', 1, 0, 'C', 1);
$pdf->Cell(8, '', 'MODA', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'No. OBLIG', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'TIPO ENT', 1, 0, 'C', 1);
$pdf->Cell(20, '', 'NOMBRE ENTIDAD', 1, 0, 'C', 1);
$pdf->Cell(9, '', 'CIUDAD', 1, 0, 'C', 1);
$pdf->Cell(5, '', 'CAL', 1, 0, 'C', 1);
$pdf->Cell(5, '', 'MRC', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'TIPO GAR', 1, 0, 'C', 1);
$pdf->Cell(9, '', 'F.INICIO', 1, 0, 'C', 1);
$pdf->Cell(15, '', 'No. CUOTAS', 1, 0, 'C', 1);
$pdf->Cell(17, '', 'CUPO APROB VLR INIC', 1, 0, 'C', 1);
$pdf->Cell(19, '', 'PAGO MINIM VLR CUOTA', 1, 0, 'C', 1);
$pdf->Cell(9, '', 'SIT OBLIG', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'NATU REES', 1, 0, 'C', 1);
$pdf->Cell(8, '', 'No. REE', 1, 0, 'C', 1);
$pdf->Cell(8, '', 'TIP PAG', 1, 0, 'C', 1);
$pdf->Cell(15, '', 'F PAGO F EXTIN', 1, 0, 'C', 1);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->Cell(13, '', '', 1, 0, 'C', 1);
$pdf->Cell(8, '', '', 1, 0, 'C', 1);
$pdf->Cell(10, '', '', 1, 0, 'C', 1);
$pdf->Cell(10, '', '', 1, 0, 'C', 1);
$pdf->Cell(20, '', '', 1, 0, 'C', 1);
$pdf->Cell(9, '', '', 1, 0, 'C', 1);
$pdf->Cell(5, '', '', 1, 0, 'C', 1);
$pdf->Cell(5, '', '', 1, 0, 'C', 1);
$pdf->Cell(10, '', '', 1, 0, 'C', 1);
$pdf->Cell(9, '', '', 1, 0, 'C', 1);
$pdf->Cell(5, '', 'PAC', 1, 0, 'C', 1);
$pdf->Cell(5, '', 'PAG', 1, 0, 'C', 1);
$pdf->Cell(5, '', 'MOR', 1, 0, 'C', 1);
$pdf->Cell(17,'', '', 1, 0, 'C', 1);
$pdf->Cell(19,'', '', 1, 0, 'C', 1);
$pdf->Cell(9, '', '', 1, 0, 'C', 1);
$pdf->Cell(10,'', '', 1, 0, 'C', 1);
$pdf->Cell(8, '', '', 1, 0, 'C', 1);
$pdf->Cell(8, '', '', 1, 0, 'C', 1);
$pdf->Cell(15,'', '', 1, 0, 'C', 1);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->Cell(7, '', 'TIPO CONT', 1, 0, 'C', 1);
$pdf->Cell(6, '', 'PADE', 1, 0, 'C', 1);
$pdf->Cell(8, '', 'LCRE', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'EST CONTR', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'CLF', 1, 0, 'C', 1);
$pdf->Cell(20, '', 'ORIGEN CARTERA', 1, 0, 'C', 1);
$pdf->Cell(9, '', 'SUCURSAL', 1, 0, 'C', 1);
$pdf->Cell(5, '', 'EST TITU', 1, 0, 'C', 1);
$pdf->Cell(5, '', 'CLS', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'COB GAR', 1, 0, 'C', 1);
$pdf->Cell(9, '', 'F.TERM', 1, 0, 'C', 1);
$pdf->Cell(5, '', 'PER', 1, 0, 'C', 1);
$pdf->Cell(5, '', '', 1, 0, 'C', 1);
$pdf->Cell(5, '', '', 1, 0, 'C', 1);
$pdf->Cell(17,'', 'CUPO UTIL SALDO CORT', 1, 0, 'C', 1);
$pdf->Cell(19,'', '', 1, 0, 'C', 1);
$pdf->Cell(9, '', 'VALOR MORA', 1, 0, 'C', 1);
$pdf->Cell(10,'', 'REES', 1, 0, 'C', 1);
$pdf->Cell(8, '', 'MOR MAX', 1, 0, 'C', 1);
$pdf->Cell(8, '', 'MOD EXT', 1, 0, 'C', 1);
$pdf->Cell(15,'', 'F.PERMAN', 1, 0, 'C', 1);

$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(160,152,152);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(200, 0, "OBLIGACIONES AL DÍA"  , 1, 'L', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 6);
$pdf->SetFillColor(230,230,230);
if(isset($dataTU->Tercero->SectorFinancieroAlDia)){
    foreach ($dataTU->Tercero->SectorFinancieroAlDia->Obligacion as $secF) {

        $pdf->Cell(13, '', $secF->FechaCorte, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secF->ModalidadCredito, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secF->NumeroObligacion, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secF->TipoEntidad, 1, 0, 'C', 1);
        $pdf->Cell(20, '', $secF->NombreEntidad, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secF->Ciudad, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secF->Calidad, 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secF->TipoGarantia, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secF->FechaApertura, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secF->NumeroCuotasPactadas, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secF->CuotasCanceladas, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secF->NumeroCuotasMora, 1, 0, 'C', 1);
        $pdf->Cell(17, '', $secF->ValorInicial, 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secF->ValorCuota, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secF->EstadoObligacion, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secF->NaturalezaReestructuracion, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secF->NumeroReestructuracion, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secF->TipoPago, 1, 0, 'C', 1);
        $pdf->Cell(15, '', $secF->FechaPago, 1, 0, 'C', 1);
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->Cell(7, '', $secF->TipoContrato, 1, 0, 'C', 1);
        $pdf->Cell(6, '', $secF->ParticipacionDeuda, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secF->LineaCredito, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secF->EstadoContrato, 1, 0, 'C', 1);
        $pdf->Cell(10, '', '', 1, 0, 'C', 1);
        $pdf->Cell(20, '', $secF->TipoEntidadOriginadoraCartera, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secF->Sucursal, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secF->EstadoTitular, 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secF->CubrimientoGarantia, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secF->FechaTerminacion, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secF->Periodicidad, 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(17,'', $secF->SaldoObligacion, 1, 0, 'C', 1);
        $pdf->Cell(19,'', '', 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secF->ValorMora, 1, 0, 'C', 1);
        $pdf->Cell(10,'', $secF->Reestructurado, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secF->MoraMaxima, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secF->ModoExtincion, 1, 0, 'C', 1);
        $pdf->Cell(15,'', $secF->FechaPermanencia, 1, 0, 'C', 1);
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->Cell(110, '', $secF->Comportamientos, 1, 0, 'R', 1);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0,66,109);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(90, '', 'COMPORTAMIENTOS', 1, 0, 'L', 1);
        if(isset($secF->Mensajes->Mensaje)){
            $pdf->Cell(0, '', '', 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(30, '', 'MENSAJES', 1, 0, 'R', 1);
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFillColor(230,230,230);
            $pdf->Cell(170, '', $secF->Mensajes->Mensaje->Descripcion, 1, 0, 'L', 1);
        }
        if(isset($secF->Reclamos->Mensaje)){
            $pdf->Cell(0, '', '', 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(30, '', 'RECLAMOS', 1, 0, 'R', 1);
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFillColor(230,230,230);
            $pdf->Cell(170, '', $secF->Reclamos->Mensaje->Descripcion, 1, 0, 'L', 1);
        }
        $pdf->SetFont('Arial', '', 6);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFillColor(230,230,230);
        $pdf->Cell(0, '', '', 0, 1, 'L');
    }
}
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(160,152,152);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(200, 0, "OBLIGACIONES EN MORA"  , 1, 'L', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 6);
$pdf->SetFillColor(230,230,230);
if(isset($dataTU->Tercero->SectorFinancieroEnMora)){
    foreach ($dataTU->Tercero->SectorFinancieroEnMora->Obligacion as $secFM) {

        $pdf->Cell(13, '', $secFM->FechaCorte, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secFM->ModalidadCredito, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secFM->NumeroObligacion, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secFM->TipoEntidad, 1, 0, 'C', 1);
        $pdf->Cell(20, '', $secFM->NombreEntidad, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secFM->Ciudad, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secFM->Calidad, 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secFM->TipoGarantia, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secFM->FechaApertura, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secFM->NumeroCuotasPactadas, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secFM->CuotasCanceladas, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secFM->NumeroCuotasMora, 1, 0, 'C', 1);
        $pdf->Cell(17, '', $secFM->ValorInicial, 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secFM->ValorCuota, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secFM->EstadoObligacion, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secFM->NaturalezaReestructuracion, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secFM->NumeroReestructuracion, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secFM->TipoPago, 1, 0, 'C', 1);
        $pdf->Cell(15, '', $secFM->FechaPago, 1, 0, 'C', 1);
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->Cell(7, '', $secFM->TipoContrato, 1, 0, 'C', 1);
        $pdf->Cell(6, '', $secFM->ParticipacionDeuda, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secFM->LineaCredito, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secFM->EstadoContrato, 1, 0, 'C', 1);
        $pdf->Cell(10, '', '', 1, 0, 'C', 1);
        $pdf->Cell(20, '', $secFM->TipoEntidadOriginadoraCartera, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secFM->Sucursal, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secFM->EstadoTitular, 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secFM->CubrimientoGarantia, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secFM->FechaTerminacion, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secFM->Periodicidad, 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(17,'', $secFM->SaldoObligacion, 1, 0, 'C', 1);
        $pdf->Cell(19,'', '', 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secFM->ValorMora, 1, 0, 'C', 1);
        $pdf->Cell(10,'', $secFM->Reestructurado, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secFM->MoraMaxima, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secFM->ModoExtincion, 1, 0, 'C', 1);
        $pdf->Cell(15,'', $secFM->FechaPermanencia, 1, 0, 'C', 1);
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->Cell(110, '', $secFM->Comportamientos, 1, 0, 'R', 1);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0,66,109);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(90, '', 'COMPORTAMIENTOS', 1, 0, 'L', 1);
        if(isset($secFM->Mensajes->Mensaje)){
            $pdf->Cell(0, '', '', 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(30, '', 'MENSAJES', 1, 0, 'R', 1);
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFillColor(230,230,230);
            $pdf->Cell(170, '', $secFM->Mensajes->Mensaje->Descripcion, 1, 0, 'L', 1);
        }
        if(isset($secFM->Reclamos->Mensaje)){
            $pdf->Cell(0, '', '', 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(30, '', 'RECLAMOS', 1, 0, 'R', 1);
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFillColor(230,230,230);
            $pdf->Cell(170, '', $secFM->Reclamos->Mensaje->Descripcion, 1, 0, 'L', 1);
        }
        $pdf->SetFont('Arial', '', 6);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFillColor(230,230,230);
        $pdf->Cell(0, '', '', 0, 1, 'L');
    }
}
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(160,152,152);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(200, 0, "OBLIGACIONES EXTINGUIDAS"  , 1, 'L', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetFont('Arial', '', 6);
$pdf->SetFillColor(230,230,230);
if(isset($dataTU->Tercero->SectorFinancieroExtinguidas)){
    foreach ($dataTU->Tercero->SectorFinancieroExtinguidas->Obligacion as $secFE) {

        $pdf->Cell(13, '', $secFE->FechaCorte, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secFE->ModalidadCredito, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secFE->NumeroObligacion, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secFE->TipoEntidad, 1, 0, 'C', 1);
        $pdf->Cell(20, '', $secFE->NombreEntidad, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secFE->Ciudad, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secFE->Calidad, 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secFE->TipoGarantia, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secFE->FechaApertura, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secFE->NumeroCuotasPactadas, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secFE->CuotasCanceladas, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secFE->NumeroCuotasMora, 1, 0, 'C', 1);
        $pdf->Cell(17, '', $secFE->ValorInicial, 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secFE->ValorCuota, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secFE->EstadoObligacion, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secFE->NaturalezaReestructuracion, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secFE->NumeroReestructuracion, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secFE->TipoPago, 1, 0, 'C', 1);
        $pdf->Cell(15, '', $secFE->FechaPago, 1, 0, 'C', 1);
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->Cell(7, '', $secFE->TipoContrato, 1, 0, 'C', 1);
        $pdf->Cell(6, '', $secFE->ParticipacionDeuda, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secFE->LineaCredito, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secFE->EstadoContrato, 1, 0, 'C', 1);
        $pdf->Cell(10, '', '', 1, 0, 'C', 1);
        $pdf->Cell(20, '', $secFE->TipoEntidadOriginadoraCartera, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secFE->Sucursal, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secFE->EstadoTitular, 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secFE->CubrimientoGarantia, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secFE->FechaTerminacion, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secFE->Periodicidad, 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(17,'', $secFE->SaldoObligacion, 1, 0, 'C', 1);
        $pdf->Cell(19,'', '', 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secFE->ValorMora, 1, 0, 'C', 1);
        $pdf->Cell(10,'', $secFE->Reestructurado, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secFE->MoraMaxima, 1, 0, 'C', 1);
        $pdf->Cell(8, '', $secFE->ModoExtincion, 1, 0, 'C', 1);
        $pdf->Cell(15,'', $secFE->FechaPermanencia, 1, 0, 'C', 1);
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->Cell(110, '', $secFE->Comportamientos, 1, 0, 'R', 1);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0,66,109);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(90, '', 'COMPORTAMIENTOS', 1, 0, 'L', 1);
        if(isset($secFE->Mensajes->Mensaje)){
            $pdf->Cell(0, '', '', 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(30, '', 'MENSAJES', 1, 0, 'R', 1);
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFillColor(230,230,230);
            $pdf->Cell(170, '', $secFE->Mensajes->Mensaje->Descripcion, 1, 0, 'L', 1);
        }
        if(isset($secFE->Reclamos->Mensaje)){
            $pdf->Cell(0, '', '', 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(30, '', 'RECLAMOS', 1, 0, 'R', 1);
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFillColor(230,230,230);
            $pdf->Cell(170, '', $secFE->Reclamos->Mensaje->Descripcion, 1, 0, 'L', 1);
        }
        $pdf->SetFont('Arial', '', 6);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFillColor(230,230,230);
        $pdf->Cell(0, '', '', 0, 1, 'L');
    }
}

$pdf->Cell(15, '', '', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(200, 0, "INFORMACIÓN ENDEUDAMIENTO EN SECTOR REAL"  , 1, 'C', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 6);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(13, '', 'FECHA CORTE.', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'TIPO CONT', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'No. OBLIG', 1, 0, 'C', 1);
$pdf->Cell(20, '', 'NOMBRE ENTIDAD', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'CIUDAD', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'CALD', 1, 0, 'C', 1);
$pdf->Cell(9, '', 'VIG', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'CLA PER', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'F.INICIO', 1, 0, 'C', 1);
$pdf->Cell(15, '', 'No. CUOTAS', 1, 0, 'C', 1);
$pdf->Cell(19, '', 'CUPO APROB VLR INIC', 1, 0, 'C', 1);
$pdf->Cell(19, '', 'PAGO MINIM VLR CUOTA', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'SIT OBLIG', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'TIP PAG', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'REF', 1, 0, 'C', 1);
$pdf->Cell(15, '', 'F PAGO F EXTIN', 1, 0, 'C', 1);

$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->Cell(13, '', '', 1, 0, 'C', 1);
$pdf->Cell(10, '', '', 1, 0, 'C', 1);
$pdf->Cell(10, '', '', 1, 0, 'C', 1);
$pdf->Cell(20, '', '', 1, 0, 'C', 1);
$pdf->Cell(10, '', '', 1, 0, 'C', 1);
$pdf->Cell(10, '', '', 1, 0, 'C', 1);
$pdf->Cell(9, '', '', 1, 0, 'C', 1);
$pdf->Cell(10, '', '', 1, 0, 'C', 1);
$pdf->Cell(10, '', '', 1, 0, 'C', 1);
$pdf->Cell(5, '', 'PAC', 1, 0, 'C', 1);
$pdf->Cell(5, '', 'PAG', 1, 0, 'C', 1);
$pdf->Cell(5, '', 'MOR', 1, 0, 'C', 1);
$pdf->Cell(19, '', '', 1, 0, 'C', 1);
$pdf->Cell(19, '', '', 1, 0, 'C', 1);
$pdf->Cell(10, '', '', 1, 0, 'C', 1);
$pdf->Cell(10, '', '', 1, 0, 'C', 1);
$pdf->Cell(10, '', '', 1, 0, 'C', 1);
$pdf->Cell(15, '', '', 1, 0, 'C', 1);

$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->Cell(13, '', '', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'CATE LCRE', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'EST CONTR', 1, 0, 'C', 1);
$pdf->Cell(20, '', 'TIPO EMPR', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'SUCURSAL', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'EST TITU', 1, 0, 'C', 1);
$pdf->Cell(9, '', 'MES', 1, 0, 'C', 1);
$pdf->Cell(10, '', '', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'F TERM', 1, 0, 'C', 1);
$pdf->Cell(5, '', 'PER', 1, 0, 'C', 1);
$pdf->Cell(5, '', '', 1, 0, 'C', 1);
$pdf->Cell(5, '', '', 1, 0, 'C', 1);
$pdf->Cell(19, '', 'CUPO UTILI SALDO CORT', 1, 0, 'C', 1);
$pdf->Cell(19, '', 'VALOR CARGO FIJO', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'VALOR MORA', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'MOD EXT', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'MOR MAX', 1, 0, 'C', 1);
$pdf->Cell(15, '', 'F.PERMAN', 1, 0, 'C', 1);

$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(160,152,152);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(200, 0, "OBLIGACIONES VIGENTES Y AL DÍA"  , 1, 'L', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetFont('Arial', '', 6);
$pdf->SetFillColor(230,230,230);

if(isset($dataTU->Tercero->SectorRealAlDia)){
    foreach ($dataTU->Tercero->SectorRealAlDia->Obligacion as $secRD) {

        $pdf->Cell(13, '', $secRD->FechaCorte, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->TipoContrato, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->NumeroObligacion, 1, 0, 'C', 1);
        $pdf->Cell(20, '', $secRD->NombreEntidad, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->Ciudad, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->Calidad, 1, 0, 'C', 1);
        $pdf->Cell(9, '',  $secRD->Vigencia, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->ClausulaPermanencia, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->FechaApertura, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secRD->NumeroCuotasPactadas, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secRD->NumeroCuotasMora, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secRD->CuotasCanceladas, 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secRD->ValorInicial, 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secRD->ValorCuota, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->EstadoObligacion, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->TipoPago, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->Reestructurado, 1, 0, 'C', 1);
        $pdf->Cell(15, '', $secRD->FechaPago, 1, 0, 'C', 1);
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->Cell(13, '', '', 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->LineaCredito, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->EstadoContrato, 1, 0, 'C', 1);
        $pdf->Cell(20, '', $secRD->TipoEntidad, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->Sucursal, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->EstadoTitular, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secRD->NumeroMesesContrato, 1, 0, 'C', 1);
        $pdf->Cell(10, '', '', 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->FechaCorte, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secRD->Periodicidad, 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secRD->SaldoObligacion, 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secRD->ValorCargoFijo, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->ValorMora, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->ModoExtincion, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRD->MoraMaxima, 1, 0, 'C', 1);
        $pdf->Cell(15, '', $secRD->FechaPermanencia, 1, 0, 'C', 1);
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->Cell(110, '', $secRD->Comportamientos, 1, 0, 'R', 1);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0,66,109);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(90, '', 'COMPORTAMIENTOS', 1, 0, 'L', 1);
        if(isset($secRD->Mensajes->Mensaje)){
            $pdf->Cell(0, '', '', 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(30, '', 'MENSAJES', 1, 0, 'R', 1);
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFillColor(230,230,230);
            $pdf->Cell(170, '', $secRD->Mensajes->Mensaje->Descripcion, 1, 0, 'L', 1);
        }
        if(isset($secRD->Reclamos->Mensaje)){
            $pdf->Cell(0, '', '', 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(30, '', 'RECLAMOS', 1, 0, 'R', 1);
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFillColor(230,230,230);
            $pdf->Cell(170, '', $secRD->Reclamos->Mensaje->Descripcion, 1, 0, 'L', 1);
        }
        $pdf->SetFont('Arial', '', 6);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFillColor(230,230,230);
        $pdf->Cell(0, '', '', 0, 1, 'L');
    }
}

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(160,152,152);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(200, 0, "OBLIGACIONES EN MORA"  , 1, 'L', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 6);
$pdf->SetFillColor(230,230,230);

if(isset($dataTU->Tercero->SectorRealEnMora)){
    foreach ($dataTU->Tercero->SectorRealEnMora->Obligacion as $secRM) {

        $pdf->Cell(13, '', $secRM->FechaCorte, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->TipoContrato, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->NumeroObligacion, 1, 0, 'C', 1);
        $pdf->Cell(20, '', $secRM->NombreEntidad, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->Ciudad, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->Calidad, 1, 0, 'C', 1);
        $pdf->Cell(9, '',  $secRM->Vigencia, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->ClausulaPermanencia, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->FechaApertura, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secRM->NumeroCuotasPactadas, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secRM->NumeroCuotasMora, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secRM->CuotasCanceladas, 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secRM->ValorInicial, 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secRM->ValorCuota, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->EstadoObligacion, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->TipoPago, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->Reestructurado, 1, 0, 'C', 1);
        $pdf->Cell(15, '', $secRM->FechaPago, 1, 0, 'C', 1);
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->Cell(13, '', '', 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->LineaCredito, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->EstadoContrato, 1, 0, 'C', 1);
        $pdf->Cell(20, '', $secRM->TipoEntidad, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->Sucursal, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->EstadoTitular, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secRM->NumeroMesesContrato, 1, 0, 'C', 1);
        $pdf->Cell(10, '', '', 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->FechaCorte, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secRM->Periodicidad, 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secRM->SaldoObligacion, 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secRM->ValorCargoFijo, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->ValorMora, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->ModoExtincion, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRM->MoraMaxima, 1, 0, 'C', 1);
        $pdf->Cell(15, '', $secRM->FechaPermanencia, 1, 0, 'C', 1);
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->Cell(110, '', $secRM->Comportamientos, 1, 0, 'R', 1);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0,66,109);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(90, '', 'COMPORTAMIENTOS', 1, 0, 'L', 1);
        if(isset($secRM->Mensajes->Mensaje)){
            $pdf->Cell(0, '', '', 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(30, '', 'MENSAJES', 1, 0, 'R', 1);
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFillColor(230,230,230);
            $pdf->Cell(170, '', $secRM->Mensajes->Mensaje->Descripcion, 1, 0, 'L', 1);
        }
        if(isset($secRM->Reclamos->Mensaje)){
            $pdf->Cell(0, '', '', 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(30, '', 'RECLAMOS', 1, 0, 'R', 1);
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFillColor(230,230,230);
            $pdf->Cell(170, '', $secRM->Reclamos->Mensaje->Descripcion, 1, 0, 'L', 1);
        }
        $pdf->SetFont('Arial', '', 6);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFillColor(230,230,230);
        $pdf->Cell(0, '', '', 0, 1, 'L');
    }
}

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(160,152,152);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(200, 0, "OBLIGACIONES EXTINGUIDAS"  , 1, 'L', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 6);
$pdf->SetFillColor(230,230,230);

if(isset($dataTU->Tercero->SectorRealExtinguidas)){
    foreach ($dataTU->Tercero->SectorRealExtinguidas->Obligacion as $secRE) {

        $pdf->Cell(13, '', $secRE->FechaCorte, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->TipoContrato, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->NumeroObligacion, 1, 0, 'C', 1);
        $pdf->Cell(20, '', $secRE->NombreEntidad, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->Ciudad, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->Calidad, 1, 0, 'C', 1);
        $pdf->Cell(9, '',  $secRE->Vigencia, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->ClausulaPermanencia, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->FechaApertura, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secRE->NumeroCuotasPactadas, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secRE->NumeroCuotasMora, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secRE->CuotasCanceladas, 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secRE->ValorInicial, 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secRE->ValorCuota, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->EstadoObligacion, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->TipoPago, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->Reestructurado, 1, 0, 'C', 1);
        $pdf->Cell(15, '', $secRE->FechaPago, 1, 0, 'C', 1);
        $pdf->Cell(0, '', '', 0, 1, 'L');

        $pdf->Cell(13, '', '', 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->LineaCredito, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->EstadoContrato, 1, 0, 'C', 1);
        $pdf->Cell(20, '', $secRE->TipoEntidad, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->Sucursal, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->EstadoTitular, 1, 0, 'C', 1);
        $pdf->Cell(9, '', $secRE->NumeroMesesContrato, 1, 0, 'C', 1);
        $pdf->Cell(10, '', '', 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->FechaCorte, 1, 0, 'C', 1);
        $pdf->Cell(5, '', $secRE->Periodicidad, 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(5, '', '', 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secRE->SaldoObligacion, 1, 0, 'C', 1);
        $pdf->Cell(19, '', $secRE->ValorCargoFijo, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->ValorMora, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->ModoExtincion, 1, 0, 'C', 1);
        $pdf->Cell(10, '', $secRE->MoraMaxima, 1, 0, 'C', 1);
        $pdf->Cell(15, '', $secRE->FechaPermanencia, 1, 0, 'C', 1);
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->Cell(110, '', $secRE->Comportamientos, 1, 0, 'R', 1);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0,66,109);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(90, '', 'COMPORTAMIENTOS', 1, 0, 'L', 1);
        if(isset($secRE->Mensajes->Mensaje)){
            $pdf->Cell(0, '', '', 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(30, '', 'MENSAJES', 1, 0, 'R', 1);
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFillColor(230,230,230);
            $pdf->Cell(170, '', $secRE->Mensajes->Mensaje->Descripcion, 1, 0, 'L', 1);
        }
        if(isset($secRE->Reclamos->Mensaje)){
            $pdf->Cell(0, '', '', 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(30, '', 'RECLAMOS', 1, 0, 'R', 1);
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFillColor(230,230,230);
            $pdf->Cell(170, '', $secRE->Reclamos->Mensaje->Descripcion, 1, 0, 'L', 1);
        }
        $pdf->SetFont('Arial', '', 6);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFillColor(230,230,230);
        $pdf->Cell(0, '', '', 0, 1, 'L');
    }
}
$pdf->Cell(10, '', '', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(200, 7, "HUELLAS DE CONSULTA ÚLTIMOS SEIS MESES", 1, 'C', 1, 0, '', '', true);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(90,7, 'ENTIDAD', 1, 0, 'C', 1);
$pdf->Cell(30,7, 'FECHA', 1, 0, 'C', 1);
$pdf->Cell(40,7, 'SUCURSAL', 1, 0, 'C', 1);
$pdf->Cell(40,7, 'CIUDAD', 1, 0, 'C', 1);
$pdf->Cell(0, '', '', 0, 1, 'L');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 6);
$pdf->SetFillColor(230,230,230);
if(isset($dataTU->Tercero->HuellaConsulta)){
    $numero = 0;
    foreach ($dataTU->Tercero->HuellaConsulta->Consulta as $cons) {
        
        $pdf->Cell(90,7, $cons->NombreEntidad, 1, 0, 'L', 1);
        $pdf->Cell(30,7, $cons->FechaConsulta, 1, 0, 'C', 1);
        $pdf->Cell(40,7, $cons->Sucursal, 1, 0, 'C', 1);
        $pdf->Cell(40,7, $cons->Ciudad, 1, 0, 'C', 1);
        $numero =$numero+1;
        $pdf->Cell(0, '', '', 0, 1, 'L');
    }
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(160,152,152);
    $pdf->MultiCell(200,7, 'Total Consultas: '.$numero, 1, 'L', 1, 0, '', '', true);
    $pdf->Cell(0, '', '', 0, 1, 'L');
}

$pdf->Cell(10, '', '', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(230,230,230);
$pdf->MultiCell(200, 0, "********** FIN DE CONSULTA **********"  , 1, 'C', 1, 0, '', '', true);
$pdf->Cell(0, '', '', '', 1, 'L');

$filename = tempnam(Yii::app()->getRuntimePath(), 'InfComercial_');
if ($filename != '') {
    $pdf->Output($filename, 'F');
    $namePDF="_InfComercial";
    $transUnion = new TransUnion();
    $transUnion->savePDFTU($bckid, $dataTU->Tercero->NumeroIdentificacion, $filename, $namePDF);
}


