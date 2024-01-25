<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ProcessView.css" />
<?php
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}

$this->breadcrumbs = array(
    'Background Checks' => array('admin'),
    'Create',
);
?>

<h1>Solicitar Multiples Estudios para Empresa</h1>

<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('notification')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
<?php endif; ?>

<div class="form wide ProcessTab">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'person-security-evaluation-form',
        'enableAjaxValidation' => false,
        'action' => array('/backgroundCheck/createMultipleCompanyStudies'),
        'htmlOptions' => (array()),
            )
    );
    ?>

    <?php echo $form->errorSummary($model); ?>
    <fieldset>
        <legend>Cliente y tipo de Reporte</legend>  

        <div class="row">
            <?php echo $form->labelEx($model, 'customerId'); ?>
            <?php echo CHtml::encode($model->customer->name) ?>
            <?php echo CHtml::activeHiddenField($model, 'customerId') ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'customerProductId'); ?>
            <?php echo CHtml::encode($model->customerProduct->name) ?>
            <?php echo CHtml::activeHiddenField($model, 'customerProductId') ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'customerUserId'); ?>
            <?php echo CHtml::encode($model->customerUser->username) ?>
            <?php echo CHtml::activeHiddenField($model, 'customerUserId') ?>
        </div>


        <?php for ($i = 1; $i <= Customer::MAX_FIELDS; $i++): ?>
            <div class="row">
                <?php $field = 'field' . $i; ?>
                <?php if (isset($model->customer) && ($model->customer->$field != "" )): ?>
                    <?php echo $form->label($model, ($model->customer ? $model->customer->$field : 'customerField' . $i), array('id' => 'field' . $i, 'required' => true)); ?>
                    <?php if ($model->customer->hasOptionsInField($i)): ?>
                        <?php
                        echo CHtml::activeDropDownList(
                                $model
                                , 'customerField' . $i
                                , $model->customer->optionsInFieldArray($i));
                        ?>
                    <?php else: ?>
                        <?php echo $form->textField($model, 'customerField' . $i, array('size' => 60, 'maxlength' => 255)); ?>
                    <?php endif; ?>
                    <?php echo $form->error($model, 'customerField' . $i); ?>
                <?php endif; ?>
            </div>
        <?php endfor; ?> 

    </fieldset>

    <fieldset>
        <legend>Revisar el archivo</legend>
        <table>
            <tr>
                <th>Incluir</th>
                <?php foreach ($permitedCompanyFields as $field): ?>
                    <th>
                        <?php echo BackgroundCheck::model()->getAttributeLabel($field) ?>
                    </th>
                <?php endforeach; ?>
                <th>Error</th>
            </tr>
            <?php foreach ($records as $numRecord => $record): ?>
                <tr>
                    <?php
                    $checked = $record['error'];
                    if ($checked) {
                        foreach ($permitedCompanyFields as $field) {
                            if (!isset($record[$field]) || trim($record[$field]) == '') {
                                $checked = false;
                            }
                        }
                    } else{
                        $checked = true;
                    }
                    ?>

                    <td><?php echo CHtml::checkBox("studies[{$numRecord}][include]", $checked) ?></td>
                    <?php foreach ($permitedCompanyFields as $field): ?>
                        <td><?php echo CHtml::textField("studies[{$numRecord}][{$field}]", $record[$field]) ?></td>
                    <?php endforeach; ?>
                    <td>
                        <?php if ($record['error']!=''): ?>
                            <div class="flash-notice">
                                <?php echo CHtml::encode($record['error']); ?>
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </fieldset>

    <?php echo CHtml::submitButton('Crear', array('name' => 'create')); ?>

    <?php $this->endWidget(); ?>

</div>
