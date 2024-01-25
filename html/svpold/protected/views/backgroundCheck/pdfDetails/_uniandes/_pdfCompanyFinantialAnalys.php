<?php
if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->percentCompleted >=100 ) {
    $pdf->AddPage();
    $pdf->SetY(30);
    // INFORMACIÓN ESTADOS FINANCIEROS
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "INFORMACIÓN ESTADOS FINANCIEROS" , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFont('Arial', '', 9);
    $pdf->MultiCell(50, 0, "Cuentas Principales " , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, $sectionCompanyFinantialAnalys->dateLastBalanceSheet , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, $sectionCompanyFinantialAnalys->dateLastBalanceSheet_1 , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0, "Var %" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(150,150,150); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(170, 0, "ESTADO DE SITUACIÓN" , 1, 'L', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Activo" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $activo_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $activo_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($activo_0, $activo_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Activo Corriente" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $activoCorriente_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $activoCorriente_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($activoCorriente_0, $activoCorriente_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Activo Fijo" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $activoFijo_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $activoFijo_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($activoFijo_0, $activoFijo_1) , 1, 'R', 1, 1, '', '', true);
        
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Otros Activos" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $otrosActivos_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $otrosActivos_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($otrosActivos_0, $otrosActivos_1) , 1, 'R', 1, 1, '', '', true);

    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Pasivo" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $pasivo_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $pasivo_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($pasivo_0, $pasivo_1) , 1, 'R', 1, 1, '', '', true);

    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Pasivo Corriente" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $pasivoCorriente_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $pasivoCorriente_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($pasivoCorriente_0, $pasivoCorriente_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Pasivo No Corriente" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $pasivoNoCorriente_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $pasivoNoCorriente_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($pasivoNoCorriente_0, $pasivoNoCorriente_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Patrimonio" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $patrimonio_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $patrimonio_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($patrimonio_0, $patrimonio_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Total Pasivo y Patrimonio" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $totalPasivoYPatrimonio_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $totalPasivoYPatrimonio_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($totalPasivoYPatrimonio_0, $totalPasivoYPatrimonio_1) , 1, 'R', 1, 1, '', '', true);

    $pdf->SetFillColor(150,150,150); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(170, 0, "ESTADO DE RESULTADOS" , 1, 'L', 1, 1, '', '', true);
 
   
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Ingresos Operacionales" , 1, 'L', 1, 0, '', '', true);
    if ($ingresosOperacionales_0 == "") { $ingresosOperacionales_0 = 0; }
    if ($ingresosOperacionales_1 == "") { $ingresosOperacionales_1 = 0; }
    $pdf->MultiCell(45, 0, "$ " . number_format( $ingresosOperacionales_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $ingresosOperacionales_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($ingresosOperacionales_0, $ingresosOperacionales_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Costo de Venta" , 1, 'L', 1, 0, '', '', true);
    if ($costoDeVenta_0 == "") { $costoDeVenta_0 = 0; }
    if ($costoDeVenta_1 == "") { $costoDeVenta_1 = 0; }
    $pdf->MultiCell(45, 0, "$ " . number_format( $costoDeVenta_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $costoDeVenta_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($costoDeVenta_0, $costoDeVenta_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Utilidad Bruta" , 1, 'L', 1, 0, '', '', true);
    if ($utilidadBruta_0 == "") { $utilidadBruta_0 = 0; }
    if ($utilidadBruta_1 == "") { $utilidadBruta_1 = 0; }
    $pdf->MultiCell(45, 0, "$ " . number_format( $utilidadBruta_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $utilidadBruta_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($utilidadBruta_0, $utilidadBruta_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Gastos Operacionales Admón" , 1, 'L', 1, 0, '', '', true);
    if ($gastosOperacionalesAdmon_0 == "") { $gastosOperacionalesAdmon_0 = 0; }
    if ($gastosOperacionalesAdmon_1 == "") { $gastosOperacionalesAdmon_1 = 0; }
    $pdf->MultiCell(45, 0, "$ " . number_format( $gastosOperacionalesAdmon_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $gastosOperacionalesAdmon_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($gastosOperacionalesAdmon_0, $gastosOperacionalesAdmon_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Gastos Operacionales Venta" , 1, 'L', 1, 0, '', '', true);
    if ($gastosOperacionalesVenta_0 == "") { $gastosOperacionalesVenta_0 = 0; }
    if ($gastosOperacionalesVenta_1 == "") { $gastosOperacionalesVenta_1 = 0; }
    $pdf->MultiCell(45, 0, "$ " . number_format( $gastosOperacionalesVenta_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $gastosOperacionalesVenta_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($gastosOperacionalesVenta_0, $gastosOperacionalesVenta_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Utilidad Operacional" , 1, 'L', 1, 0, '', '', true);
    if ($utilidadOperacional_0 == "") { $utilidadOperacional_0 = 0; }
    if ($utilidadOperacional_1 == "") { $utilidadOperacional_1 = 0; }
    $pdf->MultiCell(45, 0, "$ " . number_format( $utilidadOperacional_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $utilidadOperacional_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($utilidadOperacional_0, $utilidadOperacional_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Ingresos NO Operacionales" , 1, 'L', 1, 0, '', '', true);
    if ($ingresosNoOperacionales_0 == "") { $ingresosNoOperacionales_0 = 0; }
    if ($ingresosNoOperacionales_1 == "") { $ingresosNoOperacionales_1 = 0; }
    $pdf->MultiCell(45, 0, "$ " . number_format( $ingresosNoOperacionales_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $ingresosNoOperacionales_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($ingresosNoOperacionales_0, $ingresosNoOperacionales_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Gastos NO Operacionales" , 1, 'L', 1, 0, '', '', true);
    if ($gastosNoOperacionales_0 == "") { $gastosNoOperacionales_0 = 0; }
    if ($gastosNoOperacionales_1 == "") { $gastosNoOperacionales_1 = 0; }
    $pdf->MultiCell(45, 0, "$ " . number_format( $gastosNoOperacionales_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $gastosNoOperacionales_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($gastosNoOperacionales_0, $gastosNoOperacionales_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Utilidad Antes de Impuestos" , 1, 'L', 1, 0, '', '', true);
    if ($utilidadAntesDeImpuestos_0 == "") { $utilidadAntesDeImpuestos_0 = 0; }
    if ($utilidadAntesDeImpuestos_1 == "") { $utilidadAntesDeImpuestos_1 = 0; }
    $pdf->MultiCell(45, 0, "$ " . number_format( $utilidadAntesDeImpuestos_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $utilidadAntesDeImpuestos_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($utilidadAntesDeImpuestos_0, $utilidadAntesDeImpuestos_1) , 1, 'R', 1, 1, '', '', true);
    if ($impuestoDeRenta_0 == "") { $impuestoDeRenta_0 = 0; }
    if ($impuestoDeRenta_1 == "") { $impuestoDeRenta_1 = 0; }
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Impuesto de Renta" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $impuestoDeRenta_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $impuestoDeRenta_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($impuestoDeRenta_0, $impuestoDeRenta_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "Utilidad Neta" , 1, 'L', 1, 0, '', '', true);
    if ($utilidadNeta_0 == "") { $utilidadNeta_0 = 0; }
    if ($utilidadNeta_1 == "") { $utilidadNeta_1 = 0; }
    $pdf->MultiCell(45, 0, "$ " . number_format( $utilidadNeta_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $utilidadNeta_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($utilidadNeta_0, $utilidadNeta_1) , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(50, 0, "EBITDA" , 1, 'L', 1, 0, '', '', true);
    if ($EBITDA_0 == "") { $EBITDA_0 = 0; }
    if ($EBITDA_1 == "") { $EBITDA_1 = 0; }
    $pdf->MultiCell(45, 0, "$ " . number_format( $EBITDA_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $EBITDA_1, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(30, 0,  varCuentas($EBITDA_0, $EBITDA_1) , 1, 'R', 1, 1, '', '', true);

    $pdf->AddPage();
    $pdf->SetY(25);
    // INDICADORES FINANCIEROS
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', '', 9);
    $pdf->MultiCell(80, 0, "INDICADORES FINANCIEROS " , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, $sectionCompanyFinantialAnalys->dateLastBalanceSheet , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, $sectionCompanyFinantialAnalys->dateLastBalanceSheet_1 , 1, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(150,150,150); $pdf->SetTextColor(0,0,0);

  
    $pdf->MultiCell(170, 0, "Indicadores de Liquidez" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 0, "Razón Corriente" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($razonCorriente_0, 2, '.', ''). " veces\n" , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($razonCorriente_1, 2, '.', ''). " veces\n" , 1, 'R', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    
    $pdf->MultiCell(80, 0, "Prueba Ácida" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($pruebaAcida_0, 2, '.', ''). " veces\n" , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($pruebaAcida_1, 2, '.', ''). " veces\n" , 1, 'R', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    
    $pdf->MultiCell(80, 0, "Capital de Trabajo" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $capitalDeTrabajo_0, 2, ',', '.') , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, "$ " . number_format( $capitalDeTrabajo_1, 2, ',', '.') , 1, 'R', 1, 1, '', '', true);
    $pdf->SetFillColor(150,150,150); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(170, 0, "Indicadores de Endeudamiento" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 0, "Nivel de Endeudamiento" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($nivelDeEndeudamiento_0, 2, '.', ''). " veces\n" , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($nivelDeEndeudamiento_1, 2, '.', ''). " veces\n" , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 0, "Endeudamiento Financiero" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($endeudamientoFinanciero_0, 2, '.', ''). "%" , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($endeudamientoFinanciero_1, 2, '.', ''). "%" , 1, 'R', 1, 1, '', '', true);

    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 0, "Apalancamiento Corto Plazo" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($apalancamientoCortoPlazo_0, 2, '.', ''). "%" , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($apalancamientoCortoPlazo_1, 2, '.', ''). "%" , 1, 'R', 1, 1, '', '', true);

    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 0, "Apalancamiento Largo Plazo" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($apalancamientoLargoPlazo_0, 2, '.', ''). "%" , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($apalancamientoLargoPlazo_1, 2, '.', ''). "%" , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(150,150,150); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(170, 0, "Indicadores Rentabilidad" , 1, 'L', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 0, "Rentabilidad Operativa Activo (ROA)" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($rentabilidadPatrimonioROA_0, 2, '.', ''). "%" , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($rentabilidadPatrimonioROA_1, 2, '.', ''). "%" , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 0, "Rentabilidad Patrimonio (ROE)" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($rentabilidadPatrimonioROE_0, 2, '.', ''). "%" , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($rentabilidadPatrimonioROE_1, 2, '.', ''). "%" , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 0, "Margen Neto Utilidad" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($margenNetoUtilidad_0, 2, '.', ''). "%" , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($margenNetoUtilidad_1, 2, '.', ''). "%" , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 0, "Margen Bruto Utilidad" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($margenBruto_0, 2, '.', ''). "%" , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($margenBruto_1, 2, '.', ''). "%" , 1, 'R', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 0, "Margen EBITDA" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($margenEBITDA_0, 2, '.', ''). "%" , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($margenEBITDA_1, 2, '.', ''). "%" , 1, 'R', 1, 1, '', '', true);


    $pdf->SetFillColor(150,150,150); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(170, 0, "Indicadores de Rotación" , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 0, "Rotación de Cartera" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($rotacionCarteraAndes_0, 0, '.', ''). " dias\n" , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($rotacionCarteraAndes_1, 0, '.', ''). " dias\n" , 1, 'R', 1, 1, '', '', true);

    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 0, "Rotación de Inventario" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($rotacionInventarioAndres_0, 0, '.', ''). " dias\n" , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($rotacionInventarioAndres_1, 0, '.', ''). " dias\n" , 1, 'R', 1, 1, '', '', true);

    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(80, 0, "Rotación de Activos" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($rotacionActivos_0, 2, '.', ''). " veces\n" , 1, 'R', 1, 0, '', '', true);
    $pdf->MultiCell(45, 0, number_format($rotacionActivos_1, 2, '.', ''). " veces\n" , 1, 'R', 1, 1, '', '', true);

    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
}