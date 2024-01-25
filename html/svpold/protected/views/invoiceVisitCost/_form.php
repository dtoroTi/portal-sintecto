<?php
/* @var $this InvoiceVisitCostController */
/* @var $model InvoiceVisitCost */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invoice-visit-cost-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <?php echo $form->labelEx($model, 'businessLine'); ?>
        <?php echo $form->dropDownList($model, 'businessLine', Controller::$optionsBussinesLineClient); ?>
        <?php echo $form->error($model, 'businessLine'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'descriptionCost'); ?>
		<?php echo $form->textField($model,'descriptionCost',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'descriptionCost'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'totalVisitCost'); ?>
		<?php echo $form->textField($model,'totalVisitCost',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'totalVisitCost'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->