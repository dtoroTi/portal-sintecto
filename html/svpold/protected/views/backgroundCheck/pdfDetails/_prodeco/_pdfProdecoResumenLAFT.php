<?php

    
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(170, 0, "RESUMEN DE EVALUACION LISTAS RESTRICTIVAS"  , 0, 'C', 1, 1, '', '', true);
$pdf->SetTextColor(0,0,0);
$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetTextColor(0); $pdf->SetFillColor(220);
$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(100, 0, ""  , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell( 35, 0, "LISTAS SARLAFT"  , 1, 'C', 1, 0, '', '', true);

$pdf->MultiCell(35, 0, "BDME"  , 1, 'C', 1, 1, '', '', true);
$pdf->SetTextColor(0); $pdf->SetFillColor(255);
$pdf->SetFont('Arial', '', 8);

$pdf->MultiCell(100, 0, $backgroundCheck->lastName  , 1, 'L', 1, 0, '', '', true);

if($listasEmpresasResult == "SH"){
    $listaEmpresa = "APTO";
    $pdf->SetTextColor(0,152,0);
} else {
    $listaEmpresa = "NO APTO";
    $pdf->SetTextColor(255,0,0);
}

$pdf->MultiCell(35, 0, $listaEmpresa  , 1, 'C', 1, 0, '', '', true);

if ($XMLQuestionResult['boletinesDeudoresMorosos'] =="SI"){
    $ans="CH";
    $pdf->SetTextColor(255,0,0);
} else {
    $ans="SH";
    $pdf->SetTextColor(0,152,0);
}

$pdf->MultiCell(35, 0, $ans  , 1, 'C', 1, 1, '', '', true);

$pdf->SetTextColor(0); $pdf->SetFillColor(255);

$pdf->MultiCell(100, 0, "SOCIOS Y REPRESENTANTES"  , 1, 'L', 1, 0, '', '', true);


if($listasSociosResult == "SH"){
    $listaSocios = "APTO";
    $pdf->SetTextColor(0,152,0);
} else {
    $listaSocios = "NO APTO";
    $pdf->SetTextColor(255,0,0);
}

$pdf->MultiCell(35, 0, $listaSocios  , 1, 'C', 1, 0, '', '', true);

if($bdmResult == "SH"){
    $pdf->SetTextColor(0,152,0);
} else {
    $pdf->SetTextColor(255,0,0);
}
$pdf->MultiCell(35, 0, $bdmResult  , 1, 'C', 1, 1, '', '', true);
$pdf->SetTextColor(0); $pdf->SetFillColor(255);