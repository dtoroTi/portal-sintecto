<?php
if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 1) {
    $pdf->AddPage();
    $pdf->SetY(25);    
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(175, 5, "ASISTENCIA VISITA" , 0, 'C', 1, 1, '', '', true);
    $pdf->SetTextColor(0);
    $pdf->SetFillColor(230); $pdf->SetFont('Arial', 'B', 8);
    $pdf->MultiCell(58, 0, "Nombre y Apellido"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(58, 0, "Cargo" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(58.9, 0, "Proceso ó Área" , 1, 'L', 1, 1, '', '', true);
    foreach ($verificationSection->detailAuditAttendance as $auditAttendance) {
        $pdf->SetTextColor(0);
        $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(58, 0, $auditAttendance->name , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(58, 0, $auditAttendance->position , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(58.9, 0, $auditAttendance->area , 1, 'L', 1, 1, '', '', true);
        $i = 0;
    }
} else {
    $pdf->SetTextColor(0);
    $pdf->SetFillColor(230); $pdf->SetFont('Arial', 'B', 8);
    $pdf->MultiCell(65, 0, "Nombre y Apellido"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(65, 0, "Cargo" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(66, 0, "Proceso ó Área" , 1, 'L', 1, 1, '', '', true);
    $i = 0;
    foreach ($verificationSection->detailAuditAttendance as $auditAttendance) {
        $pdf->SetTextColor(0);
        $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(65, 0, $auditAttendance->name , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(65, 0, $auditAttendance->position , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(66, 0, $auditAttendance->area , 1, 'L', 1, 1, '', '', true);

    }
}


