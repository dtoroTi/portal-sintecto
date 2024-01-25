<?php

$pdf->Cell(0, '*1', "", 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(220);

//$pdf->SetX(60);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(192, '', 'Las secciones que presentan novedad son las siguientes:', 0, 1, 'L', 0);
$pdf->SetFont('Arial', '', 12);

// @var $verificationSection VerificationSection 

$data=[];  
foreach ($verificationSections as $verificationSection) {
    if($verificationSection->result->nick=="CH" || $verificationSection->result->nick=="CHM") {

   $data[]=$verificationSection->sectionName;  

    }   
}
$pdf->Cell(0, '*1', "", 0, 1, 'L');
$pdf->Cell(192, 3, implode(", ",$data), 0, 0, 'L', false,"");



