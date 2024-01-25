<?php

$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'Usuario',
    'A tiempo',
    'Fuera de Tiempo',
    'Oportunidad',
    'Total Procesos Finalizados'
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

//WebUser::logAccess("Exporto " . count($models) . " estudios a un CSV.");
foreach ($csvFinishProccess as $result ){


    $reportRow = array();

    $reportRow[] =$result['Usuario'];
    $reportRow[] =$result['atiempo'];
    $reportRow[] =$result['fueratiempo'];
    $reportRow[] =$result['oportunidad'];
    $reportRow[] =$result['total_estudios'];
    
    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Datos Procesos Finalizados" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
