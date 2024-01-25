<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'UserName',
    'Nombre Usuario',
    'Id Factura',
    'Fecha inicial corte',
    'Fecha final corte',
    'Fecha facturación',
    'Factura cerrada',
    'id detalle factura',
    'cliente',
    'Producto',
    'Linea de Negocio',
    'Ref.',
    'Nombre',
    'Apellido',
    'Identificacion',
    'ciudad',
    'fecha solicitud estudio',
    'fecha publicado estudio',
    'Fecha Visita',
    'Costo visita',
    'Costo adicional visita',
    'Costo transporte',
    'Costo alimentación',
    'Costo papeleria',
    'Descripción',
    'Aprobado',
    'Aprobado por',
    'Fecha Aprobación',
);

fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);
$rows = 0;

foreach ($invoiceVisit as $dateReport) {

    /*if($dateReport['verificationSectionTypeId']==5){
        $detailHousing = DetailHousing::model()->findByPk(['id'=>$dateReport['id']]);
        $fechaVisita=$detailHousing->visitedOn;
        echo  $fechaVisita;
        die();
    }*/

    if($dateReport['idSection']==5){
        $detailHousing =  DetailHousing::model()->findByAttributes(['verificationSectionId'=>$dateReport['id']]);
        $visitaOn=$detailHousing->visitedOn; 
    }else if($dateReport['idSection']==17){
        $detailCompanyVisit =  DetailCompanyVisit::model()->findByAttributes(['verificationSectionId'=>$dateReport['id']]);
        $visitaOn=$detailCompanyVisit->verifiedOn; 
    }else{
        $otherSectionXml =  XmlSection::model()->findByAttributes(['verificationSectionId'=>$dateReport['id']]);
        $xmlanswer=$otherSectionXml->answer; 

        $XMLQuestionResult = array();
        $resultxml =  unserialize($otherSectionXml->answer) ;
        $XMLQuestionResult = array_merge($XMLQuestionResult, $resultxml);   
        if(isset($XMLQuestionResult['verifiedOn'])){
            $visitaOn=$XMLQuestionResult['verifiedOn'];
        }else{
            $visitaOn='';
        }
        
    }

    /* @var $pendingReport BackgroundCheck */
    $reportRow = array();
    $reportRow['username'] = $dateReport['username'];
    $reportRow['nombre'] = $dateReport['nombre'];
    $reportRow['id'] = $dateReport['id'];
    $reportRow['from'] = $dateReport['from'];
    $reportRow['until'] = $dateReport['until'];
    $reportRow['invoiceDate'] = $dateReport['invoiceDate'];
    $reportRow['statusInvoice'] = $dateReport['statusInvoice'];
    $reportRow['idVisitdetail'] = $dateReport['idVisitdetail'];
    $reportRow['name'] = $dateReport['name'];
    $reportRow['nameproduct'] = $dateReport['nameproduct'];
    $reportRow['businessLine'] = $dateReport['businessLine'];
    $reportRow['code'] = $dateReport['code'];
    $reportRow['firstName'] = $dateReport['firstName'];
    $reportRow['lastName'] = $dateReport['lastName'];
    $reportRow['idNumber'] = $dateReport['idNumber'];
    $reportRow['city'] = $dateReport['city'];
    $reportRow['studyStartedOn'] = $dateReport['studyStartedOn'];
    $reportRow['deliveredToCustomerOn'] = $dateReport['deliveredToCustomerOn'];
    $reportRow['visitaOn'] = $visitaOn;
    $reportRow['totalValueCostVisit'] = $dateReport['totalValueCostVisit'];
    $reportRow['totalValueAddVisit'] = $dateReport['totalValueAddVisit'];
    $reportRow['totalValueTransportation'] = $dateReport['totalValueTransportation'];
    $reportRow['totalValueFeeding'] = $dateReport['totalValueFeeding'];
    $reportRow['totalValueStationery'] = $dateReport['totalValueStationery'];
    $reportRow['description'] = $dateReport['description'];
    $reportRow['aprobado'] = $dateReport['aprobado'];
    $reportRow['aprobadoPor'] = $dateReport['aprobadoPor'];
    $reportRow['DateApprovedOP'] = $dateReport['DateApprovedOP'];
    
    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
    $rows++;
}

WebUser::logAccess("Exporto visitador detalle de facturacion " . $rows . " filas.");


rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Reports_detalle_Fact_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
