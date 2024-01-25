<?php 
    
    // ANÁLISIS FINANCIERO
    if (isset($sectionCompanyFinantialAnalys)){
        $sCFA = $sectionCompanyFinantialAnalys;
        $penultimo = $sCFA->dateLastBalanceSheet_1;
        $activoCorriente_0 =  $sCFA->activoDisponible_0 + $sCFA->activoClientes_0 + $sCFA->activoAnticiposYAvances_0 + $sCFA->activoInventarios_0 + $sCFA->activoInversionesCP_0 + $sCFA->otrosActivosCorrientes_0;
        $activoCorriente_1 =  $sCFA->activoDisponible_1 + $sCFA->activoClientes_1 + $sCFA->activoAnticiposYAvances_1 + $sCFA->activoInventarios_1 + $sCFA->activoInversionesCP_1 + $sCFA->otrosActivosCorrientes_1;
        $activoFijo_0 = $sCFA->activoPropiedadPlantaYEquipo_0 - $sCFA->activoDepreciacion_0 ;
        $activoFijo_1 = $sCFA->activoPropiedadPlantaYEquipo_1 - $sCFA->activoDepreciacion_1 ;
        $otrosActivos_0 = $sCFA->activoInversionesLP_0 + $sCFA->activoIntangibles_0 + $sCFA->activoValorizaciones_0 + $sCFA->otrosNoActivosCorrientes_0;
        $otrosActivos_1 = $sCFA->activoInversionesLP_1 + $sCFA->activoIntangibles_1 + $sCFA->activoValorizaciones_1 + $sCFA->otrosNoActivosCorrientes_1;
        $activo_0 = $activoCorriente_0 + $activoFijo_0 + $otrosActivos_0;
        $activo_1 = $activoCorriente_1 + $activoFijo_1 + $otrosActivos_1;
        $pasivoCorriente_0 = $sCFA->pasivoObligacionesFinancierasCP_0 + $sCFA->pasivoProveedores_0 + $sCFA->pasivoCXP_0 + $sCFA->pasivoImpuestosYTasas_0 + $sCFA->pasivoObligacionesLaborales_0 + $sCFA->pasivoProvisiones_0 + $sCFA->depositosExigiblesCP_0 + $sCFA->fondosSocialesCP_0 + $sCFA->otrosPasivosCorrientes_0;
        $pasivoCorriente_1 = $sCFA->pasivoObligacionesFinancierasCP_1 + $sCFA->pasivoProveedores_1 + $sCFA->pasivoCXP_1 + $sCFA->pasivoImpuestosYTasas_1 + $sCFA->pasivoObligacionesLaborales_1 + $sCFA->pasivoProvisiones_1 + $sCFA->depositosExigiblesCP_1 + $sCFA->fondosSocialesCP_1 + $sCFA->otrosPasivosCorrientes_1;
        $pasivoNoCorriente_0 = $sCFA->pasivoObligacionesFinancierasLP_0 + $sCFA->pasivoProveedoresLP_0 + $sCFA->pasivoCXPLP_0 + $sCFA->pasivoImpuestosYTasasLP_0 + $sCFA->pasivoObligacionesLaboralesLP_0 + $sCFA->pasivoProvisionesLP_0 + $sCFA->depositosExigiblesLP_0 + $sCFA->fondosSociales_0 + $sCFA->otrosPasivosNoCorrientes_0;
        $pasivoNoCorriente_1 = $sCFA->pasivoObligacionesFinancierasLP_1 + $sCFA->pasivoProveedoresLP_1 + $sCFA->pasivoCXPLP_1 + $sCFA->pasivoImpuestosYTasasLP_1 + $sCFA->pasivoObligacionesLaboralesLP_1 + $sCFA->pasivoProvisionesLP_1 + $sCFA->depositosExigiblesLP_1 + $sCFA->fondosSociales_1 + $sCFA->otrosPasivosNoCorrientes_1;
        $patrimonio_0 = $sCFA->patrimonioCapitalSocial_0 + $sCFA->patrimonioReservaSocial_0 + $sCFA->patrimonioResultadoEjercicio_0 + $sCFA->patrimonioResultadoEjerciciosAnteriores_0 + $sCFA->patrimonioSuperavitPorValorizaciones_0 + $sCFA->patrimonioFondoDestinacionEspecifica_0;
        $patrimonio_1 = $sCFA->patrimonioCapitalSocial_1 + $sCFA->patrimonioReservaSocial_1 + $sCFA->patrimonioResultadoEjercicio_1 + $sCFA->patrimonioResultadoEjerciciosAnteriores_1 + $sCFA->patrimonioSuperavitPorValorizaciones_1 + $sCFA->patrimonioFondoDestinacionEspecifica_1;
        $pasivo_0 = $pasivoCorriente_0 + $pasivoNoCorriente_0;
        $pasivo_1 = $pasivoCorriente_1 + $pasivoNoCorriente_1;
        $totalPasivoYPatrimonio_0 = $pasivo_0 + $patrimonio_0;
        $totalPasivoYPatrimonio_1 = $pasivo_0 + $patrimonio_1;
        $ingresosOperacionales_0 = $sCFA->estadoIngresosOperacionales_0;
        $ingresosOperacionales_1 = $sCFA->estadoIngresosOperacionales_1;
        $costoDeVenta_0 = $sCFA->estadoCostoDeVenta_0;
        $costoDeVenta_1 = $sCFA->estadoCostoDeVenta_1;
        $utilidadBruta_0 = $ingresosOperacionales_0 - $costoDeVenta_0 ;
        $utilidadBruta_1 = $ingresosOperacionales_1 - $costoDeVenta_1 ;
        $gastosOperacionalesAdmon_0 = $sCFA->estadoGastosOperacionalesAdmon_0;
        $gastosOperacionalesAdmon_1 = $sCFA->estadoGastosOperacionalesAdmon_1;
        $gastosOperacionalesVenta_0 = $sCFA->estadoGastosOperacionalesVenta_0;
        $gastosOperacionalesVenta_1 = $sCFA->estadoGastosOperacionalesVenta_1;
        $utilidadOperacional_0 = $utilidadBruta_0 - $gastosOperacionalesAdmon_0 - $gastosOperacionalesVenta_0 ;
        $utilidadOperacional_1 = $utilidadBruta_1 - $gastosOperacionalesAdmon_1 - $gastosOperacionalesVenta_1 ;
        $ingresosNoOperacionales_0 = $sCFA->estadoIngresosNoOperacionales_0;
        $ingresosNoOperacionales_1 = $sCFA->estadoIngresosNoOperacionales_1;
        $gastosNoOperacionales_0 = $sCFA->estadoGastosNoOperacionales_0;
        $gastosNoOperacionales_1 = $sCFA->estadoGastosNoOperacionales_1;
        $utilidadAntesDeImpuestos_0 = $utilidadOperacional_0 + $ingresosNoOperacionales_0 - $gastosNoOperacionales_0;
        $utilidadAntesDeImpuestos_1 = $utilidadOperacional_1 + $ingresosNoOperacionales_1 - $gastosNoOperacionales_1;
        $impuestoDeRenta_0 = $sCFA->impuestoDeRenta_0;
        $impuestoDeRenta_1 = $sCFA->impuestoDeRenta_1;
        $utilidadNeta_0 = $utilidadAntesDeImpuestos_0 - $impuestoDeRenta_0;
        $utilidadNeta_1 = $utilidadAntesDeImpuestos_1 - $impuestoDeRenta_1;
        $EBITDA_0 = $sCFA->estadoDepreciacion_0 + $sCFA->estadoAmortizacion_0 + $utilidadOperacional_0;
        $EBITDA_1 = $sCFA->estadoDepreciacion_1 + $sCFA->estadoAmortizacion_1 + $utilidadOperacional_1;
        
        // CALCULO DE INDICADORES
        $razonCorriente_0 = divideNumbers( $activoCorriente_0 , $pasivoCorriente_0);
        $razonCorriente_1 = divideNumbers( $activoCorriente_1 , $pasivoCorriente_1);

        $pruebaAcida_0 = divideNumbers( ($activoCorriente_0 - $sCFA->activoInventarios_0) , $pasivoCorriente_0);
        $pruebaAcida_1 = divideNumbers( ($activoCorriente_1 - $sCFA->activoInventarios_1) , $pasivoCorriente_1);

        $capitalDeTrabajo_0 =  $activoCorriente_0 - $pasivoCorriente_0;
        $capitalDeTrabajo_1 =  $activoCorriente_1 - $pasivoCorriente_1;
        
        $nivelDeEndeudamiento_0 = divideNumbers( $pasivo_0 , $activo_0) ;
        $nivelDeEndeudamiento_1 = divideNumbers( $pasivo_1 , $activo_1) ;
        
        $endeudamientoFinanciero_0 = divideNumbers( ($sCFA->pasivoObligacionesFinancierasCP_0 + $sCFA->pasivoObligacionesFinancierasLP_0), $pasivo_0) ;
        $endeudamientoFinanciero_1 = divideNumbers( ($sCFA->pasivoObligacionesFinancierasCP_1 + $sCFA->pasivoObligacionesFinancierasLP_1), $pasivo_1);
        $apalancamientoCortoPlazo_0 = divideNumbers($pasivoCorriente_0, $pasivo_0);
        $apalancamientoCortoPlazo_1 = divideNumbers($pasivoCorriente_1, $pasivo_1);
        $apalancamientoLargoPlazo_0 = divideNumbers($pasivoNoCorriente_0, $pasivo_0) * 100;
        $apalancamientoLargoPlazo_1 = divideNumbers($pasivoNoCorriente_1, $pasivo_1) * 100;
        $rentabilidadPatrimonioROA_0 = divideNumbers($utilidadNeta_0, $activo_0) ;
        $rentabilidadPatrimonioROA_1 = divideNumbers($utilidadNeta_1, $activo_1) ;
        $rentabilidadPatrimonioROE_0 = divideNumbers($utilidadNeta_0, $patrimonio_0) * 100;
        $rentabilidadPatrimonioROE_1 = divideNumbers($utilidadNeta_1, $patrimonio_1) * 100;
        
        $margenNetoUtilidad_0 = divideNumbers($utilidadNeta_0, $ingresosOperacionales_0) * 100;
        $margenNetoUtilidad_1 = divideNumbers($utilidadNeta_1, $ingresosOperacionales_1) * 100;
        
        $margenEBITDA_0 = divideNumbers($EBITDA_0, $ingresosOperacionales_0);
        $margenEBITDA_1 = divideNumbers($EBITDA_1, $ingresosOperacionales_1);

        
	$coberturaGastosFinancieros_0 = divideNumbers($EBITDA_0, $sCFA->estadoInteresesBancarios_0);
        $coberturaGastosFinancieros_1 = divideNumbers($EBITDA_1, $sCFA->estadoInteresesBancarios_1);


	    $endeudamientoVentas_0 = divideNumbers($pasivo_0, $ingresosOperacionales_0);
        $endeudamientoVentas_1 = divideNumbers($pasivo_1, $ingresosOperacionales_1);

        $coberturadeGastosNoOperacionales_0 = divideNumbers($EBITDA_0, $gastosNoOperacionales_0);
        $coberturadeGastosNoOperacionales_1 = divideNumbers($EBITDA_1, $gastosNoOperacionales_1);

        $quebrantoPatrimonial_0 = divideNumbers($patrimonio_0, $sCFA->patrimonioCapitalSocial_0) * 100;
        $quebrantoPatrimonial_1 = divideNumbers($patrimonio_1, $sCFA->patrimonioCapitalSocial_1) * 100;
        
        $cuentasDisponibles_0 = $sCFA->activoDisponible_0 + $sCFA->activoInversionesCP_0;
        $cuentasDisponibles_1 = $sCFA->activoDisponible_1 + $sCFA->activoInversionesCP_1;
        $depositosExigibles_0 = $sCFA->depositosExigiblesCP_0 + $sCFA->depositosExigiblesLP_0;
        $depositosExigibles_1 = $sCFA->depositosExigiblesCP_1 + $sCFA->depositosExigiblesLP_1;

        $fondoLiquidez_0 = divideNumbers($cuentasDisponibles_0, $depositosExigibles_0);
        $fondoLiquidez_1 = divideNumbers($cuentasDisponibles_1, $depositosExigibles_1);
        

        $razonPasivoCapital_0 = divideNumbers($pasivo_0, $patrimonio_0);
        $razonPasivoCapital_1 = divideNumbers($pasivo_1, $patrimonio_1);

        $leverage_0 = divideNumbers($pasivo_0, $patrimonio_0);
        $leverage_1 = divideNumbers($pasivo_1, $patrimonio_1);

        $margenBruto_0 = divideNumbers($utilidadBruta_0 , $ingresosOperacionales_0);
        $margenBruto_1 = divideNumbers($utilidadBruta_1 , $ingresosOperacionales_1);
        //Solicitado por patricia varificado por laura
        $rotacionCarteraAndes_0 = divideNumbers(($sCFA->activoClientes_0 * 360),$sCFA->estadoIngresosOperacionales_0);
        $rotacionCarteraAndes_1 = divideNumbers(($sCFA->activoClientes_1 * 360),$sCFA->estadoIngresosOperacionales_1);
        $rotacionCartera_0 = divideNumbers($sCFA->estadoIngresosOperacionales_0, $sCFA->activoClientes_0);
        $rotacionCartera_1 = divideNumbers($sCFA->estadoIngresosOperacionales_1, $sCFA->activoClientes_1);
        //Solicitado por patricia varificado por laura
        $rotacionInventarioAndres_0 = divideNumbers(($sCFA->activoInventarios_0 * 360), $sCFA->estadoCostoDeVenta_0);
        $rotacionInventarioAndres_1 = divideNumbers(($sCFA->activoInventarios_1 * 360), $sCFA->estadoCostoDeVenta_1);
        $rotacionInventario_0 = divideNumbers($sCFA->estadoCostoDeVenta_0 , $sCFA->activoInventarios_0);
        $rotacionInventario_1 = divideNumbers($sCFA->estadoCostoDeVenta_1 , $sCFA->activoInventarios_1);
        $rotacionActivos_0 = divideNumbers($sCFA->estadoIngresosOperacionales_0 , $activo_0);
        $rotacionActivos_1 = divideNumbers($sCFA->estadoIngresosOperacionales_1 , $activo_1);
        $utilidadesAcumuladas = $patrimonio_0 - $patrimonio_1;
        $varCapitalTrabajomenos1  = divideNumbers($capitalDeTrabajo_0, $capitalDeTrabajo_1)-1;
        $varCapitalTrabajo = $varCapitalTrabajomenos1 * -1;
        $varingresosOperacionales = $ingresosOperacionales_0 - $ingresosOperacionales_1; 

        if ($razonCorriente_0 <= 0.6 ) {
            $valRazonCorriente = 2;
        } else if ($razonCorriente_0 <= 0.6 ) {
            $valRazonCorriente = 1;
        } else if ($razonCorriente_0 >= 0.6 ) {
            $valRazonCorriente = 0;
        };
        
        if ($pruebaAcida_0 <= 0.6 ) {
            $valPruebaAcida = 2;
        } else if ($pruebaAcida_0 <= 0.6 ) {
            $valPruebaAcida = 1;
        } else if ($pruebaAcida_0 >= 0.6 ) {
            $valPruebaAcida = 0;
        };

        if ($capitalDeTrabajo_0 >= 0 ) {
            $valCapitalDeTrabajo = 1;
        } else {
            $valCapitalDeTrabajo = 0;
        };
        if ($nivelDeEndeudamiento_0 <= 0.6 ) {
            $valNivelDeEndeudamiento = 2;
        } else if ($nivelDeEndeudamiento_0 <= 0.6 ) {
            $valNivelDeEndeudamiento = 1;
        } else if ($nivelDeEndeudamiento_0 >= 0.6 ) {
            $valNivelDeEndeudamiento = 0;
        };
        if ($apalancamientoCortoPlazo_0 < 80 ) {
            $valApalancamientoCortoPlazo = 1;
        } else {
            $valApalancamientoCortoPlazo = 0;
        };
        if ($apalancamientoLargoPlazo_0 < 80 ) {
            $valApalancamientoLargoPlazo = 1;
        } else {
            $valApalancamientoLargoPlazo = 0;
        };
        if ($endeudamientoFinanciero_0 <= 0.8 ) {
            $valEndeudamientoFinanciero = 1;
        } else {
            $valEndeudamientoFinanciero = 0;
        };
        if ($margenEBITDA_0 >= 0.16 ) {
            $valMargenEBITDA = 1;
        } else if ($margenEBITDA_0 >= 0.08 || $margenEBITDA_0 <= 0.159 ) {
            $valMargenEBITDA = 1;
        } else if ($margenEBITDA_0 <= 0.08 ) {
            $valMargenEBITDA = 0;
        };
        
        if ($coberturaGastosFinancieros_0 >= 0.16 ) {
            $valCoberturaGastosFinancieros = 1;
        } else if ($coberturaGastosFinancieros_0 >= 0.08 || $coberturaGastosFinancieros_0 <= 0.159 ) {
            $valCoberturaGastosFinancieros = 1;
        } else if ($coberturaGastosFinancieros_0 <= 0.08 ) {
            $valCoberturaGastosFinancieros = 0;
        };
        
        if ($rentabilidadPatrimonioROA_0 >= 0.41 ) {
            $valRentabilidadPatrimonioROA = 1;
        } else if ($rentabilidadPatrimonioROA_0 >= 0.1 || $rentabilidadPatrimonioROA_0 <= 0.4 ) {
            $valRentabilidadPatrimonioROA = 0.5;
        } else if ($rentabilidadPatrimonioROA_0 <= 0.1 ) {
            $valRentabilidadPatrimonioROA = 0;
        };
        if ($rentabilidadPatrimonioROE_0 >= 0.41 ) {
            $valRentabilidadPatrimonioROE = 1;
        } else if ($rentabilidadPatrimonioROE_0 >= 0.1 || $rentabilidadPatrimonioROE_0 <= 0.4 ) {
            $valRentabilidadPatrimonioROE = 0.5;
        } else if ($rentabilidadPatrimonioROE_0 <= 0.1 ) {
            $valRentabilidadPatrimonioROE = 0;
        };
        
        if ($margenNetoUtilidad_0 >= 0.41 ) {
            $valMargenNetoUtilidad = 1;
        } else if ($margenNetoUtilidad_0 >= 0.1 || $margenNetoUtilidad_0 <= 0.4 ) {
            $valMargenNetoUtilidad = 0.5;
        } else if ($margenNetoUtilidad_0 <= 0.1 ) {
            $valMargenNetoUtilidad = 0;
        };


        if ($endeudamientoVentas_0 >= 0.41 ) {
            $valEndeudamientoVentas = 1;
        } else if ($endeudamientoVentas_0 >= 0.1 || $endeudamientoVentas_0 <= 0.4 ) {
            $valEndeudamientoVentas = 0.5;
        } else if ($endeudamientoVentas_0 <= 0.1 ) {
            $valEndeudamientoVentas = 0;
        };
        if ($coberturadeGastosNoOperacionales_0 >= 2.5 ) {
            $valCoberturadeGastosNoOperacionales = 1;
        } else {
            $valCoberturadeGastosNoOperacionales = 0;
        };
        if ($quebrantoPatrimonial_0 >= 2.5 ) {
            $valQuebrantoPatrimonial = 1;
        } else {
            $valQuebrantoPatrimonial = 0;
        };
        if ($fondoLiquidez_0 >= 2.5 ) {
            $valFondoLiquidez = 1;
        } else {
            $valFondoLiquidez = 0;
        };
        $valFinantialAnalisys = $valRazonCorriente + $valCapitalDeTrabajo + $valNivelDeEndeudamiento + $valEndeudamientoFinanciero + $valMargenEBITDA + $valCoberturadeGastosNoOperacionales;
    }

    // CENTRALES DE RIESGO
    if(isset($sectionCompanyFinance)){
        $nObligaciones_total = $sectionCompanyFinance->nObligaciones_0 + 
            $sectionCompanyFinance->nObligaciones_30 + 
            $sectionCompanyFinance->nObligaciones_60 + 
            $sectionCompanyFinance->nObligaciones_90 + 
            $sectionCompanyFinance->nObligaciones_120 + 
            $sectionCompanyFinance->nObligaciones_more120 + 
            $sectionCompanyFinance->nObligaciones_castigada;
    
        $valorTotal_total = $sectionCompanyFinance->valorTotal_0 + 
            $sectionCompanyFinance->valorTotal_30 + 
            $sectionCompanyFinance->valorTotal_60 + 
            $sectionCompanyFinance->valorTotal_90 + 
            $sectionCompanyFinance->valorTotal_120 + 
            $sectionCompanyFinance->valorTotal_more120 + 
            $sectionCompanyFinance->valorTotal_castigada;
        
        $valorMora_total = $sectionCompanyFinance->valorMora_0 + 
            $sectionCompanyFinance->valorMora_30 + 
            $sectionCompanyFinance->valorMora_60 + 
            $sectionCompanyFinance->valorMora_90 + 
            $sectionCompanyFinance->valorMora_120 + 
            $sectionCompanyFinance->valorMora_more120 + 
            $sectionCompanyFinance->valorMora_castigada;
        
        if ($valorTotal_total != "" && $valorTotal_total != 0) { $valorTotal_total = number_format($valorTotal_total, 2, ",", "."); } else { $valorTotal_total = ""; }
        if ($valorMora_total != "" && $valorMora_total != 0) { $valorMora_total = number_format($valorMora_total, 2, ",", "."); } else { $valorMora_total = ""; }
    }

    // EMPLEADOS
    if (isset($sectionCompanyEmployee)) {
        $totalEmpleados = $sectionCompanyEmployee[0]['questionAnswer']+$sectionCompanyEmployee[1]['questionAnswer']+$sectionCompanyEmployee[2]['questionAnswer']+$sectionCompanyEmployee[3]['questionAnswer']+$sectionCompanyEmployee[4]['questionAnswer']+$sectionCompanyEmployee[5]['questionAnswer'];
    }