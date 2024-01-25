<?php
$this->breadcrumbs = array(
    'Secciones' => array('admin'),
    CHtml::encode($model->name) => array('view', 'id' => CHtml::encode($model->id)),
    'Actualizar',
);
?>

<h1>Actualizar Sección Html [<?php echo CHtml::encode($model->name); ?>]</h1>



<div class="form">

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'customer-product-form',
    'enableAjaxValidation' => false,
        ));
?>


    <div class="row">
        <h2><?php echo $form->label($model, $section); ?></h2>
<?php
$this->widget('application.extensions.SvpCkEditor.SvpCkEditor'
        , array(
    'model' => $model,
    'attribute' => $section,
    'type' => 'advance',
    'variables' => array_merge(PdfReportType::getFullAllowedVars(), TcPdf\SvpTcPdf::$allowedVars),
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