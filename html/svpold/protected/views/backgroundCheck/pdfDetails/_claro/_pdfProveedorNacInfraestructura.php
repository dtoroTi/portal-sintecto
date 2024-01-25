<?php
    //INFRAESTRUCTURA
    $pdf->AddPage();
    $pdf->SetY(30);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "INFRAESTRUCTURA " , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(200);
    $pdf->SetTextColor(0);

    $pdf->MultiCell(120, 0, "Infraestructura Física" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(2255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['infraestructuraFisica'] , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(200);
    $pdf->MultiCell(120, 0, "Infraestructura Informática y de comunicaciones" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(2255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['infraestructuraInformatica'] , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(200);
    $pdf->MultiCell(120, 0, "Maquinaria y Equipo" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(2255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['infraestructuraEquipos'] , 1, 'C', 1, 1, '', '', true);
    
    $ansComments = $backgroundCheck->getVerificationSection(61)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'J', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');