<?php

$pdf->SetFillColor(220);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(45, '', 'Documento', 1, 0, 'C', 1);
$pdf->Cell(40, '', 'Resultado', 1, 0, 'C', 1);
$pdf->Cell(35, '', 'Verificado En', 1, 0, 'C', 1);
$pdf->Cell(76, '', 'Comentarios', 1, 1, 'C', 1);

$pdf->SetFont('Arial', '', 10);
foreach ($verificationSection->detailDocuments as $document) {
  $pdf->Cell(45, '', $document->name, 1, 0, 'L');
  $pdf->Cell(40, '', $document->verificationResult->name, 1, 0, 'C');
  $pdf->Cell(35, '', $document->verifiedOn, 1, 0, 'C');
  $pdf->Cell(76, '', $document->comments, 1, 1, 'L');
}
$pdf->SetFillColor(255);
