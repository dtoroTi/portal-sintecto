<?php

$query_A = 'SELECT ctg.name as namegoup, ct.name as nameclient, ct.businessLine as namebusinessLine, ct.isActive as ActiveClient, ctu.username, ctu.firstName, ctu.lastName, ctu.isActive, ctu.created, ctu.lastLogin, ct.segment FROM ses_CustomerUser ctu
JOIN ses_Customer ct ON ct.id=ctu.customerId
JOIN ses_CustomerGroup ctg ON ctg.id=ct.customerGroupId;';
$query = Yii::app()->db->createCommand($query_A)->queryall();
$fp = fopen('php://temp', 'w');

$headers = array(
    'Grupo_Cliente',
    'Cliente',
    'Segmento',
    'Linea de Negocio Cliente',
    'Cliente Activo',
    'Usuario',
    'Nombre',
    'Apellido',
    'Creado',
    'Ultimo_Ingreso',
    'Activo',
);
fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);
$Activo= array(
    0=>'NO',
    1=>'SI',
);
$ActivoCli= array(
    ''=>'N/A',
    0=>'NO',
    1=>'SI',
);

foreach ($query as $result ){

    $reportRow = array();

    $reportRow[] =$result['namegoup'];
    $reportRow[] =$result['nameclient'];
    $reportRow[] =$result['segment'];
    $reportRow[] =$result['namebusinessLine'];
    $reportRow[] =$ActivoCli[$result['ActiveClient']];
    $reportRow[] =$result['username'];
    $reportRow[] =$result['firstName'];
    $reportRow[] =$result['lastName'];
    $reportRow[] =$result['created'];
    $reportRow[] =$result['lastLogin'];
    $reportRow[] =$Activo[$result['isActive']];

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);


}
rewind($fp);
Yii::app()->request->sendFile("Usuarios_Clientes" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);



header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=export.csv');
?>