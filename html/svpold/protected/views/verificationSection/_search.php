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
		<?php echo $form->label($model,'backgroundCheckId'); ?>
		<?php echo $form->textField($model,'backgroundCheckId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'verificationSectionTypeId'); ?>
		<?php echo $form->textField($model,'verificationSectionTypeId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Comments'); ?>
		<?php echo $form->textArea($model,'Comments',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'percentCompleted'); ?>
		<?php echo $form->textField($model,'percentCompleted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->