<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'customer.customerGroup.name',
    'customer.name',
    'customerUser.username',
    'code',
    'customerProduct.name',
    //'invoice.number',
  /*  array(
        'header' => 'invoice.invoiceDate',
        'value' => 'invoice.invoiceDate',
    ),*/
    'customerField1',
    'customerField2',
    'customerField3',
    'customerField4',
    'customerField5',
    'customerField6',
    'customerField7',
    'customerField8',
    'customerField9',
    'city',
    'firstName',
    'lastName',
    'idNumber',
   // 'created',
    'studyStartedOn',
    'deliveredToCustomerOn',
    'studyLimitOn',
    'applyToPosition',
    'result.name',
    


   /* array(
        'header' => 'Responsable',
        'value' => 'responsible.user.shortUsername'
    ),
    array(
        'header' => 'asignados',
        'value' => 'assignedUserNamesPlain',
    ),
    'returnedByCheckerOn',
    'studyLimitOn',
    'approvedOn',
    array(
        'header' => 'approvedBy',
        'value' => 'approved.name'
    ),
    'deliveredToCustomerOn',
    'daysStudy',
    'daysChecker',
    'numberOfEvents',
    'findings',
    'findingReturn',
    'sectionsSummary',
    'backgroundCheckStatus.name',
    'result.name',
    'reportAvailable',
    'backgroundCheckComponents',
    'total',
    'isEventPendingToAprove',
    'farthestEvent',
        //'assignedUserNames',
   */
);

/*if ($withEvents) {
    $headers = array_merge($headers, array(array(
            'header' => 'Novedades',
            'value' => 'eventsText'
    )));
}
if ($withEvents) {
    $headers = array_merge($headers, array(array(
        'header' => 'Tipo de Retraso',
        'value' => 'eventsTextNews'
    )));
}
*/


$row = array();
foreach ($headers as $header) {
    if (is_array($header)) {
        $row[] = BackgroundCheck::model()->getAttributeLabel($header['header']);
    } else {
        $row[] = BackgroundCheck::model()->getAttributeLabel($header);
    }
}
fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);

    // The Admin user can export up to 200 records
//filtro de lo que exporta!!!!
$model = GridViewFilter::getFilter('BackgroundCheck', 'searchCli');
if(Yii::app()->user->arUser->isGroupSupervisor==1){
   $model->customerGroupId =  Yii::app()->user->arUser->customer->customerGroupId;

  } elseif(Yii::app()->user->arUser->isSupervisor==1){
  $model->customerId = Yii::app()->user->arUser->customerId;

} else{
    $model->customerUserId = Yii::app()->user->id;

}
   $dp =  $model->searchCli(40000);
//filtro de lo que exporta!!!!


   $results = $dp->getData();

//WebUser::logAccess("Exporto " . count($models) . " estudios a un CSV.");

foreach ($results as $submodel) {
    $newSubmodel = $model->findByPk($submodel->id);
    //echo 'submodel';
    //print_r($newSubmodel);
    $row = array();
    foreach ($headers as $header) {
        if (is_array($header)) {
            $row[] = CHtml::value($newSubmodel, $header['value']);
        } else {
            $row[] = CHtml::value($newSubmodel, $header);
        }
        //print_r($row);
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
