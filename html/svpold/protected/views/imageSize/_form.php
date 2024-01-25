<?php
/* @var $this ImageSizeController */
/* @var $model ImageSize */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'image-size-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maxWidth'); ?>
		<?php echo $form->textField($model,'maxWidth'); ?>
		<?php echo $form->error($model,'maxWidth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maxHeight'); ?>
		<?php echo $form->textField($model,'maxHeight'); ?>
		<?php echo $form->error($model,'maxHeight'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->