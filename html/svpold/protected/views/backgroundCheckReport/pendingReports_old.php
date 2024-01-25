<?php
$style = array(
    'table' => 'border-spacing: 0;border-collapse: collapse;padding: 0pt;font:normal 10pt Arial,Helvetica,sans-serif;',
    'trth' => 'border: 1pt solid #00518A;background-color: #00518A;color:white;',
    'thPending' => 'background-color:#95B6C5;',
    'th' => 'border: 1pt solid #00518A;',
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
        <h2>Reporte de Estudios de Security &  Vision</h2>
        <br/>
        <div>
            <h3>Reporte de Estudios Pendientes:</h3>
            <table style="<?= $style['table'] ?>">
                <thead>
                    <tr style="<?= $style['trth'] ?>">
                        <th style="width: 30pt; <?= $style['th'] ?>">Tipo de estudio</th>
                        <th style="width: 30pt; <?= $style['th'] ?>">ID</th>
                        <th style="width: 150pt; <?= $style['th'] ?>">Nombre</th>
                        <th style="width: 60pt; <?= $style['th'] ?>">Solicitud</th>
                        <th style="width: 60pt; <?= $style['th'] ?>">Fecha Límite</th>
                        <th style="width: 20pt; <?= $style['th'] ?>">Días</th>
                        <th style="width: 40pt; <?= $style['th'] ?>">Responsable</th>
                        <th style="width: 40pt; <?= $style['th'] ?>">Novedades</th>
                    </tr>
                </thead>
                <?php $previewsCustomerGroupId = NULL; ?>

                <?php foreach ($reports as $report) : ?>
                    <?php if ($previewsCustomerGroupId != $report->customer->customerGroupId): ?>
                        <tr  style="<?= $style['trtd'] ?>">
                            <td colspan="8" style="<?= $style['td'] ?>">&nbsp;</td>
                        </tr>
                        <tr  style="<?= $style['trth'] ?>">
                            <th colspan="8" style="<?= $style['th'] ?>"><?= CHtml::encode($report->customer->customerGroup->name) ?></th>
                        </tr>
                        <?php $previewsCustomerGroupId = $report->customer->customerGroupId ?>
                    <?php endif; ?>
                    <tr  style="<?= $style['trtd'] . ($report->isOverdue ? $style['trOverdue'] : '') ?>">
                        <td style="<?= $style['td'] ?>"><?= CHtml::encode($report->customerProduct->name); ?></td>
                        <td style="<?= $style['td'] ?>"><?= CHtml::encode($report->idNumber); ?></td>
                        <td style="<?= $style['td'] ?>"><?= CHtml::encode(mb_substr($report->fullName,0,30,'UTF8'));?></td>
                        <td style="<?= $style['td'].$style['center'] ?>"><?= CHtml::encode($report->studyStartedOn); ?></td>
                        <td style="<?= $style['td'].$style['center'] ?>"><?= CHtml::encode($report->studyLimitOn); ?></td>
                        <td style="<?= $style['tdValue'] ?>"><?= CHtml::encode($report->daysStudy); ?></td>
                        <td style="<?= $style['td'] ?>"><?= CHtml::encode($report->responsibleShortUsername); ?></td>
                        <td style="<?= $style['tdValue'] ?>"><?= CHtml::encode($report->numberOfEvents); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>


    </body>


</html>