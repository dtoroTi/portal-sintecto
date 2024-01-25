<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'backgroundcheck.customer.name',
    'backgroundcheck.code',
    'backgroundcheck.idNumber',
    'backgroundcheck.city',
    'backgroundcheck.firstName',
    'backgroundcheck.lastName',
    'backgroundcheck.email',
    'backgroundcheck.tels',
    'typeVisit',
    array(
        'header' => 'Componente',
        'value' => 'backgroundcheck.backgroundCheckComponents'
    ),
    'backgroundcheck.applyToPosition',
    'authorizationFormat',
    array(
        'header' => 'RESPONSABLE DE LA VISITA',
        'value' => 'responsibleVisit.name'
    ),
    array(
        'header' => 'OBSERVACIONES',
        'value' => 'observation'
    ),
    'visitProgramdate',
    'formVisit',
    'location',
    'referenceAddress',
    'neighborhood',
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

$dp = $model->searchallCalls(4000);

$models = $dp->getData();

WebUser::logAccess("Exporto " . count($models) . " programacion visitas a un CSV.");

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
Yii::app()->request->sendFile("Informe_program_visit_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);

