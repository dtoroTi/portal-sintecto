<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'customer-product-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'customerId'); ?>
        <?php
        echo $form->dropDownList($model, 'customerId', CHtml::listData(
                        Customer::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => 'Cliente...'));
        ?> 
        <?php echo $form->error($model, 'customerId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'typeProductId'); ?>
        <?php
        echo $form->dropDownList($model, 'typeProductId', CHtml::listData(Items::model()->findAllByAttributes(array('listId'=> DynamicList::L_TYPE_PRODUCT),array('order'=>'sort')),'id','value'),array('prompt' => 'Sin tipo ...'));
        ?>
        <?php echo $form->error($model, 'typeProductId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'attachmentFileId'); ?>
        <?php
        echo $form->dropDownList($model, 'attachmentFileId', CHtml::listData(
                AttachmentFile::model()->findAll(array('order' => 'name_doc')), 'id', 'name_doc'), array('prompt' => '...'));
        ?> 
        <?php echo $form->error($model, 'attachmentFileId'); ?>
    </div>

    <?php if(!$model->isNewRecord && $model->customer->isRecover==1) {?>
    <div class="row">
        <?php echo $form->labelEx($model, 'attachmentFileId2'); ?>
        <?php
        echo $form->dropDownList($model, 'attachmentFileId2', CHtml::listData(
                AttachmentFile::model()->findAll(array('order' => 'name_doc')), 'id', 'name_doc'), array('prompt' => '...'));
        ?> 
        <?php echo $form->error($model, 'attachmentFileId2'); ?>
    </div>
    <?php } ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'costVisitId'); ?>
        <?php echo $form->dropDownList($model, 'costVisitId', //
            CHtml::listData(InvoiceVisitCost::model()->findAll(array('order' => 'id ASC,descriptionCost')), 'id', 'summaryLineVisit'), array('prompt' => '...'));
        ?>
        <?php echo $form->error($model, 'costVisitId'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row tallRow">
        <?php echo $form->labelEx($model, 'comments'); ?>
        <?php echo $form->textArea($model, 'comments', array('rows' => 6, 'cols' => 100)); ?>
        <?php echo $form->error($model, 'comments'); ?>
    </div>


    <?php  if(!$model->isNewRecord && !empty($model->verificationsInProduct)):   
        $viewDate='';
        foreach ($model->verificationsInProduct as $verificationSection){
            if( $verificationSection->verificationSectionTypeId==4 ||  $verificationSection->verificationSectionTypeId==15 ||  $verificationSection->verificationSectionTypeId==24){
                $viewDate=true;
            }
        }
        if($viewDate==true):
        ?>
            <fieldset>
                <legend>Requisitos Validación Adversos</legend>
                <div class="row">
                    <?php echo $form->labelEx($model, 'isTusDatos'); ?>
                    <?php echo $form->checkBox($model, 'isTusDatos'); ?>
                    <?php echo $form->error($model, 'isTusDatos'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'isWC'); ?>
                    <?php echo $form->checkBox($model, 'isWC'); ?>
                    <?php echo $form->error($model, 'isWC'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'isSico'); ?>
                    <?php echo $form->checkBox($model, 'isSico'); ?>
                    <?php echo $form->error($model, 'isSico'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'isRamaUnif'); ?>
                    <?php echo $form->checkBox($model, 'isRamaUnif'); ?>
                    <?php echo $form->error($model, 'isRamaUnif'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'isMediosAbrt'); ?>
                    <?php echo $form->checkBox($model, 'isMediosAbrt'); ?>
                    <?php echo $form->error($model, 'isMediosAbrt'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'isJurad'); ?>
                    <?php echo $form->checkBox($model, 'isJurad'); ?>
                    <?php echo $form->error($model, 'isJurad'); ?>
                </div>
            </fieldset>
        <?php endif; ?>
    <?php endif; ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'incremental'); ?>
        <?php
        echo $form->dropdownList($model, //
            'incremental', //
            array(
                '...' => '...',
                'Si' => 'Si',
                'No' => 'No',
            )
        );
        ?>
        <?php echo $form->error($model, 'incremental'); ?>
    </div>

    <?php if(Yii::app()->user->name=='jcocoma@sintecto.com' || Yii::app()->user->name=='jcuellar@sintecto.com' || Yii::app()->user->name=='ngonzalez@svision.co' || Yii::app()->user->name=='nhenao@sintecto.com'): ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'maxDays'); ?>
        <?php echo $form->textField($model, 'maxDays', array('required' => TRUE, 'placeholder'=>"Días 0, si es producto con limite expres", 'size'=>"35")); ?>
        <?php echo $form->error($model, 'maxDays'); ?>
    </div>
    <?php else: ?>
    <div class="row">
        <?php if($model->isNewRecord): ?>
            <?php echo $form->labelEx($model, 'maxDays'); ?>
            <?php echo $form->textField($model, 'maxDays', array('required' => TRUE, 'placeholder'=>"Días 0, si es producto con limite expres", 'size'=>"35")); ?>
            <?php echo $form->error($model, 'maxDays'); ?>
        <?php else: ?>
            <?php echo $form->labelEx($model, 'maxDays'); ?>
            <?php echo CHtml::encode($model->maxDays); ?>
        <?php endif; ?>    
    </div>
    <?php endif; ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'maxInternalDays'); ?>
        <?php echo $form->textField($model, 'maxInternalDays', array('placeholder'=>"Días 0, si es producto con limite expres", 'size'=>"35")); ?>
        <?php echo $form->error($model, 'maxInternalDays'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'contract_Limit'); ?>
        <?php echo $form->textField($model, 'contract_Limit', array('size'=>"35")); ?>
        <?php echo $form->error($model, 'contract_Limit'); ?>
    </div>

    <?php if(Yii::app()->user->name=='jcocoma@sintecto.com' || Yii::app()->user->name=='jcuellar@sintecto.com' || Yii::app()->user->name=='ngonzalez@svision.co' || Yii::app()->user->name=='nhenao@sintecto.com'): ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'hourExpress'); ?>
        <?php echo $form->textField($model, 'hourExpress', array('required'=>TRUE, 'placeholder'=>"Minutos 0, si es producto con limite de días", 'size'=>"35")); ?>
        <?php echo $form->error($model, 'hourExpress'); ?>
    </div>
    <?php else: ?>
    <div class="row">
        <?php if($model->isNewRecord): ?>
            <?php echo $form->labelEx($model, 'hourExpress'); ?>
            <?php echo $form->textField($model, 'hourExpress', array('required'=>TRUE, 'placeholder'=>"Minutos 0, si es producto con limite de días", 'size'=>"35")); ?>
            <?php echo $form->error($model, 'hourExpress'); ?>
        <?php else: ?>
            <?php echo $form->labelEx($model, 'hourExpress'); ?>
            <?php echo CHtml::encode($model->hourExpress); ?>
        <?php endif; ?>    
    </div>
    <?php endif; ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'isCompanySurvey'); ?>
        <?php
        echo $form->dropdownList(
                $model, //
                'isCompanySurvey', //
                Controller::$optionsYesNo
        );
        ?>      
        <?php echo $form->error($model, 'isCompanySurvey'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'pdfReportTypeId'); ?>
        <?php
        echo $form->dropDownList($model, 'pdfReportTypeId', CHtml::listData(
                        PdfReportType::model()->findAllByAttributes(array('isCertificate' => false), array('order' => 'name')), 'id', 'name'), array('prompt' => 'Sin Plantilla ...'));
        ?> 
        <?php echo $form->error($model, 'pdfReportTypeId'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'pdfCertificateTypeId'); ?>
        <?php
        echo $form->dropDownList($model, 'pdfCertificateTypeId', CHtml::listData(
                        PdfReportType::model()->findAllByAttributes(array('isCertificate' => true), array('order' => 'name')), 'id', 'name'), array('prompt' => 'Sin Plantilla ...'));
        ?> 
        <?php echo $form->error($model, 'pdfCertificateTypeId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'generalData'); ?>
        <?php
        echo $form->dropdownList(
                $model, //
                'generalData', //
                Controller::$optionsYesNo
        );
        ?>      
        <?php echo $form->error($model, 'generalData'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'printSummarySection'); ?>
        <?php echo $form->dropdownList($model, 'printSummarySection', CustomerProduct::$SummaryTypes); ?>
        <?php echo $form->error($model, 'printSummarySection'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'notifyByMail'); ?>
        <?php echo $form->dropdownList($model, 'notifyByMail', Controller::$optionsYesNo); ?>      
        <?php echo $form->error($model, 'notifyByMail'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'isActive'); ?>
        <?php echo $form->dropDownList($model, 'isActive', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'isActive'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'availableInOffline'); ?>
        <?php echo $form->dropdownList($model, 'availableInOffline', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'availableInOffline'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'viewDynamicForm'); ?>
        <?php echo $form->dropDownList($model, 'viewDynamicForm', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'viewDynamicForm'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'preliminary'); ?>
        <?php echo $form->dropDownList($model, 'preliminary', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'preliminary'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'isStandard'); ?>
        <?php echo $form->dropDownList($model, 'isStandard', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'isStandard'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'cost'); ?>
        <?php echo $form->textField($model, 'cost', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'cost'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'priceYearAnt'); ?>
        <?php echo $form->textField($model, 'priceYearAnt', array('size' => 45, 'maxlength' => 45, 'disabled' =>Yii::app()->user->isCustomerPriceYearAnt)); ?>
        <?php echo $form->error($model, 'priceYearAnt'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'price'); ?>
        <?php echo $form->textField($model, 'price', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'price'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'priceFase1'); ?>
        <?php echo $form->textField($model, 'priceFase1', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->dropDownList($model, 'listFase1', CustomerProduct::$optionListsFases); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'CustomerProduct[dateFase1]',
            'value' => $model->dateFase1,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'priceFase1'); ?>
        <?php echo $form->error($model, 'listFase1'); ?>
        <?php echo $form->error($model, 'dateFase1'); ?>
    </div>    

    <div class="row">
        <?php echo $form->labelEx($model, 'priceFase2'); ?>
        <?php echo $form->textField($model, 'priceFase2', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->dropDownList($model, 'listFase2', CustomerProduct::$optionListsFases); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'CustomerProduct[dateFase2]',
            'value' => $model->dateFase2,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'priceFase2'); ?>
        <?php echo $form->error($model, 'listFase2'); ?>
        <?php echo $form->error($model, 'dateFase2'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'priceFase3'); ?>
        <?php echo $form->textField($model, 'priceFase3', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->dropDownList($model, 'listFase3', CustomerProduct::$optionListsFases); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'CustomerProduct[dateFase3]',
            'value' => $model->dateFase3,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'priceFase3'); ?>
        <?php echo $form->error($model, 'listFase3'); ?>
        <?php echo $form->error($model, 'dateFase3'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'expirationInterval'); ?>
        <?php
        echo $form->dropdownList($model, 'expirationInterval', CustomerProduct::$IntervalTypes);
        ?>
        <?php echo $form->error($model, 'expirationInterval'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear/Continuar' : 'Guardar/Continuar', array('name' => 'continue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->