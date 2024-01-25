<?php /*

$section = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_VISIT);

if ($section) {
    $pdf->pushFont();
    $pdf->AddPage();
    $pdf->SetY(30);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 5, "VISITA EMPRESARIAL " , 0, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetY(40);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(171, '', 'Durante la visita que se realizó a sus dependencias se pudo determinar lo siguiente:'
            , 0, 'J', FALSE, TRUE);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "Razón Social" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(120, 0, $backgroundCheck->companyName , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "NIT" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(120, 0, $backgroundCheck->formatedIdNumber , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "Dirección" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(120, 0, $backgroundCheck->address , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "Barrio" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(120, 0, $backgroundCheck->area , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "Ciudad" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(120, 0, $backgroundCheck->city , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(120, 0, $backgroundCheck->tels , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "Contacto" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(120, 0, $section->detailCompanyVisit->contact , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "Cargo" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(120, 0, $section->detailCompanyVisit->contactPosition , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', 2, '', '', 1, 'L');

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(170, 0, "Objeto Social" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(170, 0, $section->detailCompanyVisit->socialObject , 1, 'J', 1, 1, '', '', true);
    $pdf->Cell('', 2, '', '', 1, 'L');

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(170, 0, "Servicios y/o productos" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(170, 0, $section->detailCompanyVisit->services , 1, 'J', 1, 1, '', '', true);
    $pdf->Cell('', 2, '', '', 1, 'L');

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(170, 0, "Reseña Historica de la Empresa" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(170, 0, $section->detailCompanyVisit->companyHistory , 1, 'J', 1, 1, '', '', true);
    $pdf->Cell(10, '', '', '', 1, 'L');

    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_VISIT)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'J', 1, 1, '', '', true);
    }

    $shareholdersSection = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER);

   /* $pdf->checkNewPage();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell('', '', 'Socios de la empresa.', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');


   if ($shareholdersSection) {
        foreach ($shareholdersSection->detailShareholder as $shareholder) {
            if (trim($shareholder->participation) != "") {
                $pdf->checkNewPage();
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(31, '', 'Nombre : ', 0, 0, 'L', 0);
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->MultiCell(138, '', ($shareholder->appearsInClintonsList ? '*' : '') . CHtml::encode($shareholder->name), 0, 'J', FALSE, TRUE);
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(31, '', 'ID :', 0, 0, 'L', 0);
                $pdf->MultiCell(138, '', CHtml::encode($shareholder->idNumber), 0, 'J', FALSE, TRUE);
                $pdf->Cell(31, '', 'Tipo :', 0, 0, 'L', 0);
                $pdf->MultiCell(138, '', ($shareholder->isCompany ? 'Persona Jurídica' : 'Persona Natural'), 0, 'J', FALSE, TRUE);
                if (trim($shareholder->position) != "") {
                    $pdf->Cell(31, '', 'Cargo:', 0, 0, 'L', 0);
                    $pdf->MultiCell(138, '', CHtml::encode($shareholder->position), 0, 'J', FALSE, TRUE);
                }

                $pdf->Cell(31, '', 'Participación:', 0, 0, 'L', 0);
                $pdf->MultiCell(138, '', CHtml::encode($shareholder->participation) . '%', 0, 'J', FALSE, TRUE);
                $pdf->Cell('', '', '', '', 1, 'L');
            }
        }
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell('', '', '', '', 1, 'L');

   }



    // $employeesSection = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE);
    $sectionCompanyEmployee = null;
    if($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE))
	   $sectionCompanyEmployee = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE)->detailCompanyEmployee;


    if($sectionCompanyEmployee != null)
    {

        $pdf->AddPage();
	$pdf->SetY(30);

    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "RECURSOS HUMANOS" , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Cargo" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Número" , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);


   // foreach ($employeesSection->detailCompanyEmployee as $employee) {
           // $pdf->Cell(60, '', CHtml::encode($employee->sectionTypeQuestion->question), 1, 0, 'L');
           // $pdf->Cell(20, '', CHtml::encode($employee->questionAnswer), 1, 1, 'R');

	$pdf->MultiCell(50, 0, "Gerencia" , 1, 'C', 1, 0, '', '', true);
    	$pdf->MultiCell(50, 0, $sectionCompanyEmployee[0]['questionAnswer'] , 1, 'C', 1, 1, '', '', true);
    	$pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);	
	$pdf->MultiCell(50, 0, "Directivos" , 1, 'C', 1, 0, '', '', true);
    	$pdf->MultiCell(50, 0, $sectionCompanyEmployee[1]['questionAnswer'] , 1, 'C', 1, 1, '', '', true);
   	$pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    	$pdf->MultiCell(50, 0, "Coordinaciones" , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(50, 0, $sectionCompanyEmployee[2]['questionAnswer'] , 1, 'C', 1, 1, '', '', true);
	$pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    	$pdf->MultiCell(50, 0, "Asistenciales" , 1, 'C', 1, 0, '', '', true);
    	$pdf->MultiCell(50, 0, $sectionCompanyEmployee[3]['questionAnswer'] , 1, 'C', 1, 1, '', '', true);
    	$pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    	$pdf->MultiCell(50, 0, "Operativos" , 1, 'C', 1, 0, '', '', true);
    	$pdf->MultiCell(50, 0, $sectionCompanyEmployee[4]['questionAnswer'] , 1, 'C', 1, 1, '', '', true);
    	$pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    	$pdf->MultiCell(50, 0, "Staff" , 1, 'C', 1, 0, '', '', true);
    	$pdf->MultiCell(50, 0, $sectionCompanyEmployee[5]['questionAnswer'] , 1, 'C', 1, 1, '', '', true);
    	$pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);

	if (isset($sectionCompanyEmployee)) {
        $totalEmpleados = $sectionCompanyEmployee[0]['questionAnswer']+$sectionCompanyEmployee[1]['questionAnswer']+$sectionCompanyEmployee[2]['questionAnswer']+$sectionCompanyEmployee[3]['questionAnswer']+$sectionCompanyEmployee[4]['questionAnswer']+$sectionCompanyEmployee[5]['questionAnswer'];
    }

         $pdf->MultiCell(50, 0, "Total Empleados" , 1, 'C', 1, 0, '', '', true);
    	 $pdf->MultiCell(50, 0, $totalEmpleados , 1, 'C', 1, 1, '', '', true);


    if(!isset($sectionCompanyEmployee[6]['questionAnswer']))
         $sectionCompanyEmployee[6]['questionAnswer'] = 0;
    if(!isset($sectionCompanyEmployee[7]['questionAnswer']))
         $sectionCompanyEmployee[7]['questionAnswer'] = 0;
    if(!isset($sectionCompanyEmployee[8]['questionAnswer']))
         $sectionCompanyEmployee[8]['questionAnswer'] = 0;  
    if(!isset($sectionCompanyEmployee[9]['questionAnswer']))
        $sectionCompanyEmployee[9]['questionAnswer'] = 0;   
    if(!isset($sectionCompanyEmployee[10]['questionAnswer']))
        $sectionCompanyEmployee[10]['questionAnswer'] = 0;   

	if(!isset($sectionCompanyEmployee[11]['questionAnswer']))
        $sectionCompanyEmployee[11]['questionAnswer'] = 0;
    if(!isset($sectionCompanyEmployee[12]['questionAnswer']))
        $sectionCompanyEmployee[12]['questionAnswer'] = 0;
    if(!isset($sectionCompanyEmployee[13]['questionAnswer']))
        $sectionCompanyEmployee[13]['questionAnswer'] = 0;

    
    $totalContratacion = (isset($sectionCompanyEmployee[6]['questionAnswer'])?$sectionCompanyEmployee[6]['questionAnswer']:0)+
        (isset($sectionCompanyEmployee[7]['questionAnswer'])?$sectionCompanyEmployee[7]['questionAnswer']:0)+
        (isset($sectionCompanyEmployee[11]['questionAnswer'])?$sectionCompanyEmployee[11]['questionAnswer']:0)+
        (isset($sectionCompanyEmployee[12]['questionAnswer'])?$sectionCompanyEmployee[12]['questionAnswer']:0)+
        (isset($sectionCompanyEmployee[13]['questionAnswer'])?$sectionCompanyEmployee[13]['questionAnswer']:0);

    

    $totalContratacionMode = 
        (isset($sectionCompanyEmployee[8]['questionAnswer'])?$sectionCompanyEmployee[8]['questionAnswer']:0)+
        (isset($sectionCompanyEmployee[9]['questionAnswer'])?$sectionCompanyEmployee[9]['questionAnswer']:0)+
        (isset($sectionCompanyEmployee[10]['questionAnswer'])?$sectionCompanyEmployee[10]['questionAnswer']:0);

	 function percentNumber($a){
        $ans = number_format(($a * 100), 2) . '%';
        return $ans;
    }


	function divideNumbers($a, $b){
        if ($a != 0 && $b != 0) {
            $ans = $a / $b;
        } else {
            $ans = '0';
        }
        return $ans;
    }


    
    $contratacionFijo = percentNumber(divideNumbers($sectionCompanyEmployee[6]['questionAnswer'], $totalContratacion));
    $contratacionIndefinido = percentNumber(divideNumbers($sectionCompanyEmployee[7]['questionAnswer'], $totalContratacion));
    
    $contratacionObraLabor = percentNumber(divideNumbers($sectionCompanyEmployee[11]['questionAnswer'], $totalContratacion));
    $contratacionAprendiz = percentNumber(divideNumbers($sectionCompanyEmployee[12]['questionAnswer'], $totalContratacion));
    $contratacionServicios = percentNumber(divideNumbers($sectionCompanyEmployee[13]['questionAnswer'], $totalContratacion));
    
    
    $contratacionDirecto = percentNumber(divideNumbers($sectionCompanyEmployee[8]['questionAnswer'], $totalContratacionMode));
    $contratacionTemporal = percentNumber(divideNumbers($sectionCompanyEmployee[9]['questionAnswer'], $totalContratacionMode));
    $contratacionOtros = percentNumber(divideNumbers($sectionCompanyEmployee[10]['questionAnswer'], $totalContratacionMode));

    

    
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Tipo de Contrato " , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, "100%" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Fijo" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $contratacionFijo , 1, 'C', 1, 1, '', '', true);

    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Indefinido" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $contratacionIndefinido , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Obra Labor" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $contratacionObraLabor , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Aprendiz" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $contratacionAprendiz , 1, 'C', 1, 1, '', '', true);
    
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Servicios" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $contratacionServicios , 1, 'C', 1, 1, '', '', true);
    
    
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Modalidad de Contrataci�n" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, "100%" , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Directo" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $contratacionDirecto , 1, 'C', 1, 1, '', '', true);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Temporal" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $contratacionTemporal , 1, 'C', 1, 1, '', '', true);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Otros" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $contratacionOtros , 1, 'C', 1, 1, '', '', true);

    $ansComments = $backgroundCheck->getVerificationSection(18)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'J', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');





       // if (trim($employeesSection->comments) != "") {
       //     $pdf->MultiCell(171, '', $employeesSection->comments, 0, 'J', FALSE, TRUE);
       //     $pdf->Cell('', '', '', '', 1, 'L');
       // } 
      }  





//
//    $pdf->SetFont('Arial', '', 12);

    $customersSection = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER);

    if($customersSection != null)
    { 

    $pdf->AddPage();
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255); $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "REFERENCIAS COMERCIALES" , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);




        foreach ($customersSection->detailCompanyCustomer as $customer) {

            if($backgroundCheck->customer->customerGroupId==559){

                if ($customer->deliveryCompliance == "0" ) {
                    $entrega= "";
                } else if ($customer->deliveryCompliance == "1" ) {
                    $entrega= "Deficiente";
                } else if ($customer->deliveryCompliance == "2" ) {
                    $entrega= "Regular";
                } else if ($customer->deliveryCompliance == "3" ) {
                    $entrega= "Bueno";
                } else if ($customer->deliveryCompliance == "4" ) {
                    $entrega= "Excelente";
                }else {
                    $entrega= "";}


                if ($customer->productsQuality == "0" ) {
                    $servicio= "";
                } else if ($customer->productsQuality == "1" ) {
                    $servicio= "Deficiente";
                } else if ($customer->productsQuality == "2" ) {
                    $servicio= "Regular";
                } else if ($customer->productsQuality == "3" ) {
                    $servicio= "Bueno";
                } else if ($customer->productsQuality == "4" ) {
                    $servicio= "Excelente";
                }else {
                    $servicio= "";}


                if ($customer->prices == "0" ) {
                    $precio= "";
                } else if ($customer->prices == "1" ) {
                    $precio= "Deficiente";
                } else if ($customer->prices == "2" ) {
                    $precio= "Regular";
                } else if ($customer->prices == "3" ) {
                    $precio= "Bueno";
                } else if ($customer->prices == "4" ) {
                    $precio= "Excelente";
                }else {
                    $precio= "";}


                if ($customer->postSalesService == "0" ) {
                    $pqr= "";
                } else if ($customer->postSalesService == "1" ) {
                    $pqr= "Deficiente";
                } else if ($customer->postSalesService == "2" ) {
                    $pqr= "Regular";
                } else if ($customer->postSalesService == "3" ) {
                    $pqr= "Bueno";
                } else if ($customer->postSalesService == "4" ) {
                    $pqr= "Excelente";
                }else {
                    $pqr= "";}

            } else{
                if ($customer->deliveryCompliance == "0" ) {
                    $entrega= "";
                } else if ($customer->deliveryCompliance == "1" ) {
                    $entrega= "No Apto";
                } else if ($customer->deliveryCompliance == "2" ) {
                    $entrega= "Regular";
                } else if ($customer->deliveryCompliance == "3" ) {
                    $entrega= "Bueno";
                } else if ($customer->deliveryCompliance == "4" ) {
                    $entrega= "Excelente";
                }else {
                    $entrega= "";}


                if ($customer->productsQuality == "0" ) {
                    $servicio= "";
                } else if ($customer->productsQuality == "1" ) {
                    $servicio= "No Apto";
                } else if ($customer->productsQuality == "2" ) {
                    $servicio= "Regular";
                } else if ($customer->productsQuality == "3" ) {
                    $servicio= "Bueno";
                } else if ($customer->productsQuality == "4" ) {
                    $servicio= "Excelente";
                }else {
                    $servicio= "";}


                if ($customer->prices == "0" ) {
                    $precio= "";
                } else if ($customer->prices == "1" ) {
                    $precio= "No Apto";
                } else if ($customer->prices == "2" ) {
                    $precio= "Regular";
                } else if ($customer->prices == "3" ) {
                    $precio= "Bueno";
                } else if ($customer->prices == "4" ) {
                    $precio= "Excelente";
                }else {
                    $precio= "";}


                if ($customer->postSalesService == "0" ) {
                    $pqr= "";
                } else if ($customer->postSalesService == "1" ) {
                    $pqr= "No Apto";
                } else if ($customer->postSalesService == "2" ) {
                    $pqr= "Regular";
                } else if ($customer->postSalesService == "3" ) {
                    $pqr= "Bueno";
                } else if ($customer->postSalesService == "4" ) {
                    $pqr= "Excelente";
                }else {
                    $pqr= "";}
            }

            $pdf->SetFillColor(200,200,200);
            $pdf->MultiCell(50, 0, "Razón Social" , 1, 'L', 1, 0, '', '', true);
            $pdf->SetFillColor(255,255,255);
            $pdf->MultiCell(120, 0, $customer->companyName , 1, 'L', 1, 1, '', '', true);
            $pdf->SetFillColor(200,200,200);
            $pdf->MultiCell(50, 0, "Contacto" , 1, 'L', 1, 0, '', '', true);
            $pdf->SetFillColor(255,255,255);
            $pdf->MultiCell(120, 0, $customer->contactName , 1, 'L', 1, 1, '', '', true);
            $pdf->SetFillColor(200,200,200);
            $pdf->MultiCell(50, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
            $pdf->SetFillColor(255,255,255);
            $pdf->MultiCell(120, 0, $customer->tel , 1, 'L', 1, 1, '', '', true);
            $pdf->SetFillColor(200,200,200);
            $pdf->MultiCell(50, 0, "Servicios Productos" , 1, 'L', 1, 0, '', '', true);
            $pdf->SetFillColor(255,255,255);
            $pdf->MultiCell(120, 0, $customer->services , 1, 'L', 1, 1, '', '', true);
            $pdf->SetFillColor(200,200,200);
            if($backgroundCheck->customer->customerGroupId==559){

                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(42.5, 0, "Entrega" , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(42.5, 0, "Servicio" , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(42.5, 0, "Calidad" , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(42.5, 0, "Disposición" , 1, 'C', 1, 1, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(42.5, 0, $entrega , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(42.5, 0, $servicio , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(42.5, 0, $precio , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(42.5, 0, $pqr , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', '', '', '', 1, 'L');

            } else {
                $pdf->MultiCell(50, 0,"Antiguedad como proveedor", 1, 'L', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(120, 0, $customer->relationAge , 1, 'L', 1, 1, '', '', true);
                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(42.5, 0, "Entrega" , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(42.5, 0, "Servicio" , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(42.5, 0, "Precio" , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(200,200,200);
                $pdf->MultiCell(42.5, 0, "PQR" , 1, 'C', 1, 1, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(42.5, 0, $entrega , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(42.5, 0, $servicio , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(42.5, 0, $precio , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->MultiCell(42.5, 0, $pqr , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', '', '', '', 1, 'L');
            }
        }
        
    $ansComments = null;

    if($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)!=null)
        $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->comments;
        

        if($ansComments != null){
        
        	$pdf->SetFont('Arial', 'B', 9);
        	$pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
        	$pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
        	$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
       	    $pdf->SetFont('Arial', 'I', 9);
       	    $pdf->MultiCell(170, 0, $ansComments , 1, 'J', 1, 1, '', '', true);
        	$pdf->Cell('', '', '', '', 1, 'L');    }
        }    

    $providersSection = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_PROVIDER);

    if($providersSection != null)
    {


    $pdf->AddPage();
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255); $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "REFERENCIAS  A PROVEEDORES" , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);




        foreach ($providersSection->detailCompanyProvider as $customer) {

	if ($customer->presentsDebts == "0" ) {
        $customerr= "NO";
   	} else if ($customer->presentsDebts == "1" ) {
        $customerr= "SI";}
	else {
        $customerr= "";}


	$pdf->SetFillColor(200,200,200);
        $pdf->MultiCell(40, 0, "Razón Social" , 1, 'L', 1, 0, '', '', true);
	$pdf->SetFillColor(255,255,255);
        $pdf->MultiCell(130, 0, $customer->companyName , 1, 'L', 1, 1, '', '', true);
	$pdf->SetFillColor(200,200,200);
        $pdf->MultiCell(40, 0, "Contacto" , 1, 'L', 1, 0, '', '', true);
	$pdf->SetFillColor(255,255,255);
        $pdf->MultiCell(130, 0, $customer->contactName , 1, 'L', 1, 1, '', '', true);
	$pdf->SetFillColor(200,200,200);
        $pdf->MultiCell(40, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
	$pdf->SetFillColor(255,255,255);
        $pdf->MultiCell(130, 0, $customer->tel , 1, 'L', 1, 1, '', '', true);
	$pdf->SetFillColor(200,200,200);
        $pdf->MultiCell(40, 0, "Servicios Productos" , 1, 'L', 1, 0, '', '', true);
	$pdf->SetFillColor(255,255,255);
        $pdf->MultiCell(130, 0, $customer->services , 1, 'L', 1, 1, '', '', true);
	$pdf->SetFillColor(200,200,200);
	$pdf->MultiCell(85, 0, "Presenta deudas vencidas" , 1, 'C', 1, 0, '', '', true);
	$pdf->SetFillColor(200,200,200);
	$pdf->MultiCell(85, 0,"Antiguedad como proveedor", 1, 'C', 1, 1, '', '', true);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetFont('Arial', '', 8);
	$pdf->MultiCell(85, 0, $customerr , 1, 'C', 1, 0, '', '', true);
	$pdf->SetFillColor(255,255,255);
	$pdf->MultiCell(85, 0, $customer->relationAge , 1, 'C', 1, 1, '', '', true);
	$pdf->SetFont('Arial', '', 10);
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

    }

    $this->renderPartial('/document/_documentsPDF', array(
        'backgroundCheck' => $backgroundCheck,
        'height' => '',
        'documents' => $backgroundCheck->getDocumentsInVerificationSection(VerificationSectionType::DETAIL_COMPANY_VISIT),
        'pdf' => $pdf,
            )
    );

    $pdf->popFont();


*/
