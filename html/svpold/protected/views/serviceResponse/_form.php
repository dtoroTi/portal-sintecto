<?php
/* @var $this ServiceResponseController */
/* @var $model ServiceResponse */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-response-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'response'); ?>
		<?php echo $form->textArea($model,'response',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'response'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timestamp'); ?>
		<?php echo $form->textField($model,'timestamp'); ?>
		<?php echo $form->error($model,'timestamp'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->