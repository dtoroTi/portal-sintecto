<?php

    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/claroNacPond.php');
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
    $pdf->MultiCell(34, 0, "EXPERIENCIA"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, "CERTIFICACIONES"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, "SERVICIO"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, "REFERENCIAS"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, "INFRAESTRUCTURA"  , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);

    if ($ansExperiencia == "CH" ) { $ansExperiencia_btn = '/images/btn_ch.png';} else{ $ansExperiencia_btn = '/images/btn_sh.png'; };
    $pdf->MultiCell(34, 0, ""  , 1, 'C', 1, 0, '', '', true);
    $pdf->Image(Yii::app()->basePath .$ansExperiencia_btn , 40, 150.5, 4, 4);
    

    if ($ansCertificaciones == "CH" ) { $ansCertificaciones_btn = '/images/btn_ch.png';} else{ $ansCertificaciones_btn = '/images/btn_sh.png'; };
    $pdf->MultiCell(34, 0, ""  , 1, 'C', 1, 0, '', '', true);
    $pdf->Image(Yii::app()->basePath .$ansCertificaciones_btn , 74.25, 150.5, 4, 4);

    if ($ansServicio == "CH" ) { $ansServicio_btn = '/images/btn_ch.png';} else{ $ansServicio_btn = '/images/btn_sh.png'; };    
    $pdf->MultiCell(34, 0, ""  , 1, 'C', 1, 0, '', '', true);
    $pdf->Image(Yii::app()->basePath .$ansServicio_btn , 108.5 , 150.5, 4, 4);
    
    if ($ansClientes == "CH" ) { $ansClientes_btn = '/images/btn_ch.png';} else{ $ansClientes_btn = '/images/btn_sh.png'; };        
    $pdf->MultiCell(34, 0, ""  , 1, 'C', 1, 0, '', '', true);
    $pdf->Image(Yii::app()->basePath .$ansClientes_btn , 142.25 , 150.5, 4, 4);
    
    if ($ansInfraestructura == "CH" ) { $ansInfraestructura_btn = '/images/btn_ch.png';} else{ $ansInfraestructura_btn = '/images/btn_sh.png'; };        
    $pdf->MultiCell(34, 0, ""  , 1, 'C', 1, 1, '', '', true);
    $pdf->Image(Yii::app()->basePath .$ansInfraestructura_btn , 176.5 , 150.5, 4, 4);

  
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(34, 0, $points_1. "% / 5%" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, $points_2. "% / 10%"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, $points_3. "% / 5%" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, $points_4. "% / 5%" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(34, 0, $points_5. "% / 5%" , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(42.5, 0, "FINANCIERO"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "G. HUMANOS"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "SG-SST"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "LISTAS"  , 1, 'C', 1, 1, '', '', true);
        
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);

    
    
    if ($ansFinanciero == "CH" ) { $ansFinanciero_btn = '/images/btn_ch.png';} else{ $ansFinanciero_btn = '/images/btn_sh.png'; };
    $pdf->MultiCell(42.5, 0, ""  , 1, 'C', 1, 0, '', '', true);
    $pdf->Image(Yii::app()->basePath .$ansFinanciero_btn , 44.5, 170.5, 4, 4);

    if ($ansRrhh == "CH" ) { $ansRrhh_btn = '/images/btn_ch.png';} else{ $ansRrhh_btn = '/images/btn_sh.png'; };
    $pdf->MultiCell(42.5, 0, ""  , 1, 'C', 1, 0, '', '', true);
    $pdf->Image(Yii::app()->basePath .$ansRrhh_btn , 87, 170.5, 4, 4);

    if ($ansSGSST == "CH" ) { $ansSGSST_btn = '/images/btn_ch.png';} else{ $ansSGSST_btn = '/images/btn_sh.png'; };
    $pdf->MultiCell(42.5, 0, ""  , 1, 'C', 1, 0, '', '', true);
    $pdf->Image(Yii::app()->basePath .$ansSGSST_btn , 129.5, 170.5, 4, 4);
    
    if ($ansListas == "CH" ) { $ansListas_btn = '/images/btn_ch.png';} else{ $ansListas_btn = '/images/btn_sh.png'; };
    $pdf->MultiCell(42.5, 0, ""  , 1, 'C', 1, 1, '', '', true);
    $pdf->Image(Yii::app()->basePath .$ansListas_btn , 172, 170.5, 4, 4);

    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(42.5, 0, $points_6. "% / 30%"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $points_7. "% / 20%"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $points_8. "% / 20%"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, $points_9 , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    //k de contratacion Jonathan
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(50, 0, '' , 0, 'L', 0, 0, '', '', true);
    $pdf->MultiCell(70, 0, "CAPACIDAD DE CONTRATACIÓN"  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(50, 0, '' , 0, 'L', 0, 0, '', '', true);
    $pdf->MultiCell(70, 0, $sCFA->kContratacion . ' SMLV', 1, 'C', 0, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
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
        $pdf->Image(Yii::app()->basePath . $ansGafi, 108, 205.5, 4, 4);
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
        $pdf->MultiCell(170, 0, $XMLQuestionResult['adicionalClaro_end']  , 1, 'J', 1, 1, '', '', true);
        $pdf->Cell('', '', '', '', 1, 'L');

    }
    
    // IMPACTO
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedornNacSectionImpact.php');
    
    // AUDITORIA
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorAuditoria.php');

    // RESUMEN CALIFICACIÓN OBTENIDA
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorNacCalificacionObtenida.php');

    // INFORMACION DE LA COMPAÑIA
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorNacInfo.php');


    // SOCIOS Y REPRESENTANTES LEGALES
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorNacSocios.php');
    
    // EMPLEADOS
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorNacEmpleados.php');
    
    // VALIDACIÓN EN LISTAS RESTRICTIVAS
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfValidacionListasRestrictivas.php');
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfLAFT.php');

    // RRHH --REVIEW XML
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorNacRRHH.php');

    // SGSST --REVIEW CONTENT
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorNacSGSST.php');
    
    // ANALISIS FINANCIERO
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfCompanyFinantialAnalys.php');
    
    // REFERENCIAS COMERCIALES
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorNacReferencias.php');
    
    // INFRAESTRUCTURA
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorNacInfraestructura.php');

    // CALIDAD Y HSEQ
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorNacCalidad.php');

    // CENTRALES
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfCompanyFinance.php');

    // SERVICIO CLARO
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfServicioclaro.php');

    // CONTACTO EMPRESA
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfContactoEmpresa.php');



   