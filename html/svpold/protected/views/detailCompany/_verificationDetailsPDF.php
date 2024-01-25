<?php

if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 1) {

if ($verificationSection->verificationSectionType->name == "Clientes"){
    $pdf->AddPage();
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255); $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(175, 0, "REFERENCIAS COMERCIALES" , 1, 'C', 1, 1, '', '', true);   
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);




        foreach ($verificationSection->detailCompanyCustomer as $company) {

            if($verificationSection->backgroundCheck->customer->customerGroupId==559){

                if ($company->deliveryCompliance == "0" ) {
                    $entrega= "";
                } else if ($company->deliveryCompliance == "1" ) {
                    $entrega= "Deficiente";
                } else if ($company->deliveryCompliance == "2" ) {
                    $entrega= "Regular";
                } else if ($company->deliveryCompliance == "3" ) {
                    $entrega= "Bueno";
                } else if ($company->deliveryCompliance == "4" ) {
                    $entrega= "Excelente";
                }else {
                    $entrega= "";}


                if ($company->productsQuality == "0" ) {
                    $servicio= "";
                } else if ($company->productsQuality == "1" ) {
                    $servicio= "Deficiente";
                } else if ($company->productsQuality == "2" ) {
                    $servicio= "Regular";
                } else if ($company->productsQuality == "3" ) {
                    $servicio= "Bueno";
                } else if ($company->productsQuality == "4" ) {
                    $servicio= "Excelente";
                }else {
                    $servicio= "";}


                if ($company->prices == "0" ) {
                    $precio= "";
                } else if ($company->prices == "1" ) {
                    $precio= "Deficiente";
                } else if ($company->prices == "2" ) {
                    $precio= "Regular";
                } else if ($company->prices == "3" ) {
                    $precio= "Bueno";
                } else if ($company->prices == "4" ) {
                    $precio= "Excelente";
                }else {
                    $precio= "";}


                if ($company->postSalesService == "0" ) {
                    $pqr= "";
                } else if ($company->postSalesService == "1" ) {
                    $pqr= "Deficiente";
                } else if ($company->postSalesService == "2" ) {
                    $pqr= "Regular";
                } else if ($company->postSalesService == "3" ) {
                    $pqr= "Bueno";
                } else if ($company->postSalesService == "4" ) {
                    $pqr= "Excelente";
                }else {
                    $pqr= "";}

            } else{
                if ($company->deliveryCompliance == "0" ) {
                    $entrega= "";
                } else if ($company->deliveryCompliance == "1" ) {
                    $entrega= "No Apto";
                } else if ($company->deliveryCompliance == "2" ) {
                    $entrega= "Regular";
                } else if ($company->deliveryCompliance == "3" ) {
                    $entrega= "Bueno";
                } else if ($company->deliveryCompliance == "4" ) {
                    $entrega= "Excelente";
                }else {
                    $entrega= "";}


                if ($company->productsQuality == "0" ) {
                    $servicio= "";
                } else if ($company->productsQuality == "1" ) {
                    $servicio= "No Apto";
                } else if ($company->productsQuality == "2" ) {
                    $servicio= "Regular";
                } else if ($company->productsQuality == "3" ) {
                    $servicio= "Bueno";
                } else if ($company->productsQuality == "4" ) {
                    $servicio= "Excelente";
                }else {
                    $servicio= "";}


                if ($company->prices == "0" ) {
                    $precio= "";
                } else if ($company->prices == "1" ) {
                    $precio= "No Apto";
                } else if ($company->prices == "2" ) {
                    $precio= "Regular";
                } else if ($company->prices == "3" ) {
                    $precio= "Bueno";
                } else if ($company->prices == "4" ) {
                    $precio= "Excelente";
                }else {
                    $precio= "";}


                if ($company->postSalesService == "0" ) {
                    $pqr= "";
                } else if ($company->postSalesService == "1" ) {
                    $pqr= "No Apto";
                } else if ($company->postSalesService == "2" ) {
                    $pqr= "Regular";
                } else if ($company->postSalesService == "3" ) {
                    $pqr= "Bueno";
                } else if ($company->postSalesService == "4" ) {
                    $pqr= "Excelente";
                }else {
                    $pqr= "";}
            }

            $pdf->SetFillColor(200,200,200);
            $pdf->MultiCell(50, 0, "Razón Social" , 1, 'L', 1, 0, '', '', true);
            $pdf->SetFillColor(255,255,255);
            $pdf->MultiCell(125, 0, $company->companyName , 1, 'L', 1, 1, '', '', true);
            $pdf->SetFillColor(200,200,200);
            $pdf->MultiCell(50, 0, "Contacto" , 1, 'L', 1, 0, '', '', true);
            $pdf->SetFillColor(255,255,255);
            $pdf->MultiCell(125, 0, $company->contactName , 1, 'L', 1, 1, '', '', true);
            $pdf->SetFillColor(200,200,200);
            $pdf->MultiCell(50, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
            $pdf->SetFillColor(255,255,255);
            $pdf->MultiCell(125, 0, $company->tel , 1, 'L', 1, 1, '', '', true);
            $pdf->SetFillColor(200,200,200);
            $pdf->MultiCell(50, 0, "Servicios Productos" , 1, 'L', 1, 0, '', '', true);
            $pdf->SetFillColor(255,255,255);
            $pdf->MultiCell(125, 0, $company->services , 1, 'L', 1, 1, '', '', true);
            $pdf->SetFillColor(200,200,200);
            if($verificationSection->backgroundCheck->customer->customerGroupId==559){

                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(43.7, 0, "Entrega" , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(43.7, 0, "Servicio" , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(43.7, 0, "Calidad" , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(43.9, 0, "Disposición" , 1, 'C', 1, 1, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(43.7, 0, $entrega , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(43.7, 0, $servicio , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(43.7, 0, $precio , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(43.9, 0, $pqr , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', '', '', '', 1, 'L');

            } else {
                $pdf->MultiCell(50, 0,"Antiguedad como proveedor", 1, 'L', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(125, 0, $company->relationAge , 1, 'L', 1, 1, '', '', true);
                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(43.7, 0, "Entrega" , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(43.7, 0, "Servicio" , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(43.7, 0, "Precio" , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(43.9, 0, "PQR" , 1, 'C', 1, 1, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(43.7, 0, $entrega , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(43.7, 0, $servicio , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(43.7, 0, $precio , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(43.9, 0, $pqr , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', '', '', '', 1, 'L');
            }
        }
    }

        // PROVEEDORES    

 if ($verificationSection->verificationSectionType->name == "Proveedores"){
    $pdf->AddPage();
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255); $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(175, 0, "REFERENCIAS  A PROVEEDORES" , 1, 'C', 1, 1, '', '', true);    
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);





        foreach ($verificationSection->detailCompanyProvider as $company) {

	if ($company->presentsDebts == "0" ) {
        $companyr= "NO";
   	} else if ($company->presentsDebts == "1" ) {
        $companyr= "SI";}
	else {
        $companyr= "";}


	$pdf->SetFillColor(200,200,200);
        $pdf->MultiCell(45, 0, "Razón Social" , 1, 'L', 1, 0, '', '', true);
	$pdf->SetFillColor(255,255,255);
        $pdf->MultiCell(130, 0, $company->companyName , 1, 'L', 1, 1, '', '', true);
	$pdf->SetFillColor(200,200,200);
        $pdf->MultiCell(45, 0, "Contacto" , 1, 'L', 1, 0, '', '', true);
	$pdf->SetFillColor(255,255,255);
        $pdf->MultiCell(130, 0, $company->contactName , 1, 'L', 1, 1, '', '', true);
	$pdf->SetFillColor(200,200,200);
        $pdf->MultiCell(45, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
	$pdf->SetFillColor(255,255,255);
        $pdf->MultiCell(130, 0, $company->tel , 1, 'L', 1, 1, '', '', true);
	$pdf->SetFillColor(200,200,200);
        $pdf->MultiCell(45, 0, "Servicios Productos" , 1, 'L', 1, 0, '', '', true);
	$pdf->SetFillColor(255,255,255);
        $pdf->MultiCell(130, 0, $company->services , 1, 'L', 1, 1, '', '', true);
	$pdf->SetFillColor(200,200,200);
	$pdf->MultiCell(87.5, 0, "Presenta deudas vencidas" , 1, 'C', 1, 0, '', '', true);
	$pdf->SetFillColor(200,200,200);
	$pdf->MultiCell(87.5, 0,"Antiguedad como proveedor", 1, 'C', 1, 1, '', '', true);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetFont('Arial', '', 8);
	$pdf->MultiCell(87.5, 0, $companyr , 1, 'C', 1, 0, '', '', true);
	$pdf->SetFillColor(255,255,255);
	$pdf->MultiCell(87.5, 0, $company->relationAge , 1, 'C', 1, 1, '', '', true);
	$pdf->SetFont('Arial', '', 10);
        $pdf->Cell('', '', '', '', 1, 'L');
        } 
    }
}