<?php

$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'Grupo de Cliente',
    'Cliente',
    'Nombre Cliente',
    'RUC',
    'Referencia',
    'Estado',
    'Resultado',
    'Documento de Identidad / RUC',
    'Tipo Accionista',
    'Nombre Accionista',
    'Pais Accionista',
    'Porcentaje de participación',
    'Codigo de funcionario',
    'Funcion',
    'Tiene acciones en',
    'ID del nombre del titular de la acción',
    'Activo desde',   
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
foreach ($sectionShareHolders as $result ){


    $reportRow = array();

    $reportRow[] =$result['Grupo_Cliente'];
    $reportRow[] =$result['Cliente'];
    $reportRow[] =$result['lastName'];
    $reportRow[] =$result['idNumber'];
    $reportRow[] =$result['Codigo'];
    $reportRow[] =$result['Estado'];
    $reportRow[] =$result['resultado'];
    $reportRow[] =$result['ruc']; 
    $reportRow[] =$result['shareHolderType']; 
    $reportRow[] =$result['shareHolderName'];
    $reportRow[] =$result['shareHolderCountry'];
    $reportRow[] =$result['ownerShipPercentage']; 
    $reportRow[] =$result['functionaryCode']; 
    $reportRow[] =$result['function']; 
    $reportRow[] =$result['hasSharesIn']; 
    $reportRow[] =$result['shareHolderNameID']; 
    $reportRow[] =$result['activeSince']; 

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Sec_Accionistas_Coface" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
