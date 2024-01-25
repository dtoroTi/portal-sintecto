<?php
if (isset($prodecoNacPlus2)) {
    $relationAge = 0;
    $customerService = 0;
    $postSalesService = 0;
    $customerServiceADD = 0;
    $postSalesServiceADD = 0;
    $i = 0;
    $ii =0;
    foreach ($sectionCompanyCustomer as $customer) {
        if ($relationAge < $customer->relationAge ) {
            $relationAge = $customer->relationAge;
        }
        if (  $customer->productsQuality != 0  ){
            $customerServiceADD = $customerServiceADD + $customer->productsQuality;
            $i++;
        }
        if ( $customer->postSalesService != 0 ){
            $postSalesServiceADD = $postSalesServiceADD + $customer->postSalesService;
            $ii++;
        }
    };

    $customerService = round(divideNumbers($customerServiceADD , $i));
    $postSalesService = round(divideNumbers($postSalesServiceADD , $ii));

    if ($customerService == 0) { $customerServiceCal = 0; $customerService = "N/R"; }
    if ($customerService == 1) { $customerServiceCal = 0; $customerService = "MALO"; }
    if ($customerService == 2) { $customerServiceCal = 10; $customerService = "REGULAR"; }
    if ($customerService == 3) { $customerServiceCal = 12; $customerService = "BUENO"; }
    if ($customerService >= 4) { $customerServiceCal = 14; $customerService = "EXCELENTE"; }

    if ($postSalesService == 0) { $postSalesServiceCal = 0; $postSalesService = "N/R"; }
    if ($postSalesService == 1) { $postSalesServiceCal = 0; $postSalesService = "MALO"; }
    if ($postSalesService == 2) { $postSalesServiceCal = 10; $postSalesService = "REGULAR"; }
    if ($postSalesService == 3) { $postSalesServiceCal = 12; $postSalesService = "BUENO"; }
    if ($postSalesService >= 4) { $postSalesServiceCal = 14 ; $postSalesService = "EXCELENTE"; }


    $refCIFINVal = $sectionCompanyFinance->refCIFIN;



    // print_r($sectionCompanyFinance->refCIFIN); die;

    // echo $sectionCompanyFinance->refCIFIN; die;

    if ($refCIFINVal == 5) { $refCIFINCal = 0; $refCIFIN = "N/R"; }
    if ($refCIFINVal == 4) { $refCIFINCal = 0; $refCIFIN = "N/R"; }
    if ($refCIFINVal == 3) { $refCIFINCal = 0; $refCIFIN = "NEGATIVO"; }
    if ($refCIFINVal == 2) { $refCIFINCal = 4; $refCIFIN = "REGULAR"; }
    if ($refCIFINVal == 1) { $refCIFINCal = 6; $refCIFIN = "ACEPTABLE"; }
    if ($refCIFINVal == 0) { $refCIFINCal = 7; $refCIFIN = "EXCELENTE"; }

    if ($backgroundCheck->yearsOfActivity >= 0 && $backgroundCheck->yearsOfActivity <= 3) {
        $yearsOfActivityCal = 2;
    } else if ($backgroundCheck->yearsOfActivity >= 4 && $backgroundCheck->yearsOfActivity <= 8) {
        $yearsOfActivityCal = 3;
    } else if ($backgroundCheck->yearsOfActivity >= 9) {
        $yearsOfActivityCal = 4;
    }

    if ($backgroundCheck->companySizeByActives >= 0 && $backgroundCheck->companySizeByActives <= 500) {
        $companySizeByActivesCal = 6;
    } else if ($backgroundCheck->companySizeByActives >= 501 && $backgroundCheck->companySizeByActives <= 5000) {
        $companySizeByActivesCal = 7;
    } else if ($backgroundCheck->companySizeByActives >= 5001) {
        $companySizeByActivesCal = 8;
    }

    $Pol_CalCalidad = $XMLQuestionResult['Pol_Calidad'];
        if ($XMLQuestionResult['Pol_Calidad'] == "No" || $XMLQuestionResult['Pol_Calidad'] == "N/R") {
            $Pol_CalCalidad = 0;
        } else {
            $Pol_CalCalidad = 1;
        }


    if ($relationAge < 1) {
        $relationAgeCal = 8;
    } else if ($relationAge >= 1 && $relationAge <= 2) {
        $relationAgeCal = 9;
    } else if ($relationAge >= 3 && $relationAge <= 7) {
        $relationAgeCal = 10;
    } else if ($relationAge >= 7) {
        $relationAgeCal = 11;
    }


    if ($razonCorriente_0 >= 1.5) {
        $razonCorrienteCal_0 = 5.4;
    } else if ($razonCorriente_0 >= 0.9 && $razonCorriente_0 < 1.5) {
        $razonCorrienteCal_0 = 2.7;
    } else if ($razonCorriente_0 < 0.9 || $razonCorriente_0== "") {
        $razonCorrienteCal_0 = 0.9;
    }

    if ($pruebaAcida_0 >= 1.1) {
        $pruebaAcidaCal_0 = 1.8;
    } else if ($pruebaAcida_0 >= 0.8 && $pruebaAcida_0 < 1.1) {
        $pruebaAcidaCal_0 = 0.9;
    } else if ($pruebaAcida_0 < 0.8) {
        $pruebaAcidaCal_0 = 0.36;
    }


    if ($nivelDeEndeudamiento_0 <= 0.3) {
        $nivelDeEndeudamientoCal_0 = 5.4;
    } else if ($nivelDeEndeudamiento_0 <= 0.6 && $nivelDeEndeudamiento_0 > .3) {
        $nivelDeEndeudamientoCal_0 = 2.7;
    } else if ($nivelDeEndeudamiento_0 > .6) {
        $nivelDeEndeudamientoCal_0 = 0.05;
    }

    if ($leverage_0 >= 4) {
        $leverageCal_0 = 0.9;
    } else if ($leverage_0 >= 2 && $leverage_0 < 4) {
        $leverageCal_0 = 1.8;
    } else if ($leverage_0 < 2) {
        $leverageCal_0 = 3.6;
    }

    if ($margenBruto_0 >= 0.5) {
        $margenBrutoCal_0 = 1.8;
    } else if ($margenBruto_0 >= 0.3 && $margenBruto_0 < 0.5) {
        $margenBrutoCal_0 = 0.9;
    } else if ($margenBruto_0 < 0.3) {
        $margenBrutoCal_0 = 0.36;
    }

    // echo $totalEmpleados; die;

    if ($totalEmpleados <= 10) {
        $totalEmpleadosCal = 4;
    } else if ($totalEmpleados >= 11 && $totalEmpleados <= 50) {
        $totalEmpleadosCal = 5;
    } else if ($totalEmpleados >= 51 && $totalEmpleados <= 200) {
        $totalEmpleadosCal = 6;
    } else if ($totalEmpleados > 200) {
        $totalEmpleadosCal = 7;
    }



    if ($XMLQuestionResult['rrhh_8'] == "Sí") {
        $rrhhCal_8 = 3;
    } else{
        $rrhhCal_8 = 0;
    }

    $Politica_1 = $XMLQuestionResult['Politica_1'];
    if ($Politica_1 == "Sí") { $Politica_1 = 1; } else{ $Politica_1 = 0; }


    $Politica_2 = $XMLQuestionResult['Politica_2'];
    if ($Politica_2 == "Sí" ) { $Politica_2 = 1; } else{ $Politica_2 = 0; }


    $Politica_3 = $XMLQuestionResult['Politica_3'];
    if ($Politica_3 == "Sí") { $Politica_3 = 3; } else{ $Politica_3 = 0; }


    $Politica_4 = $XMLQuestionResult['Politica_4'];
    if ($Politica_4 == "Sí") { $Politica_4 = 0.5; } else{ $Politica_4 = 0; }


    $Politica_5 = $XMLQuestionResult['Politica_5'];
    if ($Politica_5 == "Sí") { $Politica_5 = 1; } else{ $Politica_5 = 0; }

    $Politica_6 = $XMLQuestionResult['Politica_6'];
    if ($Politica_6 == "Sí") { $Politica_6 = 1.5; } else{ $Politica_6 = 0; }

    $Politica_7 = $XMLQuestionResult['Politica_7'];
    if ($Politica_7 == "Sí") { $Politica_7 = 1.5; } else{ $Politica_7 = 0; }

    $Politica_8 = $XMLQuestionResult['Politica_8'];
        if ($Politica_8 == "Sí") { $Politica_8 = 3.5; } else{ $Politica_8 = 0; }
    
        
    $plusNacNegProdeco_1 = $XMLQuestionResult['plusNacNegProdeco_1'];
    if ($plusNacNegProdeco_1 == "SI") { $plusNacNegProdecoCal_1 = -100; } else{ $plusNacNegProdecoCal_1 = 0; }
    $plusNacNegProdeco_2 = $XMLQuestionResult['plusNacNegProdeco_2'];
    if ($plusNacNegProdeco_2 == "SI") { $plusNacNegProdecoCal_2 = -50; } else{ $plusNacNegProdecoCal_2 = 0; }
    $plusNacNegProdeco_3 = $XMLQuestionResult['plusNacNegProdeco_3'];
    if ($plusNacNegProdeco_3 == "SI") { $plusNacNegProdecoCal_3 = -50; } else{ $plusNacNegProdecoCal_3 = 0; }
    $plusNacNegProdeco_4 = $XMLQuestionResult['plusNacNegProdeco_4'];
    if ($plusNacNegProdeco_4 == "SI") { $plusNacNegProdecoCal_4 = -50; } else{ $plusNacNegProdecoCal_4 = 0; }
    $plusNacNegProdeco_5 = $XMLQuestionResult['plusNacNegProdeco_5'];
    if ($plusNacNegProdeco_5 == "SI") { $plusNacNegProdecoCal_5 = -30; } else{ $plusNacNegProdecoCal_5 = 0; }
    $plusNacNegProdeco_6 = $XMLQuestionResult['plusNacNegProdeco_6'];
    if ($plusNacNegProdeco_6 == "SI") { $plusNacNegProdecoCal_6 = -30; } else{ $plusNacNegProdecoCal_6 = 0; }
    $plusNacNegProdeco_7 = $XMLQuestionResult['plusNacNegProdeco_7'];
    if ($plusNacNegProdeco_7 == "SI") { $plusNacNegProdecoCal_7 = -20; } else{ $plusNacNegProdecoCal_7 = 0; }
    $plusNacNegProdeco_8 = $XMLQuestionResult['plusNacNegProdeco_8'];
    if ($plusNacNegProdeco_8 == "SI") { $plusNacNegProdecoCal_8 = -20; } else{ $plusNacNegProdecoCal_8 = 0; }
    $plusNacNegProdeco_9 = $XMLQuestionResult['plusNacNegProdeco_9'];
    if ($plusNacNegProdeco_9 == "SI") { $plusNacNegProdecoCal_9 = -20; } else{ $plusNacNegProdecoCal_9 = 0; }


    $plusNacPosProdeco_1 = $XMLQuestionResult['plusNacPosProdeco_1'];
    if ($plusNacPosProdeco_1 == "SI") { $plusNacPosProdecoCal_1 = 25; } else{ $plusNacPosProdecoCal_1 = 0; }
    $plusNacPosProdeco_2 = $XMLQuestionResult['plusNacPosProdeco_2'];
    if ($plusNacPosProdeco_2 == "SI") { $plusNacPosProdecoCal_2 = 15; } else{ $plusNacPosProdecoCal_2 = 0; }
    $plusNacPosProdeco_3 = $XMLQuestionResult['plusNacPosProdeco_3'];
    if ($plusNacPosProdeco_3 == "SI") { $plusNacPosProdecoCal_3 = 10; } else{ $plusNacPosProdecoCal_3 = 0; }
    $plusNacPosProdeco_4 = $XMLQuestionResult['plusNacPosProdeco_4'];
    if ($plusNacPosProdeco_4 == "SI") { $plusNacPosProdecoCal_4 = 15; } else{ $plusNacPosProdecoCal_4 = 0; }

    $Pol_CalidadVal = $XMLQuestionResult['Pol_Calidad'];
    if ( $XMLQuestionResult['Pol_Calidad'] == "Sí") { $Pol_CalidadVal = "APTO"; } else { $Pol_CalidadVal = "NO APTO";}
    $Pol_CalCalidadP = $Pol_CalCalidad;

    if ( $relationAge >= 0 &&
        $customerServiceCal >= 10 &&
        $postSalesServiceCal >= 10
    ) { $referenciaVal = "APTO"; } else { $referenciaVal = "NO APTO";}
    $referenciaCal = $relationAgeCal + $customerServiceCal + $postSalesServiceCal;

    if ($refCIFINCal >= 6) { $refCIFINVal = "APTO"; } else { $refCIFINVal = "NO APTO"; }

    $financieraVal = "APTO";
    $financieraCal = $razonCorrienteCal_0 + $pruebaAcidaCal_0 + $nivelDeEndeudamientoCal_0 + $leverageCal_0 + $margenBrutoCal_0;

    $laboralCal = $totalEmpleadosCal + $rrhhCal_8;
    $PoliticaCal = $Politica_1 + $Politica_2 + $Politica_3 + $Politica_4 + $Politica_5 + $Politica_6 + $Politica_7 + $Politica_8;


    $plusNacNegProdecoCal = $plusNacNegProdecoCal_1 +
        $plusNacNegProdecoCal_2 +
        $plusNacNegProdecoCal_3 +
        $plusNacNegProdecoCal_4 +
        $plusNacNegProdecoCal_5 +
        $plusNacNegProdecoCal_6 +
        $plusNacNegProdecoCal_7 +
        $plusNacNegProdecoCal_8 +
        $plusNacNegProdecoCal_9;

    $plusNacPosProdecoCal = $plusNacPosProdecoCal_1 +
        $plusNacPosProdecoCal_2 +
        $plusNacPosProdecoCal_3 +
        $plusNacPosProdecoCal_4;

    $evalResulCal =
        $yearsOfActivityCal +
        $companySizeByActivesCal +
        $Pol_CalCalidadP +
        $referenciaCal +
        $refCIFINCal +
        $financieraCal +
        $laboralCal +
        $PoliticaCal +
        $plusNacNegProdecoCal +
        $plusNacPosProdecoCal;


//Condicional de seguridad vial

    if (isset($SeguridadVial)){
        $SeguridadVial = $XMLQuestionResult['SecurtyVial'];
    } else{
        $SeguridadVial = "N/A";
    }
//Condicional OEA
   if( $backgroundCheck->getVerificationSection(101)!=null){
       if( isset($XMLQuestionResult['Tipoasociado_1'])){
    switch ($XMLQuestionResult['Tipoasociado_1'] && $XMLQuestionResult['Tipoasociado_2']) {
        case $XMLQuestionResult['Tipoasociado_1'] == 'Sí' && $XMLQuestionResult['Tipoasociado_2'] == 'Sí':
            $TipoAsociadoScore = 150;
            break;
        case $XMLQuestionResult['Tipoasociado_1'] == 'No' && $XMLQuestionResult['Tipoasociado_2'] == 'Sí':
            $TipoAsociadoScore = 150;
            break;
        case $XMLQuestionResult['Tipoasociado_1'] == 'Sí' && $XMLQuestionResult['Tipoasociado_2'] == 'No':
            $TipoAsociadoScore = 90;
            break;
        case $XMLQuestionResult['Tipoasociado_1'] == 'No' && $XMLQuestionResult['Tipoasociado_2'] == 'No':
            $TipoAsociadoScore = 30;
            break;
    }
    switch ($XMLQuestionResult['AccesoInfor_1'] && $XMLQuestionResult['AccesoInfor_2']) {
        case $XMLQuestionResult['AccesoInfor_1'] == 'Sí' && $XMLQuestionResult['AccesoInfor_2'] == 'Sí':
            $AccesoInfoScore = 125;
            break;
        case $XMLQuestionResult['AccesoInfor_1'] == 'No' && $XMLQuestionResult['AccesoInfor_2'] == 'Sí':
            $AccesoInfoScore = 125;
            break;
        case $XMLQuestionResult['AccesoInfor_1'] == 'Sí' && $XMLQuestionResult['AccesoInfor_2'] == 'No':
            $AccesoInfoScore = 25;
            break;
        case $XMLQuestionResult['AccesoInfor_1'] == 'No' && $XMLQuestionResult['AccesoInfor_2'] == 'No':
            $AccesoInfoScore = 125;
            break;
        case $XMLQuestionResult['AccesoInfor_1'] == 'No Aplica' && $XMLQuestionResult['AccesoInfor_2'] == 'Sí':
            $AccesoInfoScore = 125;
            break;
        case $XMLQuestionResult['AccesoInfor_1'] == 'No Aplica' && $XMLQuestionResult['AccesoInfor_2'] == 'No':
            $AccesoInfoScore = 25;
            break;
        case $XMLQuestionResult['AccesoInfor_1'] == 'No Aplica' && $XMLQuestionResult['AccesoInfor_2'] == 'No Aplica':
            $AccesoInfoScore = 25;
            break;
        case $XMLQuestionResult['AccesoInfor_1'] == 'Sí' && $XMLQuestionResult['AccesoInfor_2'] == 'No Aplica':
            $AccesoInfoScore = 25;
            break;
        case $XMLQuestionResult['AccesoInfor_1'] == 'No' && $XMLQuestionResult['AccesoInfor_2'] == 'No Aplica':
            $AccesoInfoScore = 125;
            break;
    }
    switch ($XMLQuestionResult['Trayectoria_1']) {
        case $XMLQuestionResult['Trayectoria_1'] == 'Mas 5 años':
            $TrayectoriaScore = 10;
            break;
        case $XMLQuestionResult['Trayectoria_1'] == 'Entre 1-5 años':
            $TrayectoriaScore = 30;
            break;
        case $XMLQuestionResult['Trayectoria_1'] == 'Menos 1 año':
            $TrayectoriaScore = 50;
            break;
     }
     switch ($XMLQuestionResult['Experiencia_1']) {
        case $XMLQuestionResult['Experiencia_1'] == 'Mas 5 años':
            $ExperienciaScore = 5;
                   break;
        case $XMLQuestionResult['Experiencia_1'] == 'Entre 1-5 años':
            $ExperienciaScore = 15;
                   break;
        case $XMLQuestionResult['Experiencia_1'] == 'Menos 1 año':
            $ExperienciaScore = 25;
                   break;
     }
     switch ($XMLQuestionResult['paraisosFiscales']) {
        case $XMLQuestionResult['paraisosFiscales'] == 'SI':
            $ParaisosFiscScore = 100;
                   break;
        case $XMLQuestionResult['paraisosFiscales'] == 'NO':
            $ParaisosFiscScore = 20;
                   break;
     }
     switch ($XMLQuestionResult['Certificaciones_1'] && $XMLQuestionResult['Certificaciones_2']) {
     case $XMLQuestionResult['Certificaciones_1'] == 'Sí' && $XMLQuestionResult['Certificaciones_2'] == 'Sí':
         $CertificacionesScore = 10;
                   break;
     case $XMLQuestionResult['Certificaciones_1'] == 'No' && $XMLQuestionResult['Certificaciones_2'] == 'Sí':
         $CertificacionesScore = 30;
                   break;
     case $XMLQuestionResult['Certificaciones_1'] == 'Sí' && $XMLQuestionResult['Certificaciones_2'] == 'No':
         $CertificacionesScore = 10;
                   break;
     case $XMLQuestionResult['Certificaciones_1'] == 'No' && $XMLQuestionResult['Certificaciones_2'] == 'No':
         $CertificacionesScore = 50;
                   break;
     }
     $TotalScore = $TipoAsociadoScore + $AccesoInfoScore + $TrayectoriaScore + $ExperienciaScore + $ParaisosFiscScore + $CertificacionesScore;
    if($TotalScore <= 200){
        $resultOEAScore = 'BAJO';
    }elseif ($TotalScore > 200 && $TotalScore <= 300){

        $resultOEAScore = 'MEDIO';
    }else{
        $resultOEAScore = 'ALTO';
    }

    }
   }




    //Creado por Jonathan Modificacion 21-05-20 Natalia Gonzalez

    if ($backgroundCheck->studyStartedOn<'2020-04-02'){

        if($evalResulCal >= 75 && $listasEmpresasResult_SM == "SH"  && $SeguridadVial !="NO"){
            $resultString = "APTO";
        } else{
            $resultString = "NO APTO";
        }
    }
    else{

        if($evalResulCal >= 75 && $listasEmpresasResult == "SH"  && $SeguridadVial !="NO"){
            $resultString = "APTO";
        } else{
            $resultString = "NO APTO";
        }

    }


    $query = "UPDATE ses_BackgroundCheck SET evaluationResult='".$resultString."', evaluationValue='".$evalResulCal."' WHERE  id=".$backgroundCheck->id.";";
    Yii::app()->db->createCommand($query)->execute();
}
