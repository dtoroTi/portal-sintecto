<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'method' => 'post',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        )
            )
    );
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

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

    <div class="row">
        <?php echo $form->labelEx($model, 'pdfPassword'); ?>
        <?php echo $form->passwordField($model, 'pdfPassword', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'pdfPassword'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'goal'); ?>
        <?php echo $form->textField($model, 'goal', array('size' => 23, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'goal'); ?>
    </div>

    <!--<div class="row">
    <?php //echo $form->labelEx($model, 'area'); ?>
        <?php
            /*echo $form->dropdownList(
                $model, //
                'area', //
                Controller::$areatype
            );*/
        ?>
        <?php //echo $form->error($model, 'area'); ?>
    </div>-->
    
    <?php // Creada por Jonathan ?>
    <fieldset>
        <legend>Envio de Correos</legend>

        <div class="row">
            <?php echo $form->labelEx($model, 'MailAssigned'); ?>
            <?php echo $form->checkBox($model, 'MailAssigned'); ?>
            <?php echo $form->error($model, 'MailAssigned'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'Deallocated'); ?>
            <?php echo $form->checkBox($model, 'Deallocated'); ?>
            <?php echo $form->error($model, 'Deallocated'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'MailCancelled'); ?>
            <?php echo $form->checkBox($model, 'MailCancelled'); ?>
            <?php echo $form->error($model, 'MailCancelled'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'MailFinished'); ?>
            <?php echo $form->checkBox($model, 'MailFinished'); ?>
            <?php echo $form->error($model, 'MailFinished'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'MailPublished'); ?>
            <?php echo $form->checkBox($model, 'MailPublished'); ?>
            <?php echo $form->error($model, 'MailPublished'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'MailInformativeNews'); ?>
            <?php echo $form->checkBox($model, 'MailInformativeNews'); ?>
            <?php echo $form->error($model, 'MailInformativeNews'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'MailTimeImpact'); ?>
            <?php echo $form->checkBox($model, 'MailTimeImpact'); ?>
            <?php echo $form->error($model, 'MailTimeImpact'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'MailReturned'); ?>
            <?php echo $form->checkBox($model, 'MailReturned'); ?>
            <?php echo $form->error($model, 'MailReturned'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'MailApprovedPric'); ?>
            <?php echo $form->checkBox($model, 'MailApprovedPric'); ?>
            <?php echo $form->error($model, 'MailApprovedPric'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'MailStudyRequest'); ?>
            <?php echo $form->checkBox($model, 'MailStudyRequest'); ?>
            <?php echo $form->error($model, 'MailStudyRequest'); ?>
        </div>


    </fieldset>
    <?php // Creada por Jonathan ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'userTypeId'); ?>
        <?php
        echo $form->dropdownList($model, //
                'userTypeId', //
                CHtml::listData(//
                        UserType::getUserTypes(), //
                        'id', //
                        'name'),
                        ['onChange'=>'MostrarRole(this.value)']
                );
        ?>
        <?php echo $form->error($model, 'userTypeId'); ?>
    </div>

    <?php if($model->isNewRecord || $model->userTypeId!=7): ?>
    <div id="roleList" style="display: none;">
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
                    'labelOptions' => ['style' => 'display:inline;width:200px;text-align:right'],
                ]
            );
        ?>
        <?php echo $form->error($model, 'roleIds'); ?>
    </fieldset>
    </div>
    <?php else: ?>
    <?php if($model->userTypeId==7): ?>
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
    <?php endif; ?>
    <?php endif; ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'state'); ?>
        <?php echo $form->textField($model, 'state', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'state'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'city'); ?>
        <?php echo $form->textField($model, 'city', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'city'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'isInHouse'); ?>
        <?php echo $form->dropDownList($model, 'isInhouse', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'isInHouse'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'callManager'); ?>
        <?php echo $form->dropDownList($model, 'callManager', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'callManager'); ?>
    </div>
        
    <div class="row">
        <?php echo $form->labelEx($model, 'csvSeparator'); ?>
        <?php echo $form->textField($model, 'csvSeparator', array('size' => 60, 'maxlength' => 1)); ?>
        <?php echo $form->error($model, 'csvSeparator'); ?>
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
        <?php echo $form->labelEx($model, 'enforceOtp'); ?>
        <?php echo $form->dropDownList($model, 'enforceOtp', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'enforceOtp'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'userSeniorType'); ?>
        <?php echo $form->dropDownList($model, 'userSeniorType', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'userSeniorType'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model, 'userSeniorId'); ?>
        <?php //echo $form->dropDownList($model, 'userSeniorId', 
		/*CHtml::listData(User::model()->findAll(
				array(
					'order' => 'firstName',
					'condition' => 'userSeniorType=:idvalue',
					'params' => array(':idvalue' => 1))
		), 'id', 'summaryLine'), array('prompt' => '...'));*/
        ?>
        <?php //echo $form->error($model, 'userSeniorId'); ?>
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
    
    
    <div class="row">
        <?php echo $form->labelEx($model, 'enforceOtpG'); ?>
        <?php echo $form->dropDownList($model, 'enforceOtpG', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'enforceOtpG'); ?>
    </div>

    
    <div class="row">
        <?php echo $form->labelEx($model, 'otpGKey'); ?>
        <?php if ($model->otpGKey!=''):?>
        <?php echo CHtml::link('Reiniciar la Segunda Clave',array('resetOtpG','id'=>$model->id),array('onclick' => 'return confirm("Esta seguro de reiniciar la válidación OTP del usuario?")')); ?>
        <?php else:?>
        <b>El Usuario Debe reiniciar la validación de OTP</b>
        <?php endif;?>
    </div>

    <?php if (!$model->isNewRecord): ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'signatureFile'); ?>
            <?php echo $form->fileField($model, 'signatureFile'); ?>
            <?php echo $form->error($model, 'signatureFile'); ?>
        </div>
    <?php endif; ?>

    <?php if ($model->signature): ?>

        <div>
            <img src="<?= $this->createUrl('/user/signature/', array('id' => $model->id)) ?>">
        </div>
        <div>
            <?php
            echo CHtml::button('Borrar Firma', array(
                'submit' => array('/user/deleteSignature'),
                'confirm' => 'Esta seguro de borrar el archivo de la firma?',
                'params' => array(
                    'id'=>$model->id
                    )
                )
            );
            ?>
        </div>
    <br/><br/>
    <br/>
    <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear usuario' : 'Guardar usuario'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    //comment
    function MostrarRole(id) {
        roleIds = document.getElementById("roleList");
            if (id==7) {
                roleIds.style.display='block';
                //$("#roleList").show();
            }
            if (id!=7) {
                roleIds.style.display='none';
                //$("#roleList").hide();
            }
    }
</script>