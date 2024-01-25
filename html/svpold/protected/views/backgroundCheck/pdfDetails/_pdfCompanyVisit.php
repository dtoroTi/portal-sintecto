<?php
    // VISITA DE EMPRESA
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, 5, "Objeto Social" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(130, 5, $sectionCompanyVisit->socialObject , 1, 'L', 0, 1, '', '', true);

    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, 5, "Servicios y Productos Ofrecidos" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(130, 5, $sectionCompanyVisit->services, 1, 'L', 0, 1, '', '', true);

    if ($sectionCompanyVisit->yearsOfActivity == 0 ) {
        $yearsOfActivity = 'Más de 15 Años';
    } else if ($sectionCompanyVisit->yearsOfActivity == 1 ) {
        $yearsOfActivity = 'De 9 a 15 años';
    } else if ($sectionCompanyVisit->yearsOfActivity == 2 ) {
        $yearsOfActivity = 'De 4 a 8 años';
    } else if ($sectionCompanyVisit->yearsOfActivity == 3 ) {
        $yearsOfActivity = 'De 0 a 3 años';
    } else {
        $yearsOfActivity = '';
    }
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, 5, "Años de Actividad" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(130, 5, $yearsOfActivity, 1, 'L', 0, 1, '', '', true);
    
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, 5, "Reseña Histórica" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(130, 5, $sectionCompanyVisit->companyHistory, 1, 'L', 0, 1, '', '', true);