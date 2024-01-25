<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'id',
    array(
        'header' => 'FECHA DE SOLICITADO',
        'value' => 'studyStartedOn',
    ),
    'customer.name',
    'code',
    array(
        'header' => 'Tipo',
        'value' => 'customerProduct.name'
    ),
    'firstName',
    'lastName',
    'idNumber',
    'mobile',
    'email',
    /*array(
        'header' => 'Documentos',
        'value' =>'detailDocuments', 
    ),*/
    'address',
    'city',
    array(
        'header' => 'Limite FD SP',
        'value' => 'validuntilFD'
    ),

    array(
        'header' => 'Estado FD SP',
        'value' => 'statusFD'//'statusRecoverFDSP',
    ),
    array(
        'header' => 'Limite FD Doc',
        'value' => 'reciptExpiration'
    ),
    array(
        'header' => 'Estado FD Doc',
        'value' =>  'reciptFileStatus'//'statusRecoverFDDoc',
    ),
    array(
        'header' => 'Envio Correos SP',
        'value' => 'detailContactsSP',
    ),
    array(
        'header' => 'Envio Correos Doc',
        'value' => 'detailContactsDoc',
    ),

);

$row = array();
foreach ($headers as $header) {
    if (is_array($header)) {
        $row[] = BackgroundCheck::model()->getAttributeLabel($header['header']);
    } else {
        $row[] = BackgroundCheck::model()->getAttributeLabel($header);
    }
}

fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);

$dp = $model->searchRecover(4000);

$models = $dp->getData();

WebUser::logAccess("Exporto " . count($models) . " estudios a un CSV.");

foreach ($models as $submodel) {
    $newSubmodel = BackgroundCheck::model()->findByPk($submodel->id);
    $row = array();
    foreach ($headers as $header) {
        if (is_array($header)) {
            if($header['value']=='statusFD'){
                if(CHtml::value($newSubmodel, $header['value'])=="0"){
                    $row[] ="Pendiente";
                }else{
                    $row[] ="Enviado";
                }
            }
            if($header['value']=='reciptFileStatus'){
                if(CHtml::value($newSubmodel, $header['value'])=="0"){
                    $row[] ="Pendiente";
                }else{
                    $row[] ="Enviado";
                }
            }
            if($header['value']!='statusFD' && $header['value']!='reciptFileStatus'){
                $row[] = CHtml::value($newSubmodel, $header['value']);
            }
        } else {
            $row[] = CHtml::value($newSubmodel, $header);
        }
        unset($header);
    }

    fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);
    unset($row);
    unset($newSubmodel);
}
//die();

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Recaudo_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
