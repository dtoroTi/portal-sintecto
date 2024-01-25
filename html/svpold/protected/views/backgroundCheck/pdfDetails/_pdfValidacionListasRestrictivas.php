<?php

if ($backgroundCheck->getVerificationSection(24)->percentCompleted >=100 ) {
    $pdf->AddPage();
    $pdf->SetY(25);    
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 5, "VALIDACIÓN EN LISTAS RESTRICTIVAS" , 0, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->SetFont('Arial', '', 10);
    
    $pdf->MultiCell(140, 5, "De Reconocimiento público (OFAC-Clinton, ONU y Reino Unido)" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['OfacYOnu'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['OfacYOnu'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['OfacYOnu'] , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "De Reconocimiento normativo de Buenas prácticas (BOE)" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['Boe'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['Boe'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['Boe'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Boletines de Entidades de Control (Fiscalía, Procuraduría, Contraloría)" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['entControl'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['entControl'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['entControl'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Boletines de Entidades Policiales (Policía, DEA, Interpol, FBI, Unión Europea)" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['entPoliciales'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['entPoliciales'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['entPoliciales'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Otros boletines (Presidencia, SuperFinanciera, Embajadas, Fuerzas Militares, etc)" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['otrosBoletines'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['otrosBoletines'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['otrosBoletines'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Empresas ficticias" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['empresasFicticias'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['empresasFicticias'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['empresasFicticias'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Paraísos Fiscales" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['paraisosFiscales'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['paraisosFiscales'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['paraisosFiscales'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Boletines Deudores Morosos" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['boletinesDeudoresMorosos'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['boletinesDeudoresMorosos'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['boletinesDeudoresMorosos'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Registros en Rama Judicial" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['registrosRamaJudicial'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['registrosRamaJudicial'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['registrosRamaJudicial'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Demandas" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['demandas'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['demandas'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['demandas'] , 1, 'C', 0, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $ansComments = $backgroundCheck->getVerificationSection(24)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    // $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor(0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
}