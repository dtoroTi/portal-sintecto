<?php
    $pdf->AddPage();
    $pdf->SetY(30);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255);
    $pdf->MultiCell(170, 0, "INFORMACIÓN DE LA COMPAÑÍA"  , 0, 'C', 1, 1, '', '', true);
    $pdf->SetTextColor($txBlack);
    $pdf->Cell('', '', '', '', 1, 'L');


    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 170 , 5, "Objeto Social:" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 170 , 5, $sectionCompanyVisit->socialObject , 1, 'L', 1, 1, '', '', true);
    
    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 170 , 5, "Servicios y Productos Ofrecidos:" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 170 , 5, $sectionCompanyVisit->services , 1, 'L', 1, 1, '', '', true);
    
    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 125 , 5, "Años de Actividad en el mercado:" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 45 , 5, $backgroundCheck->yearsOfActivity . " años", 1, 'L', 1, 1, '', '', true);

    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 170 , 5, "Reseña Histórica:" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 170 , 5, $sectionCompanyVisit->companyHistory , 1, 'L', 1, 1, '', '', true);
    
    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 25 , 5, "Ventas anuales:" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 60 , 5, $XMLQuestionResult['adicionalClaro_7'] , 1, 'L', 1, 0, '', '', true);

    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 25 , 5, "No. Empleados:" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 60 , 5, $totalEmpleados , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 25 , 5, "Cobertura:" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 145 , 5, $XMLQuestionResult['adicionalClaro_5'] , 1, 'L', 1, 1, '', '', true);
    if($XMLQuestionResult['adicionalClaro_5_comment'] != ""){
        $pdf->SetFillColor(255,255,255); $pdf->SetFont('Arial', 'I', 7);
        $pdf->MultiCell(170, 0, "Comentarios: " . $XMLQuestionResult['adicionalClaro_5_comment'] , 1, 'L', 1, 1, '', '', true);
    }
    $pdf->Cell('', '', '', '', 1, 'L');

 if($pdf->GetY()>= 200){
    $pdf->AddPage(); $pdf->SetY(30);
}
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255);
    $pdf->MultiCell(170, 0, "INFORMACIÓN TRIBUTARIA"  , 0, 'C', 1, 1, '', '', true);

    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 25 , 5, "Estado:" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);

    //MATRICULA MERCANTIL RENOVADA
    if($XMLQuestionResult['listaResctrictiva_9'] = "SI"){
        $companyStatus = "ACTIVO";
        $pdf->SetTextColor(0,152,0);
    } else {
        $companyStatus = "INACTIVO";
        $pdf->SetTextColor(255,0,0);
    }

    $pdf->MultiCell( 60 , 5, $companyStatus , 1, 'L', 1, 0, '', '', true);
    
    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 25 , 5, "Renta:" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 60 , 5, $XMLQuestionResult['taxrenttype'] , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 25 , 5, "Municipio:" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 60 , 5, $XMLQuestionResult['icacity'] , 1, 'L', 1, 0, '', '', true);
    
    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 25 , 5, "IVA:" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 60 , 5, $XMLQuestionResult['taxivatype'] , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 25 , 5, "ICA:" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 60 , 5, $XMLQuestionResult['icacvalue'] , 1, 'L', 1, 0, '', '', true);
    
    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 25 , 5, "Tarifa ICA:" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 60 , 5, $XMLQuestionResult['taxicatype'] , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');


    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255);
    $pdf->MultiCell(170, 0, "INFORMACIÓN BANCARIA"  , 0, 'C', 1, 1, '', '', true);

    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 25 , 5, "Banco:" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 60 , 5, $XMLQuestionResult['bankname'] , 1, 'L', 1, 0, '', '', true);
    
    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 25 , 5, "Titular:" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 60 , 5, $XMLQuestionResult['bankaccountholder'] , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 25 , 5, "Tipo:" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 60 , 5, $XMLQuestionResult['bankaccounttype'] , 1, 'L', 1, 0, '', '', true);
    
    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(220); $pdf->SetTextColor(0);
    $pdf->MultiCell( 25 , 5, "No. Cuenta:" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 8); $pdf->SetFillColor($bgWhite); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 60 , 5, $XMLQuestionResult['bankaccount'] , 1, 'L', 1, 1, '', '', true);



    // print_r ($sectionCompanyVisit); die;