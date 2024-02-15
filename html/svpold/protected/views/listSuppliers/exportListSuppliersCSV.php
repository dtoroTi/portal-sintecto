<?php 

// init operation
$fp = fopen('php://temp', 'w');

$headers = array(
    'Nombre',
    'Tipo de Documento',
    'Numero de Documento',
    'Telefono',
    'Email',
    'Ciudad de Servicio',
    'Direccion',
    'Tarifa',
    'Servicio Prestado'
);

fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);
$rows = 0;

foreach ($exportSuppliersReports as $SuppliersReports) {

    $reportRow = array();
    $reportRow['name'] = $SuppliersReports->name;
    $reportRow['typeDoc'] = $SuppliersReports->typeDoc;
    $reportRow['document'] = $SuppliersReports->document;
    $reportRow['phone'] = $SuppliersReports->phone;
    $reportRow['email'] = $SuppliersReports->email;
    $reportRow['cityService'] = $SuppliersReports->cityService;
    $reportRow['address'] = $SuppliersReports->address;
    $reportRow['price'] = $SuppliersReports->price;
    $reportRow['serviceProvidedId'] = $SuppliersReports->serviceProvided->name;

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
    $rows++;
}

webUser::logAccess("Exporto reporte Listado de Proveedores " . $rows . " filas.");

rewind($fp);

Yii::app()->request->sendFile("Reports_listado_proveedores" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);