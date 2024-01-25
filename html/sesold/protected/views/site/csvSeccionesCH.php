<?php

$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'Referencia',
    'Seccion',
    'Nombre',
    'Comentario',
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

//The Admin user can export up to 200 records
//filtro de lo que exporta!!!!
$customerUser = Yii::app()->user->arUser->customerId;

$query_A='SELECT bck.code, vtst.name AS Secciones, CONCAT(bck.firstName," ",bck.lastName) AS Nombre,  vts.comments
        FROM ses_BackgroundCheck bck 
        JOIN ses_VerificationSection vts ON bck.id=vts.backgroundCheckId
        JOIN ses_VerificationSectionType vtst ON vtst.id=vts.verificationSectionTypeId
        WHERE vts.resultId=3 AND bck.customerId="'.$customerUser.'"  AND bck.studyStartedOn>="'.$_GET['from'].'" AND bck.studyStartedOn<="'.$_GET['until'].'"
        ORDER BY Secciones ASC';
$RegSecciones= Yii::app()->db->createCommand($query_A)->queryAll();


//WebUser::logAccess("Exporto " . count($models) . " estudios a un CSV.");
foreach ($RegSecciones as $result ){

    $reportRow = array();

    $reportRow[] =$result['code'];
    $reportRow[] =$result['Secciones'];
    $reportRow[] =$result['Nombre'];
    $reportRow[] =$result['comments'];

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Secciones con Hallazgo" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
