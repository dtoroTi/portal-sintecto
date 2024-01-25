<?php
    if (isset($prodecoIntPlus)) {
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
        
        $customerService = round(divideNumbers($customerServiceADD, $i));
        $postSalesService = round(divideNumbers($postSalesServiceADD, $ii));


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


        if ($backgroundCheck->yearsOfActivity >= 0 && $backgroundCheck->yearsOfActivity <= 3) {
            $yearsOfActivityCal = 3;
        } else if ($backgroundCheck->yearsOfActivity >= 4 && $backgroundCheck->yearsOfActivity <= 8) {
            $yearsOfActivityCal = 4;
        } else if ($backgroundCheck->yearsOfActivity >= 9) {
            $yearsOfActivityCal = 5;
        }

        
        if ($XMLQuestionResult['certification_1'] == "No" || $XMLQuestionResult['certification_1'] == "N/R") {
            $certificationCal_1 = 0;
        } else {
            $certificationCal_1 = 1;
        }

        if ($XMLQuestionResult['certification_2'] == "No" || $XMLQuestionResult['certification_2'] == "N/R") {
            $certificationCal_2 = 0;
        } else {
            $certificationCal_2 = 1;
        }

        if ($XMLQuestionResult['certification_3'] == "No" || $XMLQuestionResult['certification_3'] == "N/R") {
            $certificationCal_3 = 0;
        } else {
            $certificationCal_3 = 1;
        }

        if ($XMLQuestionResult['certification_6'] == "No" || $XMLQuestionResult['certification_6'] == "N/R") {
            $certificationCal_6 = 0;
        } else {
            $certificationCal_6 = 1;
        }

        if ( $XMLQuestionResult['certification_1'] == "Sí" &&
            $XMLQuestionResult['certification_2'] == "Sí" &&
            $XMLQuestionResult['certification_3'] == "Sí" &&
            $XMLQuestionResult['certification_6'] == "Sí"
        ) { $certificationVal = "APTO"; } else { $certificationVal = "NO APTO";}
        $certificationCal = $certificationCal_1 +$certificationCal_2 + $certificationCal_3 + $certificationCal_6;

        
        if ($relationAge < 1) {
            $relationAgeCal = 9;
        } else if ($relationAge >= 1 && $relationAge <= 2) {
            $relationAgeCal = 11;
        } else if ($relationAge >= 3 && $relationAge <= 7) {
            $relationAgeCal = 12;
        } else if ($relationAge >= 7) {
            $relationAgeCal = 14;
        }
        
        if ( $relationAge >= 0 &&
        $customerServiceCal >= 10 &&
            $postSalesServiceCal >= 10
        ) { $referenciaVal = "APTO"; } else { $referenciaVal = "NO APTO";}
        $referenciaCal = $relationAgeCal + $customerServiceCal + $postSalesServiceCal;
        

        if ($razonCorriente_0 >= 1.5) {
            $razonCorrienteCal_0 = 7.5;
        } else if ($razonCorriente_0 >= 0.9 && $razonCorriente_0 < 1.5) {
            $razonCorrienteCal_0 = 3.75;
        } else if ($razonCorriente_0 < 0.9) {
            $razonCorrienteCal_0 = 1.25;
        }
        
        if ($pruebaAcida_0 >= 1.1) {
            $pruebaAcidaCal_0 = 1.8;
        } else if ($pruebaAcida_0 >= 0.8 && $pruebaAcida_0 < 1.1) {
            $pruebaAcidaCal_0 = 1.25;
        } else if ($pruebaAcida_0 < 0.9) {
            $pruebaAcidaCal_0 = 0.5;
        }
        
        if ($nivelDeEndeudamiento_0 <= 0.3) {
            $nivelDeEndeudamientoCal_0 = 7.5;
        } else if ($nivelDeEndeudamiento_0 <= 0.6 && $nivelDeEndeudamiento_0 > .3) {
            $nivelDeEndeudamientoCal_0 = 3.75;
        } else if ($nivelDeEndeudamiento_0 > .6) {
            $nivelDeEndeudamientoCal_0 = 1.25;
        }
        
        
        if ($leverage_0 >= 4) {
            $leverageCal_0 = 1.25;
        } else if ($leverage_0 >= 2 && $leverage_0 < 4) {
            $leverageCal_0 = 2.5;
        } else if ($leverage_0 < 2) {
            $leverageCal_0 = 5;
        }
        
        if ($margenBruto_0 >= 0.5) {
            $margenBrutoCal_0 = 2.5;
        } else if ($margenBruto_0 >= 0.3 && $margenBruto_0 < 0.5) {
            $margenBrutoCal_0 = 2.5;
        } else if ($margenBruto_0 < 0.3) {
            $margenBrutoCal_0 = 1.25;
        }
        
        if ($totalEmpleados <= 10) {
            $totalEmpleadosCal = 7;
        } else if ($totalEmpleados >= 11 && $totalEmpleados < 50) {
            $totalEmpleadosCal = 8;
        } else if ($totalEmpleados >= 51 && $totalEmpleados < 200) {
            $totalEmpleadosCal = 9;
        } else if ($totalEmpleados > 200) {
            $totalEmpleadosCal = 10;
        }

        $financieraVal = "APTO";
        $financieraCal = $razonCorrienteCal_0 + $pruebaAcidaCal_0 + $nivelDeEndeudamientoCal_0 + $leverageCal_0 + $margenBrutoCal_0;
        
  
        $laboralCal = $totalEmpleadosCal ;
        
        $sgssst_1 = $XMLQuestionResult['sgssst_1'];
        if ($sgssst_1 == "SI" || $sgssst_1== "N/A") { $sgssstCal_1 = 4; } else{ $sgssstCal_1 = 0; }
        $certification_12 = $XMLQuestionResult['certification_12'];
        if ($certification_12 == "Sí" || $certification_12== "N/A") { $sgssstCal_7 = 3; } else{ $sgssstCal_7 = 0; }
        $sgssst_8 = $XMLQuestionResult['sgssst_8'];
        if ($sgssst_8 == "SI" || $sgssst_8== "N/A") { $sgssstCal_8 = 3; } else{ $sgssstCal_8 = 0; }
        $seguridadCal = $sgssstCal_1 + $sgssstCal_8 + $sgssstCal_7;
        
        $plusIntNegProdeco_1 = $XMLQuestionResult['plusIntNegProdeco_1'];
        if ($plusIntNegProdeco_1 == "SI") { $plusIntNegProdecoCal_1 = -100; } else{ $plusIntNegProdecoCal_1 = 0; }
        $plusIntNegProdeco_2 = $XMLQuestionResult['plusIntNegProdeco_2'];
        if ($plusIntNegProdeco_2 == "SI") { $plusIntNegProdecoCal_2 = -100; } else{ $plusIntNegProdecoCal_2 = 0; }
        $plusIntNegProdeco_3 = $XMLQuestionResult['plusIntNegProdeco_3'];
        if ($plusIntNegProdeco_3 == "SI") { $plusIntNegProdecoCal_3 = -20; } else{ $plusIntNegProdecoCal_3 = 0; }
        
        

        $plusIntPosProdeco_1 = $XMLQuestionResult['plusIntPosProdeco_1'];
        if ($plusIntPosProdeco_1 == "SI") { $plusIntPosProdecoCal_1 = 10; } else{ $plusIntPosProdecoCal_1 = 0; }
        $plusIntPosProdeco_2 = $XMLQuestionResult['plusIntPosProdeco_2'];
        if ($plusIntPosProdeco_2 == "SI") { $plusIntPosProdecoCal_2 = 15; } else{ $plusIntPosProdecoCal_2 = 0; }
        
        $plusIntNegProdecoCal = $plusIntNegProdecoCal_1 + $plusIntNegProdecoCal_2 + $plusIntNegProdecoCal_3 ;
        $plusIntPosProdecoCal = $plusIntPosProdecoCal_1 + $plusIntPosProdecoCal_2;
        
        
        $evalResulCal = 
        $yearsOfActivityCal + 
        $certificationCal +
        $referenciaCal + 
        $financieraCal + 
        $laboralCal + 
        $seguridadCal + 
        $plusIntNegProdecoCal +
        $plusIntPosProdecoCal;


        //Creado por Jonathan Modificacion 21-05-20 Natalia Gonzalez
        if ($backgroundCheck->studyStartedOn<'2020-04-02'){

            if($evalResulCal >= 71  && $listasEmpresasResult_SM == "SH" && $listasSociosResult == "SH" ){
                $resultString = "APTO";
            } else{
                $resultString = "NO APTO";
            }
        }
        else{

            if($evalResulCal >= 71  && $listasEmpresasResult == "SH" && $listasSociosResult == "SH" ){
                $resultString = "APTO";
            } else{
                $resultString = "NO APTO";
            }

        }


       /* if($evalResulCal >= 71  && $listasEmpresasResult_SM == "SH" && $listasSociosResult == "SH" ){
            $resultString = "APTO";
        } else{
            $resultString = "NO APTO";
        }
        */
        $query = "UPDATE ses_BackgroundCheck SET evaluationResult='".$resultString."', evaluationValue='".$evalResulCal."' WHERE  id=".$backgroundCheck->id.";";
        Yii::app()->db->createCommand($query)->execute();
        /*
        */
    }