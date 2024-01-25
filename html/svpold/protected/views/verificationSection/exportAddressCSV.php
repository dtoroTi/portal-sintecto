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
    'RUC',
    'Tipo de dirección',
    'Código postal',
    'Ciudad',
    'Barrio',
    'Dirección',
    'País',
    'Área de Teléfono',
    'Número de teléfono',
    'Área de fax',
    'Número de fax',
    'Télex',
    'Email',
    'Sitio web',
    'Teléfono Área',
    'Teléfono Área',
    'Teléfono Área',
    'Teléfono Área',
    'Número de teléfono',
    'Número de teléfono',
    'Número de teléfono',
    'Número de teléfono',
    'Línea de dirección adicional',
    'Última modificación',
    'Última modificación',   
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
foreach ($sectionAddress as $result ){


    $reportRow = array();

    $reportRow[] =$result['Grupo_Cliente'];
    $reportRow[] =$result['Cliente'];
    $reportRow[] =$result['lastName'];
    $reportRow[] =$result['idNumber'];
    $reportRow[] =$result['Codigo'];
    $reportRow[] =$result['Estado'];
    $reportRow[] =$result['resultado'];
    $reportRow[] =$result['ruc'];  
    $reportRow[] =$result['addressType']; 
    $reportRow[] =$result['zipcode'];  
    $reportRow[] =$result['city'];  
    $reportRow[] =$result['street'];  
    $reportRow[] =$result['houseNumber'];  
    $reportRow[] =$result['country'];  
    $reportRow[] =$result['telephoneArea'];  
    $reportRow[] =$result['telephoneNumber'];  
    $reportRow[] =$result['faxArea'];  
    $reportRow[] =$result['faxNumber'];  
    $reportRow[] =$result['telex'];  
    $reportRow[] =$result['email'];  
    $reportRow[] =$result['webSite'];  
    $reportRow[] =$result['telephoneArea2'];  
    $reportRow[] =$result['telephoneArea3'];  
    $reportRow[] =$result['telephoneArea4'];  
    $reportRow[] =$result['telephoneArea5'];  
    $reportRow[] =$result['telephoneNumber2'];  
    $reportRow[] =$result['telephoneNumber3'];  
    $reportRow[] =$result['telephoneNumber4'];  
    $reportRow[] =$result['telephoneNumber5'];  
    $reportRow[] =$result['additionalAddressLine'];  
    $reportRow[] =$result['lastChangedOn'];  
    $reportRow[] =$result['region'];  
    
    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Sec_Direccion_Coface" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
