<?php
$this->breadcrumbs = array(
    'Estudios de Seguridad' => array('admin'),
    CHtml::encode($model->code),
);
?>


<h1>Su requerimiento ha sido enviado</h1>

<p>Muchas gracias por usar nuestros servicios</p>

<p>El c&oacute;digo de seguimiento es: <?php echo CHtml::encode($model->code); ?></p>

<div class="form wide">
    <fieldset>
        <legend>Cliente y tipo de Reporte</legend>  

        <div class="row">
            <?php echo CHtml::activeLabelEx($model, 'customerId'); ?>:
            <?php echo $model->customer->name; ?>
        </div>

        <div class="row">
            <?php echo CHtml::activeLabelEx($model, 'customerUserId'); ?>:
            <?php echo $model->customerUser->username; ?>
        </div>

        <div class="row">
            <?php echo CHtml::activeLabelEx($model, 'customerProductId'); ?>:
            <?php echo CHtml::encode($model->customerProduct->name); ?>
        </div>

        <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="row">
                <?php $field = 'field' . $i; ?>
                <?php $customerField = 'customerField' . $i; ?>
                <?php if ($model->customer->$field != ""): ?>
                    <?php echo CHtml::activeLabel($model, $model->customer->$field, array('id' => 'field' . $i,'required'=>true)); ?>:
                    <?php echo CHtml::encode($model->$customerField); ?>
                <?php endif; ?>
            </div>
        <?php endfor; ?>

    </fieldset>

    <fieldset >
        <legend>Detalle</legend>  
        <div class="row">
            <?php echo CHtml::activeLabelEx($model, 'code'); ?>:
            <?php echo Chtml::encode($model->code); ?>
        </div>

        <?php if (!$model->customerProduct->isCompanySurvey): ?>
            <div class="row">
                <?php echo CHtml::activeLabelEx($model, 'firstName'); ?>:
                <?php echo Chtml::encode($model->firstName); ?>
            </div>
            <div class="row">
                <?php echo CHtml::activeLabelEx($model, 'lastName'); ?>:
                <?php echo Chtml::encode($model->lastName); ?>
            </div>
        <?php else: ?>
            <div class="row">
                <?php echo CHtml::activeLabelEx($model, 'Razón Social'); ?>:
                <?php echo Chtml::encode($model->lastName); ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php echo CHtml::activeLabelEx($model, 'idNumber'); ?>:
            <?php echo CHtml::encode($model->idNumber); ?>
        </div>

        <div class="row">
            <?php echo CHtml::activeLabelEx($model, 'tels'); ?>:
            <?php echo CHtml::encode($model->tels); ?>
        </div>
        <?php if (!$model->customerProduct->isCompanySurvey): ?>
            <div class="row">
                <?php echo CHtml::activeLabelEx($model, 'applyToPosition'); ?>:
                <?php echo CHtml::encode($model->applyToPosition); ?>
            </div>
            <div class="row">
                <?php  echo CHtml::activeLabelEx($model, 'email'); ?>:
                <?php  echo CHtml::encode($model->email); ?>
            </div>
        <?php endif; ?>

    </fieldset>
    <fieldset >
        <div class="row">
            <?php echo CHtml::activeLabelEx($model, 'customerComments'); ?>:
            <?php echo CHtml::encode($model->customerComments); ?>
        </div>

    </fieldset>

</div>