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
            /*echo CHtml::dropDownList(//
                    'newCustomerProductId', //
                    $model->customerProductId, //
                    CHtml::listData(
                            $model->customer ? $model->customer->customerProducts : array(), //
                            'id', //
                            'name'));*/
            echo CHtml::dropDownList(//
                'newCustomerProductId', //
                $model->customerProductId, //
                CHtml::listData(
                        $model->customer ? $model->customer->getCustomerProductByTypeintegridad(1) : array(), //
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
        'action' => array('/backgroundCheck/' . ($model->isNewRecord ? 'create' : 'update'), 'code' => $model->code, 'pc' => $pc),
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
                        CHtml::listData(Customer::model()->customersWithUsersAndProducts(0), 'id', 'name'), //
                        array(//
                    'ajax' => array(
                        'type' => 'POST', //request type
                        'url' => CController::createUrl('/customer/dynamicActiveCustomerProducts', array('companySurvey' => 0)),
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

            <b style="padding-left: 200px;">
                <font color ="#CC1B03">
                    Contactar Jefe Inmediato:
                    <?php
                    echo $form->dropdownList(
                            $model, //
                            'bossContact', //
                            Controller::$optionsYesNo
                    );
                    ?>
                </font>
            </b>

            <b style="padding-left: 100px;">
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

        <div class="row">
            <?php echo $form->labelEx($model, 'customerUserId'); ?>
            <?php if ($model->isNewRecord): ?>
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
            <?php else: ?>
                <?php echo CHtml::encode($model->customerUser->username) ?>
            <?php endif; ?>
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
                    <?php echo $form->label($model, ($model->customer ? $model->customer->$field : 'customerField' . $i), array('id' => 'field' . $i, 'required' => true)); ?>
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
            <?php echo $form->labelEx($model, 'firstName'); ?>
            <div>
                <?php echo $form->textField($model, 'firstName', array('size' => 25, 'maxlength' => 255)); ?>
                Apellidos:
                <?php echo $form->textField($model, 'lastName', array('size' => 25, 'maxlength' => 255)); ?>
            </div>
            <?php echo $form->error($model, 'firstName'); ?>
            <?php echo $form->error($model, 'lastName'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'idNumber'); ?>
            <div>
                <?php echo $form->textField($model, 'idNumber', array('size' => 15, 'maxlength' => 45)); ?>
                (no incluya ".")&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Expedida en:
                <?php echo $form->textField($model, 'idFrom', array('size' => 15, 'maxlength' => 45)); ?>

            </div>
            <?php echo $form->error($model, 'idNumber'); ?>
            <?php echo $form->error($model, 'idFrom'); ?>
        </div>

        <div>
            <?php echo $form->labelEx($model, 'datexpedition'); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'BackgroundCheck[datexpedition]',
                'value' => $model->datexpedition,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'dateFormat' => 'dd/mm/yy',
                    'showButtonPanel' => true,
                    'changeYear' => true,
                    'changeMonth' => true,
                    // 'maxDate' => "+0D",
                ),
                'htmlOptions' => array(
                    'style' => 'height:20px;',
                    'readonly' => 'readonly',
                ),
            ));
            ?>
            <?php echo $form->error($model, 'datexpedition'); ?>
        </div>

        <?php if ($model->isNewRecord || $model->customerProduct->generalData) : ?>
            <?php if (!$pc) : ?>
                <div class="row">
                    <?php echo $form->labelEx($model, 'birthday'); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'BackgroundCheck[birthday]',
                        'value' => $model->birthday,
                        // additional javascript options for the date picker plugin
                        'options' => array(
                            'showAnim' => 'fold',
                            'buttonText' => '...',
                            'dateFormat' => 'yy-mm-dd',
                            'showButtonPanel' => true,
                            'changeYear' => true,
                            'changeMonth' => true,
                            'maxDate' => "+0D",
                        ),
                        'htmlOptions' => array(
                            'style' => 'height:20px;'
                        ),
                    ));
                    ?>
                    (<?php echo $model->age; ?> años)
                    <?php echo $form->error($model, 'birthday'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'birthPlace'); ?>
                    <?php echo $form->textField($model, 'birthPlace', array('size' => 60, 'maxlength' => 100)); ?>
                    <?php echo $form->error($model, 'birthPlace'); ?>
                </div>


                <div class="row">
                    <?php echo $form->labelEx($model, 'relationshipStatusId'); ?>
                    <?php
                    echo CHtml::activeDropDownList(//
                            $model, //
                            'relationshipStatusId', //
                            CHtml::listData(RelationshipStatus::model()->findAll(), 'id', 'name'), //
                            array('prompt' => 'Seleccione..',));
                    ?>
                    <?php echo $form->error($model, 'relationshipStatusId'); ?>

                </div>
            <?php endif; ?>

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
                <?php endif; ?>
            <?php endif; ?>
            
                <div class="row">
                    <?php echo $form->labelEx($model, 'tels'); ?>
                    <?php echo $form->textField($model, 'tels', array('size' => 45, 'maxlength' => 45)); ?>
                    <?php echo $form->error($model, 'tels'); ?>

                    <b>Celular:</b>
                    <?php echo $form->textField($model, 'mobile', array('size' => 20, 'maxlength' => 10)); ?>
                    <?php echo $form->error($model, 'mobile'); ?>
                </div>

                <div class="row">
                    <?php  echo $form->labelEx($model, 'email'); ?>
                    <?php  echo $form->textField($model, 'email', array('size' => 45, 'maxlength' => 45)); ?>
                    <?php  echo $form->error($model, 'email'); ?>
                </div>
                
                <div class="row">
                    <?php echo $form->labelEx($model, 'applyToPosition'); ?>
                    <?php echo $form->textField($model, 'applyToPosition', array('size' => 45, 'maxlength' => 45)); ?>
                    <?php echo $form->error($model, 'applyToPosition'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'salarytobeEarned'); ?>
                    <?php echo $form->textField($model, 'salarytobeEarned', array('size' => 45, 'maxlength' => 45)); ?>
                    <?php echo $form->error($model, 'salarytobeEarned'); ?>
                </div>
    </fieldset>

    <?php if ($model->isNewRecord || $model->customerProduct->generalData) : ?>

        <?php if (!$pc) : ?>
            <fieldset>
                <legend>Solicitud</legend>
                <div class="row">
                    <?php echo $form->labelEx($model, 'actualJob'); ?>
                    <?php echo $form->textField($model, 'actualJob', array('size' => 45, 'maxlength' => 45)); ?>
                    <?php echo $form->error($model, 'actualJob'); ?>
                </div>
            </fieldset>
        <?php endif; ?>

    <?php endif; ?>

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
            <?php echo $form->labelEx($model, 'created'); ?>
            <?php echo CHtml::encode($model->created); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'studyStartedOn'); ?>
            <?php if (Yii::app()->user->isSuperAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))): ?>
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
                        'readonly' => 'readonly'
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'studyStartedOn'); ?>
            <?php else: ?>
                <?php echo CHtml::encode($model->studyStartedOn); ?>
            <?php endif; ?>
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
            <?php if (Yii::app()->user->isSuperAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))): ?>
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
            <?php else: ?>
                <?php echo CHtml::encode($model->studyLimitOn); ?>
            <?php endif; ?>
        </div>
        <?php else : ?>
            <?php echo ''; ?>
        <?php endif; ?>


        <?php if (!$model->isNewRecord && !$pc): ?>
        <div class="row">
            <?php if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))): ?>
                <?php echo $form->labelEx($model, 'studyInternalLimitOn')?>
            <?php else: ?>
                <?php if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))): ?>
                    <?php echo $form->labelEx($model, 'studyLimitOn');?>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (Yii::app()->user->isSuperAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))): ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'BackgroundCheck[maxInternalDays]',
                    'value' => $model->maxInternalDays,
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
                <?php echo $form->error($model, 'studyInternalLimitOn'); ?>
            <?php else: ?>
                <?php if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))): ?>
                    <?php echo  CHtml::encode($model->maxInternalDays); ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))): ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'dateLimitQuality'); ?>
            <?php if (Yii::app()->user->IsQualityDate): ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'BackgroundCheck[dateLimitQuality]',
                    'value' => $model->dateLimitQuality,
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
                <?php echo $form->error($model, 'dateLimitQuality'); ?>
            <?php else: ?>
                <?php echo CHtml::encode($model->dateLimitQuality); ?>
            <?php endif; ?>
        </div>
        <?php else : ?>
            <?php echo $form->labelEx($model, 'dateLimitQuality');  ?>
            <?php echo CHtml::encode($model->dateLimitQuality); ?>
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
                <?php echo $form->labelEx($model, 'findingVisit'); ?>
                <?php echo $form->checkBox($model, 'findingVisit'); ?>
                <?php echo $form->error($model, 'findingVisit'); ?>
            </div>

            <div class="row">
                <?php // echo $form->labelEx($model, 'findingReturn'); ?>
                <?php //echo $form->checkBox($model, 'findingReturn'); ?>
                <?php //echo $form->error($model, 'findingReturn'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'findingStudy'); ?>
                <?php echo $form->checkBox($model, 'findingStudy'); ?>
                <?php echo $form->textField($model, 'findingtextStudy', array('size' => 66, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'findingStudy'); ?>
            </div>
            <div class="row">

                <?php echo $form->labelEx($model, 'findingPolygraph'); ?>
                <?php echo $form->checkBox($model, 'findingPolygraph'); ?>
                <?php
                    echo $form->dropdownList(
                    $model, //
                    'findingdropPoly', //
                    Controller::$optionsfindingPolygraph
                );
                ?>
                <?php echo $form->textField($model, 'findingtextPoly', array('size' => 50, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'findingPolygraph'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'findingOther'); ?>
                <?php echo $form->checkBox($model, 'findingOther'); ?>
                <?php echo $form->error($model, 'findingOther'); ?>
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
                <?php echo $form->textField($model, 'findingtextBackg', array('size' => 44, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'findingBackground'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'findingTestPsychote'); ?>
                <?php echo $form->checkBox($model, 'findingTestPsychote'); ?>
                <?php echo $form->error($model, 'findingTestPsychote'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'findingODT'); ?>
                <?php echo $form->checkBox($model, 'findingODT'); ?>
                <?php echo $form->error($model, 'findingODT'); ?>
            </div>
        </fieldset>

        <!--Vista proceso de calidad desde infirmación general del estudio-->
        <!--Natalia Henao 27/10/2021-->
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

                <!--<b style="padding-left: 20px;">PQR</b>-->
                <?php //echo $form->checkBox($model, 'qualityPQR'); ?>
                <?php //echo $form->error($model, 'qualityPQR'); ?>

                <!--<b style="padding-left: 20px;">PNC</b>-->
                <?php //echo $form->checkBox($model, 'qualityComplain'); ?>
                <?php //echo $form->error($model, 'qualityComplain'); ?>
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
                <?php echo $form->labelEx($model, 'qualityEducation'); ?>
                <?php echo $form->checkBox($model, 'qualityEducation'); ?>
                <?php echo $form->textField($model, 'qualitytextEducation', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;">
                <?php echo $form->checkBox($model, 'qualityEducationPNC'); ?></b>
                <b style="padding-left: 23px;">
                <?php echo $form->checkBox($model, 'qualityEducationPQR'); ?></b>
                <?php echo $form->error($model, 'qualityEducation'); ?>
            </div>

            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityFinanlcial'); ?>
                <?php echo $form->checkBox($model, 'qualityFinanlcial'); ?>
                <?php echo $form->textField($model, 'qualitytextFinancial', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;">
                <?php echo $form->checkBox($model, 'qualityFinanlcialPNC'); ?></b>
                <b style="padding-left: 23px;">
                <?php echo $form->checkBox($model, 'qualityFinanlcialPQR'); ?></b>
                <?php echo $form->error($model, 'qualityFinanlcial'); ?>
            </div>

            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityAdverse'); ?>
                <?php echo $form->checkBox($model, 'qualityAdverse'); ?>
                <?php echo $form->textField($model, 'qualitytextAdverse', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;">
                <?php echo $form->checkBox($model, 'qualityAdversePNC'); ?></b>
                <b style="padding-left: 23px;">
                <?php echo $form->checkBox($model, 'qualityAdversePQR'); ?></b>
                <?php echo $form->error($model, 'qualityAdverse'); ?>
            </div>

            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityVisit'); ?>
                <?php echo $form->checkBox($model, 'qualityVisit'); ?>
                <?php echo $form->textField($model, 'qualitytextVisit', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;">
                <?php echo $form->checkBox($model, 'qualityVisitPNC'); ?></b>
                <b style="padding-left: 23px;">
                <?php echo $form->checkBox($model, 'qualityVisitPQR'); ?></b>
                <?php echo $form->error($model, 'qualityVisit'); ?>
            </div>

            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityPolygraph'); ?>
                <?php echo $form->checkBox($model, 'qualityPolygraph'); ?>
                <?php echo $form->textField($model, 'qualitytextPolygraph', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;">
                <?php echo $form->checkBox($model, 'qualityPolygraphPNC'); ?></b>
                <b style="padding-left: 23px;">
                <?php echo $form->checkBox($model, 'qualityPolygraphPQR'); ?></b>
                <?php echo $form->error($model, 'qualityPolygraph'); ?>
            </div>

            <div class="row">  
                <?php echo $form->labelEx($model, 'qualityTest'); ?>
                <?php echo $form->checkBox($model, 'qualityTest'); ?>
                <?php echo $form->textField($model, 'qualitytextTest', array('size' => 55, 'maxlength' => 255)); ?>
                <b style="padding-left: 8px;">
                <?php echo $form->checkBox($model, 'qualityTestPNC'); ?></b>
                <b style="padding-left: 23px;">
                <?php echo $form->checkBox($model, 'qualityTestPQR'); ?></b>
                <?php echo $form->error($model, 'qualityTest'); ?>
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
            <?php echo $form->error($model, 'resultId'); ?>
        </div>
        <?php if ($model->customerProduct && $model->customerProduct->hasXmlQuestion()): ?>
            <div class="errorMessage">
                Tenga en Cuenta que este reporte tiene una sección de PREGUNTAS que se debe llenar.
            </div>
        <?php endif ?>
        <div class="row tallRow">
            <?php echo $form->labelEx($model, 'comments'); ?>
            <?php echo $form->textArea($model, 'comments', array('rows' => 6, 'cols' => 100)); ?>
            <?php echo $form->error($model, 'comments'); ?>
        </div>

        <?php if (!$model->isNewRecord && Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))): ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'cost'); ?>
                <?php if ($model->daysPublicBackgroundcheck($model) >= 30):
                    echo $form->textField($model, 'cost', array('size' => 45, 'maxlength' => 45,'disabled' => 'true'));
                else:
                    echo $form->textField($model, 'cost', array('size' => 45, 'maxlength' => 45));
                endif;
                ?>
                <?php echo $form->error($model, 'cost'); ?>
            </div>  
            
            <div class="row">
                <?php echo $form->labelEx($model, 'price'); ?>
                <?php if ($model->daysPublicBackgroundcheck($model) >= 30):
                    echo $form->textField($model, 'price', array('size' => 45, 'maxlength' => 45,'disabled' => 'true'));
                    else:
                     echo $form->textField($model, 'price', array('size' => 45, 'maxlength' => 45));
                    endif;
                ?>
                <?php echo $form->error($model, 'price'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'additionalPrice'); ?>
                <?php if($model->daysPublicBackgroundcheck($model) >= 30):
                        echo $form->textField($model, 'additionalPrice', array('size' => 45, 'maxlength' => 45,'disabled' => 'true'));
                    else:
                        echo $form->textField($model, 'additionalPrice', array('size' => 45, 'maxlength' => 45));
                    endif;
                ?>
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
