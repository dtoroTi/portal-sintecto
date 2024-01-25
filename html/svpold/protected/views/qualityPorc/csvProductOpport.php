<?php

$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'Cliente',
    'Usuario',
    'A tiempo',
    'Fuera de Tiempo',
    'Oportunidad',
    'Total Procesos',
    'Meta',
    '% Cumplimiento Meta',
    '% Cumplimiento Oportunidad'
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
foreach ($csvProductOpports as $result ){

    $totalprocesos=$result['atiempo']+$result['fueratiempo'];

    if($totalprocesos==0){
        $cumplimiento=0;
    }else{
        $cumplimiento=round(($result['atiempo']*100/$totalprocesos), 2);
    }
   
    if($result['Meta']==0){
        $meta=0;
    }else{
        $meta=round(($totalprocesos*100/$result['Meta']), 2);
    }
  
    $reportRow = array();

    $reportRow[] =$result['Nombre'];
    $reportRow[] =$result['Usuario'];
    $reportRow[] =$result['atiempo'];
    $reportRow[] =$result['fueratiempo'];
    $reportRow[] =$result['oportunidad'];
    $reportRow[] =$totalprocesos;
    $reportRow[] =$result['Meta'];
    $reportRow[] =$meta.'%';
    $reportRow[] =$cumplimiento.'%';

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Productividad y Oportunidad" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
