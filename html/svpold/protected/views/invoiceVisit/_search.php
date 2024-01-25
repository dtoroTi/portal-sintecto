<?php
/* @var $this InvoiceVisitController */
/* @var $model InvoiceVisit */
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
		<?php echo $form->label($model,'from'); ?>
		<?php echo $form->textField($model,'from'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'until'); ?>
		<?php echo $form->textField($model,'until'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoiceDate'); ?>
		<?php echo $form->textField($model,'invoiceDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visitId'); ?>
		<?php echo $form->textField($model,'visitId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numberStudies'); ?>
		<?php echo $form->textField($model,'numberStudies'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'totalValueStudies'); ?>
		<?php echo $form->textField($model,'totalValueStudies',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'statusInvoice'); ?>
		<?php echo $form->textField($model,'statusInvoice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->