<?php

//init operation
$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'Vendedor',
    'Grupo',
    'Sector',
    'Tamaño',
    'Comercial',
    'Cliente',
    'Linea de negocio por cliente',
    'NIT',
    'SAC',
    'Clasificacion',
    'Fecha de incremento IPC',
    'Valor cliente año anterior',
    'Precio fase 1',
    'Categoria',
    'Fecha fase 1',
    'Precio fase 2',
    'Categoria',
    'Fecha fase 2',
    'Precio fase 3',
    'Categoria',
    'Fecha fase 3',    
    'Relación comercial',
    'Pólizas',
    'Otro sí',
    'Canal de ingreso',
    'Segmento',
    'Tipo de Cliente',
    'Incremental',
    'Producto',
    'Tipo de Producto',
    'Incremental Product',
    'Componentes',
    'Valor U',
    'Facturdo en ' . $previous3Month,
    'Facturdo en ' . $previous2Month,
    'Facturdo en ' . $previousMonth,
    'Facturdo en ' . $thisMonth,
    'Facturdo en ' . $nextMonth,
    'Publicado en ' . $previous3Month,
    'Publicado en ' . $previous2Month,
    'Publicado en ' . $previousMonth,
    'Publicado en ' . $thisMonth,
    'Publicado en ' . $todayPM1D,
    'Publicado en ' . $today,
    'Vence En ' . $today,
    'Vence En ' . $todayP1D,
    'Vence En ' . $todayP2D,
    'Vence En ' . $todayP3D,
    'Vence En ' . $thisMonth,
    'En Ejecución Total',
    'Total finalizados',
    'Total en ejecucion',
    'Iniciaron En ' . $todayPM1D,
    'Iniciaron En ' . $today,
    'Inicio Contrato',
    'Finalizacion Contrato',
);



fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);

foreach ($customerProducts as $id => $rowProd) {
    $row = $rowProd['data'];
    $tipocliente = 'Antiguo';
    $reportRow = array();
    if ($id[0] == 'b') {
        $customerProduct = $rowProd['prod'];
        $customerGroup = $customerProduct->customer->customerGroup;
        $productName = $customerProduct->shortName;
    } else {
        $customerProduct = null;
        $customerGroup = $customerGroupArr[$rowProd['customerGroupId']];
        $productName = $rowProd['data']['productName'];
    }

    $yearDateNow = date('Y');
    $createdCustomerStr =@$customerProduct->customer->created;
    $createdCustomer = new DateTime($createdCustomerStr);
    $yearCreatedCustomer =  $createdCustomer->format('Y');
    if ($yearDateNow == $yearCreatedCustomer){
        $tipocliente = 'Nuevo';
    };


    $reportRow[] = @$customerProduct->customer->salesman->name;
   // $reportRow[] = @$customerGroup->user->name;
    $reportRow[] = @$customerGroup->name;
    $reportRow[] = @$customerGroup->economicSector;
    $reportRow[] = @$customerGroup->sizeGroup;
    $reportRow[] = @$customerGroup->user2->name;
    $reportRow[] = @$customerProduct->customer->name;
    $reportRow[] = @$customerProduct->customer->businessLine;
    $reportRow[] = @$customerProduct->customer->Idcustomer;
    $reportRow[] = @$customerProduct->customer->sac->name;
    $reportRow[] = @$customerProduct->customer->customerClassification;
    $reportRow[] = @$customerProduct->customer->increaseDateIPC;
    $reportRow[] = @$customerProduct->priceYearAnt;
    $reportRow[] = @$customerProduct->priceFase1;
    $reportRow[] = @$customerProduct->listFase1;
    $reportRow[] = @$customerProduct->dateFase1;
    $reportRow[] = @$customerProduct->priceFase2;
    $reportRow[] = @$customerProduct->listFase2;
    $reportRow[] = @$customerProduct->dateFase2;
    $reportRow[] = @$customerProduct->priceFase3;
    $reportRow[] = @$customerProduct->listFase3;
    $reportRow[] = @$customerProduct->dateFase3;
    $reportRow[] = @$customerProduct->customer->businessRelationShip;
    $reportRow[] = @$customerProduct->customer->policies;
    $reportRow[] = @$customerProduct->customer->otherIf;
    $reportRow[] = @$customerProduct->customer->inputChannel;
    $reportRow[] = @$customerProduct->customer->segment;
    $reportRow[] = $tipocliente;
    $reportRow[] = @$customerProduct->customer->incremental;
    $reportRow[] = $productName;
    $reportRow[] = @$customerProduct->typeProduct->value;
    $reportRow[] = @$customerProduct->incremental;
    $reportRow[] = @$customerProduct->components;
    $reportRow[] = @$customerProduct->price;
    $reportRow[] = @$row['i_' . $previous3Month];
    $reportRow[] = @$row['i_' . $previous2Month];
    $reportRow[] = @$row['i_' . $previousMonth];
    $reportRow[] = @$row['i_' . $thisMonth];
    $reportRow[] = @$row['i_' . $nextMonth];
    $reportRow[] = @$row['p_' . $previous3Month];
    $reportRow[] = @$row['p_' . $previous2Month];
    $reportRow[] = @$row['p_' . $previousMonth];
    $reportRow[] = @$row['p_' . $thisMonth];
    $reportRow[] = @$row['finishedDayBefore'];
    $reportRow[] = @$row['finishedToday'];
    $reportRow[] = @$row['pendingToday'];
    $reportRow[] = @$row['pendingTodayP1D'];
    $reportRow[] = @$row['pendingTodayP2D'];
    $reportRow[] = @$row['pendingTodayP3D'];
    $reportRow[] = @$row['pendingThisMonth'];
    $reportRow[] = @$row['pending'];
    $reportRow[] = @$row['processFinal'];
    $reportRow[] = @$row['processEjec'];
    $reportRow[] = @$row['startedDayBefore'];
    $reportRow[] = @$row['startedToday'];
    $reportRow[] = @$customerProduct->customer->contractStartDate;
    $reportRow[] = @$customerProduct->customer->contractEndDate;
    // $reportRow[] = @$customerGroup->invoiceDay;
    // $reportRow[] = @$customerGroup->paymentTerms;

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
}

WebUser::logAccess("Exporto reporte de producctividad CSV.");


rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Reports_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
