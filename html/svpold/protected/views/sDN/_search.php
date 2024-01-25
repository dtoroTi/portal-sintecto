<?php
/* @var $this SDNController */
/* @var $model SDN */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'entNum'); ?>
		<?php echo $form->textField($model,'entNum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SDNName'); ?>
		<?php echo $form->textField($model,'SDNName',array('size'=>60,'maxlength'=>350)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SDNType'); ?>
		<?php echo $form->textField($model,'SDNType',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'program'); ?>
		<?php echo $form->textField($model,'program',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'callSign'); ?>
		<?php echo $form->textField($model,'callSign',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vessType'); ?>
		<?php echo $form->textField($model,'vessType',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tonnage'); ?>
		<?php echo $form->textField($model,'tonnage',array('size'=>14,'maxlength'=>14)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GRT'); ?>
		<?php echo $form->textField($model,'GRT',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vessFlag'); ?>
		<?php echo $form->textField($model,'vessFlag',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vessOwner'); ?>
		<?php echo $form->textField($model,'vessOwner',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remarks'); ?>
		<?php echo $form->textField($model,'remarks',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->