<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ProcessView.css" />
<?php
$this->breadcrumbs = array(
    'Background Checks' => array('admin'),
    'Create',
);
?>

<h1>Creación de Multiples Estudios de Seguridad</h1>

<div class="form wide ProcessTab">


    <fieldset>
        <legend>Registros</legend>
        <table>
            <tr>
                <th><?php echo CHtml::activeLabel($model, 'code'); ?></th>
                <th><?php echo CHtml::activeLabel($model, 'firsName'); ?></th>
                <th><?php echo CHtml::activeLabel($model, 'lastName'); ?></th>
                <th><?php echo CHtml::activeLabel($model, 'idNumber'); ?></th>
                <th>Errores</th>
            </tr>
            <?php foreach ($records as $numRecord => $record): ?>
                <tr>
                <td><?php echo CHtml::encode($record->code); ?></td>
                <td><?php echo CHtml::encode($record->firstName); ?></td>
                <td><?php echo CHtml::encode($record->lastName); ?></td>
                <td><?php echo CHtml::encode($record->formatedIdNumber); ?></td>
                <td><?php echo CHtml::errorSummary($record); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </fieldset>

</div>
