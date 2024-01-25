<?php

$portrait = $backgroundCheck->frontPageImage;
$pdf->SetLeftMargin(25);

    $pdf->pushFont();
    $pdf->AddPage();
    $pdf->SetY(25);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    
    $pdf->MultiCell(170, 0, "DATOS DE LA COMPAÑÍA"  , 1, 'C', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(230,230,230);
    $pdf->MultiCell(170, 0, "Razón Social:"  , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(170, 0, $backgroundCheck->lastName  , 1, 'L', 0, 1, '', '', true);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(230,230,230);
    $pdf->MultiCell(30, 0, "Nit/CC: "  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(30, 0, $backgroundCheck->idNumber  , 1, 'L', 0, 0, '', '', true);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(230,230,230);
    $pdf->MultiCell(45, 0, "Dígito de Verificación: "  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(20, 0, $backgroundCheck->codVerification  , 1, 'L', 0, 0, '', '', true);
    $pdf->MultiCell(25, 0, "CIIU: "  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(20, 0, $backgroundCheck->ciiu  , 1, 'L', 0, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    
    if($backgroundCheck->descriptionCiiu != ""){
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(230,230,230);
        $pdf->MultiCell(170, 0, "Descripción CIIU:"  , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(170, 0, $backgroundCheck->descriptionCiiu , 1, 'L', 0, 0, '', '', true);
        $pdf->Cell('', '', '', '', 1, 'L');
    }
    
    if(isset($backgroundCheck->originCountry)){
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(230,230,230);
        $pdf->MultiCell(40, 0, "País de Origen:"  , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(130, 0, $backgroundCheck->originCountry  , 1, 'L', 0, 0, '', '', true);
        $pdf->Cell('', '', '', '', 1, 'L');
    }

    if($backgroundCheck->address != "" || $backgroundCheck->area != ""){

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(230,230,230);
        $pdf->MultiCell(170, 0, "Dirección Principal:"  , 1, 'L', 1, 1, '', '', true);
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(170, 0, $backgroundCheck->address ." " . $backgroundCheck->area  , 1, 'L', 0, 1, '', '', true);
    }

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(230,230,230);
    $pdf->MultiCell(45, 0, "Departamento: "  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(40, 0, $backgroundCheck->state  , 1, 'L', 0, 0, '', '', true);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(230,230,230);
    $pdf->MultiCell(40, 0, "Teléfono: "  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(45, 0, $backgroundCheck->tels  , 1, 'L', 0, 0, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');

    if ($backgroundCheck->webPage != "") {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(230,230,230);
        $pdf->MultiCell(45, 0, "Sitio Web: "  , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetFillColor(255,255,255);
        $pdf->MultiCell(125, 0, $backgroundCheck->webPage  , 1, 'L', 0, 1, '', '', true);
    }
    
    if ($backgroundCheck->email != "") {    
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(230,230,230);
        $pdf->MultiCell(45, 0, "E-mail: "  , 1, 'L', 1, 0, '', '', true);
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(125, 0, $backgroundCheck->email  , 1, 'L', 0, 1, '', '', true);
    }
    
    if($backgroundCheck->shareholderType == 0){
        $shareholderType = "Privada";
    } else if($backgroundCheck->shareholderType == 1){
        $shareholderType = "Pública";
    } else {
        $shareholderType = "Mixta";
    }

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(230,230,230);
    $pdf->MultiCell(45, 0, "Tipo de Sociedad:"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(125, 0, $shareholderType , 1, 'L', 0, 1, '', '', true);
//JONATHAN AGREGADA

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(230,230,230);
    $pdf->MultiCell(45, 0, "Origen del Proveedor:"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(125, 0, $backgroundCheck->SupplierOrigin  , 1, 'L', 0, 1, '', '', true);


    
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(45, 0, "Tipo de Evaluación:"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(125, 0, $backgroundCheck->customerProduct->name , 1, 'L', 0, 1, '', '', true);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(45, 0, "Código de Evaluación:"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(125, 0, $backgroundCheck->code , 1, 'L', 0, 1, '', '', true);
    
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(45, 0, "Fecha de Informe:"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(125, 0, $backgroundCheck->approvedOn , 1, 'L', 0, 1, '', '', true);
    
    
    $query = 'SELECT expirationInterval FROM ses_CustomerProduct cp WHERE id = "'.$backgroundCheck->customerProduct->id.'"';
    $query = Yii::app()->db->createCommand($query)->queryAll();

    if($backgroundCheck->approvedOn != 0 || $backgroundCheck->approvedOn != ""){
        if ($query[0]['expirationInterval'] == "P3M" ) {
            $fechaVencimiento = strtotime ( '+3 month' , strtotime ( $backgroundCheck->approvedOn ) ) ;
            $fechaVencimiento = date('Y-m-d', $fechaVencimiento);
        } else if ($query[0]['expirationInterval'] == "P6M" ) {
            $fechaVencimiento = strtotime ( '+6 month' , strtotime ( $backgroundCheck->approvedOn ) ) ;
            $fechaVencimiento = date('Y-m-d', $fechaVencimiento);
        } else if ($query[0]['expirationInterval'] == "P1Y" ) {
            $fechaVencimiento = strtotime ( '+1 year' , strtotime ( $backgroundCheck->approvedOn ) ) ;
            $fechaVencimiento = date('Y-m-d', $fechaVencimiento);
        } else if ($query[0]['expirationInterval'] == "P2Y" ) {
            $fechaVencimiento = strtotime ( '+2 year' , strtotime ( $backgroundCheck->approvedOn ) ) ;
            $fechaVencimiento = date('Y-m-d', $fechaVencimiento);
        } else if ($query[0]['expirationInterval'] == "P3Y" ) {
            $fechaVencimiento = strtotime ( '+3 year' , strtotime ( $backgroundCheck->approvedOn ) ) ;
            $fechaVencimiento = date('Y-m-d', $fechaVencimiento);
        } else{
            $fechaVencimiento = "" ;
        }
    } else{
        $fechaVencimiento = "" ;
    }
    
    $query = "UPDATE ses_BackgroundCheck SET expireIn='".$fechaVencimiento."' WHERE  code='".$backgroundCheck->code."';";
    $query = Yii::app()->db->createCommand($query)->execute();

    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(45, 0, "Fecha de Vencimiento:"  , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(125, 0, $fechaVencimiento , 1, 'L', 0, 1, '', '', true);

    $pdf->Cell(10, '', '', '', 1, 'L'); $pdf->Cell(10, '', '', '', 1, 'L');
    // ESTUDIOS ESPECIALES
    $customBackgroundCheck = array(
        '2673', // PRODECO NAC BÁSICO
        '3354', // PRODECO NAC BÁSICO.
        '2674', // PRODECO INT BÁSICO
        '2675', // PRODECO VAL REPUTACIONAL
        '2718', // PRODECO VAL REPUTACIONAL CON SOCIOS
        '2679', // PRODECO NAC PLUS
        '3353', // PRODECO NAC PLUS.
        '2681', // PRODECO INT PLUS
        '2632', // COLPENSIONES ASIGNACIÓN DE CÓDIGO INTERNO
        '2646', // COLPENSIONES CONMUTACION DE APORTANTES
        '3157', // COLPENSIONES ASIGNACIÓN DE CÓDIGO INTERNO COMPLETO
        '3096', // COLPENSIONES ASIGNACIÓN DE CÓDIGO INTERNO PARCIAL
        '3159', // COLPENSIONES ASIGNACIÓN DE CÓDIGO INTERNO ENTREVISTA VIRTUAL
        '2680', // UNIANDES
        '2697', // CLARO PROVEEDORES NACIONALES
        '2698', // CLARO PROVEEDORES INTERNACIONALES
        '2745', // CLARO SARGLAFT
        '2746', // CLARO PREDIOS
    );

    if (in_array( $backgroundCheck->customerProduct->id, $customBackgroundCheck)) {

        include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/evalProductsId.php');
        include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/functions.php');
        include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/calculations.php');
        include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/verificationSectionsContents.php');

        // PRODECO NAC BÁSICO
        if ($backgroundCheck->customerProductId == 2673 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_prodeco/_pdfProdecoNacBasic.php');
        }

        // PRODECO NAC BÁSICO.
        if ($backgroundCheck->customerProductId == 3354 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_prodeco/_pdfProdecoNacBasic2.php');
        }
        // PRODECO INT BÁSICO
        if ($backgroundCheck->customerProductId == 2674 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_prodeco/_pdfProdecoIntBasic.php');
        }
        // PRODECO NAC PLUS
        if ($backgroundCheck->customerProductId == 2679 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_prodeco/_pdfProdecoNacPlus.php');
        }
        // PRODECO NAC PLUS.
        if ($backgroundCheck->customerProductId == 3353 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_prodeco/_pdfProdecoNacPlus2.php');
        }
        // PRODECO INT PLUS
        if ($backgroundCheck->customerProductId == 2681 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_prodeco/_pdfProdecoIntPlus.php');
        }
        // PRODECO VAL REPUTACIONAL
        if ($backgroundCheck->customerProductId == 2675 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_prodeco/_pdfProdecoValidacionReputacional.php');
        }
        // PRODECO VAL REPUTACIONAL CON ASOCIADOS
        if ($backgroundCheck->customerProductId == 2718 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_prodeco/_pdfProdecoValidacionReputacionalAsociados.php');
        }
        // COLPENSIONES ASIGNACIÓN DE CÓDIGO INTERNO
        if ($backgroundCheck->customerProductId == 2632 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_colpensiones/_pdfColpensionesAsignacionCodigo.php');
        }
        // COLPENSIONES ASIGNACIÓN DE CÓDIGO INTERNO DESCUENTO COMPLETO
        if ($backgroundCheck->customerProductId == 3157 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_colpensiones/_pdfColpensionesAsignacionCodigo.php');
        }
        // COLPENSIONES ASIGNACIÓN DE CÓDIGO INTERNO DESCUENTO PARCIAL
        if ($backgroundCheck->customerProductId == 3096 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_colpensiones/_pdfColpensionesAsignacionCodigo.php');
        }
        // COLPENSIONES ASIGNACIÓN DE CÓDIGO INTERNO DESCUENTO VIRTUAL
        if ($backgroundCheck->customerProductId == 3159 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_colpensiones/_pdfColpensionesAsignacionCodigo.php');
        }
        // COLPENSIONES CONMUTACION DE APORTANTES
        if ($backgroundCheck->customerProductId == 2646 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_colpensiones/_pdfColpensionesConmutacionAportantes.php');
        }
        // UNIANDES
        if ($backgroundCheck->customerProductId == 2680 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_uniandes/_pdfUnidandes.php');
        }
        // CLARO PROVEEDORES NACIONALES
        if ($backgroundCheck->customerProductId == 2697 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorNacional.php');
        }
        // CLARO PROVEEDORES INTERNACIONALES
        if ($backgroundCheck->customerProductId == 2698 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorInternacional.php');
        }
        // CLARO SARGLAFT
        if ($backgroundCheck->customerProductId == 2745 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfSARGLAFT.php');
        }
        // CLARO PREDIOS
        if ($backgroundCheck->customerProductId == 2746 ) {
            include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfPredios.php');
        }

    }


    else {
         //CUADROS DE CONCEPTOS
        //Jonathan Peña & Natalia Henao 02/08/2021
        //Reestructuración del Codigo para las secciones que tienen SH, CH y CHM del estudio.
        /* @var $verificationSection VerificationSection */
        $verificationSections=$backgroundCheck->verificationSections;
        foreach ($verificationSections as $verificationSection) {

            $link=$pdf->AddLink();

            $pdf->SetX(70);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(45, '', $verificationSection->sectionNick, 1, 0, 'C', true, $link);
            //$pdf->MultiCell(45, 0, $verificationSection->sectionNick  , 1, 'C', 1, 0, '', '', true);
            $pdf->SetFillColor(255,255,255);

            $nick1=$verificationSection->result?$verificationSection->result->nick:"";
            switch ($nick1) {
                case 'SH':
                    $pdf->SetTextColor(0,152,0);
                    break;
                case 'CH':
                    $pdf->SetTextColor(255,0,0);
                    break;
                case 'CHM':
                    $pdf->SetTextColor(255,128,0);
                    break; 
            }
            
            $pdf->MultiCell(45, 0,  ($verificationSection->result?$verificationSection->result->nick:"")  , 1, 'C', 1, 1, '', '', true);

            $posY=$pdf->GetY($verificationSection->verificationSectionType->id);
            $pageP=$pdf->PageNo($verificationSection->verificationSectionType->id);
            $pdf->SetLink($link,  $y=$posY, $page=$pageP);

            $pdf->Cell('', 2, '', '', 1, 'L');
        }

    $pdf->Cell(10, '', '', '', 1, 'L');

    //Jonathan Peña, Natalia Henao 30/07/2021
    $query_A = 'SELECT vs.verificationSectionTypeId, xl.answer FROM ses_XmlSection xl
    INNER JOIN ses_VerificationSection vs ON xl.verificationSectionId = vs.id
    WHERE backgroundCheckId = "'.$backgroundCheck->id.'"
    AND xl.answer != ""
    ORDER BY vs.verificationSectionTypeId ASC;';
    $query = Yii::app()->db->createCommand($query_A)->queryAll();

    $XMLQuestionResult = array();
    foreach($query as $answer){
        $result =  unserialize($answer['answer']) ;
        $XMLQuestionResult = array_merge($XMLQuestionResult, $result);
    }

    if($backgroundCheck->customerId==777){
        
        if ($backgroundCheck->getVerificationSection(107) != null){
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->MultiCell(35, 0, "Riesgo"  , 1, 'L', 1, 0, '', '', true);

            if(isset($XMLQuestionResult['sectionImpact_1'])){
                for($i=1;$i<=5;$i++){
                    if($XMLQuestionResult['sectionImpact_'.$i] == "MEDIO" || $XMLQuestionResult['sectionImpact_'.$i] == "ALTO"){

                        switch ($i) {
                            case '1':
                                $riesgo="Judicial";
                                break;
                            case '2':
                                $riesgo="SAGRILAFT";
                                break;
                            case '3':
                                $riesgo="Financiero";
                                break;
                            case '4':
                                $riesgo="Reputacional";
                                break;
                            case '5':
                                $riesgo="Legal";
                                break;
                        }
                        $pdf->SetFont('Arial', 'B', 10); $pdf->SetTextColor(0,0,0);
                        $pdf->MultiCell(26, 0, $riesgo, 1, 'C', 0, 0, '', '', true);
                    }
                }
           
                $pdf->Cell(10, '', '', '', 1, 'L');
                $pdf->MultiCell(35, 0, " ", 0, 'L', 0, 0, '', '', true);
                for($i=1;$i<=5;$i++){
                    if($XMLQuestionResult['sectionImpact_'.$i] == "MEDIO" || $XMLQuestionResult['sectionImpact_'.$i] == "ALTO"){
                        $concept=$XMLQuestionResult['sectionImpact_'.$i];
                        switch ($concept) {
                            case 'ALTO':
                                $pdf->SetTextColor(255,0,0);
                                break;
                            case 'MEDIO':
                                $pdf->SetTextColor(255,128,0);
                                break; 
                        }
                        $pdf->SetFont('Arial', 'B', 10); 
                        $pdf->MultiCell(26, 0, $XMLQuestionResult['sectionImpact_'.$i] , 1, 'C', 0, 0, '', '', true);
                    }
                }
            }
        }
    }
        /*$pdf->SetFont('Arial', 'B', 10);

        if ($backgroundCheck->getVerificationSection(17) != null){

            $pdf->SetX(70);

            $resultValVisitaEmpresa = $backgroundCheck->getVerificationSection(17)->resultId;

            if(
                $resultValVisitaEmpresa == 2
            ){
                $resultComercial = "SH";
                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(45, 0, "VISITA"  , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0,152,0);
                $pdf->MultiCell(45, 0, $resultComercial  , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');


            } elseif (
                $resultValVisitaEmpresa == 3
            ){

                $resultComercial = "CH";
                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(45, 0, "VISITA"  , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(255,0,0);
                $pdf->MultiCell(45, 0, $resultComercial  , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');

            }
            elseif  (
                $resultValVisitaEmpresa == 4
            ){
                $resultComercial = "HM";
                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(45, 0, "VISITA"  , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(255,128,0);
                $pdf->MultiCell(45, 0, $resultComercial  , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');
            }
            else {
            }
        };

        if($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS) != null) {

            $pdf->SetX(70);

            /*
           if($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE) != null)

           {


           $resultfinan = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE)->resultId;
            if (
                $resultfinan == 2
            ) {
                $resultfianancial = "SH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "FINANCIERO", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(0, 152, 0);
                $pdf->MultiCell(45, 0, $resultfianancial, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');


            } elseif (
                $resultfinan == 3
            ) {

                $resultfianancial = "CH";
                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "FINANCIERO", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 0, 0);
                $pdf->MultiCell(45, 0, $resultfianancial, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');
            } elseif (
                $resultfinan == 4
            ) {
                $resultfianancial = "HM";
                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "FINANCIERO", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 128, 0);
                $pdf->MultiCell(45, 0, $resultfianancial, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');
            } else {

            }
        }
            */

        /*};

        if ($backgroundCheck->getVerificationSection(15) != null) {

            $pdf->SetX(70);

            $resultSocios = $backgroundCheck->getVerificationSection(15)->resultId;
            if(
                $resultSocios == 2
            ){
                $resultSociosYrep = "SH";

                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(45, 0, "SOCIOS Y RP"  , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0,152,0);
                $pdf->MultiCell(45, 0, $resultSociosYrep  , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');;


            } elseif (
                $resultSocios == 3
            ){

                $resultSociosYrep = "CH";

                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(45, 0, "SOCIOS Y RP"  , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(255,0,0);
                $pdf->MultiCell(45, 0, $resultSociosYrep  , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');
            }
            elseif  (
                $resultSocios == 4
            ){
                $resultSociosYrep = "HM";

                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(45, 0, "SOCIOS Y RP"  , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(255,128,0);
                $pdf->MultiCell(45, 0, $resultSociosYrep  , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');
            }
            else {

            }
        };

        if ($backgroundCheck->getVerificationSection(13) != null) {

            $pdf->SetX(70);

            $resultrefcomerc = $backgroundCheck->getVerificationSection(13)->resultId;
            if(
                $resultrefcomerc == 2
            ){
                $resultrcomerc = "SH";

                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(45, 0, "REF COMERCIALES"  , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0,152,0);
                $pdf->MultiCell(45, 0, $resultrcomerc  , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');


            } elseif (
                $resultrefcomerc == 3
            ){

                $resultrcomerc = "CH";

                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(45, 0, "REF COMERCIALES"  , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(255,0,0);
                $pdf->MultiCell(45, 0, $resultrcomerc  , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');

            }
            elseif  (
                $resultrefcomerc == 4
            ){
                $resultrcomerc = "HM";

                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(45, 0, "REF COMERCIALES"  , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(255,128,0);
                $pdf->MultiCell(45, 0, $resultrcomerc  , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');
            }
            else {

            }
        };

        if ($backgroundCheck->getVerificationSection(18) != null) {

            $pdf->SetX(70);

            $resultemple = $backgroundCheck->getVerificationSection(18)->resultId;
            if(
                $resultemple == 2
            ){
                $resultEmpleados = "SH";

                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(45, 0, "RRHH"  , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0,152,0);
                $pdf->MultiCell(45, 0, $resultEmpleados  , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');


            } elseif (
                $resultemple == 3
            ){

                $resultEmpleados = "CH";

                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(45, 0, "RRHH"  , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(255,0,0);
                $pdf->MultiCell(45, 0, $resultEmpleados  , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');

            }
            elseif  (
                $resultemple == 4
            ){
                $resultEmpleados = "HM";

                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(45, 0, "RRHH"  , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(255,128,0);
                $pdf->MultiCell(45, 0, $resultEmpleados  , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');
            }
            else {

            }

        };
        if ($backgroundCheck->getVerificationSection(50) != null) {

            $pdf->SetX(70);

            $resultAnlfinan = $backgroundCheck->getVerificationSection(50)->resultId;
            if (
                $resultAnlfinan == 2
            ) {
                $resultanalisisfin = "SH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "A.FINANCIERO", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(0, 152, 0);
                $pdf->MultiCell(45, 0, $resultanalisisfin, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');


            } elseif (
                $resultAnlfinan == 3
            ) {

                $resultanalisisfin = "CH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "A.FINANCIERO", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 0, 0);
                $pdf->MultiCell(45, 0, $resultanalisisfin, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');

            } elseif (
                $resultAnlfinan == 4
            ) {
                $resultanalisisfin = "HM";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "A.FINANCIERO", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 128, 0);
                $pdf->MultiCell(45, 0, $resultanalisisfin, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');
            } else {

            }
        };
        if ($backgroundCheck->getVerificationSection(83) != null) {

            $pdf->SetX(70);

            $resultAbasc = $backgroundCheck->getVerificationSection(83)->resultId;
            if (
                $resultAbasc == 2
            ) {
                $resultanabasc = "SH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "S.G SEGURIDAD", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(0, 152, 0);
                $pdf->MultiCell(45, 0, $resultanabasc, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');


            } elseif (
                $resultAbasc == 3
            ) {

                $resultanabasc = "CH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "S.G SEGURIDAD", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 0, 0);
                $pdf->MultiCell(45, 0, $resultanabasc, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');

            } elseif (
                $resultAbasc == 4
            ) {
                $resultanabasc = "HM";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "S.G SEGURIDAD", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 128, 0);
                $pdf->MultiCell(45, 0, $resultanabasc, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');
            } else {

            }
        };

        if ($backgroundCheck->getVerificationSection(24) != null) {

            $pdf->SetX(70);

            $resultListRest = $backgroundCheck->getVerificationSection(24)->resultId;
            if (
                $resultListRest == 2
            ) {
                $resultlistasrestric = "SH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "L.RESTRIC", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(0, 152, 0);
                $pdf->MultiCell(45, 0, $resultlistasrestric, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');


            } elseif (
                $resultListRest == 3
            ) {

                $resultlistasrestric = "CH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "L.RESTRIC", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 0, 0);
                $pdf->MultiCell(45, 0, $resultlistasrestric, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');

            } elseif (
                $resultListRest == 4
            ) {
                $resultlistasrestric = "HM";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "L.RESTRIC", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 128, 0);
                $pdf->MultiCell(45, 0, $resultlistasrestric, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');
            } else {

            }
        };

        if ($backgroundCheck->getVerificationSection(16) != null) {

            $pdf->SetX(70);

            $resultCentriesg = $backgroundCheck->getVerificationSection(16)->resultId;
            if (
                $resultCentriesg == 2
            ) {
                $resultcentralriesgo = "SH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "C.RIESGO", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(0, 152, 0);
                $pdf->MultiCell(45, 0, $resultcentralriesgo, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');


            } elseif (
                $resultCentriesg == 3
            ) {

                $resultcentralriesgo = "CH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "C.RIESGO", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 0, 0);
                $pdf->MultiCell(45, 0, $resultcentralriesgo, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');

            } elseif (
                $resultCentriesg == 4
            ) {
                $resultcentralriesgo = "HM";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "C.RIESGO", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 128, 0);
                $pdf->MultiCell(45, 0, $resultcentralriesgo, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');
            } else {

            }
        };

        if ($backgroundCheck->getVerificationSection(87) != null) {

            $pdf->SetX(70);

            $ssgtvanti = $backgroundCheck->getVerificationSection(87)->resultId;
            if (
                $ssgtvanti == 2
            ) {
                $ssgtvantiresult = "SH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "SG-SST", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(0, 152, 0);
                $pdf->MultiCell(45, 0, $ssgtvantiresult, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');


            } elseif (
                $ssgtvanti == 3
            ) {

                $ssgtvantiresult = "CH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "SG-SST", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 0, 0);
                $pdf->MultiCell(45, 0, $ssgtvantiresult, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');

            } elseif (
                $ssgtvanti == 4
            ) {
                $ssgtvantiresult = "HM";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "SG-SST", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 128, 0);
                $pdf->MultiCell(45, 0, $ssgtvantiresult, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');
            } else {

            }
        };

          if ($backgroundCheck->getVerificationSection(33) != null) {

            $pdf->SetX(70);

            $visitaOcular = $backgroundCheck->getVerificationSection(33)->resultId;
            if (
                $visitaOcular == 2
            ) {
                $visitaOcularresult = "SH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "V.OCULAR", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(0, 152, 0);
                $pdf->MultiCell(45, 0, $visitaOcularresult, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');


            } elseif (
                $visitaOcular == 3
            ) {

                $visitaOcularresult = "CH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "V.OCULAR", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 0, 0);
                $pdf->MultiCell(45, 0, $visitaOcularresult, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');

            } elseif (
                $visitaOcular == 4
            ) {
                $visitaOcularresult = "HM";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "V.OCULAR", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 128, 0);
                $pdf->MultiCell(45, 0, $visitaOcularresult, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');
            } else {

            }
        }

        if ($backgroundCheck->getVerificationSection(107) != null) {

            $pdf->SetX(70);

            $EvalRiesgo = $backgroundCheck->getVerificationSection(107)->resultId;
            if (
                $EvalRiesgo == 2
            ) {
                $EvalRiesgoresult = "SH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "E.RIESGOS", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(0, 152, 0);
                $pdf->MultiCell(45, 0, $EvalRiesgoresult, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');


            } elseif (
                $EvalRiesgo == 3
            ) {

                $EvalRiesgoresult = "CH";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "E.RIESGOS", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 0, 0);
                $pdf->MultiCell(45, 0, $EvalRiesgoresult, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');

            } elseif (
                $EvalRiesgo == 4
            ) {
                $EvalRiesgoresult = "HM";

                $pdf->SetFillColor(0, 66, 109);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->MultiCell(45, 0, "E.RIESGOS", 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 128, 0);
                $pdf->MultiCell(45, 0, $EvalRiesgoresult, 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', 2, '', '', 1, 'L');
            } else {

            }
        }*/

        $pdf->SetTextColor(0,0,0);

        if ($backgroundCheck->customer->concept==1){       // Switch del concepto boton cliente (Concepto)
            //CONCEPTO FINAL
        if ($backgroundCheck->customerId==565){
            if (!in_array( $backgroundCheck->customerProduct->id, $customBackgroundCheck)) {

                $pdf->SetY(178);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell('', '', 'CONCEPTO FINAL.', '', 1, 'L');
                $pdf->Cell('', '', '', "", 1, 'L');

                $pdf->SetFont('Arial', '', 12);

                // Always use the Result Ignore the comments

                if (true || trim($backgroundCheck->comments) == "") {
                    if ($backgroundCheck->resultId == Result::FAVORABLE) {
                        $finalComments = 'Realizada la Evaluación de la Empresa '
                            . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                            . 'se puede concluir que bajo la Óptica del cumplimiento '
                            . 'del Sistema de Gestión en Seguridad y Control de la Cadena de Suministros '
                            . 'NO se presenta ningún aspecto que amerite '
                            . 'emitir un concepto negativo para su contratación.';
                    } elseif ($backgroundCheck->resultId == Result::NO_FAVORABLE) {
                        $finalComments = 'Realizada la Evaluación de la Empresa '
                            . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                            . 'se puede concluir que bajo la Óptica del cumplimiento '
                            . 'del Sistema de Gestión en Seguridad y Control de la Cadena de Suministros '
                            . 'presenta aspectos que ameritan emitir un concepto No Favorable '
                            . 'para su contratación, de acuerdo con las actividades '
                            . 'que puede desarrollar según su Objeto Social.';
                    } elseif ($backgroundCheck->resultId == 4) {
                        $finalComments = 'Realizada la Evaluación de la Empresa '
                            . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                            . 'se puede concluir que bajo la Óptica del cumplimiento '
                            . 'del Sistema de Gestión en Seguridad y Control de la Cadena de Suministros '
                            . 'presenta aspectos que ameritan emitir un concepto con Hallazgo Menor, '
                            . 'para su contratación, de acuerdo con las actividades '
                            . 'que puede desarrollar según su Objeto Social.';

                    }

                    else {
                        $finalComments = ' ************    ESTE ESTUDIO NO TIENE RESULTADO AUN  *********** ';
                    }
                } else {
                    $finalComments = $backgroundCheck->comments;
                }

                $pdf->MultiCell(171, '', $finalComments, 0, 'J', FALSE, TRUE);
                $pdf->Cell('', '', '', '', 1, 'L');
                $pdf->Cell('', '', '', '', 1, 'L');
                $pdf->Cell('', '', '', '', 1, 'L');
                $pdf->Cell('', '', '', '', 1, 'L');
                $pdf->SetX(80);

                if ($backgroundCheck->approved && $backgroundCheck->approved->signature) {
                    $imageFile = $backgroundCheck->approved->signature->getImageFileSized(460, 120);
                    $x = $pdf->getX();
                    $y = $pdf->getY();
                    $imageSize = getimagesize($imageFile);
                    if ($imageSize[0] < 460) {
                        $xdif = 0.5 + 460 / $imageSize[0] * 8;
                    } else {
                        $xdif = 0.5;
                    }
                    $pdf->Image($imageFile, $x + $xdif, $y - 17, -180);
                    unlink($imageFile);
                    $pdf->setXY($x, $y);
                }

                $pdf->Cell(66, '', ($backgroundCheck->approved ? $backgroundCheck->approved->name : 'PENDIENTE DE APROBACIÓN'), "T", 1, 'C', 0);
            }



        }
        else{
        if (!in_array( $backgroundCheck->customerProduct->id, $customBackgroundCheck)) {

            $pdf->SetY(178);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell('', '', 'CONCEPTO FINAL.', '', 1, 'L');
            $pdf->Cell('', '', '', "", 1, 'L');

            $pdf->SetFont('Arial', '', 12);

            // Always use the Result Ignore the comments

            if (true || trim($backgroundCheck->comments) == "") {
                if ($backgroundCheck->resultId == Result::FAVORABLE) {
                    $finalComments = 'Realizada la Evaluación de la Empresa '
                        . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                        . 'se puede concluir que bajo la Óptica de Seguridad NO '
                        . 'presenta ningún aspecto que amerite emitir un concepto '
                        . 'negativo para su contratación, de acuerdo con las '
                        . 'actividades que puede desarrollar según su Objeto Social.';
                } elseif ($backgroundCheck->resultId == Result::NO_FAVORABLE) {
                    $finalComments = 'Realizada la Evaluación de la Empresa '
                        . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                        . 'se puede concluir que bajo la Óptica de Seguridad Presenta '
                        . 'aspectos que ameritan emitir un concepto No Favorable '
                        . 'para su contratación, de acuerdo con las actividades '
                        . 'que puede desarrollar según su Objeto Social.';
                } elseif ($backgroundCheck->resultId == 4) {
                    $finalComments = 'Realizada la Evaluación de la Empresa '
                        . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                        . 'se puede concluir que bajo la Óptica de Seguridad Presenta '
                        . 'aspectos que ameritan emitir un concepto de Hallazgo Menor. ';

                }

                else {
                    $finalComments = ' ************    ESTE ESTUDIO NO TIENE RESULTADO AUN  *********** ';
                }
            } else {
                $finalComments = $backgroundCheck->comments;
            }

            $pdf->MultiCell(171, '', $finalComments, 0, 'J', FALSE, TRUE);
            $pdf->Cell('', '', '', '', 1, 'L');
            $pdf->Cell('', '', '', '', 1, 'L');
            $pdf->Cell('', '', '', '', 1, 'L');
            $pdf->Cell('', '', '', '', 1, 'L');
            $pdf->SetX(80);

            if ($backgroundCheck->approved && $backgroundCheck->approved->signature) {
                $imageFile = $backgroundCheck->approved->signature->getImageFileSized(460, 120);
                $x = $pdf->getX();
                $y = $pdf->getY();
                $imageSize = getimagesize($imageFile);
                if ($imageSize[0] < 460) {
                    $xdif = 0.5 + 460 / $imageSize[0] * 8;
                } else {
                    $xdif = 0.5;
                }
                $pdf->Image($imageFile, $x + $xdif, $y - 17, -180);
                unlink($imageFile);
                $pdf->setXY($x, $y);
            }

            $pdf->Cell(66, '', ($backgroundCheck->approved ? $backgroundCheck->approved->name : 'PENDIENTE DE APROBACIÓN'), "T", 1, 'C', 0);
        }
         }
        }


        if (trim($backgroundCheck->comments) != "" || $backgroundCheck->customerProduct->hasXmlQuestion()) {
            $pdf->AddPage();
            $newPage = true;
        } else {
            $newPage = false;
        }

          if ($backgroundCheck->customerProduct->printSummarySection == 1) {
            if (!$newPage) {
                $pdf->AddPage();
            }
            $this->renderPartial('/verificationSection/_summarySectionCommentsPDF', array(
                'verificationSections' => $backgroundCheck->verificationSections,
                'pdf' => $pdf,
                    )
            );
        }

     /*   $this->renderPartial('_pdfViewCompanyFinancial', array(
                'backgroundCheck' => $backgroundCheck,
               'pdf' => $pdf,)
       );

        $this->renderPartial('_pdfViewCompanyVisit', array(
                'backgroundCheck' => $backgroundCheck,
                'pdf' => $pdf,)
        );

        $this->renderPartial('_pdfViewCompanyOther', array(
                'backgroundCheck' => $backgroundCheck,
                'pdf' => $pdf,)
        );  */

        $lnks=0;
        foreach ($backgroundCheck->verificationSections as $verificationSection) {

            $lnks=$lnks+1;
            /* @var $verificationSection VerificationSection */
            if ($verificationSection->percentCompleted >= 100) {

                $posY=$pdf->GetY($verificationSection->verificationSectionType->id);
                $pageP=$pdf->PageNo($verificationSection->verificationSectionType->id);
                $pdf->SetLink($lnks, $y=$posY, $page=$pageP);

                $this->renderPartial('/verificationSection/_verificationSectionPDF', array(
                    'verificationSection' => $verificationSection,
                    'height' => '',
                    'pdf' => $pdf,
                        )
                );
            }
        }

      /*  foreach ($backgroundCheck->verificationSections as $verificationSection) {
            if ($verificationSection->getIsXmlSection() && $verificationSection->percentCompleted >= 100) {
                $this->renderPartial('/verificationSection/_verificationSectionPDF', array(
                    'verificationSection' => $verificationSection,
                    'height' => '',
                    'pdf' => $pdf,
                        )
                );
            }
        } */
    }

// AUDITORIA
if ($backgroundCheck->customerId==698){
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_claro/_pdfProveedorAuditoria.php');
}

    $this->renderPartial('/event/_eventsPDF', array(
            'backgroundCheck' => $backgroundCheck,
            'height' => '',
            'pdf' => $pdf,
        )
    );


    if($_GET['valor']==2){
        $pages=$pdf->PageNo();
        $NumStudytotal = $backgroundCheck->getPagesPDF($pages); 
    }

    if($_GET['valor']==1){
        $this->renderPartial('/document/_documentsPDF', array(
        'backgroundCheck' => $backgroundCheck,
        'height' => '',
        'documents' => $backgroundCheck->getDocumentsInVerificationSection(null),
        'pdf' => $pdf,
            )
        );
    }

// Se incluye la información de Servicios Web en el reporte
/*$this->renderPartial('_pdfViewServiceResponse', array(
    'backgroundCheck' => $backgroundCheck,
    'pdf' => $pdf,)
);*/

/* if (!in_array( $backgroundCheck->customerProduct->id, $customBackgroundCheck)) {
    $pdf->addPage();

    $pdf->SetY(30);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell('', '', 'CONCEPTO FINAL.', '', 1, 'L');
    $pdf->Cell('', '', '', "", 1, 'L');

    $pdf->SetFont('Arial', '', 12);

    // Always use the Result Ignore the comments
    if (true || trim($backgroundCheck->comments) == "") {
        if ($backgroundCheck->resultId == Result::FAVORABLE) {
            $finalComments = 'Realizada la Evaluación de la Empresa '
                    . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                    . 'se puede concluir que bajo la Óptica de Seguridad NO '
                    . 'presenta ningún aspecto que amerite emitir un concepto '
                    . 'negativo para su contratación, de acuerdo con las '
                    . 'actividades que puede desarrollar según su Objeto Social.';
        } elseif ($backgroundCheck->resultId == Result::NO_FAVORABLE) {
            $finalComments = 'Realizada la Evaluación de la Empresa '
                    . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                    . 'se puede concluir que bajo la Óptica de Seguridad Presenta '
                    . 'aspectos que ameritan emitir un concepto No Favorable '
                    . 'para su contratación, de acuerdo con las actividades '
                    . 'que puede desarrollar según su Objeto Social.';
        } elseif ($backgroundCheck->resultId == 4) {
            $finalComments = 'Realizada la Evaluación de la Empresa '
                . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                . 'se puede concluir que bajo la Óptica de Seguridad Presenta '
                . 'aspectos que ameritan emitir un concepto de Hallazgo Menor. ';

        }

        else {
            $finalComments = ' ************    ESTE ESTUDIO NO TIENE RESULTADO AUN  *********** ';
        }
    } else {
        $finalComments = $backgroundCheck->comments;
    }

    $pdf->MultiCell(171, '', $finalComments, 0, 'J', FALSE, TRUE);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetX(80);

    if ($backgroundCheck->approved && $backgroundCheck->approved->signature) {
        $imageFile = $backgroundCheck->approved->signature->getImageFileSized(460, 120);
        $x = $pdf->getX();
        $y = $pdf->getY();
        $imageSize = getimagesize($imageFile);
        if ($imageSize[0] < 460) {
            $xdif = 0.5 + 460 / $imageSize[0] * 8;
        } else {
            $xdif = 0.5;
        }
        $pdf->Image($imageFile, $x + $xdif, $y - 17, -180);
        unlink($imageFile);
        $pdf->setXY($x, $y);
    }

    $pdf->Cell(66, '', ($backgroundCheck->approved ? $backgroundCheck->approved->name : 'PENDIENTE DE APROBACIÓN'), "T", 1, 'C', 0);
}*/

