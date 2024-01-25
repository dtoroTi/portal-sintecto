<?php

if ($backgroundCheck->getVerificationSection(68)->percentCompleted >=100 ) {
    $pdf->AddPage();
    $pdf->SetY(25);    
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 5, "VALIDACIÓN EN LISTAS RESTRICTIVAS" , 0, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->SetFont('Arial', '', 10);
    
    $pdf->MultiCell(140, 5, "Clinton" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['listaResctrictiva_1'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['listaResctrictiva_1'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['listaResctrictiva_1'] , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "ONU" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['listaResctrictiva_2'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['listaResctrictiva_2'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['listaResctrictiva_2'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Interpol" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['listaResctrictiva_3'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['listaResctrictiva_3'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['listaResctrictiva_3'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Reino Unido" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['listaResctrictiva_4'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['listaResctrictiva_4'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['listaResctrictiva_4'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Union Europea" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['listaResctrictiva_5'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['listaResctrictiva_5'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['listaResctrictiva_5'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Proveedores Ficticios" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['listaResctrictiva_6'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['listaResctrictiva_6'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['listaResctrictiva_6'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Procuraduría" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['listaResctrictiva_7'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['listaResctrictiva_7'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['listaResctrictiva_7'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Contraloría" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['listaResctrictiva_8'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['listaResctrictiva_8'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['listaResctrictiva_8'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Matricula Mercantil Renovada" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['listaResctrictiva_9'] == "NO") {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['listaResctrictiva_9'] == "N/A"){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['listaResctrictiva_9'] , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->MultiCell(140, 5, "Novedad en Central de Riesgo" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255);
    if ( $XMLQuestionResult['listaResctrictiva_10'] == "SI" ) {
        $pdf->SetTextColor(255,0,0);
    } else if ($XMLQuestionResult['listaResctrictiva_10'] == "N/A" ){
        $pdf->SetTextColor(0);
    }else{
        $pdf->SetTextColor(0,152,0);
    };
    $pdf->MultiCell(30, 5, $XMLQuestionResult['listaResctrictiva_10'] , 1, 'C', 0, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $ansComments = $backgroundCheck->getVerificationSection(68)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    // $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor(0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
}