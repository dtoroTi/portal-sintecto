<?php


$pdf->AddPage();
$pdf->Cell('', '', '', '', 1, 'L');
$pdf->SetFillColor(0, 66, 109);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 12);
$pdf->MultiCell(170, 0, "CONTACTO EMPRESA", 1, 'C', 1, 1, '', '', true);
$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial', 'B', 9);
$pdf->MultiCell(120, 0, "Contacto Comercial" , 1, 'L', 1, 0, '', '', true);
$pdf->MultiCell(50, 0, "" , 1, 'C', 1, 1, '', '', true);

if (isset( $XMLQuestionResult['commercialName'])){
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Nombre" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['commercialName'] , 1, 'C', 1, 1, '', '', true);
 }

if (isset( $XMLQuestionResult['commercialPosition'])) {
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Cargo" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['commercialPosition'], 1, 'C', 1, 1, '', '', true);
 }

if (isset( $XMLQuestionResult['commercialEmail'])) {
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Email" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['commercialEmail'], 1, 'C', 1, 1, '', '', true);
 }

if (isset( $XMLQuestionResult['commercialPhone'])) {
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['commercialPhone'], 1, 'C', 1, 1, '', '', true);
    }

if (isset( $XMLQuestionResult['commercialMobile'])) {
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Teléfono movil" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['commercialMobile'], 1, 'C', 1, 1, '', '', true);
    }

$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial', 'B', 9);
$pdf->MultiCell(120, 0, "Contacto de Compras" , 1, 'L', 1, 0, '', '', true);
$pdf->MultiCell(50, 0, "" , 1, 'C', 1, 1, '', '', true);

if (isset( $XMLQuestionResult['purchasingName'])) {
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Nombre" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['purchasingName'], 1, 'C', 1, 1, '', '', true);
    }

if (isset( $XMLQuestionResult['purchasingEmail'])) {
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Email" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['purchasingEmail'], 1, 'C', 1, 1, '', '', true);
    }

if (isset( $XMLQuestionResult['purchasingPhone'])) {
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['purchasingPhone'], 1, 'C', 1, 1, '', '', true);
    }

if (isset( $XMLQuestionResult['purchasingMobile'])) {
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Teléfono movil" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['purchasingMobile'], 1, 'C', 1, 1, '', '', true);
    }


$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial', 'B', 9);
$pdf->MultiCell(120, 0, "Contacto de Financiero" , 1, 'L', 1, 0, '', '', true);
$pdf->MultiCell(50, 0, "" , 1, 'C', 1, 1, '', '', true);

if (isset( $XMLQuestionResult['financialName'])) {
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Nombre" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['financialName'], 1, 'C', 1, 1, '', '', true);
}

if (isset( $XMLQuestionResult['financialEmail'])) {
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Email" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['financialEmail'], 1, 'C', 1, 1, '', '', true);
    }

if (isset( $XMLQuestionResult['financialPhone'])) {
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['financialPhone'], 1, 'C', 1, 1, '', '', true);
    }

if (isset( $XMLQuestionResult['financialMobile'])) {
    $pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Teléfono movil" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['financialMobile'], 1, 'C', 1, 1, '', '', true);
    }

$ansComments = $backgroundCheck->getVerificationSection(72)->comments;

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell('', '', '', '', 1, 'L');
$pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
$pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', 'I', 9);
$pdf->MultiCell(170, 0, $ansComments , 1, 'J', 1, 1, '', '', true);
$pdf->Cell('', '', '', '', 1, 'L');