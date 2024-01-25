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

    if(Yii::app()->user->isIt || Yii::app()->user->isDescription || Yii::app()->user->isSac){
        $value=false;
    }else{
        $value=true;
    }
    ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php
        $this->widget('application.extensions.tinymce.ETinyMce', array(
            'model' => $model,
            'attribute' => 'description',
//            'options'=>array('spellchecker','table','save','emotions','insertdatetime','preview','searchreplace','print','contextmenu','paste','fullscreen','noneditable','layer','visualchars'),
            //'readOnly'=>'',
            'editorTemplate' => 'basic',
            'readOnly'=>$value,
            'htmlOptions' =>
            array(
//                'rows' => 30,
//                'cols' => 60,
                'class' => 'tinymce',
                'style' => 'width:850pt;height:300pt',
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