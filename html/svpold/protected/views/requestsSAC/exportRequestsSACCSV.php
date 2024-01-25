<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    '#',
    'Línea',
    'Persona que Solicita',
    'Tipo de Solicitud',
    'Referencia',
    'Cédula',
    'Nombres',
    'Apellidos',
    'Cargo',
    'Cliente',
    'Producto',
    'Fecha de Solicitud por SAC',
    'Fecha de Entrega Ops a SAC',
    'Dias de Entrega',
    'Impactado Por',
    'Estado',
    'Fecha Actualización',
    'Observación de SAC',
    'Observación de OPS'
);



fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);
$rows = 0;

foreach ($exportRequestsReports as $requestsReport) {

    /* @var $pendingReport BackgroundCheck */
    $reportRow = array();
    $reportRow['id'] = $requestsReport->id;
    $reportRow['businessLine'] = $requestsReport->backgroundcheck->customer->businessLine;
    $reportRow['username'] = $requestsReport->user->username;
    $reportRow['typeRequest'] = $requestsReport->typeRequest;
    $reportRow['code'] = $requestsReport->backgroundcheck->code;
    $reportRow['idNumber'] = $requestsReport->backgroundcheck->idNumber;
    $reportRow['firstName'] = $requestsReport->backgroundcheck->firstName;
    $reportRow['lastName'] = $requestsReport->backgroundcheck->lastName;
    $reportRow['applyToPosition'] = $requestsReport->backgroundcheck->applyToPosition;
    $reportRow['customer.name'] = $requestsReport->backgroundcheck->customer->name;
    $reportRow['name'] = $requestsReport->backgroundcheck->customerProduct->name;
    $reportRow['dateRequest'] = $requestsReport->dateRequest;
    $reportRow['dateAnswer'] = $requestsReport->dateAnswer;
    $reportRow['deliveryDays'] = $requestsReport->deliveryDays;
    $reportRow['shockedby'] = $requestsReport->shockedby;
    $reportRow['status'] = $requestsReport->status;
    $reportRow['t.dateUpdate'] = $requestsReport->dateUpdate;
    $reportRow['observation'] = $requestsReport->observation;
    $reportRow['observationOPS'] = $requestsReport->observationOPS;
    
    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
    $rows++;
}

WebUser::logAccess("Exporto reporte solicitudes SAC " . $rows . " filas.");


rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Reports_solicitudes_SAC_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
