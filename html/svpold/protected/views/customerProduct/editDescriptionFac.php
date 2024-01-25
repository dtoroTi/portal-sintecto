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
        <?php echo $form->labelEx($model, 'facturacion'); ?>
        <?php
        $this->widget('application.extensions.tinymce.ETinyMce', array(
                'model' => $model,
                'attribute' => 'facturacion',
//            'options'=>array('spellchecker','table','save','emotions','insertdatetime','preview','searchreplace','print','contextmenu','paste','fullscreen','noneditable','layer','visualchars'),
                'editorTemplate' => 'basic',
                'htmlOptions' =>
                    array(
//                'rows' => 30,
//                'cols' => 60,
                        'class' => 'tinymce',
                        'style' => 'width:480pt',
                    )
            )
        );
        ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear/Continuar' : 'Guardar/Continuar', array('name' => 'continue')); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->