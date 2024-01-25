<?php

// Signature
$pdf->Cell(0, '*1', "", 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(220);

$pdf->Cell($x, '', '', 0, 0, 'C', 0);

$pdf->Cell(96, '', 'Documentos', 1, 1, 'C', 1);

foreach ($backgroundCheck->documents as $document) {
    $pdf->Cell($x, '', '', 0, 0, 'C', 0);
    $pdf->Cell(96, '', $document->description, 1, 1, 'L', 0);
}

