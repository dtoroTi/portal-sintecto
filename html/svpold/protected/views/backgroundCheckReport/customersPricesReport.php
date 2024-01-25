<div>
    <h3>Reporte de Estudios Por Cliente:</h3>
    <table style="<?= $style['table'] ?>">
        <thead>
            <tr style="<?= $style['trth'] ?>">
                <th>Cliente</th>
                <th >Factura</th>
                <th >SIN</th>
                <th colspan="8">Publicados</th>
                <th colspan="1">Pendiente</th>
                <th colspan="1">Pendiente</th>
                <th colspan="5"style="<?= $style['thPending'] ?>">Pendiente</th>
                <th colspan="1">Precio</th>
            </tr>
            <tr style="<?= $style['trth'] ?>">
                <th style="width: 150pt; <?= $style['th'] ?>">&nbsp;</th>
                <th style="width: 50pt; <?= $style['th'] ?>">Abierta</th>
                <th style="width: 50pt; <?= $style['th'] ?>">Factura</th>
                <th style="width: 50pt; <?= $style['th'] ?>"  colspan="2"><?= CHtml::encode($report['previews2Month']) ?></th>
                <th style="width: 50pt; <?= $style['th'] ?>"  colspan="3"><?= CHtml::encode($report['previewsMonth']) ?></th>
                <th style="width: 50pt; <?= $style['th'] ?>" colspan="3"><?= CHtml::encode($report['thisMonth']) . '(' . round($report['monthProportion'] * 100) . '%)' ?></th>
                <th style="width: 50pt; <?= $style['th'] ?>">Publicación</th>
                <th style="width: 50pt; <?= $style['th'] ?>">Aprobación</th>
                <th style="width: 50pt; <?= $style['th'] . $style['thPending'] ?>">Total</th>
                <th style="width: 50pt; <?= $style['th'] . $style['thPending'] ?>">En Tiempo</th>
                <th style="width: 50pt; <?= $style['th'] . $style['thPending'] ?>">Vencido<br/>1-6</th>
                <th style="width: 50pt; <?= $style['th'] . $style['thPending'] ?>">Vencido<br/>7-29</th>
                <th style="width: 50pt; <?= $style['th'] . $style['thPending'] ?>">Vencido <br/>>=30</th>
                <th style="width: 50pt; <?= $style['th'] ?>">Cero</th>
            </tr>
        </thead>
        <?php
        $tot2Month = @$report['price'][BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_2MONTH];

        $tot1Month = @$report['price'][BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_MONTH];

        $totMonth = @$report['price'][BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_APPROVED_THIS_MONTH];
        ?>

        <?php foreach ($report['priceCustomerGroup'] as $customerGroupName => $customerGroup) : ?>
            <?php echo "<tr  style=" . $style['trtd'] . ">"; ?>

            <td style="<?= $style['td'] ?>"><?= CHtml::encode($customerGroupName) ?></td>
            <?php $firstRow = true; ?>
            <?php if (!$firstRow): ?>
                <tr style="<?= $style['trtd'] ?>">
                <?php else: ?>
                    <?php $firstRow = false; ?>
                <?php endif; ?>
                <?php
                $v2Month = @$customerGroup[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_2MONTH];
                $v1Month = @$customerGroup[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_MONTH];
                $vMonth = @$customerGroup[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_THIS_MONTH];
                ?>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$customerGroup[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_OPEN_INVOICE]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$customerGroup[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_NO_INVOICE]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$customerGroup[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_2MONTH]) ?></td>
                <td style="<?= $style['tdPercent'][0] ?>"><?= HtmlHelper::percent($v2Month, $tot2Month) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$customerGroup[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_MONTH]) ?></td>
                <td style="<?= $style['tdPercent'][0] ?>"><?= HtmlHelper::percent($v1Month, $tot1Month) ?></td>
                <td style="<?= $style['tdPercent'][HtmlHelper::trend($v1Month - $v2Month)] ?>"><?= HtmlHelper::percent($v1Month - $v2Month, $v2Month) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$customerGroup[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_THIS_MONTH]) ?></td>
                <td style="<?= $style['tdPercent'][0] ?>"><?= HtmlHelper::percent($vMonth, $totMonth) ?></td>
                <td style="<?= $style['tdPercent'][HtmlHelper::trend($vMonth - $v1Month * $report['monthProportion'])] ?>"><?= HtmlHelper::percent($vMonth - $v1Month * $report['monthProportion'], $v1Month * $report['monthProportion']) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$customerGroup[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_NOT_PUBLISHED]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$customerGroup[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_NOT_APPROVED]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$customerGroup[BackgroundCheck::S_PENDING][BackgroundCheck::S_TOTAL_PENDING_USER]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$customerGroup[BackgroundCheck::S_PENDING][BackgroundCheck::S_ONTIME]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$customerGroup[BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$customerGroup[BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE_7]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$customerGroup[BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE_30]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$customerGroup[BackgroundCheck::S_NO_PRICE]) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr style="<?= $style['trth'] ?>">

            <td style="<?= $style['td'] ?>" >TOTAL</td>
            <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$report['price'][BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_OPEN_INVOICE]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$report['price'][BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_NO_INVOICE]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$report['price'][BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_2MONTH]) ?></td>
            <td>100%</td>
            <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$report['price'][BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_MONTH]) ?></td>
            <td>100%</td>
            <td style="<?= $style['tdPercent'][HtmlHelper::trend($tot1Month - $tot2Month)] ?>"><?= HtmlHelper::percent($tot1Month - $tot2Month, $tot2Month) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$report['price'][BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_APPROVED_THIS_MONTH]) ?></td>
            <td>100%</td>
            <td style="<?= $style['tdPercent'][HtmlHelper::trend($totMonth - $tot1Month * $report['monthProportion'])] ?>">
                <?= HtmlHelper::percent($totMonth - $tot1Month * $report['monthProportion'], $tot1Month * $report['monthProportion']) ?>
            </td>
            <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$report['price'][BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_NOT_PUBLISHED]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::amount(@$report['price'][BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_NOT_APPROVED]) ?></td>
            <td style="<?= $style['tdValue'] . $style['thPending'] ?>"><?= HtmlHelper::amount(@$report['price'][BackgroundCheck::S_TOTAL_PENDING][BackgroundCheck::S_TOTAL_PENDING_USER]) ?></td>
            <td style="<?= $style['tdValue'] . $style['thPending'] ?>"><?= HtmlHelper::amount(@$report['price'][BackgroundCheck::S_TOTAL_PENDING][BackgroundCheck::S_ONTIME]) ?></td>
            <td style="<?= $style['tdValue'] . $style['thPending'] ?>"><?= HtmlHelper::amount(@$report['price'][BackgroundCheck::S_TOTAL_PENDING][BackgroundCheck::S_OVERDUE]) ?></td>
            <td style="<?= $style['tdValue'] . $style['thPending'] ?>"><?= HtmlHelper::amount(@$report['price'][BackgroundCheck::S_TOTAL_PENDING][BackgroundCheck::S_OVERDUE_7]) ?></td>
            <td style="<?= $style['tdValue'] . $style['thPending'] ?>"><?= HtmlHelper::amount(@$report['price'][BackgroundCheck::S_TOTAL_PENDING][BackgroundCheck::S_OVERDUE_30]) ?></td>
        </tr>
    </table>
</div>
