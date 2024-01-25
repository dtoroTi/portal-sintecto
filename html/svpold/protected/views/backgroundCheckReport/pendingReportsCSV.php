<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'Vendedor',
    'Grupo',
    'Cliente',
    'Segmento',
    'Linea de Negocio Cliente',
    'Producto',
    'Linea de Negocio',
    'Componentes',
    'ID',
    'Nombre',
    'Cargo',
    'Solicitud',
    'Límite',
    'Límite Interno',
    'Días',
    'Limite de Contrato',
    'Asignado',
    'Rol',
    'Sección',
    'Asignado en',
    'Límite Asig.',
    'Entregado',
    'Fecha Temp. Publicacíon',
    '% Sección',
    '% Total',
    'Novedades',
    'Retraso',
    'Valor al cliente',
);



fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);
$rows = 0;

foreach ($pendingReports as $pendingReport) {
    /* @var $pendingReport BackgroundCheck */

    $reportRow = array();
    $reportRow['sales'] = @$pendingReport->customer->customerGroup->user->name;
    $reportRow['groupName'] = @$pendingReport->customer->customerGroup->name;
    $reportRow['customername'] = @$pendingReport->customer->name;
    $reportRow['segment'] = @$pendingReport->customer->segment;
    $reportRow['businessLine'] = @$pendingReport->customer->businessLine;
    $reportRow['productName'] = @$pendingReport->customerProduct->name;
    $reportRow['typeProductId'] = @$pendingReport->customerProduct->typeProduct->value;
    $reportRow['components'] = @$pendingReport->backgroundCheckComponents;
    $reportRow['id'] = @$pendingReport->idNumber;
    $reportRow['fullName'] = @$pendingReport->fullName;
    $reportRow['applyToPosition'] = @$pendingReport->applyToPosition;
    $reportRow['startedOn'] = @$pendingReport->studyStartedOn;
    $reportRow['limitOn'] = @$pendingReport->studyLimitOn;
    $reportRow['internalLimitOn'] = @$pendingReport->maxInternalDays;
    $reportRow['daysStudy'] = @$pendingReport->daysStudy + 1;
    $reportRow['contract_Limit'] = @$pendingReport->customerProduct->contract_Limit;
    $reportRow['assignedUser'] = '';
    $reportRow['role'] = '';
    $reportRow['section'] = '';
    $reportRow['assignedAt'] = '';
    $reportRow['assignedLimit'] = '';
    $reportRow['finishedAt'] = '';
    $reportRow['tempdateRep'] = @$pendingReport->tempdateRep;
    $reportRow['percent'] = '';
    $reportRow['percentTotal'] = $pendingReport->total;
    $reportRow['numberOfEvents'] = @$pendingReport->numberOfEvents;
    $reportRow['overdueDays'] = @$pendingReport->overdueDays;
    $reportRow['price'] = @$pendingReport->price;

    if (count($pendingReport->assignedUsers) > 0) {
        foreach ($pendingReport->assignedUsers as $assignedUser) {
            /* @var $assignedUser AssignedUser */
            $reportRow['assignedUser'] = $assignedUser->user->shortUsername;
            $reportRow['role'] = $assignedUser->userRole->name;
            $reportRow['section'] = ($assignedUser->verificationSection ? $assignedUser->verificationSection->sectionName : '');
            $reportRow['assignedAt'] = $assignedUser->assignedAt;
            $reportRow['assignedLimit'] = $assignedUser->limit;
            $reportRow['finishedAt'] = $assignedUser->finishedAt;
            $reportRow['percent'] = ($assignedUser->verificationSection ? $assignedUser->verificationSection->percentCompleted : $pendingReport->total);
            fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
            $rows++;
        }
    } else {
        fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
        $rows++;
    }
}

WebUser::logAccess("Exporto reporte de assignación CSV con " . $rows . " filas.");


rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Reports_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
