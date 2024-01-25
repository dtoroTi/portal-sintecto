<?php
/* @var $this CustomerUserController */
/* @var $model CustomerUser */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'customer-user-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'customerId'); ?>
        <?php
        echo $form->dropdownList($model, //
                'customerId', //
                CHtml::listData(//
                        Customer::model()->findAll(array('order' => 'name')), //
                        'id', //
                        'name'));
        ?>
        <?php echo $form->error($model, 'customerId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'firstName'); ?>
        <?php echo $form->textField($model, 'firstName', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'firstName'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'lastName'); ?>
        <?php echo $form->textField($model, 'lastName', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'lastName'); ?>
    </div>

    
    <div class="row">
        <?php echo $form->labelEx($model, 'email2'); ?>
        <?php echo $form->textField($model, 'email2', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'email2'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email3'); ?>
        <?php echo $form->textField($model, 'email3', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'email3'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'compliance'); ?>
        <?php echo $form->dropDownList($model, 'compliance', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'compliance'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'mustChangePassword'); ?>
        <?php echo $form->dropDownList($model, 'mustChangePassword', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'mustChangePassword'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'isActive'); ?>
        <?php echo $form->dropDownList($model, 'isActive', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'isActive'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'isSupervisor'); ?>
        <?php echo $form->dropDownList($model, 'isSupervisor', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'isSupervisor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'isGroupSupervisor'); ?>
        <?php echo $form->dropDownList($model, 'isGroupSupervisor', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'isGroupSupervisor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'clearPassword1'); ?>
        <?php echo $form->passwordField($model, 'clearPassword1', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'clearPassword1'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'clearPassword2'); ?>
        <?php echo $form->passwordField($model, 'clearPassword2', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'clearPassword2'); ?>
    </div>

    <div class="simple">
        <?php echo $form->labelEx($model, 'lastPasswordChange'); ?>
        <?php echo CHtml::encode($model->lastPasswordChange); ?>&nbsp;
    </div>
    <br/>

    <div class="simple">
        <?php echo $form->labelEx($model, 'pdfPassword'); ?>
        <?php echo $form->passwordField($model, 'pdfPassword', array('size' => 20, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'pdfPassword'); ?>
    </div>

    <hr/>

    <div class="row">
        <?php echo $form->labelEx($model, 'enforceOtp'); ?>
        <?php echo $form->dropDownList($model, 'enforceOtp', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'enforceOtp'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'otpKey'); ?>
        <?php echo CHtml::encode($model->otpKey); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'otp'); ?>
        <?php echo $form->textField($model, 'otp', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'otp'); ?>
    </div>

    <hr/>


    <div class="row">
        <?php echo $form->labelEx($model, 'enforceOtpG'); ?>
        <?php echo $form->dropDownList($model, 'enforceOtpG', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'enforceOtpG'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'otpGKey'); ?>
        <?php if ($model->otpGKey != ''): ?>
            <?php echo CHtml::link('Reiniciar la Segunda Clave', array('resetOtpG', 'id' => $model->id), array('onclick' => 'return confirm("Esta seguro de reiniciar la válidación OTP del usuario?")')); ?>
        <?php else: ?>
            <b>El Usuario Debe reiniciar la validación de OTP</b>
        <?php endif; ?>
    </div>

    <hr/>

    <div class="row">
        <?php echo $form->labelEx($model, 'accessToReports'); ?>
        <?php echo $form->dropDownList($model, 'accessToReports', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToReports'); ?>
    </div>

    <br/>
    <div class="row">
        <?php echo $form->labelEx($model, 'accessToTemporalReports'); ?>
        <?php echo $form->dropDownList($model, 'accessToTemporalReports', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToTemporalReports'); ?>
    </div>

    <br/>
    <div class="row">
        <?php echo $form->labelEx($model, 'accessToPdfReport'); ?>
        <?php echo $form->dropDownList($model, 'accessToPdfReport', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToPdfReport'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'accessToNegativeReports'); ?>
        <?php echo $form->dropDownList($model, 'accessToNegativeReports', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToNegativeReports'); ?>
    </div>

    <br/>
    <div class="row">
        <?php echo $form->labelEx($model, 'accessToCertificates'); ?>
        <?php echo $form->dropDownList($model, 'accessToCertificates', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToCertificates'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'certifiedFindings'); ?>
        <?php echo $form->dropDownList($model, 'certifiedFindings', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'certifiedFindings'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'accessToNegativeCertificates'); ?>
        <?php echo $form->dropDownList($model, 'accessToNegativeCertificates', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToNegativeCertificates'); ?>
    </div>

    <br/>
    <div class="row">
        <?php echo $form->labelEx($model, 'accessToOfac'); ?>
        <?php echo $form->dropDownList($model, 'accessToOfac', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToOfac'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'accessToDocumentManagement'); ?>
        <?php echo $form->dropDownList($model, 'accessToDocumentManagement', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToDocumentManagement'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'notifyByMail'); ?>
        <?php echo $form->dropDownList($model, 'notifyByMail', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'notifyByMail'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'accessToCompanyReports'); ?>
        <?php echo $form->dropDownList($model, 'accessToCompanyReports', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToCompanyReports'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'accessToCreateBC'); ?>
        <?php echo $form->dropDownList($model, 'accessToCreateBC', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToCreateBC'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
