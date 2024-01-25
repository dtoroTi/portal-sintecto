<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'verification-in-product-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'verificationSectionTypeId'); ?>
		<?php echo $form->textField($model,'verificationSectionTypeId'); ?>
		<?php echo $form->error($model,'verificationSectionTypeId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customerProductId'); ?>
		<?php echo $form->textField($model,'customerProductId'); ?>
		<?php echo $form->error($model,'customerProductId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'showOrder'); ?>
		<?php echo $form->textField($model,'showOrder'); ?>
		<?php echo $form->error($model,'showOrder'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->