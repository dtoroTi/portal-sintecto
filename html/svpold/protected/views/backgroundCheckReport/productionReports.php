<?php
$style = array(
    'table' => 'border-spacing: 0;border-collapse: collapse;padding: 0pt;font:normal 10pt Arial,Helvetica,sans-serif;',
    'trth' => 'border: 1pt solid #00518A;background-color: #00518A;color:white;',
    'thPending' => 'background-color:#95B6C5;',
    'th' => 'border: 1pt solid #FFFFFF;',
    'trtd' => 'border: 1pt solid #00518A;',
    'td' => 'border: 1pt solid #00518A;',
    'tdValue' => 'border: 1pt solid #00518A;text-align: right;',
    'trTotal' => 'margin-bottom: 0pt;border-bottom: 2pt solid #00518A;font-weight: bold;',
    'trOverdue' => 'background-color:#95B6C5;',
    'center' => 'text-align:center;'
);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body style="font:normal 10pt Arial,Helvetica,sans-serif;">
<h2>Para uso exclusivo interno</h2>
<h2>Reporte de Estudios</h2>
<br/>
<table style="<?= $style['table'] ?>">
    <thead>
    <tr style="<?= $style['trth'] ?>">
        <th colspan="5"  style="<?= $style['th'] ?>">EMPRESAS</th>
        <th colspan="<?php echo ($getPrice?7:6);?>"  style="<?= $style['th']  ?>">FACTURADO</th>
        <th colspan="11"  style="<?= $style['th']  ?>">PRODUCIDO</th>
        <th colspan="6"  style="<?= $style['th'] ?>">EJECUCION</th>
    </tr>
    <tr style="<?= $style['trth'] ?>">
        <th style="width: 80pt; <?= $style['th'] ?>">Grupo</th>
        <th style="width: 80pt; <?= $style['th'] ?>">Cliente</th>
        <th style="width: 80pt; <?= $style['th'] ?>">Linea de Negocio Cliente</th>
        <th style="width: 80pt; <?= $style['th'] ?>">Tipo Cliente</th>
        <th style="width: 80pt; <?= $style['th'] ?>">Product</th>
        <th style="width: 80pt; <?= $style['th'] ?>">Linea de Negocio Producto</th>
        <th style="width: 50pt; <?= $style['th'] ?>">Comp.</th>
        <?php if ($getPrice): ?>
            <th style="width: 70pt; <?= $style['th'] ?>">Valor U</th>
        <?php endif; ?>
        <th style="width: 80pt; <?= $style['th'] ?>"><?php echo CHtml::encode($previous3Month) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?php echo CHtml::encode($previous2Month) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?php echo CHtml::encode($previousMonth) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?php echo CHtml::encode($thisMonth) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?php echo CHtml::encode($nextMonth) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?php echo CHtml::encode($previous3Month) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?php echo CHtml::encode($previous2Month) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?php echo CHtml::encode($previousMonth) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?php echo CHtml::encode($thisMonth) ?></th>
        <th style="width: 60pt; <?= $style['th'] ?>">Publicado en <?php echo CHtml::encode($todayPM1D) ?></th>
        <th style="width: 60pt; <?= $style['th'] ?>">Publicado en <?php echo CHtml::encode($today) ?></th>
        <th style="width: 60pt; <?= $style['th'] ?>">Vence En <?php echo CHtml::encode($today) ?></th>
        <th style="width: 60pt; <?= $style['th'] ?>">Vence En <?php echo CHtml::encode($todayP1D) ?></th>
        <th style="width: 60pt; <?= $style['th'] ?>">Vence En <?php echo CHtml::encode($todayP2D) ?></th>
        <th style="width: 60pt; <?= $style['th'] ?>">Vence En <?php echo CHtml::encode($todayP3D) ?></th>
        <th style="width: 60pt; <?= $style['th'] ?>">Vence En <?php echo CHtml::encode($thisMonth) ?></th>
        <th style="width: 60pt; <?= $style['th'] ?>">Vencido <?php echo CHtml::encode($today) ?></th>
        <th style="width: 60pt; <?= $style['th'] ?>">En Ejecución Total</th>
        <th style="width: 60pt; <?= $style['th'] ?>">Iniciaron En <?php echo CHtml::encode($todayPM1D) ?></th>
        <th style="width: 60pt; <?= $style['th'] ?>">Iniciaron En <?php echo CHtml::encode($today) ?></th>
        <th style="width: 60pt; <?= $style['th'] ?>">Inician desp. <?php echo CHtml::encode($today) ?></th>
        <?php
        /*
        <th style="width: 60pt; <?= $style['th'] ?>">Fecha Corte</th>
        <th style="width: 20pt; <?= $style['th'] ?>">Término</th>
        */
        ?>
    </tr>
    </thead>
    <?php $row = 0; ?>
    <?php $total = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0); ?>
    <?php
    foreach ($customerProducts as $id => $rowProd) {
        $row = $rowProd['data'];
        $total[0]+=@$row['i_' . $previous3Month];
        $total[1]+=@$row['i_' . $previous2Month];
        $total[2]+=@$row['i_' . $previousMonth];
        $total[3]+=@$row['i_' . $thisMonth];
        $total[4]+=@$row['i_' . $nextMonth];
        $total[5]+=@$row['p_' . $previous3Month];
        $total[6]+=@$row['p_' . $previous2Month];
        $total[7]+=@$row['p_' . $previousMonth];
        $total[8]+=@$row['p_' . $thisMonth];
        $total[9]+=@$row['finishedDayBefore'];
        $total[10]+=@$row['finishedToday'];
        $total[11]+=@$row['pendingToday'];
        $total[12]+=@$row['pendingTodayP1D'];
        $total[13]+=@$row['pendingTodayP2D'];
        $total[14]+=@$row['pendingTodayP3D'];
        $total[15]+=@$row['pendingThisMonth'];
        $total[16]+=@$row['pendingOverdue'];
        $total[17]+=@$row['pending'];
        $total[18]+=@$row['startedDayBefore'];
        $total[19]+=@$row['startedToday'];
        $total[20]+=@$row['startedAfterToday'];
    }
    ?>
    <tr style="<?= $style['trtd'] ?>">
        <td colspan="<?php echo ($getPrice ? 7 : 6); ?>" style=" <?= $style['td'] ?>">&nbsp;</td>
        <td style="width: 80pt; <?= $style['td'] ?>">&nbsp;</td>
        <td style="width: 80pt; <?= $style['td'] ?>">&nbsp;</td>
        <td style="width: 80pt; <?= $style['td'] ?>">&nbsp;</td>
        <td style="width: 80pt; <?= $style['td'] ?>">&nbsp;</td>
        <td style="width: 80pt; <?= $style['td'] ?>">&nbsp;</td>
        <td style="width: 80pt; <?= $style['td'] ?>">&nbsp;</td>
        <td style="width: 80pt; <?= $style['td'] ?>">&nbsp;</td>
        <td style="width: 80pt; <?= $style['td'] ?>">&nbsp;</td>
        <td style="width: 80pt; <?= $style['td'] ?>">&nbsp;</td>
        <td style="width: 80pt; <?= $style['td'] ?>">&nbsp;</td>
        <td style="width: 80pt; <?= $style['td'] ?>">&nbsp;</td>
        <td style="width: 80pt; <?= $style['td'] ?>">&nbsp;</td>
        <td style="width: 80pt; <?= $style['td'] ?>">&nbsp;</td>
        <td colspan="3" style=" <?= $style['td'] ?>">&nbsp;</th>
    </tr>
    <tr style="<?= $style['trth'] ?>">
        <th colspan="<?php echo ($getPrice ? 8 : 7); ?>" style=" <?= $style['th'] ?>">Total</th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[0]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[1]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[2]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[3]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[4]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[5]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[6]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[7]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[8]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[9]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[10]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[11]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[12]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[13]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[14]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[15]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[16]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[17]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[18]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[19]) ?></th>
        <th style="width: 80pt; <?= $style['th'] ?>"><?= @HtmlHelper::amount($total[20]) ?></th>
        <th colspan="3" style=" <?= $style['th'] ?>">&nbsp;</th>
    </tr>
    <?php foreach ($customerProducts as $id => $rowProd) : ?>
        <?php
        $row = $rowProd['data'];
        $tipocliente = 'Antiguo';
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
        $createdCustomerStr =@CHtml::encode($customerProduct->customer->created);
        $createdCustomer = new DateTime($createdCustomerStr);
        $yearCreatedCustomer =  $createdCustomer->format('Y');
        if ($yearDateNow == $yearCreatedCustomer){
            $tipocliente = 'Nuevo';
        };

        ?>
        <tr  style="<?= $style['trtd'] ?>">
            <td style="<?= $style['td'] ?>"><?= @CHtml::encode($customerGroup->name) ?></td>
            <td style="<?= $style['td'] ?>"><?= @CHtml::encode($customerProduct->customer->name) ?></td>
            <td style="<?= $style['td'] ?>"><?= @CHtml::encode($customerProduct->customer->businessLine) ?></td>
            <td style="<?= $style['td'] ?>"><?= @CHtml::encode($tipocliente) ?></td>
            <td style="<?= $style['td'] ?>"><?= $productName ?></td>
            <td style="<?= $style['td'] ?>"><?=  @CHtml::encode($customerProduct->typeProduct->value) ?></td>
            <td style="<?= $style['td'] ?>"><?= @CHtml::encode($customerProduct->components) ?></td>
            <?php if ($getPrice): ?>
                <td style="<?= $style['tdValue'] ?>">$<?= @HtmlHelper::amount($customerProduct->price, true) ?></td>
            <?php endif; ?>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['i_' . $previous3Month]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['i_' . $previous2Month]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['i_' . $previousMonth]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['i_' . $thisMonth]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['i_' . $nextMonth]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['p_' . $previous3Month]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['p_' . $previous2Month]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['p_' . $previousMonth]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['p_' . $thisMonth]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['finishedDayBefore']) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['finishedToday']) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['pendingToday']) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['pendingTodayP1D']) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['pendingTodayP2D']) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['pendingTodayP3D']) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['pendingThisMonth']) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['pendingOverdue']) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['pending']) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['startedDayBefore']) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['startedToday']) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= @HtmlHelper::amount($row['startedAfterToday']) ?></td>
            <?php
            /*
            <td style="<?= $style['td'] ?>"><?= CHtml::encode($customerGroup->invoiceDay) ?></td>
            <td style="<?= $style['td'] ?>"><?= CHtml::encode($customerGroup->paymentTerms) ?></td>
           */
            ?>
        </tr>
    <?php endforeach; ?>
</table>
</html>