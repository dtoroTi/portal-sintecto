<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'Cliente',
    'Tipo',
    'Referencia',
    'Nombre',
    'No. ID',
    'Asignado a',
    'Email',
    'Rol',
    'Grupo de Seccion',
    'Seccion',
    'Fecha Asignado Seccion',
    'Fecha Limite Seccion',
    'Fecha Terminación Seccion',
    'Fecha Solicitado',
    'Fecha Limite Cliente'
);

fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);
$rows = 0;

//var_dump($exportAssingSectionMasive);
//die();
foreach ($exportAssingSectionMasive as $assingReport) {

    /* @var $pendingReport BackgroundCheck */
    $reportRow = array();
    $reportRow[] = $assingReport['cliente'];
    $reportRow[] = $assingReport['tipo'];
    $reportRow[] = $assingReport['code'];
    $reportRow[] = $assingReport['Nombre'] ;
    $reportRow[] = $assingReport['idNumber'];
    $reportRow[] = $assingReport['asignado'];
    $reportRow[] = $assingReport['username'];
    $reportRow[] = $assingReport['rol'];
    $reportRow[] = $assingReport['grupo_seccion'];
    $reportRow[] = $assingReport['seccion'];
    $reportRow[] = $assingReport['assignedAt'];
    $reportRow[] = $assingReport['limitAt'];
    $reportRow[] = $assingReport['finishedAt'];
    $reportRow[] = $assingReport['studyStartedOn'];
    $reportRow[] = $assingReport['studyLimitOn'];

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
    $rows++;
}

WebUser::logAccess("Exporto reporte asignacion secciones" . $rows . " filas.");


rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Reports_asignacion_Seccion_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
