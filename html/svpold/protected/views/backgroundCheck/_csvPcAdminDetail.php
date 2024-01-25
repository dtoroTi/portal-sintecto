<?php

//init operation
$fp = fopen('php://temp', 'w');


$assignedUser=new AssignedUser();
$assignedUser->backgroundCheckSearch=$backgroundCheck;


$headers = array(
    'backgroundCheck.customer.customerGroup.name',
    'backgroundCheck.customer.name',
    'backgroundCheck.customer.segment',
    'backgroundCheck.customer.businessLine',
    'backgroundCheck.code',
    'backgroundCheck.customerProduct.name',
    'backgroundCheck.customerProduct.contract_Limit',
    'backgroundCheck.firstName',
    'backgroundCheck.lastName',
    'backgroundCheck.idNumber',
    'user.username',
    'user.firstName',
    'user.lastName',
    'userRole.name',
    'verificationSection.verificationSectionType.name',
    'assignedAt',
    'limitAt',
    'finishedAt',
    'verificationSection.numberOfVerifications',

);


HtmlHelper::sendCsvFile($assignedUser, $headers, "Asignaciones_" . date("Ymd_His"), null, true,'searchWithBackgroundCheck');
