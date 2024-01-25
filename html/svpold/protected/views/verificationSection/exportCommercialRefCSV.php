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
    'Comentario',
    'Razon social',
    'TAX ID cliente',
    'Año de vinculación',
    'Linea de credito otorgada',
    'Terminos de pago',
    'Metodo de pago',
    'Fecha de ultima compra',
    'Importe de ultima compra',
    'Promedio de compra mensual',
    'Cartera vencida',
    'Promedio de días vencidos',
    'Producto / Servicios que proveen',
    'Concepto',
    'Razon social',
    'TAX ID empresa',
    'Telefono contactado',
    'Persona contactada',
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
foreach ($sectionCommercialRef as $result ){


    $reportRow = array();

    $reportRow[] =$result['Grupo_Cliente'];
    $reportRow[] =$result['Cliente'];
    $reportRow[] =$result['lastName'];
    $reportRow[] =$result['idNumber'];
    $reportRow[] =$result['Codigo'];
    $reportRow[] =$result['Estado'];
    $reportRow[] =$result['resultado'];
    $reportRow[] =$result['comments'];
    $reportRow[] =$result['companyName']; 
    $reportRow[] =$result['taxIdClient']; 
    $reportRow[] =$result['yearConnection'];
    $reportRow[] =$result['lineCreditGranted'];
    $reportRow[] =$result['paymentTerms']; 
    $reportRow[] =$result['paymentMethod']; 
    $reportRow[] =$result['dateLastPurchase']; 
    $reportRow[] =$result['lastPurchaseAmount']; 
    $reportRow[] =$result['averageMonthlyPurchase']; 
    $reportRow[] =$result['pastPortfolio'];
    $reportRow[] =$result['averageDaysPastDue'];
    $reportRow[] =$result['productServiceProvide']; 
    $reportRow[] =$result['concept']; 
    $reportRow[] =$result['socialName']; 
    $reportRow[] =$result['taxIdCompany']; 
    $reportRow[] =$result['contactedPhone']; 
    $reportRow[] =$result['contactedPerson']; 
    $reportRow[] =$result['email']; 

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Sec_Ref_Comerciales_Coface" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
