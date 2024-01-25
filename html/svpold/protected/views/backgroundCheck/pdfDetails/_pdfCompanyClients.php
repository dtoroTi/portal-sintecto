<?php 
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(170, 0, "Referencias Comerciales de Clientes" , 0, 'L', 0, 1, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    foreach ($sectionCompanyCustomer as $customer) {
        $pdf->MultiCell(40, 0, "Razón Social" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(130, 0, $customer->companyName , 1, 'L', 1, 1, '', '', true);
        $pdf->MultiCell(40, 0, "Contacto" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(130, 0, $customer->contactName , 1, 'L', 1, 1, '', '', true);
        $pdf->MultiCell(40, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(130, 0, $customer->tel , 1, 'L', 1, 1, '', '', true);
        $pdf->MultiCell(40, 0, "Servicios Productos" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(130, 0, $customer->services , 1, 'L', 1, 1, '', '', true);
        $pdf->Cell('', '', '', '', 1, 'L');

    }

    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');