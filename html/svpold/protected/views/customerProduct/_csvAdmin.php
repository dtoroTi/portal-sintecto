<?php

$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'customer.customerGroup.name',
    'customer.name',
    'customer.isActive',
    'name',
    'typeProduct.value',
    'price',
    'priceYearAnt',
    'priceFase1',
    'listFase1',
    'dateFase1',
    'priceFase2',
    'listFase2',
    'dateFase2',
    'priceFase3',
    'listFase3',
    'dateFase3', 
    'maxDays',
    'maxInternalDays',
    'contract_Limit',
    'sectionsName',
    'totalWeight',
    'created',
    'modified',
    'isActive',
    'invoiceVisitCost.descriptionCost',
    'invoiceVisitCost.totalVisitCost',
);
$row = array();
foreach ($headers as $header) {
  $row[] = BackgroundCheck::model()->getAttributeLabel($header);
}
fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);

$dp = $model->search();
$dp->setPagination(false);

$models = $dp->getData();
foreach ($models as $submodel) {
  $row = array();
  foreach ($headers as $head) {
    $row[] = CHtml::value($submodel, $head);
  }
  fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);
}

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF

Yii::app()->request->sendFile("Reports_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
