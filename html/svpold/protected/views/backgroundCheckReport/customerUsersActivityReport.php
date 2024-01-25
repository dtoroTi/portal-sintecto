<div>
    <h3>Reporte de Actividad de Usuarios de los clientes <?= $report['from'] ?> hasta <?= $report['to'] ?></h3>
    <table style="<?= $style['table']?>">
        <?php $firstRow = TRUE; ?>
        <?php foreach ($report['data'] as $row) : ?>
            <?php if ($firstRow): ?>
                <tr style="<?= $style['trth']?>">
                    <?php $firstCol = TRUE; ?>
                    <?php foreach (array_keys($row) as $key) : ?>
                        <?php if ($firstCol): ?>
                            <th>&nbsp;</th>
                        <?php else: ?>
                            <th><?php echo CHtml::encode($key) ?></th>
                        <?php endif ?>
                        <?php $firstCol = FALSE; ?>
                    <?php endforeach; ?>
                </tr>
            <?php endif; ?>
            <tr style="<?= $style['trtd']?>">
                <?php $firstCol = TRUE; ?>
                <?php $totalRow = 0; ?>
                <?php foreach ($row as $key => $val) : ?>
                    <?php if ($firstCol): ?>
                        <td style="<?= $style['td']?>"><?php echo CHtml::encode($val) ?></td>
                        <?php $firstCol = FALSE; ?>
                    <?php else: ?>
                        <?php $totalRow = $totalRow + intVal($val); ?>
                        <td style="<?= $style['tdValue']?>"><?php echo CHtml::encode($val) ?></td>
                    <?php endif ?>
                <?php endforeach; ?>
            </tr>
            <?php $firstRow = false; ?>
        <?php endforeach; ?>
    </table>
</div>
