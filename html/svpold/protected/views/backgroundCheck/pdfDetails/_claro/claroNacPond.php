<?php
    $Max_1_1 = 1.25;
    if($backgroundCheck->yearsOfActivity < 2 ){
        $Obt_1_1 = 0.31;
    } else if($backgroundCheck->yearsOfActivity >= 2 && $backgroundCheck->yearsOfActivity < 6){
        $Obt_1_1 = 0.62;
    } else if($backgroundCheck->yearsOfActivity >= 6 && $backgroundCheck->yearsOfActivity < 8){
        $Obt_1_1 = 0.93;
    } else if($backgroundCheck->yearsOfActivity >= 8){
        $Obt_1_1 = 1.25;
    }

    $smmlv  = 828116;
    $Max_1_2 = 1.25;
    if($backgroundCheck->companySizeByActives * $smmlv < 414058000 ){
        $Obt_1_2 = 0.31;
    } else if($backgroundCheck->companySizeByActives * $smmlv >= 414058000 && $backgroundCheck->companySizeByActives * $smmlv < 4140580000){
        $Obt_1_2 = 0.62;
    } else if($backgroundCheck->companySizeByActives * $smmlv >= 4140580000 && $backgroundCheck->companySizeByActives * $smmlv < 24843480000){
        $Obt_1_2 = 0.93;
    } else if($backgroundCheck->companySizeByActives * $smmlv >= 24843480000){
        $Obt_1_2 = 1.25;
    }
    
    $Max_1_3 = 1.25;
    /*if($backgroundCheck->companySizeByActives < 414058000 ){
        $Obt_1_3 = 0.3;
    } else if($backgroundCheck->companySizeByActives >= 414058000 && $backgroundCheck->companySizeByActives < 4140580000){
        $Obt_1_3 = 0.6;
    } else if($backgroundCheck->companySizeByActives >= 4140580000 && $backgroundCheck->companySizeByActives < 24843480000){
        $Obt_1_3 = 0.9;
    } else if($backgroundCheck->companySizeByActives >= 24843480000){
        $Obt_1_3 = 1.3;
    }*/
    if( $XMLQuestionResult['adicionalClaro_5'] == "NACIONAL" ){
        $Obt_1_3 = 1.12 ;
    } else if( $XMLQuestionResult['adicionalClaro_5'] == "INTERNACIONAL" ) {
        $Obt_1_3 = 1.25;
    }  else{
        $Obt_1_3 = 1 ;
    }


    $Max_1_4 = 1.25;
    if($backgroundCheck->yearsOfActivity <= 2 ){
        $Obt_1_4 = 0.25;
    } else if($backgroundCheck->yearsOfActivity > 2 && $backgroundCheck->yearsOfActivity < 6){
        $Obt_1_4 = 0.75;
    } else if($backgroundCheck->yearsOfActivity >= 6 && $backgroundCheck->yearsOfActivity < 8){
        $Obt_1_4 = 1;
    } else if($backgroundCheck->yearsOfActivity >= 8 && $backgroundCheck->yearsOfActivity < 11){
        $Obt_1_4 = 1.125;
    }else if($backgroundCheck->yearsOfActivity > 10){
        $Obt_1_4 = 1.25;
    }

    $val_1 = 5;
    $weight_1 = 5;
    $points_1 =  0;
    // $points_1 = $Obt_1_1 + $Obt_1_2 + $Obt_1_3 +$Obt_1_4;
    for ($i = 1; $i <= 4; $i++) {
        if(!isset(${"Obt_1_".$i})){
            ${"Obt_1_".$i} = 0;
        }
        $points_1 = $points_1 + ${"Obt_1_".$i};
    }

    
    $Max_2_1 = 2;
    if($XMLQuestionResult['certification_1'] == "SI" || $XMLQuestionResult['certification_1'] == "N/A" ){
        $Obt_2_1 = 2;
    } else if($XMLQuestionResult['certification_1'] == "EN PROCESO" ){
        $Obt_2_1 = 1;
    } else if($XMLQuestionResult['certification_1'] == "NO" ){
        $Obt_2_1 = 0;
    } else {
        $Obt_2_1 = 0;
    }

    $Max_2_2 = 1.5;
    if($XMLQuestionResult['certification_2'] == "SI" || $XMLQuestionResult['certification_2'] == "N/A" ){
        $Obt_2_2 = 1.5;
    } else if($XMLQuestionResult['certification_2'] == "EN PROCESO" ){
        $Obt_2_2 = .8;
    } else if($XMLQuestionResult['certification_2'] == "NO" ){
        $Obt_2_2 = 0;
    } else {
        $Obt_2_2 = 0;
    }
    $Max_2_3 = 1.5;
    if($XMLQuestionResult['certification_3'] == "SI" || $XMLQuestionResult['certification_3'] == "N/A" ){
        $Obt_2_3 = 1.5;
    } else if($XMLQuestionResult['certification_3'] == "EN PROCESO" ){
        $Obt_2_3 = .8;
    } else if($XMLQuestionResult['certification_3'] == "NO" ){
        $Obt_2_3 = 0;
    } else{
        $Obt_2_3 = 0;
    }
    
    $Max_2_4 = 1.5;
    if($XMLQuestionResult['certification_4'] == "SI" || $XMLQuestionResult['certification_4'] == "N/A" ){
        $Obt_2_4 = 1.5;
    } else if($XMLQuestionResult['certification_4'] == "EN PROCESO" ){
        $Obt_2_4 = .8;
    } else if($XMLQuestionResult['certification_4'] == "NO" ){
        $Obt_2_4 = 0;
    } else{
        $Obt_2_4 = 0;
    }
    
    $Max_2_5 = 1;
    if($XMLQuestionResult['certification_5'] == "SI" || $XMLQuestionResult['certification_5'] == "N/A" ){
        $Obt_2_5 = 1;
    } else if($XMLQuestionResult['certification_5'] == "EN PROCESO" ){
        $Obt_2_5 = .5;
    } else if($XMLQuestionResult['certification_5'] == "NO" ){
        $Obt_2_5 = 0;
    } else {
        $Obt_2_5 = 0;
    }

    $Max_2_6 = 1;
    if($XMLQuestionResult['certification_6'] == "SI" || $XMLQuestionResult['certification_6'] == "N/A" ){
        $Obt_2_6 = 1;
    } else if($XMLQuestionResult['certification_6'] == "EN PROCESO" ){
        $Obt_2_6 = .5;
    } else if($XMLQuestionResult['certification_6'] == "NO" ){
        $Obt_2_6 = 0;
    } else {
        $Obt_2_6 = 0;
    }
    $Max_2_7 = 1;
    if($XMLQuestionResult['certification_7'] == "SI" || $XMLQuestionResult['certification_7'] == "N/A" ){
        $Obt_2_7 = 1;
    } else if($XMLQuestionResult['certification_7'] == "EN PROCESO" ){
        $Obt_2_7 = .5;
    } else if($XMLQuestionResult['certification_7'] == "NO" ){
        $Obt_2_7 = 0;
    } else {
        $Obt_2_7 = 0;
    }
    $Max_2_8 = .5;
    if($XMLQuestionResult['certification_8'] == "SI" || $XMLQuestionResult['certification_8'] == "N/A" ){
        $Obt_2_8 = .5;
    } else if($XMLQuestionResult['certification_8'] == "EN PROCESO" ){
        $Obt_2_8 = .3;
    } else if($XMLQuestionResult['certification_8'] == "NO" ){
        $Obt_2_8 = 0;
    }
    $val_2 = 10;
    $weight_2 = 10;
    $points_2 = 0;
    for ($i = 1; $i <= 8; $i++) {
        if(!isset(${"Obt_2_".$i})){
            ${"Obt_2_".$i} = 0;
        }
        $points_2 = $points_2 + ${"Obt_2_".$i};
    }

    
    
    $Max_3_1 = .625;
    if($XMLQuestionResult['gcBasesDatos'] == "SI" || $XMLQuestionResult['gcBasesDatos'] == "N/A" ){
        $Obt_3_1 = .625;
    } else if($XMLQuestionResult['gcBasesDatos'] == "NO" ){
        $Obt_3_1 = 0;
    }
    
    $Max_3_2 = .75;
    if($XMLQuestionResult['gcEvaluacionPeriodica'] == "SI" || $XMLQuestionResult['gcEvaluacionPeriodica'] == "N/A" ){
        $Obt_3_2 = .75;
    } else if($XMLQuestionResult['gcEvaluacionPeriodica'] == "NO" ){
        $Obt_3_2 = 0;
    }
    
    $Max_3_3 = .625;
    if($XMLQuestionResult['gcEjecutivoCuenta'] == "SI" || $XMLQuestionResult['gcEjecutivoCuenta'] == "N/A" ){
        $Obt_3_3 = .625;
    } else if($XMLQuestionResult['gcEjecutivoCuenta'] == "NO" ){
        $Obt_3_3 = 0;
    }
    
    $Max_3_4 = .6;
    if($XMLQuestionResult['gcSedeAtencionCliente'] == "SI" || $XMLQuestionResult['gcSedeAtencionCliente'] == "N/A" ){
        $Obt_3_4 = .6;
    } else if($XMLQuestionResult['gcSedeAtencionCliente'] == "NO" ){
        $Obt_3_4 = 0;
    }
    
    $Max_3_5 = .6;
    if($XMLQuestionResult['gcPostVenta'] == "SI" || $XMLQuestionResult['gcPostVenta'] == "N/A" ){
        $Obt_3_5 = .6;
    } else if($XMLQuestionResult['gcPostVenta'] == "NO" ){
        $Obt_3_5 = 0;
    }
    
    $Max_3_6 = .6;
    if($XMLQuestionResult['gcGarantias'] == "SI" || $XMLQuestionResult['gcGarantias'] == "N/A" ){
        $Obt_3_6 = .6;
    } else if($XMLQuestionResult['gcGarantias'] == "NO" ){
        $Obt_3_6 = 0;
    }
    
    $Max_3_7 = .6;
    if($XMLQuestionResult['gcServicioTecnico'] == "SI" || $XMLQuestionResult['gcServicioTecnico'] == "N/A" ){
        $Obt_3_7 = .6;
    } else if($XMLQuestionResult['gcServicioTecnico'] == "NO" ){
        $Obt_3_7 = 0;
    }
    
    $Max_3_8 = .6;
    if($XMLQuestionResult['gcPolizaSeguro'] == "SI" || $XMLQuestionResult['gcPolizaSeguro'] == "N/A" ){
        $Obt_3_8 = .6;
    } else if($XMLQuestionResult['gcPolizaSeguro'] == "NO" ){
        $Obt_3_8 = 0;
    }

    $val_3 = 5;
    $weight_3 = 5;
    $points_3 = 0;
    for ($i = 1; $i <= 8; $i++) {
        if(!isset(${"Obt_3_".$i})){
            ${"Obt_3_".$i} = 0;
        }
        $points_3 = $points_3 + ${"Obt_3_".$i};
    }


    $Max_4_1 = 1.2;
        if($deliveryCompliance == 0 ){
            $Obt_4_1 = 1.2 ;
        } else if($deliveryCompliance == 1 ){
            $Obt_4_1 = 0 ;
        } else if($deliveryCompliance == 2 ){
            $Obt_4_1 = 0.72 ;
        } else if($deliveryCompliance == 3 ){
            $Obt_4_1 = 0.96 ;
        } else if($deliveryCompliance >= 4 ){
            $Obt_4_1 = 1.2 ;
        }

        $Max_4_2 = 1.2;
        if($productsQuality == 0 ){
            $Obt_4_2 = 1.2 ;
        } else if($productsQuality == 1 ){
            $Obt_4_2 = 0 ;
    } else if($productsQuality == 2 ){
        $Obt_4_2 = 0.72 ;
    } else if($productsQuality == 3 ){
        $Obt_4_2 = 0.96 ;
    } else if($productsQuality >= 4 ){
        $Obt_4_2 = 1.2 ;
    }

    $Max_4_3 = 1.3;
    if($postSalesService == 0 ){
        $Obt_4_3 = 1.3 ;
    } else if($postSalesService == 1 ){
        $Obt_4_3 = 0 ;
    } else if($postSalesService == 2 ){
        $Obt_4_3 = 0.78 ;
    } else if($postSalesService == 3 ){
        $Obt_4_3 = 1.04 ;
    } else if($postSalesService >= 4 ){
        $Obt_4_3 = 1.3 ;
    }

    $Max_4_4 = 1.3;
    if($prices == 0 ){
        $Obt_4_4 = 1.3 ;
    } else if($prices == 1 ){
        $Obt_4_4 = 0 ;
    } else if($prices == 2 ){
        $Obt_4_4 = 0.78 ;
    } else if($prices == 3 ){
        $Obt_4_4 = 1.04 ;
    } else if($prices >= 4 ){
        $Obt_4_4 = 1.3 ;
    }
        
    $val_4 = 5;
    $weight_4 = 5;
    $points_4 = $Obt_4_1 + $Obt_4_2 + $Obt_4_3 + $Obt_4_4;
    
    
    $Max_5_1 = 1.7;
    if($XMLQuestionResult['infraestructuraFisica'] == "EXCELENTE" || $XMLQuestionResult['infraestructuraFisica'] == "N/A"){
        $Obt_5_1 = 1.7 ;
    } else if($XMLQuestionResult['infraestructuraFisica'] == "BUENO"){
        $Obt_5_1 = 1.36 ;
    } else if($XMLQuestionResult['infraestructuraFisica'] == "REGULAR"){
        $Obt_5_1 = 1.02 ;
    } else {
        $Obt_5_1 = 0 ;
    }
    
    $Max_5_2 = 1.7; 
    if($XMLQuestionResult['infraestructuraInformatica'] == "EXCELENTE" || $XMLQuestionResult['infraestructuraInformatica'] == "N/A"){
        $Obt_5_2 = 1.7 ;
    } else if($XMLQuestionResult['infraestructuraInformatica'] == "BUENO"){
        $Obt_5_2 = 1.36 ;
    } else if($XMLQuestionResult['infraestructuraInformatica'] == "REGULAR"){
        $Obt_5_2 = 1.02 ;
    } else {
        $Obt_5_2 = 0 ;
    }
    
    $Max_5_3 = 1.6;
    if($XMLQuestionResult['infraestructuraEquipos'] == "EXCELENTE" || $XMLQuestionResult['infraestructuraEquipos'] == "N/A"){
        $Obt_5_3 = 1.6 ;
    } else if($XMLQuestionResult['infraestructuraEquipos'] == "BUENO"){
        $Obt_5_3 = 1.28 ;
    } else if($XMLQuestionResult['infraestructuraEquipos'] == "REGULAR"){
        $Obt_5_3 = 0.96 ;
    } else {
        $Obt_5_3 = 0 ;
    }
    $val_5 = 5;
    $weight_5 = 5;
    $points_5 = $Obt_5_1 + $Obt_5_2 + $Obt_5_3;



    $Max_6_1 = 3;
    if( $capitalDeTrabajo_0 > 0 ){
        $Obt_6_1 = 3 ;
    } else {
        $Obt_6_1 = 0 ;
    }

    $Max_6_2 = 4.5;
    if( $razonCorriente_0 >= 1 ){
        $Obt_6_2 = 4.5 ;
    } else if ( $razonCorriente_0 >= 0.81 && $razonCorriente_0 < 1) {
        $Obt_6_2 = 1.1 ;
    } else {
        $Obt_6_2 = 0 ;
    }

    $Max_6_3 = 4.5;
    if( $nivelDeEndeudamiento_0 <= .6 ){
        $Obt_6_3 = 4.5 ;
    } else if ( $nivelDeEndeudamiento_0 >= 0.61 && $nivelDeEndeudamiento_0 < .8) {
        $Obt_6_3 = 3.2 ;
    } else {
        $Obt_6_3 = 0 ;
    }

    $Max_6_4 = 3;
    if( $apalancamientoCortoPlazo_0 <= 80 ){
        $Obt_6_4 = 3 ;
    } else {
        $Obt_6_4 = 0 ;
    }
    
    $Max_6_5 = 1.5;
    if( $endeudamientoVentas_0 <= .4 ){
        $Obt_6_5 = 1.5 ;
    } else if ( $endeudamientoVentas_0 >= 0.41 && $endeudamientoVentas_0 <= .7) {
        $Obt_6_5 = 1.1 ;
    } else {
        $Obt_6_5 = 0 ;
    }
    
    $Max_6_6 = 1.5;
    if( $endeudamientoFinanciero_0 <= .8 ){
        $Obt_6_6 = 1.5 ;
    } else {
        $Obt_6_6 = 0 ;
    }

    $Max_6_7 = 1.5;
    if( $margenEBITDA_0 >= .16 ){
        $Obt_6_7 = 1.5 ;
    } else if ( $margenEBITDA_0 >= 0.08 && $margenEBITDA_0 < .16) {
        $Obt_6_7 = 1.1 ;
    } else {
        $Obt_6_7 = 0 ;
    }

    $Max_6_8 = 3;
    if( $rentabilidadPatrimonioROA_0 > .4 ){
        $Obt_6_8 = 3 ;
    } else if ( $rentabilidadPatrimonioROA_0 >= .1 && $rentabilidadPatrimonioROA_0 <= .4) {
        $Obt_6_8 = 2.1 ;
    } else {
        $Obt_6_8 = 0 ;
    }
    
    $Max_6_9 = 1.5;
    if( $coberturadeGastosNoOperacionales_0 >= 2.5 ){
        $Obt_6_9 = 1.5 ;
    } else {
        $Obt_6_9 = 0 ;
    }

    $Max_6_10 = 3;
    if( $utilidadesAcumuladas > 0 ){
        $Obt_6_10 = 3 ;
    } else {
        $Obt_6_10 = 0 ;
    }
    
    $Max_6_11 = 3;
    if( $varingresosOperacionales > 0 && $utilidadNeta_0 > 0 ){
        $Obt_6_11 = 3 ;
    } else if( $varingresosOperacionales < 0 && $utilidadNeta_0 > 0 ){
        $Obt_6_11 = 1.5 ;
    } else if( $varingresosOperacionales > 0 && $utilidadNeta_0 < 0 ){
        $Obt_6_11 = 1.5 ;
    } else if( $varingresosOperacionales < 0 && $utilidadNeta_0 < 0 ){
        $Obt_6_11 = 0 ;
    } else {
        $Obt_6_11 = 0 ;
    }
    
    $Max_6_12 = 0;
    if( $XMLQuestionResult['adicionalClaro_1'] == "NO" ){
        $Obt_6_12 = 0 ;
    } else if( $XMLQuestionResult['adicionalClaro_1'] == "VOLUNTARIA" ) {
        $Obt_6_12 = -5 ;
    } else if( $XMLQuestionResult['adicionalClaro_1'] == "OBLIGATORIA" ) {
        $Obt_6_12 = -10 ;
    } else{
        $Obt_6_12 = "" ;
    }

    $Max_6_13 = 0;
    if ($penultimo !=null){

        if($utilidadNeta_0 < 0){
            if( $varCapitalTrabajo > 0.5 ){
                $Obt_6_13 = -100 ;
            } else {
                $Obt_6_13 = 0 ;
            }
        }else {
            $Obt_6_13 = 0 ;
        }
}else {
        $Obt_6_13 = 0 ;
    }
/*
    if($utilidadNeta_0 < 0){
        if( $varCapitalTrabajo > 0.5 ){
            $Obt_6_13 = -100 ;
        } else {
            $Obt_6_13 = 0 ;
        }
    }else {
        $Obt_6_13 = 0 ;
    }*/
    $Max_6_14 = 0;
    if( $XMLQuestionResult['adicionalClaro_2'] == "NO" ){
        $Obt_6_14 = 0 ;
    } else if( $XMLQuestionResult['adicionalClaro_2'] == "FALTA +1 AÑO" ) {
        $Obt_6_14 = -5 ;
    } else if( $XMLQuestionResult['adicionalClaro_2'] == "FALTA +2 AÑOS" ) {
        $Obt_6_14 = -10 ;
    } else if( $XMLQuestionResult['adicionalClaro_2'] == "FALTA +3 AÑOS" ) {
        $Obt_6_14 = -20 ;
    } else{
        $Obt_6_14 = "" ;
    }

    $weight_6 = 30;
    $val_6 = 30;
    $points_6 = 0;
    if ($Obt_6_13 == -100){
        $points_6 = 0;
    } else{

    for ($i = 1; $i <= 14; $i++) {
        $points_6 = $points_6 + ${"Obt_6_".$i};
    }
        }
  
    // echo $XMLQuestionResult['rrhh_1'] . "<br>";
    // echo $XMLQuestionResult['rrhh_2']; die;
    
    $Max_7_1 = .3;
    if( $XMLQuestionResult['rrhh_1'] == "SI" || $XMLQuestionResult['rrhh_1'] == "N/A" ){
        $Obt_7_1 = .3 ;
    } else {
        $Obt_7_1 = 0 ;
    }
    
    $Max_7_2 = .38;
    if( $XMLQuestionResult['rrhh_2'] == "SI" || $XMLQuestionResult['rrhh_2'] == "N/A" ){
        $Obt_7_2 = .38 ;
    } else {
        $Obt_7_2 = 0 ;
    }
    
    $Max_7_3 = .4;
    if( $XMLQuestionResult['rrhh_3'] == "SI" || $XMLQuestionResult['rrhh_3'] == "N/A" ){
        $Obt_7_3 = .4 ;
    } else {
        $Obt_7_3 = 0 ;
    }
    
    $Max_7_4 = .4;
    if( $XMLQuestionResult['rrhh_4'] == "SI" || $XMLQuestionResult['rrhh_4'] == "N/A" ){
        $Obt_7_4 = .4 ;
    } else {
        $Obt_7_4 = 0 ;
    }
    
    $Max_7_5 = 2;
    if( $XMLQuestionResult['rrhh_5'] == "SI" || $XMLQuestionResult['rrhh_5'] == "N/A" ){
        $Obt_7_5 = 2 ;
    } else {
        $Obt_7_5 = 0 ;
    }
    
    $Max_7_6 = .4;
    if( $XMLQuestionResult['rrhh_6'] == "SI" || $XMLQuestionResult['rrhh_6'] == "N/A" ){
        $Obt_7_6 = .4 ;
    } else {
        $Obt_7_6 = 0 ;
    }
    
    $Max_7_7 = 2;
    if( $XMLQuestionResult['rrhh_7'] == "DIRECTO"){
        $Obt_7_7 = 2 ;
    } else if( $XMLQuestionResult['rrhh_7'] == "TEMPORAL"){
        $Obt_7_7 = 1.6 ;
    } else if( $XMLQuestionResult['rrhh_7'] == "MIXTA"){
        $Obt_7_7 = 1.4 ;
    } else if( $XMLQuestionResult['rrhh_7'] == "PRESTACIÓN DE SERVICIOS"){
        $Obt_7_7 = 0.4 ;
    } else {
        $Obt_7_7 = 0 ;
    }

    $Max_7_8 = 2;
    if( $XMLQuestionResult['rrhh_8'] == "SI" || $XMLQuestionResult['rrhh_8'] == "N/A" ){
        $Obt_7_8 = 2 ;
    } else {
        $Obt_7_8 = 0 ;
    }

    $Max_7_9 = .4;
    if( $XMLQuestionResult['rrhh_9'] == "SI" || $XMLQuestionResult['rrhh_9'] == "N/A" ){
        $Obt_7_9 = .4 ;
    } else {
        $Obt_7_9 = 0 ;
    }

    $Max_7_10 = 2;
    if( $XMLQuestionResult['rrhh_10'] == "SI" || $XMLQuestionResult['rrhh_10'] == "N/A" ){
        $Obt_7_10 = 2 ;
    } else {
        $Obt_7_10 = 0 ;
    }
    
    $Max_7_11 = .4;
    if( $XMLQuestionResult['rrhh_11'] == "SI" || $XMLQuestionResult['rrhh_11'] == "N/A" ){
        $Obt_7_11 = .4 ;
    } else {
        $Obt_7_11 = 0 ;
    }
    
    $Max_7_12 = 1;
    if( $XMLQuestionResult['rrhh_12'] == "SI" || $XMLQuestionResult['rrhh_12'] == "N/A" ){
        $Obt_7_12 = 0 ;
    } else {
        $Obt_7_12 = 1 ;
    }
    
    $Max_7_13 = .3;
    if( $XMLQuestionResult['rrhh_13'] == "SI" || $XMLQuestionResult['rrhh_13'] == "N/A" ){
        $Obt_7_13 = .3;
    } else {
        $Obt_7_13 = 0 ;
    }
    
    $Max_7_14 = 1;
    if( $XMLQuestionResult['rrhh_14'] == "SI" || $XMLQuestionResult['rrhh_14'] == "N/A" ){
        $Obt_7_14 = 1;
    } else {
        $Obt_7_14 = 0 ;
    }
    
    $Max_7_15 = .4;
    if( $XMLQuestionResult['rrhh_15'] == "SI" || $XMLQuestionResult['rrhh_15'] == "N/A" ){
        $Obt_7_15 = .4;
    } else {
        $Obt_7_15 = 0 ;
    }
    
    $Max_7_16 = 2;
    if( $XMLQuestionResult['rrhh_16'] == "SI" || $XMLQuestionResult['rrhh_16'] == "N/A" ){
        $Obt_7_16 = 2;
    } else {
        $Obt_7_16 = 0 ;
    }
    
    $Max_7_17 = .4;
    if( $XMLQuestionResult['rrhh_17'] == "SI" || $XMLQuestionResult['rrhh_17'] == "N/A" ){
        $Obt_7_17 = .4;
    } else {
        $Obt_7_17 = 0 ;
    }
    
    $Max_7_18 = .4;
    if( $XMLQuestionResult['rrhh_18'] == "SI" || $XMLQuestionResult['rrhh_18'] == "N/A" ){
        $Obt_7_18 = .4;
    } else {
        $Obt_7_18 = 0 ;
    }
    
    $Max_7_19 = .4;
    if( $XMLQuestionResult['rrhh_19'] == "SI" || $XMLQuestionResult['rrhh_19'] == "N/A" ){
        $Obt_7_19 = .4;
    } else {
        $Obt_7_19 = 0 ;
    }
    
    $Max_7_20 = 3;
    if( $XMLQuestionResult['rrhh_20'] == "NO" || $XMLQuestionResult['rrhh_20'] == "N/A" ){
        $Obt_7_20 = 3;
    } else {
        $Obt_7_20 = 0 ;
    }
    
    $Max_7_21 = .4;
    if( $XMLQuestionResult['rrhh_21'] == "NO" || $XMLQuestionResult['rrhh_21'] == "N/A" ){
        $Obt_7_21 = 0;
    } else {
        $Obt_7_21 = .4 ;
    }

    $weight_7 = 20;
    $val_7 = 20;
    $points_7 = 0;
    for ($i = 1; $i <= 21; $i++) {
        $points_7 = $points_7 + ${"Obt_7_".$i};
    }



    $Max_8_1 = 2;
    if( $XMLQuestionResult['sgssst_1'] == "SI" || $XMLQuestionResult['sgssst_1'] == "N/A" ){
        $Obt_8_1 = 2;
    } else {
        $Obt_8_1 = 0 ;
    }
    
    $Max_8_2 = 1;
    if( $XMLQuestionResult['sgssst_2'] == "SI" || $XMLQuestionResult['sgssst_2'] == "N/A" ){
        $Obt_8_2 = 1;
    } else {
        $Obt_8_2 = 0 ;
    }
    
    $Max_8_3 = 1;
    if( $XMLQuestionResult['sgssst_3'] == "SI" || $XMLQuestionResult['sgssst_3'] == "N/A" ){
        $Obt_8_3 = 1;
    } else {
        $Obt_8_3 = 0 ;
    }
    
    $Max_8_3 = 1;
    if( $XMLQuestionResult['sgssst_3'] == "SI" || $XMLQuestionResult['sgssst_3'] == "N/A" ){
        $Obt_8_3 = 1;
    } else {
        $Obt_8_3 = 0 ;
    }
    
    $Max_8_4 = 1;
    if( $XMLQuestionResult['sgssst_4'] == "SI" || $XMLQuestionResult['sgssst_4'] == "N/A" ){
        $Obt_8_4 = 1;
    } else {
        $Obt_8_4 = 0 ;
    }
    
    $Max_8_5 = 1;
    if( $XMLQuestionResult['sgssst_5'] == "SI" || $XMLQuestionResult['sgssst_5'] == "N/A" ){
        $Obt_8_5 = 1;
    } else {
        $Obt_8_5 = 0 ;
    }
    
    $Max_8_6 = 1;
    if( $XMLQuestionResult['sgssst_6'] == "SI" || $XMLQuestionResult['sgssst_6'] == "N/A" ){
        $Obt_8_6 = 1;
    } else {
        $Obt_8_6 = 0 ;
    }
    
    $Max_8_7 = 1;
    if( $XMLQuestionResult['sgssst_7'] == "SI" || $XMLQuestionResult['sgssst_7'] == "N/A" ){
        $Obt_8_7 = 1;
    } else {
        $Obt_8_7 = 0 ;
    }
    
    $Max_8_8 = 1;
    if( $XMLQuestionResult['sgssst_8'] == "SI" || $XMLQuestionResult['sgssst_8'] == "N/A" ){
        $Obt_8_8 = 1;
    } else {
        $Obt_8_8 = 0 ;
    }
    
    $Max_8_9 = 1;
    if( $XMLQuestionResult['sgssst_9'] == "SI" || $XMLQuestionResult['sgssst_9'] == "N/A" ){
        $Obt_8_9 = 1;
    } else {
        $Obt_8_9 = 0 ;
    }
    
    $Max_8_10 = 1;
    if( $XMLQuestionResult['sgssst_10'] == "SI" || $XMLQuestionResult['sgssst_10'] == "N/A" ){
        $Obt_8_10 = 1;
    } else {
        $Obt_8_10 = 0 ;
    }
    
    $Max_8_11 = 1;
    if( $XMLQuestionResult['sgssst_11'] == "SI" || $XMLQuestionResult['sgssst_11'] == "N/A" ){
        $Obt_8_11 = 1;
    } else {
        $Obt_8_11 = 0 ;
    }
    
    $Max_8_12 = 1;
    if( $XMLQuestionResult['sgssst_12'] == "SI" || $XMLQuestionResult['sgssst_12'] == "N/A" ){
        $Obt_8_12 = 1;
    } else {
        $Obt_8_12 = 0 ;
    }
    
    $Max_8_13 = 1;
    if( $XMLQuestionResult['sgssst_13'] == "SI" || $XMLQuestionResult['sgssst_13'] == "N/A" ){
        $Obt_8_13 = 1;
    } else {
        $Obt_8_13 = 0 ;
    }
    
    $Max_8_14 = 1;
    if( $XMLQuestionResult['sgssst_14'] == "SI" || $XMLQuestionResult['sgssst_14'] == "N/A" ){
        $Obt_8_14 = 1;
    } else {
        $Obt_8_14 = 0 ;
    }
    
    $Max_8_15 = 1;
    if( $XMLQuestionResult['sgssst_15'] == "SI" || $XMLQuestionResult['sgssst_15'] == "N/A" ){
        $Obt_8_15 = 1;
    } else {
        $Obt_8_15 = 0 ;
    }
    
    $Max_8_16 = 1;
    if( $XMLQuestionResult['sgssst_16'] == "SI" || $XMLQuestionResult['sgssst_16'] == "N/A" ){
        $Obt_8_16 = 1;
    } else {
        $Obt_8_16 = 0 ;
    }
    
    $Max_8_17 = 1;
    if( $XMLQuestionResult['sgssst_17'] == "SI" || $XMLQuestionResult['sgssst_17'] == "N/A" ){
        $Obt_8_17 = 0;
    } else {
        $Obt_8_17 = 1 ;
    }
    
    $Max_8_18 = 1;
    if( $XMLQuestionResult['sgssst_18'] == "SI" || $XMLQuestionResult['sgssst_18'] == "N/A" ){
        $Obt_8_18 = 1;
    } else {
        $Obt_8_18 = 0 ;
    }
    
    $Max_8_19 = 1;
    if( $XMLQuestionResult['sgssst_19'] == "SI" || $XMLQuestionResult['sgssst_19'] == "N/A" ){
        $Obt_8_19 = 1;
    } else {
        $Obt_8_19 = 0 ;
    }
    
    $weight_8 = 20;
    $val_8 = 20;
    $points_8 = 0;
    for ($i = 1; $i <= 19; $i++) {
        $points_8 = $points_8 + ${"Obt_8_".$i};
    }
    
    
    $weight_8 = 20;
    $val_8 = 20;
    $points_8 = 0;
    for ($i = 1; $i <= 19; $i++) {
        $points_8 = $points_8 + ${"Obt_8_".$i};
    }
    

    $points_9 = "APTO";
    $Max_9_1 = "APTO";
    if( $XMLQuestionResult['listaResctrictiva_1'] == "NO" || $XMLQuestionResult['listaResctrictiva_1'] == "N/A" ){
        $Obt_9_1 = "APTO";
    } else {
        $Obt_9_1 = "NO APTO" ;
        $points_9 = "-100";
    }
    
    $Max_9_2 = "APTO";
    if( $XMLQuestionResult['listaResctrictiva_2'] == "NO" || $XMLQuestionResult['listaResctrictiva_2'] == "N/A" ){
        $Obt_9_2 = "APTO";
    } else {
        $Obt_9_2 = "NO APTO" ;
        $points_9 = "-100";
    }
    
    $Max_9_3 = "APTO";
    if( $XMLQuestionResult['listaResctrictiva_3'] == "NO" || $XMLQuestionResult['listaResctrictiva_3'] == "N/A" ){
        $Obt_9_3 = "APTO";
    } else {
        $Obt_9_3 = "NO APTO" ;
        $points_9 = "-100";
    }
    
    $Max_9_4 = "APTO";
    if( $XMLQuestionResult['listaResctrictiva_4'] == "NO" || $XMLQuestionResult['listaResctrictiva_4'] == "N/A" ){
        $Obt_9_4 = "APTO";
    } else {
        $Obt_9_4 = "NO APTO" ;
        $points_9 = "-100";
    }
    
    $Max_9_5 = "APTO";
    if( $XMLQuestionResult['listaResctrictiva_5'] == "NO" || $XMLQuestionResult['listaResctrictiva_5'] == "N/A" ){
        $Obt_9_5 = "APTO";
    } else {
        $Obt_9_5 = "NO APTO" ;
        $points_9 = "-100";
    }
    
    $Max_9_6 = "APTO";
    if( $XMLQuestionResult['listaResctrictiva_6'] == "NO" || $XMLQuestionResult['listaResctrictiva_6'] == "N/A" ){
        $Obt_9_6 = "APTO";
    } else {
        $Obt_9_6 = "NO APTO" ;
        $points_9 = "-100";
    }
    
    $Max_9_7 = "APTO";
    if( $XMLQuestionResult['listaResctrictiva_7'] == "NO" || $XMLQuestionResult['listaResctrictiva_7'] == "N/A" ){
        $Obt_9_7 = "APTO";
    } else {
        $Obt_9_7 = "NO APTO" ;
        $points_9 = "-100";
    }
    
    $Max_9_8 = "APTO";
    if( $XMLQuestionResult['listaResctrictiva_8'] == "NO" || $XMLQuestionResult['listaResctrictiva_8'] == "N/A" ){
        $Obt_9_8 = "APTO";
    } else {
        $Obt_9_8 = "NO APTO" ;
        $points_9 = "-100";
    }
    
    $Max_9_9 = "APTO";
    if( $XMLQuestionResult['listaResctrictiva_9'] == "SI" || $XMLQuestionResult['listaResctrictiva_9'] == "N/A" ){
        $Obt_9_9 = "APTO";
    } else {
        $Obt_9_9 = "NO APTO" ;
        $points_9 = "-100";
    }
    
    $Max_9_10 = "APTO";
    if( $XMLQuestionResult['listaResctrictiva_10'] == "NO" || $XMLQuestionResult['listaResctrictiva_10'] == "N/A" ){
        $Obt_9_10 = "APTO";
    } else {
        $Obt_9_10 = "NO APTO" ;
        $points_9 = "-100";
    }
    $weight_9 = 20;
    $val_9 = 20;    

    $resultValueString = 0;
    for ($i = 1; $i <= 9; $i++) {
        $resultValueString = $resultValueString + ${"points_".$i};
    }

    if( $resultValueString <= 70 or $backgroundCheck->getVerificationSection(86)->resultId == 3 ){
        $resultString = "NO CUMPLE";
    } else if( $resultValueString > 70 && $resultValueString <= 80 ){
        $resultString = "REGULAR";
    } else if( $resultValueString > 80 && $resultValueString <= 90 ){
        $resultString = "CUMPLE";
    } else if( $resultValueString > 90){
        $resultString = "EXCEDE EXPECTATIVAS";
    }
    
    $ansExperiencia = "SH";

    // CERTIFICACIONES
    if ($backgroundCheck->getVerificationSection(63)->resultId == 2 ) {
        $ansCertificaciones = "SH";
    } else{
        $ansCertificaciones = "CH";
    }
    
    // SERVICIO
    if ($backgroundCheck->getVerificationSection(62)->resultId == 2 ) {
        $ansServicio = "SH";
    } else{
        $ansServicio = "CH";
    }

    // REFERENCIAS
    if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->resultId == 2 ) {
        $ansClientes = "SH";
    } else{
        $ansClientes = "CH";
    }
    
    // INFRAESTRUCTURA
    if ($backgroundCheck->getVerificationSection(61)->resultId == 2 ) {
        $ansInfraestructura = "SH";
    } else{
        $ansInfraestructura = "CH";
    }

    //FINANCIERO
    if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->resultId == 2 ) {
        $ansFinanciero = "SH";
    } else{
        $ansFinanciero = "CH";
    }
    
    // RRHH
    if ($backgroundCheck->getVerificationSection(65)->resultId == 2 ) {
        $ansRrhh = "SH";
    } else{
        $ansRrhh = "CH";
    }

    // SOCIOS
    if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER)->resultId == 2 ) {
        $ansSocios = "SH";
    } else{
        $ansSocios = "CH";
    }
    
    // SOCIOS
    if ($backgroundCheck->getVerificationSection(64)->resultId == 2 ) {
        $ansSGSST = "SH";
    } else{
        $ansSGSST = "CH";
    }

    // listas
    if ($backgroundCheck->getVerificationSection(68)->resultId == 2 ) {
        $ansListas = "SH";
    } else{
        $ansListas = "CH";
    }

    // GAFI

    if ($backgroundCheck->getVerificationSection(86) !=null){
    if($backgroundCheck->getVerificationSection(86)->resultId == 2){
        $ansGafi = "SH";
    } else{
        $ansGafi = "CH";
    }
    }