<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'verification-section-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'backgroundCheckId'); ?>
		<?php echo $form->textField($model,'backgroundCheckId'); ?>
		<?php echo $form->error($model,'backgroundCheckId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'verificationSectionTypeId'); ?>
		<?php echo $form->textField($model,'verificationSectionTypeId'); ?>
		<?php echo $form->error($model,'verificationSectionTypeId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'percentCompleted'); ?>
		<?php echo $form->textField($model,'percentCompleted'); ?>
		<?php echo $form->error($model,'percentCompleted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->