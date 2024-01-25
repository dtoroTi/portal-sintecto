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
    'Redes sociales',
    'Referencias comerciales',
    'Condiciones de pago',
    'Experiencia de pago',
    'Nombre del Proveedor',
    'Notas',
    'Proveedor del estado',
    'Proveedor Incumplido',
    'Historia',
    'Compañías vinculadas',
    'Nombre',
    'Identificación tributaria ID',
    'País de Origen',
    'Pocentaje de relación',
    'Marcas registradas',
    'Identificación de marcas: Propio, Franquicia u otro',
    'Registro de bolsa de valores',
    'Mercado',
    'Pólizas de seguro',
    'Publicaciones de prensa',
    'Información negativa',
    'Deudas registradas',
    'Clasificaciones - rankings',
    'Casos judiciales registrados',

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
foreach ($sectionComments as $result ){


    $reportRow = array();

    $reportRow[] =$result['Grupo_Cliente'];
    $reportRow[] =$result['Cliente'];
    $reportRow[] =$result['lastName'];
    $reportRow[] =$result['idNumber'];
    $reportRow[] =$result['Codigo'];
    $reportRow[] =$result['Estado'];
    $reportRow[] =$result['resultado'];
    $reportRow[] =$result['ruc'];  
    $reportRow[] =$result['socialNetworks']; 
    $reportRow[] =$result['commercialReferences'];  
    $reportRow[] =$result['paymentConditions'];  
    $reportRow[] =$result['checkoutExperience'];  
    $reportRow[] =$result['providersName'];  
    $reportRow[] =$result['grades'];  
    $reportRow[] =$result['stateProvider'];  
    $reportRow[] =$result['incompleteProvider'];  
    $reportRow[] =$result['history'];  
    $reportRow[] =$result['relatedCompanies'];  
    $reportRow[] =$result['name'];  
    $reportRow[] =$result['taxIdentification'];  
    $reportRow[] =$result['countryOrigin'];  
    $reportRow[] =$result['relationshipPercentage'];  
    $reportRow[] =$result['trademarks'];  
    $reportRow[] =$result['identificationBrands'];  
    $reportRow[] =$result['stockExchangeReg'];  
    $reportRow[] =$result['market'];  
    $reportRow[] =$result['insurancePolicies'];  
    $reportRow[] =$result['pressReleases'];  
    $reportRow[] =$result['negativeInformation'];  
    $reportRow[] =$result['registeredDebts'];  
    $reportRow[] =$result['classificationsRankings'];  
    $reportRow[] =$result['registeredCourtCases'];  

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Sec_Comentarios_Coface" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
