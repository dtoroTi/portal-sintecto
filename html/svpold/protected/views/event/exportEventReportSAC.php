<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'idNumber',
    'Nombre',
    'Referencia',
    'Fecha novedad',
    'Detalle',
    'Tipo',
    'Tipo Retraso',
    'Creado por',
    'Fecha reporte a SAC',
    'Reportado a SAC por',
    'Usuario SAC',
    'Respuesta SAC',
    'Fecha respuesta SAC',
);



fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);
$rows = 0;

foreach ($eventReportsSAC as $dateReport) {

    /* @var $pendingReport BackgroundCheck */
    $reportRow = array();

    $reportRow['idNumber'] = $dateReport['idNumber'];
    $reportRow['nombre'] = $dateReport['nombre'];
    $reportRow['code'] = $dateReport['code'];
    $reportRow['created'] = $dateReport['created'];
    $reportRow['detail'] = $dateReport['detail'];
    $reportRow['tipo'] = $dateReport['tipo'];
    $reportRow['tipoRetraso'] = $dateReport['tipoRetraso'];
    $reportRow['creadoPor'] = $dateReport['creadoPor'];
    $reportRow['fechaReporteSAC'] = $dateReport['fechaReporteSAC'];
    $reportRow['ReportadoSACPor'] = $dateReport['ReportadoSACPor'];
    $reportRow['UsuarioSAC'] = $dateReport['UsuarioSAC'];
    $reportRow['respuestaNovedad'] = $dateReport['respuestaNovedad'];
    $reportRow['fechaRespuesta'] = $dateReport['fechaRespuesta'];


    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
    $rows++;
}

WebUser::logAccess("Exporto reporte de novedades a SAC " . $rows . " filas.");


rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Reports_detalle_NovSAC_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
