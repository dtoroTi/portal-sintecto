<?php
/* @var $this TablaPqrController */
/* @var $model TablaPqr */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tabla-pqr-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <?php echo $form->labelEx($model, 'nombreId'); ?>
        <?php
        echo $form->dropdownList($model, //
                'nombreId', //
                CHtml::listData(//
                        User::model()->findAll(array('order' => 'firstName')), //
                        'id', //
                        'firstName'));
        ?>
        <?php echo $form->error($model, 'nombreId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'tipoReclamoId'); ?>
        <?php
        echo $form->dropdownList($model, //
                'tipoReclamoId', //
                CHtml::listData(//
                        TipoPqr::model()->findAll(array('order' => 'tipoReclamo')), //
                        'id', //
                        'tipoReclamo'));
        ?>
        <?php echo $form->error($model, 'tipoReclamoId'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'nota'); ?>
		<?php echo $form->textField($model,'nota',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nota'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model, 'fechaReclamo'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'VisitInvoiceDate[fechaReclamo]',
            'value' => $model->fechaReclamo,
			'id'=>'fechaReclamo',
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'fechaReclamo'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'estadoReclamo'); ?>
		<?php echo $form->dropdownList($model, 'estadoReclamo', Controller::$optionsEstadoReclamo); ?>
		<?php echo $form->error($model,'estadoReclamo'); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model, 'fechaRespuesta'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'VisitInvoiceDate[fechaRespuesta]',
            'value' => $model->fechaRespuesta,
			'id'=>'fechaRespuesta',
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'fechaRespuesta'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->