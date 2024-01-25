<?php

$query_A = 'SELECT ctg.name AS namegrupocliente, ct.name AS namecliente, ct.businessLine AS namebusinessLine, bk.idNumber, bk.lastName, bk.code, vs.sectionBool, tk.* FROM ses_Tracking tk
JOIN ses_VerificationSection vs ON vs.id=tk.verificationSectionId
JOIN ses_BackgroundCheck bk ON bk.id=vs.backgroundCheckId
JOIN ses_Customer ct ON ct.id=bk.customerId
JOIN ses_CustomerGroup ctg ON ctg.id=ct.customerGroupId
WHERE tk.DateContact  BETWEEN NOW() - INTERVAL 2 MONTH AND NOW();';
$query = Yii::app()->db->createCommand($query_A)->queryall();
$fp = fopen('php://temp', 'w');

$headers = array(
    'Grupo_Cliente',
    'Cliente',
    'Linea de Negocio Cliente',
    'Codigo',
    'Identificación',
    'Nombre',
    'Estado del Proceso',
    'Fecha de Contacto',
    'Responsable',
    'Nombre del Contacto',
    'Correo',
    'Telefono',
    'Estado del Contacto',
    'Observaciones',
);
fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);
$estadoproc= array(
    0=>'Pagado',
    1=>'Pago en trámite',
    2=>'Pendiente confirmación de Pago',
    3=>'Documentos completos',
    4=>'Documentos incompletos',
    5=>'Subsanación completa',
    6=>'Subsanación incompleta',
    7=>'No realiza subsanación',
    8=>'Se envía invitación',
    9=>'Cancelado',
    10=>'Desiste del proceso',
);

foreach ($query as $result ){

    $reportRow = array();
    $reportRow[] =$result['namegrupocliente'];
    $reportRow[] =$result['namecliente'];
    $reportRow[] =$result['namebusinessLine'];
    $reportRow[] =$result['code'];
    $reportRow[] =$result['idNumber'];
    $reportRow[] =$result['lastName'];
    $reportRow[] =$estadoproc[$result['sectionBool']];
    $reportRow[] =$result['DateContact'];
    $reportRow[] =$result['Responsible'];
    $reportRow[] =$result['NameContact'];
    $reportRow[] =$result['Email'];
    $reportRow[] =$result['Number'];
    $reportRow[] =$result['ContactStatus'];
    $reportRow[] =$result['Observations'];


    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);


}
rewind($fp);
Yii::app()->request->sendFile("Seguimiento_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);



header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=export.csv');
?>