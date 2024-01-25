<?php

$this->breadcrumbs = array(
    'Solicitar',
);

$this->menu = array(
    array('label' => 'Manage BackgroundCheck', 'url' => array('admin')),
);
?>
<script>
    function checkIdNumber(ans) {
        var continueSubmit;
        if (ans == "1") {
            var r = confirm("Ya se ha solicitador previamente un estudio para la persona identificada con [" + $("#BackgroundCheck_idNumber").val() + "]. Desea volverlo a solicitar?");
            if (r == true)
            {
                continueSubmit = true;
            } else {
                continueSubmit = false;
            }
        } else {
            continueSubmit = true;
        }
        if (continueSubmit) {
            $("#person-security-evaluation-form").trigger("submit");
        }
    }

        // La siguiente funcion valida el elemento input
    function validar(value) {

        // Variable que usaremos para determinar si el input es valido
        let isValid = false;
        // El input que queremos validar
        const input = value;
        //El div con el mensaje de advertencia:
        const message = document.getElementById('message');

        input.willValidate = false;
        // El tamaño maximo para nuestro input
        const maximo = 45;
        // El pattern que vamos a comprobar
        const pattern = new RegExp('^[a-zA-Z áéíóúÁÉÍÓÚñÑ´]+$', 'i');

        // Primera validacion, si input esta vacio entonces no es valido
        if(!input) {
        isValid = false;
        } else {
            // Segunda validacion, si input es mayor que 45
            if(input.length > maximo) {
                isValid = false;
            } else {
                // Tercera validacion, si input contiene caracteres diferentes a los permitidos
                if(!pattern.test(input)){ 
                // Si queremos agregar letras acentuadas y/o letra ñ debemos usar
                // codigos de Unicode (ejemplo: Ñ: \u00D1  ñ: \u00F1)
                isValid = false;
                } else {
                // Si pasamos todas la validaciones anteriores, entonces el input es valido
                isValid = true;
                }
            }
        }

        // devolvemos el valor de isValid
        if (!isValid && value!='') {
            document.getElementById("message").style.display = "block";
            document.getElementById("BackgroundCheck_city").value = "";
        } else {
            document.getElementById("message").style.display = "none";
        }
    }
</script>

<h1>Solicitar un Estudio de Seguridad de <?php echo ($isCompanyStudy ? "Empresa" : "Persona"); ?></h1>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ProcessView.css" />

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'person-security-evaluation-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => (array('enctype' => 'multipart/form-data'))
    ));
    ?>

    <?php echo $form->errorSummary($backgroundCheck); ?>
    <fieldset>
        <legend>Cliente y tipo de Reporte</legend>  

        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'customerId'); ?>
            <?php echo $backgroundCheck->customer->name; ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'customerUserId'); ?>
            <?php echo $backgroundCheck->customerUser->username; ?>
        </div>


        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'customerProductId'); ?>

            <?php if (Yii::app()->user->getIsGroupSupervisor()): ?>
                <?php
                $customerProducts = $backgroundCheck->customer ? $backgroundCheck->customer->customerGroup->getCustomerProductByType($isCompanyStudy) : array();
                $customerProductsArray = array();
                /* @var $customerProduct CustomerProduct */
                foreach ($customerProducts as $customerProduct) {
                    if ($customerProduct->isActive) {
                        $customerProductsArray[$customerProduct->id] = $customerProduct->customer->name . ':' . $customerProduct->name;
                    }
                }

                echo CHtml::activeDropDownList(//
                        $backgroundCheck, //
                        'customerProductId', $customerProductsArray);
                ?>
            <?php else: ?>
                <?php
                echo CHtml::activeDropDownList(//
                        $backgroundCheck, //
                        'customerProductId', //
                        CHtml::listData(
                                $backgroundCheck->customer ? $backgroundCheck->customer->getCustomerProductByType($isCompanyStudy) : array(), //
                                'id', //
                                'name'));
                ?>
            <?php endif; ?>
            <?php echo $form->error($backgroundCheck, 'customerProductId'); ?>

        </div>
        
        <?php if($backgroundCheck->customerUser->compliance==1): ?>
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'typeProduct'); ?>
            <?php
            echo $form->dropdownList($backgroundCheck, //
                'typeProduct', //
                array(
                    '' => 'N/A',
                    'Debida Diligencia Basica' => 'Debida Diligencia Basica',
                    'Debida Diligencia Intensificada' => 'Debida Diligencia Intensificada',
                    'Debida Diligencia Ampliada' => 'Debida Diligencia Ampliada',


                )
            );
            ?>
            <?php echo $form->error($backgroundCheck, 'typeProduct'); ?>
        </div>
        

        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'typeStudy'); ?>
            <?php
            echo $form->dropdownList($backgroundCheck, //
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
            <?php echo $form->error($backgroundCheck, 'typeStudy'); ?>
        </div>
        <?php endif; ?>
        
        <?php for ($i = 1; $i <= 9; $i++): ?>
            <div class="row">
                <?php $field = 'field' . $i; ?>
                <?php if (isset($backgroundCheck->customer) && ($backgroundCheck->customer->$field != "" )): ?>
                    <?php echo $form->label($backgroundCheck, ($backgroundCheck->customer ? $backgroundCheck->customer->$field : 'customerField' . $i), array('id' => 'field' . $i, 'required' => true)); ?>
                    <?php if ($backgroundCheck->customer->hasOptionsInField($i)): ?>
                        <?php
                        echo CHtml::activeDropDownList(
                                $backgroundCheck
                                , 'customerField' . $i
                                , $backgroundCheck->customer->optionsInFieldArray($i));
                        ?>
                    <?php else: ?>
                        <?php echo $form->textField($backgroundCheck, 'customerField' . $i, array('size' => 60, 'maxlength' => 255)); ?>
                    <?php endif; ?>
                    <?php echo $form->error($backgroundCheck, 'customerField' . $i); ?>
                <?php endif; ?>
            </div>
        <?php endfor; ?>




    </fieldset>

    <fieldset >
        <legend>Detalle</legend>  
        <div class="row">
            <?php if ($isCompanyStudy): ?>
                <?php echo $form->labelEx($backgroundCheck, 'Razón Social'); ?>
                <?php echo $form->textField($backgroundCheck, 'lastName', array('size' => 25, 'maxlength' => 255)); ?>
                <?php echo $form->error($backgroundCheck, 'lastName'); ?>
            <?php else: ?>
                <?php echo $form->labelEx($backgroundCheck, 'firstName'); ?>
                <div>
                    <?php echo $form->textField($backgroundCheck, 'firstName', array('size' => 25, 'maxlength' => 255)); ?>
                    Apellidos:
                    <?php echo $form->textField($backgroundCheck, 'lastName', array('size' => 25, 'maxlength' => 255)); ?>
                </div>
                <?php echo $form->error($backgroundCheck, 'firstName'); ?>
                <?php echo $form->error($backgroundCheck, 'lastName'); ?>
            <?php endif; ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'idNumber'); ?>
            <?php echo $form->textField($backgroundCheck, 'idNumber', array('size' => 15, 'maxlength' => 45)); ?>
            <?php echo $form->error($backgroundCheck, 'idNumber'); ?>
        </div>

        <?php if (!$isCompanyStudy): ?>

            <div>
                <?php echo $form->labelEx($backgroundCheck, 'datexpedition'); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'BackgroundCheck[datexpedition]',
                    'value' => $backgroundCheck->datexpedition,
                    // additional javascript options for the date picker plugin
                    'options' => array(
                        'showAnim' => 'fold',
                        'buttonText' => '...',
                        'dateFormat' => 'dd/mm/yy',
                        'showButtonPanel' => true,
                        'changeYear' => true,
                        'changeMonth' => true,
                        'readonly'=>true,
                        // 'maxDate' => "+0D",
                    ),
                    'htmlOptions' => array(
                        'style' => 'height:20px;',
                        'readonly' => 'readonly',
                    ),
                ));
                ?>
                <?php echo $form->error($backgroundCheck, 'datexpedition'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($backgroundCheck, 'tels'); ?>
                <?php echo $form->textField($backgroundCheck, 'tels', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($backgroundCheck, 'tels'); ?>

                <b>Celular:</b>
                <?php echo $form->textField($backgroundCheck, 'mobile', array('size' => 20, 'maxlength' => 10)); ?>
                <?php echo $form->error($backgroundCheck, 'mobile'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($backgroundCheck, 'city'); ?>
                <?php echo $form->textField($backgroundCheck, 'city', array('size' => 45, 'maxlength' => 45, 'onkeyup'=>"validar(this.value);", 'onblu'=>"validar(this.value);")); ?>
                <?php echo $form->error($backgroundCheck, 'city'); ?>
            </div>
            <div id="message" name="message" style="display:none; background-color: #FBC2C4; z-index: 10; width:40%">
                En Ciudad de Estudio introduzca solo letras (A-Z) o (a-z).
            </div>
            
            <div class="row">
                <?php echo $form->labelEx($backgroundCheck, 'applyToPosition'); ?>
                <?php echo $form->textField($backgroundCheck, 'applyToPosition', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($backgroundCheck, 'applyToPosition'); ?>
                <p class="hint">
                    (Si no tiene el cargo definido, por favor ingrese: N/A).
                </p>
            </div>
            <div class="row">
                <?php  echo $form->labelEx($backgroundCheck, 'email'); ?>
                <?php   echo $form->textField($backgroundCheck, 'email', array('size' => 45, 'maxlength' => 45)); ?>
                <?php  echo $form->error($backgroundCheck, 'email'); ?>
                <p class="hint">
                    (Si no tiene el email definido, por favor ingrese: N/A).
                </p>
            </div>
        <?php else: ?>

            <div class="row">
                <?php echo $form->labelEx($backgroundCheck, 'state'); ?>
                <?php echo $form->textField($backgroundCheck, 'state', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($backgroundCheck, 'state'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($backgroundCheck, 'city'); ?>
                <?php echo $form->textField($backgroundCheck, 'city', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($backgroundCheck, 'city'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($backgroundCheck, 'address'); ?>
                <?php echo $form->textField($backgroundCheck, 'address', array('size' => 45, 'maxlength' => 255)); ?>
                <?php echo $form->error($backgroundCheck, 'address'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($backgroundCheck, 'area'); ?>
                <?php echo $form->textField($backgroundCheck, 'area', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($backgroundCheck, 'area'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($backgroundCheck, 'tels'); ?>
                <?php echo $form->textField($backgroundCheck, 'tels', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($backgroundCheck, 'tels'); ?>

                <b>Celular:</b>
                <?php echo $form->textField($backgroundCheck, 'mobile', array('size' => 20, 'maxlength' => 10)); ?>
                <?php echo $form->error($backgroundCheck, 'mobile'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($backgroundCheck, 'contactPerson'); ?>
                <?php echo $form->textField($backgroundCheck, 'contactPerson', array('size' => 45, 'maxlength' => 255)); ?>
                <?php echo $form->error($backgroundCheck, 'contactPerson'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($backgroundCheck, 'email'); ?>
                <?php echo $form->textField($backgroundCheck, 'email', array('size' => 45, 'maxlength' => 255)); ?>
                <?php echo $form->error($backgroundCheck, 'email'); ?>
            </div>


        <?php endif; ?>

    </fieldset>
    <fieldset >
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'customerComments'); ?>
            <?php echo $form->textArea($backgroundCheck, 'customerComments', array('rows' => 5, 'cols' => 50)); ?>
            <?php echo $form->error($backgroundCheck, 'customerComments'); ?>
        </div>
        <p class="hint">
            (Si su solicitud es prioritaria o VIP, por favor escríbalo en el campo de comentarios).
        </p>

        <fieldset >
            <div class="row" style="margin: 10px 0 0 30px;">
                <?php
                echo CHtml::ajaxSubmitButton('Solicitar', array('vetting/checkIdNumber'), array(
                    'type' => 'POST',
                    'data' => array('idNumber' => 'js:$("#BackgroundCheck_idNumber").val()'),
                    'success' => 'js:checkIdNumber'
                ), array());
                ?>
            </div>

            <legend>Documentos relacionados</legend>  
            <?php for ($i = 1; $i <= 25; $i++) : ?>
                <div class="row"  style="visibility: <?php echo ($i > 2 ? 'hidden' : 'visible') ?>" id="docFile<?php echo $i ?>">
                    <?php echo $form->labelEx($docForm, "doc" . $i); ?>
                    <?php echo $form->fileField($docForm, "doc" . $i); ?>
                    <?php if ($i < 25 and $i > 1): ?>
                        <input onClick="js:$('#docFile<?php echo ($i + 1) ?>').css('visibility', 'visible');
                                        $(this).css('visibility', 'hidden');" type="button" value="Más archivos" /> 
                           <?php endif ?>
                </div>
            <?php endfor; ?>
        </fieldset>

        <?php //echo CHtml::submitButton('Solicitar'); ?>

        <?php $this->endWidget(); ?>


        <?php // print_r($backgroundCheck);?>
</div><!-- form -->