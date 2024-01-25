<?php
    
    if (isset($prodecoNacPlus)) {
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
        
        $sgssst_1 = $XMLQuestionResult['sgssst_1'];
        if ($sgssst_1 == "SI" || $sgssst_1== "N/A") { $sgssstCal_1 = 4; } else{ $sgssstCal_1 = 0; }
        
        $sgssst_8 = $XMLQuestionResult['sgssst_8'];
        if ($sgssst_8 == "SI" || $sgssst_8== "N/A") { $sgssstCal_8 = 3; } else{ $sgssstCal_8 = 0; }
        
        $sgssst_2 = $XMLQuestionResult['sgssst_2'];
        if ($sgssst_2 == "SI" || $sgssst_2== "N/A") { $sgssstCal_2 = 3; } else{ $sgssstCal_2 = 0; }

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


        if ( $XMLQuestionResult['certification_1'] == "Sí" &&
            $XMLQuestionResult['certification_2'] == "Sí" &&
            $XMLQuestionResult['certification_3'] == "Sí" &&
            $XMLQuestionResult['certification_6'] == "Sí"
        ) { $certificationVal = "APTO"; } else { $certificationVal = "NO APTO";}
        
        $certificationCal = $certificationCal_1 +$certificationCal_2 + $certificationCal_3 + $certificationCal_6;

        if ( $relationAge >= 0 &&
            $customerServiceCal >= 10 &&
            $postSalesServiceCal >= 10
        ) { $referenciaVal = "APTO"; } else { $referenciaVal = "NO APTO";}
        $referenciaCal = $relationAgeCal + $customerServiceCal + $postSalesServiceCal;

        if ($refCIFINCal >= 6) { $refCIFINVal = "APTO"; } else { $refCIFINVal = "NO APTO"; }

        $financieraVal = "APTO";
        $financieraCal = $razonCorrienteCal_0 + $pruebaAcidaCal_0 + $nivelDeEndeudamientoCal_0 + $leverageCal_0 + $margenBrutoCal_0;
    
        $laboralCal = $totalEmpleadosCal + $rrhhCal_8;
        $seguridadCal = $sgssstCal_1 + $sgssstCal_8 + $sgssstCal_2;


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
        $certificationCal +
        $referenciaCal + 
        $refCIFINCal + 
        $financieraCal + 
        $laboralCal + 
        $seguridadCal + 
        $plusNacNegProdecoCal +
        $plusNacPosProdecoCal;

        //Creado por Jonathan Modificacion 21-05-20 Natalia Gonzalez

      if ($backgroundCheck->studyStartedOn<'2020-04-02'){

        if($evalResulCal >= 75 && $listasEmpresasResult_SM == "SH" ){
            $resultString = "APTO";
        } else{
            $resultString = "NO APTO";
        }
      }
      else{

          if($evalResulCal >= 75 && $listasEmpresasResult == "SH" ){
              $resultString = "APTO";
          } else{
              $resultString = "NO APTO";
          }

      }


        $query = "UPDATE ses_BackgroundCheck SET evaluationResult='".$resultString."', evaluationValue='".$evalResulCal."' WHERE  id=".$backgroundCheck->id.";";
        Yii::app()->db->createCommand($query)->execute();
    }