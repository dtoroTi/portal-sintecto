<?php
    $pdf->AddPage();
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "CALIDAD Y HSEQ" , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');


    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(120, 0, "Norma" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Certificación" , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(220);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial', '', 9);
    
    $pdf->MultiCell(120, 0, "1. Certificación ISO 9001" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['certification_1'] , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(220);
    $pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "2. Certificación ISO 14001" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->MultiCell(50, 0, $XMLQuestionResult['certification_2'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220);
    $pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "3. Certificación OSHA 18001" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['certification_3'] , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220);
    $pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "4. Certificación ISO 27001" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['certification_4'] , 1, 'C', 0, 1, '', '', true);
        
    $pdf->SetFillColor(220);
    $pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "5. Certificación ISO 28000" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['certification_5'] , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220);
    $pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "6. Certificación OEA" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['certification_6'] , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220);
    $pdf->SetTextColor(0);
    $pdf->MultiCell(120, 0, "9.  Certificación en Responsabilidad Social, Sostenibilidad, Medio Ambiente " , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['certification_7'] , 1, 'C', 0, 1, '', '', true);
    
    $ansComments = $backgroundCheck->getVerificationSection(70)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');