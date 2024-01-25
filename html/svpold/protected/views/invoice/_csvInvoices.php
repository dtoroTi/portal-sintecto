<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'customerGroup.name',
    'from',
    'until',
    'invoiceDate',
    'number',
    'comments',
    'numberOfStudies',
    'dueOn',
    'totalWithTax',
    'paymentDate',
    'totalReceived',
    'pendingPayment',
    'closed',
);


$row = array();
foreach ($headers as $header) {
    if (is_array($header)) {
        $row[] = Invoice::model()->getAttributeLabel($header['header']);
    } else {
        $row[] = Invoice::model()->getAttributeLabel($header);
    }
}
fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);

if ((Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) && Yii::app()->user->isRegisteredIp) {
    // The Admin user can export up to 200 records
    $dp = $model->search(5000);
}else{
    $dp=null;
}

$models = $dp->getData();

WebUser::logAccess("Exporto " . count($models) . " facturas a un CSV.");

foreach ($models as $submodel) {
    $newSubmodel = Invoice::model()->findByPk($submodel->id);
    $row = array();
    foreach ($headers as $header) {
        if (is_array($header)) {
            $row[] = CHtml::value($newSubmodel, $header['value']);
        } else {
            $row[] = str_replace(array("\n", "\r", '"', "'"), array(" ", " ", ".", "."), CHtml::value($newSubmodel, $header));
        }
        unset($header);
    }

    fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);
    unset($row);
    unset($newSubmodel);
}

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Reports_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
