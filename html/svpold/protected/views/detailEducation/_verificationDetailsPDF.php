<?php

$pdf->SetFillColor(220);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, '', 'Grado', 1, 0, 'C', 1);
$pdf->Cell(20, '', 'Tipo', 1, 0, 'C', 1);
$pdf->Cell(65, '', 'Institición', 1, 0, 'C', 1);
$pdf->Cell(20, '', 'Ciudad', 1, 0, 'C', 1);
$pdf->Cell(56, '', 'Título', 1, 0, 'C', 1);
$pdf->Cell(10, '', 'Grado', 1, 0, 'C', 1);
$pdf->Cell(15, '', 'Verificación', 1, 1, 'C', 1);

$pdf->SetFont('Arial', '', 8);

foreach ($verificationSection->detailStudies as $study) {
  $pdf->Cell(10, '', CHtml::encode($study->graduationYear), 1, 0, 'L');
  $pdf->Cell(20, '', CHtml::encode($study->educationType->name), 1, 0, 'L');
  $pdf->Cell(65, '', CHtml::encode($study->institution), 1, 0, 'L');
  $pdf->Cell(20, '', CHtml::encode($study->city), 1, 0, 'L');
  $pdf->Cell(56, '', CHtml::encode($study->title), 1, 0, 'L');
  $pdf->Cell(10, '', Controller::stringYesNo($study->didObtainDiploma), 1, 0, 'C');
  $pdf->Cell(15, '', CHtml::encode($study->verificationResult->name), 1, 1, 'L');
}

// Detail


$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(220);

foreach ($verificationSection->detailStudies as $study) {
  $pdf->Cell(0, '', "", 0, 1, 'L');
  $pdf->Cell(12, '', 'Grado', 1, 0, 'L', 1);
  $pdf->Cell(12, '', CHtml::encode($study->graduationYear), 1, 0, 'L');
  $pdf->Cell(10, '', 'Tipo', 1, 0, 'L', 1);
  $pdf->Cell(25, '', CHtml::encode($study->educationType->name), 1, 0, 'L');
  $pdf->Cell(20, '', 'Institución', 1, 0, 'L', 1);
  $pdf->Cell(63, '', CHtml::encode($study->institution), 1, 0, 'L');
  $pdf->Cell(37, '', 'Continua Estudiando', 1, 0, 'L', 1);
  $pdf->Cell(17, '', Controller::stringYesNo($study->stillStuding), 1, 1, 'C');


  $pdf->Cell(12, '', 'Título', 1, 0, 'L', 1);
  $pdf->Cell(130, '', CHtml::encode($study->title), 1, 0, 'L');
  $pdf->Cell(37, '', 'Obtuvo Título', 1, 0, 'L', 1);
  $pdf->Cell(17, '', Controller::stringYesNo($study->didObtainDiploma), 1, 1, 'C');


  $pdf->Cell(12, '', 'País', 1, 0, 'L', 1);
  $pdf->Cell(28, '', CHtml::encode($study->country), 1, 0, 'L');
  $pdf->Cell(14, '', 'Ciudad', 1, 0, 'L', 1);
  $pdf->Cell(28, '', CHtml::encode($study->city), 1, 0, 'L');
  $pdf->Cell(12, '', 'Tel.', 1, 0, 'L', 1);
  $pdf->Cell(22, '', CHtml::encode($study->tel), 1, 0, 'L');
  $pdf->Cell(18, '', 'Contacto', 1, 0, 'L', 1);
  $pdf->Cell(62, '', CHtml::encode($study->contact), 1, 1, 'L');

  $pdf->Cell(14, '', 'Registro', 1, 0, 'L', 1);
  $pdf->Cell(35, '', CHtml::encode($study->registry), 1, 0, 'L');
  $pdf->Cell(14, '', 'Folio', 1, 0, 'L', 1);
  $pdf->Cell(35, '', CHtml::encode($study->folio), 1, 0, 'L');
  $pdf->Cell(14, '', 'Libro', 1, 0, 'L', 1);
  $pdf->Cell(35, '', CHtml::encode($study->book), 1, 0, 'L');
  $pdf->Cell(14, '', 'Acta', 1, 0, 'L', 1);
  $pdf->Cell(35, '', CHtml::encode($study->minute), 1, 1, 'L');

  $pdf->Cell(18, '', 'Email', 1, 0, 'L', 1);
  $pdf->Cell(178, '', CHtml::encode($study->email), 1, 1, 'L');
  $pdf->Cell(18, '', 'Resultado', 1, 0, 'L', 1);
  $pdf->Cell(18, '', CHtml::encode($study->verificationResult->name), 1, 0, 'L');
  $pdf->Cell(23, '', 'Verificado en', 1, 0, 'L', 1);
  $pdf->Cell(22, '', CHtml::encode($study->verifiedOn), 1, 1, 'L');
  $pdf->Cell(25, '', 'Comentarios', 1, 0, 'L', 1);
  $pdf->MultiCell(171, '', CHtml::encode($study->comments), 1, 'J', FALSE, TRUE);

  $pdf->Cell(0, '' * 1, "", 0, 1, 'L');

//  $pdf->Cell(12, '', VerificationSection::diffTime($study->startedOn, $study->finishedOn), 1, 0, 'L');
//  $pdf->Cell(20, '', CHtml::encode($study->educationType->name), 1, 0, 'L');
//  $pdf->Cell(30, '', CHtml::encode($study->institution), 1, 0, 'L');
//  $pdf->Cell(20, '', CHtml::encode($study->city), 1, 0, 'L');
//  $pdf->Cell(30, '', CHtml::encode($study->title), 1, 0, 'L');
//  $pdf->Cell(10, '', Controller::stringYesNo($study->didObtainDiploma), 1, 0, 'C');
//  $pdf->Cell(15, '', CHtml::encode($study->verificationResult->name), 1, 0, 'L');
//  $pdf->Cell(35, '', CHTML::encode($study->comments), 1, 1, 'L');
}

$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(255);
