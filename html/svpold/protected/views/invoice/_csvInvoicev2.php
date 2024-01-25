<?php

$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    // NEW
    'customer.customerGroup.name',
    'customer.name',
    'customerUser.name',
    'customerUser.username',
    'invoice.number',
    'idNumber',
    'firstName',
    'lastName',
    'actualJob',
    'applyToPosition',
    'customerField1',
    'customerField2',
    'customerField3',
    'customerField4',
    'customerField5',
    'customerField6',
    'city',
    'state',
    'studyStartedOn',
    'approvedOn',
    'customerProduct.name',
    'backgroundCheckComponents',
    'result.name',
    'price',
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


$models = $invoice->backgroundChecks();
foreach ($models as $submodel) {
  $row = array();
  foreach ($headers as $header) {
    if (is_array($header)) {
      $row[] = CHtml::value($submodel, $header['value']);
    } else {
      $row[] = CHtml::value($submodel, $header);
    }
    
  }
  
  fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);
}

rewind($fp);
//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Factura_".CHtml::encode($invoice->customerGroup->name)."_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
