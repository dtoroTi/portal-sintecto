<?php
    // INFORMACIÓN DE EMPLEADOS
    $pdf->AddPage(); $pdf->SetY(30);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "INFORMACIÓN DE EMPLEADOS " , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Cargo" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Número" , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
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
    $pdf->MultiCell(50, 0, "Total Empleados" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $totalEmpleados , 1, 'C', 1, 1, '', '', true);


    // $pdf->writeHTMLCell(100, 50, 10, 10, 'Lorem ipsum... <img src="..." /> Curabitur at porta dui...');
    // $pdf->Image('images/image_demo.jpg', '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
    // $pdf->Image(Yii::app()->basePath . '/images/claro_logo.png', 10, 6);
    

    if(!isset($sectionCompanyEmployee[11]['questionAnswer']))
        $sectionCompanyEmployee[11]['questionAnswer'] = 0;
    if(!isset($sectionCompanyEmployee[12]['questionAnswer']))
        $sectionCompanyEmployee[12]['questionAnswer'] = 0;
    if(!isset($sectionCompanyEmployee[13]['questionAnswer']))
        $sectionCompanyEmployee[13]['questionAnswer'] = 0;

    $totalContratacion = $sectionCompanyEmployee[6]['questionAnswer'] + 
        $sectionCompanyEmployee[7]['questionAnswer'] +
        $sectionCompanyEmployee[11]['questionAnswer'] +
        $sectionCompanyEmployee[12]['questionAnswer'] +
        $sectionCompanyEmployee[13]['questionAnswer'];
    
    $totalContratacionMode = $sectionCompanyEmployee[8]['questionAnswer'] +
        $sectionCompanyEmployee[9]['questionAnswer'] +
        $sectionCompanyEmployee[10]['questionAnswer'];
    
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
    $pdf->MultiCell(50, 0, "Modalidad de Contratación" , 1, 'C', 1, 0, '', '', true);
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