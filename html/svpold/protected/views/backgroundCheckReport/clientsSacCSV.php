<?php


$query_A = 'SELECT ctg.name AS Grupo, ct.name AS Cliente, ct.segment AS Segmento, ct.businessLine AS Linea_Negocio,
usr.username AS EjecutivoSAC, if(ct.isActive=1,"SI","NO") AS Cliente_Activo, ct.created AS Creado
FROM ses_Customer ct
JOIN ses_CustomerGroup ctg ON ctg.id=ct.customerGroupId
left JOIN ses_User usr ON usr.id=ct.sacId';
$query = Yii::app()->db->createCommand($query_A)->queryall();
$fp = fopen('php://temp', 'w');


$headers = array(
    'Grupo_Cliente',
    'Cliente',
    'Segmento',
    'Linea de Negocio',
    'Ejecutivo Sac',
    'Cliente Activo',
    'Fecha de Creacion',   
);
fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);


foreach ($query as $result ){

    $reportRow = array();

    $reportRow[] =$result['Grupo'];
    $reportRow[] =$result['Cliente'];
    $reportRow[] =$result['Segmento'];
    $reportRow[] =$result['Linea_Negocio'];
    $reportRow[] =$result['EjecutivoSAC'];
    $reportRow[] =$result['Cliente_Activo'];
    $reportRow[] =$result['Creado'];
 
    

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);


}
rewind($fp);
Yii::app()->request->sendFile("Export_Clients_SAC" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);



header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=export.csv');
?>