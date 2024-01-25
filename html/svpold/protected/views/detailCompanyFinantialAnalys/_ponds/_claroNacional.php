<?php
    // var_dump($company);
    $sectionCompanyFinantialAnalys = $company;
    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/calculations.php');
    
    $empty = "<td></td><td></td><td></td>";

    $Max_6_1 = 3;
    if( $capitalDeTrabajo_0 > 0 ){
        $Obt_6_1_0 = 3 ;
    } else {
        $Obt_6_1_0 = 0 ;
    }
    if( $capitalDeTrabajo_1 > 0 ){
        $Obt_6_1_1 = 3 ;
    } else {
        $Obt_6_1_1 = 0 ;
    }
    $Obt_6_1 = "<td>". $Max_6_1. "</td><td>".$Obt_6_1_0."</td><td>".$Obt_6_1_1."</td>";

    
    $Max_6_2 = 4.5;
    if( $razonCorriente_0 >= 1 ){
        $Obt_6_2_0 = 4.5 ;
    } else if ( $razonCorriente_0 >= 0.81 && $razonCorriente_0 < 1) {
        $Obt_6_2_0 = 1.1 ;
    } else {
        $Obt_6_2_0 = 0 ;
    }
    if( $razonCorriente_1 >= 1 ){
        $Obt_6_2_1 = 4.5 ;
    } else if ( $razonCorriente_1 >= 0.81 && $razonCorriente_1 < 1) {
        $Obt_6_2_1 = 1.1 ;
    } else {
        $Obt_6_2_1 = 0 ;
    }
    
    $Obt_6_2 = "<td>". $Max_6_2. "</td><td>".$Obt_6_2_0."</td><td>".$Obt_6_2_1."</td>";
    
    $Max_6_3 = 4.5;
    if( $nivelDeEndeudamiento_0 <= .6 ){
        $Obt_6_3_0 = 4.5 ;
    } else if ( $nivelDeEndeudamiento_0 >= 0.61 && $nivelDeEndeudamiento_0 < .8) {
        $Obt_6_3_0 = 3.2 ;
    } else {
        $Obt_6_3_0 = 0 ;
    }
    if( $nivelDeEndeudamiento_1 <= .6 ){
        $Obt_6_3_1 = 4.5 ;
    } else if ( $nivelDeEndeudamiento_1 >= 0.61 && $nivelDeEndeudamiento_1 < .8) {
        $Obt_6_3_1 = 3.2 ;
    } else {
        $Obt_6_3_1 = 0 ;
    }
    
    $Obt_6_3 = "<td>". $Max_6_3. "</td><td>".$Obt_6_3_0."</td><td>".$Obt_6_3_1."</td>";

    $Max_6_6 = 1.5;
    if( $endeudamientoFinanciero_0 <= .8 ){
        $Obt_6_6_0 = 1.5 ;
    } else {
        $Obt_6_6_0 = 0 ;
    }
    if( $endeudamientoFinanciero_1 <= .8 ){
        $Obt_6_6_1 = 1.5 ;
    } else {
        $Obt_6_6_1 = 0 ;
    }

    $Obt_6_6 = "<td>". $Max_6_6. "</td><td>".$Obt_6_6_0."</td><td>".$Obt_6_6_1."</td>";

    $Max_6_4 = 3;
    if( $apalancamientoCortoPlazo_0 <= 80 ){
        $Obt_6_4_0 = 3 ;
    } else {
        $Obt_6_4_0 = 0 ;
    }
    if( $apalancamientoCortoPlazo_1 <= 80 ){
        $Obt_6_4_1 = 3 ;
    } else {
        $Obt_6_4_1 = 0 ;
    }
    $Obt_6_4 = "<td>". $Max_6_4. "</td><td>".$Obt_6_4_0."</td><td>".$Obt_6_4_1."</td>";
    
    $Max_6_7 = 1.5;
    if( $margenEBITDA_0 >= .16 ){
        $Obt_6_7_0 = 1.5 ;
    } else if ( $margenEBITDA_0 >= 0.08 && $margenEBITDA_0 < .16) {
        $Obt_6_7_0 = 1.1 ;
    } else {
        $Obt_6_7_0 = 0 ;
    }
    if( $margenEBITDA_1 >= .16 ){
        $Obt_6_7_1 = 1.5 ;
    } else if ( $margenEBITDA_1 >= 0.08 && $margenEBITDA_1 < .16) {
        $Obt_6_7_1 = 1.1 ;
    } else {
        $Obt_6_7_1 = 0 ;
    }
    $Obt_6_7 = "<td>". $Max_6_7. "</td><td>".$Obt_6_7_0."</td><td>".$Obt_6_7_1."</td>";

    $Max_6_8 = 3;
    if( $rentabilidadPatrimonioROA_0 > .4 ){
        $Obt_6_8_0 = 3 ;
    } else if ( $rentabilidadPatrimonioROA_0 >= .1 && $rentabilidadPatrimonioROA_0 <= .4) {
        $Obt_6_8_0 = 2.1 ;
    } else {
        $Obt_6_8_0 = 0 ;
    }
    if( $rentabilidadPatrimonioROA_1 > .4 ){
        $Obt_6_8_1 = 3 ;
    } else if ( $rentabilidadPatrimonioROA_1 >= .1 && $rentabilidadPatrimonioROA_1 <= .4) {
        $Obt_6_8_1 = 2.1 ;
    } else {
        $Obt_6_8_1 = 0 ;
    }
    $Obt_6_8 = "<td>". $Max_6_8. "</td><td>".$Obt_6_8_0."</td><td>".$Obt_6_8_1."</td>";


    $Max_6_9 = 1.5;
    if( $coberturadeGastosNoOperacionales_0 >= 2.5 ){
        $Obt_6_9_0 = 1.5 ;
    } else {
        $Obt_6_9_0 = 0 ;
    }
    if( $coberturadeGastosNoOperacionales_0 >= 2.5 ){
        $Obt_6_9_1 = 1.5 ;
    } else {
        $Obt_6_9_1 = 0 ;
    }
    $Obt_6_9 = "<td>". $Max_6_9. "</td><td>".$Obt_6_9_0."</td><td>".$Obt_6_9_1."</td>";

    
    $Max_6_5 = 1.5;
    if( $endeudamientoVentas_0 <= .4 ){
        $Obt_6_5_0 = 1.5 ;
    } else if ( $endeudamientoVentas_0 >= 0.41 && $endeudamientoVentas_0 <= .7) {
        $Obt_6_5_0 = 1.1 ;
    } else {
        $Obt_6_5_0 = 0 ;
    }
    if( $endeudamientoVentas_1 <= .4 ){
        $Obt_6_5_1 = 1.5 ;
    } else if ( $endeudamientoVentas_1 >= 0.41 && $endeudamientoVentas_1 <= .7) {
        $Obt_6_5_1 = 1.1 ;
    } else {
        $Obt_6_5_1 = 0 ;
    }
    $Obt_6_5 = "<td>". $Max_6_5. "</td><td>".$Obt_6_5_0."</td><td>".$Obt_6_5_1."</td>";

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
    
    $Max_6_13 = 0;
    if( $varCapitalTrabajo > 50 ){
        $Obt_6_13 = -100 ;
    } else {
        $Obt_6_13 = 0 ;
    }
    /*
    

    
    */