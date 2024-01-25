<?php
    
    $resultValFinanciero = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->resultId;
    //Concepto final fianaciero colpensiones en blanco --  habilitar codigo para el hallazgo o sin hallazgo
  /*  if($resultValFinanciero == 2 ){
        $resultFinanciero = "SH";
    } else{
        $resultFinanciero = "CH";
    };*/
    $resultFinanciero = "";
    
    $resultValComercial = $backgroundCheck->getVerificationSection(51)->resultId;
    $resultValClientes = $backgroundCheck->getVerificationSection(13)->resultId;
    $resultValEmpleados = $backgroundCheck->getVerificationSection(18)->resultId;
    $resultValVisitaEmpresa = $backgroundCheck->getVerificationSection(17)->resultId;
//if ($backgroundCheck->customerProductId == 3096 ) {

 //   $resultComercial = "";
//}else{
            if(
                $resultValComercial == 2 &&
                $resultValClientes == 2 &&
                $resultValEmpleados == 2 &&
                $resultValVisitaEmpresa == 2
            ){
                $resultComercial = "SH";
            } else {
                $resultComercial = "CH";
            };
  //  }

    $resultValOpe = $backgroundCheck->getVerificationSection(49)->resultId;
    if($resultValOpe == 2){
        $resultOpe = "SH";
    } else {      
        $resultOpe = "CH";
    };
    
    
    $resultValSocios = $backgroundCheck->getVerificationSection(15)->resultId;
    $resultValJur = $backgroundCheck->getVerificationSection(75)->resultId;
    if(
        $resultValJur == 2 && 
        (   
            $XMLQuestionResult['OfacYOnu'] == "NO" ||
            $XMLQuestionResult['OfacYOnu'] == "N/A"
        ) && (
            $shareholder->appearsInClintonsList == 0 ||
            $shareholder->appearsInClintonsList == 2
        )
        ){
       $resultJur = "SH";
    } else {      
        $resultJur = "CH";
    };
    $listasrestrictivas2 = $backgroundCheck->getVerificationSection(24)->resultId;
    if(
        $resultValSocios == 2 && $resultValOpe == 2 && $listasrestrictivas2== 2
    ){
        $resultVSO = "SH";
    }
    else{
        $resultVSO = "CH";
}


    // RESULTADOS
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255); // TITULO AZUL
    $pdf->MultiCell(42.5, 0, "OPERATIVO"  , 0, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "JURÍDICO"  , 0, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "FINANCIERO"  , 0, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "COMERCIAL"  , 0, 'C', 1, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetFillColor(255); $pdf->SetTextColor(0); // TITULO AZUL
    
    //SEPARAR
    if ($resultVSO == "SH" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(42.5, 0, $resultVSO  , 1, 'C', 1, 0, '', '', true);
    if ($resultJur == "SH" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(42.5, 0, $resultJur  , 1, 'C', 1, 0, '', '', true);
    
    if ($resultFinanciero == "SH" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(42.5, 0, $resultFinanciero  , 1, 'C', 1, 0, '', '', true);
    if ($resultComercial == "SH" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(42.5, 0, $resultComercial  , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    
    // CONCEPTO FINAL
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "CONCEPTO FINAL"  , 1, 'C', 1, 0, '', '', true);
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
    
    //VERIFICACIÓN OPERATIVA
    $pdf->AddPage();
    $pdf->SetY(25);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255); // TITULO AZUL
    $pdf->MultiCell(170, 16, "VERIFICACIÓN OPERATIVA"  , 0, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Certificado RUNEOL Vigente"  , 1, 'L', 1, 0, '', '', true);

    if ($XMLQuestionResult['valDocCID_3'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    }else if ($XMLQuestionResult['valDocCID_3'] == "N/A" ) {
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_3']  , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee el formulario de conocimiento del cliente"  , 1, 'L', 1, 0, '', '', true);

    if ($XMLQuestionResult['valDocCID_11'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    }else if ($XMLQuestionResult['valDocCID_11'] == "N/A" ) {
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_11']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee el acuerdo de condiciones técnicas y operativas"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_9'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    }else if ($XMLQuestionResult['valDocCID_9'] == "N/A" ) {
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);

    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_9']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee la certificación sobre implementación y cumplimiento de SARLAFT"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_19'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    }else if ($XMLQuestionResult['valDocCID_19'] == "N/A" ) {
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_19']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee la certificación bancaria"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_12'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    }else if ($XMLQuestionResult['valDocCID_12'] == "N/A" ) {
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_12']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee listas de los accionistas o asociados"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_15'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    }else if ($XMLQuestionResult['valDocCID_15'] == "N/A" ) {
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);

    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_15']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

if ($backgroundCheck->studyStartedOn>'2020-06-19'){

    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Cámara de comercio intefior a 30 días"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_24'] == "SI" ) { $pdf->SetTextColor(0,152,0);}
    if ($XMLQuestionResult['valDocCID_24'] == "N/A" ) { $pdf->SetTextColor(0);}
    if ($XMLQuestionResult['valDocCID_24'] == "NO" ) { $pdf->SetTextColor(255,0,0);}
    $pdf->SetFont('Arial', 'B', 10);

    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_24']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
}
    $pdf->Cell('', '', '', '', 1, 'L');



    //Agregada por Jonathan

    $ansComments = $backgroundCheck->getVerificationSection(49)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255); // TITULO AZUL
    $pdf->MultiCell(170, 16, "VERIFICACIÓN JURÍDICA"  , 0, 'L', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee certificado de existencia y representación legal expedido por Cámara de Comercio"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_1'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    } else if ($XMLQuestionResult['valDocCID_1'] == "N/A"){
        $pdf->SetTextColor(0);
    } else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_1']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee pacto de integridad"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_14'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    } else if ($XMLQuestionResult['valDocCID_14'] == "N/A"){
        $pdf->SetTextColor(0);
    } else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_14']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee certificado de personería jurídica (Para Asociaciones)"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_2'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    } else if ($XMLQuestionResult['valDocCID_2'] == "N/A"){
        $pdf->SetTextColor(0);
    } else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_2']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee certificado de existencia y representación legal expedido por Superintendencia"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_20'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    } else if ($XMLQuestionResult['valDocCID_20'] == "N/A"){
        $pdf->SetTextColor(0);
    } else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_20']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee certificado de existencia patromonio autónomo expedio por entidad admnistradora"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_21'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    } else if ($XMLQuestionResult['valDocCID_21'] == "N/A"){
        $pdf->SetTextColor(0);
    } else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_21']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee contrato de Fiducia Mercantil"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_22'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    } else if ($XMLQuestionResult['valDocCID_22'] == "N/A"){
        $pdf->SetTextColor(0);
    } else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_22']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee el acta de posesión del Representante Legal"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_18'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    } else if ($XMLQuestionResult['valDocCID_18'] == "N/A"){
        $pdf->SetTextColor(0);
    } else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_18']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee certificado de vigilancia expedido por Superintendencia"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_13'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    } else if ($XMLQuestionResult['valDocCID_13'] == "N/A"){
        $pdf->SetTextColor(0);
    } else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_13']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee RUT - Registro único tributario"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_6'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    } else if ($XMLQuestionResult['valDocCID_6'] == "N/A"){
        $pdf->SetTextColor(0);
    } else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_6']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee fotocopia del documento de identidad del Gerente y/o RL"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_7'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    } else if ($XMLQuestionResult['valDocCID_7'] == "N/A"){
        $pdf->SetTextColor(0);
    } else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_7']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee fotocopia del documento de identidad de los representantes legales autorizados"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_8'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    } else if ($XMLQuestionResult['valDocCID_8'] == "N/A"){
        $pdf->SetTextColor(0);
    } else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_8']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->MultiCell(140, 0, "Posee la certificación de cumplimiento e implementación de políticas SARLAFT"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_16'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    }else if ($XMLQuestionResult['valDocCID_16'] == "N/A" ) {
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_16']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->Cell('', '', '', '', 1, 'L');

    $ansComments = $backgroundCheck->getVerificationSection(75)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');


  
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfValidacionListasRestrictivas.php');
    
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfLAFT.php');

    //VERIFICACIÓN FINANCIERA
    $pdf->AddPage();
    $pdf->SetY(25);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255); // TITULO AZUL
    $pdf->MultiCell(170, 16, "VERIFICACIÓN FINANCIERA"  , 0, 'L', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee fotocopia de las tarjetas profesionales del contador y/o revisor fiscal"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_5'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_5']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee certificado de antecedentes disciplinarios del contador y/o Revisor Fiscal expedido por la Junta Central de Contadores"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_17'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_17']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    /*
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee RUT - Registro único tributario"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_6'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_6']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    */ 
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Presentó los estados financieros a la Supertintendencia de Sociedades o Superintendencia Solidaria"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_23'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_23']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Posee la declaración de renta del último año gravable"  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_10'] == "SI" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_10']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(140, 0, "Estados financieros comparativos certificados de los dos últimos ejercicios "  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['valDocCID_4'] == "SI" ) {
        $pdf->SetTextColor(0,152,0);
    } else if ($XMLQuestionResult['valDocCID_4'] == "N/A"){
        $pdf->SetTextColor(0);
    } else{
        $pdf->SetTextColor(255,0,0);
    };
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(30, 0, $XMLQuestionResult['valDocCID_4']  , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_colpensiones/_pdfCompanyFinantialAnalys.php');

    //VERIFICACIÓN COMERCIAL
    $pdf->AddPage();
    $pdf->SetY(25);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255); // TITULO AZUL
    $pdf->MultiCell(170, 16, "VERIFICACIÓN COMERCIAL"  , 0, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(100, 0, "Antigüedad de la empresa"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    $pdf->MultiCell(70, 0, $XMLQuestionResult['commercialVisit_1']  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    
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
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCityLoc_1']  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Ciudad"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCity_2']  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Sedes"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCityLoc_2']  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Ciudad"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCity_3']  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Sedes"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCityLoc_3']  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Ciudad"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCity_4']  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Sedes"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCityLoc_4']  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    
     
    if ($pdf->GetY() >= 255 ){
        $pdf->addPage();
        $pdf->setY(25);
    }

    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(42.5, 0, "Sedes en otras Ciudades"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $XMLQuestionResult['commercialVisitCityLoc_5']  , 1, 'C', 1, 0, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(42.5, 0, "Total de sedes"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(42.5, 0, $commercialVisitCityLocTotal  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);


    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "Modalidad comercial"  , 1, 'L', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

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
    $pdf->MultiCell(170, 0, "¿Maneja acuerdos de seguridad con clientes?"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(170, 0, $XMLQuestionResult['commercialVisit_6']  , 1, 'L', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');


    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "¿Cuáles son los requisitos que deben cumplir las empresas para ser clientes?"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);    
    $pdf->MultiCell(170, 0, $XMLQuestionResult['commercialVisit_7']  , 1, 'L', 1, 1, '', '', true);
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
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "Otros convenios de libranza que manejen y antigüedad de estos"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);
    $pdf->MultiCell(170, 0, $XMLQuestionResult['commercialVisit_10']  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    
    $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "Plazo promedio de sus créditos de libranza y cantidad de créditos de libranzas activos con Colpensiones"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);
    $pdf->MultiCell(170, 0, $XMLQuestionResult['commercialVisit_11']  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    if ($backgroundCheck->studyStartedOn>'2020-06-19'){

        $pdf->SetFillColor(230);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(170, 0, "Entidad que ejerce la supervisión, vigilancia y control"  , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor(255);
        $pdf->MultiCell(170, 0, $XMLQuestionResult['commercialVisit_16']  , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor(255);  $pdf->SetTextColor(0);$pdf->SetFont('Arial', '', 10);

    }

    $pdf->addPage();
    $pdf->setY(25);

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

    // $pdf->Cell('', '', '', '', 1, 'L');

    


    $pdf->Cell('', '', '', '', 1, 'L');
    
    $ansComments = $backgroundCheck->getVerificationSection(51)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    //REFERENCIAS COMERCIALES

    // $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255); // TITULO AZUL
    
    $pdf->MultiCell(170, 0, "Referencias Comerciales de Clientes" , 0, 'L', 1, 1, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
foreach ($sectionCompanyCustomer as $customer) {
    $pdf->SetFillColor($bgGray);
    $pdf->MultiCell(42.5, 0, "Razón Social" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(127.5, 0, $customer->companyName , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor($bgGray);
    $pdf->MultiCell(42.5, 0, "Contacto" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(127.5, 0, $customer->contactName , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor($bgGray);
    $pdf->MultiCell(42.5, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(127.5, 0, $customer->tel , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor($bgGray);
    $pdf->MultiCell(42.5, 0, "Servicios Productos" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(127.5, 0, $customer->services , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor($bgGray);
    $pdf->MultiCell(42.5, 0, "Antigüedad Proveedor" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(127.5, 0, $customer->relationAge , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor($bgGray);
    $pdf->MultiCell(42.5, 0, "Entrega" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "Servicio" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "Respuesta PQR" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "Precio" , 1, 'C', 1, 1, '', '', true);

    $qualification= array(
        0 =>  "No Aplica",
        1 => "Malo",
        2 => "Regular",
        3 => "Bueno",
        4 => "Excelente"

    );

    $pdf->SetFillColor($bgWhite);
    $pdf->MultiCell(42.5, 0, $qualification[$customer->deliveryCompliance] , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $qualification[$customer->productsQuality] , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $qualification[$customer->postSalesService] , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $qualification[$customer->prices] , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
}

$ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');



    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_colpensiones/_pdfEmpleados.php');