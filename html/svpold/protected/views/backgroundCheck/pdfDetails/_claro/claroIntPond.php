<?php

    $Max_1_1 = 5;
    if($backgroundCheck->yearsOfActivity < 4 ){
        $Obt_1_1 = 1;
    } else if($backgroundCheck->yearsOfActivity >= 4 && $backgroundCheck->yearsOfActivity < 6){
        $Obt_1_1 = 3.5;
    } else if($backgroundCheck->yearsOfActivity >= 6 && $backgroundCheck->yearsOfActivity < 8){
        $Obt_1_1 = 4;
    } else if($backgroundCheck->yearsOfActivity >= 8 && $backgroundCheck->yearsOfActivity < 10){
        $Obt_1_1 = 4.5;
    } else if($backgroundCheck->yearsOfActivity >= 10){
        $Obt_1_1 = 5;
    }

    $val_1 = 5;
    $weight_1 = 5;
    $points_1 =  0;
    for ($i = 1; $i <= 1; $i++) {
        if(!isset(${"Obt_1_".$i})){
            ${"Obt_1_".$i} = 0;
        }
        $points_1 = $points_1 + ${"Obt_1_".$i};
    }

    
    $Max_2_1 = 3;
    if($XMLQuestionResult['adicionalClaro_1'] == "GRANDE"){
        $Obt_2_1 = 3;
    } else if($XMLQuestionResult['adicionalClaro_1'] == "MEDIANA"){
        $Obt_2_1 = 2.7;
    } else if($XMLQuestionResult['adicionalClaro_1'] == "MEQUEÑA"){
        $Obt_2_1 = 2.4;
    } else if($XMLQuestionResult['adicionalClaro_1'] == "MICROEMPRESA"){
        $Obt_2_1 = 1.8;
    } else {
        $Obt_2_1 = 0;
    }

    

    
    $Max_2_2 = 2;
    if($XMLQuestionResult['adicionalClaro_2'] == "GRANDE"){
        $Obt_2_2 = 2;
    } else if($XMLQuestionResult['adicionalClaro_2'] == "MEDIANA"){
        $Obt_2_2 = 1.8;
    } else if($XMLQuestionResult['adicionalClaro_2'] == "MEQUEÑA"){
        $Obt_2_2 = 1.6;
    } else if($XMLQuestionResult['adicionalClaro_2'] == "MICROEMPRESA"){
        $Obt_2_2 = 1.2;
    } else {
        $Obt_2_2 = 0;
    }

    $val_2 = 5;
    $weight_2 = 5;
    $points_2 =  0;
    for ($i = 1; $i <= 2; $i++) {
        if(!isset(${"Obt_2_".$i})){
            ${"Obt_2_".$i} = 0;
        }
        $points_2 = $points_2 + ${"Obt_2_".$i};
    }


    $Max_3_1 = 3;
    if($XMLQuestionResult['certification_1'] == "SI"){
        $Obt_3_1 = 3;
    } else if($XMLQuestionResult['certification_1'] == "PREVISTO"){
        $Obt_3_1 = 2.4;
    } else if($XMLQuestionResult['certification_1'] == "DOCUMENTADO"){
        $Obt_3_1 = 2.1;
    } else if($XMLQuestionResult['certification_1'] == "NO"){
        $Obt_3_1 = 0;
    } else {
        $Obt_3_1 = 3;
    }
    
    $Max_3_2 = 2.25;
    if($XMLQuestionResult['certification_2'] == "SI"){
        $Obt_3_2 = 2.250;
    } else if($XMLQuestionResult['certification_2'] == "PREVISTO"){
        $Obt_3_2 = 1.8;
    } else if($XMLQuestionResult['certification_2'] == "DOCUMENTADO"){
        $Obt_3_2 = 1.575;
    } else if($XMLQuestionResult['certification_2'] == "NO"){
        $Obt_3_2 = 0;
    } else {
        $Obt_3_2 = 2.250;
    }
    
    $Max_3_3 = 2.250;
    if($XMLQuestionResult['certification_3'] == "SI"){
        $Obt_3_3 = 2.250;
    } else if($XMLQuestionResult['certification_3'] == "PREVISTO"){
        $Obt_3_3 = 1.8;
    } else if($XMLQuestionResult['certification_3'] == "DOCUMENTADO"){
        $Obt_3_3 = 1.575;
    } else if($XMLQuestionResult['certification_3'] == "NO"){
        $Obt_3_3 = 0;
    } else {
        $Obt_3_3 = 2.250;
    }
    
    $Max_3_4 = 2.250;
    if($XMLQuestionResult['certification_4'] == "SI"){
        $Obt_3_4 = 2.250;
    } else if($XMLQuestionResult['certification_4'] == "PREVISTO"){
        $Obt_3_4 = 1.8;
    } else if($XMLQuestionResult['certification_4'] == "DOCUMENTADO"){
        $Obt_3_4 = 1.575;
    } else if($XMLQuestionResult['certification_4'] == "NO"){
        $Obt_3_4 = 0;
    } else {
        $Obt_3_4 = 2.250;
    }
    
    $Max_3_5 = 2.250;
    if($XMLQuestionResult['certification_5'] == "SI"){
        $Obt_3_5 = 2.250;
    } else if($XMLQuestionResult['certification_5'] == "PREVISTO"){
        $Obt_3_5 = 1.8;
    } else if($XMLQuestionResult['certification_5'] == "DOCUMENTADO"){
        $Obt_3_5 = 1.575;
    } else if($XMLQuestionResult['certification_5'] == "NO"){
        $Obt_3_5 = 0;
    } else {
        $Obt_3_5 = 2.250;
    }
    
    $Max_3_6 = 1.5;
    if($XMLQuestionResult['certification_6'] == "SI"){
        $Obt_3_6 = 1.5;
    } else if($XMLQuestionResult['certification_6'] == "PREVISTO"){
        $Obt_3_6 = 1.2;
    } else if($XMLQuestionResult['certification_6'] == "DOCUMENTADO"){
        $Obt_3_6 = 1.05;
    } else if($XMLQuestionResult['certification_6'] == "NO"){
        $Obt_3_6 = 0;
    } else {
        $Obt_3_6 = 1.5;
    }
    
    $Max_3_7 = 1.5;
    if($XMLQuestionResult['certification_7'] == "SI"){
        $Obt_3_7 = 1.5;
    } else if($XMLQuestionResult['certification_7'] == "PREVISTO"){
        $Obt_3_7 = 1.2;
    } else if($XMLQuestionResult['certification_7'] == "DOCUMENTADO"){
        $Obt_3_7 = 1.05;
    } else if($XMLQuestionResult['certification_7'] == "NO"){
        $Obt_3_7 = 0;
    } else {
        $Obt_3_7 = 1.5;
    }


    $val_3 = 15;
    $weight_3 = 15;
    $points_3 =  0;
    for ($i = 1; $i <= 7; $i++) {
        if(!isset(${"Obt_3_".$i})){
            ${"Obt_3_".$i} = 0;
        }
        $points_3 = $points_3 + ${"Obt_3_".$i};
    }


    $Max_4_1 = 13;
    if($XMLQuestionResult['comercioInt_1'] == "Mayor a 10 años"){
        $Obt_4_1 = 13;
    } else if($XMLQuestionResult['comercioInt_1'] == "Entre 8 y 10 años"){
        $Obt_4_1 = 11.7;
    } else if($XMLQuestionResult['comercioInt_1'] == "Entre 6 y 8 años"){
        $Obt_4_1 = 10.4;
    } else if($XMLQuestionResult['comercioInt_1'] == "Entre 4 y 6 años"){
        $Obt_4_1 = 9.1;
    } else if($XMLQuestionResult['comercioInt_1'] == "Menor a 4 años"){
        $Obt_4_1 = 2.6;
    }

    $Max_4_2 = 4;
    if($XMLQuestionResult['comercioInt_2'] == "SI"){
        $Obt_4_2 = 4;
    } else {
        $Obt_4_2 = 0;
    }

    $Max_4_3 = 3;
    if($XMLQuestionResult['comercioInt_3'] == "SI"){
        $Obt_4_3 = 3;
    } else {
        $Obt_4_3 = 0;
    }

    $val_4 = 20;
    $weight_4 = 20;
    $points_4 =  0;
    for ($i = 1; $i <= 3; $i++) {
        if(!isset(${"Obt_4_".$i})){
            ${"Obt_4_".$i} = 0;
        }
        $points_4 = $points_4 + ${"Obt_4_".$i};
    }


    $Max_6_1 = 2;
    if( $capitalDeTrabajo_0 > 0 ){
        $Obt_6_1 = 2 ;
    } else {
        $Obt_6_1 = 0 ;
    }

    $Max_6_2 = 3;
    if( $razonCorriente_0 >= 1 ){
        $Obt_6_2 = 3 ;
    } else if ( $razonCorriente_0 >= 0.81 && $razonCorriente_0 < 1) {
        $Obt_6_2 = 2.1 ;
    } else {
        $Obt_6_2 = 0 ;
    }

    $Max_6_3 = 3;
    if( $nivelDeEndeudamiento_0 <= .6 ){
        $Obt_6_3 = 3;
    } else if ( $nivelDeEndeudamiento_0 >= 0.61 && $nivelDeEndeudamiento_0 < .8) {
        $Obt_6_3 = 2.1;
    } else {
        $Obt_6_3 = 0 ;
    }

    $Max_6_4 = 2;
    if( $apalancamientoCortoPlazo_0 <= 0.8 ){
        $Obt_6_4 = 2 ;
    } else {
        $Obt_6_4 = 0 ;
    }
    
    $Max_6_5 = 1;
    if( $endeudamientoVentas_0 <= .4 ){
        $Obt_6_5 = 1 ;
    } else if ( $endeudamientoVentas_0 >= 0.41 && $endeudamientoVentas_0 <= .7) {
        $Obt_6_5 = .7 ;
    } else {
        $Obt_6_5 = 0 ;
    }
    
    $Max_6_6 = 1;
    if( $endeudamientoFinanciero_0 <= .8 ){
        $Obt_6_6 = 1 ;
    } else {
        $Obt_6_6 = 0 ;
    }

    $Max_6_7 = 1;
    if( $margenEBITDA_0 >= .16 ){
        $Obt_6_7 = 1 ;
    } else if ( $margenEBITDA_0 >= 0.08 && $margenEBITDA_0 < .16) {
        $Obt_6_7 = .7 ;
    } else {
        $Obt_6_7 = 0 ;
    }

    $Max_6_8 = 2;
    if( $rentabilidadPatrimonioROA_0 > .4 ){
        $Obt_6_8 = 2 ;
    } else if ( $rentabilidadPatrimonioROA_0 >= .1 && $rentabilidadPatrimonioROA_0 <= .4) {
        $Obt_6_8 = 1.4 ;
    } else {
        $Obt_6_8 = 0 ;
    }
    
    $Max_6_9 = 1;
    if( $coberturadeGastosNoOperacionales_0 >= 2.5 ){
        $Obt_6_9 = 1 ;
    } else {
        $Obt_6_9 = 0 ;
    }

    $Max_6_10 = 2;
    if( $utilidadesAcumuladas > 0 ){
        $Obt_6_10 = 2 ;
    } else {
        $Obt_6_10 = 0 ;
    }
    
    $Max_6_11 = 2;
    if( $varingresosOperacionales > 0 && $utilidadNeta_0 > 0 ){
        $Obt_6_11 = 2 ;
    } else if( $varingresosOperacionales < 0 && $utilidadNeta_0 > 0 ){
        $Obt_6_11 = 1.8 ;
    } else if( $varingresosOperacionales > 0 && $utilidadNeta_0 < 0 ){
        $Obt_6_11 = 1.4 ;
    } else if( $varingresosOperacionales < 0 && $utilidadNeta_0 < 0 ){
        $Obt_6_11 = 0 ;
    } else {
        $Obt_6_11 = 0 ;
    }
    

            $Max_6_12 = 0;
    if ($penultimo !=null){
        if($utilidadNeta_0 < 0){
               if( $varCapitalTrabajo > 0.5 ){
                $Obt_6_12 = -100 ;
            } else {
                $Obt_6_12 = 0 ;
            }
        }else {
            $Obt_6_12 = 0 ;
        }
    }else {
    $Obt_6_12 = 0 ;
    }

$val_6 = 20;
$weight_6 = 20;
$points_6 =  0;

$points_6 = 0;
if ($Obt_6_12 == -100){
    $points_6 = 0;
} else{

for ($i = 1; $i <= 12; $i++) {

    $points_6 = $points_6 + ${"Obt_6_".$i};
}
}


    $Max_5_1 = 1.8;
    if( $XMLQuestionResult['sgssst_1'] == "SI" || $XMLQuestionResult['sgssst_1'] == "NO REQUIERE"){
        $Obt_5_1 = 1.8 ;
    } elseif( $XMLQuestionResult['sgssst_1'] == "IMPLEMENTANDO" ){
        $Obt_5_1 = .9 ;
    } else {
        $Obt_5_1 = 0 ;
    }

    $Max_5_2 = 3.3;
    if( $XMLQuestionResult['sgssst_2'] == "SI" || $XMLQuestionResult['sgssst_2'] == "NO REQUIERE"){
        $Obt_5_2 = .66 ;
    } else if( $XMLQuestionResult['sgssst_2'] == "NO" ){
        $Obt_5_2 = 3.3 ;
    } else {
        $Obt_5_2 = 0 ;
    }
    
    $Max_5_3 = 3.3;
    if( $XMLQuestionResult['sgssst_3'] == "SI" || $XMLQuestionResult['sgssst_3'] == "NO REQUIERE"){
        $Obt_5_3 = 3.3 ;
    } else {
        $Obt_5_3 = 0 ;
    }
    
    $Max_5_4 = 3.3;
    if( $XMLQuestionResult['sgssst_4'] == "SI" || $XMLQuestionResult['sgssst_4'] == "NO REQUIERE"){
        $Obt_5_4 = 3.3 ;
    } else {
        $Obt_5_4 = 0 ;
    }
    
    $Max_5_5 = 3.3;
    if( $XMLQuestionResult['sgssst_5'] == "SI" || $XMLQuestionResult['sgssst_5'] == "NO REQUIERE"){
        $Obt_5_5 = 3.3 ;
    } else {
        $Obt_5_5 = 0 ;
    }
   
    $val_5 = 15;
    $weight_5 = 15;
    $points_5 =  0;
    for ($i = 1; $i <= 5; $i++) {
        if(!isset(${"Obt_5_".$i})){
            ${"Obt_5_".$i} = 0;
        }
        $points_5 = $points_5 + ${"Obt_5_".$i};
    }
    
    $Max_7_1 = 3;
    if( $XMLQuestionResult['gcPolizaSeguro'] == "NO" ){
        $Obt_7_1 = 0 ;
    } else {
        $Obt_7_1 = 3;
    }
    $Max_7_2 = 3.5;
    if( $XMLQuestionResult['gcGarantias'] == "NO" ){
        $Obt_7_2 = 0 ;
    } else {
        $Obt_7_2 = 3.5;
    }
    $Max_7_3 = 3.5;
    if( $XMLQuestionResult['gcServicioTecnico'] == "NO" ){
        $Obt_7_3 = 0 ;
    } else {
        $Obt_7_3 = 3.5;
    }

    $val_7 = 10;
    $weight_7 = 10;
    $points_7 =  0;
    for ($i = 1; $i <= 3; $i++) {
        if(!isset(${"Obt_7_".$i})){
            ${"Obt_7_".$i} = 0;
        }
        $points_7 = $points_7 + ${"Obt_7_".$i};
    }


    $Max_8_1 = 2.5;
    if($deliveryCompliance == 0 ){
        $Obt_8_1 = 2.5 ;
    } else if($deliveryCompliance == 1 ){
        $Obt_8_1 = 0 ;
    } else if($deliveryCompliance == 2 ){
        $Obt_8_1 = 1.5 ;
    } else if($deliveryCompliance == 3 ){
        $Obt_8_1 = 1.75 ;
    } else if($deliveryCompliance >= 4 ){
        $Obt_8_1 = 2.5 ;
    }
    
    $Max_8_2 = 2.5;
    if($productsQuality == 0 ){
        $Obt_8_2 = 2.5 ;
    } else if($productsQuality == 1 ){
        $Obt_8_2 = 0 ;
    } else if($productsQuality == 2 ){
        $Obt_8_2 = 1.5 ;
    } else if($productsQuality == 3 ){
        $Obt_8_2 = 1.75 ;
    } else if($productsQuality >= 4 ){
        $Obt_8_2 = 2.5 ;
    }

    $Max_8_3 = 2.5;
    if($postSalesService == 0 ){
        $Obt_8_3 = 2.5 ;
    } else if($postSalesService == 1 ){
        $Obt_8_3 = 0 ;
    } else if($postSalesService == 2 ){
        $Obt_8_3 = 1.5 ;
    } else if($postSalesService == 3 ){
        $Obt_8_3 = 1.75 ;
    } else if($postSalesService >= 4 ){
        $Obt_8_3 = 2.5 ;
    }

    $Max_8_4 = 2.5;
    if($prices == 0 ){
        $Obt_8_4 = 2.5 ;
    } else if($prices == 1 ){
        $Obt_8_4 = 0 ;
    } else if($prices == 2 ){
        $Obt_8_4 = 1.5 ;
    } else if($prices == 3 ){
        $Obt_8_4 = 1.75 ;
    } else if($prices >= 4 ){
        $Obt_8_4 = 2.5 ;
    }

    $val_8 = 10;
    $weight_8 = 10;
    $points_8 =  0;
    for ($i = 1; $i <= 4; $i++) {
        if(!isset(${"Obt_8_".$i})){
            ${"Obt_8_".$i} = 0;
        }
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
 /*
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
    if( $XMLQuestionResult['listaResctrictiva_9'] == "NO" || $XMLQuestionResult['listaResctrictiva_9'] == "N/A" ){
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
 */
    $weight_9 = 20;
    $val_9 = 20;    

    $resultValueString = 0;
    for ($i = 1; $i <= 9; $i++) {
        $resultValueString = $resultValueString + ${"points_".$i};
    }

    if( $resultValueString <= 70  or $backgroundCheck->getVerificationSection(86)->resultId == 3 ){
        $resultString = "NO CUMPLE";
    } else if( $resultValueString > 70 && $resultValueString <= 80 ){
        $resultString = "REGULAR";
    } else if( $resultValueString > 80 && $resultValueString <= 90 ){
        $resultString = "CUMPLE";
    } else if( $resultValueString > 90){
        $resultString = "EXCEDE EXPECTATIVAS";
    }
    

    $ansActividad = "SH";
    

    $ansClientes = "SH";
    $ansInfraestructura = "SH";
    $ansFinanciero = "SH";
    $ansRrhh = "SH";
    $ansSGSST = "SH";
    $ansListas  = "SH";


    // TAMAÑO
    if ($backgroundCheck->getVerificationSection(69)->resultId == 2 ) {
        $ansTamano = "SH";
    } else{
        $ansTamano = "CH";
    }
    
    // CALIDAD
    if ($backgroundCheck->getVerificationSection(70)->resultId == 2 ) {
        $ansCalidad = "SH";
    } else{
        $ansCalidad = "CH";
    }
    
    // COMERCIO
    if ($backgroundCheck->getVerificationSection(71)->resultId == 2 ) {
        $ansComercio = "SH";
    } else{
        $ansComercio = "CH";
    }

    // SGSST
    if ($backgroundCheck->getVerificationSection(76)->resultId == 2 ) {
        $ansSGSST = "SH";
    } else{
        $ansSGSST = "CH";
    }
    
    // SERVICIO
    if ($backgroundCheck->getVerificationSection(77)->resultId == 2 ) {
        $ansServicio = "SH";
    } else{
        $ansServicio = "CH";
    }
    
    // REFERENCIAS
    if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->resultId == 2 ) {
        $ansReferencias = "SH";
    } else{
        $ansReferencias = "CH";
    }

    //FINANCIERO
    if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->resultId == 2 ) {
        $ansFinanciero = "SH";
    } else{
        $ansFinanciero = "CH";
    }

     // listas
     if ($backgroundCheck->getVerificationSection(68)->resultId == 2 ) {
        $ansListas = "SH";
    } else{
        $ansListas = "CH";
    }

// GAFI
    if ($backgroundCheck->getVerificationSection(86) !=null) {
        if ($backgroundCheck->getVerificationSection(86)->resultId == 2) {
            $ansGafi = "SH";
        } else {
            $ansGafi = "CH";
        }
    }