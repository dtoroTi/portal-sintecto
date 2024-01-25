<?php
    //ANCHO DE LAS COLUMNAS
    $wCol1 = 125; $wCol2 = 25; $wCol3 = 25; $wCol4 = 20; $wCol5 = 150;
    

    $pdf->AddPage();
    $pdf->SetY(30);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255);
    $pdf->MultiCell(170, 0, "RESUMEN CALIFICACIÓN OBTENIDA"  , 0, 'C', 1, 0, '', '', true);
    $pdf->SetTextColor($txBlack);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 8); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->MultiCell( $wCol1 , 5, "REQUISITOS" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol3 , 5, "MÁXIMO" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, "CAL." , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFont('Arial', '', 6); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->MultiCell( $wCol1 , 0, "1. TAMAÑO Y EXPERIENCIA" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol3 , 0, $val_1 . "%" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 0, pondCalc("peso", $points_1 , $val_1, $weight_1) , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1 , 0, "1.1 Años de Experiencia en el mercado" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 0, $Max_1_1 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 0, valCalc( "peso", $Obt_1_1, $Max_1_1 , $val_1 , $weight_1 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "1.2 Tamaño según la escala de Activos" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_1_2 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_1_2, $Max_1_2 , $val_1 , $weight_1 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "1.3 Cobertura de la compañía" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_1_3 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_1_3, $Max_1_3 , $val_1 , $weight_1 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "1.4 Años suministrando el bien o servicio ofrecido" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_1_4 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_1_4, $Max_1_4 , $val_1 , $weight_1 ) , 1, 'C', 0, 1, '', '', true);
    
    

    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->MultiCell( $wCol1, 5, "2. CERTIFICACIONES DE PROCESOS" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol3 , 5, $val_2 . "%" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, pondCalc("peso", $points_2 , $val_2, $weight_2) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "2.1 Certificación ISO 9001" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_2_1 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_2_1, $Max_2_1 , $val_2 , $weight_2 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "2.2 Certificación ISO 14001" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_2_2 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_2_2, $Max_2_2 , $val_2 , $weight_2 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "2.3 Certificación OSHA 18001" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_2_3 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_2_3, $Max_2_3 , $val_2 , $weight_2 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "2.4 Certificación ISO 27001" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_2_4 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_2_4, $Max_2_4 , $val_2 , $weight_2 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "2.5 Certificación RUC" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_2_5 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_2_5, $Max_2_5 , $val_2 , $weight_2 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "2.6 Certificación Basc" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_2_6 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_2_6, $Max_2_6 , $val_2 , $weight_2 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "2.7 Certificación ISO 28000" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_2_7 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_2_7, $Max_2_7 , $val_2 , $weight_2 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "2.8 Certificación OEA" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_2_8 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_2_8, $Max_2_8 , $val_2 , $weight_2 ) , 1, 'C', 0, 1, '', '', true);


    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->MultiCell( $wCol1, 5, "3. GESTION COMERCIAL Y CONFIANZA" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol3 , 5, $val_3 . "%" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, pondCalc("peso", $points_3 , $val_3, $weight_3) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "3.1 Tiene Base de Datos de Proveedores" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_3_1 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_3_1, $Max_3_1 , $val_3 , $weight_3 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "3.2 Registro y evaluación periódica de proveedores" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_3_2 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_3_2, $Max_3_2 , $val_3 , $weight_3 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "3.3 Presenta asignación de ejecutivo de cuenta" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_3_3 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_3_3, $Max_3_3 , $val_3 , $weight_3 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "3.4 Sede para la atención al cliente" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_3_4 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_3_4, $Max_3_4 , $val_3 , $weight_3 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "3.5 Cuenta con servicios Post Venta" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_3_5 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_3_5, $Max_3_5 , $val_3 , $weight_3 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "3.6 Presenta garantías en productos y servicios" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_3_6 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_3_6, $Max_3_6 , $val_3 , $weight_3 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "3.7 Cuenta con Servicio de mantenimiento técnico" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_3_7 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_3_7, $Max_3_7 , $val_3 , $weight_3 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "3.8 Tiene pólizas de Seguros Generales" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_3_8 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_3_8, $Max_3_8 , $val_3 , $weight_3 ) , 1, 'C', 0, 1, '', '', true);

    
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->MultiCell( $wCol1, 5, "4. REFERENCIAS COMERCIALES" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol3 , 5, $val_4 . "%" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, pondCalc("peso", $points_4 , $val_4, $weight_4) , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "4.1 Puntualidad en los tiempos de entrega" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_4_1 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_4_1, $Max_4_1 , $val_4 , $weight_4 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "4.2 Calidad en el Producto o Servicios" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_4_2 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_4_2, $Max_4_2 , $val_4 , $weight_4 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "4.3 Rapidez de atención a quejas o reclamos" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_4_3 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_4_3, $Max_4_3 , $val_4 , $weight_4 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "4.4 Precio frente a la competencia" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_4_4 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_4_4, $Max_4_4 , $val_4 , $weight_4 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->MultiCell( $wCol1, 5, "5. INFRAESTRUCTURA" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol3 , 5, $val_5 . "%" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, pondCalc("peso", $points_5 , $val_5, $weight_5) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "5.1 Infraestructura física" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_5_1 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_5_1, $Max_5_1 , $val_5 , $weight_5 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "5.2 Infraestructura informática y de comunicaciones" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_5_2 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_5_2, $Max_5_2 , $val_5 , $weight_5 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "5.3 Maquinaria y Equipo" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_5_3 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_5_3, $Max_5_3 , $val_5 , $weight_5 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->AddPage();
    $pdf->SetY(30);

    //
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->MultiCell( $wCol1, 5, "6. INFORMACIÓN FINANCIERA" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol3 , 5, $val_6 . "%" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, pondCalc("peso", $points_6 , $val_6, $weight_6) , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6.1 Capital de Trabajo" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_6_1 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_6_1, $Max_6_1 , $val_6 , $weight_6 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6.2 Razón Corriente" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_6_2 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_6_2, $Max_6_2 , $val_6 , $weight_6 ) , 1, 'C', 0, 1, '', '', true);

    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6.3 Nivel de Endeudamiento" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_6_3 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_6_3, $Max_6_3 , $val_6 , $weight_6 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6.4 Concentración de Endeudamiento CP" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_6_4 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_6_4, $Max_6_4 , $val_6 , $weight_6 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6.5 Endeudamiento/Ventas" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_6_5 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_6_5, $Max_6_5 , $val_6 , $weight_6 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6.6 Endeudamiento Financiero" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_6_6 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_6_6, $Max_6_6 , $val_6 , $weight_6 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6.7 Margen EBITDA" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_6_7 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_6_7, $Max_6_7 , $val_6 , $weight_6 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6.8 Rentabilidad Operativa Activo (ROA)" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_6_8 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_6_8, $Max_6_8 , $val_6 , $weight_6 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6.9 Cobertura de Gastos No Oper." , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_6_9 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_6_9, $Max_6_9 , $val_6 , $weight_6 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6.10 Utilidades Acumuladas" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_6_10 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_6_10, $Max_6_10 , $val_6 , $weight_6 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6.11 Ventas Vs. Resultado Neto" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_6_11 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_6_11, $Max_6_11 , $val_6 , $weight_6 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6.12 Presenta algún tipo de liquidación" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_6_12 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_6_12, $Max_6_12 , $val_6 , $weight_6 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6.13 Capital de trabajo reducido por debajo del 50%" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Obt_6_13 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_6_13, $Max_6_13 , $val_6 , $weight_6 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6.14 Reorganización Empresarial (LEY 1116 - 550)" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_6_14 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_6_14, $Max_6_14 , $val_6 , $weight_6 ) , 1, 'C', 0, 1, '', '', true);
    


    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->MultiCell( $wCol1, 5, "7. RECURSOS HUMANOS" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol3 , 5, $val_7 . "%" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, pondCalc("peso", $points_7 , $val_7, $weight_7) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.1 Reglamento Interno de trabajo' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_1 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_1, $Max_7_1 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.2 Comité de convivencia' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_2 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_2, $Max_7_2 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.3 Políticas y procesos de inducción y/o entrenamiento' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_3 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_3, $Max_7_3 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.4 Medición de desempeño a los empleados' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_4 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_4, $Max_7_4 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.5 Pagos a Cesantias, seguridad social, parafiscales' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_5 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_5, $Max_7_5 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.6 Políticas, procesos y programas de capacitación' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_6 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_6, $Max_7_6 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);
    
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.7 Política definida para contratación' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_7 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_7, $Max_7_7 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.8 Proceso de selección y contratación estandarizados' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_8 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_8, $Max_7_8 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.9 Documentación los cargos de la compañía' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_9 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_9, $Max_7_9 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.10 Consulta referencias y antecedentes de empleados y aspirantes' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_10 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_10, $Max_7_10 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.11 Contratos laborales colectivos' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_11 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_11, $Max_7_11 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);
    
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.12 Utiliza contratistas para ejecución de su objeto social' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_12 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_12, $Max_7_12 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.13 Contrata personal con discapacidad, madres cabeza de familia o población vulnerable' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_13 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_13, $Max_7_13 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.14 Permiso del Ministerio para laborar horas extras' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_14 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_14, $Max_7_14 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.15 Estructura de gestión humana e indicadores de gestión' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_15 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_15, $Max_7_15 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.16 Regulación SENA cuota de aprendices (Resolución física)' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_16 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_16, $Max_7_16 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.17 Cuenta con regimen Disciplinario' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_17 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_17, $Max_7_17 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.18 Plan de bienestar para los empleados' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_18 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_18, $Max_7_18 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.19 EST Resolución de operación vigente por parte del Ministerio *(solo EST)' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_19 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_19, $Max_7_19 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.20 Utiliza cooperativa de Trabajo asociado para la contratación de personal' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_20 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_20, $Max_7_20 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, '7.21 Reconocimiento de estructura organizacional' , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_7_21 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_7_21, $Max_7_21 , $val_7 , $weight_7 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->AddPage();
    $pdf->SetY(30);

    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->MultiCell( $wCol1, 5, "8. GESTIÓN DE SEGURIDAD Y SALUD OCUPACIONAL" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol3 , 5, $val_8 . "%" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, pondCalc("peso", $points_8 , $val_8, $weight_8) , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "1. SGSST documento, implementado y aprobado por la Gerencia" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_1 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_1, $Max_8_1 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "2. La política SGSST está publicada y comunicada al personal" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_2 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_2, $Max_8_2 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "3. Cuenta con los recursos humanos y financieros para la implementación del SGSST" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_3 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_3, $Max_8_3 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "4. Inducciones SGSST a colaboradores" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_4 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_4, $Max_8_4 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "5. Indicadores SGSST definidos y evaluados periódicamente" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_5 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_5, $Max_8_5 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "6. Auditorías internas generando acciones correctivas SGSST" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_6 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_6, $Max_8_6 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "7. El responsable genera informe anual sobre el SGSST" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_7 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_7, $Max_8_7 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "8. Mediciones ambientales en SGSST" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_8 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_8, $Max_8_8 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "9. Matriz de requerimientos Legales (Actualización Res 0312)" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_9 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_9, $Max_8_9 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "10. Matriz de identificación de peligros y evaluación de Riesgos" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_10 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_10, $Max_8_10 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "11. Matriz de aspectos e impactos ambientales" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_11 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_11, $Max_8_11 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "12. COPASST" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_12 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_12, $Max_8_12 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "13. Registro de formaciones al COPASST" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_13 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_13, $Max_8_13 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "14. Conformación de Brigadas y Realización de Simulacros" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_14 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_14, $Max_8_14 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "15. Registros de entrega de Dotación y EPP a los colaboradores" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_15 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_15, $Max_8_15 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "16. Exámenes médicos ocupaciones de ingreso, periódico o de retiro" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_16 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_16, $Max_8_16 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "17. Accidentes fatales o graves en el último año" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_17 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_17, $Max_8_17 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "18. Higiene y Seguridad Industrial documentado y publicado" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_18 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_18, $Max_8_18 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);
    
    $pdf->SetFillColor(220); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol1, 5, "19. Plan de emergencias documentado e implementado" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol3 , 5, $Max_8_19 . "%" , 1, 'C', 0, 0, '', '', true);
    $pdf->MultiCell( $wCol4 , 5, valCalc( "peso", $Obt_8_19, $Max_8_19 , $val_8 , $weight_8 ) , 1, 'C', 0, 1, '', '', true);


    $pdf->SetFillColor(0,66,109);$pdf->SetTextColor(255);
    $pdf->Multicell( $wCol5 ,5,"TOTAL OBTENIDO",1,'L',1,0," "," ",true);
    $pdf->MultiCell( $wCol4 , 5, $resultValueString . "%" , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

       
    $pdf->SetFillColor(0,66,109);$pdf->SetTextColor(255);
    $pdf->Multicell( $wCol5 ,5,"9. INFORMACIÓN LEGAL(Listas LAFT)",1,'L',1,0," "," ",true);
    $pdf->MultiCell( $wCol4 , 5, $points_9 , 1, 'C', 1, 1, '', '', true);

    $pdf->SetFillColor(220);$pdf->SetTextColor($txBlack);
    $pdf->Multicell( $wCol5 ,5,"Clinton",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255); $pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol4 , 5, $Obt_9_1 , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220);$pdf->SetTextColor($txBlack);
    $pdf->Multicell( $wCol5 ,5,"ONU",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255);$pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol4 , 5, $Obt_9_2 , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220);$pdf->SetTextColor($txBlack);
    $pdf->Multicell( $wCol5 ,5,"Interpol",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255);$pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol4 , 5, $Obt_9_3 , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220);$pdf->SetTextColor($txBlack);
    $pdf->Multicell( $wCol5 ,5,"Reino Unido",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255);$pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol4 , 5, $Obt_9_4 , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220);$pdf->SetTextColor($txBlack);
    $pdf->Multicell( $wCol5 ,5,"Union Europea",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255);$pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol4 , 5, $Obt_9_5 , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220);$pdf->SetTextColor($txBlack);
    $pdf->Multicell( $wCol5 ,5,"Proveedores Ficticios",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255);$pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol4 , 5, $Obt_9_6 , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220);$pdf->SetTextColor($txBlack);
    $pdf->Multicell( $wCol5 ,5,"Procuraduría",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255);$pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol4 , 5, $Obt_9_7 , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220);$pdf->SetTextColor($txBlack);
    $pdf->Multicell( $wCol5 ,5,"Contraloría",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255);$pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol4 , 5, $Obt_9_8 , 1, 'C', 0, 1, '', '', true);


    $pdf->SetFillColor(220);$pdf->SetTextColor($txBlack);
    $pdf->Multicell( $wCol5 ,5,"Matricula Mercantil Renovada",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255);$pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol4 , 5, $Obt_9_9 , 1, 'C', 0, 1, '', '', true);

    $pdf->SetFillColor(220);$pdf->SetTextColor($txBlack);
    $pdf->Multicell( $wCol5 ,5,"Novedad en Central de Riesgo",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255);$pdf->SetTextColor($txBlack);
    $pdf->MultiCell( $wCol4 , 5, $Obt_9_10 , 1, 'C', 0, 1, '', '', true);

    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFillColor(0,66,109);$pdf->SetTextColor(255);
    $pdf->Multicell( 170 ,5,"INFORMATIVOS PARA LA EVALUACION",1,'L',1,1," "," ",true);

    $pdf->SetFillColor(220);$pdf->SetTextColor($txBlack);
    $pdf->Multicell( 150 ,5,"Cuenta el sistema de gestion del riesgo de LA/FT",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255);$pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 20 , 5, $XMLQuestionResult['adicionalClaro_3'] , 1, 'C', 0, 1, '', '', true);

    if($XMLQuestionResult['adicionalClaro_3_comment'] != ""){
        $pdf->SetFillColor(255,255,255); $pdf->SetFont('Arial', 'I', 6);
        $pdf->MultiCell(170, 0, "Comentarios: " . $XMLQuestionResult['adicionalClaro_3_comment'] , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFont('Arial', '', 6);
    }

    
    $pdf->SetFillColor(220);$pdf->SetTextColor($txBlack);
    $pdf->Multicell( 150 ,5,"Cuenta con un oficial de Cumplimiento",1,'L',1,0," "," ",true);
    $pdf->SetFillColor(255);$pdf->SetTextColor($txBlack);
    $pdf->MultiCell( 20 , 5, $XMLQuestionResult['adicionalClaro_4'] , 1, 'C', 0, 1, '', '', true);