<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'Cliente',
    'Usuario Cliente',
    'Tipo producto',
    'Referencia',
    'No. ID',
    'Candidato',
    'Tipo Novedad',
    'Tipo Retraso',
    'Detalle Novedad',
    'Fecha Novedad'
);

fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);
$rows = 0;

//var_dump($exportAssingSectionMasive);
//die();
foreach ($exportEvent as $events) {

    /* @var $pendingReport BackgroundCheck */
    $reportRow = array();
    $reportRow[] = $events['customer'];
    $reportRow[] = $events['customerUser'];
    $reportRow[] = $events['customerProduct'];
    $reportRow[] = $events['code'] ;
    $reportRow[] = $events['idNumber'];
    $reportRow[] = $events['firtsName'].' '.$events['lastName'];
    $reportRow[] = $events['tipo'];
    $reportRow[] = $events['tiporetraso'];
    $reportRow[] = $events['detail'];
    $reportRow[] = $events['fecha'];

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
    $rows++;
}

WebUser::logAccess("Exporto Novedades Estudio" . $rows . " filas.");


rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Reports_Novedades_Estudios_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
