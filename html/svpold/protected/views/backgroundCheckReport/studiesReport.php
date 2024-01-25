<div>

    <h3>Reporte desde <?= $report['from'] ?> hasta <?= $report['to'] ?></h3>
    <table style="<?= $style['table']?>">
        <thead>
            <tr style="<?= $style['trth']?>">
                <th style="<?= $style['th']?>">Cliente</th>
                <th style="<?= $style['th']?>">Producto</th>
                <th colspan="2" style="<?= $style['th']?>">Mes Ant.</th>
                <th colspan="2" style="<?= $style['th']?>">Mes Act.</th>
                <th colspan="3" style="<?= $style['th']?>">Pendientes</th>
            </tr>
            <tr style="<?= $style['trth']?>">
                <th style="<?= $style['th']?>">&nbsp;</th>
                <th style="<?= $style['th']?>">&nbsp;</th>
                <th style="width: 30pt;<?= $style['th']?>">Sol.</th>
                <th style="width: 30pt;<?= $style['th']?>">Ent.</th>
                <th style="width: 30pt;<?= $style['th']?>">Sol.</th>
                <th style="width: 30pt;<?= $style['th']?>">Ent.</th>
                <th style="width: 30pt;<?= $style['th']?>">Total</th>
                <th style="width: 30pt;<?= $style['th']?>">Tarde</th>
                <th style="width: 30pt;<?= $style['th']?>">Ok</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $previewsCustomer = null;
            $reportKeys = array('previewsPeriodIn', 'previewsPeriodApproved', 'currentPeriodIn', 'currentPeriodApproved', 'pending');
            $totalKeys = array_merge($reportKeys, array('overdue', 'onTime'));
            $ceroArray = array();
            foreach ($totalKeys as $key) :
                $totalCustomer[$key] = 0;
            endforeach;

            foreach ($totalKeys as $key) :
                $totalReport[$key] = 0;
            endforeach;
            ?>

            <?php for ($i = 0; $i < count($report['data']); $i++) : ?>
                <?php $row = $report['data'][$i]; ?>
                <?php if ($i > 0 && $previewsCustomer != $row['customer']): ?>
                    <tr style="<?= $style['trTotal']?>">
                        <td style="<?= $style['td']?>">TOTAL</td>
                        <?php foreach ($totalKeys as $key): ?>
                            <td style="<?= $style['tdValue']?>"><?= HtmlHelper::number($totalCustomer[$key]) ?></td>
                        <?php endforeach; ?>
                        <?php
                        foreach ($totalKeys as $key) {
                            $totalCustomer[$key] = 0;
                        }
                        ?>
                    </tr>
                <?php endif; ?>

                <tr style="<?= $style['trtd']?>">
                    <?php if ($previewsCustomer != $row['customer']) : ?>
                        <?php
                        $rowSpan = 1;
                        while (($rowSpan + $i) < count($report['data']) && $row['customer'] == $report['data'][$i + $rowSpan]['customer']) {
                            $rowSpan++;
                        }
                        $rowSpan+=1;
                        ?>
                        <td rowspan="<?= $rowSpan; ?>"  style="<?= $style['td']?>"><?= CHtml::encode($row['customer']) ?></td>
                    <?php endif ?>
                    <?php $previewsCustomer = $row['customer']; ?>
                    <td  style="<?= $style['td']?>"><?= CHtml::encode($row['product']) ?></td>
                    <?php foreach ($reportKeys as $key): ?>
                        <td  style="<?= $style['tdValue']?>"><?= HtmlHelper::number($row[$key]) ?></td>
                        <?php $totalCustomer[$key]+=$row[$key]; ?>
                        <?php $totalReport[$key]+=$row[$key]; ?>
                    <?php endforeach; ?>
                    <?php
                    $customerProduct = CustomerProduct::model()->findByPk($row['customerProductId']);
                    $pending=$customerProduct->pendingStudies;
                    $totalCustomer['overdue']+=$pending['overdue'];
                    $totalCustomer['onTime']+=$pending['onTime'];
                    $totalReport['overdue']+=$pending['overdue'];
                    $totalReport['onTime']+=$pending['onTime'];
                    ?>
                        <td style="<?= $style['tdValue']?>"><?= HtmlHelper::number($pending['overdue'])?></td>
                        <td style="<?= $style['tdValue']?>"><?= HtmlHelper::number($pending['onTime'])?></td>


                </tr>
            <?php endfor; ?>
            <tr style="<?= $style['trTotal']?>">
                <td>TOTAL</td>
                <?php foreach ($totalKeys as $key): ?>
                    <td  style="<?= $style['tdValue']?>"><?= HtmlHelper::number($totalCustomer[$key]) ?></td>
                <?php endforeach; ?>
                <?php
                foreach ($reportKeys as $key) {
                    $totalCustomer[$key] = 0;
                }
                ?>
            </tr>
        </tbody>

        <tfoot>
            <tr  style="<?= $style['trth']?>">
                <td colspan="2">TOTAL</td>
                <?php foreach ($totalKeys as $key): ?>
                    <td  style="<?= $style['tdValue']?>"><?= HtmlHelper::number($totalReport[$key]) ?></td>
                <?php endforeach; ?>
                <?php
                foreach ($reportKeys as $key) {
                    $totalCustomer[$key] = 0;
                }
                ?>
            </tr>
        </tfoot>
    </table>
</div>
