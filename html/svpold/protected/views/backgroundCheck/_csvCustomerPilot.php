<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'Cliente',
    'Tipo Cliente',
    'Tipo producto',
    'Referencia',
    'No. ID',
    'Candidato',
    'Última hora de Entrega por OPS',
    'Aprob. En',
    'Fecha Publicado',
    'Hora Publicado',
    'Entrgado a',
    'Limite Días Cliente',
    'Días Usados'
);

fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);
$rows = 0;

//var_dump($exportAssingSectionMasive);
//die();
foreach ($exportCustomerPilot as $customerPilot) {

    $from = $customerPilot['studyStartedOn'];
    $until = $customerPilot['deliveredToCustomerOn'];
    $daysStudy=Holiday::numOfWorkingDays($from, $until);

    if($customerPilot['maxDays']==null || $customerPilot['maxDays']=="" || $customerPilot['maxDays']==0){
        $diasClient=0;
    }else{
        $diasClient=$customerPilot['maxDays'];
    }

    if($customerPilot['Aprobado']==$customerPilot['Publicado'] && $customerPilot['horPublicado']<='18:00:00' && $daysStudy<=$diasClient){
        $entregado="A Tiempo";
    }else if(($customerPilot['horTerminado']<='17:30:00' && $customerPilot['horPublicado']>'18:00:00' && $daysStudy<=$diasClient && $customerPilot['maxTerminado']==$customerPilot['Publicado']) || ($customerPilot['maxTerminado']<$customerPilot['Publicado'] && $daysStudy<=$diasClient)){
        $entregado="Fuera de Tiempo por Publicación";
    }else if($customerPilot['horTerminado']>'17:30:00' && $customerPilot['maxTerminado']==$customerPilot['Publicado'] ||  $daysStudy>$diasClient){
        $entregado="Cerrado Fuera de Tiempo por OPS";
    }

    if($customerPilot['isPilot']==1){
        $piloto="Plan Piloto";
    }else{
        $piloto="";
    }

    /* @var $pendingReport BackgroundCheck */
    $reportRow = array();
    $reportRow[] = $customerPilot['cliente'];
    $reportRow[] = $piloto;
    $reportRow[] = $customerPilot['producto'];
    $reportRow[] = $customerPilot['ref'] ;
    $reportRow[] = $customerPilot['idNumber'];
    $reportRow[] = $customerPilot['candidato'];
    $reportRow[] = $customerPilot['entrega'];
    $reportRow[] = $customerPilot['approvedOn'];
    $reportRow[] = $customerPilot['deliveredToCustomerOn'];
    $reportRow[] = $customerPilot['horPublicado'];
    $reportRow[] = $entregado;
    $reportRow[] = $diasClient;
    $reportRow[] = $daysStudy;

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
    $rows++;
}

WebUser::logAccess("Exporto Clientes Plan Piloto" . $rows . " filas.");


rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Reports_clientes_PlanPiloto_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
