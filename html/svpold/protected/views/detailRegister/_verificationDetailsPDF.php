<?php

if (count($verificationSection->detailRegisters) > 0) {
  $pdf->SetFillColor(220);
  $pdf->SetFont('Arial', 'B', 10);

  $pdf->SetFont('Arial', '', 10);
  foreach ($verificationSection->detailRegisters as $register) {
    $pdf->Cell(76, '', 'Multas de Transito: ', 1, 0, 'L', 1);
    $pdf->Cell(76, '', $register->simit, 1, 1, 'L');
    $pdf->Cell(76, '', 'Runt: ', 1, 0, 'L', 1);
    $pdf->Cell(76, '', $register->runt, 1, 1, 'L');
    $pdf->Cell(76, '', 'Libreta militar: ', 1, 0, 'L', 1);
    $pdf->Cell(76, '', $register->libreta_militar, 1, 1, 'L');
  }
  $pdf->SetFillColor(255);
}