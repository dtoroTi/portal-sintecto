<?php

$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'Grupo de Cliente',
    'Cliente',
    'Referencia',
    'Estado',
    'Resultado',
    'Ruc',
    'Exporta',
    'Código Pais',
    'Nombre Pais',
    'Listado Paises',
    'Fecha',
    'Monto',
    'Moneda',
    'Porcentaje',   
);

$row = array();
foreach ($headers as $header) {
    if (is_array($header)) {
        $row[] = DetailImport::model()->getAttributeLabel($header['header']);
    } else {
        $row[] = DetailImport::model()->getAttributeLabel($header);
    }
}
fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);

//WebUser::logAccess("Exporto " . count($models) . " estudios a un CSV.");
foreach ($sectionExport as $result ){


    $reportRow = array();

    $reportRow[] =$result['Grupo_Cliente'];
    $reportRow[] =$result['Cliente'];
    $reportRow[] =$result['Codigo'];
    $reportRow[] =$result['Estado'];
    $reportRow[] =$result['resultado'];
    $reportRow[] =$result['Ruc'];
    $reportRow[] =$result['Export'];
    $reportRow[] =$result['CountryCode'];
    $reportRow[] =$result['CountryName'];
    $reportRow[] =$result['CountryList'];
    $reportRow[] =$result['AsOfDate'];
    $reportRow[] =$result['Amount'];
    $reportRow[] =$result['Currency'];
    $reportRow[] =$result['Percentage'];

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Sec_Exportaciones_Coface" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
