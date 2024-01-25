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
    'ruc',
    'Apellido',
    'Primer nombre',
    'Título',
    'Código de funcionario',
    'Función',
    'Profesión',
    'Sexo',
    'Fecha de nacimiento',
    'Codigo de area',
    'Ciudad',
    'Calle',
    'Número de casa',
    'País',
    'Estado civil',
    '2do Documento de identidad',
    'Activo desde',
    'Email',   
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
foreach ($sectionContactPerson as $result ){


    $reportRow = array();

    $reportRow[] =$result['Grupo_Cliente'];
    $reportRow[] =$result['Cliente'];
    $reportRow[] =$result['backcliente'];
    $reportRow[] =$result['backidnumber'];
    $reportRow[] =$result['Codigo'];
    $reportRow[] =$result['Estado'];
    $reportRow[] =$result['resultado'];
    $reportRow[] =$result['ruc']; 
    $reportRow[] =$result['lastName']; 
    $reportRow[] =$result['firstName'];
    $reportRow[] =$result['title'];
    $reportRow[] =$result['functionaryCode']; 
    $reportRow[] =$result['function']; 
    $reportRow[] =$result['profession']; 
    $reportRow[] =$result['sex']; 
    $reportRow[] =$result['birthdate']; 
    $reportRow[] =$result['areaCode']; 
    $reportRow[] =$result['city']; 
    $reportRow[] =$result['street']; 
    $reportRow[] =$result['housenumber']; 
    $reportRow[] =$result['country']; 
    $reportRow[] =$result['maritalstate']; 
    $reportRow[] =$result['personalID2']; 
    $reportRow[] =$result['activeSince']; 
    $reportRow[] =$result['email']; 

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Sec_Persona_Contacto_Coface" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
