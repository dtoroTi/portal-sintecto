<?php

// Signature
/*$pdf->Cell(0, '*1', "", 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(220);

$x=$pdf->GetX();
$y=$pdf->GetY();

$pdf->Cell(60, '', 'Sección', 1, 0, 'C', 1);
$pdf->Cell(25, '', 'Resultado', 1, 1, 'C', 1);

//@var $verificationSection VerificationSection 
foreach ($verificationSections as $verificationSection) {
    $pdf->Cell(60, '', $verificationSection->sectionName, 1, 0, 'L', 0);
    $pdf->Cell(25, '', ($verificationSection->result?$verificationSection->result->nick:""), 1, 1, 'C', 0);
}*/
//Anterior----


//Nuevo
$pdf->Cell(0, '*1', "", 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(220);

$x=$pdf->GetX();
$y=$pdf->GetY();

$pdf->Cell(50, '', 'Sección', 1, 0, 'C', 1);
$pdf->Cell(25, '', 'Resultado', 1, 1, 'C', 1);
//$pdf->Cell(25, '', 'Enlace', 1, 1, 'C', 1);

// @var $verificationSection VerificationSection 
foreach ($verificationSections as $verificationSection) {

    $link=$pdf->AddLink();

    $pdf->SetTextColor(0, 123, 255);
    $pdf->Cell(50, '', $verificationSection->sectionName, 1, 0, 'L', false, $link);
    //$pdf->Cell(40, '', $verificationSection->sectionName, 1, 0, 'L', 0);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(25, '', ($verificationSection->result?$verificationSection->result->nick:""), 1, 1, 'C', 0); 
    //$pdf->SetTextColor(0, 123, 255);
    //$pdf->Cell(25, '', 'Ver Detalle', 1, 1, 'L', false, $link);

    $posY=$pdf->GetY($verificationSection->verificationSectionType->description);
    $pageP=$pdf->PageNo($verificationSection->verificationSectionType->description);
    $pdf->SetLink($link,  $y=$posY, $page=$pageP);
}
$pdf->SetTextColor(0, 0, 0);
