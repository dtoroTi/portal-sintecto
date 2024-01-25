<?php
/* @var $this AttachmentFileController */
/* @var $model AttachmentFile */
/* @var $form CActiveForm */
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
	$this->redirect('/noallowed.html');
}
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dynamic-form-json-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'questionnaireJSON'); ?>
		<?php echo $form->textArea($model,'questionnaireJSON',array('rows'=>20, 'cols'=>150)); ?>
		<?php echo $form->error($model,'questionnaireJSON'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->