<?php

//$query_A = 'SELECT * FROM ses_Compliance Comp;';
//$query = Yii::app()->db->createCommand($query_A)->queryall();
$fp = fopen('php://temp', 'w');

$headers = array(
    'ID',
    'Fecha de Reporte',
    'Nombre',
    'Apellidos',
    'Dirección(Área)',
    'Nit ó Cedula',
    'Tipo de Vinculo',
    'Operación Inusual',
    'Operación Sospechosa',
    'Señal de Alerta',
    'Importancia',
    'Urgencia',
    'Moneda',
    'Otras Alertas',
    'Fuente LAFT',
    'Ausencia ROS (AROS)',
    'Trimestre del AROS (Fecha Inicial)',
    'Trimestre del AROS (Fecha Final)',
    'Tipo de Contraparte',
    'Tipo de Operación',
    'Moneda',
    'Valor de la transacción',
    'Fecha',
    'Desc Operación',
    'Analisis Interno',
    'Pers1.Apellido 1',
    'Pers1.Apellido 2',
    'Pers1.Nombre',
    'Pers1.Identificacion',
    'Pers1.Tipo Ident',
    'Pers1.Dirección',
    'Pers1.Teléfono',
    'Pers2.Apellido 1',
    'Pers2.Apellido 2',
    'Pers2.Nombre',
    'Pers2.Identificacion',
    'Pers2.Tipo Ident',
    'Pers2.Dirección',
    'Pers2.Teléfono',
    'Pers3.Apellido 1',
    'Pers3.Apellido 2',
    'Pers3.Nombre',
    'Pers3.Identificacion',
    'Pers3.Tipo Ident',
    'Pers3.Dirección',
    'Pers3.Teléfono',
    'Pers4.Apellido 1',
    'Pers4.Apellido 2',
    'Pers4.Nombre',
    'Pers4.Identificacion',
    'Pers4.Tipo Ident',
    'Pers4.Dirección',
    'Pers4.Teléfono',
    'Ent1.Razón Social',
    'Ent1.NIT',
    'Ent1.Rep Legal',
    'Ent1.Identificación',
    'Ent1.Tipo Ident',
    'Ent1.Dirección',
    'Ent1.Teléfono',
    'Ent1.CIIU',
    'Ent1.Departamento',
    'Ent1.Producto',
    'Ent1.Vinculación',
    'Ent2.Razón Social',
    'Ent2.NIT',
    'Ent2.Rep Legal',
    'Ent2.Identificación',
    'Ent2.Tipo Ident',
    'Ent2.Dirección',
    'Ent2.Teléfono',
    'Ent2.CIIU',
    'Ent2.Departamento',
    'Ent2.Producto',
    'Ent2.Vinculación',
    'Ent3.Razón Social',
    'Ent3.NIT',
    'Ent3.Rep Legal',
    'Ent3.Identificación',
    'Ent3.Tipo Ident',
    'Ent3.Dirección',
    'Ent3.Teléfono',
    'Ent3.CIIU',
    'Ent3.Departamento',
    'Ent3.Producto',
    'Ent3.Vinculación',
    'Ent4.Razón Social',
    'Ent4.NIT',
    'Ent4.Rep Legal',
    'Ent4.Identificación',
    'Ent4.Tipo Ident',
    'Ent4.Dirección',
    'Ent4.Teléfono',
    'Ent4.CIIU',
    'Ent4.Departamento',
    'Ent4.Producto',
    'Ent4.Vinculación',
    'Observ Adicionales',

);
fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);

foreach ($query as $result ){

    $reportRow = array();

    $reportRow[] =$result['id'];
    $reportRow[] =$result['dateReport'];
    $reportRow[] =$result['name'];
    $reportRow[] =$result['lastname'];
    $reportRow[] =$result['address'];
    $reportRow[] =$result['IdCompliance'];
    $reportRow[] =$result['typeLink'];
    $reportRow[] =$result['unusualOperation'];
    $reportRow[] =$result['suspiciousOperation'];
    $reportRow[] =$result['alertsignal'];
    $reportRow[] =$result['importance'];
    $reportRow[] =$result['urgency'];
    $reportRow[] =$result['currency'];
    $reportRow[] =$result['otherAlerts'];
    $reportRow[] =$result['laftsource'];
    $reportRow[] =$result['aros'];
    $reportRow[] =$result['arostimeinit'];
    $reportRow[] =$result['arostimeend'];
    $reportRow[] =$result['counterpartType'];
    $reportRow[] =$result['operationType'];
    $reportRow[] =$result['transactioncurrency'];
    $reportRow[] =$result['transactionvalue'];
    $reportRow[] =$result['transectiondate'];
    $reportRow[] =$result['description'];
    $reportRow[] =$result['analysis'];
    $reportRow[] =$result['P1lastname1'];
    $reportRow[] =$result['P1lastname2'];
    $reportRow[] =$result['P1name'];
    $reportRow[] =$result['P1id'];
    $reportRow[] =$result['P1typeid'];
    $reportRow[] =$result['P1address'];
    $reportRow[] =$result['P1tel'];
    $reportRow[] =$result['P2lastname1'];
    $reportRow[] =$result['P2lastname2'];
    $reportRow[] =$result['P2name'];
    $reportRow[] =$result['P2id'];
    $reportRow[] =$result['P2typeid'];
    $reportRow[] =$result['P2address'];
    $reportRow[] =$result['P2tel'];
    $reportRow[] =$result['P3lastname1'];
    $reportRow[] =$result['P3lastname2'];
    $reportRow[] =$result['P3name'];
    $reportRow[] =$result['P3id'];
    $reportRow[] =$result['P3typeid'];
    $reportRow[] =$result['P3address'];
    $reportRow[] =$result['P3tel'];
    $reportRow[] =$result['P4lastname1'];
    $reportRow[] =$result['P4lastname2'];
    $reportRow[] =$result['P4name'];
    $reportRow[] =$result['P4id'];
    $reportRow[] =$result['P4typeid'];
    $reportRow[] =$result['P4address'];
    $reportRow[] =$result['P4tel'];
    $reportRow[] =$result['E1businessname'];
    $reportRow[] =$result['E1nit'];
    $reportRow[] =$result['E1replegal'];
    $reportRow[] =$result['E1replegalid'];
    $reportRow[] =$result['E1typeid'];
    $reportRow[] =$result['E1address'];
    $reportRow[] =$result['E1tel'];
    $reportRow[] =$result['E1ciiu'];
    $reportRow[] =$result['E1dept'];
    $reportRow[] =$result['E1product'];
    $reportRow[] =$result['E1vinculat'];
    $reportRow[] =$result['E2businessname'];
    $reportRow[] =$result['E2nit'];
    $reportRow[] =$result['E2replegal'];
    $reportRow[] =$result['E2replegalid'];
    $reportRow[] =$result['E2typeid'];
    $reportRow[] =$result['E2address'];
    $reportRow[] =$result['E2tel'];
    $reportRow[] =$result['E2ciiu'];
    $reportRow[] =$result['E2dept'];
    $reportRow[] =$result['E2product'];
    $reportRow[] =$result['E2vinculat'];
    $reportRow[] =$result['E3businessname'];
    $reportRow[] =$result['E3nit'];
    $reportRow[] =$result['E3replegal'];
    $reportRow[] =$result['E3replegalid'];
    $reportRow[] =$result['E3typeid'];
    $reportRow[] =$result['E3address'];
    $reportRow[] =$result['E3tel'];
    $reportRow[] =$result['E3ciiu'];
    $reportRow[] =$result['E3dept'];
    $reportRow[] =$result['E3product'];
    $reportRow[] =$result['E3vinculat'];
    $reportRow[] =$result['E1businessname'];
    $reportRow[] =$result['E4nit'];
    $reportRow[] =$result['E4replegal'];
    $reportRow[] =$result['E4replegalid'];
    $reportRow[] =$result['E4typeid'];
    $reportRow[] =$result['E4address'];
    $reportRow[] =$result['E4tel'];
    $reportRow[] =$result['E4ciiu'];
    $reportRow[] =$result['E4dept'];
    $reportRow[] =$result['E4product'];
    $reportRow[] =$result['E4vinculat'];
    $reportRow[] =$result['additionalremarks'];


    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);


}
WebUser::logAccess("Exporto reporte de Compliance CSV.");
rewind($fp);
Yii::app()->request->sendFile("Compliance" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);



header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=export.csv');
?>