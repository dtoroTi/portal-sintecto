<?php
    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/claroIntPond.php');
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
    $pdf->MultiCell(70, 0, "EVALUACIÓN FINAL"  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(50, 0, '' , 0, 'L', 0, 0, '', '', true);

    if ($resultString == "CUMPLE" || $resultString == "EXCEDE EXPECTATIVAS") {
        $pdf->SetTextColor(0,152,0);
    } else if ($resultString == "REGULAR") {
        $pdf->SetTextColor(0);
    } else {
        $pdf->SetTextColor(255,0,0);
    };

    $pdf->MultiCell(70, 0, $resultString , 1, 'C', 0, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->MultiCell(50, 0, '' , 0, 'L', 0, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(70, 0, $resultValueString , 1, 'C', 0, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');

    // 2 part
    $pdf->SetFont('Arial', 'B', 7); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->MultiCell(34, 0, "ACTIVIDAD"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, "TAMAÑO"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, "CALIDAD"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, "COMERCIO"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, "SGSST"  , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);

    if ($ansActividad == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(34, 0, $ansActividad  , 1, 'C', 1, 0, '', '', true);

    if ($ansTamano == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(34, 0, $ansTamano  , 1, 'C', 1, 0, '', '', true);
    
    if ($ansCalidad == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(34, 0, $ansCalidad  , 1, 'C', 1, 0, '', '', true);
    
    if ($ansComercio == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(34, 0, $ansComercio  , 1, 'C', 1, 0, '', '', true);
    
    /*if ($ansServicio == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(34, 0, $ansServicio  , 1, 'C', 1, 0, '', '', true);*/
    
    
    if ($ansSGSST == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(34, 0, $ansSGSST  , 1, 'C', 1, 1, '', '', true);
    
    


    
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(34, 0, $points_1. "%".' / 5%' , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, $points_2. "%".' / 5%' , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, $points_3. "%".' / 15%' , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, $points_4. "%".' / 20%' , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, $points_5. "%".' / 15%' , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(42.5, 0, "SERVICIO"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "REFERENCIAS"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "FINANCIERO"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "LISTAS"  , 1, 'C', 1, 1, '', '', true);
        
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    if ($ansServicio == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(42.5, 0, $ansServicio  , 1, 'C', 1, 0, '', '', true);

    if ($ansReferencias == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(42.5, 0, $ansReferencias  , 1, 'C', 1, 0, '', '', true);

    if ($ansFinanciero == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(42.5, 0, $ansFinanciero  , 1, 'C', 1, 0, '', '', true);
    
    if ($ansListas == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(42.5, 0, $ansListas  , 1, 'C', 1, 1, '', '', true);

    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(42.5, 0, $points_8. "%".' / 10%'  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $points_7. "%".' / 10%'  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $points_6. "%".' / 20%' , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $points_9 , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');


    //Gafi

    if ($backgroundCheck->getVerificationSection(86) !=null) {

        if ($ansGafi == "CH") {
            $ansGafi = '/images/btn_ch.png';
        } else {
            $ansGafi = '/images/btn_sh.png';
        };

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(0, 66, 109);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->MultiCell(50, 0, '', 0, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(70, 0, "GAFI", 1, 'C', 1, 0, '', '', true);
        $pdf->Cell('', '', '', '', 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->MultiCell(50, 0, '', 0, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(70, 0, "", 1, 'C', 0, 1, '', '', false);
        $pdf->Image(Yii::app()->basePath . $ansGafi, 108, 190.5, 4, 4);
        $pdf->Cell('', '', '', '', 1, 'L');
        $pdf->Cell('', '', '', '', 1, 'L');
    }

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "CONCLUSIÓN DE LA EVALUACIÓN"  , 0, 'C', 1, 1, '', '', true);
    
    
    $pdf->SetFillColor(255); $pdf->SetTextColor(0,0,0);
    
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->MultiCell(170, 0, "Realizada la evaluación de los criterios definidos,  a continuación se presenta el detalle de la puntuación obtenida por la compañía objeto de análisis: "  , 0, 'L', 1, 1, '', '', true);
    
    if($XMLQuestionResult['adicionalClaro_end'] != ""){
        $pdf->SetFont('Arial', '', 7);
        $pdf->MultiCell(170, 0, $XMLQuestionResult['adicionalClaro_end']  , 0, 'J', 1, 1, '', '', true);
        $pdf->Cell('', '', '', '', 1, 'L');

    }
    
    // RESUMEN CALIFICACIÓN OBTENIDA
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorIntCalificacionObtenida.php');

    // INFORMACION DE LA COMPAÑIA
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorNacInfo.php');

    // IMPACTO
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedornNacSectionImpact.php');

    // VALIDACIÓN EN LISTAS RESTRICTIVAS
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfValidacionListasRestrictivas.php');
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfLAFT.php');

    // SOCIOS Y REPRESENTANTES LEGALES
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorNacSocios.php');
    
    // EMPLEADOS
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorNacEmpleados.php');

    // ANALISIS FINANCIERO
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfCompanyFinantialAnalys.php');
    
    // REFERENCIAS COMERCIALES
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorNacReferencias.php');

    // SGSST --REVIEW CONTENT
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorIntSGSST.php');
    
    // CALIDAD Y HSEQ
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorIntCalidad.php');