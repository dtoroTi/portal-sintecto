<?php
    $pdf->AddPage();
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "INFORMACIÓN SGSST" , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(120, 0, "Aspectos Evaluados" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Validación" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "1. SGSST documento, implementado y aprobado por la Gerencia" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_1'] , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "2. La política SGSST está publicada y comunicada al personal" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_2'] , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "3. Cuenta con los recursos humanos y financieros para la implementación del SGSST" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_3'] , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "4. Inducciones SGSST a colaboradores" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_4'] , 1, 'C', 1, 1, '', '', true);
        
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "5. Indicadores SGSST definidos y evaluados periódicamente" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_5'] , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "6. Auditorías internas generando acciones correctivas SGSST" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_6'] , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(230,230,230);  $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "7. El responsable genera informe anual sobre el SGSST" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_7'] , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(230,230,230);  $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "8. Mediciones ambientales en SGSST" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);    
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_8'] , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(230,230,230);  $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "9. Matriz de requerimientos Legales (Actualización Res 0312)" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);       
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_9'] , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(230,230,230);  $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "10. Matriz de identificación de peligros y evaluación de Riesgos" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);           
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_10'] , 1, 'C', 1, 1, '', '', true);

     if($XMLQuestionResult['sgssst_10_comment'] != ""){
        $pdf->SetFillColor(255,255,255); $pdf->SetFont('Arial', 'I', 7);
        $pdf->MultiCell(170, 0, "Comentarios: " . $XMLQuestionResult['sgssst_10_comment'] , 1, 'L', 1, 1, '', '', true);
     }


    $pdf->SetFillColor(230,230,230);  $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "11. Matriz de aspectos e impactos ambientales" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);       
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_11'] , 1, 'C', 1, 1, '', '', true);

    if($XMLQuestionResult['sgssst_11_comment'] != ""){
        $pdf->SetFillColor(255,255,255); $pdf->SetFont('Arial', 'I', 7);
        $pdf->MultiCell(170, 0, "Comentarios: " . $XMLQuestionResult['sgssst_11_comment'] , 1, 'L', 1, 1, '', '', true);
    }

    $pdf->SetFillColor(230,230,230);  $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "12. COPASST" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);       
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_12'] , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(230,230,230);  $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "13. Registro de formaciones al COPASST" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_13'] , 1, 'C', 1, 1, '', '', true);

    if($XMLQuestionResult['sgssst_13_comment'] != ""){
        $pdf->SetFillColor(255,255,255); $pdf->SetFont('Arial', 'I', 7);
        $pdf->MultiCell(170, 0, "Comentarios: " . $XMLQuestionResult['sgssst_13_comment'] , 1, 'L', 1, 1, '', '', true);
    }

    $pdf->SetFillColor(230,230,230);  $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "14. Conformación de Brigadas y Realización de Simulacros" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_14'] , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(230,230,230);  $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "15. Registros de entrega de Dotación y EPP a los colaboradores" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);    
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_15'] , 1, 'C', 1, 1, '', '', true);

    if($XMLQuestionResult['sgssst_15_comment'] != ""){
        $pdf->SetFillColor(255,255,255); $pdf->SetFont('Arial', 'I', 7);
        $pdf->MultiCell(170, 0, "Comentarios: " . $XMLQuestionResult['sgssst_15_comment'] , 1, 'L', 1, 1, '', '', true);
    }

    $pdf->SetFillColor(230,230,230);  $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "16. Exámenes médicos ocupaciones de ingreso, periódico o de retiro" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_16'] , 1, 'C', 1, 1, '', '', true);

    if($XMLQuestionResult['sgssst_16_comment'] != ""){
        $pdf->SetFillColor(255,255,255); $pdf->SetFont('Arial', 'I', 7);
        $pdf->MultiCell(170, 0, "Comentarios: " . $XMLQuestionResult['sgssst_16_comment'] , 1, 'L', 1, 1, '', '', true);
    }

    $pdf->SetFillColor(230,230,230);  $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "17. Accidentes fatales o graves en el último año" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_17'] , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(230,230,230);  $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "18. Higiene y Seguridad Industrial documentado y publicado" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);    
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_18'] , 1, 'C', 1, 1, '', '', true);

    if($XMLQuestionResult['sgssst_18_comment'] != ""){
        $pdf->SetFillColor(255,255,255); $pdf->SetFont('Arial', 'I', 7);
        $pdf->MultiCell(170, 0, "Comentarios: " . $XMLQuestionResult['sgssst_18_comment'] , 1, 'L', 1, 1, '', '', true);
    }

    $pdf->SetFillColor(230,230,230);  $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "19. Plan de emergencias documentado e implementado" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_19'] , 1, 'C', 1, 1, '', '', true);

    $ansComments = $backgroundCheck->getVerificationSection(64)->comments;

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'J', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');