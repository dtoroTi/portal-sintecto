<?php


$sectionAudit = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_AUDIT);

// ASISTENCIA AUDITORIA
$sectionAuditAttendance = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_AUDIT_ATTENDANCE);



$pdf->AddPage();
    $pdf->SetY(30);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255);
    $pdf->MultiCell(170, 0, "HALLAZGOS EN AUDITORIA"  , 0, 'C', 1, 1, '', '', true);
    $pdf->SetTextColor(0);
    $pdf->Cell('', '', '', '', 1, 'L');

//ASISTENTES A LA AUDITORIA
    $pdf->SetTextColor(0);
    $pdf->SetFillColor(230); $pdf->SetFont('Arial', 'B', 8);
    $pdf->MultiCell(170, 0, "Asistentes a la Auditoría"  , 1, 'L', 1, 1, '', '', true);

    $pdf->SetTextColor(0);
    $pdf->SetFillColor(230); $pdf->SetFont('Arial', 'B', 8);
    $pdf->MultiCell(55, 0, "Nombre y Apellido"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(55, 0, "Cargo" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(60, 0, "Proceso ó Área" , 1, 'L', 1, 1, '', '', true);
    $i = 0;
    foreach ($sectionAuditAttendance->detailAuditAttendance as $auditAttendance) {
        $pdf->SetTextColor(0);
        $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(55, 0, $auditAttendance->name , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(55, 0, $auditAttendance->position , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(60, 0, $auditAttendance->area , 1, 'L', 1, 1, '', '', true);

    }
    $pdf->Cell('', '', '', '', 1, 'L');


    $i = 0;
    foreach ($sectionAudit->detailAudit as $audit) {

        if ($audit->findings == 1){

            $findings = 'Abierto';
        }
        else if($audit->findings == 2) {

            $findings = 'Cerrado';

        }else{
            $findings = 'No Subsanó';
        }

        $pdf->SetTextColor(0); $pdf->SetFillColor(230); $pdf->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(170, 0, "Requisito:"  , 1, 'L', 1, 1, '', '', true);
        $pdf->SetTextColor(0); $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(170, 0, $audit->request , 1, 'L', 1, 1, '', '', true);
        $pdf->SetTextColor(0); $pdf->SetFillColor(230); $pdf->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(170, 0, "Descripción:" , 1, 'L', 1, 1, '', '', true);
        $pdf->SetTextColor(0); $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(170, 0, $audit->description , 1, 'L', 1, 1, '', '', true);
        $pdf->SetTextColor(0); $pdf->SetFillColor(230); $pdf->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(170, 0, "Proceso ó Área:" , 1, 'L', 1, 1, '', '', true);
        $pdf->SetTextColor(0); $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(170, 0, $audit->area , 1, 'L', 1, 1, '', '', true);
        $pdf->SetTextColor(0); $pdf->SetFillColor(230); $pdf->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(170, 0, "Hallazgo Auditoria:" , 1, 'L', 1, 1, '', '', true);
        $pdf->SetTextColor(0); $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(170, 0, $findings , 1, 'L', 1, 1, '', '', true);
        $pdf->Cell('', '', '', '', 1, 'L');
        if($i == 2){
            $pdf->AddPage();
            $pdf->SetY(30);
            $i=0;
        } else{
            $i++;
        }
    }


    $ansComments_1 = $backgroundCheck->getVerificationSection(81)->comments;
    $ansComments_2 = $backgroundCheck->getVerificationSection(80)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments_1 . $ansComments_2 , 1, 'J', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');