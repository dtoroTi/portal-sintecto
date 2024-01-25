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
    'Nombre de la compañia',
    'Nombre corto de la empresa',
    'RUC',
    'Número de expediente',
    'País de registro',
    'Forma Lega',
    'Forma Legal Texto',
    'Fecha de la investigacion',
    'Numero TAX',
    'Actividad',
    'Actividad economica principal NACE',
    'Actividad',
    'Actividad economica NACE',
    'Actividad',
    'Actividad economica NACE',
    'Fecha de capital social',
    'Capital social original',
    'Moneda original del capital social',
    'Empleados',
    'Fecha Empleados',
    'Fecha de registro ',
    'Fecha de constitución de la empresa',
    'Estado de actividad',
    'Fecha de estado de actividad',
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
foreach ($sectionCompany as $result ){


    $reportRow = array();

    $reportRow[] =$result['Grupo_Cliente'];
    $reportRow[] =$result['Cliente'];
    $reportRow[] =$result['lastName'];
    $reportRow[] =$result['idNumber'];
    $reportRow[] =$result['Codigo'];
    $reportRow[] =$result['Estado'];
    $reportRow[] =$result['resultado'];
    $reportRow[] =$result['companyName']; 
    $reportRow[] =$result['companyShortName']; 
    $reportRow[] =$result['ruc']; 
    $reportRow[] =$result['registrationNumber']; 
    $reportRow[] =$result['registrationCountry'];
    $reportRow[] =$result['legalForm'];
    $reportRow[] =$result['legalFormText']; 
    $reportRow[] =$result['validityDate']; 
    $reportRow[] =$result['taxNumber']; 
    $reportRow[] =$result['nace1']; 
    $reportRow[] =$result['nace1Text']; 
    $reportRow[] =$result['nace2']; 
    $reportRow[] =$result['nace2Text']; 
    $reportRow[] =$result['nace3']; 
    $reportRow[] =$result['nace3Text']; 
    $reportRow[] =$result['usdShareCapitalDate']; 
    $reportRow[] =$result['originalShareCapital']; 
    $reportRow[] =$result['originalShareCapitalCurrency']; 
    $reportRow[] =$result['employees']; 
    $reportRow[] =$result['employeesDate']; 
    $reportRow[] =$result['registrationDate']; 
    $reportRow[] =$result['establishedDate']; 
    $reportRow[] =$result['activityStatus']; 
    $reportRow[] =$result['activityStatusDate']; 

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Sec_Compañia_Coface" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
