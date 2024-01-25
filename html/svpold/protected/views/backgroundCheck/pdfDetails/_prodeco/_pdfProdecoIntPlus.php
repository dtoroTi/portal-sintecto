<?php
    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_prodeco/prodecoIntPlusPond.php');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "RESUMEN DE EVALUACIÓN"  , 0, 'C', 1, 1, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(50, 0, '' , 0, 'L', 0, 0, '', '', true);
    $pdf->MultiCell(70, 0, "EVALUACIÓN FINAL PLUS"  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(50, 0, '' , 0, 'L', 0, 0, '', '', true);

    if ($resultString == "APTO") {
        $pdf->SetTextColor(0,152,0);
    } else {
        $pdf->SetTextColor(255,0,0);
    };

    $pdf->MultiCell(70, 0, $resultString , 1, 'C', 0, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->MultiCell(50, 0, '' , 0, 'L', 0, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(70, 0, $evalResulCal . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');


    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(42.5, 0, "ANTIGÜEDAD"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "CALIDAD"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "REFERENCIAS"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "FINANCIERA"  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);

    
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(42.5, 0, $yearsOfActivityCal . "%", 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $certificationCal . "%", 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $referenciaCal . "%", 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $financieraCal . "%", 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(42.5, 0, "LABORAL"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "SEGURIDAD"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "ASPECTOS -"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "ASPECTOS +"  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->SetTextColor(0,0,0);
    
    $pdf->MultiCell(42.5, 0, $laboralCal . "%", 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $seguridadCal . "%", 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $plusIntNegProdecoCal . "%", 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $plusIntPosProdecoCal . "%", 1, 'C', 1, 0, '', '', true);
   
    $pdf->Cell('', '', '', '', 1, 'L');
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
                    . 'donde se evaluaron los requisitos establecidos, se obtuvo una calificación de '.$evalResulCal .
                    '% por lo tanto su resultado es "Apto" '
                    . 'para su contratación teniendo en cuenta la verificación efectuada.';
            $resultString = "APTO";
        } elseif ($backgroundCheck->resultId == Result::NO_FAVORABLE) {
            $finalComments = 'Realizada la Evaluación riesgos de la Empresa '
            . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ', '
            . 'donde se evaluaron los requisitos establecidos, se obtuvo una calificación de '.$evalResulCal .
                    '% por lo tanto su resultado es "No Apto" '
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
        $pdf->Image($imageFile, $x + $xdif, $y - 17, -180);
        unlink($imageFile);
        $pdf->setXY($x, $y);
    }

    $pdf->Cell(66, '', ($backgroundCheck->approved ? $backgroundCheck->approved->name : 'PENDIENTE DE APROBACIÓN'), "T", 1, 'C', 0);


    // AGREGAR BÁSICO INTERNACIONAL
    if ($resultString == 'NO APTO') {
        $pdf->AddPage();
        $pdf->SetY(25);

        $pdf->SetTextColor(255);
        $pdf->MultiCell(170, 0, "EVALUACIÓN BÁSICA INTERNACIONAL"  , 1, 'C', 1, 1, '', '', true);
        $pdf->Cell('', '', '', '', 1, 'L');

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
        
        if ($XMLQuestionResult['proveedorInternacionalBasic_7'] == "No presenta coincidencia" && $listasEmpresasResult_SM == "SH") {
            $pdf->SetTextColor(0,152,0);
            $XMLQuestionResult['proveedorInternacionalBasic_7'] = "No presenta coincidencia";
            $proveedorInternacionalBasic_7 = "No presenta coincidencia";
        } else {
            $pdf->SetTextColor(255,0,0);
            $XMLQuestionResult['proveedorInternacionalBasic_7'] = "Presenta coincidencia";
            $proveedorInternacionalBasic_7 =  "Presenta coincidencia";
        };

        $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorInternacionalBasic_7'] , 1, 'C', 0, 1, '', '', true);
        $pdf->MultiCell(170, 5, " " , 0, 'L', 0, 1, '', '', true);
        
        $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(120, 5, "Resultado Obtenido Básico" , 1, 'C', 1, 0, '', '', true);
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
        $XMLQuestionResult['proveedorInternacionalBasic_7'] == 'No presenta coincidencia'
    ) {
        $proveedorInternacionalBasicResult = "APTO";
    } else{
        $proveedorInternacionalBasicResult = "NO APTO";
    }

    $pdf->SetFont('Arial', 'B', 10);
    if ($proveedorInternacionalBasicResult == "APTO" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
    $pdf->MultiCell(50, 5, $proveedorInternacionalBasicResult , 1, 'C', 1, 1, '', '', true);
    $pdf->SetTextColor(0,0,0);

    /*
    // GUARDAR RESULTADO DE LA EVALUACIÓN
    $evaluationResult = $proveedorNacionalBasicResult;
    $evaluationValue = "";
    $query = "UPDATE ses_BackgroundCheck SET evaluationResult='".$evaluationResult."', evaluationValue='".$evaluationValue."' WHERE  id=".$backgroundCheck->id.";";
    Yii::app()->db->createCommand($query)->execute();
    */

    }


    $pdf->AddPage();
    $pdf->SetY(25);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "RESUMEN CALIFICACIÓN OBTENIDA"  , 0, 'C', 1, 1, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell('', '', '', '', 1, 'L');
    
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(80, 0, "COMPONENTES"  , 0, 'C', 1, 0, '', '', true);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(30, 0, "P. Obtenido"  , 0, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, "P. Posible"  , 0, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, "Calificación"  , 0, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(220,220,220);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->MultiCell(80, 0, "1. Años de Actividad"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $yearsOfActivityCal  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 5  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $yearsOfActivityCal . "%"  , 1, 'C', 1, 1, '', '', true);
    
    
    $pdf->MultiCell(80, 0, "2. Certificaciones de Calidad"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $certificationCal , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 4  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $certificationCal . "%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->MultiCell(80, 0, "¿Cuenta con certificación ISO 9000?"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $certificationCal_1  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 1  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $certificationCal_1 ."%"  , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(80, 0, "¿Cuenta con certificación ISO 14000?"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $certificationCal_2  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 1  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $certificationCal_2 . "%"  , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(80, 0, "¿Cuenta con certificación ISO 18000?"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $certificationCal_3  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 1  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $certificationCal_3 ."%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(80, 0, "¿Cuenta con una Política de Calidad?"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $certificationCal_6  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 1  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $certificationCal_6 ."%" , 1, 'C', 1, 1, '', '', true);
    
    
    $pdf->SetFillColor(220,220,220);
    $pdf->MultiCell(80, 0, "3. Referencias Comerciales Clientes"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $referenciaCal  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 46 , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $referenciaCal . "%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(80, 0, "Antigüedad como proveedor"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $relationAgeCal  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 14 , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $relationAgeCal . "%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(80, 0, "Servicio al Cliente"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $customerServiceCal  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 16 , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $customerServiceCal . "%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(80, 0, "Servicio Post-Venta"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $postSalesServiceCal  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 16 , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $postSalesServiceCal . "%", 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(220,220,220);
    $pdf->MultiCell(80, 0, "4. Información Financiera"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $financieraCal  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 25  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $financieraCal ."%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(80, 0, "Razón Corriente"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $razonCorrienteCal_0  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 7.5  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $razonCorrienteCal_0 ."%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(80, 0, "Prueba Acida"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $pruebaAcidaCal_0  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 2.5  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $pruebaAcidaCal_0 ."%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(80, 0, "Razón de Endeudamiento"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $nivelDeEndeudamientoCal_0  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 7.5  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $nivelDeEndeudamientoCal_0 . "%"  , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(80, 0, "Razón Pasivo Capital"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $leverageCal_0  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 5  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $leverageCal_0 . "%"  , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(80, 0, "Margen Bruto"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $margenBrutoCal_0  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 2.5  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $margenBrutoCal_0 . "%"  , 1, 'C', 1, 1, '', '', true);
    
    
    $pdf->SetFillColor(220,220,220);
    $pdf->MultiCell(80, 0, "5. Información Laboral"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $laboralCal  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 10  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $laboralCal . "%"  , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(80, 0, "Número de Empleados"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $totalEmpleadosCal  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 10  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $totalEmpleadosCal . "%" , 1, 'C', 1, 1, '', '', true);
    
    
    $pdf->SetFillColor(220,220,220);
    $pdf->MultiCell(80, 0, "6. Seguridad, Salud y Medio Ambiente"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $seguridadCal  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 10  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $seguridadCal . "%"  , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(80, 0, "La empresa tiene implementado un SG-SSTA"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $sgssstCal_1  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 4  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $sgssstCal_1 ."%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(80, 0, "Cuenta con elementos de Seguridad Industrial"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $sgssstCal_8  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 3  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $sgssstCal_8 ."%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(80, 0, "Cuenta con una Política Ambiental"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $sgssstCal_7  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 3  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $sgssstCal_7 . "%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(220,220,220);
    $pdf->MultiCell(80, 0, "7. Información Adicional Negativa"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $plusIntNegProdecoCal  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, "-"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $plusIntNegProdecoCal  ."%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(80, 0, "Liquidación Voluntaria u Obligatoria"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $plusIntNegProdecoCal_1  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, -100 , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $plusIntNegProdecoCal_1 ."%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(80, 0, "Registra embargos"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $plusIntNegProdecoCal_2  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, -100 , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $plusIntNegProdecoCal_2 . "%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(80, 0, "Embargo en cuentas corrientes"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $plusIntNegProdecoCal_3  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, -20 , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $plusIntNegProdecoCal_3 . "%" , 1, 'C', 1, 1, '', '', true);

    
    $pdf->SetFillColor(220,220,220);
    $pdf->MultiCell(80, 0, "8. Información Adicional Positiva"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $plusIntPosProdecoCal  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, "-"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $plusIntPosProdecoCal . "%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(80, 0, "Pertenece a un Grupo Empresarial"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(30, 0, $plusIntPosProdecoCal_1  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 10 , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $plusIntPosProdecoCal_1 . "%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(80, 0, "Es la Empresa un Fabricante Original de Equipos y Partes."  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(30, 0, $plusIntPosProdecoCal_2  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, 15  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, $plusIntPosProdecoCal_2 . "%" , 1, 'C', 1, 1, '', '', true);
    
    

   
    // VALIDACIÓN EN LISTAS RESTRICTIVAS
    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfValidacionListasRestrictivas.php');

    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfLAFT.php');


    $pdf->AddPage();
    $pdf->SetY(30);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "DETALLE DE LA EVALUACIÓN" , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "1. Años de Actividad" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(170, 0, $backgroundCheck->yearsOfActivity . " años", 1, 'L', 0, 1, '', '', true);

    $pdf->Cell('', '', '', '', 1, 'L');


    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "2. Certificaciones de Calidad" , 1, 'L', 1, 1, '', '', true);
    
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "Cuenta con certificación ISO 9000" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['certification_1'] , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "Cuenta con certificación ISO 14000" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['certification_2'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "Cuenta con certificación ISO 18000" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['certification_3'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "Cuenta con una Política de Calidad" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['certification_6'] , 1, 'C', 0, 1, '', '', true);
    
    $ansComments = $backgroundCheck->getVerificationSection(57)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "3. Referencias Comerciales Clientes" , 1, 'L', 1, 1, '', '', true);
    
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "Antigüedad como proveedor" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $relationAge . " años" , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "Servicio al Cliente" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $customerService , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "Servicio Post-Venta" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $postSalesService , 1, 'C', 0, 1, '', '', true);

    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "4. Información Financiera" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "Razón Corriente" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, number_format($razonCorriente_0, 2, '.', '') . " veces" , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "Prueba Acida" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, number_format($pruebaAcida_0, 2, '.', '') . " veces" , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "Razón de Endeudamiento" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, number_format($nivelDeEndeudamiento_0 *100, 2, '.', '') . "%" , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "Razón Pasivo Capital" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, number_format($leverage_0, 2, '.', '') . " veces" , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "Margen Bruto" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, number_format($margenBruto_0, 2, '.', '') . " veces" , 1, 'C', 0, 1, '', '', true);
    
    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->AddPage();
    $pdf->SetY(25);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "5. Información Laboral" , 1, 'L', 1, 1, '', '', true);
    
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "Número de Empleados" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $totalEmpleados , 1, 'C', 0, 1, '', '', true);

    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "6. Seguridad, Salud y Medio Ambiente" , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "La empresa tiene implementado un SG-SSTA" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_1'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    
    $pdf->MultiCell(120, 0, "Cuenta con elementos de Seguridad Industrial" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_8'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(120, 0, "Cuenta con una Política Ambiental" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_2'] , 1, 'C', 0, 1, '', '', true);
    
    $ansComments = $backgroundCheck->getVerificationSection(67)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "7. Información Adicional Negativa" , 1, 'L', 1, 1, '', '', true);
    
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    
    $pdf->MultiCell(120, 0, "Liquidación Voluntaria u Obligatoria" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusIntNegProdeco_1'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    
    $pdf->MultiCell(120, 0, "Registra embargos" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusIntNegProdeco_2'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    
    $pdf->MultiCell(120, 0, "Embargo en cuentas corrientes" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusIntNegProdeco_3'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);

    $pdf->Cell('', '', '', '', 1, 'L');
    
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, "8. Información Adicional Positiva" , 1, 'L', 1, 1, '', '', true);
    
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 10);
    
    $pdf->MultiCell(120, 0, "Pertenece a un Grupo Empresarial" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusIntPosProdeco_1'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
    
    $pdf->MultiCell(120, 0, "Es la Empresa un Fabricante Original de Equipos y Partes" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusIntPosProdeco_2'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);

    $ansComments = $backgroundCheck->getVerificationSection(60)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_prodeco/_pdfCompanyFinantialAnalys.php');
    
    
    if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->percentCompleted >=100 ) {
    $pdf->AddPage();
    $pdf->SetY(25);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "INFORMACIÓN COMERCIAL" , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(170, 0, "Referencias Comerciales de Clientes" , 0, 'L', 0, 1, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    foreach ($sectionCompanyCustomer as $customer) {
        $pdf->MultiCell(40, 0, "Razón Social" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(130, 0, $customer->companyName , 1, 'L', 1, 1, '', '', true);
        $pdf->MultiCell(40, 0, "Contacto" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(130, 0, $customer->contactName , 1, 'L', 1, 1, '', '', true);
        $pdf->MultiCell(40, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(130, 0, $customer->tel , 1, 'L', 1, 1, '', '', true);
        $pdf->MultiCell(40, 0, "Servicios Productos" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(130, 0, $customer->services , 1, 'L', 1, 1, '', '', true);
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
}