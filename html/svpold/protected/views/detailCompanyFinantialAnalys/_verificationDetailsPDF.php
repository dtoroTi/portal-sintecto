<?php
/*
$pdf->SetFillColor(220);

$pdf->Cell(35, '', 'Número de Personas', 1, 0, 'L', 1);
$pdf->Cell(20, '', count($verificationSection->detailPersons), 1, 1, 'C');


foreach ($verificationSection->detailPersons as $person) {
  if (!$person->isAReference) {
    $pdf->Cell(0, '', '', 0, 1, 'L');
    $pdf->Cell(20, '', 'Relación', 1, 0, 'L', 1);
    $pdf->Cell(25, '', CHtml::encode($person->relation), 1, 0, 'L');
    $pdf->Cell(20, '', 'Nombre', 1, 0, 'L', 1);
    $pdf->Cell(56, '', CHtml::encode($person->name), 1, 0, 'L');
    $pdf->Cell(10, '', 'Edad', 1, 0, 'L', 1);
    $pdf->Cell(10, '', CHtml::encode($person->age), 1, 0, 'L');
    $pdf->Cell(25, '', 'Estado Civil', 1, 0, 'L', 1);
    $pdf->Cell(30, '', CHtml::encode($person->relationshipStatus->name), 1, 1, 'L');

    $pdf->Cell(25, '', 'Profesión', 1, 0, 'L', 1);
    $pdf->Cell(35, '', CHtml::encode($person->profession), 1, 0, 'L');
    $pdf->Cell(25, '', 'Trabaja en', 1, 0, 'L', 1);
    $pdf->Cell(38, '', CHtml::encode($person->workingAt), 1, 0, 'L');
    $pdf->Cell(25, '', 'Ocupación', 1, 0, 'L', 1);
    $pdf->Cell(48, '', CHtml::encode($person->functions), 1, 1, 'L');

    $pdf->Cell(25, '', 'Nivel de Educación', 1, 0, 'L', 1);
    $pdf->Cell(50, '', CHtml::encode($person->educationType ? $person->educationType->name : ""), 1, 0, 'L');
    $pdf->Cell(10, '', 'Tel', 1, 0, 'L', 1);
    $pdf->Cell(50, '', CHtml::encode($person->tel), 1, 0, 'L');
    $pdf->Cell(61, '', '', 1, 1, 'L');
  } else {
    $pdf->Cell(0, '', '', 0, 1, 'L');
    $pdf->Cell(20, '', 'Relación', 1, 0, 'L', 1);
    $pdf->Cell(50, '', CHtml::encode($person->relation), 1, 0, 'L');
    $pdf->Cell(20, '', 'Nombre', 1, 0, 'L', 1);
    $pdf->Cell(50, '', CHtml::encode($person->name), 1, 0, 'L');
    $pdf->Cell(10, '', 'Tel', 1, 0, 'L', 1);
    $pdf->Cell(46, '', CHtml::encode($person->tel), 1, 1, 'L');

    $pdf->Cell(25, '', 'Lo conoce hace', 1, 0, 'L', 1);
    $pdf->Cell(15, '', CHtml::encode($person->howLongKnowEachOther), 1, 0, 'L');
    $pdf->Cell(30, '', 'Lo recomendaría', 1, 0, 'L', 1);
    $pdf->Cell(36, '', CHtml::encode($person->wouldYouRecomendTheCandidate), 1, 0, 'L');
    $pdf->Cell(15, '', 'Resultado', 1, 0, 'L', 1);
    $pdf->Cell(30, '', CHtml::encode($person->verificationResult->name), 1, 0, 'L');
    $pdf->Cell(25, '', 'Verificado En', 1, 0, 'L', 1);
    $pdf->Cell(20, '', CHtml::encode($person->verifiedOn), 1, 1, 'L');
  }

  if (trim($person->comments) != "") {
    $pdf->Cell(25, '', 'Comentarios', 1, 0, 'L', 1);
    $pdf->MultiCell(171, '', CHtml::encode($person->comments), 1, 'J', FALSE, TRUE);
  }
}
$pdf->SetFillColor(255);
*/
if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 1) {
function percentNumbers($a)
{
    $ans = number_format(($a * 100), 2) . '%';
    return $ans;
};
function divideNumberss($a, $b){
    if ($a != 0 && $b != 0) {
        $ans = $a / $b;
    } else {
        $ans = '0';
    }
    return $ans;
};


function varCuentas( $var_0, $var_1){
    $varInt = $var_0 - $var_1;
    if ($var_1 != 0) {
        $varPercent = percentNumbers( $varInt /  $var_1);
        $ans = $varPercent;
    } else {
        $ans = "";
    }
    return $ans;
};

function pondCalc($query, $points = 0, $value = 0, $weight = 0){
    $obtValue = divideNumberss($points, $value);
    $obtWeight =  divideNumberss(($obtValue * $weight),100);
    if ($query == "peso") {
        $ans = percentNumbers($obtWeight);
    } else {
        $ans = $obtValue;
    }
    return $ans;
};
function valCalc($query, $points = 0, $questionValue = 0, $value = 0, $weight = 0){
    $obtValue = divideNumbers($points, $questionValue);
    $questionWeight = divideNumberss($questionValue, $value)*$weight;
    $obtWeight =  divideNumberss(($obtValue * $questionWeight),100);
    if ($query == "peso") {
        $ans = percentNumbers($obtWeight);
    } else {
        $ans = percentNumbers($obtValue);
    }
    return $ans;
};



//CALCULOS

if (isset($verificationSection->detailCompanyFinantialAnalys)){
    $sCFA = $verificationSection->detailCompanyFinantialAnalys;
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
    $razonCorriente_0 = divideNumberss( $activoCorriente_0 , $pasivoCorriente_0);
    $razonCorriente_1 = divideNumberss( $activoCorriente_1 , $pasivoCorriente_1);

    $pruebaAcida_0 = divideNumberss( ($activoCorriente_0 - $sCFA->activoInventarios_0) , $pasivoCorriente_0);
    $pruebaAcida_1 = divideNumberss( ($activoCorriente_1 - $sCFA->activoInventarios_1) , $pasivoCorriente_1);

    $capitalDeTrabajo_0 =  $activoCorriente_0 - $pasivoCorriente_0;
    $capitalDeTrabajo_1 =  $activoCorriente_1 - $pasivoCorriente_1;

    $nivelDeEndeudamiento_0 = divideNumberss( $pasivo_0 , $activo_0) ;
    $nivelDeEndeudamiento_1 = divideNumberss( $pasivo_1 , $activo_1) ;

    $endeudamientoFinanciero_0 = divideNumberss( ($sCFA->pasivoObligacionesFinancierasCP_0 + $sCFA->pasivoObligacionesFinancierasLP_0), $ingresosOperacionales_0) ;
    $endeudamientoFinanciero_1 = divideNumberss( ($sCFA->pasivoObligacionesFinancierasCP_1 + $sCFA->pasivoObligacionesFinancierasLP_1), $ingresosOperacionales_1) * 100;
    $apalancamientoCortoPlazo_0 = divideNumberss($pasivoCorriente_0, $patrimonio_0);
    $apalancamientoCortoPlazo_1 = divideNumberss($pasivoCorriente_1, $patrimonio_1);
    $apalancamientoLargoPlazo_0 = divideNumberss($pasivoNoCorriente_0, $patrimonio_0) * 100;
    $apalancamientoLargoPlazo_1 = divideNumberss($pasivoNoCorriente_1, $patrimonio_1) * 100;
    $rentabilidadPatrimonioROA_0 = divideNumberss($utilidadNeta_0, $activo_0) ;
    $rentabilidadPatrimonioROA_1 = divideNumberss($utilidadNeta_1, $activo_1) ;
    $rentabilidadPatrimonioROE_0 = divideNumberss($utilidadNeta_0, $patrimonio_0) * 100;
    $rentabilidadPatrimonioROE_1 = divideNumberss($utilidadNeta_1, $patrimonio_1) * 100;

    $margenNetoUtilidad_0 = divideNumberss($utilidadNeta_0, $ingresosOperacionales_0) * 100;
    $margenNetoUtilidad_1 = divideNumberss($utilidadNeta_1, $ingresosOperacionales_1) * 100;

    $margenEBITDA_0 = divideNumberss($EBITDA_0, $ingresosOperacionales_0);
    $margenEBITDA_1 = divideNumberss($EBITDA_1, $ingresosOperacionales_1);


    $coberturaGastosFinancieros_0 = divideNumberss($EBITDA_0, $sCFA->estadoInteresesBancarios_0);
    $coberturaGastosFinancieros_1 = divideNumberss($EBITDA_1, $sCFA->estadoInteresesBancarios_1);


    $endeudamientoVentas_0 = divideNumberss($pasivo_0, $sCFA->estadoIngresosOperacionales_0);
    $endeudamientoVentas_1 = divideNumberss($pasivo_1, $sCFA->estadoIngresosOperacionales_1);

    $coberturadeGastosNoOperacionales_0 = divideNumberss($EBITDA_0, $gastosNoOperacionales_0);
    $coberturadeGastosNoOperacionales_1 = divideNumberss($EBITDA_1, $gastosNoOperacionales_1);

    $quebrantoPatrimonial_0 = divideNumberss($patrimonio_0, $sCFA->patrimonioCapitalSocial_0) * 100;
    $quebrantoPatrimonial_1 = divideNumberss($patrimonio_1, $sCFA->patrimonioCapitalSocial_1) * 100;

    $cuentasDisponibles_0 = $sCFA->activoDisponible_0 + $sCFA->activoInversionesCP_0;
    $cuentasDisponibles_1 = $sCFA->activoDisponible_1 + $sCFA->activoInversionesCP_1;
    $depositosExigibles_0 = $sCFA->depositosExigiblesCP_0 + $sCFA->depositosExigiblesLP_0;
    $depositosExigibles_1 = $sCFA->depositosExigiblesCP_1 + $sCFA->depositosExigiblesLP_1;

    $fondoLiquidez_0 = divideNumberss($cuentasDisponibles_0, $depositosExigibles_0);
    $fondoLiquidez_1 = divideNumberss($cuentasDisponibles_1, $depositosExigibles_1);


    $razonPasivoCapital_0 = divideNumberss($pasivo_0, $patrimonio_0);
    $razonPasivoCapital_1 = divideNumberss($pasivo_1, $patrimonio_1);

    $leverage_0 = divideNumberss($pasivo_0, $patrimonio_0);
    $leverage_1 = divideNumberss($pasivo_1, $patrimonio_1);

    $margenBruto_0 = divideNumberss($utilidadBruta_0 , $ingresosOperacionales_0);
    $margenBruto_1 = divideNumberss($utilidadBruta_1 , $ingresosOperacionales_1);
    $rotacionCartera_0 = divideNumberss($sCFA->estadoIngresosOperacionales_0, $sCFA->activoClientes_0);
    $rotacionCartera_1 = divideNumberss($sCFA->estadoIngresosOperacionales_1, $sCFA->activoClientes_1);
    $rotacionCarteraDias_0 = divideNumberss($sCFA->activoClientes_0 * 360, $sCFA->estadoIngresosOperacionales_0);
    $rotacionCarteraDias_1 = divideNumberss($sCFA->activoClientes_1 * 360,  $sCFA->estadoIngresosOperacionales_1);
    $rotacionInventario_0 = divideNumberss($sCFA->estadoCostoDeVenta_0 , $sCFA->activoInventarios_0);
    $rotacionInventario_1 = divideNumberss($sCFA->estadoCostoDeVenta_1 , $sCFA->activoInventarios_1);
    $rotacionInventarioDias_0 = divideNumberss($sCFA->activoInventarios_0 * 360, $sCFA->estadoCostoDeVenta_0);
    $rotacionInventarioDias_1 = divideNumberss($sCFA->activoInventarios_1 * 360 , $sCFA->estadoCostoDeVenta_1);
    $rotacionActivos_0 = divideNumberss($sCFA->estadoIngresosOperacionales_0 , $activo_0);
    $rotacionActivos_1 = divideNumberss($sCFA->estadoIngresosOperacionales_1 , $activo_1);
    $utilidadesAcumuladas = $patrimonio_0 - $patrimonio_1;
    $varCapitalTrabajo  = divideNumberss($capitalDeTrabajo_0, $capitalDeTrabajo_1);
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

// VISTA PDF Vanti
if ($verificationSection->backgroundCheck->customerId == 502){    


        $pdf->AddPage();
       // $pdf->SetY(30);
        // INFORMACIÓN ESTADOS FINANCIEROS
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->SetFillColor(0, 66, 109);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->MultiCell(170, 0, "INFORMACIÓN ESTADOS FINANCIEROS", 1, 'C', 1, 1, '', '', true);
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->MultiCell(50, 0, "Cuentas Principales ", 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, $verificationSection->detailCompanyFinantialAnalys->dateLastBalanceSheet, 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, $verificationSection->detailCompanyFinantialAnalys->dateLastBalanceSheet_1, 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, "Var %", 1, 'C', 1, 1, '', '', true);

        $pdf->SetFillColor(150, 150, 150);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(170, 0, "ESTADO DE SITUACIÓN", 1, 'L', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Activo", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($activo_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($activo_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($activo_0, $activo_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Activo Corriente", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($activoCorriente_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($activoCorriente_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($activoCorriente_0, $activoCorriente_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Activo Fijo", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($activoFijo_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($activoFijo_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($activoFijo_0, $activoFijo_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Otros Activos", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($otrosActivos_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($otrosActivos_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($otrosActivos_0, $otrosActivos_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Pasivo", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($pasivo_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($pasivo_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($pasivo_0, $pasivo_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Pasivo Corriente", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($pasivoCorriente_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($pasivoCorriente_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($pasivoCorriente_0, $pasivoCorriente_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Pasivo No Corriente", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($pasivoNoCorriente_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($pasivoNoCorriente_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($pasivoNoCorriente_0, $pasivoNoCorriente_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Patrimonio", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($patrimonio_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($patrimonio_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($patrimonio_0, $patrimonio_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Total Pasivo y Patrimonio", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($totalPasivoYPatrimonio_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($totalPasivoYPatrimonio_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($totalPasivoYPatrimonio_0, $totalPasivoYPatrimonio_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(150, 150, 150);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(170, 0, "ESTADO DE RESULTADOS", 1, 'L', 1, 1, '', '', true);


        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Ingresos Operacionales", 1, 'L', 1, 0, '', '', true);
        if ($ingresosOperacionales_0 == "") {
            $ingresosOperacionales_0 = 0;
        }
        if ($ingresosOperacionales_1 == "") {
            $ingresosOperacionales_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($ingresosOperacionales_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($ingresosOperacionales_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($ingresosOperacionales_0, $ingresosOperacionales_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Costo de Venta", 1, 'L', 1, 0, '', '', true);
        if ($costoDeVenta_0 == "") {
            $costoDeVenta_0 = 0;
        }
        if ($costoDeVenta_1 == "") {
            $costoDeVenta_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($costoDeVenta_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($costoDeVenta_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($costoDeVenta_0, $costoDeVenta_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Utilidad Bruta", 1, 'L', 1, 0, '', '', true);
        if ($utilidadBruta_0 == "") {
            $utilidadBruta_0 = 0;
        }
        if ($utilidadBruta_1 == "") {
            $utilidadBruta_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadBruta_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadBruta_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($utilidadBruta_0, $utilidadBruta_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Gastos Operacionales Admón", 1, 'L', 1, 0, '', '', true);
        if ($gastosOperacionalesAdmon_0 == "") {
            $gastosOperacionalesAdmon_0 = 0;
        }
        if ($gastosOperacionalesAdmon_1 == "") {
            $gastosOperacionalesAdmon_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($gastosOperacionalesAdmon_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($gastosOperacionalesAdmon_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($gastosOperacionalesAdmon_0, $gastosOperacionalesAdmon_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Gastos Operacionales Venta", 1, 'L', 1, 0, '', '', true);
        if ($gastosOperacionalesVenta_0 == "") {
            $gastosOperacionalesVenta_0 = 0;
        }
        if ($gastosOperacionalesVenta_1 == "") {
            $gastosOperacionalesVenta_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($gastosOperacionalesVenta_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($gastosOperacionalesVenta_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($gastosOperacionalesVenta_0, $gastosOperacionalesVenta_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Utilidad Operacional", 1, 'L', 1, 0, '', '', true);
        if ($utilidadOperacional_0 == "") {
            $utilidadOperacional_0 = 0;
        }
        if ($utilidadOperacional_1 == "") {
            $utilidadOperacional_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadOperacional_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadOperacional_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($utilidadOperacional_0, $utilidadOperacional_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Ingresos NO Operacionales", 1, 'L', 1, 0, '', '', true);
        if ($ingresosNoOperacionales_0 == "") {
            $ingresosNoOperacionales_0 = 0;
        }
        if ($ingresosNoOperacionales_1 == "") {
            $ingresosNoOperacionales_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($ingresosNoOperacionales_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($ingresosNoOperacionales_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($ingresosNoOperacionales_0, $ingresosNoOperacionales_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Gastos NO Operacionales", 1, 'L', 1, 0, '', '', true);
        if ($gastosNoOperacionales_0 == "") {
            $gastosNoOperacionales_0 = 0;
        }
        if ($gastosNoOperacionales_1 == "") {
            $gastosNoOperacionales_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($gastosNoOperacionales_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($gastosNoOperacionales_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($gastosNoOperacionales_0, $gastosNoOperacionales_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Utilidad Antes de Impuestos", 1, 'L', 1, 0, '', '', true);
        if ($utilidadAntesDeImpuestos_0 == "") {
            $utilidadAntesDeImpuestos_0 = 0;
        }
        if ($utilidadAntesDeImpuestos_1 == "") {
            $utilidadAntesDeImpuestos_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadAntesDeImpuestos_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadAntesDeImpuestos_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($utilidadAntesDeImpuestos_0, $utilidadAntesDeImpuestos_1), 1, 'R', 1, 1, '', '', true);
        if ($impuestoDeRenta_0 == "") {
            $impuestoDeRenta_0 = 0;
        }
        if ($impuestoDeRenta_1 == "") {
            $impuestoDeRenta_1 = 0;
        }
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Impuesto de Renta", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($impuestoDeRenta_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($impuestoDeRenta_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($impuestoDeRenta_0, $impuestoDeRenta_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Utilidad Neta", 1, 'L', 1, 0, '', '', true);
        if ($utilidadNeta_0 == "") {
            $utilidadNeta_0 = 0;
        }
        if ($utilidadNeta_1 == "") {
            $utilidadNeta_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadNeta_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadNeta_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($utilidadNeta_0, $utilidadNeta_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "EBITDA", 1, 'L', 1, 0, '', '', true);
        if ($EBITDA_0 == "") {
            $EBITDA_0 = 0;
        }
        if ($EBITDA_1 == "") {
            $EBITDA_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($EBITDA_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($EBITDA_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($EBITDA_0, $EBITDA_1), 1, 'R', 1, 1, '', '', true);

        $pdf->AddPage();
        $pdf->SetY(25);

        // INDICADORES FINANCIEROS
        $pdf->SetFillColor(0, 66, 109);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 9);
        $pdf->MultiCell(80, 0, "INDICADORES FINANCIEROS ", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, $verificationSection->detailCompanyFinantialAnalys->dateLastBalanceSheet, 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, $verificationSection->detailCompanyFinantialAnalys->dateLastBalanceSheet_1, 1, 'C', 1, 1, '', '', true);
        $pdf->SetFillColor(150, 150, 150);
        $pdf->SetTextColor(0, 0, 0);


       // $pdf->MultiCell(170, 0, "Indicadores de Liquidez", 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Razón Corriente", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($razonCorriente_0, 2, '.', '') . " veces\n", 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($razonCorriente_1, 2, '.', '') . " veces\n", 1, 'R', 1, 1, '', '', true);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->MultiCell(80, 0, "Prueba Ácida", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($pruebaAcida_0, 2, '.', '') . " veces\n", 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($pruebaAcida_1, 2, '.', '') . " veces\n", 1, 'R', 1, 1, '', '', true);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Nivel de Endeudamiento", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($nivelDeEndeudamiento_0, 2, '.', '') . " veces\n", 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($nivelDeEndeudamiento_1, 2, '.', '') . " veces\n", 1, 'R', 1, 1, '', '', true);


        $pdf->MultiCell(80, 0, "Capital de Trabajo", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($capitalDeTrabajo_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($capitalDeTrabajo_1, 2, ',', '.'), 1, 'R', 1, 1, '', '', true);


        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Rentabilidad Patrimonio (ROE)", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($rentabilidadPatrimonioROE_0, 2, '.', '') . "%", 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($rentabilidadPatrimonioROE_1, 2, '.', '') . "%", 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Margen EBITDA", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($margenEBITDA_0, 2, '.', '') . "%", 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($margenEBITDA_1, 2, '.', '') . "%", 1, 'R', 1, 1, '', '', true);
        $pdf->Cell(0, '', '', 0, 1, 'L');
    }


    // VISTA PDF EMPRESAS

else{

        $pdf->AddPage();
       // $pdf->SetY(30);
        // INFORMACIÓN ESTADOS FINANCIEROS
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->SetFillColor(0, 66, 109);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->MultiCell(170, 0, "INFORMACIÓN ESTADOS FINANCIEROS", 1, 'C', 1, 1, '', '', true);
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->MultiCell(50, 0, "Cuentas Principales ", 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, $verificationSection->detailCompanyFinantialAnalys->dateLastBalanceSheet, 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, $verificationSection->detailCompanyFinantialAnalys->dateLastBalanceSheet_1, 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, "Var %", 1, 'C', 1, 1, '', '', true);

        $pdf->SetFillColor(150, 150, 150);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(170, 0, "ESTADO DE SITUACIÓN", 1, 'L', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Activo", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($activo_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($activo_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($activo_0, $activo_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Activo Corriente", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($activoCorriente_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($activoCorriente_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($activoCorriente_0, $activoCorriente_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Activo Fijo", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($activoFijo_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($activoFijo_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($activoFijo_0, $activoFijo_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Otros Activos", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($otrosActivos_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($otrosActivos_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($otrosActivos_0, $otrosActivos_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Pasivo", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($pasivo_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($pasivo_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($pasivo_0, $pasivo_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Pasivo Corriente", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($pasivoCorriente_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($pasivoCorriente_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($pasivoCorriente_0, $pasivoCorriente_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Pasivo No Corriente", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($pasivoNoCorriente_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($pasivoNoCorriente_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($pasivoNoCorriente_0, $pasivoNoCorriente_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Patrimonio", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($patrimonio_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($patrimonio_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($patrimonio_0, $patrimonio_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Total Pasivo y Patrimonio", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($totalPasivoYPatrimonio_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($totalPasivoYPatrimonio_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($totalPasivoYPatrimonio_0, $totalPasivoYPatrimonio_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(150, 150, 150);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(170, 0, "ESTADO DE RESULTADOS", 1, 'L', 1, 1, '', '', true);


        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Ingresos Operacionales", 1, 'L', 1, 0, '', '', true);
        if ($ingresosOperacionales_0 == "") {
            $ingresosOperacionales_0 = 0;
        }
        if ($ingresosOperacionales_1 == "") {
            $ingresosOperacionales_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($ingresosOperacionales_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($ingresosOperacionales_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($ingresosOperacionales_0, $ingresosOperacionales_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Costo de Venta", 1, 'L', 1, 0, '', '', true);
        if ($costoDeVenta_0 == "") {
            $costoDeVenta_0 = 0;
        }
        if ($costoDeVenta_1 == "") {
            $costoDeVenta_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($costoDeVenta_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($costoDeVenta_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($costoDeVenta_0, $costoDeVenta_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Utilidad Bruta", 1, 'L', 1, 0, '', '', true);
        if ($utilidadBruta_0 == "") {
            $utilidadBruta_0 = 0;
        }
        if ($utilidadBruta_1 == "") {
            $utilidadBruta_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadBruta_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadBruta_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($utilidadBruta_0, $utilidadBruta_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Gastos Operacionales Admón", 1, 'L', 1, 0, '', '', true);
        if ($gastosOperacionalesAdmon_0 == "") {
            $gastosOperacionalesAdmon_0 = 0;
        }
        if ($gastosOperacionalesAdmon_1 == "") {
            $gastosOperacionalesAdmon_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($gastosOperacionalesAdmon_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($gastosOperacionalesAdmon_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($gastosOperacionalesAdmon_0, $gastosOperacionalesAdmon_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Gastos Operacionales Venta", 1, 'L', 1, 0, '', '', true);
        if ($gastosOperacionalesVenta_0 == "") {
            $gastosOperacionalesVenta_0 = 0;
        }
        if ($gastosOperacionalesVenta_1 == "") {
            $gastosOperacionalesVenta_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($gastosOperacionalesVenta_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($gastosOperacionalesVenta_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($gastosOperacionalesVenta_0, $gastosOperacionalesVenta_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Utilidad Operacional", 1, 'L', 1, 0, '', '', true);
        if ($utilidadOperacional_0 == "") {
            $utilidadOperacional_0 = 0;
        }
        if ($utilidadOperacional_1 == "") {
            $utilidadOperacional_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadOperacional_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadOperacional_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($utilidadOperacional_0, $utilidadOperacional_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Ingresos NO Operacionales", 1, 'L', 1, 0, '', '', true);
        if ($ingresosNoOperacionales_0 == "") {
            $ingresosNoOperacionales_0 = 0;
        }
        if ($ingresosNoOperacionales_1 == "") {
            $ingresosNoOperacionales_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($ingresosNoOperacionales_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($ingresosNoOperacionales_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($ingresosNoOperacionales_0, $ingresosNoOperacionales_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Gastos NO Operacionales", 1, 'L', 1, 0, '', '', true);
        if ($gastosNoOperacionales_0 == "") {
            $gastosNoOperacionales_0 = 0;
        }
        if ($gastosNoOperacionales_1 == "") {
            $gastosNoOperacionales_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($gastosNoOperacionales_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($gastosNoOperacionales_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($gastosNoOperacionales_0, $gastosNoOperacionales_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Utilidad Antes de Impuestos", 1, 'L', 1, 0, '', '', true);
        if ($utilidadAntesDeImpuestos_0 == "") {
            $utilidadAntesDeImpuestos_0 = 0;
        }
        if ($utilidadAntesDeImpuestos_1 == "") {
            $utilidadAntesDeImpuestos_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadAntesDeImpuestos_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadAntesDeImpuestos_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($utilidadAntesDeImpuestos_0, $utilidadAntesDeImpuestos_1), 1, 'R', 1, 1, '', '', true);
        if ($impuestoDeRenta_0 == "") {
            $impuestoDeRenta_0 = 0;
        }
        if ($impuestoDeRenta_1 == "") {
            $impuestoDeRenta_1 = 0;
        }
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Impuesto de Renta", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($impuestoDeRenta_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($impuestoDeRenta_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($impuestoDeRenta_0, $impuestoDeRenta_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "Utilidad Neta", 1, 'L', 1, 0, '', '', true);
        if ($utilidadNeta_0 == "") {
            $utilidadNeta_0 = 0;
        }
        if ($utilidadNeta_1 == "") {
            $utilidadNeta_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadNeta_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($utilidadNeta_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($utilidadNeta_0, $utilidadNeta_1), 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(50, 0, "EBITDA", 1, 'L', 1, 0, '', '', true);
        if ($EBITDA_0 == "") {
            $EBITDA_0 = 0;
        }
        if ($EBITDA_1 == "") {
            $EBITDA_1 = 0;
        }
        $pdf->MultiCell(45, 0, "$ " . number_format($EBITDA_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($EBITDA_1, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(30, 0, varCuentas($EBITDA_0, $EBITDA_1), 1, 'R', 1, 1, '', '', true);

        $pdf->AddPage();
        $pdf->SetY(25);
        // INDICADORES FINANCIEROS
        $pdf->SetFillColor(0, 66, 109);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', '', 9);
        $pdf->MultiCell(80, 0, "INDICADORES FINANCIEROS ", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, $verificationSection->detailCompanyFinantialAnalys->dateLastBalanceSheet, 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, $verificationSection->detailCompanyFinantialAnalys->dateLastBalanceSheet_1, 1, 'C', 1, 1, '', '', true);
        $pdf->SetFillColor(150, 150, 150);
        $pdf->SetTextColor(0, 0, 0);


        $pdf->MultiCell(170, 0, "Indicadores de Liquidez", 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Razón Corriente", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($razonCorriente_0, 2, '.', '') . " veces\n", 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($razonCorriente_1, 2, '.', '') . " veces\n", 1, 'R', 1, 1, '', '', true);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->MultiCell(80, 0, "Prueba Ácida", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($pruebaAcida_0, 2, '.', '') . " veces\n", 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($pruebaAcida_1, 2, '.', '') . " veces\n", 1, 'R', 1, 1, '', '', true);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->MultiCell(80, 0, "Capital de Trabajo", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($capitalDeTrabajo_0, 2, ',', '.'), 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, "$ " . number_format($capitalDeTrabajo_1, 2, ',', '.'), 1, 'R', 1, 1, '', '', true);
        $pdf->SetFillColor(150, 150, 150);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(170, 0, "Indicadores de Endeudamiento", 1, 'L', 1, 1, '', '', true);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Nivel de Endeudamiento", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($nivelDeEndeudamiento_0, 2, '.', '') . " veces\n", 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($nivelDeEndeudamiento_1, 2, '.', '') . " veces\n", 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Endeudamiento Financiero", 1, 'L', 1, 0, '', '', true);
        if ($verificationSection->backgroundCheck->customerId == 648){
            $pdf->MultiCell(45, 0, number_format($endeudamientoFinanciero_0 * 100, 2, '.', '') . "%", 1, 'R', 1, 0, '', '', true);
            $pdf->MultiCell(45, 0, number_format($endeudamientoFinanciero_1, 2, '.', '') . "%", 1, 'R', 1, 1, '', '', true);
        } else{
            $pdf->MultiCell(45, 0, number_format($endeudamientoFinanciero_0, 2, '.', '') . "%", 1, 'R', 1, 0, '', '', true);
            $pdf->MultiCell(45, 0, number_format($endeudamientoFinanciero_1, 2, '.', '') . "%", 1, 'R', 1, 1, '', '', true);
        }

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Apalancamiento Corto Plazo", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($apalancamientoCortoPlazo_0, 2, '.', '') . "%", 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($apalancamientoCortoPlazo_1, 2, '.', '') . "%", 1, 'R', 1, 1, '', '', true);
        if ($verificationSection->backgroundCheck->customerId == 648){

        } else{
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->MultiCell(80, 0, "Apalancamiento Largo Plazo", 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(45, 0, number_format($apalancamientoLargoPlazo_0, 2, '.', '') . "%", 1, 'R', 1, 0, '', '', true);
            $pdf->MultiCell(45, 0, number_format($apalancamientoLargoPlazo_1, 2, '.', '') . "%", 1, 'R', 1, 1, '', '', true);
        }

        $pdf->SetFillColor(150, 150, 150);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(170, 0, "Indicadores Rentabilidad", 1, 'L', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Rentabilidad Operativa Activo (ROA)", 1, 'L', 1, 0, '', '', true);
        if ($verificationSection->backgroundCheck->customerId == 648){
            $pdf->MultiCell(45, 0, number_format($rentabilidadPatrimonioROA_0 * 100, 2, '.', '') . "%", 1, 'R', 1, 0, '', '', true);
            $pdf->MultiCell(45, 0, number_format($rentabilidadPatrimonioROA_1 * 100 , 2, '.', '') . "%", 1, 'R', 1, 1, '', '', true);
        } else{
            $pdf->MultiCell(45, 0, number_format($rentabilidadPatrimonioROA_0, 2, '.', '') . "%", 1, 'R', 1, 0, '', '', true);
            $pdf->MultiCell(45, 0, number_format($rentabilidadPatrimonioROA_1, 2, '.', '') . "%", 1, 'R', 1, 1, '', '', true);
        }
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Rentabilidad Patrimonio (ROE)", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($rentabilidadPatrimonioROE_0, 2, '.', '') . "%", 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($rentabilidadPatrimonioROE_1, 2, '.', '') . "%", 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Margen Neto Utilidad", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($margenNetoUtilidad_0, 2, '.', '') . "%", 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($margenNetoUtilidad_1, 2, '.', '') . "%", 1, 'R', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Margen Bruto Utilidad", 1, 'L', 1, 0, '', '', true);
        if ($verificationSection->backgroundCheck->customerId == 648){
            $pdf->MultiCell(45, 0, number_format($margenBruto_0 * 100, 2, '.', '') . "%", 1, 'R', 1, 0, '', '', true);
            $pdf->MultiCell(45, 0, number_format($margenBruto_1 * 100, 2, '.', '') . "%", 1, 'R', 1, 1, '', '', true);
        } else{
            $pdf->MultiCell(45, 0, number_format($margenBruto_0, 2, '.', '') . "%", 1, 'R', 1, 0, '', '', true);
            $pdf->MultiCell(45, 0, number_format($margenBruto_1, 2, '.', '') . "%", 1, 'R', 1, 1, '', '', true);
        }
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Margen EBITDA", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($margenEBITDA_0, 2, '.', '') . "%", 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($margenEBITDA_1, 2, '.', '') . "%", 1, 'R', 1, 1, '', '', true);


        $pdf->SetFillColor(150, 150, 150);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(170, 0, "Indicadores de Rotación", 1, 'L', 1, 1, '', '', true);

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Rotación de Cartera", 1, 'L', 1, 0, '', '', true);
        if ($verificationSection->backgroundCheck->customerId == 648){
            $pdf->MultiCell(45, 0, number_format($rotacionCarteraDias_0, 0, '.', '') . " Dias\n", 1, 'R', 1, 0, '', '', true);
            $pdf->MultiCell(45, 0, number_format($rotacionCarteraDias_1, 0, '.', '') . " Dias\n", 1, 'R', 1, 1, '', '', true);
        } else{
            $pdf->MultiCell(45, 0, number_format($rotacionCartera_0, 2, '.', '') . " veces\n", 1, 'R', 1, 0, '', '', true);
            $pdf->MultiCell(45, 0, number_format($rotacionCartera_1, 2, '.', '') . " veces\n", 1, 'R', 1, 1, '', '', true);
        }
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Rotación de Inventario", 1, 'L', 1, 0, '', '', true);
        if ($verificationSection->backgroundCheck->customerId == 648){
            $pdf->MultiCell(45, 0, number_format($rotacionInventarioDias_0, 0, '.', '') . " Dias\n", 1, 'R', 1, 0, '', '', true);
            $pdf->MultiCell(45, 0, number_format($rotacionInventarioDias_1, 0, '.', '') . " Dias\n", 1, 'R', 1, 1, '', '', true);
        } else {
            $pdf->MultiCell(45, 0, number_format($rotacionInventario_0, 2, '.', '') . " veces\n", 1, 'R', 1, 0, '', '', true);
            $pdf->MultiCell(45, 0, number_format($rotacionInventario_1, 2, '.', '') . " veces\n", 1, 'R', 1, 1, '', '', true);
        }
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(80, 0, "Rotación de Activos", 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($rotacionActivos_0, 2, '.', '') . " veces\n", 1, 'R', 1, 0, '', '', true);
        $pdf->MultiCell(45, 0, number_format($rotacionActivos_1, 2, '.', '') . " veces\n", 1, 'R', 1, 1, '', '', true);       
        $pdf->Cell(0, '', '', 0, 1, 'L');
}
}