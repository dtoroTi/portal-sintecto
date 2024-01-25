<?php

$criteria = new CDbCriteria;
        
$criteria->addCondition('t.id=:id');
$criteria->params=[':id'=>$customerId];
$usutd= Customer::model()->findAll($criteria);

foreach ($usutd as $datos ) {
    $usuarioTD=$datos['UsuarioTD'];
    $claveTD=$datos['ClaveTD'];
}

if($typeid=="NIT"){
    $url = "https://dash-board.tusdatos.co/api/v2/report_nit_pdf/" . $id;
}else{
    $url = "https://dash-board.tusdatos.co/api/v2/report_pdf/" . $id;
}
//$url = "https://dash-board.tusdatos.co/api/report_pdf/".$id;

    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));
    curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($client, CURLOPT_USERPWD, "$usuarioTD:$claveTD");

    $content = curl_exec($client);
              curl_close($client);
    $response = false;


    $fileName = "/var/www/html/sesold/protected/runtime/".$doc."_tusDatos.pdf";

    if(file_put_contents( $fileName,$content)){

            chmod($fileName, 0775);
            $response=true;

            $name = $doc."_tusDatos.pdf";
            header('Content-type: application/pdf');
            //header("Content-Type: application/force-download");
            header("Content-Disposition: attachment; filename=\"$name\"");
            readfile($fileName);  

            WebUser::logAccess("Descargo del historial de reportes un PDF de tus datos No: $doc ");
            unlink($fileName);     
    } 
?>

