<?php

$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'Cliente',
    'Usuario',
    'Referencia',
    'Laboral',
    'Laboral PQR',
    'Laboral PNC',
    'Academico',
    'Academico PQR',
    'Academico PNC',
    'Financiero',
    'Financiero PQR',
    'Financiero PNC',
    'Adversos',
    'Adversos PQR',
    'Adversos PNC',
    'Visita',
    'Visita PQR',
    'Visita PNC',
    'Poligrafo',
    'Poligrafo PQR',
    'Poligrafo PNC',
    'Pruebas Psicotecnicas',
    'Pruebas Psicotecnicas PQR',
    'Pruebas Psicotecnicas PNC',
    'Referencias',
    'Referencias PQR',
    'Referencias PNC',
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
foreach ($csvQualitys as $result ){

    $reportRow = array();

    $reportRow[] =$result['nombre'];
    $reportRow[] =$result['Usuario'];
    $reportRow[] =$result['Referencia'];
    $reportRow[] =$result['Laboral'];
    $reportRow[] =$result['LaboralPQR'];
    $reportRow[] =$result['LaboralPNC'];
    $reportRow[] =$result['Academico'];
    $reportRow[] =$result['AcademicoPQR'];
    $reportRow[] =$result['AcademicoPNC'];
    $reportRow[] =$result['Financiero'];
    $reportRow[] =$result['FinancieroPQR'];
    $reportRow[] =$result['FinancieroPNC'];
    $reportRow[] =$result['Adversos'];
    $reportRow[] =$result['AdversosPQR'];
    $reportRow[] =$result['AdversosPNC'];
    $reportRow[] =$result['Visita'];
    $reportRow[] =$result['VisitaPQR'];
    $reportRow[] =$result['VisitaPNC'];
    $reportRow[] =$result['Poligrafo'];
    $reportRow[] =$result['PoligrafoPQR'];
    $reportRow[] =$result['PoligrafoPNC'];
    $reportRow[] =$result['Pruebas_Psicotecnicas'];
    $reportRow[] =$result['PruebaPQR'];
    $reportRow[] =$result['PruebaPNC'];
    $reportRow[] =$result['Reference'];
    $reportRow[] =$result['ReferencePQR'];
    $reportRow[] =$result['ReferencePNC'];

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Calidad" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
