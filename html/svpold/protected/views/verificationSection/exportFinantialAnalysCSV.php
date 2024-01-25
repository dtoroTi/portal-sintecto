<?php

function addNumbers($a=0, $b=0, $c=0,$d=0, $e=0, $f=0, $g=0, $h=0, $i=0, $j=0, $k=0, $l=0, $m=0, $n=0){
    $ans = $a + $b + $c + $d + $e + $f +$g;
    return $ans;
}

function subtractNumbers($a, $b){
    $ans = $a - $b;
    if ($ans == 0) {
        $ans = '0';
    }
    return $ans;
}
function divideNumbers($a, $b){
    if ($a != 0 && $b != 0)
    {
        $ans = $a / $b;
    } else
    {
        $ans = '0';
    }
    return $ans;
}
function percentNumber($a){
    $ans = number_format(($a * 100), 2) . '%';
    return $ans;
}

$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(

    'Grupo de Cliente',
    'Cliente',
    'Nombre Cliente',
    'RUC',
    'Referencia',
    'Estado',
    'Resultado',
    'Comentarios',

    'Profit and Loss_7_Operating Revenue',
    'Profit and Loss_510_Sales costs',
    'Profit and Loss_520_Gross Profit',

    'Profit and Loss_530_Operating Expenses',
    'Profit and Loss_540_Administration',
    'Profit and Loss_550_Selling',
    'Profit and Loss_560_Operating profit (loss)',

    'Profit and Loss_570_Non-operating income',
    'Profit and Loss_580_Non-operating Expenses',
    'Profit and Loss_590_Profit before Tax',

    'Profit and Loss_600_Interest, depreciation, and amortization',
    'Profit and Loss_610_Income tax',
    'Profit and Loss_620_Net Profit',

    'Balance Sheet_10_Cash and cash equivalents',
    'Balance Sheet_25_Investments',
    'Balance Sheet_30_Trade Debtors',
    'Balance Sheet_40_Trade Debtors.provisions',
    'Balance Sheet_50_Other debtors',
    'Balance Sheet_60_Inventories',
    'Balance Sheet_70_Other current assets',
    'Balance Sheet_3_Total Current assets',

    'Balance Sheet_80_Investments',
    'Balance Sheet_90_Valuations',
    'Balance Sheet_100_Property, plant and equipment, net',
    'Balance Sheet_110_Other assets',
    'Balance Sheet_2_Total Non-Current Assets',
    'Balance Sheet_1_Total Assets',

    'Balance Sheet_200_Financial obligations',
    'Balance Sheet_210_Trade creditors',
    'Balance Sheet_220_Accounts payable and related parties',
    'Balance Sheet_230_Taxes payable',
    'Balance Sheet_240_Estimated liabilities and provisions',
    'Balance Sheet_250_Other short-term liabilities',
    'Balance Sheet_260_TOTAL SHORT TERM LIABILITIES',

    'Balance Sheet_270_Financial obligations',
    'Balance Sheet_280_Accounts payable and related parties',
    'Balance Sheet_290_Other long-term accounts payable and related parties',
    'Balance Sheet_300_Other long-term liabilities',
    'Balance Sheet_310_TOTAL LONG TERM LIABILITIES',
    'Balance Sheet_9_Total Liabilities',
    
    'Balance Sheet_320_Subscribed and paid-in capital',
    'Balance Sheet_330_Surplus  from capital',
    'Balance Sheet_340_Reserves',
    'Balance Sheet_350_Equity revaluation',
    'Balance Sheet_620_Net Profit',
    'Balance Sheet_370_Retained earning',
    'Balance Sheet_380_Surplus from revaluations',
    'Balance Sheet_21_Equity',
    'Balance Sheet_390_TOTAL EQUITY AND LIABILITIES',

    'IndicatorDate (Fecha de los EEFF)',
    'auditedFinancialfigures',
    'consolidatedFinancialStatements',
    'currency',
    'privacy',
    'financialSource',

    //Proceso 1
    'Profit and Loss_7_Operating Revenue 1',
    'Profit and Loss_510_Sales costs 1',
    'Profit and Loss_520_Gross Profit 1',

    'Profit and Loss_530_Operating Expenses 1',
    'Profit and Loss_540_Administration 1',
    'Profit and Loss_550_Selling 1',
    'Profit and Loss_560_Operating profit (loss) 1',

    'Profit and Loss_570_Non-operating income 1',
    'Profit and Loss_580_Non-operating Expenses 1',
    'Profit and Loss_590_Profit before Tax 1',

    'Profit and Loss_600_Interest, depreciation, and amortization 1',
    'Profit and Loss_610_Income tax 1',
    'Profit and Loss_620_Net Profit 1',

    'Balance Sheet_10_Cash and cash equivalents 1',
    'Balance Sheet_25_Investments 1',
    'Balance Sheet_30_Trade Debtors 1',
    'Balance Sheet_40_Trade Debtors.provisions 1',
    'Balance Sheet_50_Other debtors 1',
    'Balance Sheet_60_Inventories 1',
    'Balance Sheet_70_Other current assets 1',
    'Balance Sheet_3_Total Current assets 1',

    'Balance Sheet_80_Investments 1',
    'Balance Sheet_90_Valuations 1',
    'Balance Sheet_100_Property, plant and equipment, net 1',
    'Balance Sheet_110_Other assets 1',
    'Balance Sheet_2_Total Non-Current Assets 1',
    'Balance Sheet_1_Total Assets 1',

    'Balance Sheet_200_Financial obligations 1',
    'Balance Sheet_210_Trade creditors 1',
    'Balance Sheet_220_Accounts payable and related parties 1',
    'Balance Sheet_230_Taxes payable 1',
    'Balance Sheet_240_Estimated liabilities and provisions 1',
    'Balance Sheet_250_Other short-term liabilities 1',
    'Balance Sheet_260_TOTAL SHORT TERM LIABILITIES 1',

    'Balance Sheet_270_Financial obligations 1',
    'Balance Sheet_280_Accounts payable and related parties 1',
    'Balance Sheet_290_Other long-term accounts payable and related parties 1',
    'Balance Sheet_300_Other long-term liabilities 1',
    'Balance Sheet_310_TOTAL LONG TERM LIABILITIES 1',
    'Balance Sheet_9_Total Liabilities 1',
    
    'Balance Sheet_320_Subscribed and paid-in capital 1',
    'Balance Sheet_330_Surplus  from capital 1',
    'Balance Sheet_340_Reserves 1',
    'Balance Sheet_350_Equity revaluation 1',
    'Balance Sheet_620_Net Profit 1',
    'Balance Sheet_370_Retained earning 1',
    'Balance Sheet_380_Surplus from revaluations 1',
    'Balance Sheet_21_Equity 1',
    'Balance Sheet_390_TOTAL EQUITY AND LIABILITIES 1',

    'IndicatorDate (Fecha de los EEFF) 1',
    'auditedFinancialfigures 1',
    'consolidatedFinancialStatements 1',
    'currency 1',
    'privacy 1',
    'financialSource 1',
);

$row = array();
foreach ($headers as $header) {
    if (is_array($header)) {
        $row[] = DetailImport::model()->getAttributeLabel($header['header']);
    } else {
        $row[] = DetailImport::model()->getAttributeLabel($header);
    }
}
fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);

//WebUser::logAccess("Exporto " . count($models) . " estudios a un CSV.");
foreach ($sectionFinantialAnalys as $result ){


    $reportRow = array();

    $reportRow[] =$result['Grupo_Cliente'];
    $reportRow[] =$result['Cliente'];
    $reportRow[] =$result['lastName'];
    $reportRow[] =$result['idNumber'];
    $reportRow[] =$result['Codigo'];
    $reportRow[] =$result['Estado'];
    $reportRow[] =$result['resultado'];
    $reportRow[] =$result['comments'];

    $reportRow[] =$result['estadoIngresosOperacionales_0'];
    $reportRow[] =$result['estadoCostoDeVenta_0'];
    $utilidadBruta_0 = subtractNumbers($result['estadoIngresosOperacionales_0'], $result['estadoCostoDeVenta_0']);
    $reportRow[] =$utilidadBruta_0;

    $reportRow[] =$result['estadoDepreciacion_0'];
    $reportRow[] =$result['estadoGastosOperacionalesAdmon_0'];
    $reportRow[] =$result['estadoGastosOperacionalesVenta_0'];
    $utilidadOperacional_0 = $utilidadBruta_0-$result['estadoDepreciacion_0']-$result['estadoGastosOperacionalesAdmon_0']-$result['estadoGastosOperacionalesVenta_0'];
    $reportRow[] =$utilidadOperacional_0;

    $reportRow[] =$result['estadoIngresosNoOperacionales_0'];
    $reportRow[] =$result['estadoGastosNoOperacionales_0'];
    $utilidadesAntesdeImps_0 = $utilidadOperacional_0+$result['estadoIngresosNoOperacionales_0']-$result['estadoGastosNoOperacionales_0'];
    $reportRow[] =$utilidadesAntesdeImps_0;

    $reportRow[] =$result['estadoAmortizacion_0'];
    $reportRow[] =$result['impuestoDeRenta_0'];
    $utilidadNeta_0= $utilidadesAntesdeImps_0-$result['estadoAmortizacion_0']-$result['impuestoDeRenta_0'];
    $reportRow[] =$utilidadNeta_0;

    $reportRow[] =$result['activoDisponible_0'];
    $reportRow[] =$result['activoInversionesCP_0'];
    $reportRow[] =$result['activoClientes_0'];
    $reportRow[] =0;
    $reportRow[] =$result['activoAnticiposYAvances_0'];
    $reportRow[] =$result['activoInventarios_0'];
    $reportRow[] =$result['otrosActivosCorrientes_0'];
    //Activo Corriente 0
    $activoCorriente_0 = addNumbers($result['activoDisponible_0'], $result['activoClientes_0'], $result['activoAnticiposYAvances_0'], $result['activoInventarios_0'], $result['activoInversionesCP_0'], $result['otrosActivosCorrientes_0']);
    $reportRow[]=$activoCorriente_0;

    $reportRow[] =$result['activoInversionesLP_0'];
    $reportRow[] =$result['activoValorizaciones_0'];
    $reportRow[] =$result['activoPropiedadPlantaYEquipo_0'];
    $reportRow[] =$result['otrosNoActivosCorrientes_0'];
    $totalAcvtivoNoCorriente_0= $result['activoInversionesLP_0']+$result['activoValorizaciones_0']+$result['activoPropiedadPlantaYEquipo_0']+$result['otrosNoActivosCorrientes_0'];
    $activo_0= $totalAcvtivoNoCorriente_0+$activoCorriente_0;
    $reportRow[]=$totalAcvtivoNoCorriente_0;
    $reportRow[]=$activo_0;

    $reportRow[] =$result['pasivoObligacionesFinancierasCP_0'];
    $reportRow[] =$result['pasivoProveedores_0'];
    $reportRow[] =$result['pasivoCXP_0'];
    $reportRow[] =$result['pasivoImpuestosYTasas_0'];
    $reportRow[] =$result['pasivoObligacionesLaborales_0'];
    $reportRow[] =$result['otrosPasivosCorrientes_0'];
    $pasivoCorriente_0 = $result['pasivoObligacionesFinancierasCP_0'] + $result['pasivoProveedores_0'] + $result['pasivoCXP_0'] + $result['pasivoImpuestosYTasas_0'] + $result['pasivoObligacionesLaborales_0'] + $result['pasivoProvisiones_0'] + $result['depositosExigiblesCP_0'] + $result['otrosPasivosCorrientes_0'] + $result['fondosSocialesCP_0'];
    $reportRow[] =$pasivoCorriente_0;

    $reportRow[] =$result['pasivoObligacionesFinancierasLP_0'];
    $reportRow[] =$result['pasivoProveedoresLP_0'];
    $reportRow[] =$result['pasivoCXPLP_0'];
    $reportRow[] =$result['otrosPasivosNoCorrientes_0'];
    $pasivoNoCorriente_0 = addNumbers($result['pasivoObligacionesFinancierasLP_0'], $result['pasivoProveedoresLP_0'], $result['pasivoCXPLP_0'], $result['pasivoImpuestosYTasasLP_0'], $result['pasivoObligacionesLaboralesLP_0'], $result['pasivoProvisionesLP_0'], $result['depositosExigiblesLP_0']);
    $pasivoNoCorriente_0 = addNumbers($pasivoNoCorriente_0, $result['fondosSociales_0'], $result['otrosPasivosNoCorrientes_0']);
    $reportRow[] =$pasivoNoCorriente_0;
    $pasivo_0 = addNumbers($pasivoCorriente_0, $pasivoNoCorriente_0);
    $reportRow[] =$pasivo_0;

    $reportRow[] =$result['patrimonioCapitalSocial_0'];
    $reportRow[] =$result['patrimonioFondoDestinacionEspecifica_0'];
    $reportRow[] =$result['patrimonioReservaSocial_0'];
    $reportRow[] =$result['patrimonioSuperavitPorValorizaciones_0'];
    $reportRow[] =$result['patrimonioResultadoEjercicio_0'];
    $reportRow[] =$result['patrimonioResultadoEjerciciosAnteriores_0'];
    $reportRow[] =0;

    $patrimonio_0 = addNumbers($result['patrimonioCapitalSocial_0'], $result['patrimonioReservaSocial_0'], $result['patrimonioResultadoEjercicio_0'], $result['patrimonioResultadoEjerciciosAnteriores_0'], $result['patrimonioSuperavitPorValorizaciones_0'], $result['patrimonioFondoDestinacionEspecifica_0']);
    $reportRow[] =$patrimonio_0;
    $patrimonioPasivoYPatrimonio_0 = addNumbers($pasivo_0, $patrimonio_0);
    $reportRow[] =$patrimonioPasivoYPatrimonio_0;

    $reportRow[] =$result['dateLastBalanceSheet'];
    $reportRow[] =$result['auditedFinancialfigures'];
    $reportRow[] =$result['consolidatedFinancialStatements'];
    $reportRow[] =$result['currency'];
    $reportRow[] =$result['privacy'];
    $reportRow[] =$result['financialSource'];

    //Proceo 1
    $reportRow[] =$result['estadoIngresosOperacionales_1'];
    $reportRow[] =$result['estadoCostoDeVenta_1'];
    $utilidadBruta_1 = subtractNumbers($result['estadoIngresosOperacionales_1'], $result['estadoCostoDeVenta_1']);
    $reportRow[] =$utilidadBruta_1;

    $reportRow[] =$result['estadoDepreciacion_1'];
    $reportRow[] =$result['estadoGastosOperacionalesAdmon_1'];
    $reportRow[] =$result['estadoGastosOperacionalesVenta_1'];
    $utilidadOperacional_1 = $utilidadBruta_1-$result['estadoDepreciacion_1']-$result['estadoGastosOperacionalesAdmon_1']-$result['estadoGastosOperacionalesVenta_1'];
    $reportRow[] =$utilidadOperacional_1;

    $reportRow[] =$result['estadoIngresosNoOperacionales_1'];
    $reportRow[] =$result['estadoGastosNoOperacionales_1'];
    $utilidadesAntesdeImps_1 = $utilidadOperacional_1+$result['estadoIngresosNoOperacionales_1']-$result['estadoGastosNoOperacionales_1'];
    $reportRow[] =$utilidadesAntesdeImps_1;

    $reportRow[] =$result['estadoAmortizacion_1'];
    $reportRow[] =$result['impuestoDeRenta_1'];
    $utilidadNeta_1= $utilidadesAntesdeImps_1-$result['estadoAmortizacion_1']-$result['impuestoDeRenta_1'];
    $reportRow[] =$utilidadNeta_1;

    $reportRow[] =$result['activoDisponible_1'];
    $reportRow[] =$result['activoInversionesCP_1'];
    $reportRow[] =$result['activoClientes_1'];
    $reportRow[] =0;
    $reportRow[] =$result['activoAnticiposYAvances_1'];
    $reportRow[] =$result['activoInventarios_1'];
    $reportRow[] =$result['otrosActivosCorrientes_1'];
    //Activo Corriente 1
    $activoCorriente_1 = addNumbers($result['activoDisponible_1'], $result['activoClientes_1'], $result['activoAnticiposYAvances_1'], $result['activoInventarios_1'], $result['activoInversionesCP_1'], $result['otrosActivosCorrientes_1']);
    $reportRow[]=$activoCorriente_1;

    $reportRow[] =$result['activoInversionesLP_1'];
    $reportRow[] =$result['activoValorizaciones_1'];
    $reportRow[] =$result['activoPropiedadPlantaYEquipo_1'];
    $reportRow[] =$result['otrosNoActivosCorrientes_1'];
    $totalAcvtivoNoCorriente_1= $result['activoInversionesLP_1']+$result['activoValorizaciones_1']+$result['activoPropiedadPlantaYEquipo_1']+$result['otrosNoActivosCorrientes_1'];
    $activo_1= $totalAcvtivoNoCorriente_1+$activoCorriente_1;
    $reportRow[]=$totalAcvtivoNoCorriente_1;
    $reportRow[]=$activo_1;

    $reportRow[] =$result['pasivoObligacionesFinancierasCP_1'];
    $reportRow[] =$result['pasivoProveedores_1'];
    $reportRow[] =$result['pasivoCXP_1'];
    $reportRow[] =$result['pasivoImpuestosYTasas_1'];
    $reportRow[] =$result['pasivoObligacionesLaborales_1'];
    $reportRow[] =$result['otrosPasivosCorrientes_1'];
    $pasivoCorriente_1 = $result['pasivoObligacionesFinancierasCP_1'] + $result['pasivoProveedores_1'] + $result['pasivoCXP_1'] + $result['pasivoImpuestosYTasas_1'] + $result['pasivoObligacionesLaborales_1'] + $result['pasivoProvisiones_1'] + $result['depositosExigiblesCP_1'] + $result['otrosPasivosCorrientes_1'] + $result['fondosSocialesCP_1'];
    $reportRow[] =$pasivoCorriente_1;

    $reportRow[] =$result['pasivoObligacionesFinancierasLP_1'];
    $reportRow[] =$result['pasivoProveedoresLP_1'];
    $reportRow[] =$result['pasivoCXPLP_1'];
    $reportRow[] =$result['otrosPasivosNoCorrientes_1'];
    $pasivoNoCorriente_1 = addNumbers($result['pasivoObligacionesFinancierasLP_1'], $result['pasivoProveedoresLP_1'], $result['pasivoCXPLP_1'], $result['pasivoImpuestosYTasasLP_1'], $result['pasivoObligacionesLaboralesLP_1'], $result['pasivoProvisionesLP_1'], $result['depositosExigiblesLP_1']);
    $pasivoNoCorriente_1 = addNumbers($pasivoNoCorriente_1, $result['fondosSociales_1'], $result['otrosPasivosNoCorrientes_1']);
    $reportRow[] =$pasivoNoCorriente_1;
    $pasivo_1 = addNumbers($pasivoCorriente_1, $pasivoNoCorriente_1);
    $reportRow[] =$pasivo_1;

    $reportRow[] =$result['patrimonioCapitalSocial_1'];
    $reportRow[] =$result['patrimonioFondoDestinacionEspecifica_1'];
    $reportRow[] =$result['patrimonioReservaSocial_1'];
    $reportRow[] =$result['patrimonioSuperavitPorValorizaciones_1'];
    $reportRow[] =$result['patrimonioResultadoEjercicio_1'];
    $reportRow[] =$result['patrimonioResultadoEjerciciosAnteriores_1'];
    $reportRow[] =0;

    $patrimonio_1 = addNumbers($result['patrimonioCapitalSocial_1'], $result['patrimonioReservaSocial_1'], $result['patrimonioResultadoEjercicio_1'], $result['patrimonioResultadoEjerciciosAnteriores_1'], $result['patrimonioSuperavitPorValorizaciones_1'], $result['patrimonioFondoDestinacionEspecifica_1']);
    $reportRow[] =$patrimonio_1;
    $patrimonioPasivoYPatrimonio_1 = addNumbers($pasivo_1, $patrimonio_1);
    $reportRow[] =$patrimonioPasivoYPatrimonio_1;

    $reportRow[] =$result['dateLastBalanceSheet_1'];
    $reportRow[] =$result['auditedFinancialfigures_1'];
    $reportRow[] =$result['consolidatedFinancialStatements_1'];
    $reportRow[] =$result['currency_1'];
    $reportRow[] =$result['privacy_1'];
    $reportRow[] =$result['financialSource_1'];

    //$reportRow[] =$result['dateLastBalanceSheet_1'];

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Sec_Analisis_financiero_Coface" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
