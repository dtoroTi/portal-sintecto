<?php
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "RESUMEN DE EVALUACIÓN"  , 0, 'C', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(60, 0, '' , 0, 'L', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "EVALUACIÓN FINAL"  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(60, 0, '' , 0, 'L', 0, 0, '', '', true);


    if ($resultString == "CLASIFICA / BUENO" || $resultString == "CLASIFICA / REGULAR") {
        $pdf->SetTextColor(0,152,0);
    } else {
        $pdf->SetTextColor(255,0,0);
    };

    $pdf->MultiCell(50, 0, $resultString , 1, 'C', 0, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->MultiCell(60, 0, '' , 0, 'L', 0, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, $resultValueString , 1, 'C', 0, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');

    

    // 2 part
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(28.3, 0, "ANTIGÜEDAD"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "FINANCIERO"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "CALIDAD"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "SG-SST"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "COMPRAS"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "SERVICIO"  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);

    if ($resultAntiguedad == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $resultAntiguedad  , 1, 'C', 1, 0, '', '', true);
    if ($resultFinanciero == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $resultFinanciero  , 1, 'C', 1, 0, '', '', true);
    if ($resultCalidad == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $resultCalidad  , 1, 'C', 1, 0, '', '', true);
    if ($resultSgsst == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $resultSgsst  , 1, 'C', 1, 0, '', '', true);
    if ($resultCompras == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $resultCompras  , 1, 'C', 1, 0, '', '', true);
    if ($resultServicios == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $resultServicios  , 1, 'C', 1, 0, '', '', true);
    
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(28.3, 0, "4% " , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "35% " , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "10% " , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "10% " , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "5% " , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "5% " , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(28.3, 0, "REFERENCIAS"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "PROVEEDORES"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "RRHH"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "INFRAESTRUCT"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "COBERTURA"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "LEGAL/LAFT"  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
        
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    if ($resultReferencias == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $resultReferencias  , 1, 'C', 1, 0, '', '', true);
    if ($resultProveedores == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $resultProveedores  , 1, 'C', 1, 0, '', '', true);
    if ($resultRrhh == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $resultRrhh  , 1, 'C', 1, 0, '', '', true);
    if ($resultInfraestructura == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $resultInfraestructura  , 1, 'C', 1, 0, '', '', true);
    if ($resultCobertura == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $resultCobertura  , 1, 'C', 1, 0, '', '', true);
    if ($resultLegal == "CH" ) { $pdf->SetTextColor(255,0,0);} else{ $pdf->SetTextColor(0,152,0);};
    $pdf->MultiCell(28.3, 0, $resultLegal  , 1, 'C', 1, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(28.3, 0, "10%"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "5%"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "6%"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "5%"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(28.3, 0, "5%"  , 1, 'C', 1, 0, '', '', true);
    // $pdf->MultiCell(28.3, 0, pondCalc("peso", $valFinantialAnalisys, $pondNationalRisk['financiero']['value'], $pondNationalRisk['financiero']['weight'] )  , 1, 'C', 1, 0, '', '', true); // PONDERADO DE FINANZAS
    $pdf->MultiCell(28.3, 0, "0%"  , 1, 'C', 1, 0, '', '', true);
    
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "CONCEPTO FINAL"  , 0, 'C', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', '', 12);
    
    // Always use the Result Ignore the comments
    if (true || trim($backgroundCheck->comments) == "") {
        if ($backgroundCheck->resultId == Result::FAVORABLE) {
            $finalComments = 'Realizada la Evaluación de la Empresa '
                    . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                    . 'se puede concluir que bajo la Óptica de Seguridad NO '
                    . 'presenta ningún aspecto que amerite emitir un concepto '
                    . 'negativo para su contratación, de acuerdo con las '
                    . 'actividades que puede desarrollar según su Objeto Social.';
        } elseif ($backgroundCheck->resultId == Result::NO_FAVORABLE) {
            $finalComments = 'Realizada la Evaluación de la Empresa '
                    . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                    . 'se puede concluir que bajo la Óptica de Seguridad Presenta '
                    . 'aspectos que ameritan emitir un concepto No Favorable '
                    . 'para su contratación, de acuerdo con las actividades '
                    . 'que puede desarrollar según su Objeto Social.';
        } else {
            $finalComments = ' ************    ESTE ESTUDIO NO TIENE RESULTADO AUN  *********** ';
        }
    } else {
        $finalComments = $backgroundCheck->comments;
    }

    $pdf->MultiCell(171, '', $finalComments, 0, 'J', FALSE, TRUE);

    // RESUMEN CALIFICACIÓN OBTENIDA
    $pdf->AddPage();
    $pdf->SetY(25);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "RESUMEN CALIFICACIÓN OBTENIDA"  , 0, 'C', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(80, 5, "REQUISITOS" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, "P. Obtenido" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, "P. Posible" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, "Calificación" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(80, 5, "1. AÑOS EN EL MERCADO" , 1, 'L', 1, 0, '', '', true);
   

    $value = $pondNationalRisk['antiguedad']['value'];
    $weight = $pondNationalRisk['antiguedad']['weight'];
    $points_0 = 4;  $questionValue_0 = 4;
    $points = $points_0;
    $pdf->MultiCell(30, 5, $points , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, $value , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, pondCalc("peso", $points , $value, $weight) , 1, 'C', 1, 1, '', '', true);
    // PR
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Años de Actividad en el mercado" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_0, $questionValue_0 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(80, 5, "2. INFORMACIÓN FINANCIERA" , 1, 'L', 1, 0, '', '', true);
    $value = $pondNationalRisk['financiero']['value'];
    $weight = $pondNationalRisk['financiero']['weight'];
    
    $points_0 = 1;  $questionValue_0 = 1;
    $points_1 = 2;  $questionValue_1 = 2;
    $points_2 = 2;  $questionValue_2 = 2;
    $points_3 = 1;  $questionValue_3 = 1;
    $points_4 = 1;  $questionValue_4 = 1;
    $points_5 = 1;  $questionValue_5 = 1;
    $points_6 = 2;  $questionValue_6 = 2;
    $points_7 = 1;  $questionValue_7 = 1;
    $points_8 = 1;  $questionValue_8 = 1;
    $points_9 = 1;  $questionValue_9 = 1;
    $points_10 = 1;  $questionValue_10 = 1;
    $points = $points_0 + $points_1 + $points_2 + $points_3 + $points_4 + $points_5 + $points_6 + $points_7 + $points_8 + $points_9 + $points_10;
    $pdf->MultiCell(30, 5, $points , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, $value , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, pondCalc("peso", $points , $value, $weight) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Razón Corriente" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_0, $questionValue_0 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Capital de Trabajo" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_1, $questionValue_1 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Nivel de Endeudamiento" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_2, $questionValue_2 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Endeudamiento Financiero" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_2, $questionValue_2 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Apalancamiento Corto Plazo" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_3 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_3 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_3, $questionValue_3 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Rentabilidad Operativa Activo (ROA)" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_4 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_4 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_4, $questionValue_4 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Margen EBITDA" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_5 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_5 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_5, $questionValue_5 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Endeudamiento/Ventas" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_6 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_6 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_6, $questionValue_6 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Cobertura de Gastos No Oper." , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_7 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_7 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_7, $questionValue_7 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Utilidades Acumuladas" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_6 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_6 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_6, $questionValue_6 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Ventas Vs. Resultado Neto" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_7 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_7 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_7, $questionValue_7 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);


    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(80, 5, "3. GESTIÓN DE CALIDAD" , 1, 'L', 1, 0, '', '', true);
    $value = 27.5;
    $weight = 10;
    $points_0 = 6;  $questionValue_0 = 6;
    $points_1 = 4;  $questionValue_1 = 4;
    $points_2 = 4;  $questionValue_2 = 4;
    $points_3 = 4;  $questionValue_3 = 4;
    $points_4 = 2;  $questionValue_4 = 2;
    $points_5 = 1;  $questionValue_5 = 1;
    $points_6 = 1;  $questionValue_6 = 1;
    $points_7 = 1.5;  $questionValue_7 = 1.5;
    $points_8 = 2;  $questionValue_8 = 2;
    $points_9 = 1;  $questionValue_9 = 1;
    $points_10 = 1;  $questionValue_10 = 1;
    $points = $points_0 + $points_1 + $points_2 + $points_3 + $points_4 + $points_5 + $points_6 + $points_7 + $points_8 + $points_9 + $points_10;
    $pdf->MultiCell(30, 5, $points , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, $value , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, pondCalc("peso", $points , $value, $weight) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Certificación ISO 9001" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_0, $questionValue_0 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Certificación ISO 14001" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_1, $questionValue_1 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Certificación ISO 18000" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_2, $questionValue_2 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Certificación ISO 27001" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_3 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_3 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_3, $questionValue_3 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Manual de Calidad Documentado" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_4 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_4 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_4, $questionValue_4 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Política de Calidad declarada" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_5 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_5 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_5, $questionValue_5 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Mapa de procesos" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_6 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_6 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_6, $questionValue_6 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Caracterización de Procesos" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_7 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_7 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_7, $questionValue_7 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"Manuales de Procedimientos Documentados",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_8 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_8 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_8, $questionValue_8 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"Organigrama de la Compañía",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_9 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_9 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_9, $questionValue_9 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"Planeación estratégica (misión, visión)",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_10 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_10 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_10, $questionValue_10 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(80, 5, "4. GESTIÓN DE SEGURIDAD Y SALUD OCUPACIONAL" , 1, 'L', 1, 0, '', '', true);
    $value = 49;
    $weight = 10;
    $points_0 = 10;  $questionValue_0 = 10;
    $points_1 = 6;  $questionValue_1 = 6;
    $points_2 = 7;  $questionValue_2 = 7;
    $points_3 = 4;  $questionValue_3 = 4;
    $points_4 = 4;  $questionValue_4 = 4;
    $points_5 = 4;  $questionValue_5 = 4;
    $points_6 = 4;  $questionValue_6 = 4;
    $points_7 = 6;  $questionValue_7 = 6;
    $points_8 = 4;  $questionValue_8 = 4;
    $points_9 = 0;  $questionValue_9 = 0;
    $points_10 = 0;  $questionValue_10 = 0;
    $points = $points_0 + $points_1 + $points_2 + $points_3 + $points_4 + $points_5 + $points_6 + $points_7 + $points_8 + $points_9 + $points_10;
    $pdf->MultiCell(30, 5, $points , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, $value , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, pondCalc("peso", $points , $value, $weight) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "SG-SST (PSO) declarado" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_0, $questionValue_0 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "COPASST" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_1, $questionValue_1 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Plan de emergencias declarado" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_2, $questionValue_2 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Esquema de manejo de Incidentes definido" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_3 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_3 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_3, $questionValue_3 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Matriz de peligros" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_4 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_4 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_4, $questionValue_4 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Reglamento Interno de trabajo" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_5 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_5 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_5, $questionValue_5 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Reglamento de Higiene y Seguridad Industrial" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_6 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_6 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_6, $questionValue_6 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Entrega de dotación y epp's" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_7 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_7 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_7, $questionValue_7 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Fichas técnicas de epp's" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_8 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_8 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_8, $questionValue_8 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(80, 5, "5. GESTIÓN DE COMPRAS" , 1, 'L', 1, 0, '', '', true);
    $value = 4;
    $weight = 5;
    $points_0 = 2;  $questionValue_0 = 2;
    $points_1 = 2;  $questionValue_1 = 2;

    $points = $points_0 + $points_1;
    $pdf->MultiCell(30, 5, $points , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, $value , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, pondCalc("peso", $points , $value, $weight) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Base de datos de proveedores" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_0, $questionValue_0 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Evaluación periódica de sus proveedores" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_1, $questionValue_1 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->AddPage();   
    $pdf->SetY(25);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(80, 5, "6. GESTIÓN COMERCIAL Y CONFIANZA EN EL SERVICIO" , 1, 'L', 1, 0, '', '', true);
    $value = 12;
    $weight = 5;
    $points_0 = 2;  $questionValue_0 = 2;
    $points_1 = 2;  $questionValue_1 = 2;
    $points_2 = 2;  $questionValue_2 = 2;
    $points_3 = 2;  $questionValue_3 = 2;
    $points_4 = 2;  $questionValue_4 = 2;
    $points_5 = 2;  $questionValue_5 = 2;
 
    $points = $points_0 + $points_1 + $points_2 + $points_3 + $points_4 + $points_5;
    $pdf->MultiCell(30, 5, $points , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, $value , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, pondCalc("peso", $points , $value, $weight) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Asignación de ejecutivo de cuenta" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_0, $questionValue_0 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Cuentan con una sede para atención al cliente" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_1, $questionValue_1 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Servicio Post venta" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_2, $questionValue_2 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Garantías en productos y servicios" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_3 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_3 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_3, $questionValue_3 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Servicio de mantenimiento técnico" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_4 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_4 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_4, $questionValue_4 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Pólizas de seguros" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_5 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_5 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_5, $questionValue_5 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(80, 5, "7. REFERENCIAS COMERCIALES DE CLIENTES" , 1, 'L', 1, 0, '', '', true);
    $value = 20;
    $weight = 10;
    $points_0 = 4;  $questionValue_0 = 4;
    $points_1 = 4;  $questionValue_1 = 4;
    $points_2 = 4;  $questionValue_2 = 4;
    $points_3 = 4;  $questionValue_3 = 4;
    $points_4 = 4;  $questionValue_4 = 4;

    $points = $points_0 + $points_1 + $points_2 + $points_3 + $points_4;
    $pdf->MultiCell(30, 5, $points , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, $value , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, pondCalc("peso", $points , $value, $weight) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Puntualidad en los tiempos de entrega" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_0, $questionValue_0 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Calidad del producto o servicio" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_1, $questionValue_1 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Atención al cliente" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_2, $questionValue_2 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Rapidez para atender quejas y reclamos" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_3 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_3 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_3, $questionValue_3 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Precio frente a la competencia" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_4 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_4 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_4, $questionValue_4 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(80, 5, "8. PROVEEDORES" , 1, 'L', 1, 0, '', '', true);
    $value = 6;
    $weight = 5;
    $points_0 = 2;  $questionValue_0 = 2;
    $points_1 = 4;  $questionValue_1 = 4;

    $points = $points_0 + $points_1;
    $pdf->MultiCell(30, 5, $points , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, $value , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, pondCalc("peso", $points , $value, $weight) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "¿Presenta deudas vencidas con los proveedores referidos?" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_0, $questionValue_0 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "¿Más del 50% de los proveedores referidos, como lo califica como cliente?" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_1, $questionValue_1 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
$pdf->MultiCell(80, 5, "9. RECURSOS HUMANOS" , 1, 'L', 1, 0, '', '', true);
$value = 17;
$weight = 6;
$points_0 = 3;  $questionValue_0 = 3;
$points_1 = 3;  $questionValue_1 = 3;
$points_2 = 2;  $questionValue_2 = 2;
$points_3 = 3;  $questionValue_3 = 3;
$points_4 = 2;  $questionValue_4 = 2;
$points_5 = 4;  $questionValue_5 = 4;

$points = $points_0 + $points_1 + $points_2 + $points_3 + $points_4 + $points_5;
    $pdf->MultiCell(30, 5, $points , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, $value , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(30, 5, pondCalc("peso", $points , $value, $weight) , 1, 'C', 1, 1, '', '', true);

$pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(80, 5, "Revision de Antecedentes Judiciales a empleados" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(30, 5, $points_0 , 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 5, $questionValue_0 , 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 5, valCalc( "peso", $points_0, $questionValue_0 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
    
$pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(80, 5, "Comité de convivencia(Acta de conformación, cumplimiento reuniones trimestrales)" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(30, 5, $points_1 , 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 5, $questionValue_1 , 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 5, valCalc( "peso", $points_1, $questionValue_1 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

$pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(80, 5, "Cronograma de capacitación documentado" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(30, 5, $points_2 , 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 5, $questionValue_2 , 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 5, valCalc( "peso", $points_2, $questionValue_2 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

$pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(80, 5, "Medición de desempeño a los empleados" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(30, 5, $points_3 , 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 5, $questionValue_3 , 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 5, valCalc( "peso", $points_3, $questionValue_3 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

$pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(80, 5, "Manual de Funciones. Perfil del Cargo" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(30, 5, $points_4 , 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 5, $questionValue_4 , 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 5, valCalc( "peso", $points_4, $questionValue_4 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

$pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(80, 5, "Pago de seguridad social" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(30, 5, $points_5 , 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 5, $questionValue_5 , 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 5, valCalc( "peso", $points_5, $questionValue_5 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

$pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(80, 5, "Utiliza CTA para la contratación de personal" , 1, 'L', 1, 0, '', '', true);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(30, 5, $points_6 , 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 5, $questionValue_6 , 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 5, valCalc( "peso", $points_6, $questionValue_6 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);


    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(80, 5, "10. INFRAESTRUCTURA" , 1, 'L', 1, 0, '', '', true);
    $value = 12;
    $weight = 5;
    $points_0 = 4;  $questionValue_0 = 4;
    $points_1 = 4;  $questionValue_1 = 4;
    $points_2 = 4;  $questionValue_2 = 4;

    $points = $points_0 + $points_1 + $points_2;
    $pdf->MultiCell(30, 5, $points , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, $value , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, pondCalc("peso", $points , $value, $weight) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Infraestructura Fisica" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_0, $questionValue_0 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Infraestructura informatica y de comunicaciones" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_1, $questionValue_1 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Maquinaria y Equipo" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_2, $questionValue_2 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(80, 5, "11. COBERTURA DEL SERVICIO" , 1, 'L', 1, 0, '', '', true);
    $value = 9;
    $weight = 5;
    $points_0 = 2;  $questionValue_0 = 2;
    $points_1 = 3;  $questionValue_1 = 3;
    $points_2 = 4;  $questionValue_2 = 4;

    $points = $points_0 + $points_1 + $points_2;
    $pdf->MultiCell(30, 5, $points , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, $value , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, pondCalc("peso", $points , $value, $weight) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Cobertura Local" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_0, $questionValue_0 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Cobertura Nacional" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_1, $questionValue_1 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(220,220,220); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 5, "Cobertura Internacional" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_2, $questionValue_2 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);
        
    $pdf->SetFont('Arial',"",10);$pdf->SetFillColor(0,66,109);$pdf->SetTextColor(255,255,255);
    $pdf->Multicell(80,5,"12. INFORMACIÓN LEGAL(LISTAS SANCIONADAS)",1,'L',1,0," "," ",true);$value = 49;
    $weight = 10;
    $points_0 = 10;  $questionValue_0 = 10;
    $points_1 = 6;  $questionValue_1 = 6;
    $points_2 = 7;  $questionValue_2 = 7;
    $points_3 = 4;  $questionValue_3 = 4;
    $points_4 = 4;  $questionValue_4 = 4;
    $points_5 = 4;  $questionValue_5 = 4;
    $points_6 = 4;  $questionValue_6 = 4;
    $points_7 = 6;  $questionValue_7 = 6;
    $points_8 = 4;  $questionValue_8 = 4;
    $points_9 = 0;  $questionValue_9 = 0;
    $points_10 = 0;  $questionValue_10 = 0;
    $points_11 = 0;  $questionValue_11 = 0;
    $points = $points_0 + $points_1 + $points_2 + $points_3 + $points_4 + $points_5 + $points_6 + $points_7 + $points_8 + $points_9 + $points_10;
    $pdf->MultiCell(30, 5, $points , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, $value , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 5, pondCalc("peso", $points , $value, $weight) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFont('Arial',"",10);$pdf->SetFillColor(220,220,220);$pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"CLINTON",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_0 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_0, $questionValue_0 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial',"",10);$pdf->SetFillColor(220,220,220);$pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"ONU",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_1 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_1, $questionValue_1 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial',"",10);$pdf->SetFillColor(220,220,220);$pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"INTERPOL",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_2 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_2, $questionValue_2 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial',"",10);$pdf->SetFillColor(220,220,220);$pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"Reino Unido",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_3 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_3 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_3, $questionValue_3 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial',"",10);$pdf->SetFillColor(220,220,220);$pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"Union Europea",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_4 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_4 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_4, $questionValue_4 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial',"",10);$pdf->SetFillColor(220,220,220);$pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"Proveedores Ficticios",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_5 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_5 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_5, $questionValue_5 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial',"",10);$pdf->SetFillColor(220,220,220);$pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"Procuraduría",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_6 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_6 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_6, $questionValue_6 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial',"",10);$pdf->SetFillColor(220,220,220);$pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"Contraloría",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_7 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_7 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_7, $questionValue_7 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial',"",10);$pdf->SetFillColor(220,220,220);$pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"Pasado Judicial",1,'L',1,0," "," ",true);
    $pdf->MultiCell(30, 5, $points_8 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_8 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_8, $questionValue_8 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial',"",10);$pdf->SetFillColor(220,220,220);$pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"Matricula Mercantil Renovada",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_9 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_9 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_9, $questionValue_9 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial',"",10);$pdf->SetFillColor(220,220,220);$pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"Novedad en Central de Riesgo",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_10 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_10 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_10, $questionValue_10 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFont('Arial',"",10);$pdf->SetFillColor(220,220,220);$pdf->SetTextColor(0,0,0);
    $pdf->Multicell(80,5,"Reorganización Empresarial(LEY 1116 - 550)",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(30, 5, $points_11 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, $questionValue_11 , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(30, 5, valCalc( "peso", $points_11, $questionValue_11 , $value , $weight ) , 1, 'C', 0, 1, '', '', true);

    $pdf->AddPage();
    $pdf->SetY(25);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "INFORMACIÓN DE LA COMPAÑÍA"  , 0, 'C', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    
    if(isset($sectionCompanyVisit)){
        include_once(Yii::app()->basePath . '/views/backgroundCheck/evalDetails/_pdfCompanyVisit.php');
    }
    $pdf->SetFont('Arial',"",10);$pdf->SetFillColor(220,220,220);$pdf->SetTextColor(0,0,0);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, 0, "Ventas Anuales $ COP" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(45, 0, number_format($backgroundCheck->companySizeBySales , 0) , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, 0, "No. Empleados" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(45, 0, $backgroundCheck->companySizeByPersonel , 1, 'L', 0, 1, '', '', true);

    // INFORMACIÓN TRIBUTARIA
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "INFORMACIÓN TRIBUTARIA" , 1, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(40, 0, "Estado de la Empresa" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(45, 0, "Activo" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, 0, "Renta" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(45, 0, $XMLQuestionResult['taxrenttype'] , 1, 'L', 0, 1, '', '', true);
    
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, 0, "Municipio" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    
    $pdf->MultiCell(45, 0, $XMLQuestionResult['icacity'] , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, 0, "IVA" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(45, 0, $XMLQuestionResult['taxivatype'] , 1, 'L', 0, 1, '', '', true);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, 0, "ICA" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(45, 0,$XMLQuestionResult['taxicatype'] , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, 0, "Tarifa de ICA" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(45, 0, $XMLQuestionResult['icacvalue'] , 1, 'L', 0, 1, '', '', true);
       
    //INFORMACIÓN BANCARIA
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "INFORMACIÓN BANCARIA " , 1, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(40, 0, "Banco " , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(45, 0, $XMLQuestionResult['bankname'] , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, 0, "Titular de la Cuenta " , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(45, 0,$XMLQuestionResult['bankaccountholder'] , 1, 'L', 0, 1, '', '', true);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, 0, "Tipo de cuenta " , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(45, 0,$XMLQuestionResult['bankaccounttype'] , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, 0, "No. de Cuenta " , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(45, 0, $XMLQuestionResult['bankaccount'] , 1, 'L', 0, 1, '', '', true);
        
    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_VISIT)->comments . " " .
    $backgroundCheck->getVerificationSection(52)->comments . " " .
    $backgroundCheck->getVerificationSection(53)->comments;

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    // SOCIOS Y REPRESENTANTES DE LA EMPRESA
    $pdf->AddPage();
    $pdf->SetY(25);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "SOCIOS Y REPRESENTANTES DE LA EMPRESA " , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(50, 0, "Nombre" , 0, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, "No. Identidad" , 0, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(20, 0, "Tipo" , 0, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(25, 0, "Part. %" , 0, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "Cargo" , 0, 'L', 1, 1, '', '', true);

    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    foreach ($shareholdersSection->detailShareholder as $shareholder) {
        if($shareholder->isCompany == 0){
            $isCompany = "P. Natural";
        } else{
            $isCompany = "P. Jurídica";
        };
        $pdf->MultiCell(50, 0, $shareholder->firstName . " " . $shareholder->lastName  , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, $shareholder->idNumber , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(20, 0, $isCompany , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(25, 0, $shareholder->participation , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, $shareholder->position , 1, 'L', 1, 1, '', '', true);
    }
    
    $pdf->Cell('', '', '', '', 1, 'L');

    // VERIFICACIÓN LISTAS -ANTECEDENTES-LAFTS
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "VERIFICACIÓN LISTAS - ANTECEDENTES-LAFT" , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(40, 0, "Consultas en Listas" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(16.25, 0, "Rec. Púb"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(16.25, 0, "B. Prácticas"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(16.25, 0, "E. Control" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(16.25, 0, "E. Policiales" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(16.25, 0, "O. Boletines"  , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(16.25, 0, "E. Ficticias" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(16.25, 0, "Compliance" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(16.25, 0, "LA/FT." , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);

    // var_dump($XMLQuestionResult);
    // die;
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(40, 0, $backgroundCheck->lastName  , 1, 'L', 1, 0, '', '', true);
    if ($XMLQuestionResult['OfacYOnu'] == "SI" ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
    $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 0, '', '', true);
    
    if ($XMLQuestionResult['Boe'] == "SI" ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
    $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 0, '', '', true);
    
    if ($XMLQuestionResult['entControl'] == "SI" ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
    $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 0, '', '', true);
    
    if ($XMLQuestionResult['entPoliciales'] == "SI" ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
    $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 0, '', '', true);
    
    if ($XMLQuestionResult['otrosBoletines'] == "SI" ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
    $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 0, '', '', true);
    
    if ($XMLQuestionResult['empresasFicticias'] == "SI" ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
    $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 0, '', '', true);
    
    if ($XMLQuestionResult['complianceAlerta'] == "SI" ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
    $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 0, '', '', true);
    
    if ($XMLQuestionResult['alertaLaFt'] == "SI" ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
    $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 1, '', '', true);


    foreach ($shareholdersSection->detailShareholder as $shareholder) {
        $pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(40, 0, $shareholder->firstName . " " . $shareholder->lastName  , 1, 'L', 1, 0, '', '', true);
        if ($shareholder->managepublicresources == 1 ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
        $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->prominentpublicfunctions == 1 ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
        $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->appearsInONUList == 1 ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
        $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->appearsInINTERPOLList == 1 ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
        $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->appearsInALQAEDAList == 1 ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
        $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->appearsInUnitedKingdomList == 1 ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
        $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->appearsInEuropeanUnionList == 1 ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
        $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->appearsInFBIList == 1 ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
        $pdf->MultiCell(16.25, 0, $ans , 1, 'C', 1, 1, '', '', true);
    }
    
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $shareholdersSection->comments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    
    // LEYENDA DE LISTAS
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "Listas Consultadas" , 0, 'L', 1, 1, '', '', true);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(170, 0, " - Rec. Púb: Reconocimiento público (OFAC-Clinton, ONU y Reino Unido)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - B. Prácticas: Reconocimiento normativo de Buenas prácticas (BOE)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - E. Control: Boletines de Entidades de Control (Fiscalía, Procuraduría, Contraloría)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - E. Policiales: Boletines de Entidades Policiales (Policía, DEA, Interpol, FBI, Unión Europea)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - O. Boletines: Otros boletines (Presidencia, SuperFinanciera, Embajadas, Fuerzas Militares, etc)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - E. Ficticias: Empresas ficticias." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - Compliance: Alerta Compliance." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - LA/FT: Alerta LA/FT." , 0, 'L', 1, 1, '', '', true);

    //CALIDAD Y HSEQ
    $pdf->AddPage();
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "CALIDAD Y HSEQ" , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(55, 0, "" , 0, 'L', 0, 0, '', '', true);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(30, 0, "Norma" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, "Certificación" , 1, 'C', 1, 1, '', '', true);
    // $pdf->MultiCell(45, 0, "Fecha de Vencimiento" , 1, 'C', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(55, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(30, 0, "ISO 9001" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 9);
    
    $pdf->MultiCell(30, 0, $XMLQuestionResult['certification_1'] , 1, 'C', 0, 1, '', '', true);
    // $pdf->MultiCell(45, 0, 0 , 1, 'C', 0, 0, '', '', true);
//     $pdf->MultiCell(25, 0, 0 , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(55, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(30, 0, "ISO 14001" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 9);
    
    $pdf->MultiCell(30, 0, $XMLQuestionResult['certification_2'] , 1, 'C', 0, 1, '', '', true);
    // $pdf->MultiCell(45, 0, 0 , 1, 'C', 0, 0, '', '', true);
    // $pdf->MultiCell(25, 0, 0 , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(55, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(30, 0, "OSHAS 18000" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 9);
    
    $pdf->MultiCell(30, 0, $XMLQuestionResult['certification_3'] , 1, 'C', 0, 1, '', '', true);
    // $pdf->MultiCell(45, 0, 0 , 1, 'C', 0, 0, '', '', true);
    // $pdf->MultiCell(25, 0, 0 , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(55, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(30, 0, "ISO 27001" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 9);
    
    $pdf->MultiCell(30, 0, $XMLQuestionResult['certification_4'] , 1, 'C', 0, 1, '', '', true);
    // $pdf->MultiCell(45, 0, 0 , 1, 'C', 0, 0, '', '', true);
    // $pdf->MultiCell(25, 0, 0 , 1, 'C', 0, 1, '', '', true);
    
    $ansComments = $backgroundCheck->getVerificationSection(49)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    //INFORMACIÓN  LEGAL
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "INFORMACIÓN LEGAL" , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(45, 0, "" , 0, 'L', 0, 0, '', '', true);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(50, 0, "Detalle" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, "Validación" , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(45, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(50, 0, "Matricula Mercantil Renovada" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 9);
    if ($sectionCompanyVisit->renewedMercantileRegistration == 0) {
        $renewedMercantileRegistration = "No";
    } else if($sectionCompanyVisit->renewedMercantileRegistration == 1){
        $renewedMercantileRegistration = "Sí";
    }else {
        $renewedMercantileRegistration = "No";
    }
    $pdf->MultiCell(30, 0, $renewedMercantileRegistration , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(45, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(50, 0, "Ley 1116(insolvencia)" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 9);
    if ($sectionCompanyVisit->businessReorganization == 0) {
        $businessReorganization = "No";
    } else if($sectionCompanyVisit->businessReorganization == 1){
        $businessReorganization = "Sí";
    }else {
        $businessReorganization = "No";
    }
    $pdf->MultiCell(30, 0, $businessReorganization , 1, 'C', 0, 1, '', '', true);
    // $pdf->MultiCell(25, 0, 0 , 1, 'C', 0, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(45, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(50, 0, "Ley 550(Reestructuración)" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->MultiCell(30, 0, $businessReorganization , 1, 'C', 0, 1, '', '', true);
    // $pdf->MultiCell(25, 0, 0 , 1, 'C', 0, 1, '', '', true);

    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_VISIT)->comments;

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    //RECURSOS HUMANOS
    // $pdf->AddPage();
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "RECURSOS HUMANOS" , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(120, 0, "Aspectos Evaluados" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Validación" , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Cuenta con reglamento interno de trabajo" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['rrhh_1'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Comité de Convivencia (Actas de conformación, Cumplimiento de reuniones)" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['rrhh_2'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Políticas y proceso de inducción para entrenamiento al cargo" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['rrhh_1'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Medición de desempeño empleados" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['rrhh_2'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Cuenta con Políticas, procesos y programas de capacitación para todo el personal " , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['rrhh_1'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Tiene documentados los cargos de la compañía" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['rrhh_3'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Cuenta con un proceso de selección y contratación estandarizado" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['rrhh_4'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Aplica estudio de seguridad para la vinculación y monitoreo del personal" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['rrhh_5'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Tiene contratos laborales colectivas (pacto colectivo, convención o plan beneficios)" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['rrhh_6'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Utiliza contratistas (subcontratistas) para la ejecución de su objeto social" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['rrhh_7'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Cuenta con estructura de Gestión Humana e Indicadores de Gestión" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['rrhh_1'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Cuenta con regulación Sena, cuota de aprendices (resolución física)" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['rrhh_3'] , 1, 'C', 1, 1, '', '', true);$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Presenta Demandas Laborales" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['rrhh_5'] , 1, 'C', 1, 1, '', '', true);

    $ansComments = $backgroundCheck->getVerificationSection(54)->comments;

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    //INFORMACIÓN SG-SST

    $pdf->AddPage();
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "INFORMACIÓN SG-SST" , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(120, 0, "Aspectos Evaluados" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Validación" , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Sistema de Gestión en Seguridad y Salud en el trabajo (PSO) declarado" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_1'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "COPASST (actas de conformación, registro, votación, actas de reuniones mensuales)" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_2'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Plan de emergencias declarado" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_3'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Esquema de manejo de Incidentes definido" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_4'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Matriz de peligros" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_5'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Reglamento Interno de trabajo definido y publicado" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_6'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Reglamento de Higiene y Seguridad Industrial definido y publicado" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_7'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Entrega de dotación y epp's" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_8'] , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(120, 0, "Fichas técnicas de epp's" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['sgssst_9'] , 1, 'C', 1, 1, '', '', true);

    $ansComments = $backgroundCheck->getVerificationSection(50)->comments;

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
     

    // 
    // INFORMACIÓN DE EMPLEADOS
    

    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "INFORMACIÓN DE EMPLEADOS " , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Cargo" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Numero" , 1, 'C', 1, 1, '', '', true);
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

    $ansComments = $backgroundCheck->getVerificationSection(18)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    //INFRAESTRUCTURA
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "INFRAESTRUCTURA " , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Física" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['infra_1'] , 1, 'C', 1, 1, '', '', true);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Informática y de comunicaciones" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['infra_2'] , 1, 'C', 1, 1, '', '', true);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Maquinaria y Equipo" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $XMLQuestionResult['infra_3'] , 1, 'C', 1, 1, '', '', true);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    
    $ansComments = $backgroundCheck->getVerificationSection(60)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    // INFORMACIÓN COMERCIAL 
    $pdf->AddPage();
    $pdf->SetY(25);
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

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(170, 0, "Referencias Comerciales de Proveedores" , 0, 'L', 0, 1, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    foreach ($sectionCompanyProvider as $provider) {
        $pdf->MultiCell(40, 0, "Razón Social" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(130, 0, $provider->companyName , 1, 'L', 1, 1, '', '', true);
        $pdf->MultiCell(40, 0, "Contacto" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(130, 0, $provider->contactName , 1, 'L', 1, 1, '', '', true);
        $pdf->MultiCell(40, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(130, 0, $provider->tel , 1, 'L', 1, 1, '', '', true);
        $pdf->MultiCell(40, 0, "Servicios Productos" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(130, 0, $provider->services , 1, 'L', 1, 1, '', '', true);
        $pdf->Cell('', '', '', '', 1, 'L');
    }

    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_PROVIDER)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    include_once(Yii::app()->basePath . '/views/backgroundCheck/evalDetails/_pdfCompanyFinantialAnalys.php');