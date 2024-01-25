<?php
        $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(170, 5, "Análisis de la calificación" , 1, 'L', 1, 1, '', '', true);
        $pdf->MultiCell(170, 5, "La compañía muestra los siguientes resultados de acuerdo a los criterios de evaluación detallados a continuación" , 1, 'L', 1, 1, '', '', true);
        
        $pdf->SetFillColor(150,150,150);
        $pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(170, 5, "Items de calificación" , 1, 'L', 1, 1, '', '', true);
        
        $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(170, 5, "1. Información general" , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(120, 5, "1.1 ¿Cuenta con documento de identidad del representante legal?" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor(255,255,255);
        if ($XMLQuestionResult['proveedorInternacionalBasic_1'] == "Si Cumple" || $XMLQuestionResult['proveedorInternacionalBasic_1'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
        $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorInternacionalBasic_1'] , 1, 'C', 0, 1, '', '', true);

        $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(170, 5, "2. Aspectos legales" , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(120, 5, "2.1 ¿Cuenta con acta de constitución?" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor(255,255,255);
        if ($XMLQuestionResult['proveedorInternacionalBasic_2'] == "Si Cumple" || $XMLQuestionResult['proveedorInternacionalBasic_2'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
        $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorInternacionalBasic_2'] , 1, 'C', 0, 1, '', '', true);
        $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(120, 5, "2.2 ¿Cuenta con certificación bancaria?" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor(255,255,255);
        if ($XMLQuestionResult['proveedorInternacionalBasic_3'] == "Si Cumple" || $XMLQuestionResult['proveedorInternacionalBasic_3'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
        $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorInternacionalBasic_3'] , 1, 'C', 0, 1, '', '', true);
        //3
        $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(170, 5, "3. Formatos G.Prodeco" , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(120, 5, "3.1 ¿Cuenta con autorización para el tratamiento de datos personales?" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor(255,255,255);
        if ($XMLQuestionResult['proveedorInternacionalBasic_4'] == "Si Cumple" || $XMLQuestionResult['proveedorInternacionalBasic_4'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
        $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorInternacionalBasic_4'] , 1, 'C', 0, 1, '', '', true);
        $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(120, 5, "3.2 ¿Cuenta con carta de aceptación de términos y condiciones?" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor(255,255,255);
        if ($XMLQuestionResult['proveedorInternacionalBasic_5'] == "Si Cumple" || $XMLQuestionResult['proveedorInternacionalBasic_5'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
        $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorInternacionalBasic_5'] , 1, 'C', 0, 1, '', '', true);
        $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(120, 5, "3.3 ¿Cuenta con carta certificación de origen de recursos - SARLAFT?" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor(255,255,255);
        if ($XMLQuestionResult['proveedorInternacionalBasic_6'] == "Si Cumple" || $XMLQuestionResult['proveedorInternacionalBasic_6'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
        $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorInternacionalBasic_6'] , 1, 'C', 0, 1, '', '', true);
        //4
        $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(170, 5, "4. Validación en Listas Restrictivas" , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(120, 5, "4.1 ¿Presenta coincidencia?" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor(255,255,255);

    if ($backgroundCheck->studyStartedOn<'2020-04-02'){

        if ($XMLQuestionResult['proveedorInternacionalBasic_7'] == "No presenta coincidencia" && $listasEmpresasResult_SM == "SH") {
            $pdf->SetTextColor(0,152,0);
            $XMLQuestionResult['proveedorInternacionalBasic_7'] = "No presenta coincidencia";
            $proveedorInternacionalBasic_7 = "No presenta coincidencia";
        } else {
            $pdf->SetTextColor(255,0,0);
            $XMLQuestionResult['proveedorInternacionalBasic_7'] = "Presenta coincidencia";
            $proveedorInternacionalBasic_7 =  "Presenta coincidencia";
        }

    }
    else{

        if ($XMLQuestionResult['proveedorInternacionalBasic_7'] == "No presenta coincidencia" && $listasEmpresasResult == "SH") {
            $pdf->SetTextColor(0,152,0);
            $XMLQuestionResult['proveedorInternacionalBasic_7'] = "No presenta coincidencia";
            $proveedorInternacionalBasic_7 = "No presenta coincidencia";
        } else {
            $pdf->SetTextColor(255,0,0);
            $XMLQuestionResult['proveedorInternacionalBasic_7'] = "Presenta coincidencia";
            $proveedorInternacionalBasic_7 =  "Presenta coincidencia";
        }


    }
        $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorInternacionalBasic_7'] , 1, 'C', 0, 1, '', '', true);
        $pdf->MultiCell(170, 5, " " , 0, 'L', 0, 1, '', '', true);
        
        $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(120, 5, "Puntaje Obtenido" , 1, 'C', 1, 0, '', '', true);
        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
       
    // RESULTADO 
    if (
        ($XMLQuestionResult['proveedorInternacionalBasic_1'] == 'Si Cumple' || $XMLQuestionResult['proveedorInternacionalBasic_1'] == 'N/A') &&
        ($XMLQuestionResult['proveedorInternacionalBasic_2'] == 'Si Cumple' || $XMLQuestionResult['proveedorInternacionalBasic_2'] == 'N/A') &&
        ($XMLQuestionResult['proveedorInternacionalBasic_3'] == 'Si Cumple' || $XMLQuestionResult['proveedorInternacionalBasic_3'] == 'N/A') &&
        ($XMLQuestionResult['proveedorInternacionalBasic_4'] == 'Si Cumple' || $XMLQuestionResult['proveedorInternacionalBasic_4'] == 'N/A') &&
        ($XMLQuestionResult['proveedorInternacionalBasic_5'] == 'Si Cumple' || $XMLQuestionResult['proveedorInternacionalBasic_5'] == 'N/A') &&
        ($XMLQuestionResult['proveedorInternacionalBasic_6'] == 'Si Cumple' || $XMLQuestionResult['proveedorInternacionalBasic_6'] == 'N/A') &&
        $XMLQuestionResult['proveedorInternacionalBasic_7'] == 'No presenta coincidencia' && $listasrestric = $backgroundCheck->getVerificationSection(24)->resultId==2 && $SociosYRep = $backgroundCheck->getVerificationSection(15)->resultId==2
    ) {
        $proveedorInternacionalBasicResult = "APTO";
        $resultString = "APTO";

    } else{
        $proveedorInternacionalBasicResult = "NO APTO";
        $resultString = "NO APTO";

    }

    $pdf->SetFont('Arial', 'B', 10);
    if ($proveedorInternacionalBasicResult == "APTO" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
    $pdf->MultiCell(50, 5, $proveedorInternacionalBasicResult , 1, 'C', 1, 1, '', '', true);
    $pdf->SetTextColor(0,0,0);

    

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
            $finalComments = 'Realizada la Evaluación riesgos de la Empresa '
                    . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ', '
                    . 'donde se evaluaron los requisitos establecidos, se obtuvo un resultado "Apto" '
                    . 'para su contratación teniendo en cuenta la verificación efectuada.';
            $resultString = "APTO";
        } elseif ($backgroundCheck->resultId == Result::NO_FAVORABLE) {
            $finalComments = 'Realizada la Evaluación riesgos de la Empresa '
            . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ', '
            . 'donde se evaluaron los requisitos establecidos, se obtuvo un resultado "No Apto" '
            . 'para su contratación teniendo en cuenta la verificación efectuada.';
            $resultString = "NO APTO";
        } else {
            $finalComments = ' ************    ESTE ESTUDIO NO TIENE RESULTADO AUN  *********** ';
            // $resultString = "NO TIENE RESULTADO AUN";
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

    $evalResulCal= "---";
    // $resultString = $backgroundCheck->resultId == Result::FAVORABLE;
    $query = "UPDATE ses_BackgroundCheck SET evaluationResult='".$resultString."', evaluationValue='".$evalResulCal."' WHERE  id=".$backgroundCheck->id.";";
    Yii::app()->db->createCommand($query)->execute();

    if ($ans = $backgroundCheck->getVerificationSection(24)->percentCompleted >=100 ) {
        // VALIDACIÓN EN LISTAS RESTRICTIVAS
        $pdf->AddPage();
        $pdf->SetY(25);
        include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfValidacionListasRestrictivas.php');
    }

    if ($ans = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER)->percentCompleted >=100 ) {
        $pdf->Cell('', '', '', '', 1, 'L');
        include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfLAFT.php');
    }