<?php
/* @var $this AttachmentFileController */
/* @var $model AttachmentFile */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'SurveyLink-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name', array('size' => 50, 'maxlength' => 100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model, 'link'); ?>
        <?php echo $form->textField($model, 'link', array('size' => 150, 'maxlength' => 250)); ?>
        <?php echo $form->error($model, 'link'); ?>
    </div>

	<div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update'); ?>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->