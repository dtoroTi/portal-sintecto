<?php
/* @var $this PdfReportTypeController */
/* @var $model PdfReportType */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'pdf-report-type-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'isCertificate'); ?>
        <?php echo $form->dropdownList($model, 'isCertificate', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'isCertificate'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'islogSintecto'); ?>
        <?php echo $form->dropdownList($model, 'islogSintecto', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'islogSintecto'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'topMargin'); ?>
        <?php echo $form->textField($model, 'topMargin'); ?>
        <?php echo $form->error($model, 'topMargin'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'bottomMargin'); ?>
        <?php echo $form->textField($model, 'bottomMargin'); ?>
        <?php echo $form->error($model, 'bottomMargin'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'leftMargin'); ?>
        <?php echo $form->textField($model, 'leftMargin'); ?>
        <?php echo $form->error($model, 'leftMargin'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'rightMargin'); ?>
        <?php echo $form->textField($model, 'rightMargin'); ?>
        <?php echo $form->error($model, 'rightMargin'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'headerMargin'); ?>
        <?php echo $form->textField($model, 'headerMargin'); ?>
        <?php echo $form->error($model, 'headerMargin'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'footerMargin'); ?>
        <?php echo $form->textField($model, 'footerMargin'); ?>
        <?php echo $form->error($model, 'footerMargin'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'footerOffset'); ?>
        <?php echo $form->textField($model, 'footerOffset'); ?>
        <?php echo $form->error($model, 'footerOffset'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'markX'); ?>
        <?php echo $form->textField($model, 'markX'); ?>
        <?php echo $form->error($model, 'markX'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'markY'); ?>
        <?php echo $form->textField($model, 'markY'); ?>
        <?php echo $form->error($model, 'markY'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'defaultFont'); ?>
        <?php
        echo $form->dropDownList($model, 'defaultFont', PdfReportType::$fontTypes);
        ?> 
        <?php echo $form->error($model, 'defaultFont'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'defaultFontSize'); ?>
        <?php echo $form->textField($model, 'defaultFontSize'); ?>
        <?php echo $form->error($model, 'defaultFontSize'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->