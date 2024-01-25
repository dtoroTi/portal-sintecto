<?php

$pdf->AddPage();
$pdf->Cell('', '', '', '', 1, 'L');
$pdf->SetFillColor(0, 66, 109);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 12);
$pdf->MultiCell(170, 0, "SERVICIO CLARO" , 1, 'C', 1, 1, '', '', true);
$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(120, 0, "Tiene Base de Datos de Proveedores" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(50, 0, $XMLQuestionResult['gcBasesDatos'] , 1, 'C', 1, 1, '', '', true);

$pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(120, 0, "Cuenta con el registro y evaluación periódica de sus proveedores" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(50, 0, $XMLQuestionResult['gcEvaluacionPeriodica'] , 1, 'C', 1, 1, '', '', true);

$pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(120, 0, "Presenta asignación de ejecutivo de cuenta" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(50, 0, $XMLQuestionResult['gcEjecutivoCuenta'] , 1, 'C', 1, 1, '', '', true);

$pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(120, 0, "Cuenta con una sede para la atención al cliente" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(50, 0, $XMLQuestionResult['gcSedeAtencionCliente'] , 1, 'C', 1, 1, '', '', true);

$pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(120, 0, "Cuenta con servicios Post Venta" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(50, 0, $XMLQuestionResult['gcPostVenta'] , 1, 'C', 1, 1, '', '', true);

$pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(120, 0, "Presenta garantías en productos y servicios" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(50, 0, $XMLQuestionResult['gcGarantias'] , 1, 'C', 1, 1, '', '', true);

$pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(120, 0, "Cuenta con Servicio de mantenimiento técnico" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(50, 0, $XMLQuestionResult['gcServicioTecnico'] , 1, 'C', 1, 1, '', '', true);

$pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(120, 0, "Tiene pólizas de Seguros Generales" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(50, 0, $XMLQuestionResult['gcPolizaSeguro'] , 1, 'C', 1, 1, '', '', true);

$ansComments = $backgroundCheck->getVerificationSection(62)->comments;

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell('', '', '', '', 1, 'L');
$pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
$pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', 'I', 9);
$pdf->MultiCell(170, 0, $ansComments , 1, 'J', 1, 1, '', '', true);
$pdf->Cell('', '', '', '', 1, 'L');