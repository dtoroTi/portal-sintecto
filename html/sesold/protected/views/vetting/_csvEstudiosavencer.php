<?php  /*

//$model = CustomerGroup::model()->findByPk();
//$model->customerGroupId =  Yii::app()->user->arUser->customer->customerGroupId;
//$model = BackgroundCheck::model()->findAll();

//$model->customerId = Yii::app()->user->arUser->customerId;
$prueba='449';

$query_A = 'SELECT ct.name, bck.code, bck.idNumber, bck.firstName, bck.lastName, bck.expireIn FROM ses_BackgroundCheck bck
JOIN ses_Customer ct ON ct.id=bck.customerId
JOIN ses_CustomerGroup cg ON cg.id=ct.customerGroupId
WHERE bck.expireIn BETWEEN NOW() AND NOW() + INTERVAL 6 MONTH AND ct.customerGroupId = "'.$prueba.'";';
$query = Yii::app()->db->createCommand($query_A)->queryall();
$fp = fopen('php://temp', 'w');

$headers = array(

    'Cliente',
    'Referencia',
    'ID',
    'Nombre',
    'Apellido',
    'Vencimiento',
);
fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);


foreach ($query as $result ){

    $reportRow = array();


    $reportRow[] =$result['name'];
    $reportRow[] =$result['code'];
    $reportRow[] =$result['idNumber'];
    $reportRow[] =$result['firstName'];
    $reportRow[] =$result['lastName'];
    $reportRow[] =$result['expireIn'];


   fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

}
rewind($fp);
Yii::app()->request->sendFile("Proximos a vencer_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);



header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=export.csv');

*/


//init operation

$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'customer.name',
    'code',
    'idNumber',
    'firstName',
    'lastName',
    'expireIn',

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

// The Admin user can export up to 200 records
//filtro de lo que exporta!!!!
$model = GridViewFilter::getFilter('BackgroundCheck', 'searchCli');
    $model->customerGroupId = Yii::app()->user->arUser->customer->customerGroupId;
    $models=Yii::app()->user->arUser->customer->customerGroupId;


$query_A = 'SELECT ct.name, bck.code, bck.idNumber, bck.firstName, bck.lastName, bck.expireIn FROM ses_BackgroundCheck bck
JOIN ses_Customer ct ON ct.id=bck.customerId
JOIN ses_CustomerGroup cg ON cg.id=ct.customerGroupId
WHERE bck.expireIn BETWEEN NOW() AND NOW() + INTERVAL 3 YEAR AND ct.customerGroupId = "'.$models.'";';
$query = Yii::app()->db->createCommand($query_A)->queryall();

//WebUser::logAccess("Exporto " . count($models) . " estudios a un CSV.");
foreach ($query as $result ){

    $reportRow = array();

    $reportRow[] =$result['name'];
    $reportRow[] =$result['code'];
    $reportRow[] =$result['idNumber'];
    $reportRow[] =$result['firstName'];
    $reportRow[] =$result['lastName'];
    $reportRow[] =$result['expireIn'];

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);




rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Proximos a Vencer" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
