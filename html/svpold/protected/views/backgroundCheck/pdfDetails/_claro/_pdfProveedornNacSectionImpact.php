<?php


if($pdf->getY()>30){

    $pdf->AddPage();
}

    $pdf->SetY(30);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "EVALUACIÓN DE IMPACTO DE RIESGO" , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell('', '', '', '', 1, 'L');
    
    $pdf->MultiCell(120, 0, "Proveedor / Comodity" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, "" , 1, 'C', 1, 1, '', '', true);
    

    $pdf->SetFillColor(230); $pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "1. Riesgo Laboral" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if($XMLQuestionResult['sectionImpact_1'] == "BAJO" || $XMLQuestionResult['sectionImpact_1'] == "NO APLICA"){ $pdf->SetTextColor(0,152,0); }
    else if($XMLQuestionResult['sectionImpact_1'] == "MEDIO"){ $pdf->SetTextColor(202, 153, 28); }
    else { $pdf->SetTextColor(255,0,0); }
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sectionImpact_1'] , 1, 'C', 1, 1, '', '', true);
    

    $pdf->SetFillColor(230);$pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "2. Riesgo SGSST" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if($XMLQuestionResult['sectionImpact_2'] == "BAJO" || $XMLQuestionResult['sectionImpact_2'] == "NO APLICA"){ $pdf->SetTextColor(0,152,0); }
    else if($XMLQuestionResult['sectionImpact_2'] == "MEDIO"){ $pdf->SetTextColor(202, 153, 28); }
    else { $pdf->SetTextColor(255,0,0); }
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sectionImpact_2'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetTextColor(0);

    $pdf->SetFillColor(230); $pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "3. Riesgo Financiero" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if($XMLQuestionResult['sectionImpact_3'] == "BAJO" || $XMLQuestionResult['sectionImpact_3'] == "NO APLICA"){ $pdf->SetTextColor(0,152,0); }
    else if($XMLQuestionResult['sectionImpact_3'] == "MEDIO"){ $pdf->SetTextColor(202, 153, 28); }
    else { $pdf->SetTextColor(255,0,0); }
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sectionImpact_3'] , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(230); $pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "4. Riesgo Calidad y Servicio" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if($XMLQuestionResult['sectionImpact_4'] == "BAJO" || $XMLQuestionResult['sectionImpact_4'] == "NO APLICA"){ $pdf->SetTextColor(0,152,0); }
    else if($XMLQuestionResult['sectionImpact_4'] == "MEDIO"){ $pdf->SetTextColor(202, 153, 28); }
    else { $pdf->SetTextColor(255,0,0); }
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sectionImpact_4'] , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(230); $pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "5. Riesgo OEA" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if($XMLQuestionResult['sectionImpact_5'] == "BAJO" || $XMLQuestionResult['sectionImpact_5'] == "NO APLICA"){ $pdf->SetTextColor(0,152,0); }
    else if($XMLQuestionResult['sectionImpact_5'] == "MEDIO"){ $pdf->SetTextColor(202, 153, 28); }
    else { $pdf->SetTextColor(255,0,0); }
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sectionImpact_5'] , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(230); $pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "6. Riesgo Judicial" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if($XMLQuestionResult['sectionImpact_6'] == "BAJO" || $XMLQuestionResult['sectionImpact_6'] == "NO APLICA"){ $pdf->SetTextColor(0,152,0); }
    else if($XMLQuestionResult['sectionImpact_6'] == "MEDIO"){ $pdf->SetTextColor(202, 153, 28); }
    else { $pdf->SetTextColor(255,0,0); }
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sectionImpact_6'] , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(230); $pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "7. Riesgo Legal" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if($XMLQuestionResult['sectionImpact_7'] == "BAJO" || $XMLQuestionResult['sectionImpact_7'] == "NO APLICA"){ $pdf->SetTextColor(0,152,0); }
    else if($XMLQuestionResult['sectionImpact_7'] == "MEDIO"){ $pdf->SetTextColor(202, 153, 28); }
    else { $pdf->SetTextColor(255,0,0); }
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sectionImpact_7'] , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(230); $pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "8. Riesgo SARLAFT" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if($XMLQuestionResult['sectionImpact_8'] == "BAJO" || $XMLQuestionResult['sectionImpact_8'] == "NO APLICA"){ $pdf->SetTextColor(0,152,0); }
    else if($XMLQuestionResult['sectionImpact_8'] == "MEDIO"){ $pdf->SetTextColor(202, 153, 28); }
    else { $pdf->SetTextColor(255,0,0); }
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sectionImpact_8'] , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(230); $pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "9. Riesgo ANTICORRUPCIÓN" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if($XMLQuestionResult['sectionImpact_9'] == "BAJO" || $XMLQuestionResult['sectionImpact_9'] == "NO APLICA"){ $pdf->SetTextColor(0,152,0); }
    else if($XMLQuestionResult['sectionImpact_9'] == "MEDIO"){ $pdf->SetTextColor(202, 153, 28); }
    else { $pdf->SetTextColor(255,0,0); }
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sectionImpact_9'] , 1, 'C', 1, 1, '', '', true);
    


    $ansComments = $backgroundCheck->getVerificationSection(79)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'J', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');