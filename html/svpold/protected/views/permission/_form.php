<?php
//comment
/* @var $this PermissionController */
/* @var $model Permission */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'permission-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'controller'); ?>
		<?php echo $form->textField($model,'controller',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'controller'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'action'); ?>
		<?php echo $form->textField($model,'action',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'action'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'permission'); ?>
		<?php echo $form->textField($model,'permission',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'permission'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
    <fieldset>
        <legend>Tipos de Roles</legend>
        <?php //echo $form->labelEx($model, 'roleIds'); ?>
        <?php
        echo $form->checkBoxList($model, //
                'roleIds', //
                CHtml::listData(//
                        Role::model()->findAll(), //
                        'id', //
                        'name'),
                [
                    'template' => '{input}{label}',
                    'labelOptions' => ['style' => 'display:inline;width:300px;text-align:right'],
                ]
            );
        ?>
        <?php echo $form->error($model, 'roleIds'); ?>
    </fieldset>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->