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
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'maxDays'); ?>
		<?php echo $form->textField($model,'maxDays'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maxInternalDays'); ?>
		<?php echo $form->textField($model,'maxInternalDays'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contract_Limit'); ?>
		<?php echo $form->textField($model,'contract_Limit'); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->