<?php
/* @var $this TablaPqrController */
/* @var $model TablaPqr */
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
		<?php echo $form->label($model,'nombreId'); ?>
		<?php echo $form->textField($model,'nombreId',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipoReclamoId'); ?>
		<?php echo $form->textField($model,'tipoReclamoId',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nota'); ?>
		<?php echo $form->textField($model,'nota',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaReclamo'); ?>
		<?php echo $form->textField($model,'fechaReclamo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estadoReclamo'); ?>
		<?php echo $form->textField($model,'estadoReclamo',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaRespuesta'); ?>
		<?php echo $form->textField($model,'fechaRespuesta'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->