<?php

$pdf->SetFillColor(220);

$polygraph = $verificationSection->detailPolygraph;
$pdf->Cell(15, '', 'Restulado', 1, 0, 'L', 1);
$pdf->Cell(30, '', CHtml::encode($polygraph->verificationResult->name), 1, 0, 'L');
$pdf->Cell(25, '', 'Verificado En', 1, 0, 'L', 1);
$pdf->Cell(20, '', CHtml::encode($polygraph->verifiedOn), 1, 1, 'L');

$pdf->SetFillColor(255);

