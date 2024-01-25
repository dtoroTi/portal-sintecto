<?php

$resultValComercial = $backgroundCheck->getVerificationSection(55)->resultId;
if($resultValComercial == 2 ){
    $resultComercial = "SH";
} else {      
    $resultComercial = "CH";
};

$resultValOpeJur = $backgroundCheck->getVerificationSection(54)->resultId;

if($resultValOpeJur == 2 ){
    $resultOpeJur = "SH";
} else {      
    $resultOpeJur = "CH";
};

$resultvrestcolp = $backgroundCheck->getVerificationSection(24)->resultId;

if($resultvrestcolp == 2 ){
    $resultvalcolprestric = "SH";
} else {
    $resultvalcolprestric = "CH";
};

// RESULTADOS
$pdf->Cell('', '', '', '', 1, 'L');
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255); // TITULO AZUL
$pdf->MultiCell(56.6, 0, "R. DOCUMENTAL"  , 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(56.6, 0, "LISTAS REST."  , 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(56.6, 0, "V. COMERCIAL"  , 0, 'C', 1, 1, '', '', true);

$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(255); $pdf->SetTextColor(0); // TITULO AZUL
if ($resultOpeJur == "SH" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(56.6, 0, $resultOpeJur  , 1, 'C', 1, 0, '', '', true);
if ($resultvalcolprestric == "SH" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(56.6, 0, $resultvalcolprestric  , 1, 'C', 1, 0, '', '', true);
if ($resultComercial == "SH" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(56.6, 0, $resultComercial  , 1, 'C', 1, 1, '', '', true);
$pdf->Cell('', '', '', '', 1, 'L');

    // CONCEPTO FINAL
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
                    . 'se puede concluir que el solicitante CUMPLE los requisitos, '.
                    ' lineamientos y políticas establecidas por Colpensiones.';
            $resultString = "APTO";
        } elseif ($backgroundCheck->resultId == Result::NO_FAVORABLE) {
            $finalComments = 'Realizada la Evaluación de la Empresa '
                    . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                    . 'se puede concluir que el solicitante NO CUMPLE los requisitos, '.
                    ' lineamientos y políticas establecidas por Colpensiones.';
            $resultString = "NO APTO";
        } else {
            $finalComments = ' ************    ESTE ESTUDIO NO TIENE RESULTADO AUN  *********** ';
            $resultString = "NO TIENE RESULTADO AUN";
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


    //VERIFICACIÓN OPERATIVA Y JURIDICA
    $pdf->AddPage();
    $pdf->SetY(25);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255); // TITULO AZUL
    $pdf->MultiCell(170, 16, "VERIFICACIÓN OPERATIVA Y JURIDICA"  , 0, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Formulario de Solicitud Conmutación Pensional Comercial"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocConmutacion_1'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocConmutacion_1']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Formulario de Conocimiento del Cliente"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocConmutacion_2'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocConmutacion_2']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Fotocopia de la cédula del Representante Legal"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocConmutacion_3'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocConmutacion_3']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Certificado de Existencia y Representación Legal de la Cámara de Comercio"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocConmutacion_4'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocConmutacion_4']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Fotocopia RUT vigente"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocConmutacion_5'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocConmutacion_5']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Certificación pago de aportes a seguridad social y parafiscales del último mes"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocConmutacion_9'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocConmutacion_9']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Pacto de integridad"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocConmutacion_10'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocConmutacion_10']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Acta de Nombramiento como Representante Legal"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocConmutacion_11'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocConmutacion_11']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Resolución de facultades específicas"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocConmutacion_12'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocConmutacion_12']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255); // TITULO AZUL
    $pdf->MultiCell(170, 16, "VERIFICACIÓN FINANCIERA"  , 0, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Balance y Estado de Resultados del último año firmados por R. L., Contador y R. F."  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocConmutacion_6'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocConmutacion_6']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Fotocopia legible de la Tarjeta Profesional Contador, Revisor Fiscal"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocConmutacion_7'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocConmutacion_7']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Certificado de Antecedentes Disciplinarios del Contador o Revisor Fiscal"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocConmutacion_8'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocConmutacion_8'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->Cell('', '', '', '', 1, 'L');

    $ansComments = $backgroundCheck->getVerificationSection(54)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    // $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor(0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfValidacionListasRestrictivas.php');

    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfLAFT.php');

    $pdf->AddPage();
    $pdf->SetY(25);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255); // TITULO AZUL
    $pdf->MultiCell(170, 16, "VERIFICACIÓN COMERCIAL"  , 0, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Antigüedad de la empresa"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['commercialVisit_1']  , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "Objeto Social"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);
    $pdf->MultiCell(170, 0, $sectionCompanyVisit->socialObject  , 1, 'L', 1, 1, '', '', true);
        
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "Servicios y/o productos"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);
    $pdf->MultiCell(170, 0, $sectionCompanyVisit->services  , 1, 'L', 1, 1, '', '', true);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "Reseña Histórica"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);
    $pdf->MultiCell(170, 0, $sectionCompanyVisit->companyHistory  , 1, 'L', 1, 1, '', '', true);
    $ansComments = $backgroundCheck->getVerificationSection(17)->comments;
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);


    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Ciudad"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCity_1']  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Sedes"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCityLoc_1']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Ciudad"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCity_2']  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Sedes"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCityLoc_2']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Ciudad"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCity_3']  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Sedes"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCityLoc_3']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Ciudad"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCity_4']  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Sedes"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCityLoc_4']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Sedes en otras Ciudades"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCityLoc_5']  , 1, 'C', 1, 0, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(42.5, 0, "Total de sedes"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $commercialVisitCityLocTotal  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);


    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "Modalidad comercial"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);
    $pdf->MultiCell(170, 0, $XMLQuestionResult['commercialVisit_2']  , 1, 'L', 1, 1, '', '', true);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Tiene página web, redes sociales"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['commercialVisit_3']  , 1, 'C', 1, 1, '', '', true);


    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "Redes sociales"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(170, 0, $XMLQuestionResult['commercialVisit_4']  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Número de clientes"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['commercialVisit_5']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "Descripción locativa (aviso, publicidad, equipos de cómputo, muebles, equipos de comunicación)"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(170, 0, $XMLQuestionResult['commercialVisit_8']  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Oficina propia o arrendada"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['commercialVisit_9']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    if ($backgroundCheck->studyStartedOn>'2020-06-19'){

        $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(170, 0, "Entidad que ejerce la supervisión, vigilancia y control"  , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor(255);
        $pdf->MultiCell(170, 0, $XMLQuestionResult['commercialVisit_17']  , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    }

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "Funcionario que atendió la visita"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(170, 0, $XMLQuestionResult['commercialVisit_12']  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "Cargo del funcionario que atendió la visita"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(170, 0, $XMLQuestionResult['commercialVisit_13']  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "Lugar de la visita"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(170, 0, $XMLQuestionResult['commercialVisit_14']  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "Fecha y hora de la visita"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(170, 0, $XMLQuestionResult['commercialVisit_15']  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->Cell('', '', '', '', 1, 'L');

    $ansComments = $backgroundCheck->getVerificationSection(55)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor(0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_colpensiones/_pdfEmpleados.php');