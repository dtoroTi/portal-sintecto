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
		<?php echo $form->label($model,'verificationSectionTypeId'); ?>
		<?php echo $form->textField($model,'verificationSectionTypeId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customerProductId'); ?>
		<?php echo $form->textField($model,'customerProductId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'showOrder'); ?>
		<?php echo $form->textField($model,'showOrder'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->