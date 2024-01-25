<div class="form wide">

    <?php
    /* @var $model VerificationSectionType */
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'verification-section-type-form',
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
        <?php echo $form->labelEx($model, 'nick'); ?>
        <?php echo $form->textField($model, 'nick', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'nick'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'bussinessLineSeccion'); ?>
        <?php echo $form->dropdownList($model, 'bussinessLineSeccion', Controller::$optionsBussinesLineSeccion); ?>
        <?php echo $form->error($model, 'bussinessLineSeccion'); ?>
    </div>   

    <div class="row">
        <?php echo $form->labelEx($model, 'class'); ?>
        <?php echo CHtml::encode($model->class); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'fieldId'); ?>
        <?php echo CHtml::encode($model->fieldId); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'showOrder'); ?>
        <?php echo $form->textField($model, 'showOrder'); ?>
        <?php echo $form->error($model, 'showOrder'); ?>
    </div>
    
    
    <div class="row">
        <?php echo $form->labelEx($model, 'component'); ?>
        <?php echo $form->textField($model, 'component'); ?>
        <?php echo $form->error($model, 'component'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'cost'); ?>
        <?php echo $form->textField($model, 'cost', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'cost'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'price'); ?>
        <?php echo $form->textField($model, 'price', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'price'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'verificationSectionGroupId'); ?>
        <?php
        echo $form->dropDownList($model, 'verificationSectionGroupId', CHtml::listData(
                        VerificationSectionGroup::model()->findAll( array('order' => 'name')), 'id', 'name'), array('prompt' => 'Sin Grupo ...'));
        ?> 
        <?php echo $form->error($model, 'verificationSectionGroupId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'hasPersonalExtras'); ?>
        <?php echo $form->dropdownList($model, 'hasPersonalExtras', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'hasPersonalExtras'); ?>
    </div>

    
    <?php if ($model->isXmlSection): ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'availableInOffline'); ?>
            <?php echo $form->dropdownList($model, 'availableInOffline', Controller::$optionsYesNo); ?>
            <?php echo $form->error($model, 'availableInOffline'); ?>
        </div>
    <?php endif; ?>
    <?php if ($model->isXmlSection): ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'xmlQuestion'); ?>
            <?php echo $form->textArea($model, 'xmlQuestion', array('rows' => 15, 'cols' => 100)); ?>
            <?php echo $form->error($model, 'xmlQuestion'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'questionFormat'); ?>
            <?php echo $form->textArea($model, 'questionFormat', array('rows' => 15, 'cols' => 100)); ?>
            <?php echo $form->error($model, 'questionFormat'); ?>
        </div>
    <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear/Continuar' : 'Guardar/Continuar', array('name' => 'continue')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear/Retornar' : 'Guardar/Retornar'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->