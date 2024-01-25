<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'id',
    array(
        'header' => 'FECHA DE INGRESO',
        'value' => 'backgroundcheck.studyStartedOn',
    ),
    'dateCreate',
    array(
        'header' => 'FECHA LIMITE',
        'value' => 'backgroundcheck.studyLimitOn',
    ),
    array(
        'header' => 'RESPONSABLE LLAMADA INICIAL',
        'value' => 'callManager.name'
    ),
    array(
        'header' => 'RESPONSABLE DE LLAMADA REPROGRAMACIÓN',
        'value' => 'callReschedulingManager.name',
    ),
    'backgroundcheck.customer.name',
    'backgroundcheck.code',
    'backgroundcheck.idNumber',
    'backgroundcheck.city',
    'backgroundcheck.firstName',
    'backgroundcheck.lastName',
    'backgroundcheck.email',
    'backgroundcheck.tels',
    array(
        'header' => 'Tipo producto',
        'value' => 'backgroundcheck.customerProduct.name'
    ),
    array(
        'header' => 'Componente',
        'value' => 'backgroundcheck.backgroundCheckComponents'
    ),
    'backgroundcheck.applyToPosition',
    'statusVisit',
);

$row = array();
foreach ($headers as $header) {
    if (is_array($header)) {
        $row[] = CandidateCalls::model()->getAttributeLabel($header['header']);
    } else {
        $row[] = CandidateCalls::model()->getAttributeLabel($header);
    }
}

fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);

$dp = $model->searchcallManager(4000);

$models = $dp->getData();

WebUser::logAccess("Exporto " . count($models) . " estudios a un CSV.");

foreach ($models as $submodel) {
    $newSubmodel = CandidateCalls::model()->findByPk($submodel->id);
    $row = array();
    foreach ($headers as $header) {
        if (is_array($header)) {
            $row[] = CHtml::value($newSubmodel, $header['value']);
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
Yii::app()->request->sendFile("Llamadas_Asignadas_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
