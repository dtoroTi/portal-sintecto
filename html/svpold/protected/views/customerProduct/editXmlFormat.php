<?php
$this->breadcrumbs = array(
    'Customer Products' => array('admin'),
    CHtml::encode($model->name) => array('view', 'id' => CHtml::encode($model->id)),
    'Actualizar',
);

$this->menu = array(
    array('label' => 'Create CustomerProduct', 'url' => array('create')),
    array('label' => 'View CustomerProduct', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage CustomerProduct', 'url' => array('admin')),
);
?>

<h1>Actualizar Producto de cliente <?php echo CHtml::encode($model->id); ?></h1>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'customer.name',
        'name',
        'maxDays',
        'maxInternalDays',
        'contract_Limit',
        'created',
        'modified',
        'isCompanySurvey',
        'isActive',
        'notifyByMail',
        'availableInOffline',
        'cost',
        'price',
    ),
));
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'customer-product-form',
        'enableAjaxValidation' => false,
    ));
    ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'xmlQuestion'); ?>
        <?php echo $form->textArea($model, 'xmlQuestion', array('rows' => 15, 'cols' => 100)); ?>
        <?php echo $form->error($model, 'xmlQuestion'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'questionFormat'); ?>
        <?php echo $form->textArea($model, 'questionFormat', array('rows' => 15, 'cols' => 100)); ?>
        <?php echo $form->error($model, 'questionFormat'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'reportFormat'); ?>
        <?php echo $form->textArea($model, 'reportFormat', array('rows' => 15, 'cols' => 100)); ?>
        <?php echo $form->error($model, 'reportFormat'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear/Continuar' : 'Guardar/Continuar', array('name' => 'continue')); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->