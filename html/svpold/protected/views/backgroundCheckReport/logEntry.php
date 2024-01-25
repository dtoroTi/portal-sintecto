<?php

$query_A = 'SELECT lg.serverName as Servidor, lg.userLogin as Usuario,
min(lg.created) AS Entrada,
max(lg.created) AS Salida
FROM ses_Log lg
WHERE lg.created > DATE_SUB(NOW(),INTERVAL 1 MONTH) AND lg.serverName="svp.securityandvision.com"
GROUP BY lg.userLogin, DATE_FORMAT(lg.created,"%Y-%m-%d");';
$query = Yii::app()->db->createCommand($query_A)->queryall();
$fp = fopen('php://temp', 'w');

$headers = array(
    'Servidor',
    'Usuario',
    'Entrada',
    'Salida',
);
fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);


foreach ($query as $result ){

    $reportRow = array();

    $reportRow[] =$result['Servidor'];
    $reportRow[] =$result['Usuario'];
    $reportRow[] =$result['Entrada'];
    $reportRow[] =$result['Salida'];

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);


}
rewind($fp);
Yii::app()->request->sendFile("Log_Ingreso" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);



header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=export.csv');
?>