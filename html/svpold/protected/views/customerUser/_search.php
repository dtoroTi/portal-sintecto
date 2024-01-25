<?php
/* @var $this CustomerUserController */
/* @var $model CustomerUser */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customerId'); ?>
		<?php echo $form->textField($model,'customerId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'firstName'); ?>
		<?php echo $form->textField($model,'firstName',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastName'); ?>
		<?php echo $form->textField($model,'lastName',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isActive'); ?>
		<?php echo $form->textField($model,'isActive'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastLogin'); ?>
		<?php echo $form->textField($model,'lastLogin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastLoginIP'); ?>
		<?php echo $form->textField($model,'lastLoginIP',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sessionValidUntil'); ?>
		<?php echo $form->textField($model,'sessionValidUntil'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sessionKey'); ?>
		<?php echo $form->textField($model,'sessionKey',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mustChangePassword'); ?>
		<?php echo $form->textField($model,'mustChangePassword'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'seed'); ?>
		<?php echo $form->textField($model,'seed',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isSupervisor'); ?>
		<?php echo $form->textField($model,'isSupervisor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isGroupSupervisor'); ?>
		<?php echo $form->textField($model,'isGroupSupervisor'); ?>
	</div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->