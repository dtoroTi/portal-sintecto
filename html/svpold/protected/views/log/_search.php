<?php
/* @var $this LogController */
/* @var $model Log */
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
		<?php echo $form->label($model,'userLogin'); ?>
		<?php echo $form->textField($model,'userLogin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customerUserLogin'); ?>
		<?php echo $form->textField($model,'customerUserLogin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'backgroundCheckCode'); ?>
		<?php echo $form->textField($model,'backgroundCheckCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'serverName'); ?>
		<?php echo $form->textField($model,'serverName',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'module'); ?>
		<?php echo $form->textField($model,'module',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'controller'); ?>
		<?php echo $form->textField($model,'controller',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'action'); ?>
		<?php echo $form->textField($model,'action',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->