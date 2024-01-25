<script type="text/javascript">
    function showSectionTypeDialog() {
        $("#dialog-form").dialog("open");
    }
    ;

    $(function () {
        $("#dialog-form").dialog({
            autoOpen: false,
            height: 300,
            width: 350,
            modal: true,
            buttons: {
                "Cambiar Tipo de Estudio": function () {

                    if (confirm("Realmente desea cambiar el tipo de estudio?") && confirm("Toda la información de las secciones no requeridas se borrará. Está de acuerdo?")) {
                        var a = document.createElement('a');
                        a.href = '/backgroundCheck/changeReportType?' +
                                'code=<?php echo CHtml::encode($model->code) ?>' +
                                '&customerProductId=' + $("#newCustomerProductId").val() +
                                '&pc=<?php echo CHtml::encode($pc) ?>';
                        a.click();

                        $(this).dialog("close");
                    }
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            },
            close: function () {
                allFields.val("").removeClass("ui-state-error");
            }
        });
    });
</script>

<div id="dialog-form" title="Seleccione el tipo estudio">
    <p class="validateTips">Por favor seleccione el nuevo tipo de estudio</p>

    <form>
        <fieldset>
            <?php echo CHtml::encode($model->getAttributeLabel('customerProductId')); ?>
            <?php
            echo CHtml::dropDownList(//
                    'newCustomerProductId', //
                    $model->customerProductId, //
                    CHtml::listData(
                            $model->customer ? $model->customer->getCustomerProductByType(1) : array(), //
                            'id', //
                            'name'));
            ?>
        </fieldset> 
    </form>
</div>

<div class="form wide ProcessTab">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'person-security-evaluation-form',
        'enableAjaxValidation' => false,
        'action' => array('/backgroundCheck/' . ($model->isNewRecord ? 'createCompanySurvey' : 'update'), 'code' => $model->code, 'pc' => $pc),
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>
    <fieldset>
        <legend>Cliente y tipo de Reporte</legend>  

        <div class="row">
            <?php echo $form->labelEx($model, 'customerId'); ?>
            <?php if ($model->isNewRecord): ?>
                <?php
                echo $form->dropDownList(
                        $model, //
                        'customerId', //
                        CHtml::listData(Customer::model()->customersWithUsersAndProducts(1), 'id', 'name'), //
                        array(//
                    'ajax' => array(
                        'type' => 'POST', //request type
                        'url' => CController::createUrl('/customer/dynamicCustomerProducts', array('companySurvey' => 1)),
                        'success' => '  
                  function updateDropdownLists(data){
                      $("#BackgroundCheck_customerUserId").html(data.customerUsers);
                      $("#BackgroundCheck_customerProductId").html(data.customerProducts);
                      if (data.customerFields.field1!=null) {
                        $("#field1").html(data.customerFields.field1);
                      }else{
                        $("#field1").html("&nbsp;");
                      }
                      if (data.customerFields.field2!=null) {
                        $("#field2").html(data.customerFields.field2);
                      }else{
                        $("#field2").html("&nbsp;");
                      }
                      if (data.customerFields.field3!=null) {
                        $("#field3").html(data.customerFields.field3);
                      }else{
                        $("#field3").html("&nbsp;");
                      }
                      if (data.customerFields.field4!=null) {
                        $("#field4").html(data.customerFields.field4);
                      }else{
                        $("#field4").html("&nbsp;");
                      }
                      if (data.customerFields.field5!=null) {
                        $("#field5").html(data.customerFields.field5);
                      }else{
                        $("#field5").html("&nbsp;");
                      }
                      if (data.customerFields.field6!=null) {
                        $("#field6").html(data.customerFields.field6);
                      }else{
                        $("#field6").html("&nbsp;");
                      }
                      if (data.customerFields.field7!=null) {
                        $("#field7").html(data.customerFields.field7);
                      }else{
                        $("#field7").html("&nbsp;");
                      }
                      if (data.customerFields.field8!=null) {
                        $("#field8").html(data.customerFields.field8);
                      }else{
                        $("#field8").html("&nbsp;");
                      }
                      if (data.customerFields.field9!=null) {
                        $("#field9").html(data.customerFields.field9);
                      }else{
                        $("#field9").html("&nbsp;");
                      }
                    }',
                        'error' => '
                  function(XMLHttpRequest, textStatus, errorThrown){
                        alert("Error en llamada Dinámica " + errorThrown);
                    }',
                        'dataType' => 'json',
                    ),
                    'prompt' => 'Cliente...',
                ));
                ?>
                <?php echo $form->error($model, 'customerId'); ?>
            <?php else: ?>
                <?php echo CHtml::encode($model->customer->name) ?>
            <?php endif; ?>

            <b style="padding-left: 300px;">
            <?php        
            if (!$model->statusFD==1) {
                $disabled='';
            }else{
                $disabled='true';
            }
            if(!$model->isNewRecord){
                if($model->customerProduct->viewDynamicForm==1 && $model->ooidFD!=NULL && $model->customer->isRecover==0){
                    echo CHtml::button('Traer datos Formulario Dinámico', array('onclick' =>'ans=confirm("Está seguro de traer los datos, para el estudio: ' . $model->code. ', esto eliminará la información de la plataforma de formularios dinámicos y traerá lo que el candidato haya ingresado?"); if (ans) {document.location.href="/backgroundCheck/answersDynamicForm?code='.$model->code.'&pc='.$pc.'&prt=1&val=1";}', 'disabled'=>$disabled));
                }

                if($model->customerProduct->viewDynamicForm==1 && $model->ooidFD!=NULL && $model->customer->isRecover==1){
                    echo CHtml::button('Traer datos FD SP', array('onclick' =>'ans=confirm("Está seguro de traer los datos, para el estudio: ' . $model->code. ', esto eliminará la información de la plataforma de formularios dinámicos y traerá lo que el candidato haya ingresado?"); if (ans) {document.location.href="/backgroundCheck/answersDynamicForm?code='.$model->code.'&pc='.$pc.'&prt=1&val=1";}', 'disabled'=>$disabled));
                }
            ?>
            <?php
                if (!$model->reciptFileStatus==1) {
                    $disabled2='';
                }else{
                    $disabled2='true';
                }

                if($model->customerProduct->viewDynamicForm==1 && $model->reciptFileooid!=NULL && $model->customer->isRecover==1){
                    echo CHtml::button('Traer datos FD Doc.', array('onclick' =>'ans=confirm("Está seguro de traer los datos, para el estudio: ' . $model->code. ', esto eliminará la información de la plataforma de formularios dinámicos y traerá lo que el candidato haya ingresado?"); if (ans) {document.location.href="/backgroundCheck/answersDynamicForm?code='.$model->code.'&pc='.$pc.'&prt=2&val=2";}', 'disabled'=>$disabled2));
                }
            }
            ?>
            </b>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'customerProductId'); ?>
            <?php if ($model->isNewRecord): ?>
                <?php
                echo CHtml::activeDropDownList(//
                        $model, //
                        'customerProductId', //
                        CHtml::listData(
                                $model->customer ? $model->customer->customerProducts : array(), //
                                'id', //
                                'name'), //
                        array('prompt' => '',));
                ?>
                <?php echo $form->error($model, 'customerProductId'); ?>
            <?php else: ?>
                <?php echo CHtml::encode($model->customerProduct->name) ?>
                <?php if (!$model->isNewRecord && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())): ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
                    echo CHtml::button('Cambiar', array('onclick' =>
                        "showSectionTypeDialog();"));
                    ?>
                <?php endif; ?>
            <?php endif; ?>

        </div>
        
        <!--vista ID workflow return GZF-->
        <!--Natalia Henao Mayorga //27/09/21-->
        <div class="row">
            <?php if ($model->WorkflowID!=null): ?>
                <?php echo $form->labelEx($model, 'WorkflowID'); ?>
                <?php echo CHtml::encode($model->WorkflowID)  ?>
                <?php echo $form->error($model, 'WorkflowID'); ?>
            <?php endif; ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'customerUserId'); ?>
            <?php
            echo CHtml::activeDropDownList(//
                    $model, //
                    'customerUserId', //
                    CHtml::listData(
                            $model->customer ? $model->customer->customerUsers : array(), //
                            'id', //
                            'username'), //
                    array('prompt' => '',));
            ?>
            <?php echo $form->error($model, 'customerUserId'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'typeProduct'); ?>
            <?php
            echo $form->dropdownList($model, //
                'typeProduct', //
                array(
                    '' => 'N/A',
                    'Debida Diligencia Basica' => 'Debida Diligencia Basica',
                    'Debida Diligencia Intensificada' => 'Debida Diligencia Intensificada',
                    'Debida Diligencia Ampliada' => 'Debida Diligencia Ampliada',


                )
            );
            ?>
            <?php echo $form->error($model, 'typeProduct'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'typeStudy'); ?>
            <?php
            echo $form->dropdownList($model, //
                'typeStudy', //
                array(
                    '' => 'N/A',
                    'Proveedores' => 'Proveedores',
                    'Clientes' => 'Clientes',
                    'Colaboradores' => 'Colaboradores',
                    'Otros' => 'Otros',

                )
            );
            ?>
            <?php echo $form->error($model, 'typeStudy'); ?>
        </div>


        <?php for ($i = 1; $i <= Customer::MAX_FIELDS; $i++): ?>
            <div class="row">
                <?php $field = 'field' . $i; ?>
                <?php if (isset($model->customer) && ($model->customer->$field != "" )): ?>
                    <?php echo $form->labelEx($model, ($model->customer ? $model->customer->$field : 'customerField' . $i), array('id' => 'field' . $i)); ?>
                    <?php if ($model->customer->hasOptionsInField($i)): ?>
                        <?php
                        echo CHtml::activeDropDownList(
                                $model
                                , 'customerField' . $i
                                , $model->customer->optionsInFieldArray($i));
                        ?>
                    <?php else: ?>
                        <?php echo $form->textField($model, 'customerField' . $i, array('size' => 60, 'maxlength' => 255)); ?>
                    <?php endif; ?>
                    <?php echo $form->error($model, 'customerField' . $i); ?>
                <?php endif; ?>
            </div>
        <?php endfor; ?>


    </fieldset>


    <?php if (!empty($model->customerProduct->comments)): ?>
        <fieldset>
            <legend>Punto Crítico</legend>  
            <div class="row flash-notice">
                <?php echo CHtml::encode($model->customerProduct->comments); ?>
            </div>
        </fieldset>
    <?php endif; ?>

    <?php if (!empty($model->customerComments)): ?>
        <fieldset>
            <legend>Comentarios del cliente</legend>  
            <div class="row flash-notice">
                <?php echo CHtml::encode($model->customerComments); ?>
            </div>
        </fieldset>
    <?php endif; ?>

    <fieldset >
        <legend>Detalle</legend>  
        <div class="row">
            <?php echo $form->labelEx($model, 'Empresa'); ?>
            <?php echo $form->textField($model, 'lastName', array('size' => 25, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'lastName'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'idNumber'); ?>
            <div>
                <?php echo $form->textField($model, 'idNumber', array('size' => 25, 'maxlength' => 255)); ?>
                Dígito de Verificación:
                <?php echo $form->textField($model, 'codVerification', array('size' => 2, 'maxlength' => 255)); ?>
            </div>
            <?php echo $form->error($model, 'idNumber'); ?>
            <?php echo $form->error($model, 'codVerification'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'state'); ?>
            <?php echo $form->textField($model, 'state', array('size' => 45, 'maxlength' => 45)); ?>
            <?php echo $form->error($model, 'state'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'city'); ?>
            <?php echo $form->textField($model, 'city', array('size' => 45, 'maxlength' => 45)); ?>
            <?php echo $form->error($model, 'city'); ?>
        </div>

        <?php if (!$pc) : ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'address'); ?>
                <?php echo $form->textField($model, 'address', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'address'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'area'); ?>
                <?php echo $form->textField($model, 'area', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'area'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'tels'); ?>
                <?php echo $form->textField($model, 'tels', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'tels'); ?>

                <b>Celular:</b>
                <?php echo $form->textField($model, 'mobile', array('size' => 20, 'maxlength' => 10)); ?>
                <?php echo $form->error($model, 'mobile'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'contactPerson'); ?>
                <?php echo $form->textField($model, 'contactPerson', array('size' => 45, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'contactPerson'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->textField($model, 'email', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'webPage'); ?>
                <?php echo $form->textField($model, 'webPage', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'webPage'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'ciiu'); ?>
                <?php echo $form->textField($model, 'ciiu', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'ciiu'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'descriptionCiiu'); ?>
                <?php echo $form->textField($model, 'descriptionCiiu', array('size' => 45, 'maxlength' => 90)); ?>
                <?php echo $form->error($model, 'descriptionCiiu'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'supplierClassification'); ?>
                <?php
                    echo $form->dropdownList(
                        $model, //
                        'shareholderType', //
                        Controller::$optionsSupplierClassificationType
                    );
                ?>
                <?php echo $form->error($model, 'supplierClassification'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'shareholderType'); ?>
                <?php
                    echo $form->dropdownList(
                        $model, //
                        'shareholderType', //
                        Controller::$optionsshareholderType
                    );
                ?>
                <?php echo $form->error($model, 'shareholderType'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'yearsOfActivity'); ?>
                <?php echo $form->textField($model, 'yearsOfActivity', array('size' => 45, 'maxlength' => 45)); ?> años
                <?php echo $form->error($model, 'yearsOfActivity'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'companySizeByActives'); ?>
                <?php echo $form->textField($model, 'companySizeByActives', array('size' => 45, 'maxlength' => 45)); ?> SMMLV
                <?php echo $form->error($model, 'companySizeByActives'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'SupplierOrigin'); ?>
                <?php echo $form->textField($model, 'SupplierOrigin', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'SupplierOrigin'); ?>
            </div>
        <?php endif; ?>

    </fieldset>


    <fieldset>
        <legend>Verificación</legend>  

        <div class="row">
        <b style="padding-left: 160px;">
        <?php if (!$model->isNewRecord && $model->customer->isRecover==1 && Yii::app()->user->isRecoverStudy) : ?>
            <?php //echo $form->labelEx($model, 'startStudy'); ?>
            <?php if ($model->startStudy==1):
                    //echo CHtml::button($model, 'startStudy', array('disabled' => 'true'));
                    echo CHtml::button('Iniciar Estudio', array('disabled'=>'true'));
                else:
                    echo CHtml::button('Iniciar Estudio', array('onclick'=>'dateUpdateStudyStart("'.$model->code.'");'));
                endif;
        endif; ?>
        </b>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'studyStartedOn'); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'BackgroundCheck[studyStartedOn]',
                'value' => $model->studyStartedOn,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'dateFormat' => 'yy-mm-dd',
                    'showButtonPanel' => true,
                ),
                'htmlOptions' => array(
                    'style' => 'height:20px;',
                ),
            ));
            ?>
            <?php echo $form->error($model, 'studyStartedOn'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'assignedOn'); ?>
            <?php echo CHtml::encode($model->assignedOn); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'backgroundCheckStatusId'); ?>
            <?php
            echo $form->dropdownList($model, //
                    'backgroundCheckStatusId', //
                    CHtml::listData(//
                            BackgroundCheckStatus::model()->findAll(array('order' => 'name')), //
                            'id', //
                            'name'), //
                    array(
                    )
            );
            ?>
            <?php echo $form->error($model, 'backgroundCheckStatusId'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'requestSystemId'); ?>
            <?php
            echo $form->dropdownList($model, //
                    'requestSystemId', //
                    CHtml::listData(//
                            RequestSystem::model()->findAll(array('order' => 'name')), //
                            'id', //
                            'name'), //
                    array(
            ));
            ?>
            <?php echo $form->error($model, 'requestSystemId'); ?>
        </div>

        <?php if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))): ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'studyLimitOn'); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'BackgroundCheck[studyLimitOn]',
                'value' => $model->studyLimitOn,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'dateFormat' => 'yy-mm-dd',
                    'showButtonPanel' => true,
                ),
                'htmlOptions' => array(
                    'style' => 'height:20px;',
                ),
            ));
            ?>
            <?php echo $form->error($model, 'studyLimitOn'); ?>
        </div>
        <?php else : ?>
            <?php echo ''; ?>
        <?php endif; ?>

        <?php if (!$model->isNewRecord && !$pc): ?>

            <div class="row">
                <?php echo $form->labelEx($model, 'personContacted'); ?>
                <?php
                echo $form->dropdownList(
                        $model, //
                        'personContacted', //
                        Controller::$optionsYesNo
                );
                ?>
                <?php echo $form->error($model, 'personContacted'); ?>
            </div>

        <?php endif; ?>
    </fieldset>

    <?php
// Creada por jonathan
    ?>
    <fieldset>
        <legend>Hallazgos</legend>
        <div class="row">  
            <?php echo $form->labelEx($model, 'findingLaboralHistory'); ?>
            <?php echo $form->checkBox($model, 'findingLaboralHistory'); ?>
            <?php echo $form->textField($model, 'findingtextLaboral', array('size' => 66, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'findingLaboralHistory'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'findingSocioeconomic'); ?>
            <?php echo $form->checkBox($model, 'findingSocioeconomic'); ?>
            <?php echo $form->error($model, 'findingSocioeconomic'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'findingfinantAnalys'); ?>
            <?php echo $form->checkBox($model, 'findingfinantAnalys'); ?>
            <?php echo $form->error($model, 'findingfinantAnalys'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'findingVisit'); ?>
            <?php echo $form->checkBox($model, 'findingVisit'); ?>
            <?php echo $form->error($model, 'findingVisit'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'findingAudit'); ?>
            <?php echo $form->checkBox($model, 'findingAudit'); ?>
            <?php echo $form->error($model, 'findingAudit'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'findingBackground'); ?>
            <?php echo $form->checkBox($model, 'findingBackground'); ?>
            <?php
            echo $form->dropdownList(
                $model, //
                'findingdropBackg', //
                Controller::$optionfindingBackground
            );
            ?>
            <?php echo $form->textField($model, 'findingtextBackg', array('size' => 50, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'findingBackground'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'findingrestricList'); ?>
            <?php echo $form->checkBox($model, 'findingrestricList'); ?>
            <?php
            echo $form->dropdownList(
                $model, //
                'findingdroprestrList', //
                Controller::$optionfindingrestricList
            );
            ?>
            <?php echo $form->textField($model, 'findingtextrestrList', array('size' => 50, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'findingrestricList'); ?>

            <div class="row">
                <?php echo $form->labelEx($model, 'findingDoc'); ?>
                <?php echo $form->checkBox($model, 'findingDoc'); ?>
                <?php
                echo $form->dropdownList(
                    $model, //
                    'findingdropDoc', //
                    Controller::$optionfindingDoc
                );
                ?>
                <?php echo $form->textField($model, 'findingtextDoc', array('size' => 50, 'maxlength' => 255)); ?>

                <?php echo $form->error($model, 'findingDoc'); ?>
            </div>

    </fieldset>

    <?php
    // Creada por jonathan
    ?>

    <!--Vista proceso de calidad desde infirmación general del estudio-->
    <!--Natalia Henao 09/06/2022-->
    <fieldset>
            <legend>Calidad</legend>  

       
            <div class="row">
                 <b style="padding-left: 86px;">Devoluciones</b>
                <?php
                echo $form->dropdownList(
                    $model, //
                    'qualityReturDev', //
                    Controller::$optionDevoluciones
                );
                ?>
                <?php echo $form->error($model, 'qualityReturDev'); ?>
                <b style="padding-left: 362px;">PNC</b>
                <b style="padding-left: 6px;">PQR</b><br>
            </div>
      
            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityLaboral'); ?>
                <?php echo $form->checkBox($model, 'qualityLaboral'); ?>
                <?php echo $form->textField($model, 'qualitytextLaboral', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;"><?php echo $form->checkBox($model, 'qualityLaboralPNC'); ?></b>
                <b style="padding-left: 23px;"><?php echo $form->checkBox($model, 'qualityLaboralPQR'); ?></b>
                <?php echo $form->error($model, 'qualityLaboral'); ?>
            </div>

            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityShareholder'); ?>
                <?php echo $form->checkBox($model, 'qualityShareholder'); ?>
                <?php echo $form->textField($model, 'qualitytextShareholder', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;"><?php echo $form->checkBox($model, 'qualityShareholderPNC'); ?></b>
                <b style="padding-left: 23px;"><?php echo $form->checkBox($model, 'qualityShareholderPQR'); ?></b>
                <?php echo $form->error($model, 'qualityShareholder'); ?>
            </div>

            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityGesDocument'); ?>
                <?php echo $form->checkBox($model, 'qualityGesDocument'); ?>
                <?php echo $form->textField($model, 'qualityTextGesDocument', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;">
                <?php echo $form->checkBox($model, 'qualityGesDocumentPNC'); ?></b>
                <b style="padding-left: 23px;">
                <?php echo $form->checkBox($model, 'qualityGesDocumentPQR'); ?></b>
                <?php echo $form->error($model, 'qualityTextGesDocument'); ?>
            </div>

            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityCustomer'); ?>
                <?php echo $form->checkBox($model, 'qualityCustomer'); ?>
                <?php echo $form->textField($model, 'qualitytextCustomer', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;"><?php echo $form->checkBox($model, 'qualityCustomerPNC'); ?></b>
                <b style="padding-left: 23px;"><?php echo $form->checkBox($model, 'qualityCustomerPQR'); ?></b>
                <?php echo $form->error($model, 'qualityCustomer'); ?>
            </div>

            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityProvider'); ?>
                <?php echo $form->checkBox($model, 'qualityProvider'); ?>
                <?php echo $form->textField($model, 'qualitytextProvider', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;"><?php echo $form->checkBox($model, 'qualityProviderPNC'); ?></b>
                <b style="padding-left: 23px;"><?php echo $form->checkBox($model, 'qualityProviderPQR'); ?></b>
                <?php echo $form->error($model, 'qualityProvider'); ?>
            </div>

            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityFinance'); ?>
                <?php echo $form->checkBox($model, 'qualityFinance'); ?>
                <?php echo $form->textField($model, 'qualitytextFinance', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;"><?php echo $form->checkBox($model, 'qualityFinancePNC'); ?></b>
                <b style="padding-left: 23px;"><?php echo $form->checkBox($model, 'qualityFinancePQR'); ?></b>
                <?php echo $form->error($model, 'qualityFinance'); ?>
            </div>

            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityFinantialAnalys'); ?>
                <?php echo $form->checkBox($model, 'qualityFinantialAnalys'); ?>
                <?php echo $form->textField($model, 'qualitytextFinantialAnalys', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;"><?php echo $form->checkBox($model, 'qualityFinantialAnalysPNC'); ?></b>
                <b style="padding-left: 23px;"><?php echo $form->checkBox($model, 'qualityFinantialAnalysPQR'); ?></b>
                <?php echo $form->error($model, 'qualityFinantialAnalys'); ?>
            </div>

            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityCompanyVisit'); ?>
                <?php echo $form->checkBox($model, 'qualityCompanyVisit'); ?>
                <?php echo $form->textField($model, 'qualitytextCompanyVisit', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;"><?php echo $form->checkBox($model, 'qualityCompanyVisitPNC'); ?></b>
                <b style="padding-left: 23px;"><?php echo $form->checkBox($model, 'qualityCompanyVisitPQR'); ?></b>
                <?php echo $form->error($model, 'qualityCompanyVisit'); ?>
            </div>
            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityReference'); ?>
                <?php echo $form->checkBox($model, 'qualityReference'); ?>
                <?php echo $form->textField($model, 'qualitytextReference', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;"><?php echo $form->checkBox($model, 'qualityReferencePNC'); ?></b>
                <b style="padding-left: 23px;"><?php echo $form->checkBox($model, 'qualityReferencePQR'); ?></b>
                <?php echo $form->error($model, 'qualityReference'); ?>
            </div>
            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityReturn'); ?>
                <?php echo $form->textField($model, 'qualityReturn', array('size' => 22, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'qualityReturn'); ?>
                A qué área Devuelve:
                <?php echo $form->textField($model, 'qualityReturnPer', array('size' => 22, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'qualityReturnPer'); ?>
            </div>
        </fieldset>

    <fieldset>
        <legend>Resultado</legend>  

        <div class="row">
            <?php echo $form->labelEx($model, 'resultId'); ?>
            <?php
            echo $form->dropdownList($model, //
                    'resultId', //
                    CHtml::listData(//
                            Result::model()->findAll(array('order' => 'name')), //
                            'id', //
                            'name') //
            );
            ?>
            <?php echo $form->error($model, 'result'); ?>
        </div>

        <?php if (!$model->isNewRecord && Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))): ?>
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
                <?php echo $form->labelEx($model, 'additionalPrice'); ?>
                <?php echo $form->textField($model, 'additionalPrice', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'additionalPrice'); ?>
            </div>        
            <div class="row">
                <?php echo $form->labelEx($model, 'additionalPriceComment'); ?>
                <?php echo $form->textField($model, 'additionalPriceComment', array('size' => 45, 'maxlength' => 100)); ?>
                <?php echo $form->error($model, 'additionalPriceComment'); ?>
            </div>    
        <?php endif; ?>

    </fieldset>

    <?php 
        if(!$model->isNewRecord){
            if ($model->startStudy==0 && $model->customer->isRecover==1){ 
                $disabledEs='true';
            }else{
                $disabledEs='';
            } 
        }else{
            $disabledEs=''; 
        }
    ?>

    <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('onClick' => 'this.disabled=true;this.form.submit();', 'disabled' => $disabledEs)); ?>

    <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear y retornar' : 'Guardar y retornar', array('name' => 'backToListButton', 'onClick' => 'this.disabled=true;this.form.submit();', 'disabled' => $disabledEs)); ?>

    <?php $this->endWidget(); ?>
</div><!-- form -->

<script>
     function dateUpdateStudyStart(code) {

        if (confirm("Está seguro de Iniciar con el proceso del Estudio de seguridad.?")) {
            var a = document.createElement('a');
            a.href = '/backgroundCheck/studyStart?' +
                    'code='+code;
            a.click();
            $(this).dialog("close");
        }
    }
</script>