<?php
//comment
/* @var $this InvoiceVisitDetailController */
/* @var $model InvoiceVisitDetail */
/* @var $form CActiveForm */
if(Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()){
	$disabled='';
}else{
	$disabled='true';
}


if($model->isApprovedOP!=''){
	$disabledOP='true';
}else{
	$disabledOP='';
}

?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invoice-visit-detail-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'totalValueCostVisit'); ?>
		<?php echo $form->textField($model,'totalValueCostVisit',array('size'=>10,'maxlength'=>10, 'disabled'=>$disabled)); ?>
		<?php echo $form->error($model,'totalValueCostVisit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'totalValueAddVisit'); ?>
		<?php echo $form->textField($model,'totalValueAddVisit',array('size'=>10,'maxlength'=>10, 'disabled'=>$disabled)); ?>
		<?php echo $form->error($model,'totalValueAddVisit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'totalValueTransportation'); ?>
		<?php echo $form->textField($model,'totalValueTransportation',array('size'=>10,'maxlength'=>10,'disabled'=>$disabledOP));
		?>
		<?php echo $form->error($model,'totalValueTransportation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'totalValueFeeding'); ?>
		<?php echo $form->textField($model,'totalValueFeeding',array('size'=>10,'maxlength'=>10,'disabled'=>$disabledOP)); ?>
		<?php echo $form->error($model,'totalValueFeeding'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'totalValueStationery'); ?>
		<?php echo $form->textField($model,'totalValueStationery',array('size'=>10,'maxlength'=>10,'disabled'=>$disabledOP)); ?>
		<?php echo $form->error($model,'totalValueStationery'); ?>
	</div>

	<?php if (Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))) : ?>

		<div class="row">
			<?php echo $form->labelEx($model, 'isApprovedOP'); ?>
			<?php echo $form->dropDownList($model, 'isApprovedOP', Controller::$optionsYesNoNull); ?>
			<?php echo $form->error($model, 'isApprovedOP'); ?>
		</div>
		
	<?php endif; ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->