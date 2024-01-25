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
    if ($XMLQuestionResult['proveedorNacionalBasic_1'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_1'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
    $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_1'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(120, 5, "1.2 ¿La sociedad se encuentra vigente?" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    if ($XMLQuestionResult['proveedorNacionalBasic_2'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_2'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
    $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_2'] , 1, 'C', 0, 1, '', '', true);
    //2
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 5, "2. Aspectos legales" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(120, 5, "2.1 ¿Cuenta con certificado de existencia y representación legal?" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    if ($XMLQuestionResult['proveedorNacionalBasic_3'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_3'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
    $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_3'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(120, 5, "2.2 ¿Cuenta con RUT?" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    if ($XMLQuestionResult['proveedorNacionalBasic_4'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_4'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
    $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_4'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(120, 5, "2.3 ¿Cuenta con certificación bancaria no mayor a 30 dias?" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    if ($XMLQuestionResult['proveedorNacionalBasic_5'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_5'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
    $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_5'] , 1, 'C', 0, 1, '', '', true);
    //3
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 5, "3. Formatos G.Prodeco" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(120, 5, "3.1 ¿Cuenta con autorización para el tratamiento de datos personales?" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    if ($XMLQuestionResult['proveedorNacionalBasic_6'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_6'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
    $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_6'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(120, 5, "3.2 ¿Cuenta con carta de aceptación de términos y condiciones?" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
    $pdf->SetFillColor(255,255,255);
    if ($XMLQuestionResult['proveedorNacionalBasic_7'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_7'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
    $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_7'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(120, 5, "3.3 ¿Cuenta con carta certificación de origen de recursos - SARLAFT?" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    if ($XMLQuestionResult['proveedorNacionalBasic_8'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_8'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
    $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_8'] , 1, 'C', 0, 1, '', '', true);
     //4
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 5, "4. Validación en Listas Restrictivas" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(120, 5, "4.1 ¿Presenta coincidencia?" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);


if ($backgroundCheck->studyStartedOn<'2020-04-02'){


    if ($XMLQuestionResult['proveedorNacionalBasic_9'] == "No presenta coincidencia" && $listasEmpresasResult_SM == "SH") {
        $pdf->SetTextColor(0,152,0);
        $XMLQuestionResult['proveedorNacionalBasic_9'] = "No presenta coincidencia";
        $proveedorNacionalBasic_9 = "No presenta coincidencia";
    } else {
        $pdf->SetTextColor(255,0,0);
        $XMLQuestionResult['proveedorNacionalBasic_9'] = "Presenta coincidencia";
        $proveedorNacionalBasic_9 =  "Presenta coincidencia";
    }
}

else {

    if ($XMLQuestionResult['proveedorNacionalBasic_9'] == "No presenta coincidencia" && $listasEmpresasResult == "SH") {
        $pdf->SetTextColor(0,152,0);
        $XMLQuestionResult['proveedorNacionalBasic_9'] = "No presenta coincidencia";
        $proveedorNacionalBasic_9 = "No presenta coincidencia";
    } else {
        $pdf->SetTextColor(255,0,0);
        $XMLQuestionResult['proveedorNacionalBasic_9'] = "Presenta coincidencia";
        $proveedorNacionalBasic_9 =  "Presenta coincidencia";
    }


}

    $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_9'] , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(120, 5, "Resultado Obtenido" , 1, 'C', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);

    // RESULTADO 
    if (
        ($XMLQuestionResult['proveedorNacionalBasic_1'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_1'] == 'N/A') &&
        ($XMLQuestionResult['proveedorNacionalBasic_2'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_2'] == 'N/A') &&
        ($XMLQuestionResult['proveedorNacionalBasic_3'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_3'] == 'N/A') &&
        ($XMLQuestionResult['proveedorNacionalBasic_4'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_4'] == 'N/A') &&
        ($XMLQuestionResult['proveedorNacionalBasic_5'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_5'] == 'N/A') &&
        ($XMLQuestionResult['proveedorNacionalBasic_6'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_6'] == 'N/A') &&
        ($XMLQuestionResult['proveedorNacionalBasic_7'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_7'] == 'N/A') &&
        ($XMLQuestionResult['proveedorNacionalBasic_8'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_8'] == 'N/A') &&
        $proveedorNacionalBasic_9 == 'No presenta coincidencia' && $listasrestric = $backgroundCheck->getVerificationSection(24)->resultId==2 && $SociosYRep = $backgroundCheck->getVerificationSection(15)->resultId==2
    ) {
        $proveedorNacionalBasicResult = "APTO";
    } else{
        $proveedorNacionalBasicResult = "NO APTO";
    }

    $pdf->SetFont('Arial', 'B', 10);
    if ($proveedorNacionalBasicResult == "APTO" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
    $pdf->MultiCell(50, 5, $proveedorNacionalBasicResult , 1, 'C', 1, 1, '', '', true);
    $pdf->SetTextColor(0,0,0);

    // GUARDAR RESULTADO DE LA EVALUACIÓN
    $evaluationResult = $proveedorNacionalBasicResult;
    $evaluationValue = "";
    $query = "UPDATE ses_BackgroundCheck SET evaluationResult='".$evaluationResult."', evaluationValue='".$evaluationValue."' WHERE  id=".$backgroundCheck->id.";";
    Yii::app()->db->createCommand($query)->execute();

    

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
        } else if ($backgroundCheck->resultId == Result::NO_FAVORABLE) {
            $finalComments = 'Realizada la Evaluación riesgos de la Empresa '
            . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ', '
            . 'donde se evaluaron los requisitos establecidos, se obtuvo un resultado "No Apto" '
            . 'para su contratación teniendo en cuenta la verificación efectuada.';
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
        if($y <50){
            $y=50;
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

    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfValidacionListasRestrictivas.php');
    
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfLAFT.php');