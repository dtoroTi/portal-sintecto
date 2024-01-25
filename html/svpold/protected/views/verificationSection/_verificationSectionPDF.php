<?php
/*
if (!$verificationSection->isXmlSection && 
        ($verificationSection->hasDetail || $verificationSection->backgroundCheck->customerProduct->printSummarySection != 1 )) {
    $pdf->Cell(0, '', "", 0, 1, 'L');
    $pdf->SetFont('Arial', 'B', 10);
    //$pdf->SetFillColor(153, 204, 255);
    $pdf->SetFillColor(46, 117, 181);
    $pdf->SetTextColor(255);
    $pdf->Cell(196, '', mb_strtoupper($verificationSection->verificationSectionType->description), 0, 1, 'L', 1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFillColor(255);
    $pdf->SetFont('Arial', '', 10);

    $pdf->Cell(0, '', '', 0, 1, 'C', 1);
}
echo $this->renderPartial(
        '/' . $verificationSection->verificationSectionType->controllerName . '/_verificationDetailsPDF', array(
    'verificationSection' => $verificationSection,
    'pdf' => $pdf,
));

if ($verificationSection->backgroundCheck->customerProduct->printSummarySection != 1) {
    if (trim($verificationSection->comments) != "") {
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(175, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFont('Arial', 'I', 9);
        $pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(175, '', CHtml::encode($verificationSection->comments), 1, 'J', FALSE, TRUE);
        $pdf->SetFillColor(255);
    }
}

*/
if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 0) {

if (!$verificationSection->isXmlSection &&
($verificationSection->hasDetail || $verificationSection->backgroundCheck->customerProduct->printSummarySection != 1 )) {
$pdf->Cell(0, '', "", 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
//$pdf->SetFillColor(153, 204, 255);
$pdf->SetFillColor(46, 117, 181);
$pdf->SetTextColor(255);
$pdf->Cell(196, '', mb_strtoupper($verificationSection->verificationSectionType->description), 0, 1, 'L', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255);
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(0, '', '', 0, 1, 'C', 1);
}
}

echo $this->renderPartial(
'/' . $verificationSection->verificationSectionType->controllerName . '/_verificationDetailsPDF', array(
'verificationSection' => $verificationSection,
'pdf' => $pdf,
));
if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 1) {

if ($verificationSection->backgroundCheck->customerProduct->printSummarySection != 1) {
    //Se agrego el 15 que es la seccion de socios y representantes para que no salga duplicado el comentarios es posible que se tenga que hacer lo mismo con el resto de secciones de cumplimiento que esten quemadas en codigo
if (trim($verificationSection->comments) != "") {
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(175, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(175, '', CHtml::encode($verificationSection->comments), 1, 'J', FALSE, TRUE);
    $pdf->SetFillColor(255);
}
}

}else{
if ($verificationSection->backgroundCheck->customerProduct->printSummarySection != 1) {
if (trim($verificationSection->comments) != "") {
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(196, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(196, '', CHtml::encode($verificationSection->comments), 1, 'J', FALSE, TRUE);
    $pdf->SetFillColor(255);
}
}
}

