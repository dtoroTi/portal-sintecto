<table style="<?= $style['table'] ?>">
    <thead>
        <tr style="<?= $style['trth'] ?>">
            <th style="width: 30pt; <?= $style['th'] ?>">No.</th>
            <th style="width: 150pt; <?= $style['th'] ?>">Cliente</th>
            <th style="width: 200pt; <?= $style['th'] ?>">Tipo de estudio</th>
            <th style="width: 30pt; <?= $style['th'] ?>">ID</th>
            <th style="width: 150pt; <?= $style['th'] ?>">Nombre</th>
            <th style="width: 60pt; <?= $style['th'] ?>">Solicitud</th>
            <th style="width: 60pt; <?= $style['th'] ?>">Fecha Límite</th>
            <th style="width: 20pt; <?= $style['th'] ?>">Días</th>
            <th style="width: 40pt; <?= $style['th'] ?>">Responsable</th>
            <th style="width: 40pt; <?= $style['th'] ?>">Novedades</th>
            <th style="width: 40pt; <?= $style['th'] ?>">Retraso</th>
        </tr>
    </thead>
    <?php $row = 0; ?>
    <?php
    foreach ($reports as $report) {
        if ($report->$condition) {
            $row++;
            // The inner line had to be neasted within the foreach in in order to avoid the ! of the mail.
            ?>
            <tr  style="<?= $style['trtd'] . ($report->overdueDays > 0 ? $style['trOverdue'] : '') ?>">
                <td style="<?= $style['td'] ?>"><?= CHtml::encode($row) ?></td>
                <td style="<?= $style['td'] ?>"><?= CHtml::encode($report->customer->customerGroup->name) ?></td>
                <td style="<?= $style['td'] ?>"><?= CHtml::encode($report->customerProduct->name); ?></td>
                <td style="<?= $style['td'] ?>"><?= CHtml::encode($report->idNumber); ?></td>
                <td style="<?= $style['td'] ?>"><?= CHtml::encode(mb_substr($report->fullName, 0, 30, 'UTF8')); ?></td>
                <td style="<?= $style['td'] . $style['center'] ?>"><?= CHtml::encode($report->studyStartedOn); ?></td>
                <td style="<?= $style['td'] . $style['center'] ?>"><?= CHtml::encode($report->studyLimitOn); ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= CHtml::encode($report->daysStudy); ?></td>
                <td style="<?= $style['td'] ?>"><?= $report->assignedUserNamesFull; ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= ($report->numberOfEvents > 0 ? $report->numberOfEvents : ""); ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= ($report->overdueDays > 0 ? $report->overdueDays : ""); ?></td>
            </tr>
            <?php
        }
    }
    ?>
</table>