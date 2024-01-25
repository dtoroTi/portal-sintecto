<?php

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "RESUMEN DE EVALUACIÓN"  , 0, 'C', 1, 1, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 7); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->MultiCell(28.3, 0, "CLIENTES"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "PROVEEDORES"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "SOCIOS"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "CENTRALES"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "FINANCIERO"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "LISTAS"  , 1, 'C', 1, 1, '', '', true);

    ; $pdf->SetFillColor(255);

    if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->resultId == 2 ) {
        $ansClientes = "SH";
    } else{
        $ansClientes = "CH";
    }
    if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_PROVIDER)->resultId == 2 ) {
        $ansProveedores = "SH";
    } else{
        $ansProveedores = "CH";
    }
    
    if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER)->resultId == 2 ) {
        $ansSocios = "SH";
    } else{
        $ansSocios = "CH";
    }
    
    if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE)->resultId == 2 ) {
        $ansCentrales = "SH";
    } else{
        $ansCentrales = "CH";
    }
    
    if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->resultId == 2 ) {
        $ansFinanciero = "SH";
    } else{
        $ansFinanciero = "CH";
    }
    
    if ($backgroundCheck->getVerificationSection(24)->resultId == 2 ) {
        $ansListas = "SH";
    } else{
        $ansListas = "CH";
    }
    
    if ($ansClientes == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $ansClientes  , 1, 'C', 1, 0, '', '', true);
    
    if ($ansProveedores == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $ansProveedores  , 1, 'C', 1, 0, '', '', true);
    
    if ($ansSocios == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $ansSocios  , 1, 'C', 1, 0, '', '', true);
    
    if ($ansCentrales == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $ansCentrales  , 1, 'C', 1, 0, '', '', true);
    
    if ($ansFinanciero == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $ansFinanciero  , 1, 'C', 1, 0, '', '', true);
    
    if ($ansListas == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $ansListas  , 1, 'C', 1, 1, '', '', true);



$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(170, 0, "CONCEPTO FINAL"  , 0, 'C', 1, 0, '', '', true);
$pdf->SetTextColor(0,0,0);
$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetFont('Arial', '', 12);

// Always use the Result Ignore the comments
if (true || trim($backgroundCheck->comments) == "") {
    if ($backgroundCheck->resultId == Result::FAVORABLE) {
        $finalComments = 'Realizada la Evaluación de la Empresa '
                . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                . 'se puede concluir que bajo la Evaluación de Riesgo NO '
                . 'presenta ningún aspecto que amerite emitir un concepto '
                . 'negativo para su contratación, de acuerdo con las '
                . 'actividades que puede desarrollar según su Objeto Social.';
    } elseif ($backgroundCheck->resultId == Result::NO_FAVORABLE) {
        $finalComments = 'Realizada la Evaluación de la Empresa '
        . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                . 'se puede concluir que bajo la Óptica de Seguridad Presenta '
                . 'aspectos que ameritan emitir un concepto No Favorable '
                . 'para su contratación, de acuerdo con las actividades '
                . 'que puede desarrollar según su Objeto Social.';
            } else {
        $finalComments = ' ************    ESTE ESTUDIO NO TIENE RESULTADO AUN  *********** ';
    }
} else {
    $finalComments = $backgroundCheck->comments;
}

    $pdf->MultiCell(171, '', $finalComments, 0, 'J', FALSE, TRUE);

    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetX(80);

    if ($backgroundCheck->approved && $backgroundCheck->approved->signature) {
        $imageFile = $backgroundCheck->approved->signature->getImageFileSized(460, 120);
        $x = $pdf->getX();
        $y = $pdf->getY();
        $imageSize = getimagesize($imageFile);
        if ($imageSize[0] < 460) {
            $xdif = 0.5 + 460 / $imageSize[0] * 8;
        } else {
            $xdif = 0.5;
        }
        $pdf->Image($imageFile, $x + $xdif, $y - 17, -180);
        unlink($imageFile);
        $pdf->setXY($x, $y);
    }

    $pdf->Cell(66, '', ($backgroundCheck->approved ? $backgroundCheck->approved->name : 'PENDIENTE DE APROBACIÓN'), "T", 1, 'C', 0);


    // VALIDACIÓN EN LISTAS RESTRICTIVAS
    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfValidacionListasRestrictivas.php');

    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfLAFT.php');

    $pdf->AddPage();
    $pdf->SetY(30);

    // REFERENCIAS COMERCIALES
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "INFORMACIÓN COMERCIAL" , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfCompanyClients.php');
    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfCompanyProviders.php');
    
    // ANALISIS FINANCIERO
    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_uniandes/_pdfCompanyFinantialAnalys.php');
    
    // ANALISIS CENTRALES DE RIESGO
    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfCompanyFinance.php');