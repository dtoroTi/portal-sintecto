<?php

$pdf->Cell(0, '*1', "", 0, 1, 'L');

foreach ($verificationSections as $verificationSection) {
    if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 1) {  
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(0,66,109);
        $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(175, 0, "RESUMEN DE SECCIONES"  , 1, 'C', 1, 1, '', '', true);
    }
    break;
}
$pdf->Cell(0, '*1', "", 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(220);

/* @var $verificationSection VerificationSection */
foreach ($verificationSections as $verificationSection) {

    if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 0) {    

        $pdf->Cell(196, '', 'Resumen de : ' . $verificationSection->sectionName, 1, 1, 'L', 1);
        $pdf->MultiCell(196, '', CHtml::encode($verificationSection->comments), 1, 'J', FALSE, TRUE);
        $pdf->Cell(0, '*1', "", 0, 1, 'L');
    } else{

        $pdf->SetFillColor(0,66,109);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(25, '', 'Concepto', 1, 0, 'C', 1);
        $pdf->Cell(150, '', 'Resumen de : ' . $verificationSection->sectionName, 1, 1, 'L', 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0);
        $nick1=$verificationSection->result?$verificationSection->result->nick:"";
        switch ($nick1) {
            case 'SH':
                $pdf->SetTextColor(0,152,0);
                break;
            case 'CH':
                $pdf->SetTextColor(255,0,0);
                break;
            case 'CHM':
                $pdf->SetTextColor(255,128,0);
                break;  
        }
        $pdf->Cell(25, '', ($verificationSection->result?$verificationSection->result->nick:""), 1, 0, 'C', 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0);
        $pdf->MultiCell(150, '', CHtml::encode($verificationSection->comments), 1, 'J', FALSE, TRUE);
        $pdf->Cell(0, '*1', "", 0, 1, 'L');
    }
}
//$pdf->AddPage();