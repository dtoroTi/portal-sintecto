<?php

$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'customer.customerGroup.name',
    'customer.name',
    'customerUser.name',
    'customerUser.username',
    'invoice.number',
    'invoice.from',
    'invoice.until',    
    'invoice.dueOn',    
    'invoice.closed',    
    'code',
    'customerProduct.name',
    'customerField1',
    'customerField2',
    'customerField3',
    'customerField4',
    'customerField5',
    'customerField6',
    'city',
    'firstName',
    'lastName',
    'idNumber',
    'countOfOtherReportsOfPerson',
    'created',
    'studyStartedOn',
    'assignedOn',
     array('header' => 'Responsable', 'value' => 'responsible.user.shortUsername'),
    'studyLimitOn',
    'approvedOn',
    array('header' => 'approvedBy', 'value' => 'approved.name'),
    'deliveredToCustomerOn',
    'daysStudy',
    'daysChecker',
    'numberOfEvents',
    'findings',
    'findingReturn',
    'cost',
    'price',
    'backgroundCheckStatus.name',
    'result.name',
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
