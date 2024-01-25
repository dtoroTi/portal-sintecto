<?php
//coment
/* @var $this CustomerUserController */
/* @var $model CustomerUser */

if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'holiday-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'holiday'); ?>
		<?php echo $form->textField($model,'holiday'); ?>
		<?php echo $form->error($model,'holiday'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->