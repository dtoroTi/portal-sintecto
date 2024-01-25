<?php

$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */

$headers = array(
    'Id Tus Datos',
    'Tipo Id',
    'Número Id',
    'Fecha Expedición',
    'Nombre',
    'Fecha',
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

// The Admin user can export up to 200 records
//filtro de lo que exporta!!!!
$customerUser = Yii::app()->user->arUser->customerId;


$query_A='SELECT tusdatosId, tipe_Id, numberId, dateExpirationDoc, name, created FROM ses_InquiriesTDT WHERE customerId="'.$customerUser.'"';
$RegTusdatos = Yii::app()->db->createCommand($query_A)->queryAll();


//WebUser::logAccess("Exporto " . count($models) . " estudios a un CSV.");
foreach ($RegTusdatos as $result ){

    $reportRow = array();

    $reportRow[] =$result['tusdatosId'];
    $reportRow[] =$result['tipe_Id'];
    $reportRow[] =$result['numberId'];
    $reportRow[] =$result['dateExpirationDoc'];
    $reportRow[] =$result['name'];
    $reportRow[] =$result['created'];

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Historial_TusDatos".date("Ymd_His").".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);

?>