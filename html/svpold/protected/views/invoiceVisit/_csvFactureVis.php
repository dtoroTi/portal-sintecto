<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'user.username',
    'user.firstName',
    'user.lastName',
    'from',
    'until',
    'invoiceDate',
    'numberStudies',
    'totalValueStudies',
    'totalValueAddStudies',
    array(
        'header' => 'Total valor transporte',
        'value' => 'totalCostTansport',
    ),
    array(
        'header' => 'Total valor alimentación',
        'value' => 'totalCostFeeding',
    ),
    array(
        'header' => 'Total valor papeleria',
        'value' => 'totalCostStationery',
    ),
    'statusInvoice',
    'description',
);

$row = array();
foreach ($headers as $header) {
    if (is_array($header)) {
        $row[] = InvoiceVisit::model()->getAttributeLabel($header['header']);
    } else {
        $row[] = InvoiceVisit::model()->getAttributeLabel($header);
    }
}

fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);

$dp = $model->search(4000);

$models = $dp->getData();

WebUser::logAccess("Exporto " . count($models) . " datos visitadores a un CSV.");

foreach ($models as $submodel) {
    $newSubmodel = InvoiceVisit::model()->findByPk($submodel->id);
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
Yii::app()->request->sendFile("Informe_Facturas_Visitadores_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
