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
    'Grupo de Seccion',
    'Seccion',
    'Asignado a',
    'Fecha Asignacion',
    'Fecha Limite',
    'Fecha Solicitado',
    'Fecha Limite Cliente'
);

fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);
$rows = 0;

//var_dump($exportAssingSectionMasive);
//die();
foreach ($exportNotAssingSectionMasive as $assingReport) {

    /* @var $pendingReport BackgroundCheck */
    $reportRow = array();
    $reportRow[] = $assingReport['cliente'];
    $reportRow[] = $assingReport['tipo'];
    $reportRow[] = $assingReport['code'];
    $reportRow[] = $assingReport['Nombre'] ;
    $reportRow[] = $assingReport['idNumber'];
    $reportRow[] = $assingReport['grupo_seccion'];
    $reportRow[] = $assingReport['seccion'];
    $reportRow[] = $assingReport['asignado'];
    $reportRow[] = $assingReport['assignedAt'];
    $reportRow[] = $assingReport['limitAt'];
    $reportRow[] = $assingReport['studyStartedOn'];
    $reportRow[] = $assingReport['studyLimitOn'];

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
    $rows++;
}

WebUser::logAccess("Exporto reporte secciones no asignadas" . $rows . " filas.");


rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Reports_Seccion_no_asignada_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
