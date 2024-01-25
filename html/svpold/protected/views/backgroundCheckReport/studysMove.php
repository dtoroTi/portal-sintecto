<?php

$query_A = 'SELECT ctg.NAME AS Grupo_Cliente, ct.NAME AS Cliente, ctp.NAME AS Producto, ctp.price as Precio, ctp.maxDays, bk.CODE, bk.idNumber, usr.username AS Creado_Por, bk.studyLimitOn AS Limite_Actual, lgt.comments as Fecha_Anterior, evt.eventTypeId as Tipo_Novedad, evt.detail as Novedad  FROM ses_BackgroundCheck bk 
JOIN ses_Customer ct ON ct.id=bk.customerId
JOIN ses_CustomerGroup ctg ON ctg.id=ct.customerGroupId
JOIN ses_CustomerProduct ctp ON ctp.id=bk.customerProductId
JOIN ses_Log lgt ON lgt.backgroundCheckCode=bk.code
LEFT JOIN ses_Event evt ON evt.backgroundCheckId=bk.id
JOIN ses_User usr on usr.id=evt.createdById
WHERE bk.resultId=1 AND lgt.comments LIKE "%Fecha Limite de creacion: %";';
$query = Yii::app()->db->createCommand($query_A)->queryall();
$fp = fopen('php://temp', 'w');

$headers = array(
    'Grupo_Cliente',
    'Cliente',
    'Producto',
    'Precio',
    'Dias',
    'Codigo',
    'ID',
    'Tipo de Novedad',
    'Novedad',
    'Creado Por:',
    'Fecha Limite Actual',
    'Fecha Limite Anterior',
    'Coincide',
);
fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);
$tipeNovedad= array(
    null=>"",
    1=> "Impacto",
    2=> "Informativa",
);

    foreach ($query as $result ){
        $divisor="/";

        $toreplace = array("Fecha Limite de creacion: ");
        $Fecha_Anterior = str_replace($toreplace, "", $result['Fecha_Anterior']);

        $prueba1 = $reportRow[] =substr($Fecha_Anterior, 0, 10); //$Fecha_Anterior;//substr($result['Fecha_Anterior'], -10);
        $prueba2 = $reportRow[] =substr($result['Limite_Actual'],0, 10);//$result['Limite_Actual'];

        $fechAnterior= str_replace($divisor,"-",$prueba1);
        $fechActual= str_replace($divisor,"-",$prueba2);

       // var_dump($fechAnterior);
       // var_dump($fechActual);

        $reportRow = array();

        $reportRow[] =$result['Grupo_Cliente'];
        $reportRow[] =$result['Cliente'];
        $reportRow[] =$result['Producto'];
        $reportRow[] =$result['Precio'];
        $reportRow[] =$result['maxDays'];
        $reportRow[] =$result['CODE'];
        $reportRow[] =$result['idNumber'];
        $reportRow[] =$tipeNovedad[$result['Tipo_Novedad']];
        $reportRow[] =$result['Novedad'];
        $reportRow[] =$result['Creado_Por'];
        $reportRow[] =$result['Limite_Actual'];

        $toreplace = array("Fecha Limite de creacion: ");
        $Fecha_Anterior = str_replace($toreplace, "", $result['Fecha_Anterior']);
        $reportRow[] =$Fecha_Anterior; //substr($result['Fecha_Anterior'], -19);

        if($fechAnterior==$fechActual){
            $reportRow[] = $ans="SI";
        }else{
            $reportRow[] = $ans="NO";
        }

        fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
}


rewind($fp);
Yii::app()->request->sendFile("Estudios_Movidos" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);



header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=export.csv');
?>