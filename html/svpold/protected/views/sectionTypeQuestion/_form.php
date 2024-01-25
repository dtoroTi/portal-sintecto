<?php
/* @var $this SectionTypeQuestionController */
/* @var $model SectionTypeQuestion */
/* @var $form CActiveForm */
?>

<div class="form">

  <?php
  $form = $this->beginWidget('CActiveForm', array(
      'id' => 'section-type-question-form',
      'enableAjaxValidation' => false,
          ));
  ?>

  <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

  <div class="row">
    <?php echo $form->labelEx($model, 'question'); ?>
<?php echo $form->textField($model, 'question', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'question'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model, 'showOrder'); ?>
<?php echo $form->textField($model, 'showOrder'); ?>
<?php echo $form->error($model, 'showOrder'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model, 'verificationSectionTypeId'); ?>
    <?php
    echo CHtml::activeDropDownList(//
            $model, //
            'verificationSectionTypeId', //
            CHtml::listData(VerificationSectionType::model()->questionType()->findAll(), 'id', 'name'), //
            array('prompt' => 'Seleccione..',));
    ?>
<?php echo $form->error($model, 'verificationSectionTypeId'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model, 'isActive'); ?>
    
    <?php
    echo CHtml::activeDropDownList(//
            $model, //
            'isActive', //
            Controller::$optionsYesNo, //
            array('prompt' => 'Seleccione..',));
    ?>
<?php echo $form->error($model, 'isActive'); ?>
  </div>

  <div class="row buttons">
  <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
  </div>

<?php $this->endWidget(); ?>

</div><!-- form -->