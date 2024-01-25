<?php
/* @var $this AgreementsController */
/* @var $model Agreements */
/* @var $form CActiveForm */

if(!Yii::app()->user->isAgreements){
	$disabled='true';
}else{
	$disabled='';
}

?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'agreements-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>250, 'disabled'=>$disabled)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
        <?php echo $form->label($model, 'agreementsText'); ?>
		<?php
		$this->widget('application.extensions.SvpCkEditor.SvpCkEditor'
				, array(
			'model' => $model,
			'attribute' => 'agreementsText',
			'type' => 'others',
			'variables' => array_merge([]), 
		));
		?>
		<?php echo $form->error($model,'agreementsText'); ?>
    </div>

	<!--<div class="row">
		<?php //echo $form->labelEx($model,'created'); ?>
		<?php //echo $form->textField($model,'created'); ?>
		<?php //echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'modified'); ?>
		<?php //echo $form->textField($model,'modified'); ?>
		<?php //echo $form->error($model,'modified'); ?>
	</div>-->

	<?php if(Yii::app()->user->isAgreements): ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	<?php endif; ?>

<?php $this->endWidget(); ?>

</div><!-- form -->