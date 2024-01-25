<?php

$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(170, 0, "CONCEPTO FINAL"  , 0, 'C', 1, 0, '', '', true);
$pdf->SetTextColor(0,0,0);
$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetFont('Arial', '', 12);

// Always use the Result Ignore the comments
if (true || trim($backgroundCheck->comments) == "") {
    if ($backgroundCheck->resultId == Result::FAVORABLE) {
        $finalComments = 'Realizada la Evaluación de la Empresa '
                . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                . 'se puede concluir que bajo la Evaluación de Riesgo NO '
                . 'presenta ningún aspecto que amerite emitir un concepto '
                . 'negativo para su contratación, de acuerdo con las '
                . 'actividades que puede desarrollar según su Objeto Social.';
    } elseif ($backgroundCheck->resultId == Result::NO_FAVORABLE) {
        $finalComments = 'Realizada la Evaluación de la Empresa '
        . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                . 'se puede concluir que bajo la Óptica de Seguridad Presenta '
                . 'aspectos que ameritan emitir un concepto No Favorable '
                . 'para su contratación, de acuerdo con las actividades '
                . 'que puede desarrollar según su Objeto Social.';
            } else {
        $finalComments = ' ************    ESTE ESTUDIO NO TIENE RESULTADO AUN  *********** ';
    }
} else {
    $finalComments = $backgroundCheck->comments;
}

    $pdf->MultiCell(171, '', $finalComments, 0, 'J', FALSE, TRUE);

    $pdf->AddPage();
    $pdf->SetY(30);

    // VALIDACIÓN EN LISTAS RESTRICTIVAS
    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfValidacionListasRestrictivas.php');

    $pdf->Cell('', '', '', '', 1, 'L');
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfLAFT.php');