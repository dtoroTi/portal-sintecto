<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'customer.customerGroup.name',
    'customer.name',
    'typeClient',
    'customer.incremental',
    'customer.segment',
    'customer.businessLine',
    'customerUser.username',
    'code',
    'customerProduct.name',
    'customerProduct.incremental',
    array(
        'header' => 'customerProduct.typeProductId',
        'value' => 'customerProduct.typeProduct.value',
    ),
    'invoice.number',
    array(
        'header' => 'invoice.invoiceDate',
        'value' => 'invoice.invoiceDate',
    ),
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
    'codVerification',
    'created',
    'studyStartedOn',
    'assignedOn',
    'applyToPosition',
    array(
        'header' => 'Responsable SAC',
        'value' => 'customer.sac.name',
    ),
    array(
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
    'tempdateRep',
    'deliveredToCustomerOn',
    'daysStudy',
    'daysChecker',
    'customerProduct.contract_Limit',
    'numberOfEvents',
    'findings',
    'findingslite',
    'findingReturn',
    'qualityReturDev',
    'qualityPQR',
    'qualityComplain',
    'quality',
    'qualityReturn',
    'qualityReturnPer',
    'sectionsSummary',
    'backgroundCheckStatus.name',
    'result.name',
    'reportAvailable',
    'backgroundCheckComponents',
    'total',
    'isEventPendingToAprove',
    'farthestEvent',
    //'assignedUserNames',
);

if ($withEvents) {
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

if (Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))) {
    $headers = array_merge($headers, array(
        'cost',
        'customerProduct.priceYearAnt',
        'price',
        'additionalPrice',
        'totalPrice',
        'additionalPriceComment',
        'invoice.number',
        'invoice.dueOn',
        'isOnlyAdverse',
        'inAmendment',
    ));
}

$row = array();
foreach ($headers as $header) {
    if (is_array($header)) {
        $row[] = BackgroundCheck::model()->getAttributeLabel($header['header']);
    } else {
        $row[] = BackgroundCheck::model()->getAttributeLabel($header);
    }
}
fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);

if ((Yii::app()->user->isManager || Yii::app()->user->getIsByRole()) && Yii::app()->user->isRegisteredIp) {
    // The Admin user can export up to 200 records
    $dp = $model->search(70000);
} elseif ((Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) && Yii::app()->user->isRegisteredIp) {
    // The Admin user can export up to 200 records
    $dp = $model->search(70000);
} elseif (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

    // The Admin user can export up to 200 records
    $dp = $model->search(70000);
} else {
    $dp = $model->search();
}

$models = $dp->getData();

WebUser::logAccess("Exporto " . count($models) . " estudios a un CSV.");

foreach ($models as $submodel) {
    $newSubmodel = BackgroundCheck::model()->findByPk($submodel->id);
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

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Reports_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
