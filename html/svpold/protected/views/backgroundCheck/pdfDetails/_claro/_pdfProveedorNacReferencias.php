<?php

    $qualification= array(
        0 =>  "No Aplica",
        1 => "Malo",
        2 => "Regular",
        3 => "Bueno",
        4 => "Excelente"
    
    );
    // INFORMACIÓN COMERCIAL 
    $pdf->AddPage();
    $pdf->SetY(30);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "INFORMACIÓN COMERCIAL" , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(170, 0, "Referencias Comerciales de Clientes" , 0, 'L', 0, 1, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    foreach ($sectionCompanyCustomer as $customer) {
        $pdf->SetFillColor($bgGray);
        $pdf->MultiCell(40, 0, "Razón Social" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor($bgWhite);
        $pdf->MultiCell(130, 0, $customer->companyName , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor($bgGray);
        $pdf->MultiCell(40, 0, "Contacto" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor($bgWhite);
        $pdf->MultiCell(130, 0, $customer->contactName , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor($bgGray);
        $pdf->MultiCell(40, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor($bgWhite);
        $pdf->MultiCell(130, 0, $customer->tel , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor($bgGray);
        $pdf->MultiCell(40, 0, "Servicios Productos" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor($bgWhite);
        $pdf->MultiCell(130, 0, $customer->services , 1, 'L', 1, 1, '', '', true);

        $pdf->SetFillColor($bgGray);
        $pdf->MultiCell(42.5, 0, "Entrega" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(42.5, 0, "Servicio" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(42.5, 0, "PQR" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(42.5, 0, "Precio" , 1, 'C', 1, 1, '', '', true);

        $pdf->SetFillColor($bgWhite);
        $pdf->MultiCell(42.5, 0, $qualification[$customer->deliveryCompliance] , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(42.5, 0, $qualification[$customer->productsQuality] , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(42.5, 0, $qualification[$customer->postSalesService] , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(42.5, 0, $qualification[$customer->prices] , 1, 'C', 1, 1, '', '', true);
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
    //if($sectionAGD = $backgroundCheck->getVerificationSection(14)->percentCompleted >=100)/*Seccion Proveedores  */{
    $pdf->AddPage();
    $pdf->SetY(30);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(170, 0, "Referencias Comerciales de Proveedores" , 0, 'L', 0, 1, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    foreach ($sectionCompanyProvider as $provider) {
        $pdf->SetFillColor($bgGray);        
        $pdf->MultiCell(40, 0, "Razón Social" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor($bgWhite);
        $pdf->MultiCell(130, 0, $provider->companyName , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor($bgGray);        
        $pdf->MultiCell(40, 0, "Contacto" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor($bgWhite);
        $pdf->MultiCell(130, 0, $provider->contactName , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor($bgGray);        
        $pdf->MultiCell(40, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor($bgWhite);
        $pdf->MultiCell(130, 0, $provider->tel , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor($bgGray);        
        $pdf->MultiCell(40, 0, "Servicios Productos" , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFillColor($bgWhite);
        $pdf->MultiCell(130, 0, $provider->services , 1, 'L', 1, 1, '', '', true);
        
        $pdf->SetFillColor($bgGray);
        $pdf->MultiCell(85, 0, "Presenta Deudas Vencidas" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(85, 0, "Antigüedad como proveedor" , 1, 'L', 1, 1, '', '', true);

        if ($provider->presentsDebts == 0){
            $presentsDebts = "NO";
        } else{
            $presentsDebts = "SI";
        }

        $pdf->SetFillColor($bgWhite);
        $pdf->MultiCell(85, 0, $presentsDebts , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(85, 0, $provider->relationAge . " años" , 1, 'C', 1, 1, '', '', true);
        $pdf->Cell('', '', '', '', 1, 'L');
    }

    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_PROVIDER)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'J', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
  //  }